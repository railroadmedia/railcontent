<?php

namespace App\Nova\Flexible\Layouts;

use Illuminate\Http\Request;
use Laravel\Nova\Fields\Image;
use Laravel\Nova\Fields\Text;
use Whitecube\NovaFlexibleContent\Layouts\Layout;

class ImageLayout extends Layout
{
    /**
     * The layout's unique identifier
     *
     * @var string
     */
    protected $name = 'image-layout';

    /**
     * The displayed title
     *
     * @var string
     */
    protected $title = 'Image';

    /**
     * Get the fields displayed by the layout.
     *
     * @return array
     */
    public function fields()
    {
        return [
            Image::make('Image','path')
                ->disk('s3')
                ->prunable()
                ->deletable(false)
                ->disableDownload()
                ->storeAs(function (Request $request){
                    return $request->file('path')->getClientOriginalName();
                })
                ->preview(function($value){
                    return str_contains($value, 'amazonaws') || str_contains($value, 'cloudfront') ? $value : 'https://laravel-nova.s3.us-east-2.amazonaws.com/'.$value;
                }),
            Text::make('id', 'id')->hide()->hideFromDetail()
        ];
    }

}
