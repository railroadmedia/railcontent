<?php

namespace App\Nova\Flexible\Layouts;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Laravel\Nova\Fields\Hidden;
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
        $uuid  = Str::uuid();

        return [
            Image::make('Image', 'path_file')
                ->disk('nova_s3')
                ->prunable()
                ->deletable(false)
                ->disableDownload()
                ->storeAs(function (Request $request) {
                    return '/ImageSlides/'.$request->uuid.'-'.$request->file('path_file')->getClientOriginalName();
                })
                ->preview(function ($value) {
                    return str_contains($value, 'amazonaws') || str_contains($value, 'cloudfront') ? $value : 'https://d1fyshwdvi6fth.cloudfront.net/'.$value;
                }),
            Text::make('Image', 'path_text')->hideFromIndex()->hideFromDetail(),
            Hidden::make('id', 'id'),
            Hidden::make('uuid')->withMeta(["value" => $uuid]),
        ];
    }

}
