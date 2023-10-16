<?php

namespace App\Modules\Ecommerce\Jobs\Shopify;

use App\Models\ShopifySync;
use App\Modules\Ecommerce\Enums\ShopifyMetafieldKey;
use App\Modules\Ecommerce\Enums\ShopifyMetafieldNamespace;
use App\Modules\Ecommerce\Enums\ShopifyMetafieldTypes;
use App\Modules\Ecommerce\Jobs\Shopify\Traits\HandlesShopifyRateLimit;
use App\Modules\Ecommerce\Jobs\Shopify\Traits\LogsShopify;
use App\Modules\Ecommerce\Jobs\Shopify\Traits\SyncsToShopify;
use Carbon\Carbon;
use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\NonUniqueResultException;
use Doctrine\ORM\OptimisticLockException;
use Doctrine\ORM\ORMException;
use Exception;
use Illuminate\Bus\Batchable;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\Middleware\SkipIfBatchCancelled;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Collection;
use Illuminate\Support\Str;
use Railroad\Ecommerce\Entities\Product;
use Railroad\Ecommerce\Managers\EcommerceEntityManager;
use Railroad\Ecommerce\Repositories\ProductRepository;
use Railroad\Ecommerce\Repositories\RepositoryBase;
use Signifly\Shopify\REST\Resources\ProductResource;
use Signifly\Shopify\REST\Resources\VariantResource;
use Signifly\Shopify\Shopify;

class SyncProductsToShopify implements ShouldQueue
{
    use Batchable;
    use Dispatchable;
    use HandlesShopifyRateLimit;
    use InteractsWithQueue;
    use LogsShopify;
    use Queueable;
    use SerializesModels;
    use SyncsToShopify;

    /**
     * The number of seconds the job can run before timing out.
     *
     * @var int
     */
    public $timeout = 840; // 14 minutes
    private const SIZE_OPTION_NAME = "Size";
    private const SIZE_OPTION_KEY = "option1";
    private const SIZE_STRINGS = ["XS", "S", "M", "L", "XL", "XXL", "XXXL", "XXXXL"];

    protected Shopify $shopify;
    protected ProductRepository $productRepository;
    protected EcommerceEntityManager $entityManager;
    protected Collection $shopifyIds;
    // products that have been synced as part of a group, and should be skipped when encountered in the loop
    protected Collection $productsToSkip;
    // rows for displaying the results in a table
    protected array $results = [];

    public function middleware(): array
    {
        return [new SkipIfBatchCancelled];
    }

    public function __construct(
        protected int $startAtId,
        protected int $endAtId,
        protected int $locationId,
        protected Carbon $lastSyncAt,
        protected bool $simulate,
        protected bool $fresh)
    {
        $this->shopifyIds = collect();
        $this->productsToSkip = collect();
    }


    /**
     * Execute the job
     *
     * @param  Shopify  $shopify
     * @param  ProductRepository  $productRepository
     * @param  EcommerceEntityManager  $entityManager
     * @return void
     * @throws Exception
     */
    public function handle(
            Shopify $shopify,
            ProductRepository $productRepository,
            EcommerceEntityManager $entityManager
    ): void
    {
        // set DI instances that we'll need
        $this->shopify = $shopify;
        $this->productRepository = $productRepository;
        $this->entityManager = $entityManager;

        $this->logDebug(sprintf("%s: running batch for products %s - %s", $this->getClassName(), $this->startAtId, $this->endAtId));
        $this->sync();
    }


    /**
     * Get all the Products that make up the related options for this Product,
     * sorted to have the latest update first.
     * If there are no other related products, it will be empty.
     *
     * @param  Product  $product
     * @return Collection<Product>
     * @throws ORMException
     */
    private function getProductOptions(Product $product): Collection
    {
        $products = collect();
        $searchSkus = $this->buildProductSizeSkus($product);

        if ($searchSkus->isEmpty()) {
            return $products;
        }

        // use the searchSkus to find the other products
        $relatedProducts = $this->productRepository->bySkus($searchSkus->toArray());
        if (count($relatedProducts)) {
            $products->push($product);
            $products = $products->merge($relatedProducts);

            // sort the products so that the latest update is first
            $products = $products->sort(function (Product $product1, Product $product2) {
                return $product1->getUpdatedAt() < $product2->getUpdatedAt();
            });

            // record the IDs of these products, so we know to skip them later because they're already done
            $this->productsToSkip->push(...$products->map(fn(Product $pr) => $pr->getId()));
        }
        return $products;
    }

