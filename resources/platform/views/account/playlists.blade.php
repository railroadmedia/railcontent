@extends('partials.layout')

@section('meta')
    <title>Playlists | Musora</title>
@endsection

@section('content')   
    {{-- Breadcrumb --}}
    <breadcrumb
        brand="{{ $brand }}"
        last-level-url="/{{ $brand }}/playlists" 
        last-level-title="Playlists"
    >
    </breadcrumb>

    {{-- Playlist Header --}}
    <playlist-collection-header
        brand="{{ $brand }}"
        :playlist-count="{{ $playlistsNumber }}"
    /></playlist-collection-header>

    <div class="tw-container tw-mx-auto tw-px-4 md:tw-px-8 dark:tw-text-white tw-pt-2 tw-pb-14">
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
