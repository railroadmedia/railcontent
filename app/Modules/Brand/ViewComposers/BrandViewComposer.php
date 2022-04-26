<?php

namespace App\Modules\Brand\ViewComposers;

use Illuminate\View\View;

class BrandViewComposer
{
    /**
     * Bind data to the view.
     *
     * @param  \Illuminate\View\View  $view
     * @return void
     */
    public function compose(View $view)
    {
        $view->with('user', user());
        $view->with('brand', brand());
    }
}
