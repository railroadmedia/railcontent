<script src="https://www.google.com/recaptcha/api.js"></script>
<style>
    .grecaptcha-badge {
        display: none;
        right: 0 !important;
    }
    .thank-you-box.active {
        max-height: 1000px;
        visibility: visible;
        opacity: 1;
        padding: 10px;
    }
    @media (min-width: 40em) {
        .thank-you-box.active {
            padding: 12px;
        }
    }
</style>
@php
    if (!empty($formId))
        $cleanFormId = str_replace('-', '', (str_replace(' ', '', $formId)));
    else
        $cleanFormId = "ajaxForm";

    $theme = $theme ?? $brand;
@endphp

<div class="form-container">
    <div class="text-center mb-6 content-box">
        @if(!empty($header))
            {!! $header !!}
        @endif
    </div>
    <form id="{{ $cleanFormId }}"
          accept-charset="UTF-8"
          method="POST"
          action="{{ url()->route('customer-io.submit-email-form-rc') }}"
          class="ajax-form clearfix facebook-track-lead mx-auto relative flex flex-wrap {{$formClass ?? ''}}">

        @csrf

        @if(!empty($formName))
            {!! \Railroad\LeadTracker\Services\LeadTrackerService::getRequestTrackingInputsHtmlFromRequest(
                $formName,
                route('customer-io.submit-email-form-rc', [], false),
                'post',
                null,
                null,
                null
            ) !!}
            <input type="hidden" name="form_name" value="{{ $formName }}">
        @endif

        @if(!empty($nameInput))
            <div class="w-full px-2 sm:px-3">
                <div class="my-2">
                    <input type="text"
                           name="first_name"
                           id="sign-up-name"
                           class="block w-full rounded-full border-0 py-2 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-{{$theme}} sm:text-sm sm:leading-6 {{$inputClass ?? ''}}"
                           placeholder="{{ $nameInput ?? 'Your Name' }}"
                           required >
                </div>
            </div>
        @endif

        <div class="w-full px-2 sm:px-3 relative">
            <input type="email"
                   name="email"
                   id="sign-up-email"
                   class="block w-full rounded-full border-0 py-2 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-{{$theme}} sm:text-sm sm:leading-6 {{$inputClass ?? ''}}"
                   placeholder="{{ $inputText ?? 'Your Email' }}"
                   required >
            <p class="opacity-0 pt-0.5 pl-4 text-xs text-red-600 transition-opacity duration-300" id="email-error">
                <i class="fa-solid fa-circle-exclamation text-red-600"></i> Not a valid email address.
            </p>
        </div>

        <div class="w-full px-2 sm:px-3 mt-4">
            <button class="submit g-recaptcha flex w-full justify-center rounded-full px-3 py-2.5 uppercase font-bebas leading-none tw-tracking-tight shadow-sm hover:opacity-90 bg-{{$theme}} {{$buttonClass ?? ''}}"
                    type="submit"
                    data-sitekey="{{ $recaptchaKey }}"
                    data-callback='recaptchaSubmit{{ $cleanFormId }}'
                    data-action='submit'>
                <span class="pre-add py-1">{{ $buttonText ?? 'Get Started' }} <i class="fad fa-paper-plane"></i></span>
                <span class="pending py-1 hidden">Sending <i class="fad fa-spinner-third fa-spin"></i></span>
                <span class="success py-1 hidden">Sent <i class="fad fa-thumbs-up"></i></span>
                <span class="fail py-1 hidden">Try Again <i class="fad fa-exclamation-triangle"></i></span>
            </button>
        </div>

        @if(!empty($formId))
            <input name="inf_form_xid" type="hidden" value="{{ str_replace('-', '', (str_replace(' ', '', $formId))) }}"/>
        @endif
    </form>

    <div class="thank-you-box hidden">
        {{-- Success message by JavaScript --}}
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    document.querySelectorAll('form').forEach(form => {
        const formId = form.id;
        const formContainer = form.closest('.form-container');
        const thankYouBox = formContainer ? formContainer.querySelector('.thank-you-box') : null;
        const contentBox =  formContainer ? formContainer.querySelector('.content-box') : null;

        const emailInput = form.querySelector('input[type="email"]');
        if (emailInput) {
            emailInput.addEventListener('input', function() {
                const emailFormat = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;
                const emailError = form.querySelector('#email-error');
                if (this.value.match(emailFormat)) {
                    if (emailError) emailError.classList.add('opacity-0');
                    this.classList.remove('bg-red-200', 'border-red');
                } else {
                    if (emailError) emailError.classList.remove('opacity-0');
                    this.classList.add('bg-red-200', 'border-red');
                }
            });
        }

        window[`recaptchaSubmit${formId}`] = function(token) {
            const emailFormat = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;
            const userEmail = form.querySelector('input[type=email]');
            const submitButton = form.querySelector('.submit');

            let isValid = true;

            if (userEmail) {
                const emailError = form.querySelector('#email-error');
                if (!userEmail.value.match(emailFormat)) {
                    userEmail.classList.add('bg-red-200', 'border-red-500');
                    if (emailError) emailError.classList.remove('opacity-0');
                    isValid = false;
                } else {
                    userEmail.classList.remove('bg-red-200', 'border-red-500');
                    if (emailError) emailError.classList.add('opacity-0');
                }
            }

            if (isValid && submitButton) {
                const formData = new FormData(form);

                const preAdd = submitButton.querySelector('.pre-add');
                const pending = submitButton.querySelector('.pending');
                const success = submitButton.querySelector('.success');
                const fail = submitButton.querySelector('.fail');

                if (preAdd) preAdd.classList.add('hidden');
                if (pending) pending.classList.remove('hidden');

                axios.post(form.action, formData)
                    .then(response => {
                        if (response.status === 201) {

                        window.dataLayer = window.dataLayer || [];
                        window.dataLayer.push({
                            'event': "gtm.formSubmit",
                            'formId': formId,
                            'success': true
                        });
                            form.classList.add('hidden');

                        const modalCloseIcon = document.querySelector('.modal-close');
                        if (modalCloseIcon) {
                            modalCloseIcon.classList.add('hidden');
                        }

                            if (thankYouBox) {
                                thankYouBox.innerHTML = `
                                    <div class="text-center p-8">
                                        <i class="fa-duotone fa-solid fa-party-horn text-6xl text-{{ $theme }}"></i>
                                        <h3 class="mb-2"><strong>Success!</strong></h3>
                                        <p>Please check the link in your email to get started.</p>
                                    </div>
                                `;
                                thankYouBox.classList.remove('hidden');
                                thankYouBox.classList.add('active');
                            }
                             if (contentBox) {
                                contentBox.classList.add('hidden');
                            }
                        } else {
                            if (pending) pending.classList.add('hidden');
                            if (fail) fail.classList.remove('hidden');

                            setTimeout(() => {
                                if (fail) fail.classList.add('hidden');
                                if (preAdd) preAdd.classList.remove('hidden');
                            }, 2000);
                        }
                    })
                    .catch(error => {
                        console.error('Error submitting form:', error);
                        if (pending) pending.classList.add('hidden');
                        if (fail) fail.classList.remove('hidden');

                        // Reset after 2 seconds
                        setTimeout(() => {
                            if (fail) fail.classList.add('hidden');
                            if (preAdd) preAdd.classList.remove('hidden');
                        }, 2000);
                    });
            }
        };
    });
});

</script>
