<section class="content-inside py-10 px-3 md:py-16 lg:py-24">
    <div class="container max-w-7xl mx-auto">
        @if (!empty($headLine))
            {!! $headLine !!}
        @endif
        @if (!empty($desc))
            {!! $desc !!}
        @endif
        <div class="flex flex-wrap">
            @foreach ($lessons as $lesson)
                <div class="mb-4 px-3 md:px-4 md:w-1/2 lg:w-1/3 lesson-thumbnail @if(!empty($lesson['details'])) with-details @endif">
                    <a @if(!empty($lesson['locked'])) data-open="getAccess" @elseif(!empty($lesson['Url'])) href="{{ $lesson['Url'] }}" @endif>
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
                            <img src="{{ $lesson['imgUrl'] }}">
                        </div>
                    </a>
                    @if(!empty($lesson['title']))
                        <h4>{!! $lesson['title'] !!}
                            @if(!empty($lesson['details']))
                                <br>
                                <em>{{ $lesson['details'] }}</em></h4>
                            @endif
                    @endif
                </div>
            @endforeach
        </div>
    </div>
</section>