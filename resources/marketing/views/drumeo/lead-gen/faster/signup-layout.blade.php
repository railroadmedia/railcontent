@extends('drumeo.lead-gen.lead-gen-layout-tw',[ 'appTailwind' => true, ])

@section('meta')
    <title>Fastest Way To Get Faster</title>
    <meta name="description" content="Jared Falk's 10-day routine that will help you rapidly improve your speed around the kit.">

    <meta property="og:url" content="https://www.drumeo.com/faster/">
    <meta property="og:image" content="https://dzryyo1we6bm3.cloudfront.net/fastest-way-to-get-faster/thumbnails/og-image.jpg" style="display: none;">
    <meta property="og:title" content="Fastest Way To Get Faster">
    <meta property="og:description" content="Jared Falk's 10-day routine that will help you rapidly improve your speed around the kit.">
@stop

@section('scripts')
    <script>
        $(document).ready(function () {
            var showModal = location.search.substr(1).includes('thankyou');

            if (showModal) {
                $('#thankYouModal').foundation('open');
            }
        });
    </script>
@stop

@section('content')
    <header class="py-12 md:py-20" style="background: #040A20;">
        <div class="max-w-6xl mx-auto flex items-center container px-4">
            <div class="flex-1 text-white">
                <img class="h-14 lg:h-20 mb-3" src="https://dpwjbsxqtam5n.cloudfront.net/lead-gen/fwtgf/fwtgf-logo.svg" alt="FWTGF logo" />
                <h2 class="leading-tight mb-5">Improve your speed on the drums with <b class="font-extrabold">10 free workouts.</b></h2>
                <p class="mb-2">Enter your email below to grab your lessons.</p>
                @include("drumeo.lead-gen.partials.sign-up-form-tw", [
                    "formId" => $formId,
                    "formName" => $formName,
                    "buttonText" => "Get started for free",
                    "stacked" => true
                ])
            </div>
            <div class="flex-1 pl-12 xl:px-12">
                <img src="https://dpwjbsxqtam5n.cloudfront.net/lead-gen/fwtgf/solid-hero-header.png" alt="header hero image" />
            </div>
        </div>
    </header>
{{--    <header class="header" style="background-image: url(https://dzryyo1we6bm3.cloudfront.net/fastest-way-to-get-faster/bg.jpg);">--}}
{{--        <div class="container max-w-6xl mx-auto px-4">--}}
{{--            <div class="text-center">--}}
{{--                <img class="series-logo mx-auto" src="https://dzryyo1we6bm3.cloudfront.net/fastest-way-to-get-faster/logo.png" alt="The Fastest Way To Get Faster">--}}
{{--                <p>Enter your email below for 10 free video lessons...</p>--}}
{{--                @yield('form1')--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </header>--}}


    <section class="lesson-grid">
        <div class="container max-w-6xl mx-auto px-4">
            <h1>Jared Falk's 10-Day Plan For Faster Hands & Feet</h1>
            <p>The Fastest Way To Get Faster is a 10-Day routine that will help you rapidly improve your speed around the kit. You will need to practice hard, you will need to stick with it, and you might need to push yourself harder than usual - but it's been created to deliver results.</p>
            <div class="thumbnail-wrap grid gap-6 grid-cols-2 md:grid-cols-3">
                <div class="w-full">
                    @include("drumeo.lead-gen.partials.thumbnail-signup", [
                        "image" => "https://dzryyo1we6bm3.cloudfront.net/fastest-way-to-get-faster/thumbnails/1.jpg",
                        "badge" => "Day #1",
                        "title" => "Paradiddle Madness"
                    ])
                </div>
                <div class="w-full">
                    @include("drumeo.lead-gen.partials.thumbnail-signup", [
                        "image" => "https://dzryyo1we6bm3.cloudfront.net/fastest-way-to-get-faster/thumbnails/2.jpg",
                        "badge" => "Day #2",
                        "title" => "The Buddy Bruiser"
                    ])
                </div>
                <div class="w-full">
                    @include("drumeo.lead-gen.partials.thumbnail-signup", [
                        "image" => "https://dzryyo1we6bm3.cloudfront.net/fastest-way-to-get-faster/thumbnails/3.jpg",
                        "badge" => "Day #3",
                        "title" => "The Forearm Crusher"
                    ])
                </div>
                <div class="w-full">
                    @include("drumeo.lead-gen.partials.thumbnail-signup", [
                        "image" => "https://dzryyo1we6bm3.cloudfront.net/fastest-way-to-get-faster/thumbnails/4.jpg",
                        "badge" => "Day #4",
                        "title" => "Do You Even Math?"
                    ])
                </div>
                <div class="w-full">
                    @include("drumeo.lead-gen.partials.thumbnail-signup", [
                        "image" => "https://dzryyo1we6bm3.cloudfront.net/fastest-way-to-get-faster/thumbnails/5.jpg",
                        "badge" => "Day #5",
                        "title" => "Crazy Crossover"
                    ])
                </div>
                <div class="w-full">
                    @include("drumeo.lead-gen.partials.thumbnail-signup", [
                        "image" => "https://dzryyo1we6bm3.cloudfront.net/fastest-way-to-get-faster/thumbnails/6.jpg",
                        "badge" => "Day #6",
                        "title" => "The Illusion Of Speed"
                    ])
                </div>
                <div class="w-full">
                    @include("drumeo.lead-gen.partials.thumbnail-signup", [
                        "image" => "https://dzryyo1we6bm3.cloudfront.net/fastest-way-to-get-faster/thumbnails/7.jpg",
                        "badge" => "Day #7",
                        "title" => "The Main Foot Killer"
                    ])
                </div>
                <div class="w-full">
                    @include("drumeo.lead-gen.partials.thumbnail-signup", [
                        "image" => "https://dzryyo1we6bm3.cloudfront.net/fastest-way-to-get-faster/thumbnails/8.jpg",
                        "badge" => "Day #8",
                        "title" => "Do You Even Math? (The Sequel)"
                    ])
                </div>
                <div class="w-full">
                    @include("drumeo.lead-gen.partials.thumbnail-signup", [
                        "image" => "https://dzryyo1we6bm3.cloudfront.net/fastest-way-to-get-faster/thumbnails/9.jpg",
                        "badge" => "Day #9",
                        "title" => "Everything's Better When You're Part Of A Team"
                    ])
                </div>
                <div class="w-full end">
                    @include("drumeo.lead-gen.partials.thumbnail-signup", [
                        "image" => "https://dzryyo1we6bm3.cloudfront.net/fastest-way-to-get-faster/thumbnails/10.jpg",
                        "badge" => "Day #10",
                        "title" => "Take'r For A Rip, Eh?"
                    ])
                </div>
            </div>
        </div>
    </section>

    @include('drumeo.lead-gen.partials.enter-email1',[
        "headLine" => "Enter your email below for 10 free video lessons...",
        "formId" => $formId,
        "formName" => $formName,
    ])

    <div class="reveal medium" id="signUpModal" data-reveal>
        <section class="header pop-up">
            <h1 class="text-center">Enter your email below for 10 free video lessons...</h1>
            @yield('form2')
        </section>
    </div>

    <div class="reveal large" id="thankYouModal" data-reveal data-reset-on-close="true">
        <div class="gavin-sign-up">
            <h2>Success!</h2>
            <p>We're emailing you the link to your lessons.
                <br><br>
                <em>
                    If you don't receive the email within 10 minutes, check your spam<br class="hidden sm:inline">
                    folder or refresh this page to re-enter your email address again.</em>
                </p>
            <div class="social-links">
                <a href="https://www.youtube.com/freedrumlessons/" target="_blank" class="youtube"><i class="fab fa-youtube"></i></a>
                <a href="https://facebook.com/drumeo/" target="_blank" class="facebook"><i class="fab fa-facebook-f"></i></a>
                <a href="https://instagram.com/drumeoofficial/" target="_blank" class="instagram"><i class="fab fa-instagram"></i></a>
            </div>
        </div>
    </div>
@stop
