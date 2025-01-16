@php
    require_once(resource_path('marketing/views/guitareo/_partials/homepage-data.php'));
@endphp

@extends('guitareo._partials.global-layout')

@section('global-head')
    <title>Save On Your Lessons and Spend More Time Playing.</title>
    <meta property="og:title" content="Save On Your Lessons & Spend More Time Playing.">
    <meta property="og:url" content="https://www.guitareo.com/{{ Request::path() }}">

    <meta name="description" content="Save $300 compared to a monthly membership!">
    <meta property="og:description" content="Save $300 compared to a monthly membership!">

    <meta property="og:image" content="https://d21q7xesnoiieh.cloudfront.net/fit-in/1200x0/filters:quality(95)/marketing/guitareo/membership/homepage/2024/share-image-guitareo.webp"/>

    <link rel="stylesheet" href="{{ mix('marketing/css/app.css') }}">
    <link rel="stylesheet" href="{{ asset('/marketing/css/tailwind-helpers.css') }}">
    <link rel="stylesheet" href="{{ asset('/marketing/parcel/drumeo/nav-footer-guitareo.css') }}">
    <link rel="stylesheet" href="{{ asset('/marketing/parcel/drumeo/sales-page-guitareo.css') }}">
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
            fill: #00c9ac !important;
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
    @include("guitareo.sales.partials._nav", [
        "subscriptionVersion" => true,
        "scrollToJoin" => true,
        "hideMenu" => true,
    ])
  
 @include('musora.sales.components.header-section', [
        'ascension' => true,
        'noSubHeader' => true,
        'noTrailer' => true,
        'video' => 'https://musora-image-processing-cdn.s3.us-east-2.amazonaws.com/marketing/musora/membership/homepage/2024/header3.mp4',
        'videoM' => 'https://musora-image-processing-cdn.s3.us-east-2.amazonaws.com/marketing/musora/membership/homepage/2024/header6-m.mp4',
        'header' => 'SAVE <u style="text-decoration-color: #00c9ac;">$300</u> COMPARED TO<br class="hidden sm:inline"> A MONTHLY MEMBERSHIP',
        'pointOne' => 'Song Breakdowns',
        'pointTwo' => 'Unlimited Guitar Lessons',
        'pointThree' => 'Legendary Instructors',
        'pointFour' => '24/7 Support',
        ])

@php
    $heading = 'Save on your lessons & spend  <br class="hidden sm:block">More Time Playing.';
    $subheading = 'A Monthly Membership is great when you’re testing the waters for the first time. But if you love playing guitar and want all the awesome benefits of a Guitareo Membership for a lower price… an Annual plan is the best option.';
    $gettings = [
        [
            'position' => 'left',
            'desc' => 'Right now, you’ll <strong> save $300</strong> by upgrading to an Annual Membership. That works out to <span class=italic> just $15 a month</span>. <br><br>At this price, your guitar lessons pay for themselves after 5 months. Keep the extra cash for yourself, or reinvest it into your guitar. (Who doesn’t love new picks or a new guitar case?)',
            'alt' => 'Image with prices and savings.',
            'img' => 'marketing/guitareo/membership/ascension/save-02.webp',
        ],
        [
            'position' => 'right',
            'desc' => 'We know how hard it is to learn an instrument. After all, building new skills and forming habits takes a lot longer than a month. So this is the perfect time to set yourself up for success and invest in something that you <span class=italic>love</span> for the next year.',
            'alt' => 'Guitar player, playing guitar.',
            'img' => 'marketing/guitareo/membership/ascension/save-01.webp',
        ]
    ];
@endphp

