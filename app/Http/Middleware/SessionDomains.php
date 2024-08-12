<?php

namespace App\Http\Middleware;

use Symfony\Component\HttpFoundation\Response;
use App\Modules\Brand\Enums\Brand;
use Closure;
use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Http\Request;

class SessionDomains
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next): Response
    {
        $domainRootName = explode('.', $request->getHost())[1] ?? null;

        if (in_array($domainRootName, config('brands'))) {
            config([
                'session.domain' => $request->getHost()
            ]);
        }

        return $next($request);
    }
}
