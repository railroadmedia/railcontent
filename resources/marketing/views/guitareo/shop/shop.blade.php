@extends('_partials.layout.global-shop-layout')

@section('meta')
    <title>Guitareo Shop</title>
    <meta property="og:title" content="Guitareo Shop">
    <meta name="description" content="Say goodbye to “do it yourself” guitar lessons.">
    <meta property="og:description" content="Say goodbye to “do it yourself” guitar lessons.">

        <meta property="og:image" content="https://d21q7xesnoiieh.cloudfront.net/fit-in/1200x0/filters:quality(95)/marketing/guitareo/promos/november/xmas-guitareo-shop-share-image.jpg">
    <meta property="og:url" content="https://www.guitareo.com/shop/">
@endsection

@section('x-data')
    filter: '{{ $category !== 'shop' ? $category : 'all' }}',
@endsection

@section('layout-header')
    @include("guitareo.sales.partials._nav", [
        "cartVersion" => true
    ])
@endsection

@section('body')
    @include('_partials.components.shop.promo-shop-header',[
        'text' => 'GET LESSONS, ACCESSORIES, & MORE',
        'bg' => 'https://d122ay5chh2hr5.cloudfront.net/sales/promos/black-friday/shop-bg.jpg',
    ])

    @include('_partials.components.shop.index-filters', [
        "noClothing" => true
    ])
    <div class="sm:px-4 lg:px-5 py-5 sm:py-8 lg:py-10">
        <div id="lessons" class="anchor"></div>
        <section class="grid-view category-section" data-category="lessons" x-show="filter === 'lessons' || filter === 'all'">
            <div class="container">
                <h5 class="leading-tight mb-4 md:mb-5"><strong><i class="fas fa-video text-{{ $brand }} mr-1"></i> Guitar Lessons</strong></h5>
                <div class="fixed-cards grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 2xl:grid-cols-5 gap-2 md:gap-4 text-left">
                    @include('_partials.components.shop.product-card', [
                     "itemURL" => "/",
                     "sku" => null,
                     "thumbnail" => "https://d122ay5chh2hr5.cloudfront.net/sales/promos/july/guitareo-membership-shop.jpg",
                     "title" => "Guitareo Membership",
                     "packAuthor" => "Ayla Tesler-Mabe",
                     "cardDescription" => "Unlimited guitar lessons, a huge song library, and ongoing support from real teachers.",
                     "specialPrice" => "7-Day Free Trial",
                     "fullPrice" => 240,
                     "price" => 150,
                     "category" => "lessons",
                     "buttonText" => "Start For Free <i class='fas fa-arrow-right'></i>",
                     'soldOut' => false,
                ])
                @foreach($lessons as $key => $lesson)
                    @include('_partials.components.shop.product-card', [
                            "sku" => $lesson->sku === 'drumeo' || $lesson->sku === 'pianote' || $lesson->sku === 'singeo' || $lesson->sku === 'guitareo' ? null : $lesson->sku,
                            "itemURL" => '/shop/'.str_replace( array('Drumeo-', 'Pianote-', 'Guitareo-', 'Singeo-'), '', $lesson->slug ),
                            "thumbnail" => $lesson->thumbnail,
                            "packLogo" => $lesson->thumbnail_logo,
                            "title" => $lesson->name,
                            "packAuthor" => $lesson->instructor_name,
                            "cardDescription" => $lesson->short_desc,
                            "fullPrice" => $lesson->price,
                            "price" => $lesson->discounted_price,
                            "category" => strtolower($lesson->productType->name),
                            "soldOut" => $lesson->sold_out,
                            "includedMembership" => $lesson->included_edge,
                            "badgeText" => $lesson->badge_text,
                            'FCP' => $key < 4 ? true : null,
                    ])
                @endforeach
            </div>
            </div>
        </section>

        {{--   ACCESSORIES     --}}
        <div id="accessories" class="anchor"></div>
        <section class="grid-view category-section" data-category="shirts" x-show="filter === 'accessories' || filter === 'all'">
            <div class="container">
                <h5 class="leading-tight mb-4 md:mb-5"><strong><i class="fas fa-suitcase text-{{ $brand }} mr-1"></i> Accessories</strong></h5>
                <div class="fixed-cards grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 2xl:grid-cols-5 gap-2 md:gap-4 text-left">
                    @foreach($accessories as $accessory)
                    @include('_partials.components.shop.product-card', [
                            "sku" => (str_contains($accessory->sku, 'member') || str_contains($accessory->sku, 'products')) ? '' : $accessory->sku,
                            "itemURL" => '/shop/'.str_replace( array('Drumeo-', 'Pianote-', 'Guitareo-', 'Singeo-'), '', $accessory->slug ),
                            "thumbnail" => $accessory->thumbnail,
                            "badgeText" => $accessory->badge_text,
                            "title" => $accessory->name,
                            "cardDescription" => $accessory->short_desc,
                            "fullPrice" => $accessory->price,
                            "sizes" => $accessory->sizes,
                            "price" => $accessory->discounted_price,
                            "category" => strtolower($accessory->productType->name),
                            "soldOut" => isset($products[$accessory->sku]) ? $products[$accessory->sku]->getStockAvailability() === 0 : $accessory->sold_out,
                            "size_case_sensitive" => $accessory->size_case_sensitive,
                    ])
                @endforeach
            </div>
            </div>
        </section>

    </div>
    <section class="content-section text-white text-center px-6 py-10 sm:py-20" style="background:linear-gradient(to bottom, #01050f, #021225);overflow:visible">
        <div class="container mx-auto max-w-4xl">
            <img class="h-28 md:h-32 lazyload" src="https://www.musora.com/musora-cdn/image/width=250,quality=95/https://d122ay5chh2hr5.cloudfront.net/sales/2022/guitareo-guarantee.png" alt="guitareo-guarantee">

            <h3 class="leading-tight mt-5 md:mt-8 mb-4 md:mb-6 " data-aos-once="true" data-aos="fade-up" data-aos-offset="150" data-aos-delay="150"><strong>Happy student guarantee. </strong><br>
                Test-drive your lessons for 90 days. Zero risk. </h3>
            <p class=" opacity-60 leading-normal md:leading-loose">Online lessons can be intimidating. Maybe you’re wondering if they work, or if you’ll use them enough – or if you’ll even enjoy the experience. So we’re removing the risk with our 90-day guarantee. More than anything, we want to make sure you have a POSITIVE experience developing new skills and gaining confidence on the guitar. </p>
            <div class="flex flex-wrap items-start justify-center mt-5 md:mt-7">
                <div class="w-full sm:w-1/3 px-2 mb-3 sm:mb-0">
                    <h5 class="text-guitareo border-guitareo border-2 rounded-full inline-block py-2 px-3 mb-1">1</h5>
                    <h6 class="leading-normal">Start your<br> lessons today.</h6>
                </div>
                <div class="w-full sm:w-1/3 px-2 mb-3 sm:mb-0">
                    <h5 class="text-guitareo border-guitareo border-2 rounded-full inline-block py-2 px-3 mb-1">2</h5>
                    <h6 class="leading-normal">Enjoy them for 90<br> days, risk-free.</h6>
                </div>
                <div class="w-full sm:w-1/3 px-2">
                    <h5 class="text-guitareo border-guitareo border-2 rounded-full inline-block py-2 px-3 mb-1">3</h5>
                    <h6 class="leading-normal">Change your mind?<br> Get a refund.
{{--                        <div class="inline-block tooltip cursor-pointer bg-white" tip="If it’s not for you, simply cancel your membership within 90 days and contact us for a full refund. (If your membership includes any bonuses, your refund will deduct the value of hard goods that were shipped to you.)"><i class="fas fa-info-circle text-white"></i></div>--}}
                    </h6>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('layout-footer')
    @include("guitareo.sales.partials._footer")
@endsection
