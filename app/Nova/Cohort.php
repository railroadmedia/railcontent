<?php

namespace App\Nova;

use App\Nova\Flexible\Layouts\CohortDropdownLayout;
use App\Nova\Flexible\Layouts\CohortListLayout;
use App\Nova\Flexible\Presets\CohortDropdownPreset;
use App\Nova\Flexible\Presets\CohortListPreset;
use Illuminate\Http\Request;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\Boolean;
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
use Illuminate\Support\Str;
use Whitecube\NovaFlexibleContent\Flexible;

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
            Text::make('slug')->required()->rules('required'),
            Hidden::make('Uuid')->withMeta(["value" => $uuid]),
            Text::make('Cohort Title', 'cohort_title')
                ->required()
                ->rules('required')
                ->help("For easy reference to this banner in the CMS. This info won't show on the banner."),
//            Boolean::make('Use Custom Cohort Template?', 'custom_cohort')->hideFromIndex()->default(false)->help('Use this checkbox to enable the custom marketing cohort template.'),
            Heading::make('Header'),
            Image::make('Dark Mode Logo', 'dark_mode_logo')
                ->help('The logo should be 545 x 103px or a comparable aspect ratio.')
                ->disk('nova_s3')
                ->prunable()
                ->hideFromIndex()
                ->deletable(false)
                ->disableDownload()
                ->storeAs(function (Request $request) {
                    $brandId = $request->brand;
                    $brand = '';

                    if($brandId === "1") {
                        $brand = 'Drumeo';
                    } elseif($brandId === "2") {
                        $brand = 'Pianote';
                    } elseif($brandId === "3") {
                        $brand = 'Guitareo';
                    } elseif($brandId === "4") {
                        $brand = 'Singeo';
                    }

                    return '/'.$brand.'/cohorts/'.$request->uuid.'-'.$request->file('dark_mode_logo')->getClientOriginalName();
                })
                ->preview(function ($value) {
                    if(empty($value)) {
                        return null;
                    }

                    return $value;
                }),
            Text::make('Dark Mode Logo', 'dark_mode_logo')->hideFromIndex()->hideFromDetail()->help('Use this field if you have a hosted logo link. (Google Drive links will NOT work.)'),
            Image::make('Light Mode Logo', 'light_mode_logo')
                ->help('The logo should be 545 x 103px or a comparable aspect ratio.')
                ->disk('nova_s3')
                ->prunable()
                ->hideFromIndex()
                ->deletable(false)
                ->disableDownload()
                ->storeAs(function (Request $request) {
                    $brandId = $request->brand;
                    $brand = '';

                    if($brandId === "1") {
                        $brand = 'Drumeo';
                    } elseif($brandId === "2") {
                        $brand = 'Pianote';
                    } elseif($brandId === "3") {
                        $brand = 'Guitareo';
                    } elseif($brandId === "4") {
                        $brand = 'Singeo';
                    }

                    return '/'.$brand.'/cohorts/'.$request->uuid.'-'.$request->file('light_mode_logo')->getClientOriginalName();
                })
                ->preview(function ($value) {
                    if(empty($value)) {
                        return null;
                    }

                    return $value;
                }),
            Text::make('Light Mode Logo', 'light_mode_logo')->hideFromIndex()->hideFromDetail()->help('Use this field if you have a hosted logo link. (Google Drive links will NOT work.)'),
            Text::make('Headline')->hideFromIndex(),
            Text::make('Subheadline')->hideFromIndex(),
            Text::make('Header Description', 'header_description')->hideFromIndex(),
            Text::make('Benefit 1', 'benefit_1')->hideFromIndex(),
            Text::make('Benefit 2', 'benefit_2')->hideFromIndex(),
            Text::make('Benefit 3', 'benefit_3')->hideFromIndex(),
            Image::make('Header Image Url', 'header_image_url')
                ->help('The image should be 464 x 464px or a comparable aspect ratio.')
                ->disk('nova_s3')
                ->prunable()
                ->hideFromIndex()
                ->deletable(false)
                ->disableDownload()
                ->storeAs(function (Request $request) {
                    $brandId = $request->brand;
                    $brand = '';

                    if($brandId === "1") {
                        $brand = 'Drumeo';
                    } elseif($brandId === "2") {
                        $brand = 'Pianote';
                    } elseif($brandId === "3") {
                        $brand = 'Guitareo';
                    } elseif($brandId === "4") {
                        $brand = 'Singeo';
                    }

                    return '/'.$brand.'/cohorts/'.$request->uuid.'-'.$request->file('header_image_url')->getClientOriginalName();
                })
                ->preview(function ($value) {
                    if(empty($value)) {
                        return null;
                    }

                    return $value;
                }),
            Text::make('Header image url', 'header_image_url')->hideFromIndex()->hideFromDetail()->help('Use this field if you have a hosted image link. (Google Drive links will NOT work.)'),
            Text::make('Trailer', 'cohort_trailer')->hideFromIndex()->help('In Vimeo, video permissions must be at least set to "Hidden from Vimeo", and cannot be set to "Unlisted". Use Vimeo links only, e.g. //player.vimeo.com/video/798501810?autoplay=1'),
