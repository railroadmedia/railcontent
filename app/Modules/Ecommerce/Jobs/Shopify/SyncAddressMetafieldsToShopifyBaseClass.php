<?php

namespace App\Modules\Ecommerce\Jobs\Shopify;

use App\Modules\Ecommerce\Enums\ShopifyMetafieldKey;
use App\Modules\Ecommerce\Jobs\Shopify\Traits\HandlesShopifyRateLimit;
use App\Modules\Ecommerce\Models\Order;
use App\Modules\Ecommerce\Models\Shopify\MetaField;
use App\Modules\Ecommerce\Models\SubscriptionPayment;
use Exception;
use Illuminate\Bus\Batchable;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\Middleware\SkipIfBatchCancelled;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use Signifly\Shopify\Exceptions\NotFoundException;
use Signifly\Shopify\Exceptions\ValidationException;
use Signifly\Shopify\REST\Resources\MetafieldResource;
use Signifly\Shopify\Shopify;

abstract class SyncAddressMetafieldsToShopifyBaseClass implements ShouldQueue
{
    use Batchable;
    use Dispatchable;
    use HandlesShopifyRateLimit;
    use InteractsWithQueue;
    use Queueable;
    use SerializesModels;

    protected const RESULTS_SHOPIFY_ORDER_ID = "results_shopify_order_id";
    protected const RESULTS_STATUS = "results_status";
    protected const RESULTS_RESULT = "results_result";
    protected const STATUS_CREATED = "Created";
    protected const STATUS_FAILED = "FAILED";
    protected const STATUS_SKIPPED = "Skipped";
    protected const STATUS_UPDATED = "Updated";
    /**
     * The number of seconds the job can run before timing out.
     *
     * @var int
     */
    public $timeout = 840;
    protected Shopify $shopify;
    protected array $results = [];
    protected ?string $currentModelCountry = null;

    /**
     * Create a new job instance.
     */
    public function __construct(
        protected int $startAtId,
        protected int $endAtId,
        protected string $startCreatedAt,
        protected string $endCreatedAt,
        protected bool $simulate
    ) {
    }

    public function middleware(): array
    {
        return [new SkipIfBatchCancelled()];
    }

    /**
     * Execute the job
     *
     * @param  Shopify  $shopify
     * @return void
     * @throws Exception
     */
    public function handle(
        Shopify $shopify
    ): void {
        // set DI instances that we'll need
        $this->shopify = $shopify;

        Log::debug(
            sprintf(
                "%s: running batch %s of %s for %s %s - %s",
                get_class($this),
                $this->batch()->processedJobs() + 1,
                $this->batch()->totalJobs,
                Str::plural($this->getModelTypeName()),
                $this->startAtId,
                $this->endAtId
            )
        );

        $batchSize = 25;
        $this->loopSync($batchSize);
    }

    /**
     * Get the name of the type of model being used
     * (e.g. order)
     *
     * @return string
     */
    abstract protected function getModelTypeName(): string;

    /**
     * Get all the items that need to be synced, and perform the sync action on each one
     *
     * @param  int  $batchSize
     * @return void
     */
    protected function loopSync(int $batchSize): void
    {
        // get the items, using pagination to keep from blowing up the memory usage
        $modelsQuery = $this->getModelsQuery();

        Log::debug(
            sprintf(
                "Found %s %s to be synced. Performing in batches of %s.",
                $modelsQuery->count(),
                Str::plural($this->getModelTypeName(), $modelsQuery->count()),
                $batchSize
            )
        );

        $modelsQuery->chunkById($batchSize, function ($models) {
            $models->each(function (Order|SubscriptionPayment $model) {
                $this->currentModelCountry = null;
                try {
                    $shopifyMetafieldAttributes = $this->shopify->getOrderMetafields($model->shopify_id);
                    $this->handleRateLimit(true);
                    $shopifyMetafieldAttributes = $shopifyMetafieldAttributes->transform(
                        fn (MetafieldResource $metafieldResource) => $metafieldResource->getAttributes()
                    );
                    $this->handleRateLimit(true);
                } catch (NotFoundException $exception) {
                    $this->results[] = [
                        self::RESULTS_SHOPIFY_ORDER_ID => $model->shopify_id,
                        self::RESULTS_STATUS => self::STATUS_FAILED,
                        self::RESULTS_RESULT => "No order found in Shopify"
                    ];
                    return;
                }

                $countryResult = $this->handleMetafield(
                    ShopifyMetafieldKey::AddressCountry,
                    $model,
                    $shopifyMetafieldAttributes
                );
                $this->results[] = [
                    self::RESULTS_SHOPIFY_ORDER_ID => $model->shopify_id,
                    self::RESULTS_STATUS => key($countryResult),
                    self::RESULTS_RESULT => array_values($countryResult)[0]
                ];
                $regionResult = $this->handleMetafield(
                    ShopifyMetafieldKey::AddressRegion,
                    $model,
                    $shopifyMetafieldAttributes
                );
                $this->results[] = [
                    self::RESULTS_SHOPIFY_ORDER_ID => $model->shopify_id,
                    self::RESULTS_STATUS => key($regionResult),
                    self::RESULTS_RESULT => array_values($regionResult)[0]
                ];
            });
        });
        $this->printResults();
    }

