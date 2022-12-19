@php
    $annualLink = '/laravel/public/shopping-cart/api/query?products[DLM]=1,year,1&products[quietpad]=1&products[Drumeo-VaterSticks]=1&products[drum-technique-made-easy-pack]=1&products[four-weeks-to-better-drum-fills]=1&products[GHFAL-DIGI]=1&products[SD-DIGI]=1&products[rock-drumming-masterclass-pack]=1&products[independence-made-easy-pack]=1&products[electrify-your-drumming]=1&products[learn-songs-faster-pack]=1&locked=true';
@endphp

<div style="background:linear-gradient(to bottom, #02010f, #010522);">
<section class="content-section text-center customize px-4 lg:px-6 relative z-50 overflow-hidden bg-top lazyload" style="background: url(https://drumeo-assets.s3.amazonaws.com/promos/christmas/snow-dark.gif) center center/250px;box-shadow: 0 0 100px inset #000;">
    <div class="container mx-auto relative z-50">
        <div class="mx-auto max-w-4xl" style="font-size: 0;">
            <div class="w-full">
                <div class="bonus-wrap relative inline-block align-top mx-auto px-1 md:px-3 w-full max-w-md">
                    <img class="h-20 absolute top-0 right-0 z-10 -mt-8 -mr-2" src="https://drumeo-assets.s3.amazonaws.com/promos/december/santa-hat.png">
                    <div class=" inline-block relative w-full group" style="padding-bottom: 47%;perspective: 1000px;">
                        <div class="text-center w-full h-full absolute" style="transform-style: preserve-3d;">
                            <div class="border-2 border-promo front absolute z-20 overflow-hidden rounded-3xl w-full h-full transition-transform duration-700" style="backface-visibility: hidden;">
                                <div class="h-full w-full bg-black bg-top bg-cover lazyload" data-bg="https://cdn.musora.com/image/fetch/w_850,q_auto:best/https://drumeo-assets.s3.amazonaws.com/promos/november/drumeo-annual-card.jpg"></div>
                            </div>
                        </div>
                    </div>
                </div>
                <h3 class="leading-tight my-3">
                    <strong>
                        Join Drumeo for just ${{  round(Prices::$drumeoEdgeAnnual / 12, 2) }}/month</strong> <br class="hidden sm:inline">
                    <strong class="text-promo">PLUS</strong> get 10 free bonuses worth $1228.94.

                </h3>
                <a class="join promo bigger my-4 md:my-6 w-full max-w-xs md:max-w-lg lg:max-w-xl" style="padding: 20px 10px;" href="{{ $annualLink }}" {{--data-open="orderModal"--}}>GET Started &raquo;</a>
                <p class="leading-tight text-sm"><em>Billed at ${{ Prices::$drumeoEdgeAnnual }} per year.<br class="inline sm:hidden">  Cancel anytime. 90-day guarantee.</em></p>
                <h4 class="leading-tight my-6 sm:my-8">
                    <strong>10 FREE BONUSES.</strong> <em>ONLY<br class="inline sm:hidden"> AVAILABLE UNTIL DECEMBER 26</em></h4>
            </div>
            @php
                $bonuses = [
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
                ]
            @endphp
            @foreach($bonuses as $bonus)
                <div class="bonus-wrap relative inline-block align-top mx-auto mb-4 px-1 md:px-3 w-1/2 md:w-1/4 lg:w-1/5">
                    <div class="flip-div inline-block relative w-full group" style="@if(empty($bonus['bigCard'])) padding-bottom: 133%; @else padding-bottom: 103%; @endif perspective: 1000px;">
                        <div class="text-center w-full h-full absolute cursor-pointer" style="transform-style: preserve-3d;">
                            <div class="border-2 border-promo front absolute z-20 overflow-hidden rounded-xl w-full h-full transition-transform duration-700" style="@if(!empty($bonus['special'])) overflow: visible;border-color: #cda880; @endif backface-visibility: hidden;">
                                @if(!empty($bonus['badge']))
                                    <h6 class="absolute text-white top-0 left-0 w-full py-0.5 bg-drumeo rounded-t-xl font-bebas uppercase">{{ $bonus['badge'] }}</h6>
                                    {{--                                        <h4 class="absolute text-white -top-3 -left-3  py-3 px-2.5 rounded-full transform -rotate-12" style="    line-height: 0.6;background-color:#cda880;"><strong>6<br><span class="leading-none" style="font-size: 50%;">PAIRS</span></strong></h4>--}}
                                @endif
                                <div class="overflow-hidden rounded-xl h-full w-full bg-black bg-top bg-cover lazyload" data-bg="https://cdn.musora.com/image/fetch/w_460,q_auto:best/{{ $bonus['image'] }}"></div>
                                <div class="absolute z-40 text-center top-1/2 left-1/2 text-white transition-opacity duration-300 transform -translate-x-1/2 -translate-y-1/2 visible opacity-0 group-hover:opacity-100 text-shadow-2">
                                    <i class="fas fa-arrow-right text-4xl"></i><br>
                                    <p class="text-sm"><strong>DETAILS</strong></p>
                                </div>
                            </div>
                            <div class="back border-2 border-promo absolute z-40 overflow-hidden rounded-xl w-full h-full transition-transform duration-700" style="backface-visibility: hidden;">
                                <div class="w-full h-full mx-auto text-center text-white flex flex-wrap justify-center items-center content-center p-2 md:p-3" style="background:linear-gradient(to bottom, #01050f, #021225);">
                                    <p class="leading-normal mx-auto text-sm">{!! $bonus['description'] !!}</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <p class="w-full leading-normal mt-2">
                        {{--<strong class="font-black leading-tight inline-block mb-1">{!!  $bonus['title']  !!}</strong><br>--}}
                        <span style="text-transform:uppercase; display:inline-block;"><s>${{ $bonus['price'] }}</s> <strong class="text-promo">FREE</strong></span><br>
                        <em>
                            @if(!empty($bonus['shipping']))
                                Free Shipping
                            @else
                                Online Access
                            @endif
                        </em>
                    </p>
                </div>
            @endforeach
            {{-- <p class=" mt-4 md:mt-5" style="display:inline-block;background: -webkit-linear-gradient(20deg, #03c8ac, #0976db, #9a01ee, #f61a30);-webkit-background-clip: text;-webkit-text-fill-color: transparent;"><strong>By joining today, we’ll donate 20% of your new membership<br class="hidden sm:inline"> towards the <a target="_blank" href="https://musicounts.ca/en/take-action/ways-of-giving/fundraise-on-musicounts-behalf/fundraisers-supporting-musicounts/give-the-gift-of-music-with-musora/"><u>MusiCounts Band Aid Program</u></a>.</strong></p> --}}
            {{--            <h4 class="leading-tight mt-4"><strong>Only $12.50/month <br class="inline sm:hidden">(billed annually at ${{ Prices::$drumeoEdgeAnnual }}).</strong></h4>--}}
            <a class="join promo bigger my-4 md:my-5 w-full max-w-xs md:max-w-lg lg:max-w-3xl" style="padding: 20px 10px;" href="{{ $annualLink }}" {{--data-open="orderModal"--}}>GET Started &raquo;</a>
            {{-- <p class="leading-tight">Billed annually at <s class="opacity-60">${{ Prices::$drumeoEdgeAnnualFull }}</s>${{ Prices::$drumeoEdgeAnnual }} per year.</p> --}}
            <br>
            <a class="inline-block text-light-navy mt-2" href="/laravel/public/shopping-cart/api/query?products[DLM]=1,month,1&locked=true"><p><u><em>Or start a monthly membership for <br class="inline-block md:hidden">${{ Prices::$drumeoEdgeRegular }}/month. (no bonuses)</em></u></p></a>

        </div>
    </div>
