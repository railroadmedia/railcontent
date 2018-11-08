<?php

namespace Railroad\Railcontent\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Railroad\Permissions\Services\PermissionService;
use Railroad\Railcontent\Requests\ContentHierarchyCreateRequest;
use Railroad\Railcontent\Services\ConfigService;
use Railroad\Railcontent\Services\ContentHierarchyService;
use Railroad\Railcontent\Transformers\DataTransformer;

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

        $contentField = $this->contentHierarchyService->create(
            $request->input('parent_id'),
            $request->input('child_id'),
            $request->input('child_position')
        );

        return reply()->json(
            [$contentField],
            [
                'transformer' => DataTransformer::class,
            ]
        );
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

        return reply()->json(null, ['code' => 204]);
    }
}