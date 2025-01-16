@php
    require_once(resource_path('marketing/views/drumeo/_partials/homepage-data.php'));
@endphp

@extends('drumeo._partials.global-layout')

@section('global-head')
    <title>Save on your lessons and spend more time drumming.</title>
    <meta property="og:title" content="Save on your lessons and spend more time drumming.">
    <meta property="og:url" content="https://www.drumeo.com/{{ Request::path() }}">

    <meta name="description" content="Save $300 compared to a monthly membership!">
    <meta property="og:description" content="Save $300 compared to a monthly membership!">

    <meta property="twitter:image" content="https://musora-image-processing-cdn.s3.us-east-2.amazonaws.com/marketing/drumeo/membership/homepage/2024/twitter-image.webp">
    <meta property="og:image" content="https://d21q7xesnoiieh.cloudfront.net/fit-in/1200x0/filters:quality(95)/marketing/drumeo/membership/homepage/2024/share-image-drumeo.webp">

    <link rel="stylesheet" href="{{ mix('marketing/css/app.css') }}">
    <link href="{{ asset('/marketing/parcel/drumeo/navigation-sales.css') }}" rel="stylesheet">
    <link href="{{ asset('/marketing/css/tailwind-helpers.css') }}" rel="stylesheet">
    <link href="{{ asset('/marketing/parcel/drumeo/sales-2020.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@splidejs/splide@4.1.4/dist/css/splide.min.css">
    <style>
        .splide__pagination__page.is-active {
            background: #01050F;
            transform: none !important;
        }

        .splide__pagination__page {
            margin: 3px 10px !important;
            opacity: 1 !important;
        }

        @media (min-width: 768px) {
            .splide__pagination__page {
                margin: 3px 6px !important;
            }
        }

        .splide__arrow svg {
            fill: #0B76DB !important;
        }

        .splide__slide.is-active .active-bg {
            background-color:#1B2434!important;
            color:#fff!important;
        }
    </style>
@stop

@section('body-data')
    x-data ='{
    lazyLoad: false,
    }'
@endsection

