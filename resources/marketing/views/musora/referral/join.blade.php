@php
    $cardImages = [
        'drumeo' => 'https://dpwjbsxqtam5n.cloudfront.net/redeem/referral/drumeo-free.png',
        'pianote' => 'https://dpwjbsxqtam5n.cloudfront.net/redeem/referral/pianote-free.png',
        'singeo' => 'https://dpwjbsxqtam5n.cloudfront.net/redeem/referral/singeo-free.png',
        'guitareo' => 'https://dpwjbsxqtam5n.cloudfront.net/redeem/referral/guitareo-free.png',
    ];

    $instruments = [
        'drumeo' => 'the drums',
        'pianote' => 'the piano',
        'singeo' => 'how to sing',
        'guitareo' => 'the guitar',
    ];

    $prizeWithPrice = [
        'drumeo' => 'Yamaha E-Drum Kit retailing at $499.99 USD',
        'pianote' => 'Yamaha Digital Piano in white retailing at $699.99 USD',
        'singeo' => 'Steinberg Recording Kit with an audio interface, headphones, and a condenser microphone retailing at $359.99 USD',
        'guitareo' => 'Pacifica Electric Guitar in Red retailing at $209.99 USD',
    ];

    $prizeNames = [
        'drumeo' => 'Yamaha e-drum kit',
        'pianote' => 'Yamaha digital piano',
        'singeo' => 'Steinberg studio kit',
        'guitareo' => 'Pacifica electric guitar',
    ];

    $prizeNamesWithModel = [
        'drumeo' => 'Yamaha DTX402K E-Drum Kit',
        'pianote' => 'Yamaha P-125a Digital Piano',
        'singeo' => 'Steinberg studio kit',
        'guitareo' => 'Yamaha Pacifica PAC012 Electric Guitar',
    ];

    $prizeImgs = [
        'drumeo' => 'https://d3fzm1tzeyr5n3.cloudfront.net/referral/prize-drum.png',
        'pianote' => 'https://d3fzm1tzeyr5n3.cloudfront.net/referral/prize-piano.png',
        'singeo' => 'https://d3fzm1tzeyr5n3.cloudfront.net/referral/prize-mic.png',
        'guitareo' => 'https://d3fzm1tzeyr5n3.cloudfront.net/referral/prize-guitar.png',
    ];

    $gradients = [
        'drumeo' => '180deg, #0B76DB 0%, #013362 100%',
        'pianote' => '180deg, #F01A2F 0%, #55050D 100%',
        'singeo' => '180deg, #8101E4 0%, #360160 100%',
        'guitareo' => '180deg, #01C8AB 0%, #045045 100%',
    ];

    $prizeDesc = [
        'drumeo' => 'It has over 250 drum sounds and 10 drum kits customizable to your taste, <br class="hidden md:inline lg:hidden" />for ultimate control over your tone and volume.',
        'pianote' => 'It has a metronome to keep your playing tight. And it connects with your headphones for all those late-night playing sessions.',
        'singeo' => 'You’ll get a microphone, headphones, and an audio interface so you can start to feel more confident as a singer.',
        'guitareo' => 'It\'s well-known for its beautiful tone, playability, and red-metallic look — with vintage-style vibratos and 5-way switching of the H-S-S pickup.',
    ];

    $brand = $referralBrand;
    $cardImage = $cardImages[$brand];

@endphp

@section('body-data')
    x-data="{
        drumeoTrailer: false,
        pianoteTrailer: false,
        guitareoTrailer: false,
        singeoTrailer: false,
    }"
@endsection

