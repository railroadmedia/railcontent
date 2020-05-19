<?php

namespace Railroad\Railcontent\Middleware;

use Closure;
use Illuminate\Http\Request;
use Railroad\Railcontent\Services\ResponseService;

class VersionMiddleware
{
    /**
     * @param Request $request
     * @param Closure $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if ($request->has('version') && $request->get('version') == 'old') {
            ResponseService::$oldResponseStructure = false;
        } else {
            ResponseService::$oldResponseStructure = true;
        }

        return $next($request);
    }
}