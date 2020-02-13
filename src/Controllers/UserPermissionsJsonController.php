<?php

namespace Railroad\Railcontent\Controllers;

use Carbon\Carbon;
use Doctrine\ORM\OptimisticLockException;
use Doctrine\ORM\ORMException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Railroad\Permissions\Exceptions\NotAllowedException;
use Railroad\Permissions\Services\PermissionService;
use Railroad\Railcontent\Exceptions\NotFoundException;
use Railroad\Railcontent\Requests\UserPermissionCreateRequest;
use Railroad\Railcontent\Services\ResponseService;
use Railroad\Railcontent\Services\UserPermissionsService;
use Spatie\Fractal\Fractal;
use Throwable;

/**
 * Class UserPermissionsJsonController
 *
 * @group User access API
 *
 * @package Railroad\Railcontent\Controllers
 */
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
     * @param PermissionService $permissionPackageService
     */
    public function __construct(
        UserPermissionsService $userPermissionsService,
        PermissionService $permissionPackageService
    ) {
        $this->userPermissionsService = $userPermissionsService;
        $this->permissionPackageService = $permissionPackageService;
    }

    /** Give or modify users access to specific content for a specific amount of time.
     *
     * @param UserPermissionCreateRequest $request
     * @return Fractal
     * @throws ORMException
     * @throws OptimisticLockException
     * @throws NotAllowedException
     *
     * @permission Must be logged in
     * @permission Must have the create.user.permissions permission
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

    /** Delete user access to content.
     *
     * @param $userPermissionId
     * @return JsonResponse
     * @throws Throwable
     * @throws ORMException
     * @throws OptimisticLockException
     * @throws NotAllowedException
     *
     * @permission Must be logged in
     * @permission Must have the delete.user.permissions permission
     * @queryParam id required
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

    /** List active users permissions.
     *
     * @param Request $request
     * @return Fractal
     * @throws NotAllowedException
     *
     * @permission Must be logged in
     * @permission Must have the pull.user.permissions permission
     * @bodyParam only_active boolean Include the expired permissions if it's false. Default:true. Example: true
     * @bodyParam user_id integer Only the permissions for the specified user are returned. Default:null. Example:1
     */
    public function index(Request $request)
    {
        $this->permissionPackageService->canOrThrow(auth()->id(), 'pull.user.permissions');

        $userPermissions = $this->userPermissionsService->getUserPermissions(
            $request->get('user_id'),
            $request->get('only_active') == 'true' ? true : false
        );

        return ResponseService::userPermission($userPermissions);
    }
}