@extends('guitareo._partials.global-vue-layout')

@section('meta')
    @parent
    <title>Rhythm & Groove | Guitareo</title>
    <meta property="og:title" content="Rhythm & Groove | Guitareo"/>

    <meta name="description" content="Go beyond simple strumming on the guitar.">
    <meta property="og:description" content="Go beyond simple strumming on the guitar.">

    <meta property="og:image" content="https://guitareo.s3.amazonaws.com/shop/rhythm-and-groove/share-image.png" style="display: none;">
    <meta property="og:url" content="https://www.guitareo.com/{{ Request::path() }}">
@stop()

@section('styles')
    @parent
    @include('_partials.layout._tailwindcdn')
    <link rel="stylesheet" href="{{ asset('/marketing/css/tailwind-helpers.css') }}">
    <link href="{{ asset('/marketing/parcel/guitareo/sales-page.css') }}" rel="stylesheet">
    <link href="{{ asset('/marketing/parcel/guitareo/nav-footer.css') }}" rel="stylesheet">
@stop()


@section('content')
    @include("guitareo.sales.partials._nav", [
        "cartVersion" => true
    ])
    @include('guitareo._partials.promo-banner', [
        "name" => "Rhythm & Groove",
        "fullPrice" => floatval($productPrices['rhythm-and-groove']->price),
        "price" => floatval($productPrices['rhythm-and-groove']->discounted_price),
        "noBreadcrumb" => true
    ])

    <header class="px-5 sm:px-6 py-8 lg:py-10 text-white text-center bg-cover bg-center relative lazyload" style="background-color:#020b17;" data-bg="https://www.musora.com/musora-cdn/image/width=2500,quality=85/https://guitareo.s3.amazonaws.com/shop/rhythm-and-groove/header.jpg">
        <div class="container mx-auto max-w-5xl relative z-10">
            <img class="h-16 sm:h-20 lg:h-24" src="https://www.musora.com/musora-cdn/image/width=1200,quality=85/https://guitareo.s3.amazonaws.com/shop/rhythm-and-groove/Logo.svg" alt="Rhythm and groove logo"><br>
            <i class="fas fa-play play-button mt-56 sm:mt-80 mb-5 sm:mb-24 lg:mb-28 autoplay-video" data-open="trailer"></i>
            <h2><strong>Go beyond simple<br class="inline sm:hidden"> strumming</strong> on the guitar.</h2>
            <a class="join my-3 md:my-4 w-full max-w-xl" href="{{ url()->route('shopping-cart.add-to-cart', ['products' => ['rhythm-and-groove' => 1], 'redirect' => '/order']) }}">Start Your Course</a>
            <h3>
                @if(floatval($productPrices['rhythm-and-groove']->price) > floatval($productPrices['rhythm-and-groove']->discounted_price))
                    <s class="opacity-60">${{ floatval($productPrices['rhythm-and-groove']->price) }}</s>
                @endif
                <strong class="">Only ${{ floatval($productPrices['rhythm-and-groove']->discounted_price) }}</strong> {{--<span style="font-size: 75%;"><em>({{ round(100 - (100 * (floatval($productPrices['rhythm-and-groove']->discounted_price) / floatval($productPrices['rhythm-and-groove']->price)))) }}% off)</em></span>--}}</h3>
            <p class="leading-tight mt-2"><strong><a href="/" class="text-guitareo">(OR FREE WITH A GUITAREO MEMBERSHIP)</a><br>
                    <span class="text-coaches">** 90-DAY GUARANTEE **</span></strong></p>
        </div>
        <div class="absolute inset-0 z-0" style="background:linear-gradient(to bottom, transparent 70%, #020b17);"></div>
    </header>
    <section class="px-5 sm:px-6 py-10 sm:py-14 lg:py-20 text-white" style="background-color:#020b17;">
        <div class="container mx-auto max-w-4xl">
            <div class="sm:flex justify-center items-center">
                <img class="float-right h-24 sm:h-44 lg:h-60 mb-4 sm:mb-0 ml-3 sm:ml-0 sm:order-1 lazyload" data-src="https://www.musora.com/musora-cdn/image/width=620,quality=85/https://guitareo.s3.amazonaws.com/shop/rhythm-and-groove/music_guitar.png" alt="Guitar icon">
                <p class="leading-normal sm:pr-5 flex-grow">Rhythm is an essential part of playing guitar. Without it, songs can sound flat and dull to yourself and listeners. Anyone can lose interest in basic strums without a sense of groove or feel.
                    <br><br>
                    It’s also one of the most challenging skills for guitarists to learn. That’s why we created an easy-to-follow course you can complete in under two hours – to get you excited and confident in playing rhythm on the guitar.</p>
            </div>
        </div>
    </section>
    <div class="h-5 sm:h-7" style="background: linear-gradient(to top left, transparent calc(50% - 1px), transparent, #020b17 calc(50% + 1px));"></div>
    <section class="text-center px-5 sm:px-6 py-10 sm:py-14 lg:py-20 text-center">
        <div class="container mx-auto max-w-5xl">
            <h2 class="leading-normal"><strong>Stop playing guitar<br class="inline sm:hidden"> like a robot.</strong></h2>

            <p class="leading-normal mt-2 sm:mt-4 mb-8 sm:mb-12">Leave awkward strumming behind. <strong>Watch these four demonstrations</strong> to see how<br class="hidden sm:inline">
                you’ll take one chord progression and express it musically in many different ways.</p>
            <div class="flex flex-wrap items-start">
                <div class="w-full sm:w-1/2 px-3 lg:px-5 mb-7 sm:mb-8 lg:mb-10">
                    <div class="overflow-hidden rounded-xl mb-3 sm:mb-4 aspect-16:9 w-full relative">
                        <iframe class="absolute w-full h-full" src="//player.vimeo.com/video/740449488" frameborder="0" allowfullscreen allow="autoplay" title="Jim and Jack"></iframe>
                    </div>
                    <h5><strong>Jim and Jack</strong></h5>
                </div>
                <div class="w-full sm:w-1/2 px-3 lg:px-5 mb-7 sm:mb-8 lg:mb-10">
                    <div class="overflow-hidden rounded-xl mb-3 sm:mb-4 aspect-16:9 w-full relative">
                        <iframe class="absolute w-full h-full" src="//player.vimeo.com/video/740449454" frameborder="0" allowfullscreen allow="autoplay" title="Playing Triplets"></iframe>
                    </div>
                    <h5><strong>Playing Triplets</strong></h5>
                </div>
                <div class="w-full sm:w-1/2 px-3 lg:px-5 mb-7 sm:mb-8 lg:mb-10">
                    <div class="overflow-hidden rounded-xl mb-3 sm:mb-4 aspect-16:9 w-full relative">
                        <iframe class="absolute w-full h-full" src="//player.vimeo.com/video/740449465" frameborder="0" allowfullscreen allow="autoplay" title="Sultas of Swing"></iframe>
                    </div>
                    <h5><strong>Sultans of Swing</strong></h5>
                </div>
                <div class="w-full sm:w-1/2 px-3 lg:px-5 sm:mb-8 lg:mb-10">
                    <div class="overflow-hidden rounded-xl mb-3 sm:mb-4 aspect-16:9 w-full relative">
                        <iframe class="absolute w-full h-full" src="//player.vimeo.com/video/740449434" frameborder="0" allowfullscreen allow="autoplay" title="Creating Space"></iframe>
                    </div>
                    <h5><strong>Creating Space</strong></h5>
                </div>
            </div>

        </div>
    </section>
    <section class="text-center px-5 sm:px-6 py-10 sm:py-14 lg:py-20" style="background-color:#f5f5f7;">
        <div class="container mx-auto max-w-5xl">
            <h2 class="leading-normal"><strong>Make your chords<br class="inline sm:hidden"> come alive.</strong></h2>
            <p class="leading-normal mt-2 sm:mt-4 mb-8 sm:mb-12">Get in the groove to elevate your guitar playing. You’ll go from learning the most basic strum<br class="hidden sm:inline">
                patterns to exciting rhythmic techniques you can throw into any song or practice session.</p>

            <div class="flex flex-wrap items-start justify-center text-left">
                <div class="w-full sm:w-1/2 lg:w-1/3 px-3 mb-8 sm:mb-6">
                    <div data-open="meetSami" class="cursor-pointer autoplay-video relative bg-cover bg-center rounded-xl mb-2 sm:mb-3 bg-black lazyload" style="padding-bottom: 65%;" data-bg="https://www.musora.com/musora-cdn/image/width=640,quality=85/https://guitareo.s3.amazonaws.com/shop/rhythm-and-groove/thumb_meet.jpg">
                        <div class="join white smaller absolute bottom-4 left-4"><i class="fas fa-play"></i> PREVIEW</div>
                    </div>
                    <p class="leading-tight"><strong>Intro - The Importance of Rhythm</strong><br>
                    Meet Sami Ghawi, Ayla’s guitar teacher!</p>
                </div>
                <div class="w-full sm:w-1/2 lg:w-1/3 px-3 mb-8 sm:mb-6">
                    <div class="relative bg-cover bg-center rounded-xl mb-2 sm:mb-3 bg-black lazyload" style="padding-bottom: 65%;" data-bg="https://www.musora.com/musora-cdn/image/width=640,quality=85/https://guitareo.s3.amazonaws.com/shop/rhythm-and-groove/thumb_feel.jpg"></div>
                    <p class="leading-tight"><strong>The Essentials of Rhythm</strong><br>
                    Feel the groove. Learn how to connect with the rhythm using your ears and hands.</p>
                </div>
                <div class="w-full sm:w-1/2 lg:w-1/3 px-3 mb-8 sm:mb-6">
                    <div class="relative bg-cover bg-center rounded-xl mb-2 sm:mb-3 bg-black lazyload" style="padding-bottom: 65%;" data-bg="https://www.musora.com/musora-cdn/image/width=640,quality=85/https://guitareo.s3.amazonaws.com/shop/rhythm-and-groove/thumb_learn.jpg"></div>
                    <p class="leading-tight"><strong>It All Starts With Counting</strong><br>
                    Stay on the beat. Learn how to improve your timing and tempo using your voice, hands, and the guitar.</p>
                </div>
                <div class="w-full sm:w-1/2 lg:w-1/3 px-3 mb-8 sm:mb-6">
                    <div class="relative bg-cover bg-center rounded-xl mb-2 sm:mb-3 bg-black lazyload" style="padding-bottom: 65%;" data-bg="https://www.musora.com/musora-cdn/image/width=640,quality=85/https://guitareo.s3.amazonaws.com/shop/rhythm-and-groove/thumb_strum.jpg"></div>
                    <p class="leading-tight"><strong>Make Your Strum Patterns FEEL Good!</strong><br>
                    Strum with accents and fun patterns. Hear the most typical rhythms for genres (including rock, country, reggae, etc.)</p>
                </div>
                <div class="w-full sm:w-1/2 lg:w-1/3 px-3 mb-8 sm:mb-6">
                    <div class="relative bg-cover bg-center rounded-xl mb-2 sm:mb-3 bg-black lazyload" style="padding-bottom: 65%;" data-bg="https://www.musora.com/musora-cdn/image/width=640,quality=85/https://guitareo.s3.amazonaws.com/shop/rhythm-and-groove/thumb_spice.jpg"></div>
                    <p class="leading-tight"><strong>Sultans of Swing Fill</strong><br>
                    Learn to play this fun and exciting skip fill. Spice up your music and practice sessions by using more rhythmic fills.</p>
                </div>
                <div class="w-full sm:w-1/2 lg:w-1/3 px-3 mb-8 sm:mb-6">
                    <div class="relative bg-cover bg-center rounded-xl mb-2 sm:mb-3 bg-black lazyload" style="padding-bottom: 65%;" data-bg="https://www.musora.com/musora-cdn/image/width=640,quality=85/https://guitareo.s3.amazonaws.com/shop/rhythm-and-groove/thumb_triplets.jpg"></div>
                    <p class="leading-tight"><strong>Playing Triplets</strong><br>
                    Use triplets to change the dynamics of a song. Play this popular rhythm in All My Loving by The Beatles.</p>
                </div>
                <div class="w-full sm:w-1/2 lg:w-1/3 px-3 mb-8 sm:mb-6">
                    <div class="relative bg-cover bg-center rounded-xl mb-2 sm:mb-3 bg-black lazyload" style="padding-bottom: 65%;" data-bg="https://www.musora.com/musora-cdn/image/width=640,quality=85/https://guitareo.s3.amazonaws.com/shop/rhythm-and-groove/thumb_changing.jpg"></div>
                    <p class="leading-tight"><strong>Change Up the Feel To Create Interest</strong><br>
                    Keep your audience engaged. Use rhythmic techniques such as palm mutes, accents, crescendos, etc.</p>
                </div>
                <div class="w-full sm:w-1/2 lg:w-1/3 px-3 mb-8 sm:mb-6">
                    <div class="relative bg-cover bg-center rounded-xl mb-2 sm:mb-3 bg-black lazyload" style="padding-bottom: 65%;" data-bg="https://www.musora.com/musora-cdn/image/width=640,quality=85/https://guitareo.s3.amazonaws.com/shop/rhythm-and-groove/thumb_creating.jpg"></div>
                    <p class="leading-tight"><strong>Putting It All Together – Creating Space</strong><br>
                    Space is required! Create space in your guitar playing to let listeners breathe.</p>
                </div>
                <div class="w-full sm:w-1/2 lg:w-1/3 px-3 mb-8 sm:mb-6">
                    <div class="relative bg-cover bg-center rounded-xl mb-2 sm:mb-3 bg-black lazyload" style="padding-bottom: 65%;" data-bg="https://www.musora.com/musora-cdn/image/width=640,quality=85/https://guitareo.s3.amazonaws.com/shop/rhythm-and-groove/thumb_bonus.jpg"></div>
                    <p class="leading-tight"><strong>Bonus Q&A</strong><br>
                    View exclusive content with Sami Ghawi that answers questions from real students.</p>
                </div>
            </div>

            <div class="inline-block mx-auto my-4 w-12 h-2 rounded-full bg-guitareo"></div>

            <p class="leading-normal mb-24 max-w-xl lg:max-w-2xl">Each lesson is designed to build on the previous one, so you’ll be reinforcing what you’ve already learned while developing new skills. It WILL take practice -- but it won’t take months. Most students can expect to complete these lessons in less than two weeks (including practice time.)</p>

            <h2 class="leading-normal"><strong>Rhythm Simplified</strong></h2>
            <p class="leading-normal mt-4 mb-20 lg:mb-16">Rhythm guitar shouldn’t be complicated. That’s why we created this course that<br class="hidden sm:inline">
                provides the resources and content you need to start grooving on the guitar.</p>
        </div>
    </section>
    <div class="h-5 sm:h-7 -mt-5 sm:-mt-7" style="background: linear-gradient(to bottom right, transparent calc(50% - 1px), transparent, #00101d calc(50% + 1px));"></div>
    <section class="text-center px-5 sm:px-6 pb-10 sm:pb-14 lg:pb-20" style="background-color:#00101d;">
        <div class="container max-w-5xl mx-auto">
            <div class="flex justify-center z-30 relative">
                <div class="rounded-xl md:max-w-3xl lg:max-w-5xl bg-white py-6 md:py-8 lg:py-10 px-6 md:px-8 lg:px-20 -mt-24 mb-20 lg:mb-28 relative shadow-2xl">
                    <div class="flex items-start mb-6 text-left">
                        <img class="h-8 lg:h-10 lazyload" data-src="https://guitareo.s3.amazonaws.com/shop/rhythm-and-groove/beyond_icon.svg" alt="Beyond icon">
                        <div class="flex-grow pl-4">
                            <h5 class="text-guitareo"><strong>BEYOND BEGINNER</strong></h5>
                            <p class="leading-tight mt-1">For best results, you should know your basic chords.</p>
                        </div>
                    </div>
                    <div class="flex items-start mb-6 text-left">
                        <img class="h-8 lg:h-10 lazyload" data-src="https://guitareo.s3.amazonaws.com/shop/rhythm-and-groove/sized_icon.svg" alt="Sized icon">
                        <div class="flex-grow pl-4">
                            <h5 class="text-guitareo"><strong>8 BITE-SIZED LESSONS</strong></h5>
                            <p class="leading-tight mt-1">Spend more time playing, not watching. Each lesson is between 6 to 13 minutes long.</p>
                        </div>
                    </div>
                    <div class="flex items-start mb-6 text-left">
                        <img class="h-8 lg:h-10 lazyload" data-src="https://guitareo.s3.amazonaws.com/shop/rhythm-and-groove/practice_icon.svg" alt="Practice icon">
                        <div class="flex-grow pl-4">
                            <h5 class="text-guitareo"><strong>23 PRACTICE ALONGS</strong></h5>
                            <p class="leading-tight mt-1">You'll have short assignments to improve your strumming patterns and techniques.</p>
                        </div>
                    </div>
                    <div class="flex items-start text-left">
                        <img class="h-8 lg:h-10 lazyload" data-src="https://guitareo.s3.amazonaws.com/shop/rhythm-and-groove/forever_icon.svg" alt="Forever icon">
                        <div class="flex-grow pl-4">
                            <h5 class="text-guitareo"><strong>YOURS FOREVER</strong></h5>
                            <p class="leading-tight mt-1">You'll have instant + lifetime access – to enjoy the lessons on your schedule.</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="flex flex-wrap sm:flex-nowrap items-start justify-center sm:mt-8 mb-20">
                <img class="border-8 border-white rounded-3xl shadow-xl w-52 sm:w-72 lg:w-96 relative -mb-8 sm:mb-0 sm:-mt-8 sm:-mr-8 z-10 lazyload" data-src="https://www.musora.com/musora-cdn/image/width=760,quality=85/https://guitareo.s3.amazonaws.com/shop/rhythm-and-groove/coach.jpg" alt="Coach profile">

                <div class="text-left bg-white text-black rounded-xl pt-14 pb-8 sm:py-10 lg:py-12 px-6 sm:pr-10 sm:pl-14 lg:px-24 max-w-xl sm:mt-8 w-full sm:w-auto sm:flex-grow">
                    <h6 class="uppercase text-guitareo leading-normal text-center sm:text-left mb-2">Guitar Teacher,<br class="inline sm:hidden"> Producer, Songwriter</h6>
                    <h2 class="text-center sm:text-left"><strong>Who is Sami Ghawi?</strong></h2>
                    <h6 class="leading-normal mt-4 lg:mt-6">Sami has been a professional musician, producer & educator for over 20 years, having played thousands of live shows and helped hundreds of aspiring artists build their artistry. He is the director of an artist development company, FUSIONpresents, and has dedicated his life to "helping artists do what they love."
                        <br><br>
                        Having lived all over the world, hailing from many different cultures and speaking multiple languages, Sami's mission is to help the world communicate through the most beautiful & universal language that exists, music.
                    </h6>
                </div>
            </div>
        </div>
    </section>
    <section class="text-center px-5 sm:px-6 py-10 sm:py-14 lg:py-20 relative">
        <div class="max-w-4xl mx-auto px-4">
            <div class="-mt-24 sm:-mt-28 lg:-mt-36">
                <img class="h-28 md:h-32 lazyload" data-src="https://www.musora.com/musora-cdn/image/width=250,quality=85/https://guitareo.s3.amazonaws.com/sales/2022/guitareo-guarantee.png" alt="gurantee badge">
            </div>
            <h2 class="font-extrabold text-center my-7">
                Our promise to you:
            </h2>
            <p class="text-center mb-8">
                It’s important to us that you have an AWESOME time learning guitar. That’s why you have a 90-day risk-free guarantee. If this course doesn’t fulfill its promises to you, you’ll be eligible for a full refund by contacting our Student Experience Team <a href="{{ get_musora_brand_base_url() }}/contact"><u>here</u></a>.
            </p>
            <div class="sm:flex lg:gap-6">
                <div class="w-full sm:w-1/3 px-2 mb-3 sm:mb-0 text-center">
                    <h5 class="text-guitareo border-guitareo border-2 rounded-full inline-block py-2 px-3 mb-1">1</h5>
                    <p class="leading-normal">
                        Feel more confident holding<br>
                        a rhythm on the guitar
                    </p>
                </div>
                <div class="w-full sm:w-1/3 px-2 mb-3 sm:mb-0 text-center">
                    <h5 class="text-guitareo border-guitareo border-2 rounded-full inline-block py-2 px-3 mb-1">2</h5>
                    <p class="leading-normal">
                        Gain new rhythmic techniques <br>
                        to spice up your playing
                    </p>
                </div>
                <div class="w-full sm:w-1/3 px-2 text-center">
                    <h5 class="text-guitareo border-guitareo border-2 rounded-full inline-block py-2 px-3 mb-1">3</h5>
                    <p class="leading-normal">
                        Have more FUN <br>
                        playing the guitar
                    </p>
                </div>
            </div>
        </div>
    </section>
    <div id="customize-anchor" class="anchor"></div>
    <section class="text-center px-5 sm:px-6 py-14 sm:py-20 lg:py-28 text-center text-white bg-center bg-cover lazyload" style="background-color:#051626;" data-bg="https://www.musora.com/musora-cdn/image/width=1500,quality=85/https://guitareo.s3.amazonaws.com/shop/rhythm-and-groove/footer.jpg">
        <div class="container mx-auto">
            <img class="h-14 sm:h-20 lg:h-24" src="https://www.musora.com/musora-cdn/image/width=1200,quality=85/https://guitareo.s3.amazonaws.com/shop/rhythm-and-groove/Logo.svg" alt="Rhythm and groove logo"><br>
            <h3 class="leading-normal my-6 sm:my-8"><strong>Get grooving on guitar</strong><br class="hidden sm:inline"> with fun rhythms you can add to any song.</h3>
            {{--<p class="text-coaches tracking-widest">LIMITED TIME OFFER</p>--}}
            <a class="join my-2 md:my-3 w-full max-w-xl" href="{{ url()->route('shopping-cart.add-to-cart', ['products' => ['rhythm-and-groove' => 1], 'redirect' => '/order']) }}">Start Your Course</a>
            <h3>
                @if(floatval($productPrices['rhythm-and-groove']->price) > floatval($productPrices['rhythm-and-groove']->discounted_price))
                    <s class="opacity-60">${{ floatval($productPrices['rhythm-and-groove']->price) }}</s>
                @endif
                <strong class="">Only  ${{ floatval($productPrices['rhythm-and-groove']->discounted_price) }}</strong>
                    {{--<em style="font-size: 70%;">({{ round(100 - (100 * (floatval($productPrices['rhythm-and-groove']->discounted_price) / floatval($productPrices['rhythm-and-groove']->price)))) }}% off)</em>--}}
            </h3>
            <p class="leading-tight mt-4"><strong><a href="/" class="text-guitareo">(OR FREE WITH A GUITAREO MEMBERSHIP)</a><br>
                <span class="text-coaches">** 90-DAY GUARANTEE **</span></strong></p>
        </div>
    </section>
    <div class="h-5 sm:h-7 -mt-5 sm:-mt-7" style="background: linear-gradient(to bottom right, transparent calc(50% - 1px), transparent, #00101d calc(50% + 1px));"></div>
    <section class="text-center px-5 sm:px-6 py-10 sm:py-14 lg:py-20" style="background: #00101d;">
        <div class="container mx-auto relative z-50">
            <div class="inline-block w-full px-3 md:px-4 mb-5 text-light-navy">
                <p><strong>Any questions?</strong><br class="inline-block md:hidden"> Call us toll-free at
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

    @php
        $videoModals = [
            [
            'modal' => 'trailer',
            'vimeo' => '702222064',
            ],
            [
            'modal' => 'meetSami',
            'vimeo' => '695070821',
            ],
         ]
    @endphp
    @foreach($videoModals as $videoModal)
        <div class="reveal large" id="{{ $videoModal['modal'] }}" data-reveal data-reset-on-close="false">
            <div class="aspect-16:9 w-full relative">
                <iframe class="absolute w-full h-full reset-on-close" src="" data-lazy-load-url="//player.vimeo.com/video/{{ $videoModal['vimeo'] }}?autoplay=1" frameborder="0" allowfullscreen allow="autoplay"></iframe>
            </div>
        </div>
    @endforeach

    @include("guitareo.sales.partials._footer")
@stop

@section('scripts')
    @parent
    <script src="{{ asset('/marketing/js/modal.js') }}"></script>
    <script src="{{ asset('/marketing/parcel/drumeo/navigation-sales.js') }}"></script>
    <script type="text/javascript">
        $(document).ready(function () {
            $(document).foundation();
        });
    </script>
    <script src="{{ asset('/marketing/js/modal-autoplay.js') }}"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/lazysizes/5.3.2/lazysizes.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/lazysizes/5.3.2/plugins/unveilhooks/ls.unveilhooks.min.js"></script>
@stop()