    /**
     * Build up a collection of SKUs that would match for other sizes of this product,
     * if the product looks like a size option. If not, the collection will be empty.
     *
     * @param  Product  $product
     * @return Collection
     */
    private function buildProductSizeSkus(Product $product): Collection
    {
        $SEPARATOR = "-";
        // get the sku of the product and see if it ends with a size
        $sku = $product->getSku();
        $sizes = collect(self::SIZE_STRINGS);
        $skuEnd = Str::afterLast($sku, $SEPARATOR);

        // sku's are inconsistently cased, so analyze the end string to determine if we should transform our options
        if (ctype_lower($skuEnd)) {
            $sizes->transform(fn($size) => Str::lower($size));
        }

        if ($sizes->doesntContain($skuEnd)) {
            return collect();
        }

        // it looks like it's probably a size, so build up the sku for the other size options
        $skuBase = Str::beforeLast($sku, $SEPARATOR);

        return $sizes
            ->filter(fn($size) => $size !== $skuEnd)
            ->transform(fn($size) => $skuBase.$SEPARATOR.$size);
    }

    /**
     * Build up the data structure to send to Shopify, depending on product type and whether it has options or not
     *
     * @param  Product  $product
     * @param  bool  $isCreating
     * @param  Collection  $options
     * @return array
     * @throws Exception
     */
    private function buildPostData(
        Product $product,
        bool $isCreating,
        Collection $options
    ): array {
        if ($product->getType() === Product::TYPE_DIGITAL_SUBSCRIPTION || $product->getType(
            ) === Product::TYPE_DIGITAL_ONE_TIME) {
            if ($isCreating) {
                return $this->createProductData($product, $this->locationId);
            }
            return $this->updateProductData($product);
        } elseif ($product->getType() === Product::TYPE_PHYSICAL_ONE_TIME) {
            if ($isCreating) {
                if ($options->isNotEmpty()) {
                    return $this->createProductDataWithOptions($options, $this->locationId);
                }
                return $this->createProductData($product, $this->locationId);
            } else {
                if ($options->isNotEmpty()) {
                    return $this->updateProductDataWithOptions($options, $this->locationId);
                }
                return $this->updateProductData($product);
            }
        } else {
            throw new Exception(
                sprintf(
                    "Unknown product type %s. Expected types are: %s",
                    $product->getType(),
                    implode(", ", [
                        Product::TYPE_DIGITAL_ONE_TIME,
                        Product::TYPE_DIGITAL_SUBSCRIPTION,
                        Product::TYPE_PHYSICAL_ONE_TIME
                    ])
                )
            );
        }
    }

    /**
     * Create the data to post to Shopify to create a simple product with no options or extra variants
     *
     * @param  Product  $product
     * @param  int  $locationId
     * @return array
     */
    private function createProductData(Product $product, int $locationId): array
    {
        $postData = $this->formatProductData($product, true);
        $postData["variants"] = [$this->createVariantData($product, $locationId, true, null)];
        return $postData;
    }

