@php
    $cardImages = [
        'drumeo' => 'https://dpwjbsxqtam5n.cloudfront.net/redeem/referral/drumeo-free.png',
        'pianote' => 'https://dpwjbsxqtam5n.cloudfront.net/redeem/referral/pianote-free.png',
        'singeo' => 'https://dpwjbsxqtam5n.cloudfront.net/redeem/referral/singeo-free.png',
        'guitareo' => 'https://dpwjbsxqtam5n.cloudfront.net/redeem/referral/guitareo-free.png',
    ];

    $instruments = [
        'drumeo' => 'drums',
        'pianote' => 'piano',
        'singeo' => 'singing',
        'guitareo' => 'guitar',
    ];

    $prizeWithPrice = [
        'drumeo' => 'Yamaha E-Drum Kit retailing at $499.99 USD',
        'pianote' => 'Yamaha Digital Piano in white retailing at $699.99 USD',
        'singeo' => 'Steinberg Recording Kit with an audio interface, headphones, and a condenser microphone retailing at $359.99 USD',
        'guitareo' => 'Pacifica Electric Guitar in Red retailing at $209.99 USD',
    ];

    $prizeNames = [
        'drumeo' => 'A DTX402K - Yamaha E-Drum Kit',
        'pianote' => 'A P125A WH - Digital Piano (White Finish)',
        'singeo' => 'A UR22CR PACK - Steinberg Interface with Mic and Headphones',
        'guitareo' => 'A PAC012 RM - Pacifica Electric Guitar in Red',
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

<div class="referral-sections pt-8 lg:pt-0">
    <section class="py-16 bg-[#F9F9F9]">
        <div class="container mx-auto max-w-5xl px-4 md:px-8">
            @if ($canRefer && !$errors->has('email-invite-message'))
                <h2 class="leading-tight lg:mb-14 text-center"><strong>{{ $referredByUserName }} thinks you’ll enjoy these lessons. Get {{ ucfirst($brand) }} free for 1 month!</strong></h2>
                <div class="flex items-center sm:px-4 lg:px-0">
                    <div class="relative order-1">
                        <img class="inline-block w-full max-w-xs sm:max-w-md md:max-w-lg lg:max-w-3xl" src="{{ $cardImage }}" alt="{{ $brand }} card">
                        <div class="text-center absolute w-full left-0 bottom-1 text-xs text-white">
                            <i>Starting at $20/month thereafter (billed annually). Cancel anytime.</i>
                        </div>
                    </div>
                    <div class="mr-10">
                        <h5 class="leading-normal font-bold mb-2">Learn the {{ $instruments[$brand] }} faster with step-by-step lessons, a thousand songs, and unlimited personal support.</h5>
                        <div class="flex justify-between max-w-[550px] mb-6">
                            <div>
                                <i class="fas fa-check text-{{ $brand }}"></i> Improve your skills
                            </div>
                            <div>
                                <i class="fas fa-check text-{{ $brand }}"></i> World-class teachers
                            </div>
                            <div>
                                <i class="fas fa-check text-{{ $brand }}"></i> Play more songs
                            </div>
                        </div>
                        <div class="inline-block">
                            <a href="{{ get_legacy_brand_base_url($brand) }}/choose-your-trial-month?referralCode={{ $referralCode }}" class="btn-primary btn-small bg-{{ $brand }} py-5 px-20 mr-2 text-base">1 MONTH FOR FREE</a>
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

    <section class="bg-[#F3B13E] py-9">
        <div class="text-center">
            <p>Enter for a chance to win a piano when you sign up for a {{ ucfirst($brand) }} 30-Day Free Trial.</p>
            <p class="italic font-bold">The contest ends on September 14, 2023.</p>
        </div>
    </section>

    <section style="background:linear-gradient({{ $gradients[$brand] }});">
        <div class="flex flex-col lg:flex-row text-white max-w-4xl mx-auto items-center px-4 xl:px-0 text-center lg:text-left">
            <div class="mb-6 pt-10 lg:pt-0 lg:my-40 lg:max-w-sm w-full lg:mr-6">
                <h1 class="font-extrabold">You can win..</h1>
                <div class="font-bold mt-2 mb-4 ">{{ $prizeNames[$brand] }}</div>
                <div><b>PLUS</b> your referred friend gets one <br class="sm:hidden">entry for a chance to win these prizes!</div>
            </div>

            <img class="@if($brand === 'drumeo') sm:h-[450px] lg:h-[32rem] xl:h-[33rem] -mb-6 lg:-mb-20 @elseif($brand === 'pianote') sm:h-[450px] lg:h-[23rem] xl:h-[28rem] -mb-10 lg:-mb-32 lg:-ml-20 @elseif($brand === 'guitareo') sm:h-[450px] lg:h-[23rem] xl:h-[28rem] -mb-6 lg:-mb-32 lg:-ml-10 @elseif($brand === 'singeo') -mb-6 lg:mb-0 sm:h-56 lg:h-52 xl:h-64 @endif mx-auto" src="https://www.musora.com/musora-cdn/image/width=800,quality=95/{{ $prizeImgs[$brand] }}" alt="{{ $brand }} prize" />
        </div>
    </section>

    <section class="py-20">
        <div class="max-w-6xl mx-auto px-6 2xl:px-0 dark:text-white">
            <h4 class="mb-4"><strong>Terms and Conditions</strong></h4>
            <p>
                <strong>Eligibility:</strong> This contest is open to Musora students with an active, paid membership and newly referred students, 18 years or older at the time of entry. Void where prohibited by law. Employees, officers, and directors of the sponsor and their immediate family members and/or those living in the same household are not eligible to participate in the contest.
                <br><br>
                <strong>How to Enter:</strong> Participants automatically receive (1) entry to the contest when a referred friend signs up for a membership with a 30-day trial from August 18 to September 14, 2023. Participants may collect up to (5) contest entries for {{ ucfirst($brand) }} based on each successful referral during the contest period. New students who sign up for {{ ucfirst($brand) }} will gain one contest entry. No purchase is necessary to enter or win.
                <br><br>
                <strong>Prize:</strong> The contest prize is a {{ $prizeWithPrice[$brand] }}. The prizes are non-transferable and cannot be exchanged for cash.
                <br><br>
                <strong>Winner Selection:</strong> The winner will be randomly selected from all eligible entries received during the contest period. The winner will be notified by email or direct message within 48 hours of the selection. If the winner does not respond within 48 hours, another winner will be selected.
                <br><br>
                <strong>Release:</strong> By entering the contest, participants release and hold harmless the sponsor, their affiliates, and their respective officers, directors, employees, and agents from any liability or any injury, loss, or damage of any kind arising from or in connection with the contest or any prize won.
                <br><br>
                <strong>General Conditions:</strong> The sponsor reserves the right to cancel, suspend, or modify the contest if fraud, technical failures, or any other factor beyond their control impairs the contest's integrity, as determined by the sponsor in their sole discretion. The sponsor reserves the right to disqualify any individual who violates these Terms and Conditions or interferes with the contest in any way.
                <br><br>
                <strong>Governing Law:</strong> The contest shall be governed by and construed by the laws of the country where the contest is held, without regard to conflicts of law principles.
                <br><br>
                <strong>Privacy:</strong> Personal information collected from participants will be used only to administer the contest and will not be shared with any third party except as necessary to fulfill the prize.
                <br><br>
                By participating in the contest, participants agree to be bound by these Terms and Conditions.
            </p>
        </div>
    </section>

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
