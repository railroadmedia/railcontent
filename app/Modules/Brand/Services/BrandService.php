<?php

namespace App\Modules\Brand\Services;

use Illuminate\Support\Facades\Cache;
use Modules\UserManagementSystem\Models\User;

class BrandService
{
    /**
     * @param User $user
     * @param $brand
     * @return void
     */
    public function setLastUsedBrand(User $user, $brand)
    {
        if (in_array($brand, config('brands'))) {
            $cacheValue = Cache::get('user_' . $user->id . '_last_used_brand');

            if ($cacheValue !== $brand) {
                // set in cache
                Cache::add('user_' . $user->id . '_last_used_brand', $brand);
            }

            if ($user->last_used_brand !== $brand) {
                // set in database
                $user->last_used_brand = $brand;

                app()->terminating(function () use ($user) {
                    $user->save();
                });
            }
        }
    }
}
