<?php

use App\Modules\Brand\Services\BrandService;
use Carbon\Carbon;

if (! function_exists('user')) {
    /**
     * Get the currently logged-in user.
     *
     * @return \Modules\UserManagementSystem\Models\User|null
     */
    function user()
    {
        return auth()->user();
    }
}

if (! function_exists('brand')) {
    /**
     * Get the currently logged-in user.
     *
     * @return string
     */
    function brand()
    {
        return BrandService::getLastUsedBrand(user());
    }
}

if (!function_exists('generate_musora_cross_platform_login_key')) {
    function generate_musora_cross_platform_login_key($userId, $userPasswordHash)
    {
        return md5($userId . $userPasswordHash . Carbon::now()->startOfMinute()->toDateTimeString());
    }
}