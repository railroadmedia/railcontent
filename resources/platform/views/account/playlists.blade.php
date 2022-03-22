@php
    $bodyClass = ($bodyClass ?? '') . ' sidebar';
    $leftSidebar = true;
@endphp
@extends('members.layout')

@section('meta')
    <title>My Lists | Singeo</title>
@endsection

@section('styles')

@endsection

@section('scripts')

@endsection

@section('content')
    @include('members.partials._content-sidebar')

    @include('bladesora::members.partials._account-header', [
        'userAvatar' => current_user()->getProfilePictureUrl(),
        'userName' => current_user()->getDisplayName(),
        'appName' => 'Singeo',
        'memberSince' => current_user()->getCreatedAt(),
    ])

    <div class="container mv-3">
        <div class="flex flex-column">
            <div class="flex flex-row">
                <content-catalogue
                        catalogue-type="list"
                        brand="singeo"
                        theme-color="singeo"
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
                        :show-loading-animation="true"></content-catalogue>
            </div>
        </div>
    </div>
@endsection
