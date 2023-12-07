<div class="tw-container tw-mx-auto tw-px-4 md:tw-px-8 bg-{{ $brand }} tw-rounded-[10px]">
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
                        <span class="progress-percent body tw-font-bold text-{{ $brand }}
                                    {{ $progress > 50 ? '' : 'right' }}">
                            {{ round($progress) }}%
                        </span>
                    </span>
                </div>
                <div class="flex flex-column align-center trophy ph-2 title">
                    <div class="reward flex flex-row text-{{ $brand }} align-v-center dense tw-text-xs font-bold nowrap">
                        <i class="fas fa-trophy text-{{ $brand }}"></i>
                        @if(!empty($xpAmount))
                        &nbsp;&nbsp;{{ $xpAmount }} XP
                        @endif
                    </div>

                    <div class="white-underlay ba-{{ $brand }}-5 {{ $progress === 100 ? 'visible' : '' }} border-darken"></div>
                </div>
            </div>
        </div>

        <div class="tw-flex tw-flex-col tw-text-white tw-w-full sm:tw-w-auto tw-justify-center">
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
                <div class="tw-flex">
                    <button class="btn resetProgress"
                            data-brand="{{ $brand }}"
                            data-content-id="{{ $contentId }}"
                            title="Reset Prgress">
                            <span class="bg-white inverted tw-text-white tw-px-6 tw-items-center tw-border-none tw-shadow-none tw-flex-col">
                                <i class="fas fa-undo tw-text-white reset tw-mb-0.5 tw-text-lg" aria-hidden="true"></i> Reset
                            </span>
                    </button>
                    <button class="btn completeButton tw-text-base
                                   {{ $isCompleted ? 'is-complete' : '' }}"
                            dusk="master-complete-button"
                            title="Mark Lesson as Complete"
                            data-brand="{{ $brand }}"
                            data-content-id="{{ $contentId }}">

                        <span class="incompleted bg-white inverted tw-text-white tw-px-6 tw-items-center tw-border-none tw-shadow-none tw-flex-col">
                            <div class="tw-border-2 tw-border-white tw-rounded-full tw-px-1 tw-mb-1.5"><i class="fas fa-check tw-text-[10px] tw-mb-1"></i></div> Complete
                        </span>

                        <span class="completed tw-text-white tw-px-6 tw-items-center tw-border-none tw-shadow-none tw-flex-col">
                            <div class="tw-border-2 tw-border-white tw-bg-white tw-rounded-full tw-px-1 tw-mb-1.5"><i class="fas fa-check tw-text-[10px] tw-mb-1 tw-text-{{$brand}}"></i></div> Completed
                        </span>
                    </button>
                </div>
            @endif
        </div>
    </div>
</div>
