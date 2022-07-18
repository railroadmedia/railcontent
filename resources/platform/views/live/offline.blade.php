@extends('partials.layout')

@section('meta')
    <title>Offline - Live Lessons | {{ $brand }}</title>
@endsection

@section('content')

    @component('partials._header-banner', )
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
                
                {{-- Header CTAs --}}
                <div class="tw-flex tw-flex-row tw-flex-wrap tw-items-center tw-mt-3 tw-max-w-xl">
                    <div class="flex flex-column">
                        <label id="timezoneLabel" for="timezoneSelector" class="flex-auto body tw-cursor-pointer">
                            <button class="tw-btn-secondary tw-text-white ">
                                <i class="fas fa-globe mr-1"></i>
                                Change Your Timezone
                            </button>
                            <select name="timezone" id="timezoneSelector">
                                @foreach($timezones as $timezone)
                                    <option class="tw-text-black"
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
            <div class="tw-flex tw-flex-row tw-flex-wrap tw-items-center tw-mb-[10px]">
                <div class="tw-flex tw-flex-col tw-mb-3 tw-mr-auto">
                    <h1 class="tw-text-black dark:tw-text-white heading tw-capitalize tw-mr-2">
                        Scheduled Releases
                    </h1>
                </div>
                <div class="tw-flex tw-flex-col">
                    <button class="tw-btn-secondary tw-text-black dark:tw-text-white" data-open-modal="scheduleAddToCalendarModal">
                        Subscribe to Calendar 
                    </button>
                </div>
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
