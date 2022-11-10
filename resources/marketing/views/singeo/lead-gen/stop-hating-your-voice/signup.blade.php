@extends('singeo.lead-gen.lead-gen-layout')

@section('styles')
    @parent

    <title>How To Stop Hating Your Voice | Singeo</title>
    <meta property="og:title" content="How To Stop Hating Your Voice">
    <meta name="description" content="Learn to love your voice in 3 easy lessons!"/>
    <meta property="og:description" content="Learn to love your voice in 3 easy lessons!">
    <meta property="og:image" content="https://cdn.musora.com/image/fetch/w_1200,q_60,q_auto:best/https://singeo.s3.amazonaws.com/lead-gen/stop-hating-your-voice/fb-share-image.jpg">
    <meta property="og:url" content="https://www.singeo.com/stop-hating-your-voice/">

    <link rel="stylesheet" href="{{ asset('/marketing/css/animate.css') }}">
    <link rel="stylesheet" href="{{ asset('/marketing/parcel/singeo/lead-gen.css') }}">
    <style>

        .header {
            background-position: 75% top;
            background-size: 780px;
        }
        @media (min-width:768px) {
            .header {
                background-position: center top;
                background-size:1540px;
            }
        }

        @media (min-width:1024px) {
            .header {
                background-size:1630px;
            }
        }

        .lisa-bio {
            background-size: 620px;
            background-position: 85% top;
        }

        @media (min-width:768px) {
            .lisa-bio {
                background-size: cover;
                background-position:50% 0;

            }
        }
    </style>
@stop
@section('scripts')
    <script type="text/javascript" src="/marketing/js/modal-autoplay.js"></script>
@stop

