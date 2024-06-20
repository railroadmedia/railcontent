@extends('partials.layout')

@section('meta')
    <title> {{ ucfirst($brand) }} Search | {{ $searchTerm }} | Musora</title>
@endsection

@section('content')
    <search
        :included-types="{{ $includedTypes }}"
        :pre-loaded-content="{{ $lessons }}"
        total-results="{{ $totalResults }}"
    ></search>
@endsection
