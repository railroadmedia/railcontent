@extends('drumeo._partials.layout-template')

@section('global-head')
    <title>DOM FAMULARO’S MASTERCLASS | Drumeo</title>
    <meta property="og:title" content="DOM FAMULARO’S MASTERCLASS | Drumeo">
    <meta property="og:url" content="https://www.drumeo.com/{{ Request::path() }}">

    <meta name="description" content="Dom is going to help you stay inspired & motivated about your drumming">
    <meta property="og:description" content="Dom is going to help you stay inspired & motivated about your drumming">
    <meta property="og:image" content="https://drumeo-assets.s3.amazonaws.com/promos/black-friday/bundles/lifetime/lifetime-thumb.jpg" style="display: none;">

    @include('drumeo._partials._fonts')

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/tailwindcss/2.2.19/tailwind.min.css" />
    <link href="{{ asset('/marketing/css/drumeo/tailwind-helpers.css') }}" rel="stylesheet">
    <link href="{{ asset('/marketing/parcel/drumeo/sales-2020.css') }}" rel="stylesheet">
    <link href="{{ asset('/marketing/parcel/drumeo/navigation-sales.css') }}" rel="stylesheet">
    <style>
        .lazyload {
            opacity: 0;
        }

        .lazyloading {
            opacity: 1;
            transition: opacity 300ms;
        }
    </style>
@stop

@section('global-body')
        @include("drumeo.sales.partials._nav", [
            "edgeVersion" => true,
            "scrollToJoin" => true
        ])
    <section class="text-center text-white py-10 md:py-20 lg:py-24 px-4 md:px-6 relative overflow-hidden" style="background:#01050f;">
        <div class="container mx-auto z-10 relative max-w-4xl">
            <h3 class="mb-8 sm:mb-12"><strong>The Ultimate Motivation<br class="inline sm:hidden"> Masterclass For Drummers</strong></h3>

            <div class="w-full mx-auto my-10 px-3" style="max-width:920px;">
                <div class="aspect-16:9 w-full relative rounded-xl overflow-hidden">
                    <iframe class="absolute w-full h-full" src="//player.vimeo.com/video/682312999" frameborder="0" allowfullscreen allow="autoplay"></iframe>
                </div>
            </div>
            <div class="flex flex-wrap sm:flex-nowrap items-center justify-center">

                <p class="order-1 sm:order-0 text-left text-light-navy sm:pr-5 lg:pr-12">It’s time to celebrate a Lifetime of drumming!
                    <br><br>
                    Dom Famularo is here to help you stay inspired & motivated about playing the drums – plus, demonstrate key exercises to help you play with fluidity and longevity (after all… you’re in this for the long haul!).
                    <br><br>
                    <strong>This Masterclass will ONLY be available to you & your fellow Lifetime Members.</strong>
                    <br><br>
                    It will be broadcast LIVE on April 9 and then available for on-demand access to reference anytime you need a refresher.
                    <br><br>
                    You can tune in on:<br>
                    April 9th @ 12pm EST<br>
                    April 9th @ 6pm EST
                    <br><br>
                    See you there!</p>
                <img class="mb-4 sm:mb-0 order-0 sm:order-1 w-36 sm:w-72 lg:w-80 autoplay-video cursor-pointer" data-open="domModal" src="https://drumeo-assets.s3.amazonaws.com/drum-shop/lifetime/live_phone_thumbnail.png">
            </div>
        </div>
    </section>

    <div class="reveal large" id="domModal" data-reveal data-reset-on-close="false">
        <div class="aspect-16:9 w-full relative">
            <iframe class="absolute w-full h-full reset-on-close" src="" data-lazy-load-url="//player.vimeo.com/video/682312999?autoplay=1" frameborder="0" allowfullscreen allow="autoplay"></iframe>
        </div>
    </div>
    @include("drumeo.sales.partials._footer")

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
        <script>
            $(document).ready(function () {
                $(document).foundation();
            });
        </script>
    <script type="text/javascript" src="{{ asset('/marketing/parcel/drumeo/navigation-sales.js') }}"></script>
    <script type="text/javascript" src="{{ asset('/marketing/js/sliding-anchor.js') }}"></script>
    <script type="text/javascript" src="{{ asset('/marketing/js/modal.js') }}"></script>
    <script type="text/javascript" src="{{ asset('/marketing/js/modal-autoplay.js') }}"></script>
    <script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/lazysizes/5.3.2/lazysizes.min.js"></script>
    <script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/lazysizes/5.3.2/plugins/unveilhooks/ls.unveilhooks.min.js"></script>
@stop
