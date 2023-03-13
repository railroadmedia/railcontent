<section class="text-white px-3 pt-10 pb-7 md:pb-12 lg:pb-16 text-center" style="background:{{ $bg }};">
    <div class="container mx-auto max-w-5xl">
        <div class="mb-7 text-lg md:text-2xl md:mb-16 lg:text-3xl">{!! $headLine !!}</div>
        <div class="flex flex-wrap text-left mx-auto" style="max-width: 1200px;">
            @foreach($lessons as $key => $lesson)
                <div class="w-full md:w-1/2 flex items-start mb-10 px-2 md:px-4">
                    <img class="w-12 md:w-16 mr-3 md:mr-4" src="https://www.musora.com/musora-cdn/image/width=130,quality=85/{{ $lesson['icon'] }}" alt="icon-{{ $key + 1 }}">
                    <div>
                        <h5><strong>{!!  $lesson['title'] !!}</strong></h5>
                        <p class="mt-2 sm:mt-3">{!!  $lesson['description'] !!}</p>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>
