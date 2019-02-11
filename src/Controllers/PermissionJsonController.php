<?php

namespace Railroad\Railcontent\Controllers;

use Doctrine\ORM\EntityManager;
use Illuminate\Routing\Controller;
use Railroad\DoctrineArrayHydrator\JsonApiHydrator;
use Railroad\Permissions\Services\PermissionService;
use Railroad\Railcontent\Entities\Permission;
use Railroad\Railcontent\Exceptions\NotFoundException;
use Railroad\Railcontent\Repositories\PermissionRepository;
use Railroad\Railcontent\Requests\PermissionAssignRequest;
use Railroad\Railcontent\Requests\PermissionDissociateRequest;
use Railroad\Railcontent\Requests\PermissionRequest;
use Railroad\Railcontent\Services\ConfigService;
use Railroad\Railcontent\Services\ContentPermissionService;
use Railroad\Railcontent\Services\ResponseService;

/**
 * Class PermissionController
 *
 * @package Railroad\Railcontent\Controllers
 */
class PermissionJsonController extends Controller
{
    /**
     * @var EntityManager
     */
    private $entityManager;

    /**
     * @var PermissionRepository
     */
    private $permissionRepository;

    /**
     * @var ContentPermissionService
     */
    private $contentPermissionService;

    /**
     * @var \Railroad\Permissions\Services\PermissionService
     */
    private $permissionPackageService;

    /**
     * @var JsonApiHydrator
     */
    private $jsonApiHydrator;

    /**
     * PermissionJsonController constructor.
     *
     * @param EntityManager $entityManager
     * @param ContentPermissionService $contentPermissionService
     * @param PermissionService $permissionPackageService
     * @param JsonApiHydrator $jsonApiHydrator
     */
    public function __construct(
        EntityManager $entityManager,
        ContentPermissionService $contentPermissionService,
        PermissionService $permissionPackageService,
        JsonApiHydrator $jsonApiHydrator
    ) {
        $this->contentPermissionService = $contentPermissionService;
        $this->permissionPackageService = $permissionPackageService;
        $this->jsonApiHydrator = $jsonApiHydrator;

        $this->entityManager = $entityManager;
        $this->permissionRepository = $this->entityManager->getRepository(Permission::class);

        $this->middleware(ConfigService::$controllerMiddleware);
    }

    /**
     * Create a new permission and return it in JSON format
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function index()
    {
        $this->permissionPackageService->canOrThrow(auth()->id(), 'pull.permissions');

        $permissions = $this->permissionRepository->findAll();

        return ResponseService::permission($permissions);
    }

    /**
     * Create a new permission and return it in JSON format
     *
     * @param PermissionRequest $request
     * @return \Spatie\Fractal\Fractal
     * @throws \Doctrine\DBAL\DBALException
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     * @throws \Railroad\Permissions\Exceptions\NotAllowedException
     * @throws \ReflectionException
     */
    public function store(PermissionRequest $request)
    {
        $this->permissionPackageService->canOrThrow(auth()->id(), 'create.permission');

        $permission = new Permission();

        $this->jsonApiHydrator->hydrate($permission, $request->onlyAllowed());

        $this->entityManager->persist($permission);
        $this->entityManager->flush();

        return ResponseService::permission($permission);
    }

    /**
     * Update a permission if exist and return it in JSON format
     *
     * @param integer $id
     * @param PermissionRequest $request
     * @return JsonResponse
     * @throws \Throwable
     */
    public function update($id, PermissionRequest $request)
    {
        $this->permissionPackageService->canOrThrow(auth()->id(), 'update.permission');

        $permission = $this->permissionRepository->find($id);

        throw_unless(
            $permission,
            new NotFoundException('Update failed, permission not found with id: ' . $id)
        );

        $this->jsonApiHydrator->hydrate($permission, $request->onlyAllowed());

        $this->entityManager->flush();

        return ResponseService::permission($permission)
            ->respond(201);
    }

    /**
     * Delete a permission if exist and it's not linked with content id or content type
     *
     * @param integer $id
     * @return JsonResponse
     * @throws \Throwable
     */
    public function delete($id)
    {
        $this->permissionPackageService->canOrThrow(auth()->id(), 'delete.permission');
        $permission = $this->permissionRepository->find($id);

        throw_unless(
            $permission,
            new NotFoundException('Delete failed, permission not found with id: ' . $id)
        );

        $this->entityManager->remove($permission);
        $this->entityManager->flush();

        return ResponseService::empty(204);
    }

    /**
     * Attach permission to a specific content or to all content of a certain type
     *
     * @param PermissionAssignRequest $request
     * @return JsonResponse
     */
    public function assign(PermissionAssignRequest $request)
    {
        $this->permissionPackageService->canOrThrow(auth()->id(), 'assign.permission');

        $assignedPermission = $this->contentPermissionService->create(
            $request->input('data.relationships.content.data.id'),
            $request->input('data.attributes.content_type'),
            $request->input('data.relationships.permission.data.id')
        );
        return ResponseService::contentPermission($assignedPermission);
    }

    /**
     * Dissociate ("unattach") permissions from a specific content or all content of a certain type
     *
     * @param PermissionDissociateRequest $request
     * @return JsonResponse
     */
    public function dissociate(PermissionDissociateRequest $request)
    {
        $this->permissionPackageService->canOrThrow(auth()->id(), 'disociate.permissions');

        $dissociate = $this->contentPermissionService->dissociate(
            $request->input('data.relationships.content.data.id'),
            $request->input('data.attributes.content_type'),
            $request->input('data.relationships.permission.data.id')
        );
        return ResponseService::empty(200);
    }
}
