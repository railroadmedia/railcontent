@extends($theme.'._partials.global-layout')

@section('global-head')
    @yield('page-meta')

    <link rel="stylesheet" href="{{ mix('marketing/css/app.css') }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@splidejs/splide@4.0.7/dist/css/splide.min.css">

    <style>
        .slick-slider.slick-light-buttons .slick-arrow {
            background: #fff;
        }
        .splide__pagination__page.is-active {
            background: #01050F;
            transform: none !important;
        }

        .splide__pagination__page {
            margin: 3px 6px !important;
            opacity: 1 !important;
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

    @yield('page-styles')
@stop

@section('global-body')
    @yield('page-nav')

    <header class="pb-12 md:pb-0 md:pt-20 bg-[#111729] text-center text-white">
        <img
            class="md:hidden mb-16 @if($page === 'songs') cursor-pointer @endif"
            src="https://www.musora.com/musora-cdn/image/width=900,quality=85/@yield('header-img')"
            alt="{{$page}} thumb"
            @if($page === 'songs') x-on:click="soundslice = true" @endif
            fetchpriority="high"
        />
        <div class="px-4 md:px-0">
            <div class="mb-6">
                <img
                    class="h-6 md:h-10 @if($theme !== 'drumeo') mr-2 @endif"
                    src="https://www.musora.com/musora-cdn/image/width=150,quality=85/@if($theme === 'drumeo')https://dpwjbsxqtam5n.cloudfront.net/logos/logo-blue.png @elseif($theme === 'pianote')https://d2vyvo0tyx8ig5.cloudfront.net/logo/pianote-logo-red.png @elseif($theme === 'guitareo')https://d122ay5chh2hr5.cloudfront.net/sales/guitareo-logo-green.png @elseif($theme === 'singeo')https://d21xeg6s76swyd.cloudfront.net/sales/2021/singeo-logo.png @endif"
                    alt="{{$theme}} logo"
                    fetchpriority="high"
                />
                <img
                    class="h-6 md:h-10"
                    src="https://www.musora.com/musora-cdn/image/width=150,quality=85/@if($page === 'method')https://dpwjbsxqtam5n.cloudfront.net/sales/2021/method-text.svg @elseif($page === 'coaches')https://dpwjbsxqtam5n.cloudfront.net/sales/2021/coaches-text.svg @elseif($page === 'songs')https://dpwjbsxqtam5n.cloudfront.net/sales/2021/songs-text.svg @endif"
                    alt="{{$page}} logo"
                    style="filter:@if($theme === 'drumeo')invert(1) brightness(.35) sepia(1) saturate(50) hue-rotate(195deg); @elseif($theme === 'pianote')invert(21%) sepia(91%) saturate(4092%) hue-rotate(344deg) brightness(96%) contrast(102%); @elseif($theme === 'guitareo')invert(55%) sepia(45%) saturate(5847%) hue-rotate(141deg) brightness(110%) contrast(101%); @elseif($theme === 'singeo')invert(24%) sepia(99%) saturate(7465%) hue-rotate(275deg) brightness(85%) contrast(125%); @endif"
                    fetchpriority="high"
                />
            </div>
            <h2 class="font-extrabold mb-4">@yield('header')</h2>
            <p class="md:mb-10">@yield('desc')</p>
        </div>
        <picture>
            <source media="(min-width: 500px)" srcset="https://www.musora.com/musora-cdn/image/width=900,quality=85/@yield('header-img')">
            <img
                class="rounded-t-xl md:h-72 lg:h-80 hidden md:inline-block @if($page === 'songs') cursor-pointer @endif"
                src="https://www.musora.com/musora-cdn/image/width=550,quality=85/@yield('header-img')"
                alt="{{$page}} thumb"
                @if($page === 'songs') x-on:click="soundslice = true" @endif
                fetchpriority="high"
            />
        </picture>

    </header>

    @yield('page-body')

    @yield('page-footer')

    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@splidejs/splide@4.0.7/dist/js/splide.min.js"></script>
    <script type="text/javascript" src="{{ asset('/marketing/parcel/drumeo/navigation-sales.js') }}"></script>
    @yield('page-scripts')
@stop
