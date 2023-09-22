<?php

namespace App\Modules\Ecommerce\Services;

use App\Modules\Ecommerce\Models\Product;
use Illuminate\Support\Collection;

class ProductService
{

    public function getProductsByShopifyIds(array $shopifyProductIds)
    {
        return Product::query()
            ->whereIn('shopify_id', $shopifyProductIds)
            ->get();
    }

    public function getAllPacks(): Collection
    {
        return Product::query()
            ->where('digital_access_type', Product::DIGITAL_ACCESS_TYPE_SPECIFIC_CONTENT_ACCESS)
            ->get();
    }
}
