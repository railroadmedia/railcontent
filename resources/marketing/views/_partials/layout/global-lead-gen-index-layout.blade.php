@extends('_partials.layout.global-template')

@section('meta')
    <title>{{ $leadgen->title }}</title>
    <meta property="og:title" content="{{ $leadgen->title }}"/>
    <meta name="description" content="{{ $leadgen->meta_desc }}">
    <meta property="og:description" content="{{ $leadgen->meta_desc }}"/>
    {{--    <meta property="og:url" content="https://www.drumeo.com/drum-fills/"/>--}}
    <meta property="og:image" content="{{ $leadgen->meta_img }}"/>
    <meta name="robots" content="noindex">
@stop

@section('layout-styles')

@endsection
