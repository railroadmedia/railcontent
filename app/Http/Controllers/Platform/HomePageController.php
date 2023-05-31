<?php

namespace App\Http\Controllers\Platform;

use App\Collections\PackCollection;
use App\Decorators\Content\ContentLikesDecorator;
use App\Decorators\Content\LessonAssignmentDecorator;
use App\Http\Controllers\BaseController;
use App\Http\Controllers\Content\CoachesController;
use App\Maps\ContentTypes;
use App\Modules\Content\Services\CohortService;
use App\Modules\Ecommerce\Services\UserProductService;
use App\Services\LiveStreamEventService;
use App\Services\PackService;
use App\Services\UserMetricsService;
use Illuminate\Support\Facades\Mail;
use Modules\UserManagementSystem\Models\BlockedUser;
use Railroad\Railcontent\Services\UserContentProgressService;
use Carbon\Carbon;
use Illuminate\Database\DatabaseManager;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Modules\UserManagementSystem\Models\User;
use Railroad\Points\Services\UserPointsService;
use Railroad\Railcontent\Decorators\Decorator;
use Railroad\Railcontent\Decorators\DecoratorInterface;
use Railroad\Railcontent\Decorators\ModeDecoratorBase;
use Railroad\Railcontent\Entities\ContentFilterResultsEntity;
use Railroad\Railcontent\Repositories\ContentRepository;
use Railroad\Railcontent\Services\ContentFollowsService;
use Railroad\Railcontent\Services\ContentService;
use Railroad\Railcontent\Services\UserPlaylistsService;
use Railroad\Railcontent\Support\Collection as RailcontentCollection;
use Railroad\Railforums\Repositories\PostRepository;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use App\Modules\Content\Services\CarouselService;

class HomePageController extends BaseController
{
    private ContentService $contentService;
    private ContentFollowsService $contentFollowService;
    private LiveStreamEventService $liveStreamEventService;
    private UserMetricsService $userMetricsService;
    private UserPlaylistsService $userPlaylistsService;
    private PackService $packService;
    private DatabaseManager $databaseManager;
    private UserContentProgressService $userContentProgressService;
    private CarouselService $carouselService;
    private CohortService $cohortService;
    private UserProductService $userProductService;

    /**
     * @param ContentService $contentService
     * @param ContentFollowsService $contentFollowsService
     * @param LiveStreamEventService $liveStreamEventService
     * @param UserMetricsService $userMetricsService
     * @param UserPlaylistsService $userPlaylistsService
     * @param PackService $packService
     * @param DatabaseManager $databaseManager
     * @param UserContentProgressService $userContentProgressService
     */
    public function __construct(
        ContentService $contentService,
        ContentFollowsService $contentFollowsService,
        LiveStreamEventService $liveStreamEventService,
        UserMetricsService $userMetricsService,
        UserPlaylistsService $userPlaylistsService,
        PackService $packService,
        DatabaseManager $databaseManager,
        UserContentProgressService $userContentProgressService,
        CarouselService $carouselService,
        CohortService $cohortService,
        UserProductService $userProductService
    ) {
        $this->contentService = $contentService;
        $this->contentFollowService = $contentFollowsService;
        $this->liveStreamEventService = $liveStreamEventService;
        $this->userMetricsService = $userMetricsService;
        $this->userPlaylistsService = $userPlaylistsService;
        $this->packService = $packService;
        $this->databaseManager = $databaseManager;
        $this->userContentProgressService = $userContentProgressService;
        $this->carouselService = $carouselService;
        $this->cohortService = $cohortService;
        $this->userProductService = $userProductService;
    }

    public function homeRedirect()
    {
        return redirect()->route('platform.home', ['brand' => brand()]);
    }

    public function profileRedirect()
    {
        return redirect("/".brand()."/profile/".user()->id."/dashboard");
    }

    public function paymentSettingsRedirect()
    {
        return redirect("/".brand()."/profile/".user()->id."/settings/payments");
    }

    public function notificationsRedirect()
    {
        return redirect("/".brand()."/notifications");
    }

    public function notificationSettingsRedirect()
    {
        return redirect("/".brand()."/profile/".user()->id."/settings/notifications");
    }

    public function home(Request $request, $brand)
    {
        Decorator::$typeDecoratorsEnabled = false;
        ContentRepository::$pullFilterResultsOptionsAndCount = false;
        ModeDecoratorBase::$decorationMode = ModeDecoratorBase::DECORATION_MODE_MINIMUM;
        ContentLikesDecorator::$decorationMode = DecoratorInterface::DECORATION_MODE_MINIMUM;

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
            default:
                throw new NotFoundHttpException();
        }

