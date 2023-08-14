@extends('drumeo.lead-gen.courses.courses-layout')

@section('title')
    Brian Frasier-Moore - Gospel Chops
@endsection

@section('description')
    In this Course, Brian Frasier-Moore will teach you how to play amazing-sounding and tasty hand-to-foot combination fills, popularized by the great Gospel drummers of our time.
@endsection

@section('header-image', 'https://dpwjbsxqtam5n.cloudfront.net/lead-gen/courses/gospel-chops/header-image.jpg' )

@section('trailer-url', '//player.vimeo.com/video/315483886?autoplay=1' )

@section('logo')
    <h3>Brian Frasier-Moore</h3>
    <h2>Gospel Chops</h2>
@endsection

@section('time', '46' )

@section('theme', 'for gospel drummers' )

@section('url-slug', 'gospel-chops' )

@section('course-url')
    {{ get_musora_brand_base_url() }}/drumeo/courses/gospel-chops-tasty-combinations/218926
@endsection

@section('biography')
    <h1>Brian Frasier Moore’s Favorite Gospel-Styled Combinations</h1>
    <p>Brian Frasier-Moore is one of the most sought-after drummers in the music business. He’s toured with Madonna, Justin Timberlake, Christina Aguilera, Usher, and Janet Jackson — and performed at the Super Bowl Halftime Show in 2018.
        <br><br>
        In this course, Brian will share some fun gospel-styled combinations for all levels of drummers — giving you the patterns, the understanding for placing them within music, and empowering you to experiment with your own pattern ideas in the future.
    </p>
@endsection

@section('grid-title')
    YOUR GUIDE TO BETTER <br class="show-for-medium">HAND/FOOT COMBINATIONS
@endsection

@section('lesson-grid')
    @include('drumeo.lead-gen.courses._lesson-grid', [
        "lessonThumb" => "https://dpwjbsxqtam5n.cloudfront.net/lead-gen/courses/gospel-chops/bfm-image-1.jpg",
         "lessonText" => "RLRRKK"
    ])
    @include('drumeo.lead-gen.courses._lesson-grid', [
        "lessonThumb" => "https://dpwjbsxqtam5n.cloudfront.net/lead-gen/courses/gospel-chops/bfm-image-2.jpg",
         "lessonText" => "Double Combination"
    ])
    @include('drumeo.lead-gen.courses._lesson-grid', [
        "lessonThumb" => "https://dpwjbsxqtam5n.cloudfront.net/lead-gen/courses/gospel-chops/bfm-image-3.jpg",
         "lessonText" => "Flam Stroke Combinations"
    ])
    @include('drumeo.lead-gen.courses._lesson-grid', [
        "lessonThumb" => "https://dpwjbsxqtam5n.cloudfront.net/lead-gen/courses/gospel-chops/bfm-image-4.jpg",
         "lessonText" => "Expressions<br> With A Buzz"
    ])
    @include('drumeo.lead-gen.courses._lesson-grid', [
        "lessonThumb" => "https://dpwjbsxqtam5n.cloudfront.net/lead-gen/courses/gospel-chops/bfm-image-5.jpg",
         "lessonText" => "Singles"
    ])
    @include('drumeo.lead-gen.courses._lesson-grid', [
        "lessonThumb" => "https://dpwjbsxqtam5n.cloudfront.net/lead-gen/courses/gospel-chops/bfm-image-6.jpg",
         "lessonText" => "Tips For<br> Creativity"
    ])
@endsection

@section('artists')
    @include('drumeo.lead-gen.courses._artist-tile', [
    "tileThumb" => "https://dpwjbsxqtam5n.cloudfront.net/sales-site/teachers-grid/faces/brian-tichy.jpg",
    "tileName" => "Brian Tichy",
    "tileText" => "Breaking Down The Grooves Of John Bonham"
    ])
    @include('drumeo.lead-gen.courses._artist-tile', [
    "tileThumb" => "https://dpwjbsxqtam5n.cloudfront.net/sales-site/teachers-grid/faces/carmine-appice.jpg",
    "tileName" => "Carmine Appice",
    "tileText" => "Polyrhythmic Paradiddles"
    ])
    @include('drumeo.lead-gen.courses._artist-tile', [
    "responsiveHide" => true,
    "tileThumb" => "https://dpwjbsxqtam5n.cloudfront.net/sales-site/teachers-grid/faces/randy-cooke.jpg",
    "tileName" => "Randy Cooke",
    "tileText" => "The Rock Beat Formula"
    ])
    @include('drumeo.lead-gen.courses._artist-tile', [
    "responsiveHide" => true,
    "tileThumb" => "https://dpwjbsxqtam5n.cloudfront.net/sales-site/teachers-grid/faces/jonathan-moffett.jpg",
    "tileName" => "JONATHAN MOFFETT",
    "tileText" => "The Grooves Of Michael Jackson"
    ])
    @include('drumeo.lead-gen.courses._artist-tile', [
    "responsiveHide" => true,
    "tileThumb" => "https://dpwjbsxqtam5n.cloudfront.net/sales-site/teachers-grid/faces/anika-nilles.jpg",
    "tileName" => "ANIKA NILLES",
    "tileText" => "Building Creativity"
    ])
    @include('drumeo.lead-gen.courses._artist-tile', [
    "responsiveHide" => true,
    "tileThumb" => "https://dpwjbsxqtam5n.cloudfront.net/sales-site/teachers-grid/faces/david-garibaldi.jpg",
    "tileName" => "DAVID GARIBALDI",
    "tileText" => "The Funky Foot"
    ])
    @include('drumeo.lead-gen.courses._artist-tile', [
    "responsiveHide" => true,
    "tileThumb" => "https://dpwjbsxqtam5n.cloudfront.net/sales-site/teachers-grid/faces/mark-guiliana.jpg",
    "tileName" => "MARK GUILIANA",
    "tileText" => "Building Rhythmic Confidence"
    ])
    @include('drumeo.lead-gen.courses._artist-tile', [
    "responsiveHide" => true,
    "tileThumb" => "https://dpwjbsxqtam5n.cloudfront.net/sales-site/teachers-grid/faces/tommy-igoe.jpg",
    "tileName" => "TOMMY IGOE",
    "tileText" => "The Secrets Of Groove Essentials"
    ])
@endsection



