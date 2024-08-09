<?php

namespace Modules\UserManagementSystem\Middleware;

use Closure;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthenticateIfAvailable
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
        $passed = Auth::guard('sanctum')->check();

        if ($passed) {
            auth()->setUser(Auth::guard('sanctum')->user());
        }

        if (!$passed) {
            Auth::guard('user-management-system')->check();
        }

        return $next($request);
    }
}