        ContentRepository::$availableContentStatues =
            [ContentService::STATUS_PUBLISHED, ContentService::STATUS_SCHEDULED];
        ContentRepository::$pullFutureContent = true;

        $methodContent =
            $this->contentService->getBySlugAndType($methodSlug, 'learning-path')
                ->first();

        if (empty($methodContent)) {
            return $this->homePackOnly($request, $brand);
        }

        $startedLessons = $this->getUsersStartedContent();

        $usersList = $this->getUsersList();

        $upcomingEvents = $this->contentService->getWhereTypeInAndStatusAndPublishedOnOrdered(
            ContentTypes::liveContentTypes(),
            ContentService::STATUS_SCHEDULED,
            Carbon::now()
                ->toDateTimeString(),
            '>',
            'published_on',
            'asc',
            [],
            6
        );

        ContentRepository::$availableContentStatues = [ContentService::STATUS_PUBLISHED];
        ContentRepository::$pullFutureContent = false;

        $hotForumTopics = $this->getHotForumTopics();

        $newContent = $this->getNewContents();

        $userMetrics = $this->getUserMetrics();

        $followedLessons = $this->contentFollowService->getLessonsForFollowedCoaches(
            brand(),
            array_merge(
                config('railcontent.coachContentTypes', []),
                config('railcontent.showTypes')[config('railcontent.brand')] ?? []
            ),
            [],
            1,
            4
        );

        $subscribedCoaches = $this->contentService->getFiltered(
            1,
            6,
            '-published_on',
            ['instructor'],
            [],
            [],
            [],
            [],
            [],
            [],
            false,
            false,
            false,
            true
        );

        // coaches live
        $themeColor = 'drumeo';
        $currentDate =
            Carbon::now()
                ->toDateTimeString();

        if (config('railcontent.webUpcomingEventPriorMinutes')) {
            LiveStreamEventService::$upcomingPriorMinutes = config('railcontent.webUpcomingEventPriorMinutes');
        }

        ContentRepository::$pullFilterResultsOptionsAndCount = true;
        $currentEvent = $this->liveStreamEventService->getCurrentOrNextLiveEvent();
        ContentRepository::$pullFilterResultsOptionsAndCount = false;

        $collectionForDecoration = new RailcontentCollection();
        $collectionForDecoration = $collectionForDecoration->merge([$methodContent]);
        if (!empty($currentEvent)) {
            $collectionForDecoration = $collectionForDecoration->merge([$currentEvent]);
        }
        $collectionForDecoration = $collectionForDecoration->merge($startedLessons->results());
        $collectionForDecoration = $collectionForDecoration->merge($usersList->results());
        $collectionForDecoration = $collectionForDecoration->merge($upcomingEvents);
        $collectionForDecoration = $collectionForDecoration->merge($newContent->results());
        $collectionForDecoration = $collectionForDecoration->merge($followedLessons->results());
        $collectionForDecoration = $collectionForDecoration->merge($subscribedCoaches->results());

        Decorator::$typeDecoratorsEnabled = true;
        $collectionForDecoration = $collectionForDecoration->filter();
        $collectionForDecoration = Decorator::decorate($collectionForDecoration, 'content');

        $hasGear = count(
                user()->onboardingGear->filter(function ($item) {
                    return $item->brand == brand();
                })
            ) > 0;
        $hasTopics = count(
                user()->onboardingTopics->filter(function ($item) {
                    return $item->brand == brand();
                })
            ) > 0;
        $hasGenres = count(
                user()->onboardingGenres->filter(function ($item) {
                    return $item->brand == brand();
                })
            ) > 0;

        $hasExperience = user()->onboardingExperience ? true : false;

        $hasStartedMethod = $methodContent['started'];
        $hasCompletedMethod = $methodContent['completed'];

        $nextLearningPathLevel = user()->getMethodLevel();
        $nextLearningPathProgressPercent = $methodContent['progress_percent'];

        $upcomingEventsCount = $upcomingEvents->count();
        $upcomingEvents = $upcomingEvents->sort(function ($a, $b) {
            return strtotime($a->fetch('fields.live_event_start_time')) -
                strtotime($b->fetch('fields.live_event_start_time'));
        })
            ->slice(0, 4)
            ->values();
        $upcomingEvents = new ContentFilterResultsEntity([
                                                             'results' => $upcomingEvents,
                                                             'total_results' => $upcomingEventsCount,
                                                         ]);

