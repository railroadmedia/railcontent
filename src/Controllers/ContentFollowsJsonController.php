<?php

namespace Railroad\Railcontent\Controllers;

use Illuminate\Routing\Controller;
use Railroad\Railcontent\Repositories\ContentRepository;
use Railroad\Railcontent\Requests\ContentFollowRequest;
use Railroad\Railcontent\Services\ConfigService;
use Railroad\Railcontent\Services\ContentFollowsService;
use Railroad\Railcontent\Services\ContentService;
use Railroad\Railcontent\Transformers\DataTransformer;
use Illuminate\Http\Request;

class ContentFollowsJsonController extends Controller
{
    /**
     * @var ContentFollowsService
     */
    private $contentFollowsService;

    /**
     * @var ContentService
     */
    private $contentService;

    /**
     * @param ContentFollowsService $contentFollowsService
     */
    public function __construct(
        ContentFollowsService $contentFollowsService,
        ContentService $contentService
    ) {
        $this->contentFollowsService = $contentFollowsService;
        $this->contentService = $contentService;

        $this->middleware(ConfigService::$controllerMiddleware);
    }

    /**
     * @param ContentFollowRequest $request
     * @return mixed
     */
    public function followContent(ContentFollowRequest $request)
    {
        $response = $this->contentFollowsService->follow(
            $request->input('content_id'),
            auth()->id()
        );

        return reply()->json([[$response]], [
            'transformer' => DataTransformer::class,
        ]);
    }

    /**
     * @param ContentFollowRequest $request
     * @return mixed
     */
    public function unfollowContent(ContentFollowRequest $request)
    {
        $this->contentFollowsService->unfollow(
            $request->input('content_id'),
            auth()->id()
        );

        return reply()->json(null, ['code' => 204]);
    }

    /**
     * @param Request $request
     * @return mixed
     */
    public function getFollowedContent(Request $request)
    {
        $response = $this->contentFollowsService->getUserFollowedContent(
            auth()->id(),
            $request->get('content_type')
        );

        return reply()->json($response, [
            'transformer' => DataTransformer::class,
        ]);
    }

    /**
     * @param Request $request
     * @return mixed
     */
    public function getLatestLessonsForFollowedContentByType(Request $request)
    {
        ContentRepository::$availableContentStatues = $request->get('statuses', [ContentService::STATUS_PUBLISHED]);

        $followedContent = $this->contentFollowsService->getUserFollowedContent(
            auth()->id(),
            $request->get('content_type')
        );

        $includedFields = [];
        $contentIds = (array_pluck($followedContent, 'content_id'));
        foreach ($contentIds as $contentId) {
            $includedFields[] = 'instructor,' . $contentId;
        }

        $contentData = $this->contentService->getFiltered(
            $request->get('page', 1),
            $request->get('limit', 10),
            $request->get('sort', '-published_on'),
            [],
            [],
            [],
            [],
            $includedFields
        );

        return reply()->json($contentData['results'], [
                'transformer' => DataTransformer::class,
                'totalResults' => $contentData['total_results'],
                'filterOptions' => [],
            ]);
    }
}