@extends('partials.layout')

@section('meta')
    <title>{{ ucfirst($brand) }} Leaving Content Updates | Musora</title>
@endsection

@section('content')
    <leaving-content-updates :leaving="{{ $leaving }}"></leaving-content-updates>
@endsection
