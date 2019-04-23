<?php

namespace Railroad\Railcontent\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Railroad\Permissions\Services\PermissionService;
use Railroad\Railcontent\Exceptions\NotFoundException;
use Railroad\Railcontent\Requests\UserPermissionCreateRequest;
use Railroad\Railcontent\Services\ResponseService;
use Railroad\Railcontent\Services\UserPermissionsService;
use Throwable;

class UserPermissionsJsonController extends Controller
{
    /**
     * @var UserPermissionsService
     */
    private $userPermissionsService;

    /**
     * @var PermissionService
     */
    private $permissionPackageService;

    /**
     * UserPermissionsJsonController constructor.
     *
     * @param UserPermissionsService $userPermissionsService
     */
    public function __construct(
        UserPermissionsService $userPermissionsService,
        PermissionService $permissionPackageService
    ) {
        $this->userPermissionsService = $userPermissionsService;
        $this->permissionPackageService = $permissionPackageService;
    }

    /**
     * Create/update user permission record and return data in JSON format.
     *
     * @param UserPermissionCreateRequest $request
     * @return JsonResponse
     */
    public function store(UserPermissionCreateRequest $request)
    {
        $this->permissionPackageService->canOrThrow(auth()->id(), 'create.user.permissions');

        $userPermission = $this->userPermissionsService->updateOrCeate(
            [
                'user_id' => $request->input('data.relationships.user.data.id'),
                'permission_id' => $request->input('data.relationships.permission.data.id'),
            ],
            [
                'start_date' => $request->input('data.attributes.start_date'),
                'expiration_date' => $request->input('data.attributes.expiration_date'),
                'created_on' => Carbon::now()
                    ->toDateTimeString(),
                'updated_on' => Carbon::now()
                    ->toDateTimeString(),
            ]
        );

        return ResponseService::userPermission($userPermission);
    }

    /**
     * Delete user permission if exists in database
     *
     * @param int $userPermissionId
     * @return JsonResponse
     * @throws Throwable
     */
    public function delete($userPermissionId)
    {
        $this->permissionPackageService->canOrThrow(auth()->id(), 'delete.user.permissions');

        //delete user permission
        $delete = $this->userPermissionsService->delete($userPermissionId);

        //if the delete method response it's null the user permission not exist; we throw the proper exception
        throw_if(
            is_null($delete),
            new NotFoundException('Delete failed, user permission not found with id: ' . $userPermissionId)
        );

        return ResponseService::empty(204);
    }

    /**
     * Pull active user permissions.
     *  IF "only_active" it's set false on the request the expired permissions are returned also
     *  IF "user_id" it's set on the request only the permissions for the specified user are returned
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function index(Request $request)
    {
        $this->permissionPackageService->canOrThrow(auth()->id(), 'pull.user.permissions');

        $userPermissions = $this->userPermissionsService->getUserPermissions(
            $request->get('user_id'),
            $request->get('only_active', true)
        );

        return ResponseService::userPermission($userPermissions);
    }
}