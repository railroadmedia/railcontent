<?php

namespace App\Nova\Flexible\Layouts;

use Laravel\Nova\Fields\Text;
use Whitecube\NovaFlexibleContent\Layouts\Layout;

class BenefitLayout extends Layout
{
    /**
     * The layout's unique identifier
     *
     * @var string
     */
    protected $name = 'benefit-layout';

    /**
     * The displayed title
     *
     * @var string
     */
    protected $title = 'Benefit';

    /**
     * Get the fields displayed by the layout.
     *
     * @return array
     */
    public function fields()
    {
        return [
            // Define the layout's fields.
            Text::make('Icon')->required(),
            Text::make('Heading')->required(),
            Text::make('Description', 'desc')->required(),
            Text::make('Id')->hide()->hideFromDetail(),
        ];
    }

}
