<?php

namespace App\Modules\MusoraApi\Middleware;

use Carbon\Carbon;
use Closure;
use Illuminate\Http\Response;

class DeprecationMiddleware
{
    /**
     * @param $request
     * @param Closure $next
     * @param $deprecatedAt
     * @return Response
     */
    public function handle($request, Closure $next, $deprecatedAt): Response
    {
        /** @var Response $response */
        $response = $next($request);

        $response->headers->set('X-Deprecated-At', Carbon::createFromFormat('Y-m-d', $deprecatedAt));

        return $response;
    }
}