@section('body')
    <header class="header text-white text-center px-3 md:px-6 pt-40 pb-4 md:py-5 lg:py-7 relative bg-no-repeat lazyload" style="background-color:#160431;" data-bg="https://cdn.musora.com/image/fetch/w_2000,q_auto:best/https://singeo.s3.amazonaws.com/lead-gen/stop-hating-your-voice/header-bg.jpg">
        <div class="container mx-auto relative z-20 max-w-4xl">
            <div class="flex flex-wrap items-center">
                <div class="w-full md:w-1/2 lg:w-6/12 md:order-1 md:mt-40">
                    <i data-open="trailer" class="fas fa-play play-button autoplay-video mb-4 md:m-0" aria-controls="trailer" aria-haspopup="true" tabindex="0"></i>
                </div>
                <div class="w-full md:w-1/2 lg:w-6/12">
                    <img class="h-24 md:h-36" src="https://cdn.musora.com/image/fetch/w_500,q_auto:best/https://singeo.s3.amazonaws.com/lead-gen/stop-hating-your-voice/logo.png">
                    <h5 class="leading-tight mt-2 mb-2">Learn to love your voice<br> <strong>in 3 easy lessons!</strong></h5>
                    <p class="mb-3 md:mb-3 leading-normal text-navy">Do you cringe when you hear your voice on a recording? Do you love singing but don’t like your voice? You’re not alone. But there’s good news. The voice you think you have now is NOTHING like the potential lurking inside you. Simply enter your email below to get 3 free vocal lessons that will teach you to stop hating your voice...</p>
                    @include("singeo._partials._sign-up-form", [
                    "formId" => "Singeo - Engagement - Trigger - Stop Hating Your Voice - Web Form",
                    "formName" => 'Stop Hating Your Voice',
                    "buttonText" => "Send My Lessons",
                    "noTy" => true
                    ])

                    <div class="thank-you-box w-full rounded-lg mx-auto bg-white text-center text-black max-w-2xl transition-all duration-700 block overflow-hidden invisible max-h-0 opacity-0">
                        <h5 class="mx-auto mb-3"><strong><i class="fas fa-check"></i> Success!</strong></h5>
                        <div data-tf-widget="g77ZK0V0" data-tf-iframe-props="title=Stop Hating Your Voice Question" data-tf-medium="snippet" style="width:100%;height:400px;"></div>
                        <script src="//embed.typeform.com/next/embed.js"></script>
                    </div>
                </div>
            </div>
        </div>
        <div class="absolute inset-0 z-10 block md:hidden" style="background:linear-gradient(to bottom, transparent 25%, #160431 40%);"></div>
    </header>

    @include('singeo.lead-gen.partials._video-player',[
        "id" => "trailer",
        "code" => "682918726"
    ])

    <section class="px-4 sm:px-6 py-12 md:py-14 lg:py-20 text-white text-center lazyload bg-top bg-no-repeat bg-contain" style="background-color:#000c17;" data-bg="https://cdn.musora.com/image/fetch/w_1200,q_auto:best/https://singeo.s3.amazonaws.com/lead-gen/stop-hating-your-voice/introduction-bg.jpg">
        <div class="container mx-auto">
            <h4 class="leading-normal"><strong>Why you hate your voice</strong><br>
                <em>(and how to fix it)</em></h4>
            <p class="text-navy mt-3 sm:mt-6 mb-8 sm:mb-16 max-w-2xl">You ARE an instrument. When you sing, your body acts as a soundboard. And when you FEEL sound, it changes the way you HEAR it. That’s why there’s such a disconnect between the sound you hear in your head, and what you hear in the recording.<br><br>
            And that’s why you hate your voice. It’s a shock!<br><br>
            But enough about the why. We’re interested in how to make you sound BETTER and ultimately fall in love with your voice. And it’s 100% possible.<br><br>
                <strong>Here’s how:</strong></p>

            <h4><strong>Start LOVING your voice in 3 easy lessons</strong></h4>
            <p class="text-navy mt-3 mb-8 leading-normal">Simple exercises that will transform your sound.</p>
            @php
                $lessons = [
                    [
                        'img' => 'https://singeo.s3.amazonaws.com/lead-gen/stop-hating-your-voice/its-normal-thumb.jpg',
                        'title' => 'IT’S NORMAL!',
                        'desc' => 'Everyone hates their voice. But it’s completely normal! In this lesson, you’ll learn the ONE thing you can do that will instantly make you sound better.',
                        'href' => '/stop-hating-your-voice/lessons/1'
                    ],
                    [
                        'img' => 'https://singeo.s3.amazonaws.com/lead-gen/stop-hating-your-voice/get-control-thumb.jpg',
                        'title' => 'GET CONTROL',
                        'desc' => 'Your voice uses muscles. And when you strengthen them, you gain control of how you sound. This lesson will show you how to sing stronger, and sound better.',
                        'href' => '/stop-hating-your-voice/lessons/2'
                    ],
                    [
                        'img' => 'https://singeo.s3.amazonaws.com/lead-gen/stop-hating-your-voice/find-your-new-voice-thumb.jpg',
                        'title' => 'FIND YOUR NEW VOICE',
                        'desc' => 'Put your exercises to work and sing a real song. Notice how much better and more confident you’ll sound after only a few short lessons!',
                        'href' => '/stop-hating-your-voice/lessons/3'
                    ],
                ];
            @endphp

            <div class="flex flex-wrap justify-center text-left mx-auto max-w-2xl lg:max-w-5xl">
                @foreach ($lessons as $lesson)
                    <div class="flex lg:flex-auto w-full md:w-1/2 lg:w-1/3 px-2 md:px-3 mb-7 md:mb-10 step">
                        <div class="rounded-xl overflow-hidden" style="background: linear-gradient(to bottom, #153044 56%, #252646); ">
                            <img class="w-full lazyload" data-src="https://cdn.musora.com/image/fetch/w_800,q_auto:best/{{ $lesson['img'] }}">
                            <h4 class="px-4 mt-4 mb-2 uppercase font-bebas">{{ $lesson['title'] }}</h4>

                            <p class="px-4 pb-4 opacity-70">{!! $lesson['desc'] !!}</p>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <section class="px-4 py-12 md:py-20 lg:py-24 text-white text-center" style="background-color:#150f32;">
        <div class="container mx-auto max-w-4xl">
            <h4 class="leading-normal mb-5 sm:mb-10"><strong>Your first steps to a stronger,<br class="inline sm:hidden"> more confident voice…</strong></h4>
            <div class="flex flex-wrap justify-center">
                <div class="w-full sm:w-1/3 px-3 sm:px-4 mb-6 sm:mb-0">
                    <img class="h-12" src="https://singeo.s3.amazonaws.com/lead-gen/stop-hating-your-voice/step-by-step-icon.svg">
                    <h6 class="mt-6 mb-2"><strong>STEP-BY-STEP LESSONS</strong></h6>
                    <p class="text-navy">Learn the right things in order. No guesswork.</p>
                </div>
                <div class="w-full sm:w-1/3 px-3 sm:px-4 mb-6 sm:mb-0">
                    <img class="h-12" src="https://singeo.s3.amazonaws.com/lead-gen/stop-hating-your-voice/music-icon.svg">
                    <h6 class="mt-6 mb-2"><strong>BONUS RESOURCES</strong></h6>
                    <p class="text-navy">Backing tracks to help you practice and improve.</p>
                </div>
                <div class="w-full sm:w-1/3 px-3 sm:px-4">
                    <img class="h-12" src="https://singeo.s3.amazonaws.com/lead-gen/stop-hating-your-voice/question-icon.svg">
                    <h6 class="mt-6 mb-2"><strong>HELP WHEN YOU NEED</strong></h6>
                    <p class="text-navy">Questions? Help is just an email away.</p>
                </div>
            </div>
        </div>
    </section>
    <section class="lisa-bio text-white pt-44 pb-6 md:py-28 lg:py-32 px-4 sm:px-6 relative bg-no-repeat lazyload" style="background-color:#000c17;" data-bg="https://cdn.musora.com/image/fetch/w_1900,q_auto:best/https://singeo.s3.amazonaws.com/lead-gen/stop-hating-your-voice/coach-bg.jpg">
        <div class="container mx-auto max-w-3xl relative z-20">
            <div class="md:flex flex-wrap md:w-7/12 text-center sm:text-left">
                <img class="h-16 sm:h-24 lg:h-32 mx-auto sm:mx-0 mb-4 sm:mb-6 lg:mb-8 lazyload" data-src="https://cdn.musora.com/image/fetch/w_1500,q_auto:best/https://singeo.s3.amazonaws.com/lead-gen/stop-hating-your-voice/meet-lisa.png">
                <p class="leading-normal md:leading-relaxed text-left text-navy">Lisa is the lead instructor at Singeo and arguably the happiest vocal coach on the planet!<br><br>
                    With a background in classical and contemporary vocal training and a love for popular music, Lisa focuses on helping you find and fall in love with your unique voice.<br><br>
                    You’ll be inspired and smiling from the very first lesson.<br><br>
                    And you’ll be smiling even more once you hear the change in how you sound!</p>
            </div>
        </div>
        <div class="absolute inset-0 z-10 block md:hidden" style="background:linear-gradient(to bottom, transparent 25%, #000c17 50%);"></div>
    </section>
    <section class="final-pitch px-4 py-14 md:py-20 lg:py-24 text-white text-center bg-cover bg-center lazyload" data-bg="https://cdn.musora.com/image/fetch/w_1500,q_auto:best/https://singeo.s3.amazonaws.com/lead-gen/stop-hating-your-voice/order-bg.jpg">
        <div class="container mx-auto">
            <img class="h-20 sm:h-32 lg:h-44" src="https://cdn.musora.com/image/fetch/w_500,q_auto:best/https://singeo.s3.amazonaws.com/lead-gen/stop-hating-your-voice/logo.png">
            <h4 class="leading-tight my-5">Learn to love your voice <strong>in 3 easy lessons!</strong></h4>
            <p class="mb-3 md:mb-5 leading-tight">Enter your email below to get 3 free vocal lessons that will teach you to stop hating your voice...</p>
            <div class="w-full mx-auto max-w-lg lg:max-w-3xl">
                @include("singeo._partials._sign-up-form", [
                    "formId" => "Singeo - Engagement - Trigger - Stop Hating Your Voice - Web Form",
                    "formName" => 'Stop Hating Your Voice',
                    "buttonText" => "Send My Lessons",
                    "oneLineLg" => true,
                    "noTy" => true
                    ])

                <div class="thank-you-box w-full rounded-lg mx-auto bg-white text-center text-black max-w-2xl transition-all duration-700 block overflow-hidden invisible max-h-0 opacity-0">
                    <h5 class="mx-auto mb-3"><strong><i class="fas fa-check"></i> Success!</strong></h5>
                    <div data-tf-widget="g77ZK0V0" data-tf-iframe-props="title=Stop Hating Your Voice Question" data-tf-medium="snippet" style="width:100%;height:400px;"></div>
                    <script src="//embed.typeform.com/next/embed.js"></script>
                </div>
            </div>
        </div>
    </section>


@stop
