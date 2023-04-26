@extends('partials.layout')

@section('meta')
    <title>Playlists | Musora</title>
@endsection

@section('content')

    {{-- Playlist Header --}}
    <playlist-header
        :playlist="{{ json_encode($playlist) }}"
        :has-access="{{$playlist['has_access'] ?? 0}}"
        :lessons="{{ $listLessons }}"
        brand="{{ $brand }}"
    /></playlist-header>

    {{-- Playlist Catalog --}}


@endsection
