<section class="meet-rob px-5 py-12 md:py-8 lg:py-20 text-white text-center clearfix overflow-hidden" style="background-color:{{ $bgColor }};@isset($bgImg)background-image:url(https://cdn.musora.com/image/fetch/w_1200,q_auto:best/{{ $bgImg }}); @endisset">
    <div class="container mx-auto">
        <div class="content-wrap float-right">
            {!! $meetYourTeacher !!}
            {!! $name !!}
            <p class="leading-relaxed md:leading-relaxed">{!! $desc !!}</p>
            <h4 class="{{ $asSeenColor }}">AS SEEN IN:</h4>
            <div class="thumbs mt-4">
                @foreach ($thumbnails as $thumbnail)
                    <div class="float-left w-full px-2 md:px-3 md:w-1/3">
                        <div data-open="{{ $thumbnail['dataOpen'] }}" class="autoplay-video thumb-wrap transition-all duration-300 cursor-pointer">
                            <img class="rounded-lg" src="https://cdn.musora.com/image/fetch/w_400,q_auto:best/{{ $thumbnail['src'] }}">
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