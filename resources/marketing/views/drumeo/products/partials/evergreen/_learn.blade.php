<section class="px-3 sm:px-0 text-center customize relative z-50 overflow-hidden" style="background: #eff7ff;">
    <div class="container max-w-6xl mx-auto relative z-50" style="background: #eff7ff;" data-bg="{{ $mainImage }}">
        <div class="flex flex-wrap items-center px-4 sm:px-6 pt-10 md:py-10 lg:py-20">
            <div class="text-center sm:text-left w-full sm:w-1/2 lg:w-5/12 sm:pl-5" style="background: #eff7ff;">
                <img class="h-20 sm:h-24 lg:h-26 -mb-3 sm:mb-0 lg:mb-3 opacity-0" 
                     src="{{ $logo }}"  
                     loading="lazy" 
                     onload="this.classList.remove('opacity-0')" 
                     alt="{{ $logoAlt }}">
                <h1 class="py-6 sm:py-4"><strong>{!! $title !!}</strong></h1>
                <div class="text-center sm:text-left sm:pb-5">
                    <ul>
                        @foreach ($points as $index => $point)
                            @if ($loop->last)
                                <li class="text-{{ $brand }}">
                                    <p class="pt-2"><i class="fas fa-sharp fa-solid fa-certificate pr-1"></i>
                                        <strong>{{ $point }}</strong></p>
                                </li>
                            @else
                                <li>
                                    <p class="pt-2"><i class="fas fa-check text-{{ $brand }} pr-1"></i>
                                        {{ $point }}</p>
                                </li>
                            @endif
                        @endforeach
                    </ul>
                    <div class="flex flex-wrap flex-col sm:flex-nowrap md:flex-row items-center mt-6 sm:mt-5 lg:mt-10">
                        <div class="w-full md:w-2/3 text-center sm:pr-2 my-1">
                            <div class="w-full">
                                @include('drumeo.products.partials.evergreen._button', [
                                    'link' => $buttonLink,
                                    'buttonClass' => 'text-white font-bebas tracking-widest',
                                    'buttonText' => $buttonText,
                                ])
                            </div>
                        </div>
                    </div>
                    @include('drumeo.products.partials.evergreen._price-link', [
                        'enrollmentLink' => $enrollmentLink,
                        'brandTitle' => $brandTitle,
                    ])
                </div>
            </div>
            <div class="flex w-full justify-center sm:justify-start sm:w-1/2 lg:w-7/12 sm:order-1 sm:pl-5 mt-7 sm:mt-0 hidden sm:block">
                <img class="max-w-lg sm:max-w-2xl lg:max-w-4xl pb-4 opacity-0" 
                     src="{{ $mainImage }}" 
                     alt="collage" 
                     loading="lazy" 
                     onload="this.classList.remove('opacity-0')">
            </div>
        </div>
    </div>
    <div class="w-full sm:hidden text-center py-8">
        <img class="opacity-0" src="{{ $mainImage }}" alt="collage" loading="lazy" onload="this.classList.remove('opacity-0')" >
    </div>
</section>
