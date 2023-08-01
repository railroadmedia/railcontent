@extends('pianote._partials.global-layout')

@section('global-head')

    <title>Improvisation & Musical Freedom With Jesús Molina</title>
    <meta property="og:title" content="Improvisation & Musical Freedom With Jesús Molina">

    <meta name="description" content="Get inside the mind of one of the world’s best improvisers">
    <meta property="og:description" content="Get inside the mind of one of the world’s best improvisers">

    <meta property="og:url" content="https://www.pianote.com/{{ Request::path() }}">
    <meta property="og:image" content="https://www.musora.com/musora-cdn/image/width=1200,quality=95/https://d2vyvo0tyx8ig5.cloudfront.net/sales/jesus-molina/fb_share_image.jpg" style="display: none;">

    <link rel="stylesheet" href="{{ mix('marketing/css/app.css') }}">
    <link href="{{ asset('/marketing/css/tailwind-helpers.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('/marketing/parcel/drumeo/nav-footer-pianote.css') }}">
    <link rel="stylesheet" href="{{ asset('/marketing/parcel/drumeo/sales-pianote.css') }}">
    <style>

        .header {
            height:570px;
        }
        @media (min-width:768px) {
            .header {
                height:750px;
            }
        }

        @media (min-width: 768px) {
            .flip-div {
                padding-bottom: 100%;
            }
        }
        @media (min-width: 768px) {
            .flip-div.flipped .front {
                -ms-transform: rotateY(180deg);
                -webkit-transform: rotateY(180deg);
                transform: rotateY(180deg);
            }
            .flip-div.flipped .back {
                -ms-transform: rotateY(0deg);
                -webkit-transform: rotateY(0deg);
                transform: rotateY(0deg);
            }
            .flip-div .back {
                -ms-transform: rotateY(-180deg);
                -webkit-transform: rotateY(-180deg);
                transform: rotateY(-180deg);
            }
        }
        .flip-div .bg-image {
            padding-bottom: 75%;
        }
        @media (min-width: 768px) {
            .flip-div .bg-image {
                padding-bottom: 100%;
            }
        }

        .text-navy {
            color: #a1afc9;
        }
    </style>
@stop

