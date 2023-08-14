<?php

namespace App\Console\Commands;

use App\Console\Commands\Traits\SyncsToShopify;
use Illuminate\Console\Command;
use Illuminate\Support\Collection;
use Illuminate\Support\Str;
use Railroad\Ecommerce\Entities\Product;
use Railroad\Ecommerce\Managers\EcommerceEntityManager;
use Railroad\Ecommerce\Repositories\ProductRepository;
use Railroad\Ecommerce\Repositories\RepositoryBase;
use Signifly\Shopify\REST\Resources\ApiResource;
use Signifly\Shopify\REST\Resources\ProductResource;
use Signifly\Shopify\REST\Resources\VariantResource;
use Signifly\Shopify\Shopify;

class SyncProductsToShopify extends Command
{
    use SyncsToShopify;

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'shopify:sync-products {--fresh} {--execute}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Sync our products up to Shopify';

    protected Shopify $shopify;
    protected ProductRepository $productRepository;
    protected EcommerceEntityManager $entityManager;

    const PRODUCT_TYPE_DIGITAL_ONE_TIME = "digital one time";
    const PRODUCT_TYPE_DIGITAL_SUBSCRIPTION = "digital subscription";
    const PRODUCT_TYPE_PHYSICAL_ONE_TIME = "physical one time";

    /**
     * Execute the console command.
     *
     * @param Shopify $shopify
     * @param ProductRepository $productRepository
     * @param EcommerceEntityManager $entityManager
     * @return int
     */
    public function handle(Shopify $shopify, ProductRepository $productRepository, EcommerceEntityManager $entityManager): int
    {
        $this->shopify = $shopify;
        $this->productRepository = $productRepository;
        $this->entityManager = $entityManager;

        return $this->sync();
    }

    /**
     * @inheritDoc
     * @throws \Exception
     */
    protected function syncResource(bool $simulate, bool $fresh): Collection
    {
        // STEP 1: get the location, so we can use it for the inventory
        /** @var ApiResource $location */
        $location = $this->shopify->getLocations()?->first() ?: null;
        if (empty($location)) {
            throw new \Exception("No location found! Please set up a location inside the Shopify store to proceed.");
        }

        $shopifyIds = collect();

        // STEP 2: get all the products that need to be synced
        $products = $this->getEcommerceEntities($fresh);

        $this->info("Found {$products->count()} products to be synced");

        $bar = $this->output->createProgressBar($products->count());
        $bar->start();

        $tableHeaders = ["Product ID", "sku", "Shopify Variant ID"];
        $tableRows = [];

        $products->each(function (Product $product) use ($fresh, $bar, $simulate, $shopifyIds, $location, &$tableRows) {
            // STEP 3: determine if updating or creating
            $isCreating = $fresh || is_null($product->getShopifyId());

            // STEP 4: build up the data structure depending on product type
            if ($product->getType() === self::PRODUCT_TYPE_DIGITAL_SUBSCRIPTION
            || $product->getType() === self::PRODUCT_TYPE_DIGITAL_ONE_TIME) {
                $postData = $isCreating ? $this->createProductData($product, $location->getAttributes()["id"])
                    : $this->updateProductData($product, $location->getAttributes()["id"]);
            } elseif($product->getType() === self::PRODUCT_TYPE_PHYSICAL_ONE_TIME){
                //TODO do whatever special stuff for clothes. handle each type specially to make the nested variants and whatnot
                $postData = [];
                return;
            } else {
                throw new \Exception(sprintf("Unknown product type %s. Expected types are: %s",
                        $product->getType(), implode(", ", [$this->PRODUCT_TYPE_DIGITAL_ONE_TIME,
                        $this->PRODUCT_TYPE_DIGITAL_SUBSCRIPTION, $this->PRODUCT_TYPE_PHYSICAL_ONE_TIME])));
            }

            // STEP 5: send the data to Shopify
            if (!$simulate) {

                if ($isCreating) {
                    $productResource = $this->shopify->createProduct($postData);
                } else {
                    $variant = $this->shopify->getVariant($product->getShopifyId());
                    $productID = $variant->getAttributes()["product_id"];
                    $productResource = $this->shopify->updateProduct($productID, $postData);
                    // if we're updating something in the variant, also call Shopify to update the variant
                    if (array_key_exists("variants", $postData)) {
                        $this->shopify->updateVariant($product->getShopifyId(), $postData["variants"]);
                    }
                }

                /** @var VariantResource $variantData */
                $variantData = $productResource->getVariants()->first();
                $shopifyId = $variantData->id;
                $shopifyIds->push($shopifyId);

                // record the shopify ID
                if ($product->getShopifyId() !== $shopifyId) {
                    $product->setShopifyId($shopifyId);
                    $this->entityManager->persist($product);
                    $this->entityManager->flush();
                }
            } else {
                $shopifyId = "";
            }

            $tableRows[] = [$product->getId(), $product->getSku(), $shopifyId];
            $bar->advance();
        })->chunk(100);

        $bar->finish();
        $this->newLine();

        $this->table($tableHeaders, $tableRows);

        return $shopifyIds;
    }

    /**
     * Create the data to post to Shopify to create a product
     *
     * @param Product $product
     * @param int $locationId
     * @return array
     */
    private function createProductData(Product $product, int $locationId): array
    {
        $postData = $this->formatProductData($product, true);

        // DEV NOTE: different types of products will do this differently, but this simple case is a 1-1 product-variant
        $postData["variants"] = [$this->createVariantData($product, $locationId, true)];

        return $postData;
    }

