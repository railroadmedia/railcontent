@extends('partials.layout')

@section('meta')
    <title>Cohort Enrollment | Musora</title>
@endsection

@section('content')
    @if(!empty($singHarmony))
        <h1>Hello World</h1>
    @endif
    @include('partials._railanalytics-brand-tracking-iframe')
@endsection
