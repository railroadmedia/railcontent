<?php

namespace App\Nova;

use App\Nova\Flexible\Layouts\FeatureLayout;
use App\Nova\Flexible\Layouts\SpectLayout;
use App\Nova\Flexible\Presets\FeaturePreset;
use App\Nova\Flexible\Presets\SpecPreset;
use App\Models\ProductType;
use Illuminate\Http\Request;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\Boolean;
use Laravel\Nova\Fields\Currency;
use Laravel\Nova\Fields\Hidden;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Image;
use Laravel\Nova\Fields\Markdown;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Http\Requests\NovaRequest;
use Whitecube\NovaFlexibleContent\Flexible;

class Lesson extends Resource
{
    public static $model = \App\Models\Product::class;

    public static $search = ['name'];

    public static function indexQuery(NovaRequest $request, $query)
    {
        return $query->join('product_types', 'products.product_type_id', '=', 'product_types.id')
            ->where('product_types.name', 'Lesson')->select('products.*');
    }

    public function fields(NovaRequest $request)
    {

        return [
            ID::make()->sortable(),
            BelongsTo::make('Brand', 'brand', 'App\Nova\Brand'),
            Hidden::make('prodcut_type_id', 'product_type_id')->default(ProductType::where('name', 'Lesson')->first()->id),
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
                ->storeAs(function (Request $request){
                    return $request->file('thumbnail')->getClientOriginalName();
                })
                ->preview(function($value){
                    if(is_null($value)) return null;

                    return str_contains($value, 'amazonaws') || str_contains($value, 'cloudfront') ? $value : 'https://laravel-nova.s3.us-east-2.amazonaws.com/'.$value;
                }),
            Image::make('Thumbnail Logo', 'thumbnail_logo')
                ->disk('s3')
                ->prunable()
                ->hideFromIndex()
                ->disableDownload()
                ->nullable()
                ->storeAs(function (Request $request){
                    return $request->file('thumbnail_logo')->getClientOriginalName();
                })
                ->preview(function($value){
                    if(is_null($value)) return null;

                    return str_contains($value, 'amazonaws') || str_contains($value, 'cloudfront') ? $value : 'https://laravel-nova.s3.us-east-2.amazonaws.com/'.$value;
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
                })
                ->preview(function($value){
                    if(is_null($value)) return null;

                    return str_contains($value, 'amazonaws') || str_contains($value, 'cloudfront') ? $value : 'https://laravel-nova.s3.us-east-2.amazonaws.com/'.$value;
                }),
            Text::make('Short Description', 'short_desc')->hideFromIndex(),
            Text::make('Header Text', 'header_text')->hideFromIndex()->required(),
            Currency::make('Price')->required(),
            Currency::make('Discounted Price', 'discounted_price')->hideFromIndex(),
            Text::make('Special Text', 'special_text')->hideFromIndex(),
            Image::make('Page Logo', 'page_logo')
                ->disk('s3')
                ->prunable()
                ->hideFromIndex()
                ->disableDownload()
                ->nullable()
                ->storeAs(function (Request $request){
                    return $request->file('page_logo')->getClientOriginalName();
                })
                ->preview(function($value){
                    if(is_null($value)) return null;

                    return str_contains($value, 'amazonaws') || str_contains($value, 'cloudfront') ? $value : 'https://laravel-nova.s3.us-east-2.amazonaws.com/'.$value;
                }),
//            Text::make('Page Logo', 'page_logo')->hideFromIndex()->hideFromDetail(),
            Text::make('Video Link', 'video_src')
                ->hideFromIndex(),
            Markdown::make('Overview')->hideFromIndex(),
            Text::make('Study Text', 'study_text')
                ->hideFromIndex(),
            Text::make('Instructor Name', 'instructor_name')
                ->hideFromIndex(),
            Image::make('Instructor Image', 'product_img')
                ->disk('s3')
                ->prunable()
                ->hideFromIndex()
                ->disableDownload()
                ->nullable()
                ->storeAs(function (Request $request){
                    return $request->file('product_img')->getClientOriginalName();
                })
                ->preview(function($value){
                    if(is_null($value)) return null;

                    return str_contains($value, 'amazonaws') || str_contains($value, 'cloudfront') ? $value : 'https://laravel-nova.s3.us-east-2.amazonaws.com/'.$value;
                }),
            Markdown::make('Instructor Description', 'instructor_desc')
                ->hideFromIndex(),
            Boolean::make('Visible')->default(true)->hideFromIndex(),
            Boolean::make('Sold Out', 'sold_out')->default(false)->hideFromIndex(),
            Boolean::make('Free Bonus', 'free_bonus')->default(false)->hideFromIndex(),
            Boolean::make('Guarantee Badge', 'guaranteed')->default(false)->hideFromIndex(),
            Boolean::make('Lifetime Access', 'lifetime_access')->default(false)->hideFromIndex(),
            Boolean::make('Free Shipping', 'free_shipping')->default(false)->hideFromIndex(),
            Boolean::make('Included Edge', 'included_edge')->default(false)->hideFromIndex(),
            Boolean::make('Bundle Lifetime Access', 'bundle_lifetime_access')->default(false)->hideFromIndex(),
            Boolean::make('Bundle Free Shipping', 'bundle_free_shipping')->default(false)->hideFromIndex(),
            Flexible::make('Features/Topics')
                ->addLayout(FeatureLayout::class)
                ->preset(FeaturePreset::class),
            Flexible::make('Specs')
                ->addLayout(SpectLayout::class)
                ->preset(SpecPreset::class),
        ];
    }

    public function filters(NovaRequest $request)
    {
        return [
            new \App\Nova\Filters\Brand()
        ];
    }
}
