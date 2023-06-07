<?php

namespace App\Http\Controllers\Platform;

use App\DataMappers\Views\Railcontent\ShowDataMapper;
use App\Decorators\Content\ContentLikesDecorator;
use App\Decorators\Content\LessonAssignmentDecorator;
use App\Decorators\Content\ResourceDecorator;
use App\Decorators\Content\VimeoVideoSourcesDecorator;
use App\Http\Controllers\BaseController;
use App\Maps\ContentTypeHierarchyMap;
use App\Maps\ContentTypes;
use App\Maps\DrumeoShowDataMapper;
use App\Maps\PrimaryURLSlugToContentTypeMap;
use App\Providers\RailcontentURLProvider;
use App\Services\CalendarService;
use App\Services\User\UserAccessService;
use Carbon\Carbon;
use DateTime;
use DateTimeZone;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Modules\UserManagementSystem\Models\User;
use Railroad\Railcontent\Decorators\Decorator;
use Railroad\Railcontent\Decorators\DecoratorInterface;
use Railroad\Railcontent\Decorators\ModeDecoratorBase;
use Railroad\Railcontent\Entities\ContentFilterResultsEntity;
use Railroad\Railcontent\Repositories\ContentRepository;
use Railroad\Railcontent\Services\ConfigService;
use Railroad\Railcontent\Services\ContentFollowsService;
use Railroad\Railcontent\Services\ContentService;
use Railroad\Railcontent\Services\FullTextSearchService;
use Railroad\Railcontent\Services\MethodService;
use Railroad\Railcontent\Support\Collection;
use Railroad\Railcontent\Transformers\DataTransformer;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use App\Decorators\Content\ModeDecoratorBase as AppModeDecoratorBase;

class ContentPagesController extends BaseController
{
    private ContentService $contentService;
    private VimeoVideoSourcesDecorator $vimeoVideoSourcesDecorator;
    private LessonAssignmentDecorator $lessonAssignmentDecorator;
    private RailcontentURLProvider $railcontentURLProvider;
    private FullTextSearchService $fullTextSearchService;
    private CalendarService $calendarService;
    private ContentFollowsService $contentFollowsService;
    private ResourceDecorator $resourceDecorator;
    private MethodService $methodService;

    /**
     * @param ContentService $contentService
     * @param VimeoVideoSourcesDecorator $vimeoVideoSourcesDecorator
     * @param LessonAssignmentDecorator $lessonAssignmentDecorator
     * @param RailcontentURLProvider $railcontentURLProvider
     * @param FullTextSearchService $fullTextSearchService
     * @param CalendarService $calendarService
     * @param ContentFollowsService $contentFollowsService
     * @param ResourceDecorator $resourceDecorator
     */
    public function __construct(
        ContentService $contentService,
        VimeoVideoSourcesDecorator $vimeoVideoSourcesDecorator,
        LessonAssignmentDecorator $lessonAssignmentDecorator,
        RailcontentURLProvider $railcontentURLProvider,
        FullTextSearchService $fullTextSearchService,
        CalendarService $calendarService,
        ContentFollowsService $contentFollowsService,
        ResourceDecorator $resourceDecorator,
        MethodService $methodService
    ) {
        $this->contentService = $contentService;
        $this->vimeoVideoSourcesDecorator = $vimeoVideoSourcesDecorator;
        $this->lessonAssignmentDecorator = $lessonAssignmentDecorator;
        $this->railcontentURLProvider = $railcontentURLProvider;
        $this->fullTextSearchService = $fullTextSearchService;
        $this->calendarService = $calendarService;
        $this->contentFollowsService = $contentFollowsService;
        $this->resourceDecorator = $resourceDecorator;
        $this->methodService = $methodService;
    }

