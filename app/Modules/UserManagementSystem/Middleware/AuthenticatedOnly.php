<?php

namespace Modules\UserManagementSystem\Middleware;

use Closure;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\URL;

class AuthenticatedOnly
{
    /**
     * Handle an incoming request.
     *
     * @param Request $request
     * @param Closure $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        // try token auth first
        if (!empty($request->bearerToken())) {
            if (Auth::guard('sanctum')->check()) {
                auth()->setUser(Auth::guard('sanctum')->user());

                return $next($request);
            } else {
                throw new AuthenticationException();
            }
        }

        // other wise try cookie auth
        if (Auth::guard('user-management-system')->check()) {
            return $next($request);
        } else {
            $loginURL = url(config('user_management_system.login_page_path') . '?redirect_to=' . $request->getRequestUri());
            throw new AuthenticationException(
                $message = 'Unauthenticated.',
                [],
                $redirectTo = $loginURL
            );
        }
    }
}
