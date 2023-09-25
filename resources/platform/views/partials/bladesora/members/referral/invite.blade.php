@php
    $prizes = [
        'drumeo' => 'an e-drum kit',
        'pianote' => 'a digital piano',
        'singeo' => 'a studio kit',
        'guitareo' => 'a guitar',
    ];

    $prizeImgs = [
        'drumeo' => 'https://d3fzm1tzeyr5n3.cloudfront.net/referral/prize-drum.png',
        'pianote' => 'https://d3fzm1tzeyr5n3.cloudfront.net/referral/prize-piano.png',
        'singeo' => 'https://d3fzm1tzeyr5n3.cloudfront.net/referral/prize-mic.png',
        'guitareo' => 'https://d3fzm1tzeyr5n3.cloudfront.net/referral/prize-guitar.png',
    ];

    $prizeNames = [
        'drumeo' => 'Yamaha e-drum kit',
        'pianote' => 'Yamaha digital piano',
        'singeo' => 'singing studio kit',
        'guitareo' => 'Pacifica electric guitar',
    ];

    $prizeNamesWithModel = [
        'drumeo' => 'Yamaha DTX402K E-Drum Kit',
        'pianote' => 'Yamaha P-125a Digital Piano',
        'singeo' => 'Steinberg studio kit',
        'guitareo' => 'Yamaha Pacifica PAC012 Electric Guitar',
    ];

    $prizeWithPrice = [
        'drumeo' => 'Yamaha E-Drum Kit retailing at $499.99 USD',
        'pianote' => 'Yamaha Digital Piano in white retailing at $699.99 USD',
        'singeo' => 'Steinberg Recording Kit with an audio interface, headphones, and a condenser microphone retailing at $359.99 USD',
        'guitareo' => 'Pacifica Electric Guitar in Red retailing at $209.99 USD',
    ];

    $prizeDesc = [
        'drumeo' => 'It has over 250 drum sounds and 10 drum kits customizable to your taste, <br class="tw-hidden md:tw-inline lg:tw-hidden" />for ultimate control over your tone and volume.',
        'pianote' => 'It has a metronome to keep your playing tight. And it connects with your headphones for all those late-night playing sessions.',
        'singeo' => 'You’ll get a microphone, headphones, and an audio interface so you can start to feel more confident as a singer.',
        'guitareo' => 'It\'s well-known for its beautiful tone, playability, and metallic-red look — with vintage-style vibratos and 5-way switching of the H-S-S pickup.',
    ];

    $titleLineOne = $canRefer ? 'Refer your loved ones.' : 'Thank you for your';
    $titleLineTwo = $canRefer ? 'Win '.$prizes[$brand]. '.' : 'referrals & support!';
    $footerLineOne = $canRefer ? '30-Day Trials are for new subscribers only and cannot be' : 'You have referred the maximum of five guests.';
    $footerLineTwo = $canRefer ? 'redeemed for renewals, extensions, or gift subscriptions.' : 'You\'ll have access to more invites soon!';

    $containerClass = $canRefer ? '' : 'tw-justify-center';

    $cardImages = [
        'drumeo' => 'https://dpwjbsxqtam5n.cloudfront.net/redeem/referral/drumeo-30-day-free-trial.png',
        'pianote' => 'https://dpwjbsxqtam5n.cloudfront.net/redeem/referral/pianote-30-day-free-trial.png',
        'singeo' => 'https://dpwjbsxqtam5n.cloudfront.net/redeem/referral/singeo-30-day-free-trial.png',
        'guitareo' => 'https://dpwjbsxqtam5n.cloudfront.net/redeem/referral/guitareo-30-day-free-trial.png',
    ];

    $cardImage = $cardImages[$brand];

    $gradients = [
        'drumeo' => '180deg, #0B76DB 0%, #013362 100%',
        'pianote' => '180deg, #F01A2F 0%, #55050D 100%',
        'singeo' => '180deg, #8101E4 0%, #360160 100%',
        'guitareo' => '180deg, #01C8AB 0%, #045045 100%',
    ];

@endphp

@section('body-data')
    x-data="{
    drumeoTrailer: false,
    pianoteTrailer: false,
    guitareoTrailer: false,
    singeoTrailer: false,
    }"
@endsection

