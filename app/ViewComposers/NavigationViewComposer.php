<?php

namespace App\ViewComposers;

use App\Services\NavigationService;
use Illuminate\View\View;
use Railroad\Railnotifications\Services\NotificationService;

class NavigationViewComposer
{
    /**
     * @var NotificationService
     */
    private $notificationService;

    /**
     * SidebarComposer constructor.
     */
    public function __construct(NotificationService $notificationService)
    {
        $this->notificationService = $notificationService;
    }

    /**
     * Check the users permission levels and render a different nav for different levels
     *
     * @param  View  $view
     * @return void
     */
    public function compose(View $view)
    {
        $unread = (user())?$this->notificationService->getUnreadCount(user()->id, brand()):0;

        $view->with([
            'sidebarNavigationSectionsJson' => NavigationService::getSidebarSectionsJson(),
            'userNavigationDropdownLinksJson' => NavigationService::getUserDropDownLinksJson(),
            "hasUnreadNotifications" => $unread > 0,
        ]);
    }
}
