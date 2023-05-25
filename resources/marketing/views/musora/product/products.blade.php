@extends($theme.'._partials.layout')

@section('head-includes')
    <title>{{ ucfirst($theme) }} Shop - Get Lessons, T-Shirts, Gear, & Much More!</title>
    <meta name="description" content="Take your drumming to the next level with the largest collection of drum lessons in the world - or gear up for success with a selection of drum gear, t-shirts, sticks, and other cool drum swag.">
    <meta property="og:image" content="https://dpwjbsxqtam5n.cloudfront.net/drum-shop/og-image.jpg">
    <meta property="og:title" content="Drumeo Drum Shop - Get Lessons, T-Shirts, Gear, & Much More!">
    <meta property="og:description" content="Take your drumming to the next level with the largest collection of drum lessons in the world - or gear up for success with a selection of drum gear, t-shirts, sticks, and other cool drum swag.">
    <meta property="og:url" content="https://www.drumeo.com/drumshop/">

    <link rel="stylesheet" href="{{ mix('marketing/css/app.css') }}">
    <link href="{{ asset('/marketing/parcel/drumeo/navigation-sales.css') }}" rel="stylesheet">
    <link href="{{ asset('/marketing/parcel/drumeo/shop-pianote.css') }}" rel="stylesheet">

    @parent
@stop

