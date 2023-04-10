<?php

namespace App\Nova;

use App\Models\Brand;
use App\Models\Product;
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
use Laravel\Nova\Fields\DateTime;
use Laravel\Nova\Fields\FormData;
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

class Cohort extends Resource
{
    public static $model = \App\Models\Cohort::class;

    public static $search = ['name'];

    public function fields(NovaRequest $request)
    {
        $uuid  = Str::uuid();

        return [
            ID::make()->sortable(),

            BelongsTo::make('Brand', 'brand', 'App\Nova\Brand')->sortable(),

            Text::make('slug')->required(),
            Text::make('Headline')->sortable(),
            Text::make('Subheadline')->sortable(),
            Text::make('Title')->required(),

            Image::make('logo')
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

                    return '/'.$brand.'/cohorts/'.$request->uuid.'-'.$request->file('logo')->getClientOriginalName();
                })
                ->preview(function($value){
                    if(empty($value)) return null;

                    return $value;
                }),
            Text::make('logo')->hideFromIndex()->hideFromDetail()->help('Use this field if you have a hosted image link. (Google Drive links will NOT work.)'),
            Markdown::make('Description')->help('If a description exceeds 316 the last three characters will be replaced with an ellipses.<br> Use &lt;br&gt; for a line break, &lt;i&gt;&lt;/i&gt; for italics, and &lt;b&gt;&lt;/b&gt; for bold. <br> Limited to three lines of text.'),
//            Text::make('CTA Button Text', 'cta_text')->hideFromIndex(),
//            Text::make('CTA URL', 'cta_url'),
            Image::make('Cohort image url', 'cohort_image_url')
                ->help('The image should be 1128  x 276px or a comparable aspect ratio.')
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

                    return '/'.$brand.'/cohorts/'.$request->uuid.'-'.$request->file('cohort_image_url')->getClientOriginalName();
                })
                ->preview(function($value){
                    if(empty($value)) return null;

                    return $value;
                }),
            Text::make('Cohort image url', 'cohort_image_url')->hideFromIndex()->hideFromDetail()->help('Use this field if you have a hosted image link. (Google Drive links will NOT work.)'),
            DateTime::make(__('Start Time'), 'start_date')->hideFromIndex()->help('Ignore UTC. It is actually PST.<br>This does NOT account for Daylight Savings between Mar-Nov. Make sure you offset by an hour during PDT'),
            DateTime::make(__('End Time'), 'end_date')->hideFromIndex()->help('Ignore UTC. It is actually PST.<br>This does NOT account for Daylight Savings between Mar-Nov. Make sure you offset by an hour during PDT'),
            Number::make('Pack ID', 'pack_id'),
//            Boolean::make('visible')->hideFromIndex()->default(true),
//            Boolean::make('Featured product?', 'is_featured')->hideFromIndex()->default(false),
//            Text::make('Product ID', 'product_id')->hideFromIndex()
//                ->hide()
//                ->hideFromDetail(function (NovaRequest $request, $resource) {
//                    return !$this->is_featured;
//                })
//                ->dependsOn(
//                    ['is_featured'],
//                    function (Text $field, NovaRequest $request, FormData $formData) {
//                        if ($formData->is_featured) $field->show()->rules(['required']);
//                    }
//                ),
//            Text::make('Product URL', 'product_url')->hideFromIndex()
//                ->hide()
//                ->hideFromDetail(function (NovaRequest $request, $resource) {
//                    return !$this->is_featured;
//                })
//                ->dependsOn(
//                    ['is_featured'],
//                    function (Text $field, NovaRequest $request, FormData $formData) {
//                        if ($formData->is_featured) $field->show()->rules(['required']);
//                    }
//                ),
//            Text::make('Registration URL / Endpoint', 'endpoint')->hideFromIndex()
//                ->hide()
//                ->hideFromDetail(function (NovaRequest $request, $resource) {
//                    return !$this->is_featured;
//                })
//                ->dependsOn(
//                    ['is_featured'],
//                    function (Text $field, NovaRequest $request, FormData $formData) {
//                        if ($formData->is_featured) $field->show()->rules(['required']);
//                    }
//                ),
//            Text::make('Video Src', 'video_src')->hideFromIndex()
//                ->hide()
//                ->hideFromDetail(function (NovaRequest $request, $resource) {
//                    return !$this->is_featured;
//                })
//                ->dependsOn(
//                    ['is_featured'],
//                    function (Text $field, NovaRequest $request, FormData $formData) {
//                        if ($formData->is_featured) $field->show();
//                    }
//                ),
        ];
    }

    public function filters(NovaRequest $request)
    {
        return [
            new \App\Nova\Filters\Brand()
        ];
    }
}
