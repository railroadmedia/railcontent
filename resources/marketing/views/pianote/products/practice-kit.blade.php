@extends('pianote._partials.global-layout')

@section('global-head')
    @parent
    <title>Practice Kit | Pianote</title>
    <meta property="og:title" content="Practice Kit | Pianote">
    <meta name="description" content="Essential tools to maximize your practice time and improve your playing.">
    <meta property="og:description" content="Essential tools to maximize your practice time and improve your playing.">
    <meta property="og:image"
        content="https://d21q7xesnoiieh.cloudfront.net/fit-in/1200x0/marketing/pianote/products/practice-kit/share-image.jpg"
        style="display: none;">
    <meta property="og:url" content="https://www.pianote.com/{{ Request::path() }}">
    <script defer src="https://cdn.jsdelivr.net/npm/@alpinejs/focus@3.x.x/dist/cdn.min.js"></script>


    @include('_partials.layout._fonts')
    <link rel="stylesheet" href="{{ mix('marketing/css/app.css') }}">
    <link href="{{ asset('/marketing/css/tailwind-helpers.css') }}" rel="stylesheet">
    <link href="{{ asset('/marketing/parcel/drumeo/nav-footer-pianote.css') }}" rel="stylesheet">
    <link href="{{ asset('/marketing/parcel/drumeo/30dd.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@splidejs/splide@4.1.4/dist/css/splide.min.css">

    <style>

        header {
            background-image: url('https://d21q7xesnoiieh.cloudfront.net/fit-in/850x0/filters:quality(95)/marketing/pianote/products/practice-kit/header-bg-m.webp');
            background-size: cover;
        }

        @media (min-width: 639px) {
            header {
                background-image: url('https://d21q7xesnoiieh.cloudfront.net/fit-in/2500x0/filters:quality(95)/marketing/pianote/products/practice-kit/header-bg.webp');
                background-size: cover;
            }
        }

        .info-pop {
            position: absolute;
        }
        .info-pop:after, .info-pop:before {
            position: absolute;
            transform: translate(-50%, 0);
            height: auto;
            max-height: 0;
            visibility: hidden;
            opacity: 0;
            transition: all .3s;
            overflow: hidden;
            font-size: 14px;
        }
        .info-pop:before {
            z-index: 100;
            content: "";
            bottom: 23px;
            left: 50%;
            border-right: 7px transparent solid;
            border-left: 7px transparent solid;
            border-top: 7px solid #fff;
        }
        .info-pop:after {
            padding: 5px 8px;
            content: attr(tip);
            font-size: 14px;
            text-align: left;
            color: #000;
            width: 220px;
            border-radius: 8px;
            background: #fff;
            box-shadow: 0 0 5px rgba(0, 0, 0, 0.25);
            bottom: 30px;
            left: -300%;
        }
        .info-pop:hover, .info-pop:active, .info-pop:focus {
            z-index: 100;
        }
        .info-pop:hover:after, .info-pop:hover:before, .info-pop:active:after, .info-pop:active:before, .info-pop:focus:after, .info-pop:focus:before {
            max-height: 1000px;
            visibility: visible;
            opacity: 1;
            display: block;
        }
    </style>
@stop()

