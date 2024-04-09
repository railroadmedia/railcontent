@extends('musora._partials.layout')

@section('head-includes')
    @parent
    <title>Musora’s Ambassador Program</title>
    <meta property="og:title" content="Musora’s Ambassador Program">

    <meta name="description" content="Get paid to promote world-class online music lessons.">
    <meta property="og:description" content="Get paid to promote world-class online music lessons.">

    <meta property="og:url" content="https://www.musora.com/{{ Request::path() }}">
    <meta property="og:image" content="https://dmmior4id2ysr.cloudfront.net/homepage/2023/share-image3.jpg">

    @include('_partials.layout._fonts')

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@splidejs/splide@4.0.7/dist/css/splide.min.css">
    <link rel="stylesheet" href="{{ mix('marketing/css/app.css') }}">

    <style>
        .join {
            display: inline-block;
            font: 500 22px/1em 'Bebas Neue', sans-serif;
            text-transform: uppercase;
            background: #0c1524;
            border-radius: 50px;
            color: #fff;
            padding: 17px 7%;
            outline: none;
            cursor: pointer;
            text-align: center;
            user-select: none;
            text-decoration: none;
            transition: background-color 0.3s, color 0.3s, opacity 0.3s;
            box-shadow: 0 0 0 rgba(0, 0, 0, 0.35);
        }
        @media (min-width: 768px) {
            .join {
                font-size: 30px;
            }
        }
        .join:hover, .join:focus {
            color: #fff;
            background:#14233d;
            box-shadow: 0 0 7px rgba(0, 0, 0, 0.35);
        }
        .join.green {
            background: #10d05f;
        }
        .join.green:hover, .join.green:focus {
            background: #25ee78;
        }
        .join.white {
            background: #fff;
            color: #000;
        }
        .join.white:hover, .join.white:focus {
            background: #eee;
        }
        .join.sold-out {
            background: #777;
        }
        .join.sold-out:hover, .join.sold-out:focus {
            background: #919191;
        }
        .join.smaller {
            padding: 8px 30px;
            font-size: 16px;
        }
        @media (min-width: 768px) {
            .join.smaller {
                font-size: 18px;
                padding:11px 30px;
            }
        }
        .join.smaller.outline {
            padding: 8px 28px 6px;
            font-size: 16px;
        }
        @media (min-width: 768px) {
            .join.smaller.outline {
                font-size: 18px;
                padding: 10px 28px 8px;
            }
        }
        .join.coaches {
            background-color: #fe9f13;
            color: #000;
        }
        .join.coaches:hover, .join.coaches:focus {
            background: #feb446;
            color: #000;
        }
        .join.promo {
            background: #ffac00;
            color: #000;
        }
        .join.promo:hover, .join.promo:focus {
            background: #ffbd33;
            color: #000;
        }
        .join.outline {
            background: transparent;
            outline-style: none !important;
            border: 1px solid #fff;
            color: #fff;
            padding: 6px 12px;
        }
        @media (min-width: 768px) {
            .join.outline {
                border-width: 2px;
                padding: 11px 30px;
            }
        }
        .join.outline:hover, .join.outline:focus {
            background: #fff;
            color: #000;
        }
        .join.outline.light-navy {
            border-color: #a1afc9;
            color: #a1afc9;
        }
        .join.outline.light-navy:hover, .join.outline.light-navy:focus {
            background: #a1afc9;
            color: #000;
        }
        .join.outline.method, .join.outline.pianote {
            border-color: #f61a30;
            color: #f61a30;
        }
        .join.outline.method:hover, .join.outline.pianote:hover, .join.outline.method:focus, .join.outline.pianote:focus {
            background: #f61a30;
            color: #fff;
        }
        .join.outline.songs {
            border-color: #17d1fa;
            color: #17d1fa;
        }
        .join.outline.songs:hover, .join.outline.songs:focus {
            background: #17d1fa;
            color: #fff;
        }
        .join.outline.coaches {
            border-color: #fe9f13;
            color: #fe9f13;
        }
        .join.outline.coaches:hover, .join.outline.coaches:focus {
            background: #fe9f13;
            color: #fff;
        }
        .join.outline.promo {
            border-color: #ffac00;
            color: #ffac00;
        }
        .join.outline.promo:hover, .join.outline.promo:focus {
            background: #ffac00;
            color: #fff;
        }

        .text-musora {
            color: #0c1524;
            -webkit-text-fill-color: #0c1524 !important;
        }

        .text-musora-gold {
            color: #FFAE00!important;
        }

        .bg-musora {
            background:#0c1524 !important;
        }
        .border-musora {
            border-color:#0c1524!important;
        }
        .border-musora-gold {
            border-color:#FFAE00!important;
        }
        .border-musora::before {
            content:none!important;
        }
        .bg-musora-gold {
            background:#FFAE00 !important;
        }
    </style>
