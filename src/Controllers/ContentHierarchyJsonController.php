<?php

namespace Railroad\Railcontent\Controllers;

use Doctrine\ORM\OptimisticLockException;
use Doctrine\ORM\ORMException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Railroad\Permissions\Exceptions\NotAllowedException;
use Railroad\Permissions\Services\PermissionService;
use Railroad\Railcontent\Requests\ContentHierarchyCreateRequest;
use Railroad\Railcontent\Services\ContentHierarchyService;
use Railroad\Railcontent\Services\ResponseService;
use Spatie\Fractal\Fractal;
use Railroad\Railcontent\Contracts\UserProviderInterface;

/**
 * Class ContentHierarchyJsonController
 *
 * @group Hierarchy API
 *
 * @package Railroad\Railcontent\Controllers
 */
class ContentHierarchyJsonController extends Controller
{
    /**
     * @var ContentHierarchyService
     */
    private $contentHierarchyService;

    /**
     * @var PermissionService
     */
    private $permissionPackageService;

    /**
     * @var UserProviderInterface
     */
    private $userProvider;

    /**
     * ContentHierarchyJsonController constructor.
     *
     * @param ContentHierarchyService $contentHierarchyService
     * @param PermissionService $permissionPackageService
     */
    public function __construct(
        ContentHierarchyService $contentHierarchyService,
        PermissionService $permissionPackageService,
        UserProviderInterface $userProvider
    ) {
        $this->userProvider = $userProvider;
        $this->contentHierarchyService = $contentHierarchyService;
        $this->permissionPackageService = $permissionPackageService;
    }

    /** Create/update a content hierarchy.
     *
     * @param ContentHierarchyCreateRequest $request
     * @return Fractal
     * @throws ORMException
     * @throws OptimisticLockException
     * @throws NotAllowedException
     *
     * @permission Must be logged in
     * @permission Must have the create.content.hierarchy permission
     */
    public function store(ContentHierarchyCreateRequest $request)
    {
        $this->permissionPackageService->canOrThrow(auth()->id(), 'create.content.hierarchy');

        $hierarchy = $this->contentHierarchyService->createOrUpdateHierarchy(
            $request->input('data.relationships.parent.data.id'),
            $request->input('data.relationships.child.data.id'),
            $request->input('data.attributes.child_position')
        );

        return ResponseService::contentHierarchy($hierarchy);
    }

    /** Delete the link between parent content and child content and reposition other children.
     *
     * @param Request $request
     * @param $parentId
     * @param $childId
     * @return JsonResponse
     * @throws NotAllowedException
     * @throws ORMException
     * @throws OptimisticLockException
     *
     * @permission Must be logged in
     * @permission Must have the delete.content.hierarchy permission
     * @queryParam parentId required
     * @queryParam childId required
     */
    public function delete(Request $request, $parentId, $childId)
    {
//        $this->permissionPackageService->canOrThrow(auth()->id(), 'delete.content.hierarchy');

        $this->contentHierarchyService->delete($parentId, $childId);

        return ResponseService::empty(204);
    }
}