<?php

namespace Railroad\Railcontent\Controllers;

use Illuminate\Routing\Controller;
use Railroad\Railcontent\Exceptions\NotFoundException;
use Railroad\Railcontent\Requests\ContentInstructorCreateRequest;
use Railroad\Railcontent\Requests\ContentInstructorUpdateRequest;
use Railroad\Railcontent\Services\ConfigService;
use Railroad\Railcontent\Services\ContentInstructorService;
use Railroad\Railcontent\Services\ContentService;

class ContentInstructorJsonController extends Controller
{
    /**
     * @var ContentInstructorService
     */
    private $contentInstructorService;
    /**
     * @var ContentService
     */
    private $contentService;

    /**
     * @param ContentInstructorService $contentInstructorService
     * @param ContentService $contentService
     */
    public function __construct(
        ContentInstructorService $contentInstructorService,
        ContentService $contentService
    ) {
        $this->contentInstructorService = $contentInstructorService;
        $this->contentService = $contentService;

        $this->middleware(ConfigService::$controllerMiddleware);
    }

    /**
     * @param ContentInstructorCreateRequest $request
     * @return \Illuminate\Http\JsonResponse
     * @throws \Doctrine\ORM\NonUniqueResultException
     */
    public function store(ContentInstructorCreateRequest $request)
    {
        $contentData = $this->contentInstructorService->create(
            $request->input('content_id'),
            $request->input('instructor_id'),
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
        $data = ["instructor" => $contentData, "post" => $currentContent];

        return response()->json($data, 201, [
            'Content-Type' => 'application/vnd.api+json',
        ]);
    }

    /**
     * @param $id
     * @param ContentInstructorUpdateRequest $request
     * @return \Illuminate\Http\JsonResponse
     * @throws \Doctrine\ORM\NonUniqueResultException
     * @throws \Throwable
     */
    public function update($id, ContentInstructorUpdateRequest $request)
    {
        $contentData = $this->contentInstructorService->update(
            $id,
            $request->only([
                               'content_id',
                               'instructor_id',
                               'position',
                           ])
        );

        //if the update method response it's null the datum not exist; we throw the proper exception
        throw_if(
            is_null($contentData),
            new NotFoundException('Update failed, instructor not found with id: '.$id)
        );

        $content_id = $request->input('content_id');
        $currentContent = $this->contentService->getById($content_id);
        $extraColumns = config('railcontent.contentColumnNamesForFields', []);
        foreach ($extraColumns as $extraColumn) {
            if (isset($currentContent[$extraColumn])) {
                unset($currentContent[$extraColumn]);
            }
        }
        $data = ["instructor" => $contentData, "post" => $currentContent];

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
        $data = $this->contentInstructorService->get($id);

        $this->contentInstructorService->delete($id);

        //if the update method response it's null the instructor not exist; we throw the proper exception
        throw_if(
            is_null($data),
            new NotFoundException('Delete failed, instructor not found with id: '.$id)
        );

        $content_id = $data['content_id'];
        $currentContent = $this->contentService->getById($content_id);
        $data = ["post" => $currentContent];

        return response()->json($data, 202, [
            'Content-Type' => 'application/vnd.api+json',
        ]);
    }
}
