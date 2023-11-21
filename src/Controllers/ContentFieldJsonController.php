<?php

namespace Railroad\Railcontent\Controllers;

use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Railroad\Railcontent\Exceptions\NotFoundException;
use Railroad\Railcontent\Requests\ContentFieldCreateRequest;
use Railroad\Railcontent\Requests\ContentFieldDeleteRequest;
use Railroad\Railcontent\Requests\ContentFieldUpdateRequest;
use Railroad\Railcontent\Services\ConfigService;
use Railroad\Railcontent\Services\ContentFieldService;
use Railroad\Railcontent\Services\ContentService;
use Railroad\Railcontent\Transformers\ContentCompiledColumnTransformer;
use Railroad\Railcontent\Transformers\DataTransformer;

class ContentFieldJsonController extends Controller
{
    use ValidatesRequests;

    private $fieldService;

    /**
     * @var ContentService
     */
    private $contentService;

    /**
     * FieldController constructor.
     *
     * @param ContentFieldService $fieldService
     * @param ContentService $contentService
     */
    public function __construct(
        ContentFieldService $fieldService,
        ContentService $contentService
    ) {
        $this->fieldService = $fieldService;
        $this->contentService = $contentService;

        $this->middleware(ConfigService::$controllerMiddleware);
    }

    /**
     * Call the method from service that create a new field and link the content with the field.
     *
     * @param Request $request
     * @param $id
     * @return JsonResponse
     */
    public function show(Request $request, $id)
    {
        $contentField = $this->fieldService->get($id);

        return reply()->json(
            [$contentField],
            [
                'transformer' => DataTransformer::class,
            ]
        );
    }

    /**
     * Call the method from service that create a new field and link the content with the field.
     *
     * @param ContentFieldCreateRequest $request
     * @return JsonResponse
     */
    public function store(ContentFieldCreateRequest $request)
    {
        ContentCompiledColumnTransformer::$avoidDuplicates = true;
        $contentField = $this->fieldService->createOrUpdate(
            $request->only([
                               'content_id',
                               'key',
                               'value',
                               'position',
                               'type',
                           ])
        );
        $content_id = $request->input('content_id');
        $currentContent = $this->contentService->getById($content_id);
        $extraColumns = config('railcontent.contentColumnNamesForFields', []);
        foreach ($extraColumns as $extraColumn) {
            if (isset($currentContent[$extraColumn])) {
                unset($currentContent[$extraColumn]);
            }
        }
        $data = ["field" => $contentField, "post" => $currentContent];

        return response()->json(
            $data,
            201,
            [
                'Content-Type' => 'application/vnd.api+json',
            ]
        );
    }

    /**
     * Call the method from service to update a content field
     *
     * @param ContentFieldUpdateRequest $request
     * @param integer $fieldId
     * @return JsonResponse
     */
    public function update(ContentFieldUpdateRequest $request, $fieldId)
    {
        ContentCompiledColumnTransformer::$avoidDuplicates = true;
        ModeDecoratorBase::$decorationMode = ModeDecoratorBase::DECORATION_MODE_MINIMUM;
        Decorator::$typeDecoratorsEnabled = false;

        $field = $this->fieldService->getByContentIdAndKey(
            $request->input('content_id'),
            $request->input('key')
        );

        $data = $request->only([
                                   'content_id',
                                   'key',
                                   'value',
                                   'position',
                                   'type',
                               ]);
        $data['id'] = $field['id'] ?? null;
        $contentField = $this->fieldService->createOrUpdate(
            $data
        );

        //if the update method response it's null the field not exist; we throw the proper exception
        throw_if(
            is_null($contentField),
            new NotFoundException('Update failed, field not found with id: ' . $fieldId)
        );

        $content_id = $request->input('content_id');
        $currentContent = $this->contentService->getById($content_id);
        $data = ["field" => $contentField, "post" => $currentContent];

        return response()->json(
            $data,
            200,
            [
                'Content-Type' => 'application/vnd.api+json',
            ]
        );
    }

    /**
     * Call the method from service to delete the content's field
     *
     * @param integer $fieldId
     * @param Request $request
     * @return JsonResponse
     *
     * Hmm... we're not actually using that request in here, but including it triggers the prepending validation, so
     * maybe it needs to be there for that?
     *
     * Jonathan, February 2018
     * @throws \Throwable
     */
    public function delete(ContentFieldDeleteRequest $request, $fieldId)
    {
        ContentCompiledColumnTransformer::$avoidDuplicates = true;

        $existingField = $this->fieldService->getByContentIdAndKey(
            $request->input('content_id'),
            $request->input('key'),
            $request->input('value')
        );

        $field = $this->fieldService->get($existingField['id'] ?? $fieldId);
        $deleted = $this->fieldService->delete($existingField['id'] ?? $fieldId);

        //if the update method response it's null the field not exist; we throw the proper exception
        throw_if(
            is_null($field),
            new NotFoundException('Delete failed, field not found with id: ' . $fieldId)
        );

        $content_id = $request->input('content_id');
        $currentContent = $this->contentService->getById($content_id);

        $data = ["post" => $currentContent];

        return response()->json(
            $data,
            202,
            [
                'Content-Type' => 'application/vnd.api+json',
            ]
        );
    }

    /**
     * @param $contentId
     * @param $key
     * @param $value
     * @return \Illuminate\Http\JsonResponse
     * @throws \Doctrine\ORM\NonUniqueResultException
     */
    public function deleteByContentIdAndKey($contentId, $key, $value)
    {
        $deleted = $this->fieldService->deleteByContentIdAndKey($contentId, $key, $value);

        $currentContent = $this->contentService->getById($contentId);

        $data = ["post" => $currentContent];

        return response()->json(
            $data,
            202,
            [
                'Content-Type' => 'application/vnd.api+json',
            ]
        );
    }
}