    /**
     * Get the query builder to use to find applicable models.
     *
     * @return Builder
     */
    abstract protected function getModelsQuery(): Builder;

    /**
     * Handle the process for checking, creating, or updating the (type) metafield.
     *
     * @param  ShopifyMetafieldKey  $type
     * @param  Order|SubscriptionPayment  $model
     * @param  Collection<array>  $shopifyMetafieldAttributes
     * @return array[string $status, string $message]
     */
    protected function handleMetafield(
        ShopifyMetafieldKey $type,
        Order|SubscriptionPayment $model,
        Collection $shopifyMetafieldAttributes
    ): array {
        // safety check
        if (collect([ShopifyMetafieldKey::AddressRegion, ShopifyMetafieldKey::AddressCountry])->doesntContain($type)) {
            // coding error, so don't try to handle it gracefully. Just dump and die.
            dd(sprintf("%s: invalid metafield type %s", get_class(), $type->value));
        }

        $typeString = ucfirst(Str::after($type->value, 'address_'));

        $modelMetafield = collect($model->getMetafieldsForShopify())->filter(
            fn (MetaField $metaField) => $metaField->key == $type->value
        )->first();

        if (!$modelMetafield) {
            if ($type == ShopifyMetafieldKey::AddressCountry) {
                $this->currentModelCountry = null;
            }
            return [self::STATUS_SKIPPED => "No local $typeString"];
        }

        // sanitize the country, if that's our type
        if ($type == ShopifyMetafieldKey::AddressCountry) {
            $modelMetafield = $this->sanitizeCountryMetafield($modelMetafield);
        }

        // if we're doing the region for a Canadian address, clean it up
        if ($type == ShopifyMetafieldKey::AddressRegion) {
            $originalValue = $modelMetafield->value;
            $modelMetafield = $this->sanitizeRegion($modelMetafield);

            if (is_null($modelMetafield)) {
                return [self::STATUS_SKIPPED => "Invalid local $typeString: $originalValue"];
            }
        }

        // no metafields at all, so obviously needs to be created
        if ($shopifyMetafieldAttributes->isEmpty()) {
            return $this->createMetafield($typeString, $model, $modelMetafield);
        }

        // look for a metafield from Shopify
        $shopifyMetafield = collect($shopifyMetafieldAttributes)->first(
            fn ($item) => array_key_exists('key', $item) && $item['key'] === $type->value
        );

        // no metafield in Shopify, so create one
        if (is_null($shopifyMetafield)) {
            return $this->createMetafield($typeString, $model, $modelMetafield);
        } else {
            // Shopify already had a metafield, so compare it and see if we need to update
            if ($shopifyMetafield['value'] == $modelMetafield->value) {
                return [self::STATUS_SKIPPED => sprintf("%s: already set to %s", $typeString, $modelMetafield->value)];
            }
            // no match, so update the metafield
            return $this->updateMetafield($typeString, $shopifyMetafield['id'], $modelMetafield);
        }
    }

