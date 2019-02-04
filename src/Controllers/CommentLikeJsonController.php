<?php

namespace Railroad\Railcontent\Controllers;

use Illuminate\Routing\Controller;
use Railroad\Railcontent\Requests\CommentLikeRequest;
use Railroad\Railcontent\Requests\CommentUnLikeRequest;
use Railroad\Railcontent\Services\CommentLikeService;
use Railroad\Railcontent\Services\ConfigService;
use Railroad\Railcontent\Services\ResponseService;

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

    /**
     * Authenticated user like a comment.
     *
     * @param CommentLikeRequest $request
     * @param integer $id - comment id
     * @return mixed
     */
    public function store(CommentLikeRequest $request, $id)
    {
        $store = $this->commentLikeService->create($id, auth()->id());

        return ResponseService::commentLike($store);
    }

    /**
     * Authenticated user unlike a comment.
     *
     * @param CommentUnLikeRequest $request
     * @param integer $id
     * @return mixed
     */
    public function delete(CommentUnLikeRequest $request, $id)
    {
        $this->commentLikeService->delete($id, auth()->id());

        return ResponseService::empty(200);
    }
}