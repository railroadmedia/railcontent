<?php

namespace App\Nova\Flexible\Layouts;

use Laravel\Nova\Fields\Select;
use Laravel\Nova\Fields\Text;
use Whitecube\NovaFlexibleContent\Layouts\Layout;

class BundleLayout extends Layout
{
    /**
     * The layout's unique identifier
     *
     * @var string
     */
    protected $name = 'bundle-layout';

    /**
     * The displayed title
     *
     * @var string
     */
    protected $title = 'Bundle product';

    /**
     * Get the fields displayed by the layout.
     *
     * @return array
     */
    public function fields()
    {
        return [
            Select::make('Product')
            ->options(\App\Models\Product::join('product_types', 'product_types.id', '=', 'product_type_id')->whereNot('product_types.name', 'Bundle')->select('products.name', 'products.id')->orderBy('name')->pluck('name', 'name')),
            Text::make('id')->hideFromIndex()->hide()->hideFromDetail()
        ];
    }

}
