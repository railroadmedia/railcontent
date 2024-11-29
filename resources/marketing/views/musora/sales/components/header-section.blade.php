<header class="text-center px-5 sm:px-6 py-44 sm:py-52 lg:py-56 relative overflow-hidden"
    @if(!empty($testimonialVersion))
    style="background:linear-gradient(to bottom, #fff, #F1EFED);"
    @else
    style="background:linear-gradient(to right, #e0ecf9, #f6f8fc, #f6f8fc, #e0ecf9);"
    @endif
>
    @if(!empty($bfVersion) && ($theme == 'singeo'))
    <img class="h-16 sm:h-20 lg:h-24 mb-3 mx-auto relative" src="https://d21q7xesnoiieh.cloudfront.net/fit-in/900x0/filters:quality(95)/marketing/singeo/promos/november/singeo-CM-header.webp" alt="logo">
    @elseif(!empty($bfVersion) && ($theme == 'guitareo'))
    <img class="h-16 sm:h-20 lg:h-24 mb-3 mx-auto" src="https://d21q7xesnoiieh.cloudfront.net/fit-in/900x0/filters:quality(95)/marketing/guitareo/promos/november/guitareo-CM-header.webp" alt="logo">
    @endif
    <div class="container max-w-6xl mx-auto relative z-20">
        @if(!empty($testimonialVersion))
            <h5 class="leading-tight uppercase"><strong>MUSIC STUDENTS <br class="sm:hidden">PREFER LEARNING HERE</strong></h5>
            <h1 class="overflow-hidden leading-tight text-[35px] sm:text-5xl sm:leading-[76px] rotater-text my-1 sm:my-0" style="height: 100px;font-family: 'Sedgwick Ave', sans-serif!important; ">
                <span class="py-1.5 sm:py-3 relative inline-block delay-1000 ease-in-out">"Like my very own<br class="sm:hidden"> music coach!"</span><br>
                <span class="py-1.5 sm:py-3 relative inline-block delay-1000 ease-in-out">"So positive and<br class="sm:hidden"> uplifting!"</span><br>
                <span class="py-1.5 sm:py-3 relative inline-block delay-1000 ease-in-out">"Convenient and<br class="sm:hidden"> affordable."</span><br>
                <span class="py-1.5 sm:py-3 relative inline-block delay-1000 ease-in-out">"Try it once and<br class="sm:hidden"> you’ll see."</span><br>
                <span class="py-1.5 sm:py-3 relative inline-block delay-1000 ease-in-out">"The best teaching<br class="sm:hidden"> tool ever."</span><br>
            </h1>
        @else
            <h1 class="relative w-auto inline-block text-3xl sm:text-5xl lg:text-6xl mb-7 sm:mb-10 font-black font-lexend leading-none sm:leading-none lg:leading-none uppercase">
                {!! $header !!}
            </h1>
        @endif
        @if(!empty($boldText))
            <h5 class="leading-normal mb-5 lg:mb-7 ">{!!  $boldText  !!}</h5>
        @endif

        @if(!empty($bfVersion) && ($theme == 'singeo' || $theme == 'guitareo'))
        <h5 class="text-{{$theme}} leading-tight"><strong>SAVE $100 ON YOUR FIRST <br class="sm:hidden"> YEAR OF LESSONS.</strong></h5>
        <h6 class="font-light pb-2 md:pb-4">ONLY <span class="opacity-40"><s>$240</s></span> $140 FOR BLACK FRIDAY.</h6>
        @else
            @if(empty($noCheck))
                <p class="text-sm leading-normal sm:tracking-widest mb-5 lg:mb-7">
                    <i class="fas fa-check text-{{ $theme }}"></i> {!! $pointOne !!}
                    <i class="fas fa-check ml-3 sm:ml-5 text-{{ $theme }}"></i> {!! $pointTwo !!}
                    <br class="lg:hidden">
                    <i class="fas fa-check lg:ml-5 text-{{ $theme }}"></i> {!! $pointThree !!}
                    <i class="fas fa-check ml-3 sm:ml-5 text-{{ $theme }}"></i> {!! $pointFour !!}
                </p>
            @endif
        @endif
        @if(!empty($BFheader))
            <h6 class="leading-tight py-2 px-3 bg-[#00D7FF] rounded-lg inline-block mb-5 lg:mb-7"><i class="far fa-badge-percent mr-1"></i> <strong>BLACK FRIDAY SPECIAL:</strong><br class="sm:hidden"> {{ $BFheader }}.</h6>
        @endif
        <div class="flex flex-wrap justify-center max-w-xs sm:max-w-full mx-auto px-5 sm:px-0">
            <a class="sm:mx-0.5 w-full sm:w-56 join {{ $theme }} smaller sm:order-1 mb-2 sm:mb-0 @if(!empty($promoVersion)) anchor-slide @endif"
                @if(!empty($promoVersion))
                    href="#customize-anchor"
                    aria-label="Customize anchor"
                @elseif(!empty($month))
                    href="/choose-your-trial-month"
                    aria-label="Choose your trial month"
                @else
                    href="/choose-plan"
                     aria-label="Choose plan"
                @endif
            >
                @if(!empty($cta))
                    {!! $cta !!}
                @elseif(!empty($promoVersion) && empty($trialVersion))
                    SEE YOUR DEAL &raquo;
                @elseif(!empty($month))
                    30 Days For Free <i class="fas fa-arrow-right" style="line-height: 0;" aria-hidden="true"></i>
                @else
                    7 Days For Free <i class="fas fa-arrow-right" style="line-height: 0;" aria-hidden="true"></i>
                @endif
            </a>
            @if(empty($noTrailer))
                <div class="sm:mx-0.5 w-full sm:w-56 join outline black smaller autoplay-video" x-on:click="trailer = true;">WATCH THE TRAILER</div>
            @endif
            @if(!empty($reviewsButton))
                <a class="sm:mx-0.5 w-full sm:w-56 join outline black smaller"
                    href="https://www.shopperapproved.com/reviews/Musora.com"
                    rel="noopener noreferrer"
                    aria-label="See the reviews on Shopper Approved"
                    onclick="window.open('https://www.shopperapproved.com/reviews/Musora.com', 'newwindow', 'width=750, height=550'); return false;"
                >SEE THE REVIEWS</a>
            @endif
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
@if(!empty($slides))
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
@endif
