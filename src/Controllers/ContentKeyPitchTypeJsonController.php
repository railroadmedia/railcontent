<?php

namespace Railroad\Railcontent\Controllers;

use Illuminate\Routing\Controller;
use Railroad\Railcontent\Exceptions\NotFoundException;
use Railroad\Railcontent\Requests\ContentKeyPitchTypeCreateRequest;
use Railroad\Railcontent\Requests\ContentKeyPitchTypeUpdateRequest;
use Railroad\Railcontent\Services\ConfigService;
use Railroad\Railcontent\Services\ContentKeyPitchTypeService;
use Railroad\Railcontent\Services\ContentService;

class ContentKeyPitchTypeJsonController extends Controller
{
    /**
     * @var ContentKeyPitchTypeService
     */
    private $contentKeyPitchTypeService;
    /**
     * @var ContentService
     */
    private $contentService;

    /**
     * @param ContentKeyPitchTypeService $contentKeyPitchTypeService
     * @param ContentService $contentService
     */
    public function __construct(
        ContentKeyPitchTypeService $contentKeyPitchTypeService,
        ContentService $contentService
    ) {
        $this->contentKeyPitchTypeService = $contentKeyPitchTypeService;
        $this->contentService = $contentService;

        $this->middleware(ConfigService::$controllerMiddleware);
    }

    /**
     * @param ContentKeyPitchTypeCreateRequest $request
     * @return \Illuminate\Http\JsonResponse
     * @throws \Doctrine\ORM\NonUniqueResultException
     */
    public function store(ContentKeyPitchTypeCreateRequest $request)
    {
        $contentData = $this->contentKeyPitchTypeService->create(
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
        $data = ["keyPitchType" => $contentData, "post" => $currentContent];

        return response()->json($data, 201, [
            'Content-Type' => 'application/vnd.api+json',
        ]);
    }

    /**
     * @param $id
     * @param ContentKeyPitchTypeUpdateRequest $request
     * @return \Illuminate\Http\JsonResponse
     * @throws \Doctrine\ORM\NonUniqueResultException
     * @throws \Throwable
     */
    public function update($id, ContentKeyPitchTypeUpdateRequest $request)
    {
        $contentData = $this->contentKeyPitchTypeService->update(
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
            new NotFoundException('Update failed, key pitch type not found with id: '.$id)
        );

        $content_id = $request->input('content_id');
        $currentContent = $this->contentService->getById($content_id);
        $extraColumns = config('railcontent.contentColumnNamesForFields', []);
        foreach ($extraColumns as $extraColumn) {
            if (isset($currentContent[$extraColumn])) {
                unset($currentContent[$extraColumn]);
            }
        }
        $data = ["keyPitchType" => $contentData, "post" => $currentContent];

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
        $data = $this->contentKeyPitchTypeService->get($id);

        $this->contentKeyPitchTypeService->delete($id);

        //if the update method response it's null the key pitch type not exist; we throw the proper exception
        throw_if(
            is_null($data),
            new NotFoundException('Delete failed, key pitch type not found with id: '.$id)
        );

        $content_id = $data['content_id'];
        $currentContent = $this->contentService->getById($content_id);
        $data = ["post" => $currentContent];

        return response()->json($data, 202, [
            'Content-Type' => 'application/vnd.api+json',
        ]);
    }
}
