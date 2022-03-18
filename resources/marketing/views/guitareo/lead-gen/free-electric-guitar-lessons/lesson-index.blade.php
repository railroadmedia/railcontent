@extends('guitareo._partials.layout')

@section('head-includes')
    @parent

    <meta name="robots" content="noindex">
    <title>Getting Started On The Electric Guitar</title>
    <meta property="og:title" content="Getting Started On The Electric Guitar">

    <meta name="description" content="Pick up your guitar and start playing today!"/>
    <meta property="og:description" content="Pick up your guitar and start playing today!">

    <meta property="og:image" content="https://guitareo.s3.amazonaws.com/lead-gen/free-electric-guitar-lessons/og-image.jpg">
    <meta property="og:url" content="https://www.guitareo.com/free-electric-guitar-lessons/">

    <link rel="stylesheet" href="{{ asset('/assets/marketing/lead-gen.css') }}">
@stop

@section('layout-body')
    @include('guitareo.lead-gen.partials._course-lessons1', [
        "bgColor" => "#030d17",
        "bgImg" => "https://guitareo.s3.amazonaws.com/lead-gen/solo-in-an-hour/order-bg.jpg",
        "img" => '<img class="h-12 md:h-20 lg:h-36 inline-block" src="https://cdn.musora.com/image/fetch/w_1500,q_auto:best/https://guitareo.s3.amazonaws.com/lead-gen/free-electric-guitar-lessons/electric-logo.png">',
        "rootLink" => "/free-electric-guitar-lessons/lessons/",
        "bonuses" => [
            [
            'URL' => '1',
            'lessonNumber' => '1',
            'thumbUrl' => 'https://guitareo.s3.amazonaws.com/lead-gen/free-electric-guitar-lessons/thumbs-electric-01.jpg',
            'lessonName' => 'Electric 101',
            'duration' => '9',
            ],
            [
            'URL' => '2',
            'lessonNumber' => '2',
            'thumbUrl' => 'https://guitareo.s3.amazonaws.com/lead-gen/free-electric-guitar-lessons/thumbs-electric-02.jpg',
            'lessonName' => 'Sounding Good',
            'duration' => '9',
            ],
            [
            'URL' => '3',
            'lessonNumber' => '3',
            'thumbUrl' => 'https://guitareo.s3.amazonaws.com/lead-gen/free-electric-guitar-lessons/thumbs-electric-03.jpg',
            'lessonName' => 'Strumming Basics',
            'duration' => '9',
            ],
            [
            'URL' => '4',                
            'lessonNumber' => '4',
            'thumbUrl' => 'https://guitareo.s3.amazonaws.com/lead-gen/free-electric-guitar-lessons/thumbs-electric-04.jpg',
            'lessonName' => 'Start Making Music',
            'duration' => '11',
            ],
            [
            'URL' => '5',
            'lessonNumber' => '5',
            'thumbUrl' => 'https://guitareo.s3.amazonaws.com/lead-gen/free-electric-guitar-lessons/thumbs-electric-05.jpg',
            'lessonName' => 'Play a Song',
            'duration' => '8',
            ],
            [
            'URL' => '6',
            'lessonNumber' => '6',
            'thumbUrl' => 'https://guitareo.s3.amazonaws.com/lead-gen/free-electric-guitar-lessons/thumbs-electric-06.jpg',
            'lessonName' => 'Pave Your Own Path',
            'duration' => '2',
            ],
        ]
    ])
@stop