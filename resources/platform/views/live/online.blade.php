@php
    $bodyClass = ($bodyClass ?? '') . ' sidebar';
    $leftSidebar = true;
@endphp

@extends('members.layout', ['excludeTailwindCss' => false])

@section('meta')
    <title>Live Lesson - {{ $lessonContent->fetch('fields.title') }} | Singeo</title>
@endsection

@section('styles')
    <link rel="stylesheet" href="{{ mix('css/packages.css') }}">
@endsection

@section('scripts')

@endsection

@section('content')
    @include('members.partials._content-sidebar')

    <div class="container fluid bg-grey-5 pv-3">
        <div class="container">
            {{-- Youtube Live Embed --}}
            @include('bladesora::members.content.lesson-video._live-embed', [
                "themeColor" => "drumeo",
                "youtubeId" => $liveStreamId,
                "lessonTitle" => $lessonContent->fetch('fields.title'),
                "userAvatar" => current_user()->getProfilePictureUrl(),
                "userName" => current_user()->getDisplayName(),
                "userEmail" => current_user()->getEmail(),
                "emailRecipient" =>  "questions@drumeo.com", // If changed, update "Email addresses set in sites" doc
                "emailLogo" =>  "https://dmmior4id2ysr.cloudfront.net/logos/drumeo-logo.png",
                "brand" =>  "drumeo",
                "apiKey" => $apiKey,
                "token" => $token,
                "chatChannelName" => $chatChannelName,
                "questionsChannelName" => $questionsChannelName,
                "isAdministrator" => $isAdministrator,
                "userData" => $userData,

                "lessonTitle" => $lessonContent->fetch('fields.title'),
                "contentType" => $lessonContent->fetch('type'),
                "instructors" => $lessonContent->fetch('*fields.instructor', []),
                "lessonResources" => array_merge($lessonContent['resources'] ?? [], $parent['resources'] ?? []),
            ])
        </div>
    </div>

    <div class="container mv-3" style="margin-left: 0 !important; margin-right: 0 !important; width: 100% !important; max-width: 100%; padding-left: 87px; padding-right: 87px;">
        <div id="lessonInfo" class="flex flex-row align-v-top">
            <div class="flex flex-column grow bg-white shadow corners-10">
                @if(!empty($lessonContent->fetch('*assignments')))
                    @foreach($lessonContent->fetch('*assignments', []) as $assignment)
                        <div class="flex flex-row">
                            <div class="flex flex-column grow">
                                <content-assignment
                                        theme-color="singeo"
                                        timecode="{{ $assignment->fetch('data.timecode', 0) }}"
                                        id="{{ $assignment->fetch('id') }}"
                                        xp="{{ $assignment->fetch('xp') }}"
                                        title="{{ $assignment->fetch('fields.title') }}"
                                        soundslice-slug="{{ $assignment->fetch('fields.soundslice_slug') }}"
                                        :completed="{{ json_encode($assignment->fetch('completed')) }}"
                                        :user-id="{{ auth()->id() }}"></content-assignment>
                            </div>
                        </div>
                    @endforeach
                @endif
            </div>
        </div>
        <div class="flex flex-column  mv-3">
            <div class="flex flex-row pv-3 ph">
                <h1 class="heading">Upcoming Lessons</h1>
            </div>

            <div class="flex flex-row">
                <content-schedule :preloaded-content="{{ $scheduleEvents }}"
                                  theme-color="singeo"></content-schedule>
            </div>
        </div>
    </div>
@endsection
