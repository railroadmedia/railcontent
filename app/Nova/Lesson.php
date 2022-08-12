<?php

namespace App\Nova;

use App\Nova\Flexible\Layouts\BenefitLayout;
use App\Nova\Flexible\Layouts\FeatureLayout;
use App\Nova\Flexible\Layouts\SpectLayout;
use App\Nova\Flexible\Presets\BenefitPreset;
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
use Laravel\Nova\Fields\Number;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Http\Requests\NovaRequest;
use Whitecube\NovaFlexibleContent\Flexible;
use Illuminate\Support\Str;

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
        $uuid  = Str::uuid();

        return [
            ID::make()->sortable(),
            BelongsTo::make('Brand', 'brand', 'App\Nova\Brand'),
            Hidden::make('prodcut_type_id', 'product_type_id')->default(ProductType::where('name', 'Lesson')->first()->id),
            Hidden::make('Uuid')->withMeta(["value" => $uuid]),
            Text::make('Name')->required(),
            //slug field for displaying to use a tag
            Text::make('Slug', function(){
                $slug = str_replace( array('Drumeo-', 'Pianote-', 'Guitareo-', 'Singeo-'), '', $this->slug );

                return '<a class="link-default" target="_blank" href="/'.strtolower($this->brand->name).'/shop/'.$slug.'">'.$slug.'</a>';
            })->asHtml()->hideWhenUpdating()->hideWhenCreating(),
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
            Image::make('Thumbnail Logo', 'thumbnail_logo')
                ->disk('nova_s3')
                ->prunable()
                ->hideFromIndex()
                ->disableDownload()
                ->nullable()
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

                    return '/'.$brand.'/'.$request->uuid.'-'.$request->file('thumbnail_logo')->getClientOriginalName();
                })
                ->preview(function($value){
                    if(is_null($value)) return null;

                    return str_contains($value, 'amazonaws') || str_contains($value, 'cloudfront') ? $value : 'https://laravel-nova.s3.us-east-2.amazonaws.com/'.$value;
                }),
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
            Text::make('Short Description', 'short_desc')->hideFromIndex(),
            Text::make('Header Text', 'header_text')->hideFromIndex()->required(),
            Currency::make('Price')->required(),
            Currency::make('Discounted Price', 'discounted_price')->hideFromIndex(),
            Text::make('Special Text', 'special_text')->hideFromIndex(),
            Image::make('Page Logo', 'page_logo')
                ->disk('nova_s3')
                ->prunable()
                ->hideFromIndex()
                ->disableDownload()
                ->nullable()
                ->storeAs(function (Request $request) {
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

                    return '/'.$brand.'/'.$request->uuid.'-'.$request->file('page_logo')->getClientOriginalName();
                })
                ->preview(function($value){
                    if(is_null($value)) return null;

                    return str_contains($value, 'amazonaws') || str_contains($value, 'cloudfront') ? $value : 'https://laravel-nova.s3.us-east-2.amazonaws.com/'.$value;
                }),
            Text::make('Page Logo URL', 'page_logo')->hideFromIndex()->hideFromDetail(),
            Text::make('Video Link', 'video_src')
                ->hideFromIndex(),
            Markdown::make('Overview')->hideFromIndex(),
            Text::make('Study Text', 'study_text')
                ->hideFromIndex(),
            Flexible::make('Benefits')
                ->addLayout(BenefitLayout::class)
                ->preset(BenefitPreset::class),
            Text::make('Instructor Name', 'instructor_name')
                ->hideFromIndex(),
            Image::make('Instructor Image', 'product_img')
                ->disk('nova_s3')
                ->prunable()
                ->hideFromIndex()
                ->disableDownload()
                ->nullable()
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

                    return '/'.$brand.'/'.$request->uuid.'-'.$request->file('product_img')->getClientOriginalName();
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
            Number::make('Display order', 'display_order'),
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
