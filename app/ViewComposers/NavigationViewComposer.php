<?php

namespace App\ViewComposers;

use App\Modules\Brand\Enums\Brand;
use App\Services\NavigationService;
use Illuminate\View\View;
use Modules\Content\Services\PlaylistsService;
use Railroad\Railnotifications\Services\NotificationService;

class NavigationViewComposer
{
    /**
     * @var NotificationService
     */
    private $notificationService;

    /**
     * @var PlaylistsService
     */
    private $playlistsService;

    private $viewDataCache;

    /**
     * Check the users permission levels and render a different nav for different levels
     *
     * @param  View  $view
     * @return void
     */
    public function compose(View $view)
    {
        if (!empty($this->viewDataCache)) {
            return $this->viewDataCache;
        }

        if (empty(user())) {
            $this->viewDataCache = [
                'sidebarNavigationSectionsJson' => NavigationService::getSidebarSectionsJson(),
                'userNavigationDropdownLinksJson' => NavigationService::getUserDropDownLinksJson(),
                "hasUnreadNotifications" => false,
                "mostRecentPlaylists" => [],
                "pinnedPlaylists" =>  []
            ];

            $view->with($this->viewDataCache);

            return;
        }

        $this->notificationService = app(NotificationService::class);
        $this->playlistsService = app(PlaylistsService::class);

        $unread = (user()) ? $this->notificationService->getUnreadCount(user()->id, brand()) : 0;
        $pinnedPlaylists = (user()) ? $this->playlistsService->getPinnedPlaylists(brand()) : [];
        $latestPlaylists = [];
        if(brand()) {
            $brand           = Brand::from(brand());
            $latestPlaylists = (user()) ? $this->playlistsService->getPlaylists('most_recent', $brand, null, 10, 1)['data'] : [];
        }

        $this->viewDataCache = [
            'sidebarNavigationSectionsJson' => NavigationService::getSidebarSectionsJson(),
            'userNavigationDropdownLinksJson' => NavigationService::getUserDropDownLinksJson(),
            "hasUnreadNotifications" => $unread > 0,
            "mostRecentPlaylists" => $latestPlaylists,
            "pinnedPlaylists" =>  $pinnedPlaylists
        ];

        $view->with($this->viewDataCache);
    }
}
