@php
    if (!empty($lessonContent->fetch('fields.video.fields.youtube_video_id'))) {
        $videoProps = [
            'ref' => 'mediaElementVueInstance',
            'videoId' => $lessonContent->fetch('fields.video.fields.youtube_video_id'),
            'currentSecond' => $lessonContent->fetch('last_watch_position_in_seconds', 0),
            'totalDuration' => $lessonContent->fetch('fields.video.fields.length_in_seconds', 0),
            'videoLength' => $lessonContent->fetch('fields.video.fields.length_in_seconds'),
            'progressState' => $lessonContent->fetch('progress_state'),
            'contentId' => $lessonContent->fetch('id'),
            'useIntersectionObserver' => true,
            'videoId' => $lessonContent->fetch('fields.video.fields.youtube_video_id'),
            'videoType' => 'youtube',
            'useLegacyPlayer' => false,
        ];
    } elseif (user()->use_legacy_video_player ?? false || $agent->isSamsung()) {
        $videoProps = [
            'ref' => 'mediaElementVueInstance',
            'elementId' => 'lessonPlayer',
            'poster' => $lessonContent['video_poster_image_url'] ?? '',
            'sources' => $lessonContent['video_playback_endpoints'] ?? [],
            'hlsManifestUrl' => $lessonContent['hlsManifestUrl'] ?? '',
            'videoId' => $lessonContent->fetch('fields.video.fields.vimeo_video_id'),
            'contentId' => $lessonContent->fetch('id'),
            'currentSecond' => $lessonContent->fetch('last_watch_position_in_seconds', 0),
            'progressState' => $lessonContent->fetch('progress_state'),
            'videoLength' => $lessonContent->fetch('fields.video.fields.length_in_seconds'),
            'chapters' => $lessonContent['chapters'] ?? [],
            'userId' => user()->id(),
            'likeCount' => $lessonContent['like_count'] ?? 0,
            'isLiked' => $lessonContent['is_liked_by_current_user'] ?? false,
            'checkForTimecode' => true,
            'videoId' => $lessonContent->fetch('fields.video.fields.vimeo_video_id'),
            'videoType' => 'vimeo',
            'useLegacyPlayer' => true,

        ];
    } elseif (!empty($lessonContent->fetch('fields.video.fields.vimeo_video_id'))) {
        $videoProps = ['title' => $lessonContent->fetch('fields.title'),
            'lessonType' => $lessonType,
            'thumbnailUrl' => $lessonContent->fetch('data.thumbnail_url'),
            'description' => $lessonContent->fetch('data.description'),
            'instructors' => $lessonContent['coaches'] ?? [],
            'parentTitle' => isset($parent) ? $parent->fetch('fields.title') : null,
            'isLiked' => $lessonContent['is_liked_by_current_user'] ?? false,
            'likeCount' => $lessonContent['like_count'] ?? 0,
            'isAdded' => $lessonContent->fetch('is_added_to_primary_playlist') ?? false,
            'contentId' => $lessonContent->fetch('id'),
            'userId' => auth()->id(),
            'sources' => $lessonContent['video_playback_endpoints'] ?? [],
            'resources' => array_merge($lessonContent['resources'] ?? [], $parent['resources'] ?? []),
            'showAddToList' => $lessonType != 'song',
            'showInfoButton' => !empty($lessonContent->fetch('*fields.instructor')) || !empty($lessonContent->fetch('data.description')) || !empty($lessonContent['chapters']),
            'reportUserEmail' => user()->email,
            'reportUserName' => user()->display_name,
            'reportRecipient' => config('mailora.'. $brand . '.ask-question-recipient'),
            'reportLogo' => config('mailora.'. $brand . '.logo-link'),
            'videoId' => $lessonContent->fetch('fields.video.fields.vimeo_video_id'),
            'videoType' => 'vimeo',
            'useLegacyPlayer' => false,
            'hlsManifestUrl' => $lessonContent['hlsManifestUrl'] ?? '',
        ];
    }
@endphp
@extends('partials.layout', ['forceHideSidebar' => false])

@section('meta')
    <title>{{ $lessonContent->fetch('fields.title') }} | Musora</title>
@endsection

@section('inject-components')
    <script src="{{ mix('platform/js/lesson-page.js') }}"></script>
@endsection

@section('content')
    {{-- Session Token for Railtracker progress tracking --}}
    <input type="hidden" id="sessionToken" value="{{ railtracker_session_token() }}">

    {{-- Workouts page template --}}
    <workouts-playback
        breadcrumb-first-level-url="/{{ $brand }}/workouts"
        breadcrumb-first-level-title="Workouts"
        :breadcrumb-last-level-title="{{ json_encode($lessonContent->fetch('fields.title')) }}"
        :video-props="{{ json_encode($videoProps) }}"
        :related-lessons="{{ $relatedLessons }}"
    />
@endsection

@section('layout-scripts')
    @parent
    <script src="{{ mix('platform/js/vendor~player.js') }}"></script>
@endsection
