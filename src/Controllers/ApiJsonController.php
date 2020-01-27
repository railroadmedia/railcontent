<?php

namespace Railroad\Railcontent\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Routing\Controller;
use Railroad\Railcontent\Decorators\Mobile\StripTagDecorator;
use Railroad\Railcontent\Repositories\CommentRepository;
use Railroad\Railcontent\Services\CommentService;
use Railroad\Railcontent\Services\ContentService;
use Symfony\Component\HttpFoundation\Request;

class ApiJsonController extends Controller
{
    /**
     * @var ContentService
     */
    private $contentService;

    /**
     * @var CommentService
     */
    private $commentService;

    /**
     * @var StripTagDecorator
     */
    private $stripTagsDecorator;

    /**
     * ApiJsonController constructor.
     *
     * @param ContentService $contentService
     * @param CommentService $commentService
     * @param StripTagDecorator $stripTagDecorator
     */
    public function __construct(
        ContentService $contentService,
        CommentService $commentService,
        StripTagDecorator $stripTagDecorator
    ) {
        $this->contentService = $contentService;
        $this->commentService = $commentService;

        $this->stripTagsDecorator = $stripTagDecorator;
    }

    /**
     * @return JsonResponse
     */
    public function onboarding()
    {
        $contents = $this->contentService->getByIds(config('railcontent.onboardingContentIds') ?? []);

        return response()->json($contents);
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function getShows(Request $request)
    {
        $shows = [];
        $metaData = config('railcontent.cataloguesMetadata');
        if ($request->has('withCount')) {
            $episodesNumber = $this->contentService->countByTypes(
                config('railcontent.showTypes'),
                'type'
            );
        }

        foreach (config('railcontent.showTypes') as $showType) {
            $shows[$showType] = $metaData[$showType] ?? [];
            $shows[$showType]['episodeNumber'] = $episodesNumber[$showType]['total'] ?? '';
        }

        return response()->json($shows);
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function getComments(Request $request)
    {
        CommentRepository::$availableContentId = $request->get('content_id');
        CommentRepository::$availableUserId = null;
        CommentRepository::$availableContentType = null;
        CommentRepository::$assignedToUserId = false;

        $commentData = $this->commentService->getComments(
            $request->get('page', 1),
            $request->get('limit', 10),
            $request->get('sort', $request->get('sort', '-created_on')),
            auth()->id() ?? null
        );

        $this->stripTagsDecorator->decorate($commentData['results']);

        return response()->json(
            [
                'data' => $commentData['results']->values()
                    ->all(),
                'meta' => [
                    'totalCommentsAndReplies' => $commentData['total_comments_and_results'],
                    'totalResults' => $commentData['total_results'],
                    'page' => $request->get('page', 1),
                    'limit' => $request->get('limit', 10),
                ],
            ]
        );
    }
}