@section('global-body')
    @include('pianote.sales.partials._nav', [
        'cartVersion' => true,
    ])
   
    <header class="px-5 sm:px-6 pt-72 pb-12 sm:py-20 lg:py-36 bg-top" style="background-color:#F1F7FE;">
        <div class="container max-w-4xl mx-auto">
            <div class="flex flex-wrap sm:flex-nowrap items-center mt-28 sm:mt-0">
                <div class="w-full sm:w-5/12 text-center lg:text-left">
                    <img class="h-24 lg:h-28" alt="logo" fetchpriority="high"
                        src="https://d21q7xesnoiieh.cloudfront.net/fit-in/850x0/filters:quality(95)/marketing/pianote/products/practice-kit/logo.webp"
                        alt="Pianote Practice Kit Logo">
                    <h4 class="leading-tight my-4 sm:my-6 text-black">Essential tools to <strong>maximize <br class="md:hidden">your practice time and improve your playing.</strong></h4>
                    <h2 class="mb-4 sm:mb-6">
                        @if (floatval($productPrices['practice-kit']->price) >
                                floatval($productPrices['practice-kit']->discounted_price))
                            <strong><s
                                class="opacity-30">${{ floatval($productPrices['practice-kit']->price) }}</s></strong> 
                            <strong>${{ floatval($productPrices['practice-kit']->discounted_price) }}</strong>
                            <span class="text-pianote text-sm md:text-2xl"> (SAVE
                            {{ round(100 - 100 * (floatval($productPrices['practice-kit']->discounted_price) / floatval($productPrices['practice-kit']->price))) }}%)</span>
                            
                        @else
                            <strong>
                                ${{ floatval($productPrices['practice-kit']->discounted_price) }}</strong>
                        @endif
                    </h2>
                    <a href="/ecommerce/add-to-cart?products[practice-kit]=1"
                        class="join medium w-full">GET YOUR KIT</a>
                </div>
            </div>
        </div>
    </header>
    <section class="text-center px-5 sm:px-6 py-8 sm:py-16 lg:py-20 relative" style="background-color:#FFFFFF">
        <div class="container mx-auto z-10 relative max-w-5xl">
            <h2 class="leading-tight mb-3"><strong> Everything you need for the <br> PERFECT practice.</strong></h2>
            <p class="leading-normal mb-4 text-xs">It’s what’s inside that counts. </p>

            @php
                $items = [
                    [
                        'img' =>
                            'https://d21q7xesnoiieh.cloudfront.net/fit-in/1500x0/filters:quality(95)/marketing/pianote/products/practice-kit/features-01.webp',
                        'desc' =>
                            'It’s one of the hardest things for new piano players. But you can remember the names of the notes without messy stickers with this handy Piano Key Overlay. Simply place the strip on the piano and start playing. Then, remove it once you’ve learned the notes.',
                        'alt' => 'Piano player reading sheet music',
                        'title' => 'Remember the note names.',
                    ],
                    [
                        'img' =>
                            'https://d21q7xesnoiieh.cloudfront.net/fit-in/1500x0/filters:quality(95)/marketing/pianote/products/practice-kit/features-02.webp',
                        'desc' =>
                            'You need to write on your music. Finger numbers, note names, reminders about how to play a certain passage. Inside the PracticeKit you’ll find pencils, erasers, a highlighter PLUS clear sticky notes so you can mark up your music without ruining the score.',
                        'alt' => 'Read Music in 30 Days Workbook',
                        'title' => 'Tools to write and remember.',
                    ],
                    [
                        'img' =>
                            'https://d21q7xesnoiieh.cloudfront.net/fit-in/1500x0/filters:quality(95)/marketing/pianote/products/practice-kit/features-03.webp',
                        'desc' =>
                            'The PracticeKit comes fully-loaded, but it also has room to add the Pianote Chords & Scales Book and the Little Book Bundle. Customize your Kit with added resources to make a truly personalized practice experience.',
                        'alt' => 'Piano and Reading Music Book',
                        'title' => 'Room for your practice books.',
                    ],
                ];
            @endphp
            @foreach ($items as $index => $item)
                <div class="text-left flex flex-col sm:flex-row justify-center items-center md:py-10">
                    @if ($index % 2 == 0)
                        <img class="w-full sm:w-6/12 md:w-7/12 rounded-xl overflow-hidden transition-opacity opacity-0 order-1 sm:order-1"
                            loading="lazy" onload="this.classList.remove('opacity-0')" src="{{ $item['img'] }}" alt="{{ $item['alt'] }}">
                    @else
                        <img class="w-full sm:w-6/12 md:w-7/12 rounded-xl overflow-hidden transition-opacity opacity-0 order-1 sm:order-2"
                            loading="lazy" onload="this.classList.remove('opacity-0')" src="{{ $item['img'] }}" alt="{{ $item['alt'] }}">
                    @endif

                    <div class="flex flex-row md:flex-col sm:flex-1 justify-center items-start py-4 {{ $index % 2 == 0 ? 'sm:pl-4 md:pl-10' : 'sm:pr-4 md:pr-10' }} order-2 sm:order-1">
                        <div>
                            <h4 class="leading-tight mx-0 my-2 sm:my-4"><strong>{{ $item['title'] }}</strong></h4>
                            <p class="leading-normal max-w-xl">{{ $item['desc'] }}</p>
                        </div>
                    </div>
                </div>
            @endforeach

        </div>
    </section>


