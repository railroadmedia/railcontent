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
            "songs" => [
                "url" => get_musora_brand_base_url().'/songs',
            ],
            "Instruments" => [
                "iconClass" => "fas fa-piano-keyboard",
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
                "iconClass" => "fas fa-sign-in",
                "url" => get_musora_brand_base_url() . '/login',
            ],
            "Home" => [
                "iconClass" => "fas fa-home",
                "url" => "/",
            ],
            "Features" => [
                "iconClass" => "fas fa-star",
                "children" => [
                    "Method" => [
                        "url" => get_musora_brand_base_url().'/method',
                    ],
                    "Songs" => [
                        "url" => get_musora_brand_base_url().'/songs',
                    ],
                ],
            ],
            "Instruments" => [
                "iconClass" => "fas fa-piano-keyboard",
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
                "iconClass" => "fas fa-money-bill-wave",
                "url" => get_musora_brand_base_url().'/choose-plan',
            ],
            "Contact" => [
                "iconClass" => "fas fa-phone",
                "url" => get_musora_brand_base_url().'/contact',
            ],
            "Careers" => [
                "iconClass" => "fas fa-users",
                "url" => '/careers',
            ],
            "About" => [
                "iconClass" => "fas fa-question",
                "url" => '/about',
            ],
            "Ambassador Program" => [
                "iconClass" => "fas fa-comment-dollar",
                "url" => '/ambassador',
            ],
            "Brand Guides" => [
                "iconClass" => "fas fa-pencil-paintbrush",
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

    @if(Carbon\Carbon::create(2023, 11, 25, 0, 0, 0, 'America/Vancouver') > Carbon\Carbon::now())
        @include('_partials.components.countdown',[
            'countdownDate' => '2023-11-25 00:00:00',
            'promoVersion' => true
        ])
    @elseif(Carbon\Carbon::create(2023, 11, 27, 0, 0, 0, 'America/Vancouver') > Carbon\Carbon::now())
        @include('_partials.components.countdown',[
            'countdownDate' => '2023-11-27 00:00:00',
            'promoVersion' => true
        ])
    @else
        @include('_partials.components.countdown',[
            'countdownDate' => '2023-11-28 00:00:00',
            'promoVersion' => true
        ])

    @endif
@stop
