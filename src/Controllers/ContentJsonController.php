<?php

namespace Railroad\Railcontent\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Redis;
use Railroad\Railcontent\Exceptions\DeleteFailedException;
use Railroad\Railcontent\Exceptions\NotFoundException;
use Railroad\Railcontent\Helpers\CacheHelper;
use Railroad\Railcontent\Repositories\ContentRepository;
use Railroad\Railcontent\Requests\ContentCreateRequest;
use Railroad\Railcontent\Requests\ContentUpdateRequest;
use Railroad\Railcontent\Responses\JsonPaginatedResponse;
use Railroad\Railcontent\Responses\JsonResponse;
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
            $request->get('required_parent_ids', []),
            $parsedFilters['required_fields'] ?? [],
            $parsedFilters['included_fields'] ?? [],
            $parsedFilters['required_user_states'] ?? [],
            $parsedFilters['included_user_states'] ?? []
        );

        return new JsonPaginatedResponse(
            array_values($contentData['results']),
            $contentData['total_results'],
            $contentData['filter_options'],
            200
        );
    }

    /** Pull the children contents for the parent id
     * @param integer $parentId
     * @return JsonResponse
     */
    public function getByParentId($parentId)
    {
        $settings = CacheHelper::getSettings();
        $hash = md5($parentId . ' ' . $settings);
        $contentDataCached = Redis::get('results_by_parent_id_' . $hash);
        if (!$contentDataCached) {
        $contentData = $this->contentService->getByParentId($parentId);

            Redis::set('results_by_parent_id_' . $hash, serialize($contentData));
            if(array_key_exists('results',$contentData)) {
                foreach (array_keys($contentData['results']) as $contentId) {
                    Redis::rpush('content_' . $contentId, 'results_by_parent_id_' . $hash);
                }
            }

        } else {
            $contentData = unserialize($contentDataCached);
        }

        return new JsonResponse(
            $contentData,
            200
        );
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function getByIds(Request $request)
    {
        $contentData = $this->contentService->getByIds(explode(',', $request->get('ids', '')));

        return new JsonResponse(
            $contentData,
            200
        );
    }

    /**
     * @param Request $request
     * @param $id
     * @return JsonResponse
     */
    public function show(Request $request, $id)
    {
        $content = $this->contentService->getById($id);

        //check if content exist; if not throw exception
        throw_unless($content, new NotFoundException('No content with id ' . $id . ' exists.'));

        $results = [$id => $content];

        return new JsonResponse(array_values($results), 200);
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
            $request->get('published_on'),
            $request->get('parent_id')
        );

        return new JsonResponse([$content], 201);
    }

    /** Update a content based on content id and return it in JSON format
     *
     * @param integer $contentId
     * @param ContentUpdateRequest $request
     * @return JsonResponse
     */
    public function update(ContentUpdateRequest $request, $contentId)
    {
        //update content with the data sent on the request
        $content = $this->contentService->update(
            $contentId,
            array_intersect_key(
                $request->all(),
                [
                    'slug' => '',
                    'type' => '',
                    'status' => '',
                    'brand' => '',
                    'language' => '',
                    'user_id' => '',
                    'published_on' => '',
                    'archived_on' => ''
                ]
            )
        );

        //if the update method response it's null the content not exist; we throw the proper exception
        throw_if(
            is_null($content),
            new NotFoundException('Update failed, content not found with id: ' . $contentId)
        );

        return new JsonResponse($content, 201);
    }

    /**
     * Call the delete method if the content exist
     *
     * @param integer $contentId
     * @return JsonResponse
     */
    public function delete($contentId)
    {
        //delete content
        $delete = $this->contentService->delete($contentId);

        //if the delete method response it's null the content not exist; we throw the proper exception
        throw_if(
            is_null($delete),
            new NotFoundException('Delete failed, content not found with id: ' . $contentId)
        );

        //if the delete method response it's false the mysql delete method was failed; we throw the proper exception
        throw_if(!($delete), DeleteFailedException::class);

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

    /**
     * Call the soft delete method if the content exist
     *
     * @param integer $contentId
     * @param Request $request
     * @return JsonResponse
     */
    public function softDelete($contentId)
    {
        //delete content
        $delete = $this->contentService->softDelete($contentId);

        //if the delete method response it's null the content not exist; we throw the proper exception
        throw_if(
            is_null($delete),
            new NotFoundException('Delete failed, content not found with id: ' . $contentId)
        );

        //if the delete method response it's false the mysql delete method was failed; we throw the proper exception
        throw_if(!($delete), DeleteFailedException::class);

        return new JsonResponse(null, 204);
    }
}