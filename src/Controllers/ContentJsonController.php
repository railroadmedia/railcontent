<?php

namespace Railroad\Railcontent\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Validation\Factory as ValidationFactory;
use Railroad\Railcontent\Entities\ContentFilterResultsEntity;
use Railroad\Railcontent\Exceptions\DeleteFailedException;
use Railroad\Railcontent\Exceptions\NotFoundException;
use Railroad\Railcontent\Repositories\ContentRepository;
use Railroad\Railcontent\Requests\ContentCreateRequest;
use Railroad\Railcontent\Requests\ContentUpdateRequest;
use Railroad\Railcontent\Services\ConfigService;
use Railroad\Railcontent\Services\ContentService;
use Railroad\Railcontent\Transformers\DataTransformer;

class ContentJsonController extends Controller
{
    /**
     * @var ContentService
     */
    private $contentService;

    /**
     * @var ValidationFactory
     */
    private $validationFactory;

    /**
     * ContentController constructor.
     *
     * @param ContentService $contentService
     */
    public function __construct(
        ContentService $contentService,
        ValidationFactory $validationFactory
    ) {
        $this->contentService = $contentService;
        $this->validationFactory = $validationFactory;

        $this->middleware(ConfigService::$controllerMiddleware);
    }

    /**
     * @param Request $request
     * @return JsonPaginatedResponse
     */
    public function index(Request $request)
    {
        if ($request->has('statuses')) {
            ContentRepository::$availableContentStatues = $request->get('statuses');
        }

        $contentData = $this->contentService->getFiltered(
            $request->get('page', 1),
            $request->get('limit', 10),
            $request->get('sort', '-published_on'),
            $request->get('included_types', []),
            $request->get('slug_hierarchy', []),
            $request->get('required_parent_ids', []),
            $request->get('required_fields', []),
            $request->get('included_fields', []),
            $request->get('required_user_states', []),
            $request->get('included_user_states', [])
        );

        $filters =  $contentData['filter_options'];

        foreach ($filters as $key => $filterOptions) {
            if (is_array($filterOptions)) {
                if (($key != 'content_type') && ($key != 'instructor')) {
                      $filters[$key] = array_diff($filterOptions, ['All']);
                    array_unshift($filters[$key], 'All');
                }
            }
        }

        return reply()->json(
            $contentData['results'],
            [
                'transformer' => DataTransformer::class,
                'totalResults' => $contentData['total_results'],
                'filterOptions' => $filters,
            ]
        );
    }

    /** Pull the children contents for the parent id
     *
     * @param integer $parentId
     * @return JsonResponse
     */
    public function getByParentId($parentId)
    {
        $contentData = $this->contentService->getByParentId($parentId);

        return reply()->json(
            $contentData,
            [
                'transformer' => DataTransformer::class,
            ]
        );
    }

