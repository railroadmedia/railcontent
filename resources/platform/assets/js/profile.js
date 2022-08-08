import Forms from './vue/vuesora/assets/js/classes/forms';
import Toasts from './vue/vuesora/assets/js/classes/toasts';
import axios from 'axios';

document.addEventListener('DOMContentLoaded', function(){
    openModalOnPageLoad();

    const clearAvatar = document.getElementById('clearAvatar');
    const clearGearPhotoButtons = document.querySelectorAll('[data-clear-gear-photo]');

    const unsubscribeForm = document.getElementById('membershipUnsubscribe');
    const membershipForm = document.getElementById('membershipMain');
    const openUnsubscribeForm = document.getElementById('openUnsubscribeForm');
    const cancelUnsubscribeForm = document.getElementById('cancelUnsubscribeForm');
    const userInfo = document.getElementById('userInfo');
    
    let userId = userInfo ? userInfo.dataset['userId'] : null;

    if(clearAvatar){
        clearAvatar.addEventListener('click', () => {

            Toasts.confirm({
                title: 'Do you really want to reset your avatar?',
                submitButton: {
                    text: '<span class="bg-drumeo text-white short">YES</span>',
                    callback: () => {

                        let url = '/user-management-system/user/update/' + userId;

                        axios.patch(url, {
                            'profile_picture_url': null
                        })
                            .then(response => {
                                if(response.data){
                                    Toasts.push({
                                        icon: 'happy',
                                        title: 'Woohoo!',
                                        themeColor: 'drumeo',
                                        message: 'Avatar Successfully reset. Refreshing the page.'
                                    });
                                    location.reload();
                                }
                            })
                            .catch(error => {
                                console.error(error);
                                Toasts.push({
                                    icon: 'doh',
                                    title: 'An error happened on the server...',
                                    themeColor: 'error',
                                    message: 'Refresh the page to try once more, if it happens again please let us know using the chat below. ' +
                                        '<br><br><span class="font-italic text-grey-3">' +
                                        'Reference: <span class="font-bold">' + error.response.status + ' - ' + error.response.statusText +
                                        '</span></span>'
                                });
                            });
                    }
                },
                cancelButton: {
                    text: '<span class="bg-dark inverted text-grey-3 short">NO</span>'
                }
            });
        });
    }

    if(clearGearPhotoButtons){
        clearGearPhotoButtons.forEach( (clearButton) => {
            
            clearButton.addEventListener('click', () => {
                // console.log(clearButton.dataset)
                Toasts.confirm({
                    title: 'Do you really want to reset your gear photo?',
                    submitButton: {
                        text: '<span class="bg-drumeo text-white short">YES</span>',
                        callback: () => {
    
                            let url = '/user-management-system/user/update/' + userId;
                            let gearAttribute = { [`${clearButton.dataset.clearGearPhoto}_gear_photo`]: null }

                            axios.patch(url, gearAttribute)
                                .then(response => {
                                    if(response.data){
                                        Toasts.push({
                                            icon: 'happy',
                                            title: 'Woohoo!',
                                            themeColor: 'drumeo',
                                            message: 'Gear Photo Successfully reset. Refreshing the page.'
                                        });
                                        location.reload();
                                    }
                                })
                                .catch(error => {
                                    console.error(error);
                                    Toasts.push({
                                        icon: 'doh',
                                        title: 'An error happened on the server...',
                                        themeColor: 'error',
                                        message: 'Refresh the page to try once more, if it happens again please let us know using the chat below. ' +
                                            '<br><br><span class="font-italic text-grey-3">' +
                                            'Reference: <span class="font-bold">' + error.response.status + ' - ' + error.response.statusText +
                                            '</span></span>'
                                    });
                                });
                        }
                    },
                    cancelButton: {
                        text: '<span class="bg-dark inverted text-grey-3 short">NO</span>'
                    }
                });
            });  

        })
    }

    function toggleUnsubscribeForm(){
        membershipForm.classList.toggle('hide');
        unsubscribeForm.classList.toggle('hide');
    }

    if(openUnsubscribeForm){
        openUnsubscribeForm.addEventListener('click', toggleUnsubscribeForm);
    }

    if(cancelUnsubscribeForm){
        cancelUnsubscribeForm.addEventListener('click', toggleUnsubscribeForm);
    }

    Forms.addFileInputEventListeners();

    //Signature WYSIWYG
    tinymce.init({
        selector: '#signature',
        height: 300,
        autoresize_min_height: 300,
        toolbar: 'bold italic underline | link',
        plugins: 'lists link autolink autoresize',
        branding: false,
        elementpath: false,
        statusbar: false,
        menubar: false,
        resize: false,
        image_description: false,
        image_dimensions: false,
        file_picker_types: 'image',
        default_link_target: '_blank',
        target_list: false,
        link_assume_external_targets: true,
        link_title: false,
        media_poster: false,
        media_dimensions: false,
        media_alt_source: false,
        paste_as_text: true,
        images_upload_url: null,
        content_style: `body { font-family: 'Open Sans', sans-serif; font-size:16px; font-weight:400; } p { margin:0; } a { text-decoration: none; } blockquote { border:1px solid #d1d1d1; margin:0 0 0 1em; padding:1em; border-radius:5px; } .quote-heading { background:#e3e8e9; padding:8px 15px; margin:-1em -1em 0 -1em; } .quote-heading strong { font-size:13px; } .quote-heading em { font-size:10px; font-style:italic;text-transform:uppercase;color:#a8a8a8; } span.post-id { display:none; }`,
        convert_urls: true,
        relative_urls: false,
    });
    /*
        Tiny MCE's recomendation for limiting characters
    */
    function getStats(id) {
        var body = tinymce.get(id).getBody(),
        text = tinymce.trim(body.innerText || body.textContent);

        return {
            chars: text.length,
            words: text.split(/[\w\u2019\'-]+/).length
        };
    }
    function submitSignatureForm() {
        const maxLimit = 200;
        const errorMessage = document.querySelector('#signatureErrorMessage');
        // Check if the user has entered less than 200 characters
        if (getStats('signature').chars > maxLimit) {
            errorMessage.classList.remove('tw-opacity-0');
            return;
        }
        // Submit the signature form
        document.querySelector('#signatureModal form').submit();
        errorMessage.classList.add('tw-opacity-0');
    }
    //Intercept Form
    document.addEventListener('click', e => {
        if ( e.target.matches('#signatureButton')) {
            e.preventDefault();
            submitSignatureForm();
        }
    });
});

var openmodal = document.querySelectorAll('.mu-modal-open');
for (var i = 0; i < openmodal.length; i++) {
    openmodal[i].addEventListener('click', function(event){
        event.preventDefault();
        openModal(event);
    });
}

const overlay = document.querySelectorAll('.mu-modal-overlay');
for (var i = 0; i < overlay.length; i++) {
    overlay[i].addEventListener('click', closeModal);
}

var closemodal = document.querySelectorAll('.mu-modal-close');
for (var i = 0; i < closemodal.length; i++) {
    closemodal[i].addEventListener('click', closeModal);
}

var switchToHowCanWeHelp = document.querySelectorAll('.mu-close-modal-then-open-how-can-we-help');
for (var i = 0; i < switchToHowCanWeHelp.length; i++) {
    switchToHowCanWeHelp[i].addEventListener('click', closeModalAndSwitchToHowCanWeHelp);
}

document.onkeydown = function(evt) {
    evt = evt || window.event;
    var isEscape = false;

    if ("key" in evt) {
        isEscape = (evt.key === "Escape" || evt.key === "Esc");
    } else {
        isEscape = (evt.keyCode === 27);
    }
    if (isEscape && document.body.classList.contains('mu-modal-active')) {
        closeModal(evt);
    }
};

function openModal (event) {
    const body = document.querySelector('body');
    const targetModalClass = event.target.id;
    const targetModal = document.querySelector('.' + targetModalClass);

    targetModal.classList.remove('tw-opacity-0');
    targetModal.classList.remove('tw-pointer-events-none');
    targetModal.classList.add('mu-modal-is-open');
    body.classList.add('mu-modal-active');
}


function closeModal () {
    const body = document.querySelector('body');
    const targetModal = document.querySelector('.mu-modal-is-open');

    targetModal.classList.add('tw-opacity-0');
    targetModal.classList.add('tw-pointer-events-none');
    targetModal.classList.remove('mu-modal-is-open');
    body.classList.remove('mu-modal-active');
}

function closeModalAndSwitchToHowCanWeHelp() {
    closeModal();
    openModal({target:{id:'modal-how-can-we-help'}});
}

function openModalOnPageLoad() {
    const queryString = window.location.search;
    const urlParams = new URLSearchParams(queryString);
    const modalIdToOpen = urlParams.get('open-modal-id');

    if (modalIdToOpen) {
        openModal({target:{id:modalIdToOpen}});
    }
}
