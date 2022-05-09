<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, height=device-height, initial-scale=1, maximum-scale=5">
    <meta property="og:description" content="{{ $product->meta_desc  }}}">

    <link rel="stylesheet" href="{{ mix('platform/css/app.css') }}">
</head>

<body>
<div class="clearfix tw-container tw-mx-auto tw-max-w-6xl">
    <div class="lg:tw-flex">
        @include('test.partials.slider',[
            "headerText" => $product->header_text,
            "videoSrc" => $product->video_src,
        ])

        @include('test.partials.sidebar',[
            "sku" => "AOADS-DIGI",
            "logo" => "https://laravel-nova.s3.us-east-2.amazonaws.com/". $product->logo,
            "fullPrice" => $product->price,
            "guaranteeBadge" => $product->guaranteed
        ])
    </div>
    <div class="product-wrap lg:tw-w-2/3 tw-px-3 md:tw-px-4">
        <div class="pack-details tw-mx-auto tw-mb-7 tw-pb-5 sm:tw-pb-9 lg:tw-pb-11">
            @if($product->productType->name === 'Lesson')
                @include('test.partials.features',[
                    'features' => [
                        [
                            "icon" => "fa-trophy",
                            "heading" => "Study With ". $product->instructor_name,
                            "text" => $product->study_text,
                        ],
                        [
                            "icon" => "fa-users",
                            "heading" => "Drumeo Interactive Edition",
                            "text" => "The famous Hudson Music DVD has been reformatted for a world-class digital, interactive experience.",
                        ],
                        [
                            "icon" => "fa-smile",
                            "heading" => "100% Happiness Guaranteed",
                            "text" => "We think you’ll love these lessons, and that’s why you can try them risk-free with our 90-day guarantee!"
                        ],
                    ]
                ])

                @include('test.partials.overview',[
                    "overview" => $product->overview,
                    "overviewList" => [
                        'Two explorations -- completely improved workouts at the drums, each over thirty minutes long; a never-before-released solo recorded in Hamburg, Germany in September, 2004.',
                        'Peart’s Grammy Award-nominated solo from Rush in Rio.',
                        'Two full Rush performances from Frankfurt 2004, shown entirely from the perspective of the drum cameras.',
                        'Interviews with Lorne Wheaton, Peart’s drum tech, and Paul Northfield, Rush co-producer and engineer.',
                        'A previously unreleased solo from the Rush Counterparts tour recorded in 1994 at the Palace of Auburn Hills in Michigan.',
                    ],
                    "interactive" => true,
                ])

                @include('test.partials.instructor',[
                    "instructorPhoto" => "https://s3.amazonaws.com/drumeo-packs/Instructors/neil-peart.jpg",
                    "instructorBio" => $product->instructor_desc
                ])

                @include('test.partials.topics',[
                    "topicList" => $product->features
                ])

            @endif

            @include('test.partials.specs',[
                'specList'=> $product->specs,
                'featureList' => $product->features
            ])


        </div>
    </div>
</div>

</body>
</html>
