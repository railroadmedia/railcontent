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
    @include('_partials.layout.favicons.musora-favicons')
@stop

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
                "url" => '/support',
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