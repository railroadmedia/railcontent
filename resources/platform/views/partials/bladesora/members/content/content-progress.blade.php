<div class="tw-container tw-mx-auto tw-px-4 md:tw-px-8 bg-{{ $brand }}">
    <div class="content-progress flex flex-row flex-wrap tw-py-6">

        @if(!empty($labelText))
            <div class="flex flex-column left-column align-v-center">
                <h3 class="display text-white nowrap">
                    {{ $labelText }}
                </h3>
            </div>
        @endif

        <div class="flex flex-column">
            <div class="flex flex-row trophy-progress-bar mr-2 bg-{{ $brand }} bg-darken {{ $isCompleted ? 'complete' : '' }}">
                <div class="flex flex-column trophy-progress-cutoff bg-{{ $brand }} inverted relative">
                    <span class="progress-border ba-{{ $brand }}-5 border-darken absolute-fill"></span>
                    <span
                        data-current-progress="{{ $progress }}"
                        class="trophy-progress relative bg-white"
                        style="transform:translateX({{ $progress - 100 }}%);"
                    >
                        <span class="progress-percent body font-bold text-{{ $brand }}
                                    {{ $progress > 50 ? '' : 'right' }}">
                            {{ round($progress) }}%
                        </span>
                    </span>
                </div>
                <div class="flex flex-column align-center trophy ph-2 title">
                    <div class="reward flex flex-row text-{{ $brand }} align-v-center dense tiny font-bold nowrap">
                        <i class="fas fa-trophy text-{{ $brand }}"></i>
                        @if(!empty($xpAmount))
                        &nbsp;&nbsp;{{ $xpAmount }} XP
                        @endif
                    </div>

                    <div class="white-underlay ba-{{ $brand }}-5 {{ $progress === 100 ? 'visible' : '' }} border-darken"></div>
                </div>
            </div>
        </div>

        <div class="tw-flex tw-flex-col tw-text-white">
            @if(empty($showCompleteButton))
                <a href="{{ $isCompleted ? $backButton['url'] : $nextLessonUrl }}"
                   class="tw-btn-secondary tw-text-lg tw-mb-0 tw-leading-[0] tw-border-[3px] tw-text-white">
                    @if(!$isCompleted)
                        @if($isStarted)
                            Next Lesson &raquo;
                        @else
                            Start First Lesson
                        @endif
                    @else
                        {!! $backButton['text'] !!}
                    @endif
                </a>
            @else
                <button class="btn completeButton
                               {{ $isCompleted ? 'is-complete' : '' }}"
                        dusk="master-complete-button"
                        title="Mark Lesson as Complete"
                        data-brand="{{ $brand }}"
                        data-content-id="{{ $contentId }}">

                    <span class="incompleted bg-white inverted text-white tw-px-6">
                        <i class="fas fa-check mr-1"></i> Mark as Complete
                    </span>

                    <span class="completed bg-white text-{{ $brand }} tw-px-6">
                        <i class="fas fa-check mr-1"></i>Completed
                    </span>
                </button>
            @endif
        </div>
    </div>
</div>
