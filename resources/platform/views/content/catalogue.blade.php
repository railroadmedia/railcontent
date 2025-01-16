@extends('partials.layout')

@section('meta')
    <title>{{ ucfirst($brand) }} {{ ucfirst($catalogueMeta['name']) }} | Musora</title>
@endsection

@php
    $askQuestionRecipient = config('mailora.' . $brand . '.ask-question-recipient');
    $emailLogoLink = config('mailora.' . $brand . '.logo-link');
    $isNewReleases = ucfirst($catalogueMeta['name']) === 'New Releases';
    if (isset($startedLessons)) {
        $decodedStartedLessons = json_decode($startedLessons);
        $formattedStartedLessons = json_encode(isset($decodedStartedLessons) && isset($decodedStartedLessons->data) ? $decodedStartedLessons->data : []);
    }
@endphp

@section('content')
    <div id="app">
            <catalogue
                {{-- :catalogue-meta="{{ json_encode($catalogueMeta) }}" --}}
                :is-new-releases="{{ json_encode($isNewReleases) }}"
                catalogue-type="{{ $catalogueType }}"
                :lesson-type="{{ json_encode($lessonType) }}"
                :breadcrumbs="{{ json_encode($breadcrumbs) }}"
                :session-token="{{ json_encode(railtracker_session_token()) }}"
                ask-question-recipient="{{ $askQuestionRecipient }}"
                email-logo-link="{{ $emailLogoLink }}"
                :show-in-progress="{{ json_encode($hasStartedLessons && $lessonType !== 'routine') }}"
                :for-you-experiment="{{ json_encode($forYouExperiment) }}"
            ></catalogue>
    </div>
@endsection
