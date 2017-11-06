<?php

namespace Railroad\Railcontent\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Railroad\Railcontent\Events\ContentUpdated;
use Railroad\Railcontent\Events\DatumUpdate;
use Railroad\Railcontent\Requests\ContentDatumCreateRequest;
use Railroad\Railcontent\Requests\ContentDatumUpdateRequest;
use Railroad\Railcontent\Responses\JsonResponse;
use Railroad\Railcontent\Services\ContentDatumService;

class ContentDatumJsonController extends Controller
{
    private $datumService;

    /**
     * DatumController constructor.
     *
     * @param ContentDatumService $datumService
     */
    public function __construct(ContentDatumService $datumService)
    {
        $this->datumService = $datumService;
    }

    /**
     * Call the method from service that create new data and link the content with the data.
     *
     * @param ContentDatumCreateRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(ContentDatumCreateRequest $request)
    {
        //save a content version before datum creation
        // todo: rename to DatumCreated (after save to db) or ContentCreation (before save to db)
//        event(new DatumUpdate($request->input('content_id')));

        $categoryData = $this->datumService->create(
            $request->input('content_id'),
            $request->input('key'),
            $request->input('value'),
            $request->input('position')
        );

        return new JsonResponse($categoryData, 200);
    }

    /**
     * Call the method from service to update a content datum
     *
     * @param integer $dataId
     * @param ContentDatumUpdateRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function update($dataId, ContentDatumUpdateRequest $request)
    {
        //check if datum exist in the database
        $datum = $this->datumService->get($dataId);

        if (is_null($datum)) {
            return response()->json('Update failed, datum not found with id: ' . $dataId, 404);
        }

        //save a content version before datum update
        // todo: this should be after the datum is saved, or renamed to 'ContentUpdating' if its being triggered before the actual update
        event(new ContentUpdated($datum['content_id']));

        $categoryData = $this->datumService->update(
            $dataId,
            array_intersect_key(
                $request->all(),
                [
                    'content_id' => '',
                    'key' => '',
                    'value' => '',
                    'position' => '',
                ]
            )
        );

        return new JsonResponse($categoryData, 201);
    }

    /**
     * Call the method from service to delete the content data
     *
     * @param integer $dataId
     * @param Request $request
     */
    public function delete($dataId, Request $request)
    {
        //check if datum exist in the database
        $datum = $this->datumService->getDatum($dataId, $request->input('content_id'));

        if (is_null($datum)) {
            return response()->json('Delete failed, datum not found with id: ' . $dataId, 404);
        }

        //save a content version before datum deletion
        // todo: this should be after the datum is deleted and renamed to DatumDeleted
        event(new ContentUpdated($request->input('content_id')));

        $deleted = $this->datumService->deleteDatum(
            $dataId,
            $request->input('content_id')
        );

        return new JsonResponse(null, 204);
    }
}