@extends('drumeo.lead-gen.partials.lesson-page-layout')

@section('meta')
    <meta name="robots" content="noindex">
    <title>@yield('title') | Fastest Way to Get Faster | Drumeo</title>
    <meta name="description" content="The ultimate toolbox to jump start your drumming! Sign up for these free resources to expand your drumming education today.">

    <!-- Social Media -->
    <meta property="og:image" content="https://dpwjbsxqtam5n.cloudfront.net/lead-gen/tudt/og-image.jpg" style="display: none;">
    <meta property="og:title" content="The Ultimate Drumming Toolbox | Drumeo">
    <meta property="og:description" content="Sign up for these free resources to expand your drumming education today.">
    <meta property="og:url" content="https://www.drumeo.com/ultimate-toolbox">
@endsection

@section('total-lesson', '6')

@section('lesson-index', '/ultimate-toolbox/fwtgf')

@section('lesson-tile-width', 'w-1/2 sm:w-1/3')

@section('offers')
    @include('drumeo.lead-gen.partials._free-trial-offer')
@endsection

@php
    $lessons = [
        [
            "url" => "/ultimate-toolbox/fwtgf/1",
            "title" => "Introduction",
            "image" => "https://i.vimeocdn.com/video/468462591-0591247a658a222a1451ddba9374e9825368731349ef1978c2d4ab94290dcc33-d?mw=1200&mh=675"
        ],
        [
            "url" => "/ultimate-toolbox/fwtgf/2",
            "title" => "Exercise 1",
            "image" => "https://i.vimeocdn.com/video/468462922-4e60de18d43a40d3d449d8b56735e01b60494d619cf2a1bbd422d1c7e35dcdd3-d?mw=1200&mh=675",
        ],
        [
            "url" => "/ultimate-toolbox/fwtgf/3",
            "title" => "Exercise 2",
            "image" => "https://i.vimeocdn.com/video/468463206-70e2ae1aff12b5b73b2675bdb2f39aa9b47fe4b6b063c16262c84ae7d76d154f-d?mw=1200&mh=675",
        ],
        [
            "url" => "/ultimate-toolbox/fwtgf/4",
            "title" => "Exercise 3",
            "image" => "https://i.vimeocdn.com/video/468463619-751c666bf20b290baedbd20b81cc5f68e696df01af2e0c790f36b41e2153844c-d?mw=1200&mh=675",
        ],
        [
            "url" => "/ultimate-toolbox/fwtgf/5",
            "title" => "Exercise 4",
            "image" => "https://i.vimeocdn.com/video/468463970-f53c0f17d09c71453503ab638a3c6708cc424874bce5f877ad9df11ac97fa6c9-d?mw=1200&mh=675",
        ],
        [
            "url" => "/ultimate-toolbox/fwtgf/6",
            "title" => "Exercise 5",
            "image" => "https://i.vimeocdn.com/video/468463959-b15f743f876736499972705d6fd975620d97ba6e6cc91b2d1648e2962349009c-d?mw=1200&mh=675",
        ],
    ];
@endphp
