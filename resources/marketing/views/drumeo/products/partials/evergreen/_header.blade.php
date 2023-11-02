<header class="px-5 sm:px-6 pt-6 md:pt-9 pb-12 md:pb-18 overflow-hidden"
    style="background: linear-gradient(rgba(239, 247, 255, 1) 50%, #ffffff 50%)">
    <div class="container max-w-xl lg:max-w-3xl xl:max-w-4xl mx-auto">
        <div class="flex flex-col sm:flex-nowrap items-center">
            <div class="text-center">
                <img class="h-20 -mb-3 sm:mb-0 lg:mb-3 lazyload" data-src="{{ $logoHeader }}"
                    alt="{{ $logoAlt }}">
                <h1 class="rotater-text overflow-hidden">
                <strong>
                    @if(isset($rotatingText) && $rotatingText)
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
                    <p class="hidden lg:inline p-2 text-lg leading-10">
                        <i class="fas fa-check-circle text-{{ $brand }}"></i> {{ $item }}
                    </p>
                @endforeach
                <div class="flex inline lg:hidden my-3">
                    @foreach ($checklist as $item)
                        @php
                            $firstWord = strtok($item, ' '); // to get the first word
                            $restOfWords = substr($item, strlen($firstWord)); // to get other part of phrase
                        @endphp
                        <p class="w-1/3 leading-tight">
                            <i class="fas fa-check-circle text-{{ $brand }}"></i><br/>
                            {{ $firstWord }}<br/>{{ $restOfWords }}
                        </p>
                    @endforeach
                </div>
            </div>

        </div>

        <div class="py-5 sm:py-6 relative">
            <div class="absolute top-1/2 left-0 transform -translate-x-full -translate-y-1/2 px-4 lg:px-8 hidden sm:block">
                <img src="{{ $bgImageLeft }}" alt="{{ $subtitle }}" class="h-56 lg:h-72">
            </div>

            <div class="aspect-16:9 cursor-pointer rounded-xl autoplay-video overflow-hidden w-full relative"
                data-open="trailer">
                <i class="absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 fas fa-play play-button z-10"></i>
                <video class="rounded-xl overflow-hidden object-cover w-full h-full absolute z-0 lazyload"
                    data-src="{{ $video }}"
                    type="video/mp4" autoplay loop playsinline muted>
                </video>
            </div>
            <div class="absolute top-1/2 right-0 transform translate-x-full -translate-y-1/2 px-4 lg:px-8 hidden sm:block">
                <img src="{{ $bgImageRight }}" alt="{{ $subtitle }}" class="h-56 lg:h-72">
            </div>
        </div>
        <div class="flex w-full flex-col items-center mt-6 sm:mt-5 lg:mt-10">
            <div class="w-full sm:w-1/2 md:w-1/3 text-center sm:pr-2 my-1">
                <a href="#final" class="join blue medium w-full anchor-slide">{{ $buttonText }}</a>
            </div>
            <div class="w-full sm:w-1/2 lg:pb-5 my-1 text-center text-xs">
                <img class="h-7 sm:mb-1 lg:mb-0 mr-1 sm:mr-0 lg:mr-1 lazyload"
                    data-src="{{ $studentProfilesImage }}" alt="joined student profiles">
                <p class="inline-block leading-tight text-sm align-middle">Join {{ $numStudents }} {{ $students }} who<br> have already registered.
                </p>
            </div>
        </div>
    </div>
</header>