    public function contentTypeCatalog(Request $request, $domain, $brand, $contentTypeName)
    {
        ModeDecoratorBase::$decorationMode = ModeDecoratorBase::DECORATION_MODE_MINIMUM;
        ContentLikesDecorator::$decorationMode = DecoratorInterface::DECORATION_MODE_MINIMUM;

        if ($contentTypeName == 'lessons' && $brand == 'guitareo') {
            return $this->guitareoLessonsPage($request, $domain, $brand);
        }


        if ($contentTypeName == 'songs' && !user()->hasSongsAccess($brand)) {
            return redirect()->route('platform.songs-upgrade');
        }

        $lessonType = PrimaryURLSlugToContentTypeMap::$map[$contentTypeName];
        $catalogName = $contentTypeName;
        $catalogueMeta = config('railcontent.cataloguesMetadata')[$brand][$catalogName] ?? [];
        ContentRepository::$catalogMetaAllowableFilters = $catalogueMeta['allowableFilters'] ?? [];

        ContentRepository::$availableContentStatues =
            [ContentService::STATUS_PUBLISHED, ContentService::STATUS_SCHEDULED];
        ContentRepository::$pullFutureContent = true;

        // make sure we only show scheduled content if it is set in the future
        $futureScheduledContentOnly = true;

        if (user()->isAdmin()) {
            ContentRepository::$availableContentStatues =
                [ContentService::STATUS_PUBLISHED, ContentService::STATUS_SCHEDULED, ContentService::STATUS_DRAFT];
        }

        if (empty($lessonType) || empty($catalogueMeta)) {
            throw new NotFoundHttpException();
        }

        if (user()->permission_level === 'administrator') {
            ContentRepository::$availableContentStatues =
                [ContentService::STATUS_PUBLISHED, ContentService::STATUS_SCHEDULED, ContentService::STATUS_DRAFT];
        }

        ContentRepository::$pullFutureContent = false;

        $sortOverride = $lessonType === 'chord-and-scale' ? 'slug' : null;

        $defaultPage = $lessonType === 'routine' ? 12 : 20;

        ContentRepository::$pullFilterResultsOptionsAndCount = true;

        $searchTerm = null;

        if (!empty($request->get('term', null))) {
            $searchTerm = $request->get('term', null);
        }

        if (!empty($searchTerm)) {
            $searchResults = $this->fullTextSearchService->search(
                $request->get('term', null),
                $request->get('page', 1),
                $request->get('limit', 20),
                [$lessonType],
                $request->get('statuses', []),
                $request->get('sort', '-score'),
                $request->get('date_time_cutoff', null),
                $request->get('brands', null),
                $request->get('coach_ids', [])
            );

            $listLessons = new ContentFilterResultsEntity([
                'results' => $searchResults['results'],
                'total_results' => $searchResults['total_results'],
                'filter_options' => [],
            ]);
        }

        if ($contentTypeName == 'songs') {
            $listLessons = $this->contentService->getFiltered(
                $request->get('page', 1),
                $request->get('limit', $defaultPage),
                $sortOverride ?? $request->get('sort', '-popularity'),
                [$lessonType],
                $request->get('slug_hierarchy', []),
                $request->get('required_parent_ids', []),
                $request->get('required_fields', []),
                $request->get('included_fields', []),
                $request->get('required_user_states', []),
                $request->get('included_user_states', []),
                true
            );
        } else {
            ContentRepository::$pullFutureContent = true;

            $listLessons = $this->contentService->getFiltered(
                $request->get('page', 1),
                $request->get('limit', $defaultPage),
                $sortOverride ?? $request->get('sort', '-published_on'),
                [$lessonType],
                $request->get('slug_hierarchy', []),
                $request->get('required_parent_ids', []),
                $request->get('required_fields', []),
                $request->get('included_fields', []),
                $request->get('required_user_states', []),
                $request->get('included_user_states', []),
                true,
                false,
                true,
                false,
                $futureScheduledContentOnly
            );

        }

        ContentRepository::$pullFilterResultsOptionsAndCount = false;

        $routinesCount = $recentRoutines = null;
        $hasRecentRoutines = false;

        if ($lessonType === 'routine') {
            $recentRoutines = $this->getUsersStartedRoutinesContent();

            $hasRecentRoutines = count($recentRoutines->results()) > 0;

            $recentRoutines = $recentRoutines->toResponseRawJson();

            $routinesCount = $listLessons['total_results'];
        }

        $isStudentFocus = in_array($lessonType, ['student-review', 'question-and-answer']);

        // Todo: make a migration to change all "student-focus" lessons to "student-review" lessons so they're in line
        //  with the other brands. Then delete this ↓
        if ($brand == 'drumeo') {
            $isStudentFocus = in_array($lessonType, ['student-focus', 'question-and-answer']);
        }

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

        if ($lessonType === 'routine') {
            $hasStartedLessons = false;
        }
        if ($contentTypeName == 'songs') {
            return view('content.songs-catalogue', [
                "listLessons" => $listLessons->toResponseRawJson(),
                "startedLessons" => $startedListLessons,
                "hasStartedLessons" => $hasStartedLessons,
                "lessonType" => $lessonType,
                "sortOverride" => '-popularity',
                "isStudentFocus" => $isStudentFocus,
                "hasRecentRoutines" => $hasRecentRoutines,
                "routinesCount" => $routinesCount,
                "catalogueMeta" => $catalogueMeta,
                "artistsNumber" => count($listLessons->filterOptions()['artist'] ?? []),
                "songsNumber" => $listLessons->totalResults(),
                "searchTerm" => $searchTerm,
                "statuses" => ContentRepository::$availableContentStatues,
                "futureScheduledContentOnly" => $futureScheduledContentOnly
            ]);
        } else {
            return view('content.catalogue', [
                "listLessons" => $listLessons->toResponseRawJson(),
                "startedLessons" => $startedListLessons,
                "hasStartedLessons" => $hasStartedLessons,
                "lessonType" => $lessonType,
                "sortOverride" => $sortOverride,
                "isStudentFocus" => $isStudentFocus,
                "hasRecentRoutines" => $hasRecentRoutines,
                "routinesCount" => $routinesCount,
                "catalogueMeta" => $catalogueMeta,
                "searchTerm" => $searchTerm,
                "statuses" => ContentRepository::$availableContentStatues,
                "futureScheduledContentOnly" => $futureScheduledContentOnly
            ]);
        }
    }

