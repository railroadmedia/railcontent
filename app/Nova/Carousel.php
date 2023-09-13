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
            Text::make('Name')->sortable()->help('For easy reference to this banner in the CMS. This info won\'t show on the banner.')->required()->rules('required'),
            Boolean::make('Visible on Desktop', 'visible_on_desktop')->hideFromIndex()->default(true),
            Boolean::make('Visible on Mobile', 'visible_on_mobile')->hideFromIndex()->default(true),
            Select::make(__('Mobile endpoint version'), 'mobile_version')->options(function () {
                return [
                    '1' => '' . __('V1') . '',
                    '2' => '' . __('V2') . '',
                    '3' => '' . __('V3') . '',
                    '4' => '' . __('V4') . '',
                ];
            }),
            Boolean::make('Draft')->hideFromIndex()->default(true),
            Number::make('Display Order', 'display_order')->hideFromIndex(),
            DateTime::make('Start Time', 'start_date')->hideFromIndex()->help('Ignore UTC. It is actually PST.<br>This does NOT account for Daylight Savings between Mar-Nov. Make sure you offset by an hour during PDT'),
            DateTime::make(__('End Time'), 'end_date')->hideFromIndex()->help('Ignore UTC. It is actually PST.<br>This does NOT account for Daylight Savings between Mar-Nov. Make sure you offset by an hour during PDT'),
            Heading::make('BANNER COPY & IMAGES'),
            Text::make('Subtitle')->hideFromIndex()->sortable()->help('This is visible only if there is no logo uploaded or supported. Older app versions do not support the logo and will only see this text.'),
            Text::make('Subtitle Color', 'subtitle_color')->hideFromIndex()->help('Leave blank for white text. Otherwise, type "black".'),
            Text::make('Title')->hideFromIndex()->sortable()->help('This is visible only if there is no logo uploaded or supported. Older app versions do not support the logo and will only see this text.'),
            Text::make('Title Color', 'title_color')->hideFromIndex()->help('Leave blank for white text. Otherwise, type "black".'),
            Image::make('Logo')
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
            Text::make('Logo')->hideFromIndex()->hideFromDetail()->help('Use this field if you have a hosted image link. (Google Drive links will NOT work.)'),
            Markdown::make('Description')->help('If a description exceeds 316 the last three characters will be replaced with an ellipses.<br> Use &lt;br&gt; for a line break, &lt;i&gt;&lt;/i&gt; for italics, and &lt;b&gt;&lt;/b&gt; for bold. <br> Limited to three lines of text.'),
            Text::make('Description Color', 'desc_color')->hideFromIndex()->help('Leave blank for white text. Otherwise, type "black".'),
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
            Boolean::make('Button Light Mode', 'btn_light_mode')->hideFromIndex()->default(false),
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
            Text::make('Primary Video Source', 'primary_video_src')->hideFromIndex()
                ->help('Automatically replaces the primary button URL with the pop-up video player. Use Vimeo links only, e.g. //player.vimeo.com/video/798501810?autoplay=1. In Vimeo, video permissions must be at least set to "Hidden from Vimeo", and cannot be set to "Unlisted".'),
            Text::make('Secondary Button Text', 'secondary_cta_text')->hideFromIndex(),
            Text::make('Secondary Button URL', 'secondary_cta_url')->hideFromIndex(),
            Text::make('Secondary Video Source', 'video_src')->hideFromIndex()
                ->help('Automatically replaces the second button URL with the pop-up video player. Use Vimeo links only, e.g. //player.vimeo.com/video/798501810?autoplay=1. In Vimeo, video permissions must be at least set to "Hidden from Vimeo", and cannot be set to "Unlisted".'),
            //duplicated fields for displaying index page purpose
            Boolean::make('draft')->hideFromDetail()->hideWhenUpdating()->hideWhenCreating()->sortable(),
            Boolean::make('Desktop', 'visible_on_desktop')->hideFromDetail()->hideWhenUpdating()->hideWhenCreating()->sortable(),
            Boolean::make('Mobile', 'visible_on_mobile')->hideFromDetail()->hideWhenUpdating()->hideWhenCreating()->sortable(),
            Number::make('Display Order', 'display_order')->hideFromDetail()->hideWhenUpdating()->hideWhenCreating(),
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
