<header class="text-center relative overflow-hidden z-10 min-h-[700px] h-screen-nav max-h-[1100px]"
    style="
    @if(!empty($bubbles))
    background:linear-gradient(to right, #e0ecf9, #f6f8fc, #f6f8fc, #e0ecf9);
    @else
    background:#000;color:#fff;
    @endif
    "
>
    <div class="transform -translate-y-1/2 top-1/2 left-0 w-full absolute z-20 px-4 sm:px-10 text-center">
        @if(empty($noSubHeader))
            <h4 class="relative w-auto inline-block mb-4 lg:mb-6 font-black font-lexend leading-none uppercase">
                NEW YEAR. <span class="text-{{ $theme }}">NO EXCUSES.</span>
            </h4><br>
        @endif
        <h1 class="relative w-auto inline-block text-3xl sm:text-5xl lg:text-6xl mb-7 sm:mb-10 font-black font-lexend leading-none sm:leading-none lg:leading-none uppercase">
            {!! $header !!}
        </h1>
        @if(!empty($ascension))
                <br>
                <h5 class="relative w-auto inline-block mb-4 lg:mb-6 font-black font-lexend leading-none uppercase">
                    Enjoy all the same lessons for less.
                </h5>
        @endif
        @if(!empty($pointOne))
            <p class="text-sm leading-normal sm:tracking-widest mb-5 lg:mb-7 uppercase">
                <i class="fas fa-check text-{{ $theme }}"></i> {!! $pointOne !!}
                <i class="fas fa-check ml-3 sm:ml-5 text-{{ $theme }}"></i> {!! $pointTwo !!}
                <br class="lg:hidden">
                <i class="fas fa-check lg:ml-5 text-{{ $theme }}"></i> {!! $pointThree !!}
                <i class="fas fa-check ml-3 sm:ml-5 text-{{ $theme }}"></i> {!! $pointFour !!}
            </p>
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
                @elseif(!empty($newYears))
                    Save 20% <i class="fas fa-arrow-right" style="line-height: 0;" aria-hidden="true"></i>
                @elseif(!empty($promoVersion) && empty($trialVersion))
                    SEE YOUR DEAL <i class="fas fa-arrow-right" style="line-height: 0;" aria-hidden="true"></i>
                @elseif(!empty($month))
                    30 Days For Free <i class="fas fa-arrow-right" style="line-height: 0;" aria-hidden="true"></i>
                @else
                    7 Days For Free <i class="fas fa-arrow-right" style="line-height: 0;" aria-hidden="true"></i>
                @endif
            </a>
            @if(empty($noTrailer))
                <div class="sm:mx-0.5 w-full sm:w-56 join outline @if(!empty($bubbles)) black @else white @endif smaller autoplay-video" x-on:click="trailer = true;">@if(!empty($theme) && $theme == 'pianote') 2-MINUTE @else 1-MINUTE @endif TRAILER</div>
            @endif
            @if(!empty($reviewsButton))
                <a class="sm:mx-0.5 w-full sm:w-56 join outline @if(!empty($bubbles)) black @else white @endif smaller"
                    href="https://www.shopperapproved.com/reviews/Musora.com"
                    rel="noopener noreferrer"
                    aria-label="See the reviews on Shopper Approved"
                    onclick="window.open('https://www.shopperapproved.com/reviews/Musora.com', 'newwindow', 'width=750, height=550'); return false;"
                >SEE THE REVIEWS</a>
            @endif
        </div>
        @if(!empty($newYears))
            @if($theme == 'drumeo')
                <p class="leading-tight relative py-3 pl-12 pr-5 mt-7 rounded-xl inline-block mx-auto text-musora" style="background-color:#0C1524;">
                    <img class="absolute top-1/2 -translate-y-1/2 left-0 h-16 -ml-8 inline-block" src="https://d21q7xesnoiieh.cloudfront.net/fit-in/134x0/filters:quality(95)/marketing/drumeo/promos/january/header-bar.webp">
                    Save 20% On Your First Year<br class="sm:hidden"> + <strong>Get 7 Free Bonuses</strong></p>
            @else
                <p class="leading-tight relative py-3 pl-24 pr-5 mt-7 rounded-xl inline-block mx-auto text-musora" style="background-color:#0C1524;">
                    <img class="absolute top-1/2 -translate-y-1/2 left-0 h-16 -ml-8 inline-block" src="https://d21q7xesnoiieh.cloudfront.net/fit-in/242x0/filters:quality(95)/marketing/pianote/promos/january/header-bar.webp">
                    Save 20% On Your First Year<br class="sm:hidden"> + <strong>Get 8 Free Bonuses</strong></p>
            @endif
        @endif
    </div>
    @if(!empty($bubbles))
        @foreach($bubbles as $bubble)
            <picture>
                <source media="(min-width:640px)" srcset="{{ $bubble['src'] }}">
                <img class="absolute z-10 transform -translate-x-1/2 -translate-y-1/2 {{ $bubble['classes'] }}"
                    src="{{ $bubble['src'] }}" alt="header circle image" fetchpriority="high">
            </picture>
        @endforeach
    @else
        @if(!empty($featured) && is_array($featured))
            <div class="transform bottom-0 left-0 w-full absolute z-20 px-4 pb-7 text-center opacity-50">
                <p class="text-sm mb-1 lg:mb-3">As featured in:</p>
                @foreach($featured as $feature)
                    <a href="{{ $feature['url'] }}" target="_blank">
                        <img class="inline-block h-4 sm:h-5 {{ !$loop->last ? 'mr-2 sm:mr-3' : '' }}" src="{{ $feature['src'] }}" alt="Featured logo">
                    </a>
                @endforeach
            </div>
        @endif

        <div class="top-0 left-0 absolute w-full h-full z-10" style="background: hsl(218deg 50% 5% / 70%);"></div>
        @if(!empty($video))
            @if(!empty($videoM))
                <video class="sm:hidden block object-cover w-full relative z-0 h-full" type="video/mp4" autoplay loop playsinline muted src="{{ $video }}"></video>
                <video class="hidden sm:block object-cover w-full relative z-0 h-full" type="video/mp4" autoplay loop playsinline muted src="{{ $videoM }}"></video>
            @else
                <video class="object-cover w-full relative z-0 h-full" type="video/mp4" autoplay loop playsinline muted src="{{ $video }}"></video>
            @endif
        @endif
    @endif
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
