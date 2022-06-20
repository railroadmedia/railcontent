<?php

namespace App\Http\Controllers\Platform;

use App\DataMappers\Views\Railcontent\ShowDataMapper;
use App\Decorators\Content\LessonAssignmentDecorator;
use App\Decorators\Content\VimeoVideoSourcesDecorator;
use App\Http\Controllers\BaseController;
use App\Maps\ContentTypeHierarchyMap;
use App\Maps\ContentTypes;
use App\Maps\DrumeoShowDataMapper;
use App\Maps\PrimaryURLSlugToContentTypeMap;
use App\Services\User\UserAccessService;
use Carbon\Carbon;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Railroad\Railcontent\Decorators\ModeDecoratorBase;
use Railroad\Railcontent\Entities\ContentFilterResultsEntity;
use Railroad\Railcontent\Repositories\ContentRepository;
use Railroad\Railcontent\Services\ConfigService;
use Railroad\Railcontent\Services\ContentService;
use Railroad\Railcontent\Support\Collection;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class ContentPagesController extends BaseController
{
    private ContentService $contentService;
    private VimeoVideoSourcesDecorator $vimeoVideoSourcesDecorator;
    private LessonAssignmentDecorator $lessonAssignmentDecorator;

    /**
     * @param  ContentService  $contentService
     * @param  VimeoVideoSourcesDecorator  $vimeoVideoSourcesDecorator
     */
    public function __construct(
        ContentService $contentService,
        VimeoVideoSourcesDecorator $vimeoVideoSourcesDecorator,
        LessonAssignmentDecorator $lessonAssignmentDecorator
    ) {
        $this->contentService = $contentService;
        $this->vimeoVideoSourcesDecorator = $vimeoVideoSourcesDecorator;
        $this->lessonAssignmentDecorator = $lessonAssignmentDecorator;
    }

    public function contentTypeCatalog(Request $request, $domain, $brand, $contentTypeName)
    {
        ConfigService::$availableBrands = [brand()];
        ContentRepository::$bypassPermissions = true;

        $lessonType = PrimaryURLSlugToContentTypeMap::$map[$contentTypeName];
        $catalogName = $contentTypeName;
        $catalogueMeta = config('railcontent.cataloguesMetadata')[$brand][$catalogName] ?? [];

        ContentRepository::$availableContentStatues =
            [ContentService::STATUS_PUBLISHED, ContentService::STATUS_SCHEDULED];
        ContentRepository::$pullFutureContent = true;

        if (user()->permission_level === 'administrator') {
            ContentRepository::$availableContentStatues =
                [ContentService::STATUS_PUBLISHED, ContentService::STATUS_SCHEDULED, ContentService::STATUS_DRAFT];
        }

        $futureLessons = $this->contentService->getFiltered(
            1,
            10,
            '-published_on',
            [$lessonType],
            [],
            [],
            [],
            [],
            [],
            [],
            false
        );

        foreach ($futureLessons['results'] as $futureLessonIndex => $futureLesson) {
            if (Carbon::parse($futureLesson['published_on']) < Carbon::now()) {
                unset($futureLessons['results'][$futureLessonIndex]);
            }
        }

        if (user()->permission_level === 'administrator') {
            ContentRepository::$availableContentStatues =
                [ContentService::STATUS_PUBLISHED, ContentService::STATUS_SCHEDULED, ContentService::STATUS_DRAFT];
        }

        ContentRepository::$pullFutureContent = false;

        $sortOverride = $lessonType === 'chord-and-scale' ? 'slug' : null;

        $defaultPage = $lessonType === 'routine' ? 12 : 20;
        if ($request->get('page', 1) == 1) {
            $defaultPage = $defaultPage - count($futureLessons['results']);
        }

        ContentRepository::$pullFilterResultsOptionsAndCount = true;

        $listLessons = $this->contentService->getFiltered(
            $request->get('page', 1),
            $request->get('limit', $defaultPage),
            $sortOverride ?? '-published_on',
            [$lessonType],
            $request->get('slug_hierarchy', []),
            $request->get('required_parent_ids', []),
            $request->get('required_fields', []),
            $request->get('included_fields', []),
            $request->get('required_user_states', []),
            $request->get('included_user_states', []),
            true
        );

        ContentRepository::$pullFilterResultsOptionsAndCount = false;

        $routinesCount = $recentRoutines = null;
        $hasRecentRoutines = false;

        if ($lessonType === 'routine') {
            $recentRoutines = $this->getUsersStartedRoutinesContent();

            $hasRecentRoutines = count($recentRoutines->results()) > 0;

            $recentRoutines = $recentRoutines->toResponseRawJson();

            $routinesCount = $listLessons['total_results'];
        }

        $listLessons['results'] = $futureLessons['results']->merge($listLessons['results']);

        $isStudentFocus = in_array($lessonType, ['student-review', 'question-and-answer']);

        $startedLessons = $this->contentService->getPaginatedByTypesRecentUserProgressState(
            [$lessonType],
            auth()->id(),
            'started',
            6,
            0
        );

        $startedListLessons =
            count($startedLessons) > 0 ?
                (new ContentFilterResultsEntity(['results' => $startedLessons]))->toResponseRawJson() : false;
        $hasStartedLessons = !empty(json_decode($startedListLessons)->data);

        return view('content.catalogue', [
            "listLessons" => $listLessons->toResponseRawJson(),
            "startedLessons" => $startedListLessons,
            "hasStartedLessons" => $hasStartedLessons,
            "lessonType" => $lessonType,
            "sortOverride" => $sortOverride,
            "isStudentFocus" => $isStudentFocus,
            "recentRoutines" => $recentRoutines,
            "hasRecentRoutines" => $hasRecentRoutines,
            "routinesCount" => $routinesCount,
            "catalogueMeta" => $catalogueMeta,
        ]);
    }

    public function firstLevel(Request $request, $domain, $brand, $primaryPage, $firstSlug, $firstId)
    {
        ModeDecoratorBase::$decorationMode = ModeDecoratorBase::DECORATION_MODE_MINIMUM;

        ContentRepository::$bypassPermissions = true;
        ContentRepository::$availableContentStatues = false;
        ContentRepository::$pullFutureContent = true;

        $firstLevelContent = $this->contentService->getById($firstId);

        if (empty($firstLevelContent)) {
            throw new NotFoundHttpException();
        }

        if (in_array($firstLevelContent['type'], ContentTypes::singularContentTypes())) {
            return $this->videoLessonPage(
                $request,
                $domain,
                $brand,
                $primaryPage,
                $firstSlug,
                $firstId
            );
        }

        $childrenContent =
            $this->contentService->getByParentIdWhereTypeIn(
                $firstLevelContent['id'],
                [ContentTypeHierarchyMap::$map[$firstLevelContent['type']]]
            );

        $childrenContentResultsEntity = new ContentFilterResultsEntity(['results' => $childrenContent]);

        $infoData = [
            "courses" => count($childrenContentResultsEntity),
            "xp" => $firstLevelContent->fetch('xp', 0),
        ];

        $nextLessonUrl =
            !empty($firstLevelContent->fetch('current_lesson')) ?
                $firstLevelContent->fetch('current_lesson')
                    ->fetch('url') : null;

        $nextLessonJson = $firstLevelContent['current_lesson'] ?? null;

        if (!empty($nextLessonJson)) {
            $nextLessonJson = (new ContentFilterResultsEntity(
                ['results' => [$nextLessonJson], 'total_results' => 1]
            ))->toResponseRawJson();
        } else {
            $nextLessonJson = '';
        }

        $xpBonus = $firstLevelContent->fetch('xp_bonus', 0);


        $backButton = [
            "text" => "&laquo; Learning Paths",
        ];

        // attach the trailer video from vimeo
        $firstLevelContent =
            $this->vimeoVideoSourcesDecorator->decorate(new Collection([$firstLevelContent]))
                ->first();

        $previewVideo = '';

        foreach ($firstLevelContent['video_playback_endpoints'] ?? [] as $video) {
            if ($video['height'] === 720) {
                $previewVideo = $video['file'];
            }
        }

        $progressLabelText =
            $firstLevelContent->fetch('level_rank') ? 'Level - '.$firstLevelContent->fetch('level_rank') : '';

        return view(
            'content.overview',
            [
                "parentContent" => $firstLevelContent,
                "backButton" => $backButton,
                "childContent" => $childrenContentResultsEntity->toResponseRawJson(),
                "showLevels" => true,
                "progressLabelText" => $progressLabelText,
                "infoData" => $infoData,
                "nextLessonUrl" => $nextLessonUrl,
                "nextLessonJson" => $nextLessonJson,
                "xpBonus" => $xpBonus,
            ]
        );
    }

    public function secondLevel(
        Request $request,
        $domain,
        $brand,
        $primaryPage,
        $firstSlug,
        $firstId,
        $secondSlug,
        $secondId
    ) {
        ModeDecoratorBase::$decorationMode = ModeDecoratorBase::DECORATION_MODE_MINIMUM;

        $secondContent = $this->contentService->getById($secondId);

        throw_if(empty($secondContent), new NotFoundHttpException());

        if (in_array($secondContent['type'], ContentTypes::singularContentTypes())) {
            return $this->videoLessonPage(
                $request,
                $domain,
                $brand,
                $primaryPage,
                $firstSlug,
                $firstId,
                $secondSlug,
                $secondId
            );
        }

        $firstContent = $this->contentService->getById($firstId);

        throw_if(empty($firstContent), new NotFoundHttpException());

        if ((empty($secondContent['published_on']) ||
                Carbon::parse($secondContent['published_on']) > Carbon::now() ||
                $secondContent['status'] != 'published') &&
            !(user()->isAdmin())) {
            throw new NotFoundHttpException();
        }

        // get courses for this level
        $courses = $this->contentService->getByParentId($secondContent['id']);
        $secondContentResultsEntity = new ContentFilterResultsEntity(['results' => $courses]);

        // next lesson for user
        if ($firstContent->fetch('next_lesson_level_id') == $secondContent['id']) {
            $nextLearningPathLesson = (new ContentFilterResultsEntity(
                ['results' => [$firstContent->fetch('next_lesson', [])], 'total_results' => 1]
            ))->toResponseRawJson();
        } else {
            $nextLearningPathLesson = '';
        }

        // set view data
        $infoData = [
            "courses" => count($courses),
            "xp" => $secondContent->fetch('total_xp', 0),
        ];

        $progressLabelText = 'Level - '.$firstContent->fetch('level_rank');

        $backButton = [
            "text" => "&laquo; Learning Paths",
            "url" => url()->route('platform.content.first-level', [$primaryPage, $firstSlug, $firstId]),
        ];

        return view(
            'content.overview',
            [
                'primaryPage' => $primaryPage,
                'firstSlug' => $firstSlug,
                'firstId' => $firstId,
                'secondSlug' => $secondSlug,
                'secondId' => $secondId,
                "learningPath" => $firstContent,
                "parentContent" => $secondContent,
                "childContent" => $secondContentResultsEntity->toResponseRawJson(),
                "infoData" => $infoData,
                "nextLessonUrl" => $secondContent->fetch('current_lesson')['url'] ?? '',
                "progressLabelText" => $progressLabelText,
                "nextLessonJson" => $nextLearningPathLesson,
                'backButton' => $backButton,
                'xpBonus' => $secondContent->fetch('xp'),
                'xpAmount' => $secondContent->fetch('total_xp'),
            ]
        );
    }

    public function thirdLevel(
        Request $request,
        $domain,
        $brand,
        $primaryPage,
        $firstSlug,
        $firstId,
        $secondSlug,
        $secondId,
        $thirdSlug,
        $thirdId,
    ) {
        ModeDecoratorBase::$decorationMode = ModeDecoratorBase::DECORATION_MODE_MINIMUM;

        $thirdContent = $this->contentService->getById($thirdId);
        throw_if(empty($thirdContent), new NotFoundHttpException());

        if (in_array($thirdContent['type'], ContentTypes::singularContentTypes())) {
            return $this->videoLessonPage(
                $request,
                $domain,
                $brand,
                $primaryPage,
                $firstSlug,
                $firstId,
                $secondSlug,
                $secondId,
                $thirdSlug,
                $thirdId
            );
        }

        $secondContent = $this->contentService->getById($secondId);
        throw_if(empty($secondContent), new NotFoundHttpException());

        $firstContent = $this->contentService->getById($firstId);
        throw_if(empty($firstContent), new NotFoundHttpException());

        if ((empty($thirdContent['published_on']) ||
                Carbon::parse($thirdContent['published_on']) > Carbon::now() ||
                $thirdContent['status'] != 'published') &&
            !(user()->isAdmin())) {
            throw new NotFoundHttpException();
        }

        // get courses for this level
        $courses = $this->contentService->getByParentId($thirdContent['id']);
        $thirdContentResultsEntity = new ContentFilterResultsEntity(['results' => $courses]);

        // next lesson for user
        if ($firstContent->fetch('next_lesson_level_id') == $thirdContent['id']) {
            $nextLearningPathLesson = (new ContentFilterResultsEntity(
                ['results' => [$firstContent->fetch('next_lesson', [])], 'total_results' => 1]
            ))->toResponseRawJson();
        } else {
            $nextLearningPathLesson = '';
        }

        // set view data
        $infoData = [
            "courses" => count($courses),
            "xp" => $thirdContent->fetch('total_xp', 0),
        ];

        $progressLabelText = 'Level - '.$firstContent->fetch('level_rank');

        $backButton = [
            "text" => "&laquo; Learning Paths",
            "url" => url()->route('platform.content.first-level', [$primaryPage, $firstSlug, $firstId]),
        ];

        return view(
            'content.overview',
            [
                'primaryPage' => $primaryPage,
                'firstSlug' => $firstSlug,
                'firstId' => $firstId,
                'secondSlug' => $secondSlug,
                'secondId' => $secondId,
                'thirdSlug' => $thirdSlug,
                'thirdId' => $thirdId,
                "secondContent" => $secondContent,
                "thirdContent" => $thirdContent,
                "learningPath" => $firstContent,
                "parentContent" => $thirdContent,
                "childContent" => $thirdContentResultsEntity->toResponseRawJson(),
                "infoData" => $infoData,
                "nextLessonUrl" => $thirdContent->fetch('current_lesson')['url'] ?? '',
                "progressLabelText" => $progressLabelText,
                "nextLessonJson" => $nextLearningPathLesson,
                'backButton' => $backButton,
                'xpBonus' => $thirdContent->fetch('xp'),
                'xpAmount' => $thirdContent->fetch('total_xp'),
            ]
        );
    }

    /**
     * This is always a lesson page, for now.
     */
    public function fourthLevel(
        Request $request,
        $domain,
        $brand,
        $primaryPage,
        $firstSlug,
        $firstId,
        $secondSlug,
        $secondId,
        $thirdSlug,
        $thirdId,
        $fourthSlug,
        $fourthId
    ) {
        return $this->videoLessonPage(
            $request,
            $domain,
            $brand,
            $primaryPage,
            $firstSlug,
            $firstId,
            $secondSlug,
            $secondId,
            $thirdSlug,
            $thirdId,
            $fourthSlug,
            $fourthId
        );
    }

    public function videoLessonPage(
        Request $request,
        $domain,
        $brand,
        $primaryPage,
        $firstSlug,
        $firstId,
        $secondSlug = null,
        $secondId = null,
        $thirdSlug = null,
        $thirdId = null,
        $fourthSlug = null,
        $fourthId = null
    ) {
        $firstContent = $this->contentService->getById($firstId);

        throw_if(empty($firstContent), new NotFoundHttpException());

        $contentToRenderAsLesson = $firstContent;
        $contentToRenderAsLessonParent = null;

        if (!empty($secondId)) {
            $secondContent = $this->contentService->getById($secondId);

            throw_if(empty($secondContent), new NotFoundHttpException());

            $contentToRenderAsLesson = $secondContent;
            $contentToRenderAsLessonParent = $firstContent;
        }

        if (!empty($thirdId)) {
            $thirdContent = $this->contentService->getById($thirdId);

            throw_if(empty($thirdContent), new NotFoundHttpException());

            $contentToRenderAsLesson = $thirdContent;
            $contentToRenderAsLessonParent = $secondContent;
        }

        if (!empty($fourthId)) {
            $fourthContent = $this->contentService->getById($fourthId);

            throw_if(empty($fourthContent), new NotFoundHttpException());

            $contentToRenderAsLesson = $fourthContent;
            $contentToRenderAsLessonParent = $thirdContent;
        }

        if ((empty($contentToRenderAsLesson['published_on']) ||
                Carbon::parse($contentToRenderAsLesson['published_on']) > Carbon::now() ||
                $contentToRenderAsLesson['status'] != 'published') &&
            !(user()->isAdmin())) {
            throw new NotFoundHttpException();
        }

        ContentRepository::$availableContentStatues =
            [ContentService::STATUS_PUBLISHED, ContentService::STATUS_ARCHIVED];

        if (user()->isAdmin()) {
            array_push(ContentRepository::$availableContentStatues, ContentService::STATUS_SCHEDULED);
            array_push(ContentRepository::$availableContentStatues, ContentService::STATUS_DRAFT);
        }

        if (empty($contentToRenderAsLesson)) {
            throw new NotFoundHttpException();
        }

        if ($contentToRenderAsLesson instanceof Collection && $contentToRenderAsLesson->isEmpty()) {
            return redirect()->route('members.unreleased');
        }

        ContentRepository::$pullFutureContent = false;

        if (user()->isAdmin()) {
            ContentRepository::$pullFutureContent = true;
            $unpublished = Carbon::createFromTimeString($contentToRenderAsLesson['published_on'])->isFuture();
            if ($unpublished) {
                echo '<h2 style="background:yellow;text-align:center;padding:20px;">'.
                    'ADMIN PREVIEW (publish_on: "'.$contentToRenderAsLesson['published_on'].'")'.'</h2>';
            }
        }

        if ($contentToRenderAsLesson['status'] == ContentService::STATUS_PUBLISHED) {
            ContentRepository::$availableContentStatues =
                [ContentService::STATUS_PUBLISHED];
        }

        if (!empty($contentToRenderAsLessonParent)) {
            $parentChildren = $this->contentService->getByParentId($contentToRenderAsLessonParent['id']);

            $lessonHierarchyContent =
                $parentChildren->where('id', $contentToRenderAsLesson['id'])
                    ->first();

            $nextChild = $parentChildren->getMatchOffset($lessonHierarchyContent, 1);
            $previousChild = $parentChildren->getMatchOffset($lessonHierarchyContent, -1);
        } else {
            $sort = 'published_on';

            if ($contentToRenderAsLesson['type'] == 'rhythmic-adventures-of-captain-carson' ||
                $contentToRenderAsLesson['type'] == 'diy-drum-experiments' ||
                $contentToRenderAsLesson['type'] == 'in-rhythm') {
                $sort = 'sort';
            }

            $parentChildren = $this->contentService->getFiltered(
                $request->get('page', 1),
                $request->get('limit', 10),
                '-'.$sort,
                [$contentToRenderAsLesson['type']]
            )['results'];

            // Alter 'availableContentStatues' so next/prev buttons don't link to lessons with different status.
            // (eg: don't link to archived lessons from non-archived lessons, and vice-versa)
            if ($contentToRenderAsLesson->fetch('status') === ContentService::STATUS_PUBLISHED) {
                ContentRepository::$availableContentStatues = [ContentService::STATUS_PUBLISHED];
            }
            if ($contentToRenderAsLesson->fetch('status') === ContentService::STATUS_ARCHIVED) {
                ContentRepository::$availableContentStatues = [ContentService::STATUS_ARCHIVED];
            }

            $neighbourSiblings = $this->contentService->getTypeNeighbouringSiblings(
                $contentToRenderAsLesson['type'],
                $sort,
                $sort == 'sort' ? $contentToRenderAsLesson['sort'] : $contentToRenderAsLesson['published_on'],
                1,
                $sort,
                'desc'
            );

            // Revert to previous state
            ContentRepository::$availableContentStatues =
                [ContentService::STATUS_PUBLISHED, ContentService::STATUS_ARCHIVED];

            $nextChild = $neighbourSiblings['before']->first();
            $previousChild = $neighbourSiblings['after']->first();
        }

        $contentToRenderAsLesson =
            $this->vimeoVideoSourcesDecorator->decorate(new Collection([$contentToRenderAsLesson]))
                ->first();

        $parentChildrenTrimmed = [];
        $matched = false;

        foreach ($parentChildren as $parentChildIndex => $parentChild) {
            if ((count($parentChildren) - $parentChildIndex) <= 10 && count($parentChildrenTrimmed) < 10) {
                $parentChildrenTrimmed[] = $parentChild;
            } elseif ($matched && count($parentChildrenTrimmed) < 10) {
                $parentChildrenTrimmed[] = $parentChild;
            }

            if ($parentChild['id'] == $contentToRenderAsLesson['id']) {
                $matched = true;
            }
        }

        LessonAssignmentDecorator::$decorationMode = LessonAssignmentDecorator::DECORATION_MODE_MAXIMUM;
        $this->lessonAssignmentDecorator->decorate(new Collection([$contentToRenderAsLesson]))
            ->first();

        $lessonAssignments = $contentToRenderAsLesson['assignments'] ?? [];

        $contentToRenderAsLesson['assignments'] = $lessonAssignments;

        $themeColor = 'drumeo';

        $isHiddenContentType = in_array(
            $contentToRenderAsLesson->fetch('type'),
            config('railcontent.hiddenContentTypes')
        );

        $hasLessonInfo = !empty($contentToRenderAsLesson->fetch('*fields.instructor')) ||
            !empty($contentToRenderAsLesson->fetch('data.description')) ||
            !empty($contentToRenderAsLesson['chapters']);

        $thisLessonJson = clone $contentToRenderAsLesson;
        $thisLessonJson['completed'] = true;
        $thisLessonJson = (new ContentFilterResultsEntity(
            ['results' => [$thisLessonJson], 'total_results' => 1]
        ))->toResponseRawJson();

        // temp, add instructor from the parent to all children if not set
        foreach ($parentChildrenTrimmed as $parentChildIndex => $parentChild) {
            if (empty($parentChild->fetch('fields.instructor.1')) && !empty($parent)) {
                $parentChildrenTrimmed[$parentChildIndex]['fields'][] = [
                    'key' => 'instructor',
                    'value' => $parent->fetch('fields.instructor.1'),
                    'position' => 1,
                    'type' => 'content',
                    'content_id' => $parentChild['id'],
                ];
            }
        }

        $relatedLessons = (new ContentFilterResultsEntity(
            ['results' => $parentChildrenTrimmed]
        ))->toResponseRawJson();

//        dd([
//            "parentType" => $contentToRenderAsLessonParent['type'],
//            "lessonType" => $contentToRenderAsLesson['type'],
//            "lessonContent" => $contentToRenderAsLesson,
//            "parent" => $contentToRenderAsLessonParent,
//            "parentChildren" => $parentChildren,
//            "hasSiblings" => !empty($parentChildren),
//            "nextChild" => $nextChild,
//            "previousChild" => $previousChild,
//            "isLive" => false,
//            "relatedLessons" => $relatedLessons,
//            "themeColor" => $themeColor,
//            "isHiddenContentType" => $isHiddenContentType,
//            "hasLessonInfo" => $hasLessonInfo,
//            "thisLessonJson" => $thisLessonJson,
//            "nextLessonJson" => content_to_json($nextChild),
//            "showEmail" => false,
//        ]);

        return view(
            'content.lesson',
            [
                "parentType" => $contentToRenderAsLessonParent['type'],
                "lessonType" => $contentToRenderAsLesson['type'],
                "lessonContent" => $contentToRenderAsLesson,
                "parent" => $contentToRenderAsLessonParent,
                "parentChildren" => $parentChildren,
                "hasSiblings" => !empty($parentChildren),
                "nextChild" => $nextChild,
                "previousChild" => $previousChild,
                "isLive" => false,
                "relatedLessons" => $relatedLessons,
                "themeColor" => $themeColor,
                "isHiddenContentType" => $isHiddenContentType,
                "hasLessonInfo" => $hasLessonInfo,
                "thisLessonJson" => $thisLessonJson,
                "nextLessonJson" => content_to_json($nextChild),
                "showEmail" => false,
                "firstContent" => $firstContent,
            ]
        );
    }

    public function shows(Request $request, $domain, $brand)
    {
        $showsViewData = DrumeoShowDataMapper::cards();

        return view('content.shows-index', ['shows' => $showsViewData]);
    }

    public function studentFocus(Request $request, $domain, $brand)
    {
        if (brand() === 'drumeo') {
            return $this->contentTypeCatalog($request, $domain, $brand, 'student-focus');
        }

        if (brand() === 'pianote') {
            $lessonTypes = [
                [
                    "type" => "student-reviews",
                    "thumbnail" => "https://dpwjbsxqtam5n.cloudfront.net/shows/pianote/student-review.jpg",
                ],
                [
                    "type" => "question-and-answer",
                    "thumbnail" => "https://dpwjbsxqtam5n.cloudfront.net/shows/pianote/question-answer.jpg",
                ],
            ];
        }

        if (brand() === 'guitareo') {
            $lessonTypes = [
                [
                    "type" => "student-reviews",
                    "thumbnail" => "https://d1923uyy6spedc.cloudfront.net/student-reviews-singeo.png",
                ],
                [
                    "type" => "question-and-answer",
                    "thumbnail" => "https://d1923uyy6spedc.cloudfront.net/question-answer-singeo.png",
                ],
            ];
        }

        if (brand() === 'singeo') {
            $lessonTypes = [
                [
                    "type" => "student-reviews",
                    "thumbnail" => "https://d1923uyy6spedc.cloudfront.net/student-reviews.png",
                ],
                [
                    "type" => "question-and-answer",
                    "thumbnail" => "https://d1923uyy6spedc.cloudfront.net/question-answer.png",
                ],
            ];
        }

        return view('content.student-focus', [
            "lessonTypes" => $lessonTypes,
        ]);
    }

    /**
     * @param  Request  $request
     * @param $contentId
     * @return RedirectResponse
     */
    public function jumpToContentId(
        Request $request,
        $domain,
        $brand,
        $contentId
    ) {
        $contentRow =
            DB::connection(config('railcontent.database_connection_name'))
                ->table('railcontent_content')
                ->where('id', $contentId)
                ->get()
                ->first();

        if (empty($contentRow)) {
            throw new NotFoundHttpException();
        }

        if ($contentRow->type == 'learning-path-course') {
            $hierarchyData =
                DB::connection(config('railcontent.database_connection_name'))
                    ->table('railcontent_content_hierarchy as ch_1')
                    ->select(
                        [
                            'ch_1.parent_id as level_id',
                            'ch_2.parent_id as learning_path_id',

                            'c_1.slug as level_slug',
                            'c_2.slug as learning_path_slug',

                            'ch_1.child_position as course_child_position',
                            'ch_2.child_position as level_child_position',
                        ]
                    )
                    ->join('railcontent_content_hierarchy as ch_2', 'ch_2.child_id', '=', 'ch_1.parent_id')
                    ->join('railcontent_content as c_1', 'c_1.id', '=', 'ch_1.parent_id')
                    ->join('railcontent_content as c_2', 'c_2.id', '=', 'ch_2.parent_id')
                    ->where('c_1.type', 'learning-path-level')
                    ->where('c_2.type', 'learning-path')
                    ->where('ch_1.child_id', $contentId)
                    ->first();

            return redirect()->route(
                'platform.content.third-level',
                [
                    'method',
                    $hierarchyData->learning_path_slug,
                    $hierarchyData->learning_path_id,
                    $hierarchyData->level_slug,
                    $hierarchyData->level_id,
                    $contentRow->slug,
                    $contentRow->id,
                ]
            );
        }

        if ($contentRow->type == 'pack-bundle') {
            $hierarchyData =
                DB::connection(config('railcontent.database_connection_name'))
                    ->table('railcontent_content_hierarchy as ch_1')
                    ->select(
                        [
                            'ch_1.parent_id as pack_id',
                            'c_1.slug as pack_slug',
                            'ch_1.child_position as child_position',
                        ]
                    )
                    ->join('railcontent_content as c_1', 'c_1.id', '=', 'ch_1.parent_id')
                    ->where('c_1.type', 'pack')
                    ->where('ch_1.child_id', $contentId)
                    ->first();

            return redirect()->route(
                'platform.packs.second-level',
                [
                    $hierarchyData->pack_slug,
                    $hierarchyData->pack_id,
                    $contentRow->slug,
                    $contentRow->id,
                ]
            );
        }

        if (empty($contentRow)) {
            throw new NotFoundHttpException();
        }
    }
}
