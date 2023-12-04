@php
    $hasRelatedLessons = false;
    if(count(json_decode($relatedLessons)->data) > 1 && $lessonContent['id'] !== json_decode($relatedLessons)->data[0]->id){
        $hasRelatedLessons = true;
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
    <workouts-playback
        breadcrumb-first-level-url="/{{ $brand }}/workouts"
        breadcrumb-first-level-title="Workouts"
        :breadcrumb-last-level-title="{{ json_encode($lessonContent->fetch('fields.title')) }}"
    />
@endsection
