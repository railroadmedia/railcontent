<?php

namespace App\Modules\Ecommerce\Services;

use App\Modules\Ecommerce\Models\Product;

class ProductService
{

    public function getProductsByShopifyIdsQuery(array $shopifyProductIds)
    {
        return Product::query()
            ->whereIn('shopify_id', $shopifyProductIds)
            ->get();
    }
}
