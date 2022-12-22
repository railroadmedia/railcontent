@extends('drumeo.sales.standard-layout', [
    "bfButton" => true
])

@section('meta')
    <title>Drumeo | Reach your drumming goals.</title>
    <meta property="og:title" content="Drumeo | Reach your drumming goals.">
    <meta property="og:url" content="https://www.drumeo.com/">
@endsection

@section('promo-banner-alt')
    @include('_partials.layout.holiday.homepage-top-banner',[
        'text' => 'GET 10 FREE BONUSES WORTH $1228.94'
    ])
@endsection

@section('promo-banner')
{{--    <section class="text-white text-center relative z-10 overflow-hidden px-4 md:px-3 lg:px-5 md:px-8 py-8 md:py-14 bg-cover bg-top lazyload" style="background-color:#040811;" data-bg="https://cdn.musora.com/image/fetch/w_1500,q_auto:best/https://drumeo-assets.s3.amazonaws.com/promos/september/bg.jpg" --}}{{--style="background:radial-gradient(#022040, #01050f 80%);"--}}{{-->--}}
{{--        <div class="container mx-auto relative z-10 max-w-4xl">--}}
{{--            <img class="h-7 md:h-12 lg:h-14 mb-3 sm:mb-5 lazyload" data-src="https://cdn.musora.com/image/fetch/w_1200,q_auto:best/https://drumeo-assets.s3.amazonaws.com/promos/september/sticktember-logo.png" alt="10year_logo">--}}
{{--            --}}{{--<h1 data-aos="fade-down" class="font-bebas leading-none mb-1 text-4xl md:text-6xl">REACH YOUR  <br class="inline md:hidden">  <span class="text-coaches">DRUMMING GOALS.</span></h1>--}}
{{--            <h4 class="leading-normal"><strong>Get 6 free pairs of sticks + support <br class="inline sm:hidden"> underfunded music programs!</strong>--}}
{{--            </h4>--}}
{{--            --}}{{--<p class="leading-normal mb-3 md:mb-5 uppercase"><strong>--}}
{{--                    --}}{{--GET 3 BONUS TRAINING PACKS<br class="inline md:hidden"> FREE WHEN YOU JOIN DRUMEO--}}
{{--                --}}{{--</strong></p>--}}
{{--            <div class="flex flex-wrap items-start justify-center mx-auto my-5 sm:my-10">--}}
{{--                <div class="flex flex-wrap items-start flex-image mx-auto w-full md:w-4/12 lg:w-4/12 md:order-1 mb-5 md:mb-0 justify-center">--}}
{{--                    <img class="h-72 md:h-auto" src="https://cdn.musora.com/image/fetch/w_600,q_auto:best/https://drumeo-assets.s3.amazonaws.com/promos/september/collage.png">--}}
{{--                </div>--}}
{{--                <div class="text-left md:pr-3 lg:pr-8 w-full md:w-8/12 lg:w-8/12">--}}
{{--                    <p class="mx-auto">September is the ultimate win-win for your drumming.--}}
{{--                        <br><br>--}}
{{--                        When you join Drumeo, 20% of your membership will be donated toward <u>underfunded school music programs</u> – look at you go! That’s the first win. Now for the second…--}}
{{--                        <br><br>--}}
{{--                        Your annual Drumeo membership also includes 6 FREE pairs of 5A Drumsticks by Vater shipped to your door anywhere in the world. You’ll have unlimited drum lessons for a year + all the sticks you need to make some noise.--}}
{{--                        <br><br>--}}
{{--                        You get lessons, kids get instruments, and we get to see the next generation of drummers thrive.--}}
{{--                        <br><br>--}}
{{--                        <a class="anchor-slide" href="#customize-anchor"><u>Click below to see the full deal and start your membership.</u></a>--}}
{{--                    </p>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--            --}}{{--<div class="max-w-lg lg:max-w-2xl mx-auto relative my-7">--}}
{{--                --}}{{--<div class="aspect-16:9 w-full relative rounded-xl border-4 border-drumeo overflow-hidden">--}}
{{--                    --}}{{--<iframe class="absolute w-full h-full" src="//player.vimeo.com/video/738385463" frameborder="0" allowfullscreen allow="autoplay"></iframe>--}}
{{--                --}}{{--</div>--}}
{{--                --}}{{--<img class="absolute hidden sm:inline -top-10 lg:-top-20 -right-24 lg:-right-32 w-24 lg:w-28 lazyload" data-src="https://cdn.musora.com/image/fetch/w_400,q_auto:best/https://drumeo-assets.s3.amazonaws.com/promos/august/watch_icon.svg">--}}
{{--                --}}{{--<img style="transform: translate(-100%, -50%);" class="absolute hidden sm:inline top-1/2 -left-4 w-40 lg:w-64 lazyload" data-src="https://cdn.musora.com/image/fetch/w_400,q_auto:best/https://drumeo-assets.s3.amazonaws.com/promos/march/left_spread.png">--}}
{{--                --}}{{--<img style="transform: translate(100%, -50%);" class="absolute hidden sm:inline top-1/2 -right-4 w-40 lg:w-64 lazyload" data-src="https://cdn.musora.com/image/fetch/w_400,q_auto:best/https://drumeo-assets.s3.amazonaws.com/promos/march/right_spread.png">--}}
{{--            --}}{{--</div>--}}
{{--            <a class="anchor-slide join smaller --}}{{--coaches--}}{{--" style="background-color:#cda880;color:#000;" href="#customize-anchor">SEE THE DEAL</a>--}}
{{--        </div>--}}
{{--    </section>--}}

