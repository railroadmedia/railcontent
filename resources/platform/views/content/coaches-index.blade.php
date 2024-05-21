@php
    $headerDescription = "";
    if ($brand === "drumeo") {
        $headerDescription = "Your drumming journey is unique. You need personalized coaching that helps you reach your goals. Learn from some of the best drummers in the world!";
    } elseif ($brand === "pianote") {
        $headerDescription = "Your piano journey is unique. You need personalized coaching that helps you reach your goals. Learn from some of the best pianists in the world!";
    } elseif ($brand === "guitareo") {
        $headerDescription = "Tackle your next guitar goal with bite-sized courses from many of the world's best guitarists.";
    } elseif ($brand === "singeo") {
        $headerDescription = "Your singing journey is unique. You need personalized coaching that helps you reach your goals. Learn from some of the best singers and vocal coaches in the world!";
    }

    $breadcrumbs = [
        [
            'title' => 'Coaches',
        ]
    ];
@endphp

@extends('partials.layout', ['trackingSectionName' => 'coaches'])

@section('meta')
    <title>{{ ucfirst($brand) }} Coaches | Musora</title>
@endsection

@section('content')
    <coach-index
        :breadcrumbs="{{ json_encode($breadcrumbs) }}"
        header-description="{{ $headerDescription }}"
        :coach-event="{{ $coachEvent }}"
        @if(!empty($coachEvent))
            coach-event-current-date="{{ $currentDate }}"
            coach-event-subscription-calendar-id="{{ $currentEventCalendarId }}"
            coach-event-youtube-event-id="{{ $youtubeId }}"
            :coach-event-time-cutoff-minutes="{{ $timeCutoffMinutes }}"
            event-coach-profile-url="{{ $eventCoachProfileUrl }}"
        @endif
        :has-featured-coaches="{{ json_encode($hasFeaturedCoaches) }}"
        :featured-coaches="{{ json_encode($featuredCoaches) }}"
        :latest-lessons="{{ json_encode(json_decode($latestLessons)->data) }}"
        :has-followed-coaches="{{ json_encode($hasFollowedCoaches) }}"
        :followed-lessons="{{ json_encode(json_decode($latestSubscribedLessons)->data) }}"
        :has-upcoming-coaches="{{ json_encode($hasUpcomingCoaches) }}"
        :upcoming-coaches="{{ json_encode($upcomingCoaches) }}"
        :has-active-coaches="{{ json_encode($hasActiveCoaches) }}"
        :active-coaches="{{ json_encode($activeCoaches) }}"

        collection-type="coach"
        :collection-filterable-values="{{ json_encode($catalogueMeta['allowableFilters']) }}"
        :collection-included-types="{{ json_encode(['instructor']) }}"
        :collection-limit="{{ $limitOverride ?? 18 }}"
        :collection-data="{{ $coaches->toResponseRawJson() }}"
        :collection-required-fields="{{json_encode(['is_coach,1'])}}"
        :collection-statuses="{{ json_encode(['published', 'scheduled']) }}"
        :collection-tab-options="{{ json_encode([
                [ 'key' => 'allCoaches', 'value' => 'All Coaches' ],
                [ 'key' => 'subscribedCoaches', 'value' => 'Subscribed Coaches' ]
            ]) }}"
        collection-default-sort="slug"
        :collection-show-progress-filters="{{ json_encode(false) }}"
    ></coach-index>
@endsection

