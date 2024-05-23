@extends('partials.layout')

@section('meta')
    <title>{{ $lessonContent->fetch('fields.title') }} | Musora</title>
@endsection

@section('content')

    {{-- Session Token for Railtracker progress tracking --}}
    {{--    <input type="hidden" id="sessionToken" value="{{ railtracker_session_token() }}">--}}
    {{-- 
        "xpBonus" => $lessonContent->fetch('xp_bonus', 0),
        "isComplete" => $lessonContent->fetch('progress_percent', 0) === 100, 
    --}}

    @php
        $formattedAssignments = [];
        foreach ($lessonContent->fetch('*assignments', []) as $index => $assignment) {
            $content = [];
            $content['dusk'] = 'content-assignment';
            $content['themeColor'] = brand();
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

    <song
        thumbnail-url="{{ $lessonContent->fetch( 'data.original_thumbnail_url', $lessonContent->fetch('data.thumbnail_url') ) }}"
        song-title="{{ $lessonContent->fetch('fields.title') }}"
        song-artist="{{ $lessonContent->fetch('fields.artist') }}"
        song-album="{{ $lessonContent->fetch('fields.album') }}"
        song-meta="{{ implode(', ', $lessonContent->fetch('*fields.style.value', [])) }}"
        :has-instrumentless="{{ json_encode(boolval($lessonContent->fetch('instrumentless'))) }}"
        lesson-progress="{{ $lessonContent->fetch('progress_percent', 0) }}"
        :is-liked="{{ json_encode($lessonContent['is_liked_by_current_user'] ?? false) }}"
        :is-added="{{ json_encode($lessonContent->fetch('is_added_to_primary_playlist') ?? false) }}"
        :like-count="{{ $lessonContent['like_count'] ?? 0 }}"
        :content-id="{{ $lessonContent->fetch('id') }}"
        :resources="{{ json_encode(array_merge($lessonContent['resources'] ?? [], $parent['resources'] ?? [])) }}"
        :assignments="{{ json_encode($formattedAssignments) }}"
        :related-lessons="{{ $relatedLessons }}"
    ></song>

@endsection
