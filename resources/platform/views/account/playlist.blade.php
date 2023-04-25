@extends('partials.layout')

@section('meta')
    <title>Playlists | Musora</title>
@endsection

@section('content')

    {{-- Playlist Header --}}
    <playlist-header
        :playlist="{{ json_encode($playlist) }}"
        :has-access="false"
        :lessons="{{ $listLessons }}"
        brand="{{ $brand }}"
    /></playlist-header>

    {{-- Playlist Catalog --}}
    <playlist-catalog
        :has-access="false"
        :is-my-playlist="{{$playlist['is_my_playlist']}}"
        :lessons="{{ $listLessons }}"
        brand="{{ $brand }}"
    ></playlist-catalog>

@endsection
