<?php

namespace Railroad\Railcontent\Controllers;

use Doctrine\DBAL\DBALException;
use Doctrine\ORM\NonUniqueResultException;
use Doctrine\ORM\OptimisticLockException;
use Doctrine\ORM\ORMException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Railroad\Permissions\Exceptions\NotAllowedException;
use Railroad\Permissions\Services\PermissionService;
use Railroad\Railcontent\Entities\ContentFilterResultsEntity;
use Railroad\Railcontent\Exceptions\NotFoundException;
use Railroad\Railcontent\Managers\SearchEntityManager;
use Railroad\Railcontent\Repositories\ContentRepository;
use Railroad\Railcontent\Requests\ContentCreateRequest;
use Railroad\Railcontent\Requests\ContentUpdateRequest;
use Railroad\Railcontent\Services\ContentService;
use Railroad\Railcontent\Services\ResponseService;
use ReflectionException;
use Spatie\Fractal\Fractal;
use Throwable;

/**
 * Class ContentJsonController
 *
 * @group Content API
 *
 * @package Railroad\Railcontent\Controllers
 */
class ContentJsonController extends Controller
{
    /**
     * @var ContentService
     */
    private $contentService;

    /**
     * @var PermissionService
     */
    private $permissionPackageService;

    /**
     * ContentJsonController constructor.
     *
     * @param ContentService $contentService
     * @param PermissionService $permissionPackageService
     */
    public function __construct(
        ContentService $contentService,
        PermissionService $permissionPackageService
    ) {
        $this->contentService = $contentService;
        $this->permissionPackageService = $permissionPackageService;
    }

    /**
     * @param Request $request
     * @return JsonResponse
     * @throws NotAllowedException
     *
     * @permission pull.contents required
     * @bodyParam statuses array All content must have one of these statuses. Default:published. Example:['published']
     * @bodyParam included_types array Contents with these types will be returned.. Example:[]
     * @bodyParam required_parent_ids array All contents must be a child of any of the passed in parent ids. Example:[]
     * @bodyParam filter[required_fields] array All returned contents are required to have this field. Value format is: key;value;type (type is optional if its not declared all types will be included). Example:[]
     * @bodyParam filter[included_fields] array 	All contents must be a child of any of the passed in parent ids.. Example:[]
     * @bodyParam filter[required_user_states] array All returned contents are required to have these states for the authenticated user. Value format is: state. Example:[]
     * @bodyParam filter[included_user_states] array Contents that have any of these states for the authenticated user will be returned. The first included user state is the same as a required user state but all included states after the first act inclusively. Value format is: state. Example:[]
     * @bodyParam filter[required_user_playlists] array All returned contents are required to be inside these authenticated users playlists. Value format is: name. Example:[]
     * @bodyParam filter[included_user_playlists] array Contents that are in any of the authenticated users playlists will be returned. The first included user playlist is the same as a required user playlist but all included playlist after the first act inclusively. Value format is: name. Example:[]
     * @bodyParam slug_hierarchy string  Example:[]
     * @bodyParam sort string Default:-published_on. Example:-published_on
     * @bodyParam page integer  Which page to load, will be {limit} long.By default:1. Example:1
     * @bodyParam limit integer  How many to load per page. By default:10. Example:10
     */
    public function index(Request $request)
    {
        //$this->permissionPackageService->canOrThrow(auth()->id(), 'pull.contents');

        if ($request->has('statuses')) {
            ContentRepository::$availableContentStatues = $request->get('statuses');
        }

        $contentData = $this->contentService->getFiltered(
            $request->get('page', 1),
            $request->get('limit', 10),
            $request->get('sort', 'newest'),
            $request->get('included_types', []),
            $request->get('slug_hierarchy', []),
            $request->get('required_parent_ids', []),
            $request->get('required_fields', []),
            $request->get('included_fields', []),
            $request->get('required_user_states', []),
            $request->get('included_user_states', [])
        );

        return ResponseService::content(
            $contentData->results(),
            $contentData->qb(),
            [],
            $contentData->filterOptions()
        )
            ->respond();
    }

