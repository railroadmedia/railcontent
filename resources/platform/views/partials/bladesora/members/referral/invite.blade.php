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
        <div class="tw-h-[450px] tw-relative">
            {{--     BG IMAGES      --}}
            <img
                class="tw-absolute tw-w-full tw-h-full tw-top-0 tw-left-0 tw-object-cover tw-transition-opacity tw-opacity-0 tw-z-10 tw-hidden dark:tw-inline-block"
                src="https://d3fzm1tzeyr5n3.cloudfront.net/referral/header-bg-dark.jpg"
                onload="this.classList.remove('tw-opacity-0')"
                loading="lazy"
                alt="background image"
            />
            <img
                class="tw-absolute tw-w-full tw-h-full tw-top-0 tw-left-0 tw-object-cover tw-transition-opacity tw-opacity-0 tw-z-10 dark:tw-hidden"
                src="https://d3fzm1tzeyr5n3.cloudfront.net/referral/header-bg-light.jpg"
                onload="this.classList.remove('tw-opacity-0')"
                loading="lazy"
                alt="background image"
            />
        </div>
        <div class="tw-flex tw-justify-center tw-px-4 sm:tw-px-0 dark:tw-bg-[#1B1B1B]">
            <div class="tw-max-w-4xl tw-mx-auto tw-px-4 md:tw-px-8 tw-mt-3 tw-rounded-xl tw-bg-white -tw-mt-60 tw-mb-16 tw-py-20 tw-relative tw-z-30 dark:tw-bg-[#303030] dark:tw-text-white" style="box-shadow: 5px 5px 20px rgba(0, 0, 0, 0.25);">
                <div class="tw-max-w-sm sm:tw-max-w-none tw-mx-auto">
                    <img
                        class="-tw-mt-40 sm:-tw-mt-52 sm:tw-h-48 md:tw-h-56 tw-mx-auto tw-mb-6 tw-transition-opacity tw-opacity-0"
                        src="https://d3fzm1tzeyr5n3.cloudfront.net/referral/header-collage.png"
                        alt="header amazon image"
                        onload="this.classList.remove('tw-opacity-0')"
                        loading="lazy"
                    />
                </div>
                <h3 class="tw-font-normal tw-mb-6">
                    Refer your friends & family for a chance to <br class="tw-hidden sm:tw-inline"><strong class="tw-font-extrabold">win a $200 Amazon Gift Card.</strong>
                </h3>
                <div class="tw-flex tw-flex-col 2xl:tw-flex-row tw-items-center {{ $containerClass }}">
                    <div
                        class="tw-flex tw-flex-col lg:tw-h-full 2xl:tw-pl-10 tw-w-full tw-max-w-lg md:tw-max-w-2xl tw-mx-auto">
                        <p class="tw-mb-6">
                            Give a friend unlimited access to Pianote, free for 30 days.<br><br>
                            Every new Musora referral you make from <strong>April 6 to May 8, 2023,</strong> automatically enters you for a chance to win 1 of 4 $200 Amazon gift cards.<br><br>
                            <i class="tw-underline">See Contest Details - Terms & Conditions*</i>
                        </p>

                        <form id="invite-email-form" name="invite-email-form" method="post"
                            action="{{ $emailInviteUrl }}">
                            <label class="tw-inline-block tw-w-full tw-text-left tw-pt-6 tw-ml-2 tw-uppercase tw-text-sm tw-tracking-wide"
                                for="email"><b>Invite via email</b></label>
                            <div
                                class="tw-flex tw-flex-wrap sm:tw-flex-nowrap tw-items-center tw-justify-center tw-mt-1">
                                <input type="hidden" name="_token" class="sort-input"
                                    value="{{ csrf_token() }}" />
                                <input type="hidden" name="brand" class="sort-input"
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
                                <input onclick="copyLink()" name="button" id="button" readonly
                                    class="tw-bg-[#030814] dark:tw-bg-[#030303] tw-leading-none tw-text-lg tw-border-0 tw-rounded-full tw-select-none tw-cursor-pointer tw-text-center tw-py-4 tw-px-6 tw-uppercase tw-font-bebas-neue tw-text-white tw-flex-none tw-w-full sm:tw-w-52"
                                    value="Copy Link" />
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="tw-bg-[#00101D] tw-py-12 lg:tw-py-20">
        <div class="tw-max-w-5xl tw-mx-auto md:tw-flex md:tw-items-center md:tw-justify-center tw-px-4 xl:tw-px-0">
            <div class="tw-order-1 tw-relative md:tw-pl-10 tw-mb-10 md:tw-mb-0">
                <img
                    class="tw-w-96 tw-mx-auto"
                    src="https://musora-web-platform.s3.amazonaws.com/referral/intro-collage.png"
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
                    <i class="fa-regular fa-gift tw-text-{{$brand}} tw-text-2xl tw-mr-4"></i> <span>Refer & Enter to&nbsp;<b>Win a $200 Gift Card to Amazon.</b></span>
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
        <div class="tw-max-w-6xl tw-mx-auto tw-px-4 2xl:tw-px-0 dark:tw-text-white">
            <h4 class="tw-mb-4"><strong>Terms and Conditions</strong></h4>
            <p>
                Lorem ipsum dolor sit amet consectetur. Ultricies pretium enim vitae consectetur. Nisl tristique mi sed molestie sed. Eu tellus sed tristique cras fames orci in duis turpis. Cras mi eget cursus elementum aliquet. Ultrices tellus morbi lorem egestas non placerat facilisis nisi. Ut nisi bibendum non odio arcu nibh pellentesque nec. <br><br>
                Mi morbi mollis fusce libero. Donec faucibus faucibus auctor ut nam. Vitae amet viverra et integer faucibus faucibus. Imperdiet sit placerat tempor quis volutpat. Tempor nullam libero quis dui interdum nunc suspendisse. Bibendum cursus duis facilisi elementum scelerisque neque tortor nec. Vitae morbi tortor eu risus.<br><br>
                Nunc amet sit nisi consectetur gravida imperdiet turpis eget dui. Faucibus amet amet lacus ut. Lectus enim erat hendrerit sit nulla tortor. Massa mauris duis potenti ullamcorper amet feugiat. Maecenas lacus dolor elit vel diam at. Mauris in urna dolor netus viverra odio rhoncus condimentum turpis. Vitae est ultrices euismod pulvinar molestie tempus sollicitudin eu. Felis consectetur id nascetur enim sit integer est odio semper. Purus vitae lobortis a bibendum donec vestibulum tellus. Condimentum dictumst nibh consectetur enim auctor dictumst sit lacus et.<br><br>
                Justo massa est amet sed. Leo eget fringilla pellentesque et. Ipsum maecenas adipiscing aliquet risus aliquam viverra quam. Sed ante ornare leo tristique ultricies nunc libero. At leo lectus amet curabitur diam nec at et quisque.<br><br>
                Pellentesque feugiat dignissim diam scelerisque. Id sit ultrices semper mi eu. Commodo risus nisl lacus tristique enim erat imperdiet. Viverra massa nunc id sollicitudin pretium et pulvinar ullamcorper tincidunt. Mauris eu odio est lobortis ultricies. Fringilla venenatis aenean ultricies cursus. In morbi ac mi sed orci est. Ut nunc enim risus nunc ut volutpat at. Quis pharetra aliquam non nulla bibendum platea tempus amet. Ultrices turpis sed cursus cras maecenas orci nunc condimentum. Elementum vulputate elit tristique montes arcu dictumst nec faucibus. Posuere suspendisse eleifend porttitor sagittis mi. In in orci justo amet nisl elementum ut netus. Lacus vitae arcu dictum augue ultrices tortor penatibus orci lectus. Faucibus ut sit lobortis id phasellus id.
            </p>
        </div>
    </section>
</div>
