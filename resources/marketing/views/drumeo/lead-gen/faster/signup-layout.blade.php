@php
    $lessons = [
        [
            'img' => 'https://dpwjbsxqtam5n.cloudfront.net/lead-gen/fwtgf/the-tinder.jpg',
            'title' => 'The Tinder',
            'desc' => '',
        ],
        [
            'img' => 'https://dpwjbsxqtam5n.cloudfront.net/lead-gen/fwtgf/the-swiss-cheese.jpg',
            'title' => 'The Swiss Cheese',
            'desc' => '',
        ],
        [
            'img' => 'https://dpwjbsxqtam5n.cloudfront.net/lead-gen/fwtgf/double-trouble.jpg',
            'title' => 'Double Trouble',
            'desc' => '',
        ],
        [
            'img' => 'https://dpwjbsxqtam5n.cloudfront.net/lead-gen/fwtgf/clavediddle.jpg',
            'title' => 'Clavedidle',
            'desc' => '',
        ],
        [
            'img' => 'https://dpwjbsxqtam5n.cloudfront.net/lead-gen/fwtgf/fingerson.jpg',
            'title' => 'Fingerson',
            'desc' => '',
        ],
        [
            'img' => 'https://dpwjbsxqtam5n.cloudfront.net/lead-gen/fwtgf/machine-gun.jpg',
            'title' => 'Machine Gun',
            'desc' => '',
        ],
        [
            'img' => 'https://dpwjbsxqtam5n.cloudfront.net/lead-gen/fwtgf/the-classy.jpg',
            'title' => 'The Classy',
            'desc' => '',
        ],
        [
            'img' => 'https://dpwjbsxqtam5n.cloudfront.net/lead-gen/fwtgf/six-stroke-roll.jpg',
            'title' => 'Six Stroke Roll',
            'desc' => '',
        ],
        [
            'img' => 'https://dpwjbsxqtam5n.cloudfront.net/lead-gen/fwtgf/chopadiddle.jpg',
            'title' => 'Chopadiddle',
            'desc' => '',
        ],
        [
            'img' => 'https://dpwjbsxqtam5n.cloudfront.net/lead-gen/fwtgf/diddlechopa.jpg',
            'title' => 'DiddleChopa',
            'desc' => '',
        ],
    ];
@endphp

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

    <section class="py-12 md:py-20">
        <div class="container max-w-6xl mx-auto px-4 text-center">
           <h2 class="font-extrabold mb-4">10 exercises guaranteed to improve your speed.</h2>
            <p class="mb-10">
                These are the very same exercises Estepario uses to practice his speed <br class="hidden lg:inline">
                & endurance on the kit. Now you can use them to improve yours!
            </p>
            <div class="grid grid-cols-3 gap-6 mb-10 max-h-[800px] overflow-hidden">
                @foreach($lessons as $key => $lesson)
                    <div class="rounded-xl overflow-hidden" style="background: #F6F8FC; box-shadow: 5px 5px 5px rgba(0, 0, 0, 0.1);">
                        <img src="{{ $lesson['img'] }}" src="lesson thumbnail {{ $key+1 }}" />
                        <div class="p-4">
                            <h6 class="font-bold">{{ $key+1 }}. {{ $lesson['title'] }}</h6>
                            <p>
                                Lorem ipsum dolor sit amet consectetur. Tortor nibh lorem senectus dui. Dolor id pellentesque magna est gravida in sed euismod iaculis.
                            </p>
                        </div>
                    </div>
                @endforeach
            </div>
            <span class="btn-secondary text-drumeo">Show all</span>
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
