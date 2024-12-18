<header class="text-center relative overflow-hidden z-10 h-[560px] sm:h-[700px]"
    @if(!empty($bubbles))
    style="background:linear-gradient(to right, #e0ecf9, #f6f8fc, #f6f8fc, #e0ecf9);"
    @else
    style="background:#000;color:#fff;"
    @endif
>
    <div class="transform -translate-y-1/2 top-1/2 left-0 w-full absolute z-20 px-4 sm:px-10 text-center">
        <h1 class="relative w-auto inline-block text-3xl sm:text-5xl lg:text-6xl mb-7 sm:mb-10 font-black font-lexend leading-none sm:leading-none lg:leading-none uppercase">
            {!! $header !!}
        </h1>
        @if(!empty($pointOne))
            <p class="text-sm leading-normal sm:tracking-widest mb-5 lg:mb-7">
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
                @elseif(!empty($promoVersion) && empty($trialVersion))
                    SEE YOUR DEAL &raquo;
                @elseif(!empty($month))
                    30 Days For Free <i class="fas fa-arrow-right" style="line-height: 0;" aria-hidden="true"></i>
                @else
                    7 Days For Free <i class="fas fa-arrow-right" style="line-height: 0;" aria-hidden="true"></i>
                @endif
            </a>
            @if(empty($noTrailer))
                <div class="sm:mx-0.5 w-full sm:w-56 join outline @if(!empty($bubbles)) black @else white @endif smaller autoplay-video" x-on:click="trailer = true;">WATCH THE TRAILER</div>
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
        <div class="transform bottom-0 left-0 w-full absolute z-20 px-4 pb-7 text-center opacity-50">
            <p class="text-sm mb-3">As featured in:</p>
            <img class="inline-block h-5" src="https://musora-image-processing-cdn.s3.us-east-2.amazonaws.com/marketing/drumeo/membership/homepage/2025/nyt.png">
            <img class="inline-block h-5 mx-3" src="https://musora-image-processing-cdn.s3.us-east-2.amazonaws.com/marketing/drumeo/membership/homepage/2025/rs.png">
            <img class="inline-block h-5" src="https://musora-image-processing-cdn.s3.us-east-2.amazonaws.com/marketing/drumeo/membership/homepage/2025/nme.png">
        </div>

        <div class="top-0 left-0 absolute w-full h-full z-10" style="background: hsl(218deg 50% 5% / 70%);"></div>
        <video class="sm:hidden block object-cover w-full relative z-0 h-full" type="video/mp4" autoplay loop playsinline muted src="https://musora-image-processing-cdn.s3.us-east-2.amazonaws.com/marketing/musora/membership/homepage/2024/header6-m.mp4"></video>
        <video class="hidden sm:block object-cover w-full relative z-0 h-full" type="video/mp4" autoplay loop playsinline muted src="https://musora-image-processing-cdn.s3.us-east-2.amazonaws.com/marketing/musora/membership/homepage/2024/header3.mp4"></video>
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
