<?php

namespace Railroad\Railcontent\Controllers;

use Illuminate\Routing\Controller;
use Railroad\Railcontent\Exceptions\NotFoundException;
use Railroad\Railcontent\Requests\ContentKeyCreateRequest;
use Railroad\Railcontent\Requests\ContentKeyUpdateRequest;
use Railroad\Railcontent\Services\ConfigService;
use Railroad\Railcontent\Services\ContentKeyService;
use Railroad\Railcontent\Services\ContentService;

class ContentKeyJsonController extends Controller
{
    /**
     * @var ContentKeyService
     */
    private $contentKeyService;
    /**
     * @var ContentService
     */
    private $contentService;

    /**
     * @param ContentKeyService $contentKeyService
     * @param ContentService $contentService
     */
    public function __construct(
        ContentKeyService $contentKeyService,
        ContentService $contentService
    ) {
        $this->contentKeyService = $contentKeyService;
        $this->contentService = $contentService;

        $this->middleware(ConfigService::$controllerMiddleware);
    }

    /**
     * @param ContentKeyCreateRequest $request
     * @return \Illuminate\Http\JsonResponse
     * @throws \Doctrine\ORM\NonUniqueResultException
     */
    public function store(ContentKeyCreateRequest $request)
    {
        $contentData = $this->contentKeyService->create(
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
        $data = ["key" => $contentData, "post" => $currentContent];

        return response()->json($data, 201, [
            'Content-Type' => 'application/vnd.api+json',
        ]);
    }

    /**
     * @param $id
     * @param ContentKeyUpdateRequest $request
     * @return \Illuminate\Http\JsonResponse
     * @throws \Doctrine\ORM\NonUniqueResultException
     * @throws \Throwable
     */
    public function update($id, ContentKeyUpdateRequest $request)
    {
        $contentData = $this->contentKeyService->update(
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
            new NotFoundException('Update failed, key not found with id: '.$id)
        );

        $content_id = $request->input('content_id');
        $currentContent = $this->contentService->getById($content_id);
        $extraColumns = config('railcontent.contentColumnNamesForFields', []);
        foreach ($extraColumns as $extraColumn) {
            if (isset($currentContent[$extraColumn])) {
                unset($currentContent[$extraColumn]);
            }
        }
        $data = ["key" => $contentData, "post" => $currentContent];

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
        $data = $this->contentKeyService->get($id);

        $this->contentKeyService->delete($id);

        //if the update method response it's null the key not exist; we throw the proper exception
        throw_if(
            is_null($data),
            new NotFoundException('Delete failed, key not found with id: '.$id)
        );

        $content_id = $data['content_id'];
        $currentContent = $this->contentService->getById($content_id);
        $data = ["post" => $currentContent];

        return response()->json($data, 202, [
            'Content-Type' => 'application/vnd.api+json',
        ]);
    }
}
