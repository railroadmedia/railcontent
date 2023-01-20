@extends('partials.layout')

@section('meta')
    <title>Playlists | Musora</title>
@endsection

@section('content')



    <div class="tw-container tw-mx-auto tw-px-4 md:tw-px-8 dark:tw-text-white tw-pb-14">
        <div class="tw-flex tw-flex-col">
            <div class="tw-flex tw-flex-row">
                Playlist name - {{$playlist['name']}} <br/>
                Playlist description - {{$playlist['description']}}<br/>
                Playlist thumbnail url - {{$playlist['thumbnail_url']}} <br/>
                Is liked by current user - {{$playlist['is_liked_by_current_user']}} <br/>
            </div>
        </div>

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
