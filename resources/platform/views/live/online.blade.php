@extends('partials.layout')

@section('meta')
    <title>Live Lesson - {{ $lessonContent->fetch('fields.title') }} | {{ $brand }}</title>
@endsection

@section('content')

    <div class="fluid bg-grey-5 pv-3">
        <div class="tw-flex tw-w-full tw-max-w-[1703px] tw-mx-auto tw-px-4 md:tw-px-8 tw-mt-3 tw-flex-col 2xl:tw-flex-row">
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
    </div>

    <div class="tw-container tw-mx-auto tw-px-4 dark:tw-text-white tw-pt-8 tw-pb-14" style="margin-left: 0 !important; margin-right: 0 !important; width: 100% !important; max-width: 100%; padding-left: 87px; padding-right: 87px;">
        <div id="lessonInfo" class="tw-flex tw-flex-row tw-items-center">
            <div class="tw-flex tw-flex-col tw-grow tw-shadow">
                @if(!empty($lessonContent->fetch('*assignments')))
                    @foreach($lessonContent->fetch('*assignments', []) as $assignment)
                        <div class="tw-flex tw-flex-row">
                            <div class="tw-flex tw-flex-col tw-grow">
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
            <div class="tw-flex tw-flex-row mb-3 ph">
                <h1 class="heading dark:tw-text-white">Live Schedule</h1>
            </div>

            <div class="tw-flex tw-flex-row">
                <content-schedule
                    :preloaded-content="{{ $scheduleEvents }}"
                    theme-color="{{ $brand }}"
                />
            </div>
        </div>
    </div>

@endsection
