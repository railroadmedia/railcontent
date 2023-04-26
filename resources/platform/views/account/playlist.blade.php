@extends('partials.layout')

@section('meta')
    <title>Playlists | Musora</title>
@endsection

@section('content')

    <p class="tw-font-bold dark:tw-text-white"> Playlist Data: <br> {{ json_encode($playlist) }}</p>
    <p class="tw-font-bold dark:tw-text-white"> Has Access: <br> {{$playlist['has_access'] ?? 0}}</p>
    <p class="tw-font-bold tw-text-white"> Lessons Data: <br>{{ $listLessons }}</p>

@endsection
