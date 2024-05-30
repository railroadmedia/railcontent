@php
    $breadcrumbs = [
        [
            'title' => 'Live',
            'url' => '/'.$brand.'/live'
        ],
        [
            'title' => $lessonContent->fetch('fields.title'),
        ],
    ];
@endphp

@extends('partials.layout')

@section('meta')
    <title>Live Lesson - {{ $lessonContent->fetch('fields.title') }} | {{ $brand }}</title>
@endsection

@section('content')
    <online
        api-key="{{ $apiKey }}"
        chat-channel-name="{{ $chatChannelName }}"
        embed-url="{{ $embedUrl }}"
        :breadcrumbs="{{ json_encode($breadcrumbs) }}"
        :is-administrator="{{ json_encode(boolval($isAdministrator)) }}"
        :lesson-content="{{ json_encode($lessonContent) }}"
        :lesson-resources="{{ json_encode(array_merge($lessonContent['resources'] ?? [], $parent['resources'] ?? [])) }}"
        questions-channel-name="{{ $questionsChannelName }}"
        token="{{ $token }}"
        youtube-id="{{ $liveStreamId }}"
        :user-data="{{ json_encode($userData) }}"
        :schedule-events="{{ $scheduleEvents }}"
        @if(!empty($parentTitle))
            parent-title="{{ $parentTitle }}"
            course-url="{{ $courseUrl }}"
        @endif
    ></online>
@endsection
