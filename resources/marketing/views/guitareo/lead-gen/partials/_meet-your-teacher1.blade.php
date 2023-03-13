<section class="meet-rob px-5 py-12 md:py-8 lg:py-20 text-white text-center clearfix overflow-hidden" style="background-color:{{ $bgColor }};">
    <div class="container mx-auto">
        <div class="content-wrap float-right">
            {!! $meetYourTeacher !!}
            {!! $name !!}
            <p class="leading-relaxed md:leading-relaxed">{!! $desc !!}</p>
            <div class="{{ $asSeenColor }} text-lg md:text-xl lg:text-2xl">AS SEEN IN:</div>
            <div class="thumbs mt-4">
                @foreach ($thumbnails as $key => $thumbnail)
                    <div class="float-left w-full px-2 md:px-3 md:w-1/3">
                        <div data-open="{{ $thumbnail['dataOpen'] }}" class="autoplay-video thumb-wrap transition-all duration-300 cursor-pointer">
                            <img class="rounded-lg" src="https://www.musora.com/musora-cdn/image/width=250,quality=85/{{ $thumbnail['src'] }}" alt="as-seen-{{ $key + 1 }}">
                            <p class="leading-tight mt-2 mb-5 md:mb-0">
                                <strong>{!! $thumbnail['desc'] !!}</strong><br>
                                @isset($thumbnail['views'])
                                    {!! $thumbnail['views'] !!}
                                @endisset
                            </p>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</section>
