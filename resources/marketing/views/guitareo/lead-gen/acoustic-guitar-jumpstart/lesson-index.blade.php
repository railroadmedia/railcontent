@extends('guitareo.lead-gen.lead-gen-layout')

@section('meta')
    <meta name="robots" content="noindex">
    <title>Acoustic Guitar Jumpstart | Guitareo</title>
    <meta name="description" content="Sign up on this page and you'll get a guided beginner guitar course with Nate Savage designed specifically for acoustic guitarists.">
    <meta property="og:image" content="https://s3.amazonaws.com/guitareo/acoustic-jump-start/6.jpg" style="display: none;">
    <meta property="og:title" content="Acoustic Guitar Jumpstart">
    <meta property="og:description" content="Sign up on this page and you'll get a guided beginner guitar course with Nate Savage designed specifically for acoustic guitarists.">
    <meta property="og:url" content="https://www.guitareo.com/acoustic-guitar-jumpstart/">
    @parent
@stop

@section('body')

    @include('guitareo.lead-gen.partials._course-lessons1', [
        "bgColor" => "#161819",
        "img" => '<img class="tw-h-20 md:tw-h-28 lg:tw-h-40 tw-inline-block" style="margin-bottom: 0;" src="https://s3.amazonaws.com/guitareo/acoustic-jump-start/logo-white.png">',
        "rootLink" => "/acoustic-guitar-jumpstart/course-index/",
        "bonuses" => [
            [
            'URL' => '1',
            'lessonNumber' => '1',
            'thumbUrl' => 'https://s3.amazonaws.com/guitareo/acoustic-jump-start/1.jpg',
            'lessonName' => 'Intro',
            'duration' => '4',
            ],
            [
            'URL' => '2',
            'lessonNumber' => '2',
            'thumbUrl' => 'https://s3.amazonaws.com/guitareo/acoustic-jump-start/2.jpg',
            'lessonName' => 'Tuning',
            'duration' => '8',
            ],
            [
            'URL' => '3',
            'lessonNumber' => '3',
            'thumbUrl' => 'https://s3.amazonaws.com/guitareo/acoustic-jump-start/3.jpg',
            'lessonName' => 'Strumming',
            'duration' => '6',
            ],
            [
            'URL' => '4',
            'lessonNumber' => '4',
            'thumbUrl' => 'https://s3.amazonaws.com/guitareo/acoustic-jump-start/4.jpg',
            'lessonName' => 'Clean Chords',
            'duration' => '13',
            ],
            [
            'URL' => '5',
            'lessonNumber' => '5',
            'thumbUrl' => 'https://s3.amazonaws.com/guitareo/acoustic-jump-start/5.jpg',
            'lessonName' => 'Changing Chords Smoothly',
            'duration' => '9',
            ],
            [
            'URL' => '6',
            'lessonNumber' => '6',
            'thumbUrl' => 'https://s3.amazonaws.com/guitareo/acoustic-jump-start/6.jpg',
            'lessonName' => 'Learning Songs',
            'duration' => '9',
            ],
            [
            'URL' => '7',
            'lessonNumber' => '7',
            'thumbUrl' => 'https://s3.amazonaws.com/guitareo/acoustic-jump-start/7.jpg',
            'lessonName' => 'Music Theory',
            'duration' => '8',
            ],
            [
            'URL' => '8',
            'lessonNumber' => '8',
            'thumbUrl' => 'https://s3.amazonaws.com/guitareo/acoustic-jump-start/8.jpg',
            'lessonName' => 'What To Do Next',
            'duration' => '3',
            ],
        ]
    ])
@stop
