@extends('partials.layout')

@section('meta')
    <title>My Playlist | Musora</title>
@endsection

@section('content')
    <playlists
        :playlist-count="{{ $playlistsNumber }}"
        :playlists="{{ json_encode($playlists) }}"
    ></playlists>
@endsection
