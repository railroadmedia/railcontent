@extends('drumeo._partials.global-layout')

@section('global-head')
    <title>Beyond Beginner Drumming | Drumeo</title>
    <meta property="og:title" content="Beyond Beginner Drumming">
    <meta name="description" content="Make the jump from beginner to intermediate drummer.">
    <meta property="og:description" content="Make the jump from beginner to intermediate drummer.">
    <meta property="og:image" content="https://cdn.musora.com/image/fetch/w_1200,q_auto:best/https://drumeo-assets.s3.amazonaws.com/drum-shop/beyond-beginner-drummer/Title+Banner.jpg" style="display: none;">
    <meta property="og:url" content="https://www.drumeo.com/{{ Request::path() }}">

    @include('_partials.layout._fonts')

    @include('_partials.layout._tailwindcdn')
    <link href="{{ asset('/marketing/css/drumeo/tailwind-helpers.css') }}" rel="stylesheet">
    <link href="{{ asset('/marketing/parcel/drumeo/navigation-sales.css') }}" rel="stylesheet">
    <link href="{{ asset('/marketing/parcel/drumeo/ndsh.css') }}" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick.min.css"/>
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick-theme.min.css"/>
    <link rel="stylesheet" href="{{ asset('/marketing/css/animate.css') }}">
    <style>
        header:after,
        .jared-bio:after  {
            content:none;
        }
        header {
            background-size: 1200px;
        }
        @media (min-width: 768px) {
            header {
                background-size: 1300px;
            }

        }
        @media (min-width: 1024px) {
            header {
                background-size: 1600px;
            }

        }
        .dropdown .bg-pred {
            min-width: 32px;
        }
        @media (min-width: 40em) {
            .dropdown .bg-pred {
                min-width: 83px;
            }
        }
        .dropdown .description {
            height: 0;
            max-height: 0;
            visibility: hidden;
            opacity: 0;
            overflow: hidden;
        }
        .dropdown.active .description {
            visibility: visible;
            opacity: 1;
            height: auto;
            max-height: 400px;
        }

    </style>
@stop

