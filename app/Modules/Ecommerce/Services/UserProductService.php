<?php

namespace Modules\Ecommerce\Services;

use App\Modules\Ecommerce\Models\UserProduct;
use Carbon\Carbon;

class UserProductService
{

    public function getLatestExpirationTime(int $userId): ?Carbon
    {
        $max = UserProduct::query()->fromUser($userId)->max('expiration_date');
        return $max != null ? Carbon::parse($max) : null;
    }


}
