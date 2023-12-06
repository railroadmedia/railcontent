@extends('musora._partials.layout')

@section('head-includes')
    <title>Musora Brand Guide</title>
    <meta property="og:title" content="Musora Brand Guide">
    <meta name="description" content="We help musicians reach their goals through inspiration and education.">
    <meta property="og:description" content="We help musicians reach their goals through inspiration and education.">
    <meta property="og:url" content="https://www.musora.com/{{ Request::path() }}">
    <meta property="og:image" content="https://dmmior4id2ysr.cloudfront.net/homepage/2023/share-image3.jpg">
    <style>
        .join {
            display:inline-block;
            font:500 22px/1em 'Bebas Neue', sans-serif;
            letter-spacing:0.1em;
            text-transform:uppercase;
            background:#0c1524;
            border-radius:50px;
            color:#fff;
            padding:17px 7%;
            outline:none;
            cursor:pointer;
            text-align:center;
            user-select:none;
            text-decoration:none;
            transition:background-color 0.3s, color 0.3s, opacity 0.3s;
            box-shadow:0 0 0 rgba(0, 0, 0, 0.35);
        }

        @media (min-width:768px) {
            .join {
                font-size:30px;
            }
        }

        .join:hover, .join:focus {
            color:#fff;
            background:#14233d;
            box-shadow:0 0 7px rgba(0, 0, 0, 0.35);
        }
        .join i {
            transition:all .3s;
            position:relative;
            right:0px;
        }
        .join:hover i {
            right:-3px;
        }

        .join.white {
            background:#fff;
            color:#000;
        }

        .join.white:hover, .join.white:focus {
            background:#eee;
        }

        .join.smaller {
            padding:8px 30px;
            font-size:16px;
        }

        @media (min-width:768px) {
            .join.smaller {
                font-size:18px;
                padding:11px 30px;
            }
        }

        .join.smaller.outline {
            padding:8px 28px 6px;
            font-size:16px;
        }

        @media (min-width:768px) {
            .join.smaller.outline {
                font-size:18px;
                padding:10px 28px 8px;
            }
        }

        .join.musora-gold {
            background-color:#FFAE00;
            color:#000;
        }

        .join.musora-gold:hover, .join.musora-gold:focus {
            background:#FFAE00;
            color:#000;
        }

        .join.outline {
            background:transparent;
            outline-style:none !important;
            border:1px solid #fff;
            color:#fff;
            padding:6px 12px;
        }

        @media (min-width:768px) {
            .join.outline {
                border-width:2px;
                padding:11px 30px;
            }
        }

        .join.outline:hover, .join.outline:focus {
            background:#fff;
            color:#000;
        }

        .join.outline.black {
            border-color:#000;
            color:#000;
        }
        .join.outline.black:hover, .join.outline.black:focus {
            background:#000;
            color:#fff;
        }
        .join.outline.musora {
            border-color:#0c1524;
            color:#0c1524;
        }

        .join.outline.musora:hover, .join.outline.musora:focus {
            background:#0c1524;
            color:#fff;
        }

        .text-musora-black {
            color:#0c1524;
        }

        .text-musora,
        .text-musora-gold {
            color:#FFAE00;
        }

        .splide__pagination__page.is-active {
            background:#01050F;
            transform:none !important;
        }

        .splide__pagination__page {
            margin:3px 10px !important;
            opacity:1 !important;
        }

        @media (min-width:768px) {
            .splide__pagination__page {
                margin:3px 6px !important;
            }
        }

        .splide__arrow svg {
            fill:#FFAE00 !important;
        }

        .dot {
            left:-16px;
        }

        .full-line {
            left:0;
            bottom:31%;
        }

        @media (min-width:640px) {
            .dot,
            .full-line {
                left:50%;
            }

            .full-line {
                bottom:0;
            }
        }
        .join.drumeo {
            background:#0b76db;
        }
        .join.drumeo:hover {
            background:#0c84f5;
        }
        .join.pianote {
            background:#F61A30;
        }
        .join.pianote:hover {
            background:#ff3347;
        }
        .join.guitareo {
            background:#00C9AC;
        }
        .join.guitareo:hover {
            background:#00e3c1;
        }
        .join.singeo {
            background:#8300E9;
        }
        .join.singeo:hover {
            background:#9000ff;
        }
    </style>
@endsection

