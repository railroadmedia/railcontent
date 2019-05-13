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
use Railroad\Railcontent\Repositories\ContentRepository;
use Railroad\Railcontent\Requests\ContentCreateRequest;
use Railroad\Railcontent\Requests\ContentUpdateRequest;
use Railroad\Railcontent\Services\ContentService;
use Railroad\Railcontent\Services\ResponseService;
use ReflectionException;
use Spatie\Fractal\Fractal;
use Throwable;

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
     */
    public function index(Request $request)
    {
        $this->permissionPackageService->canOrThrow(auth()->id(), 'pull.contents');

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

        return ResponseService::content(
            $contentData->results(),
            $contentData->qb(),
            [],
            $contentData->filterOptions()
        )
            ->respond();
    }

    /** Pull the children contents for the parent id
     *
     * @param $parentId
     * @return Fractal
     * @throws NotAllowedException
     */
    public function getByParentId($parentId)
    {
        $this->permissionPackageService->canOrThrow(auth()->id(), 'pull.contents');

        $contentData = $this->contentService->getByParentId($parentId);

        return ResponseService::content($contentData);
    }

    /**
     * @param Request $request
     * @return Fractal
     * @throws NotAllowedException
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
     */
    public function show($id)
    {
        $content = $this->contentService->getById($id);

        throw_unless($content, new NotFoundException('No content with id ' . $id . ' exists.'));

        return ResponseService::content($content);
    }

    /** Create a new content and return it in JSON format
     *
     * @param ContentCreateRequest $request
     * @return JsonResponse
     * @throws DBALException
     * @throws NotAllowedException
     * @throws ORMException
     * @throws OptimisticLockException
     * @throws ReflectionException
     */
    public function store(ContentCreateRequest $request)
    {
        $this->permissionPackageService->canOrThrow(auth()->id(), 'create.content');

        $content = $this->contentService->create(
            $request->onlyAllowed()
        );

        return ResponseService::content($content)
            ->respond(201);

    }

    /** Update a content based on content id and return it in JSON format
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

    /** Call the delete method if the content exist
     *
     * @param $contentId
     * @return JsonResponse
     * @throws NotAllowedException
     * @throws ORMException
     * @throws OptimisticLockException
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

    /** Call the soft delete method if the content exist
     *
     * @param $contentId
     * @return JsonResponse
     * @throws NotAllowedException
     * @throws ORMException
     * @throws OptimisticLockException
     * @throws Throwable
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
            $types = array_merge($types, array_keys(config('railcontent.shows')));
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
            $types = array_merge($types, array_keys(config('railcontent.shows')));
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
            if (array_key_exists($type, config('railcontent.shows', []))) {
                $sortedBy = config('railcontent.shows')[$type]['sortedBy'];
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