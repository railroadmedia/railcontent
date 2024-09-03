<div id="testimonials" class="anchor"></div>
<section class="py-10 sm:py-14 lg:py-20 relative overflow-hidden text-center px-3 lg:px-5"
    @if (!empty($bgColor))
        style="background: {{ $bgColor }};"
    @endif
    x-data="{
        @foreach ($testimonials as $testimonial)
            {{ str_replace(' ', '', $testimonial['name']) }} : false, @endforeach
    }">

    <div class="container mx-auto max-w-6xl mb-12">
        <h2 class="font-lexend uppercase leading-none" @isset($headerBgColor) style="background: {{ $headerBgColor }};" @endisset><strong>
                @if ($theme != 'musora')
                    Trusted by<br class="hidden sm:inline"> {!! $header !!} everywhere.
                @else
                    {!! $header !!}
                @endif
            </strong></h2>
        <img alt="star ratings" class="h-11 my-3 opacity-0 transition-opacity" loading="lazy"
            onload="this.classList.remove('opacity-0')"
            src="https://d21q7xesnoiieh.cloudfront.net/fit-in/400x0/filters:quality(95)/marketing/musora/membership/homepage/2024/stars.png">
        <p class="mx-auto mb-7" @isset($subheaderBgColor) style="background: {{ $subheaderBgColor }};" @endisset>
            Rated 4.8/5 based on <strong class="font-black">
                @if ($theme == 'drumeo')
                    {{ number_format(2023) }}
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

        <div class="container mx-auto mb-10">
            <div class="aspect-16:9 w-full relative">
                <iframe class="absolute w-full h-full rounded-xl" src="//player.vimeo.com/video/963340669"
                    frameborder="0" allowfullscreen="" allow="autoplay" title="Musora Students"></iframe>
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
                            gap: '0.5rem',
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
                                    drag: 'free',
                                    arrows: true,
                                    gap: '0.3rem',
                                    pagination: true,
                                    focus: 1,
                                    padding: '2.5rem',
                                },
                                620: {
                                    padding: '15px',
                                    arrows: false,
                                    focus: 0,
                                    snap: false,
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
                        <li class="splide__slide flex min-h-[290px] md:min-h-[390px]">
                            <div class="flex flex-wrap items-start w-full mb-5 sm:mb-8 relative px-2 pt-2 pb-5 rounded-xl bg-cover bg-top"
                                style="background-image: url('{{ $testimonial['avatar'] }}'); @isset($splideCardBgColor) background-color: {{ $splideCardBgColor }}; @endisset"
                                @if (!empty($testimonial['video']))
                                    x-on:click="{{ str_replace(' ', '', $testimonial['name']) }} = true;"
                                @endif
                                >
                                <i class="cursor-pointer absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 fas @if (!empty($testimonial['video'])) fa-play @else fa-align-left @endif text-2xl text-white border-2 border-white px-5 py-3 rounded-full bg-[#0009] hover:opacity-80 z-10"></i>
                                <div class="absolute bottom-0 left-0 right-0 px-3 sm:px-4 pb-4 sm:pb-6 flex items-end rounded-b-xl">
                                    <div class="flex flex-wrap w-full justify-center">
                                        <h6 class="leading-tight sm:leading-normal w-full mb-2 sm:mb-3 text-white">
                                            <em>"{!! $testimonial['title'] !!}"</em>
                                        </h6>
                                        <p class="leading-tight w-full text-sm text-musora"><strong class="font-black">{{ $testimonial['name'] }}</strong></p>
                                    </div>
                                </div>
                            </div>
                        </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
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