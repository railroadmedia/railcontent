@extends('singeo._partials.global-layout')

@section('global-head')
    <title>Singing Starter Kit | Singeo</title>
    <meta property="og:title" content="Singing Starter Kit | Singeo">

    <meta name="description" content="Everything You Need To Start Singing Now">
    <meta property="og:description" content="Everything You Need To Start Singing Now">

    <meta property="og:image" content="https://singeo.s3.amazonaws.com/products/singing-starter-kit/share-image.jpg" style="display: none;">
    <meta property="og:url" content="https://www.singeo.com/{{ Request::path() }}">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/tailwindcss/2.2.19/tailwind.min.css" />
    <link href="{{ asset('/marketing/parcel/singeo/nav-footer.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('/marketing/css/singeo/tailwind-helpers.css') }}">
    <link href="{{ asset('/marketing/css/animate.css') }}" rel="stylesheet">
    <link href="{{ asset('/marketing/parcel/singeo/singing-starter-kit.css') }}" rel="stylesheet">

    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick.min.css"/>
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick-theme.min.css"/>
@stop

@section('global-body')
    @include("singeo.sales.partials._nav", [
        "cartVersion" => true
    ])

    {{--@include('shop.partials.promo-banner', [--}}
                {{--"name" => "Singing Starter Kit",--}}
                {{--"fullPrice" => floatval($productPrices['singing-starter-kit']->price),--}}
                {{--"price" => floatval($productPrices['singing-starter-kit']->discounted_price),--}}
                {{--"noBreadcrumb" => true--}}
            {{--])--}}
    @yield('topbar')

    <header class="text-center text-white py-5 md:py-8 bg-top bg-no-repeat relative" style="background-color:#000419;background-image: url(https://cdn.musora.com/image/fetch/w_1900,q_auto:best/https://singeo.s3.amazonaws.com/products/singing-starter-kit/header2.jpg);">
        <div class="container mx-auto relative z-10">
            <i class="fas fa-play play-button autoplay-video mt-40 md:mt-56 lg:mt-64 mb-3 md:mb-3" data-open="trailer"></i><br>
            <img class="h-20 md:h-32 lg:h-40" src="https://cdn.musora.com/image/fetch/w_980,q_auto:best/https://singeo.s3.amazonaws.com/products/singing-starter-kit/logo.png"><br>
            <h4 class="mt-2 mb-5">Everything You Need To Start Singing Now</h4>
            <a class="join" href="@yield('order-link')">START SINGING FOR
                @if($productPrice < floatval($productPrices['singing-starter-kit']->price))
                    <s class="opacity-50">${{ floatval($productPrices['singing-starter-kit']->price) }}</s>
                @endif
                ${{ $productPrice }} </a>
            <h6 class="font-bebas text-yellow-400 mt-5">
                @if($productPrice < floatval($productPrices['singing-starter-kit']->price))
                    SAVE {{ round(100 - (100 * ($productPrice / floatval($productPrices['singing-starter-kit']->price)))) }}% <br>
                @endif
                <span class="text-white">** 90-DAY GUARANTEE**</span></h6>
        </div>
    </header>

    @yield('banner')

    <section class="text-white sm:px-5 sm:py-12 relative" style="background:#000419;">
        <div class="container mx-auto relative max-w-5xl">
            <div class="py-6 sm:py-8 lg:py-14 px-4 sm:px-5 lg:px-10 bg-cover overflow-hidden sm:rounded-2xl bg-center sm:bg-left lazyload" {{--style="background-position: 60% 50%;"--}} data-bg="https://cdn.musora.com/image/fetch/w_2000,q_auto:best/https://singeo.s3.amazonaws.com/products/singing-starter-kit/intro2.jpg">
                <div class="w-full sm:w-3/5 lg:w-1/2 relative z-10">
                    <p class="leading-tight text-left">Start your singing journey the <em>right</em> way with The Singing Starter Kit.
                        <br><br>
                        Get rid of all the guesswork and frustration as you follow along with 6 step-by-step lessons to discover your beautiful, unique voice.
                        <br><br>
                        Use “The Most Important Vocal Exercise” to warm up your voice, and unlock the “Singer’s Secret Weapon” that will <em>instantly</em> make you sound better.
                        <br><br>
                        Plus you’ll have support and feedback from real teachers to help you at every turn.
                        <br><br>
                        The hardest part of any journey is the first step…
                        <br><br>
                        Take yours with confidence thanks to our 90-day guarantee and start singing today.
                    </p>
                    <a class="join smaller mt-5 w-full sm:w-2/3" href="/ecommerce/add-to-cart?products[singing-starter-kit]=1&redirect=/order">START SINGING &raquo;</a>
                </div>
                <div class="hidden sm:block absolute inset-0 z-0" style="background:linear-gradient(to right, #000419, transparent);"></div>
                <div class="block sm:hidden absolute inset-0 z-0" style="background:rgba(0,4,25,0.6);"></div>
            </div>
        </div>
    </section>

    <section class="text-center text-white py-10 md:py-20 lg:py-24 overflow-hidden" style="background:#000419;">
        <div class="container mx-auto">
            <div class="text-left mx-auto w-full" style="max-width:1024px; margin-bottom: 0;">
                <div class="px-5 mb-6 sm:mb-20">
                    <div class="md:flex flex-wrap items-start md:items-center">
                        <div class="w-full md:w-2/5 lg:w-1/2 px-5 md:px-0 relative">
                            <h1 class="text-singeo absolute bottom-0 text-7xl lg:text-9xl -left-5 lg:-left-10 font-hey-august text-pink-gradient"><strong>01</strong></h1>
                            <img class="rounded-3xl" src="https://cdn.musora.com/image/fetch/w_900,q_auto:best/https://singeo.s3.amazonaws.com/products/singing-starter-kit/introduction.jpg">
                        </div>
                        <div class="w-full md:w-3/5 lg:w-1/2 mb-4 md:mb-0 md:pl-10 lg:pl-12 pt-7">
                            <h3 class="text-purple-gradient leading-normal"><strong>Welcome To The Singing Starter Kit!</strong></h3>
                            <p class="leading-relaxed mt-3 md:mt-5">Get ready to sing! These are your first steps towards confident singing! This video will tell you exactly what to expect and what you will need as you move forward through these lessons.</p>

                        </div>
                    </div>
                </div>
                <div class="px-5 mb-6 sm:mb-20">
                    <div class="md:flex flex-wrap items-start md:items-center">
                        <div class="w-full md:w-2/5 lg:w-1/2 px-5 md:px-0 relative sm:order-2">
                            <h1 class="text-singeo absolute bottom-0 text-7xl lg:text-9xl -left-5 lg:-left-10 font-hey-august text-pink-gradient"><strong>02</strong></h1>
                            <img class="rounded-3xl" src="https://cdn.musora.com/image/fetch/w_900,q_auto:best/https://singeo.s3.amazonaws.com/products/singing-starter-kit/lesson1.jpg"></div>
                        <div class="w-full md:w-3/5 lg:w-1/2 mb-4 md:mb-0 md:pr-10 lg:pr-12 pt-7">
                            <h3 class="text-purple-gradient leading-normal"><strong>3 MUST-KNOW Singing Basics!</strong></h3>
                            <p class="leading-relaxed mt-3 md:mt-5">Let’s make some noise. This video will uncover some simple, yet very impactful tips and exercises for singing. Even as a beginner, you will be gaining valuable knowledge that some seasoned singers don’t even know.</p>

                        </div>
                    </div>
                </div>
                <div class="px-5 mb-6 sm:mb-20">
                    <div class="md:flex flex-wrap items-start md:items-center">
                        <div class="w-full md:w-2/5 lg:w-1/2 px-5 md:px-0 relative">
                            <h1 class="text-singeo absolute bottom-0 text-7xl lg:text-9xl -left-5 lg:-left-10 font-hey-august text-pink-gradient"><strong>03</strong></h1>
                            <img class="rounded-3xl" src="https://cdn.musora.com/image/fetch/w_900,q_auto:best/https://singeo.s3.amazonaws.com/products/singing-starter-kit/lesson2.jpg"></div>
                        <div class="w-full md:w-3/5 lg:w-1/2 mb-4 md:mb-0 md:pl-10 lg:pl-12 pt-7">
                            <h3 class="text-purple-gradient leading-normal"><strong>Understanding Your Unique Voice!</strong></h3>
                            <p class="leading-relaxed mt-3 md:mt-5">One of the most valuable lessons you can understand and embrace as a singer, is that your voice is completely and utterly unique to YOU!  This video will reveal your unique voice and why you should be excited to learn and understand the beauty of being “different”.</p>

                        </div>
                    </div>
                </div>
                <div class="px-5 mb-6 sm:mb-20">
                    <div class="md:flex flex-wrap items-start md:items-center">
                        <div class="w-full md:w-2/5 lg:w-1/2 px-5 md:px-0 relative sm:order-2">
                            <h1 class="text-singeo absolute bottom-0 text-7xl lg:text-9xl -left-5 lg:-left-10 font-hey-august text-pink-gradient"><strong>04</strong></h1>
                            <img class="rounded-3xl" src="https://cdn.musora.com/image/fetch/w_900,q_auto:best/https://singeo.s3.amazonaws.com/products/singing-starter-kit/lesson3.jpg"></div>
                        <div class="w-full md:w-3/5 lg:w-1/2 mb-4 md:mb-0 md:pr-10 lg:pr-12 pt-7">
                            <h3 class="text-purple-gradient leading-normal"><strong>The Most Important Vocal Exercise</strong></h3>
                            <p class="leading-relaxed mt-3 md:mt-5">This vocal exercise will have you giggling and feeling a bit ridiculous… which is good (laughing is healthy!). It’s also normal, and with some practice you will notice your voice getting stronger from this powerful exercise!</p>

                        </div>
                    </div>
                </div>
                <div class="px-5 mb-6 sm:mb-20">
                    <div class="md:flex flex-wrap items-start md:items-center">
                        <div class="w-full md:w-2/5 lg:w-1/2 px-5 md:px-0 relative">
                            <h1 class="text-singeo absolute bottom-0 text-7xl lg:text-9xl -left-5 lg:-left-10 font-hey-august text-pink-gradient"><strong>05</strong></h1>
                            <img class="rounded-3xl" src="https://cdn.musora.com/image/fetch/w_900,q_auto:best/https://singeo.s3.amazonaws.com/products/singing-starter-kit/lesson4.jpg"></div>
                        <div class="w-full md:w-3/5 lg:w-1/2 mb-4 md:mb-0 md:pl-10 lg:pl-12 pt-7">
                            <h3 class="text-purple-gradient leading-normal"><strong>Sing Songs Better!</strong></h3>
                            <p class="leading-relaxed mt-3 md:mt-5">SONGS! That’s the goal, right?  We all want to sing songs! This video will show you the best way to approach singing your favorite songs… and maybe surprise your friends at the next karaoke night.</p>

                        </div>
                    </div>
                </div>
                <div class="px-5 mb-6 sm:mb-20">
                    <div class="md:flex flex-wrap items-start md:items-center">
                        <div class="w-full md:w-2/5 lg:w-1/2 px-5 md:px-0 relative sm:order-2">
                            <h1 class="text-singeo absolute bottom-0 text-7xl lg:text-9xl -left-5 lg:-left-10 font-hey-august text-pink-gradient"><strong>06</strong></h1>
                            <img class="rounded-3xl" src="https://cdn.musora.com/image/fetch/w_900,q_auto:best/https://singeo.s3.amazonaws.com/products/singing-starter-kit/lesson5.jpg"></div>
                        <div class="w-full md:w-3/5 lg:w-1/2 mb-4 md:mb-0 md:pr-10 lg:pr-12 pt-7">
                            <h3 class="text-purple-gradient leading-normal"><strong>Singer’s Secret Weapon!</strong></h3>
                            <p class="leading-relaxed mt-3 md:mt-5">This truly is a game-changer when it comes to singing. The singer’s secret weapon will change the way you look at singing forever! And it will also change the way you sing… for the better!</p>

                        </div>
                    </div>
                </div>
                <div class="px-5">
                    <div class="md:flex flex-wrap items-start md:items-center">
                        <div class="w-full md:w-2/5 lg:w-1/2 px-5 md:px-0 relative">
                            <h1 class="text-singeo absolute bottom-0 text-7xl lg:text-9xl -left-5 lg:-left-10 font-hey-august text-pink-gradient"><strong>07</strong></h1>
                            <img class="rounded-3xl" src="https://cdn.musora.com/image/fetch/w_900,q_auto:best/https://singeo.s3.amazonaws.com/products/singing-starter-kit/lesson6.jpg"></div>
                        <div class="w-full md:w-3/5 lg:w-1/2 mb-4 md:mb-0 md:pl-10 lg:pl-12 pt-7">
                            <h3 class="text-purple-gradient leading-normal"><strong>Congratulations!</strong></h3>
                            <p class="leading-relaxed mt-3 md:mt-5">Congratulations you’ve just successfully kickstarted your singing journey! This video will give you some helpful pointers for you to move forward as a singer and keep your voice in shape.</p>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="lisa-bio text-white pt-10 md:pt-44 lg:pt-64 pb-0 md:pb-16 lg:pb-36 px-4 relative bg-cover bg-top lazyload" style="background-color:#100924;" data-bg="https://cdn.musora.com/image/fetch/w_1900,q_auto:best/https://singeo.s3.amazonaws.com/products/singing-starter-kit/bio-bg.jpg">
        <div class="container mx-auto max-w-5xl relative z-10">
            <div class="md:flex flex-wrap md:w-7/12 ml-auto order-1 text-center md:text-left">
                <h5 class="m-0 leading-none"><strong>Meet Your Singing Teacher</strong></h5>
                <img class="h-10 md:h-20 lg:h-24 mt-2 md:mt-3 mb-44 md:mb-5" src="https://cdn.musora.com/image/fetch/w_880,q_auto:best/https://singeo.s3.amazonaws.com/products/singing-starter-kit/lisa.png">
                <p class="leading-normal md:leading-relaxed text-left">Lisa Witt has been teaching singing for over {{ date('Y') - 2008 }} years, and is arguably the happiest vocal coach on the planet! With a background in classical and contemporary vocal training combined with a deep love for popular music, Lisa focuses on guiding her students (that’s you!) to find their own, unique sound. Using simple routines, practical exercises, and tips for faster results, Lisa helps her students gain strength, control, and confidence in singing.</p>
            </div>
        </div>
    </section>

    <div id="testimonials" class="anchor"></div>
    <section class="text-center text-white py-20 md:py-20 lg:py-24" style="background:#000419;">
        <div class="container mx-auto">
            <h2 class="mb-7 md:mb-10 lg:mb-12"><strong>The voices of Singeo singers...</strong></h2>
            <div class="slick-2 mx-auto text-left" style="max-width:1100px;">
                <div class="px-2">
                    <div class="rounded-2xl p-3 md:p-8" style="background:linear-gradient(to bottom, #1e0338, #060416)">
                        <p class="leading-normal md:leading-relaxed">"I practice every day driving to work. I have learned things about my voice I never imagined I could do.  I now take note of my breath before starting every song. I have more control, and sing consciously, instead of just opening my mouth and pushing out noise"</p>
                        <div class="flex items-center pt-5 md:pt-8">
                            <img class="rounded-full w-1/4 lazyload" data-src="https://cdn.musora.com/image/fetch/w_140,q_auto:best/https://singeo.s3.amazonaws.com/products/singing-starter-kit/diane.jpg">
                            <div class="text pl-3 md:pl-5">
                                <p class="text-singeo leading-none"><strong>Diane Smith</strong></p>
                                <p class="text-singeo leading-none pt-1">Burnley, England</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="px-2">
                    <div class="rounded-2xl p-3 md:p-8" style="background:linear-gradient(to bottom, #1e0338, #060416)">
                        <p class="leading-normal md:leading-relaxed">"I was a singing teacher before I changed careers. I missed singing. Singeo absolutely provided the vocal exercises I needed to pull my voice back into shape. There's nothing else out there in a self-contained course that I can use when and where it suits my schedule. Great course. Well worth the money."</p>
                        <div class="flex items-center pt-5 md:pt-8">
                            <img class="rounded-full w-1/4 lazyload" data-src="https://cdn.musora.com/image/fetch/w_140,q_auto:best/https://singeo.s3.amazonaws.com/products/singing-starter-kit/susan.jpg">
                            <div class="text pl-3 md:pl-5">
                                <p class="text-singeo leading-none"><strong>Susan French</strong></p>
                                <p class="text-singeo leading-none pt-1">California, USA</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="px-2">
                    <div class="rounded-2xl p-3 md:p-8" style="background:linear-gradient(to bottom, #1e0338, #060416)">
                        <p class="leading-normal md:leading-relaxed">"For the first time, I sang at church and it felt wonderful! Was I terrific? Probably not.  Do I have to be? No!  Did I sing balanced? Yes!  Was I better than a month ago? Absolutely!!!!  Did I hate my voice? For once…no!   I have discovered that I don't have to be a professional to thoroughly ENJOY singing and have it enrich my life! I’m looking forward to many more “moments of wow” as my journey goes forward with Singeo!"</p>
                        <div class="flex items-center pt-5 md:pt-8">
                            <img class="rounded-full w-1/4 lazyload" data-src="https://cdn.musora.com/image/fetch/w_140,q_auto:best/https://singeo.s3.amazonaws.com/products/singing-starter-kit/kelly.jpg">
                            <div class="text pl-3 md:pl-5">
                                <p class="text-singeo leading-none"><strong>Kelly</strong></p>
                                <p class="text-singeo leading-none pt-1">Indiana, USA</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="text-white pb-20 md:pb-20 lg:pb-24" style="background:#000419;">
        <div class="container mx-auto">
            <div class="flex items-start lg:items-center flex-wrap md:flex-nowrap max-w-5xl mx-auto px-5 md:px-6 lg:px-8 text-center md:text-left">
                <img class="w-36 md:w-52 lg:w-60 mb-5 md:mb-0 mx-auto md:order-1 inline-block lazyload" data-src="https://cdn.musora.com/image/fetch/w_480,q_auto:best/https://singeo.s3.amazonaws.com/sales/2021/guarantee.png">
                <div class="md:pr-8 lg:pr-10">
                    <h2 class="mb-4 lg:mb-7"><strong>Think you are the ONE person who actually CAN’T sing? </strong></h2>
                    <p class="leading-normal">You love to sing, so sing! The Singing Starter Kit comes with a full 90-day money-back guarantee so you can try singing risk-free. We want you to see (and HEAR) the positive changes in your voice as you gain strength and control through guided practice.</p>
                </div>
            </div>
        </div>
    </section>

    <section class="text-center text-white py-16 md:py-20 lg:py-24 bg-cover bg-left md:bg-center lazyload" style="background-color:#210436;" data-bg="https://singeo.s3.amazonaws.com/products/singing-starter-kit/final-bg.jpg">
        <div class="container mx-auto">
            <img class="h-20 md:h-32 lg:h-40" src="https://cdn.musora.com/image/fetch/w_980,q_auto:best/https://singeo.s3.amazonaws.com/products/singing-starter-kit/logo.png"><br>
            <h4 class="mt-2 mt-3 leading-normal">Everything You Need To Start Singing Now</h4>
            <a class="join my-2 md:my-3" href="@yield('order-link')">START SINGING FOR
                @if($productPrice < floatval($productPrices['singing-starter-kit']->price))
                    <s class="opacity-50">${{ floatval($productPrices['singing-starter-kit']->price) }}</s>
                @endif
                ${{ $productPrice }}</a>
            <h6 class="font-bebas text-yellow-400">
                @if($productPrice < floatval($productPrices['singing-starter-kit']->price))
                    SAVE {{ round(100 - (100 * ($productPrice / floatval($productPrices['singing-starter-kit']->price)))) }}% <br>
                @endif
                <span class="text-white">** 90-DAY GUARANTEE**</span></h6>
            <div class="mt-5 md:mt-10 inline-block w-full px-3 md:px-4 credit-cards opacity-60">
                <i class="fab fa-cc-visa"></i>
                <i class="fab fa-cc-mastercard"></i>
                <i class="fab fa-cc-amex"></i>
                <i class="fab fa-cc-paypal"></i>
                <i class="fab fa-cc-discover"></i>
            </div>
            <div class="inline-block w-full px-3 md:px-4 mt-3 md:mt-4 opacity-60">
                <p class="leading-normal"><strong>Any questions?</strong><br class="inline-block md:hidden"> Call us toll-free at
                    <a href="tel:+18004398921">1-800-439-8921</a> <br class="inline-block md:hidden"> or directly at
                    <a href="tel:+16048557605">1-604-855-7605</a>.<br> All prices listed in USD. </p>
            </div>
        </div>
    </section>



    <section class="text-center text-white py-10 md:py-20 lg:py-24" style="background:#000419;">
        <div class="container mx-auto">
            <h2 class="mb-5"><strong>Are There Any Questions? </strong></h2>
            <div class="dropdowns max-w-4xl mx-auto px-4">
                @include('singeo.sales.partials._dropdown', [
                "customClass" => "rounded-3xl",
                "question" => true,
                "title" => "Is There An Age Limit For Learning To Sing?",
                "description" => "If you can speak, you CAN sing.  There’s no age limit for when you can experience the enrichment that singing brings to your life.  Everyone progresses differently, so it’s important to remember to have patience with yourself and celebrate the milestones of your personal singing journey.",
                ])
                @include('singeo.sales.partials._dropdown', [
                "customClass" => "rounded-3xl",
                "question" => true,
                "title" => "I Have Extreme “Stage Fright”. Can I Still Learn To Sing?",
                "description" => "Absolutely! Singing is more than a performance. You don’t have to have an audience to sing. Singing can just be for YOU.  And when you take the time to learn and practice properly you will gain confidence in your singing and, when you’re ready, maybe you WILL take the stage!",
                ])
                @include('singeo.sales.partials._dropdown', [
                "customClass" => "rounded-3xl",
                "question" => true,
                "title" => "Can I Really Learn How To Sing Online?",
                "description" => "Great question!  Yes, you absolutely can. Our lessons are specifically designed for at-home learning.  Learning from home, in a space that makes you feel comfortable, helps you progress at your own pace without the intimidation of singing in front of anyone. If you have questions at any time, just reach out to us and get feedback from REAL teachers.",
                ])
            </div>
        </div>
    </section>

    <div class="reveal max-w-6xl" id="trailer" data-reveal data-reset-on-close="false">
        <div class="aspect-16:9 w-full relative">
            <iframe class="absolute w-full h-full reset-on-close" src="" data-lazy-load-url="//player.vimeo.com/video/594806758?autoplay=1" frameborder="0" allowfullscreen allow="autoplay"></iframe>
        </div>
    </div>

    @include("singeo.sales.partials._footer")

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick.min.js"></script>
    <script>
        $(function () {
            $(document).foundation();

            $('.slick-2').slick({
                slidesToShow: 3,
                responsive: [
                    {
                        breakpoint: 1024,
                        settings: {
                            slidesToShow: 2,
                            centerMode: true
                        }
                    },
                    {
                        breakpoint: 768,
                        settings: {
                            slidesToShow: 1,
                            centerMode: true
                        }
                    }
                ]

            });

            $('.dropdown').on('click', function(){
                $(this).toggleClass('active');
                $(this).find('i').toggleClass('rotate-180');
            });
        });
    </script>
    <script type="text/javascript" src="{{ asset('/marketing/parcel/drumeo/navigation-sales.js') }}"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/lazysizes/5.3.2/lazysizes.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/lazysizes/5.3.2/plugins/unveilhooks/ls.unveilhooks.min.js"></script>
    <script type="text/javascript" src="{{ asset('/marketing/js/modal.js') }}"></script>
    <script type="text/javascript" src="{{ asset('/marketing/js/modal-autoplay.js') }}"></script>
@stop
