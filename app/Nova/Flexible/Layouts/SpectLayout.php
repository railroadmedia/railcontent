<?php

namespace App\Nova\Flexible\Layouts;

use Laravel\Nova\Fields\Text;
use Whitecube\NovaFlexibleContent\Layouts\Layout;

class SpectLayout extends Layout
{
    /**
     * The layout's unique identifier
     *
     * @var string
     */
    protected $name = 'spec-layout';

    /**
     * The displayed title
     *
     * @var string
     */
    protected $title = 'Spec';

    /**
     * Get the fields displayed by the layout.
     *
     * @return array
     */
    public function fields()
    {
        return [
            Text::make('Title', 'title'),
            Text::make('Description', 'desc'),
            Text::make('Id', 'id')->hide()->hideFromDetail(),
        ];
    }

}
