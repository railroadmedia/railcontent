<?php

namespace Railroad\Railcontent\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Railroad\Railcontent\Repositories\ContentRepository;
use Railroad\Railcontent\Repositories\FieldRepository;
use Railroad\Railcontent\Repositories\PermissionRepository;
use Railroad\Railcontent\Repositories\UserContentRepository;
use Railroad\Railcontent\Requests\ContentIndexRequest;
use Railroad\Railcontent\Requests\ContentRequest;
use Railroad\Railcontent\Services\ContentService;
use Railroad\Railcontent\Events\ContentUpdated;
use Railroad\Railcontent\Services\SearchService;
use Railroad\Railcontent\Services\UserContentService;

class ContentController extends Controller
{
    /**
     * @var ContentService
     */
    private $contentService, $userContentService, $contentRepository, $search;

    /**
     * ContentController constructor.
     *
     * @param ContentService $contentService
     * @param ContentRepository $contentRepository
     * @param UserContentService $userContentService
     */
    public function __construct(ContentService $contentService, ContentRepository $contentRepository, UserContentService $userContentService)
    {
        $this->contentService = $contentService;
        $this->userContentService = $userContentService;
        $this->contentRepository = $contentRepository;
        $this->search = new SearchService(
            new FieldRepository(
                new PermissionRepository(
                    new UserContentRepository(
                        $this->contentRepository
                    )
                )
            )
        );
    }

    /**
     * @param ContentIndexRequest $request
     */
    public function index(ContentIndexRequest $request)
    {
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

        $contents = $this->search->getPaginated();

        return response()->json($contents, 200);
    }

    /** Create a new content and return it in JSON format
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
        if(is_null($content)) {
            return response()->json('Update failed, content not found with id: '.$contentId, 404);
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
        $content = $this->search->getById($contentId);

        //check if content exist
        if(is_null($content)) {
            return response()->json('Delete failed, content not found with id: '.$contentId, 404);
        }

        //check if the content it's being referenced by other content
        $linkedWithContent = $this->contentService->linkedWithContent($contentId);

        if($linkedWithContent->isNotEmpty()) {
            $ids = $linkedWithContent->implode('content_id', ', ');

            return response()->json('This content is being referenced by other content ('.$ids.'), you must delete that content first.', 404);
        }

        //call the event that save a new content version in the database
        event(new ContentUpdated($contentId));

        //delete content
        $deleted = $this->contentService->delete($content, $request->input('delete_children'));

        return response()->json($deleted, 200);
    }

    /**
     * Call the restore content method and return the new content in JSON format
     * @param integer $versionId
     * @return JsonResponse
     */
    public function restoreContent($versionId)
    {
        //get the content data saved in the database for the version id
        $version = $this->contentService->getContentVersion($versionId);

        if(is_null($version)) {
            return response()->json('Restore content failed, version not found with id: '.$versionId, 404);
        }

        //restore content
        $restored = $this->contentService->restoreContent($versionId);

        return response()->json($restored, 200);
    }

    /** Start a content for the authenticated user
     * @param Request $request
     * @return JsonResponse
     */
    public function startContent(Request $request)
    {
        $content = $this->contentService->getById($request->input('content_id'));

        if(is_null($content)) {
            return response()->json('Start content failed, content not found with id: '.$request->input('content_id'), 404);
        }

        $response = $this->userContentService->startContent($request->input('content_id'));

        return response()->json($response, 200);
    }

    /** Set content as complete for the authenticated user
     * @param Request $request
     * @return JsonResponse
     */
    public function completeContent(Request $request)
    {
        $content = $this->contentService->getById($request->input('content_id'));

        if(is_null($content)) {
            return response()->json('Complete content failed, content not found with id: '.$request->input('content_id'), 404);
        }

        $response = $this->userContentService->completeContent($request->input('content_id'));

        return response()->json($response, 201);
    }

    /** Save the progress on a content for the authenticated user
     * @param Request $request
     * @return JsonResponse
     */
    public function saveProgress(Request $request)
    {
        $content = $this->contentService->getById($request->input('content_id'));

        if(is_null($content)) {
            return response()->json('Save user progress failed, content not found with id: '.$request->input('content_id'), 404);
        }

        $response = $this->userContentService->saveContentProgress($request->input('content_id'), $request->input('progress'));

        return response()->json($response, 201);
    }

    /** Get content based on id
     * @param integer $contentId
     * @return array|mixed|null
     */
    public function getContent($contentId)
    {
        return $this->search->getById($contentId);
    }
}
