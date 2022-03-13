<header class="flex-none z-40">  

    <!-- Nav -->
    @include('_partials.layout._top-nav', [
        "logo" => $logo,
        "theme_bg" => $theme_bg,
    ])

    <!-- Sidebar -->
    @include('_partials.layout._sidebar', [
        "theme_text" => $theme_text,
        "links" => [
            "Member Login" => [
                "iconClass" => "fas fa-sign-in",
                "url" => "/member",
            ],
            "Contact" => [
                "iconClass" => "fas fa-phone",
                "url" => '/contact',
            ],
            "Drumeo" => [
                "iconClass" => "icon-courses",
                "url" => '/',
            ],
            "Drum Shop" => [
                "iconClass" => "fas fa-tag",
                "children" => [
                    "All Products" => [
                        "url" => '/drumshop',
                    ],
                    "Best Beginner Drum Book" => [
                        "url" => '/drumshop/beginner-book',
                    ],
                    "P4 Practice Pad" => [
                        "url" => '/drumshop/practice-pad-full',
                    ],
                    "Video Drum Lessons" => [
                        "url" => '/lessons/',
                    ],
                    "Clothing & Merchandise" => [
                        "url" => '/clothing/',
                    ],
                ],
            ],
            "Free Resources" => [
                "iconClass" => "fas fa-play-circle",
                "children" => [
                    "Getting Started On The Drums"=> [
                        "url" => "/getting-started/",
                    ],
                    "40 Drum Rudiments"=> [
                        "url" => "/beat/rudiments/",
                    ],
                    "The Drumeo Podcast"=> [
                        "url" => "/beat/podcasts/",
                    ],
                    "Free Video Drum Lessons"=> [
                        "url" => "/beat/videos/",
                    ],
                    "Free Articles For Drummers"=> [
                        "url" => "/beat/articles/",
                    ],
                    "How To Play Drums"=> [
                        "url" => "/beat/how-to-play-drums/",
                    ],
                ],
            ],
        ]
    ])

</header>
