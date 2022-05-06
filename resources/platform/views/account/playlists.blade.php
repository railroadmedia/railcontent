@extends('partials.layout')

@section('meta')
    <title>My Lists | Musora</title>
@endsection

@section('content')

        <div v-cloak>

            @include('partials.bladesora.members.partials._account-header', [
                'userAvatar' => user()->profile_picture_url,
                'userName' => user()->display_name,
                'appName' => 'Musora',
                'memberSince' => current_user()->getCreatedAt(),
            ])

            <div class="tw-container tw-mx-auto tw-px-4 dark:tw-text-white tw-pt-8 tw-pb-14">
                <div class="tw-flex tw-flex-col">
                    <div class="tw-flex tw-flex-row">
                        <content-catalogue
                            catalogue-type="list"
                            brand="{{ $brand }}"
                            theme-color="{{ $brand }}"
                            limit="20"
                            :included-types="{{ $includedTypes }}"
                            :use-theme-color="true"
                            :pre-loaded-content="{{ $listLessons }}"
                            user-id="{{ auth()->id() }}"
                            :is-playlists="true"
                            :paginate="true"
                            no-results-message="{{ $noResultsMessage }}"
                            no-results-icon="{{ $noResultsIcon }}"
                            :destroy-on-list-removal="true"
                            initial-page="{{ $initialPage }}"
                            :force-wide-thumbs="true"
                            :lock-unowned="true"
                            :is-admin="<?php echo e(json_encode(current_user()->getPermissionLevel() === 'administrator')); ?>"
                            @if($resetProgress)
                            :reset-progress="true"
                            @endif
                            :show-loading-animation="true"
                        />
                    </div>
                </div>
            </div>

        </div>

@endsection
