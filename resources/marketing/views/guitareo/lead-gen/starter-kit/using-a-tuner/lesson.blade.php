@extends('guitareo.lead-gen.starter-kit.starter-kit-layout')

@section('head-includes')
    <title>Using An Electronic Tuner</title>
@endsection

@section('body-content')
    @include('guitareo.lead-gen.starter-kit.partials._header')

    @section('title')
        Using An Electronic Tuner
    @endsection

    @section('video')
        <iframe src="https://player.vimeo.com/video/168467651" frameborder="0" allowfullscreen></iframe>
    @endsection

    @include('guitareo.lead-gen.partials.lesson-page1')
@endsection