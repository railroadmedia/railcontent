<?php

namespace App\Nova\Flexible\Layouts;

use App\Models\LeadgenLesson;
use App\Models\LeadgenLessonAsset;
use App\Nova\Flexible\Presets\LeadgenLessonAssetPreset;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Laravel\Nova\Fields\Hidden;
use Laravel\Nova\Fields\Image;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\Number;
use Whitecube\NovaFlexibleContent\Flexible;
use Whitecube\NovaFlexibleContent\Layouts\Layout;

class LeadgenLessonLayout extends Layout
{
    protected $model = LeadgenLesson::class;

    /**
     * The layout's unique identifier
     *
     * @var string
     */
    protected $name = 'leadgen-lesson-layout';

    /**
     * The displayed title
     *
     * @var string
     */
    protected $title = 'Leadgen Lesson';

    /**
     * Get the fields displayed by the layout.
     *
     * @return array
     */
    public function fields()
    {
        $uuid  = Str::uuid();

        return [
            // Define the layout's fields.
            Text::make('slug')->required(),
            Text::make('title')->required(),
            Text::make('Description', 'desc'),
            Image::make('thumbnail')
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
                    if(empty($value)) return null;

                    return str_contains($value, 'amazonaws') || str_contains($value, 'cloudfront') || str_contains($value, 'vimeocdn') ? $value : 'https://laravel-nova.s3.us-east-2.amazonaws.com/'.$value;
                }),
            Text::make('thumbnail')->hideFromIndex()->hideFromDetail()->required(),
            Text::make('Video Src', 'video_src')->hideFromIndex()->required(),
            Number::make('duration')->help('In minutes'),
            Flexible::make('Assets')
                ->addLayout(LeadgenLessonAssetLayout::class)
                ->preset(LeadgenLessonAssetPreset::class),
            Hidden::make('id', 'id'),
//            Hidden::make('uuid')->withMeta(["value" => $uuid]),
        ];
    }

    public function assets(){
        return $this->model;
    }

}
