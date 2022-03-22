@php
    $bodyClass = ($bodyClass ?? '') . ' sidebar';
    $leftSidebar = true;
@endphp

@extends('members.layout')

@section('meta')
    <title>Coming Soon | Singeo</title>
@endsection

@section('styles')

@endsection

@section('scripts')

@endsection

@section('content')
    @include('members.partials._content-sidebar')

    @component('bladesora::members.partials._page-header', [
        "themeColor" => 'singeo',
        "pageTitle" => 'Coming Soon',
        "pageIcon" => 'fas fa-clock',
        "pageDescription" => 'Looks like you tried to click a link to content that is not yet released. Check the schedule below to find the exact day that content is published.',
    ])
        @slot('interactionSlot')
        @endslot
    @endcomponent

    <div class="container">
        <div class="flex flex-column  mv-3">
            <div class="flex flex-row pv-3 ph">
                <h1 class="heading">Upcoming Lessons</h1>
            </div>

            <div class="flex flex-row">
                <content-schedule :preloaded-content="{{ $scheduleEvents }}"
                                  theme-color="singeo"></content-schedule>
            </div>
        </div>
    </div>
@endsection
