@extends('drumeo.lead-gen.shows.shows-layout')

@section('title')
    Behind The Scenes
@endsection

@section('description')
    This is your behind the scenes look at what we do and all the shenanigans that happen day to day.
@endsection

@section('show-tile', 'https://dpwjbsxqtam5n.cloudfront.net/shows/behind-the-scenes.jpg' )

@section('trailer-url', '//player.vimeo.com/video/332686467?autoplay=1' )

@section('logo')
    <img class="no-shadow" src="https://dpwjbsxqtam5n.cloudfront.net/lead-gen/shows/behind-the-scenes/behind-the-scenes-logo.svg">
@endsection

@section('url-slug', 'behind-the-scenes' )

@section('show-url')
    {{ get_musora_brand_base_url() }}/drumeo/behind-the-scenes
@endsection

@section('grid-title')
    <h1>SEE WHAT <strong>REALLY</strong> HAPPENS  <br class="show-for-medium"> AT THE DRUMEO HEADQUARTERS</h1>
@endsection

@section('lesson-grid')
    @include('drumeo.lead-gen.shows._lesson-grid', [
        "lessonThumb" => "https://d1923uyy6spedc.cloudfront.net/BTS_EP1_Low-2.jpg",
         "lessonText" => "Traffic Cones."
         ])
    @include('drumeo.lead-gen.shows._lesson-grid', [
        "lessonThumb" => "https://d1923uyy6spedc.cloudfront.net/BTS_EP2_Low.jpg",
         "lessonText" => "Holding The Pants Ransom"
         ])
    @include('drumeo.lead-gen.shows._lesson-grid', [
        "lessonThumb" => "https://d1923uyy6spedc.cloudfront.net/BTS_EP3_Low.jpg",
         "lessonText" => "Mark Guiliana & The Hunt For The Dirty Dish Bandits"
         ])
    @include('drumeo.lead-gen.shows._lesson-grid', [
        "lessonThumb" => "https://d1923uyy6spedc.cloudfront.net/BTS_EP5_Low.jpg",
         "lessonText" => "Senri Kawaguchi: The First Drummer To Break A Snare?"
         ])
    @include('drumeo.lead-gen.shows._lesson-grid', [
        "lessonThumb" => "https://d1923uyy6spedc.cloudfront.net/BTS_EP6_Low.jpg",
         "lessonText" => "Parking Lot Pals & The Prank Call"
         ])
    @include('drumeo.lead-gen.shows._lesson-grid', [
        "lessonThumb" => "https://d1923uyy6spedc.cloudfront.net/BTS_EP8_Low.jpg",
         "lessonText" => "Jonathan Moffett: Don’t Call Me The Goat, I Don’t Eat Paper!"
         ])
    @include('drumeo.lead-gen.shows._lesson-grid', [
        "lessonThumb" => "https://d1923uyy6spedc.cloudfront.net/BTS_EP9_Low.jpg",
         "lessonText" => "Drummers, Drinks & Drums"
         ])
    @include('drumeo.lead-gen.shows._lesson-grid', [
        "lessonThumb" => "https://d1923uyy6spedc.cloudfront.net/BTS_EP10_Low.jpg",
         "lessonText" => "The Best Drumming Product"
         ])
    @include('drumeo.lead-gen.shows._lesson-grid', [
        "lessonThumb" => "https://d1923uyy6spedc.cloudfront.net/bts-ep12-low.jpg",
         "lessonText" => "Drumeo Is Getting Fat"
         ])
    @include('drumeo.lead-gen.shows._lesson-grid', [
        "lessonThumb" => "https://d1923uyy6spedc.cloudfront.net/episode-14-low.jpg",
         "lessonText" => "Dave’s Got No Clue Why His Office Got Destroyed"
         ])
    @include('drumeo.lead-gen.shows._lesson-grid', [
        "lessonThumb" => "https://d1923uyy6spedc.cloudfront.net/220245-card-thumbnail-1550501724",
         "lessonText" => "The All-New Drumeo Desk"
         ])
    @include('drumeo.lead-gen.shows._lesson-grid', [
        "lessonThumb" => "https://d1923uyy6spedc.cloudfront.net/223896-card-thumbnail-1556292632.jpg",
         "lessonText" => "Harry Miree Stages A Coup"
         ])
@endsection

@section('artists')
    @include('drumeo.lead-gen.courses._artist-tile', [
    "tileThumb" => "https://dpwjbsxqtam5n.cloudfront.net/shows/behind-the-scenes.jpg",
    "tileName" => "Behind The Scenes",
    "tileText" => "What really happens at Drumeo?"
    ])

    @include('drumeo.lead-gen.courses._artist-tile', [
    "tileThumb" => "https://dpwjbsxqtam5n.cloudfront.net/shows/sonor-drums.jpg",
    "tileName" => "SONOR",
    "tileText" => "A DRUMEO DOCUMENTARY"
    ])

    @include('drumeo.lead-gen.courses._artist-tile', [
    "responsiveHide" => true,
    "tileThumb" => "https://dpwjbsxqtam5n.cloudfront.net/shows/paiste-cymbals.jpg",
    "tileName" => "PAISTE",
    "tileText" => "A Drumeo Documentary"
    ])

    @include('drumeo.lead-gen.courses._artist-tile', [
    "responsiveHide" => true,
    "tileThumb" => "https://dpwjbsxqtam5n.cloudfront.net/shows/namm-show-card2.jpg",
    "tileName" => "The NAMM Show",
    "tileText" => "With Dave Atkinson & Reuben Spyker"
    ])

    @include('drumeo.lead-gen.courses._artist-tile', [
    "responsiveHide" => true,
    "tileThumb" => "https://dpwjbsxqtam5n.cloudfront.net/shows/study-the-greats.jpg",
    "tileName" => "Study The Greats",
    "tileText" => "With Austin Burcham"
    ])

    @include('drumeo.lead-gen.courses._artist-tile', [
    "responsiveHide" => true,
    "tileThumb" => "https://dpwjbsxqtam5n.cloudfront.net/shows/gear.jpg",
    "tileName" => "Gear Guides",
    "tileText" => "Find Out What Gear The Pros Are Using."
    ])

    @include('drumeo.lead-gen.courses._artist-tile', [
    "responsiveHide" => true,
    "tileThumb" => "https://dpwjbsxqtam5n.cloudfront.net/shows/exploring-beats.jpg",
    "tileName" => "Exploring Beats",
    "tileText" => "With Carson Gant"
    ])

    @include('drumeo.lead-gen.courses._artist-tile', [
    "responsiveHide" => true,
    "tileThumb" => "https://dpwjbsxqtam5n.cloudfront.net/shows/show-podcast.jpg",
    "tileName" => "The Drumeo Podcast",
    "tileText" => "With Jared Falk & Dave Atkinson"
    ])
@endsection



