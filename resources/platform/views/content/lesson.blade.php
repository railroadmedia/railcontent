@php
    $bodyClass = ($bodyClass ?? '') . ' sidebar';
    $leftSidebar = true;
    $allAssignments = $lessonContent['assignments'] ?? [];
    $themeColor = 'singeo';
@endphp

@extends('members.layout')

@section('meta')
    <title>{{ $lessonContent->fetch('fields.title') }} | Singeo</title>
@endsection

@section('styles')
@endsection

@section('inject-components')
    <script src="{{ mix('assets/members/js/lesson-page.js') }}"></script>
@endsection

@section('breadcrumbs')
    @include('members.content.breadcrumbs._lesson-breadcrumbs')
@endsection

@section('content')
    @include('members.partials._content-sidebar')

    {{-- Session Token for Railtracker progress tracking --}}
    <input type="hidden" id="sessionToken" value="{{ railtracker_session_token() }}">

    <div class="container fluid bg-grey-5 pb-3">
        <div class="container p-lg-only lean">
            {{-- Video Player --}}
            @if ($lessonType == 'song')
                <youtube-player ref="mediaElementVueInstance" video-id="{{ $rangesVideoIds['original'] ?? '' }}"
                    :current-second="{{ $lessonContent->fetch('last_watch_position_in_seconds', 0) }}"
                    :total-duration="{{ $lessonContent->fetch('fields.video.fields.length_in_seconds', 0) }}"
                    progress-state="{{ $lessonContent->fetch('progress_state') }}"
                    :content-id="{{ $lessonContent->fetch('id') }}" :use-intersection-observer="true"
                    @play="handleVideoPlay" @pause="handleVideoPause"
                    :ranges="{{ json_encode($lessonContent['ranges'] ?? []) }}"
                    :ranges-video-ids="{{ json_encode($rangesVideoIds ?? []) }}">
                </youtube-player>
            @elseif(!empty($lessonContent->fetch('fields.video.fields.youtube_video_id')))
                <div class="widescreen mb-2 bg-black">
                    <transition appear name="fade">
                        <youtube-player ref="mediaElementVueInstance"
                            video-id="{{ $lessonContent->fetch('fields.video.fields.youtube_video_id') }}"
                            :current-second="{{ $lessonContent->fetch('last_watch_position_in_seconds', 0) }}"
                            :total-duration="{{ $lessonContent->fetch('fields.video.fields.length_in_seconds', 0) }}"
                            progress-state="{{ $lessonContent->fetch('progress_state') }}"
                            content-id="{{ $lessonContent->fetch('id') }}" :use-intersection-observer="true"
                            theme-color="singeo" @play="handleVideoPlay" @pause="handleVideoPause">
                        </youtube-player>
                    </transition>
                </div>
            @else
                <div id="lessonVideoWrap">
                    @if (current_user()->getUseLegacyVideoPlayer() || $agent->isSamsung())
                        <transition appear name="fade">
                            <video-media-element ref="mediaElementVueInstance" element-id="lessonPlayer" brand="singeo"
                                theme-color="singeo" poster="{{ $lessonContent['video_poster_image_url'] ?? '' }}"
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
                                :check-for-timecode="true" @playing="handleVideoPlay" @pause="handleVideoPause">

                                <div class="widescreen title text-singeo">
                                    <i class="fas fa-spinner fa-spin absolute-center"></i>
                                </div>
                            </video-media-element>
                        </transition>
                    @else
                        <transition appear name="fade">
                            <video-player ref="mediaElementVueInstance" theme-color="singeo"
                                poster="{{ $lessonContent['video_poster_image_url'] ?? '' }}"
                                :sources="{{ json_encode($lessonContent['video_playback_endpoints'] ?? []) }}"
                                @if ($lessonType == 'song')
                                :ranges="{{ json_encode($lessonContent['ranges'] ?? []) }}"
                                :ranges-video-ids="{{ json_encode($rangesVideoIds ?? []) }}"
                                :show-range-buttons="true"
                    @endif
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
                    <div class="widescreen title text-singeo mb-2"></div>
                    </video-player>
                    </transition>
            @endif
        </div>
        @endif
    </div>

        <div class="container lean">
            <video-resources
                    theme-color="singeo"
                    brand="singeo"
                    title="{{ $lessonContent->fetch('fields.title') }}"
                    :instructors="{{ json_encode($lessonContent['coaches'] ?? []) }}"
                    parent-title="{{ isset($parent) ? $parent->fetch('fields.title') : null }}"
                    :is-liked="{{ json_encode($lessonContent['is_liked_by_current_user'] ?? false) }}"
                    :like-count="{{ $lessonContent['like_count'] ?? 0 }}"
                    :is-added="{{ json_encode($lessonContent->fetch('is_added_to_primary_playlist') ?? false) }}"
                    content-id="{{ $lessonContent->fetch('id') }}"
                    user-id="{{ auth()->id() }}"
                    :resources="{{ json_encode(array_merge($lessonContent['resources'] ?? [], $parent['resources'] ?? [])) }}"
                    :show-add-to-list="{{ json_encode($lessonType != 'song') }}"
            ></video-resources>

                {{--Add to List and Next/Prev Buttons --}}
                @include('bladesora::members.content.lesson-video._buttons', [
                    "themeColor" => 'singeo',
                    "prevLessonUrl" => !empty($previousChild) ? $previousChild->fetch('url') : null,
                    "nextLessonUrl" => !empty($nextChild) ? $nextChild->fetch('url') : null,
                    "hasQAVideo" => !empty($lessonContent['qna_video_playback_endpoints']),
                    "isCompleted" => $lessonContent->fetch('completed'),
                    "contentId" => $lessonContent->fetch('id'),
                    "xpAmount" => $lessonContent->fetch('xp')
                ])

        {{-- Ask a Question Input --}}
        @if ($showEmail === true)
            <div class="flex flex-row mt-3" dusk="question-email">
                <email-form
                    email-subject="{{ $emailSubjectOverride ?? 'Question on Lesson: ' . $lessonContent->fetch('fields.title') . ' from: ' . current_user()->getEmail() }}"
                    email-type="{{ $emailTypeOverride ?? 'ask-question' }}" email-endpoint="/mailora/secure/send"
                    success-message="Your question has been sent!"
                    user-avatar="{{ current_user()->getProfilePictureUrl() }}" :lesson-page="true" theme-color="singeo">
                </email-form>
            </div>
        @endif
    </div>
    </div>

    @if (!empty($lessonContent->fetch('*fields.instructor')) || !empty($lessonContent->fetch('data.description')) || !empty($lessonContent['chapters']))
        @include('bladesora::members.content._content-info', [
        "instructors" => $lessonContent->fetch('*fields.instructor'),
        "contentDescription" => $lessonContent->fetch('data.description', null),
        "contentChapters" => $lessonContent['chapters'] ?? [],
        ])
    @endif

    <div class="container-fluid bg-singeo">
        @include('bladesora::members.content.content-progress', [
        "themeColor" => 'singeo',
        "contentType" => $lessonContent->fetch('type'),
        "progress" => $lessonContent->fetch('progress_percent'),
        "nextLessonUrl" => '',
        "xpAmount" => $lessonContent->fetch('xp'),
        "showCompleteButton" => true,
        "contentId" => $lessonContent->fetch('id'),
        "brand" => 'singeo',
        "isCompleted" => $lessonContent->fetch('completed')
        ])
    </div>

    <div class="container mt-3">
        <input id="lessonProgressPercent" type="hidden" value="{{ $lessonContent->fetch('progress_percent') }}">


        @if(!empty($allAssignments))
            <div class="flex flex-column grow mt-3">
                <div class="flex flex-row pv-3">
                    <h1 class="heading">Assignments</h1>
                    @php
                        $formattedAssignments = [];
                        foreach ($allAssignments as $index => $assignment) {
                            $content = [];
                            $content['themeColor'] = $themeColor;
                            $content['timecode'] = $assignment->fetch('data.timecode', 0);
                            $content['id'] = $assignment->fetch('id');
                            $content['xp'] = $assignment->fetch('xp');
                            $content['title'] = $assignment->fetch('fields.title');
                            $content['soundsliceSlug'] = $assignment->fetch('fields.soundslice_slug');
                            $content['completed'] = $assignment->fetch('completed');
                            $content['userId'] = auth()->id();
                            $content['position'] = $index;
                            $formattedAssignments[] = $content;
                        }
                    @endphp
                </div>
                @php
                    $formattedAssignments = [];
                    foreach ($allAssignments as $index => $assignment) {
                        $content = [];
                        $content['dusk'] = 'content-assignment';
                        $content['themeColor'] = 'singeo';
                        $content['timecode'] = $assignment->fetch('data.timecode', 0);
                        $content['id'] = $assignment->fetch('id');
                        $content['xp'] = $assignment->fetch('xp');
                        $content['title'] = $assignment->fetch('fields.title');
                        $content['soundsliceSlug'] = $assignment->fetch('fields.soundslice_slug');
                        $content['completed'] = $assignment->fetch('completed');
                        $content['userId'] = auth()->id();
                        $content['position'] = $index;
                        $formattedAssignments[] = $content;
                    }
                @endphp
                <div class="flex flex-row">
                    <assignments-container :assignments="{{ json_encode($formattedAssignments) }}">
                        <template slot="completion-bonus">
                            @include('bladesora::members.partials._completion-bonus', [
                            "xpBonus" => $lessonContent->fetch('xp_bonus', 0),
                            "isComplete" => $lessonContent->fetch('progress_percent', 0) === 100,
                            "themeColor" => 'singeo'
                            ])
                        </template>
                    </assignments-container>
                </div>
            </div>
        @endif
    </div>

    <div class="container mv-3">
        <div id="lessonInfo" class="flex flex-row reverse align-v-top">
            <div class="flex flex-column lesson-sidebar mb-3">
                <div class="flex flex-row mb-2 ph-1">
                    <h6 class="title text-black">
                        Related Lessons
                    </h6>
                </div>

                <content-catalogue catalogue-type="grid" theme-color="singeo" :use-theme-color="true"
                    :pre-loaded-content="{{ $relatedLessons }}" @if (!empty($lockUnowned))
                    :lock-unowned="true"
                    @endif
                    :display-inline="true"
                    user-id="{{ auth()->id() }}"
                    ></content-catalogue>
            </div>

            <div class="flex flex-column pr-1 p-sm-down grow">
                <div class="flex flex-row">
                    <comments theme-color="singeo" brand="singeo" content-id="{{ $lessonContent->fetch('id') }}"
                        user-id="{{ current_user()->getId() }}" user-name="{{ current_user()->getDisplayName() }}"
                        user-avatar="{{ current_user()->getProfilePictureUrl() }}"
                        user-xp="{{ Railroad\Points\Services\UserPointsService::fetchPoints(current_user()->getId()) }}"
                        user-access-level="{{ $userAccessLevel }}" profile-base-route="/members/profile/"
                        :is-admin="{{ json_encode(current_user()->getPermissionLevel() === 'administrator') }}">
                    </comments>
                </div>
            </div>
        </div>
    </div>

    @include('bladesora::members.content._lesson-complete', [
    "themeColor" => 'singeo',
    "thisLessonJson" => $thisLessonJson,
    "nextLessonJson" => !empty($nextChild) ? $nextLessonJson : null,
    ])
@endsection
