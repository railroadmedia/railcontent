@extends('partials.layout')

@section('meta')
    <title>{{ $lessonContent->fetch('fields.title') }} | {{ $brand }} | Musora</title>
@endsection

@section('inject-components')
    <script src="{{ mix('platform/js/lesson-page.js') }}"></script>
@endsection

@section('content')
    @include('content.breadcrumbs._lesson-breadcrumbs')

    {{-- Session Token for Railtracker progress tracking --}}
    {{--    <input type="hidden" id="sessionToken" value="{{ railtracker_session_token() }}">--}}

    <div class="tw-container tw-mx-auto tw-px-4 md:tw-px-8 mv-3">
        <div id="lessonInfo" class="flex flex-row align-v-top">

            <div class="flex flex-column pr-1 p-sm-down grow">
                {{-- Back Button --}}
                <a href="{{ url()->route('platform.content-type-catalog', ["contentTypeName" => 'songs']) }}" 
                   class="tw-no-underline tw-transition tw-inline-flex tw-text-[#00101D] dark:tw-text-white tw-items-center">
                   <i class="fas fa-arrow-circle-left tw-text-4xl tw-mr-2" aria-hidden="true"></i>
                   <span class="tw-font-bebas-neue tw-uppercase tw-text-xl">Back</span>
                </a>
                {{-- Song Container --}}
                <div class="flex flex-row pt-4 pb-4 song-content-container">

                    <div class="tw-flex tw-flex-col song-play-button song-album-cover tw-mr-6">
                        <div class="tw-w-screen tw-aspect-square tw-max-w-[338px] tw-min-w-[175px] corners-10 flex-center flex-column shadow-md">
                            <img src="{{ cf_img($lessonContent->fetch('data.original_thumbnail_url', $lessonContent->fetch('data.thumbnail_url')), ['width' => 400, 'height' => 400]) }}"
                                 alt="Album Art"
                                 class="corners-10"
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

                    <div class="flex flex-column tw-w-full align-v-center song-details">
                        <div>
                            <h1 class="text-black font-bold item-title heading dark:tw-text-white">{{ $lessonContent->fetch('fields.title') }}</h1>
                            <p class="text-grey-3 item-title body mt-1 mb-3">
                                {{ $lessonContent->fetch('fields.artist') }} -
                                {{ $lessonContent->fetch('fields.album') }} -
                                {{ implode(', ', $lessonContent->fetch('*fields.style.value', [])) }}
                            </p>

                            <div class="flex flex-row flex-wrap play-complete-buttons">
                                <button class="btn collapse-250 mr-1 song-play-button" style="border-radius: 120px;">
                                    <span class="text-white bg-drumeo song-play-button" style="height: 55px;">
                                        <i class="fas fa-play mr-1 song-play-button" style="margin-left: 2px;"></i>
                                        Play
                                    </span>
                                </button>

                                <button class="btn completeButton collapse-250 {{ $lessonContent->fetch('progress_percent', 0) === 100 ? 'is-complete' : '' }}"
                                        data-tooltip="Mark Lesson as Complete"
                                        data-content-id="{{ $lessonContent['id'] }}">

                                        <span class="incompleted bg-{{ $themeColor }} inverted text-{{ $themeColor }}">
                                            <i class="fas fa-check"></i>
                                            <span class="ml-1">Mark as Complete</span>
                                        </span>

                                    <span class="completed bg-{{ $themeColor }} text-white">
                                            <i class="fas fa-check"></i>
                                            <span class="ml-1">Completed</span>
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
                    <div class="flex flex-row mb-2 ph-1">
                        <h6 class="title text-black dark:tw-text-white">
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
                            <h1 class="heading">Assignments</h1>
                        </div>
                        <div class="flex flex-row">
                            <div class="flex flex-column">
                                @foreach($lessonContent->fetch('*assignments', []) as $index => $assignment)
                                    <div class="flex flex-row">
                                        <div class="flex flex-column grow bt-grey-1-1 dark:tw-border-[#223F57]">
                                            <content-assignment
                                                theme-color="{{ $themeColor }}"
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

                                @include('bladesora::members.partials._completion-bonus', [
                                    "xpBonus" => $lessonContent->fetch('xp_bonus', 0),
                                    "isComplete" => $lessonContent->fetch('progress_percent', 0) === 100,
                                    "themeColor" => 'drumeo'
                                ])
                            </div>
                        </div>
                    </div>
                @endif

                <div class="flex flex-row mt-3 song-comments-container">
{{-- todo: fix once comment component is working --}}
                    
{{--                    <comments--}}
{{--                        brand="drumeo"--}}
{{--                        theme-color="{{ $themeColor }}"--}}
{{--                        content-id="{{ $lessonContent->fetch('id') }}"--}}
{{--                        user-id="{{ user()->id }}"--}}
{{--                        user-name="{{ user()->display_name }}"--}}
{{--                        user-avatar="{{ user()->profile_picture_url }}"--}}
{{--                        user-xp="{{ user()->total_xp }}"--}}
{{--                        user-access-level="{{ user()->access_level }}"--}}
{{--                        :is-admin="{{ json_encode(user()->isAdmin()) }}"--}}
{{--                    />--}}
                </div>
            </div>

            {{-- Desktop Sidebar --}}
            <div class="flex flex-column lesson-sidebar mb-3 hide-xs-only">
                <div class="flex flex-row mb-2 ph-1">
                    <h6 class="title text-black dark:tw-text-white">
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
