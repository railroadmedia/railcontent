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
            Boolean::make('visible')->hideFromIndex()->default(true),
            Number::make('Display order', 'display_order')->hideFromIndex(),
            DateTime::make('Start Time', 'start_date')->hideFromIndex()->help('Ignore UTC. It is actually PST.'),
            DateTime::make(__('End Time'), 'end_date')->hideFromIndex()->help('Ignore UTC. It is actually PST.'),
            Heading::make('BANNER COPY & IMAGES'),
            Text::make('Subtitle')->sortable()->help('This is visible only if there is no logo uploaded.'),
            Text::make('Title')->sortable()->help('This is visible only if there is no logo uploaded.'),
            Image::make('logo')
                ->help("The logo will replace the 'Title' and 'Subtitle'.")
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

                    return '/'.$brand.'/carousels/'.$request->uuid.'-'.$request->file('logo')->getClientOriginalName();
                })
                ->preview(function($value){
                    if(empty($value)) return null;

                    return $value;
                }),
            Text::make('logo')->hideFromIndex()->hideFromDetail()->help('Use this field if you have a hosted image link. (Google Drive links will NOT work.)'),
            Markdown::make('Description')->help('If a description exceeds 316 the last three characters will be replaced with an ellipses.<br> Use &lt;br&gt; for a line break, &lt;i&gt;&lt;/i&gt; for italics, and &lt;b&gt;&lt;/b&gt; for bold. <br> Limited to three lines of text.'),
            Image::make('Desktop Image', 'desktop_img')
                ->help('The image should be 1536 x 370px or a comparable aspect ratio.')
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

                    return '/'.$brand.'/carousels/'.$request->uuid.'-'.$request->file('desktop_img')->getClientOriginalName();
                })
                ->preview(function($value){
                    if(empty($value)) return null;

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

                    return '/'.$brand.'/carousels/'.$request->uuid.'-'.$request->file('tablet_img')->getClientOriginalName();
                })
                ->preview(function($value){
                    if(empty($value)) return null;

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

                    return '/'.$brand.'/carousels/'.$request->uuid.'-'.$request->file('mobile_img')->getClientOriginalName();
                })
                ->preview(function($value){
                    if(empty($value)) return null;

                    return $value;
                }),
            Text::make('Mobile Image', 'mobile_img')->hideFromIndex()->hideFromDetail()->help('Use this field if you have a hosted image link. (Google Drive links will NOT work.)'),
            Heading::make('BANNER ACTIONS'),
            Boolean::make('Featured product?', 'is_featured')->hideFromIndex()->default(false)->help('Used for member enrolment for cohort packs. Leave unchecked for normal banners.'),
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
            Text::make('Primary Button Text', 'primary_cta_text')->hideFromIndex(),
            Text::make('Primary Button Text Alt', 'primary_cta_text_alt')->hideFromIndex()
                ->hide()
                ->hideFromDetail(function (NovaRequest $request, $resource) {
                    return !$this->is_featured;
                })
                ->help('Enrolled users will see this button instead. Usually goes to the cohort pack page.')
                ->dependsOn(
                    ['is_featured'],
                    function (Text $field, NovaRequest $request, FormData $formData) {
                        if ($formData->is_featured) $field->show();
                    }
                ),
            Text::make('Primary Button URL', 'primary_cta_url')->hideFromIndex(),
            Text::make('Primary Button URL Alt', 'primary_cta_url_alt')->hideFromIndex()
                ->hide()
                ->hideFromDetail(function (NovaRequest $request, $resource) {
                    return !$this->is_featured;
                })
                ->help('Enrolled users will go to this page instead. Usually the cohort pack page.')
                ->dependsOn(
                    ['is_featured'],
                    function (Text $field, NovaRequest $request, FormData $formData) {
                        if ($formData->is_featured) $field->show()->rules(['required']);
                    }
                ),
            Text::make('Secondary Button Text', 'secondary_cta_text')->hideFromIndex(),
            Text::make('Secondary Button URL', 'secondary_cta_url')->hideFromIndex(),
            Text::make('Video Source', 'video_src')->hideFromIndex()
                ->hide()
                ->hideFromDetail(function (NovaRequest $request, $resource) {
                    return !$this->is_featured;
                })
                ->help('Automatically replaces the second button URL with the pop-up video player.')
                ->dependsOn(
                    ['is_featured'],
                    function (Text $field, NovaRequest $request, FormData $formData) {
                        if ($formData->is_featured) $field->show();
                    }
                ),
            //duplicated fields for displaying index page purpose
            Number::make('Display order', 'display_order')->hideFromDetail()->hideWhenUpdating()->hideWhenCreating(),
            Boolean::make('visible')->hideFromDetail()->hideWhenUpdating()->hideWhenCreating(),
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
