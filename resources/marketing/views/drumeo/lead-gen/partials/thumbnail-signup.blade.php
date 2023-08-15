<a {{ !empty($url) ? 'href=' . $url : '' }}  {{ !empty($modal) ? 'data-open=' . $modal : '' }} class="lesson-grid-item cursor-pointer {{ !empty($modal) ? 'autoplay-video' : '' }} {{ !empty($locked) ? 'locked' : '' }}">
    <div class="top-image" style="background-image:url({{ $image }});">
        @if(!empty($badge))
            <span class="top-left-badge">{{ $badge }}</span>
        @endif
        @if(!empty($locked))
            <span class="lock-icon"><i class="fas fa-lock"></i></span>
        @endif
        @if(!empty($title))
            <div class="titles">
                <h4 class="two-line-wrap">{{ $title }}</h4>
            </div>
        @endif
    </div>
</a>
