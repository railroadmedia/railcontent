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

if (! function_exists('all_brands_and_musora')) {
    function all_brands_and_musora()
    {
        $brands = array_column(Brand::cases(), 'value');
        $brands[] = 'musora';
        return $brands;
    }
}

if (! function_exists('drumeo_cdn')) {
    function drumeo_cdn($file)
    {
        return 'https://dpwjbsxqtam5n.cloudfront.net/' . $file;
    }
}

if (! function_exists('pianote_cdn')) {
    function pianote_cdn($file)
    {
        return 'https://d2vyvo0tyx8ig5.cloudfront.net/' . $file;
    }
}

if (! function_exists('guitareo_cdn')) {
    function guitareo_cdn($file)
    {
        return 'https://d122ay5chh2hr5.cloudfront.net/' . $file;
    }
}

if (! function_exists('singeo_cdn')) {
    function singeo_cdn($file)
    {
        return 'https://d21xeg6s76swyd.cloudfront.net/' . $file;
    }
}

if (! function_exists('musora_cdn')) {
    function musora_cdn($file)
    {
        return 'https://dmmior4id2ysr.cloudfront.net/' . $file;
    }
}