    /**
     * Update the given metafield to have the sanitized country name.
     * In case of sanitization failure due to invalid data, return null so the metafield creation can be skipped.
     *
     * @param  MetaField  $metaField
     * @return MetaField
     */
    protected function sanitizeCountryMetafield(MetaField $metaField): MetaField
    {
        // safety check
        if ($metaField->key != ShopifyMetafieldKey::AddressCountry->value) {
            // coding error, so don't try to handle it gracefully. Just dump and die.
            dd(sprintf("%s: invalid metafield type %s for sanitizeCountryMetafield", get_class(), $metaField->key));
        }

        // get the sanitized country name
        $this->currentModelCountry = $this->getCountryName($metaField->value);

        // clone the metafield and apply the country name
        $metaField = clone $metaField;
        $metaField->value = $this->currentModelCountry;

        return $metaField;
    }

    /**
     * Get the normalized country name, using the data found in our database (and ChatGPT's help).
     *
     * @param $input
     * @return string
     */
    protected function getCountryName($input): string
    {
        return match ($input) {
            "AFG", "Afghanistan" => "Afghanistan",
            "ARE", "United Arab Emirates" => "United Arab Emirates",
            "ARG", "Argentina" => "Argentina",
            "AUS", "Australia" => "Australia",
            "Austria", "AUT" => "Austria",
            "Bahamas", "The Bahamas" => "Bahamas",
            "Barbados", "BRB" => "Barbados",
            "Belgium", "BEL" => "Belgium",
            "Belize", "BLZ" => "Belize",
            "Bolivia", "Bolivia (Plurinational State of)", "Bolivia, Plurinational State of" => "Bolivia",
            "Bosnia and Herzegovina" => "Bosnia and Herzegovina",
            "BRA", "Brazil" => "Brazil",
            "Brunei", "Brunei Darussalam" => "Brunei",
            "CAN", "Canada" => "Canada",
            "CHE", "Switzerland" => "Switzerland",
            "Chile", "CHL" => "Chile",
            "China", "CHN" => "China",
            "Colombia", "COL" => "Colombia",
            "Congo", "Congo (Democratic Republic of the)" => "Congo",
            "Costa Rica", "CRI" => "Costa Rica",
            "Côte d'Ivoire", "Ivory Coast" => "Côte d'Ivoire",
            "Czech Republic", "Czechia", "CZE" => "Czech Republic",
            "Denmark", "DNK" => "Denmark",
            "Dominican Republic", "DOM" => "Dominican Republic",
            "Ecuador", "ECU" => "Ecuador",
            "Egypt", "EGY" => "Egypt",
            "Estonia", "EST" => "Estonia",
            "Falkland Islands (Malvinas)" => "Falkland Islands",
            "Finland", "FIN" => "Finland",
            "France", "FRA" => "France",
            "Germany", "DEU" => "Germany",
            "Ghana", "GHA" => "Ghana",
            "Greece", "GRC" => "Greece",
            "Grenada", "GRD" => "Grenada",
            "Guam", "GUM" => "Guam",
            "Guinea-Bissau" => "Guinea-Bissau",
            "Honduras", "HND" => "Honduras",
            "Hong Kong", "HKG" => "Hong Kong",
            "Iceland", "ISL" => "Iceland",
            "India", "IND" => "India",
            "Indonesia", "IDN" => "Indonesia",
            "Ireland", "IRL" => "Ireland",
            "Israel", "ISR" => "Israel",
            "Italy", "ITA" => "Italy",
            "JAM", "Jamaica" => "Jamaica",
            "Japan", "JPN" => "Japan",
            "Jersey", "JEY" => "Jersey",
            "KEN", "Kenya" => "Kenya",
            "Korea (Democratic People's Republic of)" => "North Korea",
            "Korea (Republic of)", "South Korea" => "South Korea",
            "Lao People's Democratic Republic", "Laos" => "Laos",
            "Macao", "Macau" => "Macau",
            "Macedonia", "North Macedonia" => "North Macedonia",
            "MYS", "Malaysia" => "Malaysia",
            "MLT", "Malta" => "Malta",
            "MUS", "Mauritius" => "Mauritius",
            "MEX", "Mexico" => "Mexico",
            "Montenegro", "MNE" => "Montenegro",
            "Mongolia", "MNG" => "Mongolia",
            "Moldova", "Moldova (Republic of)" => "Moldova",
            "NAM", "Namibia" => "Namibia",
            "Netherlands", "NLD" => "Netherlands",
            "New Caledonia" => "New Caledonia",
            "New Zealand", "NZL" => "New Zealand",
            "NGA", "Nigeria" => "Nigeria",
            "NOR", "Norway" => "Norway",
            "Oman", "OMN" => "Oman",
            "PAK", "Pakistan" => "Pakistan",
            "Palestine", "Palestine, State of" => "Palestine",
            "PAN", "Panama" => "Panama",
            "PER", "Peru" => "Peru",
            "Philippines", "PHL" => "Philippines",
            "POL", "Poland" => "Poland",
            "Portugal", "PRT" => "Portugal",
            "Puerto Rico", "PRI" => "Puerto Rico",
            "Qatar", "QAT" => "Qatar",
            "Romania", "ROU" => "Romania",
            "Russia", "Russian Federation", "RUS" => "Russia",
            "Saint Kitts and Nevis", "Saint Kitts and Nevis Anguilla" => "Saint Kitts and Nevis",
            "Saudi Arabia", "SAU" => "Saudi Arabia",
            "Singapore", "SGP" => "Singapore",
            "Sint Maarten", "Sint Maarten (Dutch part)" => "Sint Maarten",
            "Slovakia", "SVK" => "Slovakia",
            "Slovenia", "SVN" => "Slovenia",
            "South Africa", "ZAF" => "South Africa",
            "Spain", "ESP" => "Spain",
            "Sri Lanka", "LKA" => "Sri Lanka",
            "Sweden", "SWE" => "Sweden",
            "Syria", "SYR" => "Syria",
            "Taiwan", "TWN" => "Taiwan",
            "Thailand", "THA" => "Thailand",
            "Trinidad and Tobago", "TTO" => "Trinidad and Tobago",
            "Turkey", "TUR" => "Turkey",
            "Ukraine", "UKR" => "Ukraine",
            "United Kingdom", "GBR" => "United Kingdom",
            "United States", "USA" => "United States",
            "Venezuela", "Venezuela (Bolivarian Republic of)", "Venezuela, Bolivarian Republic of" => "Venezuela",
            "Vietnam", "Viet Nam", "VNM" => "Vietnam",
            "Zambia", "ZMB" => "Zambia",
            "Zimbabwe", "ZWE" => "Zimbabwe",
            default => $input,
        };
    }

