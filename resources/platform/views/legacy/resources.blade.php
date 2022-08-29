@extends('partials.layout')

@section('meta')
    <title>Drumeo Legacy Resources | Musora</title>
@endsection

@section('content')

    @component('partials._header-banner', [
        'backgroundImage' => 'https://musora-web-platform.s3.amazonaws.com/headers/'.$brand.'-header.jpg',
    ])
        @slot('content')
            <div class="tw-flex tw-flex-col tw-pr-1">
                <h1 class="tw-text-white tw-flex tw-items-center tw-mb-2">
                    <i class="icon-legacy tw-text-{{ $brand }} tw-mr-3 tw-text-3xl"></i>
                    <span class="tw-text-32 tw-font-bold">Legacy Resources</span>
                </h1>
                <p class="tw-text-white tw-max-w-4xl tw-pr-12 tw-text-base">
                    Legacy Resources are lessons or tools that are no longer added to or supported.
                </p>
                <p class="tw-text-white tw-mb-4 tw-max-w-4xl tw-pr-12 tw-text-base">
                    Rather than remove them from the site completely you can access them here.
                </p>
            </div>
        @endslot
    @endcomponent

    <div class="tw-container tw-mx-auto tw-px-4 md:tw-px-8 mv-3">
        <div class="tw-flex tw-flex-col">
            <div class="tw-flex tw-flex-row pv-2">
                <h1 class="heading dark:tw-text-white">Choose a Resource</h1>
            </div>

            @include('partials.bladesora.members.account.partials._settings-links', [
                "brand" => "drumeo",
                "sections" => $sections
            ])
        </div>
    </div>
@endsection

