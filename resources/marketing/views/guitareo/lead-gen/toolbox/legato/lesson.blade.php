@extends('guitareo.lead-gen.starter-kit.starter-kit-layout')

@section('head-includes')
    <title>Exploring Guitar Rhythms</title>
@endsection

@section('body-content')
    @include('guitareo.lead-gen.toolbox._header')

    @include('guitareo.lead-gen.partials.lesson-page1')

    @include('guitareo.lead-gen.toolbox.legato._lesson-grid')
@endsection