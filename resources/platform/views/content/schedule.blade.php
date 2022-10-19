@extends('partials.layout')

@section('meta')
    <title>{{ ucfirst($brand) }} Schedule | Musora</title>
@endsection

@section('content')

    @component('partials._header-banner', [
        'backgroundImage' => 'https://musora-web-platform.s3.amazonaws.com/headers/'.$brand.'-header.jpg',
    ])
        @slot('content')
            <div class="tw-flex tw-flex-col tw-pr-1">
                <h1 class="tw-text-white tw-flex tw-items-center tw-mb-2">
                    <musora-icon icon-name="calendar-filled" class="tw-w-[36px] tw-mr-2 tw-text-{{ $brand }}"></musora-icon>
                    <span class="tw-text-32 tw-font-bold tw-capitalize">{{ $brand }} Schedule</span>
                </h1>

                <p class="tw-text-white tw-mb-4 tw-max-w-4xl tw-pr-12 tw-text-base">
                    Practice sessions, Q&A, celebrations, and more are available during <span class="tw-capitalize">{{ $brand }}</span> live lessons. Subscribe to an event or the whole calendar, so you don’t miss out!
                </p>

                <div class="tw-flex tw-flex-row">
                    <div class="tw-flex tw-flex-col xs-12 sm-4">
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
            <div id="scheduleHeader" class="tw-flex tw-flex-row tw-flex-wrap tw-items-center tw-mb-6 md:tw-mb-[10px]">
                <div class="tw-flex tw-flex-col tw-mb-3 tw-mr-auto">
                    <h1 class="tw-text-[#00101D] dark:tw-text-white heading tw-capitalize tw-mr-2">
                        Scheduled Releases
                    </h1>
                </div>
                <div class="tw-flex tw-flex-col">
                    <button class="tw-btn-secondary tw-text-[#00101D] dark:tw-text-white" 
                            data-open-modal="scheduleAddToCalendarModal"
                    >
                        <i class="fas fa-calendar-plus tw-mr-2"></i>
                        Subscribe to Calendar 
                    </button>
                </div>
            </div>   
            <div class="tw-flex tw-flex-row">
                <content-schedule
                    :preloaded-content="{{ $scheduleEvents }}"
                    subscription-calendar-id="{{ config('addevent.'.brand().'.uniquekeys.brand-overview') }}"
                    theme-color="{{ $brand }}"
                />
            </div>
        </div>

        <div id="printSchedule" class="flex-center tw-mb-6">
            <button class="btn collapse-200" onclick="window.print();">
                <span class="tw-bg-{{ $brand }} short tw-text-white">
                    <i class="fas fa-print tw-mr-1"></i>
                    Print Schedule
                </span>
            </button>
        </div>
    </div>

@endsection

@section('layout-styles')
    <style media="print">
        #nav, #subNav {
            display: none;
        }

        #pageHeader {
            display: none;
        }

        #scheduleHeader {
            display: none;
            border: none;
        }

        #printSchedule {
            display: none;
        }

        footer {
            display: none !important;
        }

        .shadow {
            box-shadow: none !important;
            border: 1px solid #e5e8e8;
        }

        .content-table-row.scheduled .month-col {
            flex: 0 0 100%;
            max-width: 100%;
        }

        .content-table-row.scheduled .icon-col {
            display: none;
        }

        .content-table-row.scheduled .title-column p {
            color: #000 !important;
        }

        .content-table-row.scheduled .title-column .hide-md-up {
            display: none;
        }
    </style>
@endsection

