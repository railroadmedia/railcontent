<?php

namespace Railroad\Railcontent\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Railroad\Railcontent\Services\ConfigService;
use Railroad\Railcontent\Services\CategoryService;
use Railroad\Railcontent\Services\FieldService;
use Railroad\Railcontent\Requests\FieldRequest;

class FieldController extends Controller
{
    private $fieldService;

    public function __construct(FieldService $fieldService, CategoryService $categoryService)
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
        $categoryField = $this->fieldService->createCategoryField(
            $request->input('category_id'),
            null,
            $request->input('key'),
            $request->input('value'),
            ConfigService::$subjectTypeCategory
        );

        return response()->json($categoryField, 200);
    }

    /**
     * Call the method from service to update a category field
     * @param integer $fieldId
     * @param FieldRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function category($fieldId, FieldRequest $request)
    {
        $categoryField = $this->fieldService->updateCategoryField(
            $request->input('category_id'),
            $fieldId,
            $request->input('key'),
            $request->input('value'),
            ConfigService::$subjectTypeCategory
        );

        return response()->json($categoryField, 201);
    }

    /**
     * Call the method from service to delete the category's field
     * @param integer $fieldId
     * @param Request $request
     */
    public function delete($fieldId, Request $request)
    {
        $categoryField = $this->fieldService->deleteCategoryField(
            $fieldId,
            $request->input('category_id'),
            ConfigService::$subjectTypeCategory
        );

        return response()->json($categoryField,200);
    }
}