<?php

namespace Modules\UserManagementSystem\Middleware;

use Closure;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Modules\UserManagementSystem\Models\User;

class LogOutWhenNeeded
{
    /**
     * @throws AuthenticationException
     */
    public function handle($request, Closure $next)
    {
        // try token auth first
        if (!empty($request->bearerToken())) {
            if (Auth::guard('sanctum')->check()) {
                $this->checkUser(Auth::guard('sanctum')->user());
            }
        } else {
            // otherwise, just use the normal Auth
            $this->checkUser(Auth::user());
        }
        return $next($request);
    }

    /**
     * Check if the user needs to be logged out. If so, create a log entry for it, log them out,
     * and throw an AuthenticationException.
     *
     * @param  User|null  $user
     * @return void
     * @throws AuthenticationException
     */
    private function checkUser(?User $user): void
    {
        if ($user && $user->needs_logout) {
            Log::info("Logging out user $user->id");
            $user->needs_logout = false;
            $user->save();
            Auth::logout();
            throw new AuthenticationException();
        }
    }
}