<div class="referral-sections -mt-[40px] md:-mt-[56px]">
    <section class="py-10 md:py-16 bg-[#F9F9F9]">
        <div class="container mx-auto max-w-5xl px-4">
            @if ($canRefer && !$errors->has('email-invite-message'))
                <h2 class="leading-tight mb-10 lg:mb-14 text-center"><strong>{{ $referredByUserName }} thinks you’ll enjoy these lessons. Get {{ ucfirst($brand) }} free for 1 month!</strong></h2>
                <div class="md:flex md:items-center sm:px-4 lg:px-0">
                    <div class="text-center md:text-left relative md:order-1 mb-6 md:mb-0">
                        <img class="inline-block w-full max-w-xs sm:max-w-md md:max-w-lg lg:max-w-3xl" src="{{ $cardImage }}" alt="{{ $brand }} card">
                        <div class="text-center absolute w-full left-0 bottom-1 md:bottom-0.5 lg:bottom-1 text-xs text-white">
                            <i>Starting at $20/month thereafter (billed annually). <br class="sm:hidden">Cancel anytime.</i>
                        </div>
                        <div class="absolute top-0 left-0 w-full h-full flex justify-center items-center cursor-pointer" @click="{{ $brand }}Trailer = true;">
                            <i class="fas fa-play play-button border-white border-2 rounded-full text-xl py-3 px-5 sm:text-2xl sm:py-4 sm:px-6 md:text-3xl md:py-6 md:px-8 text-white" style="background:#0009;"></i>
                        </div>
                    </div>
                    <div class="md:mr-4 lg:mr-10 text-center md:text-left">
                        <h5 class="leading-normal font-bold mb-2">Learn {{ $instruments[$brand] }} faster with step-by-step lessons, a thousand songs, and unlimited personal support.</h5>
                        <div class="flex justify-between max-w-[550px] mb-6">
                            <div>
                                <i class="fas fa-check text-{{ $brand }}"></i> Improve your skills
                            </div>
                            <div>
                                <i class="fas fa-check text-{{ $brand }}"></i> World-class teachers
                            </div>
                            <div>
                                <i class="fas fa-check text-{{ $brand }}"></i> @if($brand === 'singeo') Sing more songs @else Play more songs @endif
                            </div>
                        </div>
                        <div class="inline-block">
                            <a href="#customize-anchor" class="btn-primary btn-small bg-{{ $brand }} py-5 px-20 mr-2 text-base">1 MONTH FOR FREE</a>
                            <div class="flex flex-wrap items-center justify-center ">
                                <a aria-label="Review" class="inline-block" href="https://www.shopperapproved.com/reviews/Musora.com" target="_blank" onclick="window.open('https://www.shopperapproved.com/reviews/Musora.com', 'newwindow', 'width=750, height=550'); return false;">
                                    <i class="align-middle text-base fas fa-star" style="color: #ffac00;" aria-hidden="true"></i>
                                    <i class="align-middle text-base -ml-4 fas fa-star" style="text-shadow: -2px -1px 1px #f6f8fc;color: #ffac00;" aria-hidden="true"></i>
                                    <i class="align-middle text-base -ml-4 fas fa-star" style="text-shadow: -2px -1px 1px #f6f8fc;color: #ffac00;" aria-hidden="true"></i>
                                    <i class="align-middle text-base -ml-4 fas fa-star" style="text-shadow: -2px -1px 1px #f6f8fc;color: #ffac00;" aria-hidden="true"></i>
                                    <i class="align-middle text-base -ml-4 fas fa-star" style="text-shadow: -2px -1px 1px #f6f8fc;color: #ffac00;" aria-hidden="true"></i>
                                </a>
                                <p class="inline-block leading-tight text-xs align-middle pl-1 m-0"><em>Trusted by 81,687 active students.</em></p>
                            </div>
                        </div>
                    </div>

{{--                        <ul class="fa-ul text-left mb-0 mt-4 md:mt-6 lg:mt-14 ml-6 md:ml-7 lg:ml-8 w-auto inline-block">--}}
{{--                            <li class="mb-4 lg:mb-6 leading-tight"><i class="fas fa-li fa-check text-{{ $brand }}"></i> Organized step-by-step lessons for all skill levels.</li>--}}
{{--                            <li class="mb-4 lg:mb-6 leading-tight"><i class="fas fa-li fa-check text-{{ $brand }}"></i> Play your favorite songs with better practice tools.</li>--}}
{{--                            <li class="leading-tight"><i class="fas fa-li fa-check text-{{ $brand }}"></i> Get your questions answered by helpful teachers.</li>--}}
{{--                        </ul>--}}

                </div>
            @else
                <h1 class="leading-tight lg:mb-14"><strong>Referral link has expired.</strong></h1>
            @endif
        </div>
    </section>

    <div id="customize-anchor" class="anchor anchor-slide"></div>
    @include('musora.sales.components.card-selection-section', [
        'theme' => $referralBrand,
        "month" => true,
        "whiteBg" => true,
        "plusLogo" => "https://dmmior4id2ysr.cloudfront.net/homepage/2023/musora_plus_logo.png",
        "logo" => "https://dmmior4id2ysr.cloudfront.net/homepage/2023/musora_logo.png",
        "songs" => "Thousands of popular songs.",
        "firstPoint" => "Learn piano, guitar, drums, & singing.",
        "thirdPoint" => "Unlimited personal support",
        "plusAnnualLink" => "/ecommerce/add-to-cart?products[musora-annual-recurring-30-day-trial-membership]=1&locked=true&referralCode=" . $referralCode,
        "plusMonthlyLink" => "/ecommerce/add-to-cart?products[musora-monthly-recurring-30-day-trial-membership]=1&locked=true&referralCode=" . $referralCode,
    ])

    @include('musora.sales.components.trial-explanation', [
        'theme' => $referralBrand,
        'instrument' => 'musical',
    ])

{{--    <section class="bg-[#F3B13E] py-9">--}}
{{--        <div class="text-center px-4 sm:px-0">--}}
{{--            <p>Sign up for a {{ ucfirst($brand) }} 30-Day Free Trial for a chance to win a {{ $prizeNames[$brand] }}.</p>--}}
{{--            <p class="italic font-bold">The contest ends on September 14, 2023.</p>--}}
{{--        </div>--}}
{{--    </section>--}}

