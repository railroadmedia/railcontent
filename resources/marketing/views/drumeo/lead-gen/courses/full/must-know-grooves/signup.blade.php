@extends('drumeo.lead-gen.lead-gen-layout-tw')

@section('meta')
    <title>Rich Redmond - Must-Know Drum Grooves | Drumeo</title>
    <meta name="description" content="Sign up on this page and you’ll get 9 videos with Rich Redmond that are normally reserved for Drumeo members.">
    <meta property="og:image" content="https://dpwjbsxqtam5n.cloudfront.net/lead-gen/must-know-grooves/og-image.jpg" style="display: none;">
    <meta property="og:title" content="Rich Redmond - Must-Know Drum Grooves">
    <meta property="og:description" content="Sign up on this page and you’ll get 9 videos with Rich Redmond that are normally reserved for Drumeo members.">
    <meta property="og:url" content="https://www.drumeo.com/must-know-grooves/">
@stop

@section('styles')
    <link href="{{ asset('/assets/members-area/css/gulp/lead-gen-course.css') }}" rel="stylesheet">
@stop

@php
    $lessons = [
        [
            "lessonNumber" => "1",
            "lessonThumb" => "https://dpwjbsxqtam5n.cloudfront.net/lead-gen/must-know-grooves/thumb-getting-started.jpg",
            "lessonText" => "Getting Started",
            "description" => "You’ll hear the subtle differences of each playing style as Rich seamlessly transitions through each one to kick things off with a literal BANG."
        ],
        [
            "lessonNumber" => "2",
            "lessonThumb" => "https://dpwjbsxqtam5n.cloudfront.net/lead-gen/must-know-grooves/thumb-shuffle.jpg",
            "lessonText" => "Shuffle",
            "description" => "If you want to play in a band, start by mastering your shuffle. Rich walks you through the nuances that make each shuffle unique.",
        ],
        [
            "lessonNumber" => "3",
            "lessonThumb" => "https://dpwjbsxqtam5n.cloudfront.net/lead-gen/must-know-grooves/thumb-lindy-beat.jpg",
            "lessonText" => "Lindy Beat",
            "description" => "There’s a reason this groove was drumming’s soundtrack to early rock and roll. Master this beat and you’ll be playing a piece of history.",
        ],
        [
            "lessonNumber" => "4",
            "lessonThumb" => "https://dpwjbsxqtam5n.cloudfront.net/lead-gen/must-know-grooves/thumb-motown-beat.jpg",
            "lessonText" => "Motown Beat",
            "description" => "<em>Ain’t No Mountain High Enough</em>, <em>I Heard It Through The Grapevine</em>, <em>My Girl</em>. Learn the drum groove that propelled music’s biggest hits.",
        ],
        [
            "lessonNumber" => "5",
            "lessonThumb" => "https://dpwjbsxqtam5n.cloudfront.net/lead-gen/must-know-grooves/thumb-latin-beats.jpg",
            "lessonText" => "Latin Beats",
            "description" => "Latin beats open up all-new musical combinations for you around the drum set. Rich gives you his take on these fundamental Latin grooves.",
        ],
        [
            "lessonNumber" => "6",
            "lessonThumb" => "https://dpwjbsxqtam5n.cloudfront.net/lead-gen/must-know-grooves/thumb-vacation-rhythms.jpg",
            "lessonText" => "Vacation Rhythms",
            "description" => "The Calypso and the Soca are Caribbean inspired rhythms that will open up even more musical possibilities for you as a drummer.",
        ],
        [
            "lessonNumber" => "7",
            "lessonThumb" => "https://dpwjbsxqtam5n.cloudfront.net/lead-gen/must-know-grooves/thumb-second-line.jpg",
            "lessonText" => 'Second Line',
            "description" => "This New-Orlean’s inspired rhythm finds the grease between straight and swung to get your audience moving.",
        ],
        [
            "lessonNumber" => "8",
            "lessonThumb" => "https://dpwjbsxqtam5n.cloudfront.net/lead-gen/must-know-grooves/thumb-social-punk.jpg",
            "lessonText" => "SoCal Punk",
            "description" => "Rich shows you the fast & furious beats that became synonymous with 1990’s Southern California punk -- get ready to break a sweat.",
        ],
        [
            "lessonNumber" => "9",
            "lessonThumb" => "https://dpwjbsxqtam5n.cloudfront.net/lead-gen/must-know-grooves/thumb-mozambique-songo.jpg",
            "lessonText" => "Mozambique & Songo",
            "description" => "Tasty rhythms meet the challenges of independence. Add some heat to your groove arsenal with these tricky Latin grooves.",
        ],
    ];
@endphp

@section('content')
    <header class="header">
        <div class="container px-4 max-w-6xl mx-auto" style="background-image:url(https://dpwjbsxqtam5n.cloudfront.net/lead-gen/must-know-grooves/header.jpg);">
            <div class="text-center">
                <div class="course-logo rich">
                    <h3>Must-Know</h3>
                    <h2>Drum Grooves</h2>
                    <h4 class="text-blue">WITH RICH REDMOND</h4>
                </div>
                <p>
                    Enter your email to receive <br class="sm:hidden">this FREE Drumeo course.
                </p>
                @include("lead-gen.partials.sign-up-form-tw", [
                    "formId" => "Drumeo - Engagement - Trigger - Must Know - Web Form",
                    "formName" => 'Must-Know Drum Grooves',
                    "buttonText" => 'Send The Videos&nbsp;'
                ])
            </div>
        </div>
    </header>

    @include('lead-gen.courses.full.partials.instructor',[
        "img" => "https://dpwjbsxqtam5n.cloudfront.net/lead-gen/must-know-grooves/concert-photo.jpg",
        "title" => '
            NASHVILLE, LA,
            <br class="hidden sm:inline lg:hidden">
            YOUR LIVING ROOM
        ',
        "desc" => "Who better to teach you drumming’s <em>Must-Know Grooves</em>?
        <br><br>
        Rich Redmond has played drums on <strong>26 Number One Hit Songs</strong> with artists like Jason Aldean, Garth Brooks, Miranda Lambert, Kelly Clarkson, and so many more. He plays to 50,000+ seat venues, live television broadcasts to millions, and handles all the high-pressure demands with composure and professionalism.
        <br><br>
        <strong>And now he’s here to teach you.</strong>
        <br><br>
        Get ready to improve your versatility as a drummer with <strong>eight of drumming’s most important grooves</strong> taught by one of drumming’s most in-demand players. By the end, you’ll have the foundation to confidently play in a wide variety of musical settings and have every band begging to hire you."
    ])

    @include('lead-gen.courses.full.partials.lessons',[
        "headLine" => "THE SERIES"
    ])

    @include('lead-gen.partials.quick-questions',[
        "bgColor" => "#eff0f0",
        "textColor" => "black",
    ])

    <section class="final">
        <div class="container px-4 max-w-5xl mx-auto">
            <div class="course-logo rich">
                <h3>Must-Know</h3>
                <h2>Drum Grooves</h2>
                <h4 class="text-blue">WITH RICH REDMOND</h4>
            </div>
            <p>Enter your email to receive <br class="sm:hidden">this FREE Drumeo course.</p>
            <br><br class="show-for-medium">
            @include("lead-gen.partials.sign-up-form-tw", [
                "formId" => "Drumeo - Engagement - Trigger - Must Know - Web Form",
                "formName" => 'Must-Know Drum Grooves',
                "buttonText" => 'Send The Videos&nbsp;'
            ])
        </div>
    </section>
@stop
