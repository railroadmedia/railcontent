<?php

namespace Railroad\Railcontent\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Railroad\Railcontent\Requests\CommentUnLikeRequest;
use Railroad\Railcontent\Services\ConfigService;
use Railroad\Railcontent\Services\ContentLikeService;
use Railroad\Railcontent\Transformers\DataTransformer;

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

        $this->middleware(ConfigService::$controllerMiddleware);
        $this->contentLikeService = $contentLikeService;
    }

    /**
     * Fetch likes for content with pagination.
     *
     * @param Request $request
     * @param integer $id - content id
     * @return mixed
     */
    public function index(Request $request, $id)
    {
        $count = $this->contentLikeService->count(
            $this->contentLikeService->builder()
                ->where('content_id', $id)
        );

        $likes = $this->contentLikeService->index(
            $this->contentLikeService->builder()
                ->where('content_id', $id)
                ->limit($request->get('limit', 10))
                ->skip(($request->get('page', 1) - 1) * $request->get('limit', 10))
                ->orderBy(
                    trim($request->get('sort', '-created_on'), '-'),
                    substr($request->get('sort', '-created_on'), 0, 1) !== '-' ? 'asc' : 'desc'
                )
        );

        return reply()->json(
            $likes,
            [
                'totalResults' => $count,
                'transformer' => DataTransformer::class,
            ]
        );
    }

    /**
     * Authenticated user like content.
     *
     * @param Request $request
     * @return mixed
     */
    public function like(Request $request)
    {
        $like = $this->contentLikeService->like($request->get('content_id'), auth()->id());

        return reply()->json(
            [[$like]],
            [
                'code' => $like ? 200 : 500,
                'transformer' => DataTransformer::class,
            ]
        );
    }

    /**
     * Authenticated user unlike content.
     *
     * @param CommentUnLikeRequest $request
     * @return mixed
     */
    public function unlike(CommentUnLikeRequest $request)
    {
        $amountDeleted = $this->contentLikeService->unlike($request->get('content_id'), auth()->id());

        return reply()->json(
            [[$amountDeleted > 0]],
            [
                'code' => $amountDeleted ? 200 : 500,
                'transformer' => DataTransformer::class,
            ]
        );
    }
}