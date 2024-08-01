@extends('partials.layout')

@section('meta')
    <title>Cohort Enrollment | Musora</title>
@endsection

@section('content')
    @if($cohort['slug'] == '30-day-double-bass')
        <link rel="stylesheet" href="{{ mix('marketing/css/app.css') }}">
        <link href="{{ asset('/marketing/css/tailwind-helpers.css') }}" rel="stylesheet">
        <link rel="stylesheet" href="{{ asset('/marketing/css/animate.css') }}">
        <link href="{{ asset('/marketing/parcel/drumeo/30dd.css') }}" rel="stylesheet">
        <div class="bg-white text-black">
            @include('drumeo.products._30D-double-bass', [
                'theme' => 'drumeo',
                'platformVersion' => true
            ])

        </div>
    @endif
    @include('partials._railanalytics-brand-tracking-iframe')
@endsection
