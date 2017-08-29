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


        /*
         * Request post data examples:
         *
         * Get a courses 10th to 20th lessons where the instructor is caleb and the topic is bass drumming
         * [
         *      'page' => 2,
         *      'amount' => 10,
         *      'statues' => ['published'],
         *      'types' => ['course lesson'],
         *      'parent_slug' => 'my-cool-course-5',
         *      'include_future_published_on' => false, // this would be true for admins previewing posts
         *      'required_fields' => ['instructor' => 'caleb', 'topic' => 'bass drumming'],
         * ]
         *
         * Get 40th to 60th library lesson where the topic is snare
         * [
         *      'page' => 3,
         *      'amount' => 20,
         *      'statues' => ['published'],
         *      'types' => ['library lesson'],
         *      'parent_slug' => null,
         *      'include_future_published_on' => false,
         *      'required_fields' => ['topic' => 'snare'],
         * ]
         *
         * Get the most recent play along draft lesson
         * [
         *      'page' => 1,
         *      'amount' => 1,
         *      'statues' => ['draft'],
         *      'types' => ['play along'],
         *      'parent_slug' => null,
         *      'include_future_published_on' => true,
         *      'required_fields' => [],
         * ]
         *
         */

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
        $content = $this->contentService->getById($contentId);

        if (is_null($content)) {
            return response()->json('Delete failed, content not found with id: ' . $contentId, 404);
        }

        event(new ContentUpdated($contentId));

        $deleted = $this->contentService->delete($contentId, $request->input('delete_children'));

        return response()->json($deleted, 200);
    }

    /**
     * Call the restore content method and return the new content in JSON format
     * @param integer $versionId
     * @return JsonResponse
     */
    public function restoreContent($versionId)
    {
        $restored = $this->contentService->restoreContent($versionId);

        return response()->json($restored, 200);
    }
}
