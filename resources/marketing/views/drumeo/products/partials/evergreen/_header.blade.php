<header class="px-5 sm:px-6 pt-6 md:pt-9 pb-12 md:pb-18 overflow-hidden"
    style="background: linear-gradient(rgba(239, 247, 255, 1) 50%, #ffffff 50%)"
    x-data="{
        loadAlternateSrc(src) {
            this.$refs.playToLearnVideo.src = src;
        },
        videoLoaded: false,
    }">
    <div class="container max-w-xl lg:max-w-3xl xl:max-w-4xl mx-auto">
        <div class="flex flex-col sm:flex-nowrap items-center">
            <div class="text-center w-full">
                <img class="{{ isset($extraClass) ? $extraClass . ' ' : '' }}h-16 sm:h-20 -mb-3 sm:mb-0 lg:mb-3 py-1"
                     src="{{ $logoHeader }}" alt="{{ $logoAlt }}"
                     fetchpriority="hight">
                <h1 class="rotater-text overflow-hidden">
                    <strong>
                        @if (isset($rotatingText) && $rotatingText)
                            @for ($i = 0; $i < 12; $i++)
                                @foreach ($rotatingText as $textItem)
                                    <span class="relative nowrap delay-1000 ease-in-out">{{ $textItem }}</span><br>
                                @endforeach
                            @endfor
                        @elseif(isset($text))
                            <span>{{ $text }}</span>
                        @endif
                    </strong>
                </h1>
                <h2 class="-mt-3 sm:-mt-1 lg:mt-0 mb-4">{{ $subtitle }}</h2>
                @foreach ($checklist as $item)
                    <h6 class="hidden lg:inline p-2 leading-loose">
                        <i class="fas fa-check-circle text-{{ $brand }}" aria-hidden="true"></i>
                        {{ $item }}
                    </h6>
                @endforeach
                <div class="flex inline lg:hidden my-3">
                    @foreach ($checklist as $item)
                        <p class="w-1/2 leading-tight">
                            <i class="fas fa-check-circle text-{{ $brand }}" aria-hidden="true"></i><br />
                            {{ $item }}
                        </p>
                    @endforeach
                </div>
            </div>
        </div>

        <div class="py-5 sm:py-6 relative">
            <div class="absolute top-1/2 left-0 transform -translate-x-full -translate-y-1/2 px-4 lg:px-8 hidden sm:block">
                <img src="{{ $bgImageLeft }}" alt="{{ $subtitle }}" class="h-56 lg:h-72" fetchpriority="hight">
            </div>

            <div class="aspect-16:9 cursor-pointer rounded-xl autoplay-video overflow-hidden w-full relative"
                x-on:click="trailer = true;" role="button">
                <i class="absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 fa fa-play play-button z-10"></i>

                @if (isset($isVideo))

                {{-- Blur --}}
                <div x-data="{ videoLoaded: false }">
                    <img src="{{ $poster }}" alt="Blurred Poster Image" class="rounded-xl overflow-hidden object-cover w-full h-full absolute z-0 blur-xl" x-show="!videoLoaded">

                    <video class="rounded-xl overflow-hidden object-cover w-full h-full absolute z-0"
                        x-ref="playToLearnVideo"
                        x-on:error="loadAlternateSrc('{{ $alternateSrc }}')"
                        x-intersect.once="videoLoaded = true; $refs.playToLearnVideo.src = $refs.playToLearnVideo.dataset.src;"
                        x-effect="if (videoLoaded) { $refs.playToLearnVideo.play(); }"
                        data-src="{{ $mediaSource }}"
                        type="video/mp4"
                        muted
                        loop
                        playsinline
                        preload="auto"
                        fetchpriority="high">
                        <source :src="$refs.playToLearnVideo.dataset.src" type="video/mp4">
                    </video>
                </div>

                {{-- Without Blur --}}
                {{-- <video class="rounded-xl overflow-hidden object-cover w-full h-full absolute z-0"
                    x-ref="playToLearnVideo"
                    x-on:error="loadAlternateSrc('{{ $alternateSrc }}')"
                    x-intersect.once="videoLoaded = true; $refs.playToLearnVideo.src = $refs.playToLearnVideo.dataset.src;"
                    x-effect="if (videoLoaded) { $refs.playToLearnVideo.play(); }"
                    poster="{{ $poster }}"
                    data-src="{{ $mediaSource }}"
                    type="video/mp4"
                    autoplay
                    muted
                    loop
                    playsinline
                    preload="auto"></video> --}}
                @else
                    <img class="absolute inset-0 rounded-xl overflow-hidden object-cover w-full h-full absolute z-0"
                        src="{{ $mediaSource }}" alt="header image" fetchpriority="high" />
                @endif
            </div>
            <div class="absolute top-1/2 right-0 transform translate-x-full -translate-y-1/2 px-4 lg:px-8 hidden sm:block">
                <img src="{{ $bgImageRight }}" alt="{{ $subtitle }}" class="h-56 lg:h-72" fetchpriority="high">
            </div>
        </div>
        <div class="flex w-full flex-col text-center items-center mt-6 sm:mt-5 lg:mt-10">
            <div class="w-full sm:w-1/2 md:w-1/2 lg:w-1/3">
                @include('drumeo.products.partials.evergreen._button', [
                    'link' => $buttonLink,
                    'buttonClass' => 'text-white font-bebas tracking-widest',
                    'buttonText' => $buttonText,
                ])
            </div>
            @include('drumeo.products.partials.evergreen._price-link', [
                'enrollmentLink' => $enrollmentLink,
                'brandTitle' => $brandTitle,
            ])
        </div>
    </div>
</header>