<div class="referral-sections tw-h-full">
    @if (isset($showToast) && $showToast)
        <div class="tw-bottom-0 tw-text-center" id="emailSentToast"
             style="z-index: 2000; position: fixed !important; width: 100%">
            <div
                class="
                tw-bg-{{ $brand }} hover:tw-bg-{{ $brand }}-600
                tw-px-3
                tw-py-2
                tw-w-4/6
                tw-justify-self-center
                tw-mx-auto
                tw-rounded-md">
                <div class="tw-flex tw-justify-between tw-text-white tw-text-small">
                    <div><i class="fas fa-envelope tw-mr-2"></i>{{ $toastMessage ?? 'Your invite has been sent!' }}
                    </div>
                    <button class="tw-bg-transparent tw-border-none" onclick="hideToast();">
                        <i class="far fa-times-circle tw-text-white"></i>
                    </button>
                </div>
            </div>
        </div>
    @endif
    <section class="tw-text-center tw-text-[#00101D] dark:tw-text-white tw-transition-colors tw-py-6 md:tw-py-10 lg:tw-pt-12 lg:tw-pb-16">
        <div class="tw-max-w-7xl tw-mx-auto tw-px-4 md:tw-px-8 tw-mt-3">
            <h1 class="lg:tw-mb-14 tw-text-2xl sm:tw-text-3xl xl:tw-text-5xl">
                <strong>Share 30 days of free<br class="tw-hidden sm:tw-inline"> lessons with a friend!</strong>
            </h1>
            <div class="tw-flex tw-flex-col 2xl:tw-flex-row tw-items-center tw-px-4 {{ $containerClass }}">
                <div class="tw-flex-shrink-0 tw-w-full tw-max-w-xs sm:tw-max-w-md md:tw-max-w-lg lg:tw-max-w-xl tw-my-5 md:tw-my-6 lg:tw-my-0">
                    <div class="tw-flex tw-w-full tw-relative">
                        <div class="tw-w-full">
                            <div class="relative">
                                <img class="inline-block w-full max-w-xs sm:max-w-md md:max-w-lg lg:max-w-xl" src="{{ $cardImage }}" alt="{{ $brand }} guest card">
                            </div>
                            <div class="tw-text-sm tw-italic justify-center tw-mt-2">Starting at $20/month thereafter (billed annually). Cancel anytime.</div>
                        </div>
                    </div>
                </div>
                @if ($canRefer)
                    <div
                        class="tw-flex tw-flex-col lg:tw-h-full 2xl:tw-pl-10 tw-w-full tw-max-w-xl 2xl:tw-max-w-none tw-mx-auto">
{{--                        <h5 class="tw-py-4 tw-text-lg tw-font-normal">--}}
{{--                            Share one free month of {{ ucfirst($brand) }} with your friends! Each successful referral from <b>August 17 to September 14</b> enters you to win a {{ $prizeNames[$brand] }}.--}}
{{--                        </h5>--}}
{{--                        <a href="#terms" class="tw-text-center tw-italic tw-underline tw-cursor-pointer tw-text-black dark:tw-text-white">See Contest Terms & Conditions</a>--}}
                        <form id="invite-email-form" name="invite-email-form" onsubmit="sendPass(event)">
                            <label class="tw-inline-block tw-w-full tw-text-left tw-pt-6 tw-ml-6"
                                   for="email"><strong>Invite via email</strong></label>
                            <div
                                class="tw-flex tw-flex-wrap sm:tw-flex-nowrap tw-items-center tw-justify-center tw-mt-1">
                                <input type="hidden" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$" name="_token" class="sort-input" id="_token"
                                       value="{{ csrf_token() }}" />
                                <input type="hidden" name="brand" class="sort-input"
                                       value="{{ $brand }}" id="brand" />
                                <input
                                    class="tw-inline-block tw-text-black tw-w-full tw-mb-4 sm:tw-mb-0 sm:tw-mr-4 tw-default-form-field sm:tw-flex-grow tw-py-0 tw-px-[25px] tw-h-[50px] tw-rounded-[25px] tw-border"
                                    type="email" id="email" name="email" placeholder="Email address..." value="" required>
                                <input name="button" type="submit" id="button"
                                       class=" tw-btn-primary tw-bg-{{ $brand }} hover:tw-bg-{{ $brand }}-600 tw-leading-none tw-text-lg tw-border-0 tw-rounded-full tw-select-none tw-cursor-pointer tw-text-center tw-py-4 tw-px-6 tw-uppercase tw-font-bebas-neue tw-text-white tw-flex-none tw-w-full sm:tw-w-52"
                                       value="Send 30-day trial" onclick="sendPass(event)" />
                            </div>
                        </form>

                        <form id="invite-link-form" name="invite-link-form" action="#">
                            <label class="tw-inline-block tw-w-full tw-text-left tw-pt-6 tw-ml-6"
                                   for="email"><strong>Share your link</strong></label>
                            <div
                                class="tw-flex tw-flex-wrap sm:tw-flex-nowrap tw-items-center tw-justify-center tw-mt-1">
                                <input
                                    class="tw-text-black tw-inline-block tw-w-full tw-mb-4 sm:tw-mb-0 sm:tw-mr-4 tw-default-form-field sm:tw-flex-grow tw-py-0 tw-px-[25px] tw-h-[50px] tw-rounded-[25px] tw-border"
                                    type="text" id="referral-link" readonly name="referral-link" placeholder="link"
                                    value="{{ $userReferralLink }}">
                                <input onclick="copyLink()" name="button" id="button" readonly
                                       class="tw-bg-{{ $brand }} hover:tw-bg-{{ $brand }}-600 tw-leading-none tw-text-lg tw-border-0 tw-rounded-full tw-select-none tw-cursor-pointer tw-text-center tw-py-4 tw-px-6 tw-uppercase tw-font-bebas-neue tw-text-white tw-flex-none tw-w-full sm:tw-w-52"
                                       value="Copy Link" />
                            </div>
                        </form>
                    </div>
                @endif
            </div>
        </div>
    </section>
    <section class="tw-text-center dark:tw-text-white tw-py-5 md:tw-py-8 dark:tw-bg-[#081f35] tw-bg-[#E6E7E9]">
        <div class="tw-max-w-6xl tw-mx-auto tw-px-4 md:tw-px-8">
            <h5 class="tw-leading-normal tw-opacity-70 tw-text-lg">{{ $footerLineOne }}<br class="tw-hidden lg:tw-inline">
                {{ $footerLineTwo }}</h5>
        </div>
    </section>

