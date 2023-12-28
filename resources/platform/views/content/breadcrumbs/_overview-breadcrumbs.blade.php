@if($parentContent->fetch('type') === 'learning-path')
    @include('partials.bladesora.members.navigation.breadcrumbs', [
        "pages" => [
            [
                "title" => $parentContent->fetch('fields.title'),
            ]
        ]
    ])
@elseif($parentContent->fetch('type') === 'learning-path-level')
    @include('partials.bladesora.members.navigation.breadcrumbs', [
        "pages" => [
            [
                "title" => ucwords(brand()) . ' Method',
                "url" => url()->route('platform.content.first-level', [$primaryPage, $firstSlug, $firstId]),
            ],
            [
                "title" => $parentContent->fetch('fields.title'),
            ]
        ]
    ])
@elseif($parentContent->fetch('type') === 'learning-path-course')
    @include('partials.bladesora.members.navigation.breadcrumbs', [
        "pages" => [
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
        ]
    ])
@elseif($parentContent->fetch('type') === 'unit')
    @include('partials.bladesora.members.navigation.breadcrumbs', [
        "pages" => [
            [
                "title" => $learningPath->fetch('fields.title'),
                "url" => $learningPath->fetch('url'),
            ],
            [
                "title" => $parentContent->fetch('fields.title'),
            ]
        ]
    ])
@elseif($parentContent->fetch('type') === 'challenge')
    @include('partials.bladesora.members.navigation.breadcrumbs', [
        "pages" => [
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
        ]
    ])
@elseif($parentContent->fetch('type') === 'pack-bundle')
    @if($pack->fetch('bundle_count') > 1)
        @include('partials.bladesora.members.navigation.breadcrumbs', [
            "pages" => [
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
            ]
        ])
    @elseif($pack->fetch('bundle_count') <= 1)
        @include('partials.bladesora.members.navigation.breadcrumbs', [
            "pages" => [
                [
                    "title" => "Packs",
                    "url" => url()->route('platform.packs'),
                ],
                [
                    "title" => $pack->fetch('fields.title')
                ]
            ]
        ])
    @endif
@else
    @include('partials.bladesora.members.navigation.breadcrumbs', [
        "pages" => [
            [
                "title" => parse_lesson_type_readable($parentContent->fetch('type'), true),
                "url" => url()->route('platform.content-type-catalog', ["contentTypeName" => parse_lesson_type_readable($parentContent->fetch('type'), true)]),
            ],
            [
                "title" => $parentContent->fetch('fields.title'),
            ]
        ]
    ])
@endif