//            Image::make('Icon 1', 'icon1_url')
//                ->help('The icon should be 545 x 103px or a comparable aspect ratio.')
//                ->disk('nova_s3')
//                ->prunable()
//                ->hideFromIndex()
//                ->deletable(false)
//                ->disableDownload()
//                ->storeAs(function (Request $request){
//                    $brandId = $request->brand;
//                    $brand = '';
//
//                    if($brandId === "1") {
//                        $brand = 'Drumeo';
//                    }
//                    elseif($brandId === "2"){
//                        $brand = 'Pianote';
//                    }
//                    elseif($brandId === "3"){
//                        $brand = 'Guitareo';
//                    }
//                    elseif($brandId === "4"){
//                        $brand = 'Singeo';
//                    }
//
//                    return '/'.$brand.'/cohorts/'.$request->uuid.'-'.$request->file('icon1_url')->getClientOriginalName();
//                })
//                ->preview(function($value){
//                    if(empty($value)) return null;
//
//                    return $value;
//                }),
//            Text::make('Icon 1', 'icon1_url')->hideFromIndex()->hideFromDetail()->help('Use this field if you have a hosted logo link. (Google Drive links will NOT work.)'),

            Text::make('Icon1 Title', 'icon1_title')->hideFromIndex(),
            Text::make('Icon1 Copy', 'icon1_copy')->hideFromIndex(),
//            Image::make('Icon 2', 'icon2_url')
//                ->help('The icon should be 545 x 103px or a comparable aspect ratio.')
//                ->disk('nova_s3')
//                ->prunable()
//                ->hideFromIndex()
//                ->deletable(false)
//                ->disableDownload()
//                ->storeAs(function (Request $request){
//                    $brandId = $request->brand;
//                    $brand = '';
//
//                    if($brandId === "1") {
//                        $brand = 'Drumeo';
//                    }
//                    elseif($brandId === "2"){
//                        $brand = 'Pianote';
//                    }
//                    elseif($brandId === "3"){
//                        $brand = 'Guitareo';
//                    }
//                    elseif($brandId === "4"){
//                        $brand = 'Singeo';
//                    }
//
//                    return '/'.$brand.'/cohorts/'.$request->uuid.'-'.$request->file('icon2_url')->getClientOriginalName();
//                })
//                ->preview(function($value){
//                    if(empty($value)) return null;
//
//                    return $value;
//                }),
//            Text::make('Icon 2 Image', 'icon2_url')->hideFromIndex()->hideFromDetail()->help('Use this field if you have a hosted logo link. (Google Drive links will NOT work.)'),

            Text::make('Icon2 Title', 'icon2_title')->hideFromIndex(),
            Text::make('Icon2 Copy', 'icon2_copy')->hideFromIndex(),
