@extends('partials.layout')

@section('meta')
    <title>Playlists | Musora</title>
@endsection

@section('content')

    {{-- Playlist Header --}}
    <playlist-header
        :playlist="{{ json_encode($playlist) }}"
        :lessons="{{ $listLessons }}"
        :brand="{{ $brand }}"
    /></playlist-header>

    <div class="tw-container tw-mx-auto tw-px-4 md:tw-px-8 dark:tw-text-white tw-pb-14">
        <div class="tw-flex tw-flex-col">
            <div class="tw-flex tw-flex-row">
                <content-catalogue
                    catalogue-type="list"
                    content-endpoint="{{ url()->route('playlist.items',['playlist_id' => $playlist['id']]) }}"
                    brand="{{ $brand }}"
                    theme-color="{{ $brand }}"
                    limit="20"
                    :use-theme-color="true"
                    :pre-loaded-content="{{ $listLessons }}"
                    user-id="{{ auth()->id() }}"
                    :paginate="true"
                    no-results-message="{{ $noResultsMessage }}"
                    no-results-icon="happy"
                    :destroy-on-list-removal="true"
                    :force-wide-thumbs="true"
                    :lock-unowned="true"
                    :is-admin="<?php echo e(json_encode(user()->isAdmin())); ?>"
                    :show-loading-animation="true"
                />
            </div>
        </div>
    </div>

@endsection
