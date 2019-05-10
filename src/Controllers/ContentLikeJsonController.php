<?php

namespace Railroad\Railcontent\Controllers;

use Doctrine\ORM\OptimisticLockException;
use Doctrine\ORM\ORMException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Railroad\Railcontent\Requests\ContentLikeRequest;
use Railroad\Railcontent\Services\ContentLikeService;
use Railroad\Railcontent\Services\ResponseService;
use Spatie\Fractal\Fractal;

class ContentLikeJsonController extends Controller
{
    /**
     * @var ContentLikeService
     */
    private $contentLikeService;

    /**
     * ContentLikeJsonController constructor.
     *
     * @param ContentLikeService $contentLikeService
     */
    public function __construct(ContentLikeService $contentLikeService)
    {
        $this->middleware(config('railcontent.controller_middleware'));

        $this->contentLikeService = $contentLikeService;
    }

    /**
     * Fetch likes for content with pagination.
     *
     * @param Request $request
     * @param integer $id - content id
     * @return mixed
     */
    public function index($id, Request $request)
    {
        $qb = $this->contentLikeService->getQb(
            $id,
            $request
        );

        $likes = $this->contentLikeService->index($id, $request);

        return ResponseService::contentLike($likes, $qb);
    }

    /** Authenticated user like content.
     *
     * @param ContentLikeRequest $request
     * @return Fractal
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function like(ContentLikeRequest $request)
    {
        $like = $this->contentLikeService->like($request->input('data.relationships.content.data.id'), auth()->id());

        return ResponseService::contentLike($like);
    }

    /** Authenticated user dislike content.
     *
     * @param ContentLikeRequest $request
     * @return JsonResponse
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function unlike(ContentLikeRequest $request)
    {
        $this->contentLikeService->unlike($request->input('data.relationships.content.data.id'), auth()->id());

        return ResponseService::empty(200);
    }
}