@section('global-body')
    @include('pianote.sales.partials._nav', [
    "cartVersion" => true,
    ])

    @include('pianote._partials._promo-banner-no-tw', [
        "name" => "Improvisation & Musical Freedom",
        "fullPrice" => floatval($productPrices['jesus-molina-improvisation-and-musical-freedom-pack']->price),
        "price" => floatval($productPrices['jesus-molina-improvisation-and-musical-freedom-pack']->discounted_price),
        "noBreadcrumb" => true
    ])

    @php $annualLink = '/ecommerce/add-to-cart?products[jesus-molina-improvisation-and-musical-freedom-pack]=1&redirect=/order' @endphp

    <header class="header text-white relative overflow-hidden z-10" style="background: rgba(38, 13, 15, 0.7);">
        <div class="transform -translate-y-1/2 top-1/2 left-0 w-full absolute z-20 px-4 sm:px-6 text-center">
            <div class="container mx-auto max-w-6xl">
                <img class="h-20 sm:h-28 lg:h-32 mb-64 sm:mb-80" src="https://www.musora.com/musora-cdn/image/width=900,quality=95/https://d2vyvo0tyx8ig5.cloudfront.net/sales/jesus-molina/Logo.png" alt="Improvisation logo">
                <h2 class="leading-tight max-w-xs sm:max-w-md lg:max-w-2xl mx-auto sm:text-3xl lg:text-4xl"><strong>Get inside the mind of one of the world’s best improvisers</strong></h2>
                <p class="leading-normal mt-2 sm:mt-3 mb-4 sm:mb-5">Learn from the master himself in <br class="inline sm:hidden"> this exclusive course from Pianote</p>
                <a href="{{ $annualLink }}" class="join blue w-1/2">Get Started</a>
                {{--<div class="join sold-out w-1/2">Closed</div>--}}
            </div>
        </div>
        <div class="top-0 left-0 absolute w-full h-full z-10" style="background: rgba(38, 13, 15, 0.7);"></div>
        <video class="object-cover w-full h-full relative z-0" poster="https://i.vimeocdn.com/video/1497447067-0e4925508fe22ffc20409ea170a6b9aaca6ab22560cc9a11a85ba396272afe87-d_240" src="https://player.vimeo.com/progressive_redirect/playback/703887445/rendition/720p/file.mp4?loc=external&signature=997301dbe08c6b098c6c4496c1ae2274bbdd82df7e48b54dd652b2c27cf88967" type="video/mp4" autoplay="" loop="" playsinline="" muted></video>
    </header>

    <section class="px-5 sm:px-6 lg:px-10 py-10 md:py-12 md:py-14 text-white text-center overflow-hidden" style="background:linear-gradient(to bottom, #000c17 40%, #1e0816);">
        <div class="container mx-auto max-w-xl lg:max-w-6xl">
            {{--<div class="text-black text-left border-4 rounded-xl p-3 sm:py-7 sm:px-10 mb-7 sm:mb-14 inline-block" style="background-color:#fff8f9;border-color:#3f4850;">--}}
            {{--<div class="flex flex-wrap sm:flex-nowrap items-center justify-center mx-auto">--}}
            {{--<img class="mb-2 sm:mb-0 h-10 sm:h-14 lazyload" data-src="https://www.musora.com/musora-cdn/image/width=160,quality=95/https://d2vyvo0tyx8ig5.cloudfront.net/sales/jesus-molina/pianote-coaches-logo.png">--}}
            {{--<p class="w-full sm:w-auto leading-tight pl-3 sm:pl-5 m-0"><strong>Jesús Molina’s coach feature--}}
            {{--@if(Carbon\Carbon::create(2022, 5, 24, 10, 0, 0, 'America/Vancouver') > Carbon\Carbon::now())--}}
            {{--& live event are--}}
            {{--@else--}}
            {{--is--}}
            {{--@endif--}}
            {{--included with a Pianote membership</strong><br>--}}
            {{--Full piano lessons curriculum // 100s of song tutorials & practice tools. <br>--}}
            {{--<span class="text-sm opacity-40">Accessible on Desktop, iOS, and Android</span></p>--}}
            {{--</div>--}}
            {{--</div>--}}
            <h2 class="mb-5 sm:mb-7"><strong>You’ll never think of music<br class="inline lg:hidden"> the same way again</strong></h2>
            <div class="flex flex-wrap justify-center mx-auto">
                <div class="w-full lg:w-7/12">
                    <div class="aspect-16:9 rounded-xl overflow-hidden w-full relative">
                        <iframe class="absolute w-full h-full" src="//player.vimeo.com/video/703892831" frameborder="0" allowfullscreen allow="autoplay" title="Jesus intro video"></iframe>
                    </div>
                </div>
                <p class="w-full lg:w-5/12 lg:pl-10 mt-7 lg:mt-0 text-left">For Jesús Molina, improvisation is bringing your soul into music. It’s expressing things that words cannot express.
                    <br><br>
                    But it’s not some impossible dream, reserved for only the very rarest and most gifted musicians.
                    <br><br>
                    <strong>You have a soul. You have a voice.</strong>
                    <br><br>
                    Jesús is here to help you express it. So…
                    <br><br>
                    What will your future look like? Here’s a glimpse…</p>
            </div>
        </div>
    </section>
    <section class="px-4 lg:px-6 py-10 md:py-12 md:py-14 text-white text-center overflow-hidden bg-center bg-cover lazyload" style="background-color:#010d17;" data-bg="https://www.musora.com/musora-cdn/image/width=1500,quality=95/https://d2vyvo0tyx8ig5.cloudfront.net/sales/jesus-molina/Thumbnail_BG.jpg">
        <div class="container mx-auto max-w-6xl">
            <h2><strong>How to improvise, step-by-step</strong></h2>
            <h6 class="mt-1 mb-10"><em>But in a fun way</em></h6>

            <div class="flex flex-wrap items-center text-left mb-3">
                <p class="w-full sm:w-1/2 px-3 lg:px-10 text-navy">You’ve probably said it to yourself before:
                    <br><br>
                    “I don’t know how to improvise.”<br>
                    “I’m from a classical background.”<br>
                    “I’m not creative.”
                    <br><br>
                    But once you hear Jesús Molina talk about music, you’ll realize it’s simply not true. So how do you do it?
                    <br><br>
                    Simple. You learn from the best in the world!
                    <br><br>
                    Jesús will show you how to approach improvising in a structured, step-by-step way that’s fun, inspiring, and 100% not scary.
                    <br><br>
                    <strong>Here’s how:</strong></p>
                <div class="w-full sm:w-1/2 px-2 mt-5 sm:mt-0">
                    <div class="rounded-xl overflow-hidden" style="background-color:#061b30;">
                        <div class="relative aspect-16:9 bg-cover bg-center cursor-pointer autoplay-video lazyload" data-open="molinaTrailer" data-bg="https://www.musora.com/musora-cdn/image/width=1000,quality=95/https://d2vyvo0tyx8ig5.cloudfront.net/sales/jesus-molina/what-is-improv-no-play.jpg">
                            <i class="absolute z-10 top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 fas fa-play play-button smaller"></i>
                        </div>
                        <p class="p-6">Think you can’t improvise? Jesús Molina is here to bust that myth. You’ll discover how to think about improvisation in a new way.</p>
                    </div>
                </div>
            </div>
            <div class="flex flex-wrap text-left mb-3">
                <div class="w-full sm:w-1/2 mb-5 sm:mb-0 px-2">
                    <div class="rounded-xl overflow-hidden" style="background-color:#061b30;">
                        <div class="relative aspect-16:9 bg-cover bg-center lazyload" data-bg="https://www.musora.com/musora-cdn/image/width=1000,quality=95/https://d2vyvo0tyx8ig5.cloudfront.net/sales/jesus-molina/Classical.jpg"></div>
                        <p class="p-6">Classical improvisation? It sounds like a contradiction, but when you hear Jesús talk about this theme, you’ll be inspired to start making classical-sounding music.</p>
                    </div>
                </div>
                <div class="w-full sm:w-1/2 px-2">
                    <div class="rounded-xl overflow-hidden" style="background-color:#061b30;">
                        <div class="relative aspect-16:9 bg-cover bg-center lazyload" data-bg="https://www.musora.com/musora-cdn/image/width=1000,quality=95/https://d2vyvo0tyx8ig5.cloudfront.net/sales/jesus-molina/Jazz_improv.jpg"></div>
                        <p class="p-6">Get ready to play “Happy Birthday” like you’ve never played it before. Jesús will break down step-by-step, bar-by-bar how he makes this classic sound jazzy.</p>
                    </div>
                </div>
            </div>
            <div class="flex flex-wrap text-left">
                <div class="w-full sm:w-1/3 mb-5 sm:mb-0 px-2 sm:px-1">
                    <div class="rounded-xl overflow-hidden" style="background-color:#061b30;">
                        <div class="relative aspect-16:9 bg-cover bg-center lazyload" data-bg="https://www.musora.com/musora-cdn/image/width=700,quality=95/https://d2vyvo0tyx8ig5.cloudfront.net/sales/jesus-molina/Latin_improv.jpg"></div>
                        <p class="p-5">Discover the iconic rhythms and melodies unique to Latin music, and how to use them to transform any song.</p>
                    </div>
                </div>
                <div class="w-full sm:w-1/3 mb-5 sm:mb-0 px-2 sm:px-1">
                    <div class="rounded-xl overflow-hidden" style="background-color:#061b30;">
                        <div class="relative aspect-16:9 bg-cover bg-center lazyload" data-bg="https://www.musora.com/musora-cdn/image/width=700,quality=95/https://d2vyvo0tyx8ig5.cloudfront.net/sales/jesus-molina/Stride.jpg"></div>
                        <p class="p-5">Learn the basics of Stride, and how to start improvising over new, powerful left hand.</p>
                    </div>
                </div>
                <div class="w-full sm:w-1/3 px-2 sm:px-1">
                    <div class="rounded-xl overflow-hidden" style="background-color:#061b30;">
                        <div class="relative aspect-16:9 bg-cover bg-center lazyload" data-bg="https://www.musora.com/musora-cdn/image/width=700,quality=95/https://d2vyvo0tyx8ig5.cloudfront.net/sales/jesus-molina/Power_ballad.jpg"></div>
                        <p class="p-5">Unlock an entire world of possibilities on the piano with just a little knowledge (and one interval).</p>
                    </div>
                </div>

            </div>
        </div>
    </section>

    <div id="practice" class="anchor"></div>
    <section class="px-4 lg:px-6 py-10 md:py-12 md:py-14 text-white text-center" style="background: linear-gradient(to bottom, #000c17 60%, #021124);">
        <div class="container mx-auto max-w-5xl">
            <h2><strong>Practice like a Pro</strong></h2>
            <h6 class="mt-1"><em>Get Jesús Molina’s exclusive practice plans</em></h6>
            <p class="my-5 sm:my-7 text-navy max-w-xl">“When you practice, you’re literally building… your destiny.” ~ Jesús Molina
                <br><br>
                Practice makes perfect. So how does Jesús do it? For the first time, he’s sharing his practice secrets and routines, exclusively with Pianote.
                <br><br>
                <strong>And that means you.</strong></p>
            <div class="flex flex-wrap text-left">
                <div class="w-full sm:w-1/2 mb-5 sm:mb-0 px-2">
                    <div class="rounded-xl overflow-hidden" style="background-color:#061b30;">
                        <div class="relative aspect-16:9 bg-cover bg-center lazyload" data-bg="https://www.musora.com/musora-cdn/image/width=1000,quality=95/https://d2vyvo0tyx8ig5.cloudfront.net/sales/jesus-molina/How_to_practice.jpg"></div>
                        <p class="p-6">Imagine if your daily practice sessions were the most effective they could be. Jesús will show you how to make every minute count, so you’ll never waste time at the keys, and you’ll get better faster.</p>
                    </div>
                </div>
                <div class="w-full sm:w-1/2 px-2">
                    <div class="rounded-xl overflow-hidden" style="background-color:#061b30;">
                        <div class="relative aspect-16:9 bg-cover bg-center lazyload" data-bg="https://www.musora.com/musora-cdn/image/width=1000,quality=95/https://d2vyvo0tyx8ig5.cloudfront.net/sales/jesus-molina/Six_month_plan.jpg"></div>
                        <p class="p-6">How did Jesús get so good? This is how. For the first time, he’s revealing his detailed, 6-month practice methodology. This is your roadmap to better playing, and musical freedom.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
    {{--<section class="px-8 sm:px-6 py-8 md:py-12 lg:py-20 text-white text-center relative" style="background-color:#650215;">--}}
    {{--<div class="container mx-auto max-w-6xl relative z-10">--}}
    {{--<div class="w-full sm:w-7/12 lg:w-1/2 text-left mt-72 sm:mt-0 ml-auto">--}}
    {{--<h2><strong>Chat LIVE with Jesús Molina</strong></h2>--}}
    {{--<p class="my-3 lg:my-5 leading-tight">Sign up before <strong>May 24</strong> and reserve your spot to connect LIVE with Jesús. He’ll talk about the course, his life, and answer any questions you might have about the piano, practice, and turning pro. Anything.--}}
    {{--<br><br>--}}
    {{--It’s rare you get a chance to connect with a musician of this caliber. Don’t miss yours.</p>--}}
    {{--<a class="join smaller" href="{{ $annualLink }}">Get Started</a>--}}
    {{--</div>--}}
    {{--</div>--}}
    {{--<div class="inset-0 absolute z-0 bg-top bg-cover block sm:hidden lazyload" data-bg="https://www.musora.com/musora-cdn/image/width=700,quality=95/https://d2vyvo0tyx8ig5.cloudfront.net/sales/jesus-molina/Live_BG_mobile.jpg"></div>--}}
    {{--<div class="inset-0 absolute z-0 bg-top bg-cover hidden sm:block lazyload" data-bg="https://www.musora.com/musora-cdn/image/width=2000,quality=95/https://d2vyvo0tyx8ig5.cloudfront.net/sales/jesus-molina/Live_chat.jpg"></div>--}}
    {{--</section>--}}

    <div id="lessons" class="anchor"></div>
    <section class="px-4 sm:px-8 py-10 md:py-12 md:py-14 text-white text-center overflow-hidden bg-musora-black">
        <div class="container mx-auto max-w-5xl">
            <h2><strong>Become a better musician</strong></h2>
            <h6 class="mt-1 mb-7"><em>All the tools at your fingertips.</em></h6>

            <div class="flex flex-wrap sm:flex-nowrap items-center text-left mb-8 sm:mb-16">
                <img class="h-44 sm:h-56 lg:h-72 mx-auto sm:mx-0 rounded-xl mb-3 sm:mb-0 lazyload" data-src="https://www.musora.com/musora-cdn/image/width=1000,quality=95/https://d2vyvo0tyx8ig5.cloudfront.net/sales/jesus-molina/Fully_transcribed_lessons.jpg" alt="Fully transcribed lesson image">
                <div class="w-full sm:w-1/2 sm:pl-10">
                    <h4 class="mx-0 mb-3 text-center sm:text-left"><strong>Fully transcribed lessons.</strong></h4>
                    <p class="text-light-navy max-w-xs sm:max-w-full">Every lesson has been transcribed for you. You won’t just listen to Jesús talk, you’ll play with him, and get downloadable sheet music of everything he plays.</p>
                </div>
            </div>
            <div class="flex flex-wrap sm:flex-nowrap items-center text-left mb-6 sm:mb-16">
                <video class="sm:order-1 h-44 sm:h-56 lg:h-72 mx-auto sm:mx-0 rounded-xl mb-3 sm:mb-0 lazyload" poster="https://i.vimeocdn.com/video/1433691356-c62f096d0d6be39d98203352fccdb6b91c08c4d611af9d391290b7f01d0e0081-d_540" data-src="https://player.vimeo.com/progressive_redirect/playback/710886224/rendition/720p/file.mp4?loc=external&signature=8f9ebdab6c4a1c3fb893bc11034ec805e48d1f8d5e1da24e6f35d7761b120f95" autoplay muted playsinline loop></video>
                <div class="w-full sm:w-1/2 sm:pr-10">
                    <h4 class="mx-0 mb-3 text-center sm:text-left"><strong>Detailed practice assignments.</strong></h4>
                    <p class="text-light-navy max-w-xs sm:max-w-full">Jesús will give you downloadable and fully-transcribed practice assignments for each lesson. How does he get so good? Practice? How do you get better? Practice.</p>
                </div>
            </div>
            <div class="flex flex-wrap sm:flex-nowrap items-center text-left">
                <video class="h-44 sm:h-56 lg:h-72 mx-auto sm:mx-0 rounded-xl mb-3 sm:mb-0 lazyload" poster="https://i.vimeocdn.com/video/1433690511-8160cf6c330761c98785cb1f18b900fae4b40ceea019ce97767bf4fa8d984281-d_540" data-src="https://player.vimeo.com/progressive_redirect/playback/710886199/rendition/540p/file.mp4?loc=external&signature=5a4519db6750d90173d5ba88ee6324f8d4a1a7e4e07aa79678e25f8fb83a9625" autoplay muted playsinline loop></video>
                <div class="w-full sm:w-1/2 sm:pl-10">
                    <h4 class="mx-0 mb-3 text-center sm:text-left"><strong>Multiple difficulty levels.</strong></h4>
                    <p class="text-light-navy max-w-xs sm:max-w-full">Worried you’re not up to his level? Well let’s be honest. None of us are. That’s why Jesús has broken down every level into multiple stages of difficulty. You can do this.</p>
                </div>
            </div>
        </div>
    </section>
    <section class="px-6 sm:px-8 py-8 md:py-10 md:py-12 text-white text-center overflow-hidden lazyload" style="background:linear-gradient(to right, #7d182c, #560314);">
        <div class="container mx-auto max-w-4xl">
            <div class="flex flex-wrap sm:flex-nowrap items-center">
                <img class="h-48 sm:h-56 lg:h-72 mx-auto border-4 lg:border-8 rounded-full" src="https://www.musora.com/musora-cdn/image/width=550,quality=95/https://d2vyvo0tyx8ig5.cloudfront.net/sales/jesus-molina/Jesus_Molina_profile.jpg" alt="Jesus Molina profile">
                <div class="w-full sm:w-auto mt-7 sm:mt-0 sm:pl-7 lg:pl-14 sm:text-left">
                    <h4 class="leading-normal"><em>“You are not limited. If you think you don’t have musicality in you - that’s the biggest mistake you can make.”</em>
                        <br><br>
                        <strong class="sm:float-right">~ Jesús Molina</strong></h4>
                </div>
            </div>
        </div>
    </section>
    {{--<section class="px-6 sm:px-5 lg:px-6 py-10 md:py-12 md:py-14 text-white text-center overflow-hidden" style="background:linear-gradient(to bottom, #01050f 60%, #021124);">--}}
    {{--<div class="container mx-auto max-w-6xl">--}}
    {{--<p class="text-sm text-pianote mb-1"><em><strong>Exclusively</strong> available inside</em></p>--}}
    {{--<img class="h-12 sm:h-14 lg:h-16" src="https://www.musora.com/musora-cdn/image/width=420,quality=95/https://d2vyvo0tyx8ig5.cloudfront.net/logo/pianote-logo-red.png">--}}
    {{--<h3 class="leading-tight my-2 md:my-4"><strong>Achieve musical freedom<br class="inline sm:hidden"> on the piano.</strong></h3>--}}
    {{--<p class="text-light-navy mb-8 md:mb-10">--}}
    {{--In addition to Jesús Molina’s coach feature, you’ll develop your skills on the piano <br class="hidden sm:inline">--}}
    {{--through lessons, songs, and personal support from the best piano players in the world. </p>--}}
    {{--<div class="md:grid md:grid-cols-3 md:gap-4 mx-auto">--}}
    {{--<div class="relative rounded-xl overflow-hidden mb-3 md:mb-0" style="background-color:#051124;">--}}
    {{--<div class="w-full aspect-16:9 bg-cover bg-center lazyload" data-bg="https://www.musora.com/musora-cdn/image/width=700,quality=95/https://d2vyvo0tyx8ig5.cloudfront.net/sales/2022/method-thumbs.jpg"></div>--}}
    {{--<div class="px-4 lg:px-6 py-5 lg:py-7">--}}
    {{--<img class="h-8 icon imgfilter-coaches" src="https://www.musora.com/musora-cdn/image/width=800,quality=95/https://dpwjbsxqtam5n.cloudfront.net/sales/2021/coaches-icon.svg" alt="coaches-icon">--}}
    {{--<img class="h-5 ml-2 imgfilter-coaches lazyload" data-src="https://cdn.musora.com/image/fetch/q_auto:best/https://dpwjbsxqtam5n.cloudfront.net/sales/2021/coaches-text.svg" alt="coaches-text">--}}
    {{--<h4 class="leading-tight my-3"><strong>Motivation <br class="hidden md:inline"> & Support</strong></h4>--}}
    {{--<p class="leading-normal text-light-navy">From the big stage straight to your living room – you’ll get weekly live events, lessons, and personal feedback from incredible artists as they guide and support you every step of the way on your piano journey. </p>--}}
    {{--</div>--}}
    {{--</div>--}}
    {{--<div class="relative rounded-xl overflow-hidden mb-3 md:mb-0" style="background-color:#051124;">--}}
    {{--<div class="w-full aspect-16:9 bg-cover bg-center lazyload" data-bg="https://www.musora.com/musora-cdn/image/width=700,quality=95/https://d2vyvo0tyx8ig5.cloudfront.net/sales/2022/coaches-thumbs.jpg"></div>--}}
    {{--<div class=" px-4 lg:px-6 py-5 lg:py-7">--}}
    {{--<i class="text-4xl align-middle fal fa-piano text-pianote"></i>--}}
    {{--<img class="h-5 ml-2 imgfilter-method lazyload" data-src="https://cdn.musora.com/image/fetch/q_auto:best/https://dpwjbsxqtam5n.cloudfront.net/sales/2021/method-text.svg" alt="method-text">--}}
    {{--<h4 class="leading-tight my-3"><strong>Step-By-Step<br class="hidden md:inline"> Curriculum</strong></h4>--}}
    {{--<p class="leading-normal text-light-navy">Build your foundation on the piano with a perfectly structured curriculum that will teach you all the skills you need to start playing beautiful music. This is your guide to musical freedom on the piano, perfect for beginners and intermediates.</p>--}}
    {{--</div>--}}
    {{--</div>--}}
    {{--<div class="relative rounded-xl overflow-hidden" style="background-color:#051124;">--}}
    {{--<div class="w-full aspect-16:9 bg-cover bg-center lazyload" data-bg="https://www.musora.com/musora-cdn/image/width=700,quality=95/https://d2vyvo0tyx8ig5.cloudfront.net/sales/2022/songs-thumbs.jpg"></div>--}}
    {{--<div class="px-4 lg:px-6 py-5 lg:py-7">--}}
    {{--<i class="text-4xl align-middle icon-songs text-songs"></i>--}}
    {{--<img class="h-5 ml-2 imgfilter-songs lazyload" data-src="https://cdn.musora.com/image/fetch/q_auto:best/https://dpwjbsxqtam5n.cloudfront.net/sales/2021/songs-text.svg" alt="songs-text">--}}
    {{--<h4 class="leading-tight my-3"><strong>Play Your <br class="hidden md:inline">  Favorite Songs</strong></h4>--}}
    {{--<p class="leading-normal text-light-navy">Nothing is better than playing real music! 100s of detailed song tutorials will teach you how to play popular music from all eras, styles, and genres. Practice along to backing tracks and download the sheet music for every song.</p>--}}
    {{--</div>--}}
    {{--</div>--}}
    {{--</div>--}}

    {{--<h2 class="mt-14 mb-1"><strong>Your piano goals start here.</strong></h2>--}}
    {{--<h6 class="leading-tight"><em>Improve your skills on any topic, any time, with <br class="hidden md:inline"> world-class teachers and personal support.</em></h6>--}}

    {{--<div class="w-full flex flex-wrap justify-center my-5 sm:my-10 mx-auto max-w-xs md:max-w-full">--}}
    {{--@php--}}
    {{--$topics = [--}}
    {{--[--}}
    {{--'logo' => 'https://d2vyvo0tyx8ig5.cloudfront.net/sales/jesus-molina/Logo.png',--}}
    {{--'image' => 'https://d2vyvo0tyx8ig5.cloudfront.net/sales/2022/jesus-molina-card.jpg',--}}
    {{--'title' => 'Improvisation & Musical Freedom',--}}
    {{--'description' => 'Anyone can improvise. Even you! Learn from one of the world’s best as Jesús Molina shows you his “secret chord voicings” and other tips.',--}}
    {{--'artist' => 'Jesús  <strong>Molina</strong>',--}}
    {{--'classes' => 'border-4 border-pianote',--}}
    {{--],--}}
    {{--[--}}
    {{--'logo' => 'https://d2vyvo0tyx8ig5.cloudfront.net/sales/2022/course-logo-classical.png',--}}
    {{--'image' => 'https://d2vyvo0tyx8ig5.cloudfront.net/sales/2022/classical-piano-card2.jpg',--}}
    {{--'title' => 'Classical Piano',--}}
    {{--'description' => 'Unlock the beauty of classical music with this course from world-class touring pianist, Victoria Theodore.',--}}
    {{--'artist' => 'Victoria  <strong>Theodore</strong>',--}}
    {{--],--}}
    {{--[--}}
    {{--'logo' => 'https://d2vyvo0tyx8ig5.cloudfront.net/sales/2022/gospel-piano-logo.png',--}}
    {{--'image' => 'https://d2vyvo0tyx8ig5.cloudfront.net/sales/2022/erskine-card.jpg',--}}
    {{--'title' => 'Gospel Piano',--}}
    {{--'description' => 'Get that “Gospel” sound from acclaimed touring pianist and musical director Erskine Hawkins. From beautiful chords to a stunning left hand, you’ll learn it all.',--}}
    {{--'artist' => 'Erskine  <strong>Hawkins</strong>',--}}
    {{--],--}}
    {{--[--}}
    {{--'logo' => 'https://d2vyvo0tyx8ig5.cloudfront.net/sales/2022/course-logo-cocktail.png',--}}
    {{--'image' => 'https://d2vyvo0tyx8ig5.cloudfront.net/sales/2022/cocktail-piano-card2.jpg',--}}
    {{--'title' => 'Cocktail Piano For Beginners',--}}
    {{--'description' => 'Learn the chord progressions, songs, and improvisation techniques to start playing cocktail piano.',--}}
    {{--'artist' => 'Brett <strong>Ziegler</strong>',--}}
    {{--],--}}
    {{--[--}}
    {{--'logo' => 'https://d2vyvo0tyx8ig5.cloudfront.net/products/play-beautiful-piano/logo-minimal.png',--}}
    {{--'image' => 'https://d2vyvo0tyx8ig5.cloudfront.net/sales/2022/playing-beautiful-card2.jpg',--}}
    {{--'title' => 'The Beginners Guide To Playing Beautiful Piano',--}}
    {{--'description' => 'Start playing beautiful piano music from your very first lesson.',--}}
    {{--'artist' => 'Lisa <strong>Witt</strong>',--}}
    {{--],--}}
    {{--[--}}
    {{--'logo' => 'https://d2vyvo0tyx8ig5.cloudfront.net/sales/2022/course-logo-latin.png',--}}
    {{--'image' => 'https://d2vyvo0tyx8ig5.cloudfront.net/sales/2022/latin-piano-card2.jpg',--}}
    {{--'title' => 'Latin Piano Essentials',--}}
    {{--'description' => 'Spice up your playing and learn five of the most influential Latin genres on the piano.',--}}
    {{--'artist' => 'Kevin <strong>Castro</strong>',--}}
    {{--],--}}
    {{--[--}}
    {{--'logo' => 'https://d2vyvo0tyx8ig5.cloudfront.net/products/worship-piano/logo-text-white.png',--}}
    {{--'image' => 'https://d2vyvo0tyx8ig5.cloudfront.net/sales/2022/worship-card2.jpg',--}}
    {{--'title' => 'Worship Piano',--}}
    {{--'description' => 'Start playing piano or keyboard in your church.',--}}
    {{--'artist' => 'Amberly <strong>Martz</strong>',--}}
    {{--],--}}
    {{--[--}}
    {{--'logo' => 'https://d2vyvo0tyx8ig5.cloudfront.net/shop/products/piano-riffs-and-fills/piano-riffs-fills-logo.png',--}}
    {{--'image' => 'https://d2vyvo0tyx8ig5.cloudfront.net/sales/2022/riffs-fills-card2.jpg',--}}
    {{--'title' => 'Piano Riffs & Fills',--}}
    {{--'description' => 'Fill those spaces with piano riffs that will make you sound professional, polished ... and close to perfect.',--}}
    {{--'artist' => 'Lisa <strong>Witt</strong>',--}}
    {{--],--}}
    {{--[--}}
    {{--'logo' => 'https://d2vyvo0tyx8ig5.cloudfront.net/500-songs/sales/500-songs-logo.svg',--}}
    {{--'image' => 'https://d2vyvo0tyx8ig5.cloudfront.net/sales/2022/500-songs-card2.jpg',--}}
    {{--'title' => '500 Songs in 5 Days',--}}
    {{--'description' => 'Play the songs you love in this 5-day bootcamp that teaches you how to play almost any song.',--}}
    {{--'artist' => 'Lisa <strong>Witt</strong>',--}}
    {{--],--}}
    {{--[--}}
    {{--'logo' => 'https://d2vyvo0tyx8ig5.cloudfront.net/sight-reading-made-simple/logo.png',--}}
    {{--'image' => 'https://d2vyvo0tyx8ig5.cloudfront.net/shop/card-thumbs/sight-reading.jpg',--}}
    {{--'title' => 'Sight Reading Made Simple',--}}
    {{--'description' => 'If you’ve ever struggled through a music class — let us show you how easy reading music can be.',--}}
    {{--'artist' => 'Lisa <strong>Witt</strong>',--}}
    {{--],--}}
    {{--[--}}
    {{--'logo' => 'https://d2vyvo0tyx8ig5.cloudfront.net/faster-fingers/sales/logo.png',--}}
    {{--'image' => 'https://d2vyvo0tyx8ig5.cloudfront.net/sales/2022/faster-card2.jpg',--}}
    {{--'title' => 'Faster Fingers',--}}
    {{--'description' => 'Your roadmap to success for increasing your speed on the keys so you can learn songs quicker and play them better.',--}}
    {{--'artist' => 'Lisa <strong>Witt</strong>',--}}
    {{--],--}}
    {{--[--}}
    {{--'logo' => 'https://d2vyvo0tyx8ig5.cloudfront.net/sales/2022/essential-styles-logo.png',--}}
    {{--'image' => 'https://d2vyvo0tyx8ig5.cloudfront.net/sales/2022/sangah-card.jpg',--}}
    {{--'title' => 'Essential Styles',--}}
    {{--'description' => 'Pop, Jazz, Blues, Funk, Bossa Nova, and more. Sangha Noona can do it all, and she’ll help you discover new techniques to sound incredible in any style.',--}}
    {{--'artist' => 'Sangah <strong>Noona</strong>',--}}
    {{--],--}}
    {{--]--}}
    {{--@endphp--}}
    {{--@foreach($topics as $topic)--}}
    {{--<div class="relative sm:px-1.5 w-full md:w-1/3 lg:w-1/4 mx-auto mb-3 sm:mb-1.5">--}}
    {{--<div class="flip-div inline-block relative md:w-full group " style="perspective: 1000px;" data-aos-once="true" data-aos="fade-down" data-aos-offset="200" data-aos-duration="250" data-aos-delay="200">--}}
    {{--<div class="text-center relative md:w-full md:h-full md:absolute cursor-pointer" style="transform-style: preserve-3d;">--}}
    {{--<div class="front relative z-20 overflow-hidden rounded-xl md:w-full md:h-full md:absolute transition-transform duration-700 @if(!empty($topic['classes'])) {{ $topic['classes'] }} @endif" style="backface-visibility: hidden;">--}}
    {{--<div class="absolute z-40 text-center top-1/2 left-1/2 text-white transition-opacity duration-300 transform -translate-x-1/2 -translate-y-1/2 hidden md:visible opacity-0 group-hover:opacity-100 text-shadow-2">--}}
    {{--<i class="fas fa-arrow-right text-4xl"></i><br>--}}
    {{--<p class="text-sm"><strong>DETAILS</strong></p>--}}
    {{--</div>--}}
    {{--<div class="bg-image w-full bg-black bg-top bg-cover lazyload" data-bg="https://www.musora.com/musora-cdn/image/width=550,quality=95/{{ $topic['image'] }}"></div>--}}
    {{--<div class="absolute uppercase w-full bottom-3 md:bottom-5 z-10 text-shadow-4">--}}
    {{--@if(!empty($topic['logo']))--}}
    {{--<div class="px-6">--}}
    {{--<img class="w-full h-12 md:h-16 object-contain lazyload" data-src="https://www.musora.com/musora-cdn/image/width=500,quality=95/{{ $topic['logo'] }}" alt="{!! $topic['title'] !!}">--}}
    {{--</div>--}}
    {{--@else--}}
    {{--<h3><strong> {!! $topic['title']  !!} </strong></h3>--}}
    {{--@endif--}}
    {{--</div>--}}
    {{--@if(!empty($topic['logo']))--}}
    {{--<div class="absolute inset-0 rounded-xl overflow-hidden z-0" style="background:linear-gradient(to bottom, rgba(0,0,0,0) 40%, #29050f 100%);"></div>--}}
    {{--@else--}}
    {{--<div class="absolute inset-0 rounded-xl overflow-hidden z-0" style="background:linear-gradient(to bottom, rgba(0,0,0,0) 40%, #000 100%);"></div>--}}
    {{--@endif--}}
    {{--</div>--}}
    {{--<div class="back relative z-40 overflow-hidden rounded-xl md:w-full md:h-full md:absolute transition-transform duration-700" style="backface-visibility: hidden;">--}}
    {{--<div class="w-full h-full mx-auto text-center md:text-black md:bg-white flex flex-wrap justify-center items-center content-center pt-3 md:p-3">--}}
    {{--<p class="leading-none uppercase mx-auto mb-2 md:mb-3 hidden sm:inline-block"><strong>{!! $topic['title']  !!}</strong></p>--}}
    {{--<p class="leading-tight text-sm mx-auto">{{ $topic['description'] }}</p>--}}
    {{--@if(!empty($topic['artist']))--}}
    {{--<p class="w-full leading-normal uppercase mt-2 md:mt-3 mx-auto text-pianote hidden md:inline-block">{!! $topic['artist'] !!}</p>--}}
    {{--@endif--}}
    {{--</div>--}}
    {{--</div>--}}
    {{--</div>--}}
    {{--</div>--}}
    {{--</div>--}}
    {{--@endforeach--}}
    {{--</div>--}}
    {{--<a class="join smaller" href="{{ $annualLink }}">Get Started</a>--}}
    {{--</div>--}}
    {{--</section>--}}

    <section class="px-4 sm:px-6 py-10 md:py-12 md:py-14 text-white text-center overflow-hidden" style="background:linear-gradient(to bottom, #01050f, #021225);overflow:visible">
        <div class="container mx-auto max-w-4xl">
            <img class="h-28 md:h-32 lazyload" data-src="https://www.musora.com/musora-cdn/image/width=250,quality=95/https://d2vyvo0tyx8ig5.cloudfront.net/sales/2022/piano-guarantee.png" alt="guarantee-badge">

            <h3 class="leading-tight mt-5 md:mt-8 mb-4 md:mb-6 "><strong>Test-drive your lessons for 90 days.</strong><br>
                Zero risk.</h3>
            <p class="text-light-navy leading-normal md:leading-loose">Online lessons can be intimidating. Maybe you’re wondering if they work, or if you’ll use them enough – or if you’ll even enjoy the experience. So we’re removing the risk with our 90-day guarantee. More than anything, we want to make sure you have a POSITIVE experience developing new skills and gaining confidence on the piano.</p>
            <div class="flex flex-wrap items-start justify-center mt-5 md:mt-7">
                <div class="w-full sm:w-1/3 px-2 mb-3 sm:mb-0">
                    <h5 class="text-pianote border-pianote border-2 rounded-full inline-block py-2 px-3 mb-1">1</h5>
                    <h6 class="leading-normal">Start your<br> lessons today.</h6>
                </div>
                <div class="w-full sm:w-1/3 px-2 mb-3 sm:mb-0">
                    <h5 class="text-pianote border-pianote border-2 rounded-full inline-block py-2 px-3 mb-1">2</h5>
                    <h6 class="leading-normal">Enjoy them for 90<br>  days, risk-free.</h6>
                </div>
                <div class="w-full sm:w-1/3 px-2">
                    <h5 class="text-pianote border-pianote border-2 rounded-full inline-block py-2 px-3 mb-1">3</h5>
                    <h6 class="leading-normal">Change your mind?<br> Get a refund. <div class="inline-block tooltip cursor-pointer" tip="If it's not for you, simply contact us within 90 days for a full refund. The reason doesn’t matter. What matters is that you love your lessons and the results. "><i class="fas fa-info-circle"></i></div></h6>
                </div>
            </div>
        </div>
    </section>

    <div id="customize-anchor" class="anchor"></div>
    <section class="content-section px-3 sm:px-0 text-center customize relative z-50 overflow-hidden lazyload" data-bg="https://www.musora.com/musora-cdn/image/width=1500,quality=95/https://d2vyvo0tyx8ig5.cloudfront.net/sales/jesus-molina/Order_BG.jpg">
        <div class="container max-w-6xl mx-auto relative z-50">
            <div class="flex flex-wrap items-center">
                <div class="text-center sm:text-left w-full sm:w-1/2 lg:w-5/12 sm:pl-5">
                    <img class="h-16 md:h-20 lg:h-24 lazyload" data-src="https://www.musora.com/musora-cdn/image/width=1200,quality=95/https://d2vyvo0tyx8ig5.cloudfront.net/sales/jesus-molina/Logo.png" alt="Improvisation logo">
                    <h4 class="leading-tight mt-2 md:mt-3"><strong>Learn from one of the world’s<br class="inline lg:hidden"> best for just <!--<s class="opacity-70">${{ floatval($productPrices['jesus-molina-improvisation-and-musical-freedom-pack']->price) }}</s>--> <span class="text-pianote">${{ floatval($productPrices['jesus-molina-improvisation-and-musical-freedom-pack']->discounted_price) }}</span></strong></h4>
                    <p class="leading-tight mx-auto inline-block my-4 md:my-5"><em>Get Jesús Molina’s entire course for less than the cost of a single in-person piano lesson.</em></p>
                    <div class="w-full mx-auto sm:mx-0">
                        <p class="text-sm leading-relaxed">
                            <i class="fas fa-check text-pianote"></i> Lifetime access to all the lessons and exercises<br>
                            <i class="fas fa-check text-pianote"></i> Practice-along features to guarantee success<br>
                            <i class="fas fa-check text-pianote"></i> Personal support from REAL teachers<br>
                            <i class="fas fa-check text-pianote"></i> 90-day guarantee</p>
                        <a class="join w-full my-3 sm:my-5" style="background:#F61A30;" href="{{ $annualLink }}">Get Started</a>
                        <p class="text-center text-sm text-pianote">
                            <em><a href="/#customize-anchor">(OR FREE WITH A PIANOTE MEMBERSHIP)</a></em>
                        </p>
                    </div>
                </div>
                <div class="flex w-full justify-center sm:justify-start sm:w-1/2 lg:w-7/12 sm:order-1 sm:pl-5 mt-7 sm:mt-0">
                    <img class="max-w-lg sm:max-w-2xl lg:max-w-4xl lazyload" data-src="https://www.musora.com/musora-cdn/image/width=1400,quality=95/https://d2vyvo0tyx8ig5.cloudfront.net/sales/jesus-molina/order_collage.png" alt="Order collage">
                </div>
            </div>
        </div>
    </section>

    <section class="px-6 sm:px-8 py-8 sm:py-12 relative z-20 text-center">
        <div class="container mx-auto max-w-4xl">
            <h2 class="font-bold mb-8 sm:mb-10 leading-tight text-lg sm:text-2xl md:text-3xl lg:text-4xl"><strong>Still have questions?</strong></h2>
            <div class="dropdowns">
                @include('_partials.components.question-dropdown', [
                "num" => '?',
                "title" => "How good do I have to be to take this course?",
                "desc" => "You’ll need to have a basic understanding of the notes on the piano, and a bit of knowledge on how to read music. But if you have those skills, then you’ll learn so much from Jesús. Each lesson starts simply, before building more complexity. It’s the type of course you can come back to over and over as you grow. You’ll learn something new each time."
                ])
                {{--@include('_partials.components.question-dropdown', [--}}
                {{--"num" => '?',--}}
                {{--"title" => "What do I get when I join?",--}}
                {{--"desc" => "You’ll have complete access to every lesson, download, and practice assignment from Jesús Molina. Plus, as a Pianote member, you’ll have access to a complete piano curriculum to help you develop into a better player. You’ll also have a huge song library at your fingertips, and access to courses from other world-class pianists on styles like Gospel and Classical Piano."--}}
                {{--])--}}
                {{--@include('_partials.components.question-dropdown', [--}}
                {{--"num" => '?',--}}
                {{--"title" => "Can I buy the course on its own?",--}}
                {{--"desc" => "Right now, the course is only available inside the Pianote membership. We want to make sure our students have an incredible experience and are supported as they progress through the lessons."--}}
                {{--])--}}
                @include('_partials.components.question-dropdown', [
                "num" => '?',
                "title" => "How do I download the bonus resources?",
                "desc" => "Under every lesson there’s a handy little download button. You’ll get all the sheet music, assignments and plans in PDF form so you can save and print them."
                ])
                @include('_partials.components.question-dropdown', [
                "num" => '?',
                "title" => "What if I don’t like it?",
                "desc" => "That’s what our 90-day guarantee is for. You’ll have 90 days to try everything from this course before you need to decide if it’s worth your money. If you don’t think it is (for any reason), simply email support@pianote.com or call 1-800-439-8921 to speak with a real human who will fully refund your purchase."
                ])
            </div>
        </div>
    </section>

    @php
        $videoModals = [
            [
            'modal' => 'molinaTrailer',
            'vimeo' => '703890938',
            ],
         ]
    @endphp
    @foreach($videoModals as $videoModal)
        <div class="reveal large" id="{{ $videoModal['modal'] }}" data-reveal data-reset-on-close="false">
            <div class="w-full relative aspect-16:9">
                <iframe class="absolute w-full h-full reset-on-close" src="" data-lazy-load-url="//player.vimeo.com/video/{{ $videoModal['vimeo'] }}?autoplay=1" frameborder="0" allowfullscreen allow="autoplay" title="pianote-video"></iframe>
            </div>
        </div>
    @endforeach

    @include('pianote.sales.partials._footer')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    {{--    <script type="text/javascript" src="{{ asset('/marketing/parcel/drumeo/navigation-sales.js') }}"></script>--}}
    <script type="text/javascript" src="{{ asset('/marketing/parcel/drumeo/navigation-sales.js') }}"></script>
    <script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/lazysizes/5.3.2/lazysizes.min.js"></script>
    <script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/lazysizes/5.3.2/plugins/unveilhooks/ls.unveilhooks.min.js"></script>
    <script>
        $(document).ready(function () {
            $(document).foundation();

            $('.flip-div').click(function (e) {
                $(this).toggleClass('flipped');
            });
        });
    </script>
    <script type="text/javascript" src="{{ asset('/marketing/js/modal.js') }}"></script>
    <script type="text/javascript" src="{{ asset('/marketing/js/modal-autoplay.js') }}"></script>

    @yield('scripts')
@stop

