<?php

namespace App\Http\Controllers\Platform;

use App\Http\Controllers\BaseController;
use App\Maps\ContentTypes;
use App\Services\CalendarService;
use App\Services\LiveStreamEventService;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Railroad\EventDataSynchronizer\Events\LiveStreamEventAttended;
use Railroad\Permissions\Services\PermissionService;
use Railroad\Railchat\Services\RailchatService;
use Railroad\Railcontent\Entities\ContentFilterResultsEntity;
use Railroad\Railcontent\Helpers\CacheHelper;
use Railroad\Railcontent\Repositories\ContentRepository;
use Railroad\Railcontent\Services\ContentService;

class LivePageController extends BaseController
{
    /**
     * @var ContentService
     */
    private $contentService;

    /**
     * @var CalendarService
     */
    private $calendarService;

    /**
     * @var LiveStreamEventService
     */
    private $liveStreamEventService;

    /**
     * @var RailchatService
     */
    private $railchatService;

    /**
     * @var PermissionService
     */
    private $permissionService;

    const NOT_LIVE_PAGE_SWITCH_MINUTES = 15;

    public function __construct(
        ContentService $contentService,
        CalendarService $calendarService,
        LiveStreamEventService $liveStreamEventService,
        RailchatService $railchatService,
        PermissionService $permissionService
    ) {
        $this->contentService = $contentService;
        $this->calendarService = $calendarService;
        $this->liveStreamEventService = $liveStreamEventService;
        $this->railchatService = $railchatService;
        $this->permissionService = $permissionService;
    }

    public function chat(Request $request, $domain, $brand)
    {
        $userRoleAdmin = user()->isAdmin();
        $chatChannelName = config('railchat.' . $brand . '.chat_channel_name');
        $questionsChannelName = config('railchat.' . $brand . '.questions_channel_name');
        $embedUrl = config('railchat.' . $brand . '.embed_url');

        $userData = [
            'id' => user()->id,
            'displayName' => user()->display_name,
            'avatarUrl' => user()->profile_picture_url,
            'profileUrl' => user()->getDashboardUrl(),
            'role' => $userRoleAdmin ? $this->railchatService::ROLE_ADMINISTRATOR : $this->railchatService::ROLE_USER,
            'accessLevelName' => user()->access_level ?? '',
        ];

        $token = $this->railchatService->getUserToken(
            $userData['id'],
            $userData['displayName'],
            $userData['avatarUrl'],
            $userData['profileUrl'],
            user()->isAdmin() || $this->permissionService->is(
                user()->id,
                'live_chat_moderator'
            ),
            $userData['accessLevelName']
        );

        return view(
            'live.embed',
            [
                'apiKey' => config('railchat.' . $brand . '.get_stream_credentials')['key'],
                'token' => $token,
                'chatChannelName' => $chatChannelName,
                'questionsChannelName' => $questionsChannelName,
                'isAdministrator' => user()->isAdmin() ||
                    $this->permissionService->is(user()->id, 'live_chat_moderator'),
                'userData' => $userData,
                'embedUrl' => $embedUrl,
            ]
        );
    }

