    <section class="text-center px-5 sm:px-6 py-8 md:py-12 lg:py-20 bg-blue-50">
        <div class="container max-w-4xl mx-auto">
            <div class="flex flex-wrap sm:flex-nowrap items-center justify-center">
                <img class="h-28 sm:h-34 lg:h-46 lazyload" data-src={{ $logo }} alt="logo">
                <ul class="pl-6">
                    @foreach ($items as $item)
                        <li>
                            <h4 class="leading-loose text-left"><i
                                    class="fas fa-sharp fa-solid fa-circle-check text-{{ $brand }} mr-5"
                                    aria-hidden="true"></i>{{ $item }}</h4>
                        </li>
                    @endforeach
                </ul>
            </div>
            {{-- <a href={{$buttonLink}} class="join blue medium w-full sm:w-1/2 md:w-1/3 lg:w-3/5 mt-6 sm:mt-12 mb-3 anchor-slide" role="button">{{$buttonText}}</a><br> --}}
            <div class="w-full flex flex-col items-center pt-4">
                   <div class="w-full sm:w-1/2 md:w-1/3 xl:w-1/5">
            @include('drumeo.products.partials.evergreen._button', [
                'link' => $buttonLink,
                'buttonClass' => 'text-white font-bebas tracking-widest',
                'buttonText' => $buttonText,
            ])
</div>
                <div class="flex flex-row items-center py-2">
                    <img class="h-7 mr-2 lazyload" alt="Joined Student Profiles" data-src={{ $studentProfilesImage }}>
                    <span class="inline-block align-middle leading-tight text-xs">Join
                        {{ $numStudents }} {{ $students }} who<br> have already registered.
                    </span>
                </div>
            </div>
        </div>
    </section>
