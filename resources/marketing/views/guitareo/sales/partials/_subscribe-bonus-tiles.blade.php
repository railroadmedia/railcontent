@php $annualLink = '/ecommerce/add-to-cart?products[GUITAREO-1-YEAR-MEMBERSHIP]=1&products[GUITAR-SYSTEM]=1&products[GTME-OCT-2018-SEMESTER]=1&redirect=/order&locked=true' @endphp

<section class="content-section px-4 lg:px-6 text-center customize relative z-50 overflow-hidden" style="background:linear-gradient(to bottom, #01050f 40%, #021225);">
    <div class="container mx-auto relative z-50">
        <div class="horizontal-bonuses mx-auto" style="font-size: 0;">
            <img class="h-16 sm:h-28 lg:h-32 mb-3 md:mb-5" src="https://cdn.musora.com/image/fetch/w_1000,q_auto:best/https://guitareo.s3.amazonaws.com/sales/promos/march/play-better-solos-green.png">
            {{--<img class="h-10 md:h-16 mb-3 md:mb-4" src="https://guitareo.s3.amazonaws.com/sales/guitareo-logo-green.png">--}}
            <h2 class="leading-tight mb-3 md:mb-6 px-3"><strong>Learn what YOU want, get inspired, and <br class="hidden sm:inline"> stay motivated with personal support.</strong></h2>
            <h6 class="text-navy">
                {{--<span class="text-coaches uppercase">ONLY <span class="tzcd-full hidden sm:inline">A LIMITED TIME</span> <span class="tzcd-small inline sm:hidden">A LIMITED TIME</span> LEFT!</span><br>--}}
                <span class="text-coaches uppercase"> for only $8.33 a month</span>

                {{--<br><em>(Cancel anytime, 90-Day Money Back Guarantee)</em>--}}
            </h6>
            <div class="max-w-2xl mx-auto my-5 sm:my-7">
                @php
                    $bonuses = [
                        [
                        'image' => 'https://guitareo.s3.amazonaws.com/sales/promos/march/flippy_card_3.jpg',
                        'title' => 'Play Better Solos',
                        'description' => 'Go beyond the pentatonic scale and learn Kent’s secrets to making impressive sounds in any key.',
                        'price' => \App\Prices::$guitarSystemFull,
                        'online-ship' => "Instant Access",
                        'included' => true
                        ],
                        [
                        'image' => 'https://guitareo.s3.amazonaws.com/sales/promos/black-friday/bundles/ultimate/gs.jpg',
                        'title' => 'The Guitar System',
                        'description' => 'Transform your guitar playing with the ultimate encyclopedia of guitar lessons.',
                        'price' => \App\Prices::$guitarSystemFull,
                        'online-ship' => "Instant Access"
                        ],
                        [
                        'image' => 'https://guitareo.s3.amazonaws.com/sales/promos/black-friday/bundles/ultimate/gtme.jpg',
                        'title' => 'Guitar Technique Made Easy',
                        'description' => 'Learn the most important guitar techniques and reach total guitar freedom.',
                        'price' => \App\Prices::$GTMEFull,
                        'online-ship' => "Instant Access"
                        ],
                    ]
                @endphp
                @foreach($bonuses as $bonus)
                    <div class="bonus-wrap relative inline-block align-top mx-auto mb-3 md:mb-4 px-2 md:px-3 lg:px-2 w-1/2 sm:w-1/3">
                        <div class="flip-div @if(!empty($bonus['class'])) {{ $bonus['class'] }} @endif" style="padding-bottom: 130%;">
                            <div class="flip-inner">
                                <div class="front @if(!empty($bonus['shipping'])) {{ $bonus['shipping'] }} @endif">
                                    <div class="hover-icon"><i class="fas fa-arrow-right"></i><br>DETAILS</div>
                                    <div class="image-wrap" style="background-image:url(https://cdn.musora.com/image/fetch/w_460,q_auto:best/{{ $bonus['image'] }});"></div>
                                </div>
                                <div class="back">
                                    <div class="text-wrap">
                                        <p class="text-sm">
                                            <strong class="font-black leading-tight inline-block mb-1">{!!  $bonus['title']  !!}</strong><br>
                                            {!!  $bonus['description']  !!}</p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <p class="uppercase mt-2" style="line-height: 1.25;">
                            {{--<strong class="font-black leading-tight inline-block  mb-1">{!!  $bonus['title']  !!}</strong><br>--}}
                            <span class="inline-block">
                                @if(empty($bonus['included']))
                                    <s>${{ $bonus['price'] }}</s> <strong class="text-promo">FREE</strong>
                                @else
                                    <strong class="text-promo">Included</strong>
                                @endif
                            </span><br>
                            {{ $bonus['online-ship'] }}
                        </p>
                    </div>
                @endforeach
            </div>
        </div>
        <h4 class="leading-tight"><strong>Billed annually at <s class="opacity-60">${{ \App\Prices::$guitareoMembershipAnnualFull }}</s> ${{ \App\Prices::$guitareoMembershipAnnual }} per year.</strong><br class="inline sm:hidden"> <em class="text-coaches">(Save {{ round(100 - (100 * (\App\Prices::$guitareoMembershipAnnual / \App\Prices::$guitareoMembershipAnnualFull))) }}%.)</em></h4>
        <a class="join bigger" href="{{ $annualLink }}">Click Here To Get Started &raquo;</a>
        <br>
        <a class="monthly-alt" href="/ecommerce/add-to-cart?products[GUITAREO-1-MONTH-MEMBERSHIP]=1&redirect=/order&locked=true"><p><u><em>Or start a monthly membership for <br class="inline-block md:hidden">${{ \App\Prices::$guitareoMembershipMonthly }}/month. (no bonuses)</em></u></p></a>
    </div>
</section>

<section class="content-section text-center" style="background: #0c1429;">
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