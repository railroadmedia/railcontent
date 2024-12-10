@extends('pianote.lead-gen.lead-gen-layout-tw', [
    'appTailwind' => true,
])

@section('global-head')
    @parent
    <title>The Pianote Digital Christmas Songbook | Pianote</title>
    <meta property="og:title" content="The Pianote Digital Christmas Songbook">
    <meta name="description" content="Christmas classics to make your holiday season extra special. Presented in original and simplified arrangements.">
    <meta property="og:description" content="Christmas classics to make your holiday season extra special. Presented in original and simplified arrangements.">
    <meta property="og:image" content="https://d21q7xesnoiieh.cloudfront.net/fit-in/1200x0/filters:quality(95)/marketing/pianote/lead-gen/digital-christmas-songbook/share-image.jpg" style="display: none;">
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

    <section class="text-black px-5 sm:px-6 py-10 sm:py-20 lg:py-36 relative" style="background-color:#f4f1eb;">
        <div class="inset-0 absolute z-0 bg-top bg-cover block sm:hidden" fetchpriority="high" style="background:url('https://d21q7xesnoiieh.cloudfront.net/fit-in/900x0/filters:quality(95)/marketing/pianote/lead-gen/digital-christmas-songbook/header-bg-m.webp')"></div>
        <div class="inset-0 absolute z-0 bg-top bg-cover hidden sm:block" fetchpriority="high" style="background:url('https://d21q7xesnoiieh.cloudfront.net/fit-in/2500x0/filters:quality(95)/marketing/pianote/lead-gen/digital-christmas-songbook/header-bg.webp')"></div>
        <div class="container max-w-5xl mx-auto relative z-10">
            <div class="flex flex-wrap sm:flex-nowrap items-center">
                <div class="w-full sm:w-1/2 lg:w-7/12 text-center lg:text-left sm:pr-6">
                    <div class="lg:px-3">
                        <img class="h-16 lg:h-24 lg:-ml-5 mx-0" alt="logo" fetchpriority="high"
                            src="https://d21q7xesnoiieh.cloudfront.net/fit-in/600x0/filters:quality(95)/marketing/pianote/lead-gen/digital-christmas-songbook/logo.webp">
                        <div class="w-full sm:hidden">
                            <img class="w-full px-10 max-w-xs" alt="logo" fetchpriority="high"
                                src="https://d21q7xesnoiieh.cloudfront.net/fit-in/850x0/filters:quality(95)/marketing/pianote/lead-gen/digital-christmas-songbook/devices.webp">
                        </div>
                        <h2 class="mt-4 mb-2"><strong>The Pianote Digital <br class="block"> Christmas Songbook</strong></h2>
                        <p class="leading-normal">
                            Play 10 of the most beautiful <br class="lg:hidden">
                            and popular Christmas classics.</p>
                        <p class="leading-normal mt-2 mb-4"><strong>
                                Enter your email address to get  <br class="lg:hidden">
                                your FREE E-Book instantly.</strong></p>
                    </div>
                    <div class="w-full lg:w-10/12">
                        @include("pianote._partials.sign-up-form", [
                        "recaptchaKey" => $recaptchaKey,
                        "formName" => 'Digital Christmas Songbook',
                        "formId" => "Pianote - Engagement - Trigger - Digital Christmas Songbook - Web Form",
                        "buttonText" => "Get my book",
                        "stacked" => true,
                        "minimalForm" => true,
                        "nameInput" => true,
                        'inputBorder' => '1px solid #CCC',
                        ])
                    </div>
                </div>
                <div class="hidden sm:w-1/2 lg:w-6/12 sm:block">
                    <img class="w-full" alt="logo" fetchpriority="high"
                        src="https://d21q7xesnoiieh.cloudfront.net/fit-in/1000x0/filters:quality(95)/marketing/pianote/lead-gen/digital-christmas-songbook/devices.webp">
                </div>
            </div>
        </div>
    </section>
    <section class="text-white text-left px-5 sm:px-6 py-12 sm:py-16 relative" style="background:#111729;">
        <div class="inset-0 absolute z-0 bg-top bg-cover block sm:hidden" style="background:url('https://d21q7xesnoiieh.cloudfront.net/fit-in/800x0/filters:quality(95)/marketing/pianote/lead-gen/digital-christmas-songbook/list-bg-m.webp')"></div>
        <div class="inset-0 absolute z-0 bg-top bg-cover hidden sm:block" style="background:url('https://d21q7xesnoiieh.cloudfront.net/fit-in/2000x0/filters:quality(95)/marketing/pianote/lead-gen/digital-christmas-songbook/list-bg.webp')"></div>
        <div class="container max-w-5xl mx-auto relative z-10">
            <div class="flex flex-wrap sm:flex-nowrap items-start md:items-center">
                <div class="w-full sm:w-1/2 order-1 sm:order-2 mb-5 sm:mb-0">
                    <img class="w-full" alt="list" fetchpriority="high"
                        src="https://d21q7xesnoiieh.cloudfront.net/fit-in/1000x0/filters:quality(95)/marketing/pianote/lead-gen/digital-christmas-songbook/list.png">
                </div>
                <div class="w-full sm:w-1/2 sm:pr-5 lg:pr-12 lg:pl-4 order-2 sm:order-1">
                    <p class="leading-normal">
                        Every year we find comfort and joy in the beautiful sounds of Christmas.<br><br>
                        And now you can create your own beautiful holiday sounds with The Pianote Christmas Songbook.<br><br>
                        You’ll find 10 favorite Christmas songs arranged specifically for solo piano.<br><br>
                        Whether you like to play the full score note for note or experiment with a bit of improvisation to add your own flavor, you’ll be able to play beloved holiday songs for your loved ones to sing along with.
                    </p>
                </div>
            </div>
        </div>
    </section>

    <section class="text-center text-white pt-10 sm:pt-14 lg:pt-20 bg-cover bg-center" style="background-color:#2a2f34;background-image:url('https://d21q7xesnoiieh.cloudfront.net/fit-in/1500x0/filters:quality(95)/marketing/pianote/lead-gen/digital-christmas-songbook/piano-bg.webp');">
        <h3 class="leading-tight"><strong>Take a look inside</strong></h3>
        <p class="leading-normal mt-1 sm:mt-2 mb-4 sm:mb-5"><i class="fa-light fa-arrow-turn-down fa-flip-horizontal mr-1 relative" style="bottom:-7px"></i> <em>Click to see inside the book.</em> <i class="fa-light fa-arrow-turn-down ml-1 relative" style="bottom:-7px"></i></p>
        <a target="_blank" href="https://musora-image-processing-cdn.s3.us-east-2.amazonaws.com/marketing/pianote/lead-gen/digital-christmas-songbook/pianote-christmas-songbook-sample.pdf" class="relative">
            <img class="inline-block lg:hidden w-full transition-all opacity-0" src="https://d21q7xesnoiieh.cloudfront.net/fit-in/1500x0/filters:quality(95)/marketing/pianote/lead-gen/digital-christmas-songbook/piano-m.webp" alt="tablet piano" loading="lazy" onload="this.classList.remove('opacity-0')">
            <img class="hidden lg:inline-block w-full transition-all opacity-0" src="https://d21q7xesnoiieh.cloudfront.net/fit-in/2500x0/filters:quality(95)/marketing/pianote/lead-gen/digital-christmas-songbook/piano.webp" alt="tablet piano" loading="lazy" onload="this.classList.remove('opacity-0')">
        </a>
    </section>

    <section class="text-black px-5 sm:px-6 py-10 sm:py-20 lg:py-36 relative" style="background-color:#f4f1eb;">
          <div class="inset-0 absolute z-0 bg-top bg-cover block sm:hidden" fetchpriority="high" style="background:url('https://d21q7xesnoiieh.cloudfront.net/fit-in/900x0/filters:quality(95)/marketing/pianote/lead-gen/digital-christmas-songbook/header-bg-m.webp')"></div>
        <div class="inset-0 absolute z-0 bg-top bg-cover hidden sm:block" fetchpriority="high" style="background:url('https://d21q7xesnoiieh.cloudfront.net/fit-in/2500x0/filters:quality(95)/marketing/pianote/lead-gen/digital-christmas-songbook/header-bg.webp')"></div>
        <div class="container max-w-5xl mx-auto relative z-10">
            <div class="flex flex-wrap sm:flex-nowrap items-center">
                <div class="w-full sm:w-1/2 lg:w-7/12 text-center lg:text-left sm:pr-6">
                    <div class="lg:px-3">
                        <img class="h-16 lg:h-24 lg:-ml-5 mx-0" alt="logo" fetchpriority="high"
                            src="https://d21q7xesnoiieh.cloudfront.net/fit-in/600x0/filters:quality(95)/marketing/pianote/lead-gen/digital-christmas-songbook/logo.webp">
                        <div class="w-full sm:hidden">
                            <img class="w-full px-10 max-w-xs" alt="logo" fetchpriority="high"
                                src="https://d21q7xesnoiieh.cloudfront.net/fit-in/850x0/filters:quality(95)/marketing/pianote/lead-gen/digital-christmas-songbook/devices.webp">
                        </div>
                        <h2 class="mt-4 mb-2"><strong>The Pianote Digital <br class="block"> Christmas Songbook</strong></h2>
                        <p class="leading-normal mt-2 mb-4"><strong>
                                Enter your email address to get  <br class="lg:hidden">
                                your FREE E-Book instantly.</strong></p>
                    </div>
                    <div class="w-full lg:w-10/12">
                        @include("pianote._partials.sign-up-form", [
                            "recaptchaKey" => $recaptchaKey,
                            "formName" => 'Digital Christmas Songbook',
                            "formId" => "Pianote - Engagement - Trigger - Digital Christmas Songbook - Web Form2",
                            "buttonText" => "Get my book",
                            "stacked" => true,
                            "minimalForm" => true,
                            "nameInput" => true,
                            'inputBorder' => '1px solid #CCC',
                        ])
                    </div>
                </div>
                <div class="hidden sm:w-1/2 lg:w-6/12 sm:block">
                <img class="w-full" alt="logo" fetchpriority="high"
                        src="https://d21q7xesnoiieh.cloudfront.net/fit-in/1000x0/filters:quality(95)/marketing/pianote/lead-gen/digital-christmas-songbook/devices.webp">
            </div>
            </div>
        </div>
    </section>


    @include("pianote.sales.partials._footer")

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script type="text/javascript" src="{{ asset('/marketing/js/modal.js') }}"></script>
    <script type="text/javascript" src="{{ asset('/marketing/parcel/drumeo/navigation-sales.js') }}"></script>

@stop
