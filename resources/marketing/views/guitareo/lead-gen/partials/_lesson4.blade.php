<section class="text-white px-3 pb-7 md:pb-12 lg:pb-16 text-center" style="background: linear-gradient(0deg, #11052b, #010611);">
    <div class="container mx-auto">
        <h1 class="font-bison-bold mb-7 md:mb-12 text-3xl md:text-5xl lg:text-6xl"><strong>{!! $headLine !!}</strong></h1>
        <div class="flex flex-wrap text-left mx-auto" style="max-width: 1200px;">
            @foreach ($lessons as $key => $lesson)
                <div class="w-full md:w-1/2 lg:w-1/3 flex items-start mb-10 px-2 md:px-4">
                    <img class="h-auto w-8 mr-3 md:mr-5" src="https://cdn.musora.com/image/fetch/w_70,q_auto:best/{{ $lesson['icon'] }}" alt="icon {{$key}}">
                    <div>
                        <div class="font-bison-bold text-lg md:text-xl lg:text-2xl">{!! $lesson['title'] !!}</div>
                        <p class="opacity-70 mt-2 sm:mt-3">{!! $lesson['description'] !!}</p>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>
