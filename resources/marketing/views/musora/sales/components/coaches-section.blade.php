<div id="coaches" class="anchor"></div>
<div class="h-5 sm:h-10 -mt-5 sm:-mt-10" style="background: linear-gradient(to bottom right, transparent calc(50% - 1px), transparent, #f4f8fb calc(50% + 1px));"></div>
<section class="py-12 md:py-20 text-center" style="background-color:#f4f8fb;">
    <div class="max-w-3xl mx-auto">
        <h2 class="leading-tight font-extrabold">{!! $header !!}</h2>
        @if(!empty($desc))
            <p class="leading-tight px-4 md:px-0 mt-3 mb-5 md:mb-0 max-w-md mx-auto">{!! $desc !!}</p>
        @endif
    </div>

    <!-- Tabs -->
    <div
        x-data="{
                selectedId: 1,
                isMobile: window.innerWidth < 768 ? true : false,
            }"
        x-id="['tab']"
        x-on:resize.window="isMobile = (window.innerWidth < 768) ? true : false"
    >
        <!-- Tab List -->
        <div class="relative mx-auto max-w-lg lg:max-w-xl">
            <ul
                x-ref="tablist"
                class="hidden md:flex mt-8 mb-10 rounded-full bg-[#F5F8FC]"
            >
                <!-- Tab -->
                @foreach ($buttons as $key => $button)
                    <li class="w-full">
                        <button
                            @click="selectedId = {{ $key+1 }}"
                            @mousedown.prevent
                            @focus="selectedId = {{ $key+1 }}"
                            type="button"
                            :class="selectedId === {{ $key+1 }} ? 'text-white bg-[#01050F] border-[#01050F] bubble' : 'border-transparent'"
                            class="px-5 py-2 lg:py-2.5 w-full relative rounded-full relative z-20"
                        >
                            {!!  $button  !!}
                        </button>
                    </li>
                @endforeach
            </ul>

            <!-- Border -->
            <div class="hidden md:block border-[#ABB5C2] border-2 inset-0 absolute rounded-full z-10"></div>
        </div>

        <!-- Panels -->
        <div class="md:pb-56 lg:pb-96 relative">
            <!-- Panel -->
            @foreach ($courses as $key => $course)
                <section
                    class="max-w-6xl mx-auto px-4 lg:px-6 mb-6 md:mb-0 md:absolute md:inset-0"
                    :class="!(isMobile || (!isMobile && selectedId === {{ $key+1 }})) && 'opacity-0'"
                >
                    <h4 class="font-extrabold text-left mb-2 md:hidden">{!!  $course['title']  !!}</h4>
                    <div
                        x-data="{
                                init() {
                                    new Splide(this.$refs.splide, {
                                        classes: {
                                                arrow: 'splide__arrow bg-white opacity-100 shadow-lg h-11 w-11',
                                                prev: 'hidden',
                                                next: 'splide__arrow--next your-class-next hidden sm:flex -right-1',
                                                pagination: 'splide__pagination hidden md:flex -bottom-10',
                                        },
                                        perPage: 4.5,
                                        perMove: 1,
                                        type: 'loop',
                                        focus: 0,
                                        interval: 2000,
                                        breakpoints: {
                                            720: {
                                                perPage: 3.5,
                                                drag   : 'free',
                                                snap   : false,
                                            },
                                            620: {
                                                perPage: 2.5,
                                            },
                                        },
                                    }).mount()
                                },
                            }"
                    >
                        <section x-ref="splide" class="splide mb-10 md:mb-20 h-44 sm:h-48 lg:h-72">
                            <div class="splide__track">
                                <ul class="splide__list">
                                    @foreach ($course['images'] as $image)
                                        <li class="splide__slide flex flex-col items-center justify-center px-1">
                                            <div class="relative w-full rounded-xl overflow-hidden pb-48 sm:pb-52 lg:pb-72">
                                                <picture>
                                                    <source media="(min-width:640px)" srcset="https://www.musora.com/musora-cdn/image/width=450,quality=95/{{$image['img']}}">
                                                    <img class="absolute top-0 left-0 w-full h-full object-cover" src="https://www.musora.com/musora-cdn/image/width=260,quality=95/{{$image['img']}}" alt="{{ $image['instructor'] }}" />
                                                </picture>
                                                <div class="rounded-b-xl absolute w-full bottom-0 h-full text-white text-center flex justify-end flex-col pb-3 lg:pb-6" style="background:linear-gradient(180deg, rgba(1, 5, 15, 0) 50%, #01050F 100%);">
                                                    <h4 class="leading-none font-extrabold mb-1.5 lg:mb-2">{!! $image['title'] !!}</h4>
                                                    <p class="leading-none text-xs sm:text-sm">{{ $image['instructor'] }}</p>
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

    <div class="text-center mt-10 px-4 sm:px-0">
        @if(empty($promoVersion))
            <a href="/coaches" class="sm:mx-1 mb-2 sm:mb-0 w-full sm:w-64 join outline black smaller">EXPLORE COURSES</a>
        @endif
        <a class="sm:mx-1 w-full sm:w-64 join @if($theme != 'musora') {{ $theme }} @else musora-gold @endif smaller @if(!empty($promoVersion)) anchor-slide @endif"
            @if(!empty($promoVersion))
                href="#customize-anchor"
            @elseif(!empty($month))
                href="/choose-your-trial-month"
            @else
                href="/choose-plan"
            @endif
        >
            @if(!empty($promoVersion) && empty($trialVersion))
                SEE YOUR DEAL &raquo;
            @else
                START FOR FREE <i class="fas fa-arrow-right" style="line-height: 0;"></i>
            @endif
        </a>
    </div>
</section>
