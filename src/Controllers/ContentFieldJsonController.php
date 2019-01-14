<?php

namespace Railroad\Railcontent\Controllers;

use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Railroad\Permissions\Services\PermissionService;
use Railroad\Railcontent\Exceptions\NotFoundException;
use Railroad\Railcontent\Requests\ContentFieldCreateRequest;
use Railroad\Railcontent\Requests\ContentFieldDeleteRequest;
use Railroad\Railcontent\Requests\ContentFieldUpdateRequest;
use Railroad\Railcontent\Services\ConfigService;
use Railroad\Railcontent\Services\ContentFieldService;
use Railroad\Railcontent\Transformers\DataTransformer;

class ContentFieldJsonController extends Controller
{
    use ValidatesRequests;

    /**
     * @var ContentFieldService
     */
    private $fieldService;

    /**
     * @var PermissionService
     */
    private $permissionPackageService;

    /**
     * FieldController constructor.
     *
     * @param ContentFieldService $fieldService
     * @param PermissionService $permissionPackageService
     */
    public function __construct(ContentFieldService $fieldService, PermissionService $permissionPackageService)
    {
        $this->fieldService = $fieldService;
        $this->permissionPackageService = $permissionPackageService;

        $this->middleware(ConfigService::$controllerMiddleware);
    }

    /**
     * Call the method from service that create a new field and link the content with the field.
     *
     * @param Request $request
     * @param $id
     * @return JsonResponse
     */
    public function show(Request $request, $id)
    {
        $contentField = $this->fieldService->get($id);

        return reply()->json(
            [$contentField],
            [
                'transformer' => DataTransformer::class,
            ]
        );
    }

    /**
     * Call the method from service that create a new field and link the content with the field.
     *
     * @param ContentFieldCreateRequest $request
     * @return JsonResponse
     * @throws \Railroad\Permissions\Exceptions\NotAllowedException
     */
    public function store(ContentFieldCreateRequest $request)
    {
        $this->permissionPackageService->canOrThrow(auth()->id(), 'create.content.field');

        $contentField = $this->fieldService->create(
            $request->input('content_id'),
            $request->input('key'),
            $request->input('value'),
            $request->input('position'),
            $request->input('type')
        );

        return reply()->json(
            [$contentField],
            [
                'transformer' => DataTransformer::class,
            ]
        );
    }

    /**
     * Call the method from service to update a content datum
     *
     * @param integer $dataId
     * @param ContentFieldUpdateRequest $request
     * @return JsonResponse
     * @throws \Railroad\Permissions\Exceptions\NotAllowedException
     * @throws \Throwable
     */
    public function update($dataId, ContentFieldUpdateRequest $request)
    {
        $this->permissionPackageService->canOrThrow(auth()->id(), 'update.content.field');

        $contentField = $this->fieldService->update(
            $dataId,
            $request->only(
                [
                    'content_id',
                    'key',
                    'value',
                    'position',
                    'type',
                ]
            )
        );

        throw_if(
            is_null($contentField),
            new NotFoundException('Update failed, field not found with id: ' . $dataId)
        );

        return reply()->json(
            [$contentField],
            [
                'transformer' => DataTransformer::class,
                'code' => 201,
            ]
        );
    }

    /**
     * Call the method from service to delete the content's field
     *
     * @param ContentFieldDeleteRequest $request
     * @param integer $fieldId
     * @return JsonResponse
     * @throws \Railroad\Permissions\Exceptions\NotAllowedException
     * @throws \Throwable
     */
    public function delete(ContentFieldDeleteRequest $request, $fieldId)
    {
        $this->permissionPackageService->canOrThrow(auth()->id(), 'delete.content.field');

        $deleted = $this->fieldService->delete($fieldId);

        throw_if(
            !$deleted,
            new NotFoundException('Delete failed, field not found with id: ' . $fieldId)
        );

        return reply()->json(null, ['code' => 204]);
    }
}