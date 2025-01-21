@extends('partials.layout')

@section('meta')
    <title>{{ ucfirst($brand) }} Home | Musora</title>
@endsection

@php
    //dd($recommendedContent);
@endphp

@section('content')
    {{-- MERGING NOTES: When merging this with sanity branch, manually merge HomeV2.vue changes into Home.vue component --}}
    <home
        :is-pack-only="false"
        account-url="{{ user()->getDashboardUrl() }}"
        calendar-id="{{ $calendarId }}"
        {{-- :carousel="{{ json_encode($carousel) }}" --}}
        :cohort-banner="{{ $cohortBanner }}"
        content-endpoint="/railcontent/content"
        continue-url="{{ url()->route('platform.lesson-history.in-progress') }}"
        current-date="{{ $currentDate }}"
        :exists-cohort-banner="{{ $existsCohortBanner ? 'true' : 'false' }}"
        :has-started-content="{{ $hasStartedLessons ? 'true' : 'false' }}"
        :has-started-lessons="{{ $hasStartedLessons ? 'true' : 'false' }}"
        @if(count($hotForumTopics) > 0)
            :conversation-data="{{ json_encode($hotForumTopics) }}"
        @endif
        :is-a-member="{{ user()->isAMember() ? 'true' : 'false' }}"
        next-learning-path-level="{{ user()->getMethodLevel() }}"
        :next-learning-path-progress-percent="{{ $nextLearningPathProgressPercent }}"
        :recommended-content="{{ $recommendedContent }}"
        recommended-content-url="{{ url()->route('platform.recommended-lessons') }}"
        :time-cutoff-minutes="{{ $timeCutoffMinutes }}"
        :user-metrics="{{ json_encode($userMetrics) }}"
        youtube-id="{{ $youtubeId ?? '' }}"
        :is-first-access="{{ $isFirstAccess ? 'true' : 'false' }}"
        :explore-tasks="{{ json_encode($exploreTasks) }}"
        :is-v2-user="{{ json_encode($homepageV2) }}"
        :for-you-experiment="{{ json_encode($forYouExperiment) }}"
    ></home>

@include('partials._railanalytics-brand-tracking-iframe')

@endsection
