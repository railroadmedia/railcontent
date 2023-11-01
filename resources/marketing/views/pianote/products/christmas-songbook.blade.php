@extends('pianote._partials.global-layout')

@section('global-head')
    @parent
    <title>The Pianote Christmas Songbook | Pianote</title>
    <meta property="og:title" content="The Pianote Christmas Songbook">
    <meta name="description" content="Christmas classics to make your holiday season extra special. Presented in original and simplified arrangements.">
    <meta property="og:description" content="Christmas classics to make your holiday season extra special. Presented in original and simplified arrangements.">
    <meta property="og:image" content="https://d21q7xesnoiieh.cloudfront.net/fit-in/1200x0/filters:quality(95)/marketing/pianote/products/christmas-songbook/share-image.jpg" style="display: none;">
    <meta property="og:url" content="https://www.pianote.com/{{ Request::path() }}">

    @include('_partials.layout._fonts')
    <link rel="stylesheet" href="{{ mix('marketing/css/app.css') }}">
    <link href="{{ asset('/marketing/css/tailwind-helpers.css') }}" rel="stylesheet">
    <link href="{{ asset('/marketing/parcel/drumeo/nav-footer-pianote.css') }}" rel="stylesheet">
    <link href="{{ asset('/marketing/parcel/drumeo/30dd.css') }}" rel="stylesheet">
    <style>
        .image-modal-arrow-left, .image-modal-arrow-right {
            font-size: 0;
            position: absolute;
            transform: translate(0, -50%);
            background: #FFF;
            transition: opacity .3s;
            border-radius: 100px;
            height: auto;
            width: auto;
            z-index: 10;
            padding: 3px 10px;
            margin: 0;
            bottom: unset;
            top: 50%;
        }

        .image-modal-arrow-left {
            left: 0;
        }

        .image-modal-arrow-right {
            right: 0;
        }

        .image-modal-arrow-left::before, .image-modal-arrow-right::before {
            -webkit-font-smoothing: antialiased;
            display: inline-block;
            font-style: normal;
            font-variant: normal;
            text-rendering: auto;
            opacity: 1;
            line-height: 1;
            font-family: "Font Awesome 6 Pro";
            font-weight: 300;
            color: #f61a30;
            font-size: 28px;
        }

        .image-modal-arrow-left::before {
            content: "\f104";
        }

        .image-modal-arrow-right::before {
            content: "\f105";
        }
        .text-dull-navy {
            color:#13618B;
        }
    </style>
@stop()

