@extends('partials.layout')

@section('meta')
    <title>Playlists | Musora</title>
@endsection

@section('content')

    <p class="tw-font-bold tw-text-white">{{ json_encode($playlist) }}</p>
    <p class="tw-font-bold tw-text-white">{{$playlist['has_access'] ?? 0}}</p>
    <p class="tw-font-bold tw-text-white">{{ $listLessons }}</p>

@endsection
