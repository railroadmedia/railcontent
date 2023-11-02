<section class="px-3 sm:px-0 text-center customize relative z-50 overflow-hidden lazyload" style="background: #eff7ff;">
        <div class="container max-w-6xl mx-auto relative z-50" style="background: #eff7ff;" data-bg={{ $mainImage }}>
            <div class="flex flex-wrap items-center px-4 sm:px-6 py-10">
                <div class="text-center sm:text-left w-full sm:w-1/2 lg:w-5/12 sm:pl-5" style="background: #eff7ff;">
                    <img class="h-20 sm:h-24 lg:h-28 -mb-3 sm:mb-0 lg:mb-3 lazyload" data-src="{{ $logo }}"
                    alt="{{ $logoAlt }}">
                    <h1 class="py-2"><strong>{{ $title }}</strong></h1>
                <div class="text-center sm:text-left py-3 md:py-5">
                        <ul>
                            @foreach ($points as $index => $point)
                                @if ($loop->last)
                                    <li class="text-{{ $brand }}"><p class="pt-2"><i class="fas fa-sharp fa-solid fa-certificate pr-1"></i> <strong>{{ $point }}</strong></p></li>
                                @else
                                    <li><p class="pt-2"><i class="fas fa-check text-{{ $brand }} pr-1"></i> {{ $point }}</p></li>
                                @endif
                            @endforeach
                        </ul>
                        <div class="flex flex-wrap flex-col sm:flex-nowrap lg:flex-row items-center mt-6 sm:mt-5 lg:mt-10">
                    <div class="w-full sm:w-2/3 text-center sm:pr-2 my-1">
                        <a href="#final" class="join blue medium w-full anchor-slide">{{ $buttonTxt }}</a>
                    </div>
                    <div class="w-full sm:w-2/3 sm:flex py-2 md:py-0 items-center">
                        <img class="h-7 sm:mb-1 lg:mb-0 mr-1 sm:mr-0 lg:mr-1 lazyload"
                            data-src="{{ $studentProfilesImage }}" alt="{{ $profileImageAlt }}">
                        <p class="inline-block leading-tight text-xs align-middle">Join {{ $numStudents }}
                            {{ $students }} who have already registered.</p>
                    </div>
                </div>
                </div>
                </div>
                
                <div class="flex w-full justify-center sm:justify-start sm:w-1/2 lg:w-7/12 sm:order-1 sm:pl-5 mt-7 sm:mt-0 hidden sm:block">
                    <img class="max-w-lg sm:max-w-2xl lg:max-w-4xl lazyload" data-src={{ $mainImage }} alt="collage">
                </div>
            </div>
        </div>
    </section>