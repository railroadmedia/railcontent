@extends('partials.layout')

@section('meta')
    <title>Cohort Enrollment | Musora</title>
@endsection

@section('content')
    <cohort
        :cohort="{{ json_encode($cohort) }}"
        :register-url="{{ json_encode($registerButtonUrl) }}"
        :n-pack-owners="{{ json_encode(number_format($nPackOwners ?? 0)) }}"
        :dropdowns="{{ json_encode($cohort->dropdowns) }}"
    ></cohort>

    @include('partials._railanalytics-brand-tracking-iframe')
@endsection
