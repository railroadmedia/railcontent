@extends('partials.layout')

@section('meta')
    <title>{{ ucfirst($brand) }} Home | Musora</title>
@endsection

@section('content')

    <home-page-loader>
        <template #loading>
            <song-skeleton></song-skeleton>
        </template>
        <template #page="{ pageData }">
            <home
                :is-pack-only="false"
                account-url="{{ user()->getDashboardUrl() }}"
                calendar-id="{{ $calendarId }}"
                :carousel="{{ json_encode($carousel) }}"
                :coach-event="{{ $coachEvent }}"
                :cohort-banner="{{ $cohortBanner }}"
                content-endpoint="/railcontent/content"
                continue-url="{{ url()->route('platform.lesson-history.in-progress') }}"
                current-date="{{ $currentDate }}"
                event-coach-profile-url="{{ $eventCoachProfileUrl }}"
                :exists-cohort-banner="{{ $existsCohortBanner ? 'true' : 'false' }}"
                :has-started-content="{{ $hasStartedLessons ? 'true' : 'false' }}"
                :has-started-lessons="{{ $hasStartedLessons ? 'true' : 'false' }}"
                :has-upcoming-events="{{ $hasUpcomingEvents ? 'true' : 'false' }}"
                @if(count($hotForumTopics) > 0) 
                    :conversation-data="{{ json_encode($hotForumTopics) }}"
                @endif
                :is-a-member="{{ user()->isAMember() ? 'true' : 'false' }}"
                :new-content="{{ $newContentJson }}"
                new-content-url="{{ url()->route('platform.new-lessons') }}"
                next-learning-path-level="{{ user()->getMethodLevel() }}"
                :next-learning-path-progress-percent="{{ $nextLearningPathProgressPercent }}"
                :recommended-content="{{ $recommendedContentJson }}"
                recommended-content-url="{{ url()->route('platform.recommended-lessons') }}"
                :started-content="{{ $startedContentJson }}"
                :time-cutoff-minutes="{{ $timeCutoffMinutes }}"
                :upcoming-events="{{ $upcomingEvents }}"
                upcoming-url="{{ '/'.$brand.'/live' }}"
                :users-list="{{ json_encode($usersList->results())  }}"
                :user-metrics="{{ json_encode($userMetrics) }}"A
                :workouts-content="{{ $workoutsContentJson }}"
                workouts-content-url="{{ url()->route('platform.workouts') }}"
                youtube-id="{{ $youtubeId }}"
                :learning-paths="{{ json_encode($trialSection) }}"
                :display-trial-section="{{ $displayTrialSection ? 'true' : 'false' }}"
            ></home>
        </template>
    </home-page-loader>

    @include('partials._railanalytics-brand-tracking-iframe')

@endsection
