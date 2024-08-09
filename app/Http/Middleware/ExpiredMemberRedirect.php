<?php

namespace App\Http\Middleware;

use Symfony\Component\HttpFoundation\Response;
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
    public function handle(Request $request, Closure $next): Response
    {
        if (!empty(user()) && !empty(brand()) && !user()->isAdmin()) {
            $user = user();

            if ((!$user->isAMember() && $user->isAnExpiredMember() && !$user->isPackOwner()) ||
                (empty($this->membership_expiration_date) && !$user->isPackOwner() && !$user->isAMember())) {
                return redirect()->route('platform.membership-expired');
            }

            // allow singeo courses through since singeo uses courses instead of packs
            if ($user->isPackOwner() && !$user->isAMember() &&
                (strpos($request->path(), 'singeo/courses') === false)
                && (strpos($request->path(), 'members') === false)
                && (!$request->routeIs('platform.home'))) {
                return redirect()->route('platform.home-redirect');
            }
        }

        return $next($request);
    }
}
