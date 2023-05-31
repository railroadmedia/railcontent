<?php

namespace App\Nova\Flexible\Layouts;

use App\Models\LeadgenLesson;
use App\Models\LeadgenLessonAsset;
use App\Nova\Flexible\Presets\LeadgenLessonAssetPreset;
use App\Nova\Flexible\Presets\LeadgenLessonAssignmentPreset;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Laravel\Nova\Fields\Boolean;
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

    protected $casts = [
        'leadgen_lesson_asset_layout' => LeadgenLessonAssetLayout::class
    ];

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
            Text::make('caption'),
            Text::make('Description', 'desc')->help('Markup is supported!'),
            Image::make('Thumbnail', 'thumbnail_file')
                ->disk('nova_s3')
                ->prunable()
                ->hideFromIndex()
                ->deletable(false)
                ->disableDownload()
                ->storeAs(function (Request $request){
                    return '/Lead-gens/Thumbnails/'.$request->uuid.'-'.$request->file('thumbnail_file')->getClientOriginalName();
                })
                ->preview(function($value){
                    if(empty($value)) return null;

                    return $value;
                }),
            Text::make('Thumbnail','thumbnail_text')->hideFromIndex()->hideFromDetail(),
            Text::make('Video Src', 'video_src')->hideFromIndex()->required()->help('In Vimeo, video permissions must be at least set to "Hidden from Vimeo", and cannot be set to "Unlisted" (unless YT embed). <br> e.g. //player.vimeo.com/video/798501810?autoplay=1 and https://www.youtube.com/embed/bNpiCbY2y0c?rel=0&showinfo=0'),
            Number::make('duration')->help('In minutes')->required(),
            Flexible::make('Assignments')
                ->addLayout(LeadgenLessonAssignmentLayout::class)
                ->preset(LeadgenLessonAssignmentPreset::class),
            Flexible::make('Assets')
                ->addLayout(LeadgenLessonAssetLayout::class)
                ->preset(LeadgenLessonAssetPreset::class)
                ->help('PNG, JPEG, JPG, SVG, ZIP, and MP3'),
            Boolean::make('One off page', 'one_off')->default(false)->hideFromIndex(),
            Hidden::make('id', 'id'),
            Hidden::make('uuid')->withMeta(["value" => $uuid]),
        ];
    }

    public function getAssetAttribute()
    {
        return $this->flexible('leadgen_lesson_asset_layout');
    }
}
