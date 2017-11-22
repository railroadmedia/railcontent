<?php

namespace Railroad\Railcontent\Controllers;

use Illuminate\Routing\Controller;
use Railroad\Railcontent\Exceptions\NotFoundException;
use Railroad\Railcontent\Requests\PermissionAssignRequest;
use Railroad\Railcontent\Requests\PermissionDissociateRequest;
use Railroad\Railcontent\Requests\PermissionRequest;
use Railroad\Railcontent\Responses\JsonResponse;
use Railroad\Railcontent\Services\ContentPermissionService;
use Railroad\Railcontent\Services\PermissionService;
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
     * PermissionController constructor.
     *
     * @param PermissionService $permissionService
     * @param ContentPermissionService $contentPermissionService
     */
    public function __construct(
        PermissionService $permissionService,
        ContentPermissionService $contentPermissionService
    ) {
        $this->permissionService = $permissionService;
        $this->contentPermissionService = $contentPermissionService;
    }

    /**
     * Create a new permission and return it in JSON format
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function index(Request $request)
    {
        $permissions = $this->permissionService->getAll();

        return new JsonResponse($permissions, 200);
    }

    /**
     * Create a new permission and return it in JSON format
     *
     * @param PermissionRequest $request
     * @return \Railroad\Railcontent\Responses\JsonResponse
     */
    public function store(PermissionRequest $request)
    {
        $permission = $this->permissionService->create($request->input('name'), $request->input('brand'));

        return new JsonResponse($permission, 200);
    }

    /**
     * Update a permission if exist and return it in JSON format
     *
     * @param integer $id
     * @param PermissionRequest $request
     * @return \Railroad\Railcontent\Responses\JsonResponse
     */
    public function update($id, PermissionRequest $request)
    {
        $permission =
            $this->permissionService->update($id, $request->input('name'), $request->input('brand'));

        throw_unless(
            $permission,
            new NotFoundException('Update failed, permission not found with id: ' . $id)
        );

        return new JsonResponse($permission, 201);
    }

    /**
     * Delete a permission if exist and it's not linked with content id or content type
     *
     * @param integer $id
     * @return \Railroad\Railcontent\Responses\JsonResponse
     */
    public function delete($id)
    {
        $deleted = $this->permissionService->delete($id);

        throw_unless($deleted, new NotFoundException('Delete failed, permission not found with id: ' . $id));

        return new JsonResponse(null, 204);
    }

    /**
     * Attach permission to a specific content or to all content of a certain type
     *
     * @param PermissionAssignRequest $request
     * @return \Railroad\Railcontent\Responses\JsonResponse
     */
    public function assign(PermissionAssignRequest $request)
    {
        $assignedPermission = $this->contentPermissionService->create(
            $request->input('content_id'),
            $request->input('content_type'),
            $request->input('permission_id')
        );

        return new JsonResponse($assignedPermission, 200);
    }

    /**
     * Dissociate ("unattach") permissions either:
     *      1. from a specific content, all content of a certain type
     *      2. or, just delete a content-permission by id
     *
     * @param PermissionDissociateRequest $request
     * @return \Railroad\Railcontent\Responses\JsonResponse
     */
    public function dissociate(PermissionDissociateRequest $request)
    {
        if(!empty($request->input('content_id')) || !empty($request->input('content_type'))){
            $contentPermissions = $this->contentPermissionService->getByContentTypeOrIdAndByPermissionId(
                $request->input('content_id'),
                $request->input('content_type'),
                $request->input('permission_id')
            );
            foreach($contentPermissions as $contentPermission){
                $this->contentPermissionService->delete($contentPermission[$request->input('content_permission_id')]);
            }
        }else{
            $this->contentPermissionService->delete($request->input('content_permission_id'));
        }

        return new JsonResponse(200);
    }
}
