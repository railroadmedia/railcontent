@extends('singeo.shop.product-layout')

@section('head-includes')
    @parent
    
    <title>Vowel Practice Poster</title>
    <meta name="description" content="Your new favorite practice tool.">
    <meta property="og:description" content="Your new favorite practice tool.">
    <meta property="og:image" content="todo" style="display: none;">
    <meta property="og:url" content="https://www.singeo.com/{{ Request::path() }}">
@stop()

@section('banner')
    @include('singeo.shop.partials._shop-nav', [
        "name" => "Vowel Practice Poster",
        "fullPrice" => App\Prices::$posterFull,
        "price" => App\Prices::$poster,
        "clothing" => true
    ])
@endsection

@section('top')
    @include('singeo.shop.partials.slider', [
        "headerText" => "<strong>Vowel Practice Poster</strong>",
        "images" => [ "https://singeo.s3.amazonaws.com/products/poster-vowel-thumb2.png" ],
        "noSlider" => true,
    ])

    @include('singeo.shop.partials.sidebar', [
        "sku" => "vowel-sounds-poster",
        "fullPrice" => App\Prices::$posterFull,
        "price" => App\Prices::$poster,
    ])
@endsection

@section('bottom')
    @include('singeo.shop.partials._specs',[
        "specsList" => [
            (object)[
            'specIcon' => 'fa-list-ol',
            'specType' => 'Dimensions:',
            'specValue' => '22" x 17"'
            ],
            (object)[
            'specIcon' => 'fa-eye',
            'specType' => 'Finish:',
            'specValue' => 'Gloss'
            ],
        ],
        "featuresList" => [
            "Your new favorite practice tool - and your ticket to hitting higher notes with ease and confidence."
        ]
    ])
@endsection
   