<div id="instructorInfo" class="tw-container tw-mx-auto fluid tw-bg-white dark:tw-bg-[#191b1c] tw-rounded-[10px]">
    <div class="tw-max-w-screen-2xl tw-px-4 md:tw-px-8 tw-mx-auto lean pv-2">
        @if(!empty($lessonList))
            <div class="tw-flex tw-flex-row">
                <h6 class="body tw-font-bold tw-uppercase tw-text-[#191b1c] dark:tw-text-white tw-mb-1">Course Lessons</h6>
            </div>
            <div class="tw-flex tw-flex-row dark-mode tw-mb-3">
                <content-catalogue
                    catalogue-type="list"
                    theme-color="{{ $themeColor }}"
                    :use-theme-color="true"
                    :pre-loaded-content="{{ $lessonList }}"
                    @if(!empty($lockUnowned))
                    :lock-unowned="true"
                    @endif
                    user-id="{{ auth()->id() }}"></content-catalogue>
            </div>
        @endif

        @if(!empty($contentDescription))
            <div  class="tw-flex tw-flex-row mb-3">
                <div class="tw-flex tw-flex-col tw-flexgrow tw-text-[#191b1c] dark:tw-text-white">
                    <div id="collapsableInfo">
                        <h6 class="tw-text-base tw-mb-4 tw-font-bold tw-uppercase tw-mb-1">{{ $contentDescriptionHeader ?? 'About the Lesson' }}</h6>
                        <div class="body">
                            {!! $contentDescription !!}
                        </div>
                    </div>
                </div>
            </div>
        @endif

        @if(!empty($contentChapters))
            <div class="tw-flex tw-flex-row mb-3">
                <div class="tw-flex tw-flex-col tw-flexgrow tw-text-[#191b1c] dark:tw-text-white">
                    <h6 class="tw-text-base tw-mb-4 tw-font-bold tw-uppercase tw-mb-1">Chapter Markers</h6>
                    @foreach($contentChapters as $chapter)
                        @if(isset($chapter['chapter_timecode']))
                            <p class="body tw-text-[#191b1c] dark:tw-text-white">
                                <a class="tw-font-bold font-underline"
                                   data-jump-to-time="{{ $chapter['chapter_timecode'] ?? 0 }}">{{ gmdate('H:i:s', $chapter['chapter_timecode'] ?? 0) }}</a> - {{ $chapter['chapter_description']??'' }}
                            </p>
                        @endif
                    @endforeach
                </div>
            </div>
        @endif

        @if(!empty($instructors))
            @foreach($instructors as $instructor)
                <div  class="tw-flex tw-flex-row mb-3">
                    <div class="tw-flex tw-flex-col tw-flexgrow tw-text-[#191b1c] dark:tw-text-white">
                        <div id="collapsableInfo">
                            <h6 class="tw-text-base tw-mb-4 tw-font-bold tw-uppercase tw-mb-1">About {{ $instructor->fetch('fields.name') }}</h6>
                            <div class="body">
                                {!! $instructor->fetch('data.biography')  !!}
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        @endif

        {{ $extra ?? '' }}
    </div>
</div>
<div class="tw-container tw-mx-auto fluid">
    <div class="tw-flex tw-flex-col tw-items-center">
        <div id="toggleInstructorInfo" class="tw-transition tw-text-center tw-text-[#191b1c] tw-bg-white dark:tw-bg-[#191b1c] dark:tw-text-white tw-cursor-pointer tw-mb-[-20px]">
            <span class="x-tiny tw-uppercase tw-font-bold">Info</span>
            <i class="fas fa-chevron-down"></i>
        </div>
    </div>
</div>
