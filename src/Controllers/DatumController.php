<?php

namespace Railroad\Railcontent\Controllers;

use Illuminate\Routing\Controller;
use Illuminate\Http\Request;
use Railroad\Railcontent\Requests\DatumRequest;
use Railroad\Railcontent\Services\ConfigService;
use Railroad\Railcontent\Services\DatumService;

class DatumController extends Controller
{
    private $datumService;

    public function __construct(DatumService $datumService)
    {
        $this->datumService = $datumService;
    }

    /**
     * Call the method from service that create new data and link the category with the data.
     * @param DatumRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(DatumRequest $request)
    {
        $categoryData = $this->datumService->createSubjectDatum(
            $request->input('category_id'),
            null,
            $request->input('key'),
            $request->input('value'),
            ConfigService::$subjectTypeCategory
        );

        return response()->json($categoryData, 200);
    }

    /**
     * Call the method from service to update a category datum
     * @param integer $dataId
     * @param DatumRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function update($dataId, DatumRequest $request)
    {
        $categoryData = $this->datumService->updateSubjectDatum(
            $request->input('category_id'),
            $dataId,
            $request->input('key'),
            $request->input('value'),
            ConfigService::$subjectTypeCategory
        );

        return response()->json($categoryData, 201);
    }

    /**
     * Call the method from service to delete the category's data
     * @param integer $dataId
     * @param Request $request
     */
    public function delete($dataId,Request $request)
    {
        $categoryData = $this->datumService->deleteSubjectDatum(
            $dataId,
            $request->input('category_id'),
            ConfigService::$subjectTypeCategory
        );

        return response()->json($categoryData,200);
    }
}