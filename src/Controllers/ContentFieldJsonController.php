<?php

namespace Railroad\Railcontent\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Railroad\Railcontent\Events\ContentUpdated;
use Railroad\Railcontent\Requests\ContentFieldCreateRequest;
use Railroad\Railcontent\Requests\ContentFieldUpdateRequest;
use Railroad\Railcontent\Responses\JsonResponse;
use Railroad\Railcontent\Services\ContentFieldService;

class ContentFieldJsonController extends Controller
{
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
     * Call the method from service that create a new field and link the category with the field.
     *
     * @param ContentFieldCreateRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(ContentFieldCreateRequest $request)
    {
        //Fire an event that the content was modified
        event(new ContentUpdated($request->input('content_id')));

        $categoryField = $this->fieldService->create(
            $request->input('content_id'),
            $request->input('key'),
            $request->input('value'),
            $request->input('position'),
            $request->input('type')
        );

        return new JsonResponse($categoryField, 200);
    }

    /**
     * Call the method from service to update a content field
     *
     * @param ContentFieldUpdateRequest $request
     * @param integer $fieldId
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(ContentFieldUpdateRequest $request, $fieldId)
    {
        //Check if field exist in the database
        $field = $this->fieldService->get($fieldId);

        if (is_null($field)) {
            return response()->json('Update failed, field not found with id: ' . $field, 404);
        }

        //Save a content version
        event(new ContentUpdated($request->input('content_id', $field['content_id'])));

        $contentField = $this->fieldService->update(
            $fieldId,
            array_intersect_key(
                $request->all(),
                [
                    'content_id' => '',
                    'key' => '',
                    'value' => '',
                    'position' => '',
                    'type' => '',
                ]
            )
        );

        return new JsonResponse($contentField, 201);
    }

    /**
     * Call the method from service to delete the content's field
     *
     * @param integer $fieldId
     * @param Request $request
     */
    public function delete($fieldId, Request $request)
    {
        //Check if field exist in the database
        $field = $this->fieldService->getField($fieldId, $request->input('content_id'));

        if (is_null($field)) {
            return response()->json('Delete failed, content field not found with id: ' . $fieldId, 404);
        }

        //Save a content version before content modification
        event(new ContentUpdated($request->input('content_id')));

        $deleted = $this->fieldService->deleteField(
            $fieldId,
            $request->input('content_id')
        );

        return new JsonResponse(null, 204);
    }
}