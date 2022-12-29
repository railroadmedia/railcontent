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
            class="md:hidden mb-16 transition-opacity opacity-0 @if($page === 'songs') cursor-pointer @endif"
            src="https://cdn.musora.com/image/fetch/w_900,q_auto:best/@yield('header-img')"
            alt="{{$page}} thumb"
            loading="lazy"
            onload="this.classList.remove('opacity-0')"
            @if($page === 'songs') x-on:click="soundslice = true" @endif
        />
        <div class="px-4 md:px-0">
            <div class="mb-6">
                <img
                    class="h-6 md:h-10 transition-opacity opacity-0 @if($theme !== 'drumeo') mr-2 @endif"
                    src="https://cdn.musora.com/image/fetch/w_300,q_auto:best/@if($theme === 'drumeo')https://dpwjbsxqtam5n.cloudfront.net/logos/logo-blue.png @elseif($theme === 'pianote')https://pianote.s3.amazonaws.com/logo/pianote-logo-red.png @elseif($theme === 'guitareo')https://guitareo.s3.amazonaws.com/sales/guitareo-logo-green.png @elseif($theme === 'singeo')https://singeo.s3.amazonaws.com/sales/2021/singeo-logo.png @endif"
                    alt="{{$theme}} logo"
                    loading="lazy"
                    onload="this.classList.remove('opacity-0')"
                />
                <img
                    class="h-6 md:h-10 transition-opacity opacity-0"
                    src="https://cdn.musora.com/image/fetch/w_300,q_auto:best/@if($page === 'method')https://dpwjbsxqtam5n.cloudfront.net/sales/2021/method-text.svg @elseif($page === 'coaches')https://dpwjbsxqtam5n.cloudfront.net/sales/2021/coaches-text.svg @elseif($page === 'songs')https://dpwjbsxqtam5n.cloudfront.net/sales/2021/songs-text.svg @endif"
                    alt="{{$page}} logo"
                    style="filter:@if($theme === 'drumeo')invert(1) brightness(.35) sepia(1) saturate(50) hue-rotate(195deg); @elseif($theme === 'pianote')invert(21%) sepia(91%) saturate(4092%) hue-rotate(344deg) brightness(96%) contrast(102%); @elseif($theme === 'guitareo')invert(55%) sepia(45%) saturate(5847%) hue-rotate(141deg) brightness(110%) contrast(101%); @elseif($theme === 'singeo')invert(24%) sepia(99%) saturate(7465%) hue-rotate(275deg) brightness(85%) contrast(125%); @endif"
                    loading="lazy"
                    onload="this.classList.remove('opacity-0')"
                />
            </div>
            <h2 class="font-extrabold mb-4">@yield('header')</h2>
            <p class="md:mb-10">@yield('desc')</p>
        </div>
        <img
            class="rounded-t-xl md:h-72 lg:h-80 hidden md:inline-block transition-opacity opacity-0 @if($page === 'songs') cursor-pointer @endif"
            src="https://cdn.musora.com/image/fetch/w_900,q_auto:best/@yield('header-img')"
            alt="{{$page}} thumb"
            loading="lazy"
            onload="this.classList.remove('opacity-0')"
            @if($page === 'songs') x-on:click="soundslice = true" @endif
        />
    </header>

    @yield('page-body')

    @yield('page-footer')

    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@splidejs/splide@4.0.7/dist/js/splide.min.js"></script>
    <script type="text/javascript" src="{{ asset('/marketing/parcel/drumeo/navigation-sales.js') }}"></script>
    @yield('page-scripts')
@stop