    /** Pull contents that are children of the specified content id
     *
     * @param $parentId
     *
     * @return Fractal
     * @throws NotAllowedException
     *
     * @permission pull.contents required
     */
    public function getByParentId($parentId)
    {
        $this->permissionPackageService->canOrThrow(auth()->id(), 'pull.contents');

        $contentData = $this->contentService->getByParentId($parentId);

        return ResponseService::content($contentData);
    }

    /**
     * @param $childId
     * @param $type
     * @return mixed
     */
    public function getByChildIdWhereType($childId, $type)
    {
        $contentData = $this->contentService->getByChildIdWhereType($childId, $type);

        return ResponseService::content($contentData);
    }

    /** Pull contents based on content ids.
     * @param Request $request
     *
     *
     * @return Fractal
     * @throws NotAllowedException
     *
     * @permission Must be logged in
     * @permission Must have the pull.contents permission
     *
     * @queryParam ids required Example:2,1
     */
    public function getByIds(Request $request)
    {
        $this->permissionPackageService->canOrThrow(auth()->id(), 'pull.contents');

        $contentData = $this->contentService->getByIds(explode(',', $request->get('ids', '')));

        return ResponseService::content($contentData);
    }

    /**
     * @param $id
     * @return Fractal
     * @throws Throwable
     * @throws NonUniqueResultException
     * @queryParam id required Example:1
     */
    public function show($id)
    {
        $content = $this->contentService->getById($id);

        throw_unless($content, new NotFoundException('No content with id ' . $id . ' exists.'));

        return ResponseService::content([$content->getId() => $content]);
    }

    /** Create a new content
     *
     * @param ContentCreateRequest $request
     * @return JsonResponse
     * @throws DBALException
     * @throws NotAllowedException
     * @throws ORMException
     * @throws OptimisticLockException
     * @throws ReflectionException
     *
     * @permission Must be logged in
     * @permission Must have the create.content permission to create
     */
    public function store(ContentCreateRequest $request)
    {
        $this->permissionPackageService->canOrThrow(auth()->id(), 'create.content');

        $content = $this->contentService->create(
            $request->input('data.attributes.slug'),
            $request->input('data.attributes.type'),
            $request->input('data.attributes.status'),
            $request->input('data.attributes.language', config('railcontent.default_language')),
            $request->input('data.attributes.brand', config('railcontent.brand')),
            $request->input('data.relationships.user.data.id'),
            $request->input('data.attributes.published_on'),
            $request->input('data.relationships.parent.data.id'),
            $request->input('data.attributes.sort', 0),
            $request->input('data.attributes.fields')
        );

        $sm = SearchEntityManager::get();

        return ResponseService::content($content)
            ->respond(201);

    }

    /** Update an existing content.
     *
     * @param ContentUpdateRequest $request
     * @param $contentId
     * @return JsonResponse
     * @throws DBALException
     * @throws NotAllowedException
     * @throws ORMException
     * @throws OptimisticLockException
     * @throws ReflectionException
     * @throws Throwable
     *
     * @permission Must be logged in
     * @permission Must have the update.content permission to update
     *
     * @queryParam content_id required Example:1
     */
    public function update(ContentUpdateRequest $request, $contentId)
    {

        $this->permissionPackageService->canOrThrow(auth()->id(), 'update.content');

        $content = $this->contentService->update(
            $contentId,
            $request->onlyAllowed()
        );

        //if the content not exist; we throw the proper exception
        throw_if(
            is_null($content),
            new NotFoundException('Update failed, content not found with id: ' . $contentId)
        );

        return ResponseService::content($content)
            ->respond(200);
    }

