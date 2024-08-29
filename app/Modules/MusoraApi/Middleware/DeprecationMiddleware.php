<?php

namespace App\Modules\MusoraApi\Middleware;

use Carbon\Carbon;
use Closure;
use Illuminate\Http\Response;

class DeprecationMiddleware
{
    public function handle($request, Closure $next, $deprecatedAt)
    {
        /** @var Response $response */
        $response = $next($request);

        $response->headers->set('X-Deprecated-At', Carbon::createFromFormat('Y-m-d', $deprecatedAt));

        return $response;
    }
}
