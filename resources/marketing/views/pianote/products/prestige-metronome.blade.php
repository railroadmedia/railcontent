@extends('pianote._partials.global-layout')

@section('global-head')
    <title>The Prestige Flamed Maple Metronome | Pianote</title>
    <meta property="og:title" content="The Prestige Flamed Maple Metronome | Pianote">

    <meta name="description" content="Keep perfect time with this handcrafted, German-made Wittner metronome.">
    <meta property="og:description" content="Keep perfect time with this handcrafted, German-made Wittner metronome.">

    <meta property="og:image" content="https://d21q7xesnoiieh.cloudfront.net/fit-in/1200x0/filters:quality(95)/marketing/pianote/products/prestige-metronome/limited-metronome-share-image2.jpg" style="display: none;">
    <meta property="og:url" content="https://www.pianote.com/{{ Request::path() }}">

    @include('_partials.layout._fonts')
    <link rel="stylesheet" href="{{ mix('marketing/css/app.css') }}">
    <link href="{{ asset('/marketing/css/tailwind-helpers.css') }}" rel="stylesheet">
    <link href="{{ asset('/marketing/parcel/drumeo/nav-footer-pianote.css') }}" rel="stylesheet">
    <link href="{{ asset('/marketing/parcel/drumeo/lead-gen-learn-songs.css') }}" rel="stylesheet">
    <link href="{{ asset('/marketing/parcel/drumeo/30dd.css') }}" rel="stylesheet">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@splidejs/splide@4.0.7/dist/css/splide.min.css">
    <style>
        .text-gold {
            color:#FFC16B;
        }
        .disclaimer {
            display:none!important;
        }
    </style>
@stop

