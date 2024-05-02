<?php

namespace App\Nova;

use Illuminate\Http\Request;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\Heading;
use Laravel\Nova\Fields\Hidden;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Image;
use Laravel\Nova\Fields\Markdown;
use Laravel\Nova\Fields\Number;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\Boolean;
use Laravel\Nova\Fields\FormData;
use Laravel\Nova\Http\Requests\NovaRequest;
use Illuminate\Support\Str;
use Laravel\Nova\Fields\DateTime;
use Laravel\Nova\Fields\Select;

class TrialSection extends Resource
{
    /**
     * The model the resource corresponds to.
     *
     * @var class-string<\App\Models\TrialSection>
     */
    public static $model = \App\Models\TrialSection::class;

    /**
     * The single value that should be used to represent the resource when being displayed.
     *
     * @var string
     */
    public static $title = 'id';

    /**
     * The columns that should be searched.
     *
     * @var array
     */
    public static $search = [
        'id',
    ];

    /**
     * Get the fields displayed by the resource.
     *
     * @param  \Laravel\Nova\Http\Requests\NovaRequest  $request
     * @return array
     */
    public function fields(NovaRequest $request)
    {
        $uuid  = Str::uuid();

        return [
            ID::make()->sortable(),
            Hidden::make('Uuid')->withMeta(["value" => $uuid]),
            BelongsTo::make('Brand', 'brand', 'App\Nova\Brand')->sortable(),
            Text::make('Title')->hideFromIndex()->sortable()->help('This is visible only if there is no logo uploaded or supported. Older app versions do not support the logo and will only see this text.'),
            Text::make('Subtitle')->hideFromIndex()->sortable()->help('This is visible only if there is no logo uploaded or supported. Older app versions do not support the logo and will only see this text.'),
            Text::make('Tagline')->hideFromIndex()->sortable(),

            Markdown::make('Description')->help('If a description exceeds 316 the last three characters will be replaced with an ellipses.<br> Use &lt;br&gt; for a line break, &lt;i&gt;&lt;/i&gt; for italics, and &lt;b&gt;&lt;/b&gt; for bold. <br> Limited to three lines of text.'),
            Image::make('Desktop Image', 'desktop_img')
                ->help('The image should be 1536 x 370px or a comparable aspect ratio.')
                ->disk('nova_s3')
                ->prunable()
                ->hideFromIndex()
                ->deletable(false)
                ->disableDownload()
                ->storeAs(function (Request $request) {
                    $brandId = $request->brand;
                    $brand = '';

                    if($brandId === "1") {
                        $brand = 'Drumeo';
                    } elseif($brandId === "2") {
                        $brand = 'Pianote';
                    } elseif($brandId === "3") {
                        $brand = 'Guitareo';
                    } elseif($brandId === "4") {
                        $brand = 'Singeo';
                    }

                    return '/'.$brand.'/learning-paths/'.$request->uuid.'-'.$request->file('desktop_img')->getClientOriginalName();
                })
                ->preview(function ($value) {
                    if(empty($value)) {
                        return null;
                    }

                    return $value;
                }),
            Text::make('Desktop Image', 'desktop_img')->hideFromIndex()->hideFromDetail()->help('Use this field if you have a hosted image link. (Google Drive links will NOT work.)'),
            Image::make('Tablet Image', 'tablet_img')
                ->help('The image should be 768 x 370px or a comparable aspect ratio.')
                ->disk('nova_s3')
                ->prunable()
                ->hideFromIndex()
                ->deletable(false)
                ->disableDownload()
                ->storeAs(function (Request $request) {
                    $brandId = $request->brand;
                    $brand = '';

                    if($brandId === "1") {
                        $brand = 'Drumeo';
                    } elseif($brandId === "2") {
                        $brand = 'Pianote';
                    } elseif($brandId === "3") {
                        $brand = 'Guitareo';
                    } elseif($brandId === "4") {
                        $brand = 'Singeo';
                    }

                    return '/'.$brand.'/learning-paths/'.$request->uuid.'-'.$request->file('tablet_img')->getClientOriginalName();
                })
                ->preview(function ($value) {
                    if(empty($value)) {
                        return null;
                    }

                    return $value;
                }),
            Text::make('Tablet Image', 'tablet_img')->hideFromIndex()->hideFromDetail()->help('Use this field if you have a hosted image link. (Google Drive links will NOT work.)'),
            Image::make('Mobile Image', 'mobile_img')
                ->help('The image should be 340 x 370px or a comparable aspect ratio.')
                ->disk('nova_s3')
                ->prunable()
                ->hideFromIndex()
                ->deletable(false)
                ->disableDownload()
                ->storeAs(function (Request $request) {
                    $brandId = $request->brand;
                    $brand = '';

                    if($brandId === "1") {
                        $brand = 'Drumeo';
                    } elseif($brandId === "2") {
                        $brand = 'Pianote';
                    } elseif($brandId === "3") {
                        $brand = 'Guitareo';
                    } elseif($brandId === "4") {
                        $brand = 'Singeo';
                    }

                    return '/'.$brand.'/learning-paths/'.$request->uuid.'-'.$request->file('mobile_img')->getClientOriginalName();
                })
                ->preview(function ($value) {
                    if(empty($value)) {
                        return null;
                    }

                    return $value;
                }),
            Text::make('Mobile Image', 'mobile_img')->hideFromIndex()->hideFromDetail()->help('Use this field if you have a hosted image link. (Google Drive links will NOT work.)'),

            Text::make('Product ID', 'product_id')->hideFromIndex()
                ->hideFromIndex()->required()->rules('required'),

            Text::make('Trailer Video Source', 'trailer')->hideFromIndex()
                ->help('Automatically replaces the primary button URL with the pop-up video player. Use Vimeo links only, e.g. //player.vimeo.com/video/798501810?autoplay=1. In Vimeo, video permissions must be at least set to "Hidden from Vimeo", and cannot be set to "Unlisted".'),

            Number::make('Display Order', 'display_order')->hideFromDetail()->hideWhenUpdating(),
        ];
    }

    /**
     * Get the cards available for the request.
     *
     * @param  \Laravel\Nova\Http\Requests\NovaRequest  $request
     * @return array
     */
    public function cards(NovaRequest $request)
    {
        return [];
    }

    /**
     * Get the filters available for the resource.
     *
     * @param  \Laravel\Nova\Http\Requests\NovaRequest  $request
     * @return array
     */
    public function filters(NovaRequest $request)
    {
        return [
            new \App\Nova\Filters\Brand()
        ];
    }

    /**
     * Get the lenses available for the resource.
     *
     * @param  \Laravel\Nova\Http\Requests\NovaRequest  $request
     * @return array
     */
    public function lenses(NovaRequest $request)
    {
        return [];
    }

    /**
     * Get the actions available for the resource.
     *
     * @param  \Laravel\Nova\Http\Requests\NovaRequest  $request
     * @return array
     */
    public function actions(NovaRequest $request)
    {
        return [];
    }
}
