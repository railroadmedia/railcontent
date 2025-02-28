@extends('partials.layout')

@section('meta')
    <title>{{ ucfirst($brand) }} {{ ucfirst($catalogueMeta['name']) }} | Musora</title>
@endsection

@section('content')
    <songs
        :started-content="{{ $startedLessons }}"
        :list-lessons="{{ $listLessons }}"
        :sort="{{ json_encode($sort) }}"
    >
    </songs>
@endsection
