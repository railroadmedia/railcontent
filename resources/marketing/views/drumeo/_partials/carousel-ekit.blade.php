<section class="text-center px-4 sm:px-6 py-8 sm:py-16 lg:py-20 relative text-white" style="background:linear-gradient(to bottom, #01050d 66%, #021021);">
        <div class="container mx-auto z-10 relative max-w-5xl">
            <h2 class="leading-tight mb-7 sm:mb-10"><strong>Pro details on a<br class="sm:hidden">  beginner budget.</strong></h2>
            <div class="mb-7 sm:mb-10"
                x-data="{
                    splide: null,
                    init() {
                        this.splide = new Splide(this.$refs.splide, {
                            classes: {
                                arrow: 'splide__arrow bg-white opacity-100 top-[50%] shadow-lg h-40 w-40 text-[#0B76DB]',
                                prev: 'hidden',
                                next: 'hidden',
                                pagination: 'splide__pagination bottom-0',
                            },
                            perPage: 2.5,
                            perMove: 1,
                            type: 'loop',
                            focus: 0,
                            interval: 2000,
                            drag   : 'free',
                            snap   : false,
                            breakpoints: {
                                767: {
                                    perPage: 1.5,
                                },
                            },
                        }).mount();
                    },
                    next() {
                        if (this.splide) {
                            this.splide.go('>');
                        }
                    },
                }"
            >
                      
                <button class="arrow-button absolute top-1/3 right-0 transform -translate-y-1/2 z-150 w-20 hidden sm:block" @click="next()">
                <img src="https://d21q7xesnoiieh.cloudfront.net/filters:quality(95)/marketing/drumeo/products/kit/arrow-button-white.svg" alt="Arrow Icon" class="w-10" style="position: absolute; left:50px">
                </button>
                <div x-ref="splide" class="splide text-left">
                    <div class="splide__track pb-8">
                        <ul class="splide__list items-start">
                            @php
                                $gridItems = [
                                    [
                                    'img' => 'marketing/drumeo/products/kit/1-save.jpg',
                                    'title' => 'Save your hands (and ears) with mesh heads.',
                                    'desc' => 'Most entry-level e-kits use hard rubber pads that lack the sensitivity and feel of a real drum set. The Alesis Nitro Max features tightly-woven premium mesh heads that let you practice anywhere, anytime without disturbing family or neighbors.',
                                    ],
                                    [
                                    'img' => 'marketing/drumeo/products/kit/2-bigger.jpg',
                                    'title' => 'A bigger snare drum.',
                                    'desc' => 'Another reason to love this kit. The Nitro Max features a 10” snare with TWO strike zones – one in the center and one for rimshots. This gives your more sonic options AND helps you play with better technique and ergonomics. (Most entry-level kits have a tiny 8” snare.)',
                                    ],
                                    [
                                    'img' => 'marketing/drumeo/products/kit/3-favourite.jpg',
                                    'title' => 'Play your favorite songs.',
                                    'desc' => 'Wirelessly connect your phone and choose your favorite songs to jam along with. The Nitro Max seamlessly mixes your drumming into the music – no cables required. Simple toss your phone or tablet on the built-in mount and start jamming.',
                                    ],
                                    [
                                    'img' => 'marketing/drumeo/products/kit/4-improve.jpg',
                                    'title' => 'Improve your timing & feel.',
                                    'desc' => 'The perfect practice kit. The Nitro Max includes a built-in metronome trainer to help you develop your internal clock without any extra hardware. You’ll improve faster because the metronome tells you if you’re ahead, behind or just right.',
                                    ],
                                    [
                                    'img' => 'marketing/drumeo/products/kit/5-choose.jpg',
                                    'title' => 'Choose your favorite kit sounds.',
                                    'desc' => 'The Nitro Max Module features 32 built-in kit sounds by BFD drums – some of the most sampled drum sounds in music production history. That means you’ll literally sound like the original drum track on your favorite songs.',
                                    ],
                                ];
                            @endphp
                            @foreach ($gridItems as $gridItem)
                                <li class="splide__slide px-1 sm:px-3">
                                    <div class="rounded-xl overflow-hidden shadow-md border-2" style="color:#fff;background-color:#080c14;border-color:#121f2d; padding: 20px;">
                                        <div class="relative" style="padding-bottom:71%;">
                                            <img class="absolute object-cover h-full w-full transition-opacity opacity-1 rounded-xl"
                                                loading="lazy" onload="this.classList.remove('opacity-0')" alt="drumeo alesis-ekit"
                                                src="https://d21q7xesnoiieh.cloudfront.net/fit-in/1000x0/filters:quality(95)/{{ $gridItem['img'] }}">
                                        </div>
                                        <h4 class="mt-4 mb-2 font-black leading-tight"><strong>{{ $gridItem['title'] }}</strong></h4>
                                        <p class="pb-6 text-sm leading-normal opacity-70">{{ $gridItem['desc'] }}</p>
                                    </div>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
            <div class="flex flex-wrap sm:flex-nowrap justify-center items-center sm:text-left">
                <div class="flex-grow sm:pr-5 lg:pr-8 mx-0 mb-5 sm:mb-0">
                    <h3 class="leading-tight mb-3"><strong>Your house<br class="hidden sm:inline lg:hidden"> <img src="https://d21q7xesnoiieh.cloudfront.net/filters:quality(95)/marketing/drumeo/products/kit/arrow-yellow.svg" alt="arrow" class="w-10 mx-3"> recording studio.</strong></h3>
                    <p class="leading-normal max-w-lg mx-0">
                    Connect your kit to your laptop with a single cable, open up Garage Band (or any DAW), and start laying down your grooves.
                    <br><br>
                    This makes it effortless to collaborate with other musicians and document your practice history.</p>
                </div>
                <div class="flex-shrink-0 border-2 rounded-xl p-7 sm:p-10 text-left" style="background-color:#080c14;border-color:#121f2d;">
                    <h6 class="leading-normal font-black">
                                <img class="align-middle w-8 mr-3" src="https://d21q7xesnoiieh.cloudfront.net/fit-in/1700x0/filters:quality(95)/marketing/drumeo/products/kit/record-icon.svg"> Record your practice.
                        <br><br><img class="align-middle w-8 mr-3" src="https://d21q7xesnoiieh.cloudfront.net/fit-in/1700x0/filters:quality(95)/marketing/drumeo/products/kit/drum-icon.svg"> Create your own beats.
                        <br><br><img class="align-middle w-8 mr-3" src="https://d21q7xesnoiieh.cloudfront.net/fit-in/1700x0/filters:quality(95)/marketing/drumeo/products/kit/people-icon.svg"> Share your creative ideas.
                    </h6>
                </div>
            </div>
        </div>
    </section>