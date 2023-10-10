<?php

namespace App\Modules\Ecommerce\Controllers;

use App\Modules\Ecommerce\Collections\UserAccessPermissionsCollection;
use App\Modules\Ecommerce\Resources\UserAccessPermissionResource;
use App\Modules\Ecommerce\Services\ShopifySyncService;
use App\Modules\Ecommerce\Services\UserAccessPermissionsService;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Log;
use Railroad\Permissions\Services\PermissionService;

class UserAccessPermissionsController extends Controller
{

    private UserAccessPermissionsService $userAccessPermissionsService;
    private PermissionService $permissionService;

    public function __construct(UserAccessPermissionsService $userAccessPermissionsService,PermissionService $permissionService)
    {
        $this->userAccessPermissionsService = $userAccessPermissionsService;
        $this->permissionService = $permissionService;
    }

    public function index(Request $request)
    {
        $userAccessPermissions = $this->userAccessPermissionsService->getUserAccessPermissionsList(
            $request->get('user_id'),
            $request->get('page'),
            $request->get('limit')
        );

        $userAccessPermissions->determineActiveTimes();

        return UserAccessPermissionResource::collection(
            $userAccessPermissions->getCollection()
                ->sortBy('actualStartTime')
        );
    }

    public function store(Request $request)
    {

        $user = user();
        $userAccessPermission=null;
        $userIsSuperAdmin = $this->permissionService->is($user->id, 'administrator')||$this->permissionService->is($user->id, 'it');
        if($userIsSuperAdmin) {
            $userAccessPermission = $this->userAccessPermissionsService->createOrUpdateUserAccessPermission(
                $request->get('user_id'),
                $request->get('permission_id'),
                $request->get('start_date'),
                $request->get('days'),
                $request->get('months'),
                $request->get('lifetime'),
                $request->get('status')
            );
        }

        return ($userAccessPermission);
    }

    public function update($id, Request $request)
    {
        $userAccessPermission = $this->userAccessPermissionsService->createOrUpdateUserAccessPermission(
            $request->get('user_id'),
            $request->get('permission_id'),
            $request->get('start_date'),
            $request->get('days'),
            $request->get('months'),
            $request->get('lifetime'),
            $request->get('status'),
            $id
        );

        return $userAccessPermission;
    }

}