@section('global-body')
    @include("drumeo.sales.partials._nav", [
        "cartVersion" => true
    ])
    @include('drumeo.products.partials.promo-banner', [
                    "name" => "Beyond Beginner Drumming",
                    "fullPrice" => floatval($productPrices['beyond-beginner-drumming']->price),
                    "price" => floatval($productPrices['beyond-beginner-drumming']->discounted_price),
                "noBreadcrumb" => true
                ])

    <header class="text-center text-white py-5 md:py-10 px-4 bg-top bg-no-repeat relative" style="background-color:#00101d;background-image: url(https://cdn.musora.com/image/fetch/w_2500,q_auto:best/https://drumeo-assets.s3.amazonaws.com/drum-shop/beyond-beginner-drummer/Header_BG.jpg);">
        <div class="container mx-auto relative z-10">
            <img class="h-12 sm:h-16 lg:h-20" src="https://cdn.musora.com/image/fetch/w_1200,q_auto:best/https://drumeo-assets.s3.amazonaws.com/drum-shop/beyond-beginner-drummer/BeyondBeginnerDrumming_Logo.svg"><br>
            <i class="fas fa-play play-button autoplay-video mt-36 lg:mt-44 mb-5 md:mb-12" data-open="trailer"></i>
            <h2><strong>Make the jump from beginner to<br> intermediate drummer.</strong></h2>
            <img class="mt-1 h-10 sm:h-14 lg:h-16" src="https://drumeo-assets.s3.amazonaws.com/drum-shop/beyond-beginner-drummer/with+Siros+Vaziri.svg"><br>
            <a class="join blue my-3 md:my-4 w-full max-w-xl" href="/ecommerce/add-to-cart?products[beyond-beginner-drumming]=1">Get Started</a>
            <h6>ONLY @if(floatval($productPrices['beyond-beginner-drumming']->price) > floatval($productPrices['beyond-beginner-drumming']->discounted_price)) <s class="opacity-60">${{ floatval($productPrices['beyond-beginner-drumming']->price) }}</s> @endif
                <strong class="text-yellow-400">${{ floatval($productPrices['beyond-beginner-drumming']->discounted_price) }} {{--Launch Special--}}</strong></h6>
        </div>
    </header>


    <section class="text-white py-8 sm:py-14 lg:py-20 px-4 sm:px-10 relative lazyload bg-cover bg-center" style="background-color:#020d1f;" data-bg="https://cdn.musora.com/image/fetch/w_2000,q_auto:best/https://drumeo-assets.s3.amazonaws.com/drum-shop/beyond-beginner-drummer/Intro_BG.jpg">
        <div class="container mx-auto max-w-5xl relative z-10">
            <div class="md:flex flex-wrap md:w-7/12">
                <h3 class="mx-0 mb-3"><strong>Take your drumming &<br> musicianship to the next level.</strong></h3>
                <p class="text-light-navy">It’s hard to improve if you don’t know what to work on.
                    <br><br>
                    And the exercises that will have the biggest impact on your playing are different at each level of your drumming journey (beginner, intermediate, advanced).
                    <br><br>
                    So online educator, Siros Vaziri, put together the ultimate course to help you determine where you’re currently at and what’s holding you back. You’ll hear (and see) the exact differences between beginner & intermediate playing and have clear assignments to evolve to the next level.
                    <br><br>
                    By the end of this course, you’ll have all the tools you need to practice & perform like an intermediate drummer – so you can set your sights on advanced.</p>
            </div>
        </div>
    </section>
    <section class="text-center text-white px-3 sm:px-5 py-10 md:py-20 px-4 sm:px-10 relative overflow-hidden" style="background:#031727;">
        <div class="container mx-auto z-10 relative max-w-5xl">
            <h2><strong>You’ll know exactly<br class="inline sm:hidden"> what to work on next.</strong></h2>
            <p class="text-light-navy mt-2 mb-10">Beyond Beginner Drumming goes through your playing skill by skill<br class="hidden sm:inline">
                and shows you how to develop into an intermediate drummer.</p>

            @php
                $levels = [
                    [
                    "level" => "1",
                    "title" => "Intro & Expectations",
                    "description" => "You’ll start by setting realistic goals and expectations for yourself in the course. This is key to getting the most out of your investment in developing your skills.",
                    ],
                    [
                    "level" => "2",
                    "title" => "The Intermediate Drummer’s Mindset",
                    "description" => "Beginner drummers are deterministic – everything is black or white. As you evolve into an intermediate drummer, you’ll start to operate in the shades of grey. That’s where creativity lies!",
                    ],
                    [
                    "level" => "3",
                    "title" => "Ergonomics and Setup",
                    "description" => "As an intermediate, you’re going to be spending more time behind your kit. That’s why setting things up so the drums work for you is crucial. Siros will show you how to have an efficient & musical setup.",
                    ],
                    [
                    "level" => "4",
                    "title" => "Grip & Hand Technique",
                    "description" => "New drummers tend to grip the sticks too tightly. Siros will cover the grip techniques that intermediate & advanced drummers use and give you exercises that will make them second nature.",
                    ],
                    [
                    "level" => "5",
                    "title" => "Accuracy",
                    "description" => "Develop your visual & auditory skills by learning the different sounds you can get out of your drum set. Siros will show you how to strike consistently and become more musical.",
                    ],
                    [
                    "level" => "6",
                    "title" => "Foot Technique",
                    "description" => "Foot technique is one of the key areas that separate beginner and intermediate drummers. You’ll learn techniques to increase your foot speed & endurance and the musical context to use them in.",
                    ],
                    [
                    "level" => "7",
                    "title" => "Subdivisions",
                    "description" => "It’s time to dive deeper into what the drums bring to a song. By understanding subdivisions, you’ll know how to play in a variety of pulses & tempos that have a major impact on the music.",
                    ],
                    [
                    "level" => "8",
                    "title" => "Counting & Keeping Time",
                    "description" => "Now that you understand they theory of subdivisions, you can start to develop your internal clock. This lesson gives you techniques to count and/or internalize the rhythm of a song.",
                    ],
                    [
                    "level" => "9",
                    "title" => "Time Signatures",
                    "description" => "Time signatures are how you drummers organize time and space. By understanding time signatures, you’ll learn how to structure your drum beats and navigate any song.",
                    ],
                    [
                    "level" => "10",
                    "title" => "Double Strokes",
                    "description" => "Improving your double stroke technique is the key to unlocking the next level of your drumming. You’ll learn how to develop silky smooth doubles so you can move around the kit more efficiently.",
                    ],
                    [
                    "level" => "11",
                    "title" => "Rudiments & Stickings",
                    "description" => "As an intermediate, you’ll start to harness the creative power of rudiments. Siros will show you the most applicable four rudiments and how you can use them musically & functionally around the kit.",
                    ],
                    [
                    "level" => "12",
                    "title" => "Dynamics",
                    "description" => "This is what really separates beginners from intermediates. Beginners play within a very narrow dynamic range – and as you evolve into an intermediate you will expand into louder & softer dynamics that open up your musical possiblities.",
                    ],
                    [
                    "level" => "13",
                    "title" => "Rimshots & Accents",
                    "description" => "Now that you understand dynamics it’s time to learn techniques to execute. Rimshots & accents are your tools to play LOUDER and softer on command.",
                    ],
                    [
                    "level" => "14",
                    "title" => "Ghost Notes Part 1",
                    "description" => "Going deeper into dynamics we have ghost notes. These are whisper-quiet notes that add flavor and style to your drumming. When incorporated into grooves, they open up hundreds of musical possibilities.",
                    ],
                    [
                    "level" => "15",
                    "title" => "Ghost Notes Part II",
                    "description" => "Part II of ghost notes will explore more techniques you can use when applying these in a musical context.",
                    ],
                    [
                    "level" => "16",
                    "title" => "Independence",
                    "description" => "Beginners are still developing their coordination on the drums. In this module, Siros will show you techniques to take your drum set independence to the next level and further untangle your limbs.",
                    ],
                    [
                    "level" => "17",
                    "title" => "Improvisation",
                    "description" => "Improvisation is making music by yourself on the drums – and it’s something that seems unattainable at the beginner level. Siros will discuss how to approach improvisation and exercises to refine yours.",
                    ],
                    [
                    "level" => "18",
                    "title" => "Genres & Style",
                    "description" => "In this module, you will A/B listen to a beginner vs. intermediate style of drumming on the same song. Siros points out all the differences that separate a beginner from an intermediate so you can audit your own playing.",
                    ],
                    [
                    "level" => "19",
                    "title" => "Getting Out Of A Rut",
                    "description" => "The more you drum, the easier it is to plateau and feel “stuck.” Siros will give you a few techniques to stay motivated & inspired on your path to becoming an intermediate drummer.",
                    ],
                    [
                    "level" => "20",
                    "title" => "What’s Next",
                    "description" => "You won’t be left hanging. Siros will discuss what the future looks like as an intermediate drummer and how you can continue to progress.",
                    ],
                ]
            @endphp
            @foreach($levels as $level)
                <div class="dropdown text-center border-2 border-gray-500 rounded-md overflow-hidden flex cursor-pointer mb-3 select-none @if(!empty($level['defaultOpen'])) active @endif
                @if(!empty($level['navyBorder'])) border-navy-600 @endif">
                    <div class="bg-drumeo py-5 px-2 sm:px-3 ">
                        <h5 class="leading-tight whitespace-nowrap inline-flex items-center">
                            <span class="text-xs hidden md:inline mr-1"> LEVEL</span>
                            <strong>{{ $level['level'] }}</strong>
                        </h5>
                    </div>
                    <div class="py-5 px-3 md:px-4 text-left flex-grow">
                        <div class="flex items-center text-left flex-col sm:flex-row relative">
                            <h5 class="leading-tight flex-grow w-full sm:w-auto"><strong>{!! $level['title'] !!}</strong></h5>
                            @if(!empty($level['meta']))
                                <p class="inline-flex text-light-navy w-full sm:w-auto">
                                    <em><strong> {!!  $level['meta'] !!} </strong></em>
                                </p>
                            @endif
                        </div>
                        @if(!empty($level['description']))
                            <p class="description leading-normal transition-all duration-300 overflow-hidden opacity-0 h-0 max-h-0 invisible text-light-navy">
                                <br>
                                {!! nl2br( $level['description']) !!}
                            </p>
                        @endif
                    </div>
                    @if(!empty($level['description']))
                        <div class="py-5 px-2 sm:px-3 ml-auto">
                            <i class="text-sm sm:text-xl @if(!empty($level['navyBorder'])) text-light-navy @endif fas fa-chevron-down transform transition-all duration-300 @if(!empty($level['defaultOpen'])) rotate-180 @endif"></i>
                        </div>
                    @endif
                </div>
            @endforeach
        </div>
    </section>
    <section class="text-white py-7 md:py-10 lg:py-16 relative" style="background-color:#00101d;">
        <div class="absolute inset-0 z-0 bg-top bg-no-repeat jared-bio lazyload hidden md:block" data-bg="https://cdn.musora.com/image/fetch/w_3000,q_auto:best/https://drumeo-assets.s3.amazonaws.com/drum-shop/beyond-beginner-drummer/Coach_BG.jpg" style="background-size: cover;background-color:#020d1f;"></div>
        {{--<div class="absolute inset-0 z-0 bg-top bg-no-repeat jared-bio lazyload block md:hidden" data-bg="https://cdn.musora.com/image/fetch/w_800,q_auto:best/https://drumeo-assets.s3.amazonaws.com/drum-shop/beyond-beginner-drummer/Coach_BG.jpg" style="background-color:#020d1f;"></div>--}}
        <div class="container mx-auto max-w-5xl relative z-10 px-4">
            <div class="md:flex flex-wrap w-full sm:w-7/12 lg:w-1/2 ml-auto order-1">
                <h3 class="mx-0"><strong>Who is Siros Vaziri?</strong></h3>

                <p class="text-light-navy my-3 sm:my-5">Siros Vaziri is a professional independent drummer & educator from Mariestad, Sweden. Born in 1995, he is an avid drum teacher, content creator, drum clinician, and studio drummer.
                    <br><br>
                    At the center of his career lies his bite-sized drum lessons and other educational content on social media, where he's a highly visible and familiar name to drummers worldwide with over 500,000 followers in total. His popular Drum Camps in his hometown in Sweden have also become a big part of his career, with many drummers returning every year to participate.
                    <br><br>
                    Outside of his social media endeavors and local Drum Camps, Siros also keeps busy with studio session work and the occasional live gig. Past merits include performing abroad with legendary Iranian singer Aref Arefkia and touring all over Sweden with an established tribute band.</p>
                <div class="flex w-full text-center">
                    <div class="w-1/3">
                        <i class="fab fa-instagram text-4xl" style="background: linear-gradient(30deg, #FFD521 17%, #F20008 50%, #B900B4 83%);-webkit-background-clip: text;-webkit-text-fill-color: transparent;"></i>
                        <h2 class="my-1"><strong>250k</strong></h2>
                        <h6 class="uppercase">Followers</h6>
                    </div>
                    <div class="w-1/3">
                        <i class="fab fa-youtube text-4xl" style="color:#cd201f;"></i>
                        <h2 class="my-1"><strong>50k</strong></h2>
                        <h6 class="uppercase">Subscribers</h6>
                    </div>
                    <div class="w-1/3">
                        <i class="fab fa-facebook text-4xl" style="color:#3b5998;"></i>
                        <h2 class="my-1"><strong>257k</strong></h2>
                        <h6 class="uppercase">Followers</h6>
                    </div>
                </div>
            </div>
        </div>
    </section>


    <div id="customize-anchor" class="anchor"></div>
    <section class="final text-center text-white py-10 md:py-20 lg:py-24 px-4 bg-center bg-cover lazyload" style="background-color:#051626;" data-bg="https://cdn.musora.com/image/fetch/w_1500,q_auto:best/https://drumeo-assets.s3.amazonaws.com/drum-shop/beyond-beginner-drummer/Order_BG.jpg">
        <div class="container mx-auto">
            <img class="logo" src="https://cdn.musora.com/image/fetch/w_1200,q_auto:best/https://drumeo-assets.s3.amazonaws.com/drum-shop/beyond-beginner-drummer/BeyondBeginnerDrumming_Logo.svg"><br>
            <h2 class="mt-5"><strong>Make the jump from beginner to<br> intermediate drummer.</strong></h2>
            <img class="mt-1 h-10 sm:h-14 lg:h-16" src="https://drumeo-assets.s3.amazonaws.com/drum-shop/beyond-beginner-drummer/with+Siros+Vaziri.svg"><br>
            <a class="join blue my-3 md:my-4 w-full max-w-xl" href="/ecommerce/add-to-cart?products[beyond-beginner-drumming]=1">Get Started</a>
            <h6>ONLY @if(floatval($productPrices['beyond-beginner-drumming']->price) > floatval($productPrices['beyond-beginner-drumming']->discounted_price)) <s class="opacity-60">${{ floatval($productPrices['beyond-beginner-drumming']->price) }}</s> @endif
                <strong class="text-yellow-400">${{ floatval($productPrices['beyond-beginner-drumming']->discounted_price) }} {{--Launch Special--}}</strong></h6>
        </div>
    </section>
    <section class="text-white py-7 md:py-10 lg:py-16 relative text-center" style="background: #0c1429;">
        <div class="container mx-auto relative z-50">
            <div class="inline-block w-full px-3 md:px-4 mb-5 text-light-navy">
                <p><strong>Any Questions?</strong><br>
                    Call us toll-free at
                    <a href="tel:+18004398921">1-800-439-8921</a> <br class="inline-block md:hidden"> or directly at
                    <a href="tel:+16048557605">1-604-855-7605</a>.<br> All prices listed in USD. </p>
            </div>
            <div class="inline-block w-full px-3 md:px-4 text-light-navy" style="margin-top: 0;">
                <i class="mx-0.5 text-3xl md:text-4xl fab fa-cc-visa"></i>
                <i class="mx-0.5 text-3xl md:text-4xl fab fa-cc-mastercard"></i>
                <i class="mx-0.5 text-3xl md:text-4xl fab fa-cc-amex"></i>
                <i class="mx-0.5 text-3xl md:text-4xl fab fa-cc-paypal"></i>
                <i class="mx-0.5 text-3xl md:text-4xl fab fa-cc-discover"></i>
            </div>
        </div>
    </section>

    <div class="reveal large" id="trailer" data-reveal data-reset-on-close="false">
        <div class="aspect-16:9 w-full relative">
            <iframe class="absolute w-full h-full reset-on-close" src="" data-lazy-load-url="//player.vimeo.com/video/718050293?autoplay=1" frameborder="0" allowfullscreen allow="autoplay"></iframe>
        </div>
    </div>


    @include("drumeo.sales.partials._footer")

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="{{ asset('/marketing/parcel/drumeo/navigation-sales.js') }}"></script>
    <script type="text/javascript" src="{{ asset('/marketing/js/modal.js') }}"></script>

    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/countup.js/1.9.3/countUp.min.js"></script>
    <script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/lazysizes/5.3.2/lazysizes.min.js"></script>
    <script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/lazysizes/5.3.2/plugins/unveilhooks/ls.unveilhooks.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick.min.js"></script>
    <script>
        $(document).ready(function () {
            $(document).foundation();
            $('.dropdown').on('click', function(){
                $(this).toggleClass('active');
                $(this).find('i').toggleClass('rotate-180');
            });
        });
    </script>
    <script type="text/javascript" src="{{ asset('/marketing/js/modal-autoplay.js') }}"></script>
@stop
