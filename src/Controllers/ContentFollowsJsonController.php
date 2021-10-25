<?php

namespace Railroad\Railcontent\Controllers;

use Illuminate\Routing\Controller;
use Railroad\Railcontent\Entities\ContentFilterResultsEntity;
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

        return reply()->json(
            [$response],
            [
                'code' => $response ? 200 : 500,
                'transformer' => DataTransformer::class,
            ]
        );
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
            $request->get('brand', config('railcontent.brand')),
            $request->get('content_type'),
            $request->get('page', 1),
            $request->get('limit', 10)
        );

        return reply()->json($response['results'], [
            'transformer' => DataTransformer::class,
            'totalResults' => $response['total_results'],
            'filterOptions' => [],
        ]);
    }

    /**
     * @param Request $request
     * @return mixed
     */
    public function getLatestLessonsForFollowedContentByType(Request $request)
    {
        $contentData = $this->contentFollowsService->getLessonsForFollowedCoaches(
            $request->get('brand', config('railcontent.brand')),
            $request->get('included_types', []),
            $request->get('statuses', [ContentService::STATUS_PUBLISHED]),
            $request->get('page', 1),
            $request->get('limit', 10),
            $request->get('sort', '-published_on')
        );

        return reply()->json($contentData['results'], [
            'transformer' => DataTransformer::class,
            'totalResults' => $contentData['total_results'],
            'filterOptions' => [],
        ]);
    }
}