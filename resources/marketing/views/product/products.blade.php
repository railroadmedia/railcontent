@extends($theme.'._partials.layout')

@section('head-includes')
    <title>{{ ucfirst($theme) }} Shop - Get Lessons, T-Shirts, Gear, & Much More!</title>
    <meta name="description" content="Take your drumming to the next level with the largest collection of drum lessons in the world - or gear up for success with a selection of drum gear, t-shirts, sticks, and other cool drum swag.">
    <meta property="og:image" content="https://drumeo-assets.s3.amazonaws.com/drum-shop/og-image.jpg">
    <meta property="og:title" content="Drumeo Drum Shop - Get Lessons, T-Shirts, Gear, & Much More!">
    <meta property="og:description" content="Take your drumming to the next level with the largest collection of drum lessons in the world - or gear up for success with a selection of drum gear, t-shirts, sticks, and other cool drum swag.">
    <meta property="og:url" content="https://www.drumeo.com/drumshop/">

    <link rel="stylesheet" href="{{ mix('marketing/css/app.css') }}">
    <link rel="stylesheet" href="{{ asset('/marketing/parcel/css/navigation-sales.css') }}">
    <link rel="stylesheet" href="{{ asset('/marketing/parcel/css/shop.css') }}">
    <link rel="stylesheet" href="https://dpwjbsxqtam5n.cloudfront.net/fonts/font-awesome-5/fontawesome-all.min.css">
@stop

@section('layout-body')
    @include('product.partials._shop-header')

    <div class="container mx-auto px-4 py-10" x-data="{ filter: 'all' }">

        <div class="px-2 md:px-3 text-4xl mb-10">
            <span class="mr-4 cursor-pointer" x-on:click=" filter = 'all'">All</span>
            <span class="mr-4 cursor-pointer" x-on:click=" filter = 'lessons'">Lessons</span>
            <span class="mr-4 cursor-pointer" x-on:click=" filter = 'accessories'">Accessories</span>
            <span class="mr-4 cursor-pointer" x-on:click=" filter = 'clothing'">Clothing</span>
        </div>

        @if(count($lessons) > 0)
        <section class="grid-view" x-show="filter === 'lessons' || filter === 'all'">
            <ul class="fixed-cards">
                <li>
                    <h1 class="px-2 md:px-3" >
                        <div class="heading-icon text-{{ $theme }}"><i class="fas fa-video"></i></div>
                            Online Lessons
                    </h1>
                </li>

                @foreach($lessons as $lesson){
                    @include('product.partials._drum-shop-card', [
                        "sku" => $lesson->sku,
                        "itemURL" => '/'.$theme.'/shop/'.$lesson->slug,
                        "thumbnail" => $lesson->thumbnail,
                        "packLogo" => $lesson->logo,
                        "title" => $lesson->name,
                        "packAuthor" => $lesson->instructor_name,
                        "cardDescription" => $lesson->short_desc,
                        "fullPrice" => $lesson->price,
                        "price" => $lesson->discounted_price === '0.00' || empty($lesson->discounted_price) ? $lesson->price : $lesson->discounted_price,
                        "productJson" => '{ "'.$lesson->sku.'": 1 }',
                    ])
                }
                @endforeach
            </ul>
        </section>
        @endif

        @if(count($accessories) > 0)
            <section class="grid-view" x-show="filter === 'accessories' || filter === 'all'">
                <ul class="fixed-cards">
                    <li>
                        <h1 class="px-2 md:px-3">
                            <div class="heading-icon text-{{ $theme }}"><i class="fas fa-suitcase"></i></div>
                            Accessories
                        </h1>
                    </li>
                    @foreach($accessories as $accessory){
                        @include('product.partials._drum-shop-card', [
                            "sku" => $accessory->sku,
                            "itemURL" => '/'.$theme.'/shop/'.$accessory->slug,
                            "thumbnail" => $accessory->thumbnail,
                            "title" => $accessory->name,
                            "cardDescription" => $accessory->short_desc,
                            "fullPrice" => $accessory->price,
                            "price" => $accessory->discounted_price === '0.00' || empty($accessory->discounted_price) ? $accessory->price : $accessory->discounted_price,
                            "physical" => true,
                            "sizes" => $accessory->sizes,
                            "soldOut" => $accessory->sold_out,
                        ])
                    }
                    @endforeach
                </ul>
            </section>
        @endif

        @if(count($shirts) > 0)
        <section class="grid-view" x-show="filter === 'clothing' || filter === 'all'">
            <ul class="fixed-cards">
                <li>
                    <h1 class="px-2 md:px-3">
                        <div class="heading-icon text-{{ $theme }}"><i class="fas fa-tshirt"></i></div>
                            Shirts
                    </h1>
                </li>
                @foreach($shirts as $shirt){
                    @include('product.partials._drum-shop-card', [
                        "sku" => $shirt->sku,
                        "itemURL" => '/'.$theme.'/shop/'.$shirt->slug,
                        "thumbnail" => $shirt->thumbnail,
                        "title" => $shirt->name,
                        "cardDescription" => $shirt->short_desc,
                        "fullPrice" => $shirt->price,
                        "price" => $shirt->discounted_price === '0.00' || empty($shirt->discounted_price) ? $shirt->price : $shirt->discounted_price,
                        "physical" => true,
                        "sizes" => $shirt->sizes,
                        "soldOut" => $shirt->sold_out,
                    ])
                }
                @endforeach
            </ul>
        </section>
        @endif

        @if(count($hoodies) > 0)
            <section class="grid-view" x-show="filter === 'clothing' || filter === 'all'">
                <ul class="fixed-cards container mx-auto">
                    <li>
                        <h1 class="px-2 md:px-3">
                            <div class="heading-icon text-{{ $theme }}"><i class="fas fa-tshirt"></i></div>
                            Hoodies
                        </h1>
                    </li>
                    @foreach($hoodies as $hoodie){
                    @include('product.partials._drum-shop-card', [
                        "sku" => $hoodie->sku,
                        "itemURL" => '/'.$theme.'/shop/'.$hoodie->slug,
                        "thumbnail" => $hoodie->thumbnail,
                        "title" => $hoodie->name,
                        "cardDescription" => $hoodie->short_desc,
                        "fullPrice" => $hoodie->price,
                        "price" => $hoodie->discounted_price === '0.00' || empty($hoodie->discounted_price) ? $hoodie->price : $hoodie->discounted_price,
                        "physical" => true,
                        "sizes" => $hoodie->sizes,
                        "soldOut" => $hoodie->sold_out,
                    ])
                    }
                    @endforeach
                </ul>
            </section>
        @endif
    </div>
