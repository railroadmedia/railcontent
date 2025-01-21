<?php

namespace App\Modules\Ecommerce\Jobs\Shopify;

use App\Modules\Ecommerce\Enums\ShopifyMetafieldKey;
use App\Modules\Ecommerce\Enums\ShopifyMetafieldNamespace;
use App\Modules\Ecommerce\Enums\ShopifyMetafieldTypes;
use App\Modules\Ecommerce\Jobs\Shopify\Traits\HandlesShopifyRateLimit;
use App\Modules\Ecommerce\Models\Shopify\MetaField;
use App\Modules\Ecommerce\Traits\ExecutesShopifyGraphQlQuery;
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
use Signifly\Shopify\Exceptions\ValidationException;
use Signifly\Shopify\Shopify;
use stdClass;

class SyncProductDimensionMetafieldsToShopify implements ShouldQueue
{
    use Batchable;
    use Dispatchable;
    use ExecutesShopifyGraphQlQuery;
    use HandlesShopifyRateLimit;
    use InteractsWithQueue;
    use Queueable;
    use SerializesModels;

    private const STATUS_CREATED = "Created";
    private const STATUS_FAILED = "FAILED";
    private const STATUS_SKIPPED = "Skipped";
    private const STATUS_UPDATED = "Updated";
    private const MESSAGE_TYPE_INFO = "info";
    private const MESSAGE_TYPE_ERROR = "error";

    public int $timeout = 840;
    protected Shopify $shopify;

    /**
     * @param  array<string>  $skus
     */
    public function __construct(
        private readonly array $skus,
        private readonly int $length,
        private readonly int $width,
        private readonly int $height,
        private readonly bool $simulate,
    ) {
    }

    public function middleware(): array
    {
        return [new SkipIfBatchCancelled()];
    }

    /**
     * Execute the job
     *
     * @throws Exception
     */
    public function handle(
        Shopify $shopify
    ): void {
        // set DI instances that we'll need
        $this->shopify = $shopify;

        if (count($this->skus) === 1) {
            $queryString = "(sku:'{$this->skus[0]}')";
        } else {
            $queryString = '(sku:' . implode(' OR sku:', $this->skus) . ')';
        }

        // use GQL to get the product variants and product data
        $gql = <<<GRAPHQL
            query {
                productVariants(first: 25, query: "$queryString") {
                    nodes {
                        id
                        sku
                        metafields(first: 100) {
                            nodes {
                                id
                                key
                                value
                                type
                                namespace
                            }
                        }
                        product {
                            id
                            metafields(first: 100) {
                                nodes {
                                    id
                                    key
                                    value
                                    type
                                    namespace
                                }
                            }
                        }
                    }
                }
            }
            GRAPHQL;

        $results = $this->executeQuery($gql);

        $productVariants = collect();
        foreach ($results->data->productVariants->nodes as $node) {
            $productVariants->push(new ProductVariantData($node));
        };

        $missing = array_diff($this->skus, $productVariants->pluck('sku')->toArray());
        foreach ($missing as $sku) {
            Log::error("No product variant found for $sku");
        }

        if ($productVariants->isEmpty()) {
            return;
        }

        $product = $productVariants->first()->product;

        $lengthMetafield = new MetaField(
            ShopifyMetafieldKey::ProductLength,
            $this->length,
            ShopifyMetafieldTypes::decimal,
            ShopifyMetafieldNamespace::Model_Products,
        );
        $widthMetafield = new MetaField(
            ShopifyMetafieldKey::ProductWidth,
            $this->width,
            ShopifyMetafieldTypes::decimal,
            ShopifyMetafieldNamespace::Model_Products,
        );
        $heightMetafield = new MetaField(
            ShopifyMetafieldKey::ProductHeight,
            $this->height,
            ShopifyMetafieldTypes::decimal,
            ShopifyMetafieldNamespace::Model_Products,
        );

        $syncResult = $this->handleMetafield($product, $lengthMetafield);
        $this->logResult(key($syncResult), array_values($syncResult)[0], 'Product', $product->id);

        $syncResult = $this->handleMetafield($product, $widthMetafield);
        $this->logResult(key($syncResult), array_values($syncResult)[0], 'Product', $product->id);

        $syncResult = $this->handleMetafield($product, $heightMetafield);
        $this->logResult(key($syncResult), array_values($syncResult)[0], 'Product', $product->id);

        $productVariants->each(function (ProductVariantData $productVariant) use ($lengthMetafield, $widthMetafield, $heightMetafield) {
            $syncResult = $this->handleMetafield($productVariant, $lengthMetafield);
            $this->logResult(key($syncResult), array_values($syncResult)[0], 'Product Variant', $productVariant->id);

            $syncResult = $this->handleMetafield($productVariant, $widthMetafield);
            $this->logResult(key($syncResult), array_values($syncResult)[0], 'Product Variant', $productVariant->id);

            $syncResult = $this->handleMetafield($productVariant, $heightMetafield);
            $this->logResult(key($syncResult), array_values($syncResult)[0], 'Product Variant', $productVariant->id);
        });
    }


