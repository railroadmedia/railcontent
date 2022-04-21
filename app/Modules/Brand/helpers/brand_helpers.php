<?php

if (! function_exists('brand')) {
    /**
     * Get the relevant brand for the current request.
     *
     * @return string
     */
    function brand()
    {
        if (in_array(request()->segment(1), config('brands'))) {
            return request()->segment(1);
        }

        if (!empty(user())) {
            return user()->last_used_brand;
        }

        return 'drumeo';
    }
}
