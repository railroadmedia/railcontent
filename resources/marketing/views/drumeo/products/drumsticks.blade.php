@extends('drumeo.products.misc-products-layout', [
    "appTailwind" => true
])

@section('meta')
    @parent
    <title>The Vater Drumeo 5A Drumsticks</title>
    <meta name="description" content="Made with hickory wood and up to 2X the moisture content of most drumstick manufacturers.">
    <meta property="og:image" content="https://dpwjbsxqtam5n.cloudfront.net/drum-shop/vater-sticks/og-image.jpg" style="display: none;">
    <meta property="og:title" content="The Vater Drumeo 5A Drumsticks">
    <meta property="og:description" content="Made with hickory wood and up to 2X the moisture content of most drumstick manufacturers.">
    <meta property="og:url" content="https://www.drumeo.com/{{ Request::path() }}">
@stop()

@section('head')
    @parent
    <link href="{{ asset('/marketing/parcel/drumeo/vater-sticks.css') }}" rel="stylesheet">

    <?php \App\Analytics\Tracker::trackProductImpression('Drumeo-VaterSticks'); ?>
@stop()

@section('scripts')
    @parent
    <script src="{{ asset('/marketing/js/modal-autoplay.js') }}"></script>
@stop()

@section('body-data')
    x-data="{ trailer: false }"
@endsection

