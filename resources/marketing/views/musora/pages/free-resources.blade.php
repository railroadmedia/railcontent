@extends('musora._partials.layout')

@section('head-includes')
    <title>Musora | The Free Stuff</title>
    <meta property="og:title" content="Musora | The Free Stuff">

    <meta name="description" content="Sign up to get access to FREE lessons, giveaways, exclusive discounts and any other cool stuff we do.">
    <meta property="og:description" content="Sign up to get access to FREE lessons, giveaways, exclusive discounts and any other cool stuff we do.">

    <meta property="og:url" content="https://www.musora.com/{{ Request::path() }}">
    <meta property="og:image" content="https://d21q7xesnoiieh.cloudfront.net/fit-in/1200x0/filters:quality(95)/marketing/musora/membership/homepage/2023/share-image3.jpg">

    <style>
        h5 {
            font-size:15px
        }

        @media (min-width:768px) {
            h5 {
                font-size:18px
            }
        }

        @media (min-width:1024px) {
            h5 {
                font-size:20px
            }
        }
    </style>
    <style>

        [placeholder]:focus::-webkit-input-placeholder {
            color:transparent
        }

        form ::-webkit-input-placeholder, form ::-moz-placeholder, form :-ms-input-placeholder, form :-moz-placeholder {
            color:#777
        }

        .giveaway-form input, .giveaway-form button {
            font:400 18px/45px "Open Sans", sans-serif;
            height:45px;
            color:#999;
            border-radius:100px;
            padding:7px 20px;
            margin:0 auto 10px;
            transition:all .2s ease-in;
            box-shadow:none;
            text-align:inherit;
            border: 1px solid;
        }

        @media (min-width:640px) {
            .giveaway-form input, .giveaway-form button {
                font-size:19px;
                margin:0 auto
            }
        }

        @media (min-width:1024px) {
            .giveaway-form input, .giveaway-form button {
                font-size:23px
            }
        }

        .giveaway-form button {
            font-family:"Bebas Neue", sans-serif;
            text-transform:uppercase;
            margin:0 auto!important;
            text-align:center;
            display:block;
            cursor:pointer;
            border:none;
            width:100%;
            padding:0;
            color:#fff;
        }
        .giveaway-form input, .giveaway-form button {
            line-height:40px;
            height: 40px;
        }
        @media (min-width: 40em) {
            .giveaway-form input, .giveaway-form button {
                height: 52px;
                line-height: 52px;
            }
        }
        .thank-you-box.active {
            max-height:1000px;
            visibility:visible;
            opacity:1;
            padding:10px;
        }
        @media (min-width: 40em) {
            .thank-you-box.active {
                padding: 12px;
            }
        }
        .giveaway-form input {
            margin-bottom: 8px;
        }
    </style>
@endsection


