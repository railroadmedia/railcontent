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
    @include('_partials.layout.favicons.pianote-favicons')
@stop

<!-- Header -->
@section('layout-header')
    @include('_partials.layout.global-header', [
        "theme_bg" => "bg-pianote",
        "theme_text" => "text-pianote",
        "logo" => "https://musora-ui.s3.amazonaws.com/logos/pianote.svg",
        "links" => [
            "Member Login" => [
                "iconClass" => "fas fa-sign-in",
                "url" => "/members",
            ],
            "Contact" => [
                "iconClass" => "fas fa-phone",
                "url" => '/support',
            ],
            "Pianote" => [
                "iconClass" => "icon-courses",
                "url" => '/',
            ],
            "Shop" => [
                "iconClass" => "fas fa-tag",
                "url" => '/shop',
            ],
            "Free Resources" => [
                "iconClass" => "fas fa-play-circle",
                "children" => [
                    "Pianote Blog"=> [
                        "url" => "/blog",
                    ],
                    "Chord Hacks"=> [
                        "url" => "/chord-hacks",
                    ],
                    "Getting Started On The Piano"=> [
                        "url" => "/getting-started",
                    ],
                    "Sight Reading Made Simple"=> [
                        "url" => "/sight-reading-made-simple",
                    ],
                ],
            ],
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
        "brand" => "pianote",
        "logo" => "https://musora-ui.s3.amazonaws.com/logos/pianote-white.svg",
        "sections" => [
            [
                "title" => "Resources",
                "links" => [
                    [
                        "name" => "Blog",
                        "url" => "/",
                    ],
                    [
                        "name" => "Getting Started",
                        "url" => "/",
                    ],
                    [
                        "name" => "Chord Hacks",
                        "url" => "/",
                    ],
                    [
                        "name" => "Sight Reading Made Simple",
                        "url" => "/",
                    ]
                ]
            ],
            [
                "title" => "Shop",
                "links" => [
                    [
                        "name" => "Pianote Membership",
                        "url" => "/",
                    ],
                    [
                        "name" => "Worship Piano",
                        "url" => "/",
                    ],
                    [
                        "name" => "500 Songs",
                        "url" => "/",
                    ],
                    [
                        "name" => "Riffs & Fills",
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
                        "name" => "Guitareo",
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