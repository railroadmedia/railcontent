<?php

namespace Railroad\Railcontent\Controllers;

use Illuminate\Routing\Controller;
use Railroad\Railcontent\Exceptions\NotFoundException;
use Railroad\Railcontent\Requests\ContentStyleCreateRequest;
use Railroad\Railcontent\Requests\ContentStyleUpdateRequest;
use Railroad\Railcontent\Services\ConfigService;
use Railroad\Railcontent\Services\ContentService;
use Railroad\Railcontent\Services\ContentStyleService;

class ContentStyleJsonController extends Controller
{
    /**
     * @var ContentStyleService
     */
    private $contentStyleService;
    /**
     * @var ContentService
     */
    private $contentService;

    /**
     * @param ContentStyleService $contentStyleService
     * @param ContentService $contentService
     */
    public function __construct(
        ContentStyleService $contentStyleService,
        ContentService $contentService
    ) {
        $this->contentStyleService = $contentStyleService;
        $this->contentService = $contentService;

        $this->middleware(ConfigService::$controllerMiddleware);
    }

    /**
     * @param ContentStyleCreateRequest $request
     * @return \Illuminate\Http\JsonResponse
     * @throws \Doctrine\ORM\NonUniqueResultException
     */
    public function store(ContentStyleCreateRequest $request)
    {
        $contentData = $this->contentStyleService->create(
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
        $data = ["style" => $contentData, "post" => $currentContent];

        return response()->json($data, 201, [
            'Content-Type' => 'application/vnd.api+json',
        ]);
    }

    /**
     * @param $id
     * @param ContentStyleUpdateRequest $request
     * @return \Illuminate\Http\JsonResponse
     * @throws \Doctrine\ORM\NonUniqueResultException
     * @throws \Throwable
     */
    public function update($id, ContentStyleUpdateRequest $request)
    {
        $contentData = $this->contentStyleService->update(
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
            new NotFoundException('Update failed, style not found with id: '.$id)
        );

        $content_id = $request->input('content_id');
        $currentContent = $this->contentService->getById($content_id);
        $extraColumns = config('railcontent.contentColumnNamesForFields', []);
        foreach ($extraColumns as $extraColumn) {
            if (isset($currentContent[$extraColumn])) {
                unset($currentContent[$extraColumn]);
            }
        }
        $data = ["style" => $contentData, "post" => $currentContent];

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
        $data = $this->contentStyleService->get($id);

        $this->contentStyleService->delete($id);

        //if the update method response it's null the style not exist; we throw the proper exception
        throw_if(
            is_null($data),
            new NotFoundException('Delete failed, style not found with id: '.$id)
        );

        $content_id = $data['content_id'];
        $currentContent = $this->contentService->getById($content_id);
        $data = ["post" => $currentContent];

        return response()->json($data, 202, [
            'Content-Type' => 'application/vnd.api+json',
        ]);
    }
}
