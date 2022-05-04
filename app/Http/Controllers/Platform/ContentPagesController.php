<?php

namespace App\Http\Controllers\Platform;

use App\Decorators\Content\LessonAssignmentDecorator;
use App\Decorators\Content\VimeoVideoSourcesDecorator;
use App\Http\Controllers\BaseController;
use App\Maps\ContentTypeHierarchyMap;
use Carbon\Carbon;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Railroad\Railcontent\Decorators\ModeDecoratorBase;
use Railroad\Railcontent\Entities\ContentFilterResultsEntity;
use Railroad\Railcontent\Repositories\ContentRepository;
use Railroad\Railcontent\Services\ConfigService;
use Railroad\Railcontent\Services\ContentFollowsService;
use Railroad\Railcontent\Services\ContentService;
use Railroad\Railcontent\Support\Collection;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class ContentPagesController extends BaseController
{
    private ContentService $contentService;
    private VimeoVideoSourcesDecorator $vimeoVideoSourcesDecorator;

    /**
     * @param  ContentService  $contentService
     * @param  ContentFollowsService  $contentFollowsService
     */
    public function __construct(
        ContentService $contentService,
        ContentFollowsService $contentFollowsService,
        VimeoVideoSourcesDecorator $vimeoVideoSourcesDecorator
    ) {
        $this->contentService = $contentService;
        $this->vimeoVideoSourcesDecorator = $vimeoVideoSourcesDecorator;
    }

    public function courses(Request $request, $domain)
    {
        ConfigService::$availableBrands = [brand()];
        ContentRepository::$bypassPermissions = true;

        $lessonType = 'course';
        $catalogName = 'courses';
        $catalogueMeta = config('railcontent.cataloguesMetadata')[$catalogName] ?? [];

        ContentRepository::$availableContentStatues =
            [ContentService::STATUS_PUBLISHED, ContentService::STATUS_SCHEDULED];
        ContentRepository::$pullFutureContent = true;

        if (user()->permission_level === 'administrator') {
            ContentRepository::$availableContentStatues =
                [ContentService::STATUS_PUBLISHED, ContentService::STATUS_SCHEDULED, ContentService::STATUS_DRAFT];
        }

        $futureLessons = $this->contentService->getFiltered(1, 10, '-published_on', [$lessonType]);

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
            $request->get('included_user_states', [])
        );

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

        return view('content.catalogue', [
            "listLessons" => $listLessons->toResponseRawJson(),
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

        $firstContent = $this->contentService->getById($firstId);

        throw_if(empty($firstContent), new NotFoundHttpException());

        $secondContent = $this->contentService->getById($secondId);

        throw_if(empty($secondContent), new NotFoundHttpException());

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

        $firstContent = $this->contentService->getById($firstId);

        throw_if(empty($firstContent), new NotFoundHttpException());

        $secondContent = $this->contentService->getById($secondId);

        throw_if(empty($secondContent), new NotFoundHttpException());

        $thirdContent = $this->contentService->getById($thirdId);

        throw_if(empty($thirdContent), new NotFoundHttpException());

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

        if (empty($contentRow)) {
            throw new NotFoundHttpException();
        }
    }
}
