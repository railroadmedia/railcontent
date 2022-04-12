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
        if (!Auth::guard('sanctum')->check() && !Auth::guard('user-management-system')->check()) {
            if ($request->wantsJson()) {
                throw new AuthenticationException();
            }

            return redirect(config('user_management_system.login_page_path'));
        }

        return $next($request);
    }
}
