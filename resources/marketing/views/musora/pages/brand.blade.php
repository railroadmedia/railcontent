@extends('musora._partials.layout')

@section('head-includes')
    <title>Musora Brand Guide</title>
    <meta name="description" content="We help musicians reach their goals through inspiration and education.">
    <meta property="og:title" content="Musora Brand Guide">
    <meta property="og:description" content="We help musicians reach their goals through inspiration and education.">
    <meta property="og:url" content="https://www.musora.com/{{ Request::path() }}">
    <meta property="og:image" content="https://dmmior4id2ysr.cloudfront.net/homepage/2023/share-image.jpg">
@endsection

<!-- Main -->
@section('layout-body')

    <section class="py-24 md:py-32 lg:py-40 text-white text-center bg-center bg-cover" style="background-color:#1a1e58;background-image:url(https://www.musora.com/musora-cdn/image/width=1500,quality=85/https://dmmior4id2ysr.cloudfront.net/homepage/2021/header.jpg);">
        <div class="container mx-auto relative z-0">
            <h1 class="mt-6"><strong>Brand Guides</strong></h1>
        </div>
    </section>
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
        .join.musora-gold {
            background-color:#FFAE00;
            color:#000;
        }

        .join.musora-gold:hover, .join.musora-gold:focus {
            background:#FFAE00;
            color:#000;
        }
    </style>
    <div class="py-24 md:py-32 lg:py-40 px-2 md:px-5 text-white text-center w-full bg-musora-black">
        <div class="container mx-auto relative z-0">
            <a href="https://dmmior4id2ysr.cloudfront.net/brand/brand-guide.pdf" class="join musora-gold relative">DOWNLOAD GUIDE &nbsp; <i class="fas fa-arrow-to-bottom"></i></a>

            <div class="mt-7 md:mt-16" style="font-size: 0;">
                <a href="https://dmmior4id2ysr.cloudfront.net/brand/Drumeo-Assets.zip" class="align-middle rounded-full border-2 relative my-2 md:my-0 mx-2 inline-block py-8 px-2 relative hover:opacity-80" style="width:110px;height:110px;border-color: #0b76db;">
                    <img src="https://www.musora.com/musora-cdn/image/quality=100,width=250,metadata=none/https://dpwjbsxqtam5n.cloudfront.net/logos/logo-blue.png" class="w-auto h-auto" style="max-width: 90px;max-height: 25px;"><br>
                    <p class="text-xs"><strong>ASSETS</strong></p>
                    <i class="fas fa-arrow-to-bottom absolute left-1/2 bottom-0 transform -translate-x-1/2 pb-3 text-xs"></i>
                </a>
                <a href="https://dmmior4id2ysr.cloudfront.net/brand/Pianote-Assets.zip" class="align-middle rounded-full border-2 relative my-2 md:my-0 mx-2 inline-block py-8 px-2 relative hover:opacity-80" style="width:110px;height:110px;border-color: #f61a30;">
                    <img src="https://www.musora.com/musora-cdn/image/width=250,quality=85/https://d2vyvo0tyx8ig5.cloudfront.net/logo/pianote-logo-red.png" class="w-auto h-auto" style="max-width: 90px;max-height: 25px;"><br>
                    <p class="text-xs"><strong>ASSETS</strong></p>
                    <i class="fas fa-arrow-to-bottom absolute left-1/2 bottom-0 transform -translate-x-1/2 pb-3 text-xs"></i>
                </a>
                <a href="https://dmmior4id2ysr.cloudfront.net/brand/Guitareo-Assets.zip" class="align-middle rounded-full border-2 relative my-2 md:my-0 mx-2 inline-block py-8 px-2 relative hover:opacity-80" style="width:110px;height:110px;border-color: #03c8ac;">
                    <img src="https://d122ay5chh2hr5.cloudfront.net/sales/guitareo-logo-green.png" class="w-auto h-auto" style="max-width: 90px;max-height: 25px;"><br>
                    <p class="text-xs"><strong>ASSETS</strong></p>
                    <i class="fas fa-arrow-to-bottom absolute left-1/2 bottom-0 transform -translate-x-1/2 pb-3 text-xs"></i>
                </a>
                <a href="https://dmmior4id2ysr.cloudfront.net/brand/Singeo-Assets.zip" class="align-middle rounded-full border-2 relative my-2 md:my-0 mx-2 inline-block py-8 px-2 relative hover:opacity-80" style="width:110px;height:110px;border-color: #9a01ee;">
                    <img src="https://d21xeg6s76swyd.cloudfront.net/sales/2021/singeo-logo.png" class="w-auto h-auto" style="max-width: 90px;max-height: 25px;"><br>
                    <p class="text-xs"><strong>ASSETS</strong></p>
                    <i class="fas fa-arrow-to-bottom absolute left-1/2 bottom-0 transform -translate-x-1/2 pb-3 text-xs"></i>
                </a>
                <a href="https://dmmior4id2ysr.cloudfront.net/brand/musora-assets-2023.zip" class="align-middle rounded-full border-2 relative my-2 md:my-0 mx-2 inline-block py-8 px-2 relative hover:opacity-80" style="width:110px;height:110px;border-color: #fff;">
                    <img src="https://dmmior4id2ysr.cloudfront.net/homepage/2023/musora_logo.png" class="w-auto h-auto" style="max-width: 90px;max-height: 25px;padding: 2px 0;"><br>
                    <p class="text-xs"><strong>ASSETS</strong></p>
                    <i class="fas fa-arrow-to-bottom absolute left-1/2 bottom-0 transform -translate-x-1/2 pb-3 text-xs"></i>
                </a>
                {{--<a href="https://dmmior4id2ysr.cloudfront.net/brand/Recordeo-Assets.zip" class="align-middle rounded-full border-2 relative my-2 md:my-0 mx-2 inline-block py-8 px-2 relative hover:opacity-80" style="width:110px;height:110px;border-color: #ffae03;">--}}
                    {{--<img src="https://d1y4o0cjx5s9r3.cloudfront.net/marketing/sales/logo-yellow.png" class="w-auto h-auto" style="max-width: 90px;max-height: 25px;"><br>--}}
                    {{--<p class="text-xs"><strong>ASSETS</strong></p>--}}
                    {{--<i class="fas fa-arrow-to-bottom absolute left-1/2 bottom-0 transform -translate-x-1/2 pb-3 text-xs"></i>--}}
                {{--</a>--}}
            </div>
        </div>
    </div>

@stop
