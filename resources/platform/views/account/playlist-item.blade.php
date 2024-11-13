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
    if(!empty($lessonContent['instructor']) ||
        !empty($lessonContent['description']) ||
        !empty($lessonContent['chapters']) ||
        $lessonContent['type'] === 'assignment'
    ){
        if(!empty($lessonContent['parent'])){
            if(str_contains($lessonContent['parent']['type'],'learning-path')) {
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
            else if(str_contains($lessonContent['parent']['type'],'pack-bundle')){
                $contentBreadCrumb->firstLevelUrl = url()->route('platform.packs');
                $contentBreadCrumb->firstLevelTitle = 'Packs';
            }
            else if(str_contains($lessonContent['parent']['type'],'course-part')){
                $contentBreadCrumb->firstLevelUrl = url()->route("platform.content-type-catalog", 'courses');
                $contentBreadCrumb->firstLevelTitle = 'Course';
            }
            else if(str_contains($lessonContent['parent']['type'],'challenge')){
                $contentBreadCrumb->firstLevelUrl = url()->route("platform.workouts.challenges");
                $contentBreadCrumb->firstLevelTitle = 'Challenges';
            }
            else if(str_contains($lessonContent['parent']['type'],'unit')){
                $contentBreadCrumb->firstLevelUrl = '/pianote/method/foundations-2019/215952';
                $contentBreadCrumb->firstLevelTitle = 'Pianote Foundations';
            }else {
                $contentBreadCrumb->firstLevelUrl = url()->route("platform.content-type-catalog", ["contentTypeName" => array_flip(\App\Maps\PrimaryURLSlugToContentTypeMap::$map)[$lessonContent['parent']['type']]]);
                $contentBreadCrumb->firstLevelTitle = $lessonContent['parent']['type'];
            }

            $contentBreadCrumb->secondLevelUrl = $lessonContent['parent']['url'];
            $contentBreadCrumb->secondLevelTitle = $lessonContent['parent']['title'];
            $contentBreadCrumb->lastLevelTitle = $lessonContent['title'];
        }
        else if($lessonContent['type'] === 'coach-stream') {
            $instructor = $lessonContent->fetch('*fields.instructor')[0] ?? null;
            $contentBreadCrumb->firstLevelUrl = url()->route("platform.coaches");
            $contentBreadCrumb->firstLevelTitle = 'Coaches';
            if($instructor) {
                $contentBreadCrumb->secondLevelUrl = url()->route("platform.content.coach.show",['firstContentSlug' => $instructor->fetch('slug'), 'firstContentId' => $instructor->fetch('id')]);
                $contentBreadCrumb->secondLevelTitle = $instructor->fetch('fields.name');
            }
            $contentBreadCrumb->lastLevelTitle = $lessonContent->fetch('title');
        } else {
            $contentBreadCrumb->firstLevelUrl = url()->route("platform.content-type-catalog", ["contentTypeName" => array_flip(\App\Maps\PrimaryURLSlugToContentTypeMap::$map)[$lessonContent['type']]?? $lessonContent['type']]);
            $contentBreadCrumb->firstLevelTitle = parse_lesson_type_readable($lessonContent['type'], true);
            $contentBreadCrumb->lastLevelTitle = $lessonContent['title'];
        }
    }

@endphp

@extends('partials.layout', ['forceHideSidebar' => false])

@section('meta')
    <title>{{ $lessonContent['title'] }} | Musora</title>
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
        content-id="{{ $lessonContent['id'] }}"
        youtube-video-id="{{ ($lessonContent['video']['type'] ?? '') == 'youtube-video' ? $lessonContent['video']['external_id'] : '' }}"
        vimeo-video-id="{{ ($lessonContent['video']['type'] ?? '') == 'vimeo-video' ? $lessonContent['video']['external_id'] : '' }}"
        current-second="{{ $playlistItem['start_second'] ?? 0 }}"
        total-duration="{{ $lessonContent['length_in_seconds']?? 0 }}"
        video-length="{{ $lessonContent['length_in_seconds']?? 0 }}"
        progress-state="{{ $lessonContent['progress_state'] ?? 0 }}"
        video-poster-image-url="{{ $lessonContent['video_poster_image_url'] ?? '' }} }}"
        hls-manifest-url="{{ $lessonContent['hlsManifestUrl'] ?? '' }}"
        like-count="{{ $lessonContent['like_count'] ?? 0 }}"
        cast-title="{{ $lessonContent['title'] }}"
        thumbnail-url="{{ $lessonContent['thumbnail_url']??'' }}"
        description="{{ $lessonContent['description'] ?? '' }}"
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
        :video-media-sources="{{ json_encode($lessonContent['video']['video_playback_endpoints'] ?? []) }}"
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
        :end-second="{{ $playlistItem['end_second'] ?? $lessonContent['length_in_seconds'] ?? 0 }}"
        subscription-calendar-id="{{ config('addevent.'.$brand)['uniquekeys']['brand-overview'] }}"
        :assignments="{{ json_encode($lessonContent['assignments']??[]) }}"
        :lesson-data="{{ json_encode($lessonContent) }}"
        :show-info-button="{{ json_encode(!empty($lessonContent['artist']) || !empty($lessonContent['description'])) || !empty($lessonContent['chapters']) || $lessonContent['type'] === 'assignment' }}"
        :content-breadcrumb="{{ json_encode($contentBreadCrumb) }}"
        :content-chapters="{{ json_encode($lessonContent['chapters'] ?? []) }}"
        :content-description="{{ json_encode($lessonContent['description'] ?? null) }}"
        :content-instructors="{{ json_encode($lessonContent['instructors'] ??[]) }}"

        user-email="{{ user()->email }}"
        report-logo="{{ config('mailora.'. $brand . '.logo-link') }}"
        report-recipient="{{ config('mailora.'. $brand . '.ask-question-recipient') }}"
        difficulty="{{ $lessonContent['difficulty'] ?? 0 }}"
        artist="{{ $lessonContent['artist_name'] ?? ''}}"
    >
    </playlist-playback>
@endsection

@section('layout-scripts')
    @parent
    <script src="{{ mix('platform/js/vendor~player.js') }}"></script>
@endsection
