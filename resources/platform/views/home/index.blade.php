@extends('partials.layout')

@section('meta')
    <title>{{ ucfirst($brand) }} Home | Musora</title>
@endsection

@section('content')
    <home
        :has-gear="{{ $hasGear ? 'true' : 'false' }}"
        :has-topics="{{ $hasTopics ? 'true' : 'false' }}"
        :has-genres="{{ $hasGenres ? 'true' : 'false' }}"
        :has-experience="{{ $hasExperience ? 'true' : 'false' }}"
        :has-goals="{{ $hasGoals ? 'true' : 'false' }}"
        :carousel="{{ json_encode($carousel) }}"
        :exists-cohort-banner="{{ $existsCohortBanner ? 'true' : 'false' }}"
        :cohort-banner="{{ $cohortBanner }}"
        :has-started-lessons="{{ $hasStartedLessons ? 'true' : 'false' }}"
        :started-content="{{ $startedContentJson }}"
        :new-content="{{ $newContentJson }}"
        :hot-forum-topics="{{ json_encode($hotForumTopics) }}"
        :users-list="{{ json_encode($usersList->results())  }}"
        :coach-event="{{ $coachEvent }}"
        current-date="{{ $currentDate }}"
        calendar-id="{{ $calendarId }}"
        youtube-id="{{ $youtubeId }}"
        :time-cutoff-minutes="{{ $timeCutoffMinutes }}"
        event-coach-profile-url="{{ $eventCoachProfileUrl }}"
        :has-upcoming-events="{{ $hasUpcomingEvents ? 'true' : 'false' }}"
        :upcoming-events="{{ $upcomingEvents }}"
        :next-learning-path-progress-percent="{{ $nextLearningPathProgressPercent }}"
        :user-metrics="{{ json_encode($userMetrics) }}"
        :has-started-content="{{ $hasStartedLessons ? 'true' : 'false' }}"
        content-endpoint="/railcontent/content"
        continue-url="{{ url()->route('platform.lesson-history.in-progress') }}"
        new-content-url="{{ url()->route('platform.new-lessons') }}"
        :new-content="{{ $newContentJson }}"
        account-url="{{ user()->getDashboardUrl() }}"
        next-learning-path-level="{{ user()->getMethodLevel() }}"
        :is-a-member="{{ user()->isAMember() ? 'true' : 'false' }}"
    ></home>

@include('partials._railanalytics-brand-tracking-iframe')

@endsection

@section('layout-scripts')
    @parent
    @if(str_contains(Request::url(), 'create-playlist-window'))
        <script>
            document.addEventListener('DOMContentLoaded', function () {
                window.openplaylistmodal({ modalType: 'create', brand: '{{ $brand }}', data: { name: '', category: 'General', thumbnail_url: null, description: ''} });
            })
        </script>
    @endif
@endsection
