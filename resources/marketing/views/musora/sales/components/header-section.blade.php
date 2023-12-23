<header class="text-center px-5 sm:px-6 py-44 sm:py-52 lg:py-56 relative overflow-hidden" style="background:linear-gradient(to right, #e0ecf9, #f6f8fc, #f6f8fc, #e0ecf9);">
    <div class="container max-w-6xl mx-auto relative z-20">
        <h1 class="relative w-auto inline-block text-3xl sm:text-5xl lg:text-6xl">
            <strong>{!! $header !!}</strong>
            @if(!empty($underline))
                <svg class="w-64 sm:w-72 lg:w-96 sm:absolute -mt-4 sm:mt-0 sm:-bottom-1 sm:px-6" style="right:6%;"
                    xmlns="http://www.w3.org/2000/svg" width="524" height="22" viewBox="0 0 524 22" fill="none">
                    <path d="M1.99978 10.6328C84.053 4.08508 302.889 -3.20824 521.809 20" stroke="@if(!empty($fillColor)) {{ $fillColor }} @else #ffac00 @endif" stroke-width="3" stroke-linecap="round"/>
                    <path d="M2.17373 15.0541C83.9528 7.29382 302.406 -3.51921 521.988 15.3111" stroke="@if(!empty($fillColor)) {{ $fillColor }} @else #ffac00 @endif" stroke-width="3" stroke-linecap="round"/>
                </svg>
            @endif
        </h1>
        <p class="text-sm leading-normal tracking-widest sm:mt-10 mb-5 lg:mt-10 lg:mb-7">
            <i class="fas fa-check text-{{ $theme }}"></i> {!! $pointOne !!}
            <i class="fas fa-check ml-3 sm:ml-5 text-{{ $theme }}"></i> {!! $pointTwo !!}
            <br class="lg:hidden">
            <i class="fas fa-check lg:ml-5 text-{{ $theme }}"></i> {!! $pointThree !!}
            <i class="fas fa-check ml-3 sm:ml-5 text-{{ $theme }}"></i> {!! $pointFour !!}
        </p>
        <div class="flex flex-wrap justify-center">
            <a class="sm:mx-0.5 w-64 sm:w-56 join {{ $theme }} smaller sm:order-1 mb-2 sm:mb-0 @if(!empty($promoVersion)) anchor-slide @endif"
                @if(!empty($promoVersion))
                    href="#customize-anchor"
                @elseif(!empty($month))
                    href="/choose-your-trial-month"
                @else
                    href="/choose-plan"
                @endif
            >
                @if(!empty($promoVersion) && empty($trialVersion))
                    @if(!empty($cta))
                        {!! $cta !!}
                    @else
                        SEE YOUR DEAL &raquo;
                    @endif
                @elseif(!empty($month))
                    30 Days For Free <i class="fas fa-arrow-right" style="line-height: 0;"></i>
                @else
                    7 Days For Free <i class="fas fa-arrow-right" style="line-height: 0;"></i>
                @endif
            </a>
            @if(empty($noTrailer))
                <div class="sm:mx-0.5 w-64 sm:w-56 join outline black smaller autoplay-video" x-on:click="trailer = true;">WATCH THE TRAILER</div>
            @endif
        </div>
        <div class="flex flex-wrap items-center justify-center mt-2 sm:mt-3 mx-auto">
            <a aria-label="Review" class="inline-block" href="https://www.shopperapproved.com/reviews/Musora.com" target="_blank" onclick="window.open('https://www.shopperapproved.com/reviews/Musora.com', 'newwindow', 'width=750, height=550'); return false;">
                <i class="align-middle text-lg fas fa-star" style="color: #ffac00;" aria-hidden="true"></i>
                <i class="align-middle text-lg -ml-4 fas fa-star" style="text-shadow: -2px -1px 1px #f6f8fc;color: #ffac00;" aria-hidden="true"></i>
                <i class="align-middle text-lg -ml-4 fas fa-star" style="text-shadow: -2px -1px 1px #f6f8fc;color: #ffac00;" aria-hidden="true"></i>
                <i class="align-middle text-lg -ml-4 fas fa-star" style="text-shadow: -2px -1px 1px #f6f8fc;color: #ffac00;" aria-hidden="true"></i>
                <i class="align-middle text-lg -ml-4 fas fa-star" style="text-shadow: -2px -1px 1px #f6f8fc;color: #ffac00;" aria-hidden="true"></i>
            </a>
            <p class="inline-block leading-tight text-xs align-middle pl-1 m-0"><em>Trusted by {{ number_format(Prices::$students) }} active students.</em></p>
        </div>
    </div>
        {{-- <picture>
            <source media="(min-width:640px)" srcset={{ $bubble1 }}>
            <img class="absolute z-10 h-10 sm:h-14 lg:h-16 transform -translate-x-1/2 -translate-y-1/2 top-[53%] sm:top-[53%] left-[4%] sm:left-[4%]"
                src="{{ $bubble1 }}" alt="header circle image" fetchpriority="high">
        </picture>
        <picture>
            <source media="(min-width:640px)" srcset={{ $bubble2 }}>
            <img class="absolute z-10 h-24 sm:h-28 lg:h-44 transform -translate-x-1/2 -translate-y-1/2 top-[13%] sm:top-[21%] left-[8%] sm:left-[10%]"
                src={{ $bubble2 }} alt="header circle image" fetchpriority="high">
        </picture>
        <picture>
            <source media="(min-width:640px)" srcset={{ $bubble3 }}>
            <img class="absolute z-10 h-32 sm:h-40 lg:h-52 transform -translate-x-1/2 -translate-y-1/2 top-[84%] sm:top-[81%] left-[9%] sm:left-[18%]"
                src={{ $bubble3 }} alt="header circle image" fetchpriority="high">
        </picture>
        <picture>
            <source media="(min-width:640px)" srcset={{ $bubble4 }}>
            <img class="absolute z-10 h-10 sm:h-12 lg:h-16 transform -translate-x-1/2 -translate-y-1/2 top-[13%] sm:top-[13%] left-[31%] sm:left-[31%]"
                src={{ $bubble4 }} alt="header circle image" fetchpriority="high">
        </picture>
        <picture>
            <source media="(min-width:640px)" srcset={{ $bubble5 }}>
            <img class="absolute z-10 h-10 sm:h-12 lg:h-16 transform -translate-x-1/2 -translate-y-1/2 top-[8%] sm:top-[8%] left-[58%] sm:left-[58%]"
                src={{ $bubble5 }} alt="header circle image" fetchpriority="high">
        </picture>
        <picture>
            <source media="(min-width:640px)" srcset={{ $bubble6 }}>
            <img class="absolute z-10 h-28 sm:h-32 lg:h-48 transform -translate-x-1/2 -translate-y-1/2 top-[88%] sm:top-[88%] left-[90%] sm:left-[78%]"
                src={{ $bubble6 }} alt="header circle image" fetchpriority="high">
        </picture>
        <picture>
            <source media="(min-width:640px)" srcset={{ $bubble7 }}>
            <img class="absolute z-10 h-28 sm:h-36 lg:h-52 transform -translate-x-1/2 -translate-y-1/2 top-[13%] sm:top-[18%] left-[93%] sm:left-[87%]"
                src={{ $bubble7 }} alt="header circle image" fetchpriority="high">
        </picture>
        <picture>
            <source media="(min-width:640px)" srcset={{ $bubble8 }}>
            <img class="absolute z-10 h-12 sm:h-14 lg:h-16 transform -translate-x-1/2 -translate-y-1/2 top-[63%] sm:top-[63%] left-[99%] sm:left-[99%]"
                src={{ $bubble8 }} alt="header circle image" fetchpriority="high">
        </picture> --}}
        @foreach($bubbles as $bubble)
    <picture>
        <source media="(min-width:640px)" srcset="{{ $bubble['src'] }}">
        <img class="{{ $bubble['classes'] }}"
            src="{{ $bubble['src'] }}" alt="header circle image" fetchpriority="high">
    </picture>
@endforeach
</header>
@if(!empty($slides))
    <section class="sm:px-6 py-4 sm:py-5 text-white" style="background:#0c1524;">
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
                ",
            ])
                @slot('content')
                    @foreach ($slides as $slide)
                        <li class="splide__slide">
                            <div class="px-3 md:px-6 text-center">
                                <p class="leading-normal text-sm"><em>“{{ $slide['desc'] }}”</em></p>
                                <div class="flex flex-wrap md:flex-nowrap sm:text-left items-center justify-center mt-1.5">
                                    <img
                                        class="rounded-full object-cover object-right w-9 h-9 transition-opacity opacity-0"
                                        src={{ $slide['thumb'] }}
                                        loading="lazy"
                                        onload="this.classList.remove('opacity-0')"
                                        alt="{{$slide['name']}}"
                                    ><br class="inline md:hidden">
                                    <p class="leading-tight w-full md:w-auto text-sm text-light-navy ml-1 md:ml-2 mr-0 mt-0.5 md:mt-0"><em>{{ $slide['name'] }}, {{ $slide['credit'] }}</em></p>
                                </div>
                            </div>
                        </li>
                    @endforeach
                @endslot
            @endcomponent
        </div>
    </section>
@endif
