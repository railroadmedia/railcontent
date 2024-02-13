@php
    $cardImages = [
        'drumeo' => 'https://dpwjbsxqtam5n.cloudfront.net/redeem/referral/drumeo-30-day-free-trial.png',
        'pianote' => 'https://dpwjbsxqtam5n.cloudfront.net/redeem/referral/pianote-30-day-free-trial.png',
        'singeo' => 'https://dpwjbsxqtam5n.cloudfront.net/redeem/referral/singeo-30-day-free-trial.png',
        'guitareo' => 'https://dpwjbsxqtam5n.cloudfront.net/redeem/referral/guitareo-30-day-free-trial.png',
    ];

    $instruments = [
        'drumeo' => 'the drums',
        'pianote' => 'the piano',
        'singeo' => 'how to sing',
        'guitareo' => 'the guitar',
    ];

    $lessons = [
        'drumeo' => 'drumming',
        'pianote' => 'piano',
        'singeo' => 'singing',
        'guitareo' => 'guitar',
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
                <h2 class="leading-tight mb-10 lg:mb-14 text-center"><strong>{{ $referredByUserName }} shared one month of free {{ $lessons[$brand] }} lessons. Start your musical journey!</strong></h2>
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
                </div>
            @else
                <h1 class="leading-tight lg:mb-14"><strong>Referral link has expired.</strong></h1>
            @endif
        </div>
    </section>

    <section class="py-12 sm:py-20 text-white bg-cover bg-[url('https://www.musora.com/musora-cdn/image/width=2000,quality=95/https://d3fzm1tzeyr5n3.cloudfront.net/referral/winter/info-section-bg.jpg')]">
        <div class="max-w-4xl mx-auto px-4 xl:px-0 sm:flex sm:items-center text-center sm:text-left">
            <div class="order-1">
                <img
                    class="h-40 sm:h-auto mb-10 sm:mb-0 inline-block"
                    src="https://www.musora.com/musora-cdn/image/width=500,quality=95/https://d3fzm1tzeyr5n3.cloudfront.net/referral/winter/leaf-ring.png"
                    alt="intro"
                />
            </div>
            <div class="sm:pr-10 md:pr-20">
                <h3 class="leading-tight mb-4">
                    <strong>The 12 Days of Giving <br />contest is on right now!</strong>
                </h3>
                <p>
                    Start your 30-day trial today and you’ll enter to win a $100 gift card to {{ ucfirst($brand) }}. This referral contest closes on December 22, 2023. <a class="italic text-white underline" href="#terms">See terms & conditions below.</a>
                </p>
            </div>
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
        "plusAnnualLink" => "/ecommerce/shopify/cart/add-to-cart?products[musora-annual-recurring-30-day-trial-membership]=1&locked=true&referralCode=" . $referralCode,
        "plusMonthlyLink" => "/ecommerce/shopify/cart/add-to-cart?products[musora-monthly-recurring-30-day-trial-membership]=1&locked=true&referralCode=" . $referralCode,
    ])

    @include('musora.sales.components.trial-explanation', [
        'theme' => $referralBrand,
        'instrument' => 'musical',
        "month" => true,
    ])

    <div id="terms" class="block relative invisible"></div>
    <section class="py-12 lg:py-20 bg-[#F9F9F9] dark:bg-[#000B17]">
        <div class="max-w-6xl mx-auto px-6 2xl:px-0 dark:text-white">
            <h4 class="mb-4"><strong>Terms and Conditions</strong></h4>
            <p>
                <strong>Eligibility:</strong> This contest is open to Musora students with an active, paid membership and newly referred students, 18 years or older at the time of entry. Void where prohibited by law. Employees, officers, and directors of the sponsor and their immediate family members and/or those living in the same household are not eligible to participate in the contest.
                <br><br>
                <strong>How to Enter:</strong> Participants automatically receive an entry to the contest when a referred friend signs up for a membership with a 30-day trial from December 11 to 22, 2023. Participants may collect up to (5) contest entries for {{ ucfirst($brand) }} based on each referral sign-up during the contest period; for a total of (20) contest entries across all Musora brands. New students who sign up for {{ ucfirst($brand) }} will gain one contest entry. No purchase is necessary to enter or win.
                <br><br>
                <strong>Prize:</strong> Twelve students will win a $100 Musora gift card redeemable inside the Drumeo, Pianote, Guitareo, and Singeo shops. The prizes are non-transferable and cannot be exchanged for cash.
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
