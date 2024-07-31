@extends('partials.layout')

@section('meta')
    <title> {{ ucfirst($brand) }} Artists | Musora</title>
@endsection

@section('content')
    <artists
        :artists="{{ json_encode($artists) }}"
    >
    </artists>
@endsection
