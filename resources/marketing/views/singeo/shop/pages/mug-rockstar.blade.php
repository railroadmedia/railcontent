@extends('singeo.shop.product-layout')

@section('head-includes')
    @parent
    
    <title>The Singeo Rockstar Mug</title>
    <meta name="description" content="keep your vocal cords hydrated with this super rad mug.">
    <meta property="og:description" content="keep your vocal cords hydrated with this super rad mug.">
    <meta property="og:image" content="todo" style="display: none;">
    <meta property="og:url" content="https://www.singeo.com/{{ Request::path() }}">
@stop()

@section('banner')
    @include('singeo.shop.partials._shop-nav', [
        "name" => "The Singeo Rockstar Mug",
        "fullPrice" => App\Prices::$mugFull,
        "price" => App\Prices::$mug,
        "clothing" => true
    ])
@endsection

@section('top')
    @include('singeo.shop.partials.slider', [
        "headerText" => "<strong>The Singeo Rockstar Mug</strong>",
        "images" => [ "https://singeo.s3.amazonaws.com/products/mug-rockstar-thumb.png" ],
        "noSlider" => true,
    ])

    @include('singeo.shop.partials.sidebar', [
        "sku" => "mouth-mug",
        "fullPrice" => App\Prices::$mugFull,
        "price" => App\Prices::$mug,
    ])
@endsection

@section('bottom')
    @include('singeo.shop.partials._specs',[
        "specsList" => [
            (object)[
            'specIcon' => 'fa-list-ol',
            'specType' => 'Volume:',
            'specValue' => '12 oz'
            ],
            (object)[
            'specIcon' => 'fa-arrows-v',
            'specType' => 'Height:',
            'specValue' => '4.875"'
            ],
            (object)[
            'specIcon' => 'fa-undo',
            'specType' => 'Diameter:',
            'specValue' => '3.5” (with handle: 5.25”)'
            ],
            (object)[
            'specIcon' => 'fa-cube',
            'specType' => 'Materials:',
            'specValue' => 'Ceramic'
            ],
            (object)[
            'specIcon' => 'fa-eye',
            'specType' => 'Finish:',
            'specValue' => 'Black'
            ],
            (object)[
            'specIcon' => 'fa-tint',
            'specType' => 'Washing:',
            'specValue' => 'Dishwasher recommended.'
            ],
            (object)[
            'specIcon' => 'fa-bolt',
            'specType' => 'Microwave:',
            'specValue' => 'Microwave safe.'
            ]
        ],
        "featuresList" => [
            "Keep your vocal cords hydrated with this super rad mug."
        ]
    ])
@endsection