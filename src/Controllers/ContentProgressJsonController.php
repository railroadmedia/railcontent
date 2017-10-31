<?php

namespace Railroad\Railcontent\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Railroad\Railcontent\Requests\UserContentRequest;
use Railroad\Railcontent\Services\ContentService;
use Railroad\Railcontent\Services\UserContentService;

class ContentProgressJsonController extends Controller
{
    /**
     * @var UserContentService
     */
    private $userContentService;

    /**
     * ContentProgressJsonController constructor.
     * @param UserContentService $userContentService
     */
    public function __construct(UserContentService $userContentService)
    {
        $this->userContentService = $userContentService;
    }

    /** Start a content for the authenticated user
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function startContent(UserContentRequest $request)
    {
        $response = $this->userContentService->startContent($request->input('content_id'), $request->user()->id);

        return response()->json($response, 200);
    }

    /** Set content as complete for the authenticated user
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function completeContent(UserContentRequest $request)
    {
        $response = $this->userContentService->completeContent($request->input('content_id'), $request->user()->id);

        return response()->json($response, 201);
    }

    /** Save the progress on a content for the authenticated user
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function saveProgress(UserContentRequest $request)
    {
        $response =
            $this->userContentService->saveContentProgress(
                $request->input('content_id'),
                $request->input('progress'),
                $request->user()->id
            );

        return response()->json($response, 201);
    }
}