@php
    $isSubscriber = true;
    $page = Request::segment(1);
@endphp

@extends('partials.layout')

@section('meta')
    <title>Home | Musora</title>
@endsection

@section('content')
    <page-container>

        <div v-cloak>
            @if ($isSubscriber)

                <h4><span class="tw-capitalize">{{ $brand }}</span> Homepage</h4>
                <h5>Path: /{{ $page }}</h5>

            @endif
        </div>
        
    </page-container>
@endsection
