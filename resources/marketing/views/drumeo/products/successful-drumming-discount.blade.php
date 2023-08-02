@extends('drumeo.products.misc-products-layout')

@section('meta')
    @parent
    <title>Successful Drumming</title>
    <meta name="description" content="Successful Drumming is a complete beginner-to-advanced drum curriculum that produces rapid results.">
    <meta property="og:image" content="https://i.vimeocdn.com/video/707999377-b145eeb6979d0f2efeb622f108bf2f4c6ce798dfa6513032ec476cd932af57e1-d_1200" style="display: none;">
    <meta property="og:description" content="Successful Drumming: The Fastest Way To Improve Your Drumming. Guaranteed.">
    <meta property="og:url" content="https://www.drumeo.com/{{ Request::path() }}">
@stop()

@section('head')
    @parent
    <?php \App\Analytics\Tracker::trackProductImpression('SD-DIGI'); ?>
    <link href="{{ asset('/marketing/parcel/drumeo/tripwire.css') }}" rel="stylesheet">
@stop()

@section('scripts')
    @parent
    <script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/lazysizes/5.3.2/lazysizes.min.js"></script>
    <script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/lazysizes/5.3.2/plugins/unveilhooks/ls.unveilhooks.min.js"></script>
@stop()

@section('body-data')
    x-data="{ trailer: false }"
@endsection

