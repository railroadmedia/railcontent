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

    $breadcrumbs = [];
    if($parentContent->fetch('type') === 'learning-path'){
        $breadcrumbs = [
            [
                "title" => $parentContent->fetch('fields.title'),
            ]
        ];
    } elseif($parentContent->fetch('type') === 'learning-path-level'){
        $breadcrumbs = [
            [
                "title" => ucwords(brand()) . ' Method',
                "url" => url()->route('platform.content.first-level', [$primaryPage, $firstSlug, $firstId]),
            ],
            [
                "title" => $parentContent->fetch('fields.title'),
            ]
        ];
    } elseif($parentContent->fetch('type') === 'learning-path-course'){
        $breadcrumbs = [
            [
                "title" => ucwords(brand()) . ' Method',
                "url" => url()->route('platform.content.first-level', [$primaryPage, $firstSlug, $firstId]),
            ],
            [
                "title" => $secondContent->fetch('fields.title'),
                "url" => $secondContent->fetch('url'),
            ],
            [
                "title" => $thirdContent->fetch('fields.title'),
            ]
        ];
    } elseif($parentContent->fetch('type') === 'unit'){
        $breadcrumbs = [
            [
                "title" => $learningPath->fetch('fields.title'),
                "url" => $learningPath->fetch('url'),
            ],
            [
                "title" => $parentContent->fetch('fields.title'),
            ]
        ];
    } elseif($parentContent->fetch('type') === 'challenge'){
        $breadcrumbs = [
            [
                "title" => 'Workouts',
                "url" => url()->route('platform.workouts'),
            ],
            [
                "title" => 'Challenges',
                "url" => url()->route('platform.workouts.challenges'),
            ],
            [
                 "title" => $parentContent->fetch('fields.title'),
            ]
        ];
    } elseif($parentContent->fetch('type') === 'pack-bundle') {
        if($pack->fetch('bundle_count') > 1){
            $breadcrumbs = [
                [
                    "title" => "Packs",
                    "url" => url()->route('platform.packs'),
                ],
                [
                    "title" => $pack->fetch('fields.title'),
                    "url" => $pack->fetch('url'),
                ],
                [
                    "title" => $parentContent->fetch('fields.title')
                ]
            ];
        } elseif($pack->fetch('bundle_count') <= 1){
            $breadcrumbs = [
                [
                    "title" => "Packs",
                    "url" => url()->route('platform.packs'),
                ],
                [
                    "title" => $pack->fetch('fields.title')
                ]
            ];
        }
    } else {
        $breadcrumbs = [
            [
                "title" => parse_lesson_type_readable($parentContent->fetch('type'), true),
                "url" => url()->route('platform.content-type-catalog', ["contentTypeName" => parse_lesson_type_readable($parentContent->fetch('type'), true)]),
            ],
            [
                "title" => $parentContent->fetch('fields.title'),
            ]
        ];
    }

@endphp

@section('content')
    <pack-overview
        :breadcrumbs="{{ json_encode($breadcrumbs) }}"
        header-page-type="{{ json_encode($parentContent->fetch('type')) }}"
        header-progress="{{ $parentContent->fetch('progress_percent', 0) }}"
        :header-info-data="{{ json_encode($infoDataStrArr) }}"
        :header-ctas="{{ $ctasJson }}"
        :pack="{{ json_encode($pack) }}"
        user-id="{{ auth()->id() }}"
        :is-admin="{{ json_encode(user()->isAdmin()) }}"
        :child-content="{{ $childContent }}"
        :xp-bonus="{{ $xpBonus }}"
    ></pack-overview>
@endsection
