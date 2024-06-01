@php
    require_once(resource_path('marketing/views/pianote/_partials/homepage-data.php'));
@endphp
@extends('pianote.sales.subscription', [
    "promoVersion" => true,
    "hideHeader" => true,
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

    @php
        $bubble1 = 'https://d21q7xesnoiieh.cloudfront.net/fit-in/130x0/filters:quality(95)/marketing/pianote/membership/homepage/2024/bubbles/david-bennett2.webp';
        $bubble2 = 'https://d21q7xesnoiieh.cloudfront.net/fit-in/330x0/filters:quality(95)/marketing/pianote/membership/homepage/2024/bubbles/lisa-witt.webp';
        $bubble3 = 'https://d21q7xesnoiieh.cloudfront.net/fit-in/400x0/filters:quality(95)/marketing/pianote/membership/homepage/2024/bubbles/jordan-rudess2.webp';
        $bubble4 = 'https://d21q7xesnoiieh.cloudfront.net/fit-in/130x0/filters:quality(95)/marketing/pianote/membership/homepage/2024/bubbles/kevin-castro.webp';
        $bubble5 = 'https://d21q7xesnoiieh.cloudfront.net/fit-in/130x0/filters:quality(95)/marketing/pianote/membership/homepage/2024/bubbles/erskine-hawkins.webp';
        $bubble6 = 'https://d21q7xesnoiieh.cloudfront.net/fit-in/360x0/filters:quality(95)/marketing/pianote/membership/homepage/2024/bubbles/victoria-thoedore.webp';
        $bubble7 = 'https://d21q7xesnoiieh.cloudfront.net/fit-in/390x0/filters:quality(95)/marketing/pianote/membership/homepage/2024/bubbles/sangah-noona.webp';
        $bubble8 = 'https://d21q7xesnoiieh.cloudfront.net/fit-in/130x0/filters:quality(95)/marketing/pianote/membership/homepage/2024/bubbles/jesus-molina.webp';
            $bubbles =  [
                 [
                     'src' => 'https://d21q7xesnoiieh.cloudfront.net/fit-in/130x0/filters:quality(95)/marketing/pianote/membership/homepage/2024/bubbles/jordan-rudess2.webp',
                     'classes' => 'h-10 sm:h-14 lg:h-16 top-[53%] sm:top-[53%] left-[4%] sm:left-[4%]',
                 ],
                 [
                     'src' => 'https://d21q7xesnoiieh.cloudfront.net/fit-in/350x0/filters:quality(95)/marketing/pianote/promos/may/header-bubble-05.webp',
                     'classes' => 'h-24 sm:h-28 lg:h-44 top-[13%] sm:top-[21%] left-[8%] sm:left-[10%]',
                 ],
                 [
                     'src' => 'https://d21q7xesnoiieh.cloudfront.net/fit-in/380x0/filters:quality(95)/marketing/pianote/promos/may/header-bubble-02.webp',
                     'classes' => 'h-32 sm:h-40 lg:h-52 top-[84%] sm:top-[81%] left-[9%] sm:left-[18%]',
                 ],
                 [
                     'src' => 'https://d21q7xesnoiieh.cloudfront.net/fit-in/130x0/filters:quality(95)/marketing/pianote/membership/homepage/2024/bubbles/kevin-castro.webp',
                     'classes' => 'h-10 sm:h-12 lg:h-16 top-[13%] sm:top-[13%] left-[31%] sm:left-[31%]',
                 ],
                 [
                     'src' => 'https://d21q7xesnoiieh.cloudfront.net/fit-in/130x0/filters:quality(95)/marketing/pianote/membership/homepage/2024/bubbles/erskine-hawkins.webp',
                     'classes' => 'h-10 sm:h-12 lg:h-16 top-[8%] sm:top-[8%] left-[58%] sm:left-[58%]',
                 ],
                 [
                     'src' => 'https://d21q7xesnoiieh.cloudfront.net/fit-in/340x0/filters:quality(95)/marketing/pianote/promos/may/header-bubble-03.webp',
                     'classes' => 'h-28 sm:h-32 lg:h-48 top-[88%] sm:top-[88%] left-[90%] sm:left-[78%]',
                 ],
                 [
                     'src' => 'https://d21q7xesnoiieh.cloudfront.net/fit-in/370x0/filters:quality(95)/marketing/pianote/promos/may/header-bubble-01.webp',
                     'classes' => 'h-28 sm:h-36 lg:h-52 top-[13%] sm:top-[18%] left-[93%] sm:left-[87%]',
                 ],
                 [
                     'src' => 'https://d21q7xesnoiieh.cloudfront.net/fit-in/130x0/filters:quality(95)/marketing/pianote/promos/may/header-bubble-04.webp',
                     'classes' => 'h-12 sm:h-14 lg:h-16 top-[63%] sm:top-[63%] left-[99%] sm:left-[99%]',
                 ]
             ];
            $slides = $pianote['slides'];
    @endphp
    <header class="text-center px-5 sm:px-6 py-28 sm:py-48 relative overflow-hidden text-white"
        style="background:linear-gradient(45deg, #900068, #F61A30);">
        <div class="container max-w-6xl mx-auto relative z-20">
            <h1 class="relative w-auto inline-block text-3xl sm:text-5xl lg:text-6xl mb-7 sm:mb-10 font-black font-lexend leading-none sm:leading-none lg:leading-none uppercase">
                THE <span class="text-musora">EASY</span> WAY<br class="sm:hidden"> TO PLAY<br class="hidden sm:inline"> <span class="relative inline-block">YOUR FAVORITE SONGS.<svg class="absolute left-0 right-0 bottom-0 w-full h-4 sm:h-7" xmlns="http://www.w3.org/2000/svg" width="100%" height="100%" viewBox="0 0 524 22" fill="none" style="transform: translate(0, 100%);"><path d="M1.99978 10.6328C84.053 4.08508 302.889 -3.20824 521.809 20" stroke="#ffae00" stroke-width="3" stroke-linecap="round"></path><path d="M2.17373 15.0541C83.9528 7.29382 302.406 -3.51921 521.988 15.3111" stroke="#ffae00" stroke-width="3" stroke-linecap="round"></path></svg></span>
            </h1>
            <p class="text-sm leading-normal sm:tracking-widest mb-5 lg:mb-7">
                <i class="fas fa-check text-musora"></i> GREAT TEACHERS
                <i class="fas fa-check ml-3 sm:ml-5 text-musora"></i> VIDEO LESSONS
                <br class="lg:hidden">
                <i class="fas fa-check lg:ml-5 text-musora"></i> FUN PRACTICE
                <i class="fas fa-check ml-3 sm:ml-5 text-musora"></i> 1000+ SONGS
            </p>
            <h2 class="leading-tight mt-4 mb-1">
                <s class="opacity-50">$240</s> <strong>$180</strong>
            </h2>
            <p class="mb-4 sm:mb-6"><strong class="text-musora">Save 25%</strong> for your first year. Renews at $240/yr.
            </p>
            <div class="flex flex-wrap justify-center max-w-xs sm:max-w-full mx-auto px-5 sm:px-0">


                <a class="sm:mx-0.5 w-full sm:w-56 join musora smaller sm:order-1 mb-2 sm:mb-0 anchor-slide"
                    href="#customize-anchor" aria-label="Customize anchor"
                >SEE YOUR DEAL <i class="fas fa-arrow-right" style="line-height: 0;" aria-hidden="true"></i></a>
                <div class="sm:mx-0.5 w-full sm:w-56 join outline white smaller autoplay-video" x-on:click="trailer = true;">WATCH THE TRAILER</div>
            </div>
            <div class="flex flex-wrap items-center justify-center mt-2 sm:mt-3 mx-auto">
                <a aria-label="Review" class="inline-block" href="https://www.shopperapproved.com/reviews/Musora.com" target="_blank" rel="noopener noreferrer" onclick="window.open('https://www.shopperapproved.com/reviews/Musora.com', 'newwindow', 'width=750, height=550'); return false;">
                    <i class="align-middle text-lg fas fa-star" style="color: #ffac00;" aria-hidden="true"></i>
                    <i class="align-middle text-lg -ml-4 fas fa-star" style="text-shadow: -2px -1px 1px #b80a52;color: #ffac00;" aria-hidden="true"></i>
                    <i class="align-middle text-lg -ml-4 fas fa-star" style="text-shadow: -2px -1px 1px #b80a52;color: #ffac00;" aria-hidden="true"></i>
                    <i class="align-middle text-lg -ml-4 fas fa-star" style="text-shadow: -2px -1px 1px #b80a52;color: #ffac00;" aria-hidden="true"></i>
                    <i class="align-middle text-lg -ml-4 fas fa-star" style="text-shadow: -2px -1px 1px #b80a52;color: #ffac00;" aria-hidden="true"></i>
                </a>
                <p class="inline-block leading-tight text-xs align-middle pl-1 m-0"><em>Trusted by {{ number_format(Prices::$students) }} active students.</em></p>
            </div>
        </div>
        @foreach($bubbles as $bubble)
            <picture>
                <source media="(min-width:640px)" srcset="{{ $bubble['src'] }}">
                <img class="absolute z-10 transform -translate-x-1/2 -translate-y-1/2 {{ $bubble['classes'] }}"
                    src="{{ $bubble['src'] }}" alt="header circle image" fetchpriority="high">
            </picture>
        @endforeach
    </header>
    <section class="sm:px-6 py-4 sm:py-5 text-white relative z-10" style="background:#0c1524;">
        <div class="container max-w-5xl mx-auto">
            @component('_partials.components.carousel',[
                'xdata' => "
                    classes: {
                        arrow: 'splide__arrow bg-white opacity-100 shadow-lg h-11 w-11 header-slide-btn',
                        prev: 'splide__arrow--prev your-class-prev hidden sm:flex z-50',
                        next: 'splide__arrow--next your-class-next hidden sm:flex z-50',
                        pagination: 'hidden',
                    },
                    perPage: 1,
                    perMove: 1,
                    type: 'loop',
                    autoplay: true,
                    pauseOnHover: true,
                    pauseOnFocus: true,
                    interval: 3000,
                    lazyLoad: 'nearby',
                ",
            ])
                @slot('content')
                    @foreach ($slides as $slide)
                        <li class="splide__slide">
                            <div class="px-3 md:px-6 text-center">
                                <p class="leading-normal text-sm"><em>“{{ $slide['desc'] }}”</em></p>
                                <div class="flex flex-wrap md:flex-nowrap sm:text-left items-center justify-center mt-1.5">
                                    <img
                                        class="rounded-full object-cover object-right w-9 h-9"
                                        data-splide-lazy={{ $slide['thumb'] }}
                                alt="{{$slide['name']}}"
                                    ><br class="inline md:hidden">
                                    <p class="leading-tight w-full text-center md:w-auto text-sm text-light-navy ml-1 md:ml-2 mr-0 mt-0.5 md:mt-0"><em>{{ $slide['name'] }}, {{ $slide['credit'] }}</em></p>
                                </div>
                            </div>
                        </li>
                    @endforeach
                @endslot
            @endcomponent
        </div>
    </section>

    <section class="text-center px-5 sm:px-6 py-12 sm:py-14 lg:py-20 text-white relative" style="background: linear-gradient(to bottom, #07233E, #0C1524);">
        <div class="container max-w-5xl mx-auto">
            <img class="mb-5 h-56 inline sm:hidden"
                src="https://d21q7xesnoiieh.cloudfront.net/fit-in/620x0/filters:quality(95)/marketing/pianote/promos/may/banner-graphic.png"
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
                        <em>Free worldwide shipping!</em><br>
                        <strong class="text-musora uppercase">ONLY
                            <span x-cloak x-data="timer()" x-init="countdown()">
                     <span x-cloak x-show="timeLeft > 0 && day > 0"><span x-text="day"></span><span x-text="dayText"></span></span>
                     <span x-cloak x-show="timeLeft > 0 && hour > 0"><span x-text="hour"></span><span x-text="hourText"></span></span>
                     <span x-cloak x-show="timeLeft > 0"><span x-text="minute"></span><span x-text="minuteText"></span></span>
                     <span x-cloak x-show="timeLeft > 0"><span x-text="second"></span><span x-text="secondText"></span></span>
                     <span x-cloak x-show="timeLeft < 0">A Limited Time</span>
                 </span>
                            LEFT</strong>
                    </p>

                </div>
                <img class="h-80 lg:h-96 hidden sm:inline transition-opacity opacity-0"
                    loading="lazy"
                    onload="this.classList.remove('opacity-0')"
                    src="https://d21q7xesnoiieh.cloudfront.net/fit-in/690x0/filters:quality(95)/marketing/pianote/promos/may/banner-graphic.png"
                    alt="learn playing image"
                >
            </div>
        </div>
    </section>
    <div class="sticky-trigger block"></div>
    <a href="#customize-anchor" style="background: linear-gradient(to bottom, #FFAC00, #FF5C00);"
        class="promo-banner flex items-center justify-center -mt-10 py-1.5 px-2 sm:px-0 w-full z-[100] transition-none anchor-slide">
        {{--        <img class="h-8 sm:h-10 mr-4" src="https://cdn.musora.com/image/fetch/w_300,q_auto:best/https://d2vyvo0tyx8ig5.cloudfront.net/products/30-day-blues-piano/30-day-blues-piano-logo-blue-glow.png" alt="30 day drummer logo" />--}}
        <h3 class="inline-block font-bebas mx-0 pr-3">* FREE BONUSES *</h3>
        <p class="inline-block text-xs mx-0 leading-tight">
            <strong class="font-black">SAVE 25%</strong> + get 5 free<br>
            bonuses (worth $615)
        </p>
    </a>

    <section class="py-8 sm:py-14 lg:py-20 relative overflow-hidden text-center customize px-5 lg:px-8 relative overflow-hidden" style="background: #fff;">
        <div class="container mx-auto max-w-4xl mb-14 sm:mb-0">
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
                <div class="w-full sm:flex items-center mb-12">
                    <div class="relative flex-shrink-0">
                        <img class="h-48 sm:h-64 lg:h-72 rounded-xl overflow-hidden" src="https://d21q7xesnoiieh.cloudfront.net/fit-in/750x0/filters:quality(95)/marketing/pianote/promos/may/little-chord-thumb.png">
                    </div>
                    <div class="sm:pl-5 lg:pl-8">
                        <img class="h-14 sm:h-16 lg:h-20 my-3 sm:mt-0 sm:mb-4" src="https://d21q7xesnoiieh.cloudfront.net/fit-in/460x0/filters:quality(95)/marketing/pianote/promos/may/little-chord-logo.png">
                        <p class="leading-tight">All popular music is chords. And we’ve compiled the top 14 chord progressions in popular music into this handy little book. You’ll get diagrams for each progression as well as notated chord pathways. Use these chords to start playing your favorite songs (or write your own).</p>
                    </div>
                </div>
                <div class="w-full sm:flex items-center mb-12">
                    <div class="relative flex-shrink-0 sm:order-1">
                        <img class="h-48 sm:h-64 lg:h-72 rounded-xl overflow-hidden" src="https://d21q7xesnoiieh.cloudfront.net/fit-in/750x0/filters:quality(95)/marketing/pianote/promos/may/power-thumb.png">
                    </div>
                    <div class="sm:pr-5 lg:pr-8">
                        <img class="h-14 sm:h-16 lg:h-20 my-3 sm:mt-0 sm:mb-4" src="https://www.musora.com/musora-cdn/image/width=400,quality=95/https://d2vyvo0tyx8ig5.cloudfront.net/products/the-power-of-chords/Logo_left.png">
                        <p class="leading-tight">You’ll get LIFETIME access to this step-by-step course showing you how to play and practice all the chords you’ll need to play the songs you love. From major and minor chords -- to sus chords and even “slash” chords, it’s your comprehensive chording course!</p>
                    </div>
                </div>
                <div class="w-full sm:flex items-center">
                    <div class="relative flex-shrink-0">
                        <img class="h-48 sm:h-64 lg:h-72 rounded-xl overflow-hidden" src="https://www.musora.com/musora-cdn/image/width=750,quality=95/https://d2vyvo0tyx8ig5.cloudfront.net/sales/promos/september/webinar-offer/easy-chords.jpg">
                    </div>
                    <div class="sm:pl-5 lg:pl-8">
                        <img class="h-14 sm:h-16 lg:h-20 my-3 sm:mt-0 sm:mb-4" src="https://www.musora.com/musora-cdn/image/width=460,quality=95/https://d2vyvo0tyx8ig5.cloudfront.net/sales/promos/september/webinar-offer/easy-chords-logo.png">
                        <p class="leading-tight">You learn by doing. And that’s the goal of this 30-day chording challenge. Play with Lisa every day and master your chord progressions and inversions so you can play any lead sheet with ease. All you have to do is press play and follow along.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <div class="h-5 sm:h-10 relative z-10"
        style="background: linear-gradient(to bottom right, transparent calc(50% - 1px), transparent, #F4F8FB calc(50% + 1px));">
    </div>
    <section class="text-black px-5 sm:px-6 py-8 sm:py-10 lg:py-12 relative z-20" style="background-color:#F4F8FB;">
        <div class="container max-w-4xl mx-auto pb-10">
            <div class="flex flex-wrap sm:flex-nowrap justify-center items-center">
                <img class="w-48 sm:w-64 lg:w-80 -mt-24 mb-4 sm:-mb-24 transition-opacity opacity-0" loading="lazy"
                    onload="this.classList.remove('opacity-0')"
                    src="https://d21q7xesnoiieh.cloudfront.net/fit-in/640x0/filters:quality(95)/marketing/pianote/promos/may/live-phone.png"
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
        $buttonLink = '/ecommerce/add-to-cart?products[PIANOTE-MEMBERSHIP-1-YEAR]=1&products[piano-chords-and-scales-guide]=1&products[music-theory-posters]=1&products[little-book-chord]=1&products[easy-chords]=1&products[the-power-of-chords]=1&redirect=/order&locked=true&promo-code=welcome-offer';
        $buttonLink2 = '/ecommerce/add-to-cart?products[PIANOTE-MEMBERSHIP-1-YEAR]=1&products[digital-chords-scales-guide]=1&products[easy-chords]=1&products[the-power-of-chords]=1&redirect=/order&locked=true&promo-code=welcome-offer'
    @endphp
    <div style="background:linear-gradient(to left, #F61A30, #900068);">
        <section class="py-14 sm:py-24 lg:py-32 relative overflow-hidden text-white text-center customize px-4 lg:px-6">
            <div class="container mx-auto relative z-50  max-w-4xl ">
                <div class="w-full">
                    <img class="h-10 mb-2" src="https://d21q7xesnoiieh.cloudfront.net/fit-in/250x0/filters:quality(95)/marketing/pianote/membership/homepage/2023/pianote-logo-white.png">
                   <br>
                    <h1 class="relative w-auto inline-block text-3xl sm:text-5xl lg:text-6xl mb-7 sm:mb-10 font-black font-lexend leading-none sm:leading-none lg:leading-none uppercase">
                        THE <span class="text-musora">EASY</span> WAY<br class="sm:hidden"> TO PLAY<br class="hidden sm:inline"> <span class="relative inline-block">YOUR FAVORITE SONGS.</span>
                    </h1>
                    <h3 class="leading-tight mt-4 sm:mt-5 mb-2 text-musora">Save 25% on your first year<br class="sm:hidden"> + get $615 in free bonuses.
                    </h3>
                    <a class="join musora my-4 md:my-6 w-full max-w-xs md:max-w-lg lg:max-w-xl" style="padding: 20px 10px;" href="{{ $buttonLink }}">
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
                                'image' => 'https://d21q7xesnoiieh.cloudfront.net/fit-in/420x0/filters:quality(95)/marketing/pianote/promos/may/annual.png',
                                'description' => 'Level up your skills with the lessons, teachers, and practice tools.',
                                'price' => '240',
                                'customText' => '$180/First Year',
                            ],
                            [
                                'image' => 'https://d21q7xesnoiieh.cloudfront.net/fit-in/420x0/filters:quality(95)/marketing/pianote/membership/homepage/2024/bonus-chords-scales.webp',
                                'description' => 'Your encyclopedia of piano chords & scales.',
                                'price' => floatval($productPrices['piano-chords-and-scales-guide']->price),
                                'shipping' => 'true'
                            ],
                            [
                                'image' => 'https://d21q7xesnoiieh.cloudfront.net/fit-in/420x0/filters:quality(95)/marketing/pianote/promos/may/music-theory2.png',
                                'description' => 'You’ll understand the Circle of 5ths, be able to read notes, and play every major and minor chord and scale with the Music Theory Poster Bundle.',
                                'price' => '39',
                                'shipping' => 'true'
                            ],
                            [
                                'image' => 'https://d21q7xesnoiieh.cloudfront.net/fit-in/420x0/filters:quality(95)/marketing/pianote/promos/may/little-chords.png',
                                'description' => 'All music is chord progressions. In this little book, we’ve compiled the top 14 chord progressions you’ll find in popular music.',
                                'price' => '7',
                                'shipping' => 'true'
                            ],
                            [
                                'image' => 'https://d1fyshwdvi6fth.cloudfront.net/Pianote/Bundle-images/2bae4048-37d2-4fe4-a195-431de3f7f822-easy-chords-card.jpg',
                                'description' => 'Over 30 days, you’ll play with a teacher and unlock the beauty and power of piano chord progressions. ',
                                'price' => floatval($productPrices['easy-chords']->price),
                            ],
                            [
                                'image' => 'https://d2vyvo0tyx8ig5.cloudfront.net/sales/promos/october/power_of_chords_card.jpg',
                                'description' => 'Play the music you love using the power of chords.',
                                'price' => floatval($productPrices['the-power-of-chords']->price),
                            ],
                            [
                                'image' => 'https://d21q7xesnoiieh.cloudfront.net/fit-in/420x0/filters:quality(95)/marketing/pianote/promos/may/masterclass.png',
                                'description' => 'Exclusive LIVE Masterclass with Lisa on Chording',
                                'price' => '',
                            ],
                        ]
                    @endphp
                    @foreach($bonuses as $bonus)
                        <div
                            class="bonus-wrap relative inline-block align-top mx-auto mb-4 px-1 md:px-3 @if(!empty($bonusWidth)) {{ $bonusWidth }} @else w-1/2 md:w-1/4 @endif"
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
                                                <img src="{{ $bonus['image'] }}"
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
                                <span style="display:inline-block;">
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
                <p class="mb-4 sm:mb-6"><strong class="text-musora">Save 25%</strong> for your first year. Renews at $240/yr.
                    <br>
                    <strong class="text-musora uppercase">ONLY
                        <span x-cloak x-data="timer()" x-init="countdown()">
                     <span x-cloak x-show="timeLeft > 0 && day > 0"><span x-text="day"></span><span x-text="dayText"></span></span>
                     <span x-cloak x-show="timeLeft > 0 && hour > 0"><span x-text="hour"></span><span x-text="hourText"></span></span>
                     <span x-cloak x-show="timeLeft > 0"><span x-text="minute"></span><span x-text="minuteText"></span></span>
                     <span x-cloak x-show="timeLeft > 0"><span x-text="second"></span><span x-text="secondText"></span></span>
                     <span x-cloak x-show="timeLeft < 0">A Limited Time</span>
                 </span>
                        LEFT</strong></p>
                <a class="join musora mb-4 md:mb-5 w-full max-w-xs md:max-w-lg lg:max-w-3xl" style="padding: 20px 10px;" href="{{ $buttonLink }}">
                    GET STARTED
                </a>
                <br>
                <a class="inline-block" href="{{ $buttonLink2 }}"><p><u><em>OR get just the membership (no physical bonuses).</em></u></p></a>
            </div>
        </section>
    </div>
@endsection
@section('scripts')
    @include('_partials.components.countdown',[
    'countdownDate' => '2024-06-03 00:00:00',
    'promoVersion' => false
    ])
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
