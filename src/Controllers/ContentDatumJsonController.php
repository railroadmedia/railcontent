<?php

namespace Railroad\Railcontent\Controllers;

use Doctrine\ORM\OptimisticLockException;
use Doctrine\ORM\ORMException;
use Illuminate\Http\JsonResponse;
use Illuminate\Routing\Controller;
use Railroad\Permissions\Exceptions\NotAllowedException;
use Railroad\Permissions\Services\PermissionService;
use Railroad\Railcontent\Exceptions\NotFoundException;
use Railroad\Railcontent\Requests\ContentDatumCreateRequest;
use Railroad\Railcontent\Requests\ContentDatumDeleteRequest;
use Railroad\Railcontent\Requests\ContentDatumUpdateRequest;
use Railroad\Railcontent\Services\ContentDatumService;
use Railroad\Railcontent\Services\ResponseService;
use Spatie\Fractal\Fractal;
use Throwable;

class ContentDatumJsonController extends Controller
{
    /**
     * @var ContentDatumService
     */
    private $datumService;

    /**
     * @var PermissionService
     */
    private $permissionPackageService;

    /**
     * ContentDatumJsonController constructor.
     *
     * @param ContentDatumService $datumService
     * @param PermissionService $permissionPackageService
     */
    public function __construct(ContentDatumService $datumService, PermissionService $permissionPackageService)
    {
        $this->datumService = $datumService;
        $this->permissionPackageService = $permissionPackageService;
    }

    /** Call the method from service that create new data and link the content with the data.
     *
     * @param ContentDatumCreateRequest $request
     * @return Fractal
     * @throws NotAllowedException
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function store(ContentDatumCreateRequest $request)
    {
        $this->permissionPackageService->canOrThrow(auth()->id(), 'create.content.data');

        $contentData = $this->datumService->create(
            $request->input('data.relationships.content.data.id'),
            $request->input('data.attributes.key'),
            $request->input('data.attributes.value'),
            $request->input('data.attributes.position')
        );

        return ResponseService::contentData($contentData);
    }

    /** Call the method from service to update a content datum
     *
     * @param $dataId
     * @param ContentDatumUpdateRequest $request
     * @return JsonResponse
     * @throws NotAllowedException
     * @throws Throwable
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function update($dataId, ContentDatumUpdateRequest $request)
    {
        $this->permissionPackageService->canOrThrow(auth()->id(), 'update.content.data');

        $contentData = $this->datumService->update(
            $dataId,
            $request->onlyAllowed()
        );

        //if the update method response it's null the datum not exist; we throw the proper exception
        throw_if(
            is_null($contentData),
            new NotFoundException('Update failed, datum not found with id: ' . $dataId)
        );
        return ResponseService::contentData($contentData)
            ->respond(201);

    }

    /** Call the method from service to delete the content data
     *
     * @param ContentDatumDeleteRequest $request
     * @param $dataId
     * @return JsonResponse
     * @throws NotAllowedException
     * @throws Throwable
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function delete(ContentDatumDeleteRequest $request, $dataId)
    {
        $this->permissionPackageService->canOrThrow(auth()->id(), 'delete.content.data');

        $deleted = $this->datumService->delete($dataId);

        //if the update method response it's null the datum not exist; we throw the proper exception
        throw_if(
            is_null($deleted),
            new NotFoundException('Delete failed, datum not found with id: ' . $dataId)
        );
        return ResponseService::empty(204);

    }
}