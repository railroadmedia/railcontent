<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class ExpiredMemberRedirect
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
        if (!empty(user()) && !empty(brand()) && !user()->isAdmin()) {
            $user = user();

            if ((!$user->isAMember() && $user->isAnExpiredMember() && !$user->isPackOwner()) ||
                (empty($this->membership_expiration_date) && !$user->isPackOwner() && !$user->isAMember())) {
                return redirect()->route('platform.membership-expired');
            }
        }

        return $next($request);
    }
}
