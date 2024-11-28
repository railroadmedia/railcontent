@extends('partials.layout', ['trackingSectionName' => 'coaches'])

@section('meta')
    <title>{{ ucfirst($brand) }} Coaches | Musora</title>
@endsection

@section('content')
    <coach-index
        :coach-event="{{ $coachEvent }}"
        @if(!empty($coachEvent))
            coach-event-current-date="{{ $currentDate }}"
            coach-event-subscription-calendar-id="{{ $currentEventCalendarId }}"
            coach-event-youtube-event-id="{{ $youtubeId }}"
            :coach-event-time-cutoff-minutes="{{ $timeCutoffMinutes }}"
            event-coach-profile-url="{{ $eventCoachProfileUrl }}"
        @endif
        :featured-coaches="{{ json_encode($featuredCoaches) }}"
        :has-upcoming-coaches="{{ json_encode($hasUpcomingCoaches) }}"
        :upcoming-coaches="{{ json_encode($upcomingCoaches) }}"
    ></coach-index>
@endsection

