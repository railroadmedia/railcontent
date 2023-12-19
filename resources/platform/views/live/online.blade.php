@extends('partials.layout')

@section('meta')
    <title>Live Lesson - {{ $lessonContent->fetch('fields.title') }} | {{ $brand }}</title>
@endsection

@section('content')

    <div class="fluid pv-3">
        {{-- Youtube Live Embed --}}
        @include('partials.bladesora.members.content.lesson-video._live-embed', [
            "themeColor" => "{{ $brand }}",
            "youtubeId" => $liveStreamId,
            "lessonTitle" => $lessonContent->fetch('fields.title'),
            "userAvatar" => user()->profile_picture_url,
            "userName" => user()->display_name,
            "userEmail" => user()->email,
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

    <div class="tw-flex tw-w-full tw-max-w-[1703px] tw-mx-auto tw-px-4 md:tw-px-8 tw-mt-3 tw-flex-col">
        <div id="lessonInfo" class="tw-flex tw-flex-row tw-items-center">
            <div class="tw-flex tw-flex-col tw-grow tw-shadow">
                @if(!empty($lessonContent->fetch('*assignments')))
                    @foreach($lessonContent->fetch('*assignments', []) as $assignment)
                        <div class="tw-flex tw-flex-row">
                            <div class="tw-flex tw-flex-col tw-grow">
                                <content-assignment
                                    theme-color="{{ $brand }}"
                                    brand="{{ $brand }}"
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
        <div class="tw-flex tw-flex-col mv-3 tw-w-full">
            <div class="tw-flex tw-flex-row mb-3">
                <h1 class="heading dark:tw-text-white tw-text-xl tw-leading-none md:tw-leading-none md:tw-text-2xl">Live Schedule</h1>
            </div>

            <div class="tw-flex tw-flex-row tw-w-full">
                <content-schedule
                    :preloaded-content="{{ $scheduleEvents }}"
                    theme-color="{{ $brand }}"
                />
            </div>
        </div>
    </div>

@endsection
