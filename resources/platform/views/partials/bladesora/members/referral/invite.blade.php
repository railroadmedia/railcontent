@php
    $titleLineOne = $canRefer ? 'Share a free 30-day pass' : 'Thank you for your';
    $titleLineTwo = $canRefer ? 'with up to five friends.' : 'referrals & support!';
    $footerLineOne = $canRefer ? 'Guest passes are for new subscribers only and cannot be' : 'You have referred the maximum of five guests.';
    $footerLineTwo = $canRefer ? 'redeemed for renewals, extensions, or gift subscriptions.' : 'You\'ll have access to more invites soon!';

    $containerClass = $canRefer ? '' : 'tw-justify-center';

    $cardImages = [
        'drumeo' => 'https://dpwjbsxqtam5n.cloudfront.net/redeem/referral/30-day-guest-pass.png',
        'pianote' => 'https://dpwjbsxqtam5n.cloudfront.net/redeem/referral/pianote-guest-pass.png',
        'singeo' => 'https://dpwjbsxqtam5n.cloudfront.net/redeem/referral/singeo-guest-pass.png',
        'guitareo' => 'https://dpwjbsxqtam5n.cloudfront.net/redeem/referral/guitareo-guest-pass.png',
    ];

    $cardImage = $cardImages[brand()];

@endphp

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
                <strong>{{ $titleLineOne }}<br> {{ $titleLineTwo }}</strong>
            </h1>
            <div class="tw-flex tw-flex-col 2xl:tw-flex-row tw-items-center tw-px-4 {{ $containerClass }}">

                <div class="tw-flex-shrink-0 tw-w-full tw-max-w-xs sm:tw-max-w-md md:tw-max-w-lg lg:tw-max-w-xl tw-my-5 md:tw-my-6 lg:tw-my-0">
                    <div class="tw-flex tw-w-full tw-relative">
                        <div class="tw-inline-flex tw-w-full ">
                            <img class="tw-inline-block tw-w-full tw-transition-opacity tw-opacity-0"
                                src="{{ $cardImage }}"
                                loading="lazy"
                                onload="this.classList.remove('tw-opacity-0')"
                            >
                        </div>
                        <div class="tw-absolute tw-bottom-0 tw-w-full tw-p-4 tw-text-white">
                            <p class="tw-leading-none">PASSES REDEEMED</p>
                            <h1 class="tw-leading-none">
                                <strong>{{ $userReferralsPerformed }}/{{ $referralsPerUser }}</strong>
                            </h1>
                        </div>
                    </div>
                </div>
                @if ($canRefer)
                    <div
                        class="tw-flex tw-flex-col lg:tw-h-full 2xl:tw-pl-10 tw-w-full tw-max-w-lg 2xl:tw-max-w-none tw-mx-auto">
                        <h5 class="tw-leading-tight tw-py-4 tw-text-lg">Give a friend unlimited access to {{ ucfirst($brand) }}, free for 30 days
                        </h5>
                        <form id="invite-email-form" name="invite-email-form" method="post"
                            action="{{ $emailInviteUrl }}">
                            <label class="tw-inline-block tw-w-full tw-text-left tw-pt-6 tw-ml-6"
                                for="email"><strong>Invite via email</strong></label>
                            <div
                                class="tw-flex tw-flex-wrap sm:tw-flex-nowrap tw-items-center tw-justify-center tw-mt-1">
                                <input type="hidden" name="_token" class="sort-input"
                                    value="{{ csrf_token() }}" />
                                <input type="hidden" name="brand" class="sort-input"
                                    value="{{ $brand }}" />
                                <input
                                    class="tw-inline-block tw-text-black tw-w-full tw-mb-4 sm:tw-mb-0 sm:tw-mr-4 tw-default-form-field sm:tw-flex-grow tw-py-0 tw-px-[25px] tw-h-[50px] tw-rounded-[25px] tw-border"
                                    type="email" id="email" name="email" placeholder="Email address..." value="">
                                <input name="button" type="submit" id="button"
                                    class=" tw-btn-primary tw-bg-{{ $brand }} hover:tw-bg-{{ $brand }}-600 tw-leading-none tw-text-lg tw-border-0 tw-rounded-full tw-select-none tw-cursor-pointer tw-text-center tw-py-4 tw-px-6 tw-uppercase tw-font-bebas-neue tw-text-white tw-flex-none tw-w-full sm:tw-w-52"
                                    value="Send Guest Pass" />
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
</div>
