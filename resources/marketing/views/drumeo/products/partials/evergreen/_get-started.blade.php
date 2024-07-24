<section x-data="{ visible: false }" 
         x-intersect.once="visible = true;" 
class="container-video text-center px-6 {{ !empty($eg) ? 'py-12 md:py-16 lg:py-20 bg-blue-50' : 'py-6 md:py-8 lg:py-14' }}">
        <div class="container max-w-4xl mx-auto">
            <div class="flex flex-wrap sm:flex-nowrap items-center justify-center pb-4">
                <img class="{{ isset($extraClass) ? $extraClass . ' ' : '' }}h-28 md:h-38 lg:h-40 p-2 opacity-0 transition duration-300 ease-in-out"
                    src={{ $logo }}
                    loading="lazy" 
                    onload="this.classList.remove('opacity-0')" 
                    alt="logo">
                <ul class="pl-6">
                    @foreach ($items as $item)
                        <li>
                            <h4 class="leading-loose text-left">
                                <i class="fas fa-sharp fa-solid fa-circle-check text-{{ $brand }} mr-5" aria-hidden="true"></i>{{ $item }}
                            </h4>
                        </li>
                    @endforeach
                </ul>
            </div>
            {{-- <a href={{$buttonLink}} class="join blue medium w-full sm:w-1/2 md:w-1/3 lg:w-3/5 mt-6 sm:mt-12 mb-3 anchor-slide" role="button">{{$buttonText}}</a><br> --}}
            <div class="w-full flex flex-col items-center">
                <div class="w-full sm:w-1/2 md:w-1/3">
                    @include('drumeo.products.partials.evergreen._button', [
                        'link' => $buttonLink,
                        'buttonClass' => 'text-white font-bebas tracking-widest',
                        'buttonText' => $buttonText,
                    ])
                </div>
                {{-- <div class="flex flex-row items-center py-2">
                     @if ($numStudents > 500)
                    <img class="h-7 mr-2" alt="Joined Student Profiles" src={{ $studentProfilesImage }}>
                    <span class="inline-block align-middle leading-tight text-xs">Join
                        {{ $numStudents }} {{ $students }} who<br> have already registered.
                    </span>
                    @endif
                </div> --}}
            </div>
            @include('drumeo.products.partials.evergreen._price-link', [
                'enrollmentLink' => $enrollmentLink,
                'brandTitle' => $brandTitle,
            ])
        </div>
    </section>