<section class="text-center px-6 py-8 sm:py-10 lg:py-12" style="background:#F6F5F4;">
    <div class="container mx-auto relative z-10 max-w-6xl">
       <h2 class="pb-4"><strong>Take a look inside your <br class="block md:hidden"> PracticeKit.</strong></h2>
       <p class="hidden md:block pb-4">Everything that’s included. (Tap for more information.)</p>
       <div class="md:hidden">
            @php
                $items = [
                    ['title' => 'PracticeKit case.', 'desc' => 'It fits everything.'],
                    ['title' => '2 Mechanical Pencils', 'desc' => 'for music notation, practice notes, or procrastination doodling.'],
                    ['title' => 'Mechanical Eraser.', 'desc' => 'We know you don’t make mistakes. But just in case…'],
                    ['title' => 'Set of Colored Pencils with Sharpener.', 'desc' => 'Use the colored pencils to highlight key areas of focus. Use one color for your right hand, another for your left, another for dynamics, etc.'],
                    ['title' => 'TwoTone Highlighter.', 'desc' => 'Need a passage to stand out? Choose your color and highlight it.'],
                    ['title' => 'Piano Key Overlay.', 'desc' => 'Remember the note names with this durable rubber overlay. No stickers and no residue. Perfect for beginners.'],
                    ['title' => 'Set of Piano Paperclips.', 'desc' => 'The fun way to mark pages in your music books or bring a little music to your work life.'],
                    ['title' => 'Package of Clear Sticky Notes', 'desc' => 'so you can make notes without marking up your score.'],
                    ['title' => 'Package of Arrow Sticky Notes', 'desc' => 'so you can zoom in on specific sections and point yourself in the right direction.'],
                    ['title' => 'Staff Paper Booklet.', 'desc' => 'Make notes, practice your music theory, or jot down musical ideas. The best piano players don’t just read music. They write it.'],
                    ['title' => 'Package of Pianote Stickers.', 'desc' => 'This is just for fun. Give yourself a star for practicing today!'],
                ];
            @endphp
            <ul class="list-disc text-left px-4 pb-4">
                @foreach ($items as $item)
                    <li>
                        <p class="py-1"><strong>{{ $item['title'] }}</strong> {{ $item['desc'] }}</p>
                    </li>
                @endforeach
            </ul>
            <img src="https://d21q7xesnoiieh.cloudfront.net/fit-in/1000x0/filters:quality(95)/marketing/pianote/products/practice-kit/spread.png"> 
        </div>

        <div class="hidden md:block"> 
            <picture>
                <source media="(min-width: 768px)" srcset="https://d21q7xesnoiieh.cloudfront.net/fit-in/3000x0/filters:quality(95)/marketing/pianote/products/practice-kit/spread.png">
                <img class="rounded-xl" src="https://d21q7xesnoiieh.cloudfront.net/fit-in/1500x0/filters:quality(95)/marketing/pianote/products/practice-kit/spread.png" alt="Pianotr Practice Kit">
            </picture>
        
        @php
            $infoPops = [
                ['top' => '75%', 'left' => '15%', 'tip' => 'PracticeKit case'],
                ['top' => '80%', 'left' => '75%', 'tip' => '2 Mechanical Pencils'],
                ['top' => '90%', 'left' => '83%', 'tip' => 'Mechanical Eraser'],
                ['top' => '90%', 'left' => '40%', 'tip' => 'Set of Colored Pencils with Sharpener'],
                ['top' => '74%', 'left' => '75%', 'tip' => 'TwoTone Highlighter'],
                ['top' => '27%', 'left' => '73%', 'tip' => 'Piano Key Overlay'],
                ['top' => '60%', 'left' => '67%', 'tip' => 'Set of Piano Paperclips'],
                ['top' => '60%', 'left' => '75%', 'tip' => 'Package of Clear Sticky Notes'],
                ['top' => '74%', 'left' => '43%', 'tip' => 'Package of Arrow Sticky Notes'],
                ['top' => '60%', 'left' => '55%', 'tip' => 'Staff Paper Booklet'],
                ['top' => '52%', 'left' => '91%', 'tip' => 'Package of Pianote Stickers'],
            ];
        @endphp
        @foreach ($infoPops as $infoPop)
            <div class="info-pop hidden sm:block cursor-pointer rounded-full w-7 h-7 flex items-center justify-center"
                style="top: {{ $infoPop['top'] }}; left: {{ $infoPop['left'] }};"
                tip="{{ $infoPop['tip'] }}">
               <i class="fa-duotone fa-solid fa-circle-plus text-xl lg:text-2xl" style="--fa-primary-color: #050505; --fa-secondary-color: #ffffff; --fa-secondary-opacity: 0.8; --fa-secondary-box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.2);"></i>
            </div>
        @endforeach
        </div>
    </div>
