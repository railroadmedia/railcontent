<?php

namespace App\Modules\Ecommerce\Services;

use App\Modules\Ecommerce\Models\UserProduct;
use Illuminate\Database\Eloquent\Builder;

class UserProductService
{

    public function hasProductNotCached(int $userId, int $productId)
    : bool {
        $product =
            UserProduct::query()
                ->where('user_id', '=', $userId)
                ->where('product_id', '=', $productId)
                ->first();

        return $product && $product->isValid();
    }

    public function getNumberProductOwners(int $productId)
    : int {
        $count =
            UserProduct::query()
                ->where('product_id', '=', $productId)
                ->count();

        return $count;
    }

    public function getUserProductsQuery($userId)
    : Builder {
        return UserProduct::query()
            ->where('user_id', '=', $userId);
    }
}
