@extends('partials.layout')

@section('meta')
    <title>All latest threads | Forums | {{ $brand }}</title>
@endsection


@section('content')
    <latest-forums :threads="{{ json_encode($threads) }}" :thread-count="{{ $threadCount }}"
        show-categories-url="{{ url()->route('forums.show-categories') }}"
        show-create-thread-form-url="{{ url()->route('forums.show-create-thread-form') }}"></latest-forums>
@endsection
