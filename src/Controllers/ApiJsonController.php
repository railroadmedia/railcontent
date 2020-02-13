<?php

namespace Railroad\Railcontent\Controllers;

use Doctrine\ORM\NonUniqueResultException;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Railroad\Railcontent\Decorators\Mobile\StripTagDecorator;
use Railroad\Railcontent\Repositories\CommentRepository;
use Railroad\Railcontent\Services\CommentService;
use Railroad\Railcontent\Services\ContentService;
use Railroad\Railcontent\Services\ResponseService;
use Spatie\Fractal\Fractal;

/**
 * Class ApiJsonController
 *
 * @package Railroad\Railcontent\Controllers
 */
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
     * @return Fractal
     */
    public function onboarding()
    {
        $contents = $this->contentService->getByIds(config('railcontent.onboardingContentIds') ?? []);

        return ResponseService::content($contents);
    }

    /**
     * @param Request $request
     * @return Fractal
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
            $shows[$showType]['episodeNumber'] = $episodesNumber[$showType] ?? '';
        }

        return ResponseService::shows([$shows]);
    }

    /**
     * @param Request $request
     * @return Fractal
     * @throws NonUniqueResultException
     */
    public function getComments(Request $request)
    {
        CommentRepository::$availableContentId = $request->get('content_id');
        CommentRepository::$availableUserId = null;
        CommentRepository::$availableContentType = null;

        $commentData = $this->commentService->getComments(
            $request->get('page', 1),
            $request->get('limit', 10),
            $request->get('sort', $request->get('sort', '-created_on')),
            auth()->id() ?? null
        );

        $this->stripTagsDecorator->decorate($commentData);

        $qb = $this->commentService->getQb(
            $request->get('page', 1),
            $request->get('limit', 10),
            $request->get('sort', $request->get('sort', '-created_on'))
        );

        return ResponseService::comment($commentData['results'], $qb)
            ->addMeta(['totalCommentsAndReplies' => $this->commentService->countCommentsAndReplies()]);
    }
}
