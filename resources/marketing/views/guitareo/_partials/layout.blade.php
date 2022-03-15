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
    @include('_partials.layout.favicons.guitareo-favicons')
@stop

<!-- Header -->
@section('layout-header')
    @include('_partials.layout.global-header', [
        "theme_bg" => "bg-guitareo",
        "theme_text" => "text-guitareo",
        "logo" => "https://musora-ui.s3.amazonaws.com/logos/guitareo.svg",
        "links" => [
            "Member Login" => [
                "iconClass" => "fas fa-sign-in",
                "url" => "/members",
            ],
            "Contact" => [
                "iconClass" => "fas fa-phone",
                "url" => '/support',
            ],
            "Guitareo" => [
                "iconClass" => "icon-courses",
                "url" => '/',
            ],
            "Shop" => [
                "iconClass" => "fas fa-tag",
                "url" => '/shop',
            ],
            "The Riff" => [
                "iconClass" => "fas fa-comment-alt-edit",
                "url" => '/riff',
            ],
            "Free Resources" => [
                "iconClass" => "fas fa-play-circle",
                "children" => [
                    "Getting Started On The Acoustic Guitar"=> [
                        "url" => "/free-acoustic-guitar-lessons",
                    ],
                    "Learn to Solo In An Hour"=> [
                        "url" => "/solo-in-an-hour",
                    ],
                    "Fretboard Cheatsheet"=> [
                        "url" => "/fretboard-cheatsheet",
                    ],
                    "Song In An Hour Challenge"=> [
                        "url" => "/song-in-an-hour",
                    ],
                    "2 Simple Guitar Tricks"=> [
                        "url" => "/guitar-tricks",
                    ],
                    "The Guitarist's Toolbox"=> [
                        "url" => "/toolbox",
                    ],
                ],
            ],
        ],
        "external_links" => [
            "YouTube" => [
                "iconClass" => "fab fa-fw fa-youtube",
                "url" => 'https://www.youtube.com/user/guitarlessonscom'
            ],
            "Facebook" => [
                "iconClass" => "fab fa-fw fa-facebook",
                "url" => 'https://www.facebook.com/guitareoofficial'
            ],
            "Instagram" => [
                "iconClass" => "fab fa-fw fa-instagram",
                "url" => 'https://www.instagram.com/guitareoofficial/'
            ],
            "FAQs" => [
                "iconClass" => "fas fa-fw fa-question",
                "url" => 'https://help.guitareo.com/',
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
        "brand" => "guitareo",
        "logo" => "https://musora-ui.s3.amazonaws.com/logos/guitareo-white.svg",
        "sections" => [
            [
                "title" => "Resources",
                "links" => [
                    [
                        "name" => "The Riff",
                        "url" => "/",
                    ],
                    [
                        "name" => "2 Simple Guitar Tricks",
                        "url" => "/",
                    ],
                    [
                        "name" => "Acoustic Jump-Start",
                        "url" => "/",
                    ],
                    [
                        "name" => "Starter Kit",
                        "url" => "/",
                    ],
                    [
                        "name" => "Member Login",
                        "url" => "/",
                    ]
                ]
            ],
            [
                "title" => "Lessons",
                "links" => [
                    [
                        "name" => "Guitareo",
                        "url" => "/",
                    ],
                    [
                        "name" => "GuitarQuest",
                        "url" => "/",
                    ],
                    [
                        "name" => "500 Songs In 5 Days",
                        "url" => "/",
                    ],
                    [
                        "name" => "Acoustic Guitar Made Easy",
                        "url" => "/",
                    ],
                    [
                        "name" => "Guitar Technique Made Easy",
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
                        "name" => "Drumeo",
                        "url" => "/",
                    ],
                    [
                        "name" => "Pianote",
                        "url" => "/",
                    ],
                    [
                        "name" => "Singeo",
                        "url" => "/",
                    ]
                ]
            ],
        ]
    ])
@stop