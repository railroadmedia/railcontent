@extends('musora._partials.layout', [
    'whiteNav' => true,
    'fullSubscriptionVersion' => true,
])
@section('head-includes')
    <style>
        .join.musora-gold {
            background-color:#FFAE00;
            color:#000;
        }

        .join.musora-gold:hover, .join.musora-gold:focus {
            background:#FFAE00;
            color:#000;
        }
    </style>
@endsection

@section('layout-body')
    <header class="pb-12 md:pb-0 md:pt-20 text-center text-white" style="background-color:#000C17;"
        @if($page === 'songs') x-data="{ brand: 'drumeo', drumeoSoundslice: false, pianoteSoundslice: false, guitareoSoundslice: false, singeoSoundslice: false, }" @endif
    >
        @if($page === 'songs')
            @yield('header-mobileImg')
        @else
            <img
                class="md:hidden mb-16"
                src="https://www.musora.com/musora-cdn/image/width=900,quality=95/@yield('header-img')"
                alt="{{$page}} thumb"
                fetchpriority="high"
            />
        @endif

        <div class="px-4 md:px-0">
            <div class="mb-6">
                <img
                    class="h-5 md:h-9 mr-2"
                    src="https://www.musora.com/musora-cdn/image/width=150,quality=95/https://dmmior4id2ysr.cloudfront.net/homepage/2023/musora_logo.png"
                    alt="musora logo"
                    fetchpriority="high"
                />
                <img
                    class="h-6 md:h-9"
                    src="https://www.musora.com/musora-cdn/image/width=150,quality=95/@if($page === 'method')https://dpwjbsxqtam5n.cloudfront.net/sales/2021/method-text.svg @elseif($page === 'coaches')https://dpwjbsxqtam5n.cloudfront.net/sales/2021/coaches-text.svg @elseif($page === 'songs')https://dpwjbsxqtam5n.cloudfront.net/sales/2021/songs-text.svg @endif"
                    alt="{{$page}} logo"
                    style="filter:brightness(0) invert(1)"
                    fetchpriority="high"
                />
            </div>
            <h2 class="font-extrabold mb-4">@yield('header')</h2>
            <p class="md:mb-10 px-4 lg:px-0">@yield('desc')</p>

            <div class="flex flex-wrap items-center justify-center my-7 mx-auto">
                <a aria-label="Review" class="inline-block" href="https://www.shopperapproved.com/reviews/Musora.com" target="_blank" rel="noopener noreferrer" onclick="window.open('https://www.shopperapproved.com/reviews/Musora.com', 'newwindow', 'width=750, height=550'); return false;">
                    <i class="align-middle text-lg fas fa-star" style="color: #ffac00;" aria-hidden="true"></i>
                    <i class="align-middle text-lg -ml-4 fas fa-star" style="text-shadow: -2px 0 1px #000C17;color: #ffac00;" aria-hidden="true"></i>
                    <i class="align-middle text-lg -ml-4 fas fa-star" style="text-shadow: -2px 0 1px #000C17;color: #ffac00;" aria-hidden="true"></i>
                    <i class="align-middle text-lg -ml-4 fas fa-star" style="text-shadow: -2px 0 1px #000C17;color: #ffac00;" aria-hidden="true"></i>
                    <i class="align-middle text-lg -ml-4 fas fa-star" style="text-shadow: -2px 0 1px #000C17;color: #ffac00;" aria-hidden="true"></i>
                </a>
                <p class="inline-block leading-tight text-xs align-middle pl-1 m-0"><em>Trusted by {{ number_format(Prices::$students) }} active students.</em></p>
            </div>
            <a class="join musora-gold smaller sm:mb-10" href="/choose-plan">Start your free trial today</a>
        </div>
            @if($page === 'songs')
                @yield('header-img')
            @else
                <picture>
                    <source media="(min-width: 500px)" srcset="https://www.musora.com/musora-cdn/image/width=900,quality=95/@yield('header-img')">
                    <img
                        class="rounded-t-xl md:h-72 lg:h-80 hidden md:inline-block @if($page === 'songs') cursor-pointer @endif"
                        src="https://www.musora.com/musora-cdn/image/width=550,quality=95/@yield('header-img')"
                        alt="{{$page}} thumb"
                        @if($page === 'songs') x-on:click="soundslice = true" @endif
                        fetchpriority="high"
                    />
                </picture>
            @endif
    </header>

    @yield('page-body')
@stop

@section('layout-scripts')
    <script src="https://cdn.jsdelivr.net/npm/@splidejs/splide@4.0.7/dist/js/splide.min.js"></script>
@endsection
