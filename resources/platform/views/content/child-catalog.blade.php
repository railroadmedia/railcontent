@extends('partials.layout')

@section('meta')
    <title>{{ ucfirst($brand) }} {{ ucfirst($catalogueMeta['name']) }} | Musora</title>
@endsection


@section('content')
    {{-- Child Catalog Page Vue Component --}}
    <child-catalog
        brand="{{ $brand }}"
        first-level-url="/{{ $brand }}/workouts"
        first-level-title="Workouts"
        last-level-title="All {{ ucfirst($catalogueMeta['name']) }}"
        :collection-type="{{ json_encode($lessonType) }}"
        :filterable-values="{{ json_encode($catalogueMeta['allowableFilters']) }}"
        :include-future-scheduled-content-only = "{{ json_encode(boolval($futureScheduledContentOnly ?? true)) }}"
        :pre-loaded-content="{{ $listLessons }}"
        :statuses="{{ json_encode($statuses ?? ['published']) }}"
        :title="{{ json_encode($catalogueMeta['shortname'] ?? $catalogueMeta['name']) }}"
        subscription-calendar-id="{{ config('addevent.'.brand().'.uniquekeys.brand-overview') }}"
    ></child-catalog>
@endsection
