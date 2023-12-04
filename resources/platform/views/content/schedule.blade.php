@extends('partials.layout')

@section('meta')
    <title>{{ ucfirst($brand) }} Schedule | Musora</title>
@endsection

@section('content')
    <schedule
        :timezones="{{ json_encode($timezones) }}"
        :selected-timezone="{{ json_encode($fullTimezoneString) }}"
        :schedule-data="{{ $scheduleEvents }}"
        subscription-calendar-id="{{ config('addevent.'.brand().'.uniquekeys.brand-overview') }}"
    ></schedule>
@endsection