<!-- Main -->
@section('layout-body')

    <section class="py-24 md:py-32 lg:py-40 text-white text-center bg-center bg-cover" style="background-color:#1a1e58;background-image:url(https://www.musora.com/musora-cdn/image/width=1500,quality=95/https://dmmior4id2ysr.cloudfront.net/homepage/2021/header.jpg);">
        <div class="container mx-auto relative z-0">
            <h1 class="mt-6"><strong>Brand Guides</strong></h1>
        </div>
    </section>
    <div class="py-20 md:py-28 lg:py-32 px-2 md:px-5 text-white text-center w-full bg-musora-black">
        <div class="container mx-auto relative z-0">
            <a target="_blank" href="https://dmmior4id2ysr.cloudfront.net/brand/Branding-Guide-2023-Musora.pdf" class="m-2 join smaller musora-gold relative">MUSORA BRANDING GUIDE &nbsp; <i class="fas fa-arrow-to-bottom"></i></a>
            <br><a target="_blank" href="https://dmmior4id2ysr.cloudfront.net/brand/Branding-Guide-2023-Drumeo.pdf" class="m-2 join smaller drumeo relative">Drumeo BRANDING GUIDE &nbsp; <i class="fas fa-arrow-to-bottom"></i></a>
            <br><a target="_blank" href="https://dmmior4id2ysr.cloudfront.net/brand/Branding-Guide-2023-Drumeo.pdf" class="m-2 join smaller pianote relative">Pianote BRANDING GUIDE &nbsp; <i class="fas fa-arrow-to-bottom"></i></a>
            <br><a target="_blank" href="https://dmmior4id2ysr.cloudfront.net/brand/Branding-Guide-2023-Drumeo.pdf" class="m-2 join smaller guitareo relative">Guitareo BRANDING GUIDE &nbsp; <i class="fas fa-arrow-to-bottom"></i></a>
            <br><a target="_blank" href="https://dmmior4id2ysr.cloudfront.net/brand/Branding-Guide-2023-Drumeo.pdf" class="m-2 join smaller singeo relative">Singeo BRANDING GUIDE &nbsp; <i class="fas fa-arrow-to-bottom"></i></a>

            <div class="mt-7 md:mt-16" style="font-size: 0;">
                <a href="https://dmmior4id2ysr.cloudfront.net/brand/musora-assets-2023.zip" class="align-middle rounded-full border-2 relative my-2 md:my-0 mx-2 inline-block py-8 px-2 relative hover:opacity-80" style="width:110px;height:110px;border-color: #FFAE00;">
                    <img src="https://dmmior4id2ysr.cloudfront.net/homepage/2023/musora_logo.png" class="w-auto h-auto" style="max-width: 90px;max-height: 25px;padding: 2px 0;"><br>
                    <p class="text-xs"><strong>LOGOS</strong></p>
                    <i class="fas fa-arrow-to-bottom absolute left-1/2 bottom-0 transform -translate-x-1/2 pb-3 text-xs"></i>
                </a>
                <a href="https://dmmior4id2ysr.cloudfront.net/brand/drumeo-logos-2023.zip" class="align-middle rounded-full border-2 relative my-2 md:my-0 mx-2 inline-block py-8 px-2 relative hover:opacity-80" style="width:110px;height:110px;border-color: #0b76db;">
                    <img src="https://www.musora.com/musora-cdn/image/quality=95,width=250,metadata=none/https://dpwjbsxqtam5n.cloudfront.net/logos/logo-blue.png" class="w-auto h-auto" style="max-width: 90px;max-height: 25px;"><br>
                    <p class="text-xs"><strong>LOGOS</strong></p>
                    <i class="fas fa-arrow-to-bottom absolute left-1/2 bottom-0 transform -translate-x-1/2 pb-3 text-xs"></i>
                </a>
                <a href="https://dmmior4id2ysr.cloudfront.net/brand/pianote-logos-2023.zip" class="align-middle rounded-full border-2 relative my-2 md:my-0 mx-2 inline-block py-8 px-2 relative hover:opacity-80" style="width:110px;height:110px;border-color: #f61a30;">
                    <img src="https://www.musora.com/musora-cdn/image/width=250,quality=95/https://d2vyvo0tyx8ig5.cloudfront.net/logo/pianote-logo-red.png" class="w-auto h-auto" style="max-width: 90px;max-height: 25px;"><br>
                    <p class="text-xs"><strong>LOGOS</strong></p>
                    <i class="fas fa-arrow-to-bottom absolute left-1/2 bottom-0 transform -translate-x-1/2 pb-3 text-xs"></i>
                </a>
                <a href="https://dmmior4id2ysr.cloudfront.net/brand/guitareo-logos-2023.zip" class="align-middle rounded-full border-2 relative my-2 md:my-0 mx-2 inline-block py-8 px-2 relative hover:opacity-80" style="width:110px;height:110px;border-color: #03c8ac;">
                    <img src="https://d122ay5chh2hr5.cloudfront.net/sales/guitareo-logo-green.png" class="w-auto h-auto" style="max-width: 90px;max-height: 25px;"><br>
                    <p class="text-xs"><strong>LOGOS</strong></p>
                    <i class="fas fa-arrow-to-bottom absolute left-1/2 bottom-0 transform -translate-x-1/2 pb-3 text-xs"></i>
                </a>
                <a href="https://dmmior4id2ysr.cloudfront.net/brand/singeo-logos-2023.zip" class="align-middle rounded-full border-2 relative my-2 md:my-0 mx-2 inline-block py-8 px-2 relative hover:opacity-80" style="width:110px;height:110px;border-color: #9a01ee;">
                    <img src="https://d21xeg6s76swyd.cloudfront.net/sales/2021/singeo-logo.png" class="w-auto h-auto" style="max-width: 90px;max-height: 25px;"><br>
                    <p class="text-xs"><strong>LOGOS</strong></p>
                    <i class="fas fa-arrow-to-bottom absolute left-1/2 bottom-0 transform -translate-x-1/2 pb-3 text-xs"></i>
                </a>
            </div>
        </div>
    </div>

@stop
