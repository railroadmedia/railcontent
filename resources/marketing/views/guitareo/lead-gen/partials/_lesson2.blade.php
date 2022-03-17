<section class="text-white px-3 pt-10 pb-7 md:pb-12 lg:pb-16 text-center" style="background:{{ $bg }};">
    <div class="container mx-auto max-w-5xl">
        <h3 class="mb-7 md:mb-16">{!! $headLine !!}</h3>
        <div class="flex flex-wrap text-left mx-auto" style="max-width: 1200px;">
            @foreach($lessons as $lesson)
                <div class="w-full md:w-1/2 flex items-start mb-10 px-2 md:px-4">
                    <img class="w-12 md:w-16 mr-3 md:mr-4" src="https://cdn.musora.com/image/fetch/w_130,q_auto:best/{{ $lesson['icon'] }}">
                    <div>
                        <h5><strong>{!!  $lesson['title'] !!}</strong></h5>
                        <p class="mt-2 sm:mt-3">{!!  $lesson['description'] !!}</p>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>