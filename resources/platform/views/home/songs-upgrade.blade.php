@php
$currentTier = json_decode('plus');
$upgradeCost = json_decode(null);
$isLifetime = json_decode(true);
@endphp

@extends('partials.layout')

@section('meta')
    <title>Membership Change | Musora</title>
@endsection

@section('content')
    <div class="tw-container tw-mx-auto tw-px-4 md:tw-px-8 dark:tw-text-white">
        <membership-update-page
            :current-tier="{{ json_encode($currentTier) }}"
            :upgrade-cost="{{ json_encode($upgradeCost) }}"
            :is-lifetime-member="{{ json_encode(boolval($isLifetime)) }}"
        ></membership-update-page>
    </div>

    @include('partials._railanalytics-brand-tracking-iframe')
@endsection
