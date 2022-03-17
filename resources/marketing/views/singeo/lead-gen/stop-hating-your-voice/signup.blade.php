@extends('singeo.lead-gen.lead-gen-layout')

@section('styles')
    @parent

    <title>4 Exercises Guaranteed To Improve ANY Voice!</title>
    <meta name="description" content="Anyone can sing! Singeo is here to show you how in this free mini lesson series."/>

    <meta property="og:image" content="https://cdn.musora.com/image/fetch/w_1200,q_60,q_auto:best/https://singeo.s3.amazonaws.com/lead-gen/4-exercises/og-image.jpg">
    <meta property="og:title" content="4 Exercises Guaranteed To Improve ANY Voice!">
    <meta property="og:description" content="Anyone can sing! Singeo is here to show you how in this free mini lesson series.">
    <meta property="og:url" content="https://www.singeo.com/stop-hating-your-voice/">

    <link rel="stylesheet" href="{{ asset('/assets/css/animate.css') }}">
    <link rel="stylesheet" href="{{ asset('/assets/marketing/lead-gen.css') }}">
    <style>
        @media (min-width: 768px) {
            .hero-header {
                background-size:1500px;
            }
        }
        @media (min-width: 1024px) {
            .hero-header {
                background-size:1600px;
            }
        }
    </style>
@stop

@section('scripts')
    <script type="text/javascript" src="/assets/js/modal-autoplay.js"></script>
@stop

