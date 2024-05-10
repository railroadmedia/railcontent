@extends('pianote.sales.subscription', [
    "promoVersion" => true,
    "chordPromoPage" => true,
])

@section('global-head')
    <title>Learn Piano with Step by Step Online Lessons | Pianote</title>
    <meta property="og:title" content="Pianote - The Better Way To Learn Piano">
    <meta property="og:url" content="https://www.pianote.com/roland">
    <style>
        form input, form button {
            line-height:40px;
            height: 40px;
        }
        @media (min-width: 40em) {
            form input, form button {
                height: 52px;
                line-height: 52px;
            }
        }
        .thank-you-box.active {
            max-height:1000px;
            visibility:visible;
            opacity:1;
            padding:15px;
        }
        @media (min-width: 40em) {
            .thank-you-box.active {
                padding: 20px;
            }
        }
    </style>
    @parent
@endsection

@section('promo-banner')
    <section class="text-center px-5 sm:px-6 py-12 sm:py-14 lg:py-20 text-white relative" style="background: linear-gradient(to bottom, #07233E, #0C1524);">
        <div class="container max-w-5xl mx-auto">
            <img class="my-5 h-40 inline sm:hidden"
                src="https://d21q7xesnoiieh.cloudfront.net/fit-in/620x0/filters:quality(95)/marketing/pianote/promos/september/pianote-trial-sept-promo-collage-m.png"
                alt="learn playing image"
                fetchpriority="high"
            >
            <div class="text-left flex flex-wrap sm:flex-nowrap justify-center items-start mb-5">
                <div class="max-w-xl pr-5 lg:pr-8 mx-0">
                    <h3 class="leading-tight mb-2"><strong>Chords are everything.</strong></h3>
                    <p class="leading-normal">Chords are the foundation of all popular songs. 
                        <br><br>
                        And when you know the basics of chording -- playing your favorite songs on the piano becomes a whole lot easier. 
                        <br><br>
                        It doesn’t take months or years to play beautiful songs.
                        <br><br>
                        With Pianote -- you’ll sound good (and have fun) from your very first lesson. 
                        <br><br>
                        Whether this is your first time learning piano or you’re coming back to the keys after a break, now’s the time to join Pianote. You’ll get access to guided play-along lessons, world-class instructors, and over 1,000 popular songs.
                        <br><br>
                        And to sweeten the deal, we’re loading you up with 5 incredible bonuses that will help you start and stay playing the piano.
                        <br><br>
                        <strong>Oh, and we’ve dropped the price by 25% for your first year.</strong>
                        <br><br>
                        Scroll down to see everything that’s included.
                        <br>
                        <a class="join smaller my-3 w-1/2" href="/ecommerce/add-to-cart?products[PIANOTE-MEMBERSHIP-TRIAL-7-DAY-ANNUAL]=1&products[poster-chords]=1&products[poster-scales]=1&locked=true&promo-code=posters-trial">GET Started &raquo;</a>
                        <br>
                        <em>Free worldwide shipping!</em>
                    </p>

                </div>
                <img class="h-80 lg:h-96 hidden sm:inline transition-opacity opacity-0"
                    loading="lazy"
                    onload="this.classList.remove('opacity-0')"
                    src="https://d21q7xesnoiieh.cloudfront.net/fit-in/690x0/filters:quality(95)/marketing/pianote/promos/september/pianote-trial-sept-promo-collage.png"
                    alt="learn playing image"
                >
            </div>
        </div>
    </section>
    <div class="sticky-trigger block"></div>
    <a href="/ecommerce/add-to-cart?products[PIANOTE-MEMBERSHIP-TRIAL-7-DAY-ANNUAL]=1&products[poster-chords]=1&products[poster-scales]=1&promo-code=posters-trial&redirect=/order&locked=true"
        class="promo-banner flex text-white items-center justify-center -mt-10 py-1.5 px-2 sm:px-0 w-full z-[100] transition-none anchor-slide"style="background: linear-gradient(to bottom, #f41a30, #79080b);">
        {{--        <img class="h-8 sm:h-10 mr-4" src="https://cdn.musora.com/image/fetch/w_300,q_auto:best/https://d2vyvo0tyx8ig5.cloudfront.net/products/30-day-blues-piano/30-day-blues-piano-logo-blue-glow.png" alt="30 day drummer logo" />--}}
        <h3 class="inline-block font-bebas text-musora mx-0 pr-3">* FREE BONUSES *</h3>
        <p class="inline-block text-xs mx-0 leading-tight">
            <strong class="text-musora">SAVE 25%</strong> + get 5 free<br>
            bonuses (worth $615)
        </p>
    </a>

    <section class="py-8 sm:py-14 lg:py-20 relative overflow-hidden text-center customize px-5 lg:px-8 relative overflow-hidden" style="background: #fff;">
        <div class="container mx-auto max-w-4xl">
            <h3 class="leading-tight"><strong>Take a look at your bonuses…</strong></h3>
            <h6 class="leading-tight text-pianote mt-2 mb-5"><em>Join today and you’ll get all of these.</em></h6>

            <div class="flex flex-wrap text-left">
                <div class="w-full sm:flex items-center mb-12">
                    <div class="relative flex-shrink-0">
                        <img class="h-48 sm:h-64 lg:h-72 rounded-xl overflow-hidden" src="https://www.musora.com/musora-cdn/image/width=750,quality=95/https://d2vyvo0tyx8ig5.cloudfront.net/sales/promos/september/webinar-offer/chords-scales.jpg">
                    </div>
                    <div class="sm:pl-5 lg:pl-8">
                        <img class="h-14 sm:h-16 lg:h-20 my-3 sm:mt-0 sm:mb-4" src="https://d21q7xesnoiieh.cloudfront.net/fit-in/460x0/filters:quality(95)/marketing/pianote/promos/december/chords-and-scales-horizontal-logo.png">
                        <p class="leading-tight">Our best-selling book is yours FREE. This book is your encyclopedia of piano chords & scales. Arranged by key, you’ll find every major, minor, sus, and 7th chord as well as all the scales you’ll need to play the songs you love without fear.</p>
                    </div>
                </div>
                <div class="w-full sm:flex items-center mb-12">
                    <div class="relative flex-shrink-0 sm:order-1">
                        <img class="h-48 sm:h-64 lg:h-72 rounded-xl overflow-hidden" src="https://www.musora.com/musora-cdn/image/width=750,quality=95/https://d2vyvo0tyx8ig5.cloudfront.net/sales/promos/september/webinar-offer/music-theory-poster.jpg">
                    </div>
                    <div class="sm:pr-5 lg:pr-8">
                        <img class="h-14 sm:h-16 lg:h-20 my-3 sm:mt-0 sm:mb-4" src="https://www.musora.com/musora-cdn/image/width=460,quality=95/https://d2vyvo0tyx8ig5.cloudfront.net/sales/promos/september/webinar-offer/music-theory-logo.png">
                        <p class="leading-tight">Upgrade your practice space and master your music theory with this gorgeous poster bundle. Shipped flat so there are no creases and printed in full color on beautiful paper stock, these posters will help you connect the notes on the page to the keys on your piano.</p>
                    </div>
                </div>
                <div class="w-full sm:flex items-center">
                    <div class="relative flex-shrink-0 sm:order-1">
                        <img class="h-48 sm:h-64 lg:h-72 rounded-xl overflow-hidden" src="https://www.musora.com/musora-cdn/image/width=750,quality=95/https://d2vyvo0tyx8ig5.cloudfront.net/sales/promos/september/webinar-offer/easy-chords.jpg">
                    </div>
                    <div class="sm:pr-5 lg:pr-8">
                        <img class="h-14 sm:h-16 lg:h-20 my-3 sm:mt-0 sm:mb-4" src="https://www.musora.com/musora-cdn/image/width=460,quality=95/https://d2vyvo0tyx8ig5.cloudfront.net/sales/promos/september/webinar-offer/easy-chords-logo.png">
                        <p class="leading-tight">Put what you learned in the webinar to use with this 30-day chording challenge. Play with Lisa every day and master your chord progressions and inversions so you can play any lead sheet with ease. All you have to do is pretty play and follow along.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <div class="h-5 sm:h-10 relative z-10"
        style="background: linear-gradient(to bottom right, transparent calc(50% - 1px), transparent, #F4F8FB calc(50% + 1px));">
    </div>
    <section class="text-black px-5 sm:px-6 py-8 sm:py-10 lg:py-12" style="background-color:#F4F8FB;">
        <div class="container max-w-4xl mx-auto pb-10">
            <div class="flex flex-wrap sm:flex-nowrap justify-center items-center">
                <img class="w-48 sm:w-64 lg:w-80 -mt-24 mb-4 sm:-mb-24 transition-opacity opacity-0" loading="lazy"
                    onload="this.classList.remove('opacity-0')"
                    src="https://d21q7xesnoiieh.cloudfront.net/fit-in/640x0/filters:quality(95)/marketing/pianote/products/30-day-better-technique/screen.webp"
                    alt="Mobile Screen with 30 Day To Better Technique">
                <div class="flex-grow sm:pl-10">
                    <h3 class="leading-tight text-center sm:text-left py-4"><strong>LIVE Masterclass on Piano Chords.</strong></h3>
                    <div class="text-center sm:text-left pb-4">
                        <p>With Pianote you’ll get all the guidance you need to play your favorite songs using chords.
                            <br><br>
                            But we want you to LOVE your experience, so you’ll get an exclusive LIVE masterclass with Lisa Witt on how to approach chording and use chords to accelerate your progress.
                            <br><br>
                            Lisa will share her top chording tips and tricks, as well as her easy method to learn popular songs in minutes using (you guessed it)...
                            <br><br>
                            Chords.
                            <br><br>
                            This class is only available to Pianote members, so reserve your spot today.
                        </p>
                    </div>
                    <a class="w-full md:w-5/12 join smaller m-2  anchor-slide" href="#customize-anchor">GET STARTED</a>
                </div>
            </div>
        </div>
    </section>
