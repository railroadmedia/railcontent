<?php

namespace Railroad\Railcontent\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Railroad\Railcontent\Services\ConfigService;
use Railroad\Railcontent\Services\FieldService;
use Railroad\Railcontent\Requests\FieldRequest;
use Railroad\Railcontent\Events\ContentUpdated;

class FieldController extends Controller
{
    private $fieldService;

    public function __construct(FieldService $fieldService)
    {
        $this->fieldService = $fieldService;
    }

    /**
     * Call the method from service that create a new field and link the category with the field.
     * @param FieldRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(FieldRequest $request)
    {
        //Fire an event that the content was modified
        event(new ContentUpdated($request->input('content_id')));

        $categoryField = $this->fieldService->createField(
            $request->input('content_id'),
            null,
            $request->input('key'),
            $request->input('value'),
            $request->input('type'),
            $request->input('position')
        );

        return response()->json($categoryField, 200);
    }

    /**
     * Call the method from service to update a content field
     * @param integer $fieldId
     * @param FieldRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function update($fieldId, FieldRequest $request)
    {
        $field = $this->fieldService->getField($fieldId,  $request->input('content_id'));

        if (is_null($field)) {
            return response()->json('Update failed, field not found with id: ' . $field, 404);
        }

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
     * @param integer $fieldId
     * @param Request $request
     */
    public function delete($fieldId, Request $request)
    {
        event(new ContentUpdated($request->input('content_id')));

        $deleted = $this->fieldService->deleteField(
            $fieldId,
            $request->input('content_id')
        );

        if (!$deleted) {
            return response()->json('Delete failed, content field not found with id: ' . $fieldId, 404);
        }

        return response()->json($deleted,200);
    }
}