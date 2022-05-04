<?php

namespace App\ViewComposers;

use App\Services\NavigationService;
use Illuminate\View\View;

class NavigationViewComposer
{
    /**
     * Check the users permission levels and render a different nav for different levels
     *
     * @param  View  $view
     * @return void
     */
    public function compose(View $view)
    {
        $view->with([
            'sidebarNavigationSectionsJson' => NavigationService::getSidebarSectionsJson(),
            'userNavigationDropdownLinksJson' => NavigationService::getUserDropDownLinksJson(),
        ]);
    }
}
