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
    @include('lead-gen.partials._free-trial-offer')
@endsection

@php
    $lessons = [
        [
            "url" => "/ultimate-toolbox/fwtgf/7",
            "title" => "Introduction",
            "image" => "https://i.vimeocdn.com/video/468464265-11fa28922153ddd0a5c18307ffb4b4a8ca3b2ae99b0ee35c91cbbbd9dd4198cd-d?mw=1200&mh=675",
        ],
        [
            "url" => "/ultimate-toolbox/fwtgf/8",
            "title" => "Exercise 1",
            "image" => "https://i.vimeocdn.com/video/468464558-8ab3abdf097c6d07c260fb3a6069f914a26a619b16aff7bf2f8c2105351fdb4b-d?mw=1200&mh=675",
        ],
        [
            "url" => "/ultimate-toolbox/fwtgf/9",
            "title" => "Exercise 2",
            "image" => "https://i.vimeocdn.com/video/468464697-c789c4f1e95ad173da4eb0acb177c3b8640174230433021132e84e7f27fae524-d?mw=1200&mh=675",
        ],
        [
            "url" => "/ultimate-toolbox/fwtgf/10",
            "title" => "Exercise 3",
            "image" => "https://i.vimeocdn.com/video/468465312-3bc75a3cb1fff8da83c97c0ad3fa6feeeea7161412bf4a2cd3014b3140c41d25-d?mw=1200&mh=675",
        ],
        [
            "url" => "/ultimate-toolbox/fwtgf/11",
            "title" => "Exercise 4",
            "image" => "https://i.vimeocdn.com/video/468465007-d931b0fb1564d04666c21897fcfb3258a8f67668f8df2be39ab0ff2086702a32-d?mw=1200&mh=675",
        ],
        [
            "url" => "/ultimate-toolbox/fwtgf/12",
            "title" => "Exercise 5",
            "image" => "https://i.vimeocdn.com/video/468465317-36b42df8d9585ede4560350d2529469c3fde6d81e6a43558b4d3ae54260a3b01-d?mw=1200&mh=675",
        ],
    ];
@endphp
