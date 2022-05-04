<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Railroad\Railcontent\Services\ConfigService;

class SetContentPermissions
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if (!empty(user()) && !empty(brand())) {
            ConfigService::$brand = brand();
            ConfigService::$availableBrands = Arr::wrap(brand());
        }

        return $next($request);
    }
}
