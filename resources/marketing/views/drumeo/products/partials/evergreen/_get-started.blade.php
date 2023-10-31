<section class="text-center px-5 py-4 sm:px-6 sm:py-10 md:py-14 lg:py-20 bg-blue-50">
    <div class="container max-w-4xl mx-auto">
        <div class="flex flex-wrap sm:flex-nowrap items-center justify-center">
            <img class="h-28 sm:h-36 lg:h-48 lazyload"
                data-src={{$logo}}
                alt="logo">
            <h4 class="leading-loose text-left">
                <ul>
                    @foreach ($items as $item)
                        <li
                            class="text-base md:text-xl capitalize leading-tight mb-3 sm:mb-4">
                            <i class="fas fa-sharp fa-solid fa-circle-check text-xs md:text-xl text-{{$brand}}"></i><span class="pl-3">{{ $item }}</span>
                        </li>
                    @endforeach
                    </ul>
            </h4>
        </div>

        <a href="#final" class="join blue medium w-3/4 sm:w-1/2 mt-6 sm:mt-12 mb-3 anchor-slide">{{$buttonText}}</a><br>
        <img class="h-7 mr-1 mb-5 sm:mb-10 lazyload" alt="joined student profiles" data-src={{$studentProfilesImage}}>
        <p class="inline-block leading-tight text-sm align-middle mb-5 sm:mb-10">Join
            {{ $numStudents }} {{$students}} who<br> have already registered.</p>
    </div>
</section>
