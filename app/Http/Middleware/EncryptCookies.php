<?php

namespace App\Http\Middleware;

use Illuminate\Cookie\Middleware\EncryptCookies as Middleware;
use Illuminate\Support\Str;

class EncryptCookies extends Middleware
{
    /**
     * The names of the cookies that should not be encrypted.
     *
     * @var array
     */
    protected $except = [
    ];

    /**
     * We need custom functionality to include any cookie that looks like user_X_last_used_brand
     *
     * @param  string  $name
     * @return bool
     */
    public function isDisabled(string $name): bool
    {
        if (Str::contains($name, '_last_used_brand')) {
            return true;
        }

        return in_array($name, $this->except);
    }
}
