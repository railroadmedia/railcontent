@php
    require_once(resource_path('marketing/views/drumeo/_partials/homepage-data.php'));
@endphp
@extends('drumeo.sales.subscription', [
    "promoVersion" => true,
    "shopNav" => true,
    "hideHeader" => true,
])
@section('body-data')
    x-data ='{
    soundslice : false,
    waitlist: false,
    trailer : false,
    lazyLoad: false,
    videoLoaded: false,
    keyTrailer : false,
    }'
@endsection

@section('top-bar')

    @include('_partials.components.shop.promo-banner-2', [
        "noBreadcrumb" => true,
        "name" => "The Practice Anywhere Bundle",
        "fullPrice" => 240,
        "price" => 200,
    ])

@php
    $originalPrice = 240;
    $discountedPrice = 200;
    $savePercentage = round((($originalPrice - $discountedPrice) / $originalPrice) * 100);
@endphp

    @php
        $bubbles =  [
             [
                 'src' => $bubble1,
                 'classes' => 'h-10 sm:h-14 lg:h-16 top-[53%] sm:top-[53%] left-[4%] sm:left-[4%]',
             ],
             [
                 'src' => $bubble2,
                 'classes' => 'h-24 sm:h-28 lg:h-44 top-[13%] sm:top-[21%] left-[8%] sm:left-[10%]',
             ],
             [
                 'src' => $bubble3,
                 'classes' => 'h-32 sm:h-40 lg:h-52 top-[84%] sm:top-[81%] left-[9%] sm:left-[18%]',
             ],
             [
                 'src' => $bubble4,
                 'classes' => 'h-10 sm:h-12 lg:h-16 top-[13%] sm:top-[13%] left-[31%] sm:left-[31%]',
             ],
             [
                 'src' => $bubble5,
                 'classes' => 'h-10 sm:h-12 lg:h-16 top-[8%] sm:top-[8%] left-[58%] sm:left-[58%]',
             ],
             [
                 'src' => $bubble6,
                 'classes' => 'h-28 sm:h-32 lg:h-48 top-[88%] sm:top-[88%] left-[90%] sm:left-[78%]',
             ],
             [
                 'src' => $bubble7,
                 'classes' => 'h-28 sm:h-36 lg:h-52 top-[13%] sm:top-[18%] left-[93%] sm:left-[87%]',
             ],
             [
                 'src' => $bubble8,
                 'classes' => 'h-12 sm:h-14 lg:h-16 top-[63%] sm:top-[63%] left-[99%] sm:left-[99%]',
             ]
         ];
        $slides = $drumeo['slides'];
    @endphp
    <header class="text-center px-5 sm:px-6 py-28 sm:py-48 relative overflow-hidden"
        style="background:linear-gradient(to right, #e0ecf9, #f6f8fc, #f6f8fc, #e0ecf9);">
        <div class="container max-w-6xl mx-auto relative z-20">
            <img class="h-10 sm:h-16 lg:h-20 mb-3 sm:mb-4" src="https://d21q7xesnoiieh.cloudfront.net/fit-in/700x0/filters:quality(95)/marketing/drumeo/promos/september/logo-black.webp">
            <br>
            <h1 class="relative w-auto inline-block mb-7 sm:mb-10">
                Get unlimited drum lessons for a year<br class="hidden sm:inline">
                <strong class="relative inline-block">+ $100 to Guitar Center<svg class="absolute left-0 right-0 bottom-0 w-full h-4 sm:h-7" xmlns="http://www.w3.org/2000/svg" width="100%" height="100%" viewBox="0 0 524 22" fill="none" style="transform: translate(0, 100%);"><path d="M1.99978 10.6328C84.053 4.08508 302.889 -3.20824 521.809 20" stroke="#0B76DB" stroke-width="3" stroke-linecap="round"></path><path d="M2.17373 15.0541C83.9528 7.29382 302.406 -3.51921 521.988 15.3111" stroke="#0B76DB" stroke-width="3" stroke-linecap="round"></path></svg></strong>
            </h1>

            <p class="text-sm leading-normal sm:tracking-widest mb-5 lg:mb-7">
                <i class="fas fa-check text-drumeo"></i>  GREAT TEACHERS <br class="sm:hidden">
                <i class="fas fa-check ml-3 sm:ml-5 text-drumeo"></i>  VIDEO LESSONS
                <br class="lg:hidden">
                <i class="fas fa-check lg:ml-5 text-drumeo"></i>  FUN PRACTICE
                <i class="fas fa-check ml-3 sm:ml-5 text-drumeo"></i>  POPULAR SONGS
            </p>
            <div class="flex flex-wrap justify-center max-w-xs sm:max-w-full mx-auto px-5 sm:px-0">
                <a class="sm:mx-0.5 w-full sm:w-56 join drumeo smaller sm:order-1 mb-2 sm:mb-0 anchor-slide"
                    href="#customize-anchor" aria-label="Customize anchor"
                >SEE YOUR DEAL </a>
                <div class="sm:mx-0.5 w-full sm:w-56 join outline black smaller autoplay-video" x-on:click="trailer = true;">WATCH THE TRAILER</div>
            </div>

            <div class="flex flex-wrap items-center justify-center mt-2 sm:mt-3 mx-auto">
                <a aria-label="Review" class="inline-block" href="https://www.shopperapproved.com/reviews/Musora.com" target="_blank" rel="noopener noreferrer" onclick="window.open('https://www.shopperapproved.com/reviews/Musora.com', 'newwindow', 'width=750, height=550'); return false;">
                    <i class="align-middle text-lg fas fa-star" style="color: #ffac00;" aria-hidden="true"></i>
                    <i class="align-middle text-lg -ml-4 fas fa-star" style="text-shadow: -2px -1px 1px #f6f8fc;color: #ffac00;" aria-hidden="true"></i>
                    <i class="align-middle text-lg -ml-4 fas fa-star" style="text-shadow: -2px -1px 1px #f6f8fc;color: #ffac00;" aria-hidden="true"></i>
                    <i class="align-middle text-lg -ml-4 fas fa-star" style="text-shadow: -2px -1px 1px #f6f8fc;color: #ffac00;" aria-hidden="true"></i>
                    <i class="align-middle text-lg -ml-4 fas fa-star" style="text-shadow: -2px -1px 1px #f6f8fc;color: #ffac00;" aria-hidden="true"></i>
                </a>
                <p class="inline-block leading-tight text-xs align-middle pl-1 m-0"><em>Trusted by {{ number_format(Prices::$students) }} active students.</em></p>
            </div>
        </div>
        @foreach($bubbles as $bubble)
            <picture>
                <source media="(min-width:640px)" srcset="{{ $bubble['src'] }}">
                <img class="absolute z-10 transform -translate-x-1/2 -translate-y-1/2 {{ $bubble['classes'] }}"
                    src="{{ $bubble['src'] }}" alt="header circle image" fetchpriority="high">
            </picture>
        @endforeach
    </header>
    <section class="sm:px-6 py-4 sm:py-5 text-white relative z-10" style="background:#0c1524;">
        <div class="container max-w-5xl mx-auto">
            @component('_partials.components.carousel',[
                'xdata' => "
                    classes: {
                        arrow: 'splide__arrow bg-white opacity-100 shadow-lg h-11 w-11 header-slide-btn',
                        prev: 'splide__arrow--prev your-class-prev hidden sm:flex z-50',
                        next: 'splide__arrow--next your-class-next hidden sm:flex z-50',
                        pagination: 'hidden',
                    },
                    perPage: 1,
                    perMove: 1,
                    type: 'loop',
                    autoplay: true,
                    pauseOnHover: true,
                    pauseOnFocus: true,
                    interval: 3000,
                    lazyLoad: 'nearby',
                ",
            ])
                @slot('content')
                    @foreach ($slides as $slide)
                        <li class="splide__slide">
                            <div class="px-3 md:px-6 text-center">
                                <p class="leading-normal text-sm"><em>“{{ $slide['desc'] }}”</em></p>
                                <div class="flex flex-wrap md:flex-nowrap sm:text-left items-center justify-center mt-1.5">
                                    <img
                                        class="rounded-full object-cover object-right w-9 h-9"
                                        data-splide-lazy={{ $slide['thumb'] }}
                                alt="{{$slide['name']}}"
                                    ><br class="inline md:hidden">
                                    <p class="leading-tight w-full text-center md:w-auto text-sm text-light-navy ml-1 md:ml-2 mr-0 mt-0.5 md:mt-0"><em>{{ $slide['name'] }}, {{ $slide['credit'] }}</em></p>
                                </div>
                            </div>
                        </li>
                    @endforeach
                @endslot
            @endcomponent
        </div>
    </section>

    <section class="text-center px-5 sm:px-6 py-12 sm:py-14 lg:py-20 text-white relative" style="background: linear-gradient(68deg, #07233E 0%, #0C1524 100%);">
        <div class="container max-w-5xl mx-auto">
            <img class="mb-5 h-56 inline sm:hidden"
                src="https://d21q7xesnoiieh.cloudfront.net/fit-in/620x0/filters:quality(95)/marketing/drumeo/promos/september/promo-image.webp"
                alt="learn playing image"
                fetchpriority="high"
            >
            <div class="text-left flex flex-wrap sm:flex-nowrap justify-center items-start">
                <div class="max-w-xl pr-5 lg:pr-8 mx-0">
                    <h3 class="leading-tight mb-2"><strong>Upgrade your gear AND your drumming.</strong></h3>
                    <p class="leading-normal">
                        Fresh sticks, a new snare drum, finally replacing those old heads…
                        <br><br>
                        We’ve partnered with Guitar Center to bring you the ultimate lessons + gear combo.
                        <br><br>
                        For a limited time, when you join Drumeo for 1 year of unlimited drum lessons, you’ll get $100 to Guitar Center:
                        <br><br>
                        $50 to your nearest lessons center<br>
                        $50 to spend on gear and goodies
                        <br><br>
                        You’ll have unlimited online lessons, cash for in-person lessons AND a gift card to put toward your next gear purchase. Heads up though…
                        <br><br>
                        It’s only available to the first 1000 students to join.
                        <br><br>
                        <strong>Click the link to grab your deal.</strong>
                        <br>
                        <a class="join smaller musora mt-3 w-1/2 anchor-slide" href="#customize-anchor">GET Started &raquo;</a>
                    </p>
                </div>
                <img class="h-80 lg:h-96 hidden sm:inline transition-opacity opacity-0"
                    loading="lazy"
                    onload="this.classList.remove('opacity-0')"
                    src="https://d21q7xesnoiieh.cloudfront.net/fit-in/690x0/filters:quality(95)/marketing/drumeo/promos/september/promo-image.webp"
                    alt="learn playing image"
                >
            </div>
        </div>
    </section>
    <section class="text-center px-5 sm:px-6 py-6 sm:py-8 lg:py-10 text-white relative" style="background: #0C1524;">
        <div class="container max-w-2xl mx-auto">
            <p class="leading-normal"><em>Only available to students in the United States, in states where Guitar Center operates. Each gift card's total value must be redeemed during the transaction in which it is used.</em></p>
        </div>
    </section>
