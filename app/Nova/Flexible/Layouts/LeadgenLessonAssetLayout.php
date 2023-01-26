<?php

namespace App\Nova\Flexible\Layouts;

use Laravel\Nova\Fields\Text;
use Whitecube\NovaFlexibleContent\Layouts\Layout;

class LeadgenLessonAssetLayout extends Layout
{
    /**
     * The layout's unique identifier
     *
     * @var string
     */
    protected $name = 'leadgen-lesson-asset-layout';

    /**
     * The displayed title
     *
     * @var string
     */
    protected $title = 'Leadgen Lesson Asset';

    protected $casts = [
        'leadgen-lesson-assignment-layout' => LeadgenLessonAssignmentLayout::class
    ];

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
            Text::make('Source', 'src'),
            Text::make('Sound Slice', 'soundslice'),
        ];
    }

}
