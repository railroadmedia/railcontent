<?php

namespace Railroad\Railcontent\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Railroad\Railcontent\Events\ContentUpdated;
use Railroad\Railcontent\Requests\ContentRequest;
use Railroad\Railcontent\Services\ContentService;

class ContentJsonController extends Controller
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
     * @param Request $request
     * @return JsonResponse
     */
    public function index(Request $request)
    {
        // todo: pass real input values
        
        $contents = $this->contentService->getFiltered(
            $request->get('page', 1),
            $request->get('limit', 25),
            $request->get('order-by', 'published_on'),
            $request->get('order-direction', 'desc'),
            $request->get('types', []),
            $request->get('required-fields', [])
        );

        return response()->json($contents, 200);
    }

    /**
     * @param Request $request
     * @param $id
     * @return array|null
     */
    public function show(Request $request, $id)
    {
        return $this->contentService->getById($id);
    }

    /** Create a new content and return it in JSON format
     *
     * @param ContentRequest $request
     * @return JsonResponse
     */
    public function store(ContentRequest $request)
    {
        $content = $this->contentService->create(
            $request->get('slug'),
            $request->get('status'),
            $request->get('type'),
            $request->get('position'),
            $request->get('parent_id'),
            $request->get('published_on')
        );

        return response()->json($content, 200);
    }

    /** Update a content based on content id and return it in JSON format
     *
     * @param integer $contentId
     * @param ContentRequest $request
     * @return JsonResponse
     */
    public function update($contentId, ContentRequest $request)
    {
        $content = $this->search->getById($contentId);

        //check if content exist
        if (is_null($content)) {
            return response()->json('Update failed, content not found with id: ' . $contentId, 404);
        }

        //call the event that save a new content version in the database
        event(new ContentUpdated($contentId));

        //update content with the data sent on the request
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
     * Call the delete method if the content exist
     *
     * @param integer $contentId
     * @param Request $request
     * @return JsonResponse
     */
    public function delete($contentId, Request $request)
    {
        // todo: refactor most of this to the service

        $content = $this->search->getById($contentId);

        //check if content exist
        if (is_null($content)) {
            return response()->json('Delete failed, content not found with id: ' . $contentId, 404);
        }

        //check if the content it's being referenced by other content
        $linkedWithContent = $this->contentService->linkedWithContent($contentId);

        if ($linkedWithContent->isNotEmpty()) {
            $ids = $linkedWithContent->implode('content_id', ', ');

            return response()->json(
                'This content is being referenced by other content (' .
                $ids .
                '), you must delete that content first.',
                404
            );
        }

        //call the event that save a new content version in the database
        event(new ContentUpdated($contentId));

        //delete content
        $deleted = $this->contentService->delete($content, $request->input('delete_children'));

        return response()->json($deleted, 200);
    }

    /**
     * Call the restore content method and return the new content in JSON format
     *
     * @param integer $versionId
     * @return JsonResponse
     */
    public function restoreContent($versionId)
    {
        // todo: move to ContentVersionController

        //get the content data saved in the database for the version id
        $version = $this->contentService->getContentVersion($versionId);

        if (is_null($version)) {
            return response()->json('Restore content failed, version not found with id: ' . $versionId, 404);
        }

        //restore content
        $restored = $this->contentService->restoreContent($versionId);

        return response()->json($restored, 200);
    }

    /** Start a content for the authenticated user
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function startContent(Request $request)
    {
        // todo: move to ContentProgressController

        $content = $this->contentService->getById($request->input('content_id'));

        if (is_null($content)) {
            return response()->json(
                'Start content failed, content not found with id: ' . $request->input('content_id'),
                404
            );
        }

        $response = $this->userContentService->startContent($request->input('content_id'));

        return response()->json($response, 200);
    }

    /** Set content as complete for the authenticated user
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function completeContent(Request $request)
    {
        // todo: move to ContentProgressController

        $content = $this->contentService->getById($request->input('content_id'));

        if (is_null($content)) {
            return response()->json(
                'Complete content failed, content not found with id: ' . $request->input('content_id'),
                404
            );
        }

        $response = $this->userContentService->completeContent($request->input('content_id'));

        return response()->json($response, 201);
    }

    /** Save the progress on a content for the authenticated user
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function saveProgress(Request $request)
    {
        // todo: move to ContentProgressController

        $content = $this->contentService->getById($request->input('content_id'));

        if (is_null($content)) {
            return response()->json(
                'Save user progress failed, content not found with id: ' . $request->input('content_id'),
                404
            );
        }

        $response =
            $this->userContentService->saveContentProgress(
                $request->input('content_id'),
                $request->input('progress')
            );

        return response()->json($response, 201);
    }

}
