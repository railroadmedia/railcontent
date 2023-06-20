@extends('partials.layout')

@section('meta')
    <title>Musora | Invite A Friend</title>
@endsection

@section('content')

    @if($brand === 'pianote')
        <div class="referral-sections tw-h-full">
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
                <div class="tw-flex tw-justify-center tw-px-4 dark:tw-bg-[#1B1B1B]">
                    <div class="tw-max-w-3xl tw-mx-auto tw-px-4 md:tw-px-8 tw-rounded-xl tw-bg-white -tw-mt-60 tw-mb-16 tw-py-12 sm:tw-py-20 tw-relative tw-z-30 dark:tw-bg-[#303030] dark:tw-text-white" style="box-shadow: 5px 5px 20px rgba(0, 0, 0, 0.25);">
                        <div class="tw-max-w-sm sm:tw-max-w-none tw-mx-auto">
                            <img
                                class="-tw-mt-40 sm:-tw-mt-64 tw-mx-auto tw-mb-6 tw-transition-opacity tw-opacity-0"
                                src="https://www.musora.com/musora-cdn/image/width=600,quality=85/https://musora-web-platform.s3.amazonaws.com/referral/pianote_Lisa%26Kevin.png"
                                alt="header amazon image"
                                onload="this.classList.remove('tw-opacity-0')"
                                loading="lazy"
                            />
                        </div>
                        <h3 class="tw-font-normal tw-mb-6 tw-text-xl sm:tw-text-2xl md:tw-text-3xl">
                            Refer your friends & family for a chance to <br class="tw-hidden sm:tw-inline"><strong class="tw-font-extrabold">win a piano, VIP lesson, and more!</strong>
                        </h3>
                        <div class="tw-flex tw-flex-col 2xl:tw-flex-row tw-items-center">
                            <div class="tw-flex tw-flex-col lg:tw-h-full tw-w-full tw-mx-auto">
                                <p class="tw-mb-6 md:tw-mb-8 tw-text-sm md:tw-text-lg">
                                    Give a friend unlimited access to Pianote free for 30 days. Every new Pianote referral you make from <b class="tw-font-extrabold">June 19 to 30, 2023</b> instantly enters you for a chance to win one of three prizes! <br><br>
                                    <a href="#terms"><i class="tw-underline tw-text-sm md:tw-text-lg tw-text-black dark:tw-text-white">See Contest Details - Terms & Conditions*</i></a>
                                </p>

                                <div class="tw-flex tw-flex-col lg:tw-h-full tw-w-full tw-max-w-lg 2xl:tw-max-w-none tw-mx-auto">
                                    <form id="invite-email-form" name="invite-email-form" onsubmit="sendPass(event)">
                                        <label class="tw-inline-block tw-w-full tw-text-left tw-pt-6 tw-ml-6"
                                               for="email"><strong>Invite via email</strong></label>
                                        <div
                                            class="tw-flex tw-flex-wrap sm:tw-flex-nowrap tw-items-center tw-justify-center tw-mt-1">
                                            <input type="hidden" name="_token" class="sort-input" id="_token"
                                                   value="{{ csrf_token() }}" />
                                            <input type="hidden" name="brand" class="sort-input"
                                                   value="{{ $brand }}" id="brand" />
                                            <input
                                                class="tw-inline-block tw-text-black tw-w-full tw-mb-4 sm:tw-mb-0 sm:tw-mr-4 tw-default-form-field sm:tw-flex-grow tw-py-0 tw-px-[25px] tw-h-[50px] tw-rounded-[25px] tw-border"
                                                type="email" id="email" name="email" placeholder="Email address..." value="">
                                            <input name="button" type="submit" id="button"
                                                   class=" tw-btn-primary tw-bg-{{ $brand }} hover:tw-bg-{{ $brand }}-600 tw-leading-none tw-text-lg tw-border-0 tw-rounded-full tw-select-none tw-cursor-pointer tw-text-center tw-py-4 tw-px-6 tw-uppercase tw-font-bebas-neue tw-text-white tw-flex-none tw-w-full sm:tw-w-52"
                                                   value="Send Guest Pass" onclick="sendPass(event)" />
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
                            </div>
                        </div>
                    </div>
                </div>
        </section>

        <section class="tw-bg-[#00101D] tw-py-10 lg:tw-py-20">
            <div class="tw-max-w-5xl tw-mx-auto tw-px-3 sm:tw-px-6 xl:tw-px-0 tw-text-white tw-text-center">
                <h3 class="tw-mb-10 tw-text-xl sm:tw-text-2xl md:tw-text-3xl"><strong>You can win...</strong></h3>
                <div class="md:tw-grid md:tw-grid-cols-3 md:tw-gap-4 tw-mb-14 tw-max-w-xs sm:tw-max-w-none tw-mx-auto">
                     <img class="tw-mx-auto tw-mb-6 sm:tw-mb-0" src="https://musora-web-platform.s3.amazonaws.com/referral/pianote_1st+Prize.png" alt="1st prize" />
                     <img class="tw-mx-auto tw-mb-6 sm:tw-mb-0" src="https://musora-web-platform.s3.amazonaws.com/referral/pianote_2nd+Prize.png" alt="2nd prize" />
                     <img class="tw-mx-auto" src="https://musora-web-platform.s3.amazonaws.com/referral/pianote_3rd+Prize.png" alt="3rd prize" />
                </div>
                <b class="tw-italic">PLUS your referred friend gets one entry for a chance to win these prizes, too!</b>
            </div>
        </section>

        <div id="terms" class="tw-block tw-relative tw-invisible"></div>
        <section class="tw-py-12 lg:tw-py-20 dark:tw-bg-[#1B1B1B]">
            <div class="tw-max-w-6xl tw-mx-auto tw-px-6 2xl:tw-px-0 dark:tw-text-white">
                <h4 class="tw-mb-4"><strong>Terms and Conditions</strong></h4>
                <p>
                    <strong>Eligibility:</strong> This contest is open to Musora students with an active, paid membership and new students who sign up for a 30-Day Guest Pass, 18 years or older at the time of entry. Void where prohibited by law. Employees, officers, and directors of the sponsor and their immediate family members and/or those living in the same household are not eligible to participate in the contest.
                    <br><br>
                    <strong>How to Enter:</strong> Musora students automatically receive (1) entry to the contest when a referred friend signs up for a 30-Day Guest Pass between June 19 to 30, 2023. Musora students may collect up to (5) contest entries by having 5 successful referrals within this timeframe. New students who sign-up for a 30-Day Guest Pass within this period will have (1) entry to the contest. No purchase is necessary to enter or win.
                    <br><br>
                    <strong>Prize:</strong> The first prize is a Casio PXS3100BK Digital Piano with a retail value of US$879.99. The second prize is a Pianote Book Bundle & a VIP lesson with an estimated value of US$250. The third prize is a Pianote Book Bundle with a retail value of US$117. The prizes are non-transferable and cannot be exchanged for cash.
                    <br><br>
                    <strong>Winner Selection:</strong> The winner will be selected randomly from all eligible entries received during the entry period. The winner will be notified by email or direct message within 48 hours of the selection. If the winner does not respond within 48 hours, another winner will be selected.
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
    </div>
    @else
        @include('partials.bladesora.members.referral.invite',
            [
                'referralsPerUser' => $referralsPerUser,
                'userReferralsPerformed' => $userReferralsPerformed,
                'userReferralLink' => $userReferralLink,
                'canRefer' => $canRefer,
                'emailInviteUrl' => url()->route('referral.email-invite'),
                'brand' => $brand,
                'showToast' => session()->has('email-invite-message'),
                'toastMessage' => session()->get('email-invite-message'),
            ]
        )
    @endif

    <div id="confirmationModal" class="modal">
        <div class="tw-flex tw-justify-center tw-items-center">
            <div class="tw-max-w-xl tw-bg-white dark:tw-bg-[#081825] tw-text-center dark:tw-text-white tw-rounded-xl tw-px-8 tw-py-10 dark:tw-border-[#445F74] dark:tw-border">
                <div class="tw-text-2xl tw-font-bold">Thanks for sharing your love for music!</div>
                <p class="tw-mt-3 tw-mb-5 tw-max-w-md tw-mx-auto">
                    You've successfully sent <span id="modalEmail"></span> a 30-Day Guest Pass to {{$brand}}.
                </p>
                <div>
                    <span onclick="window.closeAllModals();" class="tw-btn-primary tw-border-[#000C17] tw-text-[#000C17] hover:tw-bg-[#00101D] hover:tw-text-white dark:tw-bg-[#000C17] dark:tw-border-white dark:tw-text-white tw-mr-2 dark:hover:tw-bg-white dark:hover:tw-text-[#000C17]">Close</span>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('layout-scripts')
    <script>
        function sendPass(e) {
            e.preventDefault();

            let token = document.getElementById('_token').value;
            let brand = document.getElementById('brand').value;
            let email = document.getElementById('email').value;

            let data = {
                _token: token,
                brand,
                email,
            };

            if(email){
                fetch('{{ url()->route('referral.email-invite') }}', {
                    method: 'POST',
                    headers: {
                        "Content-Type": "application/json",
                    },
                    body: JSON.stringify(data),
                })
                .then((res) => {
                    //use email value for the modal
                    document.getElementById('modalEmail').innerHTML = email;
                    //blank input
                    document.getElementById('email').value = '';

                    //open modal
                    window.openModal('confirmationModal');
                })
            }
        }

        function copyLink() {
            var link = document.getElementById("referral-link");
            navigator.clipboard.writeText(link.value);
            window.shownotification({
                icon: 'fa-file-import',
                text: `Link copied to clipboard.`
            });
        }

        function hideToast() {
            var toast = document.getElementById("emailSentToast");
            if(toast !== null) {
                if (!toast.classList.contains("tw-hidden")) {
                    toast.classList.add("tw-hidden");
                }
            }
        }

        function docReady(fn) {
            if (document.readyState === "complete" || document.readyState === "interactive") {
                setTimeout(fn, 1);
            } else {
                document.addEventListener("DOMContentLoaded", fn);
            }
        }

        docReady(function() {
            setTimeout(() => {
                hideToast();
            }, 3000);
        });
    </script>
@endsection
