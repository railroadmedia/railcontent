<?php

namespace App\Modules\Ecommerce\Services;

use App\Modules\Ecommerce\ApiGateways\ShopifyGateway;
use App\Modules\Ecommerce\Enums\ShopifyMetafieldKey;
use App\Modules\Ecommerce\Jobs\Shopify\Traits\HandlesMaskedEmailAddress;
use App\Modules\Ecommerce\Models\Product;
use Carbon\Carbon;
use Exception;
use Illuminate\Support\Facades\Log;

class ShopifySyncProductService
{
    use HandlesMaskedEmailAddress;

    private ProductService $productService;
    private ShopifyGateway $shopifyGateway;

    public function __construct(
        ShopifyGateway $shopifyGateway,
        ProductService $productService,
    )
    {
        $this->productService = $productService;
        $this->shopifyGateway = $shopifyGateway;
    }

    public function sync(array $productShopify): void
    {
        $skus = \Arr::pluck($productShopify['variants'], 'sku');
        $products = $this->productService->getProductsBySkus($skus)->keyBy('sku');

        foreach ($productShopify["variants"] as $variant) {
            try {
                $product = $products[$variant["sku"]] ?? new Product();
                if (!$variant['sku']) continue;
                $product->sku = $variant['sku'];
                $product->description = $productShopify['body_html'];
                $product->active = $productShopify['status'] == 'active' ? 1 : 0;
                $product->deleted_at = $productShopify['status'] == 'archived' ? Carbon::now()->toDateTimeString() : null;
                $product->brand = lcfirst($productShopify['vendor']);
                $product->type = lcfirst($productShopify['product_type']);
                $product->is_physical = $variant['requires_shipping'] ? 1 : 0;
                $product->price = floatval($variant['price']);
                //Shopify variants are stored as multiple products in MWP so we need to create a unique name here
                $variantName = ($variant['requires_shipping'] && $variant['option1'] != "Default Title") ? $variant['option1'] : '';
                $product->name = $variantName ? ($productShopify['title'] . ' - ' . $variantName) : $productShopify['title'];
                $product->thumbnail_url = !(empty(\Arr::last($productShopify['images']))) ? \Arr::last($productShopify['images'])['src'] : '';
                $product->shopify_id = $variant['id'];
                $product->stock = $variant['inventory_quantity'];

                $metaFields = $this->shopifyGateway->getVariantMetaFields($variant['admin_graphql_api_id']);
                if ($metaFields->isNotEmpty()) {
                    foreach ($metaFields as $metaField) {
                        switch ($metaField->key) {
                            case ShopifyMetafieldKey::InventoryControlSKU->value:
                                $product->inventory_control_sku = $metaField->value;
                                break;
                            case ShopifyMetafieldKey::DigitalAccessType->value:
                                $product->digital_access_type = $metaField->value;
                                break;
                            case ShopifyMetafieldKey::DigitalAccessTimeType->value:
                                $product->digital_access_time_type = $metaField->value;
                                break;
                            case ShopifyMetafieldKey::DigitalAccessTimeIntervalType->value:
                                $product->digital_access_time_interval_type = $metaField->value;
                                break;
                            case ShopifyMetafieldKey::DigitalAccessTimeIntervalLength->value:
                                $product->digital_access_time_interval_length = $metaField->value;
                                break;
                            case ShopifyMetafieldKey::FulfillmentSKU->value:
                                $product->fulfillment_sku = $metaField->value;
                                break;
                        }
                    }
                }
                $product->save();
            } catch (Exception $e) {
                Log::error("Error syncing product $product->id from Shopify: " . $productShopify['id']);
                Log::error($e->getMessage());
            }
        }
    }
}
