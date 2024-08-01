@extends('partials.layout')

@section('meta')
    <title>{{ $lessonContent->fetch('fields.title') }} | Musora</title>
@endsection

@section('content')

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

    <page-loader
        page="songs"
        :content-id="{{ json_encode($lessonContent->fetch('id')) }}"
    >
        <template #loading>
            <song-skeleton></song-skeleton>
        </template>
        <template #page="{ pageData }">
            <song
                :thumbnail-url="pageData?.thumbnail_url"
                :song-title="pageData?.title"
                :song-artist="pageData?.artist"
                :song-album="pageData?.album"
                :song-meta="pageData?.style"
                :has-instrumentless="pageData?.instrumentless"
                :lesson-progress="pageData?.lesson_progress"
                :is-liked="{{ json_encode($lessonContent['is_liked_by_current_user'] ?? false) }}"
                :is-added="{{ json_encode($lessonContent->fetch('is_added_to_primary_playlist') ?? false) }}"
                :like-count="{{ $lessonContent['like_count'] ?? 0 }}"
                :content-id="{{ json_encode($lessonContent->fetch('id')) }}"
                :resources="pageData?.resources"
                :assignments="pageData?.soundslice"
                :related-lessons="pageData?.relatedLessons"
                :report-logo="{{ json_encode(config('mailora.' . $brand . '.logo-link')) }}"
                :no-access="{{ json_encode($lessonContent->fetch('need_access')) }}"
            ></song>
        </template>
    </page-loader>

@endsection
