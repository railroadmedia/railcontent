@extends('partials.layout')

@section('meta')
    <title>{{ ucfirst($brand) }} {{ ucfirst($catalogueMeta['name']) }} | Musora</title>
@endsection


@section('content')
    <!-- BREADCRUMBS -->
    <breadcrumb
        brand="{{ $brand }}"
        first-level-url="/{{ $brand }}/workouts" 
        first-level-title="Workouts"
        last-level-title="All {{ ucfirst($catalogueMeta['name']) }}"
    >
    </breadcrumb>

    @if(session()->has('success-message'))
        <div class="form-success-message container mt-3">
            <div class="flex flex-column bg-success shadow corners-10 pa">
                <p class="body text-white">{{ session()->get('success-message') }}</p>
            </div>
        </div>
    @endif


    <div class="tw-container tw-mx-auto tw-px-4 md:tw-px-8 tw-mt-[10px] lg:tw-mt-8 dark:tw-text-white">
        <collection-wrapper
            :brand="{{ json_encode($brand) }}"
            :collection-type="{{ json_encode($lessonType) }}"
            :filterable-values="{{ json_encode($catalogueMeta['allowableFilters']) }}"
            :include-future-scheduled-content-only = "{{ json_encode(boolval($futureScheduledContentOnly ?? true)) }}"
            :included-types="{{ json_encode(['course']) }}"
            :pre-loaded-content="{{ $listLessons }}"
            :statuses="{{ json_encode($statuses ?? ['published']) }}"
            :title="{{ json_encode($catalogueMeta['shortname'] ?? $catalogueMeta['name']) }}"
        ></collection-wrapper>
    </div>

@endsection
