<section class="text-center px-5 sm:px-6 py-8 md:py-12 lg:py-20 bg-blue-50">
    <div class="container max-w-4xl mx-auto">
        <div class="flex flex-wrap sm:flex-nowrap items-center justify-center">
            <img class="h-28 sm:h-34 lg:h-46 lazyload"
                data-src={{$logo}}
                alt="logo">
                <ul class="pl-6">
                    @foreach ($items as $item)
                        <li>
                          <h4 class="leading-loose text-left"><i class="fas fa-sharp fa-solid fa-circle-check text-{{$brand}} mr-5"></i>{{ $item }}</h4>
                        </li>
                    @endforeach
                </ul>
        </div>

        <a href={{$buttonLink}} class="join blue medium w-full sm:w-1/2 lg:w-3/5 mt-6 sm:mt-12 mb-3 anchor-slide">{{$buttonText}}</a><br>
        <img class="h-7 mr-1 mb-5 lazyload" alt="joined student profiles" data-src={{$studentProfilesImage}}>
        <p class="inline-block leading-tight text-sm align-middle mb-5">Join
            {{ $numStudents }} {{$students}} who<br> have already registered.</p>
    </div>
</section>
