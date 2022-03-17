@extends('singeo.shop.product-layout')

@section('head-includes')
    @parent
    
    <title>The Singeo Retro T-shirt</title>
    <meta name="description" content="Sing with confidence AND style with this super slick Singeo Retro T-shirt!">
    <meta property="og:description" content="Sing with confidence AND style with this super slick Singeo Retro T-shirt!">
    <meta property="og:image" content="todo" style="display: none;">
    <meta property="og:url" content="https://www.singeo.com/{{ Request::path() }}">
@stop()

@section('shop')
    @include('singeo.shop.partials._shop-nav', [
        "name" => "The Singeo Retro T-shirt",
        "fullPrice" => App\Prices::$mugFull,
        "price" => App\Prices::$mug,
        "clothing" => true
    ])
@endsection

@section('top')
    @include('singeo.shop.partials.slider', [
        "headerText" => "<strong>The Singeo Retro T-shirt</strong>",
        "images" => [ "https://singeo.s3.amazonaws.com/products/retro-shirt-thumb.png" ],
        "noSlider" => true,
    ])

    @include('singeo.shop.partials.sidebar', [
        "options" => true,
        "fullPrice" => App\Prices::$shirtsFull,
        "price" => App\Prices::$shirts,
        "variations" => [
            (object)[
                "name" => "Small",
                "fullPrice" => App\Prices::$shirtsFull,
                "price" => App\Prices::$shirts,
                "sku" => "retro-shirt-s"
            ],
            (object)[
                "name" => "Medium",
                "fullPrice" => App\Prices::$shirtsFull,
                "price" => App\Prices::$shirts,
                "sku" => "retro-shirt-m"
            ],
            (object)[
                "name" => "Large",
                "fullPrice" => App\Prices::$shirtsFull,
                "price" => App\Prices::$shirts,
                "sku" => "retro-shirt-l"
            ],
            (object)[
                "name" => "X-Large",
                "fullPrice" => App\Prices::$shirtsFull,
                "price" => App\Prices::$shirts,
                "sku" => "retro-shirt-xl"
            ],
            (object)[
                "name" => "XX-Large",
                "fullPrice" => App\Prices::$shirtsFull,
                "price" => App\Prices::$shirts,
                "sku" => "retro-shirt-xxl"
            ]
        ],
    ])
@endsection

@section('bottom')
@include('singeo.shop.partials._specs',[
    "specsList" => [
        (object)[
        'specIcon' => 'fa-expand-arrows-alt',
        'specType' => 'Sizing:',
        'specValue' => "Unisex"
        ],
        (object)[
        'specIcon' => 'fa-tshirt',
        'specType' => 'Shirt:',
        'specValue' => 'Bella + Canvas Short Sleeve Jersey Tee'
        ],
        (object)[
        'specIcon' => 'fa-blanket',
        'specType' => 'Fabric:',
        'specValue' => '52% cotton, 48% polyester '
        ],
        (object)[
        'specIcon' => 'fa-palette',
        'specType' => 'Color:',
        'specValue' => 'Black'
        ]
    ],
    "featuresList" => [
        "Sing with confidence AND style with this super slick Singeo Retro T-shirt!"
    ]
])
<p><strong><i class="fas fa-expand-arrows-alt"></i> SIZE CHART:</strong></p>
<table class="specTable tw-text-center tw-w-full">
    <tbody>
        <tr>
            <th></th>
            <th>S</th>
            <th>M</th>
            <th>L</th>
            <th>XL</th>
            <th>2XL</th>
        </tr>
        <tr>
            <td>Body Length</td>
            <td>28</td>
            <td>29</td>
            <td>30</td>
            <td>31</td>
            <td>32</td>
        </tr>
        <tr>
            <td>Body Length Tolerance</td>
            <td>1</td>
            <td>1</td>
            <td>1</td>
            <td>1</td>
            <td>1</td>
        </tr>
        <tr>
            <td>Body Width</td>
            <td>18</td>
            <td>20</td>
            <td>22</td>
            <td>24</td>
            <td>26</td>
        </tr>
        <tr>
            <td>Body Width Tolerance</td>
            <td>1</td>
            <td>1</td>
            <td>1</td>
            <td>1</td>
            <td>1</td>
        </tr>
        <tr>
            <td>Neck Size</td>
            <td>6 1/2</td>
            <td>6 3/4</td>
            <td>7</td>
            <td>7 1/2</td>
            <td>7 3/4</td>
        </tr>
        </tbody>
    </table>
@endsection