<?php

namespace Railroad\Railcontent\Controllers;

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
     * @return \Illuminate\Http\JsonResponse
     */
    public function onboarding()
    {
        $contents = $this->contentService->getByIds(config('railcontent.onboardingContentIds') ?? []);

        return response()->json($contents);
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function getShows()
    {
        foreach (config('railcontent.showTypes') as $type) {
            $episodes[$type]['episodeNumber'] = $this->contentService->countByTypes(
                [$type]
            );
        }

        $contentTypes = array_flip(config('railcontent.showTypes'));
        $shows = array_intersect_key(array_replace($contentTypes, config('railcontent.cataloguesMetadata')), $contentTypes);

        return response()->json(array_merge_recursive($shows, $episodes));
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
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
                'data' => $commentData['results'],
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
