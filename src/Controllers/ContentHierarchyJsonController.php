<?php

namespace Railroad\Railcontent\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Railroad\Railcontent\Exceptions\NotFoundException;
use Railroad\Railcontent\Requests\ContentHierarchyCreateRequest;
use Railroad\Railcontent\Requests\ContentHierarchyUpdateRequest;
use Railroad\Railcontent\Responses\JsonResponse;
use Railroad\Railcontent\Services\ContentHierarchyService;

class ContentHierarchyJsonController extends Controller
{
    /**
     * @var ContentHierarchyService
     */
    private $contentHierarchyService;

    /**
     * FieldController constructor.
     *
     * @param ContentHierarchyService $contentHierarchyService
     */
    public function __construct(ContentHierarchyService $contentHierarchyService)
    {
        $this->contentHierarchyService = $contentHierarchyService;
    }

    /**
     * @param ContentHierarchyCreateRequest $request
     * @return JsonResponse
     */
    public function store(ContentHierarchyCreateRequest $request)
    {
        $contentField = $this->contentHierarchyService->create(
            $request->input('parent_id'),
            $request->input('child_id'),
            $request->input('child_position')
        );

        return new JsonResponse($contentField, 200);
    }

    /**
     * @param ContentHierarchyUpdateRequest $request
     * @param $childId
     * @param $parentId
     * @return JsonResponse
     */
    public function update(ContentHierarchyUpdateRequest $request, $parentId, $childId)
    {
        $contentHierarchy = $this->contentHierarchyService->get($parentId, $childId);

        throw_if(empty($contentHierarchy), new NotFoundException('Update hierarchy failed.'));

        $contentField = $this->contentHierarchyService->update(
            $parentId,
            $childId,
            $request->input('child_position')
        );

        return new JsonResponse($contentField, 201);
    }

    /**
     * @param Request $request
     * @param $childId
     * @param $parentId
     * @return JsonResponse
     */
    public function delete(Request $request, $parentId, $childId)
    {
        $this->contentHierarchyService->delete($parentId, $childId);

        return new JsonResponse(null, 204);
    }
}