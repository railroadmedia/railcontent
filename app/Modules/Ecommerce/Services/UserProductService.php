<?php

namespace App\Modules\Ecommerce\Services;

use App\Modules\Ecommerce\Models\UserProduct;
use Carbon\Carbon;

class UserProductService
{
    public function getFirstUserProductBrand(int $userId, array $brands): string
    {
        $result = UserProduct::query()
            ->join('ecommerce_products', 'ecommerce_user_products.product_id', '=', 'ecommerce_products.id')
            ->fromUser($userId)
            ->whereIn('ecommerce_products.brand', $brands)
            ->orderBy('ecommerce_user_products.created_at')
            ->first('ecommerce_products.brand');
        return $result['brand'] ?? '';
    }

    public function hasProductNotCached(int $userId, int $productId): bool
    {
        $product = UserProduct::query()->where('user_id', '=', $userId)
            ->where('product_id', '=', $productId)
            ->first();
        return $product && $product->isValid();
    }


}
