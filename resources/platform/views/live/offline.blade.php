@extends('partials.layout')

@section('meta')
    <title>Offline - Live Lessons | {{ $brand }}</title>
@endsection

@section('content')
        <div v-cloak>

            @component('partials._header-banner')
                @slot('content')
                    <div class="tw-inline-flex tw-w-full tw-flex-col tw-pr-4 tw-mt-14">
                        <h1 class="tw-text-white tw-flex tw-items-center tw-mb-2">
                            <i class="icon-live tw-text-{{$brand}} tw-mr-3 tw-text-3xl"></i>
                            <span class="tw-text-32 tw-font-bold"><span class="tw-capitalize">{{ $brand }}</span> Live</span>
                        </h1>

                        <p class="tw-text-white tw-mb-4 tw-max-w-4xl tw-pr-12 tw-text-base" >
                            This is where you'll see the upcoming lesson release schedule.
                            Make sure to click the "Add To Calendar" button for anything that catches your eye so you
                            don't miss out. Whenever we stream live you'll be able to watch the lesson here and chat with
                            other Musora members!
                        </p>

                        <div class="tw-flex tw-flex-row tw-flex-wrap tw-items-center tw-mt-3">
                            <div class="tw-flex tw-flex-col xs-12 sm-6 md-4 tw-mb-1">
                                <label id="timezoneLabel" for="timezoneSelector" class="tw-flex-auto body">
                                    <button class="btn ph-1">
                                    <span class="tw-bg-white tw-text-white inverted short">
                                        <i class="fas fa-globe tw-mr-1"></i>
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

            <div class="tw-container tw-mx-auto">
                <div class="tw-flex tw-flex-col mv-3">
                    <div class="tw-flex tw-flex-row pv-3">
                        <h1 class="heading">Upcoming Lessons</h1>
                    </div>

                    <div class="tw-flex tw-flex-row">
                        <content-schedule 
                            :preloaded-content="{{ $scheduleEvents }}"
                            brand="{{ $brand }}"
                            theme-color="{{ $brand }}"
                        />
                    </div>
                </div>
            </div>

        </div>
@endsection
