<?php

namespace Railroad\Railcontent\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Railroad\Permissions\Services\PermissionService;
use Railroad\Railcontent\Requests\ContentHierarchyCreateRequest;
use Railroad\Railcontent\Services\ConfigService;
use Railroad\Railcontent\Services\ContentHierarchyService;
use Railroad\Railcontent\Services\ResponseService;

class ContentHierarchyJsonController extends Controller
{
    /**
     * @var ContentHierarchyService
     */
    private $contentHierarchyService;

    /**
     * @var PermissionService
     */
    private $permissionPackageService;

    /**
     * FieldController constructor.
     *
     * @param ContentHierarchyService $contentHierarchyService
     */
    public function __construct(ContentHierarchyService $contentHierarchyService, PermissionService $permissionPackageService)
    {
        $this->contentHierarchyService = $contentHierarchyService;
        $this->permissionPackageService = $permissionPackageService;

        $this->middleware(ConfigService::$controllerMiddleware);
    }

    /**
     * Create/update a content hierarchy.
     *
     * @param ContentHierarchyCreateRequest $request
     * @return JsonResponse
     */
    public function store(ContentHierarchyCreateRequest $request)
    {
        $this->permissionPackageService->canOrThrow(auth()->id(), 'create.content.hierarchy');

        $hierarchy = $this->contentHierarchyService->createOrUpdateHierarchy(
            $request->input('data.relationships.parent.data.id'),
            $request->input('data.relationships.child.data.id'),
            $request->input('data.attributes.child_position')
        );

        return ResponseService::contentHierarchy($hierarchy);
    }

     /**
     * @param Request $request
     * @param $childId
     * @param $parentId
     * @return JsonResponse
     */
    public function delete(Request $request, $parentId, $childId)
    {
        $this->permissionPackageService->canOrThrow(auth()->id(), 'delete.content.hierarchy');

        $this->contentHierarchyService->delete($parentId, $childId);

        return ResponseService::empty(204);
    }
}