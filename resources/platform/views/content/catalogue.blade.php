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
            catalogue-type="{{ $catalogueType }}"
            :lesson-type="{{ json_encode($lessonType) }}"
            :catalogue-meta="{{ json_encode($catalogueMeta) }}"
            :breadcrumbs="{{ json_encode($breadcrumbs) }}"
            :session-token="{{ json_encode(railtracker_session_token()) }}"
            ask-question-recipient="{{ $askQuestionRecipient }}"
            email-logo-link="{{ $emailLogoLink }}"
            :show-in-progress="{{ json_encode($hasStartedLessons && $lessonType !== 'routine') }}"
        ></catalogue>
    </div>
@endsection