    /**
     * Build up the payload data to update a Product
     *
     * @param Product $product
     * @return array
     */
    private function updateProductData(Product $product): array
    {
        // first, we need to get the existing product from Shopify, so we know what to update
        $shopifyVariantId = $product->getShopifyId();
        $shopifyVariant = $this->shopify->getVariant($shopifyVariantId);
        $shopifyProductId = $shopifyVariant->getAttributes()["product_id"];
        $shopifyProduct = $this->shopify->getProduct($shopifyProductId);

        // now check for any applicable changes
        $productData = collect($this->formatProductData($product, false));
        $shopifyProductAttributes = collect($shopifyProduct->getAttributes())->only($productData->keys());

        $productChanges = $productData->diff($shopifyProductAttributes);

        // make sure we include the product ID so shopify knows to update (and not replace)
        $postData = ["id" => $shopifyProductId];
        $postData = array_merge($postData, $productChanges->toArray());

        // check for changes to the image, so we don't keep creating new images every time
        $shopifyImageData = $shopifyProduct->getAttributes()["images"];
        if (count($shopifyImageData)) {
            // shopify had one before ...
            if ($product->getThumbnailUrl()) {
                // ... and we have one now
                // DEV NOTE: Shopify hosts the image with its own cdn, so we have to just check if the actual file name is in there
                if (!Str::of(basename($shopifyImageData[0]["src"]))->contains(basename($product->getThumbnailUrl()))) {
                    // it's different, so replace it
                    $image = [
                        "src" => $product->getThumbnailUrl()
                    ];
                } else {
                    // it's the same, so do nothing
                    $image = null;
                }
            } else {
                // ... but we've removed it, so clear it out
                $image = [];
            }
        } else {
            // shopify didn't have one before, so add it if we have one now
            if ($product->getThumbnailUrl()) {
                $image = ["src" => $product->getThumbnailUrl()];
            } else {
                $image = null;
            }
        }

        if ($image !== null) {
            $postData["images"] = $image;
        }

        // check for changes to the variant, so we know to update it or not
        // DEV NOTE: there is always a variant, so we don't have to worry about checking for that or creating one,
        // and if we didn't supply the variant's ID, Shopify would end up replacing the existing one, so make sure to include it
        $variantData = collect($this->createVariantData($product, null, false));
        $shopifyVariantAttributes = collect($shopifyVariant->getAttributes())->only($variantData->keys());

        /*
          TODO: leaving this as an example, for now. We (currently) only use the metafields for the product ID, which
           won't ever change, so there's no need to handle updates

          $variantMetaFields = $this->shopify->getVariantMetafields($shopifyVariantId);
        */

        $variantChanges = $variantData->diff($shopifyVariantAttributes);
        if ($variantChanges->isNotEmpty()) {
            $postData["variants"] = array_merge(["id" => $shopifyVariantId], $variantChanges->toArray());
        }

        return $postData;
    }

    /**
     * Build an array with the properly formatted data for a Product
     *
     * @param Product $product
     * @param bool $withImage
     * @return array
     */
    private function formatProductData(Product $product, bool $withImage): array
    {
        $productData = [
            "title" => $product->getName(),
            "body_html" => $product->getDescription(),
            "vendor" => Str::ucfirst($product->getBrand()),
            "product_type" => Str::ucfirst($product->getType())
            //TODO?
            // "tags" => "",
        ];
        if ($withImage) {
            $productData["images"] = [
                [
                    "src" => $product->getThumbnailUrl(),
                ]
            ];
        }
        if ($product->getActive()) {
            $status = "active";
        } else {
            $status = $product->getDeletedAt() ? "archived" : "draft";
        }
        $productData["status"] = $status;

        return $productData;
    }

    /**
     * Create the data required to post a product to Shopify as a variant
     *
     * @param Product $product
     * @param int|null $locationId
     * @param bool $withMetafields
     * @return array
     */
    private function createVariantData(Product $product, ?int $locationId, bool $withMetafields): array
    {
        $variantData = [
            "compare_at_price" => number_format($product->getPrice(), 2),
            "price" => number_format($product->getPrice(), 2),
            "sku" => $product->getSku(),
            "weight" => $product->getWeight(),
            "weight_unit" => "lb",
            "inventory_management" => "shopify",
            "inventory_quantity" => $product->getStockAvailability(),
            "requires_shipping" => $product->getIsPhysical(),
        ];
        if ($locationId) {
            $variantData["location_id"] = $locationId;
        }
        if ($withMetafields) {
            // TODO?
            // refer to https://shopify.dev/docs/apps/custom-data/metafields/types
            // we can use meta fields for stuff like our product id, etc
            $variantData["metafields"] = [
                [
                    "key" => "_id",
                    "value" => $product->getId(),
                    "type" => "number_integer",
                    "namespace" => "products"
                ]
            ];
        }
        return $variantData;
    }


    private function createProductDataWithOptions(Product $product)
    {
        //    TODO - if the product is one that has options, handle it differently
    }

    private function updateProductDataWithOptions(Product $product)
    {
        //    TODO - if the product is one that has options, handle it differently
    }

    /**
     * @inheritDoc
     */
    protected function getShopifyResourceClass(): string
    {
        return ProductResource::class;
    }

    /**
     * @inheritDoc
     */
    protected function getSyncResource(): string
    {
        return "product";
    }

    /**
     * @inheritDoc
     */
    function getIsSimulation(): bool
    {
        return $this->option("execute") == false;
    }

    /**
     * @inheritDoc
     */
    function getIsFresh(): bool
    {
        return $this->option("fresh");
    }

    /**
     * @inheritDoc
     */
    protected function getEcommerceEntityRepository(): RepositoryBase
    {
        return $this->productRepository;
    }
}
