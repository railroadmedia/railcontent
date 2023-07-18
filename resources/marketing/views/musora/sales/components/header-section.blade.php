<header class="sm:px-6 pb-10 sm:py-12 lg:py-16" style="background:#f6f8fc;">
    <div class="container max-w-6xl mx-auto">
        <div class="flex flex-wrap sm:flex-nowrap items-center">
            <div class="w-full sm:w-7/12 sm:pr-6 text-center lg:text-left">
                <div x-on:click="trailer = true;" alt="header image" class="mb-5 overflow-hidden relative block sm:hidden bg-cover bg-top cursor-hover autoplay-video relative"
                    @if(!empty($promoVersion) || !empty($shortHeader))
                        style="background-image:url();padding-bottom: 60%;"
                    @else
                        style="background-image:url();padding-bottom: 75%;"
                    @endif
                >
                    <img class="absolute inset-0 object-cover w-full" src="https://www.musora.com/musora-cdn/image/width=700,quality=95/{{ !empty($thumbM) ? $thumbM : $thumb }}" alt="Header thumbnail" />
                    <div class="join white smaller absolute bottom-1 left-1"><i class="fas fa-play"></i> Watch Trailer</div>
                </div>
                <div class="px-5 sm:px-0">
                    <h1 class="rotater-text text-{{ $theme }}"><strong>{!! $header !!}</strong></h1>
                    <h6 class="leading-tight mt-4 lg:mt-6 mb-4 sm:mb-2"><strong>{!! $desc !!}</strong></h6>
                    <p class="hidden lg:inline">
                        <i class="fas fa-check text-{{ $theme }}"></i> {!! $pointOne !!}
                        <i class="ml-2 fas fa-check text-{{ $theme }}"></i> {!! $pointTwo !!}
                        <i class="ml-2 fas fa-check text-{{ $theme }}"></i> {!! $pointThree !!}
                    </p>
                    <div class="flex inline lg:hidden">
                        <p class="w-1/3 leading-tight"><i class="fas fa-check text-{{ $theme }}"></i><br> {!! $pointOne !!}</p>
                        <p class="w-1/3 leading-tight"><i class="fas fa-check text-{{ $theme }}"></i><br> {!! $pointTwo !!}</p>
                        <p class="w-1/3 leading-tight"><i class="fas fa-check text-{{ $theme }}"></i><br> {!! $pointThree !!}</p>
                    </div>
                    @if(!empty($specialBadge))
                        <div class="flex flex-wrap items-center justify-center sm:justify-start mt-6 sm:mt-5 lg:mt-10 -mb-6 sm:-mb-5 lg:-mb-10 pb-4">
                            <h5 class="inline-block leading-tight mx-0 py-1 px-2 rounded-md inline-block w-auto" style="background: linear-gradient(330deg, #79EE9A, #12E3FF, #79EE9A);">{!! $specialBadge !!}</h5>
                        </div>
                    @endif
                    @if(!empty($specialText))
                        <div class="flex flex-wrap items-center justify-center sm:justify-start mt-6 sm:mt-5 lg:mt-10 -mb-6 sm:-mb-5 lg:-mb-10 pb-4">
                            <p class="inline-block leading-tight text-sm mx-0"><em>{!! $specialText !!}</em></p>
                        </div>
                    @endif
                    <div class="flex flex-wrap items-center justify-center sm:justify-start mt-6 sm:mt-5 lg:mt-10 sm:max-w-xs">
                        <a class="w-full join bg-{{ $theme }} smaller mb-2 @if(!empty($promoVersion)) anchor-slide @endif"
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
                        <a aria-label="Review" class="inline-block" href="https://www.shopperapproved.com/reviews/Musora.com" target="_blank" onclick="window.open('https://www.shopperapproved.com/reviews/Musora.com', 'newwindow', 'width=750, height=550'); return false;">
                            <i class="align-middle text-lg fas fa-star" style="color: #ffac00;"></i>
                            <i class="align-middle text-lg -ml-3 fas fa-star" style="text-shadow: -2px -1px 1px #f6f8fc;color: #ffac00;"></i>
                            <i class="align-middle text-lg -ml-3 fas fa-star" style="text-shadow: -2px -1px 1px #f6f8fc;color: #ffac00;"></i>
                            <i class="align-middle text-lg -ml-3 fas fa-star" style="text-shadow: -2px -1px 1px #f6f8fc;color: #ffac00;"></i>
                            <i class="align-middle text-lg -ml-3 fas fa-star" style="text-shadow: -2px -1px 1px #f6f8fc;color: #ffac00;"></i>
                        </a>
                        <p class="inline-block leading-tight text-sm align-middle pl-2 m-0"><em>Trusted by {{ number_format(Prices::$students) }} active students.</em></p>
                    </div>
                </div>
            </div>
            <div class="w-full sm:w-5/12 hidden sm:block">
                    <div x-on:click="trailer = true;"
{{--                        @if(!empty($promoVersion))--}}
{{--                            class="relative bg-contain bg-top bg-no-repeat cursor-pointer autoplay-video" style="background-image:url(https://www.musora.com/musora-cdn/image/width=850,quality=95/{!! $promoThumb !!});padding-bottom: 108%;"--}}
{{--                        @else--}}
                            class="bg-no-repeat @if(empty($noThumbShadow)) shadow-2xl bg-cover @else bg-contain @endif rounded-xl aspect-1:1 overflow-hidden relative bg-top cursor-pointer autoplay-video" style="background-image:url(https://www.musora.com/musora-cdn/image/width=850,quality=95/{!! $thumb !!});"
{{--                        @endif--}}
                        >
                        <div class="join white smaller absolute bottom-2 left-2"><i class="fas fa-play"></i> Watch Trailer</div>
                    </div>
            </div>
        </div>
        <div class="px-5 sm:px-0">
            <div class="flex flex-wrap sm:flex-nowrap text-center border-2 rounded-xl border-{{ $theme }} mt-8 lg:mt-12 relative"
{{--                style="background-color:#eaf1fa;"--}}
            >
                    <div class="z-10 flex flex-wrap sm:flex-nowrap items-start justify-evenly w-full sm:w-auto sm:flex-grow py-4 sm:py-3 lg:py-4 lg:px-5 text-left sm:text-center">
                        @foreach ($features as $key => $feature)
                            <div class="flex sm:block w-full sm:w-auto px-4 sm:px-3 my-2 sm:mb-0">
                                <img
                                    src="https://www.musora.com/musora-cdn/image/{{ $feature['image'] }}"
                                    class="h-5 sm:h-7 mb-2 mr-4 sm:mr-0 transition-opacity opacity-0"
                                    alt="feature image{{$key+1}}"
                                    loading="lazy"
                                    onload="this.classList.remove('opacity-0')"
                                >
                                <p class="leading-tight mx-0"><strong class="font-black">{{ $feature['title'] }}</strong><br>
                                    <span class="text-sm">{!!  $feature['desc']  !!}</span></p>
                            </div>
                        @endforeach
                    </div>
                <div class="absolute inset-0 z-0 bg-{{ $theme }}" style="opacity: 0.07;"></div>
                </div>
        </div>
    </div>
</header>
<section class="sm:px-6 py-4 sm:py-5 text-white" style="background:#0c1524;">
    <div class="container max-w-4xl mx-auto">
        @component('_partials.components.carousel',[
            'xdata' => "
                classes: {
                    arrow: 'splide__arrow bg-white opacity-100 shadow-lg h-11 w-11 header-slide-btn',
                    prev: 'hidden',
                    next: 'splide__arrow--next your-class-next hidden sm:flex z-50',
                    pagination: 'hidden',
                },
                perPage: 1,
                perMove: 1,
                type: 'loop',
                interval: 2000,
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
                                    src="https://www.musora.com/musora-cdn/image/width=80,quality=95/{{ $slide['thumb'] }}"
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
