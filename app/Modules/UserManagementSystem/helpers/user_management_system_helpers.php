<?php

use App\Modules\Brand\Services\BrandService;
use App\Modules\UserManagementSystem\Services\UserAccessService;
use Carbon\Carbon;

if (!function_exists('user')) {
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

if (!function_exists('brand')) {
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

if (!function_exists('is_current_user_an_annual_or_lifetime_member')) {
    function is_current_user_an_annual_or_lifetime_member()
    {
        return UserAccessService::isAnnualOrLifetimeMember();
    }
}

if (!function_exists('is_current_user_a_member')) {
    function is_current_user_a_member()
    {
        return user()?->isAMember() ?? false;
    }
}
