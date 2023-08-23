@extends('partials.layout')

@section('meta')
    <title>Offline - Live Lessons | {{ $brand }}</title>
@endsection

@section('content')

    @component('partials._header-banner',
        ['backgroundImage' => 'https://d3fzm1tzeyr5n3.cloudfront.net/headers/'.$brand.'-header.jpg'])
        @slot('content')
            <div class="tw-inline-flex tw-w-full tw-flex-col tw-pr-4">
                <h1 class="tw-text-white tw-flex tw-items-center tw-mb-2">
                    <musora-icon icon-name="play-circle-filled" class="tw-w-[36px] tw-mr-2 tw-text-{{ $brand }}"></musora-icon>
                    <span class="tw-text-32 tw-font-bold"><span class="tw-capitalize">{{ $brand }}</span> Live</span>
                </h1>

                <p class="tw-text-white tw-mb-4 tw-max-w-4xl tw-pr-12 tw-text-base" >
                    Practice sessions, Q&A, celebrations, and more are available during <span class="tw-capitalize">{{ $brand }}</span> live lessons. Subscribe to an event or the whole calendar, so you don’t miss out!
                </p>

                {{-- Header CTAs --}}
                <div class="tw-flex tw-flex-row tw-flex-wrap tw-items-center tw-mt-3">
                    <div class="flex flex-column">
                        <label id="timezoneLabel" for="timezoneSelector" class="flex-auto body tw-cursor-pointer tw-w-fit">
                            <button class="tw-btn-secondary tw-text-white">
                                <i class="fas fa-globe mr-1"></i>
                                Change Your Timezone
                            </button>
                            <select name="timezone" id="timezoneSelector">
                                @foreach($timezones as $timezone)
                                    <option class="tw-text-[#00101D]"
                                            {{
                                                substr(
                                                    $timezone,
                                                    0,
                                                    strpos($timezone, ' - ')
                                                ) == $fullTimezoneString ? 'selected' : ''
                                            }}
                                    >
                                        {{ $timezone }}
                                    </option>
                                @endforeach
                            </select>
                        </label>
                    </div>
                </div>
            </div>
        @endslot
    @endcomponent

    <div class="tw-container tw-mx-auto tw-px-4 md:tw-px-8">

        <div class="tw-flex tw-flex-col mv-3">
            <div class="tw-flex tw-flex-row tw-flex-wrap tw-items-center tw-mb-6 md:tw-mb-[10px]">
                <div class="tw-flex tw-flex-col tw-mb-3 tw-mr-auto">
                    <h1 class="tw-text-[#00101D] dark:tw-text-white heading tw-capitalize tw-mr-2">
                        Upcoming Live Events
                    </h1>
                </div>
                <div class="tw-flex tw-flex-col">
                    <button class="tw-btn-secondary tw-text-[#00101D] dark:tw-text-white" data-open-modal="scheduleAddToCalendarModal">
                        <i class="fas fa-calendar-plus mr-1"></i>
                        Subscribe to Calendar
                    </button>
                </div>
            </div>
            <div class="tw-flex tw-flex-row">
                @if(!empty($scheduleEvents) && $scheduleEvents->count() > 0)
                    <content-schedule
                        :preloaded-content="{{ $scheduleEvents }}"
                        timezone="{{ $fullTimezoneString }}"
                        subscription-calendar-id="{{ config('addevent.'.brand().'.uniquekeys.brand-overview') }}"
                        theme-color="{{ $brand }}"
                    />
                @else
                <span>No upcoming live events</span>
                @endif
            </div>
        </div>
    </div>

@endsection
