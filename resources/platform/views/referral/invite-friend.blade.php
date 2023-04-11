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
                    //blank input
                    document.getElementById('email').value = '';

                    //open modal
                    let buttonClicked = document.getElementById('sendButton').target;
                    const openEvent = new CustomEvent('modalOpen', {
                        detail: {
                            trigger: buttonClicked,
                        },
                    });
                    const modalToOpen = document.getElementById('confirmationModal');

                    if (modalToOpen) {
                        window.appendBackgroundOverlay();

                        document.body.classList.add('no-scroll');
                        document.documentElement.classList.add('no-scroll');
                        modalToOpen.classList.add('displayed');
                        setTimeout(() => {
                            modalToOpen.classList.add('active');
                        }, 50);

                        modalToOpen.dispatchEvent(openEvent);
                    }
                })
            }
        }

        function closeModal() {
            const closeEvent = new CustomEvent('modalClose');

            const modalOverlay = document.getElementById('modalOverlay');
            const modalDialogs = document.querySelectorAll('.modal');

            // Remove the event listeners from the overlay and remove it from the DOM
            if (modalOverlay) {
                modalOverlay.removeEventListener('click', closeModal);
                document.body.removeChild(modalOverlay);
                document.body.classList.remove('no-scroll');
                document.documentElement.classList.remove('no-scroll');

                document.body.style.paddingRight = '0';

                window.dispatchEvent(closeEvent);
            }

            // Remove the active class from all Modals (easier than finding the specific one open)
            Array.from(modalDialogs).forEach((dialog) => {
                dialog.classList.remove('active');
                dialog.classList.remove('displayed');

                if (dialog.classList.contains('vimeo-embedded-player')) {
                    // pause all videos in an iframe if they contain a vimeo src
                    const iframes = dialog.getElementsByTagName('iframe');
                    Array.from(iframes).forEach((iframe) => {
                        const isVimeoIframe = iframe.getAttribute('src')?.includes('vimeo');
                        if (iframe && isVimeoIframe) {
                            const player = new Player(iframe);
                            player.pause();
                        }
                    })
                }
            });
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
