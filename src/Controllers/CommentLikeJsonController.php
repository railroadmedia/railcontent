<?php

namespace Railroad\Railcontent\Controllers;

use Illuminate\Routing\Controller;
use Railroad\Railcontent\Requests\CommentLikeRequest;
use Railroad\Railcontent\Requests\CommentUnLikeRequest;
use Railroad\Railcontent\Responses\JsonResponse;
use Railroad\Railcontent\Services\CommentLikeService;
use Railroad\Railcontent\Services\ConfigService;

class CommentLikeJsonController extends Controller
{
    /**
     * @var CommentLikeService
     */
    private $commentLikeService;

    public function __construct(
        CommentLikeService $commentLikeService
    ) {
        $this->commentLikeService = $commentLikeService;

        $this->middleware(ConfigService::$controllerMiddleware);
    }

    public function store(CommentLikeRequest $request)
    {
        $store = $this->commentLikeService->create($request->get('comment_id'), auth()->id());

        return new JsonResponse($store, $store ? 200 : 500);
    }

    public function delete(CommentUnLikeRequest $request)
    {
        $delete = $this->commentLikeService->delete($request->get('comment_id'), auth()->id());

        return new JsonResponse($delete, $delete ? 200 : 500);
    }
}