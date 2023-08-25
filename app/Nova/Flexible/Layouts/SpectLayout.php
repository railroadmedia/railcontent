<?php

namespace App\Nova\Flexible\Layouts;

use Laravel\Nova\Fields\Select;
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
            Select::make('title')->options([
                'Audio' => 'Audio',
                'Accessory' => 'Accessory',
                'Binding' => 'Binding',
                'Books' => 'Books',
                'Color' => 'Color',
                'Diameter' => 'Diameter',
                'Dimensions' => 'Dimensions',
                'Fabric' => 'Fabric',
                'Finish' => 'Finish',
                'Format' => 'Format',
                'Frame' => 'Frame',
                'Hat' => 'Hat',
                'Height' => 'Height',
                'Hoodie' => 'Hoodie',
                'Logo' => 'Logo',
                'Materials' => 'Materials',
                'Manufacturer' => 'Manufacturer',
                'Membership' => 'Membership',
                'Microwave' => 'Microwave',
                'Online' => 'Online',
                'Pages' => 'Pages',
                'Page Material' => 'Page Material',
                'Paper Stock' => 'Paper Stock',
                'Poster' => 'Poster',
                'Publisher' => 'Publisher',
                'Redeem' => 'Redeem',
                'Shirt' => 'Shirt',
                'Size' => 'Size',
                'Sizing' => 'Sizing',
                'Style' => 'Style',
                'Skill' => 'Skill',
                'Sweater' => 'Sweater',
                'Sweatshirt' => 'Sweatshirt',
                'Video' => 'Video',
                'Volume' => 'Volume',
                'Washing' => 'Washing',
                'Weight' => 'Weight',
            ])->displayUsingLabels()->sortable(),
            Text::make('Description', 'desc'),
            Text::make('Id', 'id')->hide()->hideFromDetail(),
        ];
    }

}
