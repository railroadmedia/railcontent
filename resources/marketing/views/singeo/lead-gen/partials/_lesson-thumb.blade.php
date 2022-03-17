<div class="col sm-12 md-6 lg-4 lesson-thumbnail">
    @if($locked)
        <div class="thumb col collapse">
            <div class="lock-overlay">
                <i class="fas fa-lock"></i>
            </div>

            <img src="{{ $lessonImage }}">
        </div>
    @else
        <a class="thumb col collapse {{ !empty($noPreview) ? '' : 'preview' }}"
        @if(empty($noPreview))
            data-open-modal="previewModal"
        @else
           href="{{ $lessonUrl }}"
        @endif>
            <div class="play-overlay">
                <i class="fas fa-play"></i>
            </div>
            <img src="{{ $lessonImage }}">
        </a>
    @endif

    <h4 class="col collapse">{{ $lessonTitle }}</h4>
</div>

@if(empty($noPreview) && !$locked)
    <div id="previewModal" class="modal lg slide-down">
        <div class="col collapse responsive-ratio video">
            <iframe src="https://player.vimeo.com/video/{{ !empty($previewID) ? '167285840' : '' }}" frameborder="0"></iframe>
        </div>
    </div>
@endif