{{--    <section class="pt-7 pb-52 sm:py-10 lg:py-20 px-4 sm:px-6 text-white bg-center bg-cover bg-no-repeat promo-bg">--}}
{{--        <div class="max-w-4xl mx-auto">--}}
{{--            <div class="w-full md:w-9/12 lg:w-7/12 text-center md:text-left">--}}
{{--                <img class="h-20 md:h-24 lg:h-28 mb-4 lazyload" data-src="https://cdn.musora.com/image/fetch/w_450,q_auto:best/https://drumeo-assets.s3.amazonaws.com/promos/october/logo2.png" alt="better hands logo">--}}
{{--                <p class="mb-2 leading-tight uppercase">--}}
{{--                    <strong>Get a FREE practice pad, drumsticks, Drumeo Rudiments Poster <span class="text-coaches">(NEW)</span>, and more!</strong><br>--}}
{{--                </p>--}}
{{--                <p class="text-light-navy leading-tight">Learning your rudiments will help you express yourself effortlessly on the drums. So we’re celebrating the launch of the first-ever Drumeo Rudiment Poster by giving you everything you need to run your rudiments day OR night:</p>--}}
{{--                <ul class="text-light-navy leading-tight my-3">--}}
{{--                    <li><i class="fas fa-check text-drumeo"></i> Drumeo QuietPad <strong class="text-coaches">(FREE)</strong></li>--}}
{{--                    <li><i class="fas fa-check text-drumeo"></i> 5A Drumsticks <strong class="text-coaches">(FREE)</strong></li>--}}
{{--                    <li><i class="fas fa-check text-drumeo"></i> Drumeo Rudiments Poster<strong class="text-coaches">(NEW)</strong></li>--}}
{{--                </ul>--}}
{{--                <p class="text-light-navy leading-tight mb-3">Plus, you’ll get 3 of our most popular packs to boost your better hand speed.--}}
{{--                    <br><br>--}}
{{--                    Click below to see everything included in the all NEW Drumeo Rudiments Bundle.--}}
{{--                </p>--}}
{{--                <a class="join smaller anchor-slide md:w-52 lg:w-60 blue" href="#customize-anchor">See the deal</a>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </section>--}}
@endsection

@section('sticky-bar')
    @include('_partials.layout.holiday.sticky-bar', [
        'text' => 'GET 10 FREE BONUSES <br> WORTH $1228.94',
    ])

    {{--<div class="h-10 relative w-full block" style="background:linear-gradient(to bottom, #022040, #01050f);"></div>--}}
    {{--<a href="#customize-anchor" style="background:linear-gradient(to bottom, #022040, #01050f);"--}}
            {{--class="promo-banner anchor-slide block text-white text-center w-full transition-opacity duration-300 overflow-hidden whitespace-nowrap bg-cover bg-center shadow-md py-1 z-0 mx-auto -mt-10 text-xs">--}}
        {{--<div class="container mx-auto relative">--}}
            {{--<div class="inline-block align-middle text-center">--}}
                {{--<img class="inline-block align-middle mr-2 h-8"--}}
                        {{--src="https://cdn.musora.com/image/fetch/w_130,q_auto:best/https://drumeo-assets.s3.amazonaws.com/promos/august/30logo.png">--}}
                {{--<h5 class="font-bebas inline-block align-middle mx-auto text-2xl leading-none mr-2 h-8 py-1.5 px-2 bg-black rounded-md">31% OFF</h5>--}}
                {{--<p class="inline-block align-middle mx-auto font-bebas text-sm leading-none sm:text-lg sm:leading-none text-left">--}}
                    {{--<span class="uppercase">Learn the drums by <br> playing the drums.</span></p>--}}
            {{--</div>--}}
        {{--</div>--}}
    {{--</a>--}}
@endsection

