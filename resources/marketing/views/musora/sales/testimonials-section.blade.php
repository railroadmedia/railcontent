
{{--    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>--}}
{{--    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@splidejs/splide@4.0.7/dist/css/splide.min.css">--}}
{{--    <script src="https://cdn.jsdelivr.net/npm/@splidejs/splide@4.0.7/dist/js/splide.min.js"></script>--}}
{{--    <style>--}}
{{--        .splide__pagination__page.is-active {--}}
{{--            background: #01050F;--}}
{{--        }--}}
{{--    </style>--}}

<section class="py-10 sm:py-14 lg:py-20 relative overflow-hidden text-center px-3 lg:px-5" x-data="{
        @foreach($testimonials as $testimonial)
            {{ str_replace(' ', '', $testimonial['name']) }} : false,
        @endforeach
    }">

    <div class="container mx-auto max-w-5xl">
        <h3 class="leading-tight mb-3" data-aos="fade-up"><strong>{!! $header !!}</strong></h3>

        <a class="inline-block" href="{{ $reviewLink }}" target="_blank" onclick="window.open('{{ $reviewLink }}', 'newwindow', 'width=750, height=550'); return false;">
            <p class="mx-auto mb-2">{!!  $reviewText  !!} <u>See The Reviews »</u></p>
        </a>
        <br>
        <img alt="" class="h-6 sm:h-8 mb-2 md:mb-0 mx-auto sm:mr-1 lazyload" src="https://cdn.musora.com/image/fetch/w_320,q_auto:best/https://drumeo-assets.s3.amazonaws.com/sales/2023/shopper-approved-icon.svg">


        <div class="flex flex-wrap items-start justify-center mx-auto mt-6">
            <div class="w-1/3 px-1 md:px-2 mb-2 md:mb-4">
                <div class="py-4 md:py-5 lg:py-6 rounded-xl w-full" style="color:#cd201f;">
                    <a href="{{ $youtubeLink }}" target="_blank" aria-label="youtube"> <i class="fab fa-youtube text-3xl md:text-5xl"></i>
                    </a>
                    <h2 class="font-black leading-none my-2 text-black">{{ $youtube }}</h2>
                    <p class="uppercase leading-none md:tracking-widest">Subs<span class="hidden sm:inline-block">cribers</span></p>
                </div>
            </div>
            <div class="w-1/3 px-1 md:px-2 mb-2 md:mb-4">
                <div class="py-4 md:py-5 lg:py-6 rounded-xl w-full" style="color:#3b5998;">
                    <a href="{{ $facebookLink }}" target="_blank" aria-label="facebook"> <i class="fab fa-facebook-f text-3xl md:text-5xl"></i> </a>
                    <h2 class="font-black leading-none my-2 text-black">{{ $facebook }}</h2>
                    <p class="uppercase leading-none md:tracking-widest">Likes</p>
                </div>
            </div>
            <div class="w-1/3 px-1 md:px-2 mb-2 md:mb-4">
                <div class="instagram py-4 md:py-5 lg:py-6 rounded-xl w-full">
                    <a href="{{ $instagramLink }}" target="_blank" aria-label="instagram"> <i class="fab fa-instagram text-3xl md:text-5xl" style="background: linear-gradient(30deg, #FFD521 17%, #F20008 50%, #B900B4 83%);-webkit-background-clip: text;-webkit-text-fill-color: transparent;"></i>
                    </a>
                    <h2 class="font-black leading-none my-2">{{ $instagram }}</h2>
                    <p class="uppercase leading-none md:tracking-widest" style="color:#E1306C">Followers</p>
                </div>
            </div>
        </div>
        <div
            x-data="{
                    init() {
                        new Splide(this.$refs.splide, {
                        classes: {
                                arrow: 'hidden',
                        },
                        perPage: 5,
                        perMove: 1,
                        gap: '0.5rem',
                        type: 'loop',
                        interval: 2000,
                        breakpoints: {
                            1024: {
                                perPage: 4,
                            },
                            720: {
                                perPage: 3,
                            },
                            620: {
                                perPage: 2,
                            },
                        },
                        }).mount()
                    },
                }"
        >
            <section x-ref="splide" class="splide" aria-label="Splide/Alpine.js Carousel Example">
                <div class="splide__track">
                    <ul class="splide__list">
                        @foreach ($testimonials as $testimonial)
                            <li class="splide__slide flex flex-col items-center justify-center pb-8">
                                <div class="relative cursor-pointer mb-2" x-on:click="{{str_replace(' ', '', $testimonial['name'])}} = true;">
                                    <img class="rounded-xl" src="https://cdn.musora.com/image/fetch/w_500,q_auto:best/{{$testimonial['image']}}" alt="{{$testimonial['name']}} testimonial">
                                    <div class="absolute inset-0 flex justify-center align-center">
                                        <i class="absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 fas fa-play text-lg text-white border-2 border-white px-3 py-1 rounded-full bg-[#0009] hover:opacity-80"></i>
                                    </div>
                                </div>
                                <div class="text-center">
                                    <div class="font-bold text-sm leading-snug mb-2">{!! $testimonial['title'] !!}</div>
                                    <p class="text-sm mb-1">{{ $testimonial['name'] }}</p>
                                    <p class="text-xs text-drumeo cursor-pointer" x-on:click="{{str_replace(' ', '', $testimonial['name'])}} = true;">Watch video</p>
                                </div>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </section>
        </div>
    </div>
    @foreach($testimonials as $testimonial)
        @include('_partials.components.video-modal',[
            'name' => str_replace(' ', '', $testimonial['name']),
            'video' => $testimonial['video']
        ])
    @endforeach
</section>
