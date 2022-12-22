{{--<script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>--}}
{{--<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@splidejs/splide@4.0.7/dist/css/splide.min.css">--}}
{{--<script src="https://cdn.jsdelivr.net/npm/@splidejs/splide@4.0.7/dist/js/splide.min.js"></script>--}}

{{--<style>--}}
{{--    .splide__pagination__page.is-active {--}}
{{--        background: #01050F;--}}
{{--    }--}}

{{--    .splide__arrow svg {--}}
{{--        fill: #0B76DB !important;--}}
{{--    }--}}

{{--    .bubble:after {--}}
{{--        content: '';--}}
{{--        position: absolute;--}}
{{--        bottom: 0;--}}
{{--        left: 50%;--}}
{{--        width: 0;--}}
{{--        height: 0;--}}
{{--        border: 5px solid transparent;--}}
{{--        border-top-color: black;--}}
{{--        border-bottom: 0;--}}
{{--        margin-left: -5px;--}}
{{--        margin-bottom: -5px;--}}
{{--    }--}}
{{--</style>--}}


<section class="py-12 md:py-20 text-center">
    <div class="max-w-3xl mx-auto">
        <h2 class="font-extrabold">{!! $header !!}</h2>
        <p class="px-4 md:px-0 mt-3 mb-4 md:mb-0">{!! $desc !!}</p>
    </div>

    <!-- Tabs -->
    <div
        x-data="{
                selectedId: null,
                isMobile: window.innerWidth < 768 ? true : false,
                init() {
                    // Set the first available tab on the page on page load.
                    this.$nextTick(() => this.select(this.$id('tab', 1)))
                },
                select(id) {
                    this.selectedId = id
                },
                isSelected(id) {
                    return this.selectedId === id
                },
                whichChild(el, parent) {
                    return Array.from(parent.children).indexOf(el) + 1
                }
            }"
        x-id="['tab']"
        x-on:resize.window="isMobile = (window.innerWidth < 768) ? true : false"
    >
        <!-- Tab List -->
        <div class="relative mx-auto max-w-md lg:max-w-xl">
            <ul
                x-ref="tablist"
                role="tablist"
                class="hidden md:flex mt-8 mb-10 rounded-full bg-[#F5F8FC]"
            >
                <!-- Tab -->
                @foreach ($buttons as $button)
                    <li class="w-full">
                        <button
                            :id="$id('tab', whichChild($el.parentElement, $refs.tablist))"
                            @click="select($el.id)"
                            @mousedown.prevent
                            @focus="select($el.id)"
                            type="button"
                            :tabindex="isSelected($el.id) ? 0 : -1"
                            :aria-selected="isSelected($el.id)"
                            :class="isSelected($el.id) ? 'text-white bg-[#01050F] border-[#01050F] bubble' : 'border-transparent'"
                            class="px-5 py-2 lg:py-2.5 w-full relative rounded-full relative z-20"
                            role="tab"
                        >
                            {{ $button }}
                        </button>
                    </li>
                @endforeach
            </ul>

            <!-- Border -->
            <div class="hidden md:block border-[#ABB5C2] border-2 inset-0 absolute rounded-full z-10"></div>
        </div>

        <!-- Panels -->
        <div role="tabpanels">
            <!-- Panel -->
            @foreach ($courses as $course)
                <section
                    x-show="isMobile || (!isMobile && isSelected($id('tab', whichChild($el, $el.parentElement))))"
                    role="tabpanel"
                    class="max-w-6xl mx-auto px-4 lg:px-6 mb-6 md:mb-0"
                >
                    <p class="font-extrabold text-center mb-2 md:hidden">{{ $course['title'] }}</p>
                    <div
                        x-data="{
                                init() {
                                    new Splide(this.$refs.splide, {
                                        classes: {
                                                arrow: 'splide__arrow bg-white opacity-100',
                                                prev: 'hidden',
                                                next: 'splide__arrow--next your-class-next hidden sm:flex',
                                        },
                                        perPage: 5,
                                        perMove: 1,
                                        type: 'loop',
                                        autoplay: true,
                                        focus: 0,
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
                                    @foreach ($course['images'] as $image)
                                        <li class="splide__slide flex flex-col items-center justify-center pb-8 pr-5 -mr-4">
                                            <div class="relative w-full rounded-xl bg-cover bg-center" style="padding-bottom: 140%; background-image:url(https://cdn.musora.com/image/fetch/w_400,q_auto:best/{{$image['img']}});">
                                                <div class="rounded-b-xl absolute w-full bottom-0 h-1/2 text-white text-center flex justify-center flex-col" style="background:linear-gradient(180deg, rgba(1, 5, 15, 0) 0%, #01050F 100%);">
                                                    <h4 class="font-extrabold mb-2">{!! $image['title'] !!}</h4>
                                                    <p class="leading-none">{{ $image['instructor'] }}</p>
                                                </div>
                                            </div>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        </section>
                    </div>
                </section>
            @endforeach
        </div>
    </div>

    <div class="text-center my-10">
        @if(empty($promoVersion))
            <a href="/courses" class="mx-1 mb-2 sm:mb-0 join outline method smaller">EXPLORE 200+ COURSES <i class="fas fa-info-circle"></i> </a>
        @endif
        <a href="/pricing" class="mx-1 join blue smaller">
            @if(!empty($promoVersion))
                Get Started &raquo;
            @else
                START FOR FREE <i class="fas fa-arrow-right"></i>
            @endif
        </a>
    </div>
</section>