@section('body')
    <header class="hero-header text-white text-center px-4 md:px-6 py-6 md:py-12 lg:py-16 relative bg-no-repeat lazyload" style="background-color:#010c16;" data-bg="https://singeo.s3.amazonaws.com/lead-gen/stop-hating-your-voice/header-bg.jpg">
        <div class="container mx-auto relative z-10 max-w-4xl">
            <div class="flex flex-wrap items-center">
                {{--<div class="w-full md:w-5/12 md:order-1">--}}
                    {{--<i data-open="trailer" class="fas fa-play play-button autoplay-video mt-44 mb-4 md:m-0" aria-controls="trailer" aria-haspopup="true" tabindex="0"></i>--}}
                {{--</div>--}}
                <div class="w-full md:w-1/2 lg:w-5/12">
                    <img class="h-24 md:h-36" src="https://singeo.s3.amazonaws.com/lead-gen/stop-hating-your-voice/logo.png">
                    <h5 class="leading-tight mt-2 mb-3 md:mb-4">Learn to love your voice<br> <strong>in 3 easy lessons!</strong></h5>
                    <p class="mb-3 md:mb-5 leading-normal text-navy">Hate your voice? You’re not alone. But the voice you think you have now is NOTHING like the potential lurking inside you. </p>
                    @include("singeo.lead-gen.partials._sign-up-form-cio", [
                    "formId" => "Singeo - Engagement - Trigger - 4 Exercises - Web Form",
                    "formName" => 'Improve Any Voice',
                    "buttonText" => "Send My Lessons",
                    ])
                </div>
            </div>
        </div>
    </header>
    <div class="reveal trailer text-center max-w-2xl" id="trailer" data-reveal data-reset-on-close="false">
        <div class="aspect-16:9 w-full relative">
            <iframe class="absolute w-full h-full reset-on-close" src="" data-lazy-load-url="//player.vimeo.com/video/545534938?autoplay=1" frameborder="0" allowfullscreen allow="autoplay"></iframe>
        </div>
    </div>

    <section class="px-4 py-14 md:py-20 lg:py-24 text-white text-center" style="background-color:#150f32;">
        <div class="container mx-auto">
            <h3><strong>Why you hate your voice</strong><br>
                <em>(and how to fix it)</em></h3>
            <p>You ARE an instrument. When you sing, your body acts as a soundboard. And when you FEEL sound, it changes the way you HEAR it. That’s why there’s such a disconnect between the sound you hear in your head, and what you hear in the recording.<br><br>
            And that’s why you hate your voice. It’s a shock!<br><br>
            But enough about the why. We’re interested in how to make you sound BETTER and ultimately fall in love with your voice. And it’s 100% possible.<br><br>
                <strong>Here’s how:</strong></p>
        </div>
    </section>
    
    <section class="text-white text-center clearfix px-3 md:px-4 py-7 md:py-12 lg:py-16" style="background:linear-gradient(to bottom, #011029, #010414);  ">
        <div class="container mx-auto">
            <h3><strong>Start LOVING your voice in 3 easy lessons</strong></h3>
            <h6 class="text-navy mt-3 mb-8 leading-normal">Simple exercises that will transform your sound.</h6>
            <div class="flex flex-wrap text-left mx-auto" style="max-width:1200px">
                <div class="flex flex-auto w-full md:w-1/2 lg:w-1/3 px-2 md:px-3 mb-7 md:mb-10 step">
                    <div class="rounded-xl overflow-hidden" style="background: linear-gradient(to bottom, #0e2834 56%, #16102b); ">
                        <img class="w-full" src="https://cdn.musora.com/image/fetch/w_800,q_auto:best/https://guitareo.s3.amazonaws.com/lead-gen/free-acoustic-guitar-lessons/thumbs-acoustic-01.jpg">
                        <h6 class="px-4 mt-4 mb-2 uppercase "><strong>IT’S NORMAL!</strong></h6>

                        <p class="px-4 pb-4 opacity-70">Everyone hates their voice. But it’s completely normal! In this lesson, you’ll learn the ONE thing you can do that will instantly make you sound better.</p>
                    </div>
                </div>
                <div class="flex flex-auto w-full md:w-1/2 lg:w-1/3 px-2 md:px-3 mb-7 md:mb-10 step">
                    <div class="rounded-xl overflow-hidden" style="background: linear-gradient(to bottom, #0e2834 56%, #16102b); ">
                        <img class="w-full" src="https://cdn.musora.com/image/fetch/w_800,q_auto:best/https://guitareo.s3.amazonaws.com/lead-gen/free-acoustic-guitar-lessons/thumbs-acoustic-02.jpg">
                        <h6 class="px-4 mt-4 mb-2 uppercase "><strong>GET CONTROL</strong></h6>

                        <p class="px-4 pb-4 opacity-70">Your voice uses muscles. And when you strengthen them, you gain control of how you sound. This lesson will show you how to sing stronger, and sound better.</p>
                    </div>
                </div>
                <div class="flex flex-auto w-full md:w-1/2 lg:w-1/3 px-2 md:px-3 mb-7 md:mb-10 step">
                    <div class="rounded-xl overflow-hidden" style="background: linear-gradient(to bottom, #0e2834 56%, #16102b); ">
                        <img class="w-full" src="https://cdn.musora.com/image/fetch/w_800,q_auto:best/https://guitareo.s3.amazonaws.com/lead-gen/free-acoustic-guitar-lessons/thumbs-acoustic-03.jpg">
                        <h6 class="px-4 mt-4 mb-2 uppercase "><strong>FIND YOUR NEW VOICE</strong></h6>

                        <p class="px-4 pb-4 opacity-70">Put your exercises to work and sing a real song. Notice how much better and more confident you’ll sound after only a few short lessons!</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="px-4 py-14 md:py-20 lg:py-24 text-white text-center" style="background-color:#150f32;">
        <div class="container mx-auto">
            <h3><strong>Your first steps to a stronger, more confident voice…</strong></h3>
            <div class="flex flex-wrap justify-center">
                <div class="w-full sm:w-1/3 px-3 sm:px-4">
                    <img src="">
                    <h6><strong>STEP-BY-STEP LESSONS</strong></h6>
                    <p>Learn the right things in order. No guesswork.</p>
                </div>
                <div class="w-full sm:w-1/3 px-3 sm:px-4">
                    <img src="">
                    <h6><strong>BONUS RESOURCES</strong></h6>
                    <p>Backing tracks to help you practice and improve.</p>
                </div>
                <div class="w-full sm:w-1/3 px-3 sm:px-4">
                    <img src="">
                    <h6><strong>HELP WHEN YOU NEED</strong></h6>
                    <p>Questions? Help is just an email away.</p>
                </div>
            </div>
        </div>
    </section>

    <section class="px-4 py-14 md:py-20 lg:py-24 text-white text-center bg-cover bg-center" style="background-image:url(https://cdn.musora.com/image/fetch/w_1500,q_60,q_auto:best/https://singeo.s3.amazonaws.com/lead-gen/4-exercises/bottom-background.png);">
        <div class="container mx-auto">
            <img class="mb-10" src="">
            <p>Lisa is the lead instructor at Singeo and arguably the happiest vocal coach on the planet!<br><br>
                With a background in classical and contemporary vocal training and a love for popular music, Lisa focuses on helping you find and fall in love with your unique voice.<br><br>
                You’ll be inspired and smiling from the very first lesson.<br><br>
                And you’ll be smiling even more once you hear the change in how you sound!</p>
        </div>
    </section>

    <section class="final-pitch px-4 py-14 md:py-20 lg:py-24 text-white text-center bg-cover bg-center" style="background-image:url(https://cdn.musora.com/image/fetch/w_1500,q_60,q_auto:best/https://singeo.s3.amazonaws.com/lead-gen/4-exercises/bottom-background.png);">
        <div class="container mx-auto">
            <img class="h-36" src="https://singeo.s3.amazonaws.com/lead-gen/stop-hating-your-voice/logo.png">
            <h4 class="leading-tight">Learn to love your voice <strong>in 3 easy lessons!</strong></h4>
            <p class="mb-3 md:mb-5 leading-tight text-navy">Enter your email below to get 3 free vocal lessons that will teach you to stop hating your voice...</p>
            <div class="w-full mx-auto max-w-lg lg:max-w-3xl">
                @include("singeo.lead-gen.partials._sign-up-form-cio", [
                    "formId" => "Singeo - Engagement - Trigger - 4 Exercises - Web Form",
                    "formName" => 'Improve Any Voice',
                    "buttonText" => "Send My Lessons",
                    "oneLineLg" => true,
                    ])
            </div>
        </div>
    </section>


@stop