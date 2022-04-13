@extends('partials.layout')

@section('meta')
    <title>Live Lesson - {{ $lessonContent->fetch('fields.title') }} | {{ $brand }}</title>
@endsection

@section('layout-styles')
    <link rel="stylesheet" href="{{ mix('css/packages.css') }}">
@endsection

@section('content')
    <page-container>
        <div v-cloak>

            <div class="tw-container tw-mx-auto fluid bg-grey-5 pv-3">
                <div class="tw-container tw-mx-auto">
                    {{-- Youtube Live Embed --}}
                    @include('partials.bladesora.members.content.lesson-video._live-embed', [
                        "themeColor" => "{{ $brand }}",
                        "youtubeId" => $liveStreamId,
                        "lessonTitle" => $lessonContent->fetch('fields.title'),
                        "userAvatar" => current_user()->getProfilePictureUrl(),
                        "userName" => current_user()->getDisplayName(),
                        "userEmail" => current_user()->getEmail(),
                        "emailRecipient" =>  "questions@drumeo.com", // If changed, update "Email addresses set in sites" doc
                        "emailLogo" =>  "https://dmmior4id2ysr.cloudfront.net/logos/drumeo-logo.png",
                        "brand" =>  "{{ $brand }}",
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

            <div class="tw-container tw-mx-auto tw-px-4 dark:tw-text-white tw-pt-8 tw-pb-14" style="margin-left: 0 !important; margin-right: 0 !important; width: 100% !important; max-width: 100%; padding-left: 87px; padding-right: 87px;">
                <div id="lessonInfo" class="tw-flex tw-flex-row align-v-top">
                    <div class="tw-flex tw-flex-coltw-grow tw-bg-white tw-shadow corners-10">
                        @if(!empty($lessonContent->fetch('*assignments')))
                            @foreach($lessonContent->fetch('*assignments', []) as $assignment)
                                <div class="tw-flex tw-flex-row">
                                    <div class="tw-flex tw-flex-coltw-grow">
                                        <content-assignment
                                            theme-color="{{ $brand }}"
                                            timecode="{{ $assignment->fetch('data.timecode', 0) }}"
                                            id="{{ $assignment->fetch('id') }}"
                                            xp="{{ $assignment->fetch('xp') }}"
                                            title="{{ $assignment->fetch('fields.title') }}"
                                            soundslice-slug="{{ $assignment->fetch('fields.soundslice_slug') }}"
                                            :completed="{{ json_encode($assignment->fetch('completed')) }}"
                                            :user-id="{{ auth()->id() }}"
                                        />
                                    </div>
                                </div>
                            @endforeach
                        @endif
                    </div>
                </div>
                <div class="tw-flex tw-flex-col mv-3">
                    <div class="tw-flex tw-flex-row pv-3 ph">
                        <h1 class="heading">Upcoming Lessons</h1>
                    </div>

                    <div class="tw-flex tw-flex-row">
                        <content-schedule 
                            :preloaded-content="{{ $scheduleEvents }}"
                            theme-color="{{ $brand }}"
                        />
                    </div>
                </div>
            </div>

        </div>
    </page-container>
@endsection
