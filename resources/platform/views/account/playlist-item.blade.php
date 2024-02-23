@php
    $brandParams = [
        'drumeo' => '&show_chords=0',
        'singeo' => '&show_staff_t1=0&show_staff_t2=0&show_chords=0',
        'guitareo' => '',
        'pianote' => '&show_chords=1',
    ];
    $recordingIdx = 1;
    if (($lessonType == 'song' || $lessonType == 'assignment') && isset($playlistItem['is_instrumentless_track']) && boolval($playlistItem['is_instrumentless_track'])) {
        $recordingIdx = 2;
    }
    $soundsliceAdditionalParams = $brandParams[$brand] . '&layout=3&recording_idx=' . $recordingIdx;

    $contentBreadCrumb = new stdClass();
    if(!empty($lessonContent->fetch('*fields.instructor')) ||
        !empty($lessonContent->fetch('data.description')) ||
        !empty($lessonContent['chapters'])){

            if(!empty($lessonContent['parent'])){
                if(str_contains($lessonContent['parent']->fetch('type'),'learning-path')) {
                    if($brand === 'drumeo'){
                        $contentBreadCrumb->firstLevelUrl = '/drumeo/method/drumeo-method/241247';
                    }
                    else if($brand === 'pianote'){
                        $contentBreadCrumb->firstLevelUrl = '/pianote/method/pianote-method/276693';
                    }
                    else if($brand === 'guitareo'){
                        $contentBreadCrumb->firstLevelUrl = '/guitareo/method/guitareo-method/333652';
                    }
                    else if($brand === 'singeo'){
                        $contentBreadCrumb->firstLevelUrl = '/singeo/method/singeo-method/308514';
                    }
                    $contentBreadCrumb->firstLevelTitle = $brand.' Method';
                }
                else if(str_contains($lessonContent['parent']->fetch('type'),'pack-bundle')){
                    $contentBreadCrumb->firstLevelUrl = url()->route('platform.packs');
                    $contentBreadCrumb->firstLevelTitle = 'Packs';
                }
                else if(str_contains($lessonContent['parent']->fetch('type'),'course-part')){
                    $contentBreadCrumb->firstLevelUrl = url()->route("platform.content-type-catalog", 'courses');
                    $contentBreadCrumb->firstLevelTitle = 'Course';
                }
                else if(str_contains($lessonContent['parent']->fetch('type'),'challenge')){
                    $contentBreadCrumb->firstLevelUrl = url()->route("platform.workouts.challenges");
                    $contentBreadCrumb->firstLevelTitle = 'Challenges';
                }
                else if(str_contains($lessonContent['parent']->fetch('type'),'unit')){
                    $contentBreadCrumb->firstLevelUrl = '/pianote/method/foundations-2019/215952';
                    $contentBreadCrumb->firstLevelTitle = 'Pianote Foundations';
                }else {
                    $contentBreadCrumb->firstLevelUrl = url()->route("platform.content-type-catalog", ["contentTypeName" => array_flip(\App\Maps\PrimaryURLSlugToContentTypeMap::$map)[$lessonContent['parent']->fetch('type')]]);
                    $contentBreadCrumb->firstLevelTitle = $lessonContent['parent']->fetch('type');
                }

                $contentBreadCrumb->secondLevelUrl = $lessonContent['parent']->fetch('url');
                $contentBreadCrumb->secondLevelTitle = $lessonContent['parent']->fetch('fields.title');
                $contentBreadCrumb->lastLevelTitle = $lessonContent['title'];
            }
            elseif($lessonContent->fetch('type') === 'coach-stream') {
                $instructor = $lessonContent->fetch('*fields.instructor')[0] ?? null;
                $contentBreadCrumb->firstLevelUrl = url()->route("platform.coaches");
                $contentBreadCrumb->firstLevelTitle = 'Coaches';
                if($instructor) {
                    $contentBreadCrumb->secondLevelUrl = url()->route("platform.content.coach.show",['firstContentSlug' => $instructor->fetch('slug'), 'firstContentId' => $instructor->fetch('id')]);
                    $contentBreadCrumb->secondLevelTitle = $instructor->fetch('fields.name');
                }
                $contentBreadCrumb->lastLevelTitle = $lessonContent->fetch('title');
            }else {
                $contentBreadCrumb->firstLevelUrl = url()->route("platform.content-type-catalog", ["contentTypeName" => array_flip(\App\Maps\PrimaryURLSlugToContentTypeMap::$map)[$lessonContent->fetch('type')]]);
                $contentBreadCrumb->firstLevelTitle = parse_lesson_type_readable($lessonContent->fetch('type'), true);
                $contentBreadCrumb->lastLevelTitle = $lessonContent['title'];
            }
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
    <playlist-playback
        :is-released="{{ json_encode($playlistItem['released']) }}"
        lesson-type="{{ $lessonType }}"
        brand="{{ $brand }}"
        user-id="{{ user()->id }}"
        additional-soundslice-params="{{ $soundsliceAdditionalParams }}"
        playlist-id="{{ $playlist['id'] }}"
        soundslice-slug="{{ $playlistItem['soundslice_slug'] ?? '' }}"
        content-id="{{ $lessonContent->fetch('id') }}"
        youtube-video-id="{{ $lessonContent->fetch('fields.video.fields.youtube_video_id') }}"
        vimeo-video-id="{{ $lessonContent->fetch('fields.video.fields.vimeo_video_id') }}"
        current-second="{{ $playlistItem['start_second'] ?? 0 }}"
        total-duration="{{ $lessonContent->fetch('fields.video.fields.length_in_seconds', 0) }}"
        video-length="{{ $lessonContent->fetch('fields.video.fields.length_in_seconds') }}"
        progress-state="{{ $lessonContent->fetch('progress_state') }}"
        video-poster-image-url="{{ $lessonContent['video_poster_image_url'] ?? '' }} }}"
        hls-manifest-url="{{ $lessonContent['hlsManifestUrl'] ?? '' }}"
        like-count="{{ $lessonContent['like_count'] ?? 0 }}"
        cast-title="{{ $lessonContent->fetch('fields.title') }}"
        thumbnail-url="{{ $lessonContent->fetch('data.thumbnail_url') }}"
        description="{{ $lessonContent->fetch('data.description') }}"
        parent-title="{{ isset($parent) ? $parent->fetch('fields.title') : null }}"
        playlist-name="{{ $playlist['name'] }}"
        next-lesson-url="{{ $nextPlaylistItemUrl }}"
        prev-lesson-url="{{ $previousPlaylistItemUrl }}"
        playlist-duration="{{ $playlist['duration'] }}"
        user-name="{{ user()->display_name }}"
        user-avatar="{{ user()->profile_picture_url }}"
        user-xp="{{ user()->totalXP() }}"
        user-access-level="{{ user()->access_level }}"
        playlist-url="{{ $playlist['url'] }}"
        :video-resources="{{ json_encode(array_merge($lessonContent['resources'] ?? [], $parent['resources'] ?? [])) }}"
        :instructors="{{ json_encode($lessonContent['coaches'] ?? []) }}"
        :is-liked="{{ json_encode($lessonContent['is_liked_by_current_user'] ?? false) }}"
        :video-chapters="{{ json_encode($lessonContent['chapters'] ?? []) }}"
        :video-media-sources="{{ json_encode($lessonContent['video_playback_endpoints'] ?? []) }}"
        :useLegacyVideoPlayer="{{ user()->use_legacy_video_player ?? false }}"
        :song-ranges="{{ json_encode($lessonContent['ranges'] ?? []) }}"
        :ranges-video-ids="{{ json_encode($rangesVideoIds ?? []) }}" {{-- Todo: Find a way to re add captions --}} {{-- :captions="{{ $lessonContent->fetch('fields.video.data.captions') }}" --}}
        :playlist-items="{{ $playlistItems }}"
        :related-lesson="{{ $relatedLesson }}"
        :playlist-item-position="{{ $positionInPlaylist }}"
        :playlist-item-id="{{ $playlistItem['id'] }}"
        :playlist-item-title="{{ json_encode($playlistItem['playlist_item_name'] ? $playlistItem['playlist_item_name'] : $playlistItem['title']) }}"
        :start-second="{{ $playlistItem['start_second'] ?? 0 }}"
        :is-my-playlist="{{ $playlist['is_my_playlist'] }}"
        :end-second="{{ $playlistItem['end_second'] ?? $lessonContent->fetch('fields.video.fields.length_in_seconds', 0) }}"
        subscription-calendar-id="{{ config('addevent.'.$brand)['uniquekeys']['brand-overview'] }}"
        :assignments="{{ json_encode($lessonContent->fetch('*assignments', [])) }}"
        :lesson-data="{{ json_encode($lessonContent) }}"
        :show-info-button="{{ json_encode(!empty($lessonContent->fetch('*fields.instructor')) || !empty($lessonContent->fetch('data.description')) || !empty($lessonContent['chapters'])) }}"
        :content-breadcrumb="{{ json_encode($contentBreadCrumb) }}"
        :content-chapters="{{ json_encode($lessonContent['chapters'] ?? []) }}"
        :content-description="{{ json_encode($lessonContent->fetch('data.description', null)) }}"
        :content-instructors="{{ json_encode($lessonContent->fetch('*fields.instructor')) }}"
        user-email="{{ user()->email }}"
        report-logo="{{ config('mailora.'. $brand . '.logo-link') }}"
        report-recipient="{{ config('mailora.'. $brand . '.ask-question-recipient') }}"
        difficulty="{{ $lessonContent->fetch('difficulty') }}"
    >
    </playlist-playback>
@endsection

@section('layout-scripts')
    @parent
    <script src="{{ mix('platform/js/vendor~player.js') }}"></script>
@endsection
