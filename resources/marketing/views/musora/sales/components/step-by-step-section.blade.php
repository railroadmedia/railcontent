<section class="text-center relative text-white py-12 min-h-[500px] h-screen-nav max-h-[1100px]"
    x-data="{ stick: false }"
    x-init="window.addEventListener('scroll', () => {
        stick = window.scrollY + window.innerHeight > $refs.stickySection.offsetTop + $refs.stickySection.offsetHeight;
    })">
    <picture class="fixed inset-0 -z-10">
        <source media="(min-width:1024px)" srcset="https://d21q7xesnoiieh.cloudfront.net/fit-in/2500x0/filters:quality(95)/{{ $wall }}">
        <source media="(min-width:640px)" srcset="https://d21q7xesnoiieh.cloudfront.net/fit-in/1600x0/filters:quality(95)/{{ $wallM }}">
        <img
            class="w-full h-full object-cover object-bottom"
            style="background-color:#0C1524;"
            src="https://d21q7xesnoiieh.cloudfront.net/fit-in/800x0/filters:quality(95)/{{ $wallM }}"
        />
    </picture>
    <div class="w-auto inline-block py-3 sm:py-4 px-4 sm:px-6 z-10 sticky top-[40vh]"
        :class="{ 'bottom-auto': stick }" x-ref="stickySection">
        <h1 style="text-shadow:0 0 20px rgba(0, 0, 0, 0.5);" class="font-lexend text-4xl sm:text-6xl lg:text-7xl leading-none uppercase mb-1 sm:mb-3"><strong>STEP-BY-STEP</strong></h1>
        <h1 style="text-shadow:0 0 20px rgba(0, 0, 0, 0.5);" class="font-lexend leading-none uppercase mb-3">to any goal</h1>
    </div>
    <div class="h-full">
    </div>
</section>

<section class="text-center px-5 sm:px-6 pb-12 sm:pb-16 lg:pb-20 relative overflow-hidden text-white"
    style="background: linear-gradient(to bottom, transparent 50%, #0C1524);"
>
    <div class="container max-w-5xl mx-auto relative z-20">
        <div class="text-black bg-white rounded-xl px-4 sm:px-6 py-8 sm:py-12 mb-8">
            <h5 class="uppercase text-{{ $theme }}">Step 1</h5>
            <h2 class="leading-tight my-2"><strong>Choose Your Goal</strong></h2>
            <p class="leading-tight mb-8">
                {!! $stepOne !!}
            </p>
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
                                    padding: '0rem',
                                    arrows: false,
                                    pagination: false,
                                    perPage: 5,
                                    focus: 0,
                                    interval: 2000,
                                    lazyLoad: 'nearby',
                                    breakpoints: {
                                        768: {
                                            padding: '3rem',
                                            perPage: 3,
                                            perMove: 1,
                                            pagination: true,
                                            arrows: true,
                                            type: 'loop',
                                            drag: 'free',
                                            snap: false,
                                        },
                                        620: {
                                            perPage: 1,
                                        },
                                    },
                                }).mount()
                            },
                        }"
            >
                <section x-ref="splide" class="splide mb-10 lg:mb-0">
                    <div class="splide__track">
                        <ul class="splide__list">
                            @foreach ($packs as $tile)
                                <li class="splide__slide flex flex-col items-center justify-start px-1">
                                    <div class="relative w-full rounded-xl overflow-hidden cursor-pointer hover:opacity-90 transition-opacity"
                                        @if(!empty($tile['vimeoId'])) @click="{{ $tile['name'] }} = true" @endif>
                                        <picture>
                                            <source media="(min-width:640px)" data-srcset="https://d21q7xesnoiieh.cloudfront.net/fit-in/380x0/filters:quality(95)/{{$tile['image']}}">
                                            <img
                                                class="w-full transition-opacity opacity-0 duration-300"
                                                data-splide-lazy="https://d21q7xesnoiieh.cloudfront.net/fit-in/490x0/filters:quality(95)/{{$tile['image']}}"
                                                onload="this.classList.remove('opacity-0');"
                                            />
                                        </picture>
                                    </div>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </section>
            </div>
        </div>

        <div class="text-white pt-6 sm:pt-10 mb-8 rounded-xl overflow-hidden bg-cover bg-center"
            style="background-color:#2a2f34;background-image:url('{{ $stepTwoBg }}');">
            <h5 class="uppercase text-{{ $theme }}">Step 2</h5>
            <h2 class="leading-tight my-2"><strong>Press Play</strong></h2>
            <p class="leading-normal mb-8 px-4">
                {!! $stepTwo !!}
            </p>

            <div class="relative cursor-pointer autoplay-video" x-on:click="demoVid = true;">
                <img class="inline-block sm:hidden w-full transition-all opacity-0" src="https://d21q7xesnoiieh.cloudfront.net/fit-in/800x0/filters:quality(95)/{{ $povM }}" alt="tablet piano" loading="lazy" onload="this.classList.remove('opacity-0')">
                <img class="hidden sm:inline-block w-full transition-all opacity-0" src="https://d21q7xesnoiieh.cloudfront.net/fit-in/2200x0/filters:quality(95)/{{ $pov }}" alt="tablet piano" loading="lazy" onload="this.classList.remove('opacity-0')">
            </div>
        </div>

        <div class="text-black bg-white rounded-xl pl-4 lg:px-10 pt-8 sm:pt-12">
            <h5 class="uppercase text-{{ $theme }}">Step 3</h5>
            <h2 class="leading-tight my-2"><strong>Hear the result.</strong></h2>
            <p class="leading-tight mb-8 px-4 sm:px-0">
                {!! $stepThree !!}
            </p>
            <picture>
                <source media="(min-width:1024px)" srcset="https://d21q7xesnoiieh.cloudfront.net/fit-in/1900x0/filters:quality(95)/{{ $tablet }}">
                <source media="(min-width:640px)" srcset="https://d21q7xesnoiieh.cloudfront.net/fit-in/1400x0/filters:quality(95)/{{ $tablet }}">
                <img
                    class="w-full -mb-6"
                    src="https://d21q7xesnoiieh.cloudfront.net/fit-in/800x0/filters:quality(95)/{{ $tabletM }}"
                    onload="this.classList.remove('opacity-0');"
                />
            </picture>
        </div>
    </div>
</section>
