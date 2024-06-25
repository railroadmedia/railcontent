<div id="testimonials" class="anchor"></div>

<section class="py-10 sm:py-14 lg:py-20 relative overflow-hidden text-center px-3 lg:px-5"
    @isset($bgColor)
        style="background: {{ $bgColor }};"
    @else
        style="background:linear-gradient(to bottom, #fff, #F6F8FC);"
    @endisset
    x-data="{
        @foreach ($testimonials as $testimonial)
            {{ str_replace(' ', '', $testimonial['name']) }} : false, @endforeach
    }">

    <div class="container mx-auto max-w-6xl mb-12">
        <h2 class="font-lexend uppercase leading-none"><strong>
                @if ($theme != 'musora')
                    Trusted by<br class="hidden sm:inline"> {!! $header !!} everywhere.
                @else
                    {!! $header !!}
                @endif
            </strong></h2>
        <img alt="star ratings" class="h-11 my-3 opacity-0 transition-opacity" loading="lazy"
            onload="this.classList.remove('opacity-0')"
            src="https://d21q7xesnoiieh.cloudfront.net/fit-in/400x0/filters:quality(95)/marketing/musora/membership/homepage/2024/stars.png">
        <p class="mx-auto mb-7">
            Rated 4.8/5 based on <strong class="font-black">
                @if ($theme == 'drumeo')
                    {{ number_format(1958) }}
                @else
                    {{ number_format(Prices::$reviews) }}
                @endif
                student reviews.
            </strong>
            <a role="link" aria-label="Link to shopperapproved" class="inline-block" target="_blank"
                @if ($theme == 'drumeo') href="https://www.shopperapproved.com/reviews/Musora.com/product/Drumeo+Membership/7918738"
                    onclick="window.open('https://www.shopperapproved.com/reviews/Musora.com/product/Drumeo+Membership/7918738', 'newwindow', 'width=750, height=550'); return false;"
                @else
                    href="https://www.shopperapproved.com/reviews/Musora.com"
                    onclick="window.open('https://www.shopperapproved.com/reviews/Musora.com', 'newwindow', 'width=750, height=550'); return false;" @endif>
                <strong class="font-black text-{{ $theme }}"><u>See the reviews »</u></strong>
            </a>
        </p>

        <div class="container max-w-5xl mx-auto mb-10">
            <div class="aspect-16:9 w-full relative">
                <iframe class="absolute w-full h-full rounded-xl" src="//player.vimeo.com/video/963340669?autoplay=1" frameborder="0" allowfullscreen="" allow="autoplay" title="Musora Students"></iframe>
            </div>
        </div>

        <div x-data="{
            splideInitialized: false,
            initSplide() {
                if (this.splideInitialized) return; 
                new Splide(this.$refs.splide, {
                            classes: {
                                arrow: 'splide__arrow bg-white opacity-100 bottom-0 transform -translate-y-1/2 shadow-lg h-11 w-11',
                                prev: 'splide__arrow--prev your-class-prev hidden sm:flex -left-1',
                                next: 'splide__arrow--next your-class-next hidden sm:flex -right-1',
                                pagination: 'splide__pagination md:inline -bottom-10',
                            },
                            perPage: 4,
                            type: 'loop',
                            drag: false,
                            arrows: false,
                            gap: '0.7rem',
                            pagination: false,
                            perMove: 1,
                            focus: 0,
                            autoplay: false,
                            pauseOnHover: true,
                            pauseOnFocus: true,
                            interval: 5000,
                            lazyLoad: 'nearby',
                            breakpoints: {
                                960: {
                                    perPage: 2,
                                    arrows: true,
                                    pagination: false,
                                    padding: '2.5rem',
                                },
                                767: {
                                    perPage: 2,
                                    pagination: false,
                                },
                                620: {
                                    drag: 'free',
                                    snap: false,
                                    padding: '10px',
                                    perPage: 1.5,
                                    pagination: true,
                                    arrows: false,
                                },
                            },
                }).mount();
            this.splideInitialized = true;
            }
        }" x-intersect="initSplide()" class="container max-w-7xl relative">
            <div x-ref="splide" class="splide mb-28 md:mb-20">
                <div class="splide__track">
                    <ul class="splide__list">
                        @foreach ($testimonials as $index => $testimonial)
                        <li class="splide__slide flex px-1 min-h-[390px] md:min-h-[500px]">
                            <div class="flex flex-wrap items-start w-full sm:px-3 mb-5 sm:mb-8 relative p-2 pb-5 rounded-xl"
                                @if (!empty($testimonial['video'])) 
                                    x-on:click="{{ str_replace(' ', '', $testimonial['name']) }} = true;" 
                                @endif
                                style="background: linear-gradient(to top, #000, transparent), url('{{ $testimonial['avatar'] }}'); background-size: cover; background-position: center;">
                                <i class="cursor-pointer absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 fas @if (!empty($testimonial['video'])) fa-play @else fa-align-left @endif text-2xl text-white border-2 border-white px-5 md:px-8 py-3 md:py-6 rounded-full bg-[#0009] hover:opacity-80 z-10"></i>
                                <div class="absolute bottom-0 left-0 right-0 px-3 sm:px-5 pb-4 sm:pb-7 flex items-end rounded-b-xl" style="background:linear-gradient(to top, #000, transparent);">
                                    <div class="flex flex-col justify-between text-left">
                                        <div>
                                            <p class="leading-normal text-xs mt-3 sm:mt-0 mb-2 lg:mb-4 text-white">
                                                <em>{!! $testimonial['title'] !!}</em>
                                            </p>
                                        </div>
                                        <div>
                                            <p class="leading-tight mx-0 text-white">{{ $testimonial['name'] }}</p>
                                            @if (!empty($testimonial['location']))
                                                <p class="leading-tight mx-0 text-sm text-musora">
                                                    <em>{{ $testimonial['location'] }}</em>
                                                </p>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
        @if (!empty($desktopGrid))
            <div class=" hidden sm:flex flex-wrap">
                @foreach ($testimonials as $testimonial)
                    <div class="flex flex-col items-start px-1 w-1/4 mb-3">
                        <div class="relative mb-2 w-full overflow-hidden rounded-xl cursor-pointer"
                            style="padding-bottom: 66%;"
                            x-on:click="{{ str_replace(' ', '', $testimonial['name']) }} = true;">
                            <div class="absolute inset-0 bg-cover bg-top"
                                :class="{ 'opacity-0': !lazyLoad, 'opacity-100': lazyLoad }"
                                :style="`background-image:url({{ $testimonial['image'] }}); background-color: rgba(0, 0, 0, 0.6)`"
                                x-intersect.once="lazyLoad = true"></div>
                            <div class="absolute inset-0 flex justify-center align-center">
                                <i
                                    class="absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 fas @if (!empty($testimonial['video'])) fa-play @else fa-align-left @endif text-lg text-white border-2 border-white px-3 py-1 rounded-full bg-[#0009] hover:opacity-80"></i>
                            </div>
                        </div>
                        <div class="w-full text-center">
                            <div class="font-bold text-sm leading-snug mb-2">{!! $testimonial['title'] !!}</div>
                            <p class="text-sm">{{ $testimonial['name'] }}</p>
                            @if (!empty($testimonial['brand']))
                                <p class="mt-1 text-xs cursor-pointer
                                                @if ($testimonial['brand'] == 'Drummer') text-drumeo
                                                @elseif($testimonial['brand'] == 'Pianist')
                                                text-pianote
                                                @elseif($testimonial['brand'] == 'Guitarist')
                                                text-guitareo
                                                @else
                                                text-singeo @endif
                                                "
                                    x-on:click="{{ str_replace(' ', '', $testimonial['name']) }} = true;">
                                    {{ $testimonial['brand'] }}
                                </p>
                            @else
                                <p class="mt-1 text-xs text-{{ $theme }} cursor-pointer"
                                    x-on:click="{{ str_replace(' ', '', $testimonial['name']) }} = true;">
                                    @if (!empty($testimonial['video']))
                                        Watch video
                                    @else
                                        Read more
                                    @endif
                                </p>
                            @endif
                        </div>
                    </div>
                @endforeach

            </div>
        @endif
        @if (!empty($youtube))
            <div class="flex flex-wrap items-start justify-center mx-auto mt-10 sm:mt-16 lg:mt-20 max-w-3xl">
                <div class="w-1/3 sm:px-2 mb-4 py-1 sm:py-4 lg:py-5" style="color:#cd201f;">
                    <a href="{{ $youtubeLink }}" target="_blank" aria-label="Youtube Link" role="link"> <i
                            class="fab fa-youtube text-4xl sm:text-5xl"></i>
                    </a>
                    <h2 class="font-black leading-none my-1 sm:my-2 text-black">{{ $youtube }}</h2>
                    <p class="uppercase sm:tracking-widest">Subscribers</p>
                </div>
                <div class="w-1/3 sm:px-2 mb-4 py-1 sm:py-4 lg:py-5" style="color:#3b5998;">
                    <a href="{{ $facebookLink }}" target="_blank" aria-label="Facebook Link" role="link"> <i
                            class="fab fa-facebook-f text-4xl sm:text-5xl"></i> </a>
                    <h2 class="font-black leading-none my-1 sm:my-2 text-black">{{ $facebook }}</h2>
                    <p class="uppercase sm:tracking-widest">Likes</p>
                </div>
                <div class="w-1/3 sm:px-2 mb-4 py-1 sm:py-4 lg:py-5 instagram">
                    <a href="{{ $instagramLink }}" target="_blank" aria-label="Instagram Link" role="link"> <i
                            class="fab fa-instagram text-4xl sm:text-5xl"
                            style="background: linear-gradient(30deg, #FFD521 17%, #F20008 50%, #B900B4 83%);-webkit-background-clip: text;-webkit-text-fill-color: transparent;"></i>
                    </a>
                    <h2 class="font-black leading-none my-1 sm:my-2">{{ $instagram }}</h2>
                    <p class="uppercase sm:tracking-widest" style="color:#E1306C">Followers</p>
                </div>
            </div>
        @endif
    </div>
    @foreach ($testimonials as $testimonial)
        @if (!empty($testimonial['video']))
            @include('_partials.components.video-modal', [
                'name' => str_replace(' ', '', $testimonial['name']),
                'video' => $testimonial['video'],
                'vimeo' => true,
            ])
        @else
            @component('_partials.components.modal', ['name' => str_replace(' ', '', $testimonial['name'])])
                @slot('content')
                    <div class="overflow-hidden rounded-xl max-w-sm mx-auto">
                        <img class="opacity-0 transition-opacity" loading="lazy" onload="this.classList.remove('opacity-0')"
                            src="{{ $testimonial['image'] }}" alt="{{ $testimonial['name'] }}" />
                        <div class="bg-white p-4">
                            <h2 class="leading-none font-bebas">{{ $testimonial['name'] }}</h2>
                            <p class="text-coaches uppercase mx-auto mb-3 md:mb-2">{!! $testimonial['location'] !!}</p>
                            <p class="mx-auto text-left leading-normal md:leading-normal">{!! $testimonial['title'] !!}</p>
                        </div>
                    </div>
                @endslot
            @endcomponent
        @endif
    @endforeach
</section>

