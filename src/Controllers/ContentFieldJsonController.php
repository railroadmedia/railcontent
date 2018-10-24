<?php

namespace Railroad\Railcontent\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Railroad\Railcontent\Exceptions\NotFoundException;
use Railroad\Railcontent\Requests\ContentFieldCreateRequest;
use Railroad\Railcontent\Requests\ContentFieldDeleteRequest;
use Railroad\Railcontent\Services\ConfigService;
use Railroad\Railcontent\Services\ContentFieldService;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Railroad\Railcontent\Transformers\DataTransformer;

class ContentFieldJsonController extends Controller
{
    use ValidatesRequests;

    private $fieldService;

    /**
     * FieldController constructor.
     *
     * @param ContentFieldService $fieldService
     */
    public function __construct(ContentFieldService $fieldService)
    {
        $this->fieldService = $fieldService;

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
        $contentField = $this->fieldService->createOrUpdate(
            $request->only(
                [
                    'id',
                    'content_id',
                    'key',
                    'value',
                    'position',
                    'type',
                ]
            )
        );

        return reply()->json(
            [$contentField],
            [
                'transformer' => DataTransformer::class,
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
     */
    public function delete(ContentFieldDeleteRequest $request, $fieldId)
    {
        $deleted = $this->fieldService->delete($fieldId);

        //if the update method response it's null the field not exist; we throw the proper exception
        throw_if(
            is_null($deleted),
            new NotFoundException('Delete failed, field not found with id: ' . $fieldId)
        );

        return reply()->json(null, ['code' => 204]);
    }
}