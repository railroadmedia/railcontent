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
        $products = $this->getEcommerceEntities($fresh)->take(2);

        $this->info("Found {$products->count()} products to be synced");

        $bar = $this->output->createProgressBar($products->count());
        $bar->start();

        $tableHeaders = ["Product ID", "sku", "Shopify Variant ID"];
        $tableRows = [];

        $products->each(function (Product $product) use ($fresh, $bar, $simulate, $shopifyIds, $location, &$tableRows) {
            // STEP 3: determine if updating or creating
            $isCreating = is_null($product->getShopifyId());

            // STEP 4: build up the data structure depending on product type
            //TODO do whatever special stuff for clothes. handle each type specially to make the nested variants and whatnot
            // and review what sku to use (maybe it varies by product type)?

            //TODO: check if there's a shopifyId (and not doing fresh) so we know if we're updating or creating

            $postData = [
                "title" => $product->getName(),
                "body_html" => $product->getDescription(),
                "vendor" => Str::ucfirst($product->getBrand()),
                "product_type" => Str::ucfirst($product->getType()),
                //TODO maybe need to do this separately
                "images" => [
                    [
                        "src" => $product->getThumbnailUrl(),
                    ]
                ],
                // TODO refer to https://shopify.dev/docs/apps/custom-data/metafields/types
                // we can use meta fields for stuff like our product id, etc
                //NOTE that updating a product with metafields seems to break, because keys "must be unique within this namespace on this resource"
                // "metafields" => [
                //     [
                //         // "product_id" => $product->getId()
                //         "key" => "_id",
                //         "value" => $product->getId(),
                //         "type" => "number_integer",
                //         "namespace" => "products"
                //     ]
                // ],
                // TODO?
                // "tags" => "",
                // TODO: need something to determine if draft or archived when it's not active
                "status" => $product->getActive() ? "active" : "draft",
                //TODO: this creates a new variant (and removes the old one), so be careful when doing updates
                "variants" => [
                    [
                        "price" => number_format($product->getPrice(), 2),
                        "sku" => $product->getInventoryControlSku(),
                        //TODO?
                        "taxable" => true,
                        "weight" => $product->getWeight(),
                        "weight_unit" => "lb",
                        "inventory_management" => "shopify",
                        "inventory_quantity" => $product->getStockAvailability(),
                        "requires_shipping" => $product->getIsPhysical(),
                        "location_id" => $location->getAttributes()["id"]
                    ]
                ]
            ];

            // STEP 5: send the data to Shopify
            if (!$simulate) {

                if ($isCreating) {
                    $productResource = $this->shopify->createProduct($postData);
                } else {
                    $variant = $this->shopify->getVariant($product->getShopifyId());
                    $productID = $variant->getAttributes()["product_id"];
                    $productResource = $this->shopify->updateProduct($productID, $postData);
                }

                /** @var VariantResource $variantData */
                $variantData = $productResource->getVariants()->first();
                $shopifyId = $variantData->id;
                $shopifyIds->push($shopifyId);

                // record the shopify ID
                $product->setShopifyId($shopifyId);
                $this->entityManager->persist($product);
                $this->entityManager->flush();
            } else {
                $shopifyId = "";
            }

            $tableRows[] = [$product->getId(), $product->getInventoryControlSku(), $shopifyId];
            $bar->advance();
        })->chunk(100);

        $bar->finish();
        $this->newLine();

        $this->table($tableHeaders, $tableRows);

        return $shopifyIds;
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
