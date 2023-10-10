@php
    $lessons = [
        [
            'img' => 'https://d21q7xesnoiieh.cloudfront.net/fit-in/720x0/filters:quality(95)/marketing/drumeo/lead-gen/faster/the-tinder.jpg',
            'title' => 'The Tinder',
            'desc' => 'The fastest way to go from singles to… well, not singles. This deceptively simple exercise will help you make a seamless transition from single to double strokes.',
            'unlocked' => true,
        ],
        [
            'img' => 'https://d21q7xesnoiieh.cloudfront.net/fit-in/720x0/filters:quality(95)/marketing/drumeo/lead-gen/faster/the-swiss-cheese.jpg',
            'title' => 'The Swiss Cheese',
            'desc' => 'A clever variation of the Swiss Army Triplet, this workout will improve your flams & triplets and ensure both Rights and Lefts develop equally.',
        ],
        [
            'img' => 'https://d21q7xesnoiieh.cloudfront.net/fit-in/720x0/filters:quality(95)/marketing/drumeo/lead-gen/faster/double-trouble.jpg',
            'title' => 'Double Trouble',
            'desc' => 'You’re ready to start moving around the kit. This exercise uses simple double strokes on two different surfaces to boost your coordination & speed in both hands.',
        ],
        [
            'img' => 'https://d21q7xesnoiieh.cloudfront.net/fit-in/720x0/filters:quality(95)/marketing/drumeo/lead-gen/faster/clavediddle.jpg',
            'title' => 'Clavediddle',
            'desc' => 'This is one of Estepario’s favorites. This exercise incorporates a basic clave rhythm combined with double strokes to help you improve your speed with a musical twist.',
        ],
        [
            'img' => 'https://d21q7xesnoiieh.cloudfront.net/fit-in/720x0/filters:quality(95)/marketing/drumeo/lead-gen/faster/fingerson.jpg',
            'title' => 'Fingerson',
            'desc' => 'You’re getting into new finger techniques now. Estepario shows you his signature exercise for developing finger technique to unlock new levels of speed in your playing.',
        ],
        [
            'img' => 'https://d21q7xesnoiieh.cloudfront.net/fit-in/720x0/filters:quality(95)/marketing/drumeo/lead-gen/faster/machine-gun.jpg',
            'title' => 'Machine Gun',
            'desc' => 'Estepario’s secret weapon for moving around the kit with speed & precision. You’ll harness the power of single strokes to move effortlessly between the snare and floor tom.',
        ],
        [
            'img' => 'https://d21q7xesnoiieh.cloudfront.net/fit-in/720x0/filters:quality(95)/marketing/drumeo/lead-gen/faster/the-classy.jpg',
            'title' => 'The Classy',
            'desc' => 'A tongue twister that will boost your 16th note triplets. This exercise will push your coordination and open up combinations around the drum set at high speeds.',
        ],
        [
            'img' => 'https://d21q7xesnoiieh.cloudfront.net/fit-in/720x0/filters:quality(95)/marketing/drumeo/lead-gen/faster/six-stroke-roll.jpg',
            'title' => 'Six Stroke Roll',
            'desc' => 'No fancy name required. Estepario shows you how to move the six stroll around the drum set to create blistering patterns and musical ostinatos that can be used in any setting.',
        ],
        [
            'img' => 'https://d21q7xesnoiieh.cloudfront.net/fit-in/720x0/filters:quality(95)/marketing/drumeo/lead-gen/faster/chopadiddle.jpg',
            'title' => 'Chopadiddle',
            'desc' => 'An innovative spin on the classic paradiddle, this exercise is a signature Estepario lick that will spice up your chops instantly while boosting your double strokes.',
        ],
        [
            'img' => 'https://d21q7xesnoiieh.cloudfront.net/fit-in/720x0/filters:quality(95)/marketing/drumeo/lead-gen/faster/diddlechopa.jpg',
            'title' => 'DiddleChopa',
            'desc' => 'Harness the inverted paradiddle to move around the kit with speed and ease. This is another simple concept that will push you at higher tempos as you move around the kit.',
        ],
    ];
@endphp

@extends('drumeo.lead-gen.lead-gen-layout-tw',[ 'appTailwind' => true, ])