@include('musora.sales.components.save-ascension-section', compact('heading', 'subheading', 'gettings'))
   @php
        $gridItems = [
        [
            "image" => "marketing/guitareo/membership/ascension/unlimited.webp",
            "imageM" => "marketing/guitareo/membership/ascension/unlimited-m.webp",
            "title" => "Save On Your First Year",
            "desc" => "Since you’re already a member, this deal is just for you.",
        ],
        [
            "big" => true,
            "image" => "marketing/guitareo/membership/ascension/be-first-to-know.webp",
            "imageM" => "marketing/guitareo/membership/ascension/be-first-to-know-m.webp",
            "title" => "Be First To Know",
            "desc" => "Get free access to all our latest guitar challenges.",
        ],
        [
            "big" => true,
            "image" => "marketing/guitareo/membership/ascension/lifetime-bonuses.webp",
            "imageM" => "marketing/guitareo/membership/ascension/lifetime-bonuses-m.webp",
            "title" => "Lifetime Bonuses",
            "desc" => 'Keep one of our most popular challenges <span class="italic">forever.</span>',
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
            'desc' => 'Taking a break from the guitar? Try Drums, Piano, or Singing lessons anytime.',
        ],
    ];
    @endphp
    @include('musora.sales.components.reason-cards-five-section', [
        'bgColor' => '#F6F8FC',
        'header' => 'What You’ll Get For the Next 365 Days',
        'full' => true,
    ])

    @include('musora.sales.components.get-serious-section', [
        'title' => 'Get Serious About Guitar',
        'items' => [
            [
                'icon' => 'marketing/guitareo/membership/ascension/icons-01.svg',
                'heading' => 'Start a Lifelong Journey',
                'description' => 'Once a guitarist, always a guitarist. While a month of practice can introduce you to the basics, a year allows you to really develop your skills and play songs you never imagined you could.',
            ],
            [
                'icon' => 'marketing/guitareo/membership/ascension/icons-02.svg',
                'heading' => 'Strengthen Your Commitment',
                'description' => 'As Jimi Hendrix once said, "Sometimes you want to give up the guitar, you\'ll hate the guitar. But if you stick with it, you\'re gonna be rewarded." Committing to your guitar for a full year is the best way to level up your skills.',
            ],
            [
                'icon' => 'marketing/guitareo/membership/ascension/icons-03.svg',
                'heading' => 'Reach Your Guitar Goals',
                'description' => 'The more time you practice—the better you’ll become. In a year, you can look <br class="hidden lg:block"> back and see how far you\'ve grown as a guitarist.',
            ],
        ],
    ])

    @php
        $testimonials = $guitareo['testimonials'];
        $youtube = number_format(Prices::$guitareoYoutubeSubsc);
        $facebook = number_format(Prices::$guitareoFacebookLikes);
        $instagram = number_format(Prices::$guitareoInstagramFollowers);
    @endphp

    @include('musora.sales.components.testimonials-section', [
        'header' => 'guitarists',
        'youtubeLink' => 'https://www.youtube.com/guitarlessonscom/',
        'facebookLink' => 'https://facebook.com/guitareoofficial/',
        'instagramLink' => 'https://instagram.com/guitareoofficial/',
    ])
    @include('musora.sales.components.guarantee-section', [
        'badge' => 'marketing/guitareo/membership/homepage/2024/guitareo-guarantee.webp',
        'header' => '<strong>Happy student guarantee.</strong><br>Test-drive your lessons for 90 days. Zero risk.',
        'desc' => 'More than anything we want to make sure you have a POSITIVE experience developing new skills and gaining <br class="hidden lg:block"> confidence with Guitareo. Which is why you’ll have 90 days risk-free to try everything again and make sure you love it.',
    ])

    <div id="customize-anchor"></div>
    <section class="py-14 sm:py-24 lg:py-32 relative overflow-hidden text-white text-center customize px-4 lg:px-6"
        style="background: linear-gradient(to bottom, #1D4689 0%, #0C1524 100%);">
        <div class="container mx-auto relative z-50  max-w-3xl ">
            <h1 class="leading-tight font-black">
                Upgrade Now to Save on<br class="hidden sm:inline">
                Your Guitareo Membership.</h1>
            <h5 class="leading-tight my-3 sm:my-4 text-musora">
                <strong>Annual Membership</strong> +<br class="sm:hidden"> Bonus Worth $127</h5>
            <img class="h-36 sm:h-56 my-4 sm:my-7" src="https://d21q7xesnoiieh.cloudfront.net/fit-in/900x0/filters:quality(95)/marketing/guitareo/membership/ascension/order.webp">


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
                    class="join guitareo smaller mb-4 md:mb-5 w-full max-w-xs sm:max-w-sm"
                    href="/ecommerce/add-to-cart?products[GUITAREO-1-YEAR-MEMBERSHIP]=1&products[30-days-to-better-strumming]=1&locked=true&promo-code=welcome-back,WBG24"
                >GET Started »</a>

                <p class="text-sm"><em>All prices listed in USD.</em></p>
            </div>
        </div>
    </section>

    @php
    $faqs = [
    [
        "title" => "Is Annual good for beginners?",
        "desc" => "Yes! An Annual Membership is the best option for beginners if you plan on committing to the guitar for more than 4 months. It means you'll have access to unlimited lessons for a whole year, PLUS you'll save 62% compared to a monthly plan."
    ],
    [
        "title" => "How much does an Annual Membership cost when it renews?",
        "desc" => "After your first year, an Annual Membership will cost $240 per year, which is still 50% less than what you would pay with a monthly Guitareo Membership."
    ],
    [
        "title" => "Can I pay for the Annual Membership in installments?",
        "desc" => "Unfortunately, the Annual Membership is paid all at once in full and we do not have payment plans available at this time."
    ],
    [
        "title" => "Will I get a reminder before my Annual Membership renews?",
        "desc" => "Yes, we always send a reminder email to let you know when your Annual Membership is about to renew."
    ],
    [
        "title" => "Can I really learn guitar effectively online in a year?",
        "desc" => "Our challenges have a 4x better completion rate than traditional online learning. That's because we've designed our challenges to be fun and engaging while you're learning new techniques. You don't sit and watch an instructor, we get you playing along so you'll ENJOY doing it and actually level up on the guitar."
    ],
    [
        "title" => "What if I don't have enough time to learn?",
        "desc" => "Because it's all online, you can play guitar anytime you want! It's like having a teacher in your pocket (but your teacher is awake with you at 2 am if that's the only time you can practice). Plus, our mentors can set you up with a practice routine that fits your schedule."
    ],
    [
        "title" => "What if I already take guitar lessons in person?",
        "desc" => "That's great! Guitareo is a perfect complement to your in-person learning. There are plenty of students who use Guitareo to supplement their in-person lessons."
    ],
    [
        "title" => "How does the lifetime bonus work?",
        "desc" => "You're getting 30-Day To Better Strumming for life. That means you'll get access to it forever, so even if you need to take a break from your guitar lessons—they're still yours to enjoy."
    ]
    ];
    @endphp

    <section class="py-12 md:py-20">
        <div class="container mx-auto max-w-5xl px-6">
            <h2 class="font-extrabold mb-10 text-center">Frequently Asked Questions</h2>
            @foreach($faqs as $faq)
                @include('_partials.components.question-dropdown', [
                    'num' => '?',
                    "title" => $faq['title'],
                    "desc" => $faq['desc'],
                ])
            @endforeach
        </div>
    </section>

    @include("guitareo.sales.partials._footer")

    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script type="text/javascript" src="{{ asset('/marketing/parcel/drumeo/navigation-sales.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/@splidejs/splide@4.1.4/dist/js/splide.min.js"></script>
@endsection
