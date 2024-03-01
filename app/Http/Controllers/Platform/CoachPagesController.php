<?php

namespace App\Http\Controllers\Platform;

use App\Decorators\Content\VimeoVideoSourcesDecorator;
use App\Services\LiveStreamEventService;
use Carbon\Carbon;
use Illuminate\Contracts\View\Factory;
use Illuminate\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\View\View;
use Railroad\Railcontent\Decorators\DecoratorInterface;
use Railroad\Railcontent\Decorators\ModeDecoratorBase;
use Railroad\Railcontent\Entities\ContentFilterResultsEntity;
use Railroad\Railcontent\Repositories\ContentRepository;
use Railroad\Railcontent\Services\ContentFollowsService;
use Railroad\Railcontent\Services\ContentService;
use Railroad\Railcontent\Support\Collection;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class CoachPagesController extends Controller
{
    /**
     * @var ContentService
     */
    private $contentService;

    /**
     * @var VimeoVideoSourcesDecorator
     */
    private $vimeoVideoSourcesDecorator;

    /**
     * @var LiveStreamEventService
     */
    private $liveStreamEventService;

    /**
     * @var ContentFollowsService
     */
    private $contentFollowService;

    const NOT_LIVE_PAGE_SWITCH_MINUTES = 30;

    /**
     * CourseController constructor.
     *
     * @param ContentService $contentService
     */
    public function __construct(
        ContentService $contentService,
        VimeoVideoSourcesDecorator $vimeoVideoSourcesDecorator,
        LiveStreamEventService $liveStreamEventService,
        ContentFollowsService $contentFollowService
    ) {
        $this->contentService = $contentService;
        $this->vimeoVideoSourcesDecorator = $vimeoVideoSourcesDecorator;
        $this->liveStreamEventService = $liveStreamEventService;
        $this->contentFollowService = $contentFollowService;
    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\Foundation\Application|Factory|Application|View
     * @throws \Exception
     */
    public function coaches(Request $request)
    {
        $previousStatuses = ContentRepository::$availableContentStatues;
        $previousPullFutureContent = ContentRepository::$pullFutureContent;

        if (user()->isAdmin()) {
            ContentRepository::$pullFutureContent = true;
            ContentRepository::$availableContentStatues =
                [ContentService::STATUS_PUBLISHED, ContentService::STATUS_SCHEDULED, ContentService::STATUS_DRAFT];
        }

        $lessonType = 'instructor';

        $catalogueMeta = config('railcontent.cataloguesMetadata')[brand()]['coaches'] ?? [];
        ContentRepository::$catalogMetaAllowableFilters = $catalogueMeta['allowableFilters'] ?? [];
        ContentRepository::$countFilterOptionItems = true;

        $coaches = $this->contentService->getFiltered(
            $request->get('page', 1),
            $request->get('limit', 18),
            $request->get('sort', 'slug'),
            [$lessonType],
            [],
            [],
            ['is_coach,1'],
            [],
            [],
            [],
            true,
            false,
            true,
            $request->get('only_subscribed', false)
        );

        $activeCoaches = $this->contentService->getFiltered(
            1,
            20,
            'slug',
            [$lessonType],
            [],
            [],
            ['is_active,1', 'is_coach,1']
        );

        $featuredCoaches = $this->contentService->getFiltered(
            1,
            20,
            'slug',
            [$lessonType],
            [],
            [],
            ['is_featured,1', 'is_coach,1']
        );

        $themeColor = 'drumeo';
        $currentDate =
            Carbon::now()
                ->toDateTimeString();

        $currentEvent = $this->liveStreamEventService->getCurrentOrNextLiveEvent();
        ContentRepository::$availableContentStatues = [
            ContentService::STATUS_PUBLISHED,
            ContentService::STATUS_SCHEDULED,
        ];

        ContentRepository::$pullFutureContent = true;

        ContentRepository::$availableContentStatues = [ContentService::STATUS_PUBLISHED];
        ContentRepository::$pullFutureContent = false;

        if (user()->isAdmin()) {
            ContentRepository::$availableContentStatues =
                [ContentService::STATUS_PUBLISHED, ContentService::STATUS_SCHEDULED, ContentService::STATUS_DRAFT];
        }

        if ($currentEvent) {
            $youtubeId = $this->liveStreamEventService->getCurrentOrNextYoutubeEventId();
            $eventCoachSlug = $currentEvent->fetch('fields.instructor.slug');
            $eventCoachUrl = url()->route(
                'platform.content.coach.show',
                ['firstContentSlug' => $currentEvent->fetch('slug'), 'firstContentId' => $currentEvent->fetch('id'),]
            );

            $brandOverview = config('addevent.uniquekeys.brand-overview');
            $env = config('app.env') === 'production' ? 'prod' : 'sandbox';
            $coachCalendar = config('addevent.uniquekeys.by-coach')[$eventCoachSlug] ?? null;
            $currentEventCalendarId = $coachCalendar ?? $brandOverview;
        }

        $followedCoaches = $this->contentFollowService->getUserFollowedContent(
            user()->id,
            config('railcontent.brand'),
            $lessonType,
            1,
            6
        );

        $latestSubscribedLessons = $this->contentFollowService->getLessonsForFollowedCoaches(
            config('railcontent.brand'), [], [],
            1,
            4
        );

        $requiredFields = [];
        foreach ($featuredCoaches->results() as $featuredCoache) {
            $requiredFields[] = 'instructor,' . $featuredCoache['id'];
            $instructor =
                $this->contentService->getBySlugAndType($featuredCoache['slug'], 'instructor')
                    ->first();
            if ($instructor) {
                $requiredFields[] = 'instructor,' . $instructor['id'];
            }
        }

        //latest featured lessons - Show the latest lessons from all the featured coaches.
        ContentRepository::$availableContentStatues = [ContentService::STATUS_PUBLISHED];
        ContentRepository::$pullFutureContent = true;

        $includedTypes = array_merge(config('railcontent.coachContentTypes', []), config('railcontent.showTypes', [])[config('railcontent.brand')] ?? []);

        $latestLessons = $this->contentService->getFiltered(
            1,
            6,
            '-published_on',
            $includedTypes,
            [],
            [],
            $requiredFields,
            [],
            [],
            [],
            false,
            false,
            false
        );

        $upcomingCoaches = config('coaches.upcoming_coaches', []);
        $catalogueMeta = config('railcontent.cataloguesMetadata')[brand()]['coaches'] ?? [];
        return view('content.coaches-index', [
            'coaches' => $coaches,
            'activeCoaches' => $activeCoaches->results(),
            'themeColor' => $themeColor,
            'showSearch' => true,
            'coachEvent' => content_to_json([$currentEvent]),
            'currentEventCalendarId' => $currentEventCalendarId ?? null,
            'eventCoachProfileUrl' => $eventCoachUrl ?? '',
            'currentDate' => $currentDate,
            'timeCutoffMinutes' => self::NOT_LIVE_PAGE_SWITCH_MINUTES,
            'youtubeId' => $youtubeId ?? null,
            "followedCoaches" => $followedCoaches->toResponseRawJson(),
            "hasFollowedCoaches" => $followedCoaches->totalResults() > 0,
            "latestLessons" => $latestLessons->toResponseRawJson(),
            "featuredCoaches" => $featuredCoaches,
            "hasFeaturedCoaches" => $featuredCoaches->totalResults() > 0,
            "hasActiveCoaches" => $activeCoaches->totalResults() > 0,
            "latestSubscribedLessons" => $latestSubscribedLessons->toResponseRawJson(),
            "onlySubscribedCoaches" => $request->get('only_subscribed', false),
            'upcomingCoaches' => $upcomingCoaches,
            'hasUpcomingCoaches' => ($upcomingCoaches && count($upcomingCoaches) > 0),
            "catalogueMeta" => $catalogueMeta,
        ]);
    }

    /**
     * @param Request $request
     * @param $coachSlug
     * @return Factory|Application|View
     */
    public function show(Request $request, $domain, $brand, $coachSlug, $coachId)
    {
        ContentRepository::$availableContentStatues =
            [ContentService::STATUS_PUBLISHED, ContentService::STATUS_SCHEDULED];
        ContentRepository::$pullFutureContent = true;
        ModeDecoratorBase::$decorationMode = DecoratorInterface::DECORATION_MODE_MINIMUM;

        if (user()->isAdmin()) {
            ContentRepository::$availableContentStatues =
                [ContentService::STATUS_PUBLISHED, ContentService::STATUS_SCHEDULED, ContentService::STATUS_DRAFT];
        }

        ContentRepository::$countFilterOptionItems = true;
        $lessonType = 'instructor';

        $thisCoach = $this->contentService->getById($coachId);

        if (empty($thisCoach)) {
            throw new NotFoundHttpException();
        }

        $includedFields = [];
        $requiredFields = [];

        $fieldIds = [$thisCoach['id']];
        $requiredFields[] = 'instructor,' . $thisCoach['id'];

        if ($request->has('title')) {
            $requiredFields[] = 'title,%' . $request->get('title') . '%,string,like';
        }

        $includedTypes =
            array_merge(config('railcontent.coachContentTypes', []), config('railcontent.showTypes', [])[config('railcontent.brand')] ?? []);

        $catalogueMeta = config('railcontent.cataloguesMetadata')[brand()]['coach-lessons'] ?? [];
        ContentRepository::$catalogMetaAllowableFilters = $catalogueMeta['allowableFilters'] ?? [];

        $listLessons = $this->contentService->getFiltered(
            $request->get('page', 1),
            $request->get('limit', 16),
            '-published_on',
            $request->get('included_types', $includedTypes),
            $request->get('slug_hierarchy', []),
            $request->get('required_parent_ids', []),
            $request->get('required_fields', $requiredFields),
            $request->get('included_fields', $includedFields),
            $request->get('required_user_states', []),
            $request->get('included_user_states', [])
        );

        $catalogueMeta = config('railcontent.cataloguesMetadata')[$brand]['coaches'] ?? [];

        //featured lessons for coach
        $featuredLessons = $this->contentService->getFiltered(
            1,
            4,
            '-published_on',
            [],
            [],
            [],
            array_merge(['is_featured,1'], $requiredFields),
            [],
            [],
            []
        );

        $currentDate =
            Carbon::now()
                ->toDateTimeString();

        $currentEvent = $this->liveStreamEventService->getCurrentOrNextLiveEvent(null, $fieldIds);

        if ($currentEvent) {
            $youtubeId = $this->liveStreamEventService->getCurrentOrNextYoutubeEventId();
            $eventCoachSlug = $currentEvent->fetch('fields.instructor.slug');
            $eventCoachId = $currentEvent->fetch('fields.instructor.id');
            $eventCoachUrl = url()->route('platform.content.first-level',
                                          [
                                              'brand' => brand(),
                                              'primaryPage' => 'coaches',
                                              'firstContentSlug' => $eventCoachSlug,
                                              'firstContentId' => $eventCoachId
                                          ]
            );
            $brandOverview = config('addevent.uniquekeys.brand-overview');
            $env = config('app.env') === 'production' ? 'prod' : 'sandbox';
            $coachCalendar = config('addevent.uniquekeys.by-coach')[$coachSlug] ?? null;
            $currentEventCalendarId = $coachCalendar ?? $brandOverview;
        }

        return view('content.coach-show', [
            "thisCoach" => $thisCoach,
            "startedLessons" => [],
            "hasStartedLessons" => false,
            "listLessons" => $listLessons->toResponseRawJson(),
            "lessonType" => $lessonType,
            "sortOverride" => '-published_on',
            "availableContentStatues" => ContentRepository::$availableContentStatues,
            "catalogueMeta" => $catalogueMeta,
            "includedFields" => $includedFields,
            "requiredFields" => $requiredFields,
            'totalResults' => $listLessons->totalResults(),
            'includedTypes' => array_map('ucfirst', $listLessons->filterOptions()['type'] ?? []),
            'featuredLessons' => $featuredLessons->toResponseRawJson(),
            "hasFeaturedLessons" => $featuredLessons->totalResults() > 0,
            'showSearch' => true,
            'currentEvent' => $currentEvent,
            'coachEvent' => content_to_json([$currentEvent]),
            'currentEventCalendarId' => $currentEventCalendarId ?? null,
            'eventCoachProfileUrl' => $eventCoachUrl ?? '',
            'currentDate' => $currentDate,
            'timeCutoffMinutes' => self::NOT_LIVE_PAGE_SWITCH_MINUTES,
            'youtubeId' => $youtubeId ?? null,
        ]);
    }

    /**
     * @param Request $request
     * @param $lessonType
     * @param $lessonId
     * @param bool $redirectToFirstChild
     * @return Factory|Application|RedirectResponse|View
     */
    public function stream(Request $request, $domain, $brand, $coachSlug, $streamSlug, $streamId)
    {
        ContentRepository::$availableContentStatues =
            [ContentService::STATUS_PUBLISHED, ContentService::STATUS_ARCHIVED];

        if (user()->isAdmin()) {
            array_push(ContentRepository::$availableContentStatues, ContentService::STATUS_SCHEDULED);
            array_push(ContentRepository::$availableContentStatues, ContentService::STATUS_DRAFT);
        }

        $lessonContent = $this->contentService->getById($streamId);

        if (!$lessonContent || ($lessonContent instanceof Collection && $lessonContent->isEmpty())) {
            throw new NotFoundHttpException();
        }

        if ($lessonContent['status'] == ContentService::STATUS_PUBLISHED) {
            ContentRepository::$availableContentStatues = [ContentService::STATUS_PUBLISHED];
        }

        $sort = 'published_on';

        $parentChildren = $this->contentService->getFiltered(
            $request->get('page', 1),
            $request->get('limit', 10),
            '-' . $sort,
            [$lessonContent['type']]
        )['results'];

        // Alter 'availableContentStatues' so next/prev buttons don't link to lessons with different status.
        // (eg: don't link to archived lessons from non-archived lessons, and vice-versa)
        if ($lessonContent->fetch('status') === ContentService::STATUS_PUBLISHED) {
            ContentRepository::$availableContentStatues = [ContentService::STATUS_PUBLISHED];
        }
        if ($lessonContent->fetch('status') === ContentService::STATUS_ARCHIVED) {
            ContentRepository::$availableContentStatues = [ContentService::STATUS_ARCHIVED];
        }

        $neighbourSiblings = $this->contentService->getTypeNeighbouringSiblings(
            $lessonContent['type'],
            $sort,
            $sort == 'sort' ? $lessonContent['sort'] : $lessonContent['published_on'],
            1,
            $sort,
            'desc',
            $lessonContent['id']
        );

        // Revert to previous state
        ContentRepository::$availableContentStatues =
            [ContentService::STATUS_PUBLISHED, ContentService::STATUS_ARCHIVED];

        $nextChild = $neighbourSiblings['before']->first();
        $previousChild = $neighbourSiblings['after']->first();
        $lessonContent =
            $this->vimeoVideoSourcesDecorator->decorate(new Collection([$lessonContent]))
                ->first();

        $parentChildrenTrimmed = [];
        $matched = false;

        foreach ($parentChildren as $parentChildIndex => $parentChild) {
            if ((count($parentChildren) - $parentChildIndex) <= 10 && count($parentChildrenTrimmed) < 10) {
                $parentChildrenTrimmed[] = $parentChild;
            } elseif ($matched && count($parentChildrenTrimmed) < 10) {
                $parentChildrenTrimmed[] = $parentChild;
            }

            if ($parentChild['id'] == $lessonContent['id']) {
                $matched = true;
            }
        }

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


        $thisCoach = $this->contentService->getBySlugAndType($coachSlug, 'instructor')->first();
        if (empty($thisCoach)) {
            throw new NotFoundHttpException();
        }

        $relatedLessons = ($this->contentService->getFiltered(
            $request->get('page', 1),
            $request->get('limit', 20),
            $catalogueMeta['sortBy'] ?? '-published_on',
            ['coach-stream'],
            $request->get('slug_hierarchy', []),
            $request->get('required_parent_ids', []),
            $request->get('required_fields', ['instructor,' . $thisCoach['id']]),
            $request->get('included_fields', []),
            $request->get('required_user_states', []),
            $request->get('included_user_states', [])
        ))->toResponseRawJson();

        return view('content.lesson', [
            "parentType" => null,
            "lessonType" => $lessonContent['type'],
            "lessonContent" => $lessonContent,
            "parent" => null,
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
            "coach" => $thisCoach,
        ]);
    }
}
