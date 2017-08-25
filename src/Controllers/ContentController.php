<?php

namespace Railroad\Railcontent\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Railroad\Railcontent\Requests\ContentIndexRequest;
use Railroad\Railcontent\Requests\ContentRequest;
use Railroad\Railcontent\Services\ContentService;
use Railroad\Railcontent\Events\ContentUpdated;

class ContentController extends Controller
{
    /**
     * @var ContentService
     */
    private $contentService;

    /**
     * ContentController constructor.
     *
     * @param ContentService $contentService
     */
    public function __construct(ContentService $contentService)
    {
        $this->contentService = $contentService;
    }

    /**
     * @param ContentIndexRequest $request
     */
    public function index(ContentIndexRequest $request)
    {
        // WIP
//        $this->contentService->getPaginated();

//        'page' => 'numeric|min:1',
//            'amount' => 'numeric|min:1',
//            'statuses' => 'array',
//            'types' => 'array',
//            'parent_slug' => 'string',
//            'include_future_published_on' => 'boolean'
    }

    /** Create a new category and return it in JSON format
     *
     * @param ContentRequest $request
     * @return JsonResponse
     */
    public function store(ContentRequest $request)
    {
        $content = $this->contentService->create(
            $request->input('slug'),
            $request->input('status'),
            $request->input('type'),
            $request->input('position'),
            $request->input('parent_id'),
            $request->input('published_on')
        );

        return response()->json($content, 200);
    }

    /** Update a category based on category id and return it in JSON format
     *
     * @param integer $contentId
     * @param ContentRequest $request
     * @return JsonResponse
     */
    public function update($contentId, ContentRequest $request)
    {
        $content = $this->contentService->getById($contentId);

        if (is_null($content)) {
            return response()->json('Update failed, content not found with id: ' . $contentId, 404);
        }

        event(new ContentUpdated($contentId));

        $content = $this->contentService->update(
            $contentId,
            $request->input('slug'),
            $request->input('status'),
            $request->input('type'),
            $request->input('position'),
            $request->input('parent_id'),
            $request->input('published_on'),
            $request->input('archived_on')
        );

        return response()->json($content, 201);
    }

    /**
     * Call the delete method if the category exist
     *
     * @param integer $contentId
     * @param Request $request
     * @return JsonResponse
     */
    public function delete($contentId, Request $request)
    {
        $deleted = $this->contentService->delete($contentId, $request->input('delete_children'));

        if (!$deleted) {
            return response()->json('Delete failed, content not found with id: ' . $contentId, 404);
        }

        return response()->json($deleted, 200);
    }
}
