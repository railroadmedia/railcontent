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
                'url' => $nextLessonUrl,
                'faIconClass' => 'fa-play',
                'isPrimary' => true,
            ]
        ],
        [
            'type' => 'ResetProgressCta',
            'props' => [
                'contentId' => $parentContent->fetch('id'),
                'progress' => $parentContent->fetch('progress_percent', 0),
            ]
        ],
        [
            'type' => 'DownloadResourcesCta',
            'props' => [
                'resources' => $pack['resources'] ?? []
            ]
        ]
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
        @include('content.breadcrumbs._overview-breadcrumbs')
        <page-header
            page-type="{{ $parentContent->fetch('type') }}"
            title="Pack"
            hero-img="{{ $pack->fetch('data.header_image_url') }}"
            dark-mode-logo="{{ $pack->fetch('data.dark_mode_logo_url') }}"
            light-mode-logo="{{ $pack->fetch('data.light_mode_logo_url') }}"
            progress="{{ $parentContent->fetch('progress_percent', 0) }}"
            :info-data="{{ json_encode($infoDataStrArr) }}"
            :ctas="{{ $ctasJson }}"
            description="{{ $pack->fetch('data.description', null) }}"
        >
        </page-header>
    </div>
    <div class="tw-w-full tw-mx-auto 3xl:tw-max-w-screen-3xl 4xl:tw-max-w-screen-4xl tw-px-4 md:tw-px-8 tw-my-4">
        <div class="tw-flex tw-flex-col">
            <div class="tw-flex tw-flex-row">
                <content-catalogue
                    brand="{{ $brand }}"
                    catalogue-type="list"
                    theme-color="{{ $brand }}"
                    :use-theme-color="true"
                    :pre-loaded-content="{{ $childContent }}"
                    :show-numbers="true"
                    user-id="{{ auth()->id() }}"
                    :is-admin="{{ json_encode(user()->isAdmin()) }}"
                >
                @for($i = 0; $i < 10; $i++)
                    @include('partials.bladesora.members.skeletons.list-item', [
                        "overview" => false,
                        "showNumbers" => true,
                        "thumbnailType" => false
                    ])
                @endfor
                </content-catalogue>
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
