@extends('_partials.layout.global-layout')

<!-- Header -->
@section('layout-header')
    @include('_partials.layout.global-header', [
        "theme_bg" => "bg-musora",
        "theme_text" => "text-musora",
        "logo" => "https://musora-ui.s3.amazonaws.com/logos/musora-white.svg",
        "links" => [
            "Home" => [
                "iconClass" => "fas fa-home",
                "url" => "/",
            ],
            "Member Login" => [
                "iconClass" => "fas fa-sign-in",
                "url" => "/members",
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
                "themeClass" => "text-musora",
                "url" => get_legacy_brand_base_url("drumeo")
            ],
            "Pianote" => [
                "iconClass" => "fas fa-external-link",
                "themeClass" => "text-musora",
                "url" => get_legacy_brand_base_url("pianote")
            ],
            "Guitareo" => [
                "iconClass" => "fas fa-external-link",
                "themeClass" => "text-musora",
                "url" => get_legacy_brand_base_url("guitareo")
            ],
            "Singeo" => [
                "iconClass" => "fas fa-external-link",
                "themeClass" => "text-musora",
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
        "logo" => "https://musora-ui.s3.amazonaws.com/logos/musora-white.svg"
    ])
@stop