    public function live(Request $request, $domain, $brand)
    {
        CacheHelper::$disableCache = true;

        ContentRepository::$availableContentStatues = [
            ContentService::STATUS_PUBLISHED,
            ContentService::STATUS_SCHEDULED,
        ];

        ContentRepository::$pullFutureContent = true;

        $userRoleAdmin = user()->isAdmin();
        $chatChannelName = config('railchat.' . $brand . '.chat_channel_name');
        $questionsChannelName = config('railchat.' . $brand . '.questions_channel_name');
        $embedUrl = config('railchat.' . $brand . '.embed_url');

        $userData = [
            'id' => user()->id,
            'displayName' => user()->display_name,
            'avatarUrl' => user()->profile_picture_url,
            'profileUrl' => user()->getDashboardUrl(),
            'role' => $userRoleAdmin ? $this->railchatService::ROLE_ADMINISTRATOR : $this->railchatService::ROLE_USER,
            'accessLevelName' => user()->access_level ?? '',
        ];

        $token = $this->railchatService->getUserToken(
            $userData['id'],
            $userData['displayName'],
            $userData['avatarUrl'],
            $userData['profileUrl'],
            user()->isAdmin() || $this->permissionService->is(
                user()->id,
                'live_chat_moderator'
            ),
            $userData['accessLevelName']
        );

        $timezones = CalendarService::getTimezoneList();

        // get users timezone
        $fullTimezoneString = $this->calendarService->getTimezone($request);

        $liveEvents = $this->contentService->getWhereTypeInAndStatusAndPublishedOnOrdered(
            ContentTypes::liveContentTypes(),
            ContentService::STATUS_SCHEDULED,
            Carbon::now()
                ->subHours(6)
                ->toDateTimeString(),
            '>',
            'published_on',
            'asc',
            [],
            15
        );

        $contentReleases = $this->contentService->getWhereTypeInAndStatusAndPublishedOnOrdered(
            ContentTypes::contentReleaseContentTypes(),
            ContentService::STATUS_PUBLISHED,
            Carbon::now()
                ->toDateTimeString(),
            '>',
            'published_on',
            'asc',
            [],
            10
        );

        $scheduleEvents =
            $liveEvents->merge($contentReleases)
                ->sort(
                    function ($a, $b) {
                        return strtotime($a['published_on']) - strtotime($b['published_on']);
                    }
                )
                ->slice(0, 5)
                ->values();

        // calculate if there is a current event and the previous/next events
        $showLivePage = false;
        $eventsWithinTimeFrame = [];
        $currentEvent = null;
        $nextEvent = null;

        foreach ($liveEvents as $liveEvent) {
            if (empty($liveEvent->fetch('fields.live_event_start_time')) ||
                empty($liveEvent->fetch('fields.live_event_end_time'))) {
                continue;
            }

            $startTimeUtc = Carbon::parse($liveEvent->fetch('fields.live_event_start_time'));
            $endTimeUtc = Carbon::parse($liveEvent->fetch('fields.live_event_end_time'));

            $startTimeCutoff =
                $startTimeUtc->copy()
                    ->subMinutes(self::NOT_LIVE_PAGE_SWITCH_MINUTES);
            $endTimeCutoff =
                $endTimeUtc->copy()
                    ->addMinutes(self::NOT_LIVE_PAGE_SWITCH_MINUTES);

            if (Carbon::now() > $startTimeUtc->subMinutes(self::NOT_LIVE_PAGE_SWITCH_MINUTES) &&
                Carbon::now() < $endTimeUtc->addMinutes(15)) {
                $showLivePage = true;
                $eventsWithinTimeFrame[] = $liveEvent;
            }
        }

        // if there are multiple events withing the time frame we need to figure out which one is closest
        foreach ($eventsWithinTimeFrame as $eventWithinTimeFrame) {
            $startTimeUtc = Carbon::parse($eventWithinTimeFrame->fetch('fields.live_event_start_time'));
            $endTimeUtc = Carbon::parse($eventWithinTimeFrame->fetch('fields.live_event_end_time'));

            if (empty($currentEvent)) {
                $currentEvent = $eventWithinTimeFrame;
            }

            if (Carbon::now() > $startTimeUtc && Carbon::now() < $endTimeUtc) {
                $currentEvent = $eventWithinTimeFrame;
            }
        }

        // if there is no current live event, calculate the next upcoming event
        if (!$showLivePage) {
            foreach ($scheduleEvents as $scheduleEvent) {
                if (empty($scheduleEvent->fetch('fields.live_event_start_time')) ||
                    empty($scheduleEvent->fetch('fields.live_event_end_time'))) {
                    continue;
                }

                $startTimeUtc = Carbon::parse($scheduleEvent->fetch('fields.live_event_start_time'));

                if (Carbon::now() < $startTimeUtc->subMinutes(self::NOT_LIVE_PAGE_SWITCH_MINUTES)) {
                    $nextEvent = $scheduleEvent;
                    break;
                }
            }
        }

        // this is for previewing any upcoming event
        if ($request->has('forced-content-id')) {
            $forcedEvent = $this->contentService->getById($request->get('forced-content-id'));

            if (!empty($forcedEvent)) {
                $currentEvent = $forcedEvent;
                $nextEvent = $forcedEvent;
                $showLivePage = true;
            }
        }

        $event = $currentEvent ?? $nextEvent;

        if ($showLivePage) {
            event(
                new LiveStreamEventAttended(
                    user()->id,
                    $event['id'],
                    Carbon::now()->toDateTimeString()
                )
            );

            if (!empty($event->fetch('fields.live_event_youtube_id'))) {
                $youtubeId = $event->fetch('fields.live_event_youtube_id');
            } else {
                $youtubeId = $this->liveStreamEventService->getCurrentOrNextYoutubeEventId();
            }

            $themeColor = ContentTypes::mapContentThemeColor($event->fetch('type'));

            return view(
                'live.online',
                [
                    'lessonContent' => $event,
                    'liveStreamId' => $youtubeId,
                    'themeColor' => $themeColor,
                    'apiKey' => config('railchat.get_stream_credentials')['key'],
                    'token' => $token,
                    'chatChannelName' => $chatChannelName,
                    'questionsChannelName' => $questionsChannelName,
                    'isAdministrator' => user()->isAdmin() ||
                        $this->permissionService->is(user()->id, 'live_chat_moderator'),
                    'userData' => $userData,
                    'embedUrl' => $embedUrl,
                    'scheduleEvents' => json_encode(array_slice($liveEvents->toArray(), 0, 5)),
                ]
            );
        }

        $nextEventJson =
            (new ContentFilterResultsEntity(['results' => ($event) ? clone $event : []]))->toResponseRawJson();

        $onlyFutureScheduleEvents = [];

        foreach ($liveEvents as $liveEvent) {
            if (Carbon::now() < Carbon::parse($liveEvent['published_on'])) {
                $onlyFutureScheduleEvents[] = $liveEvent;
            }
        }

        $onlyFutureScheduleEvents = array_slice($onlyFutureScheduleEvents, 0, 5);

        return view(
            'live.offline',
            [
                "nextEvent" => $event,
                "nextEventJson" => $nextEventJson,
                "scheduleEvents" => json_encode($onlyFutureScheduleEvents),
                "fullTimezoneString" => $fullTimezoneString,
                "timezones" => $timezones,
            ]
        );
    }

