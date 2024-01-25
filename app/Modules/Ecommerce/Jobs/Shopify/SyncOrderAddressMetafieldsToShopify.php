<?php

namespace App\Modules\Ecommerce\Jobs\Shopify;

use App\Modules\Ecommerce\Enums\ShopifyMetafieldKey;
use App\Modules\Ecommerce\Jobs\Shopify\Traits\HandlesShopifyRateLimit;
use App\Modules\Ecommerce\Models\Order;
use App\Modules\Ecommerce\Models\Shopify\MetaField;
use Exception;
use Illuminate\Bus\Batchable;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
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

class SyncOrderAddressMetafieldsToShopify implements ShouldQueue
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
    protected ?string $currentOrderCountry = null;

    /**
     * Create a new job instance.
     */
    public function __construct(
        protected int $startAtId,
        protected int $endAtId,
        protected bool $simulate
    ) {
    }

    public function middleware(): array
    {
        return [new SkipIfBatchCancelled];
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
                "%s: running batch %s of %s for orders %s - %s",
                get_class($this),
                $this->batch()->processedJobs() + 1,
                $this->batch()->totalJobs,
                $this->startAtId,
                $this->endAtId
            )
        );

        $batchSize = 25;
        $this->loopOrdersSync($batchSize);
    }

    /**
     * Get all the orders that need to be synced, and perform the sync action on each one
     *
     * @param  int  $batchSize
     * @return void
     */
    private function loopOrdersSync(int $batchSize): void
    {
        // get the orders, using pagination to keep from blowing up the memory usage
        $ordersQuery = Order::query()
            ->whereBetween("id", [$this->startAtId, $this->endAtId])
            ->whereNotNull('shopify_id');

        Log::debug(
            sprintf(
                "Found %s %s to be synced. Performing in batches of %s.",
                $ordersQuery->count(),
                Str::plural("order", $ordersQuery->count()),
                $batchSize
            )
        );

        $ordersQuery->chunkById($batchSize, function ($orders) {
            $orders->each(function (Order $order) {
                try {
                    $shopifyMetafieldAttributes = $this->shopify->getOrderMetafields($order->shopify_id);
                    $shopifyMetafieldAttributes = $shopifyMetafieldAttributes->transform(
                        fn(MetafieldResource $metafieldResource) => $metafieldResource->getAttributes()
                    );
                    $this->handleRateLimit(true);
                } catch (NotFoundException $exception) {
                    $this->results[] = [
                        self::RESULTS_SHOPIFY_ORDER_ID => $order->shopify_id,
                        self::RESULTS_STATUS => self::STATUS_FAILED,
                        self::RESULTS_RESULT => "No order found in Shopify"
                    ];
                    return;
                }

                $countryResult = $this->handleMetafield(
                    ShopifyMetafieldKey::AddressCountry,
                    $order,
                    $shopifyMetafieldAttributes
                );
                $this->results[] = [
                    self::RESULTS_SHOPIFY_ORDER_ID => $order->shopify_id,
                    self::RESULTS_STATUS => key($countryResult),
                    self::RESULTS_RESULT => array_values($countryResult)[0]
                ];
                $regionResult = $this->handleMetafield(
                    ShopifyMetafieldKey::AddressRegion,
                    $order,
                    $shopifyMetafieldAttributes
                );
                $this->results[] = [
                    self::RESULTS_SHOPIFY_ORDER_ID => $order->shopify_id,
                    self::RESULTS_STATUS => key($regionResult),
                    self::RESULTS_RESULT => array_values($regionResult)[0]
                ];
            });
        });
        $this->printResults();
    }

    /**
     * Handle the process for checking, creating, or updating the (type) metafield.
     *
     * @param  ShopifyMetafieldKey  $type
     * @param  Order  $order
     * @param  Collection<array>  $shopifyMetafieldAttributes
     * @return array[string $status, string $message]
     */
    protected function handleMetafield(
        ShopifyMetafieldKey $type,
        Order $order,
        Collection $shopifyMetafieldAttributes
    ): array {
        // safety check
        if (collect([ShopifyMetafieldKey::AddressRegion, ShopifyMetafieldKey::AddressCountry])->doesntContain($type)) {
            // coding error, so don't try to handle it gracefully. Just dump and die.
            dd(sprintf("%s: invalid metafield type %s", get_class(), $type->value));
        }

        $typeString = ucfirst(Str::after($type->value, 'address_'));

        $orderMetafield = collect($order->getMetafieldsForShopify())->filter(
            fn(MetaField $metaField) => $metaField->key == $type->value
        )->first();

        if (!$orderMetafield) {
            if ($type == ShopifyMetafieldKey::AddressCountry) {
                $this->currentOrderCountry = null;
            }
            return [self::STATUS_SKIPPED => "No local $typeString"];
        }

        // sanitize the country, if that's our type
        if ($type == ShopifyMetafieldKey::AddressCountry) {
            $orderMetafield = $this->sanitizeCountryMetafield($orderMetafield);
        }

        // if we're doing the region for a Canadian address, clean it up
        if ($type == ShopifyMetafieldKey::AddressRegion) {
            $orderMetafield = $this->sanitizeRegion($orderMetafield);

            if (is_null($orderMetafield)) {
                return [self::STATUS_SKIPPED => "Invalid local $typeString"];
            }
        }

        // no metafields at all, so obviously needs to be created
        if ($shopifyMetafieldAttributes->isEmpty()) {
            return $this->createMetafield($typeString, $order, $orderMetafield);
        }

        // look for a metafield from Shopify
        $shopifyMetafield = collect($shopifyMetafieldAttributes)->first(
            fn($item) => array_key_exists('key', $item) && $item['key'] === $type->value
        );

        // no metafield in Shopify, so create one
        if (is_null($shopifyMetafield)) {
            return $this->createMetafield($typeString, $order, $orderMetafield);
        } else {
            // Shopify already had a metafield, so compare it and see if we need to update
            if ($shopifyMetafield['value'] == $orderMetafield->value) {
                return [self::STATUS_SKIPPED => sprintf("%s: already set to %s", $typeString, $orderMetafield->value)];
            }
            // no match, so update the metafield
            return $this->updateMetafield($typeString, $shopifyMetafield['id'], $orderMetafield);
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
        $this->currentOrderCountry = $this->getCountryName($metaField->value);

        // clone the metafield and apply the country name
        $metaField = clone $metaField;
        $metaField->value = $this->currentOrderCountry;

        return $metaField;
    }

    /**
     * Get the normalized country name, using the data found in our database (and ChatGPT's help).
     *
     * @param $input
     * @return string
     */
    private function getCountryName($input): string
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
        if ($this->currentOrderCountry != "Canada") {
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
    private function getProvinceName($input): ?string
    {
        return match ($input) {
            "British Columbia", "BC", "B. C.", "British Colmvia", "British Columbua", "BRITISH COLOMBIA", "B C", "B.C.", "B.C", "BC - BRITISH COLUMBIA" => "British Columbia",
            "Ontario", "ON", "On.", "ont", "ontaro", "ON - Ontario", "ON ONTARIO", "Ontatio" => "Ontario",
            "Alberta", "AB", "AB - Alberta", "Alverta", "Albert", "CA-AB", "ALBERTA, CANADA" => "Alberta",
            "Quebec", "QC", "QC - Quebec", "quevec", "Quebuec", "Quebec, Canada", "PROVINCE DE QUEBEC", "Province of Quebec", "(QUEBEC)", "QUE" => "Quebec",
            "Saskatchewan", "SK", "Sask", "SASKATCHTWEN" => "Saskatchewan",
            "Manitoba", "MB", "Manatoba", "MANNITOBA" => "Manitoba",
            "New Brunswick", "NB", "N-B", "N.B.", "New-Brunswick", "Nouveau-Brunswick", "Nouveaux-Brunswick", "New Bruniswick" => "New Brunswick",
            "Nova Scotia", "NS", "NovaScotia", "NOVA  SCOTIA", "Novs Scotia" => "Nova Scotia",
            "Prince Edward Island", "PE", "PEI" => "Prince Edward Island",
            "Newfoundland and Labrador", "NL", "Newfoundland", "NEWFOUNDLAND & LABRADOR", "NEWFOUNDLAND/LABRADOR" => "Newfoundland and Labrador",
            "Yukon", "YT", "Yukon Territory" => "Yukon",
            "Northwest Territories", "NT", "northwest territories" => "Northwest Territories",
            "Nunavut" => "Nunavut",
            default => null,
        };
    }

    /**
     * Create the (type) metafield in Shopify, with the given data for the given order.
     *
     * @param  string  $typeString
     * @param  Order  $order
     * @param  MetaField  $localMetaField
     * @return array[string $status, string $message]
     */
    protected function createMetafield(string $typeString, Order $order, MetaField $localMetaField): array
    {
        if ($this->simulate) {
            return [self::STATUS_CREATED => sprintf("(simulated) %s: %s", $typeString, $localMetaField->value)];
        }

        try {
            $response = $this->shopify->createOrderMetafield(
                $order->shopify_id,
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
    private function printResults(): void
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
    private function padForTable(string $string, bool $isLong = false): string
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

    /**
     * @inheritDoc
     */
    protected function getClassName(): string
    {
        return get_class($this);
    }
}
