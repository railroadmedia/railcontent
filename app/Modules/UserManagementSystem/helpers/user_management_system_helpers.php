<?php

use App\Modules\Brand\Services\BrandService;

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
     * @return \Modules\UserManagementSystem\Models\User|null
     */
    function brand()
    {
        return BrandService::$currentBrand;
    }
}