{{--    <section style="background:linear-gradient({{ $gradients[$brand] }});">--}}
{{--        <div class="tw-flex tw-flex-col lg:tw-flex-row tw-text-white tw-max-w-4xl tw-mx-auto tw-items-center tw-px-4 xl:tw-px-0 tw-text-center lg:tw-text-left">--}}
{{--            <div class="tw-mb-6 tw-pt-10 lg:tw-pt-0 lg:tw-my-40 lg:tw-max-w-md tw-w-full lg:tw-mr-6">--}}
{{--                <h1 class="tw-font-extrabold tw-leading-none tw-mb-4">This could be yours…</h1>--}}
{{--                <div class="tw-font-bold tw-mt-2 tw-mb-4 ">The {{ $prizeNamesWithModel[$brand] }}</div>--}}
{{--                <div class="tw-mb-4">{!! $prizeDesc[$brand] !!}</div>--}}
{{--                <div><b>PLUS</b> your referred friend gets an entry to win!</div>--}}
{{--            </div>--}}

{{--            <img class="@if($brand === 'drumeo') sm:tw-h-[450px] lg:tw-h-[32rem] xl:tw-h-[33rem] -tw-mb-6 lg:-tw-mb-20 @elseif($brand === 'pianote') sm:tw-h-[450px] lg:tw-h-[23rem] xl:tw-h-[28rem] -tw-mb-10 lg:-tw-mb-32 lg:-tw-ml-20 @elseif($brand === 'guitareo') sm:tw-h-[450px] lg:tw-h-[23rem] xl:tw-h-[28rem] -tw-mb-6 lg:-tw-mb-32 lg:-tw-ml-10 @elseif($brand === 'singeo') -tw-mb-6 lg:tw-mb-0 sm:tw-h-56 lg:tw-h-52 xl:tw-h-64 @endif tw-mx-auto" src="https://www.musora.com/musora-cdn/image/width=800,quality=95/{{ $prizeImgs[$brand] }}" alt="{{ $brand }} prize" />--}}
{{--        </div>--}}
{{--    </section>--}}

{{--    <div id="terms" class="tw-block tw-relative tw-invisible"></div>--}}
{{--    <section class="tw-py-20">--}}
{{--        <div class="tw-max-w-6xl tw-mx-auto tw-px-6 2xl:tw-px-0 dark:tw-text-white">--}}
{{--            <h4 class="tw-mb-4"><strong>Terms and Conditions</strong></h4>--}}
{{--            <p>--}}
{{--                <strong>Eligibility:</strong> This contest is open to Musora students with an active, paid membership and newly referred students, 18 years or older at the time of entry. Void where prohibited by law. Employees, officers, and directors of the sponsor and their immediate family members and/or those living in the same household are not eligible to participate in the contest.--}}
{{--                <br><br>--}}
{{--                <strong>How to Enter:</strong> Participants automatically receive (1) entry to the contest when a referred friend signs up for a membership with a 30-day trial from August 17 to September 14, 2023. Participants may collect up to (5) contest entries for {{ ucfirst($brand) }} based on each successful referral during the contest period. New students who sign up for {{ ucfirst($brand) }} will gain one contest entry. No purchase is necessary to enter or win.--}}
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
</div>
