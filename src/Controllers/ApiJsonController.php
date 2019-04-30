<?php

namespace Railroad\Railcontent\Controllers;

use Railroad\Railcontent\Decorators\Mobile\LessonAssignmentDecorator;
use Illuminate\Routing\Controller;
use Railroad\Railcontent\Decorators\Mobile\StripTagDecorator;
use Railroad\Railcontent\Decorators\Mobile\VimeoVideoSourcesDecorator;
use Railroad\Railcontent\Repositories\CommentRepository;
use Railroad\Railcontent\Services\CommentService;
use Railroad\Railcontent\Services\ContentHierarchyService;
use Railroad\Railcontent\Services\ContentService;
use Railroad\Railcontent\Support\Collection;
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
     * @var ContentHierarchyService
     */
    private $contentHierarchyService;

    /**
     * @var StripTagDecorator
     */
    private $stripTagsDecorator;

    /**
     * @var VimeoVideoSourcesDecorator
     */
    private $vimeoVideoSourcesDecorator;

    /**
     * @var LessonAssignmentDecorator
     */
    private $lessonAssignmentsDecorator;

    /**
     * MyListJsonController constructor.
     *
     * @param ContentService $contentService
     * @param ContentHierarchyService $contentHierarchyService
     */
    public function __construct(
        ContentService $contentService,
        ContentHierarchyService $contentHierarchyService,
        CommentService $commentService,
        StripTagDecorator $stripTagDecorator,
        VimeoVideoSourcesDecorator $vimeoVideoSourcesDecorator,
        LessonAssignmentDecorator $lessonAssignmentDecorator
    ) {
        $this->contentHierarchyService = $contentHierarchyService;
        $this->contentService = $contentService;
        $this->commentService = $commentService;

        $this->stripTagsDecorator = $stripTagDecorator;
        $this->vimeoVideoSourcesDecorator = $vimeoVideoSourcesDecorator;
        $this->lessonAssignmentsDecorator = $lessonAssignmentDecorator;
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
        $contentTypes = array_keys(config('railcontent.shows'));

        foreach ($contentTypes as $type) {
            $episodes[$type]['episodeNumber'] = $this->contentService->countByTypes(
                [$type]

            );
        }

        return response()->json(array_merge_recursive(config('railcontent.shows'), $episodes));
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

    /**
     * @param $contentId
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function getContentWithVimeoData($contentId, Request $request)
    {
        $content = $this->contentService->getById($contentId);

        $isDownload = $request->get('download', false);

        $lessonParent =
            $this->contentService->getByChildIdWhereParentTypeIn($contentId, ['course', 'song', 'show', 'play-along']);

        $parentChildren = [];

        if ($content['type'] == 'course') {
            $parentChildren = [];
        } elseif ($lessonParent->isNotEmpty()) {
            $parentChildren = $this->contentService->getByParentId($lessonParent->first()['id']);
        } else {
            $parentChildren = $this->contentService->getFiltered(
                $request->get('page', 1),
                $request->get('limit', 10),
                '-published_on',
                [$content['type']]
            )['results'];
        }

        if ($lessonParent->isNotEmpty()) {
            $content['parent'] = $lessonParent;
        }

        $parentChildrenTrimmed = $this->getParentChildTrimmed($parentChildren, $content);

        $content['related_lessons'] = $parentChildrenTrimmed;
        $lessons = $this->contentService->getByParentId($contentId);

        if ($isDownload && (count($lessons) > 0)) {
            $content['lessons'] = $lessons;

            //for download feature we need lessons assignments, vimeo urls, comments
            $this->vimeoVideoSourcesDecorator->decorate(new Collection($content['lessons']));

            $this->lessonAssignmentsDecorator->decorate(new Collection($content['lessons']));

            $this->commentService->attachCommentsToContents($content['lessons']);

            $parentChildren = $this->contentService->getByParentId($content['id']);

            foreach ($content['lessons'] as $lessonIndex => $lesson) {
                $content['lessons'][$lessonIndex]['related_lessons'] = $parentChildren;
            }
        }

        $this->stripTagsDecorator->decorate(new Collection([$content]));

        $lessonContent =
            $this->vimeoVideoSourcesDecorator->decorate(new Collection([$content]))
                ->first();

        return response()->json(['data' => [$lessonContent]]);
    }

    /**
     * @param $parentChildren
     * @param $content
     * @return array
     */
    private function getParentChildTrimmed($parentChildren, $content)
    : array {
        $parentChildrenTrimmed = [];
        $matched = false;

        foreach ($parentChildren as $parentChildIndex => $parentChild) {

            if ((count($parentChildren) - $parentChildIndex) <= 10 && count($parentChildrenTrimmed) < 10) {
                $parentChildrenTrimmed[] = $parentChild;
            } elseif ($matched && count($parentChildrenTrimmed) < 10) {
                $parentChildrenTrimmed[] = $parentChild;
            }

            if ($parentChild['id'] == $content['id']) {
                $matched = true;
            }

        }

        return $parentChildrenTrimmed;
    }

}
