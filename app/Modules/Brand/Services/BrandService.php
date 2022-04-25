<?php

namespace App\Modules\Brand\Services;

use App\Modules\Brand\Enums\Brand;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\URL;
use Modules\UserManagementSystem\Models\User;

class BrandService
{
    public static $currentBrand = null;

    /**
     * @param User $user
     * @param $brand
     * @return void
     */
    public function setLastUsedBrand(User $user, Brand $brand)
    {
        $brandString = $brand->value;

        if (in_array($brandString, config('brands'))) {
            self::$currentBrand = $brandString;
            URL::defaults(['brand' => self::$currentBrand]);

            $cacheKey = 'user_' . $user->id . '_last_used_brand';
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
            cookie()->queue($cacheKey, $brandString);
        }
    }
}
