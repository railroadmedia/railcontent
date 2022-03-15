@extends('_partials.layout.global-layout')

@section('head-includes')
    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&family=Open+Sans:wght@400;600;700;800&display=swap" rel="stylesheet">
    <!-- Icons -->
    <link rel="stylesheet" href="https://dpwjbsxqtam5n.cloudfront.net/fonts/font-awesome-5/fontawesome-all.min.css">
    <link rel="stylesheet" href="https://d1prhhmg8i11jr.cloudfront.net/v1.0.3/dist/icons.css">
    <!-- Favicons -->
    @include('_partials.layout.favicons.drumeo-favicons')
@stop

<!-- Header -->
@section('layout-header')
    @include('_partials.layout.global-header', [
        "theme_bg" => "bg-drumeo",
        "theme_text" => "text-drumeo",
        "logo" => "https://musora-ui.s3.amazonaws.com/logos/drumeo.svg",
        "links" => [
            "Member Login" => [
                "iconClass" => "fas fa-sign-in",
                "url" => "/members",
            ],
            "Contact" => [
                "iconClass" => "fas fa-phone",
                "url" => '/support',
            ],
            "Drumeo" => [
                "iconClass" => "icon-courses",
                "url" => '/',
            ],
            "Drum Shop" => [
                "iconClass" => "fas fa-tag",
                "url" => '/shop',
            ],
            "Free Resources" => [
                "iconClass" => "fas fa-play-circle",
                "children" => [
                    "Drumeo Beat"=> [
                        "url" => "/beat",
                    ],
                    "Getting Started On The Drums"=> [
                        "url" => "/getting-started",
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
                    "40 Free Songs"=> [
                        "url" => "/40-songs",
                    ],
                ],
            ],
        ],
        "external_links" => [
            "Drumeo Kids App" => [
                "iconClass" => "fas fa-fw fa-mobile-alt",
                "url" => '/kids'
            ],
            "YouTube" => [
                "iconClass" => "fab fa-fw fa-youtube",
                "url" => 'https://www.youtube.com/freedrumlessons/'
            ],
            "Facebook" => [
                "iconClass" => "fab fa-fw fa-facebook",
                "url" => 'https://facebook.com/drumeo/'
            ],
            "Instagram" => [
                "iconClass" => "fab fa-fw fa-instagram",
                "url" => 'https://instagram.com/drumeoofficial/'
            ],
            "FAQs" => [
                "iconClass" => "fas fa-fw fa-question",
                "url" => 'https://help.drumeo.com/',
                "target" => '_parent'
            ]
        ]
    ])
@stop

<!-- Global Wrapper -->
@section('global-layout-body') 
    <!-- Brand Specific Content -->
    @yield('layout-body')
@stop

<!-- Footer -->
@section('layout-footer')
    @include('_partials.layout.global-footer', [
        "brand" => "drumeo",
        "logo" => "https://musora-ui.s3.amazonaws.com/logos/drumeo-white.svg",
        "sections" => [
            [
                "title" => "Resources",
                "links" => [
                    [
                        "name" => "Drumeo Beat",
                        "url" => "/",
                    ],
                    [
                        "name" => "Drumeo Podcast",
                        "url" => "/",
                    ],
                    [
                        "name" => "40 Drum Rudiments",
                        "url" => "/",
                    ],
                    [
                        "name" => "How To Play Drums",
                        "url" => "/",
                    ],
                    [
                        "name" => "Free Drum Lessons",
                        "url" => "/",
                    ]
                ]
            ],
            [
                "title" => "Drum Shop",
                "links" => [
                    [
                        "name" => "Drumeo",
                        "url" => "/",
                    ],
                    [
                        "name" => "P4 Practice Pad",
                        "url" => "/",
                    ],
                    [
                        "name" => "Beginner Drum Book",
                        "url" => "/",
                    ],
                    [
                        "name" => "Drumming System",
                        "url" => "/",
                    ],
                    [
                        "name" => "Drumeo Merch",
                        "url" => "/",
                    ]
                ]
            ],
            [
                "title" => "Other Sites",
                "links" => [
                    [
                        "name" => "Musora",
                        "url" => "/",
                    ],
                    [
                        "name" => "Guitareo",
                        "url" => "/",
                    ],
                    [
                        "name" => "Pianote",
                        "url" => "/",
                    ],
                    [
                        "name" => "Singeo",
                        "url" => "/",
                    ],
                    [
                        "name" => "Drumeo Kids",
                        "url" => "/",
                    ],
                ]
            ],
        ]
    ])
@stop