<?php

namespace App\Modules\Ecommerce\Services;

use App\Modules\Ecommerce\Models\AccessCode;
use App\Modules\Ecommerce\Models\Product;
use Illuminate\Support\Collection;

class ProductService
{

    public function getProductsByShopifyIds(array $shopifyProductIds): Collection
    {
        return Product::query()
            ->whereIn('shopify_id', $shopifyProductIds)
            ->get();
    }

    public function getProductsBySkus(array $skus): Collection
    {
        return Product::query()
            ->whereIn('sku', $skus)
            ->get();
    }

    public function getAllPacks(): Collection
    {
        return Product::query()
            ->where('digital_access_type', Product::DIGITAL_ACCESS_TYPE_SPECIFIC_CONTENT_ACCESS)
            ->get();
    }

    public function getById(int $productId): ?Product
    {
        return Product::query()->find($productId);
    }

    public function getBySku(string $sku): ?Product
    {
        return Product::query()->where('sku', '=', $sku)->first();
    }

    public function getByAccessCode(AccessCode $accessCode): Collection
    {
        $productIds = unserialize($accessCode->product_ids);
        return Product::query()
            ->whereIn('id', $productIds)
            ->get();
    }

    public function getAll(): Collection
    {
        return Product::all();
    }

    public function getByBrand(string $brand): Collection
    {
        return Product::query()
            ->where('brand', '=', $brand)
            ->get();
    }
}
