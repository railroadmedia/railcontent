<?php

namespace Railroad\Railcontent\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Railroad\Railcontent\Requests\CategoryRequest;
use Railroad\Railcontent\Requests\FieldRequest;
use Railroad\Railcontent\Services\CategoryService;

class CategoryController extends Controller
{
    private $categoryService;

    public function __construct(CategoryService $categoryService)
    {
        $this->categoryService = $categoryService;
    }

    /** Create a new category and return it in JSON format
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(CategoryRequest $request)
    {
        $category = $this->categoryService->create(
            $request->input('slug'),
            $request->input('parentId'),
            $request->input('position'));

        return response()->json($category,200);
    }

    /** Update a category based on category id and return it in JSON format
     * @param integer $categoryId
     * @param CategoryRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function update($categoryId, CategoryRequest $request)
    {
        $category = $this->categoryService->get($categoryId);

        if(is_null($category))
        {
            return response()->json('Category not found',404);
        }

        $category = $this->categoryService->update(
            $categoryId,
            $request->input('slug'),
            $request->input('position')
        );

        return response()->json($category,201);
    }

    /**
     * Call the delete method if the category exist
     * @param integer $categoryId
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function delete($categoryId, Request $request)
    {
        $category = $this->categoryService->get($categoryId);

        if(is_null($category))
        {
            return response()->json('Category not found',404);
        }

        $category = $this->categoryService->delete(
            $categoryId,
            $request->input('deleteChildren')
        );

        return response()->json($category,200);
    }

    /**
     * Create a new field and link category with the new created field.
     * @param FieldRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function createCategoryField(FieldRequest $request)
    {
        $categoryField = $this->categoryService->createCategoryField(
            $request->input('category_id'),
            null,
            $request->input('key'),
            $request->input('value')
        );

        return response()->json($categoryField, 200);
    }

    /**
     * Call the method from service to update a category field
     * @param integer $fieldId
     * @param FieldRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function updateCategoryField($fieldId, FieldRequest $request)
    {
        $categoryField = $this->categoryService->updateCategoryField(
            $request->input('category_id'),
            $fieldId,
            $request->input('key'),
            $request->input('value')
        );

        return response()->json($categoryField, 201);
    }

    /**
     * Call the method from service to delete the category's field
     * @param integer $fieldId
     * @param Request $request
     */
    public function deleteCategoryField($fieldId,Request $request)
    {
        $categoryField = $this->categoryService->deleteCategoryField($fieldId, $request->input('category_id'));

        return response()->json($categoryField,200);
    }
}
