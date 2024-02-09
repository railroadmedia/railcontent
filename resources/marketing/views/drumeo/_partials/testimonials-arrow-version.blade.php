@php
require_once(resource_path('marketing/views/drumeo/_partials/homepage-data.php'));
@endphp

<h2 class="leading-tight mt-14 sm:mt-20 mb-4 sm:mb-5"><strong>… and {{ number_format(Prices::$students) }} happy<br class="sm:hidden"> drum students.</strong></h2>
@php
$testimonials = $drumeo['testimonialsShopVersion'];
@endphp
<div x-data="{
                    splide: null,
                    init() {
                        this.splide = new Splide(this.$refs.splide, {
                            classes: {
                                arrow: 'splide__arrow bg-white opacity-100 top-[50%] shadow-lg h-11 w-11 text-[#0B76DB]',
                                prev: 'hidden',
                                next: 'hidden',
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
                        }).mount();
                    },
                    goNext() {
                        if (this.splide) {
                            this.splide.go('>');
                        }
                    },
                }" class="relative">
    <button class="absolute top-1/3 right-0 transform -translate-y-1/2 z-150 w-20 hidden sm:block" @click="goNext()">
        <img src="https://musora-image-processing-cdn.s3.us-east-2.amazonaws.com/marketing/drumeo/products/kit/arrow-button-blue.svg" alt="Arrow Icon" class="w-10" style="position: absolute; left:50px">
    </button>
    <div x-ref="splide" class="splide" style="width: 95%">
        <div class="splide__track">
            <ul class="splide__list items-start" style="padding-top: 60px !important;">

                @foreach ($testimonials as $testimonial)
                <li class="splide__slide bg-white rounded-xl pb-6 px-8 mr-4 text-center">
                    <div class="-mt-10 mb-6">
                        <img class="rounded-full w-[90px] h-[90px] object-cover" src="https://www.musora.com/musora-cdn/image/width=130,quality=95/{{ $testimonial['img'] }}" alt="{{ $testimonial['name'] }} avatar" />
                    </div>
                    <h6 class="mb-1"> <strong>{{ $testimonial['name'] }}</strong> </h6>
                    <p><i>30-Day Drummer Student</i></p>
                    @if (isset($location))
                    <p><i>{{ $location }}</i></p>
                    @endif
                    <img class="my-4" src="https://www.musora.com/musora-cdn/image/width=200,quality=95/https://dpwjbsxqtam5n.cloudfront.net/drum-shop/30-day-drummer/season3/stars.svg" alt="stars" />
                    <p class="mb-6">“{!! $testimonial['comment'] !!}”</p>
                </li>
                @endforeach
            </ul>
        </div>
    </div>
