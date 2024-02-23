@extends('partials.layout')

@section('meta')
    <title>{{ $pack->fetch('fields.title') }} | Musora</title>
@endsection

@php
    $ctas = [
        [
            'type' => 'primary',
            'props' => [
                'text' => $pack->fetch('primary_cta_text'),
                'url' => $nextLessonUrl,
                'icon' => 'fa-play'
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
        <div v-cloak>

        {{-- @if($pack['slug'] == 'piano-technique-made-easy' || $pack['slug'] == 'de-stupefy-your-left-hand')
            @include('partials.bladesora.members.navigation.breadcrumbs', [
                "pages" => [
                    [
                        "title" => "Packs",
                        "url" => url()->route('platform.packs'),
                    ],
                    [
                        "title" => $pack->fetch('fields.title'),
                        "url" => $pack['url'],
                    ],
                    [
                        "title" => $parentContent->fetch('fields.title'),
                    ],
                ]
            ])

        @else
            @include('partials.bladesora.members.navigation.breadcrumbs', [
                "pages" => [
                    [
                        "title" => "Packs",
                        "url" => url()->route('platform.packs'),
                    ],
                    [
                        "title" => $pack->fetch('fields.title'),
                    ],
                ]
            ])
        @endif --}}

        {{-- @component('partials._header-banner', [
            'backgroundImage' => $pack->fetch('data.header_image_url'),
            'hideUser' => true,
        ])
            @slot('content')
                <div class="tw-flex tw-flex-col pr-1 tw-justify-end tw-items-center tw-w-full tw-min-h-[312px]">
                    <img alt="{{ $pack->fetch('title') }} Logo"
                        class="tw-w-full tw-transition-opacity tw-max-w-[300px] tw-opacity-0"
                        src="{{ $pack->fetch('data.logo_image_url') }}"
                        onload="this.classList.remove('tw-opacity-0')"
                    >
                </div>
            @endslot
        @endcomponent

        @include('partials.bladesora.members.content.content-info-subheader', [
            "brand" => '{{ $brand }}',
            "infoData" => $infoData,
            "contentId" => $parentContent->fetch('id'),
            "contentType" => $parentContent->fetch('type'),
            "resetProgress" => $parentContent->fetch('progress_state', false) !== false,
            "instructorInfo" => false,
            "addToList" => !in_array($parentContent->fetch('type'), ['learning-path', 'pack-bundle']),
            "downloadableResources" => $pack['resources'] ?? [],
            "isAdded" => $parentContent->fetch('is_added_to_primary_playlist')
        ]) --}}

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
        >
        </page-header>

        <div class="tw-container tw-mx-auto tw-px-4 md:tw-px-8 mv-3">
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

        </div>
@endsection
