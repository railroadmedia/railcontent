@php
    require_once(resource_path('marketing/views/pianote/_partials/bonus-data-2024.php'));
    require_once(resource_path('marketing/views/pianote/_partials/homepage-data.php'));
    require_once(resource_path('marketing/views/pianote/_partials/bonus-data.php'));
@endphp

@extends('pianote._partials.global-layout')

@section('global-head')
    @parent
    <title>Book Bundle| Pianote</title>
    <meta property="og:title" content="Book Bundle | Pianote">
    <meta name="description" content="Get The Best Piano Lessons And A Library Of Piano Books">
    <meta property="og:description" content="Get The Best Piano Lessons And A Library Of Piano Books">
    <meta property="og:image"
        content="https://d21q7xesnoiieh.cloudfront.net/fit-in/1200x0/marketing/pianote/promos/black-friday/book-bundle-share-image.jpg"
        style="display: none;">
    <meta property="og:url" content="https://www.pianote.com/{{ Request::path() }}">
    <script defer src="https://cdn.jsdelivr.net/npm/@alpinejs/focus@3.x.x/dist/cdn.min.js"></script>


    @include('_partials.layout._fonts')
    <link rel="stylesheet" href="{{ mix('marketing/css/app.css') }}">
    <link href="{{ asset('/marketing/css/tailwind-helpers.css') }}" rel="stylesheet">
    <link href="{{ asset('/marketing/parcel/drumeo/nav-footer-pianote.css') }}" rel="stylesheet">
    <link href="{{ asset('/marketing/parcel/drumeo/30dd.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@splidejs/splide@4.1.4/dist/css/splide.min.css">
    <style>
    #guarantee-section{
        background-color: #F4F8FB !important;
    }
    #guarantee-block{
        background: linear-gradient(to bottom right, transparent calc(50% - 1px), transparent, #F4F8FB calc(50% + 1px)) !important;
    }
    </style>
@stop()


@section('body-data')
   x-data="{
        @foreach($bonusVideos as $bonusVideo)
            @if(!empty($bonusVideo['vimeoId']))
                modal{{ $bonusVideo['vimeoId'] }}: false,
            @endif
        @endforeach
    }"
@endsection
@php
    $stock = !empty($products['alesis-ekit']->getPublicStockCount())
        ? $products['alesis-ekit']->getPublicStockCount()
        : 0;
@endphp

