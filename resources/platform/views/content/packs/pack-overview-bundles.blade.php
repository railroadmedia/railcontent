@extends('partials.layout')

@section('meta')
    <title>{{ $pack['title'] }} | Musora</title>
@endsection

@php
    $breadcrumbs = [
        [
            "title" => "Packs",
            "url" => url()->route('platform.packs'),
        ],
        [
            "title" => $pack->fetch('fields.title'),
        ]
    ];

    $packType = $pack['type'];

@endphp

@section('content')
    <pack-overview-bundles
        :pack-type="'{{ $packType }}'"
        :breadcrumbs="{{ json_encode($breadcrumbs) }}"
        :xp-bonus="{{ $xpBonus }}"
    ></pack-overview-bundles>
@endsection

@section('layout-scripts')
    <script src="{{ mix('platform/js/vendor~player.js') }}"></script>
    @parent
@endsection
