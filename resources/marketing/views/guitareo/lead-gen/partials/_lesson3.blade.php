<section class="text-white text-center clearfix px-3 md:px-4 py-7 md:py-12 lg:py-16" style="background:{{ $bg }};">
    <div class="container mx-auto">
        @if(!empty($headLine))
            <div class="text-lg md:text-2xl lg:text-3xl">{!! $headLine !!}</div>
        @endif
        @if(!empty($subHeadLine))
            <div class="opacity-70 mt-3 mb-8 leading-normal lg:text-lg lg:leading-normal">{!! $subHeadLine !!}</div>
        @endif
        <div class="flex flex-wrap justify-center text-left mx-auto" style="max-width:1200px">
            @foreach ($lessons as $key => $lesson)
                <div class="w-5/6 md:w-1/2 lg:w-1/3 px-2 md:px-4 mb-7 md:mb-10 step">
                    <div class="@isset($lesson['playButton'])cursor-pointer play-vimeo autoplay-video @endisset relative" @isset($lesson['dataOpen']) data-open="{{ $lesson['dataOpen'] }}" @endisset>
                        <picture>
                            <source media="(min-width: 1024px)" srcset="https://cdn.musora.com/image/fetch/w_450,q_auto:best/{{ $lesson['image'] }}">
                            <source media="(min-width: 768px)" srcset="https://cdn.musora.com/image/fetch/w_500,q_auto:best/{{ $lesson['image'] }}">
                            <img class="w-full rounded-lg lazyload" data-src="https://cdn.musora.com/image/fetch/w_520,q_auto:best/{{ $lesson['image'] }}" alt="lesson-thumbnail{{ $key + 1 }}">
                        </picture>

                        @isset($lesson['playButton'])
                            <i class="fas fa-play play-button absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2"></i>
                        @endisset
                    </div>
                    <h1 class="mt-4 mb-2 @isset($lessonTitleFont) {{ $lessonTitleFont }} @endisset text-base lg:text-lg lg:leading-none"><strong>{!! $lesson['title'] !!}</strong></h1>
                    <p class="opacity-70">{!! $lesson['description'] !!}</p>
                </div>
            @endforeach
        </div>
    </div>
</section>
