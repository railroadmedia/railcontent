<?php

namespace App\Modules\Ecommerce\Controllers;

use App\Modules\Ecommerce\Collections\UserAccessPermissionsCollection;
use App\Modules\Ecommerce\Resources\UserAccessPermissionResource;
use App\Modules\Ecommerce\Services\ShopifySyncService;
use App\Modules\Ecommerce\Services\UserAccessPermissionsService;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Log;

class UserAccessPermissionsController extends Controller
{

    private UserAccessPermissionsService $userAccessPermissionsService;

    public function __construct(UserAccessPermissionsService $userAccessPermissionsService)
    {
        $this->userAccessPermissionsService = $userAccessPermissionsService;
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
        $userAccessPermission = $this->userAccessPermissionsService->createOrUpdateUserAccessPermission(
            $request->get('user_id'),
            $request->get('permission_id'),
            $request->get('start_date'),
            $request->get('days'),
            $request->get('months'),
            $request->get('lifetime'),
            $request->get('status')
        );

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