</section>
</div>
<section class="content-section text-center" style="background: #0c1429;">
    <div class="container mx-auto relative z-50">
        <a class="inline-block" href="https://www.shopperapproved.com/reviews/Musora.com/product/Drumeo+Membership/7918738" target="_blank" onclick="window.open('https://www.shopperapproved.com/reviews/Musora.com/product/Drumeo+Membership/7918738', 'newwindow', 'width=750, height=550'); return false;">
            <img alt="" class="h-7 md:h-12 lg:h-14 mb-2 md:mb-0 mx-auto md:mr-2 opacity-70 lazyload" data-src="https://cdn.musora.com/image/fetch/w_320,q_auto:best/https://dpwjbsxqtam5n.cloudfront.net/sales/2021/shopper-approved-logo-white.png">
            <i class="align-middle text-2xl md:text-4xl fas fa-star" style="color: #f68d2d;"></i>
            <i class="align-middle text-2xl md:text-4xl fas fa-star" style="color: #f68d2d;"></i>
            <i class="align-middle text-2xl md:text-4xl fas fa-star" style="color: #f68d2d;"></i>
            <i class="align-middle text-2xl md:text-4xl fas fa-star" style="color: #f68d2d;"></i>
            <i class="align-middle text-2xl md:text-4xl fas fa-star" style="color: #f68d2d;"></i>
            <p class="mx-auto mt-2 md:mt-3 text-light-navy">Drumeo is rated 5-stars for price, satisfaction,<br class="inline sm:hidden"> and customer service. <u>See The Reviews »</u></p>
        </a>
        <div class="inline-block w-full px-3 md:px-4 my-5 text-light-navy">
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
