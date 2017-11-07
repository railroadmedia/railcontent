<?php

namespace Railroad\Railcontent\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Railroad\Railcontent\Events\ContentUpdated;
use Railroad\Railcontent\Events\DatumUpdate;
use Railroad\Railcontent\Exceptions\NotFoundException;
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
     * @return \Railroad\Railcontent\Responses\JsonResponse
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
     * @return \Railroad\Railcontent\Responses\JsonResponse
     */
    public function update($dataId, ContentDatumUpdateRequest $request)
    {
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

        //if the update method response it's null the datum not exist; we throw the proper exception
        throw_if(is_null($categoryData), new NotFoundException('Update failed, datum not found with id: ' . $dataId));

        return new JsonResponse($categoryData, 201);
    }

    /**
     * Call the method from service to delete the content data
     *
     * @param integer $dataId
     * @param Request $request
     * @return \Railroad\Railcontent\Responses\JsonResponse
     */
    public function delete($dataId)
    {
        $deleted = $this->datumService->delete($dataId);

        //if the update method response it's null the datum not exist; we throw the proper exception
        throw_if(is_null($deleted), new NotFoundException('Delete failed, datum not found with id: ' . $dataId));

        return new JsonResponse(null, 204);
    }
}