<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Railroad\Railcontent\Services\UserPermissionsService;


class PausedMemberRedirect
{
    private UserPermissionsService $userPermissionsService;

    /**
     * @param UserPermissionsService $userPermissionsService
     */
    public function __construct(UserPermissionsService $userPermissionsService)
    {
        $this->userPermissionsService = $userPermissionsService;
    }

    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if (!empty(user()) && !user()->isAdmin() && user()->checkIfUserProductsStartInFuture()) {
            if ($this->userPermissionsService->userHasPermissionsWithFutureStartDate(user()->id) &&
                empty($this->userPermissionsService->getUserPermissions(user()->id))) {
                return redirect()->route('platform.membership-paused');
            }

//            $service = app()->make(UserPermissionsService::class);
//            if ($service->userHasPermissionsWithFutureStartDate(user()->id) &&
//                empty($service->getUserPermissions(user()->id))) {
//                return redirect()->route('platform.membership-paused');
//            }
        }

        return $next($request);
    }
}
