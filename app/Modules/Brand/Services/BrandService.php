<?php

namespace App\Modules\Brand\Services;

use App\Modules\Brand\Enums\Brand;
use Illuminate\Support\Facades\Cache;
use Modules\UserManagementSystem\Models\User;

class BrandService
{
    /**
     * @param User $user
     * @param $brand
     * @return void
     */
    public function setLastUsedBrand(User $user, Brand $brand)
    {
        $brandString = $brand->value;

        if (in_array($brandString, config('brands'))) {
            $cacheKey = 'musora_last_used_brand';
            $cacheValue = Cache::get($cacheKey);

            // set in cache
            if ($cacheValue !== $brandString) {
                Cache::add($cacheKey, $brandString);
            }

            // set in database
            if ($user->last_used_brand !== $brandString) {
                $user->last_used_brand = $brandString;

                app()->terminating(function () use ($user) {
                    $user->save();
                });
            }

            // set in cookie
            // NOTE: it's best to make this cookie unencrypted inside the EncryptCookies middleware
            cookie()->queue($cacheKey, $brandString);
        }
    }
}
