<?php

namespace Railroad\Railcontent\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Railroad\Railcontent\Requests\UserContentRequest;
use Railroad\Railcontent\Services\ResponseService;
use Railroad\Railcontent\Services\UserContentProgressService;
use Railroad\Railcontent\Transformers\DataTransformer;

class ContentProgressJsonController extends Controller
{
    /**
     * @var UserContentProgressService
     */
    private $userContentService;

    /**
     * ContentProgressJsonController constructor.
     *
     * @param UserContentProgressService $userContentService
     */
    public function __construct(
        UserContentProgressService $userContentService
    ) {
        $this->userContentService = $userContentService;

        $this->middleware(config('railcontent.controller_middleware'));
    }

    /** Start a content for the authenticated user
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function startContent(UserContentRequest $request)
    {

        $response = $this->userContentService->startContent(
            $request->input('data.relationships.content.data.id'),
            auth()->id()
        );

        return ResponseService::empty(200)->setData(['data'=> $response]);
    }

    /**
     * Set content as complete for the authenticated user
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function completeContent(UserContentRequest $request)
    {
        $response = $this->userContentService->completeContent(
            $request->input('data.relationships.content.data.id'),
            auth()->id()
        );

        return ResponseService::empty(201)->setData(['data'=> $response]);

        return reply()->json(
            [[$response]],
            [
                'transformer' => DataTransformer::class,
                'code' => 201,
            ]
        );
    }

    /**
     * Set content as complete for the authenticated user
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function resetContent(UserContentRequest $request)
    {
        $response = $this->userContentService->resetContent(
            $request->input('data.relationships.content.data.id'),
            auth()->id()
        );

        return reply()->json(
            [[$response]],
            [
                'transformer' => DataTransformer::class,
                'code' => 201,
            ]
        );
    }

    /**
     * Save the progress on a content for the authenticated user
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function saveProgress(UserContentRequest $request)
    {
        $response = $this->userContentService->saveContentProgress(
            $request->input('data.relationships.content.data.id'),
            $request->input('data.attributes.progress_percent'),
            auth()->id()
        );
        return ResponseService::empty(201)->setData(['data'=> $response]);
    }
}