@php
//dd($startedLessons);
@endphp

@extends('partials.layout')

@section('meta')
    <title>{{ ucfirst($brand) }} Workouts | Musora</title>
@endsection

@section('content')
    <workouts
        :carousel-data="{{ $carousel }}"
        :continue-data="{{ $startedLessons }}"
        :workout-data="{{ $listLessons }}"
        :collection-type="{{ json_encode($lessonType) }}"
        :filterable-values="{{ json_encode($catalogueMeta['allowableFilters'] ?? []) }}"
        :include-future-scheduled-content-only = "{{ json_encode(boolval($futureScheduledContentOnly ?? true)) }}"
        :statuses="{{ json_encode($statuses ?? ['published']) }}"
    ></workouts>
@endsection