@endsection

@section('body-data')
    x-data="{
    modal: false,
    apply: false
    }"
@endsection

@section('layout-scripts')
    <script src="https://cdn.jsdelivr.net/npm/@splidejs/splide@4.0.7/dist/js/splide.min.js"></script>
@endsection

<!-- Main -->
@section('layout-body')
    <header class="bg-cover bg-center text-center text-white py-12 md:py-20 lg:py-24 px-4 relative" style="background-color:#011223;background-image:url(https://www.musora.com/musora-cdn/image/width=1500,quality=95/https://dmmior4id2ysr.cloudfront.net/affiliate/background-drums.jpg);">
        <div class="background-fade">
            <div class="drums" style="background-image: url(https://www.musora.com/musora-cdn/image/width=1500,quality=95/https://dmmior4id2ysr.cloudfront.net/affiliate/background-drums.jpg);"></div>
            <div class="piano"  style="background-image: url(https://www.musora.com/musora-cdn/image/width=1500,quality=95/https://dmmior4id2ysr.cloudfront.net/affiliate/background-piano.jpg);"></div>
            <div class="guitar"  style="background-image: url(https://www.musora.com/musora-cdn/image/width=1500,quality=95/https://dmmior4id2ysr.cloudfront.net/affiliate/background-guitar.jpg);"></div>
        </div>
        <div class="container mx-auto max-w-6xl relative z-10">
            <img class="mx-auto h-16 sm:h-32 lg:h-40 mb-5 md:mb-7" src="https://www.musora.com/musora-cdn/image/width=900,quality=95/https://dmmior4id2ysr.cloudfront.net/affiliate/Musora-AllBrands.png" alt="musora logos" fetchpriority="high">

            <h2 class="leading-tight"><strong>Musora’s<br class="inline sm:hidden"> Ambassador Program</strong></h2>
            <h4 class="mb-5 md:mb-7 leading-normal">Join the band by becoming a voice for world-class <br class="hidden sm:inline">
                music instruction and earn in return</h4>

            <span class="join smaller mb-3 md:mb-0 md:mx-2 cursor-pointer border-2 text-musora-gold border-musora-gold hover:bg-musora-gold" x-on:click="modal = true">Guidelines</span>
            <a class="join smaller md:mx-2 bg-musora-gold text-black"
                href="https://musora.everflowclient.io/affiliate/signup"
{{--                x-on:click="apply = true"--}}
            >APPLY NOW</a>
        </div>
    </header>
    <section class="text-white text-center py-8 md:py-10 lg:py-12 px-4 bg-musora-black">
        <div class="container mx-auto max-w-2xl">
            <h6 class="leading-normal px-3">
                Our mission at Musora is to create more musicians and keep them playing longer. As the trusted expert and influencer in your community, we look to you to help us achieve that mission through our ambassador program.
                <br><br>
                Our reward model ensures generous compensation for your creativity, hard work and the results delivered. We provide the tools and resources for success, allowing you to cater to your followers who look to you for entertainment and guidance and maximize your returns.
                <br><br>
                <strong>Apply today, and let’s fill the world with more music!</strong>
            </h6>
        </div>
    </section>
    <section class="bg-cover bg-center text-center text-white py-10 md:py-14 lg:py-20 px-4 sm:px-6 relative">
        {{-- background --}}
        <img src="https://www.musora.com/musora-cdn/image/width=1500,quality=95/https://dmmior4id2ysr.cloudfront.net/affiliate/background-piano.jpg"
            class="absolute object-cover object-center inset-0 w-full h-full"
             alt="piano background"
        />
        <div class="container mx-auto max-w-6xl relative z-0">
            <h3><strong>Applying is as easy as ¾ time</strong></h3>
            <div class="flex flex-wrap my-8 md:my-12 lg:my-14">
                <div class="w-full md:w-1/3 px-2 mb-8 md:mb-0">
                    <div class="inline-block rounded-full p-3 text-center border-4 border-musora-gold relative" style="width: 78px;"><h1 class="text-5xl text-musora-gold leading-none"><strong>1</strong></h1></div>
                    <h4 class="leading-normal mt-4 lg:mt-5 mb-2 lg:mb-4"><strong>Read This</strong></h4>
                    <span class="join smaller cursor-pointer border-2 text-musora-gold border-musora-gold hover:bg-musora-gold" x-on:click="modal = true">Guidelines</span>
                </div>
                <div class="w-full md:w-1/3 px-2 mb-8 md:mb-0">
                    <div class="inline-block rounded-full p-3 text-center border-4 border-musora-gold relative" style="width: 78px;"><h1 class="text-5xl text-musora-gold leading-none"><strong>2</strong></h1></div>
                    <h4 class="leading-normal mt-4 lg:mt-5 mb-2 lg:mb-4"><strong>Fill This Out</strong></h4>
                    <a class="join smaller border-2 text-musora-gold border-musora-gold hover:bg-musora-gold"
{{--                        x-on:click="apply = true"--}}
                        href="https://musora.everflowclient.io/affiliate/signup"
                    >APPLY NOW</a>
                </div>
                <div class="w-full md:w-1/3 px-2">
                    <div class="inline-block rounded-full p-3 text-center border-4 border-musora-gold relative" style="width: 78px;"><h1 class="text-5xl text-musora-gold leading-none"><strong>3</strong></h1></div>
                    <h4 class="leading-normal mt-4 lg:mt-5 mb-2 lg:mb-4"><strong>Get Approved</strong></h4>
                    <h3><i class="fas fa-check bg-musora-gold rounded-full text-black inline-block py-1.5 leading-tight px-3"></i></h3>
                </div>
            </div>
            <div class="inline-block text-left">
                <h5 class="leading-tight mb-3"><strong>Thanks for your interest in our partner program!</strong></h5>
                <ul class="fa-ul pl-4">
                    <li><i class="fas fa-li fa-check text-musora-gold text-2xl"></i><em>Your site and/or channel will be reviewed to join the Musora  Affiliate program.</em></li>
                    <li><i class="fas fa-li fa-check text-musora-gold text-2xl"></i><em>If approved, you’ll have access to all the links, logos and banners for your chosen Musora brand(s).</em></li>
                    <li><i class="fas fa-li fa-check text-musora-gold text-2xl"></i><em>We will not approve coupon sites, sites under construction, or sites with long load times or functionality issues.</em></li>
                </ul>
            </div>
        </div>
    </section>
    <section class="text-white py-8 md:py-14 lg:py-20 px-3 sm:px-6 bg-musora-black">
        <div class="container mx-auto max-w-3xl">
            <h3 class="text-center mb-7 md:mb-10"><strong>FAQ<br class="sm:hidden"> (Frequent Ambassador Questions)</strong></h3>
            <ul class="fa-ul pl-4">
                <li class="w-full leading-relaxed mb-7 md:mb-10">
                    <i class="far fa-li fa-question-circle text-musora-gold text-4xl"></i>
                    <strong class="font-black">Who Can Apply?</strong><br>
                    Anyone can apply, as long as you read the "read this" and didn't think, "Hey, that describes me perfectly!"
                </li>
                <li class="w-full leading-relaxed mb-7 md:mb-10">
                    <i class="far fa-li fa-question-circle text-musora-gold text-4xl"></i>
                    <strong class="font-black">How Do I Make Money?</strong><br>
                    Through promoting the benefits and joys of learning music on the best platform for music education in the world. Aka, using affiliate links to direct traffic to our trials, products and special offers.
                </li>
                <li class="w-full leading-relaxed mb-7 md:mb-10">
                    <i class="far fa-li fa-question-circle text-musora-gold text-4xl"></i>
                    <strong class="font-black">What Else Do I Get?</strong><br>
                    You have to practice what you preach, so we will give you free access to everything we offer our students so you can make educated recommendations.
                </li>
                <li class="w-full leading-relaxed mb-7 md:mb-10">
                    <i class="far fa-li fa-question-circle text-musora-gold text-4xl"></i>
                    <strong class="font-black">What Else?</strong><br>
                    How about dedicated support? (If you need it)
                </li>
                <li class="w-full leading-relaxed mb-7 md:mb-10">
                    <i class="far fa-li fa-question-circle text-musora-gold text-4xl"></i>
                    <strong class="font-black">That's It?</strong><br>
                    Jeeze. Okay, besides the money, free Musora access, and dedicated support? We will work with you to brainstorm on sponsored content and giveaways.
                </li>
                <li class="w-full leading-relaxed">
                    <i class="far fa-li fa-question-circle text-musora-gold text-4xl"></i>
                    <strong class="font-black">Who Is Tracking All Of This?</strong><br>
                    Everflow! This fantastic system looks after all the tracking, assets, reporting, and calculations. It also makes sure you get paid on time and consistently.
                </li>
            </ul>
        </div>
    </section>
    <section class="bg-cover bg-center text-center text-white py-10 md:py-16 lg:py-20 px-4 relative">
        <img src="https://www.musora.com/musora-cdn/image/width=1500,quality=95/https://dmmior4id2ysr.cloudfront.net/affiliate/background-guitar.jpg"
            class="absolute object-cover z-[-2] w-full h-full top-0 left-0 object-cover"
             alt="guitar background"
        />
        <div class="container mx-auto max-w-6xl">
            <h2><strong>Musora’s<br class="inline sm:hidden"> Ambassador Program</strong></h2>
            <a class="join bg-musora-gold text-black my-5 md:my-7 inline-block"
{{--                x-on:click="apply = true"--}}
                href="https://musora.everflowclient.io/affiliate/signup">APPLY NOW</a>
            <p class="leading-normal">Have any questions? Please email <a href="mailto:jmilligan@musora.com"><u>jmilligan@musora.com</u></a> after<br class="hidden md:inline">
                reviewing the <span class="cursor-pointer" x-on:click="modal = true"><u>brand guidelines</u></span> and <a class="cursor-pointer"
{{--                    x-on:click="apply = true"--}}
                    href="https://musora.everflowclient.io/affiliate/signup"
                ><u>application page</u></a>.</p>
        </div>
    </section>

    @component('_partials.components.modal', ['name' => 'modal'])
        @slot('content')
            <div class="relative w-full max-w-4xl overflow-y-auto rounded-xl bg-white px-5 py-5 sm:px-8 sm:py-8 lg:px-12 lg:py-12 shadow-lg">
                <h5 class="text-center mb-2"><strong>Partnership and Brand Guidelines</strong></h5>
                <p>Requirements:</p>
                <ul class="list-disc list-outside pl-5 mb-2">
                    <li>Must disclose either affiliate partnership or sponsorship.</li>
                    <li>All sponsored content must be approved by Musora Account Manager prior to publishing.</li>
                    <li>All content must live permanently on respective channel (unless platform removes on time schedule, e.g. Snapchat, IG Stories, etc.).</li>
                    <li>Honest and fair reviews. If you’re unhappy with the product, please give us the opportunity to resolve any issue prior to posting your review.</li>
                </ul>
                <p>Restrictions:</p>
                <ul class="list-disc list-outside pl-5 mb-2">
                    <li>Must not promote or contain sexually explicit or obscene materials.</li>
                    <li>Must not promote violence or contain violent materials.</li>
                    <li>Must not promote or contain materials or activity that is hateful, harassing, harmful, invasive of another’s privacy, abusive, or discriminatory (including on the basis of race, color, sex, religion, nationality, disability, sexual orientation, political affiliation or age.)</li>
                    <li>Must not promote or undertake in illegal activities.</li>
                    <li>Must not incorporate any materials which infringe or assist others to infringe on any copyright, trademark or other intellectual property rights or to violate the law.</li>
                    <li>Must not include any unapproved trademark, including logos, of Musora Media brands or its partners.</li>
                    <li>Must not make inaccurate, deceptive or otherwise misleading claims about Musora Media brands, Musora Media partners, products, policies, promotions, or prices.</li>
                    <li>You will not artificially generate clicks or impressions on your Site(s) or create Sessions on Musora Media Inc.  site(s), whether by way of fake redirects, automated software, or other mechanisms to generate Actions;</li>
                    <li>You must not create or design your website(s) or any other website(s) that you operate,  explicitly or implied in a manner which resembles our website(s) nor design your website(s) in a  manner which leads customers to believe you are Musora Media Inc. or any other affiliated business.</li>
                    <li>Affiliates that bid in their Pay-Per-Click campaigns using keywords such as  drumeo.com, Drumeo, www.drumeo, www.drumeo.com, and/or any  misspellings or similar alterations of these – be it separately or in combination with other  keywords – and do not direct the traffic from such campaigns to their own website prior to re directing it to ours, will be considered trademark violators, and will be banned from Musora Media Inc.’s Affiliate Program.</li>
                    <li>Affiliate shall not transmit any so-called “interstitials,” “Parasiteware™,” “Parasitic  Marketing,” “Shopping Assistance Application,” “Toolbar Installations and/or Add-ons,”  “Shopping Wallets” or “deceptive pop-ups and/or pop-unders” to consumers from the time the consumer clicks on a qualifying link until such time as the consumer has fully exited Musora Media Inc.’s sites (i.e., where no page from our site or any of Musora Media Inc. brand’s content or  branding is visible on the end-user’s screen).</li>
                    <li>You will not sell, resell, redistribute, sublicense, or transfer any Program Content or any  application that uses, incorporates, or displays any Program Content or Data Feeds.</li>
                </ul>
                <p>We reserve the right to terminate our agreement at any time.</p>
            </div>
        @endslot
    @endcomponent
    @component('_partials.components.modal', ['name' => 'apply'])
        @slot('content')
            <div class="relative w-full max-w-lg overflow-y-auto rounded-xl bg-white px-5 py-5 sm:px-8 sm:py-8 shadow-lg">
                <h4 class="leading-tight text-center mb-3 sm:mb-5"><strong>Which program would you<br class="hidden sm:inline"> like to apply for? </strong></h4>
                <a class="join w-full mb-4 bg-drumeo " href="https://musora.everflowclient.io/affiliate/signup">APPLY</a>
            </div>
        @endslot
    @endcomponent
@stop
