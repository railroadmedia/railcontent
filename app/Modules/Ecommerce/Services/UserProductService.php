<?php

namespace App\Modules\Ecommerce\Services;

use App\Modules\Ecommerce\Models\UserProduct;
use Illuminate\Database\Eloquent\Builder;

class UserProductService
{
    public function getUserProductsQuery($userId): Builder
    {
        return UserProduct::query()
            ->where('user_id', '=', $userId);
    }
}