@section('global-body')
    @include('pianote.sales.partials._nav', [
        "cartVersion" => true
    ])
    <header class="text-white px-5 sm:px-6 pt-96 pb-10 sm:py-20 lg:py-36 relative" style="background-color:#0f5e8a;">
        <div class="inset-0 absolute z-0 bg-top bg-cover block sm:hidden" style="background:url('https://d21q7xesnoiieh.cloudfront.net/fit-in/0x0/filters:quality(95)/marketing/pianote/products/christmas-songbook/header-m.png')"></div>
        <div class="inset-0 absolute z-0 bg-top bg-cover hidden sm:block" style="background:url('https://d21q7xesnoiieh.cloudfront.net/fit-in/0x0/filters:quality(95)/marketing/pianote/products/christmas-songbook/header.jpg')"></div>
        <div class="container max-w-4xl mx-auto relative z-10">
            <div class="flex flex-wrap sm:flex-nowrap items-center">
                <div class="w-full sm:w-5/12 text-center lg:text-left">
                    <img class="h-24 lg:h-36 lg:-ml-5 mx-0" alt="logo" fetchpriority="high"
                        src="https://d21q7xesnoiieh.cloudfront.net/fit-in/440x0/filters:quality(95)/marketing/pianote/products/christmas-songbook/christmas-songbook-logo-left.png">
                    <p class="leading-normal my-4 sm:my-6">Christmas classics to make your holiday season extra special.
                        Presented in original and simplified arrangements.
                    </p>
                    <h4 class="mb-4 sm:mb-6">
                        @if(floatval($productPrices['christmas-songbook']->price) > floatval($productPrices['christmas-songbook']->discounted_price))
                            <strong>ONLY</strong> <s class="opacity-60">${{ floatval($productPrices['christmas-songbook']->price) }}</s>
                            <strong>${{ floatval($productPrices['christmas-songbook']->discounted_price) }}</strong> (SAVE {{ round(100 - (100 * (floatval($productPrices['christmas-songbook']->discounted_price) / floatval($productPrices['christmas-songbook']->price)))) }}%)
                        @else
                            <strong>ONLY ${{ floatval($productPrices['christmas-songbook']->discounted_price) }}</strong>
                        @endif
                        </h4>
                    <a href="#final" class="join medium w-full anchor-slide">GET YOUR COPY &raquo;</a>
                </div>
            </div>
        </div>
    </header>
    <section class="text-left px-5 sm:px-6 py-12 sm:py-10 lg:py-14 relative" style="background:#F1F7FE;">
        <div class="inset-0 absolute z-0 bg-top bg-cover block sm:hidden" style="background:url('https://d21q7xesnoiieh.cloudfront.net/fit-in/0x0/filters:quality(95)/marketing/pianote/products/christmas-songbook/song-list-bg-m.jpg')"></div>
        <div class="inset-0 absolute z-0 bg-top bg-cover hidden sm:block" style="background:url('https://d21q7xesnoiieh.cloudfront.net/fit-in/0x0/filters:quality(95)/marketing/pianote/products/christmas-songbook/song-list-bg.jpg')"></div>
        <div class="container max-w-6xl mx-auto relative z-10">
            <div class="flex flex-wrap sm:flex-nowrap items-start lg:items-center">
                <div class="w-full sm:w-1/2 mb-5 sm:mb-0 sm:pr-10 lg:pr-12">
                    <h4 class="leading-tight text-dull-navy"><strong>All Your Favorites</strong></h4>
                    <img class="h-8 sm:h-9 lg:h-11 mt-1 mb-4 sm:mb-6" alt="In One Book." src="https://d21q7xesnoiieh.cloudfront.net/fit-in/0x0/filters:quality(95)/marketing/pianote/products/christmas-songbook/in-one-book.png">
                    <p class="leading-normal">
                        Logs crackling in the fireplace. Snowflakes fluttering against the window.
                        <br><br>
                        Beautiful Christmas songs sung around the piano.
                        <br><br>
                        Embrace the joy of Christmas with 20 beautiful songs, hand-picked and arranged for solo piano. Each song comes in a traditional and simplified arrangement, so you can spread the joy of holiday music no matter your skill level.
                        <br><br>
                        Give your loved ones the gift of music this Christmas. Or treat yourself to your favorite holiday songs.</p>
                </div>
                <div class="w-full sm:w-1/2 sm:pl-5">
                    <p class="leading-normal mb-3 sm:mb-5 text-dull-navy"><strong>Here’s the full list:</strong></p>
                    <style>
                        @media only screen and (min-width:64em) {
                            ol {
                                column-count: 2;
                            }
                        }
                    </style>
                    <ol class="pl-6 list-decimal text-dull-navy" style="column-gap: 20px;">
                        <li class="leading-none mb-3">Angels We Have Heard on High</li>
                        <li class="leading-none mb-3">Auld Lang Syne</li>
                        <li class="leading-none mb-3">Away in a Manger</li>
                        <li class="leading-none mb-3">Carol of the Bells</li>
                        <li class="leading-none mb-3">Dance of the Sugar Plum Fairy</li>
                        <li class="leading-none mb-3">Deck the Halls</li>
                        <li class="leading-none mb-3">God Rest Ye Merry Gentlemen</li>
                        <li class="leading-none mb-3">It Came Upon a Midnight Clear</li>
                        <li class="leading-none mb-3">Jingle Bells</li>
                        <li class="leading-none mb-3">Joy to the World</li>
                        <li class="leading-none mb-3">O Christmas Tree</li>
                        <li class="leading-none mb-3">O Holy Night</li>
                        <li class="leading-none mb-3">O Little Town of Bethlehem</li>
                        <li class="leading-none mb-3">Silent Night</li>
                        <li class="leading-none mb-3">The First Noel</li>
                        <li class="leading-none mb-3">The Holly and the Ivy</li>
                        <li class="leading-none mb-3">Twelve Days of Christmas</li>
                        <li class="leading-none mb-3">We Three Kings</li>
                        <li class="leading-none mb-3">We Wish You a Merry Christmas</li>
                        <li class="leading-none mb-3">What Child is This</li>
                    </ol>
                </div>
            </div>

        </div>
    </section>
{{--    <section class="text-center px-5 sm:px-6 py-10 sm:py-14 lg:py-20">--}}
{{--        <div class="container max-w-4xl mx-auto">--}}
{{--            <h3 class="text-center"><strong>Original & Simplified <br class="inline sm:hidden"> Arrangements of Every Song</strong></h3>--}}
{{--            <p class="leading-normal mt-4 sm:mt-5 mb-7 sm:mb-10 mx-auto max-w-2xl">--}}
{{--                <span class="text-dull-navy"><em>Perfect for beginners<br class="inline sm:hidden"> and intermediate players.</em></span>--}}
{{--                <br><br>--}}
{{--                Christmas songs are better when they’re shared.--}}
{{--                <br><br>--}}
{{--                That’s why we’ve created simplified arrangements for every song in this book. Perfect for beginners, they are easy to play while still keeping the joy and feeling of the original piece.--}}
{{--                <br><br>--}}
{{--                Want to know what that sounds like?--}}
{{--                <br><br>--}}
{{--                Click below to hear for yourself.</p>--}}