@stop

@section('layout-scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script>
        $(function () {
            $('.scalable-card').click(function (e) {
                e.stopPropagation();
                if (!$(e.target).is('.pack-pick') && !$(e.target).is('option') && !$(e.target).is('a') && !$(e.target).is('button')) {
                    $(this).toggleClass('flipped');
                }

            });

            //customize section pack picker
            var originalLink = '/laravel/public/shopping-cart/api/query?go-back-to-shop=true';

            $('select').prop('selectedIndex', 0);
            $(".pack-pick").change(function () {
                var orderButton = $(this).parent().find(".selected-pack");
                var selectedOption = $(this).find("option:selected");
                $(this).removeClass('error');
                orderButton.addClass('active');
                orderButton.attr('href', originalLink);
                orderButton.attr('href', orderButton.attr('href') + selectedOption.val());
                orderButton.attr('data-product-json', selectedOption.attr('data-product-json'));
            });

            $(".selected-pack").on('click', function (ev) {
                if (!$(this).hasClass('active')) {
                    ev.preventDefault();
                    ev.stopPropagation();
                    var selecter = $(this).parent().find(".pack-pick");
                    selecter.addClass('error');
                }
            });

            $('.delay-overlay').click(function (e) {
                e.stopPropagation();

                $('.delay-overlay').removeClass('active');
                $('.shipping-info').removeClass('active');
                $('.timing-info').removeClass('active');
            });

            $(".shipping-delay .shipping-trigger").on('click', function () {
                $('.delay-overlay').addClass('active');
                $('.shipping-info').addClass('active');
            });

            $(".shipping-delay .timing-trigger").on('click', function () {
                $('.delay-overlay').addClass('active');
                $('.timing-info').addClass('active');
            });

            $(".shipping-delay .close-modal").on('click', function () {
                $('.delay-overlay').removeClass('active');
                $('.shipping-info').removeClass('active');
                $('.timing-info').removeClass('active');
            });
            $(document).keyup(function(e) {
                if (e.which === 27) {
                    $('.delay-overlay').removeClass('active');
                    $('.shipping-info').removeClass('active');
                    $('.timing-info').removeClass('active');
                }
            });
        });
    </script>
@stop
