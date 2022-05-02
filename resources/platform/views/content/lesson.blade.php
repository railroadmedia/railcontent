@extends('partials.layout')

@section('meta')
    <title>{{ $lessonContent->fetch('fields.title') }} | Singeo</title>
@endsection

@section('inject-components')
    <script src="{{ mix('assets/members/js/lesson-page.js') }}"></script>
@endsection

@section('content')
        <div v-cloak>

            @include('content.breadcrumbs._lesson-breadcrumbs')

            {{-- Session Token for Railtracker progress tracking --}}
            <input type="hidden" id="sessionToken" value="{{ railtracker_session_token() }}">

            <div class="tw-container tw-mx-auto fluid bg-grey-5 tw-pb-3">
                <div class="tw-container tw-mx-auto p-lg-only lean">
                    {{-- Video Player --}}
                    @if ($lessonType == 'song')
                        <youtube-player 
                            ref="mediaElementVueInstance" 
                            video-id="{{ $rangesVideoIds['original'] ?? '' }}"
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
                                <youtube-player
                                    ref="mediaElementVueInstance"
                                    video-id="{{ $lessonContent->fetch('fields.video.fields.youtube_video_id') }}"
                                    :current-second="{{ $lessonContent->fetch('last_watch_position_in_seconds', 0) }}"
                                    :total-duration="{{ $lessonContent->fetch('fields.video.fields.length_in_seconds', 0) }}"
                                    progress-state="{{ $lessonContent->fetch('progress_state') }}"
                                    content-id="{{ $lessonContent->fetch('id') }}" :use-intersection-observer="true"
                                    theme-color="{{ $brand }}" @play="handleVideoPlay" @pause="handleVideoPause">
                                </youtube-player>
                            </transition>
                        </div>
                    @else
                        <div id="lessonVideoWrap">
                            @if (current_user()->getUseLegacyVideoPlayer() || $agent->isSamsung())
                                <transition appear name="fade">
                                    <video-media-element 
                                        ref="mediaElementVueInstance" element-id="lessonPlayer"
                                        brand="{{ $brand }}"
                                        theme-color="{{ $brand }}" poster="{{ $lessonContent['video_poster_image_url'] ?? '' }}"
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

                                        <div class="widescreen title tw-text-{{ $brand }}">
                                            <i class="fas fa-spinner fa-spin absolute-center"></i>
                                        </div>
                                    </video-media-element>
                                </transition>
                            @else
                                <transition appear name="fade">
                                    <video-player  
                                        ref="mediaElementVueInstance"
                                        theme-color="{{ $brand }}"
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
                                        <div class="widescreen title tw-text-{{ $brand }} tw-mb-2"></div>
                                    </video-player>
                                </transition>
                    @endif
                </div>
                @endif
            </div>

                <div class="tw-container tw-mx-auto lean">
                    <video-resources
                        theme-color="{{ $brand }}"
                        brand="{{ $brand }}"
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
                        @include('partials.bladesora.members.content.lesson-video._buttons', [
                            "themeColor" => '{{ $brand }}',
                            "prevLessonUrl" => !empty($previousChild) ? $previousChild->fetch('url') : null,
                            "nextLessonUrl" => !empty($nextChild) ? $nextChild->fetch('url') : null,
                            "hasQAVideo" => !empty($lessonContent['qna_video_playback_endpoints']),
                            "isCompleted" => $lessonContent->fetch('completed'),
                            "contentId" => $lessonContent->fetch('id'),
                            "xpAmount" => $lessonContent->fetch('xp')
                        ])

                {{-- Ask a Question Input --}}
                @if ($showEmail === true)
                    <div class="tw-flex tw-flex-row tw-mt-3" dusk="question-email">
                        <email-form
                            email-subject="{{ $emailSubjectOverride ?? 'Question on Lesson: ' . $lessonContent->fetch('fields.title') . ' from: ' . current_user()->getEmail() }}"
                            email-type="{{ $emailTypeOverride ?? 'ask-question' }}" email-endpoint="/mailora/secure/send"
                            success-message="Your question has been sent!"
                            user-avatar="{{ current_user()->getProfilePictureUrl() }}" :lesson-page="true" theme-color="{{ $brand }}">
                        </email-form>
                    </div>
                @endif
            </div>
            </div>

            @if (!empty($lessonContent->fetch('*fields.instructor')) || !empty($lessonContent->fetch('data.description')) || !empty($lessonContent['chapters']))
                @include('partials.bladesora.members.content._content-info', [
                    "instructors" => $lessonContent->fetch('*fields.instructor'),
                    "contentDescription" => $lessonContent->fetch('data.description', null),
                    "contentChapters" => $lessonContent['chapters'] ?? [],
                ])
            @endif

            <div class="container-fluid tw-bg-{{ $brand }}">
                @include('partials.bladesora.members.content.content-progress', [
                    "themeColor" => '{{ $brand }}',
                    "contentType" => $lessonContent->fetch('type'),
                    "progress" => $lessonContent->fetch('progress_percent'),
                    "nextLessonUrl" => '',
                    "xpAmount" => $lessonContent->fetch('xp'),
                    "showCompleteButton" => true,
                    "contentId" => $lessonContent->fetch('id'),
                    "brand" => '{{ $brand }}',
                    "isCompleted" => $lessonContent->fetch('completed')
                ])
            </div>

            <div class="tw-container tw-mx-auto tw-mt-3">
                <input id="lessonProgressPercent" type="hidden" value="{{ $lessonContent->fetch('progress_percent') }}">


                @if(!empty($allAssignments))
                    <div class="tw-flex tw-flex-col tw-flex-grow tw-mt-3">
                        <div class="tw-flex tw-flex-row pv-3">
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
                                $content['themeColor'] = '{{ $brand }}';
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
                        <div class="tw-flex tw-flex-row">
                            <assignments-container :assignments="{{ json_encode($formattedAssignments) }}">
                                <template slot="completion-bonus">
                                    @include('partials.bladesora.members.partials._completion-bonus', [
                                        "xpBonus" => $lessonContent->fetch('xp_bonus', 0),
                                        "isComplete" => $lessonContent->fetch('progress_percent', 0) === 100,
                                        "themeColor" => '{{ $brand }}'
                                    ])
                                </template>
                            </assignments-container>
                        </div>
                    </div>
                @endif
            </div>

            <div class="tw-container tw-mx-auto mv-3">
                <div id="lessonInfo" class="tw-flex tw-flex-row reverse tw-items-start">
                    <div class="tw-flex tw-flex-col lesson-sidebar tw-mb-3">
                        <div class="tw-flex tw-flex-row tw-mb-2 ph-1">
                            <h6 class="title tw-text-black">
                                Related Lessons
                            </h6>
                        </div>

                        <content-catalogue catalogue-type="grid" theme-color="{{ $brand }}" :use-theme-color="true"
                            :pre-loaded-content="{{ $relatedLessons }}" @if (!empty($lockUnowned))
                            :lock-unowned="true"
                            @endif
                            :display-inline="true"
                            user-id="{{ auth()->id() }}"
                            ></content-catalogue>
                    </div>

                    <div class="tw-flex tw-flex-col pr-1 p-sm-down tw-flex-grow">
                        <div class="tw-flex tw-flex-row">
                            <comments theme-color="{{ $brand }}" brand="{{ $brand }}" content-id="{{ $lessonContent->fetch('id') }}"
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

            @include('partials.bladesora.members.content._lesson-complete', [
                "themeColor" => '{{ $brand }}',
                "thisLessonJson" => $thisLessonJson,
                "nextLessonJson" => !empty($nextChild) ? $nextLessonJson : null,
            ])

        </div>
@endsection
