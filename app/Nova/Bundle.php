<?php

namespace App\Nova;

use App\Models\ProductType;
use App\Nova\Flexible\Layouts\BundleLayout;
use App\Nova\Flexible\Layouts\ImageLayout;
use App\Nova\Flexible\Presets\BundlePreset;
use App\Nova\Flexible\Presets\ImagePreset;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\Boolean;
use Laravel\Nova\Fields\Currency;
use Laravel\Nova\Fields\DateTime;
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
            ->where('product_types.name', 'Bundles')->select('products.*');
    }

    public function fields(NovaRequest $request)
    {
        $uuid  = Str::uuid();

        return [
            ID::make()->sortable(),
            BelongsTo::make('Brand', 'brand', 'App\Nova\Brand')->sortable(),
            Hidden::make('prodcut_type_id', 'product_type_id')->default(ProductType::where('name', 'Bundles')->first()->id),
            Text::make('Name')->required()->sortable(),
            Boolean::make('Sales Page Visible?','sales_page_visible')->default(true)->hideFromIndex(),
            DateTime::make('Sales Page Start Time', 'sales_page_start_date')->hideFromIndex()->help('Ignore UTC. It is actually PST.<br>This does NOT account for Daylight Savings between Mar-Nov. Make sure you offset by an hour during PDT'),
            DateTime::make('Sales Page End Time', 'sales_page_end_date')->hideFromIndex()->help('Ignore UTC. It is actually PST.<br>This does NOT account for Daylight Savings between Mar-Nov. Make sure you offset by an hour during PDT'),

            //slug field for displaying to use a tag
            Text::make('Slug', function(){
                return '<a class="link-default" target="_blank" href="'.get_legacy_brand_base_url(strtolower($this->brand->name)).($this->brand->name === 'Drumeo' ? '/drumshop/' : '/shop/').$this->slug.'">'.$this->slug.'</a>';
            })->asHtml(),
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

                    return '/'.$brand.'/Meta-images/'.$request->uuid.'-'.$request->file('meta_img')->getClientOriginalName();
                })
                ->preview(function($value){
                    if(empty($value)) return null;

                    return $value;
                }),
            Text::make('Meta Image', 'meta_img')->hideFromIndex()->hideFromDetail(),
            Currency::make('Price')->required(),
            Currency::make('Discounted Price', 'discounted_price')->hideFromIndex(),
            Image::make('Page Logo', 'page_logo')
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

                    return '/'.$brand.'/Page-logos/'.$request->uuid.'-'.$request->file('page_logo')->getClientOriginalName();
                })
                ->preview(function($value){
                    if(empty($value)) return null;

                    return $value;
                }),
            Text::make('Page Logo', 'page_logo')->hideFromIndex()->hideFromDetail(),
            Text::make('Header Text', 'header_text')->hideFromIndex(),
            Text::make('Subheader Text', 'subheader_text')->hideFromIndex(),
            Text::make('Special Text', 'special_text')->hideFromIndex(),
            Text::make('Video Link', 'video_src')
                ->hideFromIndex(),
            Flexible::make('Images')
                ->addLayout(ImageLayout::class)
                ->preset(ImagePreset::class),
            Image::make('Spread Image', 'spread_img')
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

                    return '/'.$brand.'/Spread-images/'.$request->uuid.'-'.$request->file('page_logo')->getClientOriginalName();
                })
                ->preview(function($value){
                    if(empty($value)) return null;

                    return $value;
                }),
            Text::make('Spread Image', 'spread_img')->hideFromIndex()->hideFromDetail(),
            Markdown::make('Overview')
                ->hideFromIndex(),
            Boolean::make('Visible On Shop Page')->default(false)->hideFromIndex()->hideFromDetail()->hideWhenCreating()->hideWhenUpdating(),
            Boolean::make('Sold Out', 'sold_out')->default(false)->hideFromIndex(),
            Boolean::make('Guarantee Badge', 'guaranteed')->default(false)->hideFromIndex(),
            Boolean::make('Free Shipping', 'free_shipping')->default(false)->hideFromIndex(),
            Flexible::make('Bonuses')
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
