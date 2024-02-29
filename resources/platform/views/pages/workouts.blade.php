@php
//dd($startedLessons);
@endphp

@extends('partials.layout')

@section('meta')
    <title>{{ ucfirst($brand) }} Workouts | Musora</title>
@endsection

@section('content')
    <workouts
        :is-admin="{{ json_encode(user()->isAdmin()) }}"
        :carousel-data="{{ json_encode($carousel) }}"
        @if($startedLessons)
            :continue-data="{{ $startedLessons }}"
        @endif
        :workout-data="{{ $listLessons }}"
        :collection-type="{{ json_encode($lessonType) }}"
        :filterable-values="{{ json_encode($catalogueMeta['allowableFilters'] ?? []) }}"
        :include-future-scheduled-content-only = "{{ json_encode(boolval($futureScheduledContentOnly ?? true)) }}"
        :statuses="{{ json_encode($statuses ?? ['published']) }}"
        :tabs="{{ json_encode($catalogueMeta['tabs'] ?? []) }}"
    ></workouts>
@endsection
