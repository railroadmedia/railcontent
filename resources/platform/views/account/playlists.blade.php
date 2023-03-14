@extends('partials.layout')

@section('meta')
    <title>Playlists | Musora</title>
@endsection

@section('content')

<<<<<<< HEAD
    {{-- Playlist Header --}}
    <playlist-collection-header
        :brand="{{ $brand }}"
        :playlist-count="{{ $playlistsNumber }}"
    /></playlist-collection-header>
=======
    @include('partials.bladesora.members.partials._account-header', [
        'backgroundImage' => 'https://d3fzm1tzeyr5n3.cloudfront.net/headers/'.$brand.'-header.jpg',
        'userAvatar' => user()->profile_picture_url,
        'userName' => user()->display_name,
        'appName' => 'Musora',
        'memberSince' => user()->created_at,
    ])
>>>>>>> master

    <div class="tw-container tw-mx-auto tw-px-4 md:tw-px-8 dark:tw-text-white tw-pb-14">
        <div class="tw-flex tw-flex-col">
            <div class="tw-flex tw-flex-row">

                {{-- Playlist Catalog --}}
                <playlist-collection-catalog
                    brand="{{ $brand }}"
                    :playlists="{{ json_encode($playlists) }}"
                    :playlist-count="{{ $playlistsNumber }}"
                    {{-- :search-term="{{ $searchTerm }}" --}}
                ></playlist-collection-catalog>

            </div>
        </div>
    </div>

@endsection
