@extends('partials.layout')

@section('meta')
    <title>{{ ucfirst($brand) }} {{ ucfirst($catalogueMeta['name']) }} | Musora</title>
@endsection

@php
    $askQuestionRecipient = config('mailora.' . $brand . '.ask-question-recipient');
    $emailLogoLink = config('mailora.' . $brand . '.logo-link');
    if (isset($startedLessons)) {   
        $decodedStartedLessons = json_decode($startedLessons);
        $formattedStartedLessons = json_encode(isset($decodedStartedLessons) && isset($decodedStartedLessons->data) ? $decodedStartedLessons->data : []);
    }
@endphp

@section('content')
    <div id="app">
        <catalogue
            :has-started-lessons="{{ json_encode($hasStartedLessons) }}"
            :lesson-type="{{ json_encode($lessonType) }}"
            :brand="{{ json_encode($brand) }}"
            :catalogue-meta="{{ json_encode($catalogueMeta) }}"
            :started-lessons="{{ $hasStartedLessons ? $formattedStartedLessons : '[]' }}"
            :breadcrumbs="{{ json_encode($breadcrumbs) }}"
            :list-lessons="{{ $listLessons }}"
            :session-token="{{ json_encode(railtracker_session_token()) }}"
            ask-question-recipient="{{ $askQuestionRecipient }}"
            email-logo-link="{{ $emailLogoLink }}"
            :include-future-scheduled-content-only = "{{ json_encode(boolval($futureScheduledContentOnly ?? true)) }}"
            :statuses="{{ json_encode($statuses ?? ['published']) }}"
            :is-all-content="{{ json_encode($isAllContent ?? false) }}"
            :included-types="{{ json_encode(is_array($lessonType) ? $lessonType : explode(',', $lessonType) ) }}"
            :show-in-progress="{{ json_encode($hasStartedLessons && $lessonType !== 'routine') }}"
        ></catalogue>
    </div>
@endsection
