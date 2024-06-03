@extends('partials.layout')

@section('meta')
    <title>Musora | Invite A Friend</title>
@endsection

@section('content')
    <invite-friend
        :referrals-per-user="{{ json_encode($referralsPerUser) }}"
        :user-referrals-performed="{{ json_encode($userReferralsPerformed) }}"
        user-referral-link="{{ $userReferralLink }}"
        :can-refer="{{ json_encode($canRefer) }}"
        email-invite-url="{{ url()->route('referral.email-invite') }}"
        link-copy-url="{{ url()->route('musora-api.v1.referral.link_copied') }}"
        invite-sent-url="{{ url()->route('musora-api.v1.referral.invite_sent') }}"
        invite-check-url="{{ url()->route('referral.email-invite') }}"
    ></invite-friend>

{{--        @include('partials.bladesora.members.referral.invite',--}}
{{--            [--}}
{{--                'referralsPerUser' => $referralsPerUser,--}}
{{--                'userReferralsPerformed' => $userReferralsPerformed,--}}
{{--                'userReferralLink' => $userReferralLink,--}}
{{--                'canRefer' => $canRefer,--}}
{{--                'emailInviteUrl' => url()->route('referral.email-invite'),--}}
{{--                'brand' => $brand,--}}
{{--                'showToast' => session()->has('email-invite-message'),--}}
{{--                'toastMessage' => session()->get('email-invite-message'),--}}
{{--            ]--}}
{{--        )--}}

{{--        <div id="confirmationModal" class="modal">--}}
{{--            <div class="tw-flex tw-justify-center tw-items-center" style="background:transparent!important;">--}}
{{--                <div class="tw-max-w-xl tw-bg-white dark:tw-bg-[#081825] tw-text-center dark:tw-text-white tw-rounded-xl tw-px-5 sm:tw-px-8 tw-py-6 sm:tw-py-10 dark:tw-border-[#445F74] dark:tw-border">--}}
{{--                    <div class="tw-text-2xl tw-font-bold">Thanks for sharing your love of music!</div>--}}
{{--                    <p class="tw-mt-3 tw-mb-5 tw-max-w-md tw-mx-auto">--}}
{{--                        You've successfully sent <span id="modalEmail"></span>--}}
{{--                        <br class="tw-hidden sm:tw-inline-block"> a 30-Day Trial to {{ ucfirst($brand) }}.--}}
{{--                    </p>--}}
{{--                    <div>--}}
{{--                        <span onclick="window.closeAllModals();" class="tw-btn-primary tw-border-[#000C17] tw-text-[#000C17] hover:tw-bg-[#00101D] hover:tw-text-white dark:tw-bg-[#000C17] dark:tw-border-white dark:tw-text-white tw-mr-2 dark:hover:tw-bg-white dark:hover:tw-text-[#000C17]">Close</span>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
@endsection

@section('layout-scripts')
{{--    <script>--}}
{{--        function sendPass(e) {--}}
{{--            e.preventDefault();--}}

{{--            let token = document.getElementById('_token').value;--}}
{{--            let brand = document.getElementById('brand').value;--}}
{{--            let email = document.getElementById('email');--}}
{{--            const emailFormat = /^\w+([\.-^+]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;--}}

{{--            let data = {--}}
{{--                _token: token,--}}
{{--                brand,--}}
{{--                email: email.value,--}}
{{--            };--}}

{{--            if(email.value.match(emailFormat)){--}}
{{--                fetch('{{ url()->route('referral.email-invite') }}', {--}}
{{--                    method: 'POST',--}}
{{--                    headers: {--}}
{{--                        "Content-Type": "application/json",--}}
{{--                    },--}}
{{--                    body: JSON.stringify(data),--}}
{{--                })--}}
{{--                .then((res) => {--}}
{{--                    //use email value for the modal--}}
{{--                    document.getElementById('modalEmail').innerHTML = email.value;--}}
{{--                    //blank input--}}
{{--                    document.getElementById('email').value = '';--}}
{{--                    //open modal--}}
{{--                    window.openModal('confirmationModal');--}}
{{--                })--}}
{{--                .then((res) => {--}}
{{--                    fetch('{{ url()->route('musora-api.v1.referral.invite_sent') }}', {--}}
{{--                        method: 'POST',--}}
{{--                        headers: {--}}
{{--                            "Content-Type": "application/json",--}}
{{--                        },--}}
{{--                        body: JSON.stringify({--}}
{{--                            _token: '{{ csrf_token() }}',--}}
{{--                            brand,--}}
{{--                        }),--}}
{{--                    });--}}
{{--                })--}}
{{--            }--}}
{{--            else {--}}
{{--                email.classList.add('tw-bg-red-200');--}}
{{--            }--}}
{{--        }--}}

{{--        function copyLink() {--}}
{{--            var link = document.getElementById("referral-link");--}}
{{--            navigator.clipboard.writeText(link.value);--}}
{{--            window.shownotification({--}}
{{--                icon: 'fa-file-import',--}}
{{--                text: `Link copied to clipboard.`--}}
{{--            });--}}
{{--            fetch('{{ url()->route('musora-api.v1.referral.link_copied') }}', {--}}
{{--                method: 'POST',--}}
{{--                headers: {--}}
{{--                    "Content-Type": "application/json",--}}
{{--                },--}}
{{--                body: JSON.stringify({--}}
{{--                    _token: '{{ csrf_token() }}',--}}
{{--                    brand: document.getElementById('brand').value--}}
{{--                }),--}}
{{--            });--}}
{{--        }--}}

{{--        function hideToast() {--}}
{{--            var toast = document.getElementById("emailSentToast");--}}
{{--            if(toast !== null) {--}}
{{--                if (!toast.classList.contains("tw-hidden")) {--}}
{{--                    toast.classList.add("tw-hidden");--}}
{{--                }--}}
{{--            }--}}
{{--        }--}}

{{--        function docReady(fn) {--}}
{{--            if (document.readyState === "complete" || document.readyState === "interactive") {--}}
{{--                setTimeout(fn, 1);--}}
{{--            } else {--}}
{{--                document.addEventListener("DOMContentLoaded", fn);--}}
{{--            }--}}
{{--        }--}}

{{--        docReady(function() {--}}
{{--            setTimeout(() => {--}}
{{--                hideToast();--}}
{{--            }, 3000);--}}
{{--        });--}}
{{--    </script>--}}
@endsection