@section('final')
{{--     @include("drumeo.sales.partials._subscribe-options")--}}
     <div id="customize-anchor" class="anchor anchor-slide"></div>
    @include('_partials.layout.holiday.homepage-bottom-membership',[
        'logo' => 'https://drumeo-assets.s3.amazonaws.com/promos/november/drumeo-annual-card.jpg',
        'joinText' => '<strong>Join Drumeo for just $' . round(Prices::$drumeoEdgeAnnual / 12, 2) . '/month</strong> <br class="hidden sm:inline"><strong class="text-promo">PLUS</strong> get 10 free bonuses worth $1228.94.',
        'annualLink' => '/laravel/public/shopping-cart/api/query?products[DLM]=1,year,1&products[quietpad]=1&products[Drumeo-VaterSticks]=1&products[drum-technique-made-easy-pack]=1&products[four-weeks-to-better-drum-fills]=1&products[GHFAL-DIGI]=1&products[SD-DIGI]=1&products[rock-drumming-masterclass-pack]=1&products[independence-made-easy-pack]=1&products[electrify-your-drumming]=1&products[learn-songs-faster-pack]=1&locked=true',
        'bonusNum' => 10,
        'tileWidth' => 'w-1/2 md:w-1/4 lg:w-1/5',
        'bonuses' => [
                    [
                        'image' => 'https://drumeo-assets.s3.amazonaws.com/promos/black-friday/bundles/vertical-bg/pad.jpg',
                        'title' => 'QuietPad',
                        'description' => 'Practice anywhere with two full-size playing surfaces.',
                        'price' => Prices::$quietPadFull,
                        'shipping' => true,
                    ],
                    [
                        'image' => 'https://drumeo-assets.s3.amazonaws.com/promos/black-friday/bundles/vertical-bg/drumsticks.jpg',
                        'title' => 'Drumeo Drumsticks',
                        'description' => 'Drumeo 5A Drumsticks by Vater -- made with hickory and extra moisture to last longer.',
                        'price' => Prices::$sticksFull,
                        'shipping' => true,
                    ],
                    [
                        'image' => 'https://drumeo-assets.s3.amazonaws.com/promos/black-friday/bundles/vertical-bg/sd.jpg',
                        'title' => 'Successful Drumming',
                        'description' => 'Jared Falk’s step-by-step curriculum for building a rock-solid foundation on the drums.',
                        'price' => Prices::$sdOnlineFull,
                        'online-ship' => "Instant Access"
                    ],
                    [
                        'image' => 'https://drumeo-assets.s3.amazonaws.com/promos/black-friday/bundles/vertical-bg/ime.jpg',
                        'title' => 'Independence Made Easy',
                        'description' => 'Jared Falk’s 26-week masterclass to unlock your musicality and freedom on the drums.',
                        'price' => Prices::$imeFull,
                        'online-ship' => "Instant Access"
                    ],
                    [
                        'image' => 'https://drumeo-assets.s3.amazonaws.com/promos/black-friday/bundles/vertical-bg/rdm.jpg',
                        'title' => 'Rock Drumming Masterclass',
                        'description' => 'Todd Sucherman’s 26-week masterclass to help you improve your rock drumming.',
                        'price' => Prices::$rdmFull,
                        'online-ship' => "Instant Access"
                    ],
                    [
                        'image' => 'https://drumeo-assets.s3.amazonaws.com/promos/black-friday/bundles/vertical-bg/dtme.jpg',
                        'title' => 'Drum Technique Made Easy',
                        'description' => 'Bruce Becker’s 26-week masterclass to improve your hand & foot technique.',
                        'price' => Prices::$dtmeFull,
                    ],
                    [
                        'image' => 'https://drumeo-assets.s3.amazonaws.com/promos/black-friday/bundles/vertical-bg/eyd.jpg',
                        'title' => 'Electrify Your Drumming',
                        'description' => 'Your guide to playing 10 styles of electronic dance music - includes 23 play-alongs!',
                        'price' => Prices::$eydFull,
                        'online-ship' => "Instant Access"
                    ],
                    [
                        'image' => 'https://drumeo-assets.s3.amazonaws.com/promos/black-friday/bundles/vertical-bg/fwtbdf.jpg',
                        'title' => 'Better Drum Fills',
                        'description' => 'The ultimate four-week crash course to playing more creative & musical drum fills.',
                        'price' => Prices::$bdfFull,
                        'online-ship' => "Instant Access"
                    ],
                    [
                        'image' => 'https://cdn.musora.com/image/fetch/c_fill,w_300,q_auto:good/https://drumeo-assets.s3.amazonaws.com/promos/july/tommy_card.jpg',
                        'title' => 'Great Hands For A Lifetime',
                        'description' => 'Tommy Igoe helps you improve your hand strength, speed, stamina, comfort, and control in the drums in four hours of video lessons.',
                        'price' => Prices::$ghfalFull,
                    ],
                    [
                        'image' => 'https://drumeo-assets.s3.amazonaws.com/promos/black-friday/bundles/vertical-bg/lsf.jpg',
                        'title' => 'Learn Songs Faster',
                        'description' => 'This masterclass will give you proven techniques for learning MORE songs in less time.',
                        'price' => Prices::$learnSongsFasterFull,
                        'online-ship' => "Instant Access"
                    ],
                ],
        'monthlyLink' => '/laravel/public/shopping-cart/api/query?products[DLM]=1,month,1&locked=true'
    ])
@endsection
