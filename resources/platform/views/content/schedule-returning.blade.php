@extends('partials.layout')

@section('meta')
    <title>{{ ucfirst($brand) }} Returning Content Updates | Musora</title>
@endsection

@section('content')
    <returning-content-updates :returning="{{ $returning }}"></returning-content-updates>
@endsection
