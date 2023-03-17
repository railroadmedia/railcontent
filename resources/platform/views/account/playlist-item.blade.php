@php
    //dd($playlistItem);
    $brandParams = [
        'drumeo' => '&show_chords=0',
        'singeo' => '&show_staff_t1=0&show_staff_t2=0&show_chords=0',
        'guitareo' => '',
        'pianote' => '&show_chords=1',
    ];
    $recordingIdx = 1;
    
    if (($lessonType == 'song' || $lessonType == 'assignment') && property_exists($playlistItem, 'is_instrumentless_track') && $playlistItem['is_instrumentless_track']) {
        $recordingIdx = 2;
    }
    
    $soundsliceAdditionalParams = $brandParams[$brand] . '&layout=3&recording_idx=' . $recordingIdx;
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

    {{-- <p class="tw-text-white">{{ json_encode($playlist) }}</p> --}}

    {{-- WRAPPER VUE --}}
    <playlist-playback-wrapper 
        lesson-type="{{ $lessonType }}" 
        brand="{{ $brand }}" 
        user-id="{{ user()->id }}"
        additional-soundslice-params="{{ $soundsliceAdditionalParams }}"
        soundslice-slug="{{ $playlistItem['soundslice_slug'] ?? '' }}" 
        content-id="{{ $lessonContent->fetch('id') }}"
        youtube-video-id="{{ $lessonContent->fetch('fields.video.fields.youtube_video_id') }}"
        vimeo-video-id="{{ $lessonContent->fetch('fields.video.fields.vimeo_video_id') }}"
        current-second="{{ $playlistItem['start_second'] ?? 0 }}"
        total-duration="{{ $lessonContent->fetch('fields.video.fields.length_in_seconds', 0) }}"
        video-length="{{ $lessonContent->fetch('fields.video.fields.length_in_seconds') }}"
        progress-state="{{ $lessonContent->fetch('progress_state') }}"
        :useLegacyVideoPlayer="{{ user()->use_legacy_video_player ?? false }}"
        video-poster-image-url="{{ $lessonContent['video_poster_image_url'] ?? '' }} }}"
        :video-media-sources="{{ json_encode($lessonContent['video_playback_endpoints'] ?? []) }}"
        hls-manifest-url="{{ $lessonContent['hlsManifestUrl'] ?? '' }}"
        :video-chapters="{{ json_encode($lessonContent['chapters'] ?? []) }}"
        like-count="{{ $lessonContent['like_count'] ?? 0 }}"
        :is-liked="{{ json_encode($lessonContent['is_liked_by_current_user'] ?? false) }}"
        :song-ranges="{{ json_encode($lessonContent['ranges'] ?? []) }}"
        :ranges-video-ids="{{ json_encode($rangesVideoIds ?? []) }}"
        :captions="{{ $lessonContent->fetch('fields.video.data.captions', $lessonContent['captions'][0] ?? null) }}"
        cast-title="{{ $lessonContent->fetch('fields.title') }}"
        thumbnail-url="{{ $lessonContent->fetch('data.thumbnail_url') }}"
        description="{{ $lessonContent->fetch('data.description') }}"
        :instructors="{{ json_encode($lessonContent['coaches'] ?? []) }}"
        parent-title="{{ isset($parent) ? $parent->fetch('fields.title') : null }}"
        :video-resources="{{ json_encode(array_merge($lessonContent['resources'] ?? [], $parent['resources'] ?? [])) }}"
        :playlist-items="{{ $playlistItems }}" 
        :related-lessons="{{ $relatedLessons }}"
        :lock-unowned="{{ !empty($lockUnowned) }}" 
        playlist-name="{{ $playlist['name'] }}"
        playlist-duration="{{ $playlist['duration'] }}"
        playlist-url="{{ $playlist['url'] }}"
        playlist-item-id="{{ $playlist['user_playlist_item_id'] }}"
        user-name="{{ user()->display_name }}" 
        user-avatar="{{ user()->profile_picture_url }}"
        user-xp="{{ user()->totalXP() }}" 
        user-access-level="{{ user()->access_level }}"
    >
        <template>
            @include('partials.bladesora.members.content.lesson-video._buttons', [
                'themeColor' => '{{ $brand }}',
                'prevLessonUrl' => !empty($previousChild) ? $previousChild->fetch('url') : null,
                'nextLessonUrl' => !empty($nextChild) ? $nextChild->fetch('url') : null,
                'hasQAVideo' => !empty($lessonContent['qna_video_playback_endpoints']),
                'isCompleted' => $lessonContent->fetch('completed'),
                'contentId' => $lessonContent->fetch('id'),
                'xpAmount' => $lessonContent->fetch('fields.xp'),
                'nextLabel' => 'Next',
                'prevLabel' => 'Previous',
            ])
        </template>
    </playlist-playback-wrapper>
@endsection

@section('layout-scripts')
    @parent
    <script src="{{ mix('platform/js/vendor~player.js') }}"></script>
@endsection
