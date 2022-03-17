<section class="text-white text-center clearfix px-3 md:px-4 py-7 md:py-12 lg:py-16" style="background:{{ $bg }};">
    <div class="container mx-auto">
        @isset($headLine)
            <h3>{!! $headLine !!}</h3>
        @endisset
        @isset($subHeadLine)
            <h6 class="opacity-70 mt-3 mb-8 leading-normal">{!! $subHeadLine !!}</h6>
        @endisset
        <div class="flex flex-wrap text-left mx-auto" style="max-width:1200px">
            @foreach ($lessons as $lesson)
                <div class="w-full md:w-1/2 lg:w-1/3 px-2 md:px-4 mb-7 md:mb-10 step">
                    <div class="@isset($lesson['playButton'])cursor-pointer play-vimeo autoplay-video @endisset relative" @isset($lesson['dataOpen']) data-open="{{ $lesson['dataOpen'] }}" @endisset>
                        <img class="w-full rounded-lg" src="https://cdn.musora.com/image/fetch/w_700,q_auto:best/{{ $lesson['image'] }}">
                        @isset($lesson['playButton']) 
                            <i class="fas fa-play play-button absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2"></i>
                        @endisset
                    </div>
                    <h6 class="mt-4 mb-2 @isset($lessonTitleFont) {{ $lessonTitleFont }} @endisset"><strong>{!! $lesson['title'] !!}</strong></h6>
                    <p class="opacity-70">{!! $lesson['description'] !!}</p>
                </div>
            @endforeach
        </div>
    </div>
</section>