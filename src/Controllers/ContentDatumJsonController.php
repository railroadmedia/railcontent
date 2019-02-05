<?php

namespace Railroad\Railcontent\Controllers;

use Illuminate\Routing\Controller;
use Railroad\Railcontent\Exceptions\NotFoundException;
use Railroad\Railcontent\Requests\ContentDatumCreateRequest;
use Railroad\Railcontent\Requests\ContentDatumDeleteRequest;
use Railroad\Railcontent\Requests\ContentDatumUpdateRequest;
use Railroad\Railcontent\Services\ConfigService;
use Railroad\Railcontent\Services\ContentDatumService;
use Railroad\Railcontent\Services\ContentService;
use Railroad\Railcontent\Transformers\DataTransformer;

class ContentDatumJsonController extends Controller
{
    private $datumService;

    /**
     * @var ContentService
     */
    private $contentService;

    /**
     * DatumController constructor.
     *
     * @param ContentDatumService $datumService
     */
    public function __construct(
        ContentDatumService $datumService,
        ContentService $contentService
    )
    {
        $this->datumService = $datumService;
        $this->contentService = $contentService;

        $this->middleware(ConfigService::$controllerMiddleware);
    }

    /**
     * Call the method from service that create new data and link the content with the data.
     *
     * @param ContentDatumCreateRequest $request
     * @return JsonResponse
     */
    public function store(ContentDatumCreateRequest $request)
    {
        $contentData = $this->datumService->create(
            $request->input('content_id'),
            $request->input('key'),
            $request->input('value'),
            $request->input('position')
        );

        $content_id = $request->input('content_id');
        $currentContent = $this->contentService->getById($content_id);
        $data = ["datum" => $contentData, "post" => $currentContent];

        return response()->json(
            $data,
            201,
            [
                'Content-Type' => 'application/vnd.api+json'
            ]
        );
    }

    /**
     * Call the method from service to update a content datum
     *
     * @param integer $dataId
     * @param ContentDatumUpdateRequest $request
     * @return JsonResponse
     * @throws \Throwable
     */
    public function update($dataId, ContentDatumUpdateRequest $request)
    {
        $contentData = $this->datumService->update(
            $dataId,
            $request->only(
                [
                    'content_id',
                    'key',
                    'value',
                    'position',
                ]
            )
        );

        //if the update method response it's null the datum not exist; we throw the proper exception
        throw_if(
            is_null($contentData),
            new NotFoundException('Update failed, datum not found with id: ' . $dataId)
        );

        $content_id = $request->input('content_id');
        $currentContent = $this->contentService->getById($content_id);
        $data = ["datum" => $contentData, "post" => $currentContent];

        return response()->json(
            $data,
            200,
            [
                'Content-Type' => 'application/vnd.api+json'
            ]
        );
    }

    /**
     * Call the method from service to delete the content data
     *
     * @param integer $dataId
     * @return JsonResponse
     *
     * Hmm... we're not actually using that request in here, but including it triggers the prepending validation, so
     * maybe it needs to be there for that?
     *
     * Jonathan, February 2018
     */
    public function delete(ContentDatumDeleteRequest $request, $dataId)
    {
        $deleted = $this->datumService->delete($dataId);

        $content_id = $request->input('content_id');
        $currentContent = $this->contentService->getById($content_id);
        $data = ["post" => $currentContent];

        //if the update method response it's null the datum not exist; we throw the proper exception
        throw_if(
            is_null($deleted),
            new NotFoundException('Delete failed, datum not found with id: ' . $dataId)
        );

        return response()->json(
            $data,
            202,
            [
                'Content-Type' => 'application/vnd.api+json'
            ]
        );

//        return reply()->json($data, ['code' => 202]);
    }
}