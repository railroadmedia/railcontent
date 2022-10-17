@extends('drumeo.lead-gen.lead-gen-layout-tw')

@section('meta')
    <title>Anika Nilles - Subdivision Challenge | Drumeo</title>
    <meta name="description" content="Sign up on this page and you’ll get 5 videos with Anika Nilles that are normally reserved for Drumeo members.">
    <meta property="og:image" content="https://dpwjbsxqtam5n.cloudfront.net/lead-gen/subdivision-challenge/og-image.jpg" style="display: none;">
    <meta property="og:title" content="Anika Nilles - Subdivision Challenge">
    <meta property="og:description" content="Sign up on this page and you’ll get 5 videos with Anika Nilles that are normally reserved for Drumeo members.">
    <meta property="og:url" content="https://www.drumeo.com/subdivision-challenge/">
@stop

@section('styles')
    <link href="{{ asset('/assets/members-area/css/gulp/lead-gen-course.css') }}" rel="stylesheet">
@stop

@section('content')

    <header class="header">
        <div class="container max-w-6xl mx-auto px-4" style="background-image:url(https://dpwjbsxqtam5n.cloudfront.net/lead-gen/subdivision-challenge/header.jpg);">
            <div class="text-center">
                <div class="course-logo anika">
                    <h4 class="text-yellow"><strong>ANIKA NILLES'</strong></h4>
                    <h2>SUBDIVISION</h2>
                    <h3>CHALLENGE</h3>
                </div>
                <p>Get comfortable playing <strong>odd <br class="sm:hidden"> numbers</strong> in this FREE series.</p>
            </div>
        </div>
    </header>

    <section class="lesson-breakdown text-center">
        <div class="container max-w-6xl mx-auto px-4">
            <h1 class="opensans"><strong>Challenge yourself with <br class="lg:hidden">fives, sixes, and sevens.</strong></h1>
            <div class="left-right-thumbs">
                <div class="thumb-wrap">
                    <img src="https://dpwjbsxqtam5n.cloudfront.net/lead-gen/subdivision-challenge/thumb-1.jpg" alt="subdivision-challenge-thumb-1">
                    <div class="text">
                        <h4><strong>Play everything easily.</strong></h4>
                        <p>Your favorite songs are probably based on standard four note groupings. Studying subdivisions in fives, sixes, and sevens will make these songs seem EASY by training your brain to hear between the lines.</p>
                    </div>
                </div>
                <div class="thumb-wrap">
                    <img src="https://dpwjbsxqtam5n.cloudfront.net/lead-gen/subdivision-challenge/thumb-2.jpg" alt="subdivision-challenge-thumb-2">
                    <div class="text">
                        <h4><strong>Expand your musical possibilities.</strong></h4>
                        <p>Go beyond playing fills and grooves exclusively in fours and eights. The Subdivision Challenge will have you playing entirely NEW patterns and stickings around the kit, opening hundreds of creative options to you.</p>
                    </div>
                </div>
                <div class="thumb-wrap">
                    <img src="https://dpwjbsxqtam5n.cloudfront.net/lead-gen/subdivision-challenge/thumb-3.jpg" alt="subdivision-challenge-thumb-3">
                    <div class="text">
                        <h4><strong>Strengthen your weaker hand.</strong></h4>
                        <p>Admit it - you start everything with your right hand and end with your left. Studying fives and sevens will force you to switch your lead hand more than you’re used to, giving you a stronger “weak” hand and a more flexible brain.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    @include('lead-gen.partials.quick-questions',[
        "bgColor" => "#eff0f0",
        "textColor" => "black",
    ])

    <section class="final">
        <div class="container max-w-6xl mx-auto px-4">
            <div class="course-logo anika">
                <h4 class="text-yellow"><strong>ANIKA NILLES'</strong></h4>
                <h2>SUBDIVISION</h2>
                <h3>CHALLENGE</h3>
            </div>
            {{--<p>Enter your email and receive <br class="hide-for-medium">the five video series, FREE.</p>--}}
            {{--<br>--}}

        </div>
    </section>
@stop
