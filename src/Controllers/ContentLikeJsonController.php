<?php

namespace Railroad\Railcontent\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Railroad\Railcontent\Repositories\ContentLikeRepository;
use Railroad\Railcontent\Requests\CommentLikeRequest;
use Railroad\Railcontent\Requests\CommentUnLikeRequest;
use Railroad\Railcontent\Services\ConfigService;
use Railroad\Railcontent\Transformers\DataTransformer;

class ContentLikeJsonController extends Controller
{
    /**
     * @var ContentLikeRepository
     */
    private $contentLikeRepository;

    public function __construct(
        ContentLikeRepository $contentLikeRepository
    ) {
        $this->contentLikeRepository = $contentLikeRepository;

        $this->middleware(ConfigService::$controllerMiddleware);
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
        $count =
            $this->contentLikeRepository->query()
                ->where('content_id', $id)
                ->count();

        $likes =
            $this->contentLikeRepository->query()
                ->where('content_id', $id)
                ->limit($request->get('limit', 10))
                ->skip(($request->get('page', 1) - 1) * $request->get('limit', 10))
                ->orderBy(
                    trim($request->get('sort', '-created_on'), '-'),
                    substr($request->get('sort', '-created_on'), 0, 1) !== '-' ? 'asc' : 'desc'
                )
                ->get();

        return reply()->json(
            $likes,
            [
                'totalResults' => $count,
                'transformer' => DataTransformer::class,
            ]
        );
    }

    /**
     * Like content.
     *
     * @param Request $request
     * @return mixed
     */
    public function like(Request $request)
    {
        $likeStored =
            $this->contentLikeRepository->query()
                ->updateOrInsert(
                    [
                        'content_id' => $request->get('content_id'),
                        'user_id' => $request->get('user_id'),
                    ],
                    [
                        'created_on' => Carbon::now()
                            ->toDateTimeString(),
                    ]
                );

        return reply()->json(
            [[$store]],
            [
                'code' => $store ? 200 : 500,
                'transformer' => DataTransformer::class,
            ]
        );
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
        $delete = $this->commentLikeService->delete($id, auth()->id());

        return reply()->json(
            [[$delete]],
            [
                'code' => $delete ? 200 : 500,
                'transformer' => DataTransformer::class,
            ]
        );
    }
}