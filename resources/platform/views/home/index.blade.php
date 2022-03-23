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

        {{-- v-cloak: Wait Until Page Container has loaded --}}
        <div v-cloak>

            @if ($isSubscriber)

                <div class="tw-container tw-mx-auto tw-px-4 dark:tw-text-white">
                    <h4><span class="tw-capitalize">{{ $brand }}</span> Homepage</h4>
                    <h5>Path: /{{ $page }}</h5>
                </div>

            @endif
            
        </div>
        
    </page-container>
@endsection
