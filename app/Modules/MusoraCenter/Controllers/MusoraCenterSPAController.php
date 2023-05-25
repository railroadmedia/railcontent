<?php

namespace App\Modules\MusoraCenter\Controllers;

use Illuminate\Routing\Controller;
use Railroad\Permissions\Services\PermissionService;
use Railroad\Usora\Entities\User;

class MusoraCenterSPAController extends Controller
{
    /**
     * @var PermissionService
     */
    private $permissionService;

    /**
     * SinglePageController constructor.
     * @param PermissionService $permissionService
     */
    public function __construct(
        PermissionService $permissionService,
    )
    {
        $this->permissionService = $permissionService;
    }

    public function show()
    {
        $user = user();
        $userIsSuperAdmin = $this->permissionService->is($user->id, 'super_administrator');

        $permissions = [];

        if ($this->permissionService->is($user->id, 'administrator')) {
            $permissions = [
                'content',
                'users',
                'customers',
                'products',
                'permissions',
                'orders',
                'access-codes',
                'failed-billing',
                'discounts',
                'shipping',
                'shipping-fulfillment',
                'mentors'
            ];
        }

        if ($this->permissionService->is($user->id, 'view_daily_stats')) {
            $permissions[] = 'daily-stats';
        }

        if ($this->permissionService->is($user->id, 'shipping_fulfillment')) {
            $permissions[] = 'shipping-fulfillment';
        }

        if ($this->permissionService->is($user->id, 'mentors')) {
            $permissions[] = 'mentors';
        }

        if ($this->permissionService->is($user->id, 'payment_recovery')) {
            $permissions[] = 'failed-billing';
        }

        if ($this->permissionService->is($user->id, 'accounting')) {
            $permissions[] = 'accounting-reporting';
        }

        if ($this->permissionService->is($user->id, 'membership_stats')) {
            $permissions[] = 'membership-stats';
        }

        if ($this->permissionService->is($user->id, 'retention_stats')) {
            $permissions[] = 'retention-stats';
        }

        if ($this->permissionService->is($user->id, 'it')) {
            $permissions[] = 'it';
        }

        $userMappedInfo = [
            "id" => $user->id,
            "display_name" => $user->display_name,
            "email" => $user->email,
            "csrf_token" => csrf_token(),
            "permission_level" => $userIsSuperAdmin ? 'super_administrator' : 'administrator',
            "permissions" => $permissions,
            "logoutUrl" => route('user_management_system.logout.cookie')
        ];

        $musoraWebAppURL = env('MUSORA_WEB_PLATFORM_URL', config('url'));

        return view(
            'musora-center::musora-center-spa',
            [
                "user" => $userMappedInfo,
                "musoraWebAppURL" => $musoraWebAppURL,
            ]
        );
    }
}
