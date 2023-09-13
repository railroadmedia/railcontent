<?php

namespace App\Nova\Flexible\Layouts;

use Laravel\Nova\Fields\Text;
use Whitecube\NovaFlexibleContent\Layouts\Layout;

class CohortListLayout extends Layout
{
    /**
     * The layout's unique identifier
     *
     * @var string
     */
    protected $name = 'cohort-list-layout';

    /**
     * The displayed title
     *
     * @var string
     */
    protected $title = '';

    /**
     * Get the fields displayed by the layout.
     *
     * @return array
     */
    public function fields()
    {
        return [
            // Define the layout's fields.
           // Text::make('title')->required()->rules('required'),
            Text::make('description')->required()->rules('required'),
            Text::make('id')->hide()->hideFromDetail(),
        ];
    }

}
