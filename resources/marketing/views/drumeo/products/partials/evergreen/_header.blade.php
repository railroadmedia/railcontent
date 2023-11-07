<header class="px-5 sm:px-6 pt-6 md:pt-9 pb-12 md:pb-18 overflow-hidden"
    style="background: linear-gradient(rgba(239, 247, 255, 1) 50%, #ffffff 50%)">
    <div class="container max-w-xl lg:max-w-3xl xl:max-w-4xl mx-auto">
        <div class="flex flex-col sm:flex-nowrap items-center">
            <div class="text-center w-3/4">
                <img class="h-20 -mb-3 sm:mb-0 lg:mb-3 lazyload py-1" data-src="{{ $logoHeader }}"
                    alt="{{ $logoAlt }}">
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
                        <i class="fas fa-check-circle text-{{ $brand }}" aria-hidden="true"></i> {{ $item }}
                    </h6>
                @endforeach
                <div class="flex inline lg:hidden my-3">
                    @foreach ($checklist as $item)
                        @php
                            $firstWord = strtok($item, ' '); // to get the first word
                            $restOfWords = substr($item, strlen($firstWord)); // to get other part of phrase
                        @endphp
                        <p class="w-1/2 leading-tight">
                            <i class="fas fa-check-circle text-{{ $brand }}" aria-hidden="true"></i><br />
                            {{ $firstWord }}<br />{{ $restOfWords }}
                        </p>
                    @endforeach
                </div>
            </div>
        </div>

        <div class="py-5 sm:py-6 relative">
            <div
                class="absolute top-1/2 left-0 transform -translate-x-full -translate-y-1/2 px-4 lg:px-8 hidden sm:block">
                <img src="{{ $bgImageLeft }}" alt="{{ $subtitle }}" class="h-56 lg:h-72">
            </div>

            <div class="aspect-16:9 cursor-pointer rounded-xl autoplay-video overflow-hidden w-full relative"
                x-on:click="trailer = true;" role="button">
                <i
                    class="absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 fas fa-play play-button z-10"></i>
                @if (isset($isVideo))
                    <video class="rounded-xl overflow-hidden object-cover w-full h-full absolute z-0 lazyload"
                        data-src="{{ $mediaSource }}" type="video/mp4" autoplay loop playsinline muted>
                    </video>
                @else
                    <img class="absolute inset-0 rounded-xl overflow-hidden object-cover w-full h-full absolute z-0"
                        src="{{ $mediaSource }}" alt="header image" fetchpriority="high" />
                @endif
            </div>
            <div
                class="absolute top-1/2 right-0 transform translate-x-full -translate-y-1/2 px-4 lg:px-8 hidden sm:block">
                <img src="{{ $bgImageRight }}" alt="{{ $subtitle }}" class="h-56 lg:h-72">
            </div>
        </div>
        <div class="flex w-full flex-col items-center mt-6 sm:mt-5 lg:mt-10">

            <a href={{ $buttonLink }}
                class="join blue medium w-full sm:w-1/2 lg:w-3/5 anchor-slide" role="button">{{ $buttonText }}</a>
            <div class="w-full md:w-1/2 text-center p-4">
                <img class="h-7 mr-2 lazyload" data-src="{{ $studentProfilesImage }}"
                    alt="Joined student profiles">
                <span class="inline-block align-middle text-xs leading-tight py-2">Join {{ $numStudents }}
                    {{ $students }} who<br> have already registered.
                </span>
            </div>
        </div>
    </div>
</header>
