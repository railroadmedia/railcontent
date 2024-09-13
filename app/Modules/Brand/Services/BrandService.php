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

    /**
     * @param User|null $user
     * @return string
     */
    public static function getLastUsedBrand(User $user = null)
    {
        if (!empty(self::$currentBrand)) {
            return self::$currentBrand;
        }

        if (empty($user)) {
            return null;
        }

        $cacheKey = 'user_' . $user->id . '_last_used_brand';
        $cookieValue = request()->cookie($cacheKey);
        $cacheValue = Cache::get($cacheKey);
        $databaseValue = $user->last_used_brand;
        /**
         * NOTE: set primary_brand unless it doesn´t exist. This will make sure pack-only users will
         * be redirected to the correct brand.
         */
        $default = $user->primary_brand ?? 'drumeo';

        // check in cookie first
        if (!empty($cookieValue) && in_array($cookieValue, config('brands'))) {
            return $cookieValue;
        }

        // then check cache
        if (!empty($cacheValue) && in_array($cacheValue, config('brands'))) {
            return $cacheValue;
        }

        // then check database
        if (!empty($databaseValue) && in_array($databaseValue, config('brands'))) {
            return $databaseValue;
        }

        return $default;
    }

    /**
     * @return string|void
     */
    public static function getForumsUrl()
    {
        switch (self::getLastUsedBrand()) {
            case 'drumeo':
                return url()->route('forums.jump-to-post', [config('railforums.forum_rules_post_id.drumeo')]);
            case 'pianote':
                return url()->route('forums.jump-to-post', [config('railforums.forum_rules_post_id.pianote')]);
            case 'guitareo':
                return url()->route('forums.jump-to-post', [config('railforums.forum_rules_post_id.guitareo')]);
            case 'singeo':
                return url()->route('forums.jump-to-post', [config('railforums.forum_rules_post_id.singeo')]);
            default:
                return '';
        }
    }
}
