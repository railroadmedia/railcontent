<div id="testimonials" class="anchor"></div>
<section class="py-10 sm:py-14 lg:py-20 relative overflow-hidden text-center px-3 lg:px-5" x-data="{
        @foreach($testimonials as $testimonial)
            {{ str_replace(' ', '', $testimonial['name']) }} : false,
        @endforeach
    }">

    <div class="container mx-auto max-w-6xl">
        <h2 class="leading-tight mb-4"><strong>{!! $header !!}</strong></h2>
        @if(!empty($subheadline))
            <p class="mx-auto mb-6">{!!  $subheadline  !!}</p>
        @endif
        <a class="inline-block w-full" href="{{ $reviewLink }}" target="_blank" onclick="window.open('{{ $reviewLink }}', 'newwindow', 'width=750, height=550'); return false;">
            <img
                alt="shopper approved image"
                class="h-8 sm:h-9 lg:h-11 mb-2 mx-auto transition-opacity opacity-0"
                src="https://www.musora.com/musora-cdn/image/width=700,quality=85/https://dmmior4id2ysr.cloudfront.net/homepage/2023/shopper-approved.png"
                loading="lazy"
                onload="this.classList.remove('opacity-0')"
            >
            <p class="mx-auto @if(empty($youtube)) mb-10 sm:mb-16 @endif">{!!  $reviewText  !!} <span class="inline-block @if($theme != 'musora') text-{{ $theme }} @else text-drumeo @endif">See the reviews »</span></p>

        </a>
        @if(!empty($youtube))
            <div class="flex flex-wrap items-start justify-center mx-auto mt-2 sm:mt-6">
                <div class="w-1/3 sm:px-2 mb-4 py-1 sm:py-4 lg:py-5" style="color:#cd201f;">
                    <a href="{{ $youtubeLink }}" target="_blank" aria-label="youtube"> <i class="fab fa-youtube text-4xl sm:text-5xl"></i>
                    </a>
                    <h2 class="font-black leading-none my-1 sm:my-2 text-black">{{ $youtube }}</h2>
                    <p class="uppercase sm:tracking-widest">Subscribers</p>
                </div>
                <div class="w-1/3 sm:px-2 mb-4 py-1 sm:py-4 lg:py-5" style="color:#3b5998;">
                    <a href="{{ $facebookLink }}" target="_blank" aria-label="facebook"> <i class="fab fa-facebook-f text-4xl sm:text-5xl"></i> </a>
                    <h2 class="font-black leading-none my-1 sm:my-2 text-black">{{ $facebook }}</h2>
                    <p class="uppercase sm:tracking-widest">Likes</p>
                </div>
                <div class="w-1/3 sm:px-2 mb-4 py-1 sm:py-4 lg:py-5 instagram">
                    <a href="{{ $instagramLink }}" target="_blank" aria-label="instagram"> <i class="fab fa-instagram text-4xl sm:text-5xl" style="background: linear-gradient(30deg, #FFD521 17%, #F20008 50%, #B900B4 83%);-webkit-background-clip: text;-webkit-text-fill-color: transparent;"></i>
                    </a>
                    <h2 class="font-black leading-none my-1 sm:my-2">{{ $instagram }}</h2>
                    <p class="uppercase sm:tracking-widest" style="color:#E1306C">Followers</p>
                </div>
            </div>
        @endif
        <div class=" @if(!empty($desktopGrid)) block sm:hidden @endif">
            <div
                x-data="{
                    init() {
                        new Splide(this.$refs.splide, {
                            classes: {
                                    arrow: 'splide__arrow bg-white opacity-100 top-[38%] shadow-lg h-11 w-11',
                                    prev: 'hidden',
                                    next: 'splide__arrow--next your-class-next hidden sm:flex -right-1 mb-16',
                                    pagination: 'splide__pagination -bottom-10',
                            },
                            perPage: 4.5,
                            perMove: 1,
                            type: 'loop',
                            focus: 0,
                            interval: 2000,
                            breakpoints: {
                                1000: {
                                    perPage: 3.5,
                                },
                                620: {
                                    perPage: 1.5,
                                },
                            },
                        }).mount()
                    },
                }"
            >
                <section x-ref="splide" class="splide mb-20">
                    <div class="splide__track">
                        <ul class="splide__list">
                            @foreach ($testimonials as $testimonial)
                                <li class="splide__slide flex flex-col items-start px-1">
                                    <div class="relative mb-2 w-full overflow-hidden rounded-xl cursor-pointer" style="padding-bottom: 66%;"
                                        x-on:click="{{str_replace(' ', '', $testimonial['name'])}} = true;"
                                    >
                                        <div class="absolute inset-0 bg-cover bg-top" style="background-image:url(https://www.musora.com/musora-cdn/image/width=500,quality=85/{{$testimonial['image']}});"></div>
                                        <div class="absolute inset-0 flex justify-center align-center">
                                            <i class="absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 fas @if(!empty($testimonial['video'])) fa-play @else fa-align-left @endif text-lg text-white border-2 border-white px-3 py-1 rounded-full bg-[#0009] hover:opacity-80"></i>
                                        </div>
                                    </div>
                                    <div class="w-full text-center">
                                        <div class="font-bold text-sm leading-snug mb-2">{!! $testimonial['title'] !!}</div>
                                        <p class="text-sm">{{ $testimonial['name'] }}</p>
                                            @if(!empty($testimonial['brand']))
                                                <p class="mt-1 text-xs cursor-pointer
                                                @if($testimonial['brand'] == 'Drummer')
                                                text-drumeo
                                                @elseif($testimonial['brand'] == 'Pianist')
                                                text-pianote
                                                @elseif($testimonial['brand'] == 'Guitarist')
                                                text-guitareo
                                                @else
                                                text-singeo
                                                @endif
                                                " x-on:click="{{str_replace(' ', '', $testimonial['name'])}} = true;">
                                                    {{ $testimonial['brand'] }}
                                                </p>
                                            @else
                                                <p class="mt-1 text-xs text-{{ $theme }} cursor-pointer" x-on:click="{{str_replace(' ', '', $testimonial['name'])}} = true;">
                                                    @if(!empty($testimonial['video']))
                                                        Watch video
                                                    @else
                                                        Read more
                                                    @endif
                                                </p>
                                            @endif
                                    </div>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </section>
            </div>
        </div>
        @if(!empty($desktopGrid))
            <div class=" hidden sm:flex flex-wrap">
                @foreach ($testimonials as $testimonial)
                    <div class="flex flex-col items-start px-1 w-1/4 mb-3">
                        <div class="relative mb-2 w-full overflow-hidden rounded-xl cursor-pointer" style="padding-bottom: 66%;"
                            x-on:click="{{str_replace(' ', '', $testimonial['name'])}} = true;"
                        >
                            <div class="absolute inset-0 bg-cover bg-top" style="background-image:url(https://www.musora.com/musora-cdn/image/width=500,quality=85/{{$testimonial['image']}});"></div>
                            <div class="absolute inset-0 flex justify-center align-center">
                                <i class="absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 fas @if(!empty($testimonial['video'])) fa-play @else fa-align-left @endif text-lg text-white border-2 border-white px-3 py-1 rounded-full bg-[#0009] hover:opacity-80"></i>
                            </div>
                        </div>
                        <div class="w-full text-center">
                            <div class="font-bold text-sm leading-snug mb-2">{!! $testimonial['title'] !!}</div>
                            <p class="text-sm">{{ $testimonial['name'] }}</p>
                            @if(!empty($testimonial['brand']))
                                <p class="mt-1 text-xs cursor-pointer
                                                @if($testimonial['brand'] == 'Drummer')
                                                text-drumeo
                                                @elseif($testimonial['brand'] == 'Pianist')
                                                text-pianote
                                                @elseif($testimonial['brand'] == 'Guitarist')
                                                text-guitareo
                                                @else
                                                text-singeo
                                                @endif
                                                " x-on:click="{{str_replace(' ', '', $testimonial['name'])}} = true;">
                                    {{ $testimonial['brand'] }}
                                </p>
                            @else
                                <p class="mt-1 text-xs text-{{ $theme }} cursor-pointer" x-on:click="{{str_replace(' ', '', $testimonial['name'])}} = true;">
                                    @if(!empty($testimonial['video']))
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
    </div>
    @foreach($testimonials as $testimonial)
        @if(!empty($testimonial['video']))
            @include('_partials.components.video-modal',[
                'name' => str_replace(' ', '', $testimonial['name']),
                'video' => $testimonial['video'],
                'vimeo' => true
            ])
        @else
            @component('_partials.components.modal', ['name' => str_replace(' ', '', $testimonial['name'])])
                @slot('content')
                    <div class="overflow-hidden rounded-xl max-w-sm mx-auto">
                        <img src="{{$testimonial['image']}}" alt="{{$testimonial['name']}}" />
                        <div class="bg-white p-4">
                            <h2 class="leading-none font-bebas">{{$testimonial['name']}}</h2>
                            <p class="text-coaches uppercase mx-auto mb-3 md:mb-2">{!!  $testimonial['location'] !!}</p>
                            <p class="mx-auto mt-2 mb-3 md:mb-2 leading-tight"><strong>{!!  $testimonial['title'] !!}</strong></p>
                            <p class="mx-auto text-left leading-normal md:leading-normal">{!! $testimonial['description'] !!}</p>
                        </div>
                    </div>
                @endslot
            @endcomponent
        @endif
    @endforeach
</section>
