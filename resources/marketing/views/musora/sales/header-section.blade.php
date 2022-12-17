<header class="px-5 sm:px-6 py-10 sm:py-14 lg:py-20" style="background:#f6f8fc;">
    <div class="container max-w-6xl mx-auto">
        <div class="flex flex-wrap sm:flex-nowrap items-center">
            <div class="w-full sm:w-7/12 sm:pr-8 text-center lg:text-left">
                <h1 class="rotater-text text-drumeo"><strong>{!! $header !!}</strong></h1>
                <h6 class="leading-tight mt-4 lg:mt-6 mb-4 sm:mb-2"><strong>{!! $desc !!}</strong></h6>

                <div class="mt-6 mb-5 rounded-xl overflow-hidden relative block sm:hidden bg-cover bg-top cursor-hover autoplay-video lazyload" style="padding-bottom: 75%;" data-bg="https://cdn.musora.com/image/fetch/w_850,q_auto:best/{!! $thumb !!}" x-on:click="trailer = true;" alt="header image">
                    <div class="join white smaller absolute bottom-2 left-2"><i class="fas fa-play"></i> Watch Trailer</div>
                </div>

                <p class="hidden lg:inline">
                    <i class="fas fa-check text-drumeo"></i> {!! $pointOne !!}
                    <i class="ml-2 fas fa-check text-drumeo"></i> {!! $pointTwo !!}
                    <i class="ml-2 fas fa-check text-drumeo"></i> {!! $pointThree !!}
                </p>
                <div class="flex inline lg:hidden">
                    <p class="w-1/3 leading-tight"><i class="fas fa-check-circle text-drumeo"></i><br> {!! $pointOne !!}</p>
                    <p class="w-1/3 leading-tight"><i class="fas fa-check-circle text-drumeo"></i><br> {!! $pointTwo !!}</p>
                    <p class="w-1/3 leading-tight"><i class="fas fa-check-circle text-drumeo"></i><br> {!! $pointThree !!}</p>
                </div>
                <div class="flex flex-wrap items-center mt-6 sm:mt-5 lg:mt-10 max-w-xs">
                    <a href="/pricing" class="w-full join blue smaller mb-2">START FOR FREE <i class="fas fa-arrow-right"></i> </a>
                    <a class="inline-block" href="{{ $reviewLink }}" target="_blank" onclick="window.open('{{ $reviewLink }}', 'newwindow', 'width=750, height=550'); return false;">
                    <i class="align-middle text-lg fas fa-star" style="color: #ffac00;"></i>
                    <i class="align-middle text-lg -ml-3 fas fa-star" style="text-shadow: -2px -1px 1px #f6f8fc;color: #ffac00;"></i>
                    <i class="align-middle text-lg -ml-3 fas fa-star" style="text-shadow: -2px -1px 1px #f6f8fc;color: #ffac00;"></i>
                    <i class="align-middle text-lg -ml-3 fas fa-star" style="text-shadow: -2px -1px 1px #f6f8fc;color: #ffac00;"></i>
                    <i class="align-middle text-lg -ml-3 fas fa-star" style="text-shadow: -2px -1px 1px #f6f8fc;color: #ffac00;"></i>
                    </a>
                    <p class="inline-block leading-tight text-sm align-middle pl-2 m-0"><em>Trusted by {{ $students }} active students.</em></p>
                </div>
            </div>
            <div class="w-full sm:w-5/12 hidden sm:block">
                <div class="shadow-2xl rounded-xl aspect-1:1 overflow-hidden relative bg-cover bg-center cursor-pointer autoplay-video lazyload" data-bg="https://cdn.musora.com/image/fetch/w_850,q_auto:best/{!! $thumb !!}" x-on:click="trailer = true;">
                    <div class="join white smaller absolute bottom-2 left-2"><i class="fas fa-play"></i> Watch Trailer</div>
                </div>
            </div>
        </div>

        <div class="flex flex-wrap sm:flex-nowrap text-center border-2 rounded-xl border-drumeo mt-8 lg:mt-12 mb-2 lg:mb-4" style="background-color:#eaf1fa;">
            <div class="flex flex-wrap sm:flex-nowrap items-start justify-evenly w-full sm:w-auto sm:flex-grow py-4 sm:py-3 lg:py-4 lg:px-5 text-left sm:text-center">
                @foreach ($features as $key => $feature)
                    <div class="flex sm:block w-full sm:w-auto px-4 sm:px-3 mb-4 sm:mb-0">
                        <img
                            src="{{ $feature['image'] }}"
                            class="h-7 mb-2 mr-3 sm:mr-0 transition-opacity opacity-0"
                            alt="feature image{{$key+1}}"
                            loading="lazy"
                            onload="this.classList.remove('opacity-0')"
                        >
                        <p class="leading-tight mx-0"><strong class="font-black">{{ $feature['title'] }}</strong><br>
                            <span class="text-sm">{{ $feature['desc'] }}</span></p>
                    </div>
                @endforeach
            </div>
        </div>
        <div class="sm:px-5">
            <div class="slick slick-light-buttons text-center mx-auto my-9 md:mb-0 h-40 sm:h-24 lg:h-20">
                @foreach ($slides as $slide)
                    <div class="px-3 md:px-6 slick-slide">
                        <p class="leading-normal text-sm"><em>“{{ $slide['desc'] }}”</em></p>
                        <div class="flex flex-wrap md:flex-nowrap sm:text-left items-center justify-center mt-1.5">
                            <img
                                class="rounded-full h-10 transition-opacity opacity-0"
                                src="https://cdn.musora.com/image/fetch/w_80,q_auto:best/{{ $slide['thumb'] }}"
                                loading="lazy"
                                onload="this.classList.remove('opacity-0')"
                            ><br class="inline md:hidden">
                            <p class="leading-tight w-full md:w-auto text-sm text-light-navy ml-1 md:ml-2 mr-0 mt-1 md:mt-0"><em>{{ $slide['name'] }}, {{ $slide['credit'] }}</em></p>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</header>
