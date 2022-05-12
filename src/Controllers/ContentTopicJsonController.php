<?php

namespace Railroad\Railcontent\Controllers;

use Illuminate\Routing\Controller;
use Railroad\Railcontent\Exceptions\NotFoundException;
use Railroad\Railcontent\Requests\ContentTopicCreateRequest;
use Railroad\Railcontent\Requests\ContentTopicUpdateRequest;
use Railroad\Railcontent\Services\ConfigService;
use Railroad\Railcontent\Services\ContentService;
use Railroad\Railcontent\Services\ContentTopicService;

class ContentTopicJsonController extends Controller
{
    /**
     * @var ContentTopicService
     */
    private $contentTopicService;
    /**
     * @var ContentService
     */
    private $contentService;

    /**
     * @param ContentTopicService $contentTopicService
     * @param ContentService $contentService
     */
    public function __construct(
        ContentTopicService $contentTopicService,
        ContentService $contentService
    ) {
        $this->contentTopicService = $contentTopicService;
        $this->contentService = $contentService;

        $this->middleware(ConfigService::$controllerMiddleware);
    }

    /**
     * @param ContentTopicCreateRequest $request
     * @return \Illuminate\Http\JsonResponse
     * @throws \Doctrine\ORM\NonUniqueResultException
     */
    public function store(ContentTopicCreateRequest $request)
    {
        $contentData = $this->contentTopicService->create(
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
        $data = ["topic" => $contentData, "post" => $currentContent];

        return response()->json($data, 201, [
            'Content-Type' => 'application/vnd.api+json',
        ]);
    }

    /**
     * @param $id
     * @param ContentTopicUpdateRequest $request
     * @return \Illuminate\Http\JsonResponse
     * @throws \Doctrine\ORM\NonUniqueResultException
     * @throws \Throwable
     */
    public function update($id, ContentTopicUpdateRequest $request)
    {
        $contentData = $this->contentTopicService->update(
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
            new NotFoundException('Update failed, topic not found with id: '.$id)
        );

        $content_id = $request->input('content_id');
        $currentContent = $this->contentService->getById($content_id);
        $extraColumns = config('railcontent.contentColumnNamesForFields', []);
        foreach ($extraColumns as $extraColumn) {
            if (isset($currentContent[$extraColumn])) {
                unset($currentContent[$extraColumn]);
            }
        }
        $data = ["topic" => $contentData, "post" => $currentContent];

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
        $data = $this->contentTopicService->get($id);

        $this->contentTopicService->delete($id);

        //if the update method response it's null the topic not exist; we throw the proper exception
        throw_if(
            is_null($data),
            new NotFoundException('Delete failed, topic not found with id: '.$id)
        );

        $content_id = $data['content_id'];
        $currentContent = $this->contentService->getById($content_id);
        $data = ["post" => $currentContent];

        return response()->json($data, 202, [
            'Content-Type' => 'application/vnd.api+json',
        ]);
    }
}
