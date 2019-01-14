<?php

namespace Railroad\Railcontent\Controllers;

use Illuminate\Routing\Controller;
use JMS\Serializer\SerializerBuilder;
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

    private $serializer;

    /**
     * DatumController constructor.
     *
     * @param ContentDatumService $datumService
     */
    public function __construct(ContentDatumService $datumService, PermissionService $permissionPackageService)
    {
        $this->datumService = $datumService;
        $this->permissionPackageService = $permissionPackageService;

        $this->serializer =
            SerializerBuilder::create()
                ->build();

        $this->middleware(ConfigService::$controllerMiddleware);
    }

    /**
     * Call the method from service that create new data and link the content with the data.
     *
     * @param ContentDatumCreateRequest $request
     * @return JsonResponse
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

        return response($this->serializer->serialize(['data' => [$contentData]], 'json'));

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

        //if the update method response it's null the datum not exist; we throw the proper exception
        throw_if(
            is_null($contentData),
            new NotFoundException('Update failed, datum not found with id: ' . $dataId)
        );
        return response($this->serializer->serialize(['data' => [$contentData]], 'json'), 201);

//        return reply()->json(
//            [$contentData],
//            [
//                'transformer' => DataTransformer::class,
//                'code' => 201,
//            ]
//        );
    }

    /**
     * Call the method from service to delete the content data
     *
     * @param integer $dataId
     * @return JsonResponse
     *
     * Hmm... we're not actually using that request in here, but including it triggers the prepending validation, so
     * maybe it needs to be there for that?
     *
     * Jonathan, February 2018
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

        return reply()->json(null, ['code' => 204]);
    }
}