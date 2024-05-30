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
@endphp

@section('meta')
    <title>Offline - Live Lessons | {{ $brand }}</title>
@endsection

@section('content')
    <offline
        header-page-type="{{ $headerDataObj->type }}"
        header-icon-name="{{ $headerDataObj->iconName }}"
        header-title="{{ $headerDataObj->title }}"
        :header-ctas="{{ json_encode($headerDataObj->ctas) }}"
        :schedule-events="{{ $scheduleEvents }}"
        subscription-calendar-id="{{ config('addevent.'.brand().'.uniquekeys.brand-overview') }}"
        timezone="{{ $fullTimezoneString }}"
    ></offline>
@endsection
