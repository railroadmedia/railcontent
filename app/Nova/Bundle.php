<?php

namespace App\Nova;

use App\Models\ProductType;
use App\Nova\Flexible\Layouts\BundleLayout;
use App\Nova\Flexible\Presets\BundlePreset;
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

class Bundle extends Resource
{
    public static $model = \App\Models\Product::class;

    public static $search = ['name'];

    public static function indexQuery(NovaRequest $request, $query)
    {
        return $query->join('product_types', 'products.product_type_id', '=', 'product_types.id')
            ->where('product_types.name', 'Bundle')->select('products.*');
    }

    public function fields(NovaRequest $request)
    {
        return [
            ID::make()->sortable(),
            BelongsTo::make('Brand', 'brand', 'App\Nova\Brand'),
            Hidden::make('prodcut_type_id', 'product_type_id')->default(ProductType::where('name', 'Bundle')->first()->id),
            Text::make('Name')->required(),
            //slug field for displaying to use a tag
            Text::make('Slug', function(){
                $slug = str_replace( array('Drumeo-', 'Pianote-', 'Guitareo-', 'Singeo-'), '', $this->slug );

                return '<a class="link-default" target="_blank" href="/'.strtolower($this->brand->name).'/shop/'.$slug.'">'.$slug.'</a>';
            })->asHtml(),
            //slug field for saving
            Text::make('Slug')->required()->hideFromDetail()->hideFromIndex(),
            Text::make('Sku')->hideFromIndex()->required(),
            Image::make('Thumbnail')
                ->disk('nova_s3')
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
                ->disk('nova_s3')
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
                ->disk('nova_s3')
                ->prunable()
                ->hideFromIndex()
                ->disableDownload()
                ->deletable(false)
                ->storeAs(function (Request $request){
                    return $request->file('meta_img')->getClientOriginalName();
                })
                ->preview(function($value){
                    if(is_null($value)) return null;

                    return str_contains($value, 'amazonaws') || str_contains($value, 'cloudfront') ? $value : 'https://laravel-nova.s3.us-east-2.amazonaws.com/'.$value;
                }),
            Image::make('Bundle Image', 'bundle_img')
                ->disk('nova_s3')
                ->prunable()
                ->hideFromIndex()
                ->disableDownload()
                ->nullable()
                ->storeAs(function (Request $request){
                    return $request->file('bundle_img')->getClientOriginalName();
                })
                ->preview(function($value){
                    if(is_null($value)) return null;

                    return str_contains($value, 'amazonaws') || str_contains($value, 'cloudfront') ? $value : 'https://laravel-nova.s3.us-east-2.amazonaws.com/'.$value;
                }),
            Image::make('Page Logo', 'page_logo')
                ->disk('nova_s3')
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
            Text::make('Video Link', 'video_src')
                ->hideFromIndex(),
            Text::make('Short Description', 'short_desc')->hideFromIndex(),
            Text::make('Header Text', 'header_text')->hideFromIndex(),
            Currency::make('Price')->required(),
            Currency::make('Discounted Price', 'discounted_price')->hideFromIndex(),
            Text::make('Special Text', 'special_text')->hideFromIndex(),
            Markdown::make('Overview')
                ->hideFromIndex(),
            Boolean::make('Visible')->default(true)->hideFromIndex(),
            Boolean::make('Sold Out', 'sold_out')->default(false)->hideFromIndex(),
            Boolean::make('Guarantee Badge', 'guaranteed')->default(false)->hideFromIndex(),
            Boolean::make('Free Shipping', 'free_shipping')->default(false)->hideFromIndex(),
            Flexible::make('Products')
                ->addLayout(BundleLayout::class)
                ->preset(BundlePreset::class),
        ];
    }

    public function filters(NovaRequest $request)
    {
        return [
            new \App\Nova\Filters\Brand()
        ];
    }
}
