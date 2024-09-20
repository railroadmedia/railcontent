@extends('partials.layout')

@section('meta')
    <title>{{ ucfirst($brand) }} All Content Updates | Musora</title>
@endsection

@section('content')
    <all-content-updates
        :returning="{{ $returning }}"
        :leaving="{{ $leaving }}"
        :coming-soon="{{ $comingSoon }}"
        month="{{ $month }}"
    ></all-content-updates>
@endsection
