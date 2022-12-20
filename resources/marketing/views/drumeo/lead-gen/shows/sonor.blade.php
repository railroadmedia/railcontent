@extends('drumeo.lead-gen.shows.shows-layout')

@section('title')
    Sonor - A Drumeo Documentary
@endsection

@section('description')
    Take a closer look at Sonor Drums with Jared as he explores the Sonor Factory in Bad Berleburg Germany and interviews the people behind the amazing brand.
@endsection

@section('show-tile', 'https://dpwjbsxqtam5n.cloudfront.net/shows/sonor-drums.jpg' )

@section('trailer-url', '//player.vimeo.com/video/301501910?autoplay=1' )

@section('logo')
    <img src="https://dpwjbsxqtam5n.cloudfront.net/lead-gen/shows/sonor/logo.png">
@endsection

@section('url-slug', 'sonor' )

@section('show-url')
    {{ get_musora_brand_base_url() }}/drumeo/sonor-drums   
@endsection

@section('grid-title')
    <h1>JOIN JARED FALK FOR A <br class="show-for-medium">CLOSER LOOK AT SONOR DRUMS</h1>
@endsection

@section('lesson-grid')
    @include('drumeo.lead-gen.shows._lesson-grid', [
        "lessonThumb" => "https://d1923uyy6spedc.cloudfront.net/e03-how-to-find-your-motivation-low.jpg",
         "lessonText" => "How To Find Your Motivation"
    ])
    @include('drumeo.lead-gen.shows._lesson-grid', [
        "lessonThumb" => "https://d1923uyy6spedc.cloudfront.net/e05-factory-secrets-to-creating-drum-shells-low.jpg",
         "lessonText" => "Factory Secrets To Creating Drum Shells"
    ])
    @include('drumeo.lead-gen.shows._lesson-grid', [
        "lessonThumb" => "https://d1923uyy6spedc.cloudfront.net/e07-the-finer-details-of-sonor-drums-low.jpg",
         "lessonText" => "The Finer Details of Sonor Drums"
    ])
    @include('drumeo.lead-gen.shows._lesson-grid', [
        "lessonThumb" => "https://d1923uyy6spedc.cloudfront.net/e09-exploring-a-whole-new-side-of-sonor-drums-low.jpg",
         "lessonText" => "Exploring A Whole New Side of Sonor Drums"
    ])
    @include('drumeo.lead-gen.shows._lesson-grid', [
        "lessonThumb" => "https://d1923uyy6spedc.cloudfront.net/e10-trying-out-every-kit-in-the-sonor-drums-factory-low.jpg",
         "lessonText" => "Trying Out Every Sonor Kit In The Factory"
    ])
    @include('drumeo.lead-gen.shows._lesson-grid', [
        "lessonThumb" => "https://d1923uyy6spedc.cloudfront.net/e11-jared-jams-with-himself-low.jpg",
         "lessonText" => "Jared Jams With Himself At Sonor"
    ])
    @include('drumeo.lead-gen.shows._lesson-grid', [
        "lessonThumb" => "https://d1923uyy6spedc.cloudfront.net/e13-jared-gets-creative-at-sonor-low.jpg",
         "lessonText" => "Jared Gets Creative At Sonor"
    ])
    @include('drumeo.lead-gen.shows._lesson-grid', [
        "lessonThumb" => "https://d1923uyy6spedc.cloudfront.net/e14-a-kid-in-a-candy-store-low.jpg",
         "lessonText" => "A Kid In A Candy Store"
    ])
    @include('drumeo.lead-gen.shows._lesson-grid', [
        "lessonThumb" => "https://d1923uyy6spedc.cloudfront.net/e15-mountaintop-solo-low.jpg",
         "lessonText" => "Mountain-Top Solo In Bad Berleburg, Germany"
    ])
@endsection

@section('artists')
    @include('drumeo.lead-gen.courses._artist-tile', [
    "tileThumb" => "https://dpwjbsxqtam5n.cloudfront.net/shows/sonor-drums.jpg",
    "tileName" => "SONOR",
    "tileText" => "A DRUMEO DOCUMENTARY"
    ])

    @include('drumeo.lead-gen.courses._artist-tile', [
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
    "tileThumb" => "https://dpwjbsxqtam5n.cloudfront.net/shows/show-podcast.jpg",
    "tileName" => "The Drumeo Podcast",
    "tileText" => "With Jared Falk & Dave Atkinson"
    ])

    @include('drumeo.lead-gen.courses._artist-tile', [
    "responsiveHide" => true,
    "tileThumb" => "https://dpwjbsxqtam5n.cloudfront.net/shows/exploring-beats.jpg",
    "tileName" => "Exploring Beats",
    "tileText" => "With Carson Gant"
    ])

    @include('drumeo.lead-gen.courses._artist-tile', [
    "responsiveHide" => true,
    "tileThumb" => "https://dpwjbsxqtam5n.cloudfront.net/shows/gear.jpg",
    "tileName" => "Gear Guides",
    "tileText" => "Find Out What Gear The Pros Are Using."
    ])

    @include('drumeo.lead-gen.courses._artist-tile', [
    "responsiveHide" => true,
    "tileThumb" => "https://dpwjbsxqtam5n.cloudfront.net/shows/behind-the-scenes.jpg",
    "tileName" => "Behind The Scenes",
    "tileText" => "What really happens at Drumeo?"
    ])
@endsection



