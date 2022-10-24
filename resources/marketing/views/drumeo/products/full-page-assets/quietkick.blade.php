@extends('drumeo._partials.layout')

@section('head-includes')
    <title>QuietKick | Drumeo</title>
    <meta property="og:title" content="QuietKick | Drumeo">
    <meta name="description" content="Improve your kick foot anywhere.">
    <meta property="og:description" content="Improve your kick foot anywhere.">
    <meta property="og:image" content="https://drumeo-assets.s3.amazonaws.com/drum-shop/quietkick/fb-share-image.jpg" style="display: none;">
    <meta property="og:url" content="https://www.drumeo.com/drumshop/quietkick/">

    <?php \App\Analytics\Tracker::trackProductImpression('quietkick'); ?>

    <link href="{{ asset('/marketing/css/drumeo/tailwind-helpers.css') }}" rel="stylesheet">
    <link href="{{ asset('/marketing/parcel/drumeo/navigation-sales.css') }}" rel="stylesheet">
    <link href="{{ asset('/marketing/parcel/drumeo/sales-2020.css') }}" rel="stylesheet">
    <style>
        .header {
            height:600px;
        }
        @media (min-width: 768px) {
            .header {
                height:750px;
            }
        }
        @media (min-width: 1024px) {
            .header {
                height:800px;
            }
        }
        .img-toggle.active {
            display:block;
        }

        .dropdowns {
            max-width: 1100px;
            margin: 20px auto 0;
            padding: 0 10px;
        }
        @media (min-width: 40em) {
            .dropdowns {
                margin: 40px auto 0;
                padding: 0 20px;
            }
        }
        .dropdowns .dropdown .bg-pred {
            min-width: 32px;
        }
        @media (min-width: 40em) {
            .dropdowns .dropdown .bg-pred {
                min-width: 83px;
            }
        }
        .dropdowns .dropdown .description {
            height: 0;
            max-height: 0;
            visibility: hidden;
            opacity: 0;
            overflow: hidden;
        }
        .dropdowns .dropdown.active .description {
            visibility: visible;
            opacity: 1;
            height: auto;
            max-height: 400px;
        }

    </style>
@stop

