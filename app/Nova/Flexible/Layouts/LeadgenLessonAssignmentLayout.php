<?php

namespace App\Nova\Flexible\Layouts;

use Laravel\Nova\Fields\Text;
use Whitecube\NovaFlexibleContent\Layouts\Layout;

class LeadgenLessonAssignmentLayout extends Layout
{
    /**
     * The layout's unique identifier
     *
     * @var string
     */
    protected $name = 'leadgen-lesson-assignment-layout';

    /**
     * The displayed title
     *
     * @var string
     */
    protected $title = 'Assignment';

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
            Text::make('Sub Title','subtitle'),
            Text::make('Source', 'src'),
            Text::make('Sound Slice ID', 'soundslice'),
        ];
    }

}
