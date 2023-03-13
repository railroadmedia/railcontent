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
            <div x-ref="lessons" class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-10 max-w-md mx-auto md:max-w-full {{-- max-h-[800px] --}} overflow-hidden transition-all duration-300">
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
            <span class="btn-secondary text-drumeo" @click="console.log('click')">Show all</span>
        </div>
    </section>

    <section class="py-12 md:py-20" style="background: radial-gradient(34.53% 68.28% at 31.51% 33.16%, #FFEBDD 0%, #E2E7F0 100%)">
        <div class="flex flex-wrap sm:flex-nowrap items-start justify-center sm:mt-8 md:px-4 lg:px-0">
            <img
                class="border-8 border-white rounded-3xl shadow-xl w-52 sm:w-72 lg:w-96 relative -mb-16 sm:mb-0 sm:-mt-8 sm:-mr-8 z-10"
                src="https://drumeo-assets.s3.amazonaws.com/lead-gen/fwtgf/coach.jpg"
                alt="profile picture"
            >
            <div class="h-10 w-full sm:hidden" style="background: linear-gradient(to left top, #00101d calc(50% - 1px), transparent, transparent calc(50% + 1px));"></div>
            <div class="text-white text-left rounded-none md:rounded-xl pt-14 pb-8 sm:py-10 lg:py-12 px-6 sm:pr-10 sm:pl-14 lg:px-14 sm:mt-8 w-full sm:w-auto sm:flex-grow" style="background-color:#00101d;">
                <h6 class="uppercase text-drumeo leading-normal">MEET YOUR TEACHER</h6>
                <h2><strong>El Estepario Siberiano</strong></h2>
                <h6 class="leading-normal mt-4 lg:mt-6">
                    Estepario Siberiano has pushed the boundaries of drumming.<br><br>

                    He’s inspired millions of people with his dedication, talent, and innovation – playing at speeds (with one AND two hands) that were thought to be impossible. And always applying these skills in a musical context – not just playing fast for the sake of playing fast.<br><br>

                    He’s developed key exercises that have helped him play at these speeds – and now he’s here to teach you!
                </h6>
                <div class="flex justify-between text-center mt-7 lg:mt-10">
                    <div class="">
                        <img class="h-6 sm:h-8 lazyload" data-src="https://cdn.musora.com/image/fetch/w_100,q_auto:best/https://drumeo-assets.s3.amazonaws.com/drum-shop/30-day-drummer/TikTok_Icon.svg" alt="tiktok icon">
                        <h3 class="mt-2"><strong>2.2M</strong></h3>
                        <p class="uppercase opacity-70 text-sm">Followers</p>
                    </div>
                    <div class="">
                        <img class="h-6 sm:h-8 lazyload" data-src="https://cdn.musora.com/image/fetch/w_100,q_auto:best/https://drumeo-assets.s3.amazonaws.com/drum-shop/30-day-drummer/Insta_Icon.svg" alt="insta icon">
                        <h3 class="mt-2"><strong>948k</strong></h3>
                        <p class="uppercase opacity-70 text-sm">followers</p>
                    </div>
                    <div class="">
                        <img class="h-6 sm:h-8 lazyload" data-src="https://cdn.musora.com/image/fetch/w_100,q_auto:best/https://drumeo-assets.s3.amazonaws.com/drum-shop/30-day-drummer/Youtube_Icon.svg" alt="youtube icon">
                        <h3 class="mt-2"><strong>224M</strong></h3>
                        <p class="uppercase opacity-70 text-sm">views</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    @include('drumeo.lead-gen.partials.quick-questions', [
        'textColor' => 'black',
        'bgColor' => 'white'
    ])

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
