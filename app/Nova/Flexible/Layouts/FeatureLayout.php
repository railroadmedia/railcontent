<?php

namespace App\Nova\Flexible\Layouts;

use Laravel\Nova\Fields\Text;
use Whitecube\NovaFlexibleContent\Layouts\Layout;

class FeatureLayout extends Layout
{
    /**
     * The layout's unique identifier
     *
     * @var string
     */
    protected $name = 'feature-layout';

    /**
     * The displayed title
     *
     * @var string
     */
    protected $title = 'Feature/Topic';

    /**
     * Get the fields displayed by the layout.
     */
    public function fields(): array
    {
        return [
            Text::make('Description', 'desc')->required()->rules('required'),
            Text::make('Id', 'id')->hide()->hideFromDetail(),
        ];
    }

}
