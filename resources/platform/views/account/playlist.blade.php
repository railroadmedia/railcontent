@extends('partials.layout')

@section('meta')
    <title>Playlists | Musora</title>
@endsection

@section('content')

    {{-- Playlist Header --}}

    {{-- Playlist Catalog --}}
    <playlist-catalog
        :has-access="{{$playlist['has_access'] ?? 0}}"
        :is-my-playlist="{{$playlist['is_my_playlist'] ?? 0}}"
        :lessons="{{ $listLessons }}"
        brand="{{ $brand }}"
    ></playlist-catalog>

@endsection
