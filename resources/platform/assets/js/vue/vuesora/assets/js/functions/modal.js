import Utils from '../classes/utils';
import Player from '@vimeo/player';

export default (function () {
    document.addEventListener('DOMContentLoaded', () => {
        const closeEvent = new CustomEvent('modalClose');

        document.body.addEventListener('click', (event) => {
            const buttonClicked = event.target;
            const modalId = buttonClicked.dataset.openModal;

            if (modalId != null) {
                openModal(modalId, buttonClicked);
            }

            if (buttonClicked.classList.contains('close-modal')) {
                closeModal();
            }
        });

        document.body.addEventListener('openModal', (event) => {
            openModal(event.detail.target);
        });

        function openModal(modalId, buttonClicked) {
            const openEvent = new CustomEvent('modalOpen', {
                detail: {
                    trigger: buttonClicked,
                },
            });
            const modalToOpen = document.getElementById(modalId);

            closeModal();

            //event.stopPropagation();

            if (modalToOpen) {
                window.appendBackgroundOverlay();
                const xIcon = document.createElement('span');
                xIcon.setAttribute('id', 'modalXIcon');
                xIcon.setAttribute('class', 'close-modal');

                const appendDiv = modalToOpen.getElementsByClassName('tw-relative');
                const xIconCheck = modalToOpen.querySelector('#modalXIcon');
                if(!xIconCheck) {
                    if(appendDiv.length !== 0) {
                        appendDiv[0].appendChild(xIcon);
                    }
                    else{
                        xIcon.setAttribute('class', 'black');
                        modalToOpen.appendChild(xIcon);
                    }
                }

                document.body.classList.add('no-scroll');
                document.documentElement.classList.add('no-scroll');
                modalToOpen.classList.add('displayed');
                setTimeout(() => {
                    modalToOpen.classList.add('active');
                }, 50);

                modalToOpen.dispatchEvent(openEvent);
            } else {
                console.error(`Modal Error - Could not find modal with the ID: "${modalId}"`);
            }
        }

        function closeModal() {
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

            // window.modalSimpleBar = null;
        }

        window.closeAllModals = function () {
            closeModal();
        };

        window.appendBackgroundOverlay = function () {
            const modalOverlay = document.createElement('div');

            // Add ID to overlay
            modalOverlay.setAttribute('id', 'modalOverlay');

            // Append to the DOM
            document.body.appendChild(modalOverlay);

            // Add active class to fade in
            modalOverlay.classList.add('active');

            // Add an event listener
            modalOverlay.addEventListener('click', closeModal);

            // Add padding to the right of the page if there's a scrollbar
            const bodyHeight = document.body.clientHeight;
            const clientHeight = document.documentElement.clientHeight;

            if (bodyHeight > clientHeight) {
                document.body.style.paddingRight = `${Utils.getScrollBarWidth()}px`;
            }
        };

        window.openModal = openModal;
        window.closeModal = closeModal;
    });
}());