@section('layout-body')
    @include("drumeo.sales.partials._nav", [
        "cartVersion" => true
    ])
    @include('drumeo.products.partials.promo-banner', [
                "name" => "QuietKick",
                "fullPrice" => Prices::$quietKickFull,
                "price" => Prices::$quietKick,
                "noBreadcrumb" => true
            ])

    <header class="header text-white relative overflow-hidden z-10" style="background-color:#011434;">
        <div class="transform -translate-y-1/2 top-1/2 left-0 w-full absolute z-20 px-4 lg:px-6 text-center">
            <div class="container mx-auto max-w-6xl">
                <img alt="quietkick" class="h-16 sm:h-24 lg:h-28" src="https://cdn.musora.com/image/fetch/w_600,q_auto:best/https://drumeo-assets.s3.amazonaws.com/drum-shop/quietkick/drumeo-quietkick.png"><br>
                <h1 class="leading-tight mt-72 sm:mt-96"><strong>Improve your kick<br class="inline sm:hidden"> foot anywhere.</strong></h1>
                @if( $products['quietkick']->getStock() > 1 && !empty($products['quietkick']->getStock()))
                    <a class="join blue my-2 sm:my-4 lg:my-6 w-2/3 anchor-slide" href="#customize-anchor">Get Started &raquo;</a>
                @else
                    <a class="join sold-out my-2 sm:my-4 lg:my-6 w-2/3">SOLD OUT</a>
                @endif
                <h6 class="leading-tight">
                    STARTING AT @if(Prices::$quietKickFull > Prices::$quietKick) <s style="opacity: 0.6;">${{ Prices::$quietKickFull }}</s> @endif
                    ${{ Prices::$quietKick }}
                    {{--@if( $products['quietkick']->getStock() > 1 && !empty($products['quietkick']->getStock()))--}}
                        {{--<br><strong class="text-yellow-500">LAUNCH SPECIAL</strong>--}}
                    {{--@endif--}}
                </h6>
            </div>
        </div>
        <div class="top-0 left-0 absolute w-full h-full z-10" style="background: linear-gradient(to bottom, transparent, rgba(0,79,153,0.6));"></div>
        <video class="object-cover w-full h-full relative z-0" poster="" src="https://player.vimeo.com/progressive_redirect/playback/696274730/rendition/1080p?loc=external&signature=a2e19f58b044993d2561fbeaabcd4855ec9d1f577a7bba332fc5a7e7221cb23a" type="video/mp4" autoplay="" loop="" playsinline="" muted></video>
    </header>

    <section class="text-left text-white px-5 sm:pl-5 sm:pr-0 bg-cover lazyload" style="background-color: #c1c6ca; color: #203e59;" data-bg="https://cdn.musora.com/image/fetch/w_1500,q_auto:best/https://drumeo-assets.s3.amazonaws.com/drum-shop/quietkick/bg.jpg">
        <div class="container mx-auto max-w-6xl relative pb-8 md:py-10 lg:py-16">
            <div class="mx-auto mb-4 sm:mb-0 sm:absolute sm:top-0 sm:right-0 z-10 max-w-xs sm:max-w-full w-full sm:w-1/2 lg:w-7/12">
                <img class="w-full img-toggle hidden active" src="https://cdn.musora.com/image/fetch/w_1300,q_auto:best/https://drumeo-assets.s3.amazonaws.com/drum-shop/quietkick/quietkick-up2.png" alt="quietkick pedal">
                <img class="w-full img-toggle hidden" src="https://cdn.musora.com/image/fetch/w_1300,q_auto:best/https://drumeo-assets.s3.amazonaws.com/drum-shop/quietkick/quietkick-down2.png" alt="quietkick pedal">
            </div>
            <div class="w-full sm:w-1/2 lg:w-5/12 z-20">
                <h2 class="leading-none mb-3 lg:mb-5"><strong>Never skip leg day.</strong></h2>
                <p class="leading-tight">Drummers are notorious for it.
                    <br><br>
                    You focus on developing fast hands but your feet remain slow & inconsistent – and who can blame you?
                    <br><br>
                    Bass drum workouts are loud (bass cuts through the walls), not very musical (*thud*), and expensive – wearing out a bass drum head can cost you $50+! And the only bass drum practice pads available are either way too expensive OR poorly designed – most creep forward worse than a drummers backbeat after a cup of coffee.
                    <br><br>
                    The Drumeo Quietkick gives you a portable & convenient way to develop your kick foot anywhere – so you can start pounding out smooth & powerful doubles every time you sit at the kit.
                </p>
            </div>
        </div>
    </section>
    <section class="text-left text-white px-3 sm:px-5 py-8 sm:py-16 lg:py-20 relative overflow-hidden lazyload" style="background:linear-gradient(to bottom, #000f1c 25%, #01192f);">
        <div class="container mx-auto z-10 relative max-w-5xl">
            <h2 class="text-center mb-10 sm:mb-16"><strong>Foot workouts on the fly.</strong></h2>
            <div class="flex flex-wrap sm:flex-nowrap items-center mb-8 sm:mb-16">
                <img  alt="quietkick double pedal" class="h-44 sm:h-56 lg:h-80 mx-auto sm:mx-0 rounded-xl mb-3 sm:mb-0 lazyload" data-src="https://cdn.musora.com/image/fetch/w_1000,q_auto:best/https://drumeo-assets.s3.amazonaws.com/drum-shop/quietkick/double-kick.jpg">
                <div class="w-full sm:w-1/2 sm:pl-10">
                    <h5 class="mb-3 text-center sm:text-left"><strong>Single OR double kick.</strong></h5>
                    <p class="text-light-navy max-w-xs sm:max-w-full">Yup, your double pedal works too. An extra beater turns your QuietKick into the ultimate double-kick workout station. (Extra beater sold separately.)</p>
                </div>
            </div>
            <div class="flex flex-wrap sm:flex-nowrap items-center mb-6 sm:mb-16">
                <img  alt="quietkick in library" class="sm:order-1 h-44 sm:h-56 lg:h-80 mx-auto sm:mx-0 rounded-xl mb-3 sm:mb-0 lazyload" data-src="https://cdn.musora.com/image/fetch/w_1000,q_auto:best/https://drumeo-assets.s3.amazonaws.com/drum-shop/quietkick/anywhere.jpg">
                <div class="w-full sm:w-1/2 sm:pr-10">
                    <h5 class="mb-3 text-center sm:text-left"><strong>Practice anywhere.</strong></h5>
                    <p class="text-light-navy max-w-xs sm:max-w-full">A hotel, the park, or maybe just a new spot in your house. The QuietKick allows you to practice anywhere – and that means your foot will never hold you back again.</p>
                </div>
            </div>
            <div class="flex flex-wrap sm:flex-nowrap items-center {{--mb-8 sm:mb-16--}}">
                <img  alt="quietkick pedal" class="h-44 sm:h-56 lg:h-80 mx-auto sm:mx-0 rounded-xl mb-3 sm:mb-0 lazyload" data-src="https://cdn.musora.com/image/fetch/w_1000,q_auto:best/https://drumeo-assets.s3.amazonaws.com/drum-shop/quietkick/any-pedal.jpg">
                <div class="w-full sm:w-1/2 sm:pl-10">
                    <h5 class="mb-3 text-center sm:text-left"><strong>Feels like a bass drum.</strong></h5>
                    <p class="text-light-navy max-w-xs sm:max-w-full">The Drumeo QuietKick replicates the action & feel of playing a real bass drum. That makes your transition from pad to kit seamless.</p>
                </div>
            </div>
        </div>
    </section>

    <section class="text-center text-white px-5 py-10 md:py-20 lg:py-24" style="background:#000c17;">
        <div class="container mx-auto relative z-10 max-w-5xl">
            <h2><strong>How it works</strong></h2>
            <div class="max-w-xl lg:max-w-3xl mx-auto my-6 sm:my-10">
                <div class="aspect-16:9 rounded-xl overflow-hidden w-full relative">
                    <iframe class="absolute w-full h-full" src="//player.vimeo.com/video/696274986" frameborder="0" allowfullscreen allow="autoplay" title="10year-video"></iframe>
                </div>
            </div>
            <div class="flex flex-wrap">
                <div class="w-full sm:w-1/3 mb-6 sm:mb-0 sm:px-3 lg:px-8">
                    <h1 class="inline-block text-drumeo rounded-full leading-none py-3.5 sm:py-3 lg:py-3.5 w-14 sm:w-16 lg:w-20 border-drumeo border-2"><strong>1</strong></h1><br>
                    <img  alt="quietkick icon" class="my-6 sm:my-8 lg:my-10 h-16 lazyload" data-src="https://drumeo-assets.s3.amazonaws.com/drum-shop/quietkick/step2.svg">
                    <p class="text-light-navy">Swap out your existing beater with the included reverse-angle beater. This directs your kick motion downward – creating a quieter practice rig with little-to-no creeping across the floor.</p>
                </div>
                <div class="w-full sm:w-1/3 mb-6 sm:mb-0 sm:px-3 lg:px-8">
                    <h1 class="inline-block text-drumeo rounded-full leading-none py-3.5 sm:py-3 lg:py-3.5 w-14 sm:w-16 lg:w-20 border-drumeo border-2"><strong>2</strong></h1><br>
                    <img  alt="kick icon" class="my-6 sm:my-8 lg:my-10 h-16 lazyload" data-src="https://drumeo-assets.s3.amazonaws.com/drum-shop/quietkick/step1.svg">
                    <p class="text-light-navy">Now attach your QuietKick to your kick pedal the same way you would any bass drum. Just slide the unit under your pedal and clamp down until it’s secure.</p>
                </div>
                <div class="w-full sm:w-1/3 sm:px-3 lg:px-8">
                    <h1 class="inline-block text-drumeo rounded-full leading-none py-3.5 sm:py-3 lg:py-3.5 w-14 sm:w-16 lg:w-20 border-drumeo border-2"><strong>3</strong></h1><br>
                    <img  alt="pad icon" class="my-6 sm:my-8 lg:my-10 h-16 lazyload" data-src="https://drumeo-assets.s3.amazonaws.com/drum-shop/quietkick/step-3.svg">
                    <p class="text-light-navy">And finally, choose your strike pad. You’ll get one long-lasting strike pads + 2 ultra-quiet strike pads included with your QuietKick. And that’s it! You’re off to the races.</p>
                </div>
            </div>
        </div>
    </section>

    <section class="text-center text-white px-5 py-10 md:py-20 lg:py-24" style="background:#01192e;">
        <div class="container mx-auto relative z-10 max-w-5xl">
            <h2><strong>Finally, a practice pad<br class="inline sm:hidden"> for your feet.</strong></h2>
            <h6 class="mt-2">(Kick pedal not included)</h6>
            <div class="flex flex-wrap my-5 sm:my-10">
                <div class="p-1 w-full sm:w-4/12"><div class="h-44 sm:h-52 lg:h-72 w-full bg-center bg-cover rounded-xl lazyload" data-bg="https://cdn.musora.com/image/fetch/w_600,q_auto:best/https://drumeo-assets.s3.amazonaws.com/drum-shop/quietkick/product-image03.jpg"></div></div>
                <div class="p-1 w-full sm:w-8/12"><div class="h-32 sm:h-52 lg:h-72 w-full bg-center bg-cover rounded-xl lazyload" data-bg="https://cdn.musora.com/image/fetch/w_1200,q_auto:best/https://drumeo-assets.s3.amazonaws.com/drum-shop/quietkick/product-image04.jpg"></div></div>
                <div class="p-1 w-full sm:w-8/12"><div class="h-36 sm:h-52 lg:h-72 w-full bg-center bg-cover rounded-xl lazyload" data-bg="https://cdn.musora.com/image/fetch/w_1200,q_auto:best/https://drumeo-assets.s3.amazonaws.com/drum-shop/quietkick/product-image02.jpg"></div></div>
                <div class="p-1 w-full sm:w-4/12"><div class="h-44 sm:h-52 lg:h-72 w-full bg-center bg-cover rounded-xl lazyload" data-bg="https://cdn.musora.com/image/fetch/w_600,q_auto:best/https://drumeo-assets.s3.amazonaws.com/drum-shop/quietkick/product-image01.jpg"></div></div>
            </div>
            <div class="flex flex-wrap sm:flex-nowrap justify-center items-center">
                <p class="sm:max-w-md m-0 sm:pr-5 lg:pr-10 text-left mb-5 sm:mb-0">The QuietKick includes everything you need to start working out your foot. You’ll get three strike pads, one QuietKick unit, and one reverse-angle beater (with the option to add a second beater if you play double-kick).</p>
                <table class="border border-white border-collapse rounded-xl">
                    <tr class="rounded-xl">
                        <td class="px-3 py-1 text-left border border-white border-collapse">QuietKick Frame</td>
                        <td class="px-5 py-1 border border-white border-collapse">1</td>
                    </tr>
                    <tr>
                        <td class="px-3 py-1 text-left border border-white border-collapse">Reverse Angle Beater<br>
                        <span class="opacity-50">(optional second)</span></td>
                        <td class="px-5 py-1 border border-white border-collapse">1</td>
                    </tr>
                    <tr>
                        <td class="px-3 py-1 text-left border border-white border-collapse">Ultra-Quiet Strike Pads</td>
                        <td class="px-5 py-1 border border-white border-collapse">2</td>
                    </tr>
                    <tr>
                        <td class="px-3 py-1 text-left border border-white border-collapse">Long-Lasting Strike Pad</td>
                        <td class="px-5 py-1 border border-white border-collapse">1</td>
                    </tr>
                </table>
            </div>
        </div>
    </section>

    <div id="customize-anchor" class="anchor"></div>
    <section class="content-section text-center customize px-4 lg:px-6 lazyload" style="background-color:#132332;background-size: cover;" data-bg="https://cdn.musora.com/image/fetch/w_1500,q_auto:best/https://drumeo-assets.s3.amazonaws.com/drum-shop/quietkick/final.jpg">
        <div class="container mx-auto">
            <img alt="quietkick logo" class="h-14 sm:h-20 lg:h-28" src="https://cdn.musora.com/image/fetch/w_600,q_auto:best/https://drumeo-assets.s3.amazonaws.com/drum-shop/quietkick/drumeo-quietkick.png"><br>
            <h2 class="leading-tight mt-4 mb-2"><strong>Improve your kick foot anywhere.</strong></h2>
            <h6><em>Bass drum pedal not included.</em></h6>

            @if( $products['quietkick']->getStock() > 1 && !empty($products['quietkick']->getStock()))
                <div class="flex flex-wrap items-end justify-center 2-full max-w-sm md:max-w-2xl lg:max-w-3xl my-5 sm:my-10 mx-auto">
                    <div class="w-full md:w-1/2 px-2 md:px-3 relative">
                        {{--<p class="w-full px-4 pt-2 pb-4 -mb-3 text-white rounded-t-2xl" style="background:linear-gradient(to bottom, #0a73d8, #10518f);"><strong>LAUNCH SPECIAL</strong></p>--}}
                        <a href="{{ URL::Route('shopping-cart.to-cart.api') }}?products[quietkick]=1" class="text-black overflow-hidden rounded-2xl block mx-auto mb-4 md:mb-0 group">
                            <div class="bg-white px-3 pt-6 md:pt-8 pb-5 md:pb-8">
                                <h5 class="leading-none mb-3"><strong>Single Kick</strong></h5>
                                <h1 class="inline-block leading-none">
                                    @if(Prices::$quietKickFull > Prices::$quietKick)
                                        <s class="opacity-60">${{ Prices::$quietKickFull }}</s>
                                    @endif
                                    <strong>${{ Prices::$quietKick }}</strong></h1>
                                <p class="text-drumeo text-sm my-2 sm:my-4"><em>Plus shipping.</em></p>
                                <div class="join blue smaller w-full transition-opacity duration-300 group-hover:opacity-80" style="max-width: 230px;">Select</div>
                            </div>
                            <div class="px-3 pt-5 md:pt-6 pb-9 md:pb-10" style="background: #f1f8ff;border-top: 2px solid #e6f2ff;">
                                <p class="mb-1"><strong>INCLUDES:</strong></p>
                                <p class="mb-1">1 Drumeo QuietKick</p>
                                <p class="mb-1">1 Reverse Angle Beater</p>
                                <p class="mb-1">2 Ultra-quiet strike pads</p>
                                <p>1 Long-lasting strike pad</p>
                            </div>
                        </a>
                    </div>
                    <div class="w-full md:w-1/2 px-2 md:px-3 relative">
                        {{--<p class="w-full px-4 pt-2 pb-4 -mb-3 text-white rounded-t-2xl" style="background:#777;"><strong></strong></p>--}}
                        <a {{--href="{{ URL::Route('shopping-cart.to-cart.api') }}?products[quietkick]=1&products[quietkick-beater]=1"--}} class="text-black overflow-hidden rounded-2xl block mx-auto mb-4 md:mb-0 group">
                            <div class="bg-white px-3 pt-6 md:pt-8 pb-5 md:pb-8">
                                <h5 class="leading-none mb-3"><strong>Double Kick</strong></h5>
                                <h1 class="inline-block leading-none">
                                    @if(Prices::$quietKickFull > Prices::$quietKick)
                                        <s class="opacity-60">${{ Prices::$quietKickFull + 20 }}</s>
                                    @endif
                                    <strong>${{ Prices::$quietKick + 20 }}</strong></h1><br>
                                <p class="text-sm my-2 sm:my-3"><em>Plus shipping.</em></p>
                                {{--<div class="join blue smaller w-full transition-opacity duration-300 group-hover:opacity-80" style="max-width: 230px;">Select</div>--}}
                                <div class="join sold-out smaller w-full transition-opacity duration-300 group-hover:opacity-80" style="max-width: 230px;">Sold Out</div>
                            </div>
                            <div class="px-3 pt-5 md:pt-6 pb-9 md:pb-10" style="background: #f1f8ff;border-top: 2px solid #e6f2ff;">
                                <p><strong>HEADS UP:</strong><br> We ran out of extra beaters! You can purchase the Single Kick version (it's the same main unit) and we'll email you when we receive more additional beaters for purchase.</p>
                            </div>
                        </a>
                    </div>
                </div>
                <a style="color: #00bc75;" class="inline-block cursor-pointer" href="/#customize-anchor"><h4><strong><u>Or get it FREE when you join Drumeo &raquo;</u></strong></h4></a>
            @else
                <a class="join sold-out mt-5 sm:mt-10">SOLD OUT</a>
            @endif
        </div>
    </section>

    <section class="content-section text-center" style="background: #0c1429;">
        <div class="container mx-auto relative z-50">
            <div class="inline-block w-full px-3 md:px-4 mb-5 text-light-navy">
                <p>Call us toll-free at
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

    <section class="text-center text-white px-5 py-10 md:py-20 lg:py-24" style="background: #030f1f;">
        <div class="container mx-auto relative z-10 max-w-5xl">
            <h2><strong>Still have questions?</strong></h2>
            <div class="dropdowns">
                @include('drumeo.products.partials.question-dropdown-tw', [
                "customClass" => "sm:rounded-full",
                "question" => true,
                "title" => "Does the QuietKick work with a double bass pedal?",
                "description" => "Yes! You’ll see the option to add a second beater to your QuietKick. This allows you to attach your double pedal and work out both your feet. The extra beater is the only additional piece you need for this.",
                ])
                @include('drumeo.products.partials.question-dropdown-tw', [
                "customClass" => "sm:rounded-full",
                "question" => true,
                "title" => "Does the QuietKick scoot?",
                "description" => "You know what we mean – when your bass drum goes scooting across the floor everytime you hit it. The QuietKick has little to no scooting – but on a hard floor it will shift a little. For the best results, use your QuietKick on a rug or carpet. If you’re still having trouble add a bit of velcro to the bottom.",
                ])
                @include('drumeo.products.partials.question-dropdown-tw', [
                "customClass" => "sm:rounded-full",
                "question" => true,
                "title" => "Will it ship internationally?",
                "description" => "Yes! Just enter your country upon checkout – you’ll see the shipping tally in your cart. You can also grab the QuietKick with FREE shipping by joining Drumeo. You’ll get a free QuietKick shipped anywhere in the world for the price of your annual membership. <a href='/laravel/public/shopping-cart/api/query?products[DLM]=1,year,1&products[quietkick]=1&locked=true'><u>Click here to see that option.</u></a>",
                ])
            </div>
        </div>
    </section>
@stop

@section('layout-scripts')
    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script type="text/javascript" src="{{ asset('/marketing/parcel/drumeo/navigation-sales.js') }}" defer></script>
    <script type="text/javascript" src="{{ asset('/marketing/js/drumeo/modal.js') }}" defer></script>
    <script type="text/javascript" src="/marketing/js/drumeo/jquery.countdown-2.min.js"></script>
    <script>
        setInterval(function(){
            setTimeout(function(){
                for (var i = 0; i < document.querySelectorAll(".img-toggle").length; i++) {
                    document.querySelectorAll(".img-toggle")[i].classList.toggle('active');
                }
            },900);
        },900);
        $(document).ready(function () {
            $(document).foundation();
            $('.dropdown').on('click', function(){
                $(this).toggleClass('active');
                $(this).find('i').toggleClass('rotate-180');
            });
            $('.tzcd-big').countdown('2022/08/01')
                .on('update.countdown', function (event) {
                    var format = '' + '<div><h1>%M</h1> <p>min%!M</p></div> ' + '<div><h1>%S</h1> <p>sec%!S</p></div>';
                    if (event.offset.totalHours > 0) {
                        format = '' + '<div><h1>%H</h1> <p>hr%!H</p></div> ' + format;
                    }
                    if (event.offset.totalDays > 0) {
                        format = '' + '<div><h1>%D</h1> <p>day%!D</p></div> ' + format;
                    }
                    $(this).html(event.strftime(format));
                })
                .on('finish.countdown', function (event) {
                    $(this).html('<div><h1>LIMITED</h1> <p>TIME LEFT</p></div>');
                });
        });
    </script>
    <script type="text/javascript" src="{{ asset('/marketing/parcel/drumeo/modal-autoplay.js') }}" defer></script>
    <script type="text/javascript" src="{{ asset('/marketing/js/sliding-anchor.js') }}" defer></script>
    <script async type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/lazysizes/5.3.2/lazysizes.min.js" defer></script>
    <script async type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/lazysizes/5.3.2/plugins/unveilhooks/ls.unveilhooks.min.js" defer></script>
@stop
