@extends('_partials.layout.global-sales-layout')

@section('global-head')
    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&family=Open+Sans:wght@400;600;700;800&display=swap" rel="stylesheet">
    <!-- Icons -->
    <script src="https://kit.fontawesome.com/cf2f4c6c71.js" crossorigin="anonymous"></script>
    <link href="https://dpwjbsxqtam5n.cloudfront.net/fonts/icons.css" rel="stylesheet">
    <!-- Favicons -->
    @include('_partials.layout.favicons.singeo-favicons')

    @yield('head-includes')
@stop

<!-- Header -->
@section('layout-header')
    @include('_partials.layout.global-header', [
        "emptyPromoVersion" => $emptyPromoVersion,
        "logo" => "https://musora-ui.s3.amazonaws.com/logos/singeo.svg",
        // TOP NAV
        "nav_links" => [
            "Features" => [
                "children" => [
                    "Method"=> [
                        "iconClass" => "fa-fw far fa-music-note",
                        "url" => get_legacy_brand_base_url("singeo")."/method",
                    ],
                    "Songs"=> [
                        "iconClass" => "fa-fw far fa-headphones",
                        "url" => get_legacy_brand_base_url("singeo")."/songs",
                    ],
                    "Coaches"=> [
                        "iconClass" => "fa-fw far fa-whistle",
                        "url" => get_legacy_brand_base_url("singeo")."/coaches",
                    ],
                ],
            ],
            "Instruments" => [
                "children" => [
                    "Drumeo"=> [
                        "iconClass" => "fa-fw far fa-drum",
                        "url" => get_legacy_brand_base_url("drumeo"),
                    ],
                    "Pianote"=> [
                        "iconClass" => "fa-fw far fa-piano-keyboard",
                        "url" => get_legacy_brand_base_url("pianote"),
                    ],
                    "Guitareo"=> [
                        "iconClass" => "fa-fw far fa-guitar",
                        "url" => get_legacy_brand_base_url("guitareo"),
                    ],
                ],
            ],
            "Pricing" => [
                "url" => '/choose-plan',
            ],
            "Shop" => [
                "url" => '/shop',
            ],
            "Blog" => [
                "url" => '/chorus',
            ],
        ],
        // SIDEBAR
        "sidebar_links" => [
            "Member Login" => [
                "iconClass" => "fas fa-sign-in",
                "url" => get_musora_brand_base_url() . '/login',
            ],
            "Home" => [
                "iconClass" => "fas fa-home",
                "url" => '/',
            ],
            "Features" => [
                "iconClass" => "fas fa-star",
                "children" => [
                    "Method"=> [
                        "url" => "/methods",
                    ],
                    "Songs"=> [
                        "url" => "/songs",
                    ],
                    "Coaches"=> [
                        "url" => "/coaches",
                    ],
                ],
            ],
            "Instuments" => [
                "iconClass" => "fas fa-piano-keyboard",
                "children" => [
                    "Drumeo"=> [
                        "url" => get_legacy_brand_base_url("drumeo"),
                    ],
                    "Pianote"=> [
                        "url" => get_legacy_brand_base_url("pianote"),
                    ],
                    "Guitareo"=> [
                        "url" => get_legacy_brand_base_url("guitareo"),
                    ],
                ],
            ],
            "Pricing" => [
                "iconClass" => "fas fa-money-bill-wave",
                "url" => '/choose-plan',
            ],
            "Shop" => [
                "iconClass" => "fas fa-tag",
                "url" => '/shop',
            ],
            "Blog" => [
                "iconClass" => "fas fa-comment-alt-edit",
                "url" => '/chorus',
            ],
            "4 Vocal Exercises" => [
                "iconClass" => "fas fa-microphone-alt",
                "url" => '/improve-any-voice',
            ],
        ],
        "external_links" => [
            "YouTube" => [
                "iconClass" => "fab fa-fw fa-youtube",
                "url" => 'https://www.youtube.com/c/singeoofficial'
            ],
            "Facebook" => [
                "iconClass" => "fab fa-fw fa-facebook",
                "url" => 'https://www.facebook.com/singeoofficial/'
            ],
            "Instagram" => [
                "iconClass" => "fab fa-fw fa-instagram",
                "url" => 'https://instagram.com/singeoofficial/'
            ],
            "TikTok" => [
                "iconClass" => "fab fa-fw fa-tiktok",
                "url" => 'https://www.tiktok.com/@singeoofficial'
            ],
            "FAQs" => [
                "iconClass" => "fas fa-fw fa-question",
                "url" => 'https://help.singeo.com/',
                "target" => '_parent'
            ],
            "Contact" => [
                "iconClass" => "fas fa-fw fa-phone",
                "url" => '/contact',
                "target" => '_parent'
            ],
        ]
    ])
