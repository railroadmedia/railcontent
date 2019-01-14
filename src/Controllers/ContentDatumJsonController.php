<?php

namespace Railroad\Railcontent\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Routing\Controller;
use Railroad\Permissions\Services\PermissionService;
use Railroad\Railcontent\Exceptions\NotFoundException;
use Railroad\Railcontent\Requests\ContentDatumCreateRequest;
use Railroad\Railcontent\Requests\ContentDatumDeleteRequest;
use Railroad\Railcontent\Requests\ContentDatumUpdateRequest;
use Railroad\Railcontent\Services\ConfigService;
use Railroad\Railcontent\Services\ContentDatumService;
use Railroad\Railcontent\Transformers\DataTransformer;

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
     * DatumController constructor.
     *
     * @param ContentDatumService $datumService
     */
    public function __construct(ContentDatumService $datumService, PermissionService $permissionPackageService)
    {
        $this->datumService = $datumService;
        $this->permissionPackageService = $permissionPackageService;

        $this->middleware(ConfigService::$controllerMiddleware);
    }

    /**
     * Call the method from service that create new data and link the content with the data.
     *
     * @param ContentDatumCreateRequest $request
     * @return JsonResponse
     * @throws \Railroad\Permissions\Exceptions\NotAllowedException
     */
    public function store(ContentDatumCreateRequest $request)
    {
        $this->permissionPackageService->canOrThrow(auth()->id(), 'create.content.data');

        $contentData = $this->datumService->create(
            $request->input('content_id'),
            $request->input('key'),
            $request->input('value'),
            $request->input('position')
        );

        return reply()->json(
            [$contentData],
            [
                'transformer' => DataTransformer::class,
            ]
        );
    }

    /**
     * Call the method from service to update a content datum
     *
     * @param integer $dataId
     * @param ContentDatumUpdateRequest $request
     * @return JsonResponse
     * @throws \Throwable
     */
    public function update($dataId, ContentDatumUpdateRequest $request)
    {
        $this->permissionPackageService->canOrThrow(auth()->id(), 'update.content.data');

        $contentData = $this->datumService->update(
            $dataId,
            $request->only(
                [
                    'content_id',
                    'key',
                    'value',
                    'position',
                ]
            )
        );

        throw_if(
            is_null($contentData),
            new NotFoundException('Update failed, datum not found with id: ' . $dataId)
        );

        return reply()->json(
            [$contentData],
            [
                'transformer' => DataTransformer::class,
                'code' => 201,
            ]
        );
    }

    /**
     * Call the method from service to delete the content data
     *
     * @param ContentDatumDeleteRequest $request
     * @param integer $dataId
     * @return JsonResponse
     * @throws \Railroad\Permissions\Exceptions\NotAllowedException
     * @throws \Throwable
     */
    public function delete(ContentDatumDeleteRequest $request, $dataId)
    {
        $this->permissionPackageService->canOrThrow(auth()->id(), 'delete.content.data');

        $deleted = $this->datumService->delete($dataId);

        throw_if(
            !$deleted,
            new NotFoundException('Delete failed, datum not found with id: ' . $dataId)
        );

        return reply()->json(null, ['code' => 204]);
    }
}