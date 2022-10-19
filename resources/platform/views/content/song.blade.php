@extends('partials.layout')

@section('meta')
    <title>{{ $lessonContent->fetch('fields.title') }} | Musora</title>
@endsection

@section('inject-components')
    <script src="{{ mix('platform/js/lesson-page.js') }}"></script>

    <script type="text/javascript">
        document.querySelectorAll('.song-play-button').forEach(item => {
            item.addEventListener("click", function () {
                console.log('test');
                document.getElementById('open-exercise-button').click();
            });
        })
    </script>
@endsection

@section('content')
    @include('content.breadcrumbs._lesson-breadcrumbs')

    {{-- Session Token for Railtracker progress tracking --}}
    {{--    <input type="hidden" id="sessionToken" value="{{ railtracker_session_token() }}">--}}

    <div class="tw-w-full tw-max-w-[1703px] tw-mx-auto tw-px-4 md:tw-px-8 mv-3">
        <div id="lessonInfo" class="tw-flex xl:tw-flex-row tw-flex-col align-v-top ">

            <div class="tw-flex tw-flex-col tw-pr-0 xl:tw-pr-8 tw-grow tw-w-full">
                {{-- Back Button --}}
                <a href="{{ url()->route('platform.content-type-catalog', ["contentTypeName" => 'songs']) }}" 
                   class="tw-no-underline tw-transition tw-inline-flex tw-text-[#00101D] dark:tw-text-white tw-items-center tw-w-fit">
                   <i class="fas fa-arrow-circle-left tw-text-4xl tw-mr-2" aria-hidden="true"></i>
                   <span class="tw-font-bebas-neue tw-uppercase tw-text-xl">Back</span>
                </a>
                {{-- Song Container --}}
                <div class="tw-flex tw-flex-col sm:tw-flex-row tw-py-4 song-content-container">

                    <div class="tw-flex tw-flex-col song-play-button song-album-cover sm:tw-mr-6 tw-mb-6 sm:tw-mb-0">
                        <div class=" tw-aspect-square sm:tw-max-w-[338px] tw-min-w-[175px] 2xl:tw-w-screen corners-10 flex-center flex-column shadow-md tw-bg-[#d1d1d1] dark:tw-bg-[#081825]">
                            <img src="{{ $lessonContent->fetch( 'data.original_thumbnail_url', $lessonContent->fetch('data.thumbnail_url') ) }}"
                                 alt="Album Art"
                                 class="corners-10 tw-transition-opacity tw-opacity-0 tw-w-full"
                                 loading="lazy"
                                 onload="this.classList.remove('tw-opacity-0')"
                            >
                            {{-- Play Icon --}}
                            <div class="thumb-title flex-center text-center ph-1 rounded ba-white-2 hover-border-drumeo"
                                    style="width: 80px; height: 80px; position: absolute;">
                                <div class="square heading rounded pointer text-white hover-text-drumeo shadow-md"
                                        style="width: 80px; height: 80px;">
                                    <i class="fas fa-play absolute-center" style="margin-left: 2px;"></i>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="tw-flex flex-column tw-w-full song-details">
                        <div>
                            <h1 class="text-black font-bold item-title heading dark:tw-text-white">{{ $lessonContent->fetch('fields.title') }}</h1>
                            <p class="text-grey-3 tw-text-lg dark:tw-text-[#9EC0DC] tw-text-[#3F3F46] mt-1 mb-3">
                                {{ $lessonContent->fetch('fields.artist') }} -
                                {{ $lessonContent->fetch('fields.album') }} -
                                {{ implode(', ', $lessonContent->fetch('*fields.style.value', [])) }}
                            </p>

                            <div class="flex flex-row flex-wrap play-complete-buttons">
                                <button class="tw-btn-primary tw-bg-{{ $brand }} hover:tw-bg-{{ $brand }}-600 tw-mr-3 tw-mb-3 song-play-button">
                                    <i class="fas fa-play tw-mr-2 tw-text-base song-play-button"></i>
                                    Play
                                </button>

                                <button class="btn tw-mb-3 completeButton collapse-250 {{ $lessonContent->fetch('progress_percent', 0) === 100 ? 'is-complete' : '' }}"
                                    data-tooltip="Mark Lesson as Complete"
                                    data-content-id="{{ $lessonContent['id'] }}">

                                    <span class="incompleted bg-{{ $themeColor }} inverted text-{{ $themeColor }}">
                                        <i class="fas fa-check"></i>
                                        <span class="ml-1 tw-text-lg">Mark as Complete</span>
                                    </span>

                                    <span class="completed bg-{{ $themeColor }} text-white">
                                            <i class="fas fa-check"></i>
                                            <span class="ml-1 tw-text-lg">Completed</span>
                                        </span>
                                </button>

                            </div>

                            <div class="flex-row content-lesson-action-buttons">
                                <content-lesson-action-buttons
                                    theme-color="{{ $themeColor }}"
                                    title="{{ $lessonContent->fetch('fields.title') }}"
                                    :instructors="{{ json_encode($lessonContent['instructors'] ?? []) }}"
                                    parent-title="{{ isset($parent) ? $parent->fetch('fields.title') : null }}"
                                    :is-liked="{{ json_encode($lessonContent['is_liked_by_current_user'] ?? false) }}"
                                    :like-count="{{ $lessonContent['like_count'] ?? 0 }}"
                                    :is-added="{{ json_encode($lessonContent->fetch('is_added_to_primary_playlist') ?? false) }}"
                                    content-id="{{ $lessonContent->fetch('id') }}"
                                    user-id="{{ auth()->id() }}"
                                    :resources="{{ json_encode(array_merge($lessonContent['resources'] ?? [], $parent['resources'] ?? [])) }}"
                                />
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Mobile Small Sidebar --}}
                <div class="flex flex-column mb-3 hide-sm-up">
                    <div class="flex flex-row mb-2">
                        <h6 class="tw-text-2xl tw-leading-none tw-font-bold tw-text-[#00101D] dark:tw-text-white">
                            Related Lessons
                        </h6>
                    </div>

                    <content-catalogue
                        catalogue-type="grid"
                        theme-color="{{ $themeColor }}"
                        :use-theme-color="true"
                        :pre-loaded-content="{{ $relatedLessons }}"
                        @if(!empty($lockUnowned))
                        :lock-unowned="true"
                        @endif
                        :display-inline="true"
                        user-id="{{ auth()->id() }}"
                    />
                </div>

                @if(!empty($lessonContent->fetch('*assignments', [])))
                    <div style="height: 0px; overflow: hidden;">
                        <div class="flex flex-row pv-3">
                            <h1 class="heading dark:tw-text-white">Assignments</h1>
                        </div>
                        <div class="flex flex-row">
                            <div class="flex flex-column">
                                @foreach($lessonContent->fetch('*assignments', []) as $index => $assignment)
                                    <div class="flex flex-row">
                                        <div class="flex flex-column grow">
                                            <content-assignment
                                                theme-color="{{ $themeColor }}"
                                                brand="{{ $brand }}"
                                                timecode="{{ $assignment->fetch('data.timecode', 0) }}"
                                                id="{{ $assignment->fetch('id') }}"
                                                xp="{{ $assignment->fetch('xp') }}"
                                                title="{{ $assignment->fetch('fields.title') }}"
                                                soundslice-slug="{{ $assignment->fetch('fields.soundslice_slug') }}"
                                                :completed="{{ json_encode($assignment->fetch('completed')) }}"
                                                position="{{ $index }}"
                                                :user-id="{{ auth()->id() }}"
                                            />
                                        </div>
                                    </div>
                                @endforeach

                                @include('partials.bladesora.members.partials._completion-bonus', [
                                    "xpBonus" => $lessonContent->fetch('xp_bonus', 0),
                                    "isComplete" => $lessonContent->fetch('progress_percent', 0) === 100,
                                    "themeColor" => 'drumeo'
                                ])
                            </div>
                        </div>
                    </div>
                @endif

                <div class="flex flex-row song-comments-container">
                    <comments
                        :brand="$brand"
                        theme-color="{{ $themeColor }}"
                        content-id="{{ $lessonContent->fetch('id') }}"
                        user-id="{{ user()->id }}"
                        user-name="{{ user()->display_name }}"
                        user-avatar="{{ user()->profile_picture_url }}"
                        user-xp="{{ user()->total_xp }}"
                        user-access-level="{{ user()->access_level }}"
                        :is-admin="{{ json_encode(user()->isAdmin()) }}"
                    ></comments>
                </div>
            </div>

            {{-- Desktop Sidebar --}}
            <div class="mb-3 hide-xs-only xl:tw-max-w-[420px]">
                <div class="flex flex-row mb-2">
                    <h6 class="tw-text-2xl tw-leading-none tw-font-bold tw-text-[#00101D] dark:tw-text-white">
                        Related Lessons
                    </h6>
                </div>

                <content-catalogue
                    catalogue-type="grid"
                    theme-color="{{ $themeColor }}"
                    :use-theme-color="true"
                    :pre-loaded-content="{{ $relatedLessons }}"
                    @if(!empty($lockUnowned))
                    :lock-unowned="true"
                    @endif
                    :display-inline="true"
                    user-id="{{ user()->id }}"
                />
            </div>

        </div>
    </div>

    @include('partials.bladesora.members.content._lesson-complete', [
        "themeColor" => $themeColor,
        "thisLessonJson" => $thisLessonJson,
        "nextLessonJson" => !empty($nextChild) ? $nextLessonJson : null,
    ])
@endsection
