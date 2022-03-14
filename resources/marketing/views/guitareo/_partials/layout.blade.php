@extends('_partials.layout.global-layout')

@section('head-includes')
    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&family=Open+Sans:wght@400;600;700;800&display=swap" rel="stylesheet">
    <!-- Icons -->
    <script src="https://kit.fontawesome.com/cf2f4c6c71.js" crossorigin="anonymous"></script>
    <link href="https://d1prhhmg8i11jr.cloudfront.net/v1.0.3/dist/icons.css" rel="stylesheet">
    <!-- Favicons -->
    @include('_partials.layout.favicons.guitareo-favicons')
@stop

<!-- Header -->
@section('layout-header')
    @include('_partials.layout.global-header', [
        "theme_bg" => "bg-guitareo",
        "theme_text" => "text-guitareo",
        "logo" => "https://musora-ui.s3.amazonaws.com/logos/guitareo.svg"
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