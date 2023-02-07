@extends('partials.layout')

@section('meta')
    <title>Playlists | Musora</title>
@endsection

@section('content')

    {{-- Playlist Header --}}
    <playlist-header
        :playlists="{{ json_encode($playlists) }}"
    /></playlist-header>

    <div class="tw-container tw-mx-auto tw-px-4 md:tw-px-8 dark:tw-text-white tw-pb-14">
        <div class="tw-flex tw-flex-col">
            <div class="tw-flex tw-flex-row">

                {{-- Playlist Catalog --}}
                <playlist-collection-catalog
                    :playlists="{{ json_encode($playlists) }}"
                    token="{{ csrf_token() }}"
                ></playlist-collection-catalog>

            </div>
        </div>
    </div>

@endsection