@section('layout-body')
    @include('musora.product.partials._shop-header')

    <div class="container mx-auto px-4 py-10" x-data="{ filter: '{{ !empty($category) && $category !== 'shop' ? $category : 'all' }}' }">

        @if($theme === 'drumeo' || $theme === 'pianote')
            <div class="px-2 md:px-3 md:text-2xl lg:text-3xl mb-10">
                <span
                    class="mr-4 cursor-pointer border-{{ $theme }} border-solid"
                    x-on:click="filter = 'all'"
                    x-bind:class="filter === 'all' ? 'border-b-2 font-bold' : 'text-gray-400'"
                >
                    All
                </span>
                @if(count($lessons) > 0)
                    <span
                        class="mr-4 cursor-pointer border-{{ $theme }} border-solid"
                        x-on:click="filter = 'lessons'"
                        x-bind:class="filter === 'lessons' ? 'border-b-2 font-bold' : 'text-gray-400'"
                    >
                        Lessons
                    </span>
                @endif
                @if(count($accessories) > 0)
                    <span
                        class="mr-4 cursor-pointer border-{{ $theme }} border-solid"
                        x-on:click="filter = 'accessories'"
                        x-bind:class="filter === 'accessories' ? 'border-b-2 font-bold' : 'text-gray-400'"
                    >
                        Accessories
                    </span>
                @endif
                @if(count($hats) > 0 || count($hats) > 0 || count($hoodies) > 0)
                    <span
                        class="mr-4 cursor-pointer border-{{ $theme }} border-solid"
                        x-on:click="filter = 'clothing'"
                        x-bind:class="filter === 'clothing' ? 'border-b-2 font-bold' : 'text-gray-400'"
                    >
                        Clothing
                    </span>
                @endif
            </div>

            @if(count($lessons) > 0)
                <section class="grid-view" x-show="filter === 'lessons' || filter === 'all'">
                    <ul class="fixed-cards">
                        <li>
                            <h5 class="px-2 md:px-3 mb-4 md:mb-7 flex items-center">
                                <div class="inline-block heading-icon text-{{ $theme }} text-3xl mr-4"><i class="fas fa-video"></i></div>
                                Online @if($theme === 'drumeo') Drum @else Piano @endif Lessons
                            </h5>
                        </li>

                        @foreach($lessons as $lesson){
                            @include('musora.product.partials._drum-shop-card', [
                                "sku" => $lesson->sku === 'drumeo' || $lesson->sku === 'pianote' || $lesson->sku === 'singeo' || $lesson->sku === 'guitareo' ? null : $lesson->sku,
                                "itemURL" => '/'.$theme.'/shop/'.str_replace( array('Drumeo-', 'Pianote-', 'Guitareo-', 'Singeo-'), '', $lesson->slug ),
                                "thumbnail" => $lesson->thumbnail,
                                "badgeText" => $lesson->badge_text,
                                "thumbnail_logo" => $lesson->thumbnail_logo,
                                "packLogo" => $lesson->page_logo,
                                "title" => $lesson->name,
                                "packAuthor" => $lesson->instructor_name,
                                "cardDescription" => $lesson->short_desc,
                                "fullPrice" => $lesson->price,
                                "price" => $lesson->discounted_price === '0.00' || empty($lesson->discounted_price) ? $lesson->price : $lesson->discounted_price,
                                "productJson" => '{ "'.$lesson->sku.'": 1 }',
                                "buttonText" => $lesson->sku === 'drumeo' || $lesson->sku === 'pianote' || $lesson->sku === 'singeo' || $lesson->sku === 'guitareo' ? 'see the deal' : null,
                                "soldOut" => $lesson->sold_out,
                                "includedEdge" => $lesson->included_edge,
                                "category" => strtolower($lesson->productType->name),
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
                            <h5 class="px-2 md:px-3 mb-4 md:mb-7 flex items-center">
                                <div class="inline-block heading-icon text-{{ $theme }} text-3xl mr-4"><i class="fas fa-suitcase"></i></div>
                                Accessories
                            </h5>
                        </li>
                        @foreach($accessories as $accessory){
                            @include('musora.product.partials._drum-shop-card', [
                                "sku" => $accessory->sku,
                                "itemURL" => '/'.$theme.'/shop/'.str_replace( array('Drumeo-', 'Pianote-', 'Guitareo-', 'Singeo-'), '', $accessory->slug ),
                                "thumbnail" => $accessory->thumbnail,
                                "badgeText" => $accessory->badge_text,
                                "title" => $accessory->name,
                                "cardDescription" => $accessory->short_desc,
                                "fullPrice" => $accessory->price,
                                "price" => $accessory->discounted_price === '0.00' || empty($accessory->discounted_price) ? $accessory->price : $accessory->discounted_price,
                                "physical" => true,
                                "sizes" => $accessory->sizes,
                                "soldOut" => $accessory->sold_out,
                                "category" => strtolower($accessory->productType->name),
                            ])
                        }
                        @endforeach
                    </ul>
                </section>
            @endif

            @if(count($hats) > 0)
                <section class="grid-view" x-show="filter === 'clothing' || filter === 'all'">
                    <ul class="fixed-cards">
                        <li>
                            <h5 class="px-2 md:px-3 mb-4 md:mb-7 flex items-center">
                                <div class="heading-icon text-{{ $theme }}">
                                    <img
                                        class="h-10 mr-4"
                                        src="https://dpwjbsxqtam5n.cloudfront.net/drum-shop/hat.svg"
                                        alt="hat icon"
                                        style="@if($theme === 'pianote') filter: invert(1) sepia(1) brightness(.5) hue-rotate(-70deg) saturate(37); @elseif($theme === 'drumeo') filter: invert(1) sepia(1) brightness(.35) hue-rotate(140deg) saturate(37); @endif"
                                    />
                                </div>
                                Hats
                            </h5>
                        </li>
                        @foreach($hats as $hat){
                            @include('musora.product.partials._drum-shop-card', [
                                "sku" => $hat->sku,
                                "itemURL" => '/'.$theme.'/shop/'.str_replace( array('Drumeo-', 'Pianote-', 'Guitareo-', 'Singeo-'), '', $hat->slug ),
                                "thumbnail" => $hat->thumbnail,
                                "badgeText" => $hat->badge_text,
                                "title" => $hat->name,
                                "cardDescription" => $hat->short_desc,
                                "fullPrice" => $hat->price,
                                "price" => $hat->discounted_price === '0.00' || empty($hat->discounted_price) ? $hat->price : $hat->discounted_price,
                                "physical" => true,
                                "sizes" => $hat->sizes,
                                "soldOut" => $hat->sold_out,
                                "category" => strtolower($hat->productType->name),
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
                            <h5 class="px-2 md:px-3 mb-4 md:mb-7 flex items-center">
                                <div class="inline-block heading-icon text-{{ $theme }} text-3xl mr-4"><i class="fas fa-tshirt"></i></div>
                                Shirts
                            </h5>
                        </li>
                        @foreach($shirts as $shirt){
                            @include('musora.product.partials._drum-shop-card', [
                                "sku" => $shirt->sku,
                                "itemURL" => '/'.$theme.'/shop/'.str_replace( array('Drumeo-', 'Pianote-', 'Guitareo-', 'Singeo-'), '', $shirt->slug ),
                                "thumbnail" => $shirt->thumbnail,
                                "badgeText" => $shirt->badge_text,
                                "title" => $shirt->name,
                                "cardDescription" => $shirt->short_desc,
                                "fullPrice" => $shirt->price,
                                "price" => $shirt->discounted_price === '0.00' || empty($shirt->discounted_price) ? $shirt->price : $shirt->discounted_price,
                                "physical" => true,
                                "sizes" => $shirt->sizes,
                                "soldOut" => $shirt->sold_out,
                                "size_case_sensitive" => $shirt->size_case_sensitive,
                                "category" => strtolower($shirt->productType->name),
                            ])
                        }
                        @endforeach
                        @if($theme === 'drumeo')
                            @include('musora.product.partials._drum-shop-card', [
                                 "badgeText" => "SEE MORE ON TEESPRING",
                                 "itemURL" => "https://teespring.com/stores/drumeo",
                                 "thumbnail" => "https://dpwjbsxqtam5n.cloudfront.net/drum-shop/card-thumbs/teespring.jpg",
                                 "title" => "Teespring Drumeo Store",
                                 "cardDescription" => "Check out our on-demand designs that are only available through Teespring.",
                                 "specialPrice" => "Various Designs & Pricing",
                                 "price" => 'Various Designs & Pricing',
                                 "category" => "shirts",
                                 "buttonText" => "VISIT TEESPRING <i class='fas fa-external-link'></i>",
                                 "externalURL" => true,
                            ])
                        @endif
                    </ul>
                </section>
            @endif

            @if(count($hoodies) > 0)
                <section class="grid-view" x-show="filter === 'clothing' || filter === 'all'">
                    <ul class="fixed-cards container mx-auto">
                        <li>
                            <h5 class="px-2 md:px-3 mb-4 md:mb-7 flex items-center">
                                <div class="heading-icon">
                                    <img
                                        class="h-8 mr-4"
                                        src="https://dpwjbsxqtam5n.cloudfront.net/drum-shop/hoodie.svg"
                                        alt="hoodie icon"
                                        style="@if($theme === 'pianote') filter: invert(1) sepia(1) brightness(.5) hue-rotate(-70deg) saturate(37); @elseif($theme === 'drumeo') filter: invert(1) sepia(1) brightness(.35) hue-rotate(140deg) saturate(37); @endif"
                                    />
                                </div>
                                Hoodies
                            </h5>
                        </li>
                        @foreach($hoodies as $hoodie){
                            @include('musora.product.partials._drum-shop-card', [
                                "sku" => $hoodie->sku,
                                "itemURL" => '/'.$theme.'/shop/'.str_replace( array('Drumeo-', 'Pianote-', 'Guitareo-', 'Singeo-'), '', $hoodie->slug ),
                                "thumbnail" => $hoodie->thumbnail,
                                "badgeText" => $hoodie->badge_text,
                                "title" => $hoodie->name,
                                "cardDescription" => $hoodie->short_desc,
                                "fullPrice" => $hoodie->price,
                                "price" => $hoodie->discounted_price === '0.00' || empty($hoodie->discounted_price) ? $hoodie->price : $hoodie->discounted_price,
                                "physical" => true,
                                "sizes" => $hoodie->sizes,
                                "soldOut" => $hoodie->sold_out,
                                "category" => strtolower($hoodie->productType->name),
                            ])
                        }
                        @endforeach
                    </ul>
                </section>
            @endif
        @else
            <section class="grid-view" x-show="filter === 'clothing' || filter === 'all'">
                <ul class="fixed-cards container mx-auto">
                    @foreach($products as $product){
                        @include('musora.product.partials._drum-shop-card', [
                            "sku" => $product->sku,
                            "itemURL" => '/'.$theme.'/shop/'.str_replace( array('Drumeo-', 'Pianote-', 'Guitareo-', 'Singeo-'), '', $product->slug ),
                            "thumbnail" => $product->thumbnail,
                            "thumbnail_logo" => $product->thumbnail_logo,
                            "badgeText" => $product->badge_text,
                            "title" => $product->name,
                            "cardDescription" => $product->short_desc,
                            "fullPrice" => $product->price,
                            "price" => $product->discounted_price === '0.00' || empty($product->discounted_price) ? $product->price : $product->discounted_price,
                            "sizes" => $product->sizes,
                            "soldOut" => $product->sold_out,
                            "size_case_sensitive" => $product->size_case_sensitive,
                            "category" => strtolower($product->productType->name),
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
            var originalLink = '/ecommerce/add-to-cart?go-back-to-shop=true';

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
