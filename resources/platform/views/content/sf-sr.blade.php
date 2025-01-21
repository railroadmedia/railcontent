@extends('partials.layout')

@section('meta')
    <title>{{ ucfirst($brand) }} {{ ucfirst($pageData['name']) }} | Musora</title>
@endsection

@section('content')
    <sfsr
        :page-data="{{ json_encode($pageData) }}"
    ></sfsr>
@endsection
