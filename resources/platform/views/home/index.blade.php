@php
    $isSubscriber = true;
    $page = Request::segment(1);
    $brand = request()->get('brand');
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

                    <home-card-links brand="{{ $brand }}"/>

                </div>

            @endif
            
        </div>
        
    </page-container>
@endsection
