<?php

namespace Railroad\Railcontent\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Railroad\Permissions\Services\PermissionService;
use Railroad\Railcontent\Exceptions\NotFoundException;
use Railroad\Railcontent\Repositories\ContentRepository;
use Railroad\Railcontent\Requests\ContentCreateRequest;
use Railroad\Railcontent\Requests\ContentUpdateRequest;
use Railroad\Railcontent\Services\ContentService;
use Railroad\Railcontent\Services\ResponseService;

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
     * ContentController constructor.
     *
     * @param ContentService $contentService
     */
    public function __construct(
        ContentService $contentService,
        PermissionService $permissionPackageService
    ) {
        $this->contentService = $contentService;
        $this->permissionPackageService = $permissionPackageService;

        $this->middleware(config('railcontent.controller_middleware'));
    }

    /**
     * @param Request $request
     * @return JsonPaginatedResponse
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

        return ResponseService::content($contentData['results'], $contentData['qb'], [], $contentData['filter_options'])->respond();
    }

    /** Pull the children contents for the parent id
     *
     * @param integer $parentId
     * @return JsonResponse
     */
    public function getByParentId($parentId)
    {
        $this->permissionPackageService->canOrThrow(auth()->id(), 'pull.contents');

        $contentData = $this->contentService->getByParentId($parentId);

        return ResponseService::content($contentData);
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function getByIds(Request $request)
    {
        $this->permissionPackageService->canOrThrow(auth()->id(), 'pull.contents');

        $contentData = $this->contentService->getByIds(explode(',', $request->get('ids', '')));

        return ResponseService::content($contentData);
    }

    /**
     * @param $id
     * @return JsonResponse
     */
    public function show($id)
    {
        $content = $this->contentService->getById($id);

        throw_unless($content, new NotFoundException('No content with id ' . $id . ' exists.'));

        return ResponseService::content($content);
    }

    /**
     * Create a new content and return it in JSON format
     *
     * @param ContentUpdateRequest $request
     * @return JsonResponse
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
     * @param integer $contentId
     * @param ContentUpdateRequest $request
     * @return JsonResponse
     * @throws \Throwable
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

    /**
     * Call the delete method if the content exist
     *
     * @param integer $contentId
     * @return JsonResponse
     * @throws \Throwable
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
}