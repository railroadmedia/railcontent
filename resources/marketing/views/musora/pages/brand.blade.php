@extends('musora._partials.layout')

<!-- Main -->
@section('layout-body')

    <section class="py-24 md:py-32 lg:py-40 text-white text-center bg-center bg-cover" style="background-color:#1a1e58;background-image:url(https://cdn.musora.com/image/fetch/w_1500,q_auto:best/https://musora-center.s3.amazonaws.com/homepage/2021/header.jpg);">
        <div class="container mx-auto relative z-0">
            <h1 class="mt-6"><strong>Brand Guides</strong></h1>
        </div>
    </section>
    <style>
        .join {
            font: 700 18px/1em "Open Sans",sans-serif;
            padding: 11px 50px;
            background: #000;
            background-clip: padding-box;
        }
        .join:before {
            content: '';
            position: absolute;
            top: 0;
            right: 0;
            bottom: 0;
            left: 0;
            z-index: -1;
            border-radius: inherit;
            background: linear-gradient(90deg,#03c8ac, #0976db, #9a01ee, #f61a30);
            margin: -3px;
        }
        .join:hover {
            background: linear-gradient(90deg,#03c8ac, #0976db, #9a01ee, #f61a30);
            color: #000;
        }
    </style>
    <div class="py-24 md:py-32 lg:py-40 px-2 md:px-5 text-white text-center w-full" style="background-color:#000c17;">
        <div class="container mx-auto relative z-0">
            <a href="https://musora-center.s3.amazonaws.com/brand/brand-guide.pdf" class="join relative">DOWNLOAD GUIDE &nbsp; <i class="fas fa-arrow-to-bottom"></i></a>

            <div class="mt-7 md:mt-16" style="font-size: 0;">
                <a href="https://musora-center.s3.amazonaws.com/brand/Drumeo-Assets.zip" class="align-middle rounded-full border-2 relative my-2 md:my-0 mx-2 inline-block py-8 px-2 relative hover:opacity-80" style="width:110px;height:110px;border-color: #0b76db;">
                    <img src="https://dpwjbsxqtam5n.cloudfront.net/logos/logo-blue.png" class="w-auto h-auto" style="max-width: 90px;max-height: 25px;"><br>
                    <p class="text-xs"><strong>ASSETS</strong></p>
                    <i class="fas fa-arrow-to-bottom absolute left-1/2 bottom-0 transform -translate-x-1/2 pb-3 text-xs"></i>
                </a>
                <a href="https://musora-center.s3.amazonaws.com/brand/Pianote-Assets.zip" class="align-middle rounded-full border-2 relative my-2 md:my-0 mx-2 inline-block py-8 px-2 relative hover:opacity-80" style="width:110px;height:110px;border-color: #f61a30;">
                    <img src="https://cdn.musora.com/image/fetch/w_250,q_auto:best/https://pianote.s3.amazonaws.com/logo/pianote-logo-red.png" class="w-auto h-auto" style="max-width: 90px;max-height: 25px;"><br>
                    <p class="text-xs"><strong>ASSETS</strong></p>
                    <i class="fas fa-arrow-to-bottom absolute left-1/2 bottom-0 transform -translate-x-1/2 pb-3 text-xs"></i>
                </a>
                <a href="https://musora-center.s3.amazonaws.com/brand/Guitareo-Assets.zip" class="align-middle rounded-full border-2 relative my-2 md:my-0 mx-2 inline-block py-8 px-2 relative hover:opacity-80" style="width:110px;height:110px;border-color: #03c8ac;">
                    <img src="https://guitareo.s3.amazonaws.com/sales/guitareo-logo-green.png" class="w-auto h-auto" style="max-width: 90px;max-height: 25px;"><br>
                    <p class="text-xs"><strong>ASSETS</strong></p>
                    <i class="fas fa-arrow-to-bottom absolute left-1/2 bottom-0 transform -translate-x-1/2 pb-3 text-xs"></i>
                </a>
                <a href="https://musora-center.s3.amazonaws.com/brand/Singeo-Assets.zip" class="align-middle rounded-full border-2 relative my-2 md:my-0 mx-2 inline-block py-8 px-2 relative hover:opacity-80" style="width:110px;height:110px;border-color: #9a01ee;">
                    <img src="https://singeo.s3.amazonaws.com/sales/2021/singeo-logo.png" class="w-auto h-auto" style="max-width: 90px;max-height: 25px;"><br>
                    <p class="text-xs"><strong>ASSETS</strong></p>
                    <i class="fas fa-arrow-to-bottom absolute left-1/2 bottom-0 transform -translate-x-1/2 pb-3 text-xs"></i>
                </a>
                {{--<a href="https://musora-center.s3.amazonaws.com/brand/Recordeo-Assets.zip" class="align-middle rounded-full border-2 relative my-2 md:my-0 mx-2 inline-block py-8 px-2 relative hover:opacity-80" style="width:110px;height:110px;border-color: #ffae03;">--}}
                    {{--<img src="https://d1y4o0cjx5s9r3.cloudfront.net/marketing/sales/logo-yellow.png" class="w-auto h-auto" style="max-width: 90px;max-height: 25px;"><br>--}}
                    {{--<p class="text-xs"><strong>ASSETS</strong></p>--}}
                    {{--<i class="fas fa-arrow-to-bottom absolute left-1/2 bottom-0 transform -translate-x-1/2 pb-3 text-xs"></i>--}}
                {{--</a>--}}
            </div>
        </div>
    </div>

@stop