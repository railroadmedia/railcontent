<?php

namespace App\ViewComposers;

use App\Services\NavigationService;
use Illuminate\View\View;
use Railroad\Railcontent\Services\UserPlaylistsService;
use Railroad\Railnotifications\Services\NotificationService;

class NavigationViewComposer
{
    /**
     * @var NotificationService
     */
    private $notificationService;

    private $userPlaylistsService;

    private static $viewDataCache;

    /**
     * SidebarComposer constructor.
     */
    public function __construct(NotificationService $notificationService, UserPlaylistsService $userPlaylistsService)
    {
        $this->notificationService = $notificationService;
        $this->userPlaylistsService = $userPlaylistsService;
    }

    /**
     * Check the users permission levels and render a different nav for different levels
     *
     * @param  View  $view
     * @return void
     */
    public function compose(View $view): void
    {
        if (!empty(self::$viewDataCache)) {
            return self::$viewDataCache;
        }

        $unread = (user()) ? $this->notificationService->getUnreadCount(user()->id, brand()) : 0;
        $pinnedPlaylists = (user()) ? $this->userPlaylistsService->getPinnedPlaylists() : [];
        $latestPlaylists = (user()) ? $this->userPlaylistsService->getUserPlaylist(
            user()->id,
            'user-playlist',
            brand(),
            10,
            1,
            null,
            'most_recent'
        ) : [];

        self::$viewDataCache = [
            'sidebarNavigationSectionsJson' => NavigationService::getSidebarSectionsJson(),
            'userNavigationDropdownLinksJson' => NavigationService::getUserDropDownLinksJson(),
            "hasUnreadNotifications" => $unread > 0,
            "mostRecentPlaylists" => $latestPlaylists,
            "pinnedPlaylists" =>  $pinnedPlaylists
        ];

        $view->with(self::$viewDataCache);
    }
}