    public function firstLevel(Request $request, $domain, $brand, $primaryPage, $firstSlug, $firstId)
    {
        if ($primaryPage == 'songs' && !user()->hasSongsAccess($brand)) {
            return redirect()->route('platform.songs-upgrade');
        }

        ModeDecoratorBase::$decorationMode = ModeDecoratorBase::DECORATION_MODE_MINIMUM;
        ContentLikesDecorator::$decorationMode = DecoratorInterface::DECORATION_MODE_MINIMUM;

        ContentRepository::$availableContentStatues = false;
        ContentRepository::$pullFutureContent = true;

        ContentRepository::$availableContentStatues =
            [ContentService::STATUS_PUBLISHED, ContentService::STATUS_ARCHIVED];

        if (user()->isAdmin()) {
            array_push(ContentRepository::$availableContentStatues, ContentService::STATUS_SCHEDULED);
            array_push(ContentRepository::$availableContentStatues, ContentService::STATUS_DRAFT);
        }
        $classicalMethodPack = null;
        $classicalMethodPackJson = null;

        $firstLevelContent = $this->contentService->getById($firstId);

        if (empty($firstLevelContent)) {
            throw new NotFoundHttpException();
        }

        $nextContentForUser = $this->contentService->getNextContentForParentContentForUser(
            $firstLevelContent['id'],
            auth()->id()
        );

        if ($primaryPage == 'songs') {
            return $this->drumeoSongPage($request, $domain, $brand, $primaryPage, $firstSlug, $firstId);
        }

        $areMultipartSongs =
            (in_array($primaryPage, ['songs', 'play-alongs']) && (in_array($brand, ['pianote', 'guitareo'])));
        if (in_array($firstLevelContent['type'], ContentTypes::singularContentTypes()) && !$areMultipartSongs) {
            return $this->videoLessonPage(
                $request,
                $domain,
                $brand,
                $primaryPage,
                $firstSlug,
                $firstId
            );
        }

        $childrenContent = $firstLevelContent['units'] ??
            $this->contentService->getByParentId(
                $firstLevelContent['id']
            );

        $childrenContentResultsEntity = new ContentFilterResultsEntity(['results' => $childrenContent]);
        $childrenLabel = config('railcontent.children_name_mapping')[brand()][$firstLevelContent['type']] ?? 'lessons';
        $infoData["$childrenLabel"] = count($childrenContentResultsEntity->results());

        $infoData['xp'] = $firstLevelContent->fetch('total_xp', 0);

        $nextLessonUrl = $nextContentForUser['url'] ?? '';
        $nextLessonJson = $nextContentForUser ?? null;

        if (!empty($nextLessonJson)) {
            $nextLessonJson = (new ContentFilterResultsEntity(
                ['results' => [$nextLessonJson], 'total_results' => 1]
            ))->toResponseRawJson();
        } else {
            $nextLessonJson = '';
        }

        $xpBonus = $firstLevelContent->fetch('xp_bonus', 0);

        if ($primaryPage == "method") {
            switch (brand()) {
                case 'drumeo':
                    $methodSlug = 'drumeo-method';
                    break;
                case 'pianote':
                    $methodSlug = 'pianote-method';
                    break;
                case 'guitareo':
                    $methodSlug = 'guitareo-method';
                    break;
                case 'singeo':
                    $methodSlug = 'singeo-method';
                    break;
            }
            $methodContent = $this->contentService->getBySlugAndType($methodSlug, 'learning-path')->first();
            $backButton = [
                "text" => "&laquo; Learning Paths",
                "url" => url()->route(
                    'platform.content.first-level',
                    [$primaryPage, $methodContent['slug'], $methodContent['id']]
                ),
            ];

            if ($firstId == 276693) {
                $classicalMethodPack = $this->contentService->getById(361886);
                $classicalMethodPackJson = (new ContentFilterResultsEntity(
                    ['results' => [$classicalMethodPack], 'total_results' => 1]
                ))->toResponseRawJson();
            } else {
                $classicalMethodPack = null;
                $classicalMethodPackJson = null;
            }
        } else {
            // for the situation when $primaryPage == "courses"
            $backButton = [
                "text" => "Back to All Courses",
                "url" => url()->route('platform.content-type-catalog', ["contentTypeName" => 'courses']),
            ];
        }


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
        $collectionForDecoration = new Collection();
        $collectionForDecoration = $collectionForDecoration->merge([$firstLevelContent]);

        Decorator::$typeDecoratorsEnabled = true;
        $collectionForDecoration = $collectionForDecoration->filter();
        \App\Decorators\Content\ModeDecoratorBase::$decorationMode = ModeDecoratorBase::DECORATION_MODE_MAXIMUM;
        $collectionForDecoration = Decorator::decorate($collectionForDecoration, 'content');

        $noProgress = empty($firstLevelContent->fetch('higher_key_progress'));
        $progressLevel = 'Level - ' . (($noProgress) ? '1.1' : $firstLevelContent->fetch('higher_key_progress', '1.1'));
        $progressLabelText = ($primaryPage == 'method') ? $progressLevel : '';

        return view('content.overview', [
            "parentContent" => $firstLevelContent,
            "backButton" => $backButton,
            "childContent" => $childrenContentResultsEntity->toResponseRawJson(),
            "showLevels" => true,
            "progressLabelText" => $progressLabelText,
            "infoData" => $infoData,
            "nextLessonUrl" => $nextLessonUrl,
            "nextLessonJson" => $nextLessonJson,
            "xpBonus" => $xpBonus,
            'displayItemAsOverview' => $firstLevelContent['type'] === 'learning-path',
            'classicalMethodPack' => $classicalMethodPack,
            'classicalMethodPackJson' => $classicalMethodPackJson,
        ]);
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
        if ($primaryPage == 'songs' && !user()->hasSongsAccess($brand)) {
            return redirect()->route('platform.songs-upgrade');
        }

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
                $secondContent['status'] != 'published') && !(user()->isAdmin())) {
            throw new NotFoundHttpException();
        }

        // get courses for this level
        $courses = $this->contentService->getByParentId($secondContent['id']);
        $secondContentResultsEntity = new ContentFilterResultsEntity(['results' => $courses]);

        // next lesson for user
        $nextContentForUser = $this->contentService->getNextContentForParentContentForUser(
            $secondContent['id'],
            auth()->id()
        );
        $nextLessonUrl = $nextContentForUser['url'] ?? '';
        $nextLessonJson = $nextContentForUser ?? null;

        if (!empty($nextLessonJson)) {
            $nextLearningPathLesson = (new ContentFilterResultsEntity(
                ['results' => [$nextLessonJson], 'total_results' => 1]
            ))->toResponseRawJson();
        } else {
            $nextLearningPathLesson = '';
        }

        $childrenLabel = (config('railcontent.children_name_mapping')[brand()][$secondContent['type']]);

        // set view data
        $infoData = [
            "$childrenLabel" => count($courses),
            "xp" => $secondContent->fetch('total_xp', 0),
        ];

        $noProgress = empty($firstContent->fetch('higher_key_progress'));
        $progressLevel = 'Level - ' . (($noProgress) ? '1.1' : $firstContent->fetch('higher_key_progress', '1.1'));
        $progressLabelText = ($primaryPage == 'method') ? $progressLevel : '';

        $backButton = [
            "text" => "&laquo; Learning Paths",
            "url" => url()->route('platform.content.first-level', [$primaryPage, $firstSlug, $firstId]),
        ];

        $secondContent =
            $this->vimeoVideoSourcesDecorator->decorate(new Collection([$secondContent]))
                ->first();

        return view('content.overview', [
            'primaryPage' => $primaryPage,
            'firstSlug' => $firstSlug,
            'firstId' => $firstId,
            'secondSlug' => $secondSlug,
            'secondId' => $secondId,
            "learningPath" => $firstContent,
            "parentContent" => $secondContent,
            "childContent" => $secondContentResultsEntity->toResponseRawJson(),
            "infoData" => $infoData,
            "nextLessonUrl" => $secondContent->fetch('current_lesson')['url'] ?? $nextLessonUrl,
            "progressLabelText" => $progressLabelText,
            "nextLessonJson" => $nextLearningPathLesson,
            'backButton' => $backButton,
            'xpBonus' => $secondContent->fetch('xp'),
            'xpAmount' => $secondContent->fetch('total_xp'),
            'displayItemAsOverview' => $secondContent['type'] === 'learning-path-level' &&
                in_array(brand(), ['drumeo', 'pianote']),
        ]);
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
                $thirdContent['status'] != 'published') && !(user()->isAdmin())) {
            throw new NotFoundHttpException();
        }

        // get courses for this level
        $courses = $this->contentService->getByParentId($thirdContent['id']);
        $thirdContentResultsEntity = new ContentFilterResultsEntity(['results' => $courses]);

        // next lesson for user
        $nextContentForUser = $this->contentService->getNextContentForParentContentForUser(
            $thirdContent['id'],
            auth()->id()
        );
        $nextLessonUrl = $nextContentForUser['url'] ?? '';
        $nextLessonJson = $nextContentForUser ?? null;

        if (!empty($nextLessonJson)) {
            $nextLearningPathLesson = (new ContentFilterResultsEntity(
                ['results' => [$nextLessonJson], 'total_results' => 1]
            ))->toResponseRawJson();
        } else {
            $nextLearningPathLesson = '';
        }

        $childrenLabel = (config('railcontent.children_name_mapping')[brand()][$thirdContent['type']]);

        // set view data
        $infoData = [
            "$childrenLabel" => count($courses),
            "xp" => $thirdContent->fetch('total_xp', 0),
        ];

        $noProgress = empty($firstContent->fetch('higher_key_progress'));
        $progressLevel = 'Level - ' . (($noProgress) ? '1.1' : $firstContent->fetch('higher_key_progress', '1.1'));
        $progressLabelText = ($primaryPage == 'method') ? $progressLevel : '';

        $backButton = [
            "text" => "&laquo; Learning Paths",
            "url" => url()->route('platform.content.first-level', [$primaryPage, $firstSlug, $firstId]),
        ];

        return view('content.overview', [
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
            "nextLessonUrl" => $thirdContent->fetch('current_lesson')['url'] ?? $nextLessonUrl,
            "progressLabelText" => $progressLabelText,
            "nextLessonJson" => $nextLearningPathLesson,
            'backButton' => $backButton,
            'xpBonus' => $thirdContent->fetch('xp'),
            'xpAmount' => $thirdContent->fetch('total_xp'),
            'displayItemAsOverview' => false,
        ]);
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
        ContentLikesDecorator::$decorationMode = DecoratorInterface::DECORATION_MODE_MAXIMUM;
        ModeDecoratorBase::$decorationMode = DecoratorInterface::DECORATION_MODE_MINIMUM;
        AppModeDecoratorBase::$decorationMode = DecoratorInterface::DECORATION_MODE_MAXIMUM;

        $this->contentService->idContentCache = [];

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

        if ((
                empty($contentToRenderAsLesson['published_on']) ||
                Carbon::parse($contentToRenderAsLesson['published_on']) > Carbon::now() ||
                !in_array(
                    $contentToRenderAsLesson['status'],
                    [ContentService::STATUS_PUBLISHED, ContentService::STATUS_ARCHIVED]
                ))
            && !(user()->isAdmin())) {
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

        ContentRepository::$pullFutureContent = user()->isAdmin();
        $adminMessage = $this->getAdminMessage($contentToRenderAsLesson['published_on']);

        if ($contentToRenderAsLesson['status'] == ContentService::STATUS_PUBLISHED) {
            ContentRepository::$availableContentStatues = [ContentService::STATUS_PUBLISHED];
        }

        ModeDecoratorBase::$decorationMode = DecoratorInterface::DECORATION_MODE_MINIMUM;

        if (($contentToRenderAsLesson['type'] == 'learning-path-lesson')) {
            $parentChildren = $this->contentService->getByParentId($contentToRenderAsLessonParent['id']);
            $learningPath = \Arr::last($contentToRenderAsLesson->getParentContentData());
            $nextPrevLessons = $this->methodService->getNextAndPreviousLessons(
                $contentToRenderAsLesson['id'],
                $learningPath->id
            );
            $nextChild = $nextPrevLessons->getNextLesson();
            $previousChild = $nextPrevLessons->getPreviousLesson();
        } elseif (!empty($contentToRenderAsLessonParent)) {
            $parentChildren = $this->contentService->getByParentId($contentToRenderAsLessonParent['id']);

            $lessonHierarchyContent =
                $parentChildren->where('id', $contentToRenderAsLesson['id'])
                    ->first();

            $nextChild = $parentChildren->getMatchOffset($lessonHierarchyContent, 1);
            $previousChild = $parentChildren->getMatchOffset($lessonHierarchyContent, -1);
        } else {
            $sort = $contentToRenderAsLesson['published_on'] ? 'published_on' : 'sort';

            if ($contentToRenderAsLesson['type'] == 'rhythmic-adventures-of-captain-carson' ||
                $contentToRenderAsLesson['type'] == 'diy-drum-experiments' ||
                $contentToRenderAsLesson['type'] == 'in-rhythm') {
                $sort = 'sort';
            }

            $parentChildren =
                $this->contentService->getFiltered(
                    $request->get('page', 1),
                    $request->get('limit', 10),
                    '-' . $sort,
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
                'desc',
                $contentToRenderAsLesson['id']
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

        if (empty($contentToRenderAsLesson['assignments'] ?? [])) {
            LessonAssignmentDecorator::$decorationMode = LessonAssignmentDecorator::DECORATION_MODE_MAXIMUM;
            $this->lessonAssignmentDecorator->decorate(new Collection([$contentToRenderAsLesson]))
                ->first();
        }

        $lessonAssignments = $contentToRenderAsLesson['assignments'] ?? [];

        $contentToRenderAsLesson['assignments'] = $lessonAssignments;

        $themeColor = 'drumeo';

        $isHiddenContentType = in_array(
            $contentToRenderAsLesson->fetch('type'),
            config('railcontent.hiddenContentTypes')
        );

        $hasLessonInfo =
            !empty($contentToRenderAsLesson->fetch('*fields.instructor')) ||
            !empty($contentToRenderAsLesson->fetch('data.description')) ||
            !empty($contentToRenderAsLesson['chapters']);

        $thisLessonJson = clone $contentToRenderAsLesson;
        $thisLessonJson['completed'] = true;
        $thisLessonJson =
            (new ContentFilterResultsEntity(['results' => [$thisLessonJson], 'total_results' => 1]))->toResponseRawJson(
            );

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

        $relatedLessons = (new ContentFilterResultsEntity(['results' => $parentChildrenTrimmed]))->toResponseRawJson();

        $rangesVideoIds = [];
        if ($primaryPage == 'songs' && $brand == 'singeo') {
            $rangesVideoIds = [];
            $ranges = ['low', 'original', 'high'];
            $contentToRenderAsLesson['ranges'] = [];

            foreach ($contentToRenderAsLesson['fields'] as $field) {
                foreach ($ranges as $range) {
                    $fetchFieldTemplate = 'fields.%s_video.fields.youtube_video_id';
                    $fetchFieldString = sprintf($fetchFieldTemplate, $range);
                    $videoId = $contentToRenderAsLesson->fetch($fetchFieldString);

                    if (!empty($videoId)) {
                        $rangesVideoIds[$range] = $videoId;
                        $contentToRenderAsLesson['ranges'][] = $range;
                    }
                }

                $contentToRenderAsLesson['ranges'] = array_unique($contentToRenderAsLesson['ranges'] ?? []);
            }
        }

        return view('content.lesson', [
            "parentType" => $contentToRenderAsLessonParent['type'] ?? null,
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
            "rangesVideoIds" => $rangesVideoIds,
            "adminMessage" => $adminMessage,
        ]);
    }

    public function drumeoSongPage(Request $request, $domain, $brand, $primaryPage, $firstSlug, $firstId)
    {
        ContentRepository::$availableContentStatues =
            [ContentService::STATUS_PUBLISHED, ContentService::STATUS_ARCHIVED];

        ContentRepository::$pullFutureContent = user()->isAdmin();

        if (user()->isAdmin()) {
            array_push(
                ContentRepository::$availableContentStatues,
                ContentService::STATUS_SCHEDULED,
                ContentService::STATUS_DRAFT
            );
        }

        $lessonContent = $this->contentService->getById($firstId);

        if (empty($lessonContent)) {
            throw new NotFoundHttpException();
        }

        $adminMessage = $this->getAdminMessage($lessonContent['published_on']);

        $lessonContent =
            $this->vimeoVideoSourcesDecorator->decorate(new Collection([$lessonContent]))
                ->first();

        ResourceDecorator::$decorationMode = ResourceDecorator::DECORATION_MODE_MAXIMUM;
        $lessonContent = $this->resourceDecorator->decorate(new Collection([$lessonContent]))->first();
        ResourceDecorator::$decorationMode = ResourceDecorator::DECORATION_MODE_MINIMUM;

        LessonAssignmentDecorator::$decorationMode = LessonAssignmentDecorator::DECORATION_MODE_MAXIMUM;

        $lessonContent =
            $this->lessonAssignmentDecorator->decorate(new Collection([$lessonContent]))
                ->first();

        LessonAssignmentDecorator::$decorationMode = LessonAssignmentDecorator::DECORATION_MODE_MINIMUM;

        $lessonAssignments = $lessonContent['assignments'] ?? [];

        $lessonContent['assignments'] = $lessonAssignments;

        $themeColor = 'drumeo';

        $isHiddenContentType = in_array(
            $lessonContent->fetch('type'),
            config('railcontent.hiddenContentTypes')
        );

        $hasLessonInfo =
            !empty($lessonContent->fetch('*fields.instructor')) ||
            !empty($lessonContent->fetch('data.description')) ||
            !empty($lessonContent['chapters']);

        $thisLessonJson = clone $lessonContent;
        $thisLessonJson['completed'] = true;
        $thisLessonJson =
            (new ContentFilterResultsEntity(['results' => [$thisLessonJson], 'total_results' => 1]))->toResponseRawJson(
            );

        ContentRepository::$availableContentStatues = [ContentService::STATUS_PUBLISHED];

        $songsFromSameArtist = $this->contentService->getFiltered(
            $request->get('page', 1),
            $request->get('limit', 10),
            '-published_on',
            [$lessonContent['type']],
            [],
            [],
            ['artist,' . $lessonContent->fetch('fields.artist')]
        )['results'];

        // remove requested song if in related lessons, part one of two
        foreach ($songsFromSameArtist as $songFromSameArtistIndex => $songFromSameArtist) {
            if ($lessonContent['id'] == $songFromSameArtist['id']) {
                unset($songsFromSameArtist[$songFromSameArtistIndex]);
            }
        }

        $songsFromSameArtist = $songsFromSameArtist->sortByFieldValue('title');

        $songsFromSameStyle = new Collection();

        if (count($songsFromSameArtist) < 10) {
            $songsFromSameStyle = $this->contentService->getFiltered(
                1,
                19,
                '-published_on',
                [$lessonContent['type']],
                [],
                [],
                ['style,' . $lessonContent->fetch('fields.style')]
            )['results'];

            // remove requested song if in related lessons, part two of two (because sometimes in $songsFromSameStyle)
            foreach ($songsFromSameStyle as $songFromSameStyleIndex => $songFromSameStyle) {
                if ($lessonContent['id'] == $songFromSameStyle['id']) {
                    unset($songsFromSameStyle[$songFromSameStyleIndex]);
                }
            }

            $songsFromSameStyle = $songsFromSameStyle->sortByFieldValue('title');

            foreach ($songsFromSameStyle as $songFromSameStyleIndex => $songFromSameStyle) {
                foreach ($songsFromSameArtist as $songFromSameArtistIndex => $songFromSameArtist) {
                    if ($songFromSameStyle['id'] == $songFromSameArtist['id']) {
                        unset($songsFromSameStyle[$songFromSameStyleIndex]);
                    }
                }
            }
        }

        $relatedLessons = (new ContentFilterResultsEntity([
            'results' => array_slice(
                array_merge(
                    $songsFromSameArtist->toArray(),
                    $songsFromSameStyle->toArray()
                ),
                0,
                10
            ),
        ]))->toResponseRawJson();

        return view('content.song', [
            "lessonType" => 'songs',
            "lessonContent" => $lessonContent,
            "hasSiblings" => !empty($parentChildren),
            "relatedLessons" => $relatedLessons,
            "themeColor" => $themeColor,
            "isHiddenContentType" => $isHiddenContentType,
            "hasLessonInfo" => $hasLessonInfo,
            "thisLessonJson" => $thisLessonJson,
            "showEmail" => false,
            "adminMessage" => $adminMessage,
        ]);
    }

    public function guitareoLessonsPage(Request $request, $domain, $brand)
    {
        ModeDecoratorBase::$decorationMode = DecoratorInterface::DECORATION_MODE_MAXIMUM;
        ContentLikesDecorator::$decorationMode = DecoratorInterface::DECORATION_MODE_MAXIMUM;
        AppModeDecoratorBase::$decorationMode = DecoratorInterface::DECORATION_MODE_MAXIMUM;

        $this->contentService->idContentCache = [];

        // all members have access to all packs atm
//        if (user()->isAMember()) {
//            ContentRepository::$bypassPermissions = true;
//        }

        ContentRepository::$availableContentStatues = [ContentService::STATUS_PUBLISHED];
        ContentRepository::$pullFutureContent = false;

        $packs = [];

        $packs[] = $this->contentService->getById(217320);
        $packs[] = $this->contentService->getById(214542);
        $packs[] =
            $this->contentService->getBySlugAndType('the-ultimate-guide-to-recording-guitar', 'pack')
                ->first();
        $packs[] =
            $this->contentService->getBySlugAndType('guitar-system', 'pack')
                ->first();
        $packs = array_values(array_filter($packs));

        $guitarQuestPack =
            $this->contentService->getBySlugAndType('guitar-quest', 'pack')
                ->first();

        $newCourses = $this->contentService->getFiltered(
            1,
            10,
            '-published_on',
            ['course'],
            [],
            [],
            [],
            [],
            [],
            [],
            false
        );

        $newQuickTips = $this->contentService->getFiltered(
            1,
            10,
            '-published_on',
            ['quick-tips'],
            [],
            [],
            [],
            [],
            [],
            [],
            false
        );

        $legacyPacks = [];

        //        $legacyPacks[] = $this->contentService->getBySlugAndType('blues-guitar-blueprint', 'pack')->first();
        //        $legacyPacks[] = $this->contentService->getBySlugAndType('beginner-guitar-system', 'pack')->first();

        $topics = [
            [
                'topic' => 'Chords',
                'url' => '/guitareo/courses?required_fields[]=topic%2CChords',
            ],
            [
                'topic' => 'Fingerstyle',
                'url' => '/guitareo/courses?required_fields[]=topic%2CFingerstyle',
            ],
            [
                'topic' => 'Gear',
                'url' => '/guitareo/courses?required_fields[]=topic%2CGear',
            ],
            [
                'topic' => 'Guitar Essentials',
                'url' => '/guitareo/courses?required_fields[]=topic%2CGuitar%20Essentials',
            ],
            [
                'topic' => 'Improvisation & Soloing',
                'url' => '/guitareo/courses?required_fields[]=topic%2CImprovisation%20%26%20Soloing',
            ],
            [
                'topic' => 'Picking',
                'url' => '/guitareo/courses?required_fields[]=topic%2CPicking',
            ],
            //            [
            //                'topic' => 'Reading Music',
            //                'url' => '/guitareo/courses?required_fields[]=topic%2CReading%20Music',
            //            ],
            [
                'topic' => 'Rhythm',
                'url' => '/guitareo/courses?required_fields[]=topic%2CRhythm',
            ],
            [
                'topic' => 'Scales',
                'url' => '/guitareo/courses?required_fields[]=topic%2CScales',
            ],
            [
                'topic' => 'Songwriting',
                'url' => '/guitareo/courses?required_fields[]=topic%2CSongwriting',
            ],
            [
                'topic' => 'Technique',
                'url' => '/guitareo/courses?required_fields[]=topic%2CTechnique',
            ],
            [
                'topic' => 'Theory & Ear Training',
                'url' => '/guitareo/courses?required_fields[]=topic%2CTheory%20%26%20Ear%20Training',
            ],
        ];

        return view('content.guitareo-lessons', [
            'guitarQuestPack' => $guitarQuestPack,
            'packs' => $packs,
            'newCourses' => $newCourses->toResponseRawJson(),
            'newQuickTips' => $newQuickTips->toResponseRawJson(),
            'topics' => $topics,
            'legacyPacks' => $legacyPacks,
        ]);
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
     * @return ContentFilterResultsEntity
     */
    private function getUsersStartedRoutinesContent()
    {
        $lessons = $this->contentService->getPaginatedByTypesRecentUserProgressState(
            ['routine'],
            user()->id,
            'started',
            4
        );

        $totalResults = $this->contentService->countByTypesUserProgressState(
            ['routine'],
            user()->id,
            'started'
        );

        return new ContentFilterResultsEntity(['results' => $lessons, 'total_results' => $totalResults]);
    }

    /**
     * @param Request $request
     * @param $contentId
     * @return RedirectResponse
     */
    public function jumpToContentId(
        Request $request,
        $domain,
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
                    ->select([
                        'ch_1.parent_id as level_id',
                        'ch_2.parent_id as learning_path_id',

                        'c_1.slug as level_slug',
                        'c_2.slug as learning_path_slug',

                        'ch_1.child_position as course_child_position',
                        'ch_2.child_position as level_child_position',
                    ])
                    ->join('railcontent_content_hierarchy as ch_2', 'ch_2.child_id', '=', 'ch_1.parent_id')
                    ->join('railcontent_content as c_1', 'c_1.id', '=', 'ch_1.parent_id')
                    ->join('railcontent_content as c_2', 'c_2.id', '=', 'ch_2.parent_id')
                    ->where('c_1.type', 'learning-path-level')
                    ->where('c_2.type', 'learning-path')
                    ->where('ch_1.child_id', $contentId)
                    ->first();

            return redirect()->route('platform.content.third-level', [
                'method',
                $hierarchyData->learning_path_slug,
                $hierarchyData->learning_path_id,
                $hierarchyData->level_slug,
                $hierarchyData->level_id,
                $contentRow->slug,
                $contentRow->id,
            ]);
        }

        if ($contentRow->type == 'pack-bundle') {
            $hierarchyData =
                DB::connection(config('railcontent.database_connection_name'))
                    ->table('railcontent_content_hierarchy as ch_1')
                    ->select([
                        'ch_1.parent_id as pack_id',
                        'c_1.slug as pack_slug',
                        'ch_1.child_position as child_position',
                    ])
                    ->join('railcontent_content as c_1', 'c_1.id', '=', 'ch_1.parent_id')
                    ->where('c_1.type', 'pack')
                    ->where('ch_1.child_id', $contentId)
                    ->first();

            return redirect()->route('platform.packs.second-level', [
                $hierarchyData->pack_slug,
                $hierarchyData->pack_id,
                $contentRow->slug,
                $contentRow->id,
            ]);
        }
        if (in_array($contentRow->type, ContentTypes::singularContentTypes())) {
            return $this->videoLessonPage(
                $request,
                $domain,
                brand(),
                '',
                $contentRow->slug,
                $contentRow->id
            );
        }
        if (empty($contentRow)) {
            throw new NotFoundHttpException();
        }
    }

    /**
     * @param Request $request
     * @param $contentId
     * @return RedirectResponse
     */
    public function jumpToContinueContent(
        Request $request,
        $domain,
        $contentId
    ) {
        ModeDecoratorBase::$decorationMode = ModeDecoratorBase::DECORATION_MODE_MINIMUM;

        $nextContent = $this->contentService->getNextContentForParentContentForUser($contentId, user()->id);

        if (empty($nextContent)) {
            throw new NotFoundHttpException();
        }

        $urls = $this->railcontentURLProvider->getContentURLs(
            $nextContent['id'],
            $nextContent['slug'],
            $nextContent['type'],
            $nextContent
        );

        if (!empty($urls) && !empty($urls->getWebURLPath())) {
            return redirect()->to($urls->getWebURLPath());
        }

        throw new NotFoundHttpException();
    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Foundation\Application|\Illuminate\View\View
     * @throws \Doctrine\ORM\NonUniqueResultException
     */
    public function search(Request $request)
    {
        ContentRepository::$availableContentStatues =
            $request->get('statuses', ContentRepository::$availableContentStatues);

        $includedTypes = ContentTypes::searchableContentTypes();

        $lessons = $this->fullTextSearchService->search(
            $request->get('term', null),
            $request->get('page', 1),
            $request->get('limit', 20),
            $request->get('included_types', $includedTypes),
            $request->get('statuses', []),
            $request->get('sort', '-score'),
            $request->get('date_time_cutoff', null),
            $request->get('brands', null),
            $request->get('coach_ids', [])
        );

        $listLessons =
            reply()
                ->json($lessons['results'], [
                    'transformer' => DataTransformer::class,
                    'totalResults' => $lessons['total_results'],
                ])
                ->content();

        return view('content.search', [
            "lessons" => $listLessons,
            "searchTerm" => $request->get('term', null),
            "totalResults" => $lessons['total_results'],
            "includedTypes" => json_encode($includedTypes),
        ]);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Foundation\Application|\Illuminate\View\View
     */
    public function newLessonsPage(Request $request)
    {
        ModeDecoratorBase::$decorationMode = ModeDecoratorBase::DECORATION_MODE_MINIMUM;

        $lessonType = ContentTypes::newContentTypes();
        $filteredType = $request->get('included_types');

        ContentRepository::$availableContentStatues =
            [ContentService::STATUS_PUBLISHED, ContentService::STATUS_SCHEDULED];

        ContentRepository::$pullFutureContent = false;
        ContentRepository::$pullFilterResultsOptionsAndCount = false;

        $listLessons = $this->contentService->getFiltered(
            $request->get('page', 1),
            $request->get('limit', 20),
            '-published_on',
            $filteredType ?? $lessonType,
            $request->get('slug_hierarchy', []),
            $request->get('required_parent_ids', []),
            $request->get('required_fields', []),
            $request->get('included_fields', []),
            $request->get('required_user_states', []),
            $request->get('included_user_states', [])
        );

        $catalogueMeta = config('railcontent.cataloguesMetadata')[brand()]['all'] ?? [];
        $adminMessage = null;
        return view('content.catalogue', [
            "listLessons" => $listLessons->toResponseRawJson(),
            "hasStartedLessons" => false,
            'isAllContent' => true,
            "lessonType" => implode(',', $listLessons['filter_options']['type']),
            "totalResults" => $listLessons['total_results'],
            "catalogueMeta" => $catalogueMeta,
            "adminMessage" => $adminMessage,
        ]);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\View\View
     */
    public function schedule(Request $request)
    {
        $fullTimezoneString = $this->calendarService->getTimezone($request);

        $scheduleEvents = $this->contentService->getContentForCalendar(null, false);

        $timezones = $this->getTimezoneList();

        foreach ($scheduleEvents as $event) {
            $event['assignments'] = null;
            $event['lessons'] = null;
            $event['current_lesson'] = null;
        }

        return view('content.schedule', [
            "scheduleEvents" => json_encode($scheduleEvents),
            "fullTimezoneString" => $fullTimezoneString,
            "timezones" => $timezones,
        ]);
    }

    private function getTimezoneList()
    {
        $regions = [
            'Africa' => DateTimeZone::AFRICA,
            'America' => DateTimeZone::AMERICA,
            'Antarctica' => DateTimeZone::ANTARCTICA,
            'Aisa' => DateTimeZone::ASIA,
            'Atlantic' => DateTimeZone::ATLANTIC,
            'Australia' => DateTimeZone::AUSTRALIA,
            'Europe' => DateTimeZone::EUROPE,
            'Indian' => DateTimeZone::INDIAN,
            'Pacific' => DateTimeZone::PACIFIC,
        ];

        $formattedTimeZones = [];

        foreach ($regions as $name => $mask) {
            $zones = DateTimeZone::listIdentifiers($mask);

            foreach ($zones as $timezone) {
                $dateTimeZone = new DateTimeZone($timezone);
                try {
                    $time = new DateTime(null, $dateTimeZone);
                    $formattedTimeForZone = ' - ' . $time->format('g:i a');
                } catch (\Exception $e) {
                    error_log($e);
                }

                $formattedTimeZones[] = $timezone . ($formattedTimeForZone ?? '');
            }
        }

        return $formattedTimeZones;
    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Foundation\Application|\Illuminate\View\View
     */
    public function subscribedContent(Request $request)
    {
        ModeDecoratorBase::$decorationMode = ModeDecoratorBase::DECORATION_MODE_MINIMUM;
        LessonAssignmentDecorator::$decorationMode = LessonAssignmentDecorator::DECORATION_MODE_MINIMUM;

        $includedTypes =
            array_merge(
                config('railcontent.coachContentTypes', []),
                config('railcontent.showTypes', [])[config('railcontent.brand')] ?? []
            );
        $lessonType = $request->get('included_types', $includedTypes);

        $followedLessons =
            $this->contentFollowsService->getLessonsForFollowedCoaches(
                config('railcontent.brand'),
                $lessonType,
                [],
                $request->get('page', 1),
                $request->get('limit', 20)
            );

        $catalogueMeta = config('railcontent.cataloguesMetadata')[brand()]['subscribed'] ?? [];

        return view('content.catalogue', [
            "hasStartedLessons" => false,
            'isAllContent' => true,
            "listLessons" => $followedLessons->toResponseRawJson(),
            "lessonType" => implode(',', array_map('ucfirst', $followedLessons->filterOptions()['type'] ?? [])),
            "endpointOverride" => "/railcontent/followed-lessons",
            "totalResults" => $followedLessons['total_results'],
            "catalogueMeta" => $catalogueMeta,
        ]);
    }

    /**
     * @param Request $request
     * @param $domain
     * @param $brand
     * @param $contentId
     * @param $commentId
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Foundation\Application|RedirectResponse|\Illuminate\Routing\Redirector
     * @throws \Doctrine\ORM\NonUniqueResultException
     */
    public function jumpToContentComment(
        Request $request,
        $domain,
        $brand,
        $contentId,
        $commentId
    ) {
        ContentRepository::$availableContentStatues = false;
        ContentRepository::$pullFutureContent = true;

        $content = $this->contentService->getById($contentId);

        if (empty($content)) {
            throw new NotFoundHttpException();
        }

        $url = $content->fetch('url', '');

        return redirect($url . '?goToComment=' . $commentId);
    }

    private function getAdminMessage($published_on): ?string
    {
        if (user()->isAdmin()) {
            ContentRepository::$pullFutureContent = true;
            if ($published_on) {
                $unpublished =
                    Carbon::createFromTimeString($published_on)
                        ->isFuture();
                if ($unpublished) {
                    return 'ADMIN PREVIEW (Published On: "' .
                        $published_on .
                        '")';
                }
            } else {
                return 'ADMIN PREVIEW (Draft)';
            }
        }
        return null;
    }

    public function comments()
    {
        if (!user()->isAdmin()) {
            throw new NotFoundHttpException();
        }

        return view('content.comments');
    }
}
