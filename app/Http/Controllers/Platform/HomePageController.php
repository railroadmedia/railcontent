<?php

namespace App\Http\Controllers\Platform;

use App\Decorators\Content\ContentLikesDecorator;
use App\Decorators\Playlist\PlaylistDecorator;
use App\Http\Controllers\BaseController;
use App\Maps\ContentTypes;
use App\Modules\Content\ApiGateways\SanityGateway;
use App\Modules\Content\Services\CarouselService;
use App\Modules\Content\Services\CohortService;
use App\Modules\Content\Services\LearningPathsService;
use App\Modules\Ecommerce\Services\UserAccessPermissionsService;
use App\Modules\EventTracking\Avo\AvoHelper;
use App\Modules\FeatureFlagging\Facades\FeatureFlagging;
use App\Modules\UserManagementSystem\Services\OnboardingService;
use App\Services\LiveStreamEventService;
use App\Services\PackService;
use App\Services\UserMetricsService;
use Avo;
use Carbon\Carbon;
use Doctrine\ORM\ORMException;
use Illuminate\Database\DatabaseManager;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use Modules\UserManagementSystem\Models\BlockedUser;
use Modules\UserManagementSystem\Models\User;
use Modules\UserManagementSystem\Services\ExploreTasksService;
use Railroad\Railcontent\Decorators\Decorator;
use Railroad\Railcontent\Decorators\DecoratorInterface;
use Railroad\Railcontent\Decorators\Entity\AddedToPrimaryPlaylistDecorator;
use Railroad\Railcontent\Decorators\ModeDecoratorBase;
use Railroad\Railcontent\Entities\ContentFilterResultsEntity;
use Railroad\Railcontent\Repositories\ContentRepository;
use Railroad\Railcontent\Services\ContentFollowsService;
use Railroad\Railcontent\Services\ContentService;
use Railroad\Railcontent\Services\UserContentProgressService;
use Railroad\Railcontent\Services\UserPlaylistsService;
use Railroad\Railcontent\Support\Collection as RailcontentCollection;
use Railroad\Railforums\Repositories\PostRepository;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class HomePageController extends BaseController
{
    private const int DEFAULT_CONTENT_COUNT = 20;
    private const int STARTED_CONTENT_COUNT = self::DEFAULT_CONTENT_COUNT;
    private const int RECSYS_CONTENT_COUNT = 50;
    private const int WORKOUTS_CONTENT_COUNT = self::DEFAULT_CONTENT_COUNT;
    private const int NEW_RELEASES_CONTENT_COUNT = self::DEFAULT_CONTENT_COUNT;
    private const int PLAYLISTS_COUNTENT_COUNT = 24;

    public function __construct(
        private readonly ContentService $contentService,
        private readonly ContentFollowsService $contentFollowsService,
        private readonly LiveStreamEventService $liveStreamEventService,
        private readonly UserMetricsService $userMetricsService,
        private readonly UserPlaylistsService $userPlaylistsService,
        private readonly PackService $packService,
        private readonly DatabaseManager $databaseManager,
        private readonly UserContentProgressService $userContentProgressService,
        private readonly CarouselService $carouselService,
        private readonly CohortService $cohortService,
        private readonly OnboardingService $onboardingService,
        private readonly LearningPathsService $learningPathsService,
        private readonly UserAccessPermissionsService $userAccessPermissionsService,
        private readonly SanityGateway $sanityGateway,
        private readonly ExploreTasksService $exploreTasksService
    ) {
    }

    public function homeRedirect(): RedirectResponse
    {
        return redirect()->route('platform.home', ['brand' => brand()]);
    }

    public function profileRedirect(): RedirectResponse
    {
        return redirect("/" . brand() . "/profile/" . user()->id . "/dashboard");
    }

    public function paymentSettingsRedirect(): RedirectResponse
    {
        return redirect("/" . brand() . "/profile/" . user()->id . "/settings/payments");
    }

    public function notificationsRedirect(): RedirectResponse
    {
        return redirect("/" . brand() . "/notifications");
    }

    public function notificationSettingsRedirect(): RedirectResponse
    {
        return redirect("/" . brand() . "/profile/" . user()->id . "/settings/notifications");
    }

    public function home(Request $request, $musoraDomain, $brand)
    {
        if (!in_array($brand, all_brands())) {
            throw new NotFoundHttpException();
        }
        Decorator::$typeDecoratorsEnabled = false;
        ContentRepository::$pullFilterResultsOptionsAndCount = false;
        ModeDecoratorBase::$decorationMode = ModeDecoratorBase::DECORATION_MODE_MINIMUM;
        ContentLikesDecorator::$decorationMode = DecoratorInterface::DECORATION_MODE_MINIMUM;
        AddedToPrimaryPlaylistDecorator::$skip = true;

        $methodSlug = "$brand-method";

        ContentRepository::$availableContentStatues =
            [ContentService::STATUS_PUBLISHED, ContentService::STATUS_SCHEDULED];
        ContentRepository::$pullFutureContent = true;
        $originalContentStatuses = ContentRepository::$availableContentStatues;
        array_push(ContentRepository::$availableContentStatues, ContentService::STATUS_UNLISTED);
        $methodContent =
            $this->contentService->getBySlugAndType($methodSlug, 'learning-path')
                ->first();
        ContentRepository::$availableContentStatues = $originalContentStatuses;
        if (empty($methodContent)) {
            return $this->homePackOnly($request, $brand);
        }

        if (!$this->onboardingService->getBrand(user()->id)) {
            return redirect()->route('platform.onboarding');
        }

        $startedLessons = $this->getUsersStartedContent();

        $usersList = $this->getUsersPlaylist();

        ContentRepository::$availableContentStatues = [ContentService::STATUS_PUBLISHED];
        ContentRepository::$pullFutureContent = false;

        $hotForumTopics = $this->getHotForumTopics();

        if (FeatureFlagging::accessible('recsys', user())) {
            $recommendedContent = $this->getAllRecommendations();
        } else {
            $recommendedContent = new ContentFilterResultsEntity([]);
        }

        $userMetrics = $this->getUserMetrics();

        $followedLessons = $this->contentFollowsService->getLessonsForFollowedCoaches(
            brand(),
            array_merge(
                config('railcontent.coachContentTypes', []),
                config('railcontent.showTypes')[config('railcontent.brand')] ?? []
            ),
            [],
            1,
            4
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
        $collectionForDecoration = $collectionForDecoration->merge($recommendedContent->results());
        $collectionForDecoration = $collectionForDecoration->merge($followedLessons->results());

        Decorator::$typeDecoratorsEnabled = true;
        $collectionForDecoration = $collectionForDecoration->filter();
        $collectionForDecoration = Decorator::decorate($collectionForDecoration, 'content');

        $collectionForDecoration = new RailcontentCollection();
        PlaylistDecorator::$decorationMode = DecoratorInterface::DECORATION_MODE_MAXIMUM;
        $collectionForDecoration = $collectionForDecoration->merge($usersList->results());
        $collectionForDecoration = Decorator::decorate($collectionForDecoration, 'playlist');
        PlaylistDecorator::$decorationMode = DecoratorInterface::DECORATION_MODE_MINIMUM;

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

        $hasGoals = user()->onboardingGoals ? true : false;

        $nextLearningPathProgressPercent = $methodContent['progress_percent'];

        if ($currentEvent) {
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


        $brand = brand();

        $cohortBanner = [];
        $activeCohort = $this->cohortService->getActiveCohort();

        $hasProduct = user() && $this->userAccessPermissionsService->hasProductNotCached(
            user()?->id,
            $activeCohort['product_id'] ?? 0
        );

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
                    if (Carbon::parse($nextLesson->fetch('published_on')) > Carbon::now()) {
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

        $showOldTrialSection = $this->learningPathsService->showLearningPaths($brand);
        $showNewTrialSection = $this->learningPathsService->showNewLearningPaths();
        $homepageV2 = boolval(FeatureFlagging::branch('homepage-v2', user()));
        if ($showNewTrialSection) {
            $trialSection = $this->learningPathsService->getNewLearningPaths($homepageV2);
        } else if ($showOldTrialSection) {
            $trialSection = $this->learningPathsService->getLearningPaths();
        } else {
            $trialSection = [];
        }

        $userTasks = $this->exploreTasksService->uncompletedTasksForUser(user());

        return view('home.index', [
            "brand" => $brand,
            "calendarId" => $currentEventCalendarId ?? null,
            "carousel" => $carousel,
            "coachEvent" => content_to_json([$currentEvent]),
            "cohortBanner" => json_encode($cohortBanner),
            "completedLevelsUrl" => $methodContent['url'] ?? '',
            "currentDate" => $currentDate,
            "currentEvent" => $currentEvent,
            'displayTrialSection' => $showOldTrialSection,
            "eventCoachProfileUrl" => $eventCoachUrl ?? '',
            "existsCohortBanner" => !empty($cohortBanner),
            "hasExperience" => $hasExperience,
            "hasGear" => $hasGear,
            "hasGenres" => $hasGenres,
            "hasGoals" => $hasGoals,
            "hasRecommendations" => count($recommendedContent->results()) > 0,
            "hasStartedLessons" => count($followedLessons->results()) > 0,
            "hasTopics" => $hasTopics,
            "hotForumTopics" => $hotForumTopics,
            "nextLearningPathProgressPercent" => $nextLearningPathProgressPercent,
            "recommendedContentJson" => $recommendedContent->toResponseRawJson(),
            "startedContentJson" => $startedLessons->toResponseRawJson(),
            "themeColor" => $themeColor,
            "timeCutoffMinutes" => LiveStreamEventService::NOT_LIVE_PAGE_SWITCH_MINUTES,
            "trialSection" => $trialSection,
            "userMetrics" => $userMetrics,
            "usersList" => $usersList,
            "trialSectionRedesign" => $showNewTrialSection,
            "isFirstAccess" => user()->isFirstAccess(),
            "homepageV2" => $homepageV2,
            "exploreTasks" => $userTasks,
        ]);
    }

    public function onboarding(Request $request)
    {
        $newUser = !$this->onboardingService->getBrand(user()->id);
        $user = User::whereId(Auth::id())->firstOrFail();

        if ($user->primary_brand) {
            $this->onboardingService->saveInstrument(
                $this->onboardingService->getInstrumentFromBrand($user->primary_brand)
            );
        }

        Avo::onboarding_started(AvoHelper::defaultEventProperties());

        return view('home.onboarding', [
            'newUser' => $newUser,
        ]);
    }

    /**
     * @throws ORMException
     */
    public function homePackOnly(Request $request, $brand): View
    {
        $packs = $this->packService->getPacksForHome(user());
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
            "startedContentCount" => 0, //TODO: replace with real data
        ]);
    }

    /**
     * singeo only
     */
    private function getCoursesContent(): string
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

    private function getHotForumTopics(): array
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
                    ' ' . $forumPosts[$forumPostIndex]->content . ' '
                );

                $forumPosts[$forumPostIndex]->user_xp = $user->getBrandTotalXp();
                $forumPosts[$forumPostIndex]->xp_rank = $user->getXpRank();
            } else {
                unset($forumPosts[$forumPostIndex]);
            }
        }

        return $forumPosts->toArray();
    }

    private function getPlayAlongStyles(): array
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

    private function getUserMetrics(): array
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
                "icon" => "fa-solid fa-thumbs-up",
                "value" => $userProfileMetrics->getCommentLikes(),
                "label" => "Comment Likes",
            ],
            "practiced" => [
                "icon" => "fa-solid fa-stopwatch",
                "value" => user()->getBrandMinutesPracticed(),
                "label" => "Minutes Practiced",
            ],
        ];
    }

    private function getAllRecommendations(): ContentFilterResultsEntity
    {
        return $this->contentService->getRecommendedContent(
            user()->id,
            brand(),
            pageSize: self::RECSYS_CONTENT_COUNT,
        );
    }

    private function getNewContents(): ContentFilterResultsEntity
    {
        ContentRepository::$availableContentStatues = ['published'];
        ContentRepository::$pullFutureContent = false;
        $previousAllowPullSongsContent = ContentRepository::$allowsPullSongsContent;
        ContentRepository::$allowsPullSongsContent = false;
        $contents = $this->contentService->getFiltered(
            1,
            self::NEW_RELEASES_CONTENT_COUNT,
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
        ContentRepository::$allowsPullSongsContent = $previousAllowPullSongsContent;
        return $contents;
    }


    private function getWorkoutsContents(): ContentFilterResultsEntity
    {
        $oldFutureContent = ContentRepository::$pullFutureContent;
        ContentRepository::$pullFutureContent = false;
        $workouts = $this->contentService->getFiltered(
            1,
            self::WORKOUTS_CONTENT_COUNT,
            '-published_on',
            ['workout'],
            [],
            [],
            [],
            [],
            [],
            [],
            false
        );
        ContentRepository::$pullFutureContent = $oldFutureContent;
        return $workouts;
    }

    /**
     * @return ContentFilterResultsEntity
     */
    public function getUsersStartedContent(): ContentFilterResultsEntity
    {
        $contentTypes = ContentTypes::inProgressContentTypes();
        //TODO ADRIAN this needs to be handled differently as this is uses join on the railcontent_content table
        $startedProgressRows = $this->userContentProgressService->getForUserStateContentTypes(
            auth()->id(),
            $contentTypes,
            'started',
            'updated_on',
            'desc',
            self::STARTED_CONTENT_COUNT
        );
        $ids = array_column($startedProgressRows, 'content_id');
        $lessons = $ids ? $this->sanityGateway->getByRailContentIds($ids) : [];

        return (new ContentFilterResultsEntity(['results' => $lessons]));
    }

    /**
     * @return ContentFilterResultsEntity
     */
    public function getUsersPlaylist(): ContentFilterResultsEntity
    {
        $playlists = $this->userPlaylistsService->getUserPlaylist(
            userId: user()->id,
            playlistType: 'user-playlist',
            brand: brand(),
            limit: self::PLAYLISTS_COUNTENT_COUNT,
            sort: '-last_progress'
        );

        return new ContentFilterResultsEntity(['results' => $playlists]);
    }

    /**
     * @return string
     */
    public function getNewSongs()
    {
        $songs = $this->contentService->getFiltered(
            1,
            self::DEFAULT_CONTENT_COUNT,
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
            self::DEFAULT_CONTENT_COUNT,
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
            self::DEFAULT_CONTENT_COUNT,
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
            self::DEFAULT_CONTENT_COUNT,
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

    public function redirect30day(): View
    {
        return view('pages.redirect30day');
    }
}
