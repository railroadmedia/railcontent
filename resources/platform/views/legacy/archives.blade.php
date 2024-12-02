@extends('partials.layout')

@section('meta')
    <title>{{ ucfirst($brand) }} Archives | Musora</title>
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
            catalogue-type="list"
            lesson-type="archives"
            :catalogue-meta="{{ json_encode([
                "name" => "Legacy Archives"
            ])}}"
            :breadcrumbs="{{ json_encode([ 
                    [
                        "title" => "Legacy Resources",
                        "url" => "/drumeo/legacy-resources",
                    ],
                    [
                        'title' => 'Legacy Archives'
                    ]
                ])}}"
            :session-token="{{ json_encode(railtracker_session_token()) }}"
            {{-- ask-question-recipient="{{ $askQuestionRecipient }}" --}}
            {{-- email-logo-link="{{ $emailLogoLink }}" --}}
            {{-- :show-in-progress="{{ json_encode($hasStartedLessons && $lessonType !== 'routine') }}" --}}
        ></catalogue>
    </div>
@endsection

