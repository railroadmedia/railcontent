<?php

namespace App\ViewComposers;

use App\Modules\Brand\Enums\Brand;
use App\Services\NavigationService;
use Illuminate\View\View;
use Railroad\Railcontent\Services\UserPlaylistsService;
use Railroad\Railnotifications\Services\NotificationService;
use Modules\Content\Services\PlaylistsService;

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
    public function __construct(NotificationService $notificationService, PlaylistsService $userPlaylistsService)
    {
        $this->notificationService = $notificationService;
        $this->userPlaylistsService = $userPlaylistsService;
    }

    /**
     * Check the users permission levels and render a different nav for different levels
     */
    public function compose(View $view): void
    {
        if (!empty(self::$viewDataCache)) {
            return;
        }

        $unread = (user()) ? $this->notificationService->getUnreadCount(user()->id, brand()) : 0;
        $pinnedPlaylists = (user()) ? $this->userPlaylistsService->getPinnedPlaylists(brand()) : [];
        $brand = Brand::from(brand());
        $latestPlaylists = (user()) ? $this->userPlaylistsService->getPlaylists('most_recent', $brand, null, 10, 1)['data'] : [];

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
