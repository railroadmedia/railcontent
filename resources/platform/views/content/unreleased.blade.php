@extends('partials.layout')

@section('meta')
    <title>Coming Soon to {{ ucfirst($brand) }} | Musora</title>
@endsection

{{-- CHECK IF THIS PAGE IS STILL RELEVANT --}}
@section('content')

    <div class="tw-w-full tw-mx-auto 3xl:tw-max-w-screen-3xl 4xl:tw-max-w-screen-4xl tw-px-4 md:tw-px-8">
        <breadcrumb
            :breadcrumbs="{{ json_encode([ 
                [
                    'title' => 'Coming Soon'
                ]
            ])}}"
        ></breadcrumb>
        <page-header
            page-type="unreleased"
            title="Coming Soon"
            icon-name="clock-filled"
            description="Looks like you tried to click a link to content that is not yet released. Check the schedule below to find the exact day that content is published."
        ></page-header>
    </div>

    <div class="tw-w-full tw-mx-auto 3xl:tw-max-w-screen-3xl 4xl:tw-max-w-screen-4xl tw-px-4 md:tw-px-8">
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
