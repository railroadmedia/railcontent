<?php

namespace Railroad\Railcontent\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Railroad\Railcontent\Events\ContentUpdated;
use Railroad\Railcontent\Exceptions\ContentNotFoundException;
use Railroad\Railcontent\Repositories\ContentRepository;
use Railroad\Railcontent\Requests\ContentCreateRequest;
use Railroad\Railcontent\Requests\ContentUpdateRequest;
use Railroad\Railcontent\Responses\JsonPaginatedResponse;
use Railroad\Railcontent\Responses\JsonResponse;
use Railroad\Railcontent\Services\ConfigService;
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
     * @return JsonPaginatedResponse
     */
    public function index(Request $request)
    {
        $filters = $request->get('filter', []);
        $parsedFilters = [];

        foreach ($filters as $filterName => $filterValues) {
            foreach ($filterValues as $filterString) {
                $parsedFilters[$filterName][] = explode(',', $filterString);
            }
        }

        if ($request->has('statuses') && $request->get('auth_level') == 'administrator') {
            ContentRepository::$availableContentStatues = $request->get('statuses');
        }

        $contentData = $this->contentService->getFiltered(
            $request->get('page', 1),
            $request->get('limit', 10),
            $request->get('sort', 'published_on'),
            $request->get('included_types', []),
            $request->get('slug_hierarchy', []),
            $parsedFilters['required_fields'] ?? [],
            $parsedFilters['included_fields'] ?? [],
            $parsedFilters['required_user_states'] ?? [],
            $parsedFilters['included_user_states'] ?? []
        );

        return new JsonPaginatedResponse(
            $contentData['results'],
            $contentData['total_results'],
            $contentData['filter_options'],
            200
        );
    }

    /**
     * @param Request $request
     * @param $id
     * @return array|null
     */
    public function show(Request $request, $id)
    {
        $content = $this->contentService->getById($id);

        $request->request->add(['content_id' => $id]);

        //check if content exist; if not throw exception
        throw_unless($content, ContentNotFoundException::class);

        $results = [$id => $content];

        return new JsonResponse($results, 200);
    }

    public function slugs(Request $request, ...$slugs)
    {

    }

    /** Create a new content and return it in JSON format
     *
     * @param ContentUpdateRequest $request
     * @return JsonResponse
     */
    public function store(ContentCreateRequest $request)
    {
        $content = $this->contentService->create(
            $request->get('slug'),
            $request->get('type'),
            $request->get('status'),
            $request->get('language'),
            $request->get('brand'),
            $request->get('user_id'),
            $request->get('published_on')
        );

        return new JsonResponse([$content['id'] => $content], 201);
    }

    /** Update a content based on content id and return it in JSON format
     *
     * @param integer $contentId
     * @param ContentUpdateRequest $request
     * @return JsonResponse
     */
    public function update(ContentUpdateRequest $request, $contentId)
    {
        $content = $this->contentService->getById($contentId);
        request()->request->add(['content_id' => $contentId]);

        //check if content exist; if not throw exception
        throw_unless($content, ContentNotFoundException::class);

        //call the event that save a new content version in the database
        event(new ContentUpdated($content['id']));

        //update content with the data sent on the request
        $content = $this->contentService->update(
            $contentId,
            [
                "slug" => $request->input('slug'),
                "status" => $request->input('status'),
                "type" => $request->input('type'),
                "language" => $request->input('language') ?? ConfigService::$defaultLanguage,
                "published_on" => $request->input('published_on'),
                "archived_on" => $request->input('archived_on')
            ]
        );

        return new JsonResponse($content, 201);
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

        $content = $this->contentService->getById($contentId);

        $request->request->add(['content_id' => $contentId]);

        //check if content exist; if not throw exception
        throw_unless($content, ContentNotFoundException::class);

        //call the event that save a new content version in the database
        event(new ContentUpdated($contentId));

        //delete content
        $this->contentService->delete($contentId);

        return new JsonResponse(null, 204);
    }

    /**
     * @param Request $request
     * @return Response
     */
    public function options(Request $request)
    {
        return response()->make(
            '',
            200,
            [
                'Access-Control-Allow-Origin' => '*',
                'Access-Control-Allow-Methods' => 'POST, PATCH, GET, OPTIONS, PUT, DELETE',
                'Access-Control-Allow-Headers' => 'X-Requested-With, content-type'
            ]
        );
    }
}