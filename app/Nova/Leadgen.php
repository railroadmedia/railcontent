<?php

namespace App\Nova;

use App\Nova\Flexible\Layouts\LeadgenLessonAssetLayout;
use App\Nova\Flexible\Layouts\LeadgenLessonLayout;
use App\Nova\Flexible\Presets\LeadgenLessonAssetPreset;
use App\Nova\Flexible\Presets\LeadgenLessonPreset;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\Boolean;
use Laravel\Nova\Fields\DateTime;
use Laravel\Nova\Fields\Hidden;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Image;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Http\Requests\NovaRequest;
use Whitecube\NovaFlexibleContent\Flexible;

class Leadgen extends Resource
{
    /**
     * The model the resource corresponds to.
     *
     * @var class-string<\App\Models\Leadgen>
     */
    public static $model = \App\Models\Leadgen::class;

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
        'title',
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
            BelongsTo::make('Brand', 'brand', 'App\Nova\Brand')->sortable(),
            Hidden::make('Uuid')->withMeta(["value" => $uuid]),
            Text::make('title')->required()->rules('required'),
            Text::make('Meta Description', 'meta_desc')->hideFromIndex()->required()->rules('required'),
            Image::make('Meta Image', 'meta_img')
                ->disk('nova_s3')
                ->prunable()
                ->hideFromIndex()
                ->disableDownload()
                ->deletable(false)
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

                    return '/'.$brand.'/Lead-gens/Meta-images/'.$request->uuid.'-'.$request->file('meta_img')->getClientOriginalName();
                })
                ->preview(function($value){
                    if(empty($value)) return null;

                    return $value;
                }),
            Text::make('Meta Image', 'meta_img')->hideFromIndex()->hideFromDetail(),
            //To display in the index page
            Text::make('Index Slug','slug', function(){
                return '<a class="link-default" target="_blank" href="'.get_legacy_brand_base_url(strtolower($this->brand->name)).'/'.$this->slug.'">'.$this->slug.'</a>';
            })->asHtml()->hideWhenCreating()->hideWhenUpdating(),
            Text::make('Index Slug', 'slug')->hideFromIndex()->hideFromDetail(),
            Image::make('logo')
                ->disk('nova_s3')
                ->prunable()
                ->hideFromIndex()
                ->disableDownload()
                ->deletable(false)
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

                    return '/'.$brand.'/Lead-gens/Logos/'.$request->uuid.'-'.$request->file('logo')->getClientOriginalName();
                })
                ->preview(function($value){
                    if(empty($value)) return null;

                    return $value;
                }),
            Text::make('logo')->hideFromIndex()->hideFromDetail(),
            Image::make('Header Background Image', 'bg_img')
                ->disk('nova_s3')
                ->prunable()
                ->hideFromIndex()
                ->disableDownload()
                ->deletable(false)
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

                    return '/'.$brand.'/Lead-gens/Background-images/'.$request->uuid.'-'.$request->file('bg_img')->getClientOriginalName();
                })
                ->preview(function($value){
                    if(empty($value)) return null;

                    return $value;
                }),
            Text::make('Header Background Image', 'bg_img')->hideFromIndex()->hideFromDetail(),
            Boolean::make('visible')->default(true),
            DateTime::make('Start Time', 'start_date')->hideFromIndex()->help('Ignore UTC. It is actually PST.<br>This does NOT account for Daylight Savings between Mar-Nov. Make sure you offset by an hour during PDT'),
            DateTime::make('End Time', 'end_date')->hideFromIndex()->help('Ignore UTC. It is actually PST.<br>This does NOT account for Daylight Savings between Mar-Nov. Make sure you offset by an hour during PDT'),
            Flexible::make('Assets')
                ->addLayout(LeadgenLessonAssetLayout::class)
                ->preset(LeadgenLessonAssetPreset::class),
            Flexible::make('Lessons')
                ->addLayout(LeadgenLessonLayout::class)
                ->preset(LeadgenLessonPreset::class),
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
