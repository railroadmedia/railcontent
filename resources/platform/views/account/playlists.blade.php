@extends('partials.layout')

@section('meta')
    <title>Playlists | Musora</title>
@endsection

@section('content')

    {{-- Playlist Header --}}
    <playlist-collection-header
        :playlist-count="{{ $playlistsNumber }}"
    /></playlist-collection-header>

    <div class="tw-container tw-mx-auto tw-px-4 md:tw-px-8 dark:tw-text-white tw-pb-14">
        <div class="tw-flex tw-flex-col">
            <div class="tw-flex tw-flex-row">

                {{-- Playlist Catalog --}}
                <playlist-collection-catalog
                    {{-- :brand="{{ $brand }}" --}}
                    :playlist-count="{{ $playlistsNumber }}"
                    :playlists="{{ json_encode($playlists) }}"
                    :search-term="{{ $searchTerm }}"
                ></playlist-collection-catalog>

            </div>
        </div>
    </div>

@endsection
