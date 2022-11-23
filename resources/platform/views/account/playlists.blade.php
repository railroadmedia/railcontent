@extends('partials.layout')

@section('meta')
    <title>Playlists | Musora</title>
@endsection

@section('content')

    @include('partials.bladesora.members.partials._account-header', [
        'backgroundImage' => 'https://musora-web-platform.s3.amazonaws.com/headers/'.$brand.'-header.jpg',
        'userAvatar' => user()->profile_picture_url,
        'userName' => user()->display_name,
        'appName' => 'Musora',
        'memberSince' => user()->created_at,
    ])

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
