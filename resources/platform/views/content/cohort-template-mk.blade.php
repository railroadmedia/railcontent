@extends('partials.layout')

@section('meta')
    <title>Cohort Enrollment | Musora</title>
@endsection

@section('content')
    @if($cohort['slug'] == '30-day-double-bass')
        @include('marketing.drumeo.products.30-day-double-bass', [
            'platformVersion' => true
        ])
    @endif
    @include('partials._railanalytics-brand-tracking-iframe')
@endsection
