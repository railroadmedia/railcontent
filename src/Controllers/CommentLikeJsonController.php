<?php

namespace Railroad\Railcontent\Controllers;

use Illuminate\Routing\Controller;
use Railroad\Railcontent\Requests\CommentLikeRequest;
use Railroad\Railcontent\Requests\CommentUnLikeRequest;
use Railroad\Railcontent\Responses\JsonResponse;
use Railroad\Railcontent\Services\CommentLikeService;

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