    /**
     * Update the given metafield to have the sanitized Canadian province name,
     * if we're working on a Canadian address.
     * In case of sanitization failure due to invalid data, return null so the metafield creation can be skipped.
     *
     * @param  MetaField  $metaField
     * @return MetaField|null
     */
    protected function sanitizeRegion(MetaField $metaField): ?MetaField
    {
        // safety check
        if ($metaField->key != ShopifyMetafieldKey::AddressRegion->value) {
            // coding error, so don't try to handle it gracefully. Just dump and die.
            dd(sprintf("%s: invalid metafield type %s for sanitizeRegion", get_class(), $metaField->key));
        }

        // we're only doing this for Canadian provinces, so just return the unaltered version for any other country
        if ($this->currentModelCountry != "Canada") {
            return $metaField;
        }

        $metaField = clone $metaField;
        $province = $this->getProvinceName($metaField->value);

        if (is_null($province)) {
            return null;
        }

        $metaField->value = $province;
        return $metaField;
    }

    /**
     * Get the proper province name, using the data found in our database (and ChatGPT's help).
     *
     * @param $input
     * @return string|null
     */
    protected function getProvinceName($input): ?string
    {
        return match (strtolower($input)) {
            "ab", "ab - alberta", "albert", "alberta", "alberta, canada", "alverta", "ca-ab" => "Alberta",
            "b c", "b. c.", "b.c", "b.c.", "bc", "bc - british columbia", "british colmvia", "british colombia", "british columbia", "british columbua" => "British Columbia",
            "manatoba", "manitoba", "mannitoba", "mb" => "Manitoba",
            "n-b", "n.b", "n.b.", "nb", "new bruniswick", "new brunswick", "new-brunswick" => "New Brunswick",
            "newfoundland", "newfoundland & labrador", "newfoundland and labrador", "newfoundland/labrador", "nl" => "Newfoundland and Labrador",
            "nova scotia", "novascotia", "novs scotia", "ns" => "Nova Scotia",
            "northwest aterritories", "northwest territories", "nt" => "Northwest Territories",
            "nunavut" => "Nunavut",
            "on", "on - ontario", "on ontario", "on.", "ont", "ontario", "ontariuo", "ontaro", "ontatio" => "Ontario",
            "pe", "pei", "prince edward island" => "Prince Edward Island",
            "qc", "qc - quebec", "quebec", "quebec, canada", "quebecq", "quebuec", "quevec", "province of quebec", "province de quebec", "québec", "quÉbec" => "Quebec",
            "sask", "saskatchewan", "saskatchtwen", "sk" => "Saskatchewan",
            "yt", "yukon", "yukon territory" => "Yukon",
            default => null,
        };
    }

