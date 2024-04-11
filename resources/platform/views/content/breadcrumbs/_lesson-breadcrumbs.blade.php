@if ($lessonType === 'unit-part')
    @include('partials.bladesora.members.navigation.breadcrumbs', [
        'pages' => [
            [
                'title' => $firstContent->fetch('fields.title'),
                'url' => $firstContent->fetch('url'),
            ],
            [
                'title' => $parent->fetch('fields.title'),
                'url' => $parent->fetch('url'),
            ],
            [
                'title' => $lessonContent->fetch('fields.title'),
            ],
        ],
        'breadcrumbClassOverride' => $breadcrumbClassOverride ?? '',
    ])
@elseif($lessonType === 'challenge-part')
    @include('partials.bladesora.members.navigation.breadcrumbs', [
        'pages' => [
            [
                'title' => 'Workouts',
                'url' => url()->route('platform.workouts'),
            ],
            [
                'title' => 'Challenges',
                'url' => url()->route('platform.workouts.challenges'),
            ],
            [
                'title' => $parent->fetch('fields.title'),
                'url' => $parent->fetch('url'),
            ],
            [
                'title' => $lessonContent->fetch('fields.title'),
            ],
        ],
        'breadcrumbClassOverride' => $breadcrumbClassOverride ?? '',
    ])
@elseif($lessonType === 'learning-path-lesson')
    @include('partials.bladesora.members.navigation.breadcrumbs', [
        'pages' => [
            [
                'title' => $brand . ' Method',
                'url' => url()->route('platform.content.first-level', [
                    'method',
                    $firstContent['slug'],
                    $firstContent['id'],
                ]),
            ],
            [
                'title' => $parent->fetch('fields.title'),
                'url' => $parent->fetch('url'),
            ],
            [
                'title' => $lessonContent->fetch('fields.title'),
            ],
        ],
        'breadcrumbClassOverride' => $breadcrumbClassOverride ?? '',
    ])
@elseif($lessonType === 'coach-stream')
    @include('partials.bladesora.members.navigation.breadcrumbs', [
        'pages' => [
            [
                'title' => 'Coaches',
                'url' => url()->route('platform.coaches'),
            ],
            [
                'title' => !empty($coach->fetch('fields.title'))
                    ? $coach->fetch('fields.title')
                    : $coach->fetch('fields.name'),
                'url' => $coach->fetch('url'),
            ],
            [
                'title' => $lessonContent->fetch('fields.title'),
            ],
        ],
        'breadcrumbClassOverride' => $breadcrumbClassOverride ?? '',
    ])
@elseif(!empty($pack))
    @if ($theme ?? '' === 'made-easy' || $pack->fetch('bundle_count') <= 1)
        @include('partials.bladesora.members.navigation.breadcrumbs', [
            'pages' => [
                [
                    'title' => 'Packs',
                    'url' => url()->route('platform.packs'),
                ],
                [
                    'title' => $pack->fetch('fields.title'),
                    'url' => $pack->fetch('url'),
                ],
                [
                    'title' => $lessonContent->fetch('fields.title'),
                ],
            ],
            'breadcrumbClassOverride' => $breadcrumbClassOverride ?? '',
        ])
    @else
        @include('partials.bladesora.members.navigation.breadcrumbs', [
            'pages' => [
                [
                    'title' => 'Packs',
                    'url' => url()->route('platform.packs'),
                ],
                [
                    'title' => $pack->fetch('fields.title'),
                    'url' => $pack->fetch('url'),
                ],
                [
                    'title' => $parent->fetch('fields.title'),
                    'url' => $parent->fetch('url'),
                ],
                [
                    'title' => $lessonContent->fetch('fields.title'),
                ],
            ],
            'breadcrumbClassOverride' => $breadcrumbClassOverride ?? '',
        ])
    @endif
@else
    @if (isset($parent))
        @if ($parent->fetch('type') === 'pack-bundle')
            @include('partials.bladesora.members.navigation.breadcrumbs', [
                'pages' => [
                    [
                        'title' => 'Packs',
                        'url' => url()->route('platform.packs'),
                    ],
                    [
                        'title' => $pack->fetch('fields.title'),
                        'url' => url()->route('platform.packs.first-level', [
                            'packSlug' => $pack->fetch('slug'),
                            'packId' => $pack->fetch('id'),
                        ]),
                    ],
                    [
                        'title' => $lessonContent->fetch('fields.title'),
                    ],
                ],
                'breadcrumbClassOverride' => $breadcrumbClassOverride ?? '',
            ])
        @else
            @include('partials.bladesora.members.navigation.breadcrumbs', [
                'pages' => [
                    [
                        'title' => parse_lesson_type_readable($parent->fetch('type'), true),
                        'url' => url()->route('platform.content-type-catalog', [
                            'contentTypeName' => array_flip(\App\Maps\PrimaryURLSlugToContentTypeMap::$map)[
                                $parent->fetch('type')
                            ],
                        ]),
                    ],
                    [
                        'title' => $parent->fetch('fields.title'),
                        'url' => $parent->fetch('url'),
                    ],
                    [
                        'title' => $lessonContent->fetch('fields.title'),
                    ],
                ],
                'breadcrumbClassOverride' => $breadcrumbClassOverride ?? '',
            ])
        @endif
    @else
        @include('partials.bladesora.members.navigation.breadcrumbs', [
            'pages' => [
                [
                    'title' => parse_lesson_type_readable($lessonContent->fetch('type'), true),
                    'url' => url()->route('platform.content-type-catalog', [
                        'contentTypeName' => array_flip(\App\Maps\PrimaryURLSlugToContentTypeMap::$map)[
                            $lessonContent->fetch('type')
                        ],
                    ]),
                ],
                [
                    'title' => $lessonContent->fetch('fields.title'),
                ],
            ],
            'breadcrumbClassOverride' => $breadcrumbClassOverride ?? '',
        ])
    @endif
@endif
