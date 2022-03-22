@php
    $bodyClass = ($bodyClass ?? '') . ' sidebar';
    $leftSidebar = true;
@endphp

@extends('members.layout')

@section('meta')
    <title>Offline - Live Lessons | Singeo</title>
@endsection

@section('styles')

@endsection

@section('scripts')

@endsection

@section('content')
    @include('members.partials._content-sidebar')

    @component('members.partials._header-banner')
        @slot('content')
            <div class="tw-inline-flex tw-w-full tw-flex-col tw-pr-4 tw-mt-14">
                <h1 class="tw-text-white tw-flex tw-items-center tw-mb-2">
                    <i class="icon-live tw-text-singeo tw-mr-3 tw-text-3xl"></i>
                    <span class="tw-text-32">Singeo Live</span>
                </h1>

                <p class="tw-text-white tw-mb-4 tw-max-w-4xl tw-pr-12 tw-text-base" >
                    This is where you'll see the upcoming lesson release schedule.
                    Make sure to click the "Add To Calendar" button for anything that catches your eye so you
                    don't miss out. Whenever we stream live you'll be able to watch the lesson here and chat with
                    other Singeo members!
                </p>

                <div class="flex flex-row flex-wrap align-v-center mt-3">
                    <div class="flex flex-column xs-12 sm-6 md-4 mb-1">
                        <label id="timezoneLabel" for="timezoneSelector" class="flex-auto body">
                            <button class="btn ph-1">
                            <span class="bg-white text-white inverted short">
                                <i class="fas fa-globe mr-1"></i>
                                Change Your Timezone
                            </span>
                            </button>

                            <select name="timezone" id="timezoneSelector">
                                @foreach($timezones as $timezone)
                                    <option value="{{ substr($timezone, 0, strpos($timezone, ' - ')) }}"
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

    <div class="container">
        <div class="flex flex-column  mv-3">
            <div class="flex flex-row pv-3">
                <h1 class="heading">Upcoming Lessons</h1>
            </div>

            <div class="flex flex-row">
                <content-schedule :preloaded-content="{{ $scheduleEvents }}"
                                  theme-color="singeo"></content-schedule>
            </div>
        </div>
    </div>
@endsection