    public function markLiveLessonAttended()
    {
        ContentRepository::$availableContentStatues = [
            ContentService::STATUS_PUBLISHED,
            ContentService::STATUS_SCHEDULED,
        ];

        ContentRepository::$pullFutureContent = true;

        $user = user();

        $liveEvents = $this->contentService->getWhereTypeInAndStatusAndPublishedOnOrdered(
            ContentTypes::liveContentTypes(),
            ContentService::STATUS_SCHEDULED,
            Carbon::now()
                ->subHours(12)
                ->toDateTimeString(),
            '>',
            'published_on',
            'asc'
        );

        foreach ($liveEvents as $liveEvent) {
            if (empty($liveEvent->fetch('fields.live_event_start_time')) ||
                empty($liveEvent->fetch('fields.live_event_end_time'))) {
                continue;
            }

            $startTimeUtc = Carbon::parse($liveEvent->fetch('fields.live_event_start_time'), 'UTC');
            $endTimeUtc = Carbon::parse($liveEvent->fetch('fields.live_event_end_time'), 'UTC');

            if (Carbon::now() > $startTimeUtc->subMinutes(self::NOT_LIVE_PAGE_SWITCH_MINUTES) &&
                Carbon::now() < $endTimeUtc->addMinutes(self::NOT_LIVE_PAGE_SWITCH_MINUTES)) {
                // give xp
                $this->userPointsService->setPoints(
                    $user->getId(),
                    [
                        'content_id' => $liveEvent['id'],
                        'live_stream_start_time' => $startTimeUtc->toDateTimeString(),
                    ],
                    'live_stream_attended',
                    config('xp_ranks.live_lesson_attended'),
                    'Awarded for attending a live stream for at least 300 seconds.'
                );
            }
        }
    }
}