        if ($currentEvent) {
            $youtubeId = $this->liveStreamEventService->getCurrentOrNextYoutubeEventId();
            $eventCoachSlug = $currentEvent->fetch('fields.instructor.slug');
            $eventCoachId = $currentEvent->fetch('fields.instructor.id');
            if (!empty($eventCoachSlug) && !empty($eventCoachId)) {
                $eventCoachUrl = url()->route('platform.content.first-level', [
                    'brand' => brand(),
                    'primaryPage' => 'coaches',
                    'firstContentSlug' => $eventCoachSlug,
                    'firstContentId' => $eventCoachId,
                ]);
                $currentEventCalendarId = config('addevent.uniquekeys.by-coach')[$currentEvent->fetch(
                        'fields.instructor.slug'
                    )] ?? config('addevent.uniquekeys.brand-overview');
            } else {
                $currentEvent = null;
            }
        }

        $carousel = $this->carouselService->getCarouselSlides();

        $cohortBanner = [];
        $activeCohort = $this->cohortService->getActiveCohort();

        $hasProduct =
            user() && $this->userProductService->hasProductNotCached(user()?->id, $activeCohort['product_id'] ?? 0);

        if ($activeCohort && $hasProduct) {
            $contentId = $activeCohort['content_id'];
            if ($contentId > 0) {
                $content = $this->contentService->getById($contentId);
                $cohortBanner = [
                    'cohort_id' => $activeCohort['id'],
                    'course_url' => ($content) ? $content->fetch('url', '') : '',
                    'light_mode_logo' => $activeCohort['light_mode_logo'],
                    'dark_mode_logo' => $activeCohort['dark_mode_logo'],
                    'continue_visible' => false,
                    'close_visible' => Carbon::parse($activeCohort['cohort_end_date']) < Carbon::now(),
                ];

                $nextLesson = $this->contentService->getNextCohortLesson($contentId, user()->id);

                if ($nextLesson) {
                    $cohortBanner['lesson_url'] = $nextLesson->fetch('url');
                    $cohortBanner['published_on'] = $nextLesson->fetch('published_on');
                    $cohortBanner['published_on_in_timezone'] = $nextLesson->fetch('published_on_in_timezone');
                    $cohortBanner['title'] = $nextLesson->fetch('title');
                    $cohortBanner['thumbnail'] = $nextLesson->fetch('data.thumbnail_url');
                    $cohortBanner['continue_visible'] = true;
                    if(Carbon::parse($nextLesson->fetch('published_on')) > Carbon::now()){
                        $cohortBanner['continue_visible'] = false;
                        $cohortBanner['close_visible'] = false;
                    }
                }
                if ($content && $content['completed']) {
                    $cohortBanner['completed'] = true;
                    $cohortBanner['continue_visible'] = false;
                }
            }
        }

