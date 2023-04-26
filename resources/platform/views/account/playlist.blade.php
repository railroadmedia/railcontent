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

    {{-- Playlist Catalog --}}
    <playlist-catalog
        :is-my-playlist="{{ $playlist['is_my_playlist'] }}"
        :lessons="{{ $listLessons }}"
        brand="{{ $brand }}"
    ></playlist-catalog>

@endsection
