<?php

namespace Railroad\Railcontent\Controllers;

use Illuminate\Routing\Controller;
use Railroad\Railcontent\Exceptions\NotFoundException;
use Railroad\Railcontent\Requests\PermissionAssignRequest;
use Railroad\Railcontent\Requests\PermissionDissociateRequest;
use Railroad\Railcontent\Requests\PermissionRequest;
use Railroad\Railcontent\Services\ConfigService;
use Railroad\Railcontent\Services\ContentPermissionService;
use Railroad\Railcontent\Services\PermissionService;
use Railroad\Railcontent\Transformers\DataTransformer;
use Symfony\Component\HttpFoundation\Request;

/**
 * Class PermissionController
 *
 * @package Railroad\Railcontent\Controllers
 */
class PermissionJsonController extends Controller
{
    /**
     * @var PermissionService
     */
    private $permissionService;
    /**
     * @var ContentPermissionService
     */
    private $contentPermissionService;

    /**
     * @var \Railroad\Permissions\Services\PermissionService
     */
    private $permissionPackageService;

    /**
     * PermissionController constructor.
     *
     * @param PermissionService $permissionService
     * @param ContentPermissionService $contentPermissionService
     */
    public function __construct(
        PermissionService $permissionService,
        ContentPermissionService $contentPermissionService,
        \Railroad\Permissions\Services\PermissionService $permissionPackageService
    ) {
        $this->permissionService = $permissionService;
        $this->contentPermissionService = $contentPermissionService;
        $this->permissionPackageService = $permissionPackageService;

        $this->middleware(ConfigService::$controllerMiddleware);
    }

    /**
     * Create a new permission and return it in JSON format
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function index(Request $request)
    {
        $this->permissionPackageService->canOrThrow(auth()->id(), 'pull.permissions');

        $permissions = $this->permissionService->getAll();

        return reply()->json(
            $permissions,
            [
                'transformer' => DataTransformer::class,
            ]
        );
    }

    /**
     * Create a new permission and return it in JSON format
     *
     * @param PermissionRequest $request
     * @return JsonResponse
     */
    public function store(PermissionRequest $request)
    {
        $this->permissionPackageService->canOrThrow(auth()->id(), 'create.permission');

        $permission = $this->permissionService->create(
            $request->input('name'),
            $request->input('brand')
        );

        return reply()->json(
            [$permission],
            [
                'transformer' => DataTransformer::class,
            ]
        );
    }

    /**
     * Update a permission if exist and return it in JSON format
     *
     * @param integer $id
     * @param PermissionRequest $request
     * @return JsonResponse
     * @throws \Throwable
     */
    public function update($id, PermissionRequest $request)
    {
        $this->permissionPackageService->canOrThrow(auth()->id(), 'update.permission');

        $permission = $this->permissionService->update(
            $id,
            $request->input('name'),
            $request->input('brand')
        );

        throw_unless(
            $permission,
            new NotFoundException('Update failed, permission not found with id: ' . $id)
        );

        return reply()->json(
            [$permission],
            [
                'transformer' => DataTransformer::class,
                'code' => 201,
            ]
        );
    }

    /**
     * Delete a permission if exist and it's not linked with content id or content type
     *
     * @param integer $id
     * @return JsonResponse
     * @throws \Throwable
     */
    public function delete($id)
    {
        $this->permissionPackageService->canOrThrow(auth()->id(), 'delete.permission');

        $deleted = $this->permissionService->delete($id);

        throw_unless(
            $deleted,
            new NotFoundException('Delete failed, permission not found with id: ' . $id)
        );

        return reply()->json(null, ['code' => 204]);
    }

    /**
     * Attach permission to a specific content or to all content of a certain type
     *
     * @param PermissionAssignRequest $request
     * @return JsonResponse
     */
    public function assign(PermissionAssignRequest $request)
    {
        $this->permissionPackageService->canOrThrow(auth()->id(), 'assign.permission');
        $assignedPermission = $this->contentPermissionService->create(
            $request->input('content_id'),
            $request->input('content_type'),
            $request->input('permission_id')
        );

        return reply()->json(
            [$assignedPermission],
            [
                'transformer' => DataTransformer::class,
            ]
        );
    }

    /**
     * Dissociate ("unattach") permissions from a specific content or all content of a certain type
     *
     * @param PermissionDissociateRequest $request
     * @return JsonResponse
     */
    public function dissociate(PermissionDissociateRequest $request)
    {
        $this->permissionPackageService->canOrThrow(auth()->id(), 'disociate.permissions');

        $dissociate = $this->contentPermissionService->dissociate(
            $request->input('content_id'),
            $request->input('content_type'),
            $request->input('permission_id')
        );

        return reply()->json(
            [[$dissociate]],
            [
                'transformer' => DataTransformer::class,
            ]
        );
    }
}
