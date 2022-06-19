<?php

namespace App\Nova;

use App\Models\SizeChart;
use App\Nova\Flexible\Layouts\FeatureLayout;
use App\Nova\Flexible\Layouts\ImageLayout;
use App\Nova\Flexible\Layouts\SizeLayout;
use App\Nova\Flexible\Layouts\SpectLayout;
use App\Nova\Flexible\Presets\FeaturePreset;
use App\Nova\Flexible\Presets\ImagePreset;
use App\Nova\Flexible\Presets\SizePreset;
use App\Nova\Flexible\Presets\SpecPreset;
use Illuminate\Http\Request;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\Boolean;
use Laravel\Nova\Fields\Currency;
use Laravel\Nova\Fields\Heading;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Image;
use Laravel\Nova\Fields\Markdown;
use Laravel\Nova\Fields\Select;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Http\Requests\NovaRequest;
use Whitecube\NovaFlexibleContent\Flexible;

class Product extends Resource
{
    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $model = \App\Models\Product::class;

    /**
     * The single value that should be used to represent the resource when being displayed.
     *
     * @var string
     */
    public static $title = 'name';

    /**
     * The columns that should be searched.
     *
     * @var array
     */
    public static $search = [
        'id', 'name'
    ];

    /**
     * Get the fields displayed by the resource.
     *
     * @param  \Laravel\Nova\Http\Requests\NovaRequest  $request
     * @return array
     */
    public function fields(NovaRequest $request)
    {
        return [
            ID::make()->sortable(),
            BelongsTo::make('Brand', 'brand', 'App\Nova\Brand'),
            BelongsTo::make('ProductType', 'productType', 'App\Nova\ProductType'),
            Text::make('Name')->required(),
            Text::make('Slug')
                ->asHtml()
                ->required()
                ->displayUsing(function($value){
                    return '<a class="link-default" target="_blank" href="/'.strtolower($this->brand->name).'/shop/'.$value.'">'.$value.'</a>';
                }),
            Text::make('Sku')->hideFromIndex()->required(),
            Image::make('Thumbnail')
                ->disk('s3')
                ->prunable()
                ->hideFromIndex()
                ->deletable(false)
                ->disableDownload()
                ->required()
                ->storeAs(function (Request $request){
                    return $request->file('thumbnail')->getClientOriginalName();
                }),
            Text::make('Meta Description', 'meta_desc')->hideFromIndex()->required(),
            Image::make('Meta Image', 'meta_img')
                ->disk('s3')
                ->prunable()
                ->hideFromIndex()
                ->disableDownload()
                ->deletable(false)
                ->required()
                ->storeAs(function (Request $request){
                    return $request->file('meta_img')->getClientOriginalName();
                }),
            Text::make('Short Description', 'short_desc')->hideFromIndex(),
            Text::make('Header Text', 'header_text')->hideFromIndex()->required(),
            Currency::make('Price')->hideFromIndex()->required(),
            Currency::make('Discounted Price', 'discounted_price')->hideFromIndex(),
            Text::make('Special Text', 'special_text')->hideFromIndex(),
            Flexible::make('Features/Topics')
                ->addLayout(FeatureLayout::class)
                ->preset(FeaturePreset::class),
            Flexible::make('Specs')
                ->addLayout(SpectLayout::class)
                ->preset(SpecPreset::class),
            Boolean::make('Visible')->default(true)->hideFromIndex(),
            Boolean::make('Sold Out', 'sold_out')->default(false)->hideFromIndex(),
            Boolean::make('Free Bonus', 'free_bonus')->default(false)->hideFromIndex(),
            Boolean::make('Guarantee Badge', 'guaranteed')->default(false)->hideFromIndex(),
            Boolean::make('Lifetime Access', 'lifetime_access')->default(false)->hideFromIndex(),
            Boolean::make('Free Shipping', 'free_shipping')->default(false)->hideFromIndex(),
            Heading::make('Lesson'),
            Image::make('Logo')
                ->disk('s3')
                ->prunable()
                ->hideFromIndex()
                ->disableDownload()
                ->nullable()
                ->storeAs(function (Request $request){
                    return $request->file('logo')->getClientOriginalName();
                }),
            Text::make('Video Link', 'video_src')->hideFromIndex(),
            Text::make('Instructor Name', 'instructor_name')->hideFromIndex(),
            Image::make('Instructor Image', 'instructor_img')
                ->disk('s3')
                ->prunable()
                ->hideFromIndex()
                ->disableDownload()
                ->nullable()
                ->storeAs(function (Request $request){
                    return $request->file('instructor_img')->getClientOriginalName();
                }),
            Markdown::make('Instructor Description', 'instructor_desc')->hideFromIndex(),
            Text::make('Study Text', 'study_text')->hideFromIndex(),
            Markdown::make('Overview')->hideFromIndex(),
            Heading::make('Clothing/Accessory'),
            Flexible::make('Images')
                ->addLayout(ImageLayout::class)
                ->preset(ImagePreset::class),
            Select::make('Size Chart', 'size_chart_id')
                ->options(\App\Models\SizeChart::pluck('chart', 'id'))
                ->onlyOnForms()
                ->hideFromIndex(),
            Text::make('Size Chart', 'size_chart_id')
                ->asHtml()
                ->hideFromIndex()
                ->hideWhenCreating()
                ->hideWhenUpdating()
                ->displayUsing(function($value){
                    return is_null($value) ? "-" : "<img src=\"https://laravel-nova.s3.us-east-2.amazonaws.com/".SizeChart::where('id', '=', $value)->first()->chart."\" alt='size chart' />";
                }),
            Flexible::make('Sizes')
                ->addLayout(SizeLayout::class)
                ->preset(SizePreset::class),
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
        return [];
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
