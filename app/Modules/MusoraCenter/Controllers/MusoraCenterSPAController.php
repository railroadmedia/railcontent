<?php

namespace App\Modules\MusoraCenter\Controllers;

use Illuminate\View\View;
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
     */
    public function __construct(
        PermissionService $permissionService,
    ) {
        $this->permissionService = $permissionService;
    }

    public function show(): View
    {
        $user = user();
        $userIsSuperAdmin = $this->permissionService->is($user->id, 'super_administrator');

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
            'mentors',
            'it',
        ];

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
                "userMappedInfo" => $userMappedInfo,
                "musoraWebAppURL" => $musoraWebAppURL,
            ]
        );
    }
}