@section('content')

    @include('_partials.components.shop.promo-banner', [
        "name" => "Drumeo Drumsticks",
        "fullPrice" => floatval($productPrices['Drumeo-VaterSticks']->price),
        "price" => floatval($productPrices['Drumeo-VaterSticks']->discounted_price),
        "noBreadcrumb" => true
    ])
    <header class="header text-center">
        <video poster="https://dpwjbsxqtam5n.cloudfront.net/drum-shop/vater-sticks/header-thumbnail.jpg" src="https://dpwjbsxqtam5n.cloudfront.net/drum-shop/vater-sticks/header-video-2.mp4" type="video/mp4" autoplay="" loop="" playsinline="" muted></video>
        <div class="overlay"></div>
        <div class="row">
            <img class="logo" src="https://dpwjbsxqtam5n.cloudfront.net/drum-shop/vater-sticks/drumeo-drumsticks-logo.png" alt="Drumstick logo">
            <br>
            <div class="watch-badge">
                Watch The <br>
                10,000 Rimshot  <br>
                Challenge
                <img src="https://dpwjbsxqtam5n.cloudfront.net/sales/arrow-left-white.png" alt="Left arrow">
            </div>
            <img @click="trailer = true;" class="play-button autoplay-video" src="https://dpwjbsxqtam5n.cloudfront.net/sales/play-button.png" alt="Play button">
            <br>
            <a class="join blue" href="/ecommerce/add-to-cart?products[Drumeo-VaterSticks]=1">Grab A Pair &raquo;</a>
            {{--<a class="join sold-out">Sold Out</a>--}}
            <p class="dense">
                @if(floatval($productPrices['Drumeo-VaterSticks']->price) > floatval($productPrices['Drumeo-VaterSticks']->discounted_price))
                    <s>${{ floatval($productPrices['Drumeo-VaterSticks']->price) }}</s>
                    <strong>Only ${{ floatval($productPrices['Drumeo-VaterSticks']->discounted_price), 2 }}</strong>
                    (Save {{ round(100 - (100 * (floatval($productPrices['Drumeo-VaterSticks']->discounted_price) / floatval($productPrices['Drumeo-VaterSticks']->price)))) }}%)
                @else
                    <strong>Only ${{ floatval($productPrices['Drumeo-VaterSticks']->discounted_price) }}</strong>
                @endif
            </p>
        </div>

        @component('_partials.components.video-modal',[
            'name' => 'trailer',
            'video' => '436834726',
            'vimeo' => true,
        ])
            @slot('button')
                <div class="text-center bg-white rounded-b-xl py-4">
                    <a class="join blue" href="/ecommerce/add-to-cart?products[Drumeo-VaterSticks]=1">Grab A Pair &raquo;</a>
                </div>
            @endslot
        @endcomponent
    </header>


    <section class="content-section text-center moisture"
            style="background-position:center bottom;background-image:url(https://dpwjbsxqtam5n.cloudfront.net/drum-shop/vater-sticks/water-bg.jpg);">
        <div class="row">
            <h1><strong>Dry drumsticks <br class="hide-for-medium"> snap like twigs.</strong></h1>
            <h5>Drumeo 5A Drumsticks by Vater have up to <strong>double the moisture</strong> content of regular<br
                        class="show-for-medium"> drumsticks — giving you a longer-lasting stick you can count on.</h5>
        </div>
    </section>
    <section class="content-section text-center moisture" style="background-color:#f4f8fb; color:#000;">
        <div class="row">
            <div class="columns medium-4">
                <i class="fa-light fa-axe text-blue"></i>
                <h2>HICKORY WOOD </h2>
                <p>
                    <em class="text-blue">For strength and durability.</em><br>
                    Hickory holds the perfect balance of strength and durability while absorbing an amazing amount of shock. That’s why it’s found in all kinds of important striking tools such as axes, mallets, and hammers. High-quality hickory drumsticks allow you to play for long periods of time without fatiguing from negative vibrations.
                </p>
            </div>
            <div class="columns medium-4">
                <i class="fa-light fa-tint text-blue"></i>
                <h2>2X MOISTURE </h2>
                <p>
                    <em class="text-blue">For longer-lasting sticks.</em><br>
                    Vater drumsticks use a dowel moisture content specific to striking tools (10-12%), while other drumstick manufacturers use a moisture content known for furniture manufacturing (6-8%). The more water you extract, the weaker the wood. The more water moisture present (like ours), the stronger the wood - giving you more music out of each pair.
                </p>
            </div>
            <div class="columns medium-4">
                <i class="fa-light fa-hand-sparkles text-blue"></i>
                <h2>HAND ROLLED </h2>
                <p>
                    <em class="text-blue">For better sticks, every time. </em><br>
                    Alan Vater personally rolls every pair of sticks before they leave the Vater factory. The Vater stamp is reserved for only the finest, most evenly rolled sticks. You can play with confidence knowing your pair of Drumeo Drumsticks has been weighted, tone matched, and rolled to perfection by the master himself before reaching your hands.
                </p>
            </div>
        </div>
    </section>
    <section class="content-section text-center tools"
            style="background-image:url(https://dpwjbsxqtam5n.cloudfront.net/drum-shop/vater-sticks/your-tools-bg.jpg);">
        <div class="row">
            <h1><strong>Your tools matter.</strong></h1>


            <p>An artist’s brush, a carpenter’s hammer, a drummer’s drumstick. <br><br> Your tools matter.
                <br><br> So when Alan Vater offered to personally open up the shop anytime, day or night, to ensure Drumeo students would always have their sticks, I knew I found the perfect fit.
                <br><br> Drumeo has a bigger community than ever, with drummers all over the world playing in thousands of different situations. When I was thinking about our next drumstick, I didn’t want it to be just another drumstick with a Drumeo logo on it. I wanted a stick with the
                <strong>versatility</strong> to meet a wide range of needs and the
                <strong>durability</strong> to get your money's worth out of every pair.
                <br><br> Vater’s high standards for quality and their grassroots, family-owned style really resonate with me. Growing up on a farm, these are the same values my dad displayed every day to get the job done. In many ways, partnering with Vater on these new Drumeo Drumsticks feels like working with family — and that's important to me.
                <br><br> Vater drumsticks have a rich history with Alan & Ron Vater’s grandfather, Jack Adams, starting out by making drumsticks for his jazz drummer friends in the Boston area —
                <strong>Buddy Rich, Elvin Jones, and Philly Joe Jones</strong>. That tradition of excellence continues today with Vater being used by drummers in the last nine Superbowl Halftime Shows!
                <br><br> Your drumsticks are an extension of your unique personality behind the kit. That's why I'm so excited to partner with Vater, a company that has been helping drummers achieve excellence for a long time. When you pick up a pair of Drumeo 5A Drumsticks by Vater, you're not just picking up another pair of hickory drumsticks. You're picking up a pair of history.
            </p>

            <img class="signature" src="https://dpwjbsxqtam5n.cloudfront.net/drum-shop/vater-sticks/signature.png" alt="Jared signature"><br>
            <img class="avatar" src="https://dpwjbsxqtam5n.cloudfront.net/drum-shop/vater-sticks/jared-falk.jpg" alt="Jared Falk"><br>
            <h5><strong>JARED FALK</strong></h5>
            <p class="text-blue">FOUNDER OF DRUMEO</p>

        </div>
    </section>
    <section class="content-section text-center company" style="background-color:#f4f8fb;color:#000;">

        <h1><strong>You’re in good company.</strong></h1>
        <h5>Vater sticks were originally made for the owner of Jack’s Drum Shop’s
            <br class="show-for-medium">
            jazz drummer friends — <strong>Buddy Rich, Elvin Jones, and Philly Joe Jones</strong>.
            <br><br>
            That tradition continues today with many of the world’s <br class="show-for-medium-only">
            most legendary drummers choosing Vater sticks.
        </h5>
        <div class="container mx-auto my-7">
            <div class="flex flex-wrap justify-center">
                @php
                    $images = [
                        [
                        "img" => "https://dpwjbsxqtam5n.cloudfront.net/drum-shop/vater-sticks/stewart-copeland.jpg",
                        "artist" => "Stewart Copeland",
                        "band" => "The Police"
                        ],
                        [
                        "img" => "https://image-cdn-ak.spotifycdn.com/image/ab67706c0000da849df515eaf42d2b34f2ea86ae",
                        "artist" => "Elise Trouw",
                        "band" => "Independent"
                        ],
                        [
                        "img" => "https://dpwjbsxqtam5n.cloudfront.net/drum-shop/vater-sticks/sarah-jones.jpg",
                        "artist" => "Sarah Jones",
                        "band" => "Harry Styles"
                        ],
                        [
                        "img" => "https://www.musora.com/musora-cdn/image/width=500,quality=95/https://drumeoblog.s3.amazonaws.com/beat/wp-content/uploads/2023/04/18004218/2023-03-30-Chad-Smith-Live-151-1.jpg",
                        "artist" => "Chad Smith",
                        "band" => "Red Hot Chili Peppers"
                        ],
                        [
                        "img" => "https://dpwjbsxqtam5n.cloudfront.net/drum-shop/vater-sticks/max-weinberg.jpg",
                        "artist" => "Max Weinberg",
                        "band" => "Bruce Springsteen"
                        ],
                        [
                        "img" => "https://m.media-amazon.com/images/M/MV5BNzc2ODE0OTk0Ml5BMl5BanBnXkFtZTcwOTUzOTQwOQ@@._V1_FMjpg_UX1000_.jpg",
                        "artist" => "Brad Wilk",
                        "band" => "Rage Against The Machine"
                        ],
                        [
                        "img" => "https://dpwjbsxqtam5n.cloudfront.net/drum-shop/vater-sticks/brian-frasier-moore.jpg",
                        "artist" => "Brian Frasier-Moore",
                        "band" => "Justin Timberlake"
                        ],
                        [
                        "img" => "https://miro.medium.com/v2/resize:fit:1400/1*CUwi6l0nyt5mx1juUeC52g.jpeg",
                        "artist" => "Vinnie Colaiuta",
                        "band" => "Studio Legend"
                        ],
                        [
                        "img" => "https://dpwjbsxqtam5n.cloudfront.net/drum-shop/vater-sticks/matt-mcguire.jpg",
                        "artist" => "Matt McGuire",
                        "band" => "The Chainsmokers"
                        ],
                        [
                        "img" => "https://www.musora.com/musora-cdn/image/width=500,quality=95/https://drumeoblog.s3.amazonaws.com/beat/wp-content/uploads/2022/06/21150547/2022-01-15-COACH-Greyson-AM-116.jpg",
                        "artist" => "Greyson Nekrutman",
                        "band" => "Sepultura"
                        ],
                        [
                        "img" => "https://dpwjbsxqtam5n.cloudfront.net/drum-shop/vater-sticks/josh-freese.jpg",
                        "artist" => "Josh Freese",
                        "band" => "Foo Fighters"
                        ],
                        [
                        "img" => "https://dpwjbsxqtam5n.cloudfront.net/drum-shop/vater-sticks/mike-mangini.jpg",
                        "artist" => "Mike Mangini",
                        "band" => "Independent"
                        ]
                    ];
                @endphp
                @foreach ($images as $image)
                    <div class="flex flex-col items-center justify-start px-2 mb-4  w-1/2 sm:w-1/4 lg:w-1/6">
                        <div class="relative w-full rounded-xl overflow-hidden" style="padding-bottom: 100%;">
                            <picture>
                                <img
                                    class="absolute top-0 left-0 w-full h-full object-cover object-top"
                                    src="{{$image['img']}}"
                                />
                            </picture>
                        </div>
                        <div class="w-full text-center mt-2 lg:mt-3">
                            <h6 class="leading-none font-extrabold mb-1">{!! $image['artist'] !!}</h6>
                            <p class="leading-none text-xs sm:text-sm text-drumeo">{!! $image['band'] !!}</p>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
        <h5>& many more of the best drummers in the world.</h5>

    </section>

    <div id="customize-anchor" class="anchor"></div>
    <section class="content-section text-center customize px-4 lg:px-6" style="background:#173c59 url('https://d21q7xesnoiieh.cloudfront.net/fit-in/2000x0/filters:quality(95)/marketing/drumeo/shop/stickbag/order-bg.jpg') center center/cover;">
        <div class="top-0 left-0 absolute w-full h-full z-10" style="background: linear-gradient(to right, rgba(7,23,43,0.5), rgba(26,32,38,0.5));"></div>
        <div class="container mx-auto relative z-20">
            <img alt="logo" class="h-20 sm:h-28 mb-10" src="https://dpwjbsxqtam5n.cloudfront.net/drum-shop/vater-sticks/drumeo-drumsticks-logo.png"><br>

            @if( $products['Drumeo-VaterSticks']->getStockAvailability() > 1 && !empty($products['Drumeo-VaterSticks']->getStockAvailability()))

                <div class="flex flex-wrap items-start justify-center 2-full max-w-sm md:max-w-2xl mx-auto">
                    <div class="w-full md:w-1/2 px-2 md:px-3 relative">
                        @if(floatval($productPrices['Drumeo-VaterSticks']->price) > floatval($productPrices['Drumeo-VaterSticks']->discounted_price))
                            <p class="inline-block relative -bottom-1 mb-1 px-5 py-1 z-10 leading-tight text-xs rounded-full bg-black uppercase" >
                                Save {{ round(100 - (100 * (floatval($productPrices['Drumeo-VaterSticks']->discounted_price) / floatval($productPrices['Drumeo-VaterSticks']->price)))) }}%
                            </p>
                        @endif
                        <a href="/ecommerce/add-to-cart?products[Drumeo-VaterSticks]=1" class="text-black overflow-hidden rounded-2xl block mx-auto mb-4 md:mb-0 group border-2 border-black">
                            <div class="bg-white px-3 py-5 md:py-7">
                                <h4 class="mb-2 sm:mb-3"><strong>Drumsticks Only</strong></h4>
                                <img class="h-32 transition-opacity opacity-0"
                                    loading="lazy"
                                    onload="this.classList.remove('opacity-0')"
                                    src="https://www.musora.com/musora-cdn/image/width=200,quality=95/https://d1fyshwdvi6fth.cloudfront.net/Drumeo/Thumbnails/e36ad306-8ba6-4db5-99bc-bd955080a57a-2023-06-21-Vater-Sticks-101-White-Backdrop+(1).jpg"
                                    alt="learn playing image"
                                >
                                <br>
                                <h4 class="inline-block leading-tight">
                                    @if(floatval($productPrices['Drumeo-VaterSticks']->price) > floatval($productPrices['Drumeo-VaterSticks']->discounted_price))
                                        <s>${{ floatval($productPrices['Drumeo-VaterSticks']->price) }}</s>
                                    @endif

                                    <strong>${{ floatval($productPrices['Drumeo-VaterSticks']->discounted_price) }}</strong></h4>
                                <p class="text-sm"><em>
                                        @if(floatval($productPrices['Drumeo-VaterSticks']->price) > floatval($productPrices['Drumeo-VaterSticks']->discounted_price))
                                            Save {{ round(100 - (100 * (floatval($productPrices['Drumeo-VaterSticks']->discounted_price) / floatval($productPrices['Drumeo-VaterSticks']->price)))) }}%
                                        @endif
                                        One-time payment.</em></p>
                                <div class="join mt-5 musora-black smaller w-full transition-opacity duration-300 group-hover:opacity-80 max-w-[230px]">Select</div>
                            </div>
                        </a>

                    </div>
                </div>
            @else
                <a class="join sold-out mt-5 sm:mt-10">SOLD OUT</a>
            @endif
        </div>
    </section>

    <section class="text-center py-10 text-white" style="background: #00101D;">
        <div class="container mx-auto relative z-50">
            <div class="inline-block w-full px-3 md:px-4 mb-5 text-light-navy">
                <p>Call us toll-free at
                    <a href="tel:+18004398921">1-800-439-8921</a> <br class="inline-block md:hidden"> or directly at
                    <a href="tel:+16048557605">1-604-855-7605</a>.<br> All prices listed in USD. </p>
            </div>
            <div class="inline-block w-full px-3 md:px-4 text-light-navy" style="margin-top: 0;">
                <i class="mx-0.5 text-3xl md:text-4xl fab fa-cc-visa"></i>
                <i class="mx-0.5 text-3xl md:text-4xl fab fa-cc-mastercard"></i>
                <i class="mx-0.5 text-3xl md:text-4xl fab fa-cc-amex"></i>
                <i class="mx-0.5 text-3xl md:text-4xl fab fa-cc-paypal"></i>
                <i class="mx-0.5 text-3xl md:text-4xl fab fa-cc-discover"></i>
            </div>
        </div>
    </section>

@stop


