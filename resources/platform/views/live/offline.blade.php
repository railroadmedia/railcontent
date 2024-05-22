@extends('partials.layout')

@php
    $headerData = [
        'type' => 'live',
        'title' => $brand.' Live',
        'iconName' => 'play-circle',
        'ctas' => [
            [
                'type' => 'TimezoneSelectCta',
                'props' => [
                    'timezones' => $timezones,
                    'fullTimezoneString' => $fullTimezoneString
                ]
            ]
        ]
    ];

    $headerDataJson = json_encode($headerData);
    $headerDataObj = json_decode($headerDataJson);

    
    $breadcrumbs = [
        [
            'title' => 'Live',
        ],
    ];
@endphp

@section('meta')
    <title>Offline - Live Lessons | {{ $brand }}</title>
@endsection

@section('content')
    <div class="tw-w-full tw-mx-auto 3xl:tw-max-w-screen-3xl 4xl:tw-max-w-screen-4xl tw-px-4 md:tw-px-8">
        <breadcrumb :breadcrumbs="{{ json_encode($breadcrumbs) }}"></breadcrumb>
        <page-header
            page-type="{{ $headerDataObj->type }}"
            icon-name="{{ $headerDataObj->iconName }}"
            title="{{ $headerDataObj->title }}"
            :ctas="{{ json_encode($headerDataObj->ctas) }}"
            description="Practice sessions, Q&A, celebrations, and more are available during {{ $brand }} live lessons. Subscribe to an event or the whole calendar, so you don't miss out!"
        ></page-header>
    </div>
    <div class="tw-w-full tw-mx-auto 3xl:tw-max-w-screen-3xl 4xl:tw-max-w-screen-4xl tw-px-4 md:tw-px-8">
        <div class="tw-flex tw-flex-col mv-3">
            <div class="tw-flex tw-flex-row tw-flex-wrap tw-items-center tw-mb-6 md:tw-mb-[10px]">
                <div class="tw-flex tw-flex-col tw-mb-3 tw-mr-auto">
                    <h1 class="tw-text-[#00101D] dark:tw-text-white heading tw-capitalize tw-mr-2 tw-text-xl md:tw-text-2xl">
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
                @if(!empty($scheduleEvents) && count(json_decode($scheduleEvents)) > 0)
                    <content-schedule
                        :preloaded-content="{{ $scheduleEvents }}"
                        timezone="{{ $fullTimezoneString }}"
                        subscription-calendar-id="{{ config('addevent.'.brand().'.uniquekeys.brand-overview') }}"
                        theme-color="{{ $brand }}"
                    />
                @else
                <span class="dark:tw-text-white">No upcoming live events</span>
                @endif
            </div>
        </div>
    </div>

@endsection