@stop

<!-- Global Wrapper -->
@section('global-body')
    <!-- Brand Specific Content -->
    @yield('layout-body')
@stop

<!-- Footer -->
@section('layout-footer')

    @include("singeo.sales.partials._footer")
{{--    @include('_partials.layout.global-footer', [--}}
{{--        "emptyPromoVersion" => empty($promoVersion),--}}
{{--        "brand" => "singeo",--}}
{{--        "logo" => "https://musora-ui.s3.amazonaws.com/logos/singeo-white.svg",--}}
{{--        "sections" => [--}}
{{--            [--}}
{{--                "title" => "Resources",--}}
{{--                "links" => [--}}
{{--                    [--}}
{{--                        "name" => "Blog",--}}
{{--                        "url" => "/",--}}
{{--                    ],--}}
{{--                    [--}}
{{--                        "name" => "Getting Started",--}}
{{--                        "url" => "/",--}}
{{--                    ],--}}
{{--                    [--}}
{{--                        "name" => "Chord Hacks",--}}
{{--                        "url" => "/",--}}
{{--                    ],--}}
{{--                    [--}}
{{--                        "name" => "Sight Reading Made Simple",--}}
{{--                        "url" => "/",--}}
{{--                    ]--}}
{{--                ]--}}
{{--            ],--}}
{{--            [--}}
{{--                "title" => "Shop",--}}
{{--                "links" => [--}}
{{--                    [--}}
{{--                        "name" => "Pianote Membership",--}}
{{--                        "url" => "/",--}}
{{--                    ],--}}
{{--                    [--}}
{{--                        "name" => "Worship Piano",--}}
{{--                        "url" => "/",--}}
{{--                    ],--}}
{{--                    [--}}
{{--                        "name" => "500 Songs",--}}
{{--                        "url" => "/",--}}
{{--                    ],--}}
{{--                    [--}}
{{--                        "name" => "Riffs & Fills",--}}
{{--                        "url" => "/",--}}
{{--                    ]--}}
{{--                ]--}}
{{--            ],--}}
{{--            [--}}
{{--                "title" => "Other Sites",--}}
{{--                "links" => [--}}
{{--                    [--}}
{{--                        "name" => "Musora",--}}
{{--                        "url" => get_musora_brand_base_url(),--}}
{{--                    ],--}}
{{--                    [--}}
{{--                        "name" => "Drumeo",--}}
{{--                        "url" => get_legacy_brand_base_url("drumeo"),--}}
{{--                    ],--}}
{{--                    [--}}
{{--                        "name" => "Guitareo",--}}
{{--                        "url" => get_legacy_brand_base_url("guitareo"),--}}
{{--                    ],--}}
{{--                    [--}}
{{--                        "name" => "Singeo",--}}
{{--                        "url" => get_legacy_brand_base_url("singeo"),--}}
{{--                    ]--}}
{{--                ]--}}
{{--            ],--}}
{{--        ]--}}
{{--    ])--}}
@stop


@yield('layout-scripts')
