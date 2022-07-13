<?php

namespace Railroad\Railcontent\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Railroad\Railcontent\Requests\CommentUnLikeRequest;
use Railroad\Railcontent\Services\ConfigService;
use Railroad\Railcontent\Services\ContentLikeService;
use Railroad\Railcontent\Services\ContentService;
use Railroad\Railcontent\Transformers\DataTransformer;

class ContentLikeJsonController extends Controller
{
    private ContentLikeService $contentLikeService;
    private ContentService $contentService;

    /**
     * @param ContentLikeService $contentLikeService
     * @param ContentService $contentService
     */
    public function __construct(ContentLikeService $contentLikeService, ContentService $contentService)
    {
        $this->middleware(ConfigService::$controllerMiddleware);
        $this->contentLikeService = $contentLikeService;
        $this->contentService = $contentService;
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

        return reply()->json($likes, [
                                       'totalResults' => $count,
                                       'transformer' => DataTransformer::class,
                                   ]);
    }

    /**
     * @param Request $request
     * @return mixed
     * @throws \Doctrine\DBAL\DBALException
     * @throws \Doctrine\ORM\NonUniqueResultException
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     * @throws \ReflectionException
     */
    public function like(Request $request)
    {
        $like = $this->contentLikeService->like($request->get('content_id'), auth()->id());
        $content = $this->contentService->getById($request->get('content_id'));
        $this->contentService->update($request->get('content_id'), [
            'like_count' => $content['like_count'] + 1,
        ]);

        return reply()->json([$like], [
                                        'code' => $like ? 200 : 500,
                                        'transformer' => DataTransformer::class,
                                    ]);
    }

    /**
     * @param CommentUnLikeRequest $request
     * @return mixed
     * @throws \Doctrine\DBAL\DBALException
     * @throws \Doctrine\ORM\NonUniqueResultException
     * @throws \Doctrine\ORM\ORMException
     * @throws \Doctrine\ORM\OptimisticLockException
     * @throws \ReflectionException
     */
    public function unlike(CommentUnLikeRequest $request)
    {
        $amountDeleted = $this->contentLikeService->unlike($request->get('content_id'), auth()->id());
        $content = $this->contentService->getById($request->get('content_id'));
        if($content['like_count'] > 0) {
            $this->contentService->update($request->get('content_id'), [
                'like_count' => $content['like_count'] - 1,
            ]);
        }
        return reply()->json([[$amountDeleted > 0]], [
                                                       'code' => $amountDeleted ? 200 : 500,
                                                       'transformer' => DataTransformer::class,
                                                   ]);
    }
}