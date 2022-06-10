<?php

namespace App\Http\Controllers\Platform;

use App\Collections\PackCollection;
use App\Http\Controllers\BaseController;
use App\Http\Controllers\Content\CoachesController;
use App\Maps\ContentTypes;
use App\Services\LiveStreamEventService;
use App\Services\UserMetricsService;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Railroad\Points\Services\UserPointsService;
use Railroad\Railcontent\Decorators\Decorator;
use Railroad\Railcontent\Entities\ContentFilterResultsEntity;
use Railroad\Railcontent\Repositories\ContentRepository;
use Railroad\Railcontent\Services\ContentFollowsService;
use Railroad\Railcontent\Services\ContentService;
use Railroad\Railcontent\Services\UserPlaylistsService;
use Railroad\Railcontent\Support\Collection as RailcontentCollection;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class HomePageController extends BaseController
{
    private ContentService $contentService;
    private ContentFollowsService $contentFollowService;
    private LiveStreamEventService $liveStreamEventService;
    private UserMetricsService $userMetricsService;
    private UserPlaylistsService $userPlaylistsService;

    /**
     * @param ContentService $contentService
     * @param ContentFollowsService $contentFollowsService
     */
    public function __construct(
        ContentService $contentService,
        ContentFollowsService $contentFollowsService,
        LiveStreamEventService $liveStreamEventService,
        UserMetricsService $userMetricsService,
        UserPlaylistsService $userPlaylistsService
    ) {
        $this->contentService = $contentService;
        $this->contentFollowService = $contentFollowsService;
        $this->liveStreamEventService = $liveStreamEventService;
        $this->userMetricsService = $userMetricsService;
        $this->userPlaylistsService = $userPlaylistsService;
    }

    public function homeRedirect()
    {
        return redirect()->route('platform.home', ['brand' => brand()]);
    }

    public function home(Request $request, $brand)
    {
        Decorator::$typeDecoratorsEnabled = false;
        ContentRepository::$pullFilterResultsOptionsAndCount = false;

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

        $startedLessons = $this->getUsersStartedContent();

        $usersList = $this->getUsersList();

        $upcomingEvents = $this->contentService->getWhereTypeInAndStatusAndPublishedOnOrdered(
            ContentTypes::liveContentTypes(),
            ContentService::STATUS_SCHEDULED,
            Carbon::now()
                ->toDateTimeString(),
            '>',
            'published_on',
            'asc'
        );

        ContentRepository::$availableContentStatues = [ContentService::STATUS_PUBLISHED];
        ContentRepository::$pullFutureContent = false;

        $hotForumTopics = $this->getHotForumTopics();

        $newContent = $this->getNewContents();

        $userMetrics = $this->getUserMetrics();

        $followedLessons = $this->contentFollowService->getLessonsForFollowedCoaches(
            brand(),
            array_merge(config('railcontent.coachContentTypes', []), config('railcontent.showTypes', [])),
            [],
            1,
            4
        );

        $subscribedCoaches = $this->contentFollowService->getUserFollowedContent(
            user()->id,
            brand(),
            ['instructor'],
            1,
            6
        );

        $packs = $this->getPacks();

        // coaches live
        $themeColor = 'drumeo';
        $currentDate =
            Carbon::now()
                ->toDateTimeString();

        if (config('railcontent.webUpcomingEventPriorMinutes')) {
            LiveStreamEventService::$upcomingPriorMinutes = config('railcontent.webUpcomingEventPriorMinutes');
        }

        $currentEvent = $this->liveStreamEventService->getCurrentOrNextLiveEvent();

        $coachOfTheMonth = $this->contentService->getFiltered(
            1,
            1,
            '-published_on',
            ['instructor'],
            [],
            [],
            ['is_coach_of_the_month,1,boolean,='],
            [],
            [],
            [],
            false,
            false,
            false
        )
            ->results();

        $collectionForDecoration = new RailcontentCollection();
        $collectionForDecoration = $collectionForDecoration->merge([$methodContent]);
        if (!empty($currentEvent)) {
            $collectionForDecoration = $collectionForDecoration->merge([$currentEvent]);
        }
        $collectionForDecoration = $collectionForDecoration->merge($coachOfTheMonth);
        $collectionForDecoration = $collectionForDecoration->merge($startedLessons->results());
        $collectionForDecoration = $collectionForDecoration->merge($usersList->results());
        $collectionForDecoration = $collectionForDecoration->merge($upcomingEvents);
        $collectionForDecoration = $collectionForDecoration->merge($newContent->results());
        $collectionForDecoration = $collectionForDecoration->merge($packs);
        $collectionForDecoration = $collectionForDecoration->merge($followedLessons->results());
        $collectionForDecoration = $collectionForDecoration->merge($subscribedCoaches->results());

        Decorator::$typeDecoratorsEnabled = true;
        $collectionForDecoration = Decorator::decorate($collectionForDecoration, 'content');

        $hasStartedMethod = $methodContent['started'];
        $hasCompletedMethod = $methodContent['completed'];

        $nextLearningPathLesson = $methodContent['next_lesson'] ?? null;
        $showNextLearningPathLesson = !empty($methodContent['next_lesson']);

        $nextLearningPathLessonUrl = $methodContent['next_lesson']['url'] ?? '';
        $nextLearningPathLevel = $methodContent['level_rank'] ?? '1.1';
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
            $eventCoachUrl = url()->route('platform.content.first-level',
                [
                    'brand' => brand(),
                    'primaryPage' => 'coaches',
                    'firstContentSlug' => $eventCoachSlug,
                    'firstContentId' => $eventCoachId
                ]
            );
            $currentEventCalendarId = config('addevent.uniquekeys.by-coach')[$currentEvent->fetch(
                    'fields.instructor.slug'
                )] ?? config('addevent.uniquekeys.brand-overview');
        }

        return view('home.index', [
            'brand' => $brand,
            "hotForumTopics" => $hotForumTopics,
            "newContentJson" => $newContent->toResponseRawJson(),
            "startedContentJson" => $startedLessons->toResponseRawJson(),
            "startedContentCount" => $startedLessons->totalResults(),
            "usersList" => $usersList->toResponseRawJson(),
            "usersListCount" => $usersList->totalResults(),
            "userMetrics" => $userMetrics,
            "displayMethod" => !$hasStartedMethod,
            "userHasInteractedWithDrumeoMethod" => $hasStartedMethod,
            "nextLearningPathLesson" => $nextLearningPathLesson,
            "nextLearningPathLessonUrl" => $nextLearningPathLessonUrl,
            "nextLearningPathLevel" => $nextLearningPathLevel,
            "nextLearningPathProgressPercent" => $nextLearningPathProgressPercent,
            "showNextLearningPathLesson" => $showNextLearningPathLesson,
            "packs" => $packs,
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
            "hasSubscribedCoaches" => $subscribedCoaches->totalResults() > 0,
            "hasfollowedLessons" => $subscribedCoaches->totalResults() > 0 && $followedLessons->totalResults() > 0,
            'upcomingEvents' => $upcomingEvents->toResponseRawJson(),
            'hasUpcomingEvents' => $upcomingEvents->totalResults() > 0,
            'coachOfTheMonth' => $coachOfTheMonth->first(),
            'hasCompletedMethod' => $hasCompletedMethod,
            'hasStartedMethod' => $hasStartedMethod,
            'methodUrl' => $methodContent['url'] ?? '',
            'completedLevelsUrl' => $methodContent['url'] ?? '',
        ]);
    }

    /**
     * @return PackCollection
     */
    private function getPacks()
    {
        return []; // todo: after ecom
        return $this->packService->getPacks(user());
    }

    /**
     * @return array
     */
    private function getHotForumTopics()
    {
        // todo: railforums integration
        return [];
        //forum posts by administrators should not be displayed on the homepage
        $query = $this->userRepository->createQueryBuilder('user');

        $query =
            $query->select('user.id')
                ->where('user.permissionLevel IN (:permission)')
                ->setParameter('permission', ['administrator']);

        $administrators = array_column(
            $query->getQuery()
                ->getResult(),
            'id'
        );

        // latest forum posts
        $forumPosts =
            $this->databaseManager->table('forum_posts')
                ->select(['forum_posts.*', 'forum_threads.title'])
                ->leftJoin('forum_threads', 'forum_threads.id', '=', 'forum_posts.thread_id')
                ->leftJoin('forum_categories', 'forum_threads.category_id', '=', 'forum_categories.id')
                ->limit(100)
                ->whereNull('forum_posts.deleted_at')
                ->whereNull('forum_threads.deleted_at')
                ->whereNull('forum_categories.deleted_at')
                ->where('forum_posts.state', 'published')
                ->whereNotIn('forum_posts.author_id', array_values($administrators))
                ->orderBy('forum_posts.created_at', 'desc')
                ->get()
                ->groupBy('thread_id');

        $forumThreadPosts = $forumPosts->splice(0, 6);

        $forumPosts = new Collection();

        foreach ($forumThreadPosts as $threadId => $forumThreadPosts) {
            $forumPosts[] = $forumThreadPosts[0];
        }

        $query = $this->userRepository->createQueryBuilder('user');
        $users = [];

        if (!empty(
        $forumPosts->pluck('author_id')
            ->toArray()
        )) {
            $users = $query->where(
                $query->expr()
                    ->in(
                        'user.id',
                        $forumPosts->pluck('author_id')
                            ->toArray()
                    )
            )
                ->getQuery()
                ->getResult();
        }

        $usersIndexed = [];

        foreach ($users as $user) {
            $usersIndexed[$user->getId()] = $user;
        }

        foreach ($forumPosts as $forumPostIndex => $forumPost) {
            if (isset($usersIndexed[$forumPost->author_id])) {
                $user = $usersIndexed[$forumPost->author_id];
                $userXP = UserPointsService::fetchPoints($forumPost->author_id);

                $forumPosts[$forumPostIndex]->user = $user;
                $forumPosts[$forumPostIndex]->content = preg_replace(
                    "~<blockquote(.*?)>(.*)</blockquote>~si",
                    "",
                    ' ' . $forumPosts[$forumPostIndex]->content . ' '
                );

                $forumPosts[$forumPostIndex]->user_xp = $userXP;
                $forumPosts[$forumPostIndex]->xp_rank = map_experience_rank($userXP);
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
                "value" => user()->total_xp,
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
                "value" => $userProfileMetrics->getMinutesPracticed(),
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

        $lessons = $this->contentService->getPaginatedByTypesRecentUserProgressState(
            $this->parseContentTypes($contentTypes),
            user()->id,
            'started',
            6
        );

        $totalResults = $this->contentService->countByTypesUserProgressState(
            $this->parseContentTypes($contentTypes),
            user()->id,
            'started'
        );

        return (new ContentFilterResultsEntity(['results' => $lessons, 'total_results' => $totalResults]));
    }

    /**
     * @return ContentFilterResultsEntity
     */
    public function getUsersList()
    {
        $contentTypes = ContentTypes::inProgressContentTypes();

        $userPrimaryPlaylist = $this->userPlaylistsService->getUserPlaylist(auth()->id(), 'primary-playlist', brand());

        if (empty($userPrimaryPlaylist)) {
            return (new ContentFilterResultsEntity(['results' => [], 'total_results' => 0]));
        }
        $userPrimaryPlaylistId = $userPrimaryPlaylist[0]['id'];
        $usersPrimaryList = $this->userPlaylistsService->getUserPlaylistContents(
            $userPrimaryPlaylistId,
            $this->parseContentTypes($contentTypes),
            6
        );

        $usersListTotalResults = $this->userPlaylistsService->countUserPlaylistContents(
            $userPrimaryPlaylistId,
            $contentTypes
        );

        return (new ContentFilterResultsEntity(
            ['results' => $usersPrimaryList, 'total_results' => $usersListTotalResults]
        ));
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
        $allShowTypes = config('railcontent.showTypes');

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
}
