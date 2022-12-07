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
    @include('_partials.layout.favicons.singeo-favicons')
@stop

<!-- Header -->
@section('layout-header')
    @include('_partials.layout.global-header', [
        "theme_bg" => "bg-singeo",
        "theme_text" => "text-singeo",
        "logo" => "https://musora-ui.s3.amazonaws.com/logos/singeo.svg",
        "links" => [
            "Member Login" => [
                "iconClass" => "fas fa-sign-in",
                "url" => "/members",
            ],
            "Contact" => [
                "iconClass" => "fas fa-phone",
                "url" => get_musora_brand_base_url().'/contact',
            ],
            "Singeo" => [
                "iconClass" => "icon-courses",
                "url" => '/',
            ],
            "Shop" => [
                "iconClass" => "fas fa-tag",
                "url" => '/shop',
            ],
            "The Chorus" => [
                "iconClass" => "fas fa-comment-alt-edit",
                "url" => '/chorus',
            ],
            "4 Vocal Exercises" => [
                "iconClass" => "fas fa-microphone-alt",
                "url" => '/improve-any-voice',
            ]
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
            "FAQs" => [
                "iconClass" => "fas fa-fw fa-question",
                "url" => 'https://help.singeo.com/',
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
        "brand" => "singeo",
        "logo" => "https://musora-ui.s3.amazonaws.com/logos/singeo-white.svg"
    ])
@stop
