<?php

namespace Railroad\Railcontent\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Railroad\Railcontent\Events\ContentUpdated;
use Railroad\Railcontent\Requests\FieldRequest;
use Railroad\Railcontent\Services\ContentFieldService;

class FieldJsonController extends Controller
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
     * @param FieldRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(FieldRequest $request)
    {
        //Fire an event that the content was modified
        event(new ContentUpdated($request->input('content_id')));

        $categoryField = $this->fieldService->createField(
            $request->input('content_id'),
            $request->input('key'),
            $request->input('value'),
            $request->input('position'),
            $request->input('type')
        );

        return response()->json($categoryField, 200);
    }

    /**
     * Call the method from service to update a content field
     *
     * @param integer $fieldId
     * @param FieldRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function update($fieldId, FieldRequest $request)
    {
        //Check if field exist in the database
        $field = $this->fieldService->getField($fieldId, $request->input('content_id'));

        if (is_null($field)) {
            return response()->json('Update failed, field not found with id: ' . $field, 404);
        }

        //Save a content version
        event(new ContentUpdated($request->input('content_id')));

        $contentField = $this->fieldService->updateField(
            $request->input('content_id'),
            $fieldId,
            $request->input('key'),
            $request->input('value'),
            $request->input('type'),
            $request->input('position')
        );

        return response()->json($contentField, 201);
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

        return response()->json($deleted, 200);
    }
}