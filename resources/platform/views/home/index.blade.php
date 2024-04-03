@extends('partials.layout')

@section('meta')
    <title>{{ ucfirst($brand) }} Home | Musora</title>
@endsection

@section('content')
    <home
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
        :has-experience="{{ $hasExperience ? 'true' : 'false' }}"
        :has-gear="{{ $hasGear ? 'true' : 'false' }}"
        :has-genres="{{ $hasGenres ? 'true' : 'false' }}"
        :has-goals="{{ $hasGoals ? 'true' : 'false' }}"
        :has-started-content="{{ $hasStartedLessons ? 'true' : 'false' }}"
        :has-started-lessons="{{ $hasStartedLessons ? 'true' : 'false' }}"
        :has-topics="{{ $hasTopics ? 'true' : 'false' }}"
        :has-upcoming-events="{{ $hasUpcomingEvents ? 'true' : 'false' }}"
        :hot-forum-topics="{{ json_encode($hotForumTopics) }}"
        :is-a-member="{{ user()->isAMember() ? 'true' : 'false' }}"
        :new-content="{{ $newContentJson }}"
        new-content-url="{{ url()->route('platform.new-lessons') }}"
        next-learning-path-level="{{ user()->getMethodLevel() }}"
        :next-learning-path-progress-percent="{{ $nextLearningPathProgressPercent }}"
        @feature('recsys')
            :recommended-content="{{ $recommendedContentJson }}"
        @endfeature
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

@include('partials._railanalytics-brand-tracking-iframe')

@endsection
