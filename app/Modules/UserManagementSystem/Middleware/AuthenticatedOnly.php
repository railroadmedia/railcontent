<?php

namespace Modules\UserManagementSystem\Middleware;

use Closure;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Support\Facades\Auth;
use Laravel\Sanctum\Http\Middleware\EnsureFrontendRequestsAreStateful;

class AuthenticatedOnly
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure $next
     * @param string|null $guard
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {
        // try cookie based web auth first
        if (!$request->wantsJson() && !Auth::guard($guard)->check()) {
            return redirect(config('user_management_system.login_page_path'));
        }

        // if its a json request, use token auth if client is using json api
        if ($request->wantsJson() && !Auth::guard('sanctum')->check()) {
            throw new AuthenticationException();
        }

        return $next($request);
    }
}
