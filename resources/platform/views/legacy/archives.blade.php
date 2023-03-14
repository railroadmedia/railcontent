@extends('partials.layout')

@section('meta')
    <title>Drumeo Archives | Musora</title>
@endsection

@section('content')

    @component('partials._header-banner', [
        'backgroundImage' => 'https://d3fzm1tzeyr5n3.cloudfront.net/headers/'.$brand.'-header.jpg',
    ])
        @slot('content')
            <div class="tw-flex tw-flex-col tw-pr-1">
                <h1 class="tw-text-white tw-flex tw-items-center tw-mb-2">
                    <i class="icon-legacy tw-text-{{ $brand }} tw-mr-3 tw-text-3xl"></i>
                    <span class="tw-text-32 tw-font-bold">Lesson Archives</span>
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

            <div class="tw-flex tw-flex-row pv-3">
                <h1 class="heading capitalize dark:tw-text-white">Search Archives</h1>
            </div>

            <div class="tw-flex tw-flex-row">
                <content-catalogue
                        content-endpoint="/railcontent/content"
                        catalogue-type="list"
                        limit="20"
                        theme-color="drumeo"
                        :use-theme-color="true"
                        :pre-loaded-content="{{ $lessons }}"
                        user-id="{{ auth()->id() }}"
                        :search-bar="true"
                        :use-url-params="true"
                        :paginate="true"
                        :statuses="['archived']"
                        total-results="{{ $totalResults }}"
                        :show-loading-animation="true"></content-catalogue>
            </div>
        </div>
    </div>
@endsection

