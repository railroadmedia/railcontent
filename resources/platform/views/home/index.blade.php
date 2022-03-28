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

                    {{-- Carousel --}}
                    
                    
                    {{-- Home Cards --}}
                    <home-card-links brand="{{ $brand }}"/>

                    {{-- Continue Section --}}

                    {{-- New Section --}}

                    {{-- Popular Conversations --}}

                    {{-- From Subscribed Coaches --}}

                    {{-- Subscribed Coaches --}}

                    {{-- My Playlists --}}

                    {{-- Live Section --}}

                    {{-- My Stats --}}

                </div>

            @endif
            
        </div>
        
    </page-container>
@endsection
