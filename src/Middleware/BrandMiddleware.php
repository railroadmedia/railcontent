<?php

namespace Railroad\Railcontent\Middleware;

use Closure;
use Illuminate\Http\Request;
use Railroad\Railcontent\Services\ConfigService;

class BrandMiddleware
{
    /**
     * Allows brand to be set on any request for the host installationg.
     *
     * @param Request $request
     * @param Closure $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if ($request->has('brand') && ConfigService::$dataMode == 'host') {
            config(
                [
                    'railcontent.brand' => $request->get('brand'),
                    'railcontent.available_brands' => array_wrap($request->get('brand')),
                ]
            );
//            ConfigService::$brand = $request->get('brand');
//            ConfigService::$availableBrands = array_wrap($request->get('brand'));
        }

        return $next($request);
    }
}