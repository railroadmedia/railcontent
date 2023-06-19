@extends('pianote.lead-gen.classical-piano.classical-piano-layout')

@section('meta')
    <meta name="robots" content="noindex">
    @parent
@endsection

@section('page-body')
    <header class="header text-center text-white py-12 md:py-18 lg:py-20 px-4 bg-center bg-no-repeat relative" style="background-color:#010519; background-image:url(https://www.musora.com/musora-cdn/image/width=1500,quality=85/https://d2vyvo0tyx8ig5.cloudfront.net/lead-gen/classical-piano/final-bg.jpg);">
        <div class="container mx-auto relative z-10 max-w-4xl">
            <img class="h-10 md:h-20 lg:h-24" src="https://www.musora.com/musora-cdn/image/width=1500,quality=85/https://d2vyvo0tyx8ig5.cloudfront.net/lead-gen/classical-piano/logo.png">
        </div>
    </header>

    <div class="text-center text-white py-10 md:py-20 px-4" style="background: linear-gradient(to bottom, #00101d 60%, #171427);">
        <div class="container mx-auto">
            <h5 class="leading-normal max-w-xl lg:max-w-2xl">Simply click on the first lesson<br class="inline md:hidden"> below to get started.</h5>

            <div class="flex flex-wrap items-start justify-center mx-auto max-w-xs md:max-w-2xl lg:max-w-6xl px-0 md:px-2 my-8">
                <a href="/classical-piano/lessons/1" class="px-1 md:px-4 w-1/2 lg:w-1/4 mb-7">
                    <div class="aspect-16:9 border-4 rounded-xl w-full bg-cover bg-black bg-center mb-2 cursor-pointer hover:opacity-90 transition-opacity duration-300 relative" style="background-image:url(https://i.vimeocdn.com/video/1348484700-f1676cc5d71f95c91af4359c80dd48f31d8459d6d2e424ea221682a7da1e3624-d_500);">
                        <i class="fas fa-play bg-pianote rounded-full p-3 absolute bottom-0 left-0 m-2 text-center" style="text-indent: 2px;"></i>
                    </div>
                    <h6 class="leading-normal"><strong>5 Classical Piano Tips</strong></h6>
                </a>
                <a href="/classical-piano/lessons/2" class="px-1 md:px-4 w-1/2 lg:w-1/4 mb-7">
                    <div class="aspect-16:9 border-4 rounded-xl w-full bg-cover bg-black bg-center mb-2 cursor-pointer hover:opacity-90 transition-opacity duration-300 relative" style="background-image:url(https://i.vimeocdn.com/video/1348485549-add695e75f60eedd07eec845c0e07a8e9468795b94d2400bcc4f3288db9bb0db-d_500);">
                        <i class="fas fa-play bg-pianote rounded-full p-3 absolute bottom-0 left-0 m-2 text-center" style="text-indent: 2px;"></i>
                    </div>
                    <h6 class="leading-normal"><strong>Hand Positioning & Exercises</strong></h6>
                </a>
                <a href="/classical-piano/lessons/3" class="px-1 md:px-4 w-1/2 lg:w-1/4 mb-7">
                    <div class="aspect-16:9 border-4 rounded-xl w-full bg-cover bg-black bg-center mb-2 cursor-pointer hover:opacity-90 transition-opacity duration-300 relative" style="background-image:url(https://i.vimeocdn.com/video/1348486156-e5fd383daef14bde0507d3485eb4935b1457be075f4546b3debca6f2d5c80be5-d_500);">
                        <i class="fas fa-play bg-pianote rounded-full p-3 absolute bottom-0 left-0 m-2 text-center" style="text-indent: 2px;"></i>
                    </div>
                    <h6 class="leading-normal"><strong>Playing Your First Classical Piece</strong></h6>
                </a>
                <a href="/classical-piano/lessons/4" class="px-1 md:px-4 w-1/2 lg:w-1/4 mb-7 md:mb-0">
                    <div class="aspect-16:9 border-4 rounded-xl w-full bg-cover bg-black bg-center mb-2 cursor-pointer hover:opacity-90 transition-opacity duration-300 relative" style="background-image:url(https://i.vimeocdn.com/video/1348487138-78a002bff259c65a103bb4a45a97021e03eba1da366155a554ba74b3a38a6da2-d_500);">
                        <i class="fas fa-play bg-pianote rounded-full p-3 absolute bottom-0 left-0 m-2 text-center" style="text-indent: 2px;"></i>
                    </div>
                    <h6 class="leading-normal"><strong>Playing With Expression</strong></h6>
                </a>
            </div>
        </div>
    </div>
    <section class="text-center py-12 md:py-20 lg:py-24 text-white bg-center bg-cover lazyload" style="background-color:#000417;" data-bg="https://www.musora.com/musora-cdn/image/width=1500,q_60,quality=85/https://d2vyvo0tyx8ig5.cloudfront.net/shop/header-background.jpg">
        <div class="container mx-auto">
            <div class="w-full px-2 md:px-3 text-center">
                <img class="h-10 sm:h-20 lg:h-24 mb-5 lazyload" data-src="https://www.musora.com/musora-cdn/image/width=1300,q_60,quality=85/https://d2vyvo0tyx8ig5.cloudfront.net/logo/pianote-logo-red.png">
                <h3><strong>Start your free 7-day trial.</strong></h3>
                <h5 class="leading-normal"><em class="opacity-70">Cancel anytime. 90-Day Money-Back Guarantee</em></h5>
                <a class="join my-5 md:my-7" href="/choose-plan">Get Started &raquo;</a>
            </div>
        </div>
    </section>
@endsection
