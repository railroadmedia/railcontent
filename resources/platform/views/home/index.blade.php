@php
  require_once(resource_path('platform/prototyping_data/test_data.php'))
@endphp

@extends('_partials.layout')

@section('layout-body')
  
  <main id="home-app" class="flex-1">
    <home-app/>
  </main>

@endsection