@section('global-body')
    @include('pianote.sales.partials._nav')
    <div id="signup" class="anchor"></div>
    <header class="text-white px-4 sm:px-6 py-10 sm:py-10 lg:py-16 relative" style="background-color:#000;">
        <div class="inset-0 absolute z-0 bg-top bg-cover hidden sm:block" style="background:url('https://d21q7xesnoiieh.cloudfront.net/fit-in/2000x0/filters:quality(95)/marketing/pianote/products/prestige-metronome/header-bg.jpg')"></div>
        <div class="container max-w-4xl mx-auto relative z-10">
            <div class="flex flex-wrap sm:flex-nowrap items-center">
                <div class="w-full sm:w-2/3 text-center lg:text-left">
                    <img class="h-48 mb-5 sm:hidden" alt="logo" fetchpriority="high" src="https://d21q7xesnoiieh.cloudfront.net/fit-in/310x0/filters:quality(95)/marketing/pianote/products/prestige-metronome/header-metronome-m.png">
                    <br>
                    <img class="h-20 sm:h-24 lg:h-32" alt="logo" fetchpriority="high" src="https://d21q7xesnoiieh.cloudfront.net/fit-in/440x0/filters:quality(95)/marketing/pianote/products/prestige-metronome/logo-white-m2.svg">
                    <p class="leading-normal my-3 sm:my-4">Keep perfect time with this handcrafted, German-made Wittner metronome. It features a luxurious flamed maple case finished in a satin lacquer and all the precision engineering you’d expect from the world’s best metronome maker.
                        <br><br>
                        Numbers are extremely limited as <strong class="text-gold">only 216</strong> were made.</p>
                    <h3 class="leading-tight text-gold"><strong>${{ floatval($productPrices['maelzel-metronome']->discounted_price) }}</strong></h3>
                    <p class="leading-normal my-3 sm:my-4"><em>Enter your email to be notified when one is available:</em></p>

                    @include('pianote._partials.sign-up-form', [
                        "recaptchaKey" => $recaptchaKey,
                        "formName" => 'Metronome Notice',
                        "formId" => "Pianote - Engagement - Trigger - Metronome Notice - Web Form",
                        "buttonText" => "Notify Me ",
                    ])
                </div>
            </div>
        </div>
    </header>

    <section class="text-center px-4 sm:px-6 py-8 sm:py-16 lg:py-20 relative bg-center bg-cover text-white" style="background-image:url('https://d21q7xesnoiieh.cloudfront.net/fit-in/1500x0/filters:quality(95)/marketing/pianote/products/prestige-metronome/metronome-feature-bg.jpg');">
        <div class="container mx-auto z-10 relative max-w-6xl">
            <h2 class="leading-tight"><strong>So beautiful - you’ll<br class="sm:hidden"> WANT to use it.</strong></h2>
            <p class="leading-normal mt-2 mb-5 mx-auto max-w-xl">Most metronomes collect dust.<br class="sm:hidden"> This one demands attention.</p>
            @php
                $gridItems = [
                    [
                    'icon' => 'marketing/pianote/products/prestige-metronome/timing-icon.svg',
                    'img' => 'marketing/pianote/products/prestige-metronome/timing-slide.jpg',
                    'title' => 'Precision Timing So<br class="hidden sm:inline"> You’re Always On Beat',
                    'desc' => 'The Swiss make watches. The Germans make metronomes. And Wittner makes the best. Cheap metronomes don’t keep time. With this metronome - every beat is perfect.',
                    ],
                    [
                    'icon' => 'marketing/pianote/products/prestige-metronome/numbered-icon.svg',
                    'img' => 'marketing/pianote/products/prestige-metronome/numbered-slide.jpg',
                    'title' => 'Hand-Numbered<br class="hidden sm:inline"> & One-Of-A-Kind',
                    'desc' => 'Each Prestige Metronome is hand-numbered, and there are only 216 in the world. Your metronome is one-of-a-kind, and you can feel proud having it in your practice space.',
                    ],
                    [
                    'icon' => 'marketing/pianote/products/prestige-metronome/maple-wood-icon.svg',
                    'img' => 'marketing/pianote/products/prestige-metronome/wooden-slide.jpg',
                    'title' => 'Solid Flamed Maple<br class="hidden sm:inline"> Wood Casing',
                    'desc' => 'Chosen by Horst Wittner himself, this beautiful white maple features a perfect flamed grain that’s not found on any other metronome in the world. No plastic here.',
                    ],
                    [
                    'icon' => 'marketing/pianote/products/prestige-metronome/adjustable-icon.svg',
                    'img' => 'marketing/pianote/products/prestige-metronome/adjustable-slide.jpg',
                    'title' => 'Adjustable Tempos<br class="hidden sm:inline"> For Any Song',
                    'desc' => 'Changing tempos is easy with this metronome. Find the tempo you want on the tempo chart, and simply slide the adjustable weight until it clicks to the right tempo. The old ways are still the best ways.',
                    ],
                    [
                    'icon' => 'marketing/pianote/products/prestige-metronome/hand-wound-icon.svg',
                    'img' => 'marketing/pianote/products/prestige-metronome/hand-wound-slide.jpg',
                    'title' => 'Hand-Wound and<br class="hidden sm:inline"> Battery-Free',
                    'desc' => 'Like the best watches, this metronome doesn’t take batteries. Instead, you’ll find a hand winder on the side to set the internal gears in motion. ',
                    ],
                ];
            @endphp
            <div class="hidden lg:flex">
                <div class="w-1/4 pr-3">
                    <div class="mt-20 mb-14">
                        <img class="h-8 transition-opacity opacity-0" alt="icon" loading="lazy" onload="this.classList.remove('opacity-0')"
                            src="https://d21q7xesnoiieh.cloudfront.net/fit-in/50x0/filters:quality(95)/{{ $gridItems[3]['icon'] }}">
                        <h6 class="my-2"><strong>{!! $gridItems[3]['title']  !!}</strong></h6>
                        <p class="text-sm">{!! $gridItems[3]['desc'] !!}</p>
                    </div>
                    <div>
                        <img class="h-8 transition-opacity opacity-0" alt="icon" loading="lazy" onload="this.classList.remove('opacity-0')"
                            src="https://d21q7xesnoiieh.cloudfront.net/fit-in/50x0/filters:quality(95)/{{ $gridItems[0]['icon'] }}">
                        <h6 class="my-2"><strong>{!! $gridItems[0]['title'] !!}</strong></h6>
                        <p class="text-sm">{!!  $gridItems[0]['desc']  !!}</p>
                    </div>
                </div>
                <div class="w-1/2">
                    <img class="transition-opacity opacity-0" alt="icon" loading="lazy" onload="this.classList.remove('opacity-0')"
                        src="https://d21q7xesnoiieh.cloudfront.net/fit-in/1000x0/filters:quality(95)/marketing/pianote/products/prestige-metronome/limited-metronome-features2.png"
                    >
                </div>
                <div class="w-1/4 pl-3">
                    <div>
                        <img class="h-8 transition-opacity opacity-0" alt="icon" loading="lazy" onload="this.classList.remove('opacity-0')"
                            src="https://d21q7xesnoiieh.cloudfront.net/fit-in/50x0/filters:quality(95)/{{ $gridItems[2]['icon'] }}">
                        <h6 class="my-2"><strong>{!! $gridItems[2]['title'] !!}</strong></h6>
                        <p class="text-sm">{!! $gridItems[2]['desc'] !!}</p>
                    </div>
                    <div class="my-5">
                        <img class="h-8 transition-opacity opacity-0" alt="icon" loading="lazy" onload="this.classList.remove('opacity-0')"
                            src="https://d21q7xesnoiieh.cloudfront.net/fit-in/50x0/filters:quality(95)/{{ $gridItems[4]['icon'] }}">
                        <h6 class="my-2"><strong>{!! $gridItems[4]['title'] !!}</strong></h6>
                        <p class="text-sm">{!! $gridItems[4]['desc'] !!}</p>
                    </div>
                    <div>
                        <img class="h-8 transition-opacity opacity-0" alt="icon" loading="lazy" onload="this.classList.remove('opacity-0')"
                            src="https://d21q7xesnoiieh.cloudfront.net/fit-in/50x0/filters:quality(95)/{{ $gridItems[1]['icon'] }}">
                        <h6 class="my-2"><strong>{!! $gridItems[1]['title'] !!}</strong></h6>
                        <p class="text-sm">{!! $gridItems[1]['desc'] !!}</p>
                    </div>
                </div>
            </div>
            <div class="lg:hidden mb-5"
                x-data="{
                    init() {
                        new Splide(this.$refs.splide, {
                            classes: {
                                    arrow: 'hidden',
                                    prev: 'hidden',
                                    next: 'hidden',
                                    pagination: 'splide__pagination bottom-0',
                            },
                            perPage: 2.5,
                            perMove: 1,
                            type: 'loop',
                            focus: 0,
                            interval: 2000,
                            drag   : 'free',
                            snap   : false,
                            breakpoints: {
                                767: {
                                    perPage: 1.5,
                                },
                            },
                        }).mount()
                    },
                }"
            >
                <div x-ref="splide" class="splide text-left">
                    <div class="splide__track pb-8">
                        <ul class="splide__list items-start">
                            @foreach ($gridItems as $gridItem)
                                <li class="splide__slide px-1">
                                    <div class="rounded-xl overflow-hidden shadow-md" style="color:#000;background-color:#F6F8FC;">
                                        <div class="relative" style="padding-bottom:71%;">
                                            <img class="absolute object-cover h-full w-full transition-opacity opacity-1"
                                                loading="lazy" onload="this.classList.remove('opacity-0')" alt="metronome"
                                                src="https://d21q7xesnoiieh.cloudfront.net/fit-in/1000x0/filters:quality(95)/{{ $gridItem['img'] }}">
                                        </div>
                                        <p class="mt-4 mb-1 px-4 font-black leading-tight"><strong>{!! $gridItem['title'] !!}</strong></p>
                                        <p class="px-4 pb-6 text-sm leading-tight">{!! $gridItem['desc'] !!}</p>
                                    </div>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="px-5 sm:px-12 py-10 md:py-20 lg:py-24 overflow-hidden"  style="background:linear-gradient(to bottom, #fff7ef 50%, #dad0c6);" >
        <div class="container mx-auto relative z-10 max-w-4xl">
            <h2 class="text-center mb-10"><strong>Practice with the best.  <br>Then hear the result.</strong></h2>
            <div class="relative">
                <div class="flex flex-wrap sm:flex-nowrap items-center bg-white rounded-xl border border-black py-6 sm:py-8 px-5 sm:pr-0 sm:pl-10 mb-8 relative z-10">
                    <img class="rounded-xl shadow-md h-64 lg:h-72 sm:order-1" style="margin-right: -5%;" src="https://d21q7xesnoiieh.cloudfront.net/fit-in/1000x0/filters:quality(95)/marketing/pianote/products/prestige-metronome/practice-section-02.jpg">
                    <p class="leading-normal w-full sm:pr-8 mt-5 sm:mt-0">
                        Tick, tick, tick.
                        <br><br>
                        You need a metronome.
                        <br><br>
                        And while no piano player loves the metronome, it’s one of (if not the) most important practice tools you will EVER have.
                        <br><br>
                        <strong>So get the best.</strong>
                        <br><br>
                        Because a cheap metronome won’t keep time. And that’s disastrous for your progress.
                    </p>
                </div>
                <div class="absolute w-full h-full border rounded-xl" style="border-color:#A17642;top: 10px;left: 10px;"></div>
            </div>
            <div class="relative">
                <div class="flex flex-wrap sm:flex-nowrap items-center bg-white rounded-xl border border-black py-6 sm:py-8 px-5 sm:pl-0 sm:pr-10 mb-8 relative z-10">
                    <img class="rounded-xl shadow-md h-64 lg:h-72 sm:-ml-[5%]" src="https://d21q7xesnoiieh.cloudfront.net/fit-in/1000x0/filters:quality(95)/marketing/pianote/products/prestige-metronome/practice-section-01.jpg">
                    <p class="leading-normal w-full sm:pl-8 mt-5 sm:mt-0">
                        Wittner has been hand-making metronomes in Germany since 1895, setting the standard for precision manufacturing and timekeeping. Four generations later, the company is still family-owned and operated.
                        <br><br>
                        We’re so proud to partner with Wittner to bring you this exclusive, limited-edition Prestige Flamed Maple Metronome.
                    </p>
                </div>
                <div class="absolute w-full h-full border rounded-xl" style="border-color:#A17642;top: 10px;right: 10px;"></div>
            </div>
            <div class="relative">
                <div class="flex flex-wrap sm:flex-nowrap items-center bg-white rounded-xl border border-black py-6 sm:py-8 px-5 sm:pr-0 sm:pl-10 relative z-10">
                    <img class="rounded-xl shadow-md h-64 lg:h-72 sm:order-1" style="margin-right: -5%;" src="https://d21q7xesnoiieh.cloudfront.net/fit-in/1000x0/filters:quality(95)/marketing/pianote/products/prestige-metronome/practice-section-03.jpg">
                    <p class="leading-normal w-full sm:pr-8 mt-5 sm:mt-0">
                        You won’t find them anywhere else in the world. You can’t buy one from Wittner. They’re not in any stores. The only way to get one is to be a Pianote Member. Even Elon Musk couldn’t get one.
                        <br><br>
                        <strong>But you can.</strong>
                        <br><br>
                        There are only 216 in the world because that’s all they could make with this beautiful wood.
                        <br><br>
                        Each metronome is individually hand-numbered.
                        <br><br>
                        And once they are gone, they’ll never be made again.
                    </p>
                </div>
                <div class="absolute w-full h-full border rounded-xl" style="border-color:#A17642;top: 10px;left: 10px;"></div>
            </div>
        </div>
    </section>
