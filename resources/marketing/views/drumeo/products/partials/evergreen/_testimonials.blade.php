<section class="pt-14 md:pt-28 pb-40 md:pb-50" style="background: {{ $bgColor }}">
        <!-- top part-->
    @if (!empty($showTop))
    <div class="text-center text-white">
        <h2 class="leading-tight mb-4"><strong>{{ $title }}</strong></h2>
            @if (isset($subTitle))
                <p>{{ $subTitle }}</p>
            @endif
            <a class="inline-block w-full pt-4" href="https://www.shopperapproved.com/reviews/Musora.com" target="_blank"
            onclick="window.open('https://www.shopperapproved.com/reviews/Musora.com', 'newwindow', 'width=750, height=550'); return false;" role="button">
            <img alt="stars" class="h-8 sm:h-9 lg:h-10 mb-2 mx-auto transition-opacity opacity-0"
                src="https://d21q7xesnoiieh.cloudfront.net/fit-in/300x0/filters:quality(95)/marketing/drumeo/products/30-day-drummer/five-stars.svg"
                loading="lazy" onload="this.classList.remove('opacity-0')">
        </a>

        @include('drumeo.products.partials._social-icons-testimonials', [
            'socialIcons' => $socialIcons,
        ])
    </div>
    @endif
    <!-- bottom part-->
@if (!empty($showBottom))
    <div class="container max-w-5xl mx-auto text-center text-white px-4">
        <h2 class="p-4"><strong>{{ $subHeader }}</strong></h2>
        <h4 class="py-2 md:py-4 leading-tight">{{ $description }}</h4>
    </div>
    <!-- carousel -->

    <div class="max-w-5xl mx-auto px-5 sm:px-6 mb-10 sm:mb-0">
        <div x-data="{
            init() {
                new Splide(this.$refs.splide, {
                    classes: {
                        arrow: 'splide__arrow bg-white opacity-100 top-[50%] shadow-lg h-11 w-11 text-[#0B76DB]',
                        prev: 'hidden',
                        next: 'splide__arrow--next hidden sm:flex mb-16',
                        pagination: 'splide__pagination -bottom-10',
                    },
                    perPage: 2.5,
                    perMove: 1,
                    type: 'loop',
                    focus: 0,
                    interval: 2000,
                    breakpoints: {
                        800: {
                            perPage: 2.5,
                        },
                        769: {
                            perPage: 1.5,
                            drag: 'free',
                            snap: false,
                        },
                    },
                }).mount()
            },
        }">
            <div x-ref="splide" class="splide sm:mb-9">
                <div class="splide__track">
                    <ul class="splide__list items-start" style="padding-top: 60px !important;">

                        @foreach ($testimonials as $testimonial)
                        <li class="splide__slide bg-[#F4F8FB] rounded-xl pb-6 px-8 mr-4 text-center">
                            <div class="-mt-10 mb-6">
                                <img class="rounded-full w-[90px] h-[90px] object-cover lazyload"
                                    data-src="https://www.musora.com/musora-cdn/image/width=130,quality=95/{{ $testimonial['img'] }}"
                                    alt="{{ $testimonial['name'] }} avatar" />
                            </div>
                            <h6 class="mb-1"> <strong>{{ $testimonial['name'] }}</strong> </h6>
                            @if (isset($students))
                                <p><i>{{ $students }}</i></p>
                            @endif
                            @if (isset($location))
                                <p><i>{{ $location }}</i></p>
                            @endif
                            <img class="my-4"
                                src="https://www.musora.com/musora-cdn/image/width=200,quality=85/https://dpwjbsxqtam5n.cloudfront.net/drum-shop/30-day-drummer/season3/stars.svg"
                                alt="stars" />
                            <p class="mb-6">“{!! $testimonial['comment'] !!}”</p>
                        </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>
    @endif
</section>
