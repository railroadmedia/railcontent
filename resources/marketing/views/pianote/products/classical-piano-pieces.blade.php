@extends('pianote._partials.global-layout')

@section('global-head')
    @parent
    <title>The Most Beautiful Classical Piano Pieces | Pianote</title>
    <meta property="og:title" content="The Most Beautiful Classical Piano Pieces | Pianote">
    <meta name="description" content="Timeless classics you’ll want to play over and over again. Presented in original and simplified arrangements.">
    <meta property="og:description" content="Timeless classics you’ll want to play over and over again. Presented in original and simplified arrangements.">
    <meta property="og:image" content="https://www.musora.com/musora-cdn/image/width=1200,quality=85/https://d2vyvo0tyx8ig5.cloudfront.net/products/classical-piano-pieces/share-image.jpg" style="display: none;">
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
            font-family: "Font Awesome 5 Pro";
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
        header {
            background-image:url(https://www.musora.com/musora-cdn/image/width=850,quality=85/https://d2vyvo0tyx8ig5.cloudfront.net/products/classical-piano-pieces/header-image-m.jpg);
            background-size: 290px;
        }
        @media (min-width: 768px) {
            header {
               background-image:url(https://d2vyvo0tyx8ig5.cloudfront.net/products/classical-piano-pieces/header-image.jpg);
                background-size: cover;
            }
        }
    </style>
@stop()

@section('global-body')
    @include('pianote.sales.partials._nav', [
        "cartVersion" => true
    ])
    <header class="text-white px-5 sm:px-6 pt-72 pb-12 sm:py-20 lg:py-36 bg-top bg-no-repeat" style="background-color:#0e1623;">
        <div class="container max-w-3xl mx-auto">
            <div class="flex flex-wrap sm:flex-nowrap items-center">
                <div class="w-full sm:w-5/12 text-center lg:text-left">
                    <img class="h-24 lg:h-32" alt="logo" fetchpriority="high"
                        src="https://www.musora.com/musora-cdn/image/width=440,quality=85/https://d2vyvo0tyx8ig5.cloudfront.net/products/classical-piano-pieces/logo-light.svg">
                    <p class="leading-normal my-4 sm:my-6"><strong>Timeless classics</strong> you’ll want to play over and over again. Presented in original and simplified arrangements.</p>
                    <h4 class="mb-4 sm:mb-6">
                        @if(floatval($productPrices['classical-piano-pieces']->price) > floatval($productPrices['classical-piano-pieces']->discounted_price))
                            <strong>ONLY</strong> <s class="opacity-60">${{ floatval($productPrices['classical-piano-pieces']->price) }}</s>
                            <strong>${{ floatval($productPrices['classical-piano-pieces']->discounted_price) }}</strong> (SAVE {{ round(100 - (100 * (floatval($productPrices['classical-piano-pieces']->discounted_price) / floatval($productPrices['classical-piano-pieces']->price)))) }}%)
                        @else
                            <strong>ONLY ${{ floatval($productPrices['classical-piano-pieces']->discounted_price) }}</strong>
                        @endif
                        </h4>
                    <a href="/ecommerce/add-to-cart?products[classical-piano-pieces]=1&redirect=/order" class="join medium w-full">GET YOUR COPY &raquo;</a>
                </div>
            </div>
        </div>
    </header>
    <section class="text-center px-5 sm:px-6 py-10 sm:py-14 lg:py-20 bg-cover bg-top" style="background:url(https://d2vyvo0tyx8ig5.cloudfront.net/products/classical-piano-pieces/list-section-bg.png);">
        <div class="container max-w-6xl mx-auto">
            <img class="hidden sm:inline-block h-9 lg:h-11" src="https://d2vyvo0tyx8ig5.cloudfront.net/products/classical-piano-pieces/composers-text.svg">
            <img class="sm:hidden h-14" src="https://d2vyvo0tyx8ig5.cloudfront.net/products/classical-piano-pieces/composers-text-m.svg">

            <p class="leading-normal my-3 sm:my-5 mx-auto max-w-3xl">When you think of classical piano, you think of iconic pieces from the greats.
                <br><br>
                So when deciding which works should adorn these pages, we asked ourselves one simple question…
                <br><br>
                <strong class="text-pianote">Is it beautiful?</strong>
                <br><br>
                Those are the pieces you’ll find here. This book is a carefully curated collection of the most beautiful classical piano pieces ever written. And even though some of them are quite advanced, we believe that playing them shouldn’t be reserved for the pros.</p>

            <img class="hidden sm:inline-block h-64 lg:h-80" src="https://d2vyvo0tyx8ig5.cloudfront.net/products/classical-piano-pieces/composers-list.png">
            <img class="sm:hidden" style="height:480px" src="https://d2vyvo0tyx8ig5.cloudfront.net/products/classical-piano-pieces/composers-list-m.png">
        </div>
    </section>
    <section class="text-center px-5 sm:px-6 py-10 sm:py-14 lg:py-20" style="background:#F2EFED;">
        <div class="container max-w-4xl mx-auto">
            <h3 class="text-center"><strong>Original & Simplified <br class="inline sm:hidden"> Arrangments of Every Piece</strong></h3>
            <p class="leading-normal mt-4 sm:mt-5 mb-7 sm:mb-10">
                <span class="text-pianote"><em>Because these pieces should<br class="inline sm:hidden"> not be reserved for the pros.</em></span>
                <br><br>
                Some of these pieces are quite advanced.
                <br><br>
                But we don’t think that should stop anyone from being able to play and enjoy them. That’s why you’ll find simplified versions of every piece that are approachable for the late beginner/early intermediate pianist.
                <br><br>
                We’ve made them easier while staying true to the beauty of the original composition.</p>

            <div class="flex flex-wrap text-left mx-auto mt-5 sm:mt-7">
                <div class="w-full sm:w-1/2 sm:px-2 mb-4 sm:mb-0">
                    <video class="example-video rounded-xl overflow-hidden w-full" controls poster="https://d2vyvo0tyx8ig5.cloudfront.net/products/classical-piano-pieces/original-video-thumb2.jpg" src="https://player.vimeo.com/progressive_redirect/playback/844377509/rendition/360p/file.mp4?loc=external&signature=0dc3b6476a403c1b90b438937802ce3bbd5f17c6e8677cfcb66e8489ef2d12db"></video>
                </div>
                <div class="w-full sm:w-1/2 sm:px-2">
                    <video class="example-video rounded-xl overflow-hidden w-full" controls poster="https://d2vyvo0tyx8ig5.cloudfront.net/products/classical-piano-pieces/simplified-video-thumb2.jpg" src="https://player.vimeo.com/progressive_redirect/playback/844377537/rendition/360p/file.mp4?loc=external&signature=53c2216a9cad739dcae352c0102d39e5c39074c2117e77d0e93bfb2b568c823e"></video>
                </div>
            </div>
        </div>
    </section>

    <section class="text-center text-white pt-10 sm:pt-14 lg:pt-20 bg-cover bg-center" style="background-color:#2a2f34;background-image:url(https://www.musora.com/musora-cdn/image/width=1500,quality=85/https://d2vyvo0tyx8ig5.cloudfront.net/products/classical-piano-pieces/piano-book-bg.jpg);">
        <h3 class="leading-tight"><strong>Take A Look Inside.</strong></h3>
        <p class="leading-normal mt-1 sm:mt-2 mb-4 sm:mb-5"><i class="fa-light fa-arrow-turn-down fa-flip-horizontal mr-1 relative" style="bottom:-7px"></i> <em>Click to see inside the book!</em> <i class="fa-light fa-arrow-turn-down ml-1 relative" style="bottom:-7px"></i></p>
        <a target="_blank" href="https://d2vyvo0tyx8ig5.cloudfront.net/products/classical-piano-pieces/Classical-Piano-Book-1-14.pdf" class="relative">
            <img class="inline-block sm:hidden w-full transition-all opacity-0" src="https://www.musora.com/musora-cdn/image/width=1500,quality=85/https://d2vyvo0tyx8ig5.cloudfront.net/products/classical-piano-pieces/piano-book-m.png" alt="tablet piano" loading="lazy" onload="this.classList.remove('opacity-0')">
            <img class="hidden sm:inline-block w-full transition-all opacity-0" src="https://www.musora.com/musora-cdn/image/width=1500,quality=85/https://d2vyvo0tyx8ig5.cloudfront.net/products/classical-piano-pieces/piano-book.png" alt="tablet piano" loading="lazy" onload="this.classList.remove('opacity-0')">
        </a>
    </section>
    <section class="relative text-center px-3 sm:px-6 pt-10 sm:pt-14 lg:pt-20" style="background:linear-gradient(to bottom, #f2efed, #FFF);">
        <div class="absolute z-10 top-0 left-0 right-0 bg-cover bg-no-repeat bg-top z-10 h-1/2 lg:h-full" style="background-image:url(https://www.musora.com/musora-cdn/image/width=1500,quality=85/https://d2vyvo0tyx8ig5.cloudfront.net/products/classical-piano-pieces/author-bg.png);"></div>
        <div class="container max-w-5xl mx-auto relative z-20">
            <h3 class="text-center mb-24"><strong>About The Authors</strong></h3>

            <div class="flex flex-wrap sm:flex-nowrap items-start justify-center">
                <div class="w-full sm:w-1/2 px-4 mb-20 sm:mb-0">
                    <div class="relative text-left z-10 rounded-xl py-8 sm:py-12 px-6 sm:px-10 w-full shadow-md" style="background-color:#f2efed;">
                        <img class="absolute top-0 left-1/2 -translate-x-1/2 -translate-y-1/2 w-32 lg:w-36 z-20 rounded-full border-4 border-white shadow-md transition-all opacity-0" alt="profile picture" loading="lazy" onload="this.classList.remove('opacity-0')"
                            src="https://www.musora.com/musora-cdn/image/width=550,quality=85/https://d2vyvo0tyx8ig5.cloudfront.net/products/classical-piano-pieces/lisa-profile.jpg">
                        <br>
                        <img class="h-5 mt-4 sm:mt-3 mb-3 transition-all opacity-0" alt="lisa signature" loading="lazy" onload="this.classList.remove('opacity-0')"
                            src="https://www.musora.com/musora-cdn/image/width=550,quality=85/https://d2vyvo0tyx8ig5.cloudfront.net/products/classical-piano-pieces/Vector.svg">
                        <p class="leading-normal">
                            Lisa Witt is the lead instructor at Pianote and has inspired millions of students around the world with her infectious enthusiasm for this instrument.
                            <br><br>Lisa grew up learning classical piano through the Royal Conservatory of Music, but it wasn’t easy.
                            <br><br>“In fact, I mostly hated it,” she said.
                            <br><br>“But there were some songs that made it all worth it. The beautiful songs by the great composers.”
                            <br><br>Those songs are what drove Lisa to compile this book and share those beautiful pieces with you. She hand-picked each one to fill this book with 20 of the most beautiful classical piano pieces around.
                            <br><br>Lisa’s teaching style is all about FUN. If you’re not having fun playing the piano, then you won’t keep learning.The pieces in this book reflect that style. They are beautiful, but also fun to learn. So you’ll keep coming back to them.
                            <br><br>Lisa is also the author of “Piano Chords & Scales: The Ultimate Guide” and “The Pianote Practice Planner.”
                        </p>
                    </div>
                </div>
                <div class="w-full sm:w-1/2 px-4">
                    <div class="relative text-left z-10 rounded-xl py-8 sm:py-12 px-6 sm:px-10 w-full shadow-md" style="background-color:#f2efed;">
                        <img class="absolute top-0 left-1/2 -translate-x-1/2 -translate-y-1/2 w-32 lg:w-36 z-20 rounded-full border-4 border-white shadow-md transition-all opacity-0" alt="profile picture" loading="lazy" onload="this.classList.remove('opacity-0')"
                            src="https://www.musora.com/musora-cdn/image/width=550,quality=85/https://d2vyvo0tyx8ig5.cloudfront.net/products/classical-piano-pieces/eleny-profile.jpg">
                        <br>
                        <img class="h-7 mt-4 sm:mt-3 mb-1.5 transition-all opacity-0" alt="lisa signature" loading="lazy" onload="this.classList.remove('opacity-0')"
                            src="https://www.musora.com/musora-cdn/image/width=550,quality=85/https://d2vyvo0tyx8ig5.cloudfront.net/products/classical-piano-pieces/Vector-1.svg">
                        <p class="leading-normal">
                            Eleny Quapp is a skilled musician with over 20 years of experience. As a former student of the Royal Conservatory of Music, she has refined her skills at the piano and has since become an accomplished teacher, passing on her passion for music to her students.
                            <br><br>Eleny's love for music is reflected in her teaching, where she emphasizes the importance of practice and dedication, but also discovering the fun in learning. She firmly believes in the profound effects that music can have on a person's life and will always find ways to inspire those around her.
                            <br><br>With a particular affinity for classical music, Eleny enjoys sharing her passion for some of the world's most beautiful music with those around her.
                            <br><br>The Most Beautiful Piano Classical Pieces is a delightful collection of some of her favorite pieces. 
                            <br><br>She has arranged all the simplified pieces to be accessible to students of all skill levels Her arrangements reflect what she is most passionate about - sharing the joy and beauty of classical music.
                        </p>
                    </div>
                </div>
            </div>

        </div>
    </section>
    <section class="text-center px-5 sm:px-6 py-10 sm:py-14 lg:py-20 mb-20 sm:mb-24">
        <div class="container max-w-5xl mx-auto">
            <h3 class="leading-tight text-center mb-6 sm:mb-7"><strong>The best way to <br class="inline sm:hidden"> play your favorites.</strong></h3>
            <div class="cursor-pointer" data-open="seeInside0">
                <img class="hidden sm:inline-block h-64 lg:h-72" src="https://d2vyvo0tyx8ig5.cloudfront.net/products/classical-piano-pieces/collage.png">
                <img class="sm:hidden" src="https://d2vyvo0tyx8ig5.cloudfront.net/products/classical-piano-pieces/collage-m.png">
            </div>
        </div>
    </section>

    <div id="final" class="anchor"></div>

    <section class="px-5 sm:px-6 py-12 sm:py-16 lg:py-20 bg-cover bg-top" style="background:#f7fbfe url(https://d2vyvo0tyx8ig5.cloudfront.net/products/classical-piano-pieces/order-bg.jpg);">
        <div class="container max-w-3xl mx-auto">
            <div class="flex flex-wrap sm:flex-nowrap items-center">
                <div class="w-full sm:w-7/12 text-center lg:text-left sm:order-1 px-10 sm:px-0">
                    <img class="-mt-32 sm:-mt-36 mb-4 sm:-mb-12 w-full max-w-xs sm:max-w-md" src="https://d2vyvo0tyx8ig5.cloudfront.net/products/classical-piano-pieces/order-book.png">
                </div>
                <div class="w-full sm:w-5/12 text-center lg:text-left sm:pr-5">
                    <img class="h-24 lg:h-32" alt="logo" fetchpriority="high"
                        src="https://www.musora.com/musora-cdn/image/width=440,quality=85/https://d2vyvo0tyx8ig5.cloudfront.net/products/classical-piano-pieces/logo-light-dark.svg">
                    <p class="leading-normal my-4 sm:my-6"><strong>Timeless classics</strong> you’ll want to play over and over again. Presented in original and simplified arrangements.</p>
                    <h4 class="mb-4 sm:mb-6">
                        @if(floatval($productPrices['classical-piano-pieces']->price) > floatval($productPrices['classical-piano-pieces']->discounted_price))
                            <strong>ONLY</strong> <s class="opacity-60">${{ floatval($productPrices['classical-piano-pieces']->price) }}</s>
                            <strong>${{ floatval($productPrices['classical-piano-pieces']->discounted_price) }}</strong> (SAVE {{ round(100 - (100 * (floatval($productPrices['classical-piano-pieces']->discounted_price) / floatval($productPrices['classical-piano-pieces']->price)))) }}%)
                        @else
                            <strong>ONLY ${{ floatval($productPrices['classical-piano-pieces']->discounted_price) }}</strong>
                        @endif
                    </h4>
                    <a href="/ecommerce/add-to-cart?products[classical-piano-pieces]=1&redirect=/order" class="join medium w-full">GET YOUR COPY &raquo;</a>
                </div>
            </div>
        </div>
    </section>

    @php
        $modalImages = [
            "https://d2vyvo0tyx8ig5.cloudfront.net/products/classical-piano-pieces/collage-01.jpg",
            "https://d2vyvo0tyx8ig5.cloudfront.net/products/classical-piano-pieces/collage-05.jpg",
            "https://d2vyvo0tyx8ig5.cloudfront.net/products/classical-piano-pieces/collage-02.jpg",
            "https://d2vyvo0tyx8ig5.cloudfront.net/products/classical-piano-pieces/collage-06.jpg"
        ];
    @endphp
    @foreach ($modalImages as $key => $img)
        @include('pianote.products.partials.image-modal',[
            'id' => "seeInside".$key,
            "image" => $img,
            "imageName" => "seeInside".$key,
        ])
    @endforeach

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
                    imgNum = 3;
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
                if(imgNum === 3){
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
