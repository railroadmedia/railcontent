<?php

namespace App\Nova\Flexible\Layouts;

use Laravel\Nova\Fields\Boolean;
use Laravel\Nova\Fields\Select;
use Laravel\Nova\Fields\Text;
use Whitecube\NovaFlexibleContent\Layouts\Layout;

class SizeLayout extends Layout
{
    /**
     * The layout's unique identifier
     *
     * @var string
     */
    protected $name = 'size-layout';

    /**
     * The displayed title
     *
     * @var string
     */
    protected $title = 'Size';

    /**
     * Get the fields displayed by the layout.
     *
     * @return array
     */
    public function fields()
    {
        return [
            Select::make('Sizes', 'size')
            ->options(\App\Models\Size::pluck('name', 'name')),
            Boolean::make('Sold Out', 'sold_out'),
            Text::make('id', 'id')->hide()->hideFromDetail()
        ];
    }

}
