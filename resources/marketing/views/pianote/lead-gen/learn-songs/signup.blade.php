@extends('pianote.lead-gen.learn-songs.learn-songs-layout')

@section('page-body')
    <header class="header text-center text-white pt-20 pb-8 sm:py-9 px-4 bg-top bg-no-repeat relative" style="background-color:#010519; background-image:url(https://www.musora.com/musora-cdn/image/width=2500,q_60,quality=85/https://d2vyvo0tyx8ig5.cloudfront.net/lead-gen/learn-3-songs/header.jpg);">
        <div class="container mx-auto relative z-10">
            <div class="flex flex-wrap items-center md:py-10 lg:py-20">
                <div class="w-full md:w-1/2">
                    <i class="fas fa-play play-button autoplay-video" data-open="trailer"></i>
                </div>
                <div class="w-full md:w-1/2 px-10 md:px-0 my-5 md:my-0">
                    <img class="w-full max-w-xs lg:max-w-md" src="https://www.musora.com/musora-cdn/image/width=900,q_60,quality=85/https://d2vyvo0tyx8ig5.cloudfront.net/lead-gen/learn-3-songs/logo-vertical.png">
                </div>
            </div>
            <h1><strong>Start playing REAL<br class="inline sm:hidden"> songs today</strong></h1>
            <h4 class="leading-tight mt-3 md:mt-4 mb-4 md:mb-7"><em><strong>Because it doesn’t take months<br class="inline sm:hidden"> to play beautiful music</strong><br>
            <span class="opacity-70">Enter your email below for<br class="inline sm:hidden"> your free song tutorials.</span></em></h4>
            <div class="max-w-3xl mx-auto">
                @include('pianote._partials._sign-up-form-rc', [
                    "recaptchaKey" => $recaptchaKey,
                    "formId" => "Pianote - Engagement - Trigger - Learn 3 Songs - Web Form",
                    "formName" => 'Learn 3 Songs On Piano',
                ])
            </div>
        </div>
        <div class="absolute bottom-0 left-0 right-0 h-4/5 md:h-1/2 lg:h-2/5 z-0" style="background:linear-gradient(to bottom, transparent, #010519 40%);"></div>
    </header>
    <div class="reveal large text-center" id="trailer" data-reveal data-reset-on-close="false">
        <div class="aspect-16:9 w-full relative">
            <iframe class="absolute w-full h-full reset-on-close" src="" data-lazy-load-url="//player.vimeo.com/video/556327370?autoplay=1" frameborder="0" allowfullscreen allow="autoplay"></iframe>
        </div>
    </div>
    <div class="text-center text-white" style="background-color:#010519;">
        <div class="container mx-auto">
            <div class="flex flex-wrap items-start max-w-xl mx-auto px-2">
                <div class="px-1 md:px-3 inline-block w-1/3">
                    <div class="aspect-1:1 border-4 rounded-xl w-full bg-cover bg-black bg-center md:mb-1 cursor-pointer hover:opacity-90 transition-opacity duration-300 autoplay-video" data-open="songLewis" style="background-image:url(https://www.musora.com/musora-cdn/image/width=350,q_60,quality=85/https://d2vyvo0tyx8ig5.cloudfront.net/lead-gen/learn-3-songs/album-lewis.webp);"></div>
                    <p class="hidden md:inline"><strong>Someone You Loved</strong><br>
                    Lewis Capaldi</p>
                </div>
                <div class="px-1 md:px-3 inline-block w-1/3">
                    <div class="aspect-1:1 border-4 rounded-xl w-full bg-cover bg-black bg-center md:mb-1 cursor-pointer hover:opacity-90 transition-opacity duration-300 autoplay-video" data-open="songLeonard" style="background-image:url(https://www.musora.com/musora-cdn/image/width=350,q_60,quality=85/https://d2vyvo0tyx8ig5.cloudfront.net/lead-gen/learn-3-songs/album-leonard.webp);"></div>
                    <p class="hidden md:inline"><strong>Hallelujah</strong><br>
                    Leonard Cohen</p>
                </div>
                <div class="px-1 md:px-3 inline-block w-1/3">
                    <div class="aspect-1:1 border-4 rounded-xl w-full bg-cover bg-black bg-center md:mb-1 cursor-pointer hover:opacity-90 transition-opacity duration-300 autoplay-video" data-open="songTaylor" style="background-image:url(https://www.musora.com/musora-cdn/image/width=350,q_60,quality=85/https://d2vyvo0tyx8ig5.cloudfront.net/lead-gen/learn-3-songs/album-taylor.webp);"></div>
                    <p class="hidden md:inline"><strong>Love Story</strong><br>
                    Taylor Swift</p>
                </div>
            </div>
        </div>
    </div>
    <div class="reveal large text-center" id="songLewis" data-reveal data-reset-on-close="false">
        <div class="aspect-16:9 w-full relative">
            <iframe class="absolute w-full h-full reset-on-close" src="" data-lazy-load-url="//player.vimeo.com/video/556379410?autoplay=1" frameborder="0" allowfullscreen allow="autoplay"></iframe>
        </div>
    </div>
    <div class="reveal large text-center" id="songLeonard" data-reveal data-reset-on-close="false">
        <div class="aspect-16:9 w-full relative">
            <iframe class="absolute w-full h-full reset-on-close" src="" data-lazy-load-url="//player.vimeo.com/video/556379424?autoplay=1" frameborder="0" allowfullscreen allow="autoplay"></iframe>
        </div>
    </div>
    <div class="reveal large text-center" id="songTaylor" data-reveal data-reset-on-close="false">
        <div class="aspect-16:9 w-full relative">
            <iframe class="absolute w-full h-full reset-on-close" src="" data-lazy-load-url="//player.vimeo.com/video/556379447?autoplay=1" frameborder="0" allowfullscreen allow="autoplay"></iframe>
        </div>
    </div>
    <section class="text-center text-white relative py-12 px-4" style="background: linear-gradient(to bottom, #000417, #000e2f);">
        <div class="container mx-auto">
            <h3 class="leading-normal"><strong>You can play real songs on<br class="inline sm:hidden">  the piano. We’ll prove it.</strong></h3>
            <h5 class="max-w-xl lg:max-w-3xl md:px-3 leading-normal mt-3 md:mt-5 mb-8">We play the piano to play songs. Real songs. Songs people want to listen to. These 3 fun lessons will show you <em>exactly</em> how to start playing beautiful songs on the piano. Even if you’ve never touched the keys before.</h5>
            <div class="flex flex-wrap items-start max-w-6xl mx-auto">
                <div class="w-full md:w-1/3 px-3 mb-10 md:mb-0">
                    <i class="fal fa-history text-pianote text-5xl md:text-6xl lg:text-7xl"></i>
                    <h4 class="mt-4 md:mt-7 md:mb-2"><strong>Short Fun Lessons</strong></h4>
                    <p>So you spend more time playing.</p>
                </div>
                <div class="w-full md:w-1/3 px-3 mb-10 md:mb-0">
                    <i class="fal fa-arrow-to-bottom text-pianote text-5xl md:text-6xl lg:text-7xl"></i>
                    <h4 class="mt-4 md:mt-7 md:mb-2"><strong>Downloadable Charts</strong></h4>
                    <p>Save them, print them, they’re yours!</p>
                </div>
                <div class="w-full md:w-1/3 px-3">
                    <i class="fal fa-music text-pianote text-5xl md:text-6xl lg:text-7xl"></i>
                    <h4 class="mt-4 md:mt-7 md:mb-2"><strong>Hear The Results</strong></h4>
                    <p>From your very 1st lesson.</p>
                </div>
            </div>

            <div class="flex flex-wrap items-center mx-auto max-w-sm md:max-w-4xl md:px-3 mt-16 md:mt-32">
                <div class="w-full md:w-5/12 lg:w-1/2 md:order-1 -mb-80 md:mb-0 relative">
                    <img class="md:border-4 md:rounded-xl lazyload w-full" data-src="https://www.musora.com/musora-cdn/image/width=900,q_60,quality=85/https://d2vyvo0tyx8ig5.cloudfront.net/lead-gen/learn-3-songs/lisa.png">
                    <div class="absolute bottom-0 left-0 right-0 h-2/3 z-10 md:hidden" style="background:linear-gradient(to bottom, transparent, #000923 40%);"></div>
                </div>
                <div class="w-full md:w-7/12 lg:w-1/2 px-4 md:pl-0 md:pr-8 lg:pr-14 z-20">
                    <img class="w-3/4 lg:w-full lazyload" data-src="https://www.musora.com/musora-cdn/image/width=750,q_60,quality=85/https://d2vyvo0tyx8ig5.cloudfront.net/lead-gen/learn-3-songs/lisa-name.png">
                    <h3 class="text-pianote mb-5 lg:mb-8"><em>is your teacher.</em></h3>
                    <h5 class="leading-relaxed lg:leading-loose text-left">Lisa is the lead instructor at Pianote, and will show you how to play your first 3 songs on the piano. She believes songs are the key to success at this instrument, and that anyone can play a song in their very first lesson. Lisa’s contagious enthusiasm will have you excited to practice and return to the keys again and again. </h5>
                </div>
            </div>

            <div class="flex flex-wrap items-start max-w-4xl mx-auto mt-12 md:mt-20">
                <div class="w-full md:w-1/2 px-7 lg:px-14 mb-14 md:mb-0">
                    <img class="border-4 rounded-full border-white w-28 md:w-32 lg:w-40 lazyload" data-src="https://www.musora.com/musora-cdn/image/width=320,q_60,quality=85/https://d2vyvo0tyx8ig5.cloudfront.net/500-songs/sales/marcel.jpg">
                    <h5 class="leading-relaxed my-4 md:my-7"><em>“Lisa may not know it, but she is truly a natural at delivering and teaching the material."</em></h5>
                    <h5><strong>Marcel Robichaud</strong></h5>
                    <h6 class="text-pianote mt-1">Canada</h6>
                </div>
                <div class="w-full md:w-1/2 px-7 lg:px-14">
                    <img class="border-4 rounded-full border-white w-28 md:w-32 lg:w-40 lazyload" data-src="https://www.musora.com/musora-cdn/image/width=320,q_60,quality=85/https://d2vyvo0tyx8ig5.cloudfront.net/500-songs/sales/bernhard.jpg">
                    <h5 class="leading-relaxed my-4 md:my-7"><em>"Lisa is the perfect teacher. Her hands-on teaching approach is invaluable to my learning and helps me make progress more easily."</em></h5>
                    <h5><strong>Bernhard Zainsinger</strong></h5>
                    <h6 class="text-pianote mt-1">Switzerland</h6>
                </div>
            </div>
        </div>
    </section>
    <section class="text-center py-14 md:py-24 lg:py-28 text-white bg-black bg-center bg-cover lazyload" style="background-color:#000417;" data-bg="https://www.musora.com/musora-cdn/image/width=1500,q_60,quality=85/https://d2vyvo0tyx8ig5.cloudfront.net/shop/header-background.jpg">
        <div class="container mx-auto">
            <div class="w-full px-2 md:px-3 text-center">
                <img class="inline md:hidden w-3/4 mb-5 lazyload" data-src="https://www.musora.com/musora-cdn/image/width=900,q_60,quality=85/https://d2vyvo0tyx8ig5.cloudfront.net/lead-gen/learn-3-songs/logo-vertical.png">
                <img class="hidden md:inline w-full max-w-lg lg:max-w-2xl mb-10 lazyload" data-src="https://www.musora.com/musora-cdn/image/width=1300,q_60,quality=85/https://d2vyvo0tyx8ig5.cloudfront.net/lead-gen/learn-3-songs/logo-horizontal.png">
                <h1><strong>Play songs in minutes, <br class="inline sm:hidden">  not hours.</strong></h1>
                <h4 class="mt-5 lg:mt-4 mb-6 lg:mb-8 leading-normal"><em><strong>Because it doesn’t take months<br class="inline sm:hidden"> to play beautiful music</strong><br>
                        <span class="opacity-70">Enter your email below<br class="inline sm:hidden"> for your free song tutorials.</span></em></h4>
                <div class="mx-auto" style="max-width:700px">
                    @include('pianote._partials._sign-up-form-rc', [
                    "recaptchaKey" => $recaptchaKey,
                        "formId" => "Pianote - Engagement - Trigger - Learn 3 Songs - Web Form",
                        "formName" => 'Learn 3 Songs On Piano',
                    ])
                </div>
            </div>
        </div>
    </section>
@endsection
@section('scripts')
    @parent
    <script type="text/javascript" src="{{ asset('/marketing/js/modal.js') }}"></script>
    <script>
        $(document).ready(function () {
            $(document).foundation();
        });
    </script>
    <script type="text/javascript" src="{{ asset('/marketing/js/modal-autoplay.js') }}"></script>
@endsection
