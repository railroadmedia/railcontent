@php $annualLink = '/ecommerce/add-to-cart?products[PIANOTE-MEMBERSHIP-1-YEAR]=1&products[pianote-practice-planner]=1&products[100-days-of-practice-poster]=1&products[poster-chords]=1&products[poster-scales]=1&products[the-power-of-chords]=1&products[faster-fingers]=1&locked=true&redirect=/order' @endphp

{{--@include('_partials.layout.holiday.homepage-bottom-banner',[--}}
{{--    'text' => '<strong class="text-promo">Save up to 81%</strong> on lessons,<br class="inline md:hidden"> accessories, and merch.'--}}
{{--])--}}

<section class="content-section text-center customize relative z-50 overflow-hidden" style="background: linear-gradient(to bottom, #01050f 40%, #021022); padding: 0 !important;">
    <div class="bg-black text-center pt-12 md:pt-16 pb-2">
        <img class="h-10 md:h-16 mx-auto" src="https://cdn.musora.com/image/fetch/w_500,q_auto:best/https://pianote.s3.amazonaws.com/logo/pianote-logo-red.png">
        <h2 class="leading-normal text-white">
            <strong>
                Start practicing and playing better <br>
                for just <span class="text-pianote">$16.42</span> a month.
            </strong>
        </h2>
    </div>
    <div class="horizontal-bonuses mx-auto max-w-xs sm:max-w-md md:max-w-2xl lg:max-w-xl" style="font-size: 0;">
        {{-- <img class="h-12 md:h-14 lg:h-16 lazyload" data-src="https://cdn.musora.com/image/fetch/w_420,q_auto:best/https://pianote.s3.amazonaws.com/logo/pianote-logo-red.png" alt="6th-anniversary-logo"> --}}
        {{-- <h2 class="mt-3 leading-tight"><strong>Start playing beautiful music <br class="hidden sm:inline">for just <span class="text-pianote">${{ round((Prices::$pianoteMembershipAnnualRegular / 12), 2) }}</span> a month.</strong></h2> --}}
        <h5 class="mb-5 md:mb-7 mt-2 text-coaches" style="line-height: 1.4em;">
            {{-- <img class="inline-block align-middle mr-2 h-14 mb-2" src="https://cdn.musora.com/image/fetch/w_160,q_auto:best/https://pianote.s3.amazonaws.com/sales/promos/piano-month/national-piano-month-logo-white.png">
            <br class="inline sm:hidden">
            JOIN PIANOTE + GET 4 FREE BONUSES WORTH $237
            <br><span class="text-coaches uppercase">ONLY <span class="tzcd-full hidden sm:inline">A LIMITED TIME</span> <span class="tzcd-small inline sm:hidden">A LIMITED TIME</span> LEFT!</span> --}}
            JOIN PIANOTE + GET 6 BONUSES WORTH $262
        </h5>

        @php

            $bonuses = [
                [
                    'image' => 'https://pianote.s3.amazonaws.com/sales/promos/may/Pianote_Planner_Card.jpg',
                    'title' => '',
                    'description' => 'Always know exactly what to practice.',
                    'price' => 39,
                    'online-ship' => "Free Shipping",
                    'badge' => 'Chords & Scales Book'
                ],
                [
                    'image' => 'https://pianote.s3.amazonaws.com/sales/promos/may/100_Days_Card.jpg',
                    'title' => '',
                    'description' => 'Stay motivated and on track with 100 days of practice.',
                    'price' => 9,
                    'online-ship' => "Free Shipping",
                    'badge' => 'Classical Piano Pieces'
                ],
                [
                    'image' => 'https://pianote.s3.amazonaws.com/sales/promos/may/Piano_Chords_Card.jpg',
                    'title' => '',
                    'description' => 'Always know your chord shapes with this helpful poster.',
                    'price' => 9,
                    'online-ship' => "Free Shipping",
                    'badge' => 'Chords Poster'
                ],
                [
                    'image' => 'https://pianote.s3.amazonaws.com/sales/promos/may/Piano_Scales_Card.jpg',
                    'title' => '',
                    'description' => 'Never forget the notes of a scale with this easy-to-read poster.',
                    'price' => 9,
                    'online-ship' => "Free Shipping"
                ],
                [
                    'image' => 'https://pianote.s3.amazonaws.com/sales/promos/october/power_of_chords_card.jpg',
                    'title' => '',
                    'description' => 'Play the music you love using the power of chords.',
                    'price' => 97,
                    'online-ship' => "Lifetime Access"
                ],
                [
                    'image' => 'https://pianote.s3.amazonaws.com/sales/promos/black-friday/faster-fingers.jpg',
                    'title' => '',
                    'description' => 'Boost your speed and confidence with this guided practice course.',
                    'price' => 99,
                    'online-ship' => "Lifetime Access"
                ],
            ]
        @endphp

        @foreach($bonuses as $bonus)
            <div class="bonus-wrap relative inline-block align-top mx-auto mb-3 md:mb-4 px-2 lg:px-3 lg:px-2 w-1/2 sm:w-1/3">
                <div class="flip-div @if(!empty($bonus['class'])) {{ $bonus['class'] }} @endif" style="padding-bottom: 140%;">
                    <div class="flip-inner">
                        <div class="front @if(!empty($bonus['shipping'])) {{ $bonus['shipping'] }} @endif" style="border-color:#fe9f13;">
                            <div class="hover-icon"><i class="fas fa-arrow-right"></i><br>DETAILS</div>
                            <div class="image-wrap" style="background-image:url(https://cdn.musora.com/image/fetch/w_460,q_auto:best/{{ $bonus['image'] }});"></div>
                        </div>
                        <div class="back">
                            <div class="text-wrap">
                                <p class="text-xs">{!!  $bonus['description']  !!}</p>
                            </div>
                        </div>
                    </div>
                </div>
                <p class="uppercase mt-2">
                    @if(!empty($bonus['title'])) <strong class="font-black leading-tight inline-block  mb-1">{!!  $bonus['title']  !!}</strong><br> @endif
                    <span class="text-pianote" style="text-transform:uppercase; display:inline-block;"><s style="color:#5F5F5F;">${{ $bonus['price'] }}</s> <strong>FREE</strong></span><br>
                    {{ $bonus['online-ship'] }}
                </p>
            </div>
        @endforeach
    </div>
    {{-- <p class="mt-5 md:mt-7" style="display:inline-block;background: -webkit-linear-gradient(20deg, #03c8ac, #0976db, #9a01ee, #f61a30);-webkit-background-clip: text;-webkit-text-fill-color: transparent;"><strong>By joining today, we’ll donate 20% of your new membership<br class="hidden sm:inline"> towards the <a target="_blank" href="https://musicounts.ca/en/take-action/ways-of-giving/fundraise-on-musicounts-behalf/fundraisers-supporting-musicounts/give-the-gift-of-music-with-musora/"><u>MusiCounts Band Aid Program</u></a>.</strong></p> --}}
    <h4 class="mt-2 leading-normal">
        {{--<span class="text-coaches">PIANOTE ANNUAL MEMBERSHIP</span><br>--}}
        <strong>Billed annually at ${{ Prices::$pianoteMembershipAnnualRegular }} per year.</strong>
        {{--<br class="inline sm:hidden"><em class="text-coaches">(Normally ${{ Prices::$pianoteMembershipAnnualFull }}, Save {{ round(100 - (100 * (Prices::$pianoteMembershipAnnualRegular / Prices::$pianoteMembershipAnnualFull))) }}%.)</em>--}}
    </h4>
    <a class="join bigger" href="{{ $annualLink }}">GET STARTED</a>
    <a class="text-light-navy monthly-alt" href="/ecommerce/add-to-cart?products[PIANOTE-MEMBERSHIP-1-MONTH]=1&redirect=%2Forder">
        <p class="mb-20">
            <u><em>Or start a monthly membership for <br class="inline-block md:hidden">${{ Prices::$pianoteMembershipMonthlyRegular }}/month.</em></u>
        </p>
    </a>
</section>

<section class="content-section text-center" style="background: #000;">
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
