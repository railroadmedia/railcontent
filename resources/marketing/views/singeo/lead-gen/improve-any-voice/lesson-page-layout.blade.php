@extends('singeo.lead-gen.partials._lesson-page-layout')

@section('styles')
    @parent

    <meta name="description" content="Anyone can sing! Singeo is here to show you how in this free mini lesson series."/>
    <meta property="og:image" content="https://www.musora.com/musora-cdn/image/width=1200,q_60,quality=85/https://d21xeg6s76swyd.cloudfront.net/lead-gen/4-exercises/og-image.jpg">
    <meta property="og:title" content="4 Exercises Guaranteed To Improve ANY Voice!">
    <meta property="og:description" content="Anyone can sing! Singeo is here to show you how in this free mini lesson series.">
    <meta property="og:url" content="https://www.singeo.com/improve-any-voice/">
@stop

@section('title', 'Improve Any Voice')

@section('total-lesson-number', 7)

@section('assets')
    @include('singeo.lead-gen.partials._assignment-resources', [
        "title" => "Download All MP3 Exercises",
        "zipURL" => "https://d21xeg6s76swyd.cloudfront.net/lead-gen/4-exercises/4-exercises.zip"
    ])
@endsection

@section('lesson-tiles')
    @php
        $lessons = [
            [
                'img' => 'https://d21xeg6s76swyd.cloudfront.net/lead-gen/4-exercises/thumb-1.png',
                'title' => 'Vocal Lesson #1 - Start Here',
                'titleColor' => '#f6d31a',
                'desc' => 'Why You Need To<br class="hidden md:inline"> Exercise Your Voice',
                'href' => '/improve-any-voice/lessons/1'
            ],
            [
                'img' => 'https://d21xeg6s76swyd.cloudfront.net/lead-gen/4-exercises/thumb-2.png',
                'title' => 'Vocal Lesson #2',
                'titleColor' => '#f51a93',
                'desc' => 'The Most Useful<br class="hidden md:inline"> Vocal Exercise',
                'href' => '/improve-any-voice/lessons/2'
            ],
            [
                'img' => 'https://d21xeg6s76swyd.cloudfront.net/lead-gen/4-exercises/thumb-3.png',
                'title' => 'Vocal Lesson #3',
                'titleColor' => '#50e49e',
                'desc' => 'The Perfect<br class="hidden md:inline"> Balance Exercise',
                'href' => '/improve-any-voice/lessons/3'
            ],
            [
                'img' => 'https://d21xeg6s76swyd.cloudfront.net/lead-gen/4-exercises/thumb-4.png',
                'title' => 'Vocal Lesson #4',
                'titleColor' => '#19b2f6',
                'desc' => 'The Strength Building,<br class="hidden md:inline"> Pitch Accuracy Exercise',
                'href' => '/improve-any-voice/lessons/4'
            ],
            [
                'img' => 'https://d21xeg6s76swyd.cloudfront.net/lead-gen/4-exercises/thumb-5.png',
                'title' => 'Vocal Lesson #5',
                'titleColor' => '#ff1c52',
                'desc' => 'The Range<br class="hidden md:inline"> Builder Exercise',
                'href' => '/improve-any-voice/lessons/5'
            ],
            [
                'img' => 'https://d21xeg6s76swyd.cloudfront.net/lead-gen/4-exercises/thumb-6.png',
                'title' => 'Vocal Lesson #6',
                'titleColor' => '#ff6900',
                'desc' => 'The Full Vocal<br class="hidden md:inline"> Routine',
                'href' => '/improve-any-voice/lessons/6'
            ],
        ];
    @endphp

    @include('singeo.lead-gen.partials._lesson-tiles2')
@endsection
