@extends('drumeo.lead-gen.shows.shows-layout')

@section('title')
    In Rhythm - Your backstage pass to professional drummers
@endsection

@section('description')
    Beau Bokan and Drumeo take you on a journey through a day in the life of touring drummers -- from breakfast to soundcheck, showtime, and getting back on the bus (and everywhere in between).
@endsection

@section('show-tile', 'https://dpwjbsxqtam5n.cloudfront.net/lead-gen/shows/in-rhythm/in-rhythm-show-card-aaron.jpg' )

@section('trailer-url', 'https://www.youtube.com/embed/Q-ZYnzED71E?autoplay=1' )

@section('logo')
    <img class="no-shadow" src="https://dpwjbsxqtam5n.cloudfront.net/lead-gen/shows/in-rhythm/in-rhythm-logo.png">
@endsection

@section('url-slug', 'in-rhythm' )

@section('show-url')
    {{ get_musora_brand_base_url() }}/drumeo/in-rhythm
@endsection

@section('watch-arrow')
    <img class="arrow" src="https://dpwjbsxqtam5n.cloudfront.net/lead-gen/shows/free-episode.png">
@endsection

@section('grid-title')
    <h1 class="opensans">Your backstage pass to<br class="hide-for-large"> professional drummers</h1>
@endsection

@section('grid-sub')
    Beau Bokan, Golden Hearts Media, and Drumeo take you on a journey through a day in the life of touring drummers -- from breakfast to soundcheck, showtime, and getting back on the bus (and everywhere in between).
@endsection

@section('lesson-grid')
    @include('drumeo.lead-gen.shows._lesson-grid', [
        "lessonThumb" => "https://dpwjbsxqtam5n.cloudfront.net/lead-gen/shows/in-rhythm/aaron-gillespie.jpg",
         "lessonText" => "Aaron Gillespie<br><span class='light'>(Underoath, The Almost, Paramore)</span>"
    ])
    @include('drumeo.lead-gen.shows._lesson-grid', [
        "lessonThumb" => "https://dpwjbsxqtam5n.cloudfront.net/lead-gen/shows/in-rhythm/aric-improta.jpg",
         "lessonText" => "Aric Improta<br><span class='light'>(Night Verses, Fever 333)</span>"
    ])
    @include('drumeo.lead-gen.shows._lesson-grid', [
        "lessonThumb" => "https://dpwjbsxqtam5n.cloudfront.net/lead-gen/shows/in-rhythm/brian-fraser-moore.jpg",
         "lessonText" => "Brian Frasier-Moore<br><span class='light'>(Justin Timberlake, Madonna, Christina Aguilera)</span>"
    ])
    @include('drumeo.lead-gen.shows._lesson-grid', [
        "lessonThumb" => "https://dpwjbsxqtam5n.cloudfront.net/lead-gen/shows/in-rhythm/tim-oxford.jpg",
         "lessonText" => "Tim Oxford<br><span class='light'>(Arkells)</span>"
    ])
    @include('drumeo.lead-gen.shows._lesson-grid', [
        "lessonThumb" => "https://dpwjbsxqtam5n.cloudfront.net/lead-gen/shows/in-rhythm/matt-greiner.jpg",
         "lessonText" => "Matt Greiner<br><span class='light'>(August Burns Red)</span>"
    ])
    @include('drumeo.lead-gen.shows._lesson-grid', [
        "lessonThumb" => "https://dpwjbsxqtam5n.cloudfront.net/lead-gen/shows/in-rhythm/mike-sleath.jpg",
         "lessonText" => "Mike Sleath<br><span class='light'>(Shawn Mendes)</span>"
    ])
@endsection

@section('artists')
    @include('drumeo.lead-gen.courses._artist-tile', [
    "tileThumb" => "https://dpwjbsxqtam5n.cloudfront.net/shows/in-rhythm-show-card.jpg",
    "tileName" => "In Rhythm",
    "tileText" => "By Beau Bokan"
    ])
    @include('drumeo.lead-gen.courses._artist-tile', [
    "tileThumb" => "https://dpwjbsxqtam5n.cloudfront.net/shows/study-the-greats.jpg",
    "tileName" => "Study The Greats",
    "tileText" => "With Austin Burcham"
    ])

    @include('drumeo.lead-gen.courses._artist-tile', [
    "responsiveHide" => true,
    "tileThumb" => "https://dpwjbsxqtam5n.cloudfront.net/shows/diy-drum-experiments.jpg",
    "tileName" => "DIY Drum Experiments",
    "tileText" => "With David Raouf"
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
    <div class="columns artist show-for-medium">
        <div class="plus"><i class="icon-courses"></i></div>
        <p><strong>200 LESSON COURSES</strong><br>
            WITH LEGENDARY DRUMMERS</p>
    </div>
    <div class="columns artist show-for-medium">
        <div class="plus"><i class="fas fa-music"></i></div>
        <p><strong>300 PLAY-ALONG SONGS</strong><br>
            FOR APPLYING YOUR SKILLS</p>
    </div>
@endsection