    /**
     * Create the (type) metafield in Shopify, with the given data for the given model.
     *
     * @param  string  $typeString
     * @param  Order|SubscriptionPayment  $model
     * @param  MetaField  $localMetaField
     * @return array[string $status, string $message]
     */
    protected function createMetafield(
        string $typeString,
        Order|SubscriptionPayment $model,
        MetaField $localMetaField
    ): array {
        if ($this->simulate) {
            return [self::STATUS_CREATED => sprintf("(simulated) %s: %s", $typeString, $localMetaField->value)];
        }

        try {
            $response = $this->shopify->createOrderMetafield(
                $model->shopify_id,
                MetaField::getStructureForShopify($localMetaField)
            );
            $this->handleRateLimit(true);
            if ($response->getAttributes()['value']) {
                return [self::STATUS_CREATED => sprintf("%s: %s", $typeString, $response->getAttributes()['value'])];
            }
        } catch (ValidationException $exception) {
            return [
                self::STATUS_FAILED =>
                    sprintf(
                        "validation error(s) when attempting to create %s metafield: %s",
                        $typeString,
                        collect($exception->errors)
                    )
            ];
        }
        return [self::STATUS_FAILED => "Unknown response when attempting to create $typeString metafield"];
    }

    /**
     * Update the (type) metafield in Shopify, with the given data for the given order.
     *
     * @param  string  $typeString
     * @param  int  $shopifyMetafieldId
     * @param  MetaField  $localMetaField
     * @return array[string $status, string $message]
     */
    protected function updateMetafield(string $typeString, int $shopifyMetafieldId, MetaField $localMetaField): array
    {
        if ($this->simulate) {
            return [self::STATUS_UPDATED => sprintf("(simulated) %s: %s", $typeString, $localMetaField->value)];
        }

        try {
            $response = $this->shopify->updateMetafield(
                $shopifyMetafieldId,
                MetaField::getStructureForShopify($localMetaField)
            );
            $this->handleRateLimit(true);
        } catch (ValidationException $exception) {
            return [
                self::STATUS_FAILED =>
                    sprintf(
                        "validation error(s) when attempting to update %s metafield: %s",
                        $typeString,
                        collect($exception->errors)
                    )
            ];
        }
        if ($response->getAttributes()['value']) {
            return [self::STATUS_UPDATED => sprintf("%s: %s", $typeString, $response->getAttributes()['value'])];
        }
        return [self::STATUS_FAILED => "Unknown response when attempting to update $typeString metafield"];
    }

    /**
     * Print the results in a table.
     *
     * @return void
     */
    protected function printResults(): void
    {
        if (empty($this->results)) {
            return;
        }

        $output = [];
        $output[] = "|".Str::padRight("", 100, "-")."|";
        $output[] = sprintf(
            "| %s | %s | %s |",
            $this->padForTable("Shopify Order ID"),
            $this->padForTable("Status"),
            $this->padForTable("Result", true),
        );
        $output[] = "|".Str::padRight("", 100, "-")."|";
        foreach ($this->results as $result) {
            $output[] = "| {$this->padForTable($result[self::RESULTS_SHOPIFY_ORDER_ID])} | {$this->padForTable($result[self::RESULTS_STATUS])} | {$this->padForTable($result[self::RESULTS_RESULT], true)} |";
        }
        $output[] = "|".Str::padRight("", 100, "-")."|";
        Log::info(PHP_EOL.implode(PHP_EOL, $output).PHP_EOL);
    }

    /**
     * Pad the given string so that it will fill a table column for our output
     *
     * @param  string  $string
     * @param  bool  $isLong
     * @return string
     */
    protected function padForTable(string $string, bool $isLong = false): string
    {
        return Str::padRight($string, $isLong ? 60 : 16, " ");
    }

    /**
     * @inheritDoc
     */
    protected function getIsSimulation(): bool
    {
        return $this->simulate;
    }
}
