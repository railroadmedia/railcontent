@extends('musora._partials.layout')

@section('head-includes')
    <title>6 Reasons Online Music Lessons Will Help Your Learn Faster | Musora</title>
    <meta property="og:title" content="6 Reasons Online Music Lessons Will Help Your Learn Faster | Musora">

    <meta name="description" content="Online music lessons have grown in popularity because they work!">
    <meta property="og:description" content="Online music lessons have grown in popularity because they work!">

    <meta property="og:url" content="https://www.musora.com/{{ Request::path() }}">
    <meta property="og:image" content="https://dmmior4id2ysr.cloudfront.net/homepage/2023/share-image3.jpg">

    <script src="https://www.google.com/recaptcha/api.js?onload=vueRecaptchaApiLoaded&render=explicit" async defer></script>
    <link href="{{ asset('/marketing/parcel/drumeo/sales-2020.css') }}" rel="stylesheet">
    <style>
        a {
            color:inherit!important;
        }

        .join {
            display:inline-block;
            font:500 22px/1em 'Bebas Neue', sans-serif;
            letter-spacing:0.1em;
            text-transform:uppercase;
            background:#0c1524;
            border-radius:50px;
            color:#fff;
            padding:17px 7%;
            outline:none;
            cursor:pointer;
            text-align:center;
            user-select:none;
            text-decoration:none;
            transition:background-color 0.3s, color 0.3s, opacity 0.3s;
            box-shadow:0 0 0 rgba(0, 0, 0, 0.35);
        }

        @media (min-width:768px) {
            .join {
                font-size:30px;
            }
        }

        .join:hover, .join:focus {
            color:#fff;
            background:#14233d;
            box-shadow:0 0 7px rgba(0, 0, 0, 0.35);
        }
        .join i {
            transition:all .3s;
            position:relative;
            right:0px;
        }
        .join:hover i {
            right:-3px;
        }

        .join.smaller {
            padding:8px 30px;
            font-size:16px;
        }

        @media (min-width:768px) {
            .join.smaller {
                font-size:18px;
                padding:11px 30px;
            }
        }

        .join.musora-gold {
            background-color:#FFAE00;
            color:#000;
        }

        .join.musora-gold:hover, .join.musora-gold:focus {
            background:#FFAE00;
            color:#000;
        }

        .text-musora-black {
            color:#0c1524;
        }

        .text-musora,
        .text-musora-gold {
            color:#FFAE00;
        }
        .splide__pagination__page.is-active {
            background:#01050F;
            transform:none !important;
        }

        .splide__pagination__page {
            margin:3px 10px !important;
            opacity:1 !important;
        }

        @media (min-width:768px) {
            .splide__pagination__page {
                margin:3px 6px !important;
            }
        }

        .splide__arrow svg {
            fill:#FFAE00 !important;
        }
        p strong {
            font-weight:900;
        }
    </style>
@endsection

@section('body-class', 'dark')

