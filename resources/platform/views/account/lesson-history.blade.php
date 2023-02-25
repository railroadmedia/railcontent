@extends('partials.layout')

@section('meta')
    <title>Lesson History | Musora</title>
@endsection

@section('content')

    <header id="page-header" class="tw-flex tw-w-full tw-min-h-[240px] tw-relative tw-z-0 tw-items-center tw-justify-center">
        <div class="tw-bg-cover tw-absolute tw-w-full tw-h-full tw-top-0 tw-left-0 tw-bg-top">
            <img src="https://musora.com/cdn-cgi/image/quality=100,width=1536,fit=cover,metadata=none/https://musora-web-platform.s3.amazonaws.com/headers/unified_header.jpg" 
                 class="tw-h-full tw-w-full tw-object-cover tw-object-top tw-transition-opacity" 
                 onload="this.classList.remove('tw-opacity-0')"
            />
        </div>
        <div class="tw-absolute tw-w-full tw-z-10 tw-h-full tw-bottom-0" style="background: linear-gradient(182.73deg, rgba(0, 16, 29, 0) -0.24%, rgb(0, 16, 29) 97.72%);"></div>
        <div class="tw-container tw-mx-auto tw-px-4 md:tw-px-8 tw-z-20 tw-w-full tw-h-auto tw-flex tw-flex-wrap">
            <div class="tw-flex tw-flex-col tw-mr-8">
                <!-- Title -->
                <h1 class="tw-text-white tw-flex tw-items-center tw-mb-1">
                    <musora-icon icon-name="bookmark" class="tw-w-[36px] tw-mr-2 tw-text-white"></musora-icon>
                    <span class="tw-text-32 tw-font-bold">Lesson History </span>
                </h1>
            </div>
        </div>
    </header>

    <div class="tw-container tw-mx-auto tw-px-4 md:tw-px-8 dark:tw-text-white tw-pb-14">
        <div class="tw-flex tw-flex-col">
            <div class="tw-flex tw-flex-row">
                <content-catalogue
                    catalogue-type="list"
                    brand="{{ $brand }}"
                    theme-color="{{ $brand }}"
                    limit="20"
                    :included-types="{{ json_encode($allowedTypes) }}"
                    :use-theme-color="true"
                    :pre-loaded-content="{{ $listLessons }}"
                    user-id="{{ auth()->id() }}"
                    :is-playlists="true"
                    :paginate="true"
                    no-results-message="{{ $noResultsMessage }}"
                    no-results-icon="happy"
                    :destroy-on-list-removal="true"
                    initial-page="{{ $initialPage }}"
                    :force-wide-thumbs="true"
                    :lock-unowned="true"
                    :is-admin="<?php echo e(json_encode(user()->isAdmin())); ?>"
                    @if($resetProgress)
                    :reset-progress="true"
                    @endif
                    :show-loading-animation="true"
                />
            </div>
        </div>
    </div>

@endsection
