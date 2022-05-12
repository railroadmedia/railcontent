<?php

namespace Railroad\Railcontent\Controllers;

use Illuminate\Routing\Controller;
use Railroad\Railcontent\Exceptions\NotFoundException;
use Railroad\Railcontent\Requests\ContentBpmCreateRequest;
use Railroad\Railcontent\Requests\ContentBpmUpdateRequest;
use Railroad\Railcontent\Services\ConfigService;
use Railroad\Railcontent\Services\ContentBpmService;
use Railroad\Railcontent\Services\ContentService;

class ContentBpmJsonController extends Controller
{
    /**
     * @var ContentBpmService
     */
    private $contentBpmService;
    /**
     * @var ContentService
     */
    private $contentService;

    /**
     * @param ContentBpmService $contentBpmService
     * @param ContentService $contentService
     */
    public function __construct(
        ContentBpmService $contentBpmService,
        ContentService $contentService
    ) {
        $this->contentBpmService = $contentBpmService;
        $this->contentService = $contentService;

        $this->middleware(ConfigService::$controllerMiddleware);
    }

    /**
     * @param ContentBpmCreateRequest $request
     * @return \Illuminate\Http\JsonResponse
     * @throws \Doctrine\ORM\NonUniqueResultException
     */
    public function store(ContentBpmCreateRequest $request)
    {
        $contentData = $this->contentBpmService->create(
            $request->input('content_id'),
            $request->input('value'),
            $request->input('position')
        );

        $content_id = $request->input('content_id');
        $currentContent = $this->contentService->getById($content_id);
        $extraColumns = config('railcontent.contentColumnNamesForFields', []);
        foreach ($extraColumns as $extraColumn) {
            if (isset($currentContent[$extraColumn])) {
                unset($currentContent[$extraColumn]);
            }
        }
        $data = ["bpm" => $contentData, "post" => $currentContent];

        return response()->json($data, 201, [
            'Content-Type' => 'application/vnd.api+json',
        ]);
    }

    /**
     * @param $id
     * @param ContentBpmUpdateRequest $request
     * @return \Illuminate\Http\JsonResponse
     * @throws \Doctrine\ORM\NonUniqueResultException
     * @throws \Throwable
     */
    public function update($id, ContentBpmUpdateRequest $request)
    {
        $contentData = $this->contentBpmService->update(
            $id,
            $request->only([
                               'content_id',
                               'value',
                               'position',
                           ])
        );

        //if the update method response it's null the datum not exist; we throw the proper exception
        throw_if(
            is_null($contentData),
            new NotFoundException('Update failed, bpm not found with id: '.$id)
        );

        $content_id = $request->input('content_id');
        $currentContent = $this->contentService->getById($content_id);
        $extraColumns = config('railcontent.contentColumnNamesForFields', []);
        foreach ($extraColumns as $extraColumn) {
            if (isset($currentContent[$extraColumn])) {
                unset($currentContent[$extraColumn]);
            }
        }
        $data = ["bpm" => $contentData, "post" => $currentContent];

        return response()->json($data, 200, [
            'Content-Type' => 'application/vnd.api+json',
        ]);
    }

    /**
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     * @throws \Doctrine\ORM\NonUniqueResultException
     * @throws \Throwable
     */
    public function delete($id)
    {
        $data = $this->contentBpmService->get($id);

        $this->contentBpmService->delete($id);

        //if the update method response it's null the bpm not exist; we throw the proper exception
        throw_if(
            is_null($data),
            new NotFoundException('Delete failed, bpm not found with id: '.$id)
        );

        $content_id = $data['content_id'];
        $currentContent = $this->contentService->getById($content_id);
        $data = ["post" => $currentContent];

        return response()->json($data, 202, [
            'Content-Type' => 'application/vnd.api+json',
        ]);
    }
}
