@extends('partials.layout')

@php
 //dd(json_encode(array_merge($lessonContent['resources'] ?? [], $parent['resources'] ?? [])));
@endphp

@section('meta')
    <title>{{ $lessonContent->fetch('fields.title') }} | Musora</title>
@endsection

@section('inject-components')
    <script src="{{ mix('platform/js/lesson-page.js') }}"></script>
@endsection

@section('content')
    @include('content.breadcrumbs._lesson-breadcrumbs')
    {{-- Session Token for Railtracker progress tracking --}}
    {{--    <input type="hidden" id="sessionToken" value="{{ railtracker_session_token() }}">--}}

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
        back-url="{{ url()->previous() }}"
        theme-color="{{ $themeColor }}"
        brand="{{ $brand }}"
        back-url="{{ url()->route('platform.content-type-catalog', ["contentTypeName" => 'songs']) }}"
        thumbnail-url="{{ $lessonContent->fetch( 'data.original_thumbnail_url', $lessonContent->fetch('data.thumbnail_url') ) }}"
        song-title="{{ $lessonContent->fetch('fields.title') }}"
        song-artist="{{ $lessonContent->fetch('fields.artist') }}"
        song-album="{{ $lessonContent->fetch('fields.album') }}"
        song-meta="{{ implode(', ', $lessonContent->fetch('*fields.style.value', [])) }}"
        parent-title="{{ isset($parent) ? $parent->fetch('fields.title') : null }}"
        lesson-progress="{{ $lessonContent->fetch('progress_percent', 0) }}"
        :instructors="{{ json_encode($lessonContent['instructors'] ?? []) }}"
        :is-liked="{{ json_encode($lessonContent['is_liked_by_current_user'] ?? false) }}"
        :is-added="{{ json_encode($lessonContent->fetch('is_added_to_primary_playlist') ?? false) }}"
        :like-count="{{ $lessonContent['like_count'] ?? 0 }}"
        :content-id="{{ $lessonContent->fetch('id') }}"
        :user-id="{{ auth()->id() }}"
        user-name="{{ user()->display_name }}"
        user-avatar="{{ user()->profile_picture_url }}"
        user-x-p="{{ user()->total_xp }}"
        user-access-level="{{ user()->access_level }}"
        :is-admin="{{ json_encode(user()->isAdmin()) }}"
        :resources="{{ json_encode(array_merge($lessonContent['resources'] ?? [], $parent['resources'] ?? [])) }}"
        :related-lessons="{{ $relatedLessons }}"
        :assignments="{{ json_encode($formattedAssignments) }}"
        :has-instrumentless="{{ json_encode(boolval($lessonContent->fetch('instrumentless'))) }}"
        @if(!empty($lockUnowned))
            :lock-unowned="true"
        @endif
    >
        <template v-slot:completionBonus>
            @include('partials.bladesora.members.partials._completion-bonus', [
                "xpBonus" => $lessonContent->fetch('xp_bonus', 0),
                "isComplete" => $lessonContent->fetch('progress_percent', 0) === 100,
                "themeColor" => 'drumeo'
            ])
        </template>
    </song>

    @include('partials.bladesora.members.content._lesson-complete', [
        "themeColor" => $themeColor,
        "thisLessonJson" => $thisLessonJson,
        "nextLessonJson" => !empty($nextChild) ? $nextLessonJson : null,
    ])
@endsection
