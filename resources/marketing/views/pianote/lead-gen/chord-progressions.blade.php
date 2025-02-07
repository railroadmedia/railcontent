@extends('pianote.lead-gen.lead-gen-layout-tw', [
    'appTailwind' => true,
])

@section('global-head')
    @parent
    <title>Little Book of Chord Progressions (Digital) | Pianote</title>
    <meta property="og:title" content="Little Book of Chord Progressions (Digital)">
    <meta name="description" content="In this little E-book, we have compiled the top 14 chord progressions you will find in popular music.">
    <meta property="og:description" content="In this little E-book, we have compiled the top 14 chord progressions you will find in popular music.">
    <meta property="og:image" content="https://d21q7xesnoiieh.cloudfront.net/fit-in/1200x0/filters:quality(95)/marketing/pianote/lead-gen/chords-progressions-digital-book/share-image.jpg" style="display: none;">
    <meta property="og:url" content="https://www.pianote.com/{{ Request::path() }}">

    @include('_partials.layout._fonts')
    <link rel="stylesheet" href="{{ mix('marketing/css/app.css') }}">
    <link href="{{ asset('/marketing/css/tailwind-helpers.css') }}" rel="stylesheet">
    <link href="{{ asset('/marketing/parcel/drumeo/nav-footer-pianote.css') }}" rel="stylesheet">
    <link href="{{ asset('/marketing/parcel/drumeo/30dd.css') }}" rel="stylesheet">
@stop()

