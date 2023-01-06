@extends('_partials.layout.global-layout')

@section('head-includes')
    @include('_partials.layout._fonts')
    <!-- Favicons -->
    @include('_partials.layout.favicons.singeo-favicons')

    @yield('head-includes')
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
                "url" => get_musora_brand_base_url() . '/login',
            ],
            "Contact" => [
                "iconClass" => "fas fa-phone",
                "url" => get_musora_brand_base_url().'/contact',
            ],
            "Singeo" => [
                "iconClass" => "fas fa-home",
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
