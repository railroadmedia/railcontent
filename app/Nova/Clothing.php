<?php

namespace App\Nova;

use App\Models\Brand;
use App\Models\Product;
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
use Laravel\Nova\Fields\FormData;
use Laravel\Nova\Fields\Heading;
use Laravel\Nova\Fields\Hidden;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Image;
use Laravel\Nova\Fields\Markdown;
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
            ->whereIn('product_types.name', ['Hats', 'Shirts', 'Hoodies', 'Sweaters'])->select('products.*');
    }

    public function fields(NovaRequest $request)
    {
        $types = ProductType::whereIn('name', ['Hats', 'Shirts', 'Hoodies', 'Sweaters'])->get();
        $uuid  = Str::uuid();

        return [
            ID::make()->sortable(),
            BelongsTo::make('Brand', 'brand', 'App\Nova\Brand')->sortable(),
            Select::make('Product Type', 'product_type_id')->options([
                $types->where('name', 'Hats')->first()->id => 'Hats',
                $types->where('name', 'Shirts')->first()->id => 'Shirts',
                $types->where('name', 'Hoodies')->first()->id => 'Hoodies',
                $types->where('name', 'Sweaters')->first()->id => 'Sweaters'
            ])->displayUsingLabels()->sortable(),
            Hidden::make('Uuid')->withMeta(["value" => $uuid]),
            Text::make('Name')->required()->sortable(),
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
                    if(!empty($request->brand)){
                        $brand = Brand::query()->where('id', $request->brand)->first()->name;
                    }else{
                        abort(500, 'Please select a brand');
                    }

                    return '/'.$brand.'/Meta-images/'.$request->uuid.'-'.$request->file('meta_img')->getClientOriginalName();
                })
                ->preview(function($value){
                    if(empty($value)) return null;

                    return $value;
                }),
            Text::make('Meta Image', 'meta_img')->hideFromIndex()->hideFromDetail(),
            Text::make('Promo Code', 'promo_code')->hideFromIndex(),
            Currency::make('Price')->required(),
            Currency::make('Discounted Price', 'discounted_price')->help('If discounted price is the same as the price, no discount will show on the sales page.'),
            Boolean::make('Sold Out', 'sold_out')->default(false)->hideFromIndex(),
            Boolean::make('Is Seasonal ?', 'is_seasonal')->default(false)->hideFromIndex(),
            Heading::make('Shop Card'),
            Text::make('Badge Text', 'badge_text')->hideFromIndex(),
            Image::make('Shop Card Thumbnail', 'thumbnail')
                ->disk('nova_s3')
                ->prunable()
                ->hideFromIndex()
                ->deletable(false)
                ->disableDownload()
                ->storeAs(function (Request $request){
                    if(!empty($request->brand)){
                        $brand = Brand::query()->where('id', $request->brand)->first()->name;
                    }else{
                        abort(500, 'Please select a brand');
                    }

                    return '/'.$brand.'/Thumbnails/'.$request->uuid.'-'.$request->file('thumbnail')->getClientOriginalName();
                })
                ->preview(function($value){
                    if(empty($value)) return null;

                    return $value;
                }),
            Text::make('Shop Card Thumbnail', 'thumbnail')->hideFromIndex()->hideFromDetail(),
            Text::make('Shop Card Description', 'short_desc')->hideFromIndex(),
            Boolean::make('Visible On Shop Page','visible')->default(true)->hideFromIndex(),
            Number::make('Display order', 'display_order')->sortable()
                ->help('Display order should be 0 if set to invisible on shop page.')
                ->required()
                ->dependsOn(
                    ['brand', 'product_type_id', 'is_seasonal'],
                    function (Text $field, NovaRequest $request, FormData $formData) {
                        if($formData->brand === '1' || $formData->brand === '2'){
                            $display_num = Product::where([['brand_id', $formData->brand],['product_type_id', $formData->product_type_id], ['is_seasonal', ['is_seasonal', !empty($formData->is_seasonal) ? 1 : 0]]])->orderBy('display_order', 'DESC')->first();
                            abort(500, $display_num);
                        }
                        else {
                            $display_num = Product::where([['brand_id', $formData->brand], ['is_seasonal', ['is_seasonal', !empty($formData->is_seasonal) ? 1 : 0]]])->orderBy('display_order', 'DESC')->first();
                        }

                        if(!is_null($display_num)){
                            $display_num = $display_num->display_order;
                            $field->default($display_num+1);
                        } else {
                            $field->default(1);
                        }
                }),
            Heading::make('Product page'),
            Text::make('Header Text', 'header_text')->hideFromIndex(),
            Text::make('Subheader Text', 'subheader_text')->hideFromIndex(),
            Text::make('Special Text', 'special_text')->hideFromIndex(),
            Flexible::make('Slide Images', 'images')
                ->addLayout(ImageLayout::class)
                ->preset(ImagePreset::class),
            Markdown::make('Overview')->hideFromIndex()->help('If you want to make text bold, wrap with ** **. ex) ** Text **'),
            Flexible::make('Specs')
                ->addLayout(SpectLayout::class)
                ->preset(SpecPreset::class),
            Flexible::make('Features')
                ->addLayout(FeatureLayout::class)
                ->preset(FeaturePreset::class),
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
            Boolean::make('Size Case Sensitive', 'size_case_sensitive')->default(false)->hideFromIndex()->help('Size codes are uppercases by default and will be lowercases if checked'),
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
                    if(!empty($request->brand)){
                        $brand = Brand::query()->where('id', $request->brand)->first()->name;
                    }else{
                        abort(500, 'Please select a brand');
                    }

                    return '/'.$brand.'/Bundle-images/'.$request->uuid.'-'.$request->file('bundle_img')->getClientOriginalName();
                })
                ->preview(function($value){
                    if(empty($value)) return null;

                    return $value;
                }),
            Text::make('Bundle Image', 'bundle_img')->hideFromIndex()->hideFromDetail(),
            Text::make('Bundle Description', 'bundle_desc')->hideFromIndex(),
            Boolean::make('Bundle Free Shipping', 'bundle_free_shipping')->default(false)->hideFromIndex(),
        ];
    }

    public function filters(NovaRequest $request)
    {
        return [
            new \App\Nova\Filters\Brand()
        ];
    }
}
