@extends('partials.layout')

@section('meta')
    <title>{{ $pack->fetch('fields.title') }} | Musora</title>
@endsection

@php
    $ctas = [
        [
            'type' => 'PageHeaderPrimaryCta',
            'props' => [
                'text' => $pack->fetch('primary_cta_text'),
                'url' => $pack->fetch('primary_cta_url'),
                'faIconClass' => 'fa-play',
                'isPrimary' => true,
            ]
        ],

    ];

    $ctasJson = json_encode($ctas);

    $infoDataStrArr = [];
    if (isset($infoData['lessons']) && isset($infoData['xp'])) {
        $infoDataStrArr = [
            $infoData['lessons'] . ' Lessons',
            $infoData['xp'] . ' XP'
        ];
    }

    $breadcrumbs = [
        [
            "title" => "Packs",
            "url" => url()->route('platform.packs'),
        ],
        [
            "title" => $pack->fetch('fields.title'),
        ]
    ];

@endphp

@section('content')
    <pack-overview-bundles
        :breadcrumbs="{{ json_encode($breadcrumbs) }}"
        @if(isset($breadcrumbClassOverride) && $breadcrumbClassOverride !== '')
            :breadcrumb-class-override="{{ json_encode($breadcrumbClassOverride) }}"
        @endif
        :pack="{{ json_encode($pack) }}"
        :header-pack="{{ json_encode($pack) }}"
        :header-info-data="{{ json_encode($infoDataStrArr) }}"
        :header-ctas="{{ $ctasJson }}"
        header-page-type="{{ $parentContent->fetch('type') }}"
        :child-content="{{ $childContent }}"
        :xp-bonus="{{ $xpBonus }}"
    ></pack-overview-bundles>
@endsection

@section('layout-scripts')
    <script src="{{ mix('platform/js/vendor~player.js') }}"></script>
    @parent
@endsection
