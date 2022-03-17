<section class="text-white px-3 pb-7 md:pb-12 lg:pb-16 text-center" style="background: linear-gradient(0deg, #11052b, #010611);">
    <div class="container mx-auto">
        <h1 class="font-bison-bold mb-7 md:mb-12 text-3xl md:text-5xl lg:text-6xl"><strong>{!! $headLine !!}</strong></h1>
        <div class="flex flex-wrap text-left mx-auto" style="max-width: 1200px;">
            @foreach ($lessons as $lesson)
                <div class="w-full md:w-1/2 lg:w-1/3 flex items-start mb-10 px-2 md:px-4">
                    <img class="w-8 mr-3 md:mr-5" src="{{ $lesson['icon'] }}">
                    <div>
                        <h4 class="font-bison-bold">{!! $lesson['title'] !!}</h4>
                        <p class="opacity-70 mt-2 sm:mt-3">{!! $lesson['description'] !!}</p>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>