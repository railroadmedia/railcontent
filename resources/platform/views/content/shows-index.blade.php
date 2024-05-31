@extends('partials.layout')

@section('meta')
    <title>Shows | Drumeo</title>
@endsection

@section('content')
    <shows :shows='@json($shows)'></shows>
@endsection
