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
    <playlist :playlist="{{ json_encode($playlist) }}" :lessons="{{ $listLessons }}" />
@endsection
