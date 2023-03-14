@extends('_partials.layout.global-layout')

@section('head-includes')
    @include('_partials.layout._fonts')
    <!-- Favicons -->
    @include('_partials.layout.favicons.drumeo-favicons')
@stop

<!-- Header -->
@section('layout-header')
    @include('_partials.layout.global-header', [
        "theme_bg" => "bg-drumeo",
        "theme_text" => "text-drumeo",
        "logo" => "https://d38h3dn806jqj1.cloudfront.net/logos/drumeo.svg",
        "links" => [
            "Member Login" => [
                "iconClass" => "fas fa-sign-in",
                "url" => get_musora_brand_base_url() . '/login',
            ],
            "Contact" => [
                "iconClass" => "fas fa-phone",
                "url" => get_musora_brand_base_url().'/contact',
            ],
            "Drumeo" => [
                "iconClass" => "fas fa-home",
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
                    "100 Free Songs"=> [
                        "url" => "/100-songs",
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
        "logo" => "https://d38h3dn806jqj1.cloudfront.net/logos/drumeo-white.svg",
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
                        "url" => get_musora_brand_base_url()
                    ],
                    [
                        "name" => "Guitareo",
                        "url" => get_legacy_brand_base_url("guitareo")
                    ],
                    [
                        "name" => "Pianote",
                        "url" => get_legacy_brand_base_url("pianote")
                    ],
                    [
                        "name" => "Singeo",
                        "url" => get_legacy_brand_base_url("singeo")
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
