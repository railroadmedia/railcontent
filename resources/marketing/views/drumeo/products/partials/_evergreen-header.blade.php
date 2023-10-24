<header class="px-5 sm:px-6 py-10 sm:py-14 lg:py-20" style="background:#eff7ff;">
    <div class="container max-w-5xl mx-auto">
        <div class="flex flex-col sm:flex-nowrap items-center">
            <div class="w-full sm:w-7/12 text-center">
                <img class="h-20 sm:h-24 lg:h-28 -mb-3 sm:mb-0 lg:mb-3 lazyload" data-src="{{ $logo }}"
                    alt="{{ $logoAlt }}">
                <h1 class="rotater-text overflow-hidden">
                    <strong>
                        @for ($i = 0; $i < 12; $i++)
                            @foreach ($rotatingText as $text)
                                <span class="relative nowrap delay-1000 ease-in-out">{{ $text }}</span><br>
                            @endforeach
                        @endfor
                    </strong>
                </h1>
                <h2 class="-mt-3 sm:-mt-1 lg:mt-0 mb-4">{{ $subtitle }}</h2>
                <p class="hidden lg:inline">
                    @foreach ($checklist as $item)
                        <i class="fas fa-check text-{{ $brandTitle }}"></i> {{ $item }}
                    @endforeach
                </p>
                <div class="flex inline lg:hidden my-3">
                    @foreach ($checklist as $item)
                        @php
                            $firstWord = strtok($item, ' '); // to get the first word
                            $restOfWords = substr($item, strlen($firstWord)); // to get other part of phrase
                        @endphp
                        <p class="w-1/3 leading-tight">
                            <i class="fas fa-check-circle text-{{ $brandTitle }}"></i><br />
                            {{ $firstWord }}<br />{{ $restOfWords }}
                        </p>
                    @endforeach
                </div>
            </div>
            
        </div>
    </div>

<section class="text-center px-4 sm:px-6 py-10 sm:py-14 lg:py-6">

<div class="flex items-center">
    <img src="{{ $bgImageLeft }}" alt="" class="w-10 hidden sm:inline md:inline lg:inline xl:inline">
    
    <div class="container max-w-4xl mx-auto">
        <div class="aspect-16:9 cursor-pointer rounded-xl autoplay-video overflow-hidden w-full relative" data-open="trailer">
            <i class="absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 fas fa-play play-button z-10"></i>
            <video class="rounded-xl overflow-hidden object-cover w-full h-full absolute z-0 lazyload"
                data-src="{{ $video }}"
                type="video/mp4" autoplay loop playsinline muted>
            </video>
        </div>
    </div>

    <img src="{{ $bgImageRight }}" alt="" class="w-10 hidden sm:inline md:inline lg:inline xl:inline">
</div>
   


    <div class="flex w-full flex-col items-center mt-6 sm:mt-5 lg:mt-10">
                <div class="w-full sm:w-1/2 text-center sm:pr-2 my-1">
                    <a href="#final" class="join blue medium w-full anchor-slide">{{ $buttonText }}</a>
                </div>
                <div class="w-full sm:w-1/2 lg:pb-5 my-1 text-center">
                    <img class="h-7 sm:mb-1 lg:mb-0 mr-1 sm:mr-0 lg:mr-1 lazyload"
                        data-src="{{ $studentProfilesImage }}" alt="joined student profiles">
                    <p class="inline-block leading-tight text-sm align-middle">Join {{ $numStudents }} {{$students}} who<br>
                        have already registered.</p>
                </div>
            </div>
</section>
</header>


