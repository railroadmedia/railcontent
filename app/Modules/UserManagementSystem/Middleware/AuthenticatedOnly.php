<?php

namespace Modules\UserManagementSystem\Middleware;

use Closure;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthenticatedOnly
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
        // try token auth first
        if (!empty($request->bearerToken())) {
            if (Auth::guard('sanctum')->check()) {
                return $next($request);
            } else {
                throw new AuthenticationException();
            }
        }

        // other wise try cookie auth
        if (Auth::guard('user-management-system')->check()) {
            return $next($request);
        } else {
            throw new AuthenticationException();
        }
    }
}
