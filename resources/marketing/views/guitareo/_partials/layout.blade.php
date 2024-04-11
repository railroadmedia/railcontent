@extends('_partials.layout.global-layout')

@section('head-includes')
    @include('_partials.layout._fonts')
    <!-- Favicons -->
    @include('_partials.layout.favicons.guitareo-favicons')
@stop

<!-- Header -->
@section('layout-header')
    @include('_partials.layout.global-header', [
        "theme_bg" => "bg-guitareo",
        "theme_text" => "text-guitareo",
        "logo" => "https://d38h3dn806jqj1.cloudfront.net/logos/guitareo.svg",
        "links" => [
            "Member Login" => [
                "iconClass" => "fas fa-sign-in",
                "url" => get_musora_brand_base_url() . '/login',
            ],
            "Contact" => [
                "iconClass" => "fas fa-phone",
                "url" => get_musora_brand_base_url().'/contact',
            ],
            "Guitareo" => [
                "iconClass" => "fas fa-home",
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
                "url" => 'https://help.musora.com/',
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
        "logo" => "https://d38h3dn806jqj1.cloudfront.net/logos/guitareo-white.svg",
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
                        "url" => get_musora_brand_base_url() . '/login',
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
                        "url" => get_musora_brand_base_url(),
                    ],
                    [
                        "name" => "Drumeo",
                        "url" => get_legacy_brand_base_url("drumeo"),
                    ],
                    [
                        "name" => "Pianote",
                        "url" => get_legacy_brand_base_url("pianote"),
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
