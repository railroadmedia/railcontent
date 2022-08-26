@if($parentContent->fetch('type') === 'learning-path')
    @include('partials.bladesora.members.navigation.breadcrumbs', [
        "pages" => [
            [
                "title" => 'Home',
                "url" => url()->route('platform.home', ['brand' => brand()]),
            ],
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
                "title" => 'Home',
                "url" => url()->route('platform.home'),
            ],
            [
                "title" => $learningPath->fetch('fields.title'),
                "url" => $learningPath->fetch('url'),
            ],
            [
                "title" => $parentContent->fetch('fields.title'),
            ]
        ]
    ])
@elseif($parentContent->fetch('type') === 'pack-bundle')
    @include('partials.bladesora.members.navigation.breadcrumbs', [
        "pages" => [
            [
                "title" => 'Home',
                "url" => url()->route('platform.home'),
            ],
            [
                "title" => 'Packs',
                "url" => url()->route('platform.packs'),
            ],
            [
                "title" => $pack->fetch('fields.title'),
                "url" => $pack->fetch('url'),
            ],
            [
                "title" => $parentContent->fetch('fields.title'),
            ]
        ]
    ])
@else
    @include('partials.bladesora.members.navigation.breadcrumbs', [
        "pages" => [
            [
                "title" => 'Home',
                "url" => url()->route('platform.home'),
            ],
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
