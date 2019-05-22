<?php

namespace Railroad\Railcontent\Controllers;

use Doctrine\ORM\OptimisticLockException;
use Doctrine\ORM\ORMException;
use Illuminate\Http\JsonResponse;
use Illuminate\Routing\Controller;
use Railroad\Railcontent\Requests\CommentLikeRequest;
use Railroad\Railcontent\Requests\CommentUnLikeRequest;
use Railroad\Railcontent\Services\CommentLikeService;
use Railroad\Railcontent\Services\ResponseService;
use Spatie\Fractal\Fractal;

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
     * @return Fractal
     * @throws ORMException
     * @throws OptimisticLockException
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
     * @return JsonResponse
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function delete(CommentUnLikeRequest $request, $id)
    {
        $this->commentLikeService->delete($id, auth()->id());

        return ResponseService::empty(200);
    }
}