@section('meta')
    <title>Fastest Way To Get Faster</title>
    <meta property="og:title" content="Fastest Way To Get Faster">
    <meta name="description" content="El Estepario Siberiano’s 10 exercises to improve your speed on the drums.">
    <meta property="og:description" content="El Estepario Siberiano’s 10 exercises to improve your speed on the drums.">

    <meta property="og:url" content="https://www.drumeo.com/faster/">
    <meta property="og:image" content="https://dpwjbsxqtam5n.cloudfront.net/lead-gen/fwtgf/share-image.jpg" style="display: none;">
@stop

@section('styles')
    <link href="{{ asset('/marketing/parcel/drumeo/lead-gen-tw.css') }}" rel="stylesheet">
@endsection

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

@section('body-data')
    x-data="{
        sampleLesson: false,
    }"
@endsection

@section('content')
    <header class="py-10 sm:py-14" style="background: linear-gradient(45deg, #2a2a72, #009ffd);">
        <div class="max-w-5xl mx-auto sm:flex items-center container px-4 text-center sm:text-left">
            <div class="w-full sm:w-7/12 lg:w-1/2 text-white max-w-xl mx-auto sm:max-w-full">
                <div class="px-2 sm:px-3">
                    <img
                        class="h-12 sm:h-14 lg:h-16 mb-3 transition-opacity opacity-0"
                        src="https://www.musora.com/musora-cdn/image/width=500,quality=95/https://dpwjbsxqtam5n.cloudfront.net/lead-gen/fwtgf/fwtgf-logo.svg"
                        alt="FWTGF logo"
                        loading="lazy"
                        onload="this.classList.remove('opacity-0')"
                    />
                    <img
                        class="rounded-xl sm:hidden mb-5 transition-opacity opacity-0"
                        src="{{ $headerImageM }}"
                        alt="header hero image mobile"
                        loading="lazy"
                        onload="this.classList.remove('opacity-0')"
                    />
                    <h2 class="leading-tight mb-5">Improve your speed on the drums with <b class="font-extrabold">10 free workouts.</b></h2>
                    <h6 class="mb-4">Enter your email below to grab your lessons.</h6>
                </div>
                @include("drumeo.lead-gen.partials.sign-up-form", [
                    "recaptchaKey" => $recaptchaKey,
                    "formId" => $formId,
                    "formName" => $formName,
                    "buttonColor" => "bg-[#17ff9e] text-black",
                    "buttonText" => "Get started for free",
                    "stacked" => true,
                    "redirectURL" => "/faster/thank-you/",
                ])
            </div>
            <div class="w-full sm:w-5/12 lg:w-1/2 sm:pl-5 lg:pl-7 hidden sm:block">
                <img
                    class="transition-opacity opacity-0"
                    src="{{ $headerImage }}"
                    alt="header hero image"
                    loading="lazy"
                    onload="this.classList.remove('opacity-0')"
                />
            </div>
        </div>
    </header>

    <section class="py-12 sm:py-20 px-4 text-center">
        <div class="container max-w-6xl mx-auto">
           <h2 class="font-extrabold mb-4">
               10 exercises guaranteed <br class="inline lg:hidden">
               to improve your speed.</h2>
            <p class="mb-10">
                These are the very same exercises Estepario uses to practice his speed <br class="hidden sm:inline">
                & endurance on the kit. Now you can use them to improve yours!
            </p>
            <div class="flex flex-wrap justify-center mb-10 max-w-xs mx-auto sm:max-w-full">
                @foreach($lessons as $key => $lesson)
                    <div class="w-full sm:w-1/3 px-2 lg:px-3 mb-4 lg:mb-6">
                        <div class="rounded-xl overflow-hidden" style="background: #F6F8FC; box-shadow: 5px 5px 5px rgba(0, 0, 0, 0.1);">
                            <div class="relative">
                                <img
                                    class="transition-opacity opacity-0"
                                    src="{{ $lesson['img'] }}"
                                    alt="lesson thumbnail {{ $key+1 }}"
                                    loading="lazy"
                                    onload="this.classList.remove('opacity-0')"
                                />
                                @if(!empty($lesson['unlocked']))
                                    <i class="absolute top-1/2 left-1/2 fas fa-play play-button" style="margin: -39px;" @click="sampleLesson = true;"></i>
                                @else
                                    <div class="absolute inset-0 flex justify-center items-center">
                                        <i class="fa-solid fa-lock-keyhole text-white text-5xl"></i>
                                    </div>
                                @endif
                            </div>
                            <div class="p-4 text-left">
                                <h6 class="mx-0 mb-2 uppercase font-black">{{ $key+1 }}. {{ $lesson['title'] }}</h6>
                                <p class="text-sm">{{ $lesson['desc'] }}</p>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <section class="py-12 sm:py-20" style="background: linear-gradient(45deg, #2a2a72, #009ffd);">
        <div class="flex flex-wrap sm:flex-nowrap items-start justify-center sm:mt-8 sm:px-4 lg:px-0">
            <img
                class="border-8 border-white rounded-3xl shadow-xl w-52 sm:w-72 lg:w-96 relative -mb-16 sm:mb-0 sm:-mt-8 sm:-mr-8 z-10 transition-opacity opacity-0"
                src="https://dpwjbsxqtam5n.cloudfront.net/lead-gen/fwtgf/coach.jpg"
                alt="profile picture"
                loading="lazy"
                onload="this.classList.remove('opacity-0')"
            >
            <div class="h-10 w-full sm:hidden" style="background: linear-gradient(to left top, #00101d calc(50% - 1px), transparent, transparent calc(50% + 1px));"></div>
            <div class="text-white text-left rounded-none sm:rounded-xl pt-14 pb-8 sm:py-10 lg:py-12 px-6 sm:pr-10 sm:pl-14 lg:px-14 sm:mt-8 w-full sm:w-auto sm:flex-grow lg:max-w-xl" style="background-color:#00101d;">
                <h6 class="uppercase leading-normal" style="color:#fd5470;">MEET YOUR TEACHER</h6>
                <h2><strong>El Estepario Siberiano</strong></h2>
                <h6 class="leading-normal mt-4 lg:mt-6">
                    Estepario Siberiano has pushed the boundaries of drumming.<br><br>

                    He’s inspired millions of people with his dedication, talent, and innovation – playing at speeds (with one AND two hands) that were thought to be impossible. And always applying these skills in a musical context – not just playing fast for the sake of playing fast.<br><br>

                    He’s developed key exercises that have helped him play at these speeds – and now he’s here to teach you!
                </h6>
                <div class="flex justify-between text-center mt-7 lg:mt-10">
                    <div class="">
                        <img class="h-6 sm:h-8 lazyload" data-src="https://www.musora.com/musora-cdn/image/width=100,quality=95/https://dpwjbsxqtam5n.cloudfront.net/drum-shop/30-day-drummer/TikTok_Icon.svg" alt="tiktok icon">
                        <h3 class="mt-2"><strong>3.7M</strong></h3>
                        <p class="uppercase opacity-70 text-sm">Followers</p>
                    </div>
                    <div class="">
                        <img class="h-6 sm:h-8 lazyload" data-src="https://www.musora.com/musora-cdn/image/width=100,quality=95/https://dpwjbsxqtam5n.cloudfront.net/drum-shop/30-day-drummer/Insta_Icon.svg" alt="insta icon">
                        <h3 class="mt-2"><strong>2.8M</strong></h3>
                        <p class="uppercase opacity-70 text-sm">followers</p>
                    </div>
                    <div class="">
                        <img class="h-6 sm:h-8 lazyload" data-src="https://www.musora.com/musora-cdn/image/width=100,quality=95/https://dpwjbsxqtam5n.cloudfront.net/drum-shop/30-day-drummer/Youtube_Icon.svg" alt="youtube icon">
                        <h3 class="mt-2"><strong>577M</strong></h3>
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

    <section class="py-14 sm:py-28 text-center text-white bg-cover bg-center" style="background: url('https://d21q7xesnoiieh.cloudfront.net/fit-in/1500x0/filters:quality(95)/marketing/drumeo/lead-gen/faster/order-bg.jpg');">
        <div class="max-w-3xl mx-auto">
        <img class="h-16 lg:h-24" src="https://www.musora.com/musora-cdn/image/width=400,quality=95/https://dpwjbsxqtam5n.cloudfront.net/lead-gen/fwtgf/fwtgf-logo.svg" alt="FWTGF logo" />
        <h5 class="my-5 sm:my-7">Enter your email to receive ten free exercises.</h5>
        @include("drumeo.lead-gen.partials.sign-up-form", [
            "recaptchaKey" => $recaptchaKey,
            "formId" => $formId . '2',
            "formName" => $formName,
            "buttonText" => "Send videos",
            "redirectURL" => "/faster/thank-you/",
        ])
        </div>
    </section>

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

    @include('_partials.components.video-modal',[
        'name' => 'sampleLesson',
        'video' => '806957290',
        'vimeo' => true,
    ])
@stop
