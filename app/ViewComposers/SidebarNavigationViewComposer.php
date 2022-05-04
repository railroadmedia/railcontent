<?php

namespace App\ViewComposers;

use App\Services\SidebarNavigationService;
use Illuminate\View\View;

class SidebarNavigationViewComposer
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
            'sidebarNavigationSectionsJson' => SidebarNavigationService::getSectionsJson(),
        ]);
    }
}
