<?php

namespace Railroad\Railcontent\Controllers;

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
}
