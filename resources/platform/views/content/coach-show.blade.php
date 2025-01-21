@php
    $firstLastName = preg_split('/\s+/', $thisCoach->fetch('fields.name'));
    $currentUserSubscribed = $thisCoach->fetch('current_user_is_subscribed');

    $ctas = [
        [
            'type' => 'PageHeaderCta',
            'props' => [
                'text' => $currentUserSubscribed ? 'Unsubscribe' : 'Subscribe',
                'contentFunction' => $currentUserSubscribed ? 'unfollowCoach' : 'followCoach',
                'payload' => [
                    'coachId' => $thisCoach->fetch('id'),
                    'firstName' => $firstLastName[0],
                ],
                'faIconClass' => 'fa-bell',
                'showAllAlways' => true,
                'isPrimary' => true,
            ]
        ]
    ];

    $ctasJson = json_encode($ctas);
@endphp


@extends('partials.layout', ['trackingSectionName' => 'Coaches'])

@section('meta')
    <title>{{ ucfirst($thisCoach->fetch('fields.name')) }} | Musora</title>
@endsection

@section('content')
    <coach-show
        :coach-event="{{ $coachEvent }}"
        @if(!empty($coachEvent))
            coach-event-current-date-string="{{ $currentDate }}"
            coach-event-subscription-calendar-id="{{ $currentEventCalendarId }}"
            coach-event-youtube-event-id="{{ $youtubeId }}"
            :coach-event-time-cutoff-minutes="{{ $timeCutoffMinutes }}"
            event-coach-profile-url="{{ $eventCoachProfileUrl }}"
        @endif
    ></coach-show>

@endsection
