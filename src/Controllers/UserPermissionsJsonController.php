<?php

namespace Railroad\Railcontent\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Railroad\Railcontent\Exceptions\NotFoundException;
use Railroad\Railcontent\Requests\UserPermissionCreateRequest;
use Railroad\Railcontent\Requests\UserPermissionUpdateRequest;
use Railroad\Railcontent\Transformers\DataTransformer;

class UserPermissionsJsonController extends Controller
{
    /**
     * @var \Railroad\Railcontent\Services\UserPermissionsService
     */
    private $userPermissionsService;

    /**
     * UserPermissionsJsonController constructor.
     *
     * @param \Railroad\Railcontent\Services\UserPermissionsService $userPermissionsService
     */
    public function __construct(\Railroad\Railcontent\Services\UserPermissionsService $userPermissionsService)
    {
        $this->userPermissionsService = $userPermissionsService;
    }

    /**
     * Create/update user permission record and return data in JSON format.
     *
     * @param \Railroad\Railcontent\Requests\UserPermissionCreateRequest $request
     * @return JsonResponse
     */
    public function store(UserPermissionCreateRequest $request)
    {
        $userPermission = $this->userPermissionsService->updateOrCeate(
            [
                'user_id' => $request->input('user_id'),
                'permission_id' => $request->input('permission_id'),
            ],
            [
                'start_date' => $request->input('start_date'),
                'expiration_date' => $request->input('expiration_date'),
                'created_on' => Carbon::now()
                    ->toDateTimeString(),
                'updated_on' => Carbon::now()
                    ->toDateTimeString(),
            ]
        );

        return reply()->json(
            [$userPermission],
            [
                'transformer' => DataTransformer::class,
            ]
        );
    }

    /**
     * Delete user permission if exists in database
     *
     * @param int $userPermissionId
     * @return JsonResponse
     * @throws \Throwable
     */
    public function delete($userPermissionId)
    {
        //delete user permission
        $delete = $this->userPermissionsService->delete($userPermissionId);

        //if the delete method response it's null the user permission not exist; we throw the proper exception
        throw_if(
            is_null($delete),
            new NotFoundException('Delete failed, user permission not found with id: ' . $userPermissionId)
        );

        return reply()->json(null, ['code' => 204]);
    }

    /**
     * Pull active user permissions.
     *  IF "only_active" it's set false on the request the expired permissions are returned also
     *  IF "user_id" it's set on the request only the permissions for the specified user are returned
     *
     * @param \Illuminate\Http\Request $request
     * @return JsonResponse
     */
    public function index(Request $request)
    {
        $userPermissions = $this->userPermissionsService->getUserPermissions(
            $request->get('user_id'),
            $request->get('only_active', true)
        );

        return reply()->json(
            $userPermissions,
            [
                'transformer' => DataTransformer::class,
            ]
        );
    }
}