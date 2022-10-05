@extends('partials.layout')

@section('meta')
    <title>Coming Soon to {{ ucfirst($brand) }} | Musora</title>
@endsection

@section('content')

    @component('partials.bladesora.members.partials._page-header', [
        "themeColor" => '{{ $brand }}',
        "pageTitle" => 'Coming Soon',
        "pageIcon" => 'fas fa-clock',
        "pageDescription" => 'Looks like you tried to click a link to content that is not yet released. Check the schedule below to find the exact day that content is published.',
    ])
        @slot('interactionSlot')
        @endslot
    @endcomponent

    <div class="tw-container tw-mx-auto tw-px-4 md:tw-px-8">
        <div class="tw-flex tw-flex-col  mv-3">
            <div class="tw-flex tw-flex-row mb-3 ph">
                <h1 class="heading dark:tw-text-white">Upcoming Lessons</h1>
            </div>

            <div class="tw-flex tw-flex-row">
                <content-schedule :preloaded-content="{{ $scheduleEvents }}"
                                theme-color="{{ $brand }}"></content-schedule>
            </div>
        </div>
    </div>

@endsection
