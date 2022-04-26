@if($parentContent->fetch('type') === 'learning-path')
    @include('partials.bladesora.members.navigation.breadcrumbs', [
        "pages" => [
            [
                "title" => 'Home',
                "url" => url()->route('members.home'),
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
                "title" => 'Singeo Method',
                "url" => url()->route('members.learning-paths.show', ['singeo-method', 308514]),
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
                "title" => 'Singeo Method',
                "url" => url()->route('members.learning-paths.show', ['singeo-method', 308514]),
            ],
            [
                "title" => $parentLevel->fetch('fields.title'),
                "url" => $parentLevel->fetch('url'),
            ],
            [
                "title" => $parentContent->fetch('fields.title'),
            ]
        ]
    ])
@elseif($parentContent->fetch('type') === 'unit')
    @include('partials.bladesora.members.navigation.breadcrumbs', [
        "pages" => [
            [
                "title" => 'Home',
                "url" => url()->route('members.home'),
            ],
            [
                "title" => 'Learning Paths',
                "url" => url()->route('members.learning-paths.index'),
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
@else
    @include('partials.bladesora.members.navigation.breadcrumbs', [
        "pages" => [
            [
                "title" => 'Home',
                "url" => url()->route('members.home'),
            ],
            [
                "title" => parse_lesson_type_readable($parentContent->fetch('type'), true),
                "url" => url()->route('members.catalogues.show', ["contentType" => parse_lesson_type_readable($parentContent->fetch('type'), true)]),
            ],
            [
                "title" => $parentContent->fetch('fields.title'),
            ]
        ]
    ])
@endif