<?php

namespace App\Nova\Flexible\Layouts;

use Laravel\Nova\Fields\Text;
use Whitecube\NovaFlexibleContent\Layouts\Layout;

class CohortDropdownLayout extends Layout
{
    /**
     * The layout's unique identifier
     *
     * @var string
     */
    protected $name = 'cohort-dropdown-layout';

    /**
     * The displayed title
     *
     * @var string
     */
    protected $title = 'CohortDropdownLayout';

    /**
     * Get the fields displayed by the layout.
     *
     * @return array
     */
    public function fields()
    {
        return [
            // Define the layout's fields.
            Text::make('title')->required(),
            Text::make('description')->required(),
            Text::make('id')->hide()->hideFromDetail(),
        ];
    }

}
