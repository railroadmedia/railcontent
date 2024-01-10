<div class="flex flex-row">
    <div class="flex flex-column next-prev-button-col mr-1" dusk="previous-lesson">
        @if(!empty($prevLessonUrl))
            <a href="{{ $prevLessonUrl }}"
               data-tooltip="Previous Lesson"
               class="tw-btn-secondary tw-text-{{ $brand }}">
                <i class="fas fa-chevron-left"></i>
                <span class="hide-xs-only ml-1">{{ isset($prevLabel) ? $prevLabel : 'Previous Lesson' }}</span>
            </a>
        @else
            <a class="tw-btn-secondary tw-text-gray-400 dark:tw-text-[#7E9AB1] no-events">
                <i class="fas fa-chevron-left"></i>
                <span class="hide-xs-only ml-1">{{ isset($prevLabel) ? $prevLabel : 'Previous Lesson' }}</span>
            </a>
        @endif
    </div>

    <div class="flex flex-column">
        <div class="flex flex-row">
            @if($hasQAVideo)
                <div class="flex flex-column ph-1">
                    <button id="playQAVideo"
                            data-tooltip="Play QnA Video"
                            data-open-modal="QAVideoModal"
                            class="btn">
                        <span class="qa bg-{{ $brand }} inverted text-{{ $brand }}">
                            <i class="fas fa-question-circle"></i>
                            <span class="hide-xs-only ml-1">Watch Q&A</span>
                        </span>
                        <span class="lesson bg-{{ $brand }} inverted text-{{ $brand }}">
                            <i class="fas fa-play"></i>
                            <span class="hide-xs-only ml-1">Watch Lesson</span>
                        </span>
                    </button>
                </div>

                {{--  Signup modal  --}}
                <div id="QAVideoModal" class="modal">
                    <div class="tw-flex tw-justify-center tw-items-center">
                        <div class="tw-max-w-3xl" style="padding-bottom: 56.25%;">
                            <iframe class="tw-absolute tw-w-full tw-h-full tw-top-0 tw-left-0" src="{{$lessonContent['qna_video_playback_endpoints'][0]['file']}}" allowfullscreen title="QnA Video"></iframe>
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </div>

    <div class="flex flex-column next-prev-button-col ml-1" dusk="next-lesson">
        @if(!empty($nextLessonUrl))
            <a href="{{ $nextLessonUrl }}"
               class="tw-btn-secondary tw-text-{{ $brand }}"
               data-tooltip="Next Lesson">
                <span class="hide-xs-only mr-1">{{ isset($nextLabel) ? $nextLabel : 'Next Lesson' }}</span>
                <i class="fas fa-chevron-right"></i>
            </a>
        @else
            <a class="tw-btn-secondary tw-text-gray-400 dark:tw-text-[#7E9AB1] no-events">
                <span class="hide-xs-only mr-1">{{ isset($nextLabel) ? $nextLabel : 'Next Lesson' }}</span>
                <i class="fas fa-chevron-right"></i>
            </a>
        @endif
    </div>
</div>
