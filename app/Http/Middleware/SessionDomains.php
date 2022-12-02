<?php

namespace App\Http\Middleware;

use App\Modules\Brand\Enums\Brand;
use Closure;
use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Http\Request;

class SessionDomains
{
    /**
     * Handle an incoming request.
     *
     * @param Request $request
     * @param Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
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