<!-- Main -->
@section('layout-body')

    <div class="container mx-auto max-w-7xl px-4 md:px-10 py-10 md:py-16">
        <header>
            <h1 class="text-3xl md:text-5xl lg:text-7xl"><strong>Free Resources</strong></h1>
            <p class="pb-10">Explore blogs, newsletters, and free tools for insights and productivity.</p>
            <h5 class="border-y border-y-black py-4 mb-7 uppercase tracking-widest font-bold">GIVEAWAY</h5>
        </header>

        <div class="text-white px-3 sm:px-6 lg:px-10 py-6 lg:py-10 mb-5 bg-drumeo rounded-xl" {{--style="background-color:#101520;"--}}>
            <div class="flex flex-col lg:flex-row items-center">
                <div class="w-full lg:w-5/12 lg:pr-8 text-left px-2 sm:px-0 mb-4 lg:mb-0">
                    <img class="w-full max-w-md" style="border-radius: 1.75rem !important;" src="https://d21q7xesnoiieh.cloudfront.net/fit-in/870x0/filters:quality(95)/marketing/musora/lead-gen/youtube/win.jpg">
                </div>
                <div class="w-full lg:w-7/12 text-left giveaway-form">
                    <h2 class="uppercase leading-none mb-2"><strong>Win The Cymbals From<br> Drumeo’s Linkin Park Video</strong></h2>
                    @if(Carbon\Carbon::create(2024, 12, 02, 0, 0, 0, 'America/Vancouver') > Carbon\Carbon::now())
                        <p class="leading-normal mb-1">
                            <strong>Win the ENTIRE set of Istanbul Agop cymbals that Brandon used in our latest video.</strong>
                            <br>
                            Item list:
                        </p>
                        <style>
                            ul {
                                column-count: 2;
                            }
                        </style>
                        <ul class="pl-6 mb-3 list-disc" style="column-gap: 20px;">
                            <li class="leading-tight text-sm mb-1">Istanbul Traditional 10" Splash</li>
                            <li class="leading-tight text-sm mb-1">Istanbul Traditional 15" Medium Hihats</li>
                            <li class="leading-tight text-sm mb-1">Istanbul Traditional 16" Thin Crash</li>
                            <li class="leading-tight text-sm mb-1">Istanbul Traditional 18" Dark Crash</li>
                            <li class="leading-tight text-sm mb-1">Istanbul Traditional 20" Dark Crash</li>
                            <li class="leading-tight text-sm mb-1">Istanbul Xist	18" Ion FX Crash</li>
                            <li class="leading-tight text-sm mb-1">Istanbul Mantra 22" Ride</li>
                        </ul>
                        @include("drumeo.lead-gen.partials.sign-up-form", [
                            "recaptchaKey" => $recaptchaKey,
                            "formName" => 'Cymbal Giveaway',
                            "formId" => "Drumeo - Engagement - Trigger - Cymbal Giveaway - Web Form",
                            "buttonText" => "I WANT TO WIN",
                            "minimalForm" => true,
                            "buttonColor" => "bg-musora text-black",
                            "redirectUrl" => "https://www.musora.com/thank-you",
                        ])
                        <p class="leading-tight text-xs mt-1"><a href="https://musora-image-processing-cdn.s3.us-east-2.amazonaws.com/marketing/musora/lead-gen/youtube/cymblas-t-and-c.pdf"><u>View Terms & Conditions</u></a><br>
                            By signing up you’ll also receive our ongoing free lessons and special offers. Don’t worry, we value your privacy and you can unsubscribe at any time.</p>
                    @else
                        <h4 class="leading-normal mb-1">This giveaway has ended.</h4>
                    @endif
                </div>
            </div>
        </div>

        <div class="text-white px-3 sm:px-6 lg:px-10 py-6 lg:py-10 rounded-xl" style="background-color:#222;">
            <div class="flex flex-col lg:flex-row items-center">
                <div class="w-full lg:w-5/12 lg:pl-8 lg:order-1 text-left px-2 sm:px-0 mb-4 lg:mb-0">
                    <img class="w-full max-w-md" style="border-radius: 1.75rem !important;" src="https://d21q7xesnoiieh.cloudfront.net/fit-in/870x0/filters:quality(95)/marketing/musora/lead-gen/youtube/win2.jpg">
                </div>
                <div class="w-full lg:w-7/12 text-left giveaway-form">
                    <h2 class="uppercase leading-none mb-2"><strong>WIN A COPY OF PHOBIA BY BREAKING BENJAMIN, SIGNED BY CHAD SZELIGA</strong></h2>
                    @if(Carbon\Carbon::create(2024, 12, 07, 0, 0, 0, 'America/Vancouver') > Carbon\Carbon::now())
                    <p class="leading-normal mb-1">
                        <strong>Enter to win one copy of Phobia, signed by former Breaking Benjamin drummer Chad Szeliga.</strong>
                    </p>
                    @include("drumeo.lead-gen.partials.sign-up-form", [
                        "recaptchaKey" => $recaptchaKey,
                        "formName" => 'Phobia Giveaway',
                        "formId" => "Drumeo - Engagement - Trigger - Phobia Giveaway - Web Form",
                        "buttonText" => "I WANT TO WIN",
                        "minimalForm" => true,
                        "buttonColor" => "bg-musora text-black",
                        "redirectUrl" => "https://www.musora.com/thank-you",
                    ])
                    <p class="leading-tight text-xs mt-1"><a href="https://musora-image-processing-cdn.s3.us-east-2.amazonaws.com/marketing/musora/lead-gen/youtube/phobia-t-and-c.pdf"><u>View Terms & Conditions</u></a><br>
                        By signing up you’ll also receive our ongoing free lessons and special offers. Don’t worry, we value your privacy and you can unsubscribe at any time.</p>

                    @else
                        <h4 class="leading-normal mb-1">This giveaway has ended.</h4>
                    @endif
                </div>
            </div>
        </div>

        <h5 class="border-y border-y-black py-4 uppercase tracking-widest font-bold mt-10 md:mt-16 mb-7">Free Video Lessons</h5>
        @php
            $benefits = [
                ['image' => 'https://d21q7xesnoiieh.cloudfront.net/fit-in/1200x0/filters:quality(95)/marketing/musora/lead-gen/youtube/gsotd.webp', 'title' => 'Getting Started On The Drums', 'link' => 'https://www.drumeo.com/getting-started/lessons'],
                ['image' => 'https://d21q7xesnoiieh.cloudfront.net/fit-in/1200x0/filters:quality(95)/marketing/musora/lead-gen/youtube/gsotp.webp', 'title' => 'Getting Started On The Piano', 'link' => 'https://www.pianote.com/getting-started-on-the-piano/lessons'],
                ['image' => 'https://d21q7xesnoiieh.cloudfront.net/fit-in/1200x0/filters:quality(95)/marketing/musora/lead-gen/youtube/iav.webp', 'title' => 'Improve Any Voice', 'link' => 'https://www.singeo.com/improve-any-voice/lessons'],
                ['image' => 'https://d21q7xesnoiieh.cloudfront.net/fit-in/1200x0/filters:quality(95)/marketing/musora/lead-gen/youtube/gsotag.webp', 'title' => 'Getting Started On The Acoustic Guitar', 'link' => 'https://www.guitareo.com/free-acoustic-guitar-lessons/lessons'],
            ];
        @endphp

        <div class="grid grid-col-1 md:grid-cols-2 gap-2 md:gap-5 lg:gap-8 pb-10 md:pb-20">
            @foreach ($benefits as $benefit)
                <div class="text-left">
                    <a href="{{ $benefit['link'] }}" target="_blank">
                        <img src="{{ $benefit['image'] }}" alt="{{ $benefit['title'] }}" class="mx-auto rounded-lg transform hover:scale-[1.02] transition-transform duration-300">
                        <h4 class="mb-6 md:mb-0 mt-2 capitalized font-bold">{{ $benefit['title'] }}</h4>
                    </a>
                </div>
            @endforeach
        </div>

          <section class="px-5 sm:px-6 py-6 rounded-3xl mb-10 lg:mb-20 bg-musora border-2 border-black">
            <div class="flex flex-col lg:flex-row items-center">
                <div class="w-full lg:w-7/12 text-center px-6 flex jusitfy-center flex-col items-center">
                    <h1 class="capitalize leading-tight"><strong>The ultimate music  <br/> lessons experience  <br/> at a special price</strong></h1>
                    <p class="tracking-tight py-4 lg:py-6">
                        An exclusive discount for our YouTube community.
                    </p>
                </div>
                <div class="w-full md:w-1/2 lg:w-5/12 xl:w-4/12 text-center max-w-[400px]">
                @php
                    $annualLink = '/ecommerce/add-to-cart?products[musora-annual-recurring-membership]=1&promo-code=musorayt&locked=true';
                    $points = [
                        '<strong>Learn piano, guitar, drums, & singing.</strong>',
                        '<strong>300+ popular songs.</strong>',
                        '<strong>Unlimited personal support.</strong>',
                        'Join a community of ' .  number_format(Prices::$students)  . ' students.',
                        '90-day money-back guarantee.',
                        'Cancel anytime.'
                    ];
                @endphp

                <div class="w-full px-2 md:px-3 mb-4 md:mb-0 relative text-center">
                    <p class="inline-block relative -bottom-1 mb-1 px-5 py-1 z-10 leading-tight text-xs rounded-full bg-black text-musora border border-black">EXCLUSIVE OFFER</p>
                    <a href="{{ $annualLink }}" class="text-black overflow-hidden rounded-2xl block mx-auto group border-2 border-black" aria-label="Annual Plan">
                        <div class="bg-white px-3 py-6 md:py-9">
                            <h2 class="mb-2 text-3xl lg:text-4xl"><strong>Annual</strong></h2>
                            <h4 class="inline-block leading-tight">
                                <span class="line-through opacity-60">$240</span>
                                <strong class="text-4xl">$180</strong>
                            </h4>
                            <p class="text-sm"><em>Save $60!</em></p>
                            <button class="my-5 py-2 bg-musora text-black w-full rounded-full transition-opacity duration-300 group-hover:opacity-80 max-w-[230px] uppercase font-medium font-bebas text-xl" role="button" tabindex="0">TRY FOR FREE FOR 7 DAYS</button>
                            @foreach ($points as $point)
                                <p class="text-sm mb-1.5">{!! $point !!}</p>
                            @endforeach
                        </div>
                    </a>
                </div>
                </div>
            </div>
        </section>
     <section class="">
        <div class="flex flex-col lg:flex-row gap-16 md:gap-8 justify-between items-start relative">
            <div class="flex flex-col justify-evenly gap-4 w-full lg:w-5/12">
                <h5 class="border-y border-y-black py-4 uppercase tracking-widest font-bold">YouTube Channels</h5>
                <div class="flex flex-col space-y-4">
                    <a href="https://www.youtube.com/@MusoraMedia" class="bg-musora text-white font-bold py-16 lg:py-14 rounded-2xl text-center transition-all duration-300 hover:opacity-90 cursor-pointer">
                        <div class="relative">
                            <img src="https://d21q7xesnoiieh.cloudfront.net/fit-in/1000x0/filters:quality(95)/marketing/musora/lead-gen/youtube/logo-light.svg" alt="Musora Logo" class="h-6">
                        </div>
                    </a>
                    <a href="https://www.youtube.com/freedrumlessons/" class="bg-drumeo text-white font-bold py-20 md:py-14 rounded-2xl text-center transition-all duration-300 hover:opacity-90 cursor-pointer">
                        <div class="relative">
                            <img src="https://d21q7xesnoiieh.cloudfront.net/fit-in/1000x0/filters:quality(95)/marketing/musora/lead-gen/youtube/drumeo.svg" alt="Drumeo Logo" class="h-8">
                        </div>
                    </a>
                    <a href="https://www.youtube.com/pianoteofficial" class="bg-pianote text-white font-bold py-20 md:py-14 rounded-2xl text-center transition-all duration-300 hover:opacity-90 cursor-pointer">
                        <div class="relative">
                            <img src="https://d21q7xesnoiieh.cloudfront.net/fit-in/1000x0/filters:quality(95)/marketing/musora/lead-gen/youtube/pianote.svg" alt="Pianote Logo" class="h-8">
                        </div>
                    </a>
                </div>
            </div>

            <div class="hidden lg:block w-px bg-black self-stretch"></div>

            <div class="flex flex-col justify-between gap-4 lg:w-6/12">
                <h5 class="border-y border-y-black py-4 uppercase tracking-widest font-bold mb-2">Newsletters</h5>
                    <div class="flex flex-col items-baseline">
                        <a href="/playlist" class="relative bg-cover bg-center mb-6 group block">
                            <img
                                src="https://d21q7xesnoiieh.cloudfront.net/fit-in/1000x0/filters:quality(95)/marketing/musora/lead-gen/youtube/mp.webp"
                                alt="Musora Playlists"
                                class="rounded-2xl transition-transform duration-300"
                            >
                            <i class="fa-regular fa-arrow-up-right absolute top-2 right-2 text-white text-4xl transition-transform duration-300 transform translate-y-0 group-hover:-translate-y-2"></i>
                        </a>

                        <a href="/history" class="relative bg-cover bg-center block group">
                            <img
                                src="https://d21q7xesnoiieh.cloudfront.net/fit-in/1000x0/filters:quality(95)/marketing/musora/lead-gen/youtube/timh.webp"
                                alt="Today in Music History"
                                class="rounded-2xl transition-transform duration-300"
                            >
                            <i class="fa-regular fa-arrow-up-right absolute top-2 right-2 text-white text-4xl transition-transform duration-300 transform translate-y-0 group-hover:-translate-y-2"></i>
                        </a>
                    </div>
            </div>
        </div>
    </section>
</div>

@stop
