<?php

namespace Railroad\Railcontent\Controllers;

use Illuminate\Routing\Controller;
use Railroad\Railcontent\Requests\CommentLikeRequest;
use Railroad\Railcontent\Requests\CommentUnLikeRequest;
use Railroad\Railcontent\Services\CommentLikeService;
use Railroad\Railcontent\Services\ResponseService;

class CommentLikeJsonController extends Controller
{
    /**
     * @var CommentLikeService
     */
    private $commentLikeService;

    /**
     * CommentLikeJsonController constructor.
     *
     * @param CommentLikeService $commentLikeService
     */
    public function __construct(
        CommentLikeService $commentLikeService
    ) {
        $this->commentLikeService = $commentLikeService;
    }

    /** Authenticated user like a comment.
     *
     * @param CommentLikeRequest $request
     * @param $id
     * @return \Spatie\Fractal\Fractal
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function store(CommentLikeRequest $request, $id)
    {
        $store = $this->commentLikeService->create($id, auth()->id());

        return ResponseService::commentLike($store);
    }

    /** Authenticated user dislike a comment.
     *
     * @param CommentUnLikeRequest $request
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     */
    public function delete(CommentUnLikeRequest $request, $id)
    {
        $this->commentLikeService->delete($id, auth()->id());

        return ResponseService::empty(200);
    }
}