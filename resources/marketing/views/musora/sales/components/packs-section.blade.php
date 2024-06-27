<section class="px-4 lg:px-6 py-12 md:py-20 text-center">
    <div class="max-w-6xl mx-auto">
        <h2 class="leading-tight font-extrabold">{!! $header !!}</h2>
        <p class="leading-tight px-4 md:px-0 mt-3 mb-5 sm:mb-7 mx-auto">{!! $desc !!}</p>
        <div
            x-data="{
                    init() {
                        new Splide(this.$refs.splide, {
                            classes: {
                                    arrow: 'splide__arrow bg-white opacity-100 shadow-lg h-11 w-11',
                                    prev: 'splide__arrow--prev your-class-prev hidden sm:flex -left-1',
                                    next: 'splide__arrow--next your-class-next hidden sm:flex -right-1',
                                    pagination: 'splide__pagination flex -bottom-10',
                            },
                            padding: '3rem',
                            perPage: 4,
                            perMove: 1,
                            type: 'loop',
                            focus: 0,
                            interval: 2000,
                            lazyLoad: 'nearby',
                            breakpoints: {
                                1020: {
                                    padding: '2rem',
                                },
                                720: {
                                    padding: '3rem',
                                    perPage: 3,
                                    drag   : 'free',
                                    snap   : false,
                                },
                                620: {
                                    padding: '1rem',
                                    perPage: 2,
                                },
                            },
                        }).mount()
                    },
                }"
        >
            <div x-ref="splide" class="splide">
                <div class="splide__track">
                    <ul class="splide__list">
                        @foreach ($packs as $index => $pack)
                            <li class="splide__slide flex flex-col items-center justify-center px-1">
                                <picture>
                                    <source media="(min-width:640px)" data-srcset="https://d21q7xesnoiieh.cloudfront.net/fit-in/320x0/filters:quality(95)/{{$pack['image']}}">
                                    <img
                                        class="rounded-xl overflow-hidden transition-opacity opacity-0 duration-300"
                                        data-splide-lazy="https://d21q7xesnoiieh.cloudfront.net/fit-in/490x0/filters:quality(95)/{{$pack['image']}}"
                                        onload="this.classList.remove('opacity-0');"
                                    />
                                </picture>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>

        <div class="text-center mt-16 lg:mt-20 px-4 sm:px-0">
            @if(empty($promoVersion))
                <a href="/coaches" class="sm:mx-1 mb-2 sm:mb-0 w-full sm:w-72 join outline black smaller">EXPLORE COURSES</a>
            @endif
            <a class="sm:mx-1 w-full sm:w-64 join @if($theme != 'musora') {{ $theme }} @else musora-gold @endif smaller @if(!empty($promoVersion)) anchor-slide @endif"
                @if(!empty($promoVersion))
                    href="#customize-anchor"
                aria-label="Customize Anchor"
                @elseif(!empty($month))
                    href="/choose-your-trial-month"
                aria-label="Choose Your Trial Month"
                @else
                    href="/choose-plan"
                aria-label="Choose Plan"
                @endif
            >
                @if(!empty($promoVersion) && empty($trialVersion))
                    SEE YOUR DEAL &raquo;
                @else
                    START FOR FREE <i class="fas fa-arrow-right" style="line-height: 0;"></i>
                @endif
            </a>
        </div>
    </div>
</section>