        return view('home.index', [
            'brand' => $brand,
            "hotForumTopics" => $hotForumTopics,
            "newContentJson" => $newContent->toResponseRawJson(),
            "startedContentJson" => $startedLessons->toResponseRawJson(),
            "startedContentCount" => count($startedLessons),
            "usersList" => $usersList->toResponseRawJson(),
            "userMetrics" => $userMetrics,
            "nextLearningPathLevel" => $nextLearningPathLevel,
            "nextLearningPathProgressPercent" => $nextLearningPathProgressPercent,
            'themeColor' => $themeColor,
            'currentDate' => $currentDate,
            'currentEvent' => $currentEvent,
            'eventCoachProfileUrl' => $eventCoachUrl ?? '',
            'calendarId' => $currentEventCalendarId ?? null,
            'coachEvent' => content_to_json([$currentEvent]),
            'youtubeId' => $youtubeId ?? null,
            'timeCutoffMinutes' => LiveStreamEventService::NOT_LIVE_PAGE_SWITCH_MINUTES,
            'followedLessons' => $followedLessons->toResponseRawJson(),
            'subscribedCoaches' => $subscribedCoaches,
            'subscribedCoachesJson' => $subscribedCoaches->toResponseRawJson(),
            "hasSubscribedCoaches" => count($subscribedCoaches->results()) > 0,
            "hasfollowedLessons" => count($subscribedCoaches->results()) > 0 && count($followedLessons->results()) > 0,
            'upcomingEvents' => $upcomingEvents->toResponseRawJson(),
            'hasUpcomingEvents' => $upcomingEvents->totalResults() > 0,
            'hasCompletedMethod' => $hasCompletedMethod,
            'hasStartedMethod' => $hasStartedMethod,
            'hasGear' => $hasGear,
            'hasGenres' => $hasGenres,
            'hasTopics' => $hasTopics,
            'hasExperience' => $hasExperience,
            'methodUrl' => url()->route('platform.content.jump-to-continue-content', $methodContent['id']),
            'completedLevelsUrl' => $methodContent['url'] ?? '',
            'carousel' => $carousel,
            'cohortBanner' => json_encode($cohortBanner),
            'existsCohortBanner' => !empty($cohortBanner),
        ]);
    }

    public function onboarding(Request $request)
    {
        return view('home.onboarding');
    }

    /**
     * @param Request $request
     * @param $brand
     * @return string
     */
    public function homePackOnly(Request $request, $brand)
    {
        $packs = $this->packService->getPacksForHome(user());;
        $hotForumTopics = $this->getHotForumTopics();
        $member = user();

        foreach ($packs as $packIndex => $pack) {
            if ($pack['slug'] == 'rock-drumming-masterclass-january-2019-semester') {
                unset($packs[$packIndex]);

                $packs->prepend($pack);
            }
        }

        $userNameToDisplay = !empty($member->first_name) ? $member->first_name : $member->display_name;

        $courses = $this->getCoursesContent();

        $userMetrics = $this->getUserMetrics();

        return view('home.pack', [
            "packs" => $packs,
            "courses" => $courses,
            "hotForumTopics" => $hotForumTopics,
            "userNameToDisplay" => $userNameToDisplay,
            "userMetrics" => $userMetrics,
            "startedContentCount" => 0 //TODO: replace with real data
        ]);
    }

    /**
     * singeo only
     *
     * @return ContentFilterResultsEntity
     */
    private function getCoursesContent()
    {
        ContentRepository::$availableContentStatues = ['published'];
        ContentRepository::$pullFutureContent = false;

        $content = $this->contentService->getFiltered(
            1,
            6,
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

        ContentRepository::$pullFutureContent = true;

        return (new ContentFilterResultsEntity(
            ['results' => $content['results'], 'total_results' => $content['results']]
        ))->toResponseRawJson();
    }

    /**
     * @return array
     */
    private function getHotForumTopics()
    {
        PostRepository::$blockedUserIds =
            BlockedUser::where('blocker_id', '=', user()->id)
                ->get()
                ->pluck('user_id')
                ->toArray();

        // latest forum posts
        $forumPosts =
            $this->databaseManager->connection(config('railforums.database_connection_name'))
                ->table('forum_threads')
                ->select(['forum_posts.*', 'forum_threads.title'])
                ->join('forum_posts', 'forum_threads.last_post_id', '=', 'forum_posts.id')
                ->limit(6)
                ->whereNull('forum_posts.deleted_at')
                ->whereNull('forum_threads.deleted_at')
                ->where('forum_posts.state', 'published')
                ->whereNotIn('forum_posts.author_id', PostRepository::$blockedUserIds)
                ->orderBy('forum_threads.last_post_id', 'desc')
                ->get();

        $usersIndexed =
            User::query()
                ->whereIn(
                    'id',
                    $forumPosts->pluck('author_id')
                        ->toArray()
                )
                ->get()
                ->keyBy('id');

        foreach ($forumPosts as $forumPostIndex => $forumPost) {
            if (isset($usersIndexed[$forumPost->author_id])) {
                $user = $usersIndexed[$forumPost->author_id];

                $forumPosts[$forumPostIndex]->user = $user;
                $forumPosts[$forumPostIndex]->content = preg_replace(
                    "~<blockquote(.*?)>(.*)</blockquote>~si",
                    "",
                    ' '.$forumPosts[$forumPostIndex]->content.' '
                );

                $forumPosts[$forumPostIndex]->user_xp = $user->getBrandTotalXp();
                $forumPosts[$forumPostIndex]->xp_rank = $user->getXpRank();
            } else {
                unset($forumPosts[$forumPostIndex]);
            }
        }

        return $forumPosts->toArray();
    }

    private function getPlayAlongStyles()
    {
        return [
            [
                'style' => 'alternative',
                'thumbnail' => 'https://dzryyo1we6bm3.cloudfront.net/card-thumbnails/play-alongs/550/drumeo-pa-alternative.jpg',
            ],
            [
                'style' => 'electronic',
                'thumbnail' => 'https://dzryyo1we6bm3.cloudfront.net/card-thumbnails/play-alongs/550/drumeo-pa-electronic.jpg',
            ],
            [
                'style' => 'funk',
                'thumbnail' => 'https://dzryyo1we6bm3.cloudfront.net/card-thumbnails/play-alongs/550/drumeo-pa-funk.jpg',
            ],
            [
                'style' => 'metal',
                'thumbnail' => 'https://dzryyo1we6bm3.cloudfront.net/card-thumbnails/play-alongs/550/drumeo-pa-metal.jpg',
            ],
            [
                'style' => 'rock',
                'required_field' => 'Pop/Rock',
                'thumbnail' => 'https://dzryyo1we6bm3.cloudfront.net/card-thumbnails/play-alongs/550/drumeo-pa-rock.jpg',
            ],
            [
                'style' => 'vocals',
                'required_field' => 'Odd Time',
                'thumbnail' => 'https://dzryyo1we6bm3.cloudfront.net/card-thumbnails/play-alongs/550/drumeo-pa-vocals.jpg',
            ],
        ];
    }

    /**
     * @return array
     */
    private function getUserMetrics()
    {
        $userProfileMetrics = $this->userMetricsService->getUserProfileMetrics(user()->id);

        return [
            "xp" => [
                "icon" => "icon-experience-points",
                "value" => user()->getBrandTotalXp(),
                "label" => user()->getXpRank(),
            ],
            "forums_likes" => [
                "icon" => "fa fa-comments",
                "value" => $userProfileMetrics->getForumPostLikes(),
                "label" => "Forum Post Likes",
            ],
            "comments" => [
                "icon" => "icon-comments-liked",
                "value" => $userProfileMetrics->getCommentLikes(),
                "label" => "Comment Likes",
            ],
            "practiced" => [
                "icon" => "icon-minutes-practiced",
                "value" => user()->getBrandMinutesPracticed(),
                "label" => "Minutes Practiced",
            ],
        ];
    }

    /**
     * @return ContentFilterResultsEntity
     */
    private function getNewContents()
    {
        ContentRepository::$availableContentStatues = ['published'];
        ContentRepository::$pullFutureContent = false;

        $contents = $this->contentService->getFiltered(
            1,
            6,
            '-published_on',
            ContentTypes::newContentTypes(),
            [],
            [],
            ['show_in_new_feed,1'],
            [],
            [],
            [],
            false,
            false,
            false
        );

        ContentRepository::$pullFutureContent = true;

        return $contents;
    }

    /**
     * @return ContentFilterResultsEntity
     */
    public function getUsersStartedContent()
    {
        $contentTypes = ContentTypes::inProgressContentTypes();

        $startedProgressRows = $this->userContentProgressService->getForUserStateContentTypes(
            auth()->id(),
            $contentTypes,
            'started',
            'updated_on',
            'desc',
            6
        );
        $lessons = $this->contentService->getByIds(array_column($startedProgressRows, 'content_id'));

        return (new ContentFilterResultsEntity(['results' => $lessons]));
    }

    /**
     * @return ContentFilterResultsEntity
     */
    public function getUsersList()
    {
        $contentTypes = ContentTypes::inProgressContentTypes();
        $userPrimaryPlaylist = \Arr::first(
            $this->userPlaylistsService->getUserPlaylist(
                user()->id,
                'primary-playlist',
                brand()
            )
        );
        if (empty($userPrimaryPlaylist)) {
            return (new ContentFilterResultsEntity(['results' => []]));
        }
        $myListId = $userPrimaryPlaylist['id'];
        ContentRepository::$includedInPlaylistsIds = [$myListId];
        $results = $this->contentService->getFiltered(
            1,
            6,
            '-published_on',
            $this->parseContentTypes($contentTypes),
            [],
            [],
            [],
            [],
            [],
            [],
            false,
            false,
            false,
            false
        );
        ContentRepository::$includedInPlaylistsIds = false;

        return $results;
    }

    /**
     * @return string
     */
    public function getNewSongs()
    {
        $songs = $this->contentService->getFiltered(
            1,
            6,
            '-published_on',
            ['song'],
            [],
            [],
            [],
            [],
            [],
            [],
            false,
            false,
            false
        );

        return (new ContentFilterResultsEntity(
            ['results' => $songs['results'], 'total_results' => $songs['total_results']]
        ))->toResponseRawJson();
    }

    /**
     * @return string
     */
    public function getNewCourses()
    {
        $courses = $this->contentService->getFiltered(
            1,
            6,
            '-published_on',
            ['course'],
            [],
            [],
            [],
            [],
            [],
            [],
            false,
            false,
            false
        );

        return (new ContentFilterResultsEntity(
            ['results' => $courses['results'], 'total_results' => $courses['total_results']]
        ))->toResponseRawJson();
    }

    /**
     * Get 4 show types ordered by newest episode
     */
    private function getNewShowTypes()
    {
        ContentRepository::$pullFutureContent = false;
        $allShowTypes = config('railcontent.showTypes')[config('railcontent.brand')] ?? [];

        // Pull 20 of the most recent shows
        $recentShows = $this->contentService->getFiltered(
            1,
            20,
            '-published_on',
            $allShowTypes,
            [],
            [],
            [],
            [],
            [],
            [],
            false,
            false,
            false
        );
        $recentShowTypes = [];

        // Keep only shows that were released in the last 7 days
        foreach ($recentShows['results'] as $recentShow) {
            $now = \Carbon\Carbon::now();
            $published = $recentShow->fetch('published_on');
            $diffInDays = $now->diffInDays($published);

            if (!in_array($recentShow->fetch('type'), $recentShowTypes) && $diffInDays < 7) {
                $recentShowTypes[] = $recentShow->fetch('type');
            }
        }

        $newShows = $recentShowTypes;
        // Merge the New Shows Array with the All Shows Array and take only unique entries
        $recentShowTypes = array_unique(array_merge($recentShowTypes, $allShowTypes));
        // Only take 4 items since that's all we need
        $recentShowTypes = array_slice($recentShowTypes, 0, 6);

        $showData = config('railcontent.cataloguesMetadata')[brand()];
        $showTypes = [];

        // Map the shows meta data to the array
        foreach ($recentShowTypes as $recentShowType) {
            foreach ($showData as $key => $value) {
                if ($recentShowType === $key) {
                    $showTypes[$key] = $value;

                    // If the item was apart of the New Shows array specify that it has
                    // a new episode
                    if (in_array($key, $newShows)) {
                        $showTypes[$key]['has_new'] = true;
                    }
                }
            }
        }

        return $showTypes;
    }

    private function getFeaturedContent()
    {
        $staffPicks = $this->contentService->getFiltered(
            1,
            20,
            '-published_on',
            ContentTypes::ourPicksContentTypes(),
            [],
            [],
            ['home_staff_pick_rating,20,integer,<='],
            [],
            [],
            [],
            false,
            false,
            false
        )
            ->results()
            ->sortByFieldValue('home_staff_pick_rating', 'asc');

        $unstartedStaffPicks = [];

        foreach ($staffPicks as $staffPick) {
            if (!$staffPick['completed'] && !$staffPick['started']) {
                $unstartedStaffPicks[] = $staffPick;
            }
        }

        if (empty($unstartedStaffPicks)) {
            return null;
        }

        return $unstartedStaffPicks[array_rand($unstartedStaffPicks)] ?? null;
    }

    private function parseContentTypes($contentTypes)
    {
        $parsedTypes = [];

        foreach ($contentTypes as $contentType) {
            switch ($contentType) {
                case 'library':
                    $parsedTypes[] = 'recording';
                    break;
                case 'recording':
                    $parsedTypes[] = 'recording';
                    break;
                case 'songs':
                    $parsedTypes[] = 'song';
                    break;
                case 'song':
                    $parsedTypes[] = 'song';
                    break;
                case 'course':
                    $parsedTypes[] = 'course';
                    break;
                case 'courses':
                    $parsedTypes[] = 'course';
                    break;
                case 'course-part':
                    $parsedTypes[] = 'course-part';
                    break;
                case 'student-focus':
                    $parsedTypes[] = 'student-focus';
                    break;
                case 'play-alongs':
                    $parsedTypes[] = 'play-along';
                    break;
                case 'pack-lesson':
                    $parsedTypes[] = 'pack-bundle-lesson';
                    break;
                default:
                    $parsedTypes[] = $contentType;
                    break;
            }
        }

        return $parsedTypes;
    }

    public function testemail(Request $request)
    {
        $host = $request->host();
        Mail::raw('Hello World!', function ($msg) use ($host) {
            $msg->to('robert@musora.com')
                ->subject("Test Email: $host");
        });
    }

    public function redirect30day()
    {
        return view('pages.redirect30day');
    }
}
