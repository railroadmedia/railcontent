@extends('singeo.shop.product-layout')

@section('head-includes')
    @parent
    <title>Singeo Do-Re-Mi Tumbler</title>
    <meta name="description" content="Your new favorite practice tool.">
    <meta property="og:description" content="Your new favorite practice tool.">
    <meta property="og:image" content="todo" style="display: none;">
    <meta property="og:url" content="https://www.singeo.com/{{ Request::path() }}">
@stop()

@section('shop')
    @include('singeo.shop.partials._shop-nav', [
        "name" => "Singeo Do-Re-Mi Tumbler",
        "fullPrice" => SingeoPrices::$tumblerFull,
        "price" => 19,
        "clothing" => true
    ])
@endsection

@section('top')
    @include('singeo.shop.partials.slider', [
        "headerText" => "<strong>Singeo Do-Re-Mi Tumbler</strong>",
        "images" => [ "https://singeo.s3.amazonaws.com/products/tumbler-doremi-thumb2.png" ],
        "noSlider" => true,
    ])

    @include('singeo.shop.partials.sidebar', [
        "sku" => "products[wallflower-tumbler]=1&promo-code=member&locked=true",
        "fullPrice" => SingeoPrices::$tumblerFull,
        "price" => 19,
        "bundle" => true,
    ])
@endsection

@section('bottom')
    @include('singeo.shop.partials._specs',[
        "specsList" => [
            (object)[
            'specIcon' => 'fa-list-ol',
            'specType' => 'Volume:',
            'specValue' => '20.9 oz'
            ],
            (object)[
            'specIcon' => 'fa-cube',
            'specType' => 'Materials:',
            'specValue' => 'Double wall stainless steel with copper vacuum insulation'
            ],
            (object)[
            'specIcon' => 'fa-eye',
            'specType' => 'Finish:',
            'specValue' => 'Matte pearlized finish'
            ]
        ],
        "featuresList" => [
            "The singer’s companion! This cozy tumbler will keep you hydrated at home or on the go."
        ]
    ])
@endsection