{{--    <section style="background:linear-gradient({{ $gradients[$brand] }});">--}}
{{--        <div class="flex flex-col lg:flex-row text-white max-w-4xl mx-auto items-center px-4 xl:px-0 text-center lg:text-left">--}}
{{--            <div class="mb-6 pt-10 lg:pt-0 lg:my-40 lg:max-w-md w-full lg:mr-6">--}}
{{--                <h2 class="font-extrabold leading-none mb-4">This could be yours…</h2>--}}
{{--                <div class="font-bold mt-2 mb-4 ">{{ $prizeNamesWithModel[$brand] }}</div>--}}
{{--                <div>{!! $prizeDesc[$brand] !!}</div>--}}
{{--            </div>--}}

{{--            <img class="@if($brand === 'drumeo') sm:h-[450px] lg:h-[32rem] xl:h-[33rem] -mb-6 lg:-mb-20 @elseif($brand === 'pianote') sm:h-[450px] lg:h-[23rem] xl:h-[28rem] -mb-10 lg:-mb-32 lg:-ml-20 @elseif($brand === 'guitareo') sm:h-[450px] lg:h-[23rem] xl:h-[28rem] -mb-6 lg:-mb-32 lg:-ml-10 @elseif($brand === 'singeo') -mb-6 lg:mb-0 sm:h-56 lg:h-52 xl:h-64 @endif mx-auto" src="https://www.musora.com/musora-cdn/image/width=800,quality=95/{{ $prizeImgs[$brand] }}" alt="{{ $brand }} prize" />--}}
{{--        </div>--}}
{{--    </section>--}}

{{--    <section class="py-20">--}}
{{--        <div class="max-w-6xl mx-auto px-6 2xl:px-0 dark:text-white">--}}
{{--            <h4 class="mb-4"><strong>Terms and Conditions</strong></h4>--}}
{{--            <p>--}}
{{--                <strong>Eligibility:</strong> This contest is open to Musora students with an active, paid membership and newly referred students, 18 years or older at the time of entry. Void where prohibited by law. Employees, officers, and directors of the sponsor and their immediate family members and/or those living in the same household are not eligible to participate in the contest.--}}
{{--                <br><br>--}}
{{--                <strong>How to Enter:</strong> Participants automatically receive (1) entry to the contest when a referred friend signs up for a membership with a 30-day trial from August 18 to September 14, 2023. Participants may collect up to (5) contest entries for {{ ucfirst($brand) }} based on each successful referral during the contest period. New students who sign up for {{ ucfirst($brand) }} will gain one contest entry. No purchase is necessary to enter or win.--}}
{{--                <br><br>--}}
{{--                <strong>Prize:</strong> The contest prize is a {{ $prizeWithPrice[$brand] }}. The prizes are non-transferable and cannot be exchanged for cash.--}}
{{--                <br><br>--}}
{{--                <strong>Winner Selection:</strong> The winner will be randomly selected from all eligible entries received during the contest period. The winner will be notified by email or direct message within 48 hours of the selection. If the winner does not respond within 48 hours, another winner will be selected.--}}
{{--                <br><br>--}}
{{--                <strong>Release:</strong> By entering the contest, participants release and hold harmless the sponsor, their affiliates, and their respective officers, directors, employees, and agents from any liability or any injury, loss, or damage of any kind arising from or in connection with the contest or any prize won.--}}
{{--                <br><br>--}}
{{--                <strong>General Conditions:</strong> The sponsor reserves the right to cancel, suspend, or modify the contest if fraud, technical failures, or any other factor beyond their control impairs the contest's integrity, as determined by the sponsor in their sole discretion. The sponsor reserves the right to disqualify any individual who violates these Terms and Conditions or interferes with the contest in any way.--}}
{{--                <br><br>--}}
{{--                <strong>Governing Law:</strong> The contest shall be governed by and construed by the laws of the country where the contest is held, without regard to conflicts of law principles.--}}
{{--                <br><br>--}}
{{--                <strong>Privacy:</strong> Personal information collected from participants will be used only to administer the contest and will not be shared with any third party except as necessary to fulfill the prize.--}}
{{--                <br><br>--}}
{{--                By participating in the contest, participants agree to be bound by these Terms and Conditions.--}}
{{--            </p>--}}
{{--        </div>--}}
{{--    </section>--}}

    @include('_partials.components.video-modal',[
        'name' => 'drumeoTrailer',
        'video' => '785314424',
        'vimeo' => true,
    ])
    @include('_partials.components.video-modal',[
        'name' => 'pianoteTrailer',
        'video' => '785314388',
        'vimeo' => true,
    ])
    @include('_partials.components.video-modal',[
        'name' => 'guitareoTrailer',
        'video' => '785314408',
        'vimeo' => true,
    ])
    @include('_partials.components.video-modal',[
        'name' => 'singeoTrailer',
        'video' => '785314379',
        'vimeo' => true,
    ])
</div>
