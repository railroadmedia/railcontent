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
                    brand="{{ $brand }}"
                    :playlists="{{ json_encode($playlists) }}"
                    :playlist-count="{{ $playlistsNumber }}"
                    {{-- :search-term="{{ $searchTerm }}" --}}
                ></playlist-collection-catalog>

            </div>
        </div>
    </div>

@endsection
