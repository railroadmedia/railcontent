<?php

namespace App\Modules\MusoraApi\Middleware;

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
    public function handle(Request $request, Closure $next, $guard): mixed
    {
        //set filter version
        if($request->has('count_filter_items')) {
            config(['railcontent.filter_version' => 'V2']);
        }

        //set endpoints version
        config(['musora-api.api.version' => $guard]);
        return $next($request);
    }
}
