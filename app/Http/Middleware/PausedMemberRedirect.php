<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class PausedMemberRedirect
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if (!empty(user()) && !user()->isAdmin()) {
            $user = user();

            if (($user->isAPausedMember() && !$user->isPackOwner())) {
                return redirect()->route('platform.membership-paused');
            }
        }

        return $next($request);
    }
}
