<?php

namespace App\Modules\UserManagementSystem\Middleware;

use Closure;
use Illuminate\Auth\AuthenticationException;

class AuthenticatedAdmin
{
    public function handle($request, Closure $next)
    {
        // try token auth first
        if (user()->isAdmin()) {
            return $next($request);
        } else {
            throw new AuthenticationException("Admin access required.");
        }
    }
}