    public function getByChildIdWhereType($childId, $type)
    {
        $contentData = $this->contentService->getByChildIdWhereType($childId, $type);

        return reply()->json(
            $contentData,
            [
                'transformer' => DataTransformer::class,
            ]
        );
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function getByIds(Request $request)
    {
        $contentData = $this->contentService->getByIds(explode(',', $request->get('ids', '')));

        return reply()->json(
            $contentData,
            [
                'transformer' => DataTransformer::class,
            ]
        );
    }

    /**
     * @param $id
     * @return JsonResponse
     */
    public function show($id)
    {
        $content = $this->contentService->getById($id);
        throw_unless($content, new NotFoundException('No content with id ' . $id . ' exists.'));

        //        $rules = $this->contentService->getValidationRules($content);
        //        if($rules === false){
        //            return new JsonResponse('Application misconfiguration. Validation rules missing perhaps.', 503);
        //        }
        //
        //        $contentPropertiesForValidation = $this->contentService->getContentPropertiesForValidation($content, $rules);
        //
        //        $validator = $this->validationFactory->make($contentPropertiesForValidation, $rules);
        //
        //        $validation = [ 'status' => 200, 'messages' => [] ];
        //
        //        try{
        //            $validator->validate();
        //        }catch(ValidationException $exception){
        //            $messages = $exception->validator->messages()->messages();
        //            $validation = ['status' => 422, 'messages' => $messages];
        //        }
        //
        //        $content = array_merge($content, ['validation' => $validation]);

        return reply()->json(
            array_values([$id => $content]),
            [
                'transformer' => DataTransformer::class,
            ]
        );
    }

    public function slugs(Request $request, ...$slugs)
    {

    }

    /**
     * Create a new content and return it in JSON format
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
            $request->get('parent_id'),
            $request->get('sort', 0)
        );

        return reply()->json(
            [$content],
            [
                'transformer' => DataTransformer::class,
                'code' => 201,
            ]
        );
    }

    /** Update a content based on content id and return it in JSON format
     *
     * @param integer $contentId
     * @param ContentUpdateRequest $request
     * @return JsonResponse
     * @throws \Throwable
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
                    'sort' => '',
                    'status' => '',
                    'brand' => '',
                    'language' => '',
                    'user_id' => '',
                    'published_on' => '',
                    'archived_on' => '',
                ]
            )
        );

        //if the update method response it's null the content not exist; we throw the proper exception
        throw_if(
            is_null($content),
            new NotFoundException('Update failed, content not found with id: ' . $contentId)
        );

        return reply()->json(
            [$content],
            [
                'transformer' => DataTransformer::class,
                'code' => 201,
            ]
        );
    }

    /**
     * Call the delete method if the content exist
     *
     * @param integer $contentId
     * @return JsonResponse
     * @throws \Throwable
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
        throw_if(
            !($delete),
            DeleteFailedException::class
        );

        return reply()->json(null, ['code' => 204]);
    }

    /**
     * @param Request $request
     * @return Response
     */
    public function options(Request $request)
    {
        return reply()->json(
            null,
            [
                'code' => 200,
                'Access-Control-Allow-Origin' => '*',
                'Access-Control-Allow-Methods' => 'POST, PATCH, GET, OPTIONS, PUT, DELETE',
                'Access-Control-Allow-Headers' => 'X-Requested-With, content-type',
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
        throw_if(
            !($delete),
            DeleteFailedException::class
        );

        return reply()->json(null, ['code' => 204]);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function getInProgressContent(Request $request)
    {
        ContentRepository::$availableContentStatues = $request->get('statuses', [ContentService::STATUS_PUBLISHED]);
        ContentRepository::$pullFutureContent = false;

        $lessons = [];
        $totalResults = 0;

        $types = $request->get('included_types', []);
        $limit = $request->get('limit', 10);
        $page = $request->get('page', 1);

        if (in_array('shows', $types)) {
            $types = array_merge($types, array_values(config('railcontent.showTypes', [])));
        }

        if (!empty($types)) {
            $lessons = $this->contentService->getPaginatedByTypesRecentUserProgressState(
                $types,
                auth()->id(),
                'started',
                $limit,
                $page - 1
            );

            $totalResults = $this->contentService->countByTypesUserProgressState(
                $types,
                auth()->id(),
                'started'
            );
        }

        $filterOptions = $this->contentService->getFiltersForUserProgressState(auth()->id(), 'started');

        $filterOptions['content_type'] = array_values(array_diff($filterOptions['content_type'] ?? [], ['course-part']));

        return (new ContentFilterResultsEntity(
            [
                'results' => $lessons,
                'total_results' => $totalResults,
                'filter_options' => $filterOptions,
            ]
        ))->toJsonResponse();
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function getOurPicksContent(Request $request)
    {
        ContentRepository::$availableContentStatues = $request->get('statuses', [ContentService::STATUS_PUBLISHED]);
        ContentRepository::$pullFutureContent = false;

        $staffPicks = [];
        $types = $request->get('included_types', []);
        $limit = $request->get('limit', 10);
        $page = $request->get('page', 1);

        if (in_array('shows', $types)) {
            $types = array_merge($types, array_values(config('railcontent.showTypes', [])));
        }

        $field = ($request->has('is_home')) ? 'home_staff_pick_rating' : 'staff_pick_rating';

        if (!empty($types)) {
            $staffPicks = $this->contentService->getFiltered(
                $page,
                $limit,
                '-published_on',
                $types,
                [],
                [],
                [$field . ',20,integer,<='],
                [],
                [],
                [],
                false,
                false
            );

            $results =
                $staffPicks->results()
                    ->sortByFieldValue($field, 'asc');
        }

        return (new ContentFilterResultsEntity(
            ['results' => $results, 'total_results' => $staffPicks->totalResults()]
        ))->toJsonResponse();
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function getAllContent(Request $request)
    {
        ContentRepository::$availableContentStatues = $request->get('statuses', [ContentService::STATUS_PUBLISHED]);
        ContentRepository::$pullFutureContent = false;

        $results = [];
        $types = $request->get('included_types', []);

        $sortedBy = '-published_on';
        foreach ($types as $type) {
            if (array_key_exists($type, config('railcontent.cataloguesMetadata'))) {
                $sortedBy = config('railcontent.cataloguesMetadata')[$type]['sortBy'] ?? $sortedBy;
            }
        }

        $page = $request->get('page', 1);
        $limit = $request->get('limit', 10);
        $requiredFields = $request->get('required_fields', []);
        $requiredUserState = $request->get('required_user_states', []);

        ContentRepository::$availableContentStatues =
            $request->get('statuses', [ContentService::STATUS_PUBLISHED, ContentService::STATUS_SCHEDULED]);

        if ($request->has('future')) {
            ContentRepository::$pullFutureContent = true;
        } else {
            ContentRepository::$pullFutureContent = false;
        }

        if (!empty($types)) {
            $results = $this->contentService->getFiltered(
                $page,
                $limit,
                $sortedBy,
                $types,
                [],
                [],
                $requiredFields,
                [],
                $requiredUserState,
                [],
                true
            );

            return $results->toJsonResponse();
        }

        return (new ContentFilterResultsEntity(['results' => $results]))->toJsonResponse();
    }
}