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
    <section class="tw-text-center tw-text-[#00101D] tw-transition-colors tw-relative {{-- tw-py-6 md:tw-py-10 lg:tw-pt-12 lg:tw-pb-16 --}}">
        <div class="tw-h-96 sm:tw-h-[450px] tw-relative">
            {{--     BG IMAGES      --}}
            <img
                class="tw-absolute tw-w-full tw-h-full tw-top-0 tw-left-0 tw-object-cover tw-transition-opacity tw-opacity-0 tw-z-10 tw-hidden dark:tw-inline-block"
                src="https://www.musora.com/musora-cdn/image/width=1300,quality=90/https://d3fzm1tzeyr5n3.cloudfront.net/referral/header-bg-dark.jpg"
                onload="this.classList.remove('tw-opacity-0')"
                loading="lazy"
                alt="background image"
            />
            <img
                class="tw-absolute tw-w-full tw-h-full tw-top-0 tw-left-0 tw-object-cover tw-transition-opacity tw-opacity-0 tw-z-10 dark:tw-hidden"
                src="https://www.musora.com/musora-cdn/image/width=1300,quality=90/https://d3fzm1tzeyr5n3.cloudfront.net/referral/header-bg-light.jpg"
                onload="this.classList.remove('tw-opacity-0')"
                loading="lazy"
                alt="background image"
            />
        </div>
        <div class="tw-flex tw-justify-center tw-px-4 sm:tw-px-0 dark:tw-bg-[#1B1B1B]">
            <div class="tw-max-w-4xl tw-mx-auto tw-px-4 md:tw-px-8 tw-mt-3 tw-rounded-xl tw-bg-white -tw-mt-60 tw-mb-16 tw-py-12 sm:tw-py-20 tw-relative tw-z-30 dark:tw-bg-[#303030] dark:tw-text-white" style="box-shadow: 5px 5px 20px rgba(0, 0, 0, 0.25);">
                <div class="tw-max-w-sm sm:tw-max-w-none tw-mx-auto">
                    <img
                        class="-tw-mt-40 sm:-tw-mt-52 sm:tw-h-48 md:tw-h-56 tw-mx-auto tw-mb-6 tw-transition-opacity tw-opacity-0"
                        src="https://www.musora.com/musora-cdn/image/width=600,quality=85/https://d3fzm1tzeyr5n3.cloudfront.net/referral/header-collage.png"
                        alt="header amazon image"
                        onload="this.classList.remove('tw-opacity-0')"
                        loading="lazy"
                    />
                </div>
                <h3 class="tw-font-normal tw-mb-6">
                    Refer your friends & family for a chance to <br class="tw-hidden sm:tw-inline"><strong class="tw-font-extrabold">win a $100 Amazon Gift Card.</strong>
                </h3>
                <div class="tw-flex tw-flex-col 2xl:tw-flex-row tw-items-center {{ $containerClass }}">
                    <div
                        class="tw-flex tw-flex-col lg:tw-h-full 2xl:tw-pl-10 tw-w-full tw-max-w-lg md:tw-max-w-2xl tw-mx-auto">
                        <p class="tw-mb-6">
                            Give a friend unlimited access to

                            @if($brand == 'drumeo') Drumeo, @endif
                            @if($brand == 'pianote') Pianote, @endif
                            @if($brand == 'guitareo') Guitareo, @endif
                            @if($brand == 'singeo') Singeo, @endif

                             free for 30 days.<br><br>
                            Every new Musora referral you make from <strong>April 6 to May 8, 2023,</strong> automatically enters you for a chance to win 1 of 10 $100 Amazon gift cards.<br><br>
                            <i class="tw-underline">See Contest Details - Terms & Conditions*</i>
                        </p>

                        <div class="tw-flex-shrink-0 tw-w-full tw-max-w-xs sm:tw-max-w-sm tw-my-5 md:tw-my-6 lg:tw-my-0 tw-mx-auto">
                            <div class="tw-flex tw-w-full tw-relative">
                                <div class="tw-inline-flex tw-w-full ">
                                    <img class="tw-inline-block tw-w-full tw-transition-opacity tw-opacity-0"
                                        src="{{ $cardImage }}"
                                        loading="lazy"
                                        onload="this.classList.remove('tw-opacity-0')"
                                    >
                                </div>
                                <div class="tw-absolute tw-bottom-0 tw-w-full tw-p-3 tw-text-white">
                                    <p class="tw-leading-none">PASSES REDEEMED</p>
                                    <h2 class="tw-leading-none">
                                        <strong>{{ $userReferralsPerformed }}/{{ $referralsPerUser }}</strong>
                                    </h2>
                                </div>
                            </div>
                        </div>

                        <form id="invite-email-form" name="invite-email-form" onsubmit="sendPass(event)" {{-- method="post"
                            action="{{ $emailInviteUrl }}"--}}>
                            <label class="tw-inline-block tw-w-full tw-text-left tw-pt-6 tw-ml-2 tw-uppercase tw-text-sm tw-tracking-wide"
                                for="email"><b>Invite via email</b></label>
                            <div
                                class="tw-flex tw-flex-wrap sm:tw-flex-nowrap tw-items-center tw-justify-center tw-mt-1">
                                <input type="hidden" name="_token" class="sort-input" id="_token"
                                    value="{{ csrf_token() }}" />
                                <input type="hidden" name="brand" class="sort-input" id="brand"
                                       value="{{ $brand }}" />
                                <input
                                    class="tw-inline-block tw-text-black tw-w-full tw-mb-4 sm:tw-mb-0 sm:tw-mr-2 tw-default-form-field sm:tw-flex-grow tw-py-0 tw-px-[25px] tw-h-[50px] tw-rounded-[25px] tw-border"
                                    type="email" id="email" name="email" placeholder="Email address..." value="">
                                <input name="button" type="submit" id="button"
                                    class=" tw-btn-primary tw-bg-[#030814] dark:tw-bg-[#030303] tw-leading-none tw-text-lg tw-border-0 tw-rounded-full tw-select-none tw-cursor-pointer tw-text-center tw-py-4 tw-px-6 tw-uppercase tw-font-bebas-neue tw-text-white tw-flex-none tw-w-full sm:tw-w-52"
                                    value="Send Guest Pass" />
                            </div>
                        </form>
                        <hr class="tw-mt-6" />

                        <form id="invite-link-form" name="invite-link-form" action="#">
                            <label class="tw-inline-block tw-w-full tw-text-left tw-pt-6 tw-ml-2 tw-uppercase tw-text-sm tw-tracking-wide"
                                for="email"><b>Share your link</b></label>
                            <div
                                class="tw-flex tw-flex-wrap sm:tw-flex-nowrap tw-items-center tw-justify-center tw-mt-1">
                                <input
                                    class="tw-text-black tw-inline-block tw-w-full tw-mb-4 sm:tw-mb-0 sm:tw-mr-2 tw-default-form-field sm:tw-flex-grow tw-py-0 tw-px-[25px] tw-h-[50px] tw-rounded-[25px] tw-border"
                                    type="text" id="referral-link" readonly name="referral-link" placeholder="link"
                                    value="{{ $userReferralLink }}">
                                <input
                                    onclick="copyLink()"
                                    name="button" id="sendButton" readonly
                                    class="tw-bg-[#030814] dark:tw-bg-[#030303] tw-leading-none tw-text-lg tw-border-0 tw-rounded-full tw-select-none tw-cursor-pointer tw-text-center tw-py-4 tw-px-6 tw-uppercase tw-font-bebas-neue tw-text-white tw-flex-none tw-w-full sm:tw-w-52"
                                    value="Copy Link" />
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="tw-bg-[#00101D] tw-py-10 lg:tw-py-20">
        <div class="tw-max-w-5xl tw-mx-auto md:tw-flex md:tw-items-center md:tw-justify-center tw-px-4 sm:tw-px-6 xl:tw-px-0">
            <div class="tw-order-1 tw-relative md:tw-pl-5 lg:tw-pl-10 tw-mb-10 md:tw-mb-0">
                <img
                    class="tw-w-72 md:tw-w-96 tw-mx-auto"
                    src="https://www.musora.com/musora-cdn/image/width=500,quality=90/https://d3fzm1tzeyr5n3.cloudfront.net/referral/intro-collage.png"
                    alt="intro"
                />
            </div>
            <div class="tw-text-white tw-max-w-md tw-mx-auto tw-text-center md:tw-text-left">
                <p class="tw-uppercase tw-text-sm tw-mb-2">Got more musical friends? </p>
                <h3 class="tw-leading-tight">
                    <strong>You can refer them to @if($brand !== 'drumeo') Drumeo, @endif  @if($brand !== 'pianote') Pianote, @endif @if($brand === 'singeo') and @endif @if($brand !== 'guitareo') Guitareo, @endif @if($brand !== 'singeo') and Singeo, @endif too.</strong>
                </h3>
                <div class="tw-flex tw-items-center tw-justify-center md:tw-justify-start tw-my-5 tw-text-sm md:tw-text-base">
                    <i class="fa-light fa-calendar-days tw-text-{{$brand}} tw-text-2xl tw-mr-4"></i> <span>Musora Referral Contest&nbsp;-&nbsp;<b>April 6 to May 8, 2023</b></span>
                </div>
                <div class="tw-flex tw-items-center tw-justify-center md:tw-justify-start tw-my-5 tw-text-sm md:tw-text-base">
                    <i class="fa-regular fa-gift tw-text-{{$brand}} tw-text-2xl tw-mr-4"></i> <span>Refer & Enter to&nbsp;<b>Win a $100 Gift Card to Amazon.</b></span>
                </div>
                <i class="tw-text-sm">
                    Guest passes are for new subscribers only and cannot be redeemed for renewals, extensions, or gift subscriptions.
                </i>
                <div class="tw-mt-6 tw-flex tw-flex-col md:tw-flex-row">
                    @if($brand !== 'drumeo') <a href="/drumeo/referral/invite-a-friend" class="tw-btn-secondary tw-text-drumeo tw-px-4 tw-mr-0 md:tw-mr-2 tw-mb-3 md:tw-mb-0 tw-text-base">Refer to Drumeo</a> @endif
                    @if($brand !== 'pianote') <a href="/pianote/referral/invite-a-friend" class="tw-btn-secondary tw-text-pianote tw-px-4 tw-mr-0 md:tw-mr-2 tw-mb-3 md:tw-mb-0 tw-text-base">Refer to Pianote</a> @endif
                    @if($brand !== 'guitareo') <a href="/guitareo/referral/invite-a-friend" class="tw-btn-secondary tw-text-guitareo tw-px-4 tw-mb-3 md:tw-mb-0 @if($brand !== 'singeo') tw-mr-0 md:tw-mr-2 @endif tw-text-base">Refer to Guitareo</a> @endif
                    @if($brand !== 'singeo') <a href="/singeo/referral/invite-a-friend" class="tw-btn-secondary tw-text-singeo tw-px-4 tw-text-base">Refer to Singeo</a> @endif
                </div>
            </div>
        </div>
    </section>
    <section class="tw-py-12 lg:tw-py-20 dark:tw-bg-[#1B1B1B]">
        <div class="tw-max-w-6xl tw-mx-auto tw-px-6 2xl:tw-px-0 dark:tw-text-white">
            <h4 class="tw-mb-4"><strong>Terms and Conditions</strong></h4>
            <p>
                <strong>Eligibility:</strong> The Musora Referral Contest is open to all Musora students who are 18 years of age or older at the time of entry. Void where prohibited by law. Employees, officers, and directors of the sponsor and their immediate family members and/or those living in the same household are not eligible to participate in the contest.
                <br><br>
                <strong>How to Enter:</strong> The contest period runs from April 6 to May 8, 2023. Participants are automatically entered into the contest by using referral methods on this page. Participants can collect one contest entry by 1) referring a friend or family member or 2) having the referee sign-up for a 30-Day Guest Pass. Each participant has a maximum of 20 contest entries total for all brands. No purchase is necessary to enter or win.
                <br><br>
                <strong>Prize:</strong> One of ten $100 Amazon.com gift cards. The prize is non-transferable and cannot be exchanged for cash.
                <br><br>
                <strong>Winner Selection:</strong> The winner will be selected at random from all eligible entries received during the entry period. The winner will be notified by email or direct message within 48 hours of the selection. If the winner does not respond within 48 hours, another winner will be selected.
                <br><br>
                <strong>Release:</strong> By entering the contest, participants release and hold harmless the sponsor, their affiliates, and their respective officers, directors, employees, and agents from any and all liability or any injury, loss, or damage of any kind arising from or in connection with the contest or any prize won.
                <br><br>
                <strong>General Conditions:</strong> The sponsor reserves the right to cancel, suspend, or modify the contest if fraud, technical failures, or any other factor beyond their control impairs the contest's integrity, as determined by the sponsor in their sole discretion. The sponsor reserves the right to disqualify any individual who violates these Terms and Conditions or interferes with the contest in any way.
                <br><br>
                <strong>Governing Law:</strong> The contest shall be governed by and construed in accordance with the laws of the country where the contest is held, without regard to conflicts of law principles.
                <br><br>
                <strong>Privacy:</strong> Personal information collected from participants will be used only for the purpose of administering the contest and will not be shared with any third party except as necessary to fulfill the prize.
                <br><br>
                By participating in the contest, participants agree to be bound by these Terms and Conditions.
            </p>
        </div>
    </section>

    <div id="confirmationModal" class="modal">
        <div class="tw-flex tw-flex-col tw-bg-white dark:tw-bg-[#081825] dark:tw-border-[#445F74] dark:tw-text-white corners-10 tw-shadow tw-py-10 tw-px-7 tw-text-center">
            <h3 class="tw-mb-4"><strong>Thanks for sharing your love for music!</strong></h3>
            <p class="tw-px-4 tw-mb-6">
                You've successfully sent <!--[email address]--> a 30-Day Guest Pass to
                @if($brand == 'drumeo') Drumeo. @endif
                @if($brand == 'pianote') Pianote. @endif
                @if($brand == 'guitareo') Guitareo. @endif
                @if($brand == 'singeo') Singeo. @endif
            </p>
            <div class="tw-text-center">
                <span class="tw-btn-secondary tw-text-black dark:tw-text-white sm:tw-flex-1" onclick="closeModal()">Close</span>
            </div>
        </div>
    </div>
</div>
