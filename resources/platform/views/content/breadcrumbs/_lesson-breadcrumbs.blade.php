@if($lessonType === 'unit-part')
    @include('partials.bladesora.members.navigation.breadcrumbs', [
        "pages" => [
            [
                "title" => 'Home',
                "url" => url()->route('members.home')
            ],
            [
                "title" => 'Learning Paths',
                "url" => url()->route('members.learning-paths.index')
            ],
            [
                "title" => $learningPath->fetch('fields.title'),
                "url" => $learningPath->fetch('url')
            ],
            [
                "title" => $parent->fetch('fields.title'),
                "url" => $parent->fetch('url')
            ],
            [
                "title" => $lessonContent->fetch('fields.title')
            ]
        ]
    ])
@elseif($lessonType === 'learning-path-lesson')
        @include('partials.bladesora.members.navigation.breadcrumbs', [
            "pages" => [
                [
                    "title" => 'Singeo Method',
                    "url" => url()->route('platform.content.first-level', ['method', $firstContent['slug'], $firstContent['id']])
                ],
                [
                    "title" => $parent->fetch('fields.title'),
                    "url" => $parent->fetch('url')
                ],
                [
                    "title" => $lessonContent->fetch('fields.title')
                ]
            ]
        ])
@elseif(!empty($pack))
    @if($pack['slug'] == 'piano-technique-made-easy' || $pack['slug'] == 'de-stupefy-your-left-hand')
        @include('partials.bladesora.members.navigation.breadcrumbs', [
            "pages" => [
                [
                    "title" => 'Home',
                    "url" => url()->route('members.home'),
                ],
                [
                    "title" => "Packs",
                    "url" => url()->route('members.packs.index'),
                ],
                [
                    "title" => $pack->fetch('fields.title'),
                    "url" => $pack['url'],
                ],
                [
                    "title" => $parent->fetch('fields.title'),
                    "url" => $parent['url'],
                ],
                [
                    "title" => $lessonContent->fetch('fields.title')
                ]
            ]
        ])
    @endif
@else
    @if($parent)
        @if($parent->fetch('type') === 'pack-bundle')
            @include('partials.bladesora.members.navigation.breadcrumbs', [
                "pages" => [
                    [
                        "title" => 'Home',
                        "url" => url()->route('members.home')
                    ],
                    [
                        "title" => "Packs",
                        "url" => url()->route('members.packs.index'),
                    ],
                    [
                        "title" => $pack->fetch('fields.title'),
                        "url" => url()->route('members.packs.show', [
                            "packSlug" => $pack->fetch('slug')
                        ]),
                    ],
                    [
                        "title" => $lessonContent->fetch('fields.title')
                    ]
                ]
            ])
        @else
            @include('partials.bladesora.members.navigation.breadcrumbs', [
                "pages" => [
                    [
                        "title" => 'Home',
                        "url" => url()->route('members.home')
                    ],
                    [
                        "title" => parse_lesson_type_readable($parent->fetch('type'), true),
                        "url" => url()->route("members.catalogues.show", ["contentType" => parse_lesson_type_readable($parent->fetch('type'), true)]),
                    ],
                    [
                        "title" => $parent->fetch('fields.title'),
                        "url" => $parent->fetch('url'),
                    ],
                    [
                        "title" => $lessonContent->fetch('fields.title')
                    ]
                ]
            ])
        @endif
    @else
        @include('partials.bladesora.members.navigation.breadcrumbs', [
            "pages" => [
                [
                    "title" => 'Home',
                    "url" => url()->route('members.home')
                ],
                [
                    "title" => parse_lesson_type_readable($lessonContent->fetch('type'), true),
                    "url" => url()->route("members.catalogues.show", ["contentType" => parse_lesson_type_for_url($lessonContent->fetch('type'))]),
                ],
                [
                    "title" => $lessonContent->fetch('fields.title')
                ]
            ]
        ])
    @endif
@endif
