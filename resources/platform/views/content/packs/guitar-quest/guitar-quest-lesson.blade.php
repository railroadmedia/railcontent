@extends('partials.layout')

@section('meta')
    <title>{{ $lessonContent->fetch('fields.title') }} | Musora</title>
@endsection

@section('styles')
    @parent
    <link href="{{ asset('assets/marketing/fonts.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/marketing/guitar-quest.css') }}" rel="stylesheet">
    {{-- Styelsora --}}
    <link href="{{ asset('/stylesora/stylesora.css') }}" rel="stylesheet">
    <link href="{{ asset('/tailwindcss/tailwind.css') }}" rel="stylesheet">
@endsection

@section('inject-components')
    <script src="{{ mix('assets/members/js/lesson-page.js') }}"></script>
@endsection

@section('scripts')
    @parent
    <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.min.js" defer></script>
@endsection

@section('content')
    @include('content.breadcrumbs._lesson-breadcrumbs')

    <div class="container fluid collapsed-h bg-grey-5 pb-3">
        <div class="container lean">

            {{-- Video Title and Resources --}}
            @if(!empty($lessonContent->fetch('fields.video.fields.youtube_video_id')))
                <div class="widescreen mb-2 bg-black">
                    <transition appear name="fade">
                        <youtube-player
                            ref="mediaElementVueInstance"
                            video-id="{{ $lessonContent->fetch('fields.video.fields.youtube_video_id') }}"
                            :current-second="{{ $lessonContent->fetch('last_watch_position_in_seconds', 0) }}"
                            :total-duration="{{ $lessonContent->fetch('fields.video.fields.length_in_seconds', 0) }}"
                            progress-state="{{ $lessonContent->fetch('progress_state') }}"
                            content-id="{{ $lessonContent->fetch('id') }}"
                            :use-intersection-observer="true"
                            @play="handleVideoPlay"
                            @pause="handleVideoPause"
                        ></youtube-player>
                    </transition>
                </div>
            @else
                <div id="lessonVideoWrap">
                    @if(
                        current_user()->getUseLegacyVideoPlayer()
                        || $agent->isSamsung()
                       )
                        <transition appear name="fade">
                            <video-media-element
                                ref="mediaElementVueInstance"
                                element-id="lessonPlayer"
                                brand="guitareo"
                                theme-color="guitareo"
                                poster="{{ $lessonContent['video_poster_image_url'] ?? '' }}"
                                :sources="{{ json_encode($lessonContent['video_playback_endpoints'] ?? []) }}"
                                hls-manifest-url="{{ $lessonContent['hlsManifestUrl'] ?? '' }}"
                                video-id="{{ $lessonContent->fetch('fields.video.fields.vimeo_video_id') }}"
                                content-id="{{ $lessonContent->fetch('id') }}"
                                current-second="{{ $lessonContent->fetch('last_watch_position_in_seconds', 0) }}"
                                progress-state="{{ $lessonContent->fetch('progress_state') }}"
                                video-length="{{ $lessonContent->fetch('fields.video.fields.length_in_seconds') }}"
                                :chapters="{{ json_encode($lessonContent['chapters'] ?? []) }}"
                                user-id="{{ current_user()->getId() }}"
                                like-count="{{ $lessonContent['like_count'] ?? 0 }}"
                                :is-liked="{{ json_encode($lessonContent['is_liked_by_current_user'] ?? false) }}"
                                :check-for-timecode="true"
                                @playing="handleVideoPlay"
                                @pause="handleVideoPause"
                            >
                                <div class="widescreen title text-guitareo">
                                    <i class="fas fa-spinner fa-spin absolute-center"></i>
                                </div>
                            </video-media-element>
                        </transition>
                    @else
                        <transition appear name="fade">
                            <video-player
                                ref="mediaElementVueInstance"
                                theme-color="guitareo"
                                poster="{{ $lessonContent['video_poster_image_url'] ?? '' }}"
                                :sources="{{ json_encode($lessonContent['video_playback_endpoints'] ?? []) }}"
                                hls-manifest-url="{{ $lessonContent['hlsManifestUrl'] ?? '' }}"
                                captions="{{ $lessonContent->fetch('fields.video.data.captions', $lessonContent['captions'][0] ?? null) }}"
                                :chapters="{{ json_encode($lessonContent['chapters'] ?? []) }}"
                                current-second="{{ $lessonContent->fetch('last_watch_position_in_seconds', 0) }}"
                                content-id="{{ $lessonContent->fetch('id') }}"
                                user-id="{{ current_user()->getId() }}"
                                video-id="{{ $lessonContent->fetch('fields.video.fields.vimeo_video_id') }}"
                                cast-title="{{ $lessonContent->fetch('fields.title') }}"
                                :use-intersection-observer="true"
                                @play="handleVideoPlay"
                                @pause="handleVideoPause"
                            >
                                <div class="widescreen title text-guitareo mb-2"></div>
                            </video-player>
                        </transition>
                    @endif
                </div>

            @endif

            <video-resources
                theme-color="guitareoGuitarQuest"
                brand="guitareo"
                title="{{ $lessonContent->fetch('fields.title') }}"
                :instructors="{{ json_encode($lessonContent['coaches'] ?? []) }}"
                parent-title="{{ isset($parent) ? $parent->fetch('fields.title') : null }}"
                :is-liked="{{ json_encode($lessonContent['is_liked_by_current_user'] ?? false) }}"
                :like-count="{{ $lessonContent['like_count'] ?? 0 }}"
                :is-added="{{ json_encode($lessonContent->fetch('is_added_to_primary_playlist') ?? false) }}"
                content-id="{{ $lessonContent->fetch('id') }}"
                user-id="{{ auth()->id() }}"
                :resources="{{ json_encode(array_merge($lessonContent['resources'] ?? [], $parent['resources'] ?? [])) }}"
            ></video-resources>

            {{-- Add to List and Next/Prev Buttons --}}
            @include('bladesora::members.content.lesson-video._buttons', [
                "themeColor" => 'guitareoGuitarQuest',
                "prevLessonUrl" => !empty($previousChild) ? $previousChild->fetch('url') : null,
                "nextLessonUrl" => !empty($nextChild) ? $nextChild->fetch('url') : null,
                "hasQAVideo" => !empty($lessonContent['qna_video_playback_endpoints']),
                "isCompleted" => $lessonContent->fetch('completed'),
                "contentId" => $lessonContent->fetch('id'),
                "xpAmount" => $lessonContent->fetch('xp')
            ])

            {{-- Ask a Question Input --}}
            @if($showEmail === true)
                <div class="flex flex-row mt-3">
                    <email-form
                        email-subject="{{ $emailSubjectOverride ?? 'Question on Lesson: ' . $lessonContent->fetch('fields.title') . ' from: ' . current_user()->getEmail() }}"
                        brand="guitareo"
                        theme-color="guitareo"
                        recipient="nathan@guitareo.com"
                        email-type="layouts/inline/alert"
                        email-endpoint="/mailora/secure/send"
                        email-logo="https://dmmior4id2ysr.cloudfront.net/logos/guitareo-logo.png"
                        email-alert="{{ $emailSubjectOverride ?? 'Question on Lesson: ' . $lessonContent->fetch('fields.title') . ' from: ' . current_user()->getEmail() }}"
                        success-message="Your question has been sent!"
                        user-avatar="{{ current_user()->getProfilePictureUrl() }}"
                        :lesson-page="true">
                    </email-form>
                </div>
            @endif
        </div>
    </div>

    @if(
    !empty($lessonContent->fetch('*fields.instructor')) ||
    !empty($lessonContent->fetch('data.description')) ||
    !empty($lessonContent['chapters'])
    )
        @include('bladesora::members.content._content-info', [
            "instructors" => $lessonContent->fetch('*fields.instructor'),
            "contentDescription" => $lessonContent->fetch('data.description', null),
            "contentChapters" => $lessonContent['chapters'] ?? null,
        ])
    @endif

    <div class="container fluid collapsed bg-gq-blue color-darkblue">
        @include('members.partials._content-progress', [
            "themeColor" => 'guitareo',
            "contentType" => $lessonContent->fetch('type'),
            "progress" => $lessonContent->fetch('progress_percent'),
            "nextLessonUrl" => '',
            "xpAmount" => $lessonContent->fetch('xp'),
            "showCompleteButton" => true,
            "contentId" => $lessonContent->fetch('id'),
            "brand" => 'guitareo',
            "isCompleted" => $lessonContent->fetch('completed', false),
            "isStarted" => $lessonContent->fetch('started', false),
        ])
    </div>

    <div class="container mt-3">
        <input id="lessonProgressPercent" type="hidden"
               value="{{ $lessonContent->fetch('progress_percent') }}">

        @if(!empty($lessonContent['assignments']))
            <div class="flex flex-column grow bg-white corners-10 mt-3">
                <div class="flex flex-row ph pv-3">
                    <h1 class="heading">Assignments</h1>
                </div>
                <div class="flex flex-row">
                    <div class="flex flex-column">
                        @foreach($lessonContent->fetch('*assignments', []) as $index => $assignment)
                            <div class="flex flex-row assignment-component">
                                <div class="flex flex-column grow">
                                    <content-assignment
                                        theme-color="guitareoGuitarQuest"
                                        timecode="{{ $assignment->fetch('data.timecode', 0) }}"
                                        id="{{ $assignment->fetch('id') }}"
                                        xp="{{ $assignment->fetch('xp') }}"
                                        title="{{ $assignment->fetch('fields.title') }}"
                                        soundslice-slug="{{ $assignment->fetch('fields.soundslice_slug') }}"
                                        position="{{ $index }}"
                                        :completed="{{ json_encode($assignment->fetch('completed')) }}"
                                        :user-id="{{ auth()->id() }}"></content-assignment>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        @endif
    </div>

    @if(empty($lessonContent->fetch('*assignments')) && !empty($lessonContent->fetch('*data.sheet_music_image_url.value')))
        <div class="container mv-3">
            <div class="flex flex-column grow bg-white corners-10">
                <div class="flex flex-row ph pv-3">
                    <h1 class="heading">Resources</h1>
                </div>
                <div class="flex flex-row">
                    <div class="flex flex-column">
                        @foreach($lessonContent->fetch('*data.sheet_music_image_url.value') as $sheetMusicImageUrl)
                            <div class="flex flex-row bb-light-1">
                                <div class="flex flex-column grow ph pv-3">
                                    <img src="{{ $sheetMusicImageUrl }}" style="width:100%;">
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    @endif

    <div class="container mv-3">
        <div id="lessonInfo" class="flex flex-row reverse align-v-top">

            @if(!empty($parentChildren))
                <div class="flex flex-column lesson-sidebar bg-white corners-10 mb-3">
                    @if(!empty($parent))
                        <div class="flex flex-row">
                            <div class="flex-column pa-1 grow">
                                <h6 class="body color-gq-yellow">
                                    {{  ucwords(str_replace('bundle', '', str_replace('-', ' ', $parent['type']))) }}
                                </h6>

                                <a href="{{ $parent->fetch('url') }}" class="title mb-2 text-black no-decoration">
                                    {{ $parent->fetch('fields.title') }}
                                </a>
                            </div>
                        </div>
                    @else
                        <div class="flex flex-row">
                            <div class="flex-column pa-1 grow">
                                <a href="{{ url()->route('members.content',
                                        [$lessonType]) }}"
                                   class="title capitalize mb-2 text-black no-decoration">
                                    Other {{ ucwords(str_replace('-', ' ', $lessonType)) }}
                                </a>
                            </div>
                        </div>
                    @endif

                    <div class="flex flex-row content-table
                            {{ !empty($parent) && $parent['lesson_count'] > 10 ? 'has-see-all' : '' }}">
                        <div class="flex flex-column xs-12">
                            <content-catalogue
                                    brand="guitareo"
                                    catalogue-type="list"
                                    theme-color="guitareoGuitarQuest"
                                    :use-theme-color="true"
                                    :pre-loaded-content="{{ $relatedLessons }}"
                                    @if(!empty($lockUnowned))
                                    :lock-unowned="true"
                                    @endif
                                    :compact-layout="true"
                                    user-id="{{ auth()->id() }}"></content-catalogue>

                            @if(!empty($parent) && $parent['lesson_count'] > 10)
                                <div class="flex flex-row pa-1 bt-grey-1-1">
                                    <a href="{{ $parent->fetch('url') }}"
                                       class="btn short bg-guitareo inverted text-guitareo">
                                        See All
                                    </a>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            @endif

            <div class="flex flex-column grow bg-white corners-10">
                <div class="flex flex-row">
                    <comments
                        theme-color="guitareoGuitarQuest"
                        brand="guitareo"
                        content-id="{{ $lessonContent->fetch('id') }}"
                        user-id="{{ auth()->id() }}"
                        user-name="{{ current_user()->getDisplayName() }}"
                        user-avatar="{{ current_user()->getProfilePictureUrl() }}"
                        {{-- todo: update --}}
                        user-xp="{{ 0 }}"
                        user-access-level="{{ '' }}"
                        profile-base-route="/members/profile/"
                        :is-admin="{{ json_encode(current_user()->getPermissionLevel() == 'administrator') }}"
                    ></comments>
                </div>
            </div>
        </div>
    </div>

    {{-- Level Complete Modal --}}
    @include("partials.modals._level-complete")
    {{-- Lesson Complete Modal --}}
    @include("partials.modals._lesson-complete")
    {{-- Quest Complete Modal --}}
    @include("partials.modals._quest-complete")

@endsection
