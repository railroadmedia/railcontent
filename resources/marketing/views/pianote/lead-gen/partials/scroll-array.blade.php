<div class="side-scroller chords">
    <h1 class="medium-heading mb-4">Other Lessons in this Series</h1>
    <div class="horizontal-scroll">
                    <span class="scroll-left scroll-click">
                        <i class="fas fa-angle-left hidden-xs"></i>
                    </span>
        <span class="scroll-right scroll-click">
                        <i class="fas fa-angle-right hidden-xs"></i>
                    </span>
        
        <div class="inside-scroll-mask">
            <div class="inside-scroll-element" data-current-lesson="{{ $currentLesson }}">
                @foreach ($lessons as $lesson)
                    <div class="lesson-node">
                        <a href="{{ $lesson['url'] }}">
                            <img src="{{ $lesson['img'] }}" alt="{{ $lesson['imgAlt'] }}">
                        </a>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</div>