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

@section('total-lesson', '7')

@section('lesson-index', '/ultimate-toolbox/fwtgf')

@section('lesson-tile-width', 'w-1/2 sm:w-1/3')

@section('offers')
    @include('lead-gen.partials._free-trial-offer')
@endsection

@php
    $lessons = [
        [
            "url" => "/ultimate-toolbox/fwtgf/13",
            "title" => "Introduction",
            "image" => "https://i.vimeocdn.com/video/468465303-ae3eeb22d4d9f54d97aacb71014dfe35d62e723651952a1dffed8f2d33de0cdd-d?mw=1200&mh=675"
        ],
        [
            "url" => "/ultimate-toolbox/fwtgf/14",
            "title" => "Exercise 1",
            "image" => "https://i.vimeocdn.com/video/468465837-a713fe204be18020e4dd63d5b70b6554c3b04efdd6443f754f47f9742e58d9b4-d?mw=1200&mh=675"
        ],
        [
            "url" => "/ultimate-toolbox/fwtgf/15",
            "title" => "Exercise 2",
            "image" => "https://i.vimeocdn.com/video/468465825-1ae84191e678505bb3867eb7d224d1b380c11261d4dd530affce1dc169cd4d46-d?mw=1200&mh=675"
        ],
        [
            "url" => "/ultimate-toolbox/fwtgf/16",
            "title" => "Exercise 3",
            "image" => "https://i.vimeocdn.com/video/468466472-cafd2faf42e3c0d925a881856a6a012b51cd600e879b82626e3b5da272fc8b3f-d?mw=1200&mh=675"
        ],
        [
            "url" => "/ultimate-toolbox/fwtgf/17",
            "title" => "Exercise 4",
            "image" => "https://i.vimeocdn.com/video/468466651-c5db0822c030c82859d7c766965e4db86ba37af00c78e52fe25639f5742ae00f-d?mw=1200&mh=675"
        ],
        [
            "url" => "/ultimate-toolbox/fwtgf/18",
            "title" => "Exercise 5",
            "image" => "https://i.vimeocdn.com/video/468466646-4e47a36cb4b8058d59b98cf9b05d25184d7b00a5913b16fc2575d1a576571582-d?mw=1200&mh=675"
        ],
        [
            "url" => "/ultimate-toolbox/fwtgf/19",
            "title" => "Conclusion",
            "image" => "https://i.vimeocdn.com/video/468466881-30ddd2f68277c803b48b5012f17cba6bf7136c8805b22b6b806f6edf45b1fd56-d?mw=1200&mh=675"
        ],
    ];
@endphp
