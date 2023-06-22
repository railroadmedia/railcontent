@php
    require_once(resource_path('marketing/views/drumeo/lead-gen/getting-started/signup-data.php'))
@endphp

@extends('drumeo._partials.global-layout')

@section('global-head')
    <title>Getting Started On The Drums | Drumeo</title>
    <meta property="og:title" content="Getting Started On The Drums | Drumeo">

    <meta name="description" content="Just starting out on the drums? Want to rebuild your foundation? Try Jared Falk's free video series!">
    <meta property="og:description" content="Just starting out on the drums? Want to rebuild your foundation? Try Jared Falk's free video series!">

    <meta property="og:image" content="https://drumeo-assets.s3.amazonaws.com/lead-gen/gsotd/updated/share-image.jpg" style="display: none;">
    <meta property="og:url" content="https://www.drumeo.com/getting-started/">

    @include('_partials.layout._fonts')

    <link rel="stylesheet" href="{{ mix('marketing/css/app.css') }}">
    <link href="{{ asset('/marketing/css/tailwind-helpers.css') }}" rel="stylesheet">
    <link href="{{ asset('/marketing/parcel/drumeo/navigation-sales.css') }}" rel="stylesheet">
    <link href="{{ asset('/marketing/parcel/drumeo/lead-gen-tw.css') }}" rel="stylesheet">

    <style>
        h3 {
            font-size: 21px;
        }

        @media (min-width: 768px){
            h3 {
                font-size:24px;
            }
        }

        @media (min-width: 1024px) {
            h3 {
                font-size: 30px;
            }
        }
    </style>
@stop

