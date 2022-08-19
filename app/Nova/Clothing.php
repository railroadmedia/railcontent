<?php

namespace App\Nova;

use App\Models\ProductType;
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
use Illuminate\Support\Str;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\Boolean;
use Laravel\Nova\Fields\Currency;
use Laravel\Nova\Fields\Hidden;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Image;
use Laravel\Nova\Fields\Number;
use Laravel\Nova\Fields\Select;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Http\Requests\NovaRequest;
use Whitecube\NovaFlexibleContent\Flexible;

class Clothing extends Resource
{
    public static $model = \App\Models\Product::class;

    public static $search = ['name'];

    public static function indexQuery(NovaRequest $request, $query)
    {
        return $query->join('product_types', 'products.product_type_id', '=', 'product_types.id')
            ->whereIn('product_types.name', ['Hat', 'Shirt', 'Hoodie'])->select('products.*');
    }

    public function fields(NovaRequest $request)
    {
        $types = ProductType::whereIn('name', ['Hat', 'Shirt', 'Hoodie'])->get();
        $uuid  = Str::uuid();

        return [
            ID::make()->sortable(),
            BelongsTo::make('Brand', 'brand', 'App\Nova\Brand'),
            Select::make('Product Type', 'product_type_id')->options([
                $types->where('name', 'Hat')->first()->id => 'Hat',
                $types->where('name', 'Shirt')->first()->id => 'Shirt',
                $types->where('name', 'Hoodie')->first()->id => 'Hoodie'
            ])->displayUsingLabels(),
            Hidden::make('Uuid')->withMeta(["value" => $uuid]),
            Text::make('Name')->required(),
            //slug field for displaying to use a tag
            Text::make('Slug', function(){
                $slug = str_replace( array('Drumeo-', 'Pianote-', 'Guitareo-', 'Singeo-'), '', $this->slug );

                return '<a class="link-default" target="_blank" href="/'.strtolower($this->brand->name).'/shop/'.$slug.'">'.$slug.'</a>';
            })->asHtml(),
            //slug field for saving
            Text::make('Slug')->required()->hideFromDetail()->hideFromIndex(),
            Text::make('Sku')->hideFromIndex()->required(),
            Text::make('Promo Code', 'promo_code')->hideFromIndex(),
            Image::make('Thumbnail')
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

                    return '/'.$brand.'/'.$request->uuid.'-'.$request->file('thumbnail')->getClientOriginalName();
                })
                ->preview(function($value){
                    if(is_null($value)) return null;

                    return str_contains($value, 'amazonaws') || str_contains($value, 'cloudfront') ? $value : 'https://laravel-nova.s3.us-east-2.amazonaws.com/'.$value;
                }),
            Text::make('Thumbnail')->hideFromIndex()->hideFromDetail(),
            Text::make('Badge Text', 'badge_text')->hideFromIndex(),
            Text::make('Meta Description', 'meta_desc')->hideFromIndex()->required(),
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

                    return '/'.$brand.'/'.$request->uuid.'-'.$request->file('meta_img')->getClientOriginalName();
                })
                ->preview(function($value){
                    if(is_null($value)) return null;

                    return str_contains($value, 'amazonaws') || str_contains($value, 'cloudfront') ? $value : 'https://laravel-nova.s3.us-east-2.amazonaws.com/'.$value;
                }),
            Text::make('Meta Image', 'meta_img')->hideFromIndex()->hideFromDetail(),
            Text::make('Short Description', 'short_desc')->hideFromIndex(),
            Text::make('Header Text', 'header_text')->hideFromIndex()->required(),
            Currency::make('Price')->required(),
            Currency::make('Discounted Price', 'discounted_price')->hideFromIndex(),
            Text::make('Special Text', 'special_text')->hideFromIndex(),
            Boolean::make('Visible')->default(true)->hideFromIndex(),
            Boolean::make('Sold Out', 'sold_out')->default(false)->hideFromIndex(),
            Boolean::make('Free Bonus', 'free_bonus')->default(false)->hideFromIndex(),
            Boolean::make('Guarantee Badge', 'guaranteed')->default(false)->hideFromIndex(),
            Boolean::make('Lifetime Access', 'lifetime_access')->default(false)->hideFromIndex(),
            Boolean::make('Free Shipping', 'free_shipping')->default(false)->hideFromIndex(),
            Boolean::make('Bundle Lifetime Access', 'bundle_lifetime_access')->default(false)->hideFromIndex(),
            Boolean::make('Bundle Free Shipping', 'bundle_free_shipping')->default(false)->hideFromIndex(),
            Boolean::make('Membership Discount', 'membership_discount')->default(false)->hideFromIndex(),
            Boolean::make('Size Case Sensitive', 'size_case_sensitive')->default(false)->hideFromIndex(),
            Number::make('Display order', 'display_order'),
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
