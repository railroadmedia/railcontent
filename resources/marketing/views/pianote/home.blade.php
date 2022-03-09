<!DOCTYPE html>
@extends('_partials.layout.public-layout')

@section('head-includes')
    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&family=Open+Sans:wght@400;600;700;800&display=swap" rel="stylesheet">
    <!-- Icons -->
    <script src="https://kit.fontawesome.com/cf2f4c6c71.js" crossorigin="anonymous"></script>
    <link href="https://d1prhhmg8i11jr.cloudfront.net/v1.0.3/dist/icons.css" rel="stylesheet">
@stop

<!-- Header -->
@section('layout-header')
    @include('_partials.layout.public-header', [
        "brand" => "pianote",
        "logo" => "https://musora-ui.s3.amazonaws.com/logos/pianote.svg"
    ])
@stop

<!-- Main -->
@section('layout-body')
    


@stop

<!-- Footer -->
@section('layout-footer')
    @include('_partials.layout.public-footer', [
        "brand" => "pianote",
        "logo" => "https://musora-ui.s3.amazonaws.com/logos/pianote-white.svg",
    ])
@stop