@endsection

@section('final')
    <section class="py-14 sm:py-24 lg:py-32 relative overflow-hidden text-white text-center customize px-4 lg:px-6"
        style="background: linear-gradient(68deg, #07233E 0%, #0C1524 100%);">
        <div class="container mx-auto relative z-50  max-w-3xl ">
            <div class="w-full px-4 md:px-0">
                <img class="h-10 sm:h-14" src="https://d21q7xesnoiieh.cloudfront.net/fit-in/2000x0/filters:quality(95)/marketing/drumeo/promos/september/logo-white.webp">
                <h2 class="leading-tight my-3 sm:my-4 font-black">
                    Get unlimited drum lessons for a year<br class="hidden sm:inline">
                    + $100 to Guitar Center</h2>
                <p class="text-sm leading-normal">
                    <i class="fas fa-check text-{{ $theme }}"></i> Drumeo Membership
                    <br class="sm:hidden">
                    <i class="fas fa-check lg:ml-5 text-{{ $theme }}"></i> $50 Online/In-Person Gift Card
                    <br class="sm:hidden">
                    <i class="fas fa-check lg:ml-5 text-{{ $theme }}"></i> $50 In-Person Lessons Gift Card
                </p>
            </div>
            <img class="h-24 sm:h-48 lg:h-56 my-5 sm:my-7" src="https://d21q7xesnoiieh.cloudfront.net/fit-in/2000x0/filters:quality(95)/marketing/drumeo/promos/september/order-image.webp">

            <a role="link" aria-label=" Get Started" class="join {{ $theme }} w-full max-w-xs md:max-w-lg lg:max-w-2xl" style="padding: 20px 10px;" href="/ecommerce/add-to-cart?products[DLM-1-year]=1&products[guitar-center-store-gift-card]=1&products[guitar-center-lessons-gift-card]=1&locked=true">GET Started &raquo;</a>
        </div>
    </section>
@endsection
