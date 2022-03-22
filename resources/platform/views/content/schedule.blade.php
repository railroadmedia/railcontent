@php
    $bodyClass = ($bodyClass ?? '') . ' sidebar';
    $leftSidebar = true;
@endphp

@extends('members.layout')

@section('meta')
    <title>Schedule | Singeo</title>
@endsection

@section('content')
    @include('members.partials._content-sidebar')

    @component('members.partials._header-banner')
        @slot('content')
            <div class="flex flex-column pr-1">
                <h1 class="tw-text-white tw-flex tw-items-center tw-mb-2">
                    <i class="fas fa-calendar-alt tw-text-singeo tw-mr-3 tw-text-3xl"></i>
                    <span class="tw-text-32">Schedule</span>
                </h1>

                <p class="tw-text-white tw-mb-4 tw-max-w-4xl tw-pr-12 tw-text-base">
                    We'd LOVE for you to join us for a live lesson! This is where you'll see the upcoming schedule
                    for live lessons and other releases. Take a look. And make sure to click the "Add To Calendar"
                    button for anything that catches your eye so you don't miss out!
                </p>

                <div class="flex flex-row">
                    <div class="flex flex-column xs-12 sm-4">
                        <label id="timezoneLabel" for="timezoneSelector" class="mt-3">
                            <button class="btn collapse-250">
                    <span class="bg-white text-white inverted short">
                        <i class="fas fa-globe mr-1"></i>
                        Change Your Timezone
                    </span>
                            </button>

                            <select name="timezone" id="timezoneSelector">
                                @foreach($timezones as $timezone)
                                    <option {{
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

    <div class="container mv-2">
        <div class="content-table flex flex-column mb-3">
            <div id="scheduleHeader" class="flex flex-row pv-3 flex-wrap align-v-center">
                <div class="flex flex-column xs-12 sm-8 md-9 mb-2 m-xs-only">
                    <h1 class="heading">Scheduled Releases</h1>
                </div>
                <div class="flex flex-column xs-12 sm-4 md-3 mb-3">
                    <button class="btn" data-open-modal="scheduleAddToCalendarModal">
                        <span class="text-singeo bg-singeo inverted">
                            <i class="fas fa-calendar-plus mr-1"></i>
                            Subscribe to Calendar
                        </span>
                    </button>
                </div>
            </div>

            <content-schedule :preloaded-content="{{ $scheduleEvents }}"
                              subscription-calendar-id="{{ config('addevent.uniquekeys.brand-overview') }}"
                              theme-color="singeo"></content-schedule>
        </div>

        <div id="printSchedule" class="flex-center">
            <button class="btn collapse-200" onclick="window.print();">
                <span class="bg-singeo short text-white">
                    <i class="fas fa-print mr-1"></i>
                    Print Schedule
                </span>
            </button>
        </div>
    </div>
@endsection

@section('styles')
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

