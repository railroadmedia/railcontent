@extends('_partials.layout.global-layout')

@section('head-includes')
    @include('_partials.layout._fonts')
    <!-- Favicons -->
    @include('_partials.layout.favicons.pianote-favicons')
@stop

<!-- Header -->
@section('layout-header')
    @include('_partials.layout.global-header', [
        "theme_bg" => "bg-pianote",
        "theme_text" => "text-pianote",
        "logo" => "https://d38h3dn806jqj1.cloudfront.net/logos/pianote.svg",
        "links" => [
            "Member Login" => [
                "iconClass" => "fas fa-sign-in",
                "url" => get_musora_brand_base_url() . '/login',
            ],
            "Contact" => [
                "iconClass" => "fas fa-phone",
                "url" => get_musora_brand_base_url().'/contact',
            ],
            "Pianote" => [
                "iconClass" => "fas fa-home",
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
        ],
        "external_links" => [
            "Mobile App" => [
                "iconClass" => "fas fa-fw fa-mobile-alt",
                "url" => '/app'
            ],
            "YouTube" => [
                "iconClass" => "fab fa-fw fa-youtube",
                "url" => 'https://youtube.com/user/pianolessonscom'
            ],
            "Facebook" => [
                "iconClass" => "fab fa-fw fa-facebook",
                "url" => 'https://facebook.com/pianoteofficial'
            ],
            "Instagram" => [
                "iconClass" => "fab fa-fw fa-instagram",
                "url" => 'https://instagram.com/pianoteofficial'
            ],
            "FAQs" => [
                "iconClass" => "fas fa-fw fa-question",
                "url" => 'https://help.pianote.com/',
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
        "brand" => "pianote",
        "logo" => "https://d38h3dn806jqj1.cloudfront.net/logos/pianote-white.svg",
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
                        "url" => get_musora_brand_base_url(),
                    ],
                    [
                        "name" => "Drumeo",
                        "url" => get_legacy_brand_base_url("drumeo"),
                    ],
                    [
                        "name" => "Guitareo",
                        "url" => get_legacy_brand_base_url("guitareo"),
                    ],
                    [
                        "name" => "Singeo",
                        "url" => get_legacy_brand_base_url("singeo"),
                    ]
                ]
            ],
        ]
    ])
@stop
