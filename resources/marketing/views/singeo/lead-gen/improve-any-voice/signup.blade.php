@extends('singeo.lead-gen.lead-gen-layout')

@section('styles')
    @parent

    <title>4 Exercises Guaranteed To Improve ANY Voice!</title>
    <meta name="description" content="Anyone can sing! Singeo is here to show you how in this free mini lesson series."/>

    <meta property="og:image" content="https://cdn.musora.com/image/fetch/w_1200,q_60,q_auto:best/https://singeo.s3.amazonaws.com/lead-gen/4-exercises/og-image.jpg">
    <meta property="og:title" content="4 Exercises Guaranteed To Improve ANY Voice!">
    <meta property="og:description" content="Anyone can sing! Singeo is here to show you how in this free mini lesson series.">
    <meta property="og:url" content="https://www.singeo.com/improve-any-voice/">

    <link rel="stylesheet" href="{{ asset('/marketing/parcel/singeo/animate.css') }}">
    <link rel="stylesheet" href="{{ asset('/marketing/parcel/singeo/lead-gen.css') }}">

    <style>
        .hero-header {
            background-position: center top;
            background-size: 470px;
            background-image: url('https://cdn.musora.com/image/fetch/w_900,q_60,q_auto:best/https://singeo.s3.amazonaws.com/lead-gen/4-exercises/header-mobile.png');
        }

        @media (min-width: 768px) {
            .hero-header {
                background-size: 1300px;
                background-image: url('https://cdn.musora.com/image/fetch/w_2900,q_60,q_auto:best/https://singeo.s3.amazonaws.com/lead-gen/4-exercises/header-desktop.png');
            }
        }

        @media (min-width: 1024px) {
            .hero-header {
                background-size: 1450px;
            }
        }
    </style>
@stop
@section('scripts')
    <script type="text/javascript" src="/marketing/parcel/singeo/modal-autoplay.js"></script>
@stop

@section('body')
    <header class="hero-header text-white text-center px-4 py-6 md:py-20 lg:py-36 relative bg-no-repeat" style="background-color:#010c16;">
        <div class="container mx-auto relative z-10 max-w-5xl">
            <div class="flex flex-wrap items-center">
                <div class="w-full md:w-5/12 md:order-1">
                    <i data-open="trailer" class="fas fa-play play-button autoplay-video mt-44 mb-4 md:m-0" aria-controls="trailer" aria-haspopup="true" tabindex="0"></i>
                </div>
                <div class="w-full md:w-7/12 lg:text-left">
                    <h1 class="leading-tight"><strong>4 Exercises Guaranteed<br class="inline sm:hidden lg:inline"> To Improve ANY Voice!</strong></h1>
                    <h3 class="mt-2 md:mt-5 mb-3 md:mb-7 lg:mb-10" style="text-shadow: 0 0 5px #000;"><em>You CAN sing! We'll show you how.</em></h3>
                    <h5 class="mb-3 md:mb-5 leading-tight">Simply enter your email to<br class="inline lg:hidden"> unlock your FREE videos!</h5>
                    @include("singeo.lead-gen.partials._sign-up-form-cio", [
                    "formId" => "Singeo - Engagement - Trigger - 4 Exercises - Web Form",
                    "formName" => 'Improve Any Voice',
                    "buttonText" => "Send My Videos",
                    "oneLineLg" => true,
                    ])
                </div>
            </div>
        </div>
    </header>

    @include('singeo.lead-gen.partials._video-player',[
        "id" => "trailer",
        "code" => "545534938"
    ])

    @include('singeo.lead-gen.partials._video-player',[
        "id" => "lesson1",
        "code" => "543823396"
    ])

    <section class="text-white text-center clearfix px-3 md:px-4 py-7 md:py-12 lg:py-16" style="background-color:#010611;">
        <div class="container mx-auto">
            <div class="flex flex-wrap text-left mx-auto" style="max-width:1200px">
                @php
                    $lessons = [
                        [
                            'img' => 'https://singeo.s3.amazonaws.com/lead-gen/4-exercises/thumb-1.png',
                            'title' => 'Vocal Lesson #1 - Start Here',
                            'titleColor' => '#f6d31a',
                            'desc' => 'Why You Need To<br class="hidden md:inline"> Exercise Your Voice',
                            'playButton' => true,
                            'data' => 'lesson1'
                        ],
                        [
                            'img' => 'https://singeo.s3.amazonaws.com/lead-gen/4-exercises/thumb-2.png',
                            'title' => 'Vocal Lesson #2',
                            'titleColor' => '#f51a93',
                            'desc' => 'The Most Useful<br class="hidden md:inline"> Vocal Exercise'
                        ],
                        [
                            'img' => 'https://singeo.s3.amazonaws.com/lead-gen/4-exercises/thumb-3.png',
                            'title' => 'Vocal Lesson #3',
                            'titleColor' => '#50e49e',
                            'desc' => 'The Perfect<br class="hidden md:inline"> Balance Exercise'
                        ],
                        [
                            'img' => 'https://singeo.s3.amazonaws.com/lead-gen/4-exercises/thumb-4.png',
                            'title' => 'Vocal Lesson #4',
                            'titleColor' => '#19b2f6',
                            'desc' => 'The Strength Building,<br class="hidden md:inline"> Pitch Accuracy Exercise'
                        ],
                        [
                            'img' => 'https://singeo.s3.amazonaws.com/lead-gen/4-exercises/thumb-5.png',
                            'title' => 'Vocal Lesson #5',
                            'titleColor' => '#ff1c52',
                            'desc' => 'The Range<br class="hidden md:inline"> Builder Exercise'
                        ],
                        [
                            'img' => 'https://singeo.s3.amazonaws.com/lead-gen/4-exercises/thumb-6.png',
                            'title' => 'Vocal Lesson #6',
                            'titleColor' => '#ff6900',
                            'desc' => 'The Full Vocal<br class="hidden md:inline"> Routine'
                        ],
                    ];
                @endphp

                @include('singeo.lead-gen.partials._lesson-tiles1')
            </div>
        </div>
    </section>

    <section class="final-pitch px-4 py-14 md:py-20 lg:py-24 text-white text-center bg-cover bg-center" style="background-image:url(https://cdn.musora.com/image/fetch/w_1500,q_60,q_auto:best/https://singeo.s3.amazonaws.com/lead-gen/4-exercises/bottom-background.png);">
        <div class="container mx-auto">
            <h3 class="mb-5 md:mb-8 lg:mb-10"><strong>Simply enter your email to<br class="inline lg:hidden"> unlock your FREE videos!</strong></h3>
            <div class="w-full mx-auto max-w-lg lg:max-w-3xl">
                @include("singeo.lead-gen.partials._sign-up-form-cio", [
                    "formId" => "Singeo - Engagement - Trigger - 4 Exercises - Web Form",
                    "formName" => 'Improve Any Voice',
                    "buttonText" => "Send My Videos",
                    "oneLineLg" => true,
                    ])
            </div>
        </div>
    </section>


@stop
