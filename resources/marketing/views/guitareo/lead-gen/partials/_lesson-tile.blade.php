<div class="mb-4 px-3 md:px-4 md:w-1/2 lg:w-1/3 lesson-thumbnail @if(!empty($details)) with-details @endif">
    <a @if(!empty($locked)) data-open="getAccess" @elseif(!empty($Url)) href="{{ $Url }}" @endif>
        <div class="thumb">
            @if(!empty($badgeText))
                <span class="badge">
                    {!!  $badgeText  !!}
                </span>
            @endif
            @if(!empty($locked))
                <div class="lock-overlay">
                    <i class="fas fa-lock"></i>
                </div>
            @elseif(!empty($singleLesson))
                <div class="play-overlay">
                    <i class="fas fa-play"></i>
                </div>
            @else
                <div class="play-overlay">
                    <i class="fas fa-arrow-right"></i>
                </div>
            @endif
            <img src="{{ $imgUrl }}">
        </div>
    </a>
    @if(!empty($title))
        <h4>{!! $title !!}
            @if(!empty($details))
                <br>
                <em>Beginner / {{ $details }}</em></h4>
            @endif
    @else
        <h4></h4>
    @endif
</div>