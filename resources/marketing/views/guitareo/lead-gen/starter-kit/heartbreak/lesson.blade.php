@extends('guitareo.lead-gen.starter-kit.starter-kit-layout')

@section('head-includes')
    <title>Heartbreak Avenue</title>
@endsection

@section('body-content')
    @include('guitareo.lead-gen.starter-kit.partials._header')

    @include('guitareo.lead-gen.partials.lesson-page1')

    @include('guitareo.lead-gen.starter-kit.heartbreak._lesson-grid')
@endsection