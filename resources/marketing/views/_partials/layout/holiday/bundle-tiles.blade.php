<div
    x-data="{
        init() {
            new Splide(this.$refs.splide, {
                classes: {
                        arrow: 'splide__arrow bg-white opacity-100 shadow-lg h-11 w-11',
                        prev: 'splide__arrow--prev your-class-prev -left-1',
                        next: 'splide__arrow--next your-class-next -right-1',
                        pagination: 'splide__pagination flex -bottom-10',
                },
                padding: '2rem',
                perPage: 1,
                perMove: 1,
                type: 'loop',
                focus: 0,
                interval: 2000,
                lazyLoad: 'nearby',
                breakpoints: {
                    768: {
                        drag: 'free',
                        snap: false,
                    },
                    620: {
                        padding: '1rem',
                        arrows: false,
                    },
                },
            }).mount()
        },
    }"
>
    <section x-ref="splide" class="splide mb-20 sm:mb-0">
        <div class="splide__track">
            <ul class="splide__list">
                @foreach ($bundles as $key => $bundle)
                    <li class="splide__slide flex flex-col items-center justify-start">
                        <a href="{{ $bundle['slug'] }}" class="w-full mx-auto p-1 sm:p-2 transition-opacity duration-500 hover:opacity-90 @if(!empty($bundle['specialW'])) lg:w-2/3 @elseif(!empty($bundle['specialW2'])) lg:w-1/3 @elseif(!empty($bundle['full'])) @else sm:w-1/2 @endif">
                            <div class="flex items-center w-full overflow-hidden relative text-white rounded-xl pb-[108%] sm:pb-[35%]">
{{--                                @if($bundle['slug'] == '/shop/challenges-bundle')--}}
{{--                                    <p class="absolute top-0 left-0 bg-[#00D7FF] font-black px-2 md:px-3 py-1 md:py-2 text-sm md: rounded-br-lg z-10 text-black">--}}
{{--                                        CYBER MONDAY ONLY--}}
{{--                                    </p>--}}
{{--                                @endif--}}
                                @if(!empty($bundle['img']))
                                    <div class="hidden sm:inline-block absolute inset-0 z-0 bg-cover bg-center" style="background-position:30% 0;background-image:url('{{ $bundle['img'] }}');"></div>
                                    <div class="inline-block sm:hidden absolute inset-0 z-0 bg-cover bg-top" style="background-image:url('{{ $bundle['imgM'] }}');"></div>
                                @endif
                            </div>
                        </a>
                    </li>
                @endforeach
            </ul>
        </div>
    </section>
</div>