    /** Delete an existing content and content related links.
     *
     * The content related links are: links with the parent, content childrens, content fields, content datum, links with the permissions, content comments, replies and assignation and links with the playlists.
     *
     * @param $contentId
     * @return JsonResponse
     * @throws NotAllowedException
     * @throws ORMException
     * @throws OptimisticLockException
     *
     * @permission Must be logged in
     * @permission Must have the delete.content permission
     * @queryParam id required Content that will be deleted. Example:2
     */
    public function delete($contentId)
    {
        $this->permissionPackageService->canOrThrow(auth()->id(), 'delete.content');

        $delete = $this->contentService->delete($contentId);

        if (!is_null($delete)) {
            return ResponseService::empty(204);
        }
        return ResponseService::empty(404);

    }

    /**
     * @param Request $request
     * @return mixed
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

    /** Soft delete existing content
     *
     * If a content it's soft deleted the API will automatically filter it out from the pull request unless the status set on the pull requests explicitly state otherwise.
     *
     * @param $contentId
     * @return JsonResponse
     * @throws NotAllowedException
     * @throws ORMException
     * @throws OptimisticLockException
     * @throws Throwable
     *
     * @permission Must be logged in
     * @permission Must have the delete.content permission
     * @queryParam id required Content Example:2
     */
    public function softDelete($contentId)
    {
        $this->permissionPackageService->canOrThrow(auth()->id(), 'delete.content');

        //delete content
        $delete = $this->contentService->softDelete($contentId);

        //if the delete method response it's null the content not exist; we throw the proper exception
        throw_if(
            is_null($delete),
            new NotFoundException('Delete failed, content not found with id: ' . $contentId)
        );

        return ResponseService::empty(204);
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function getInProgressContent(Request $request)
    {
        $lessons = new ContentFilterResultsEntity([]);

        $types = $request->get('included_types', []);
        $limit = $request->get('limit', 10);
        $page = $request->get('page', 1);

        if (in_array('shows', $types)) {
            $types = array_merge($types, array_values(config('railcontent.showTypes', [])));
        }

        $requiredFields = [];
        foreach ($request->get('required_fields', []) as $filter) {
            $criteria = explode(',', $filter);
            $requiredFields[] = ['name' => $criteria[0], 'value' => $criteria[1], 'operator' => '='];
        }

        if (!empty($types)) {
            $lessons = $this->contentService->getPaginatedByTypesRecentUserProgressState(
                $types,
                auth()->id(),
                'started',
                $limit,
                $page - 1,
                $requiredFields
            );

            if (!empty($lessons->results())) {
                $contentTypes = array_map(
                    function ($res) {
                        return $res->getType();
                    },
                    $lessons->results()
                );

                $filterTypes = ['content_type' => array_unique($contentTypes)];
            }
        }

        return ResponseService::content(
            $lessons->results(),
            $lessons->qb(),
            [],
            array_merge($lessons->filterOptions(), $filterTypes ?? [])
        )
            ->respond();
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function getOurPicksContent(Request $request)
    {
        $staffPicks = new ContentFilterResultsEntity([]);

        $types = $request->get('included_types', []);
        $limit = $request->get('limit', 10);
        $page = $request->get('page', 1);

        if (in_array('shows', $types)) {
            $types = array_merge($types, array_values(config('railcontent.showTypes', [])));
        }

        $field = ($request->has('is_home')) ? 'homeStaffPickRating' : 'staffPickRating';

        if (!empty($types)) {
            $staffPicks = $this->contentService->getFiltered(
                $page,
                $limit,
                $field,
                $types,
                [],
                [],
                [$field . ',20,integer,<=']
            );
        }

        return ResponseService::content(
            $staffPicks->results(),
            $staffPicks->qb(),
            [],
            $staffPicks->filterOptions()
        )
            ->respond();
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function getAllContent(Request $request)
    {
        $results = new ContentFilterResultsEntity([]);

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
        }

        return ResponseService::content(
            $results->results(),
            $results->qb(),
            [],
            $results->filterOptions()
        )
            ->respond();
    }
}