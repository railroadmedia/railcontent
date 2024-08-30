@extends('partials.layout')

@section('meta')
    <title>{{ ucfirst($brand) }} Home | Musora</title>
@endsection

@section('content')
    <home
        :is-pack-only="false"
        account-url="{{ user()->getDashboardUrl() }}"
        calendar-id="{{ $calendarId }}"
        :carousel="{{ json_encode($carousel) }}"
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
        new-content-url="{{ url()->route('platform.new-lessons') }}"
        next-learning-path-level="{{ user()->getMethodLevel() }}"
        :next-learning-path-progress-percent="{{ $nextLearningPathProgressPercent }}"
        :recommended-content="{{ $recommendedContentJson }}"
        recommended-content-url="{{ url()->route('platform.recommended-lessons') }}"
        :started-content="{{ $startedContentJson }}"
        :time-cutoff-minutes="{{ $timeCutoffMinutes }}"
        :users-list="{{ json_encode($usersList->results())  }}"
        :user-metrics="{{ json_encode($userMetrics) }}"A
        workouts-content-url="{{ url()->route('platform.workouts') }}"
        youtube-id="{{ $youtubeId }}"
        :learning-paths="{{ json_encode($trialSection) }}"
        :display-trial-section="{{ $displayTrialSection ? 'true' : 'false' }}"
    ></home>

    @include('partials._railanalytics-brand-tracking-iframe')

@endsection
