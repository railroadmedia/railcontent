@extends('drumeo.lead-gen.shows.shows-layout')

@section('title')
    Study The Greats
@endsection

@section('description')
    Detailed breakdowns of legendary beats, licks, and ideas.
@endsection

@section('show-tile', 'https://d1923uyy6spedc.cloudfront.net/226223-card-thumbnail-1560244297.jpg' )

@section('trailer-url', 'https://www.youtube.com/embed/9atDj93z2aY?autoplay=1' )

@section('logo')
    <img class="no-shadow" src="https://dpwjbsxqtam5n.cloudfront.net/lead-gen/shows/study-the-greats/study-the-greats.svg">
@endsection

@section('url-slug', 'study-the-greats' )

@section('show-url')
    {{ get_musora_brand_base_url() }}/drumeo/study-the-greats
@endsection

@section('grid-title')
    <h1>Austin Burcham gives you detailed <br class="show-for-medium">
        breakdowns of the most legendary <br class="show-for-medium">
        drum beats, licks, and ideas.</h1>
@endsection

@section('lesson-grid')
    @include('drumeo.lead-gen.shows._lesson-grid', [
        "lessonThumb" => "https://dzryyo1we6bm3.cloudfront.net/thumbnails/190992_thumbnail_360p.jpg",
         "lessonText" => "Todd Sucherman"
         ])
    @include('drumeo.lead-gen.shows._lesson-grid', [
        "lessonThumb" => "https://dzryyo1we6bm3.cloudfront.net/thumbnails/191232_thumbnail_360p.jpg",
         "lessonText" => "David Garibaldi"
         ])
    @include('drumeo.lead-gen.shows._lesson-grid', [
        "lessonThumb" => "https://dzryyo1we6bm3.cloudfront.net/thumbnails/195920_thumbnail_360p.jpg",
         "lessonText" => "Benny Greb"
         ])
    @include('drumeo.lead-gen.shows._lesson-grid', [
        "lessonThumb" => "https://dzryyo1we6bm3.cloudfront.net/thumbnails/195927_thumbnail_360p.jpg",
         "lessonText" => "Bernard Purdie"
         ])
    @include('drumeo.lead-gen.shows._lesson-grid', [
        "lessonThumb" => "https://dzryyo1we6bm3.cloudfront.net/thumbnails/196089_thumbnail_360p.jpg",
         "lessonText" => "Stanley Randolph"
         ])
    @include('drumeo.lead-gen.shows._lesson-grid', [
        "lessonThumb" => "https://dzryyo1we6bm3.cloudfront.net/thumbnails/196095_thumbnail_360p.jpg",
         "lessonText" => "Danny Seraphine"
         ])
    @include('drumeo.lead-gen.shows._lesson-grid', [
        "lessonThumb" => "https://dzryyo1we6bm3.cloudfront.net/thumbnails/209591_thumbnail_360p.jpg",
         "lessonText" => "Dave DiCenso"
         ])
    @include('drumeo.lead-gen.shows._lesson-grid', [
        "lessonThumb" => "https://dzryyo1we6bm3.cloudfront.net/thumbnails/209779_thumbnail_360p.jpg",
         "lessonText" => "Billy Cobham"
         ])
    @include('drumeo.lead-gen.shows._lesson-grid', [
        "lessonThumb" => "https://dzryyo1we6bm3.cloudfront.net/thumbnails/210253_thumbnail_360p.jpg",
         "lessonText" => "Gavin Harrison"
         ])
    @include('drumeo.lead-gen.shows._lesson-grid', [
        "lessonThumb" => "https://dzryyo1we6bm3.cloudfront.net/thumbnails/211157_thumbnail_360p.jpg",
         "lessonText" => "John Blackwell"
         ])
    @include('drumeo.lead-gen.shows._lesson-grid', [
        "lessonThumb" => "https://dzryyo1we6bm3.cloudfront.net/thumbnails/212102_thumbnail_360p.jpg",
         "lessonText" => "Jost Nickel"
         ])
    @include('drumeo.lead-gen.shows._lesson-grid', [
        "lessonThumb" => "https://d1923uyy6spedc.cloudfront.net/stg-ep12-mark-guiliana-low.jpg",
         "lessonText" => "Mark Guiliana"
         ])
    @include('drumeo.lead-gen.shows._lesson-grid', [
        "lessonThumb" => "https://d1923uyy6spedc.cloudfront.net/226223-card-thumbnail-1560244297.jpg",
         "lessonText" => "Jonathan “Sugarfoot” Moffett"
         ])
    @include('drumeo.lead-gen.shows._lesson-grid', [
        "lessonThumb" => "https://d1923uyy6spedc.cloudfront.net/226270-card-thumbnail-1561038109.jpg",
         "lessonText" => "Marco Minnemann"
         ])
    @include('drumeo.lead-gen.shows._lesson-grid', [
        "lessonThumb" => "https://d1923uyy6spedc.cloudfront.net/226532-card-thumbnail-1561296819.jpg",
         "lessonText" => "Dafnis Prieto"
         ])

@endsection

@section('artists')
    @include('drumeo.lead-gen.courses._artist-tile', [
    "tileThumb" => "https://dpwjbsxqtam5n.cloudfront.net/shows/study-the-greats.jpg",
    "tileName" => "Study The Greats",
    "tileText" => "With Austin Burcham"
    ])

    @include('drumeo.lead-gen.courses._artist-tile', [
    "tileThumb" => "https://dpwjbsxqtam5n.cloudfront.net/shows/behind-the-scenes.jpg",
    "tileName" => "Behind The Scenes",
    "tileText" => "What really happens at Drumeo?"
    ])

    @include('drumeo.lead-gen.courses._artist-tile', [
    "responsiveHide" => true,
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