@section('global-body')
    @include("drumeo.sales.partials._nav", [
        "subscriptionVersion" => true,
        "scrollToJoin" => true,
        "hideMenu" => true,
    ])
    @include('musora.sales.components.header-section', [
        'ascension' => true,
        'noSubHeader' => true,
        'noTrailer' => true,
        'video' => 'https://musora-image-processing-cdn.s3.us-east-2.amazonaws.com/marketing/drumeo/membership/homepage/2025/header.mp4',
        'header' => 'SAVE <u style="text-decoration-color: #0B76DB;">$300</u> COMPARED TO<br class="hidden sm:inline"> A MONTHLY MEMBERSHIP',
        'pointOne' => 'Song Breakdowns',
        'pointTwo' => 'Unlimited Drum Lessons',
        'pointThree' => 'Legendary Instructors',
        'pointFour' => '24/7 Support',
        'featured' => [
            [
                'url' => 'https://www.nytimes.com/2024/10/22/arts/music/amplifier-newsletter-music-social-media-accounts.html',
                'src' => 'https://musora-image-processing-cdn.s3.us-east-2.amazonaws.com/marketing/drumeo/membership/homepage/2025/nyt.png',
            ],
            [
                'url' => 'https://www.rollingstone.com/music/music-features/phil-collins-in-the-air-tonight-drum-fill-videos-1106780/',
                'src' => 'https://musora-image-processing-cdn.s3.us-east-2.amazonaws.com/marketing/drumeo/membership/homepage/2025/rs.png',
            ],
            [
                'url' => 'https://www.nme.com/news/music/dream-theater-mike-potnoy-play-pull-me-under-first-time-13-years-3563614',
                'src' => 'https://musora-image-processing-cdn.s3.us-east-2.amazonaws.com/marketing/drumeo/membership/homepage/2025/nme.png',
            ],
        ],
    ])
    @php
        $heading = 'Save on your lessons <br class="hidden sm:block">& spend more time drumming.';
        $subheading = 'A Monthly Membership is great when you’re testing the waters for the first time. But if you love drumming and want all the awesome benefits of a Drumeo Membership for a lower price… an Annual plan is the best option.';
        $gettings = [
            [
                'position' => 'left',
                'desc' => 'Right now, you’ll <strong> save $300</strong> by upgrading to an Annual Membership. That works out to just $15 a month. <br><br>At this price, your drum lessons pay for themselves after 5 months. Keep the extra cash for yourself, or reinvest it into your kit. (Who doesn’t love some new cymbals or a cushy drum throne?) ',
                'alt' => 'Image with prices and savings.',
                'img' => 'marketing/drumeo/membership/ascension/save-02.webp',
            ],
            [
                'position' => 'right',
                'desc' => 'We know how hard it is to learn an instrument. After all, building new skills and forming habits takes a lot longer than a month. So this is the perfect time to set yourself up for success and invest in something that you love for the next year.',
                'alt' => 'Drummer playing drums.',
                'img' => 'marketing/drumeo/membership/ascension/save-01.webp',
            ]
        ];
    @endphp
    @include('musora.sales.components.save-ascension-section', compact('heading', 'subheading', 'gettings'))
    @php
        $gridItems = [
        [
            "image" => "marketing/drumeo/membership/ascension/unlimited.webp",
            "imageM" => "marketing/drumeo/membership/ascension/unlimited-m.webp",
            "title" => "Save On Your First Year",
            "desc" => "Since you’re already a member, this deal is just for you.",
        ],
        [
            "big" => true,
            "image" => "marketing/drumeo/membership/ascension/be-first-to-know.webp",
            "imageM" => "marketing/drumeo/membership/ascension/be-first-to-know-m.webp",
            "title" => "Be First To Know",
            "desc" => "Get free access to all our latest drum challenges.",
        ],
        [
            "big" => true,
            "image" => "marketing/drumeo/membership/ascension/lifetime-bonuses.webp",
            "imageM" => "marketing/drumeo/membership/ascension/lifetime-bonuses-m.webp",
            "title" => "Lifetime Bonuses",
            "desc" => "Keep two of our most popular challenges forever.",
        ],
        [
            "image" => "marketing/drumeo/membership/ascension/24-7-support.webp",
            "imageM" => "marketing/drumeo/membership/ascension/24-7-support-m.webp",
            "title" => "24/7 Personal Support",
            "desc" => "Chat with our mentors & community for help on any topic.",
        ],
        [
            "full" => true,
            'image' => 'marketing/drumeo/membership/ascension/learn-new.webp',
            'imageM' => 'marketing/drumeo/membership/ascension/learn-new-m.webp',
            'title' => 'Learn New Instruments',
            'desc' => 'Taking a break from drums? Try Piano, Guitar, or Singing lessons anytime.',
        ],
    ];
    @endphp
    @include('musora.sales.components.reason-cards-five-section', [
        'bgColor' => '#F6F8FC',
        'header' => 'What You’ll Get For the Next 365 Days',
        'full' => true,
    ])

    @include('musora.sales.components.get-serious-section', [
        'title' => 'Get Serious About Your Drumming',
        'items' => [
            [
                'icon' => 'marketing/drumeo/membership/ascension/icons-01.svg',
                'heading' => 'Start a Lifelong Journey',
                'description' => 'Once a drummer, always a drummer. While you can learn the basics in a month, a year allows you to really develop your skills and play music you never imagined you could.',
            ],
            [
                'icon' => 'marketing/drumeo/membership/ascension/icons-02.svg',
                'heading' => 'Strengthen Your Commitment',
                'description' => 'As Buddy Rich said, "You only get better by playing." Committing to your drum set for a full year is the best way to level up your skills.',
            ],
            [
                'icon' => 'marketing/drumeo/membership/ascension/icons-03.svg',
                'heading' => 'Reach Your Drumming Goals',
                'description' => 'The more time you practice—the better you\'ll become. In a year, you can look <br class="hidden lg:block">back and see how far you\'ve grown as a drummer.',
            ],
        ],
    ])

    @php
        $testimonials = $drumeo['testimonials'];
        $youtube = convertNumber(Prices::$drumeoYoutubeSubsc);
        $facebook = convertNumber(Prices::$drumeoFacebookLikes);
        $instagram = convertNumber(Prices::$drumeoInstagramFollowers);
    @endphp
    @include('musora.sales.components.testimonials-section', [
        'header' => 'drummers',
        'youtubeLink' => 'https://www.youtube.com/freedrumlessons/',
        'facebookLink' => 'https://facebook.com/drumeo/',
        'instagramLink' => 'https://instagram.com/drumeoofficial/',
    ])
    @include('musora.sales.components.guarantee-section', [
        'badge' => 'marketing/drumeo/membership/homepage/2024/guarantee.webp',
        'header' => '<strong>Happy student guarantee.</strong><br>Test-drive your lessons for 90 days. Zero risk.',
        'desc' => 'More than anything we want to make sure you have a POSITIVE experience developing new skills and gaining <br class="hidden lg:block"> confidence with Drumeo. Which is why you’ll have 90 days risk-free to try everything and make sure you love it.',
    ])
    <div id="customize-anchor"></div>
    <section class="py-14 sm:py-24 lg:py-32 relative overflow-hidden text-white text-center customize px-4 lg:px-6"
        style="background: linear-gradient(to bottom, #1D4689 0%, #0C1524 100%);">
        <div class="container mx-auto relative z-50  max-w-3xl ">
            <h1 class="leading-tight font-black">
                Upgrade Now to Save on<br class="hidden sm:inline">
                Your Drumeo Membership.</h1>
            <h5 class="leading-tight my-3 sm:my-4 text-musora">
                <strong>Annual Membership</strong> +<br class="sm:hidden"> 2 Bonuses Worth $254</h5>
            <img class="h-36 sm:h-56 my-4 sm:my-7" src="https://d21q7xesnoiieh.cloudfront.net/fit-in/900x0/filters:quality(95)/marketing/drumeo/membership/ascension/order.webp">


            <div class="promo-footer text-center">
                <h3 class="leading-tight mb-1">
                    <s class="opacity-50">${{ Prices::$plusSubscriptionAnnualFull }}</s>
                    <strong>$180</strong> <span class="text-musora">
                (Save {{ round(100 - (100 * (180 / 240))) }}%)
            </span>
                </h3>

                <p class="text-sm mb-4 sm:mb-6"><em>
                    For your first year, then ${{ Prices::$plusSubscriptionAnnualFull }}/yr.
                    </em>
                </p>

                <a role="link"
                    aria-label="Get Started"
                    class="join drumeo smaller mb-4 md:mb-5 w-full max-w-xs sm:max-w-sm"
                    href="/ecommerce/add-to-cart?products[DLM-1-year]=1&products[30-day-chops]=1&products[30-day-drummer-4]=1&locked=true&promo-code=welcome-back,WBD24"
                >GET Started »</a>

                <p class="text-sm"><em>All prices listed in USD.</em></p>
            </div>
        </div>
    </section>
    @php
        $faqs = [
            [
                "title" => "Is an Annual Membership good for beginners?",
                "desc" => "Yes! An Annual Membership is the best option for beginners if you plan on learning the drums for more than 4 months. It means you'll have access to unlimited lessons for a whole year, PLUS you'll save 62% compared to a monthly plan."
            ],
            [
                "title" => "How much does an Annual Membership cost when it renews?",
                "desc" => "After your first year, an Annual Membership will cost $240 per year, which is still 50% less than what you would pay with a Monthly Drumeo Membership."
            ],
            [
                "title" => "Can I pay for the Annual Membership in installments?",
                "desc" => "Unfortunately, the Annual Membership is paid all at once in full and we do not have payment plans available at this time."
            ],
            [
                "title" => "Will I get a reminder before my Annual Membership renews?",
                "desc" => "Yes, we always send a reminder email to let you know when your annual membership is about to renew."
            ],
            [
                "title" => "Does Drumeo have anything for advanced drummers?",
                "desc" => "Drumeo is the perfect companion for advanced drummers, giving you access to artist courses so you can gain insights and inspiration from the legends – with 200+ artist courses on a variety of topics. Plus, you'll get note-for-note transcriptions for popular songs and practical playback tools, so you can take on any new challenges with confidence."
            ],
            [
                "title" => "Can I really learn drums effectively online in a year?",
                "desc" => "Our challenges have a 4x better completion rate than traditional online learning. That's because we've designed our challenges to be fun and engaging while you're learning new techniques. You don't sit and watch an instructor, we get you playing along so you'll ENJOY doing it and actually level up on the drums in the next year."
            ],
            [
                "title" => "What if I don't have enough time to learn?",
                "desc" => "Because it's all online, you can play drums anytime you want! It's like having a teacher in your pocket (but your teacher is actually awake at 2 am if that's the only time you can practice). Plus, our mentors can set you up with a practice routine that fits your schedule."
            ],
            [
                "title" => "What if I already take drum lessons in person?",
                "desc" => "That's great! Drumeo is the perfect complement to your in-person learning. There are plenty of students who use Drumeo to supplement their in-person lessons."
            ],
            [
                "title" => "How do the lifetime bonuses work?",
                "desc" => "You're getting 30-Day Drummer and 30-Day Chops for life. That means you'll get access to them forever, so even if you need to take a break from your drum lessons—they're still yours to enjoy."
            ]
        ];
    @endphp

    <section class="px-5 sm:px-10 py-12 md:py-20">
        <div class="container mx-auto max-w-5xl">
            <h2 class="font-extrabold mb-10 text-center">Frequently Asked Questions</h2>
            @foreach($faqs as $faq)
                @include('_partials.components.question-dropdown', [
                    'num' => '?',
                    "title" => $faq['title'],
                    "desc" => $faq['desc'],
                ])
            @endforeach
            <p class="leading-normal text-center mt-7"><strong>Still have questions?</strong><br class="sm:hidden">
                Call us toll-free at <a class="underline" href="tel:+18004398921">1-800-439-8921</a>
                 directly at<br> <a class="underline" href="tel:+16048557605">1-604-855-7605</a> or start a chat with us in the bottom right corner of any page!</p>
        </div>
    </section>


    @include("drumeo.sales.partials._footer", [
        "minimal" => true
    ])

    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script type="text/javascript" src="{{ asset('/marketing/parcel/drumeo/navigation-sales.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/@splidejs/splide@4.1.4/dist/js/splide.min.js"></script>
    @yield('scripts')

    {{-- <script type="application/javascript">
        document.addEventListener('DOMContentLoaded', function () {
            var stickyBar = document.querySelector('.promo-banner');
            if (!stickyBar) return;

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
    </script> --}}
@endsection
