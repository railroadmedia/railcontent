@extends('partials.layout')
@php
    //dd($playlist['name']);
    //dd(get_defined_vars()['__data']);
    //dd($brand . '/playlists')
@endphp
@section('meta')
    <title>Playlists | Musora</title>
@endsection

@section('content')
    {{-- Playlist Breadcrumb --}}
    <playlist-breadcrumb
        brand="{{ $brand }}"
        first-level-url="/{{ $brand }}/playlists" 
        first-level-title="Playlists"
        last-level-title="{{ $playlist['name'] }}"
    >
    </playlist-breadcrumb>

    {{-- Playlist Header --}}
    <playlist-header
        :playlist="{{ json_encode($playlist) }}"
        :has-access="{{$playlist['has_access'] ?? 0}}"
        :lessons="{{ $listLessons }}"
        brand="{{ $brand }}"
    /></playlist-header>

    {{-- Playlist Catalog --}}
    <playlist-catalog
        :has-access="{{$playlist['has_access'] ?? 0}}"
        :is-my-playlist="{{$playlist['is_my_playlist'] ?? 0}}"
        :lessons="{{ $listLessons }}"
        brand="{{ $brand }}"
    ></playlist-catalog>

@endsection