@section('global-body')
    @include('pianote.sales.partials._nav', [
        "cartVersion" => true
    ])

    <section class="text-black px-5 sm:px-6 py-10 sm:py-20 lg:py-24 relative" style="background-color:#f4f1eb;">
        <div class="inset-0 absolute z-0 bg-top bg-cover block sm:hidden" fetchpriority="high" style="background:url('https://d21q7xesnoiieh.cloudfront.net/fit-in/900x0/filters:quality(95)/marketing/pianote/lead-gen/chords-progressions-digital-book/header-bg-m.webp')"></div>
        <div class="inset-0 absolute z-0 bg-top bg-cover hidden sm:block" fetchpriority="high" style="background:url('https://d21q7xesnoiieh.cloudfront.net/fit-in/2500x0/filters:quality(95)/marketing/pianote/lead-gen/chords-progressions-digital-book/header-bg.webp')"></div>
        <div class="container max-w-5xl mx-auto relative z-10">
            <div class="flex flex-wrap sm:flex-nowrap items-center">
                <div class="w-full sm:w-1/2 lg:w-7/12 text-center lg:text-left">
                    <div>
                        <img class="h-16 lg:h-20 mx-0" alt="logo" fetchpriority="high"
                            src="https://d21q7xesnoiieh.cloudfront.net/fit-in/600x0/filters:quality(95)/marketing/pianote/lead-gen/chords-progressions-digital-book/logo.svg">
                        <div class="w-full sm:hidden">
                            <img class="w-full px-10 max-w-xs" alt="logo" fetchpriority="high"
                                src="https://d21q7xesnoiieh.cloudfront.net/fit-in/1200x0/filters:quality(95)/marketing/pianote/lead-gen/chords-progressions-digital-book/devices.webp">
                        </div>
                        <p class="leading-normal pt-2 md:pt-4">
                            All music is chord progressions. <br class="hidden md:block">
                            In this little book, we’ve compiled the top 14 chord progressions <br class="hidden lg:block">
                            you’ll find in popular music.
                            <br><br>
                            You’ll get diagrams for each one as well as notated chord pathways.<br class="hidden lg:block">
                            Use these chords to start playing your favorite songs (or write your own).
                        </p>
                        <p class="leading-normal my-2 lg:my-4"><strong>
                                Enter your email address to get  <br class="lg:hidden">
                                your FREE E-Book instantly.</strong></p>
                    </div>
                    <div class="w-full lg:w-10/12">
                        @include("pianote._partials.sign-up-form", [
                        "recaptchaKey" => $recaptchaKey,
                        "formName" => 'Chords Progressions Digital Book',
                        "formId" => "Pianote - Engagement - Trigger - Chords Progressions Digital Book - Web Form",
                        "buttonText" => "GET MY FREE E-BOOK",
                        "stacked" => true,
                        "minimalForm" => true,
                        "nameInput" => true,
                        'inputBorder' => '1px solid #CCC',
                        ])
                    </div>
                </div>
                <div class="hidden sm:w-1/2 lg:w-6/12 sm:block sm:pl-8">
                    <img class="w-full" alt="logo" fetchpriority="high"
                        src="https://d21q7xesnoiieh.cloudfront.net/fit-in/1200x0/filters:quality(95)/marketing/pianote/lead-gen/chords-progressions-digital-book/devices.webp">
                </div>
            </div>
        </div>
    </section>
    <section class="text-black text-left py-12 sm:py-18 lg:py-20 relative" style="background:white">
        <div class="inset-0 absolute z-0 bg-top bg-cover hidden sm:block" style="background:url('https://d21q7xesnoiieh.cloudfront.net/fit-in/2000x0/filters:quality(95)/marketing/pianote/lead-gen/chords-progressions-digital-book/paper-bg-new.webp')"></div>
        <div class="container max-w-5xl mx-auto z-10">
            <div class="flex flex-wrap sm:flex-nowrap items-start md:items-center">
                <div class="w-full sm:w-1/2 px-5 sm:px-6 pb-8 md:pb-0 sm:pr-5 lg:pr-12 lg:pl-8 relative z-10">
                    <h4 class="pb-4 md:pb-6 pr-24 sm:pr-20 leading-snug"><strong>The most popular chord progressions used in modern music.</strong></h4>
                    <p class="leading-normal">
                        These are the chord progressions you hear on the radio.<br><br>
                        They’re the chord progressions that stars like U2 and Taylor Swift have built their careers on.<br><br>
                        We’re breaking down the 14 most popular chord progressions with detailed diagrams and music notation.
                    </p>
                </div>

                <div class="w-full sm:w-1/2 mb-5 sm:mb-0 lg:pl-16 lg:px-10 relative z-10 pt-20 sm:pt-0 bg-[url('https://d21q7xesnoiieh.cloudfront.net/fit-in/800x0/filters:quality(95)/marketing/pianote/lead-gen/chords-progressions-digital-book/paper-bg-m.webp')] sm:bg-none">
                <h4 class="pb-4 md:pb-6 px-5 sm:px-6"><strong>You’ll get:</strong></h4>
                    <ul class="ml-6 fa-ul px-5 sm:px-6" style="column-gap: 20px;">
                        <li class="mb-3"><i class="fa-li fas fa-check text-pianote mr-1"></i> Color diagrams of all 14 progressions</li>
                        <li class="mb-3"><i class="fa-li fas fa-check text-pianote mr-1"></i> Music notation for all progressions</li>
                        <li class="mb-3"><i class="fa-li fas fa-check text-pianote mr-1"></i> Notation to show you how to play the chord progressions using inversions</li>
                        <li class="mb-3"><i class="fa-li fas fa-check text-pianote mr-1"></i> Broken chord patterns to make the chord progressions sound truly beautiful</li>
                    </ul>
                </div>
            </div>
        </div>
    </section>


    <section class="text-center text-white pt-10 sm:pt-14 lg:pt-20 bg-cover bg-center" style="background-color:#2a2f34;background-image:url('https://d21q7xesnoiieh.cloudfront.net/fit-in/1500x0/filters:quality(95)/marketing/pianote/lead-gen/chords-progressions-digital-book/piano-bg.webp');">
        <h3 class="leading-tight"><strong>Take a look inside</strong></h3>
        <p class="leading-normal mt-1 sm:mt-2 mb-4 sm:mb-5"><i class="fa-light fa-arrow-turn-down fa-flip-horizontal mr-1 relative" style="bottom:-7px"></i> <em>Click to see inside the E-Book.</em> <i class="fa-light fa-arrow-turn-down ml-1 relative" style="bottom:-7px"></i></p>
        <a target="_blank" href="https://musora-image-processing-cdn.s3.us-east-2.amazonaws.com/marketing/pianote/lead-gen/chords-progressions-digital-book/little-books-chord-progressions-eBook-preview.pdf" class="relative">
            <img class="inline-block lg:hidden w-full transition-all opacity-0" src="https://d21q7xesnoiieh.cloudfront.net/fit-in/1500x0/filters:quality(95)/marketing/pianote/lead-gen/chords-progressions-digital-book/piano-m.webp" alt="tablet piano" loading="lazy" onload="this.classList.remove('opacity-0')">
            <img class="hidden lg:inline-block w-full transition-all opacity-0" src="https://d21q7xesnoiieh.cloudfront.net/fit-in/2500x0/filters:quality(95)/marketing/pianote/lead-gen/chords-progressions-digital-book/piano.webp" alt="tablet piano" loading="lazy" onload="this.classList.remove('opacity-0')">
        </a>
    </section>

    <section class="text-black px-5 sm:px-6 py-10 sm:py-20 relative" style="background-color:#f4f1eb;">
        <div class="inset-0 absolute z-0 bg-top bg-cover block sm:hidden" fetchpriority="high" style="background:url('https://d21q7xesnoiieh.cloudfront.net/fit-in/900x0/filters:quality(95)/marketing/pianote/lead-gen/chords-progressions-digital-book/header-bg-m.webp')"></div>
        <div class="inset-0 absolute z-0 bg-top bg-cover hidden sm:block" fetchpriority="high" style="background:url('https://d21q7xesnoiieh.cloudfront.net/fit-in/2500x0/filters:quality(95)/marketing/pianote/lead-gen/chords-progressions-digital-book/header-bg.webp')"></div>
        <div class="container max-w-5xl mx-auto relative z-10">
            <div class="flex flex-wrap sm:flex-nowrap items-center">
                <div class="w-full sm:w-1/2 lg:w-7/12 text-center lg:text-left sm:pr-6">
                    <div class="lg:px-3">
                        <img class="h-16 lg:h-20 mx-0" alt="logo" fetchpriority="high"
                            src="https://d21q7xesnoiieh.cloudfront.net/fit-in/600x0/filters:quality(95)/marketing/pianote/lead-gen/chords-progressions-digital-book/logo.svg">
                        <div class="w-full sm:hidden">
                            <img class="w-full px-10 max-w-xs" alt="logo" fetchpriority="high"
                                src="https://d21q7xesnoiieh.cloudfront.net/fit-in/850x0/filters:quality(95)/marketing/pianote/lead-gen/chords-progressions-digital-book/devices.webp">
                        </div>
                        <p class="leading-normal mt-2 mb-4"><strong>
                                Enter your email address to get  <br class="lg:hidden">
                                your FREE E-Book instantly.</strong></p>
                    </div>
                    <div class="w-full lg:w-10/12">
                        @include("pianote._partials.sign-up-form", [
                            "recaptchaKey" => $recaptchaKey,
                            "formName" => 'Chords Progressions Digital Book',
                            "formId" => "Pianote - Engagement - Trigger - Chords Progressions Digital Book - Web Form2",
                            "buttonText" => "GET MY FREE E-BOOK",
                            "stacked" => true,
                            "minimalForm" => true,
                            "nameInput" => true,
                            'inputBorder' => '1px solid #CCC',
                        ])
                    </div>
                </div>
                <div class="hidden sm:w-1/2 lg:w-6/12 sm:block">
                <img class="w-full" alt="logo" fetchpriority="high"
                        src="https://d21q7xesnoiieh.cloudfront.net/fit-in/1300x0/filters:quality(95)/marketing/pianote/lead-gen/chords-progressions-digital-book/devices.webp">
            </div>
            </div>
        </div>
    </section>


    @include("pianote.sales.partials._footer")

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script type="text/javascript" src="{{ asset('/marketing/js/modal.js') }}"></script>
    <script type="text/javascript" src="{{ asset('/marketing/parcel/drumeo/navigation-sales.js') }}"></script>

@stop