@section('global-body')
    @include("drumeo.sales.partials._nav")

    <header class="py-12 sm:py-20" style="background: linear-gradient(225deg, #15C5FD 0%, #BBFFEF 100%);">
        <div class="max-w-6xl mx-auto sm:flex items-center container px-4 text-center sm:text-left">
            <div class="w-full sm:w-1/2 max-w-xl mx-auto sm:max-w-full">
                <div class="px-2 sm:pl-3 lg:pr-20 xl:pr-28">
                    <img
                        class="h-20 lg:h-24 mb-3"
                        src="https://www.musora.com/musora-cdn/image/width=500,quality=85/https://drumeo-assets.s3.amazonaws.com/lead-gen/gsotd/updated/GSOTD-dark-blue.png"
                        alt="GSOTD logo"
                        fetchpriority="high"
                    />
                    <h3 class="leading-tight mb-5">Go from a <strong>total beginner</strong> to playing your <strong>first drum beats</strong> in this <u>FREE</u> series.</h3>
                    <div class="max-w-sm mx-auto sm:hidden mb-5">
                        <img
                            src="https://www.musora.com/musora-cdn/image/width=600,quality=85/https://drumeo-assets.s3.amazonaws.com/lead-gen/gsotd/updated/header-collage.png"
                            alt="header hero image mobile"
                            fetchpriority="high"
                        />
                    </div>
                    <h6 class="mb-4">Enter your email below for your 12 free lessons:</h6>
                </div>
                <div class="lg:pr-20 xl:pr-28">
                @include("drumeo.lead-gen.partials.sign-up-form", [
                    "formId" => "Drumeo - Engagement - Trigger - GSOTD - Web Form",
                    "formName" => 'Getting Started On The Drums',
                    "buttonText" => "Get started for free",
                    'stacked' => true,
                    "redirectURL" => "/getting-started/thank-you/",
                    "recaptchaKey" => $recaptchaKey
                ])
                </div>
            </div>
            <div class="w-full sm:w-1/2 hidden sm:block">
                <img
                    class="transition-opacity opacity-0"
                    src="https://www.musora.com/musora-cdn/image/width=700,quality=85/https://drumeo-assets.s3.amazonaws.com/lead-gen/gsotd/updated/header-collage.png"
                    alt="header hero image"
                    loading="lazy"
                    onload="this.classList.remove('opacity-0')"
                />
            </div>
        </div>
    </header>

    <section class="py-12 sm:py-20 px-4 text-center">
        <div class="container max-w-6xl mx-auto">
            <h2 class="font-extrabold mb-4">Get started even if you don’t have drums yet.</h2>
            <p class="mb-10">
                Getting Started On The Drums includes <b>3 learning paths</b> to help you start <br class="hidden md:inline">without drums, help you buy drums, AND start playing on a full kit.
            </p>
            <div class="flex flex-wrap justify-center mb-10 max-w-sm mx-auto md:max-w-full">
                @foreach($lessons as $key => $lesson)
                    @include('drumeo.lead-gen.getting-started.dropdown',[
                        'title' => $lesson['title'],
                        'lessonNum' => $lesson['lessonNum'],
                        'key' => $key,
                        'lessonInfo' => $lesson['lessonInfo'],
                    ])
                @endforeach
            </div>
        </div>
    </section>

    <section class="py-12 sm:py-20" style="background: #F1F7FE;">
        <div class="flex flex-wrap sm:flex-nowrap items-start justify-center sm:mt-8 sm:px-4 lg:px-0">
            <div class="-mb-16 sm:mb-0 sm:mt-10 sm:-mr-8 relative">
                <picture>
                    <source media="(min-width: 640px)" srcset="https://drumeo-assets.s3.amazonaws.com/lead-gen/gsotd/updated/coach-image.png">
                    <img
                        class="w-52 sm:w-72 md:w-96 relative z-40 transition-opacity opacity-0"
                        src="https://drumeo-assets.s3.amazonaws.com/lead-gen/gsotd/updated/coach-image-m.png"
                        alt="profile picture"
                        loading="lazy"
                        onload="this.classList.remove('opacity-0')"
                    >
                </picture>

                <picture class="w-80 sm:w-80 lg:w-96 -left-14 sm:left-0 sm:-top-6 md:top-0 absolute md:-top-7 lg:-top-10 md:-left-10">
                    <source media="(min-width: 640px)" srcset="https://drumeo-assets.s3.amazonaws.com/lead-gen/gsotd/updated/coach-splash.png">
                    <img class="transition-all opacity-0" src="https://drumeo-assets.s3.amazonaws.com/lead-gen/gsotd/updated/coach-splash-m.png" alt="splash" loading="lazy" onload="this.classList.remove('opacity-0')" />
                </picture>

            </div>
            <div class="mx-4 sm:mx-0 text-white text-left rounded-xl pt-20 pb-8 sm:py-10 lg:py-12 px-6 sm:pr-10 sm:pl-14 lg:px-14 sm:mt-8 w-full sm:w-auto sm:flex-grow max-w-sm sm:max-w-md md:max-w-lg lg:max-w-xl z-30" style="background-color:#00101d;">
                <h6 class="uppercase text-drumeo leading-normal text-[#15C5FD]">MEET YOUR TEACHER</h6>
                <h2><strong>Domino Santantonio</strong></h2>
                <h6 class="leading-normal mt-4 lg:mt-6">
                    Domino Santantonio is one of the world’s most viewed drummers.<br><br>
                    And she’s achieved this with her engaging & supportive style of drumming – always smiling and reminding you why playing the drums is so fun & healthy. Who better to jumpstart your drumming progress?<br><br>
                    Plus, Domino is also your personal guide through the course.<br><br>
                    At the end of every week, you’ll have a Q&A session with Domino where you can ask her any questions you had during the lessons.
                </h6>
                <div class="flex justify-between text-center mt-7 lg:mt-10">
                    <div class="">
                        <img class="h-6 sm:h-8 transition-all opacity-0" src="https://www.musora.com/musora-cdn/image/width=100,quality=85/https://dpwjbsxqtam5n.cloudfront.net/drum-shop/30-day-drummer/TikTok_Icon.svg" alt="tiktok icon" loading="lazy" onload="this.classList.remove('opacity-0')">
                        <h3 class="mt-2"><strong>1.6M</strong></h3>
                        <p class="uppercase opacity-70 text-sm">Followers</p>
                    </div>
                    <div class="">
                        <img class="h-6 sm:h-8 transition-all opacity-0" src="https://www.musora.com/musora-cdn/image/width=100,quality=85/https://dpwjbsxqtam5n.cloudfront.net/drum-shop/30-day-drummer/Insta_Icon.svg" alt="insta icon" loading="lazy" onload="this.classList.remove('opacity-0')">
                        <h3 class="mt-2"><strong>460K</strong></h3>
                        <p class="uppercase opacity-70 text-sm">followers</p>
                    </div>
                    <div class="">
                        <img class="h-6 sm:h-8 transition-all opacity-0" src="https://www.musora.com/musora-cdn/image/width=100,quality=85/https://dpwjbsxqtam5n.cloudfront.net/drum-shop/30-day-drummer/Youtube_Icon.svg" alt="youtube icon" loading="lazy" onload="this.classList.remove('opacity-0')">
                        <h3 class="mt-2"><strong>224M</strong></h3>
                        <p class="uppercase opacity-70 text-sm">views</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    @include('drumeo.lead-gen.partials.quick-questions', [
        'textColor' => 'white',
        'bgColor' => 'linear-gradient(180deg, #01050F 0%, #032546 100%);'
    ])

    <section class="py-8 sm:py-14 text-center relative">
        <img class="absolute top-0 left-0 w-full h-full transition-opacity opacity-0 object-cover" src="https://drumeo-assets.s3.amazonaws.com/lead-gen/gsotd/updated/order-bg.jpg" alt="order-bg" loading="lazy" onload="this.classList.remove('opacity-0')" />
        <div class="max-w-3xl mx-auto z-50 relative">
            <img class="h-16 lg:h-24 transition-all opacity-0" src="https://www.musora.com/musora-cdn/image/width=400,quality=85/https://drumeo-assets.s3.amazonaws.com/lead-gen/gsotd/updated/GSOTD-dark-blue.png" alt="GSTOD logo" loading="lazy" onload="this.classList.remove('opacity-0')" />
            <h5 class="my-5 sm:my-7 font-bold">Enter your email to receive 12 free lessons.</h5>
            <div class="max-w-sm mx-auto sm:max-w-none">
            @include("drumeo.lead-gen.partials.sign-up-form", [
                "formId" => "Drumeo - Engagement - Trigger - GSOTD - Web Form",
                "formName" => 'Getting Started On The Drums',
                "buttonText" => "Get started for free ",
                    "redirectURL" => "/getting-started/thank-you/",
                    "recaptchaKey" => $recaptchaKey
            ])
            </div>
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

    @include("drumeo.sales.partials._footer", [
            "minimal" => true
        ])

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script defer src="{{ asset('/marketing/parcel/drumeo/navigation-sales.js') }}"></script>
    <script type="text/javascript" src="{{ asset('/marketing/js/modal.js') }}"></script>
    <script>
        $(document).ready(function () {
            $(document).foundation();
        });
    </script>
    <script defer src="{{ asset('/marketing/js/pre-form-submit-facebook-lead.js') }}"></script>
    <script defer src="{{ asset('/marketing/js/drumeo/infusionsoft-tracking.js') }}"></script>
@stop