    /**
     * Handle the process for checking, creating, or updating the metafields for the Product or ProductVariant.
     *
     * @return array[string $status, string $message]
     */
    protected function handleMetafield(
        ProductData|ProductVariantData $data,
        MetaField $newMetaField
    ): array {

        // no metafields at all, so obviously needs to be created
        if ($data->metafields->isEmpty()) {
            return $this->createMetafield($data, $newMetaField);
        }

        // look for an existing metafield for this key
        $shopifyMetafield = $data->metafields->first(
            fn (MetafieldData $item) => $item->key == $newMetaField->key
        );

        // no existing metafield in Shopify, so create one
        if (is_null($shopifyMetafield)) {
            return $this->createMetafield($data, $newMetaField);
        } else {
            // Shopify already had this metafield, so compare it and see if we need to update
            if ($shopifyMetafield->value  == $newMetaField->value) {
                return [self::STATUS_SKIPPED => sprintf("%s: already set to %s", $newMetaField->key, $newMetaField->value)];
            }
            // no match, so update the metafield
            return $this->updateMetafield($shopifyMetafield->id, $newMetaField);
        }
    }

    /**
     * Create the metafield in Shopify, with the given data for the given model.
     *
     * @return array[string $status, string $message]
     */
    protected function createMetafield(
        ProductData|ProductVariantData $data,
        MetaField $newMetaField
    ): array {

        if ($this->simulate) {
            return [self::STATUS_CREATED => sprintf("%s: %s (simulated)", $newMetaField->key, $newMetaField->value)];
        }

        try {
            if ($data instanceof ProductVariantData) {
                $response = $this->shopify->createProductVariantMetafield(
                    $data->product->id,
                    $data->id,
                    MetaField::getStructureForShopify($newMetaField)
                );
            } else {
                $response = $this->shopify->createProductMetafield(
                    $data->id,
                    MetaField::getStructureForShopify($newMetaField)
                );
            }

            $this->handleRateLimit(true);
            if ($response->getAttributes()['value']) {
                return [self::STATUS_CREATED => sprintf("%s: %s", $newMetaField->key, $response->getAttributes()['value'])];
            }
        } catch (ValidationException $exception) {
            return [
                self::STATUS_FAILED =>
                    sprintf(
                        "validation error(s) when attempting to create %s metafield: %s",
                        $newMetaField->key,
                        collect($exception->errors)
                    )
            ];
        }
        return [self::STATUS_FAILED => sprintf("Unknown response when attempting to create %s metafield", $newMetaField->key)];
    }

    /**
     * Update the metafield in Shopify, with the given data for the given order.
     *
     * @return array[string $status, string $message]
     */
    protected function updateMetafield(int $shopifyMetafieldId, MetaField $newMetaField): array
    {
        if ($this->simulate) {
            return [self::STATUS_UPDATED => sprintf("%s: %s (simulated)", $newMetaField->key, $newMetaField->value)];
        }

        try {
            $response = $this->shopify->updateMetafield(
                $shopifyMetafieldId,
                MetaField::getStructureForShopify($newMetaField)
            );
            $this->handleRateLimit(true);
        } catch (ValidationException $exception) {
            return [
                self::STATUS_FAILED =>
                    sprintf(
                        "validation error(s) when attempting to update %s metafield: %s",
                        $newMetaField->key,
                        collect($exception->errors)
                    )
            ];
        }
        if ($response->getAttributes()['value']) {
            return [self::STATUS_UPDATED => sprintf("%s: %s", $newMetaField->key, $response->getAttributes()['value'])];
        }
        return [self::STATUS_FAILED => sprintf("Unknown response when attempting to update %s metafield", $newMetaField->key)];
    }

    /**
     * Log the results for this model
     */
    private function logResult(string $status, string $result, string $metafieldType, string $objectId, string $msgType = self::MESSAGE_TYPE_INFO): void
    {
        Log::$msgType(sprintf(
            '%s: %s %s %s - %s',
            'ProductDimensionsSync',
            $metafieldType,
            $objectId,
            $status,
            $result
        ));
    }

    /**
     * @inheritDoc
     */
    protected function getIsSimulation(): bool
    {
        return false;
    }

    /**
     * @inheritDoc
     */
    protected function getClassName(): string
    {
        return class_basename(__CLASS__);
    }

    /**
     * @inheritDoc
     */
    protected function getShopifyConnection(): Shopify
    {
        return $this->shopify;
    }

}
// @codingStandardsIgnoreStart
class ProductVariantData
{
    public string $sku;
    public string $id;
    public string $gid;
    /** @var Collection<MetafieldData> */
    public Collection $metafields;
    public ProductData $product;

    public function __construct(stdClass $data)
    {
        $this->sku = $data->sku;
        $this->gid = $data->id;
        $this->id = str_replace('gid://shopify/ProductVariant/', '', $this->gid);
        $this->metafields = collect();
        foreach ($data->metafields->nodes as $metafield) {
            $this->metafields->push(new MetafieldData($metafield));
        }
        $this->product = new ProductData($data->product);
    }
}

class ProductData
{
    public string $id;
    public string $gid;
    /** @var Collection<MetafieldData> */
    public Collection $metafields;

    public function __construct(stdClass $data)
    {
        $this->gid = $data->id;
        $this->id = str_replace('gid://shopify/Product/', '', $this->gid);
        $this->metafields = collect();
        foreach ($data->metafields->nodes as $metafield) {
            $this->metafields->push(new MetafieldData($metafield));
        }
    }
}

class MetafieldData
{
    public string $id;
    public string $gid;
    public string $key;
    public string $value;
    public string $type;
    public string $namespace;

    public function __construct(stdClass $data)
    {
        $this->gid = $data->id;
        $this->id = str_replace('gid://shopify/Metafield/', '', $this->gid);
        $this->key = $data->key ?? '';
        $this->value = $data->value ?? '';
        $this->type = $data->type ?? '';
        $this->namespace = $data->namespace ?? '';
    }
}
