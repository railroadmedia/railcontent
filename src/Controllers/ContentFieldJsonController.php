<?php

namespace Railroad\Railcontent\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Railroad\Railcontent\Exceptions\NotFoundException;
use Railroad\Railcontent\Requests\ContentFieldCreateRequest;
use Railroad\Railcontent\Requests\ContentFieldDeleteRequest;
use Railroad\Railcontent\Requests\ContentFieldUpdateRequest;
use Railroad\Railcontent\Responses\JsonResponse;
use Railroad\Railcontent\Services\ContentFieldService;
use Illuminate\Foundation\Validation\ValidatesRequests;

class ContentFieldJsonController extends Controller
{
    use ValidatesRequests;

    private $fieldService;

    /**
     * FieldController constructor.
     *
     * @param ContentFieldService $fieldService
     */
    public function __construct(ContentFieldService $fieldService)
    {
        $this->fieldService = $fieldService;
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

        return new JsonResponse($contentField, 200);
    }

    /**
     * Call the method from service that create a new field and link the content with the field.
     *
     * @param ContentFieldCreateRequest $request
     * @return \Railroad\Railcontent\Responses\JsonResponse
     */
    public function store(ContentFieldCreateRequest $request)
    {
        $contentField = $this->fieldService->create(
            $request->input('content_id'),
            $request->input('key'),
            $request->input('value'),
            $request->input('position'),
            $request->input('type')
        );

        return new JsonResponse($contentField, 200);
    }

    /**
     * Call the method from service to update a content field
     *
     * @param ContentFieldUpdateRequest $request
     * @param integer $fieldId
     * @return \Railroad\Railcontent\Responses\JsonResponse
     */
    public function update(ContentFieldUpdateRequest $request, $fieldId)
    {
        $contentField = $this->fieldService->update(
            $fieldId,
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

        //if the update method response it's null the field not exist; we throw the proper exception
        throw_if(
            is_null($contentField),
            new NotFoundException('Update failed, field not found with id: ' . $fieldId)
        );

        return new JsonResponse($contentField, 201);
    }

    /**
     * Call the method from service to delete the content's field
     *
     * @param integer $fieldId
     * @param Request $request
     * @return \Railroad\Railcontent\Responses\JsonResponse
     *
     * Hmm... we're not actually using that request in here, but including it triggers the prepending validation, so
     * maybe it needs to be there for that?
     *
     * Jonathan, February 2018
     */
    public function delete(ContentFieldDeleteRequest $request, $fieldId)
    {
        $deleted = $this->fieldService->delete($fieldId);

        //if the update method response it's null the field not exist; we throw the proper exception
        throw_if(
            is_null($deleted),
            new NotFoundException('Delete failed, field not found with id: ' . $fieldId)
        );

        return new JsonResponse(null, 204);
    }
}