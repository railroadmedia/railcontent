<?php

namespace App\Modules\Api\Middleware;

use Closure;
use Illuminate\Http\Request;

class ApiVersionMiddleware
{
    /**
     *
     * @param Request $request
     * @param Closure $next
     * @param $guard
     * @return mixed
     */
    public function handle(Request $request, Closure $next, $guard)
    : mixed {
        config(['musora-api.api.version' => $guard]);
        return $next($request);
    }
}
