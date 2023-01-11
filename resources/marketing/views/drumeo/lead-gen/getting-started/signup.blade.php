@extends('drumeo._partials.global-layout')

@section('global-head')
    <title>Getting Started On The Drums | Drumeo</title>
    <meta property="og:title" content="Getting Started On The Drums | Drumeo">

    <meta name="description" content="Just starting out on the drums? Want to rebuild your foundation? Try Jared Falk's free video series!">
    <meta property="og:description" content="Just starting out on the drums? Want to rebuild your foundation? Try Jared Falk's free video series!">

    <meta property="og:image" content="https://dpwjbsxqtam5n.cloudfront.net/lead-gen/gsotd/og-image.jpg" style="display: none;">
    <meta property="og:url" content="https://www.drumeo.com/getting-started/">

    @include('_partials.layout._fonts')

    @include('_partials.layout._tailwindcdn')
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

    <header class="pt-8 sm:pt-20">
        <div class="max-w-xl md:max-w-4xl mx-auto flex flex-col md:flex-row px-3 sm:px-4 lg:px-0 text-center md:text-left">
            <div class="w-full md:w-7/12 lg:w-1/2">
                <div class="md:px-2">
                    <picture>
                        <source media="(min-width:768px)" srcset="https://cdn.musora.com/image/fetch/w_650,q_auto:best/https://drumeo-assets.s3.amazonaws.com/lead-gen/getting-started/logo_left_black.png">
                        <img class="h-10 md:h-14 mb-6 lazyload" data-src="https://cdn.musora.com/image/fetch/w_650,q_auto:best/https://drumeo-assets.s3.amazonaws.com/lead-gen/getting-started/logo_centre_black.png" alt="getting started logo">
                    </picture>

                    <img class="md:hidden object-cover h-full w-full rounded-lg mb-6 lazyload" data-src="https://cdn.musora.com/image/fetch/w_1500/https://drumeo-assets.s3.amazonaws.com/lead-gen/getting-started/E-mail.jpg" alt="jared email">

                    <h3 class="font-extrabold leading-tight">
                        Go from a total beginner to playing your first drum beats in this FREE series.
                    </h3>
                    <h6 class="my-4" style="color: rgba(0, 0, 0, 0.8);">
                        Enter your email below for your 10 free lessons.
                    </h6>
                </div>

                @include("drumeo.lead-gen.partials.sign-up-form-tw", [
                    "formId" => "Drumeo - Engagement - Trigger - GSOTD - Web Form",
                    "formName" => 'Getting Started On The Drums',
                    "buttonText" => "Get started for free ",
                    'stacked' => true,
                    'inputBorder' => '1px solid #7A8491',
                    "redirectURL" => "/getting-started/thank-you/"
                ])
            </div>
            <div class="w-full sm:w-5/12 lg:w-1/2">
                <div class="px-4 lg:px-10 h-full w-full">
                    <img class="hidden md:inline-block object-cover h-full w-full rounded-lg lazyload" data-src="https://cdn.musora.com/image/fetch/w_860,q_auto:best/https://drumeo-assets.s3.amazonaws.com/lead-gen/getting-started/E-mail.jpg" alt="jared email">
                </div>
            </div>

        </div>
    </header>

    <section class="py-20">
        <div class="max-w-lg sm:max-w-4xl lg:max-w-6xl mx-auto">
            <p class="text-center text-xs uppercase mb-2 sm:mb-4 tracking-widest" style="color: #ABB5C2;">
                What you'll get
            </p>
            <h3 class="text-center leading-tight font-extrabold mb-10 px-2 sm:px-0">
                10 beginner drum lessons to set <br>
                yourself up for success behind the kit.
            </h3>
            <div class="flex flex-wrap mb-14 sm:px-2">
                <div class="w-full sm:w-1/2 lg:w-1/3 px-4 sm:px-2 mb-6">
                    <div class="relative mb-2 cursor-pointer hover:opacity-90 transition-opacity" data-open="signUpModal">
                        <img class="relative z-0 rounded-lg lazyload" data-src="https://cdn.musora.com/image/fetch/w_740,q_auto:best/https://drumeo-assets.s3.amazonaws.com/lead-gen/getting-started/lesson1_thumb.jpg" alt="thumb1">
                        <i class="absolute top-1/2 left-1/2 fas fa-play play-button text-white" style="margin: -39px;"></i>
                    </div>
                    <p>
                        Positioning your drums in the right places is super important. Jared shows you where to place every drum for maximum efficiency in this first video.
                    </p>
                </div>
                <div class="w-full sm:w-1/2 lg:w-1/3 px-4 sm:px-2 mb-6">
                    <img class="rounded-lg mb-2 lazyload" data-src="https://cdn.musora.com/image/fetch/w_720,q_auto:best/https://drumeo-assets.s3.amazonaws.com/lead-gen/getting-started/lesson2_thumb.jpg" alt="thumb2">
                    <p>
                        Tuning your drums doesn’t need to be frustrating. Follow Jared’s simple guide to getting great sounds out of your kit with the turn of a key.
                    </p>
                </div>
                <div class="w-full sm:w-1/2 lg:w-1/3 px-4 sm:px-2 mb-6">
                    <img class="rounded-lg mb-2 lazyload" data-src="https://cdn.musora.com/image/fetch/w_720,q_auto:best/https://drumeo-assets.s3.amazonaws.com/lead-gen/getting-started/lesson3_thumb.jpg" alt="thumb3">
                    <p>
                        Yep, there’s a right and wrong way. Jared covers the 3 main grips in drumming and how you can get the most out of every stroke without risking injuries.
                    </p>
                </div>
                <div class="w-full sm:w-1/2 lg:w-1/3 px-4 sm:px-2 mb-6 sm:mb-0">
                    <img class="rounded-lg mb-2 lazyload" data-src="https://cdn.musora.com/image/fetch/w_720,q_auto:best/https://drumeo-assets.s3.amazonaws.com/lead-gen/getting-started/lesson4_thumb.jpg" alt="thumb4">
                    <p>
                        Reading drum music is surprisingly simple. Jared shows you this vital skill so you can take your drumming ANYWHERE.
                    </p>
                </div>
                <div class="w-full sm:w-1/2 lg:w-1/3 px-4 sm:px-2 mb-6 sm:mb-0">
                    <img class="rounded-lg mb-2 lazyload" data-src="https://cdn.musora.com/image/fetch/w_720,q_auto:best/https://drumeo-assets.s3.amazonaws.com/lead-gen/getting-started/lesson6_thumb.jpg" alt="thumb6">
                    <p>
                        And just like that, you’re playing full beats. Jared shows you some of the most popular drum beats -- you’re almost ready to play along with real music!
                    </p>
                </div>
                <div class="w-full sm:w-1/2 lg:w-1/3 px-4 sm:px-2">
                    <img class="rounded-lg mb-2 lazyload" data-src="https://cdn.musora.com/image/fetch/w_720,q_auto:best/https://drumeo-assets.s3.amazonaws.com/lead-gen/getting-started/lesson7_thumb.jpg" alt="thumb7">
                    <p>
                        Drum fills are your moment to shine. You’ll learn how to move around the kit musically with these fun & effective transitions.
                    </p>
                </div>
            </div>
            <h5 class="font-extrabold text-center italic">
                You’ll get 10 FREE lessons in total.
            </h5>
        </div>
    </section>


    <section class="pt-32 pb-20 px-2 sm:px-4 relative" style="background: #F2F8FB;">
        <div class="h-10 absolute left-0 right-0" style="background: linear-gradient(to top left, #F2F8FB calc(50% - 1px), #F2F8FB, #fff calc(50% + 1px)); top: -1px;"></div>
        <div class="max-w-xl md:max-w-3xl mx-auto text-center">
            <img class="h-20 sm:h-24 lazyload" data-src="https://cdn.musora.com/image/fetch/w_800,q_auto:best/https://drumeo-assets.s3.amazonaws.com/lead-gen/getting-started/logo_centre_black.png" alt="logo centered">
            <h3 class="leading-tight font-extrabold my-10">
                Enter your email address<br class="inline sm:hidden"> below to get started:
            </h3>
            @include("drumeo.lead-gen.partials.sign-up-form-tw", [
                "formId" => "Drumeo - Engagement - Trigger - GSOTD - Web Form",
                "formName" => 'Getting Started On The Drums',
                "buttonText" => "Get started for free ",
                'inputBorder' => '1px solid #7A8491',
                    "redirectURL" => "/getting-started/thank-you/"
            ])
        </div>
    </section>

    <div class="reveal max-w-xl text-center" id="signUpModal" data-reveal data-reset-on-close="false">
        <div class="p-4">
            <h2 class="mb-2"><strong>Enter your email address<br class="inline sm:hidden"> below to get started:</strong></h2>
            @include("drumeo.lead-gen.partials.sign-up-form-tw", [
                "stacked" => true,
                "formId" => "Drumeo - Engagement - Trigger - GSOTD - Web Form",
                "formName" => 'Getting Started On The Drums',
                    "redirectURL" => "/getting-started/thank-you/"
            ])
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
    <script defer src="{{ asset('/marketing/js/drumeo/pre-form-submit-facebook-lead.js') }}"></script>
    <script defer src="{{ asset('/marketing/js/drumeo/infusionsoft-tracking.js') }}"></script>
    <script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/lazysizes/5.3.2/lazysizes.min.js"></script>
    <script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/lazysizes/5.3.2/plugins/unveilhooks/ls.unveilhooks.min.js"></script>
@stop
