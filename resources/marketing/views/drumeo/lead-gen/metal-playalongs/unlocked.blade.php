@php
  require_once(resource_path('marketing/views/drumeo/lead-gen/metal-playalongs/lessons.php'))
@endphp

@extends('drumeo.lead-gen.lead-gen-layout-tw')

@section('meta')
    <meta name="robots" content="noindex">
    <title>9 Metal Play-Alongs | Drumeo</title>
    <meta property="og:title" content="9 Metal Play-Alongs | Drumeo">
    <meta name="description" content="Add your drumming to nine heavy drum play-along tracks. (FREE).">
    <meta property="og:description" content="Add your drumming to nine heavy drum play-along tracks. (FREE).">
    <meta property="og:image" content="https://drumeo-assets.s3.amazonaws.com/lead-gen/metal-playalongs/share-image.jpg" style="display: none;">
    <meta property="og:url" content="https://www.drumeo.com/metal-playalongs/">

    @include('_partials.layout._fonts')

    <link href="{{ asset('/marketing/parcel/drumeo/lead-gen-tw.css') }}" rel="stylesheet">
    <style>
        .lazyload {opacity: 0;}  .lazyloading {opacity: 1;transition: opacity 300ms;}
        .edge-pitch {top:40px;}
        @media (min-width: 768px) {  .edge-pitch {top:56px;}  }
    </style>
@stop

@section('global-body')
    @include("drumeo.sales.partials._nav")
    <div class="shim w-full block h-11 sm:h-9" style="background-color:#010a2b;"></div>
    <a href="/choose-plan" class="edge-pitch block text-center w-full whitespace-nowrap z-10 py-2 sm:py-1 fixed mx-auto bg-black text-white">
        <div class="container mx-auto">
            <div class="text-center sm:text-left inline-block align-middle hover:opacity-90 transition-opacity duration-300">
                <img class="align-middle w-auto mr-2 h-6 hidden sm:inline-block" src="https://cdn.musora.com/image/fetch/w_300,q_auto:best/https://dpwjbsxqtam5n.cloudfront.net/logos/logo-white.png">
                <p class="inline-block align-middle mx-auto text-xs leading-tight">Get {{ Prices::$drumeoPlayAlongs }}+ more play-alongs + world-class drum  <br>
                    lessons inside Drumeo. Click for a FREE trial.</p>
            </div>
        </div>
    </a>

    <header class="text-white text-center py-14 md:py-24 lg:py-32 px-4 md:px-6" style="background: #062342 url(https://cdn.musora.com/image/fetch/w_1900,q_auto:best/https://drumeo-assets.s3.amazonaws.com/lead-gen/free-playalongs/order_background.jpg) center center/cover;">
        <div class="container mx-auto">
            <img class="h-16 md:h-28 lg:h-36" src="https://drumeo-assets.s3.amazonaws.com/lead-gen/metal-playalongs/Logo.svg" alt="metal playalongs logo">
            <h6 class="leading-normal my-5">Add your drumming to nine heavy drumless play-along tracks.</h6>
        </div>
    </header>
    <section class="text-center text-white relative py-8 md:py-10 lg:py-16 px-4" style="background-color:#010a2b;">
        <div class="container mx-auto">
            <div class="album-grid flex flex-wrap justify-center max-w-2xl lg:max-w-4xl mx-auto">
                @foreach($lessons as $lesson)
                    <a href="{{ $lesson['url'] }}" class="w-1/2 sm:w-1/3 px-2 md:px-3 mb-5 md:mb-7">
                        <div class="relative autoplay-video cursor-pointer overflow-hidden rounded-md">
                            <i class="absolute top-1/2 left-1/2 fas fa-play play-button" style="margin: -39px;"></i>
                            <div class="aspect-1:1 w-full bg-contain bg-center lazyload" data-bg="https://cdn.musora.com/image/fetch/w_550,q_auto:best/{{ $lesson['image'] }}"></div>
                        </div>
                        <h5 class="mt-3 mb-1"><strong>w/ {{ $lesson['artist'] }}</strong></h5>
                        <p class="text-light-navy leading-tight">{{ $lesson['descriptions'] }}</p>
                    </a>
                @endforeach
            </div>
        </div>
    </section>
    <section class="text-center py-14 md:py-24 lg:py-32 text-white" style="background: #062342 url(https://cdn.musora.com/image/fetch/w_1900,q_auto:best/https://drumeo-assets.s3.amazonaws.com/lead-gen/free-playalongs/order_background.jpg) center bottom/cover;">
        <div class="container mx-auto">
            <div class="w-full px-2 md:px-3 text-center">
                <h1 class="text-2xl md:text-4xl lg:text-5xl"><strong>Keep the party going.</strong></h1>
                <h4 class="mt-5 lg:mt-6 mb-6 lg:mb-9 leading-normal px-3 md:text-xl lg:text-2xl">
                    Get {{ Prices::$drumeoPlayAlongs }}+ play-alongs & world-class drum lessons  <br class="hidden md:inline">
                    inside Drumeo. Click below to try a free trial.</h4>
                <a class="join" href="/choose-plan">Free Trial &raquo;</a>
            </div>
        </div>
    </section>

    @include("drumeo.sales.partials._footer", [
            "minimal" => true
        ])
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script type="text/javascript" src="{{ asset('/marketing/js/modal.js') }}"></script>
    <script>
        $(document).ready(function () {
            $(document).foundation();
        });
    </script>
    <script type="text/javascript" src="{{ asset('/marketing/js/modal-autoplay.js') }}"></script>
    <script src="{{ asset('/marketing/parcel/drumeo/navigation-sales.js') }}"></script>
    <script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/lazysizes/5.3.2/lazysizes.min.js"></script>
    <script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/lazysizes/5.3.2/plugins/unveilhooks/ls.unveilhooks.min.js"></script>
@stop
