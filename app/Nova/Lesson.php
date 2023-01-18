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
use Laravel\Nova\Fields\Heading;
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
            ->where('product_types.name', 'Lessons')->select('products.*');
    }

    public function fields(NovaRequest $request)
    {
        $uuid  = Str::uuid();

        return [
            ID::make()->sortable(),
            BelongsTo::make('Brand', 'brand', 'App\Nova\Brand')->sortable(),
            Hidden::make('product_type_id', 'product_type_id')->default(ProductType::where('name', '=', 'Lessons')->first()->id),
            Hidden::make('Uuid')->withMeta(["value" => $uuid]),
            Text::make('Name')->required()->sortable(),
            //slug field for displaying to use a tag
            Text::make('Slug', function(){
                return '<a class="link-default" target="_blank" href="'.get_legacy_brand_base_url(strtolower($this->brand->name)).($this->brand->name === 'Drumeo' ? '/drumshop/' : '/shop/').$this->slug.'">'.$this->slug.'</a>';
            })->asHtml()->hideWhenUpdating()->hideWhenCreating(),
            //slug field for saving
            Text::make('Slug')->hideFromDetail()->hideFromIndex(),
            Text::make('Sku')->hideFromIndex(),
            Text::make('Meta Description', 'meta_desc')->hideFromIndex(),
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

                    return '/'.$brand.'/meta-Image/'.$request->uuid.'-'.$request->file('meta_img')->getClientOriginalName();
                })
                ->preview(function($value){
                    if(empty($value)) return null;

                    return str_contains($value, 'amazonaws') || str_contains($value, 'cloudfront') || str_contains($value, 'vimeocdn') ? $value : 'https://laravel-nova.s3.us-east-2.amazonaws.com/'.$value;
                }),
            Text::make('Meta Image', 'meta_img')->hideFromIndex()->hideFromDetail(),
            Text::make('Promo Code', 'promo_code')->hideFromIndex(),
            Currency::make('Price')->required(),
            Currency::make('Discounted Price', 'discounted_price')->help('If discounted price is the same as the price, no discount will show on the sales page.'),
            Boolean::make('Sold Out', 'sold_out')->default(false)->hideFromIndex(),
            Heading::make('Shop Card'),
            Text::make('Badge Text', 'badge_text')->hideFromIndex(),
            Image::make('Shop Card Thumbnail', 'thumbnail')
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

                    return '/'.$brand.'/thumbnail/'.$request->uuid.'-'.$request->file('thumbnail')->getClientOriginalName();
                })
                ->preview(function($value){
                    if(empty($value)) return null;

                    return str_contains($value, 'amazonaws') || str_contains($value, 'cloudfront') || str_contains($value, 'vimeocdn') ? $value : 'https://laravel-nova.s3.us-east-2.amazonaws.com/'.$value;
                }),
            Text::make('Shop Card Thumbnail', 'thumbnail')->hideFromIndex()->hideFromDetail(),
            Image::make('Shop Card Logo', 'thumbnail_logo')
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

                    return '/'.$brand.'/thumbnail-logo'.$request->uuid.'-'.$request->file('thumbnail_logo')->getClientOriginalName();
                })
                ->preview(function($value){
                    if(empty($value)) return null;

                    return str_contains($value, 'amazonaws') || str_contains($value, 'cloudfront') || str_contains($value, 'vimeocdn') ? $value : 'https://laravel-nova.s3.us-east-2.amazonaws.com/'.$value;
                }),
            Text::make('Shop Card Logo', 'thumbnail_logo')->hideFromIndex()->hideFromDetail(),
            Text::make('Shop Card Description', 'short_desc')->hideFromIndex(),
            Boolean::make('Visible On Shop Page','visible')->default(true)->hideFromIndex(),
            Boolean::make('Included Edge', 'included_edge')->default(false)->hideFromIndex(),
            Number::make('Display order', 'display_order')->default(0)->sortable(),
            Heading::make('Product page'),
            Text::make('Header Text', 'header_text')->hideFromIndex(),
            Text::make('Subheader Text', 'subheader_text')->hideFromIndex(),
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

                    return '/'.$brand.'/page-logo'.$request->uuid.'-'.$request->file('page_logo')->getClientOriginalName();
                })
                ->preview(function($value){
                    if(empty($value)) return null;

                    return str_contains($value, 'amazonaws') || str_contains($value, 'cloudfront') || str_contains($value, 'vimeocdn') ? $value : 'https://laravel-nova.s3.us-east-2.amazonaws.com/'.$value;
                }),
            Text::make('Page Logo', 'page_logo')->hideFromIndex()->hideFromDetail(),
            Text::make('Video Link', 'video_src')
                ->hideFromIndex(),
            Markdown::make('Overview')->hideFromIndex(),
            Flexible::make('Benefits')
                ->addLayout(BenefitLayout::class)
                ->preset(BenefitPreset::class)
                ->help('There has to be 2 benefits or leave it blank.'),
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

                    return '/'.$brand.'/product-image'.$request->uuid.'-'.$request->file('product_img')->getClientOriginalName();
                })
                ->preview(function($value){
                    if(empty($value)) return null;

                    return str_contains($value, 'amazonaws') || str_contains($value, 'cloudfront') || str_contains($value, 'vimeocdn') ? $value : 'https://laravel-nova.s3.us-east-2.amazonaws.com/'.$value;
                }),
            Text::make('Instructor Image', 'product_img')->hideFromIndex()->hideFromDetail(),
            Markdown::make('Instructor Description', 'instructor_desc')
                ->hideFromIndex(),
            Flexible::make('Topics')
                ->addLayout(FeatureLayout::class)
                ->preset(FeaturePreset::class),
            Flexible::make('Specs')
                ->addLayout(SpectLayout::class)
                ->preset(SpecPreset::class),
            Boolean::make('Guarantee Badge', 'guaranteed')->default(false)->hideFromIndex(),
            Boolean::make('Free Shipping', 'free_shipping')->default(false)->hideFromIndex(),
            Heading::make('Bundle'),
            Image::make('Bundle Image', 'bundle_img')
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

                    return '/'.$brand.'/bundle-image'.$request->uuid.'-'.$request->file('bundle_img')->getClientOriginalName();
                })
                ->preview(function($value){
                    if(empty($value)) return null;

                    return str_contains($value, 'amazonaws') || str_contains($value, 'cloudfront') || str_contains($value, 'vimeocdn') ? $value : 'https://laravel-nova.s3.us-east-2.amazonaws.com/'.$value;
                }),
            Text::make('Bundle Image', 'bundle_img')->hideFromIndex()->hideFromDetail(),
            Text::make('Bundle Description', 'bundle_desc')->hideFromIndex(),
            Boolean::make('Bundle Free Shipping', 'bundle_free_shipping')->default(false)->hideFromIndex()->hideFromDetail()->hideWhenCreating()->hideWhenUpdating(),
        ];
    }

    public function filters(NovaRequest $request)
    {
        return [
            new \App\Nova\Filters\Brand()
        ];
    }
}
