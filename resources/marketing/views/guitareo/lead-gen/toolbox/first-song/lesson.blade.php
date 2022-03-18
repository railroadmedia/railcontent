@extends('guitareo.lead-gen.starter-kit.starter-kit-layout')

@section('head-includes')
    <title>Playing Your First Song</title>
@endsection

@section('body-content')
    @include('guitareo.lead-gen.toolbox._header')

    @include('guitareo.lead-gen.partials.lesson-page1')

    @include('guitareo.lead-gen.toolbox.first-song._lesson-grid')
@endsection