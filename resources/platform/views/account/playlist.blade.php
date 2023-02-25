@extends('partials.layout')

@section('meta')
    <title>Playlists | Musora</title>
@endsection

@section('content')

    {{-- Playlist Header --}}
    <playlist-header
        :playlist="{{ json_encode($playlist) }}"
        :lessons="{{ $listLessons }}"
        brand="{{ $brand }}"
    /></playlist-header>

    <div class="tw-container tw-mx-auto tw-px-4 md:tw-px-8 dark:tw-text-white tw-pb-14">
        <div class="tw-flex tw-flex-col">
            <div class="tw-flex tw-flex-row">

                <playlist-catalog
                    :lessons="{{ $listLessons }}"
                    brand="{{ $brand }}"
                ></playlist-catalog>

            </div>
        </div>
    </div>

@endsection
