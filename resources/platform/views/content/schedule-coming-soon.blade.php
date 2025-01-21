@extends('partials.layout')

@section('meta')
    <title>{{ ucfirst($brand) }} Coming Soon Content Updates | Musora</title>
@endsection

@section('content')
    <coming-soon-content-updates :coming-soon="{{ $comingSoon }}"></coming-soon-content-updates>
@endsection
