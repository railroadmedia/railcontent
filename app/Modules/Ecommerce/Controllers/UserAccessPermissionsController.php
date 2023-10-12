<?php

namespace App\Modules\Ecommerce\Controllers;

use App\Modules\Ecommerce\Resources\UserAccessPermissionResource;
use App\Modules\Ecommerce\Services\UserAccessPermissionsService;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

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

    /**
     * @param Request $request
     * @return \App\Modules\Ecommerce\Models\UserAccessPermission|\Illuminate\Database\Eloquent\Builder|\Illuminate\Database\Eloquent\Model|object|null
     */
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

    /**
     * @param $id
     * @param Request $request
     * @return \App\Modules\Ecommerce\Models\UserAccessPermission|\Illuminate\Database\Eloquent\Builder|\Illuminate\Database\Eloquent\Model|object|null
     */
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
            $request->get('revoked_at'),
            $id
        );

        return $userAccessPermission;
    }

}
