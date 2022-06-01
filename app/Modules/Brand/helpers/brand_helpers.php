<?php

use App\Modules\Brand\Enums\Brand;
use App\Modules\Brand\Services\BrandService;

if (! function_exists('brand')) {
    /**
     * Get the relevant brand for the current request.
     *
     * @return string
     */
    function brand()
    {
        if (!empty(user())) {
            return BrandService::getLastUsedBrand(user());
        }

        return 'musora';
    }
}

if (! function_exists('all_brands')) {
    /**
     * Get the relevant brand for the current request.
     *
     * @return array
     */
    function all_brands()
    {
        return array_column(Brand::cases(), 'value');
    }
}
