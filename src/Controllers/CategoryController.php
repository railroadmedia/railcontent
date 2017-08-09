<?php

namespace Railroad\Railcontent\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Railroad\Railcontent\Requests\CategoryRequest;
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
}
