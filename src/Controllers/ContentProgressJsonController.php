<?php

namespace Railroad\Railcontent\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Railroad\Railcontent\Requests\UserContentRequest;
use Railroad\Railcontent\Services\ConfigService;
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
    public function __construct(UserContentProgressService $userContentService)
    {
        $this->userContentService = $userContentService;

        $this->middleware(ConfigService::$controllerMiddleware);
    }

    /** Start a content for the authenticated user
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function startContent(UserContentRequest $request)
    {
// nu de aici se declanseaza eventul
//die("start-content-railcontent");
//aici nici nu pare sa intre
// CAND DAU PLAY, INTRA AICI, DAR CONTINUA VIDEOUL SI DACA AM DIE!!!!!
        $response = $this->userContentService->startContent(
            $request->input('content_id'),
            auth()->id()
        );

        return reply()->json(
            [[$response]],
            [
                'transformer' => DataTransformer::class,
            ]
        );
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
            $request->input('content_id'),
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
     * Set content as complete for the authenticated user
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function resetContent(UserContentRequest $request)
    {
        $response = $this->userContentService->resetContent(
            $request->input('content_id'),
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
            $request->input('content_id'),
            $request->input('progress_percent'),
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
}