//            Image::make('Icon 3', 'icon3_url')
//                ->help('The icon should be 545 x 103px or a comparable aspect ratio.')
//                ->disk('nova_s3')
//                ->prunable()
//                ->hideFromIndex()
//                ->deletable(false)
//                ->disableDownload()
//                ->storeAs(function (Request $request){
//                    $brandId = $request->brand;
//                    $brand = '';
//
//                    if($brandId === "1") {
//                        $brand = 'Drumeo';
//                    }
//                    elseif($brandId === "2"){
//                        $brand = 'Pianote';
//                    }
//                    elseif($brandId === "3"){
//                        $brand = 'Guitareo';
//                    }
//                    elseif($brandId === "4"){
//                        $brand = 'Singeo';
//                    }
//
//                    return '/'.$brand.'/cohorts/'.$request->uuid.'-'.$request->file('icon3_url')->getClientOriginalName();
//                })
//                ->preview(function($value){
//                    if(empty($value)) return null;
//
//                    return $value;
//                }),
//            Text::make('Icon 3', 'icon3_url')->hideFromIndex()->hideFromDetail()->help('Use this field if you have a hosted logo link. (Google Drive links will NOT work.)'),

            Text::make('Icon3 Title', 'icon3_title')->hideFromIndex(),
            Text::make('Icon3 Copy', 'icon3_copy')->hideFromIndex(),

            Heading::make('Body'),
            Text::make('Body Title', 'body_title')->hideFromIndex(),
            Markdown::make('Body Top Description', 'body_top_description')->help('If a description exceeds 316 the last three characters will be replaced with an ellipses.<br> Use &lt;br&gt; for a line break, &lt;i&gt;&lt;/i&gt; for italics, and &lt;b&gt;&lt;/b&gt; for bold. <br> Limited to three lines of text.')->hideFromIndex(),
            Image::make('Body Image Url', 'body_image_url')
                ->help('The image should be 896 x 504px or a comparable aspect ratio.')
                ->disk('nova_s3')
                ->prunable()
                ->hideFromIndex()
                ->deletable(false)
                ->disableDownload()
                ->storeAs(function (Request $request) {
                    $brandId = $request->brand;
                    $brand = '';

                    if($brandId === "1") {
                        $brand = 'Drumeo';
                    } elseif($brandId === "2") {
                        $brand = 'Pianote';
                    } elseif($brandId === "3") {
                        $brand = 'Guitareo';
                    } elseif($brandId === "4") {
                        $brand = 'Singeo';
                    }

                    return '/'.$brand.'/cohorts/'.$request->uuid.'-'.$request->file('body_image_url')->getClientOriginalName();
                })
                ->preview(function ($value) {
                    if(empty($value)) {
                        return null;
                    }

                    return $value;
                }),
            Text::make('Body image url', 'body_image_url')->hideFromIndex()->hideFromDetail()->help('Use this field if you have a hosted image link. (Google Drive links will NOT work.)'),

            Heading::make('Bottom'),
            Image::make('Bottom Logo', 'body_logo')
                ->help('The logo should be 896 x 100px or a comparable aspect ratio.')
                ->disk('nova_s3')
                ->prunable()
                ->hideFromIndex()
                ->deletable(false)
                ->disableDownload()
                ->storeAs(function (Request $request) {
                    $brandId = $request->brand;
                    $brand = '';

                    if($brandId === "1") {
                        $brand = 'Drumeo';
                    } elseif($brandId === "2") {
                        $brand = 'Pianote';
                    } elseif($brandId === "3") {
                        $brand = 'Guitareo';
                    } elseif($brandId === "4") {
                        $brand = 'Singeo';
                    }

                    return '/'.$brand.'/cohorts/'.$request->uuid.'-'.$request->file('body_logo')->getClientOriginalName();
                })
                ->preview(function ($value) {
                    if(empty($value)) {
                        return null;
                    }

                    return $value;
                }),
            Text::make('Bottom Logo', 'body_logo')->hideFromIndex()->hideFromDetail()->help('Use this field if you have a hosted logo link. (Google Drive links will NOT work.)'),
            Markdown::make('Bottom Description', 'body_bottom_description')->hideFromIndex(),

            Flexible::make('Items')->help('You can use tags as {enrolled} that will be replaced with number of enrolled students   e.g: "Join {enrolled} players who have already registered."')
                ->addLayout(CohortListLayout::class)
                ->preset(CohortListPreset::class),

            Heading::make('Product'),
            Boolean::make('Is there a product?', 'is_product')->hideFromIndex()->default(false)->help('Is there a product?'),
            Text::make('Product Description Header', 'product_description_header')->hideFromIndex()
                ->hide()
                ->hideFromDetail(function (NovaRequest $request, $resource) {
                    return !$this->is_product;
                })
                ->dependsOn(
                    ['is_product'],
                    function (Text $field, NovaRequest $request, FormData $formData) {
                        if ($formData->is_product) {
                            $field->show()->rules(['required']);
                        }
                    }
                ),
            Text::make('Product Description Body', 'product_description_body')->hideFromIndex()
                ->hide()
                ->hideFromDetail(function (NovaRequest $request, $resource) {
                    return !$this->is_product;
                })
                ->help('Use &lt;br&gt; for a line break.')
                ->dependsOn(
                    ['is_product'],
                    function (Text $field, NovaRequest $request, FormData $formData) {
                        if ($formData->is_product) {
                            $field->show()->rules(['required']);
                        }
                    }
                ),
            Number::make('Product Original Price', 'product_original_price')->hideFromIndex()
                ->hide()
                ->hideFromDetail(function (NovaRequest $request, $resource) {
                    return !$this->is_product;
                })
                ->dependsOn(
                    ['is_product'],
                    function (Text $field, NovaRequest $request, FormData $formData) {
                        if ($formData->is_product) {
                            $field->show()->rules(['required']);
                        }
                    }
                ),
            Number::make('Product Sale Price', 'product_sale_price')->hideFromIndex()
                ->hide()
                ->hideFromDetail(function (NovaRequest $request, $resource) {
                    return !$this->is_product;
                })
                ->dependsOn(
                    ['is_product'],
                    function (Text $field, NovaRequest $request, FormData $formData) {
                        if ($formData->is_product) {
                            $field->show()->rules(['required']);
                        }
                    }
                ),
            Image::make('Product Image', 'product_image')
                ->help('The image should be 16:9.')
                ->disk('nova_s3')
                ->prunable()
                ->hideFromIndex()
                ->deletable(false)
                ->disableDownload()
                ->storeAs(function (Request $request) {
                    $brandId = $request->brand;
                    $brand = '';

                    if($brandId === "1") {
                        $brand = 'Drumeo';
                    } elseif($brandId === "2") {
                        $brand = 'Pianote';
                    } elseif($brandId === "3") {
                        $brand = 'Guitareo';
                    } elseif($brandId === "4") {
                        $brand = 'Singeo';
                    }

                    return '/'.$brand.'/cohorts/'.$request->uuid.'-'.$request->file('product_image')->getClientOriginalName();
                })
                ->preview(function ($value) {
                    if(empty($value)) {
                        return null;
                    }

                    return $value;
                })
                ->hide()
                ->hideFromDetail(function (NovaRequest $request, $resource) {
                    return !$this->is_product;
                })
                ->dependsOn(
                    ['is_product'],
                    function (Image $field, NovaRequest $request, FormData $formData) {
                        if ($formData->is_product) {
                            $field->show();
                        }
                    }
                ),
            Text::make('Get Product Badge', 'get_product_badge')->hideFromIndex()
                ->hide()
                ->hideFromDetail(function (NovaRequest $request, $resource) {
                    return !$this->is_product;
                })
                ->dependsOn(
                    ['is_product'],
                    function (Text $field, NovaRequest $request, FormData $formData) {
                        if ($formData->is_product) {
                            $field->show()->rules(['required']);
                        }
                    }
                ),
            Text::make('Product Name', 'product_name')->hideFromIndex()
                ->hide()
                ->hideFromDetail(function (NovaRequest $request, $resource) {
                    return !$this->is_product;
                })
                ->dependsOn(
                    ['is_product'],
                    function (Text $field, NovaRequest $request, FormData $formData) {
                        if ($formData->is_product) {
                            $field->show()->rules(['required']);
                        }
                    }
                ),
            Text::make('Course Description', 'course_description')->hideFromIndex()
                ->hide()
                ->hideFromDetail(function (NovaRequest $request, $resource) {
                    return !$this->is_product;
                })
                ->dependsOn(
                    ['is_product'],
                    function (Text $field, NovaRequest $request, FormData $formData) {
                        if ($formData->is_product) {
                            $field->show()->rules(['required']);
                        }
                    }
                ),
            Text::make('Course + Product Description', 'course_product_description')->hideFromIndex()
                ->hide()
                ->hideFromDetail(function (NovaRequest $request, $resource) {
                    return !$this->is_product;
                })
                ->dependsOn(
                    ['is_product'],
                    function (Text $field, NovaRequest $request, FormData $formData) {
                        if ($formData->is_product) {
                            $field->show()->rules(['required']);
                        }
                    }
                ),
            Text::make('Product Cart Link', 'product_cart_link')->hideFromIndex()
                ->hide()
                ->hideFromDetail(function (NovaRequest $request, $resource) {
                    return !$this->is_product;
                })
                ->dependsOn(
                    ['is_product'],
                    function (Text $field, NovaRequest $request, FormData $formData) {
                        if ($formData->is_product) {
                            $field->show()->rules(['required']);
                        }
                    }
                ),
            Text::make('Product Cart Link Description', 'product_cart_link_description')->hideFromIndex()
                ->hide()
                ->hideFromDetail(function (NovaRequest $request, $resource) {
                    return !$this->is_product;
                })
                ->dependsOn(
                    ['is_product'],
                    function (Text $field, NovaRequest $request, FormData $formData) {
                        if ($formData->is_product) {
                            $field->show()->rules(['required']);
                        }
                    }
                ),

            Heading::make('Dropdown'),
            Text::make('Dropdown Title', 'dropdown_title')->hideFromIndex(),
            Flexible::make('Dropdowns')
                ->addLayout(CohortDropdownLayout::class)
                ->preset(CohortDropdownPreset::class),

            Heading::make('Footer'),
            Text::make('Footer Title', 'bottom_title')->hideFromIndex(),
            Text::make('Footer Description', 'bottom_description')->hideFromIndex(),

            DateTime::make(__('Enrollment Start Time'), 'enrollment_start_date')->hideFromIndex()->help('Ignore UTC. It is actually PST.<br>This does NOT account for Daylight Savings between Mar-Nov. Make sure you offset by an hour during PDT'),
            DateTime::make(__('Enrollment End Time'), 'enrollment_end_date')->hideFromIndex()->help('Ignore UTC. It is actually PST.<br>This does NOT account for Daylight Savings between Mar-Nov. Make sure you offset by an hour during PDT'),
            Text::make('Product ID', 'product_id')->hideFromIndex()->required()->rules('required'),
            DateTime::make(__('Cohort Start Time'), 'cohort_start_date')->hideFromIndex()->help("Controls whether cohort is currently active.  Cohort banners/pinned packs are a couple of functions tied to this."),
            DateTime::make(__('Cohort End Time'), 'cohort_end_date')->hideFromIndex()->help("Controls whether cohort is currently active.  Cohort banners/pinned packs are a couple of functions tied to this."),

            Text::make('Course ID', 'content_id')->hideFromIndex()->required()->rules('required'),

            Text::make('Conversation Thread ID', 'conversation_thread_id')->hideFromIndex(),
        ];
    }

    public function filters(NovaRequest $request)
    {
        return [
            new \App\Nova\Filters\Brand()
        ];
    }
}
