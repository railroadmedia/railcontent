<?php

namespace App\Http\Controllers\Platform;

use Illuminate\View\View;
use App\Http\Controllers\BaseController;
use App\Maps\ContentTypes;
use App\Services\CalendarService;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Modules\EventDataSynchronizer\Events\LiveStreamEventAttended;
use Railroad\Permissions\Services\PermissionService;
use Railroad\Railchat\Services\RailchatService;
use Railroad\Railcontent\Entities\ContentFilterResultsEntity;
use Railroad\Railcontent\Helpers\CacheHelper;
use Railroad\Railcontent\Repositories\ContentRepository;
use Railroad\Railcontent\Services\ConfigService;
use Railroad\Railcontent\Services\ContentService;
use App\Modules\Content\ApiGateways\SanityGateway;

class LivePageController extends BaseController
{
    /**
     * @var ContentService
     */
    private $contentService;

    public const NOT_LIVE_PAGE_SWITCH_MINUTES = 15;

    public function __construct(
        ContentService $contentService,
        private readonly CalendarService $calendarService,
        private readonly RailchatService $railchatService,
        private readonly PermissionService $permissionService,
        private readonly SanityGateway $sanityGateway
    ) {
        $this->contentService = $contentService;
    }

    public function chat(Request $request): View
    {
        $userRoleAdmin = user()->isAdmin();
        $chatChannelName = config('railchat.drumeo.chat_channel_name');
        $questionsChannelName = config('railchat.drumeo.questions_channel_name');
        $embedUrl = config('railchat.drumeo.embed_url');

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
                'apiKey' => config('railchat.drumeo.get_stream_credentials')['key'],
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
        $userRoleAdmin = user()->isAdmin();
        $chatChannelName = config('railchat.drumeo.chat_channel_name');
        $questionsChannelName = config('railchat.drumeo.questions_channel_name');
        $embedUrl = config('railchat.drumeo.embed_url');

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

        // this is for previewing any upcoming event
        if ($request->has('forced-content-id')) {
            $forcedEvent = $this->sanityGateway->getByRailcontentId($request->get('forced-content-id'));
            if (!empty($forcedEvent)) {
                $currentEvent = $forcedEvent;
                $showLivePage = true;
            }
        } else {
            // get users timezone
            $fullTimezoneString = $this->calendarService->getTimezone($request);
            $liveEvents         = $this->sanityGateway->getLiveEvents(brand(), self::NOT_LIVE_PAGE_SWITCH_MINUTES);

            $showLivePage = false;
            $currentEvent = null;

            if (!empty($liveEvents)) {
                $showLivePage = true;
                $currentEvent = $liveEvents[0];
            }
        }

        if ($showLivePage) {
            event(
                new LiveStreamEventAttended(
                    user()->id,
                    $currentEvent['id'],
                    Carbon::now()->toDateTimeString()
                )
            );

            return view(
                'live.online',
                [
                    'lessonContent' => $currentEvent,
                    'liveStreamId' => $currentEvent['videoId'],
                    'apiKey' => config('railchat.get_stream_credentials')['key'],
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

        return view(
            'live.offline',
            [
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
                    $user->id,
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
