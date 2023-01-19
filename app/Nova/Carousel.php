<?php

namespace App\Nova;

use Illuminate\Http\Request;
use Laravel\Nova\Fields\BelongsTo;
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

class Carousel extends Resource
{
    /**
     * The model the resource corresponds to.
     *
     * @var class-string<\App\Models\Carousel>
     */
    public static $model = \App\Models\Carousel::class;

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
            Text::make('Subtitle')->sortable(),
            Text::make('Title')->required()->sortable(),
            Markdown::make('Description')->required()->help('If a description exceeds 316 the last three characters will be replaced with an ellipses.<br> Use &lt;br&gt; for a line break.'),
            Text::make('CTA Button Text', 'cta_text')->required()->hideFromIndex(),
            Text::make('CTA URL', 'cta_url')->required(),
            Image::make('Image', 'img')
                ->help('The image should be 1128  x 276px or a comparable aspect ratio.')
                ->disk('nova_s3')
                ->prunable()
                ->hideFromIndex()
                ->deletable(false)
                ->disableDownload()
                ->storeAs(function (Request $request){
                    $brandId = $request->brand;
                    $brand = '';

                    if($brandId === "1") {
                        $brand = 'Drumeo';
                    }
                    elseif($brandId === "2"){
                        $brand = 'Pianote';
                    }
                    elseif($brandId === "3"){
                        $brand = 'Guitareo';
                    }
                    elseif($brandId === "4"){
                        $brand = 'Singeo';
                    }

                    return '/'.$brand.'/carousels/'.$request->uuid.'-'.$request->file('img')->getClientOriginalName();
                })
                ->preview(function($value){
                    if(empty($value)) return null;

                    return $value;
                }),
            Text::make('Image', 'img')->hideFromIndex()->hideFromDetail()->help('Use this field if you have a hosted image link. (Google Drive links will NOT work.)'),
            Number::make('Display order', 'display_order'),
            Boolean::make('visible')->hideFromIndex()->default(true),
            Boolean::make('Featured product?', 'is_featured')->hideFromIndex()->default(false),
            Text::make('Product ID', 'product_id')->hideFromIndex()
                ->hide()
                ->hideFromDetail(function (NovaRequest $request, $resource) {
                    return !$this->is_featured;
                })
                ->dependsOn(
                    ['is_featured'],
                    function (Text $field, NovaRequest $request, FormData $formData) {
                        if ($formData->is_featured) $field->show()->rules(['required']);
                    }
                ),
            Text::make('Product URL', 'product_url')->hideFromIndex()
                ->hide()
                ->hideFromDetail(function (NovaRequest $request, $resource) {
                    return !$this->is_featured;
                })
                ->dependsOn(
                    ['is_featured'],
                    function (Text $field, NovaRequest $request, FormData $formData) {
                        if ($formData->is_featured) $field->show()->rules(['required']);
                    }
                ),
            Text::make('Registration URL / Endpoint', 'endpoint')->hideFromIndex()
                ->hide()
                ->hideFromDetail(function (NovaRequest $request, $resource) {
                    return !$this->is_featured;
                })
                ->dependsOn(
                    ['is_featured'],
                    function (Text $field, NovaRequest $request, FormData $formData) {
                        if ($formData->is_featured) $field->show()->rules(['required']);
                    }
                ),
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
