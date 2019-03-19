<?php

namespace Railroad\Railcontent\Middleware;

use Closure;
use Illuminate\Http\Request;

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
        if ($request->has('brand') && config('railcontent.data_mode') == 'host') {
            config(
                [
                    'railcontent.brand' => $request->get('brand'),
                    'railcontent.available_brands' => array_wrap($request->get('brand')),
                ]
            );
        }

        return $next($request);
    }
}