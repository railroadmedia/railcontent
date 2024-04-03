@extends('partials.layout')

@section('meta')
    <title>My Playlists | Musora</title>
@endsection

@section('content')
    <playlists
        :playlist-count="{{ $playlistsNumber }}"
        :playlists="{{ json_encode($playlists) }}"
        :filter-options="{{ json_encode($filterOptions) }}"
    ></playlists>
@endsection