@endsection
@section('final')
    <div id="customize-anchor" class="anchor"></div>
    <div id="order" class="anchor"></div>
    @php
        $buttonLink = '/ecommerce/add-to-cart?products[PIANOTE-MEMBERSHIP-1-YEAR]=1&products[music-theory-posters]=1&products[digital-chords-scales-guide]=1&products[piano-chords-and-scales-guide]=1&products[easy-chords]=1&products[new-piano-players-start-here]=1&products[piano-riffs-and-fills]=1&products[song-secrets-webinar]=1&redirect=/order&locked=true&promo-code=special-discount'
    @endphp
    <div style="background:linear-gradient(to bottom, #07233E, #0C1524);">
        <section class="py-14 sm:py-24 lg:py-32 relative overflow-hidden text-white text-center customize px-4 lg:px-6">
            <div class="container mx-auto relative z-50  max-w-6xl ">
                <div class="w-full">
                    <img class="h-10 mb-2" src="https://d21q7xesnoiieh.cloudfront.net/fit-in/250x0/filters:quality(95)/marketing/pianote/membership/homepage/2023/pianote-logo-red.png">
                   <br>
                    <h1 class="relative w-auto inline-block text-3xl sm:text-5xl lg:text-6xl mb-7 sm:mb-10 font-black font-lexend leading-none sm:leading-none lg:leading-none uppercase">
                        THE <span class="text-pianote">EASY</span> WAY TO PLAY<br> <span class="relative inline-block">YOUR FAVORITE SONGS<svg class="absolute left-0 right-0 bottom-0 w-full h-4 sm:h-7" xmlns="http://www.w3.org/2000/svg" width="100%" height="100%" viewBox="0 0 524 22" fill="none" style="transform: translate(0, 100%);"><path d="M1.99978 10.6328C84.053 4.08508 302.889 -3.20824 521.809 20" stroke="#f61a30" stroke-width="3" stroke-linecap="round"></path><path d="M2.17373 15.0541C83.9528 7.29382 302.406 -3.51921 521.988 15.3111" stroke="#f61a30" stroke-width="3" stroke-linecap="round"></path></svg></span>.
                    </h1>
                    <h4 class="leading-tight mt-4 sm:mt-5 mb-2 text-musora">Save 25% on your first year + get $615 in free bonuses.</h4>
                    <a class="join my-4 md:my-6 w-full max-w-xs md:max-w-lg lg:max-w-xl" style="padding: 20px 10px;" href="{{ $buttonLink }}">
                        GET STARTED
                    </a>
                    <p class="leading-tight text-sm mb-6"><em>First year discount: <s class="opacity-40">$240</s>
                            <strong> $180 </strong>.
                            <br class="inline sm:hidden"> Cancel anytime. 90-day guarantee.</em></p>
                </div>
                <div style="font-size:0px">

                    @php
                        $bonuses = [
                            [
                                'image' => 'marketing/pianote/membership/homepage/2024/bonus-chords-scales.webp',
                                'title' => 'Chords & <br>Scales Book',
                                'description' => 'Your encyclopedia of piano chords & scales.',
                                'price' => floatval($productPrices['piano-chords-and-scales-guide']->price),
                                'shipping' => 'true'
                            ],
                            [
                                'image' => 'https://d1fyshwdvi6fth.cloudfront.net/Pianote/Bundle-images/2bae4048-37d2-4fe4-a195-431de3f7f822-easy-chords-card.jpg',
                                'title' => 'Easy Chords',
                                'description' => 'Chords are the foundation of all music. But they can be tricky to understand, let alone practice. Easy Chords solves that problem. Over 30 days, you’ll play with a teacher and unlock the beauty and power of piano chord progressions. You’ll be able to play hundreds of songs after taking this course. And best of all? It only takes 10 minutes a day.',
                                'price' => floatval($productPrices['easy-chords']->price),
                            ],
                            [
                                'image' => 'https://d2vyvo0tyx8ig5.cloudfront.net/sales/promos/october/power_of_chords_card.jpg',
                                'title' => 'The Power of Chords',
                                'description' => 'Play the music you love using the power of chords.',
                                'price' => floatval($productPrices['the-power-of-chords']->price),
                            ],
                        ]
                    @endphp
                    @foreach($bonuses as $bonus)
                        <div
                            class="bonus-wrap relative inline-block align-top mx-auto mb-4 px-1 md:px-3 @if(!empty($bonusWidth)) {{ $bonusWidth }} @else w-1/2 md:w-1/4 lg:w-1/5 @endif"
                            x-data="{
                        flipped: false,
                    }"
                            x-on:click="
                        flipped = !flipped;
                        if(flipped){
                            $refs.front.classList.add('rotate-y-180');
                            $refs.back.classList.remove('-rotate-y-180');
                            $refs.back.classList.add('rotate-y-0');
                        }
                        else {
                            $refs.front.classList.remove('rotate-y-180');
                            $refs.back.classList.add('-rotate-y-180');
                            $refs.back.classList.remove('rotate-y-0');
                        }
                    "
                        >
                            <div class="flip-div inline-block relative w-full group" style="@if(empty($bonus['bigCard'])) padding-bottom: 133%; @else padding-bottom: 103%; @endif perspective: 1000px;">
                                <div class="text-center w-full h-full absolute cursor-pointer" style="transform-style: preserve-3d;">
                                    <div
                                        x-ref="front"
                                        class="border-2 border-musora front absolute z-20 overflow-hidden rounded-xl w-full h-full transition-transform duration-700"
                                        style="@if(!empty($bonus['special'])) overflow: visible;border-color: #cda880; @endif backface-visibility: hidden;">
                                        @if(!empty($bonus['badge']))
                                            <h6 class="absolute text-white top-0 left-0 w-full py-0.5 bg-{{ $theme }} font-bebas uppercase">{{ $bonus['badge'] }}</h6>
                                        @endif
                                        <div class="overflow-hidden h-full w-full bg-black bg-top bg-cover"
                                            :class="{'opacity-0': !lazyLoad, 'opacity-100': lazyLoad}"
                                            x-intersect.once="lazyLoad = true">
                                            <picture class="absolute inset-0 w-full h-full object-cover">
                                                <source srcset="https://d21q7xesnoiieh.cloudfront.net/fit-in/980x0/filters:quality(95)/{{ $bonus['image'] }}"
                                                    media="(min-width: 640px)">
                                                <img src="https://d21q7xesnoiieh.cloudfront.net/fit-in/420x0/filters:quality(95)/{{ $bonus['image'] }}"
                                                    alt="Bonus Image"
                                                    class="w-full h-full object-cover opacity-0 transition-opacity"
                                                    loading="lazy"
                                                    onload="this.classList.remove('opacity-0')">
                                            </picture>
                                        </div>
                                        <div class="absolute z-40 text-center top-1/2 left-1/2 text-white transition-opacity duration-300 transform -translate-x-1/2 -translate-y-1/2 visible opacity-0 group-hover:opacity-100 text-shadow-2">
                                            <i class="fas fa-arrow-right text-4xl"></i><br>
                                            <p class="text-sm"><strong>DETAILS</strong></p>
                                        </div>
                                    </div>
                                    <div
                                        x-ref="back"
                                        class="back border-2 border-musora absolute z-40 overflow-hidden rounded-xl w-full h-full transition-transform duration-700 -rotate-y-180"
                                        style="backface-visibility: hidden;"
                                    >
                                        <div class="w-full h-full mx-auto text-center text-white flex flex-wrap justify-center items-center content-center p-2 md:p-3" style="background:linear-gradient(to bottom, #01050f, #021225);">
                                            <p class="leading-normal mx-auto text-sm">{!! $bonus['description'] !!}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <p class="w-full leading-normal mt-2">
                                @if(!empty($bonus['title']))
                                    <strong class="font-black leading-tight inline-block mb-1">{!!  $bonus['title']  !!}</strong><br>
                                @endif
                                <span style="text-transform:uppercase; display:inline-block;">
                            @if(!empty($bonus['price']))
                                        <s class="opacity-40">${{ $bonus['price'] }}</s>
                                    @endif
                                    @if(!empty($bonus['customText']))
                                        <strong class="text-musora">{{ $bonus['customText'] }}</strong>
                                    @else
                                        <strong class="text-musora">FREE</strong>
                                    @endif
                                <br>
                                <em>
                                    @if(!empty($bonus['shipping']))
                                        Free Shipping
                                    @else
                                        Online Access
                                    @endif
                                </em>
                            </span>
                            </p>
                        </div>
                    @endforeach
                </div>
                <h2 class="leading-tight mt-6 mb-1">
                    <s class="opacity-50">$240</s> <strong>$180</strong>
                </h2>
                <p class="text-sm mb-4 sm:mb-6"><strong class="text-musora">Save 25%</strong> for your first year. Renews at $240/yr.</p>
                <a class="join mb-4 md:mb-5 w-full max-w-xs md:max-w-lg lg:max-w-3xl" style="padding: 20px 10px;" href="{{ $buttonLink }}">
                    GET STARTED
                </a>
                <br>
                <a class="inline-block opacity-70 mt-2" href="{{ $buttonLink }}"><p><u><em>OR get just the membership (no physical bonuses).</em></u></p></a>
            </div>
        </section>
    </div>
@endsection
@section('scripts')
<script type="application/javascript">
    document.addEventListener('DOMContentLoaded', function () {
        var stickyBar = document.querySelector('.promo-banner');
        window.addEventListener('scroll', function () {
            var stickTrigger = document.querySelector('.sticky-trigger').offsetTop;
            var unstickTrigger = document.querySelector('.unstick-trigger').offsetTop;
            if (window.scrollY > (unstickTrigger - 115)) {
                stickyBar.classList.remove('fixed', 'mt-0');
            }
            if (window.scrollY < stickTrigger - 115) {
                stickyBar.classList.remove('fixed', 'mt-0');
            }
            if (window.scrollY < unstickTrigger - 115 && window.scrollY > stickTrigger - 115) {
                stickyBar.classList.add('fixed', 'mt-0');
            }
        });
    });
</script>
@endsection
