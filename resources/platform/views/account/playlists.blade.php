@extends('partials.layout')

@section('meta')
    <title>My Lists | Singeo</title>
@endsection

@section('content')
    <page-container>

        <div v-cloak>

            @include('partials.bladesora.members.partials._account-header', [
                'userAvatar' => current_user()->getProfilePictureUrl(),
                'userName' => current_user()->getDisplayName(),
                'appName' => 'Singeo',
                'memberSince' => current_user()->getCreatedAt(),
            ])

            <div class="tw-container tw-mx-auto tw-px-4 dark:tw-text-white tw-pt-8 tw-pb-14">
                <div class="tw-flex tw-flex-column">
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

    </page-container>
@endsection
