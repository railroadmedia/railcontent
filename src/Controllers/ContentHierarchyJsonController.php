<?php

namespace Railroad\Railcontent\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Railroad\Railcontent\Exceptions\NotFoundException;
use Railroad\Railcontent\Requests\ContentHierarchyCreateRequest;
use Railroad\Railcontent\Requests\ContentHierarchyUpdateRequest;
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
     * FieldController constructor.
     *
     * @param ContentHierarchyService $contentHierarchyService
     */
    public function __construct(ContentHierarchyService $contentHierarchyService)
    {
        $this->contentHierarchyService = $contentHierarchyService;

        $this->middleware(ConfigService::$controllerMiddleware);
    }

    /**
     * Create a new content hierarchy.
     *
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

        return reply()->json(
            [$contentField],
            [
                'transformer' => DataTransformer::class,
            ]
        );
    }

    /**
     * Update content hierarchy.
     *
     * @param ContentHierarchyUpdateRequest $request
     * @param int $childId
     * @param int $parentId
     * @return JsonResponse
     */
    public function update(ContentHierarchyUpdateRequest $request, $parentId, $childId)
    {
        $contentHierarchy = $this->contentHierarchyService->update(
            $parentId,
            $childId,
            $request->input('child_position')
        );

        throw_if(
            is_null($contentHierarchy),
            new NotFoundException('Update hierarchy failed.')
        );


        return reply()->json(
            [$contentHierarchy],
            [
                'transformer' => DataTransformer::class,
                'code' => 201,
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
        $this->contentHierarchyService->delete($parentId, $childId);

        return reply()->json(null, ['code' => 204]);
    }
}