<!-- Main -->
@section('layout-body')
    <section class="text-center px-5 sm:px-6 py-10 sm:py-16 lg:py-20 relative overflow-hidden" style="background:linear-gradient(to bottom, #fff 40%, #F1EFED);">
        <div class="container max-w-xs sm:max-w-6xl mx-auto relative z-20">
            <img
                class="h-36 sm:h-40 lg:h-44 mb-3 sm:mb-4 transition-opacity opacity-0"
                src="https://www.musora.com/musora-cdn/image/width=600,quality=95/https://dmmior4id2ysr.cloudfront.net/moderators/logo.svg"
                alt="logo"
                loading="lazy"
                onload="this.classList.remove('opacity-0')"
            >
            <br>
            <h1 class="relative w-auto inline-block text-3xl sm:text-4xl lg:text-5xl">
                <strong>Moderators<br class="sm:hidden"> at Musora</strong>
            </h1>
            <h6 class="leading-relaxed mt-2 mb-7 sm:mb-14 px-5 sm:px-0 max-w-xs sm:max-w-full">
                Want to find out more about our awesome
                Musora Mod team? Let's get in touch!</h6>
            <a class="sm:mx-1 w-full sm:w-56 join musora-gold smaller anchor-slide" href="#final">Ask A Question <i class="fas fa-arrow-right" style="line-height: 0;"></i></a>
        </div>
    </section>
    <section class="text-center px-5 sm:px-6 py-12 sm:py-14 lg:py-20" style="background-color:#f6f8fc;">
        <div class="container max-w-4xl mx-auto">
            <h2 class="relative w-auto inline-block mb-4 sm:mb-8">
                <strong>Musora<br class="sm:hidden"> Moderator Team</strong>
            </h2>
            <img class="mb-5 h-58 inline sm:hidden"
                src="https://www.musora.com/musora-cdn/image/width=620,quality=95/https://dmmior4id2ysr.cloudfront.net/moderators/collage-top-m2.png"
                alt="learn playing image"
                fetchpriority="high"
            >
            <div class="text-left flex flex-wrap sm:flex-nowrap justify-center items-center mb-5">
                <p class="leading-normal max-w-xl pr-7 mx-0">Hey music maestros! 🎵
                    <br><br>
                    With more than 75,000 active students, our incredible team of volunteer Mods is here to keep the rhythm flowing alongside our Musora Mentors family! As Mods, we're all about jamming with students, helping them unleash their musical mojo and groove to their favorite beats!
                    <br><br>
                    Music is the universal language that adds color and joy to our world. Our Mods embody the spirit of Musora, creating a stage where we can all connect, learn, and grow together.</p>
                <img class="h-72 lg:h-96 hidden sm:inline transition-opacity opacity-0"
                    loading="lazy"
                    onload="this.classList.remove('opacity-0')"
                    src="https://www.musora.com/musora-cdn/image/width=910,quality=95/https://dmmior4id2ysr.cloudfront.net/moderators/collage-top2.png"
                    alt="learn playing image"
                >
            </div>
        </div>
    </section>
    <section class="text-center px-4 sm:px-6 py-12 sm:py-14 lg:py-20">
        <div class="container max-w-4xl mx-auto">
            <h2 class="leading-tight"><strong>So, what makes an<br> awesome Musora Mod?</strong></h2>
            <p class="uppercase mt-2 mb-8 sm:mb-10 opacity-50">It’s someone who:</p>

            <div class="grid grid-cols-1 sm:grid-cols-4 sm:gap-4">
                <div class="flex sm:flex-wrap items-center py-4 sm:pt-0 sm:pb-5 px-3 sm:px-5 mb-2 sm:mb-0 w-full bg-[#f2f0ee] rounded-xl">
                    <div class="w-12 sm:w-full flex-shrink-0 sm:-mt-7 sm:mb-3">
                        <h1><i class="fas fa-music text-musora"></i></h1>
                    </div>
                    <div class="sm:w-full pl-3 sm:pl-0 text-left sm:text-center">
                        <p class="leading-normal"><strong>Keeps rocking</strong> their musical journey.</p>
                    </div>
                </div>
                <div class="flex sm:flex-wrap items-center py-4 sm:pt-0 sm:pb-5 px-3 sm:px-5 mb-2 sm:mb-0 w-full bg-[#f2f0ee] rounded-xl">
                    <div class="w-12 sm:w-full flex-shrink-0 sm:-mt-7 sm:mb-3">
                        <h1><i class="fas fa-party-horn text-musora"></i></h1>
                    </div>
                    <div class="sm:w-full pl-3 sm:pl-0 text-left sm:text-center">
                        <p class="leading-normal">Spreads good vibes <strong>like confetti</strong>.</p>
                    </div>
                </div>
                <div class="flex sm:flex-wrap items-center py-4 sm:pt-0 sm:pb-5 px-3 sm:px-5 mb-2 sm:mb-0 w-full bg-[#f2f0ee] rounded-xl">
                    <div class="w-12 sm:w-full flex-shrink-0 sm:-mt-7 sm:mb-3">
                        <h1><i class="fas fa-star text-musora"></i></h1>
                    </div>
                    <div class="sm:w-full pl-3 sm:pl-0 text-left sm:text-center">
                        <p class="leading-normal">Dives into Collabs, Recitals, and Student Focus <strong>like a true performer</strong>.</p>
                    </div>
                </div>
                <div class="flex sm:flex-wrap items-center py-4 sm:pt-0 sm:pb-5 px-3 sm:px-5 mb-2 sm:mb-0 w-full bg-[#f2f0ee] rounded-xl">
                    <div class="w-12 sm:w-full flex-shrink-0 sm:-mt-7 sm:mb-3">
                        <h1><i class="fas fa-heart text-musora"></i></h1>
                    </div>
                    <div class="sm:w-full pl-3 sm:pl-0 text-left sm:text-center">
                        <p class="leading-normal"><strong>Has a passion for sharing</strong> the magic of music and supporting fellow musicians.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="text-center px-5 sm:px-6 py-12 sm:py-14 lg:py-20" style="background-color:#f2f0ee;">
        <div class="container max-w-4xl mx-auto">

            <h2 class="leading-tight mb-8 sm:mb-10"><strong>What do our funky<br class="sm:hidden"> Mods do?</strong></h2>
            <div class="flex flex-wrap sm:flex-nowrap text-left items-center mb-5 sm:mb-7 lg:mb-10">
                <picture class="w-full sm:w-72 flex-shrink-0">
                    <source media="(min-width:640px)" srcset="https://www.musora.com/musora-cdn/image/width=640,quality=95/https://dmmior4id2ysr.cloudfront.net/moderators/do-images-01.jpg">
                    <img class="w-full mb-5 sm:mb-0 rounded-xl transition-opacity opacity-0" alt="reason image" loading="lazy" onload="this.classList.remove('opacity-0')"
                        src="https://www.musora.com/musora-cdn/image/width=600,quality=95/https://dmmior4id2ysr.cloudfront.net/moderators/do-images-01-m.jpg"
                    >
                </picture>
                <div class="sm:pl-5 lg:pl-8">
                    <p class="leading-tight mb-5"><i class="fas fa-messages text-musora bg-musora-black rounded-full w-9 h-9 text-center align-middle mr-2 leading-9"></i> They create a <strong>harmonious forum</strong> where everyone thrives.</p>
                    <p class="leading-tight mb-5"><i class="fas fa-question text-musora bg-musora-black rounded-full w-9 h-9 text-center align-middle mr-2 leading-9"></i> They <strong>keep the groove going</strong> by responding to questions and messages.</p>
                    <p class="leading-tight mb-5"><i class="fas fa-hand text-musora bg-musora-black rounded-full w-9 h-9 text-center align-middle mr-2 leading-9"></i> They <strong>lend a helping hand</strong> to students in need or guide them to the right resources.</p>
                </div>
            </div>
            <div class="flex flex-wrap sm:flex-nowrap text-left items-center mb-5 sm:mb-7 lg:mb-10">
                <picture class="w-full sm:w-72 flex-shrink-0 sm:order-1">
                    <source media="(min-width:640px)" srcset="https://www.musora.com/musora-cdn/image/width=640,quality=95/https://dmmior4id2ysr.cloudfront.net/moderators/do-images-03.jpg">
                    <img class="w-full mb-5 sm:mb-0 rounded-xl transition-opacity opacity-0" alt="reason image" loading="lazy" onload="this.classList.remove('opacity-0')"
                        src="https://www.musora.com/musora-cdn/image/width=600,quality=95/https://dmmior4id2ysr.cloudfront.net/moderators/do-images-03-m.jpg"
                    >
                </picture>
                <div class="sm:pr-5 lg:pr-8">
                    <p class="leading-tight mb-5"><i class="fas fa-magnifying-glass text-musora bg-musora-black rounded-full w-9 h-9 text-center align-middle mr-2 leading-9"></i> They <strong>sniff out page errors</strong> and send them our way for a quick fix.</p>
                    <p class="leading-tight mb-5"><i class="fas fa-star text-musora bg-musora-black rounded-full w-9 h-9 text-center align-middle mr-2 leading-9"></i> They get an <strong>exclusive backstage pass</strong> to test new features and products.</p>
                    <p class="leading-tight mb-5"><i class="fas fa-megaphone text-musora bg-musora-black rounded-full w-9 h-9 text-center align-middle mr-2 leading-9"></i> They <strong>become ambassadors</strong>, spreading the word about Musora to our groovy community.</p>
                </div>
            </div>
            <div class="flex flex-wrap sm:flex-nowrap text-left items-center">
                <picture class="w-full sm:w-72 flex-shrink-0">
                    <source media="(min-width:640px)" srcset="https://www.musora.com/musora-cdn/image/width=640,quality=95/https://dmmior4id2ysr.cloudfront.net/moderators/do-images-02.jpg">
                    <img class="w-full mb-5 sm:mb-0 rounded-xl transition-opacity opacity-0" alt="reason image" loading="lazy" onload="this.classList.remove('opacity-0')"
                            src="https://www.musora.com/musora-cdn/image/width=600,quality=95/https://dmmior4id2ysr.cloudfront.net/moderators/do-images-02-m.jpg"
                    >
                </picture>
                <div class="sm:pl-5 lg:pl-8">
                    <p class="leading-tight mb-5"><i class="fas fa-handshake-simple text-musora bg-musora-black rounded-full w-9 h-9 text-center align-middle mr-2 leading-9"></i> They handle all student interactions <strong>with respect</strong> and follow Musora's code of conduct.</p>
                    <p class="leading-tight mb-5"><i class="fas fa-book text-musora bg-musora-black rounded-full w-9 h-9 text-center align-middle mr-2 leading-9"></i> They <strong>take the time to become familiar</strong> with every nook and cranny of the Musora Platform.</p>
                    <p class="leading-tight mb-5"><i class="fas fa-clock text-musora bg-musora-black rounded-full w-9 h-9 text-center align-middle mr-2 leading-9"></i> ️They <strong>dedicate a flexible amount of time</strong> each month, like a true stage magician.</p>
                </div>
            </div>
        </div>
    </section>
    <section class="text-center px-5 sm:px-6 py-12 sm:py-14 lg:py-20" style="background-color:#f6f8fc;">
        <div class="container max-w-4xl mx-auto">
            <h2 class="leading-tight"><strong>
                    And what's in it for our <br> sensational Moderators?</strong></h2>
            <p class="uppercase mt-2 mb-8 sm:mb-10 opacity-50">Check out these perks:</p>


            @php
                $songItems = [
                    [
                        'icon' => 'fa-gift',
                        'desc' => '<strong>A special Welcome Package</strong> that will make their musical hearts sing.',
                    ],
                    [
                        'icon' => 'fa-money-bill-wave',
                        'desc' => '<strong>A shopping spree</strong> valued at $240 USD to score some groovy Musora merchandise.',
                    ],
                    [
                        'icon' => 'fa-ticket',
                        'desc' => '<strong>A full Musora+ Membership</strong>, like a golden ticket to a jam-packed concert.',
                    ],
                    [
                        'icon' => 'fa-star',
                        'desc' => "<strong>Priority access</strong> to our electric In Person Live Events, so they're always first in line.",
                    ],
                    [
                        'icon' => 'fa-certificate',
                        'desc' => '<strong>A unique avatar or badge</strong> that proudly showcases their Moderator Status.',
                    ],
                    [
                        'icon' => 'fa-tshirt',
                        'desc' => '<strong>Exclusive early access</strong> to check out the latest Musora merchandise and gear.',
                    ],
                ];
            @endphp
            <div class="flex flex-wrap">
                @foreach ($songItems as $songItem)
                    <div class="w-full sm:w-1/2 mb-6 lg:mb-8">
                        <div class="flex sm:px-5">
                            <div class="w-14 flex-shrink-0">
                                <i class="fas {!! $songItem['icon'] !!} text-3xl sm:text-4xl text-musora"></i>
                            </div>
                            <div class="text-left pl-3">
                                <p>{!! $songItem['desc'] !!}</p>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>


        </div>
    </section>
    <section class="text-center px-5 sm:px-6 py-12 sm:py-14 lg:py-20">
        <div class="container max-w-4xl mx-auto">
            <img class="mb-5 h-40 inline sm:hidden"
                src="https://www.musora.com/musora-cdn/image/width=620,quality=95/https://dmmior4id2ysr.cloudfront.net/moderators/collage-bottom-m2.png"
                alt="learn playing image"
                fetchpriority="high"
            >
            <div class="text-left flex flex-wrap sm:flex-nowrap justify-center items-center mb-5">
                <img class="h-72 lg:h-96 hidden sm:inline transition-opacity opacity-0"
                    loading="lazy"
                    onload="this.classList.remove('opacity-0')"
                    src="https://www.musora.com/musora-cdn/image/width=690,quality=95/https://dmmior4id2ysr.cloudfront.net/moderators/collage-bottom2.png"
                    alt="learn playing image"
                >
                <p class="leading-normal max-w-xl sm:pl-7 lg:pl-10 mx-0">Want to dive deeper into the world of our maestro Mod team that brings the sweet harmony to our musical community? Don't miss your cue, let's connect and make some magical music together! Fill out the form below and let’s chat!
                    <br><br>
                    Keep on jammin’!<br>
                    The Musora Team 🎶</p>
            </div>
        </div>
    </section>

    <div id="final" class="anchor"></div>
    <section class="text-center text-white px-5 sm:px-8 py-12 sm:py-14 lg:py-20" style="background-color:#0c1524;">
        <div class="container max-w-4xl mx-auto">

            <h2 class="leading-tight"><strong>Send us a question!</strong></h2>
            <h6 class="mt-2 mb-8 sm:mb-10">Want to find out more about our awesome Musora Mod team? Let's get in touch!</h6>
            <div class="max-w-3xl mx-auto text-left">
                <contact-email-form-marketing
                    brand="drumeo"
                    captchakey="6LfwMZ4dAAAAALEGLsEUwAqrJLLnec_sSbl72Oqx"
                    email-subject="Support Request From Musora"
                    email-type="support-contact"
                    email-endpoint="{{url()->route('mailora.public.send') }}"
                    email-logo="https://www.musora.com/musora-cdn/image/width=400,quality=95/https://d3fzm1tzeyr5n3.cloudfront.net/musora/logo.png"
                    input-label="Report your issue here.."
                    recipient="support@musora.com"
                    success-message="Your email has been sent!"
                />
            </div>
        </div>
    </section>
@stop


@section('layout-scripts')
    @parent
    <script src="{{ mix('platform/js/manifest.js') }}"></script>
    <script src="{{ mix('platform/js/vendor.js') }}"></script>
    <script src="{{ mix('platform/js/app.js') }}"></script>
@endsection
