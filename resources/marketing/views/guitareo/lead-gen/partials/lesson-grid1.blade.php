@php
    $lessonNum = 1;
@endphp

<div class="lesson-grid">
    <div class="container lg:mx-auto max-w-6xl">
        <div class="white-box">
            <h2 class="px-3 md:px-4">{{ $header }}</h2>
            <div class="flex flex-wrap">
                @foreach ($lessons as $lesson)
                    <div class="relative lg:w-1/3 sm:w-1/2 px-3 md:px-4 lesson-thumbnail @if(!empty($details)) with-details @endif">
                        <a @if(!empty($lesson['locked'])) class="get-access-trigger" @elseif(!empty($lesson['Url'])) href="{{ $lesson['Url'] }}" @endif>
                            <div class="thumb col">
                                @if(!empty($lesson['badgeText']))
                                    <span class="badge">
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
                                @if(!empty($lesson['details']))
                                    <div class="series-details">
                                        {{ $lesson['details'] }}
                                    </div>
                                @endif
                                <img src="{{ $lesson['imgUrl'] }}" alt="lesson-{{ $lessonNum }}">
                            </div>
                            @isset($lesson['accessButton'])
                                <div class="access-button @if(!empty($accessButtonColor)) {{ $accessButtonColor }} @endif">{{ $lesson['accessButton'] }}</div>
                            @endisset
                        </a>
                        @if(!empty($lesson['title']))
                            <h4 class="col">{!! $lesson['title'] !!}<br>
                                <i>Beginner</i></h4>
                        @else
                            <h4 class="col"></h4>
                        @endif
                    </div>

                    @php
                        $lessonNum++;
                    @endphp
                @endforeach
            </div>
        </div>
    </div>
</div>