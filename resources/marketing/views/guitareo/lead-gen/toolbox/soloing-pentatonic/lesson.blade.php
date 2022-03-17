@extends('guitareo.lead-gen.starter-kit.starter-kit-layout')

@section('head-includes')
    <title>Soloing With Minor Pentatonic Scales</title>
@endsection

@section('body-content')
    @include('guitareo.lead-gen.toolbox._header')

    @include('guitareo.lead-gen.partials.lesson-page1')

    @include('guitareo.lead-gen.toolbox.soloing-pentatonic._lesson-grid')
@endsection