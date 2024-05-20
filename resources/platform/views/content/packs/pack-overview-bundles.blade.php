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
                'faIconClass' => 'fa-play'
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

@endphp

@section('content')
    <div class="tw-w-full tw-mx-auto 3xl:tw-max-w-screen-3xl 4xl:tw-max-w-screen-4xl tw-px-4 md:tw-px-8">
        @include('partials.bladesora.members.navigation.breadcrumbs', [
            "pages" => [
                [
                    "title" => "Packs",
                    "url" => url()->route('platform.packs'),
                ],
                [
                    "title" => $pack->fetch('fields.title'),
                ]
            ]
        ])
        <page-header
            page-type="{{ $parentContent->fetch('type') }}"
            title="Packs"
            hero-img="{{ $pack->fetch('data.header_image_url') }}"
            dark-mode-logo="{{ $pack->fetch('data.dark_mode_logo_url') }}"
            light-mode-logo="{{ $pack->fetch('data.light_mode_logo_url') }}"
            :info-data="{{ json_encode($infoDataStrArr) }}"
            :ctas="{{ $ctasJson }}"
        >
        </page-header>

        @if(!empty($pack->fetch('*fields.instructor')) || !empty($pack->fetch('data.description')))
            <content-info
                :instructors="{{ json_encode($pack->fetch('*fields.instructor')) }}"
                :content-description="{{ json_encode($pack->fetch('data.description', null)) }}"
            ></content-info>
        @endif
    </div>

    <div class="tw-w-full tw-mx-auto 3xl:tw-max-w-screen-3xl 4xl:tw-max-w-screen-4xl tw-px-4 md:tw-px-8">
        <div class="tw-flex tw-flex-col">

            <div class="tw-flex tw-flex-row pv-3">
                <h1 class="tw-text-[30px] tw-font-bold dark:tw-text-white tw-capitalize">{{ $pack->fetch('fields.title') }}</h1>
            </div>

            <div class="tw-flex tw-flex-row tw-border-b tw-border-[#D4D4D8] dark:tw-border-[#223F57] tw-pb-[30px]">
                <content-catalogue
                    brand="{{ $brand }}"
                    catalogue-type="grid"
                    theme-color="{{ $brand }}"
                    :pre-loaded-content="{{ $childContent }}"
                    user-id="{{ auth()->id() }}"
                    :full-width-on-mobile="true"
                ></content-catalogue>
            </div>

            @if($xpBonus > 0)
                @include('partials.bladesora.members.partials._completion-bonus', [
                    "xpBonus" => $xpBonus,
                    "isComplete" => $parentContent->fetch('progress_percent', 0) === 100,
                    "themeColor" => '{{ $brand }}'
                ])
            @endif
        </div>
    </div>

@endsection

@section('layout-scripts')
    <script src="{{ mix('platform/js/vendor~player.js') }}"></script>
    @parent
@endsection
