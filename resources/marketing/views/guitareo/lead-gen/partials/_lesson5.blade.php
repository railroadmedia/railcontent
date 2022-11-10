<section class="content-inside py-10 px-3 md:py-16 lg:py-24">
    <div class="container max-w-7xl mx-auto">
        @if (!empty($headLine))
            {!! $headLine !!}
        @endif
        @if (!empty($desc))
            {!! $desc !!}
        @endif
        <div class="flex flex-wrap">
            @foreach ($lessons as $key => $lesson)
                <div class="mb-4 px-3 md:px-4 md:w-1/2 lg:w-1/3 lesson-thumbnail @if(!empty($lesson['details'])) with-details @endif">
                    <div class="cursor-pointer" @if(!empty($lesson['locked'])) data-open="getAccess" @elseif(!empty($lesson['Url'])) href="{{ $lesson['Url'] }}" @endif>
                        <div class="thumb">
                            @if(!empty($lesson['badgeText']))
                                <span class="badge" @if(!empty($lesson['badgeBgColor'])) style="background:{{ $lesson['badgeBgColor'] }};" @endif>
                                    {!!  $lesson['badgeText']  !!}
                                </span>
                            @endif
                            @if(!empty($lesson['locked']))
                                <div class="lock-overlay">
                                    <i class="fas fa-lock"></i>
                                </div>
                            @elseif(!empty($lesson['singleLesson']))
                                <div class="play-overlay">
                                    <i class="fas fa-play"></i>
                                </div>
                            @else
                                <div class="play-overlay">
                                    <i class="fas fa-arrow-right"></i>
                                </div>
                            @endif
                            <picture>
                                <source media="(min-width: 1024px)" srcset="https://cdn.musora.com/image/fetch/w_550,q_auto:best/{{ $lesson['imgUrl'] }}">
                                <source media="(min-width: 768px)" srcset="https://cdn.musora.com/image/fetch/w_500,q_auto:best/{{ $lesson['imgUrl'] }}">
                                <img class="w-full" src="https://cdn.musora.com/image/fetch/w_400,q_auto:best/{{ $lesson['imgUrl'] }}" alt="lesson-{{ $key + 1 }}">
                            </picture>
                        </div>
                    </div>
                    @if(!empty($lesson['title']))
                        <h2 class="mt-2 font-bold text-sm md:text-lg leading-none md:leading-none">{!! $lesson['title'] !!}
                            @if(!empty($lesson['details']))
                                <br>
                                <em class="font-normal text-gray-400 uppercase" style="font-size:11px;">{{ $lesson['details'] }}</em></h2>
                            @endif
                    @endif
                </div>
            @endforeach
        </div>
    </div>
</section>