    /**
     * Build an array with the properly formatted data for a Product
     *
     * @param  Product  $product
     * @param  bool  $withImage
     * @param  Collection|null  $allOptions  - the collection of alike products that will be options for the product in Shopify
     * @return array
     */
    private function formatProductData(Product $product, bool $withImage, ?Collection $allOptions = null): array
    {
        $productData = [
            "title" => is_null($allOptions) ? $product->getName() : $this->guessProductNameForOption($allOptions),
            "body_html" => $product->getDescription(),
            "vendor" => Str::ucfirst($product->getBrand()),
            "product_type" => Str::ucfirst($product->getType())
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
     * Try to find the commonality in the name of the given products, starting at the beginning and running until they
     * no longer match across all products. Then use some logic based on our standards to remove specific pieces like
     * "size", and get back the base name shared with all the given products.
     *
     * @param  Collection<Product>  $productOptions
     * @return string
     */
    private function guessProductNameForOption(Collection $productOptions): string
    {
        $productNames = $productOptions->map(fn(Product $product) => $product->getName());

        // go through all the names, and walk through the names character by character, until the matching stops,
        // so that we can pull out the common name
        $productNames = $productNames->sort(function (string $productName1, string $productName2) {
            return strlen($productName1) > strlen($productName2);
        });

        // break each product name into an array, so we can step through them all
        $productNames->transform(fn(string $productName) => str_split($productName));

        $baseNameArray = $productNames->shift();

        $commonName = "";
        foreach ($baseNameArray as $index => $char) {
            $matchFound = true;
            $productNames->each(function (array $productName) use ($char, $index, &$matchFound) {
                $matchFound &= ($productName[$index] === $char);
            });

            if ($matchFound) {
                $commonName .= $char;
            } else {
                break;
            }
        }

        // safety check that we actually made a change
        if ($commonName === implode($baseNameArray)) {
            return $commonName;
        }

        // clean up the name, since it should have been "foo - L", "bar - Size M", etc. so remove everything before the last "-"
        return Str::beforeLast($commonName, " -");
    }

    /**
     * Create the data required to post a product to Shopify as a variant
     *
     * @param  Product  $product
     * @param  int|null  $locationId
     * @param  bool  $withMetafields
     * @param  string|null  $sizeOptionName
     * @param  bool  $includeInventory
     * @return array
     */
    private function createVariantData(
        Product $product,
        ?int $locationId,
        bool $withMetafields,
        ?string $sizeOptionName,
        bool $includeInventory = true
    ): array {
        $variantData = [
            "compare_at_price" => number_format($product->getPrice(), 2),
            "price" => number_format($product->getPrice(), 2),
            "sku" => $product->getSku(),
            "weight" => $product->getWeight(),
            "weight_unit" => "lb",
            "requires_shipping" => $product->getIsPhysical(),
        ];
        // inventory settings can't be applied when updating a variant - only when creating, so only add these conditionally
        if ($includeInventory) {
            $variantData["inventory_management"] = "shopify";
            $variantData["inventory_quantity"] = $product->getStockAvailability();
        }
        if ($locationId) {
            $variantData["location_id"] = $locationId;
        }
        if ($withMetafields) {
            // refer to https://shopify.dev/docs/apps/custom-data/metafields/types
            // we can use meta fields for stuff like our product id, etc
            $variantData["metafields"] = [
                [
                    "key" => ShopifyMetafieldKey::Id,
                    "value" => (string)$product->getId(),
                    "type" => ShopifyMetafieldTypes::integer,
                    "namespace" => ShopifyMetafieldNamespace::Model_Products
                ]
            ];
        }
        if ($sizeOptionName) {
            $variantData[$sizeOptionName] = $this->getSizeFromProductSku($product);
        }
        return $variantData;
    }

    /**
     * Get the size of the product from its sku, following our conventions
     *
     * @param  Product  $product
     * @return string|null
     */
    private function getSizeFromProductSku(Product $product): ?string
    {
        // by convention, the sku ends with the size (and an - in front of it), so just grab the end
        // of the string after the last -
        $sizeString = Str::afterLast($product->getSku(), "-");

        // make sure this is a valid option, based on our constant of sizes
        $sizes = collect(self::SIZE_STRINGS);

        // in case the size in the name is inconsistently cased, analyze the end string to determine if we should transform our options
        if (ctype_lower($sizeString)) {
            $sizes->transform(fn($size) => Str::lower($size));
        }

        if ($sizes->contains($sizeString)) {
            return $sizeString;
        }

        return null;
    }

    /**
     * Build up the payload data to update a simple product with no options or extra variants
     *
     * @param  Product  $product
     * @return array
     */
    private function updateProductData(Product $product): array
    {
        // first, we need to get the existing product from Shopify, so we know what to update
        $shopifyVariantId = $product->getShopifyId();
        $this->handleRateLimit();
        $shopifyVariant = $this->shopify->getVariant($shopifyVariantId);
        $shopifyProductId = $shopifyVariant->getAttributes()["product_id"];
        $this->handleRateLimit();
        $shopifyProduct = $this->shopify->getProduct($shopifyProductId);

        // build up the common data for updating the product
        $postData = $this->formatUpdateProductData($product, $shopifyProduct);

        // check for changes to the variant, so we know to update it or not
        $variantChanges = $this->getUpdatedVariantData($product, $shopifyVariant);
        if (count($variantChanges)) {
            $postData["variants"][] = $variantChanges;
        }

        return $postData;
    }

    /**
     * Build an array with the properly formatted data to update the given Product
     *
     * @param  Product  $product
     * @param  ProductResource  $shopifyProduct
     * @return array
     */
    private function formatUpdateProductData(Product $product, ProductResource $shopifyProduct): array
    {
        // check for any applicable changes
        $productData = collect($this->formatProductData($product, false));
        $shopifyProductAttributes = collect($shopifyProduct->getAttributes())->only($productData->keys());

        $productChanges = $productData->diff($shopifyProductAttributes);

        // make sure we include the product ID so shopify knows to update (and not replace)
        $postData = ["id" => $shopifyProduct->getAttributes()["id"]];
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
        } elseif ($product->getThumbnailUrl()) {
            $image = ["src" => $product->getThumbnailUrl()];
        } else {
            $image = null;
        }

        if ($image !== null) {
            $postData["images"] = $image;
        }

        return $postData;
    }

    /**
     * Get the variant data that needs to be updated for the given product
     *
     * @param  Product  $product
     * @param  VariantResource  $shopifyVariant
     * @return array
     */
    private function getUpdatedVariantData(Product $product, VariantResource $shopifyVariant): array
    {
        $updated = [];
        $variantData = collect($this->createVariantData($product, null, false, null, false));
        $shopifyVariantAttributes = collect($shopifyVariant->getAttributes())->only($variantData->keys());
        $variantChanges = $variantData->diff($shopifyVariantAttributes);
        if ($variantChanges->isNotEmpty()) {
            // be sure to supply the variant's ID, otherwise Shopify would end up replacing the existing one
            $updated = array_merge(["id" => $product->getShopifyId()], $variantChanges->toArray());
        }
        return $updated;
    }

    /**
     * For the given collection of Products, create the data to send to Shopify with the root product, the size options,
     * and a variant for each of our Products, corresponding to a size option.
     *
     * @param  Collection  $productOptions
     * @param  int|null  $locationId
     * @return array
     */
    private function createProductDataWithOptions(Collection $productOptions, ?int $locationId): array
    {
        // create the base of the product data, using the first (latest) entry
        $postData = $this->formatProductData($productOptions->first(), true, $productOptions);

        // sort the options by size
        $productOptions = $this->sortProductOptionsBySize($productOptions);

        // create the size option for the product
        $postData["options"] = [
            "name" => self::SIZE_OPTION_NAME,
            "values" => [
                $productOptions->map(fn(Product $product) => $this->getSizeFromProductSku($product))
            ]
        ];

        // create a variant for each option
        $variants = [];
        $productOptions->each(function (Product $product) use ($locationId, &$variants) {
            $variants[] = $this->createVariantData($product, $locationId, true, self::SIZE_OPTION_KEY);
        });
        $postData["variants"] = $variants;

        return $postData;
    }

    /**
     * Sort the given collection of products, to be in order of size from smallest to largest
     *
     * @param  Collection  $productOptions
     * @return Collection
     */
    private function sortProductOptionsBySize(Collection $productOptions): Collection
    {
        return $productOptions->sort(function (Product $product1, Product $product2) {
            $p1SizeString = $this->getSizeFromProductSku($product1);
            $p2SizeString = $this->getSizeFromProductSku($product2);

            // now find the index of each size string in our list of sizes, and sort accordingly
            $p1SizeIndex = array_search($p1SizeString, self::SIZE_STRINGS);
            $p2SizeIndex = array_search($p2SizeString, self::SIZE_STRINGS);

            return $p1SizeIndex > $p2SizeIndex;
        });
    }

    /**
     * Build up the payload data to update a Product with Options (i.e. sizes)
     *
     * @param  Collection  $productOptions
     * @param  int|null  $locationId
     * @return array
     */
    private function updateProductDataWithOptions(Collection $productOptions, ?int $locationId): array
    {
        // using the first option as the basis for the Product (because it's the latest updated)
        /** @var Product $latestProduct */
        $latestProduct = $productOptions->first();

        // then we can sort the options by size
        $productOptions = $this->sortProductOptionsBySize($productOptions);

        // first, we need to get the existing product from Shopify, so we know what to update
        // the latest updated may not be in shopify yet, so find one that has a shopify id
        $shopifyVariantId = $productOptions
            ->filter(fn(Product $productOption) => !is_null($productOption->getShopifyId()))
            ->first()
            ->getShopifyId();

        $this->handleRateLimit();
        $shopifyVariant = $this->shopify->getVariant($shopifyVariantId);
        $shopifyProductId = $shopifyVariant->getAttributes()["product_id"];
        $this->handleRateLimit();
        $shopifyProduct = $this->shopify->getProduct($shopifyProductId);
        // build up the common data for updating the product
        $postData = $this->formatUpdateProductData($latestProduct, $shopifyProduct);

        // the title most likely match because we pulled out the common name, so check for that
        if (array_key_exists("title", $postData)) {
            $checkTitle = $this->guessProductNameForOption($productOptions);
            if ($checkTitle === $shopifyProduct->getAttributes()["title"]) {
                unset($postData["title"]);
            }
        }

        // DEV NOTE: we don't need to update the product's options because shopify will generate the values on its own,
        // and we're not going to change the name

        // check all the existing variants to see if we changed anything
        $this->handleRateLimit();
        $allShopifyVariants = $this->shopify->getVariants($shopifyProductId);
        // track so we can check for any missing
        $matchedProductOptions = collect();
        $variantsData = [];
        $allShopifyVariants->each(
            function (VariantResource $shopifyVariant) use ($matchedProductOptions, $productOptions, &$variantsData) {
                // find the corresponding product from our productOptions
                $shopifyVariantId = $shopifyVariant->getAttributes()["id"];
                /** @var Product $matched */
                $matched = $productOptions->filter(fn(Product $product) => $product->getShopifyId() == $shopifyVariantId
                )->first();
                if (is_null($matched)) {
                    $this->logError(
                        sprintf(
                            "Failed to retrieve Product from Shopify metafield: %s. Cannot update variant!",
                            $shopifyVariantId
                        )
                    );
                    // continue
                    return;
                }
                $matchedProductOptions->push($matched->getId());

                $variantData = collect($this->createVariantData($matched, null, false, self::SIZE_OPTION_KEY, false));
                // be sure to include the id so that Shopify knows to update and not create
                $variantsData[] = array_merge(["id" => $matched->getShopifyId()], $variantData->toArray());
            }
        );

        // if we have any new entries in the productOptions that are not yet variants, we need to add them
        $missedProducts = $productOptions
            ->filter(fn(Product $product) => $matchedProductOptions->doesntContain($product->getId()));
        if ($missedProducts->isNotEmpty()) {
            $missedProducts->each(function (Product $missedProduct) use ($locationId, &$variantsData) {
                $variantsData[] = $this->createVariantData(
                    $missedProduct,
                    $locationId,
                    true,
                    self::SIZE_OPTION_KEY,
                    false
                );
            });
        }

        // the variants might be out of order because we might have added some that didn't exist, etc, so order them by size
        $sortedVariantsData = collect($this->sortVariantDataBySize($variantsData))->values();
        $sortedVariantsData->transform(function (array $data, int $index) {
            // Shopify starts at position 1, not 0
            $data["position"] = $index + 1;
            return $data;
        });
        $postData["variants"] = $sortedVariantsData;

        return $postData;
    }

    /**
     * Sort the given array of variant data, to be in order of size from smallest to largest
     *
     * @param  array  $variantData
     * @return array
     */
    private function sortVariantDataBySize(array $variantData): array
    {
        return collect($variantData)->sort(function (array $data1, array $data2) {
            $data1SizeString = $data1[self::SIZE_OPTION_KEY];
            $data2SizeString = $data2[self::SIZE_OPTION_KEY];

            // now find the index of each size string in our list of sizes, and sort accordingly
            $data1SizeIndex = array_search($data1SizeString, self::SIZE_STRINGS);
            $data2SizeIndex = array_search($data2SizeString, self::SIZE_STRINGS);

            return $data1SizeIndex > $data2SizeIndex;
        })->toArray();
    }

    /**
     * Simulate sending the post data for the product to Shopify, and record the results in the table rows
     *
     * @param  Product  $product
     * @param  array  $postData
     * @param $simulatedShopifyId
     * @return void
     */
    private function simulateSendToShopify(Product $product, array $postData, &$simulatedShopifyId): void
    {
        if (array_key_exists("variants", $postData)) {
            // this is sending options (has variants data)
            foreach ($postData["variants"] as $variantData) {
                // make a new entry for each variant
                if (array_key_exists("metafields", $variantData)) {
                    // try to get our internal Product ID from the metafields
                    $metafields = collect($variantData["metafields"]);
                    $productIdMetafield = $metafields->filter(
                        fn(array $fields) => array_key_exists("namespace", $fields)
                            && $fields["namespace"] === ShopifyMetafieldNamespace::Model_Products
                            && array_key_exists("key", $fields)
                            && $fields["key"] === ShopifyMetafieldKey::Id
                    );
                    // we were able to find one, so that means this is a variant for an existing product in Shopify
                    $productId = $productIdMetafield->first()["value"];
                } else {
                    // we didn't have metafields, so this would be a new product in Shopify
                    $productId = $postData["id"];
                }
                $this->results[] = [$productId, $variantData["sku"] ?? "n/a", ++$simulatedShopifyId];
            }
        } else {
            // this is a simple product with no options or additional variants
            $this->results[] = [$postData["id"], $postData["sku"] ?? $product->getSku(), ++$simulatedShopifyId];
        }
    }

    /**
     * Record the shopify ID of the variant on our Product entry,
     * and return the formatted array to print out in our log
     *
     * @param  VariantResource  $variantData
     * @param  Product|null  $product
     * @return array
     * @throws OptimisticLockException
     * @throws \Doctrine\ORM\Exception\ORMException
     */
    private function recordShopifyId(VariantResource $variantData, ?Product $product): array
    {
        $shopifyId = $variantData->id;
        $this->shopifyIds->push($shopifyId);

        // no product is given if this variant data is one of many variants for a product
        if (is_null($product)) {
            // get the metafield with our ID record
            $this->handleRateLimit();
            $variantMetaFields = $this->shopify->getVariantMetafields(
                $shopifyId,
                ["namespace" => ShopifyMetafieldNamespace::Model_Products, "key" => ShopifyMetafieldKey::Id]
            );
            $productId = $variantMetaFields->first()?->getAttributes()["value"] ?? null;
            try {
                $product = $this->productRepository->findProduct($productId, [0, 1]);
            } catch (NonUniqueResultException $e) {
                $this->logError(
                    sprintf(
                        "Failed to retrieve Product for ID %s, from Shopify metafield: %s",
                        $shopifyId,
                        $e->getMessage()
                    )
                );
                return ["ERROR", $variantData->sku, $shopifyId];
            }
        }

        if (is_null($product)) {
            $this->logError(sprintf("Product could not be found for ID %s, from Shopify metafield", $shopifyId));
            return ["ERROR", $variantData->sku, $shopifyId];
        }

        if ($this->getIsFresh() || $product->getShopifyId() !== $shopifyId) {
            // grab the eloquent model, so we can update it
            $productModel = \App\Modules\Ecommerce\Models\Product::find($product->getId());
            $productModel->shopify_id = $shopifyId;
            $productModel->saveWithoutUpdatedAt();
            // refresh the doctrine model to get the change
            $this->entityManager->refresh($product);
        }

        return [$product->getId(), $variantData->sku, $shopifyId];
    }

    /**
     * @inheritDoc
     */
    protected function getClassName(): string
    {
        return "SyncProductsToShopify";
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
    protected function getIsFresh(): bool
    {
        return $this->fresh;
    }

    /**
     * @inheritDoc
     */
    protected function getLimit(): ?int
    {
        return null;
    }

    /**
     * @inheritDoc
     */
    protected function getSyncResource(): string
    {
        return ShopifySync::RESOURCE_PRODUCT;
    }

    /**
     * @inheritDoc
     * @throws Exception
     */
    protected function syncResource(bool $simulate, bool $fresh): Collection
    {
        // STEP 1: get all the products that need to be synced
        $products = $this->getEcommerceEntities($fresh, $this->startAtId, $this->endAtId);

        $simulatedShopifyId = 0;
        $products->each(function (Product $product) use ($fresh, $simulate, &$simulatedShopifyId) {
            // STEP 2: check if this product was already completed as part of a group
            if ($this->productsToSkip->contains($product->getId())) {
                return;
            }

            // STEP 3: determine if updating or creating
            // this product could be part of a group, so first check if it should be one of many options
            $options = $this->getProductOptions($product);
            if ($options->isEmpty()) {
                $isCreating = $fresh || is_null($product->getShopifyId());
            } else {
                $isAllNew = $options
                    ->filter(fn(Product $productOption) => !is_null($productOption->getShopifyId()))
                    ->isEmpty();
                $isCreating = $fresh || $isAllNew;
            }

            // STEP 4: build up the data structure depending on product type
            $postData = $this->buildPostData($product, $isCreating, $options);

            // STEP 5: send the data to Shopify
            if ($simulate) {
                $this->simulateSendToShopify($product, $postData, $simulatedShopifyId);
            } else {
                if ($isCreating) {
                    $productResource = $this->shopify->createProduct($postData);
                } else {
                    if ($options->isEmpty()) {
                        // this is just a simple product with no options, so it exists in shopify as the only variant
                        $variant = $this->shopify->getVariant($product->getShopifyId());
                    } else {
                        // this product of ours may not yet be in shopify, so get the first in the group that has a shopify id
                        $existingVariant = $options
                            ->filter(fn(Product $productOption) => !is_null($productOption->getShopifyId()))
                            ->first();
                        $variant = $this->shopify->getVariant($existingVariant->getShopifyId());
                    }
                    $productID = $variant->getAttributes()["product_id"];

                    // remove the variants data so that we can set it separately afterwards
                    if (array_key_exists("variants", $postData)) {
                        $variantData = $postData["variants"];
                        unset($postData["variants"]);
                    } else {
                        $variantData = null;
                    }

                    $this->handleRateLimit();
                    $productResource = $this->shopify->updateProduct($productID, $postData);

                    // we have to send all variants, so call Shopify to update each one
                    if (!is_null($variantData)) {
                        if ($options->isEmpty()) {
                            // just the one product and variant, so grab the first
                            $this->handleRateLimit();
                            $this->shopify->updateVariant($product->getShopifyId(), $variantData[0]);
                        } else {
                            // we have multiple, so update or create each one
                            foreach ($variantData as $variantDatum) {
                                $this->handleRateLimit();
                                if (array_key_exists("id", $variantDatum)) {
                                    $this->shopify->updateVariant($variantDatum["id"], $variantDatum);
                                } else {
                                    $variantResource = $this->shopify->createVariant(
                                        $productResource->getAttributes()["id"],
                                        $variantDatum
                                    );
                                    $inventoryItemId = $variantResource->getAttributes()["inventory_item_id"];
                                    // we can now set the variant's inventory
                                    $this->handleRateLimit();
                                    $this->shopify->adjustInventoryLevel(
                                        $inventoryItemId,
                                        $this->locationId,
                                        $product->getStockAvailability()
                                    );
                                }
                            }
                        }
                    }
                }

                // STEP 6: record each variant back into our system and log
                $variants = $productResource->getVariants();
                if ($variants->count() === 1) {
                    // this is the only variant, so just record this variant as the product
                    $variantData = $variants->first();
                    $this->results[] = $this->recordShopifyId($variantData, $product);
                } else {
                    $variants->each(function (VariantResource $variantData) {
                        $this->results[] = $this->recordShopifyId($variantData, null);
                    });
                }
            }

            $this->handleRateLimit();
        });

        $this->logInfo(sprintf("%s: results for syncing products to Shopify job %s of %s:",
            $this->getClassName(), $this->batch()->processedJobs()+1, $this->batch()->totalJobs));

        foreach($this->results as $result) {
            $this->logInfo(sprintf("Product ID %s (sku %s): Shopify Variant ID %s",
                $result[0], $result[1], $result[2]));
        }

        return $this->shopifyIds;
    }

    /**
     * @inheritDoc
     */
    protected function getEcommerceEntityRepository(): RepositoryBase|EntityRepository
    {
        return $this->productRepository;
    }

    /**
     * @inheritDoc
     */
    protected function getLastSyncAtOverride(): null|Carbon
    {
        return $this->lastSyncAt;
    }
}
