@extends('partials.layout')

@section('meta')
    <title>{{ ucfirst($brand) }} Home | Musora</title>
@endsection

@php
    $isPackOnly = true;
@endphp

@section('content')
    <home
        :is-pack-only="{{ $isPackOnly }}"
        account-url="{{ user()->getDashboardUrl() }}"
        content-endpoint="/railcontent/content"
        :is-a-member="{{ user()->isAMember() ? 'true' : 'false' }}"
        :user-metrics="{{ json_encode($userMetrics) }}"
        upgrade-membership-url="{{ get_legacy_brand_base_url() . '/#customize-anchor'  }}"
        @if($isPackOnly)

            @if(!empty($packs)) :pack-data="{{ json_encode($packs) }}" @endif
            @if(count($hotForumTopics) > 0) :conversation-data="{{ json_encode($hotForumTopics) }}" @endif
            :course-data="{{ json_encode($courses) }}"
            @if($startedContentCount > 0)
                continue-url="{{ url()->route('platform.lesson-history.in-progress') }}"
                :started-content="{{ $startedContentJson }}"
            @endif
        @else 
            calendar-id="{{ $calendarId }}"
            :carousel="{{ json_encode($carousel) }}"
            :coach-event="{{ $coachEvent }}"
            :cohort-banner="{{ $cohortBanner }}"
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
            :new-content="{{ $newContentJson }}"
            new-content-url="{{ url()->route('platform.new-lessons') }}"
            :next-learning-path-progress-percent="{{ $nextLearningPathProgressPercent }}"
            next-learning-path-level="{{ user()->getMethodLevel() }}"
            :recommended-content="{{ $recommendedContentJson }}"
            recommended-content-url="{{ url()->route('platform.recommended-lessons') }}"
            :time-cutoff-minutes="{{ $timeCutoffMinutes }}"
            :upcoming-events="{{ $upcomingEvents }}"
            upcoming-url="{{ '/'.$brand.'/live' }}"
            :users-list="{{ json_encode($usersList->results())  }}"
            :workouts-content="{{ $workoutsContentJson }}"
            workouts-content-url="{{ url()->route('platform.workouts') }}"
            youtube-id="{{ $youtubeId }}"
            :learning-paths="{{ json_encode($trialSection) }}"
            :display-trial-section="{{ $displayTrialSection ? 'true' : 'false' }}"
        @endif
    ></home>

    @include('partials._railanalytics-brand-tracking-iframe')
@endsection

