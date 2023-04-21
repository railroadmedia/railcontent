@php
    //dd($playlistItem);
    //dd(get_defined_vars()['__data']);
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
    if(user()->id == 149628){
    dd($playlistItem['end_second'] );
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

    {{-- WRAPPER VUE --}}
    <playlist-playback-wrapper lesson-type="{{ $lessonType }}" brand="{{ $brand }}" user-id="{{ user()->id }}"
        additional-soundslice-params="{{ $soundsliceAdditionalParams }}" playlist-id="{{ $playlist['id'] }}"
        soundslice-slug="{{ $playlistItem['soundslice_slug'] ?? '' }}" content-id="{{ $lessonContent->fetch('id') }}"
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
        :ranges-video-ids="{{ json_encode($rangesVideoIds ?? []) }}" {{-- Todo: Find a way to re add captions --}} {{-- :captions="{{ $lessonContent->fetch('fields.video.data.captions') }}" --}}
        cast-title="{{ $lessonContent->fetch('fields.title') }}"
        thumbnail-url="{{ $lessonContent->fetch('data.thumbnail_url') }}"
        description="{{ $lessonContent->fetch('data.description') }}"
        :instructors="{{ json_encode($lessonContent['coaches'] ?? []) }}"
        parent-title="{{ isset($parent) ? $parent->fetch('fields.title') : null }}"
        :video-resources="{{ json_encode(array_merge($lessonContent['resources'] ?? [], $parent['resources'] ?? [])) }}"
        :playlist-items="{{ $playlistItems }}" :related-lesson="{{ $relatedLesson }}"
        :related-playlists="{{ $relatedPlaylists }}" playlist-name="{{ $playlist['name'] }}"
        next-lesson-url="{{ $nextPlaylistItemUrl }}" prev-lesson-url="{{ $previousPlaylistItemUrl }}"
        playlist-duration="{{ $playlist['duration'] }}" user-name="{{ user()->display_name }}"
        user-avatar="{{ user()->profile_picture_url }}" user-xp="{{ user()->totalXP() }}"
        :playlist-item-position="{{ $positionInPlaylist }}"
        :playlist-item-id="{{ $playlistItem['id'] }}"
        :start-second="{{ $playlistItem['start_second'] }}"
        :end-second="{{ $playlistItem['end_second'] ?? $lessonContent->fetch('fields.video.fields.length_in_seconds', 0) }}"
        user-access-level="{{ user()->access_level }}">
    </playlist-playback-wrapper>
@endsection

@section('layout-scripts')
    @parent
    <script src="{{ mix('platform/js/vendor~player.js') }}"></script>
@endsection