@section('content')
    @include('drumeo.products.partials.promo-banner', [
                    "name" => "Successful Drumming",
                    "fullPrice" => floatval($productPrices['SD-DIGI']->price),
                    "price" => floatval($productPrices['SD-DIGI']->discounted_price),
                "noBreadcrumb" => true
                ])
    <header class="header stacked">
        <div class="container mx-auto clearfix xlarge" style="background-image:url(https://dpwjbsxqtam5n.cloudfront.net/tripwires/sd/header-bg.jpg);">
            <img class="px-4 w-auto max-h-20 mx-auto" src="https://dpwjbsxqtam5n.cloudfront.net/tripwires/sd/sd-logo.png" alt="Successful drumming logo">

            <div class="float-left w-full px-3 sm:px-4 video-container">
                <i @click="trailer = true;" class="fas fa-play play-button autoplay-video"></i>
            </div>
            <div class="float-left w-full px-3 sm:px-4 text-container">
                <div class="course-logo">
                    <h2>SUCCESS <strong>STARTS HERE</strong></h2>
                </div>
                <p>Jared Falk’s step-by-step plan for building a rock-solid <br class="hidden sm:inline">
                    drumming foundation for achieving any musical goals. </p>
                {{--<a class="join sold-out">Sold Out</a>--}}
                <a href="/ecommerce/add-to-cart?products[SD-DIGI]=1" class="join blue">Get Started &raquo;</a>
                <p class="price-info">
                    @if($productPrices['SD-DIGI']->price > $productPrices['SD-DIGI']->discounted_price)
                        <s>NORMALLY ${{ floatval($productPrices['SD-DIGI']->price) }}.</s>
                        <strong>NOW ${{ floatval($productPrices['SD-DIGI']->discounted_price) }}</strong>
                        (SAVE {{ round(100 - (100 * (floatval($productPrices['SD-DIGI']->discounted_price) / floatval($productPrices['SD-DIGI']->price)))) }}%).
                    @else
                        <strong>NOW ${{ floatval($productPrices['SD-DIGI']->discounted_price) }}</strong>
                    @endif
                    <br> <span class="text-blue">90-DAY GUARANTEE.</span>
                </p>
            </div>
        </div>
    </header>

    @include('_partials.components.video-modal',[
        'name' => 'trailer',
        'video' => '275665270',
        'vimeo' => true,
    ])

    <section class="text-center px-5 sm:px-6 py-10 sm:py-14 lg:py-20" style="background-color:#f4f8fb;">
        <div class="container max-w-6xl mx-auto">
            <h2 class=" mb-8 sm:mb-10"><strong>The Faster Way To Improve Your Skills… For Just $247</strong></h2>


            <div class="flex flex-wrap items-start justify-center text-left mb-2 sm:mb-6">
                <div class="flex flex-wrap items-start w-full sm:w-1/2 lg:w-1/3 pb-4 sm:pb-0 sm:px-3 mb-4 sm:mb-8 border-b sm:border-b-0">
                    <img class="w-1/3 sm:w-full rounded-xl mb-3 transition-opacity" src="https://www.musora.com/musora-cdn/image/width=640,quality=95/https://dpwjbsxqtam5n.cloudfront.net/tripwires/sd/1.jpg" alt="grid1" loading="lazy" onload="this.classList.remove('opacity-0')">
                    <p class="w-2/3 sm:w-full pl-3 sm:pl-0 leading-normal">
                        <strong class="font-black inline-block mb-0.5">THE FOUNDATION</strong><br> Build a solid foundation on topics like technique, notation, and your first beats and fills!
                    </p>
                </div>
                <div class="flex flex-wrap items-start w-full sm:w-1/2 lg:w-1/3 pb-4 sm:pb-0 sm:px-3 mb-4 sm:mb-8 border-b sm:border-b-0">
                    <img class="w-1/3 sm:w-full rounded-xl mb-3 transition-opacity" src="https://www.musora.com/musora-cdn/image/width=640,quality=95/https://dpwjbsxqtam5n.cloudfront.net/tripwires/sd/2.jpg" alt="grid1" loading="lazy" onload="this.classList.remove('opacity-0')">
                    <p class="w-2/3 sm:w-full pl-3 sm:pl-0 leading-normal">
                        <strong class="font-black inline-block mb-0.5">THE TECHNIQUES</strong><br> Take your drumming to the next level with step-by-step lessons on essential technical topics.
                    </p>
                </div>
                <div class="flex flex-wrap items-start w-full sm:w-1/2 lg:w-1/3 pb-4 sm:pb-0 sm:px-3 mb-4 sm:mb-8 border-b sm:border-b-0">
                    <img class="w-1/3 sm:w-full rounded-xl mb-3 transition-opacity" src="https://www.musora.com/musora-cdn/image/width=640,quality=95/https://dpwjbsxqtam5n.cloudfront.net/tripwires/sd/3.jpg" alt="grid1" loading="lazy" onload="this.classList.remove('opacity-0')">
                    <p class="w-2/3 sm:w-full pl-3 sm:pl-0 leading-normal">
                        <strong class="font-black inline-block mb-0.5">THE GROOVES</strong><br> Get time-saving tools and video guides for composing your own beats and fills for any musical style.
                    </p>
                </div>
                <div class="flex flex-wrap items-start w-full sm:w-1/2 lg:w-1/3 pb-4 sm:pb-0 sm:px-3 mb-4 sm:mb-8 border-b sm:border-b-0">
                    <img class="w-1/3 sm:w-full rounded-xl mb-3 transition-opacity" src="https://www.musora.com/musora-cdn/image/width=640,quality=95/https://dpwjbsxqtam5n.cloudfront.net/tripwires/sd/4.jpg" alt="grid1" loading="lazy" onload="this.classList.remove('opacity-0')">
                    <p class="w-2/3 sm:w-full pl-3 sm:pl-0 leading-normal">
                        <strong class="font-black inline-block mb-0.5">THE BREAKDOWN</strong><br> Get three unique tools to simplify your favorite songs so you can apply your skills to real music.
                    </p>
                </div>
                <div class="flex flex-wrap items-start w-full sm:w-1/2 lg:w-1/3 pb-4 sm:pb-0 sm:px-3 mb-4 sm:mb-8 border-b sm:border-b-0">
                    <img class="w-1/3 sm:w-full rounded-xl mb-3 transition-opacity" src="https://www.musora.com/musora-cdn/image/width=640,quality=95/https://dpwjbsxqtam5n.cloudfront.net/tripwires/sd/5.jpg" alt="grid1" loading="lazy" onload="this.classList.remove('opacity-0')">
                    <p class="w-2/3 sm:w-full pl-3 sm:pl-0 leading-normal">
                        <strong class="font-black inline-block mb-0.5">THE BASSIST</strong><br> The three keys to locking-in with a bass guitar player to make the band sound and perform better.
                    </p>
                </div>
                <div class="flex flex-wrap items-start w-full sm:w-1/2 lg:w-1/3 pb-4 sm:pb-0 sm:px-3 mb-4 sm:mb-8 border-b sm:border-b-0">
                    <img class="w-1/3 sm:w-full rounded-xl mb-3 transition-opacity" src="https://www.musora.com/musora-cdn/image/width=640,quality=95/https://dpwjbsxqtam5n.cloudfront.net/tripwires/sd/6.jpg" alt="grid1" loading="lazy" onload="this.classList.remove('opacity-0')">
                    <p class="w-2/3 sm:w-full pl-3 sm:pl-0 leading-normal">
                        <strong class="font-black inline-block mb-0.5">THE BAND</strong><br> Watch the creation of 5 original songs and get a 10 step process for establishing your band’s goals.
                    </p>
                </div>
                <div class="flex flex-wrap items-start w-full sm:w-1/2 lg:w-1/3 pb-4 sm:pb-0 sm:px-3 mb-4 sm:mb-8 border-b sm:border-b-0">
                    <img class="w-1/3 sm:w-full rounded-xl mb-3 transition-opacity" src="https://www.musora.com/musora-cdn/image/width=640,quality=95/https://dpwjbsxqtam5n.cloudfront.net/tripwires/sd/7.jpg" alt="grid1" loading="lazy" onload="this.classList.remove('opacity-0')">
                    <p class="w-2/3 sm:w-full pl-3 sm:pl-0 leading-normal">
                        <strong class="font-black inline-block mb-0.5">THE SHOWS</strong><br> You’ll get detailed interviews with professional gigging drummers and a checklist for your next gig.
                    </p>
                </div>
                <div class="flex flex-wrap items-start w-full sm:w-1/2 lg:w-1/3 pb-4 sm:pb-0 sm:px-3 mb-4 sm:mb-8 border-b sm:border-b-0">
                    <img class="w-1/3 sm:w-full rounded-xl mb-3 transition-opacity" src="https://www.musora.com/musora-cdn/image/width=640,quality=95/https://dpwjbsxqtam5n.cloudfront.net/tripwires/sd/8.jpg" alt="grid1" loading="lazy" onload="this.classList.remove('opacity-0')">
                    <p class="w-2/3 sm:w-full pl-3 sm:pl-0 leading-normal">
                        <strong class="font-black inline-block mb-0.5">THE MUSIC</strong><br> Enjoy 10 fun play-along songs that you can jam along with to challenge yourself and build experience.
                    </p>
                </div>
                <div class="flex flex-wrap items-start w-full sm:w-1/2 lg:w-1/3 pb-4 sm:pb-0 sm:px-3 mb-4 sm:mb-8 border-b sm:border-b-0">
                    <img class="w-1/3 sm:w-full rounded-xl mb-3 transition-opacity" src="https://www.musora.com/musora-cdn/image/width=640,quality=95/https://dpwjbsxqtam5n.cloudfront.net/tripwires/sd/9.jpg" alt="grid1" loading="lazy" onload="this.classList.remove('opacity-0')">
                    <p class="w-2/3 sm:w-full pl-3 sm:pl-0 leading-normal">
                        <strong class="font-black inline-block mb-0.5">THE LIFESTYLE</strong><br> Three tools for focusing on your goals, staying excited about the drums, and connecting with other musicians.
                    </p>
                </div>
            </div>
        </div>
    </section>
    <section class="text-center px-5 sm:px-6 py-10 sm:py-14 lg:py-20" style="background-color:#f4f8fb;">
        <div class="container max-w-6xl mx-auto">
            <h2 class="leading-tight "><strong>Your toolbox for success on the drums</strong></h2>
            <h6 class="leading-normal mt-3  mb-8 sm:mb-10">
                Get Jared’s personal toolbox for learning songs faster, locking-in with other musicians,<br class="hidden lg:inline">
                  preparing for gigs, and setting yourself up for a successful experience on the drums, <br class="hidden lg:inline">
                 whatever that might mean to you.</h6>
            <div class="flex flex-wrap justify-center align-center">
                <div class="w-full sm:w-1/2 px-3 sm:px-4 circle-point">
                    <div class="point-icon"><i class="fal fa-tree"></i></div>
                    <p><strong>THE DRUMMING TREE</strong><br>
                        Perfect for drummers of all levels with progressive step-by-step lessons on every topic.</p>
                </div>
                <div class="w-full sm:w-1/2 px-3 sm:px-4 circle-point">
                    <div class="point-icon"><img src="https://dpwjbsxqtam5n.cloudfront.net/tripwires/sd/drum-icon.png" alt="Drum icon"></div>
                    <p><strong>THE EASY BEAT SYSTEM </strong><br>
                        A simple three-step formula for writing original drum beats and expressing your ideas.</p>
                </div>
                <div class="w-full sm:w-1/2 px-3 sm:px-4 circle-point">
                    <div class="point-icon"><img src="https://dpwjbsxqtam5n.cloudfront.net/tripwires/sd/stick-icon.png" alt="Stick icon"></div>
                    <p><strong>THE DRUM FILL BUILDER</strong><br>
                        A simple three-step formula for unlocking your creativity while creating your own drum fills.</p>
                </div>
                <div class="w-full sm:w-1/2 px-3 sm:px-4 circle-point">
                    <div class="point-icon"><i class="fal fa-list"></i></div>
                    <p><strong>THE STYLE SELECTOR </strong><br>
                        Explore a variety of musical styles including rock, jazz, latin, funk, country, metal, and more.</p>
                </div>
                <div class="w-full sm:w-1/2 px-3 sm:px-4 circle-point">
                    <div class="point-icon"><i class="fal fa-file-alt"></i></div>
                    <p><strong>THE DRUMMING CHEAT SHEET </strong><br>
                        The easier way to create personalized charts for learning and remembering song structures.</p>
                </div>
                <div class="w-full sm:w-1/2 px-3 sm:px-4 circle-point">
                    <div class="point-icon"><i class="fal fa-music"></i></div>
                    <p><strong>THE DRUMMING SONG SIMPLIFIER</strong><br>
                        A fast and effective way to play-along to virtually any song without learning every drum part.</p>
                </div>
                <div class="w-full sm:w-1/2 px-3 sm:px-4 circle-point">
                    <div class="point-icon"><i class="fal fa-lock"></i></div>
                    <p><strong>THE LOCKED-IN SYSTEM </strong><br>
                        A simple three-phase approach for working with a bassist to create a better musical foundation.</p>
                </div>
                <div class="w-full sm:w-1/2 px-3 sm:px-4 circle-point">
                    <div class="point-icon"><i class="fal fa-headphones"></i></div>
                    <p><strong>THE SUCCESSFUL BAND METHOD </strong><br>
                        A list of 10 important guidelines for bands to follow to improve your chance of success.</p>
                </div>
                <div class="w-full sm:w-1/2 px-3 sm:px-4 circle-point">
                    <div class="point-icon"><i class="fal fa-check"></i></div>
                    <p><strong>THE DRUMMER’S CHECKLIST </strong><br>
                        A comprehensive list of everything drummers should bring to the practice room, studio, or live gig.</p>
                </div>
                <div class="w-full sm:w-1/2 px-3 sm:px-4 circle-point">
                    <div class="point-icon"><i class="fal fa-calendar-alt"></i></div>
                    <p><strong>THE HABITUAL DRUMMER </strong><br>
                        Five steps to maintaining the habits you need to achieve consistent drumming progress.</p>
                </div>
                <div class="w-full sm:w-1/2 px-3 sm:px-4 circle-point">
                    <div class="point-icon"><i class="fal fa-lightbulb"></i></div>
                    <p><strong>THE INSPIRED DRUMMER </strong><br>
                        Ten sources of drumming inspiration to help you stay motivated as a musician.</p>
                </div>
                <div class="w-full sm:w-1/2 px-3 sm:px-4 circle-point">
                    <div class="point-icon"><i class="fal fa-users"></i></div>
                    <p><strong>THE CONNECTED DRUMMER </strong><br>
                        Ten unique ways you can connect with other musicians for support and encouragement.</p>
                </div>
            </div>
        </div>
    </section>

    <section class="text-center px-5 sm:px-6 py-10 sm:py-14 lg:py-20" style="background-color:#f4f8fb;">
        <div class="container max-w-5xl mx-auto">
            <div class="flex flex-wrap sm:flex-nowrap items-start justify-center sm:mt-8">
                <img class="border-solid border-8 border-white rounded-3xl shadow-xl w-52 sm:w-72 lg:w-96 relative -mb-8 sm:mb-0 sm:-mt-8 sm:-mr-8 z-10 lazyload" data-src="https://www.musora.com/musora-cdn/image/width=550,quality=95/https://dpwjbsxqtam5n.cloudfront.net/tripwires/sd/meet-jared-3.jpg" alt="profile picture">

                <div class="text-white text-left rounded-xl pt-14 pb-8 sm:py-10 lg:py-12 px-6 sm:pr-10 sm:pl-14 lg:px-24 max-w-xl sm:mt-8 w-full sm:w-auto sm:flex-grow" style="background-color:#00101d;">
                    <h6 class="uppercase text-drumeo leading-normal text-center sm:text-left">MEET YOUR TEACHER</h6>
                    <h2 class="text-center sm:text-left"><strong>Jared Falk</strong></h2>
                    <h6 class="leading-normal mt-4 lg:mt-6">Jared Falk has been a trusted source for online drum lessons for 15+ years.
                        <br><br>
                        As the face of Drumeo, Jared is a pioneer of online drum instruction — helping prospective drummers around the world learn their first beats and beyond.
                        <br><br>
                        His passion, grit, and approachable style have helped him become the most-watched drum instructor online… ever! And now you can take in his first-ever full curriculum for beginner drummers anytime and anywhere it fits your schedule.
                    </h6>
                </div>
            </div>

            <h3 class="mt-12 sm:mt-16 lg:mt-20 mb-5 sm:mb-8 lg:mb-10"><strong>What drummers are saying:</strong></h3>
            <div class="flex flex-wrap text-left">
                <div class="w-full lg:w-1/2 py-2 sm:px-2 lg:p-3">
                    <div class="flex items-start p-5 bg-white rounded-lg">
                        <img class="h-16 lg:h-20 rounded-full lazyload" data-src="https://www.musora.com/musora-cdn/image/width=160,quality=95/https://dpwjbsxqtam5n.cloudfront.net/tripwires/sd/dave-mccoy.jpg" alt="Larnell lewis" >
                        <p class="pl-4"><strong>DAVE MCCOY</strong><br>
                            <em class="leading-tight inline-block mb-1 opacity-60">CALIFORNIA</em><br>
                            He puts the lessons together so beginners or advanced students can understand and simply get better...
                        </p>
                    </div>
                </div>
                <div class="w-full lg:w-1/2 py-2 sm:px-2 lg:p-3">
                    <div class="flex items-start p-5 bg-white rounded-lg">
                        <img class="h-16 lg:h-20 rounded-full lazyload" data-src="https://www.musora.com/musora-cdn/image/width=160,quality=95/https://dpwjbsxqtam5n.cloudfront.net/tripwires/sd/fred-rose.jpg" alt="Matt Mcguire" >
                        <p class="pl-4"><strong>Fred Rose</strong><br>
                            <em class="leading-tight inline-block mb-1 opacity-60">CALIFORNIA</em><br>
                            "I’ve used several other packs online, I’ve taken private lessons, and nothing gives you this clear sense of accomplishment and goals and direction..."
                        </p>
                    </div>
                </div>
                <div class="w-full lg:w-1/2 py-2 sm:px-2 lg:p-3">
                    <div class="flex items-start p-5 bg-white rounded-lg">
                        <img class="h-16 lg:h-20 rounded-full lazyload" data-src="https://www.musora.com/musora-cdn/image/width=160,quality=95/https://dpwjbsxqtam5n.cloudfront.net/tripwires/sd/rich-behe.jpg" alt="Dorothea Taylor" >
                        <p class="pl-4"><strong>Rich Behe</strong><br>
                            <em class="leading-tight inline-block mb-1 opacity-60">GERMANY</em><br>
                            "One of the biggest frustrations for me has been trying to keep track of where I am within different video lessons. I would forget where I left off..."
                        </p>
                    </div>
                </div>
                <div class="w-full lg:w-1/2 py-2 sm:px-2 lg:p-3">
                    <div class="flex items-start p-5 bg-white rounded-lg">
                        <img class="h-16 lg:h-20 rounded-full lazyload" data-src="https://www.musora.com/musora-cdn/image/width=160,quality=95/https://dpwjbsxqtam5n.cloudfront.net/tripwires/sd/ken-voller.jpg" alt="Dorothea Taylor">
                        <p class="pl-4"><strong>Ken Voller</strong><br>
                            <em class="leading-tight inline-block mb-1 opacity-60">UK</em><br>
                            "The way that 'Successful Drumming', particularly the Foundation, sets out goals and achievements in small, bite size, chunks is so good!"
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="text-white text-center px-5 sm:px-6 py-10 sm:py-14 lg:py-20" style="background-color:#2a2f34;">
        <div class="container max-w-4xl mx-auto">
            <img class="h-28 sm:h-40 lg:h-52 block mx-auto -mt-24 sm:-mt-36 lg:-mt-48 lazyload" data-src="https://www.musora.com/musora-cdn/image/width=410,quality=95/https://dpwjbsxqtam5n.cloudfront.net/sales/2022/guarantee.png" alt="guarantee badge" src="https://www.musora.com/musora-cdn/image/width=410,quality=95/https://dpwjbsxqtam5n.cloudfront.net/sales/2022/guarantee.png">
            <h2 class="my-4 sm:my-6 lg:my-8"><strong>Happy student guarantee.</strong><br> Test-drive your lessons for 90 days. Zero risk.

            <h6 class="leading-normal">Online lessons can be intimidating. Maybe you’re wondering if they work, or if you’ll use them enough – or if you’ll even enjoy the experience. So we’re removing the risk with our 90-day guarantee. More than anything, we want to make sure you have a POSITIVE experience developing new skills and gaining confidence on the drums.</h6>

        </div>
    </section>

    <section class="pt-32 pb-20 px-2 sm:px-4 relative" style="background: #F2F8FB;">
        <div class="max-w-xl md:max-w-3xl mx-auto text-center">
            <img class="filter invert h-20 sm:h-24 lazyload" src="https://www.musora.com/musora-cdn/image/width=800,quality=95/https://dpwjbsxqtam5n.cloudfront.net/tripwires/sd/sd-logo.png" alt="logo centered">
            <h3 class="leading-tight font-extrabold my-10">
                Get Jared Falk’s trusted step-by-step curriculum <br class="hidden sm:inline">
                for a one-time payment of just $247.
            </h3>
            <a href="/ecommerce/add-to-cart?products[SD-DIGI]=1" class="join blue">Get Started &raquo;</a>
            <div class="inline-block w-full px-3 md:px-4 my-5" style="color:#2a2f34;">
                <p><strong>Any other questions?</strong><br class="inline-block md:hidden"> Call us toll-free at
                    <a href="tel:+18004398921">1-800-439-8921</a> <br class="inline-block md:hidden"> or directly at
                    <a href="tel:+16048557605">1-604-855-7605</a>.<br> All prices listed in USD. </p>
            </div>
            <div class="inline-block w-full px-3 md:px-4" style="color:#2a2f34;">
                <i class="mx-0.5 text-3xl md:text-4xl fab fa-cc-visa" aria-hidden="true"></i>
                <i class="mx-0.5 text-3xl md:text-4xl fab fa-cc-mastercard" aria-hidden="true"></i>
                <i class="mx-0.5 text-3xl md:text-4xl fab fa-cc-amex" aria-hidden="true"></i>
                <i class="mx-0.5 text-3xl md:text-4xl fab fa-cc-paypal" aria-hidden="true"></i>
                <i class="mx-0.5 text-3xl md:text-4xl fab fa-cc-discover" aria-hidden="true"></i>
            </div>
        </div>
    </section>

    <span class="pack-details float-left mx-auto mb-7 px-2 pb-5 sm:px-0 sm:pb-9 lg:pb-11 hide"></span>
@stop