@section('global-body')
    @include('pianote.sales.partials._nav', [
        'cartVersion' => true,
    ])
    {{-- @include('_partials.components.shop.promo-banner-2', [
        'name' => 'Classical Piano Pieces',
        'fullPrice' => floatval($productPrices['read-music-in-30-days-workbook']->price),
        'price' => floatval($productPrices['read-music-in-30-days-workbook']->discounted_price),
        'noBreadcrumb' => true,
    ]) --}}
     <header class="text-white relative overflow-hidden z-10 object-cover object-center h-[700px] lg:h-[800px]" style="background: url('https://d21q7xesnoiieh.cloudfront.net/fit-in/1200x0/filters:quality(95)/marketing/pianote/promos/black-friday/the-book-bundle/header-bg.webp') no-repeat center center; background-size: cover;">
        <div class="transform -translate-y-1/2 top-1/2 left-0 w-full absolute z-20 px-4 lg:px-6 text-center">
            <div class="container mx-auto max-w-5xl lg:pt-10">
                <img alt="Bundle Logo" class="h-16 sm:h-18" src="https://d21q7xesnoiieh.cloudfront.net/fit-in/1200x0/filters:quality(95)/marketing/pianote/promos/black-friday/the-book-bundle/book-bundle-logo.svg"><br>
                <h2 class="leading-tight my-3 lg:my-6"><strong>Get The Best Piano Lessons And A <br class="hidden md:block">Library Of Piano Books</strong></h2>
                <img class="hidden md:inline object-cover max-w-3xl lg:max-w-4xl mx-auto" src="https://d21q7xesnoiieh.cloudfront.net/fit-in/1600x0/filters:quality(95)/marketing/pianote/promos/black-friday/the-book-bundle/header-collage.webp" alt="Bundle Collage">
                <img class="md:hidden object-cover w-full sm:max-w-2xl p-4" src="https://d21q7xesnoiieh.cloudfront.net/fit-in/800x0/filters:quality(95)/marketing/pianote/promos/black-friday/the-book-bundle/header-collage.webp" alt="Bundle Collage Mobile">
               <div class="px-3 mx-auto w-full max-w-2xl">
                    <h2 class="leading-none my-1 md:my-4"><s class="opacity-50"> $1321</s><strong> $399</strong> <span class="text-[#A285FF] text-3xl">(Save 66%)</span></h2>
                    @if($stock > 0)
                        <a class="join pianote mt-4 w-full anchor-slide uppercase" href="#customize-anchor">get the deal</a>
                    @else
                        <a class="join sold-out mt-4 w-full anchor-slide" href="#customize-anchor">SOLD OUT</a>
                    @endif
                    </div>
                </div>
            </div>
        </div>
    </header>
     @include('pianote._partials.bf-header-bottom')


    @php
        $videoTargetSkus = ['pianote-membership', 'book-bag', 'practice-kit', 'little-book-bundle', 'piano-chords-and-scales-guide', 'pianote-practice-planner', 'classical-piano-pieces'];
    @endphp

    <section class="pt-8 pb-16 sm:pt-16 lg:pt-20 px-4 sm:px-6 bg-white">
        <div class="container mx-auto max-w-5xl">
         <h1 class="leading-tight text-center mb-3"><strong>Here’s what you’ll get <br> with this bundle. </strong></h1>
        <h5 class="leading-normal text-center mb-3 lg:pb-6 md:px-8 max-w-4xl">
        Piano players LOVE books. That’s why we’ve loaded this bundle with practice books, planners, and songbooks to fill your shelves.<br><br>Improve your chording, plan and track your progress, and play the most beautiful piano pieces ever written.
        </h5>

            @include('drumeo._partials.bf-bonus-section', [
            'videoTargetSkus' => $videoTargetSkus,
            ])
        </div>
    </section>

    @php
        $videoTargetSkus2 = ['new-piano-players-start-here', 'easy-chords', '30-day-blues-piano', '30-days-to-better-technique', 'easy-chords', 'classical-piano-collection'];
    @endphp

    <section class="pt-8 pb-16 lg:pb-28 px-4 sm:px-6 bg-white">
        <div class="container mx-auto max-w-5xl">
         <h1 class="leading-tight text-center mb-3"><strong>Bonus lessons.  <br> Yours for life. </strong></h1>
        <h5 class="leading-normal text-center mb-3 lg:pb-6 md:px-8 max-w-4xl">
       You’ll get LIFETIME access to all these courses when you join Pianote. Even if you don’t renew your membership. These lessons are yours to keep for life.<br><br> Start learning, improve your chording and technique. Play the Blues and beautiful Classical piano. It’s all here.
        </h5>

            @include('drumeo._partials.bf-bonus-section', [
            'videoTargetSkus' => $videoTargetSkus2,
            ])
        </div>
    </section>

    <div x-data="{lazyLoad: false}">
         @include('musora.sales.components.guarantee-section', [
        'badge' => 'marketing/pianote/membership/homepage/webp-format/piano-guarantee.webp',
        'header' => '<strong>Happy student guarantee.</strong><br>Test-drive your lessons for 90 days. Zero risk.',
        'desc' => 'Online lessons can be intimidating. Maybe you’re wondering if they work, or if you’ll use them enough – or if you’ll even enjoy the experience. So we’re removing the risk with our 90-day guarantee. More than anything, we want to make sure you have a POSITIVE experience developing new skills and gaining confidence on the piano.',
    ])
        @include('drumeo._partials.countdown-bundle-2024')

        @php
            $targetSkus = ['practice-kit', 'little-book-bundle', 'piano-chords-and-scales-guide', 'pianote-practice-planner', 'classical-piano-pieces', 'new-piano-players-start-here', 'easy-chords', '30-day-blues-piano', '30-days-to-better-technique', 'classical-piano-collection'];
        @endphp
            <div id="customize-anchor"></div>
            @include('drumeo._partials.bf-order-section-bonuses', [
            'bgColor' => 'background:linear-gradient(to bottom, #131633, #000);',
            'promoLogo' => 'https://d21q7xesnoiieh.cloudfront.net/fit-in/1200x0/filters:quality(95)/marketing/pianote/promos/black-friday/the-book-bundle/book-bundle-logo.svg',
            'logoHeight' => 'h-16 sm:h-20',
            'topImage' => 'marketing/pianote/promos/black-friday/the-book-bundle/bonus-AM.webp',
            'secondImage' => 'marketing/pianote/promos/black-friday/the-book-bundle/bonus-BB.webp',
            'bonusWidth' => 'w-1/2 md:w-1/3 lg:w-1/5',
            'promoHeader' => '<h2 class="leading-tight mb-4 sm:mb-5"><strong>Get The Best Online Piano Lessons And A <br class="hidden md:block">Library Of Piano Books</h2>',
            'buttonLink' => '/ecommerce/add-to-cart?products[PIANOTE-MEMBERSHIP-1-YEAR]=1&products[the-book-bundle]=1&promo-code=book-bundle&locked=true',
            'bundle'=> "book",
            ])
    </div>

     @php
        $videoBonuses = [];
        foreach ($bonusVideos as $bonusVideo) {
            if (!empty($bonusVideo['vimeoId']) && in_array($bonusVideo['sku'], $videoTargetSkus)) {
                $videoBonuses[] = ['name' => 'modal' . $bonusVideo['vimeoId'], 'video' => $bonusVideo['vimeoId']];
            }
        }
    @endphp

    @foreach ($videoBonuses as $modal)
        @include('_partials.components.video-modal', [
            'name' => $modal['name'],
            'video' => $modal['video'],
            'vimeo' => true,
        ])
    @endforeach

    @include('pianote.sales.partials._footer')

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script type="text/javascript" src="{{ asset('/marketing/js/modal.js') }}"></script>
    <script type="text/javascript" src="{{ asset('/marketing/parcel/drumeo/navigation-sales.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/@splidejs/splide@4.1.4/dist/js/splide.min.js"></script>

@stop
