@extends('drumeo._partials.layout-template')

@section('global-head')
    <title></title>
    <meta property="og:title" content="">
    <meta property="og:url" content="https://www.drumeo.com/">
    <meta name="description" content="">
    <meta property="og:description" content="">
    <meta property="og:image" content="">

    @include('drumeo._partials._fonts')

    <link rel="stylesheet" href="{{ mix('marketing/css/app.css') }}">
    <link href="{{ asset('/marketing/parcel/drumeo/navigation-sales.css') }}" rel="stylesheet">
    <link href="{{ asset('/marketing/css/drumeo/tailwind-helpers.css') }}" rel="stylesheet">
    <link href="{{ asset('/marketing/parcel/drumeo/sales-2020.css') }}" rel="stylesheet">
    {{--<link href="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.css" rel="stylesheet">--}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@splidejs/splide@4.0.7/dist/css/splide.min.css">

    <style>
        .slick-slider.slick-light-buttons .slick-arrow {
            background: #fff;
        }
    </style>

    <style>
        .splide__pagination__page.is-active {
            background: #01050F;
        }

        .splide__arrow svg {
            fill: #0B76DB !important;
        }

        .bubble:after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 50%;
            width: 0;
            height: 0;
            border: 5px solid transparent;
            border-top-color: black;
            border-bottom: 0;
            margin-left: -5px;
            margin-bottom: -5px;
        }
    </style>
@stop

@section('body-data')
    x-data ='{
    trailer : false
    }'
@endsection

@section('global-body')
    @if(!empty($trialVersion))
        @if(!empty($joinUrl))
            @include("drumeo.sales.partials._nav", [
                "edgeVersion" => true,
                "trialVersion" => true,
                "joinUrl" => $joinUrl
            ])
        @else
            @include("drumeo.sales.partials._nav", [
                "edgeVersion" => true,
                "trialVersion" => true,
                "scrollToJoin" => true,
            ])
        @endif
    @else
        @include("drumeo.sales.partials._nav", [
            "edgeVersion" => true,
            "scrollToJoin" => true,
            "homepage" => true
        ])
    @endif

    <header class="pb-12 md:pt-20 bg-[#111729] text-center text-white">
        <img class="md:hidden mb-16" src="https://drumeo-assets.s3.amazonaws.com/sales/2023/method/method-thumb.jpg" alt="method thumb" />
        <div class="px-4 md:px-0">
            <div class="mb-6">
                <img class="h-6 md:h-10" src="https://dpwjbsxqtam5n.cloudfront.net/logos/logo-blue.png" alt="drumeo logo" />
                <img class="h-6 md:h-10" src="https://dpwjbsxqtam5n.cloudfront.net/sales/2021/method-text.svg" alt="method" style="filter: invert(1) brightness(.35) sepia(1) saturate(50) hue-rotate(195deg)" />
            </div>
            <h2 class="font-extrabold mb-4">Always know exactly what to practice.</h2>
            <p class="md:mb-10">10 perfectly organized levels with video lessons from the top authorities on every topic.</p>
        </div>
        <img class="rounded-xl md:h-72 lg:h-80 hidden md:inline-block" src="https://drumeo-assets.s3.amazonaws.com/sales/2023/method/method-thumb.jpg" alt="method thumb" />
    </header>

    <section class="py-12 md:py-20">
        <div class="container mx-auto max-w-5xl px-6">
            <h3 class="font-extrabold text-center mb-10 leading-snug">Your clear path, frustration-free <br>guide to playing the drums.</h3>
            @include('drumeo.products.partials.question-dropdown-alt', [
                "title" => "Do I need to be tech-savvy to learn through your app?",
                "description" => 'Not at all! Technology is here to make your life easier, and Drumeo is designed to help you find lessons and songs easily. And if you ever get stuck, you can contact our Student Experience team by phone or email for prompt and helpful support. ',
            ])
        </div>
    </section>

{{--    @include('_partials.components.video-modal',[--}}
{{--        'name' => 'trailer',--}}
{{--        'video' => '772644658'--}}
{{--    ])--}}


    @include("drumeo.sales.partials._footer")

    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@splidejs/splide@4.0.7/dist/js/splide.min.js"></script>
    @yield('scripts')
@stop