</section>



    <div id="final" class="anchor"></div>

    <section class="bg-cover bg-center" style="background: url('https://d21q7xesnoiieh.cloudfront.net/fit-in/2500x0/filters:quality(95)/marketing/pianote/products/practice-kit/order-bg.webp');">
        <div class="container max-w-3xl mx-auto py-20 lg:py-40 px-10 md:px-0">
            <div class="flex flex-col items-center">
              <img class="h-24 lg:h-28" alt="logo" fetchpriority="high"
                        src="https://d21q7xesnoiieh.cloudfront.net/fit-in/850x0/filters:quality(95)/marketing/pianote/products/practice-kit/logo.webp"
                        alt="Pianote Practice Kit Logo">
            
                    <h2 class="leading-tight my-4 sm:my-6 text-black text-center">Essential tools to <strong>maximize <br class="md:hidden">your practice time and improve your playing.</strong></h2>
                    <h2 class="mb-4 sm:mb-6">
                        @if (floatval($productPrices['practice-kit']->price) >
                                floatval($productPrices['practice-kit']->discounted_price))
                            <strong><s
                                class="opacity-30">${{ floatval($productPrices['practice-kit']->price) }}</s></strong> 
                            <strong>${{ floatval($productPrices['practice-kit']->discounted_price) }}</strong>
                            <span class="text-pianote text-sm md:text-2xl"> (SAVE
                            {{ round(100 - 100 * (floatval($productPrices['practice-kit']->discounted_price) / floatval($productPrices['practice-kit']->price))) }}%)</span>
                        @else
                            <strong>
                                ${{ floatval($productPrices['practice-kit']->discounted_price) }}</strong>
                        @endif
                    </h2>
                    <a href="/ecommerce/add-to-cart?products[practice-kit]=1"
                        class="join medium w-full sm:w-1/2">GET YOUR KIT</a>
            </div>
        </div>
    </section>

    @include('pianote.sales.partials._footer')

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script type="text/javascript" src="{{ asset('/marketing/js/modal.js') }}"></script>
    <script type="text/javascript" src="{{ asset('/marketing/parcel/drumeo/navigation-sales.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/@splidejs/splide@4.1.4/dist/js/splide.min.js"></script>

@stop