{{--            <div class="flex flex-wrap text-left mx-auto mt-5 sm:mt-7">--}}
{{--                <div class="w-full sm:w-1/2 sm:px-2 mb-4 sm:mb-0">--}}
{{--                    <video class="example-video rounded-xl overflow-hidden w-full" controls poster="https://d21q7xesnoiieh.cloudfront.net/fit-in/0x0/filters:quality(95)/marketing/pianote/products/christmas-songbook/original-thumb.png" src="https://player.vimeo.com/progressive_redirect/playback/844377509/rendition/360p/file.mp4?loc=external&signature=0dc3b6476a403c1b90b438937802ce3bbd5f17c6e8677cfcb66e8489ef2d12db"></video>--}}
{{--                </div>--}}
{{--                <div class="w-full sm:w-1/2 sm:px-2">--}}
{{--                    <video class="example-video rounded-xl overflow-hidden w-full" controls poster="https://d21q7xesnoiieh.cloudfront.net/fit-in/0x0/filters:quality(95)/marketing/pianote/products/christmas-songbook/simplified-thumb.png" src="https://player.vimeo.com/progressive_redirect/playback/844377537/rendition/360p/file.mp4?loc=external&signature=53c2216a9cad739dcae352c0102d39e5c39074c2117e77d0e93bfb2b568c823e"></video>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </section>--}}

    <section class="text-center text-white pt-10 sm:pt-14 lg:pt-20 bg-cover bg-center" style="background-color:#2a2f34;background-image:url('https://d21q7xesnoiieh.cloudfront.net/fit-in/1500x0/filters:quality(95)/marketing/pianote/products/christmas-songbook/sample-bg.jpg');">
        <h3 class="leading-tight"><strong>Take A Look Inside.</strong></h3>
        <p class="leading-normal mt-1 sm:mt-2 mb-4 sm:mb-5"><i class="fa-light fa-arrow-turn-down fa-flip-horizontal mr-1 relative" style="bottom:-7px"></i> <em>Click to see inside the book!</em> <i class="fa-light fa-arrow-turn-down ml-1 relative" style="bottom:-7px"></i></p>
        <a target="_blank" href="https://musora-image-processing-cdn.s3.us-east-2.amazonaws.com/marketing/pianote/products/christmas-songbook/preview-christmas-songbook.pdf" class="relative">
            <img class="inline-block sm:hidden w-full transition-all opacity-0" src="https://d21q7xesnoiieh.cloudfront.net/fit-in/1500x0/filters:quality(95)/marketing/pianote/products/christmas-songbook/piano-m.png" alt="tablet piano" loading="lazy" onload="this.classList.remove('opacity-0')">
            <img class="hidden sm:inline-block w-full transition-all opacity-0" src="https://d21q7xesnoiieh.cloudfront.net/fit-in/2500x0/filters:quality(95)/marketing/pianote/products/christmas-songbook/piano.png" alt="tablet piano" loading="lazy" onload="this.classList.remove('opacity-0')">
        </a>
    </section>
    <section class="relative text-center px-3 sm:px-6 py-10 sm:py-14 lg:py-20" style="background:linear-gradient(to bottom, #F1F7FE 40%, #FFF);">
        <div class="absolute z-10 top-0 left-0 right-0 bg-cover bg-no-repeat bg-top z-10 h-1/2 lg:h-full" style="background-image:url('https://d21q7xesnoiieh.cloudfront.net/fit-in/1500x0/filters:quality(95)/marketing/pianote/products/christmas-songbook/author-bg.png');"></div>
        <div class="container max-w-5xl mx-auto relative z-20">
            <h3 class="text-center mb-24"><strong>About The Authors</strong></h3>

            <div class="flex flex-wrap sm:flex-nowrap items-start justify-center">
                <div class="w-full sm:w-1/2 px-4 mb-20 sm:mb-0">
                    <div class="relative text-left z-10 rounded-xl py-8 sm:py-12 px-6 sm:px-10 w-full shadow-md" style="background-color:#fff;">
                        <img class="absolute top-0 left-1/2 -translate-x-1/2 -translate-y-1/2 w-32 lg:w-36 z-20 rounded-full border-4 border-white shadow-md transition-all opacity-0" alt="profile picture" loading="lazy" onload="this.classList.remove('opacity-0')"
                            src="https://d21q7xesnoiieh.cloudfront.net/fit-in/550x0/filters:quality(95)/marketing/pianote/products/christmas-songbook/kevin-profile.jpg">
                        <br>
                        <img class="h-5 mt-4 sm:mt-3 mb-3 transition-all opacity-0" alt="lisa signature" loading="lazy" onload="this.classList.remove('opacity-0')"
                            src="https://d21q7xesnoiieh.cloudfront.net/fit-in/550x0/filters:quality(95)/marketing/pianote/products/christmas-songbook/kevin-castro.png">
                        <p class="leading-normal">
                            Kevin Castro lives and breathes the piano. Not only is he an experienced piano teacher, he also serves as the musical director for JUNO-Award-winning artist JESSIA, an official Disney pianist, and a studio pianist for hire (including recording a track for J-Lo).
                            <br><br>
                            And all those skills come to bear when he’s arranging music. Because Kevin plays so much piano, he knows instinctively how to arrange music so it not only sounds beautiful on the keys, but also feel “right” under the fingers.
                            <br><br>
                            That’s what you’ll find in this book.
                            <br><br>
                            Kevin has painstakingly arranged these iconic Christmas songs so they not only sound festive and stunning but are fun to play!
                        </p>
                    </div>
                </div>
                <div class="w-full sm:w-1/2 px-4">
                    <div class="relative text-left z-10 rounded-xl py-8 sm:py-12 px-6 sm:px-10 w-full shadow-md" style="background-color:#fff;">
                        <img class="absolute top-0 left-1/2 -translate-x-1/2 -translate-y-1/2 w-32 lg:w-36 z-20 rounded-full border-4 border-white shadow-md transition-all opacity-0" alt="profile picture" loading="lazy" onload="this.classList.remove('opacity-0')"
                            src="https://d21q7xesnoiieh.cloudfront.net/fit-in/550x0/filters:quality(95)/marketing/pianote/products/christmas-songbook/carlos-profile.jpg">
                        <br>
                        <img class="h-5 mt-4 sm:mt-3 mb-3 transition-all opacity-0" alt="lisa signature" loading="lazy" onload="this.classList.remove('opacity-0')"
                            src="https://d21q7xesnoiieh.cloudfront.net/fit-in/550x0/filters:quality(95)/marketing/pianote/products/christmas-songbook/carlos-castro.png">
                        <p class="leading-normal">
                            Carlos has been teaching piano for over 40 years. He’s also Kevin’s dad!
                            <br><br>
                            He was educated at some of the top music universities in the world, including Berklee College Of Music, Rochester University, The University of Edinburgh, the National University of Singapore, and the Yamaha School Of Music.
                            <br><br>
                            Carlos is known for his immense knowledge of theory, arranging, improvising, and Latin jazz.
                            <br><br>
                            And it’s that knowledge, combined with his expertise in teaching beginner piano players, that have led to the beautiful simplified arrangements you’ll find in this book.
                            <br><br>
                            As you’re playing these songs, you’ll appreciate the care and dedication that Carlos put into each and every one.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <div id="final" class="anchor"></div>
    <section class="px-5 sm:px-6 py-10 sm:py-14 lg:py-20 text-center text-white" style="background:#0f5e8a url('https://d21q7xesnoiieh.cloudfront.net/fit-in/2000x0/filters:quality(95)/marketing/pianote/products/christmas-songbook/order-bg.jpg') center center/cover;">
        <div class="container mx-auto">
            <img alt="quietkick logo" class="h-28 sm:h-44 lg:h-52" src="https://d21q7xesnoiieh.cloudfront.net/fit-in/500x0/filters:quality(95)/marketing/pianote/products/christmas-songbook/christmas-songbook-logo-center.png"><br>
            <p class="leading-tight mt-3 mb-6">Christmas classics to make your holiday season extra special.<br class="hidden sm:inline">
                Presented in original and simplified arrangements.</p>

            @if( $products['christmas-songbook']->getStockAvailability() > 1 && !empty($products['christmas-songbook']->getStockAvailability()))
                <div class="flex flex-wrap items-start justify-center 2-full max-w-sm sm:max-w-3xl mx-auto">
                    <div class="w-full md:w-1/2 px-2 md:px-3 relative">
                        @if(floatval($productPrices['christmas-songbook']->price) > floatval($productPrices['christmas-songbook']->discounted_price))
                            <p class="inline-block relative -bottom-1 mb-1 px-5 py-1 z-10 leading-tight text-xs rounded-full bg-black uppercase" >Save {{ round(100 - (100 * (floatval($productPrices['christmas-songbook']->discounted_price) / floatval($productPrices['christmas-songbook']->price)))) }}%</p>
                        @endif
                        <a href="/ecommerce/add-to-cart?locked=true&product-array=christmas-songbook:1,christmas-song-book-digital:1" class="text-black overflow-hidden rounded-2xl block mx-auto mb-4 md:mb-0 group border-2 border-black">
                            <div class="bg-white px-3 py-6 md:py-9">
                                <h4 class="mb-2 sm:mb-3"><strong>Book Only</strong></h4>
                                <img class="h-28 lg:h-32 transition-opacity opacity-0"
                                    loading="lazy"
                                    onload="this.classList.remove('opacity-0')"
                                    src="https://d21q7xesnoiieh.cloudfront.net/fit-in/310x0/filters:quality(95)/marketing/pianote/products/christmas-songbook/book-only.png"
                                    alt="learn playing image"
                                >
                                <br>
                                <h4 class="inline-block leading-tight">
                                    @if(floatval($productPrices['christmas-songbook']->price) > floatval($productPrices['christmas-songbook']->discounted_price))
                                        <s>${{ floatval($productPrices['christmas-songbook']->price) }}</s>
                                    @endif
                                    <strong>${{ floatval($productPrices['christmas-songbook']->discounted_price) }}</strong></h4>
                                <p class="text-sm"><em>
                                        @if(floatval($productPrices['christmas-songbook']->price) > floatval($productPrices['christmas-songbook']->discounted_price))
                                            Save {{ round(100 - (100 * (floatval($productPrices['christmas-songbook']->discounted_price) / floatval($productPrices['christmas-songbook']->price)))) }}%.
                                        @endif
                                        One-time payment.</em></p>
                                <div class="join my-5 musora-black smaller w-full transition-opacity duration-300 group-hover:opacity-80 max-w-[230px]">Get Your Copy</div>
                                <p class="text-sm mb-1.5">20 Christmas Classics</p>
                                <p class="text-sm">BONUS Digital Book (10 songs)</p>
                            </div>
                        </a>
                    </div>

                    <div class="w-full md:w-1/2 px-2 md:px-3 relative">
                        <img class="h-16 absolute top-0 right-0 z-10" src="https://d21q7xesnoiieh.cloudfront.net/fit-in/130x0/filters:quality(95)/marketing/pianote/products/christmas-songbook/free-shipping-badge.png">
                        <p class="inline-block relative -bottom-1 mb-1 px-5 py-1 z-10 leading-tight text-xs rounded-full text-dull-navy uppercase bg-pianote text-white" >BEST DEAL</p>
                        <a href="/ecommerce/add-to-cart?locked=true&promo-code=special&product-array=PIANOTE-MEMBERSHIP-1-YEAR:1,christmas-songbook:1,christmas-song-book-digital:1,piano-chords-and-scales-guide:1,new-piano-players-start-here:1,easy-chords:1"
                            class="text-black overflow-hidden rounded-2xl block mx-auto mb-4 md:mb-0 group border-2 border-pianote">
                            <div class="bg-white px-3 py-6 md:py-9">
                                <h4 class="mb-2 sm:mb-3"><strong>Holiday Bundle</strong></h4>
                                <img class="h-28 lg:h-32 transition-opacity opacity-0"
                                    loading="lazy"
                                    onload="this.classList.remove('opacity-0')"
                                    src="https://d21q7xesnoiieh.cloudfront.net/fit-in/550x0/filters:quality(95)/marketing/pianote/products/christmas-songbook/holiday-bundle.png"
                                    alt="learn playing image"
                                >
                                <br>
                                <h4 class="inline-block leading-tight"><s class="opacity-60">$532</s> <strong>$200</strong></h4>
                                <p class="text-sm"><em>Join Pianote + Get the Book FREE</em></p>
                                <div class="join my-5 smaller w-full transition-opacity duration-300 group-hover:opacity-80 max-w-[230px]">Get Started</div>
                                <p class="text-sm mb-1.5 text-pianote"><strong>Annual Pianote Membership</strong> ($240 value)</p>
                                <p class="text-sm mb-1.5">Christmas Songbook ($49 value)</p>
                                <p class="text-sm mb-1.5">Digital Book (10 songs) ($10 value)</p>
                                <p class="text-sm mb-1.5">Chords & Scales Book ($39 value)</p>
                                <p class="text-sm mb-1.5">New Piano Players Start Here ($97 value)</p>
                                <p class="text-sm">Easy Chords ($97 value)</p>
                            </div>
                        </a>
                    </div>
                </div>
            @else
                <a class="join sold-out mt-5 sm:mt-10">SOLD OUT</a>
            @endif
        </div>
    </section>
    <section class="text-white px-4 sm:px-6 py-8 sm:py-12 text-center" style="background: #012c41;">
        <div class="container mx-auto relative z-50">
            <div class="inline-block w-full px-3 md:px-4 mb-5">
                <p><strong>Any questions?</strong><br class="inline-block md:hidden"> Call us toll-free at
                    <a href="tel:+18004398921">1-800-439-8921</a> <br class="inline-block md:hidden"> or directly at
                    <a href="tel:+16048557605">1-604-855-7605</a>.<br> All prices listed in USD. </p>
            </div>
            <div class="inline-block w-full px-3 md:px-4" style="margin-top: 0;">
                <i class="mx-0.5 text-3xl md:text-4xl fab fa-cc-visa"></i>
                <i class="mx-0.5 text-3xl md:text-4xl fab fa-cc-mastercard"></i>
                <i class="mx-0.5 text-3xl md:text-4xl fab fa-cc-amex"></i>
                <i class="mx-0.5 text-3xl md:text-4xl fab fa-cc-paypal"></i>
                <i class="mx-0.5 text-3xl md:text-4xl fab fa-cc-discover"></i>
            </div>
        </div>
    </section>


    @include("pianote.sales.partials._footer")

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script type="text/javascript" src="{{ asset('/marketing/js/modal.js') }}"></script>
    <script type="text/javascript" src="{{ asset('/marketing/parcel/drumeo/navigation-sales.js') }}"></script>

    <script src="{{ asset('/marketing/js/drumeo/manifest.js') }}"></script>
    <script src="{{ asset('/marketing/js/drumeo/vendor.js') }}"></script>
    <script src="{{ asset('/marketing/js/drumeo/cart-sidebar.js') }}"></script>
    <script src="{{ asset('/marketing/js/drumeo/app.js') }}"></script>

    <script>
        $(document).ready(function () {
            $(document).foundation();

            $(".example-video").on('play', function () {
                $(".example-video").not(this).trigger('pause');
            });

            let imgNum = 0;

            $('.image-modal-arrow-left').on('click', function(){
                if(imgNum === 0){
                    imgNum = 5;
                }
                else {
                    imgNum--;
                }

                $('#seeInside' + imgNum).find('img').each(function(){
                    const imgSrc = $(this);
                    $('#seeInside0').find('img').attr('src', imgSrc.data('src'))
                })
            })

            $('.image-modal-arrow-right').on('click', function(){
                if(imgNum === 5){
                    imgNum = 0;
                }
                else {
                    imgNum++;
                }

                $('#seeInside' + imgNum).find('img').each(function(){
                    const imgSrc = $(this);
                    $('#seeInside0').find('img').attr('src', imgSrc.data('src'))
                })
            })
        })
    </script>
    <script type="text/javascript" src="{{ asset('/marketing/js/modal-autoplay.js') }}"></script>
    <script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/lazysizes/5.3.2/lazysizes.min.js"></script>
    <script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/lazysizes/5.3.2/plugins/unveilhooks/ls.unveilhooks.min.js"></script>

@stop
