@extends('partials.layout')

@section('meta')
    <title>Playlists | Musora</title>
@endsection

@section('content')

    <p class="tw-font-bold dark:tw-text-white"> Playlist Data: <br> {{ json_encode($playlist) }}</p>
    <p class="tw-font-bold dark:tw-text-white"> Has Access: {{ $playlist['has_access'] ?? false }}</p>
    <p class="tw-font-bold tw-text-white"> Lessons Data: <br>{{ $listLessons }}</p>

@endsection
