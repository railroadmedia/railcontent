@extends('_partials.layout.global-layout')

<!-- Header -->
@section('layout-header')
    @include('_partials.layout.global-header', [
        "theme_bg" => "bg-musora",
        "theme_text" => "text-musora",
        "logo" => "https://dmmior4id2ysr.cloudfront.net/homepage/2023/musora_logo.png",
        "nav_links" => [
            "lessons" => [
                "url" => get_musora_brand_base_url().'/method',
            ],
            "Instruments" => [
                "iconClass" => "fad fa-piano-keyboard",
                "children" => [
                    "piano" => [
                        "url" => get_legacy_brand_base_url("pianote"),
                        "brand" => "pianote",
                        "iconClass" => "fa-fw far fa-piano-keyboard",
                    ],
                    "guitar" => [
                        "url" => get_legacy_brand_base_url("guitareo"),
                        "brand" => "guitareo",
                        "iconClass" => "fa-fw far fa-guitar",
                    ],
                    "drums" => [
                        "url" => get_legacy_brand_base_url("drumeo"),
                        "brand" => "drumeo",
                        "iconClass" => "fa-fw far fa-drum",
                    ],
                    "singing" => [
                        "url" => get_legacy_brand_base_url("singeo"),
                        "brand" => "singeo",
                        "iconClass" => "fa-fw far fa-microphone-stand",
                    ],
                ],
            ],
            "pricing" => [
                "url" => get_musora_brand_base_url().'/choose-plan',
            ],
            "login" => [
                "url" => get_musora_brand_base_url().'/login',
            ],
        ],
        "links" => [
            "Member Login" => [
                "iconClass" => "fad fa-sign-in",
                "url" => get_musora_brand_base_url() . '/login',
            ],
            "Home" => [
                "iconClass" => "fad fa-home",
                "url" => "/",
            ],
            "Features" => [
                "iconClass" => "fad fa-star",
                "children" => [
                    "Method" => [
                        "url" => get_musora_brand_base_url().'/method',
                    ],
                ],
            ],
            "Instruments" => [
                "iconClass" => "fad fa-piano-keyboard",
                "children" => [
                    "Piano" => [
                        "url" => get_legacy_brand_base_url("pianote"),
                    ],
                    "Guitar" => [
                        "url" => get_legacy_brand_base_url("guitareo"),
                    ],
                    "Drums" => [
                        "url" => get_legacy_brand_base_url("drumeo"),
                    ],
                    "Singing" => [
                        "url" => get_legacy_brand_base_url("singeo"),
                    ],
                ],
            ],
            "Pricing" => [
                "iconClass" => "fad fa-money-bill-wave",
                "url" => get_musora_brand_base_url().'/choose-plan',
            ],
            "Contact" => [
                "iconClass" => "fad fa-phone",
                "url" => get_musora_brand_base_url().'/contact',
            ],
            "The Playlist" => [
                "iconClass" => "fad fa-album-collection",
                "url" => 'https://lp.musora.com/playlists',
            ],
            "Careers" => [
                "iconClass" => "fad fa-users",
                "url" => '/careers',
            ],
            "About" => [
                "iconClass" => "fad fa-circle-question",
                "url" => '/about',
            ],
            "Ambassador Program" => [
                "iconClass" => "fad fa-comment-dollar",
                "url" => '/ambassador',
            ],
            "Brand Guides" => [
                "iconClass" => "fad fa-pencil-paintbrush",
                "url" => '/brand',
            ],
        ],
        "external_links" => [
            "Drumeo" => [
                "iconClass" => "fas fa-external-link",
                "url" => get_legacy_brand_base_url("drumeo")
            ],
            "Pianote" => [
                "iconClass" => "fas fa-external-link",
                "url" => get_legacy_brand_base_url("pianote")
            ],
            "Guitareo" => [
                "iconClass" => "fas fa-external-link",
                "url" => get_legacy_brand_base_url("guitareo")
            ],
            "Singeo" => [
                "iconClass" => "fas fa-external-link",
                "url" => get_legacy_brand_base_url("singeo")
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
        "brand" => "musora",
        "logo" => "https://dmmior4id2ysr.cloudfront.net/homepage/2023/musora_logo.png"
    ])
@stop
