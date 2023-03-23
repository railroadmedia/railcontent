@extends('partials.layout')

@section('meta')
    <title>Musora | Invite A Friend</title>
@endsection

@section('content')

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
                    //add code to open modal
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
