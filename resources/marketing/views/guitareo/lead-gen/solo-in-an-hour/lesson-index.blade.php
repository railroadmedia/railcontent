@extends('guitareo.lead-gen.lead-gen-layout-tw')

@section('meta')
    <meta name="robots" content="noindex">
    <title>Solo In An Hour | Guitareo</title>
    <meta property="og:title" content="Solo In An Hour">
    <meta name="description" content="Play your first solo in less than 60 minutes"/>
    <meta property="og:description" content="Play your first solo in less than 60 minutes">
    <meta property="og:image" content="https://guitareo.s3.amazonaws.com/lead-gen/solo-in-an-hour/og-image.jpg">
    <meta property="og:url" content="https://www.guitareo.com/solo-in-an-hour/">
    <link rel="stylesheet" href="{{ asset('/marketing/parcel/guitareo/lead-gen.css') }}">
    @parent
@stop

@section('body')

    @include('guitareo.lead-gen.partials._course-lessons1', [
        "bgColor" => "#030d17",
        "bgImg" => "https://guitareo.s3.amazonaws.com/lead-gen/solo-in-an-hour/order-bg.jpg",
        "img" => '<img class="tw-h-20 md:tw-h-28 lg:tw-h-40 tw-inline-block" src="https://www.musora.com/musora-cdn/image/width=800,quality=85/https://guitareo.s3.amazonaws.com/lead-gen/solo-in-an-hour/logo.png">',
        "rootLink" => "/solo-in-an-hour/lessons/",
        "bonuses" => [
            [
            'URL' => '1',
            'lessonNumber' => '1',
            'thumbUrl' => 'https://guitareo.s3.amazonaws.com/courses/Learn%20To%20Solo%20In%20An%20Hour/1-yes-you-can-solo.png',
            'lessonName' => 'Yes, You Can Solo In An Hour!',
            'duration' => '2',
            ],
            [
            'URL' => '2',
            'lessonNumber' => '2',
            'thumbUrl' => 'https://guitareo.s3.amazonaws.com/courses/Learn%20To%20Solo%20In%20An%20Hour/2-most-important-scale.png',
            'lessonName' => 'The Most Important Scale For Soloing',
            'duration' => '7',
            ],
            [
            'URL' => '3',
            'lessonNumber' => '3',
            'thumbUrl' => 'https://guitareo.s3.amazonaws.com/courses/Learn%20To%20Solo%20In%20An%20Hour/3-what-makes-a-good-solo.png',
            'lessonName' => 'What Makes A Good Solo?',
            'duration' => '10',
            ],
            [
            'URL' => '4',
            'lessonNumber' => '4',
            'thumbUrl' => 'https://guitareo.s3.amazonaws.com/courses/Learn%20To%20Solo%20In%20An%20Hour/4-building-lick-library.png',
            'lessonName' => 'Building A Lick Vocabulary',
            'duration' => '9',
            ],
            [
            'URL' => '5',
            'lessonNumber' => '5',
            'thumbUrl' => 'https://guitareo.s3.amazonaws.com/courses/Learn%20To%20Solo%20In%20An%20Hour/5-first-solo.png',
            'lessonName' => 'Playing Your First Solo',
            'duration' => '8',
            ],
            [
            'URL' => '6',
            'lessonNumber' => '6',
            'thumbUrl' => 'https://guitareo.s3.amazonaws.com/courses/Learn%20To%20Solo%20In%20An%20Hour/6-other-keys.png',
            'lessonName' => 'What About Soloing In Other Keys?',
            'duration' => '5',
            ],
            [
            'URL' => '7',
            'lessonNumber' => '7',
            'thumbUrl' => 'https://guitareo.s3.amazonaws.com/courses/Learn%20To%20Solo%20In%20An%20Hour/7-where-to-go.png',
            'lessonName' => 'Where To Go From Here',
            'duration' => '6',
            ],
        ]
    ])
@stop