<section class="text-center px-5 py-10 md:py-20 lg:py-24">
        <div class="container mx-auto relative z-10 max-w-5xl">
            <h2><strong>The last metronome <br class="sm:hidden">  you’ll ever buy.</strong></h2>
            <p class="leading-tight mt-2 mb-5 sm:mb-10 mx-auto max-w-lg">
                Get the Rolex of metronomes. And never buy another one again.
                This is the metronome you’ll give to your children one day.</p>

                @php
                    $slides = [
                     [
                         'img' => 'marketing/pianote/products/prestige-metronome/gallery-01.jpg',
                     ],
                     [
                         'img' => 'marketing/pianote/products/prestige-metronome/gallery-02.jpg',
                     ],
                     [
                         'img' => 'marketing/pianote/products/prestige-metronome/gallery-03.jpg',
                     ],
                     [
                         'img' => 'marketing/pianote/products/prestige-metronome/gallery-04.jpg',
                     ],
                     [
                         'img' => 'marketing/pianote/products/prestige-metronome/gallery-05.jpg',
                     ],
                 ];
                @endphp

            <div class="flex flex-wrap items-center mb-10">
                <div class="w-full sm:w-1/2 sm:order-1">
                    <div class="p-2 w-full"><div data-open="image1" class="h-72 sm:h-80 lg:h-96 w-full bg-center bg-cover rounded-xl"
                            style="background-image:url('https://d21q7xesnoiieh.cloudfront.net/fit-in/1000x0/filters:quality(95)/{{ $slides[0]['img'] }}')"></div></div>
                </div>
                <div class="w-1/2 sm:w-1/4">
                    <div class="p-2 w-full"><div data-open="image1" class="h-36 sm:h-40 lg:h-48 w-full bg-center bg-cover rounded-xl"
                            style="background-image:url('https://d21q7xesnoiieh.cloudfront.net/fit-in/480x0/filters:quality(95)/{{ $slides[1]['img'] }}')"></div></div>
                    <div class="p-2 w-full"><div data-open="image1" class="h-36 sm:h-36 lg:h-44 w-full bg-center bg-cover rounded-xl"
                            style="background-image:url('https://d21q7xesnoiieh.cloudfront.net/fit-in/480x0/filters:quality(95)/{{ $slides[2]['img'] }}')"></div></div>
                </div>
                <div class="w-1/2 sm:w-1/4 sm:order-2">
                    <div class="p-2 w-full"><div data-open="image1" class="h-36 sm:h-40 lg:h-48 w-full bg-center bg-cover rounded-xl"
                            style="background-image:url('https://d21q7xesnoiieh.cloudfront.net/fit-in/480x0/filters:quality(95)/{{ $slides[3]['img'] }}')"></div></div>
                    <div class="p-2 w-full"><div data-open="image1" class="h-36 sm:h-36 lg:h-44 w-full bg-center bg-cover rounded-xl"
                            style="background-image:url('https://d21q7xesnoiieh.cloudfront.net/fit-in/480x0/filters:quality(95)/{{ $slides[4]['img'] }}')"></div></div>
                </div>
            </div>
        </div>
    </section>

    <div class="h-5 sm:h-10 -mb-5 sm:-mb-10 relative z-10" style="background: linear-gradient(to top left, transparent calc(50% - 1px), transparent, #fff calc(50% + 1px));"></div>
    <section class="text-center px-5 sm:px-6 pb-10 sm:pb-14 lg:pb-20 py-10 sm:py-14 lg:pt-32 bg-center bg-cover text-white" style="background-image:url('https://d21q7xesnoiieh.cloudfront.net/fit-in/1500x0/filters:quality(95)/marketing/pianote/products/prestige-metronome/metronome-feature-bg.jpg');">
        <div class="container max-w-3xl mx-auto">
            <img class="h-28 sm:h-40 lg:h-52 block mx-auto -mt-24 sm:-mt-36 lg:-mt-48 transition-all opacity-0 relative z-20" src="https://d21q7xesnoiieh.cloudfront.net/fit-in/410x0/filters:quality(95)/marketing/pianote/products/metronome/repair-guarantee.png" alt="guarantee badge" loading="lazy" onload="this.classList.remove('opacity-0')">
            <h3 class="my-4 sm:my-6 lg:my-8"><strong>The best metronome deserves<br> the best guarantee.</strong></h3>
            <p class="leading-normal">Wittner makes the best metronomes in the world.
                <br><br>
                And that means you can be safe knowing your Prestige Flamed Maple Metronome will last years and years. But just in case the unthinkable happens, and something goes wrong…
                <br><br>
                You’ll be protected by Wittner’s 2-year guarantee.</p>
        </div>
    </section>
    <div id="customize-anchor" class="anchor"></div>
    <section class="px-5 sm:px-6 py-12 sm:pb-16 sm:pt-0 lg:pb-20 relative" style="background:#fff9f2;">
        <div class="container max-w-4xl mx-auto relative z-10">
            <div class="flex flex-wrap sm:flex-nowrap items-center">
                <div class="w-full sm:w-5/12 text-center lg:text-left sm:order-1 px-10 sm:px-0">
                    <img class="-mt-32 sm:-mt-36 sm:-mb-12 w-full" src="https://d21q7xesnoiieh.cloudfront.net/fit-in/900x0/filters:quality(95)/marketing/pianote/products/prestige-metronome/metronome-order.png">
                </div>
                <div class="w-full sm:w-7/12 text-center lg:text-left sm:pr-5">
                    <img class="h-48 mb-5 sm:hidden" alt="logo" fetchpriority="high" src="https://d21q7xesnoiieh.cloudfront.net/fit-in/310x0/filters:quality(95)/marketing/pianote/products/prestige-metronome/header-metronome-m.png">
                    <br class="sm:hidden">
                    <img class="h-20 lg:hidden" alt="logo" fetchpriority="high" src="https://d21q7xesnoiieh.cloudfront.net/fit-in/440x0/filters:quality(95)/marketing/pianote/products/prestige-metronome/logo-m2.svg">
                    <img class="h-24 lg:h-32 hidden lg:inline-block mt-12" alt="logo" fetchpriority="high" src="https://d21q7xesnoiieh.cloudfront.net/fit-in/580x0/filters:quality(95)/marketing/pianote/products/prestige-metronome/logo2.svg">
                    <p class="leading-normal my-3 sm:my-4">Keep perfect time with this handcrafted, German-made<br class="sm:hidden"> Wittner metronome. <em class="font-black">Limited to 216.</em></p>
                    <h3 class="leading-tight"><strong>${{ floatval($productPrices['maelzel-metronome']->discounted_price) }}</strong></h3>
                    <p class="leading-normal my-3 sm:my-4"><em>Enter your email to be notified when one is available:</em></p>
                    @include('pianote._partials.sign-up-form', [
                        "recaptchaKey" => $recaptchaKey,
                        "formName" => 'Metronome Notice',
                        "formId" => "Pianote - Engagement - Trigger - Metronome Notice - Web Form2",
                        "buttonText" => "Notify Me ",
                    ])
                </div>
            </div>
        </div>
    </section>

    <section class="text-white px-4 sm:px-6 py-8 sm:py-12 text-center" style="background: #00101D;">
        <div class="max-w-lg container mx-auto relative z-50 opacity-70">
            <div class="inline-block w-full px-3 md:px-4 mb-5">
                <p><strong>Any questions?</strong><br> Call us toll-free at
                    <a href="tel:+18004398921">1-800-439-8921</a> <br class="inline-block md:hidden"> or directly at
                    <a href="tel:+16048557605">1-604-855-7605</a>.<br> All prices listed in USD. </p>
            </div>
        </div>
    </section>

    @include("pianote.sales.partials._footer")

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script type="text/javascript" src="{{ asset('/marketing/parcel/drumeo/navigation-sales.js') }}"></script>

    <script src="https://cdn.jsdelivr.net/npm/@splidejs/splide@4.0.7/dist/js/splide.min.js"></script>
@stop
