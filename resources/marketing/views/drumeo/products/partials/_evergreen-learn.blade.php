<section class="px-5 sm:px-6 py-10 sm:py-14 lg:py-20" style="background: #eff7ff;">
    <div class="container max-w-6xl mx-auto">
        <div class="flex flex-col md:flex-row items-center">
            <!-- Left Column -->
            <div class="w-full md:w-6/12 text-center lg:text-left mb-5 md:mb-0">
                <img class="h-20 sm:h-24 lg:h-28 -mb-3 sm:mb-0 lg:mb-3 lazyload" data-src="{{ $logo }}"
                    alt="{{ $logoAlt }}">
                <h1><strong>{{ $title }}</strong></h1>
                <div class="text-base text-center md:text-left md:text-xl font-normal leading-10 py-3 md:py-5">
                    <ul>
                        @foreach ($points as $index => $point)
                            @if ($loop->last)
                                <li class="text-{{ $brand }} font-bold"><i class="fas fa-sharp fa-solid fa-certificate"></i> {{ $point }}</li>
                            @else
                                <li><i class="fas fa-check text-{{ $brand }}"></i> {{ $point }}</li>
                            @endif
                        @endforeach
                    </ul>
                </div>

                <div class="flex flex-wrap flex-col sm:flex-nowrap md:flex-row lg:flex-row items-center mt-6 sm:mt-5 lg:mt-10">
                    <div class="w-full sm: w-1/2 md:w-1/2 text-center sm:pr-2 my-1">
                        {{-- <a href="#final" class="join blue medium w-full anchor-slide">{{ $buttonTxt }}</a> --}}
                        <a x-data="{ isHovered: false }" href="#final"
                            class="medium w-full anchor-slide text-white cursor-pointer text-center user-select-none bg-{{ $brand }} rounded-full outline-none py-2 px-14 md:py-3 font-bebas text-xl md:text-2xl tracking-wider text-uppercase text-decoration-none transition duration-300 inline-block"
                            @mouseenter="isHovered = true" @mouseleave="isHovered = false"
                            :style="{ filter: isHovered ? 'brightness(120%)' : 'brightness(100%)' }">
                            {{ $buttonTxt }}
                        </a>
                    </div>
                    <div class="w-full flex sm:w-1/2 py-2 md:py-0">
                        <img class="h-7 sm:mb-1 lg:mb-0 mr-1 sm:mr-0 lg:mr-1 lazyload"
                            data-src="{{ $studentProfilesImage }}" alt="{{ $profileImageAlt }}">
                        <p class="inline-block leading-tight text-sm align-middle">Join {{ $numStudents }}
                            {{ $students }} who have already registered.</p>
                    </div>
                </div>
            </div>
            <!-- Right Column (hidden on Mobile) -->
            <div class="w-full md:w-6/12 px-3 hidden sm:block">
                <img src="{{ $mainImage }}" alt="{{ $students }}" class="rounded-2xl">
            </div>
        </div>
    </div>
</section>
