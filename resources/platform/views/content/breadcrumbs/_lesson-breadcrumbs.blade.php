@if($lessonType === 'unit-part')
    @include('partials.bladesora.members.navigation.breadcrumbs', [
        "pages" => [
            [
                "title" => 'Home',
                "url" => url()->route('platform.home')
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
                    "title" => $brand.' Method',
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
                    "url" => url()->route('platform.home'),
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
    @if(isset($parent))
        @if($parent->fetch('type') === 'pack-bundle')
            @include('partials.bladesora.members.navigation.breadcrumbs', [
                "pages" => [
                    [
                        "title" => 'Home',
                        "url" => url()->route('platform.home')
                    ],
                    [
                        "title" => "Packs",
                        "url" => url()->route('platform.packs'),
                    ],
                    [
                        "title" => $pack->fetch('fields.title'),
                        "url" => url()->route('platform.packs.first-level', [
                            "packSlug" => $pack->fetch('slug'),
                            "packId" => $pack->fetch('id'),
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
                        "url" => url()->route('platform.home')
                    ],
                    [
                        "title" => parse_lesson_type_readable($parent->fetch('type'), true),
                        "url" => url()->route("platform.content-type-catalog", ["contentTypeName" => array_flip(\App\Maps\PrimaryURLSlugToContentTypeMap::$map)[$parent->fetch('type')]]),
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
                    "url" => url()->route('platform.home')
                ],
                    [
                        "title" => parse_lesson_type_readable($lessonContent->fetch('type'), true),
                        "url" => url()->route("platform.content-type-catalog", ["contentTypeName" => array_flip(\App\Maps\PrimaryURLSlugToContentTypeMap::$map)[$lessonContent->fetch('type')]]),
                    ],
                [
                    "title" => $lessonContent->fetch('fields.title')
                ]
            ]
        ])
    @endif
@endif
