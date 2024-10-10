<script src="https://www.google.com/recaptcha/api.js"></script>
<style> .grecaptcha-badge {display:none;right:0!important;}
    .thank-you-box.active {
            max-height:1000px;
            visibility:visible;
            opacity:1;
            padding:10px;
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
    $checkboxPosition = $checkboxPosition ?? 'top';
@endphp

@if (!empty($errors) && $errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
<div class="form-container">
<form id="{{$cleanFormId}}" accept-charset="UTF-8" method="POST"
    action="{{ url()->route('customer-io.submit-email-form-rc') }}"
    class="ajax-form clearfix facebook-track-lead mx-auto relative flex flex-wrap">

    {{-- Include tracking inputs for the form --}}
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

    @if(!empty($checkboxItems) && !$stacked  && $checkboxPosition == 'top')
        @include('_partials.components.forms.checkbox-group', [
            'checkboxItems' => $checkboxItems,
            'checkboxTitle' => $checkboxTitle ?? null,
            'theme' => $theme
        ])
    @endif

    @if(!empty($nameInput))
        <div class="w-full px-2 sm:px-3">
            <div class="my-2">
                {{-- Name input field --}}
                <input type="text" name="first_name" id="sign-up-name" class="block w-full rounded-full border-0 py-2 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-{{$theme}} sm:text-sm sm:leading-6" placeholder="Your Name" required @if(!empty($inputBorder)) style="border: {{$inputBorder}};" @endif>
            </div>
        </div>
    @endif

    <div class="w-full px-2 sm:px-3 {{ (!empty($stacked) && $stacked) ? '' : 'sm:w-7/12 sm:text-left' }} relative">
        {{-- Email input field --}}
        <input type="email" name="email" id="sign-up-email" class="block w-full rounded-full border-0 py-2 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-{{$theme}} sm:text-sm sm:leading-6"
            @if(!empty($inputText)) placeholder="{!!  $inputText  !!}" @else placeholder="Your Email" @endif required @if(!empty($inputBorder)) style="border: {{$inputBorder}};" @endif>
        <p class="opacity-0 pt-0.5 pl-4 text-xs text-red-600 transition-opacity duration-300" id="email-error"> <i class="fa-solid fa-circle-exclamation text-red-600"></i> Not a valid email address.</p>
    </div>

    @if(!empty($checkboxItems) && $stacked)
        @include('_partials.components.forms.checkbox-group', [
            'checkboxItems' => $checkboxItems,
            'checkboxTitle' => $checkboxTitle ?? null,
            'theme' => $theme
        ])
    @endif

    <div class="w-full px-2 sm:px-3 {{ (!empty($stacked) && $stacked) ? '' : 'sm:w-5/12 mt-0' }}">
        <button class="submit g-recaptcha flex w-full justify-center rounded-full px-3 py-2.5 text-lg uppercase font-bebas leading-none tw-tracking-tight shadow-sm hover:opacity-90 @if(!empty($buttonColor)) {{ $buttonColor }} @else bg-{{$theme}} @endif @if(!empty($outline)) outline @endif" type="submit"
                data-sitekey="{{$recaptchaKey}}"
                data-callback='recaptchaSubmit{{$cleanFormId}}'
                data-action='submit'>
            <span class="pre-add">@if(!empty($buttonText)) {!!  $buttonText  !!} @else Get Started @endif <i class="fad fa-paper-plane"></i></span>
            <span class="pending hidden">Sending <i class="fad fa-spinner-third fa-spin"></i></span>
            <span class="success hidden">Sent <i class="fad fa-thumbs-up"></i></span>
            <span class="fail hidden">Try Again <i class="fad fa-exclamation-triangle"></i></span>
        </button>
    </div>

    @if(!empty($formId))
        <input name="inf_form_xid" type="hidden" value="{{ str_replace('-', '', (str_replace(' ', '', $formId))) }}"/>
    @endif

   @if(!empty($redirectURL))
        <input name="success_redirect" type="hidden" value="{{ $redirectURL }}"/>
    {{-- @else
        <input name="success_redirect" type="hidden" value="/thank-you"/> --}}
    @endif

    @if(!empty($checkboxItems) && !$stacked && $checkboxPosition == 'bottom')
        @include('_partials.components.forms.checkbox-group', [
            'checkboxItems' => $checkboxItems,
            'checkboxTitle' => $checkboxTitle ?? null,
            'theme' => $theme
        ])
    @endif
</form>

@if(empty($noTy) && empty($minimalForm))
    <div class="disclaimer opacity-70 mx-auto flex items-center justify-center pt-2" @if(!empty($disclaimerColor)) style="color: {{$disclaimerColor}};" @endif>
        <i class="fa-light fa-info-circle leading-none mr-2"></i>
        <span class="text-left leading-tight text-xs max-w-lg">By signing up you’ll also receive our ongoing free lessons and special offers. Don’t worry, we value your privacy and you can unsubscribe at any time.</span>
    </div>

    <div class="thank-you-box w-full rounded-lg mx-auto bg-white text-center text-black max-w-2xl hidden shadow-lg p-6">
        <p><strong><i class="fas fa-check"></i> Success!</strong></p>
        <h2 class="text-{{ $theme }} my-2 font-bebas"><strong>@if(!empty($headline)) {{ $headline }} @else CHECK YOUR EMAIL @endif</strong></h2>
        <p class="leading-normal text-xs"><em>@if(!empty($body)) {{ $body }} @else You should receive an email from {{ 'team@' . $theme . '.com' }} within 10 minutes.
                If you don’t, then check your spam folder or re-enter your email address again. @endif
            </em>
        </p>

        @if(empty($noSocial))
            <div class="social-media tracking-widest">
                @php
                    $socialLinks = [
                        'musora' => ['yt' => '@MusoraMedia', 'fb' => 'musoramedia', 'ig' => 'musoraofficial'],
                        'drumeo' => ['yt' => 'freedrumlessons', 'fb' => 'drumeo', 'ig' => 'drumeoofficial'],
                        'pianote' => ['yt' => 'pianoteofficial', 'fb' => 'pianoteofficial', 'ig' => 'pianoteofficial'],
                        'guitareo' => ['yt' => 'guitarlessonscom', 'fb' => 'guitareoofficial', 'ig' => 'guitareoofficial'],
                        'singeo' => ['yt' => 'singeoofficial', 'fb' => 'singeoofficial', 'ig' => 'singeoofficial']
                    ];
                @endphp

                @if(isset($socialLinks[$theme]))
                    <a href="https://www.youtube.com/{{ $socialLinks[$theme]['yt'] }}/" target="_blank" class="youtube"><i class="fab fa-youtube"></i></a>
                    <a href="https://facebook.com/{{ $socialLinks[$theme]['fb'] }}/" target="_blank" class="facebook"><i class="fab fa-facebook-f"></i></a>
                    <a href="https://instagram.com/{{ $socialLinks[$theme]['ig'] }}/" target="_blank" class="instagram"><i class="fab fa-instagram"></i></a>
                @endif
            </div>
        @endif
    </div>
@else

    <div class="thank-you-box rounded-full w-full mx-auto text-center bg-white bg-opacity-40 text-{{$theme}} max-w-2xl transition-all duration-700 block overflow-hidden invisible max-h-0 opacity-0">
        <h5 class="mx-auto text-xl font-bold"><strong><i class="fas fa-check"></i> Success, Check your email!</strong></h5>
    </div>
@endif

</div>



<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    document.querySelectorAll('form').forEach(form => {
        const formId = form.id;
        const formContainer = form.closest('.form-container');
        const thankYouBox = formContainer ? formContainer.querySelector('.thank-you-box') : null;

        form.querySelectorAll('.instrument-checkbox').forEach(checkbox => {
            checkbox.addEventListener('change', function() {
                const preferredInstrument = form.querySelector('#preferred_instrument');
                if (preferredInstrument) {
                    const selectedInstrument = Array.from(form.querySelectorAll('.instrument-checkbox:checked'))
                        .map(cb => cb.value)
                        .join(', ');
                    preferredInstrument.value = selectedInstrument;
                }
            });
        });

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

        // Define recaptchaSubmit for each form
        window[`recaptchaSubmit${formId}`] = function(token) {
            const emailFormat = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;
            const userEmail = form.querySelector('input[type=email]');
            const submitButton = form.querySelector('.submit');
            const checkboxes = form.querySelectorAll('.instrument-checkbox');
            const tooltip = form.querySelector('#checkbox-tooltip');
            const disclaimer = form.querySelector('.disclaimer');


            let isValid = true;

            if (checkboxes.length > 0 && tooltip) {
                const isCheckboxSelected = Array.from(checkboxes).some(checkbox => checkbox.checked);
                if (!isCheckboxSelected) {
                    tooltip.classList.remove('opacity-0');
                    tooltip.classList.add('opacity-100');
                    setTimeout(() => {
                        tooltip.classList.remove('opacity-100');
                        tooltip.classList.add('opacity-0');
                    }, 3000);
                    isValid = false;
                } else {
                    tooltip.classList.add('opacity-0');
                }
            }

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
                            console.log('Form submitted', response);
                            form.reset();
                            if (pending) pending.classList.add('hidden');
                            if (success) success.classList.remove('hidden');

                            form.classList.add('hidden');
                            if (thankYouBox) {
                                thankYouBox.classList.remove('invisible', 'max-h-0', 'opacity-0', 'hidden');
                                thankYouBox.classList.add('active');
                            }

                            if (disclaimer) {
                                disclaimer.classList.add('hidden');
                            }

                            const successRedirect = form.querySelector('input[name="success_redirect"]');
                            if (successRedirect && successRedirect.value) {
                                setTimeout(() => {
                                    window.location.href = successRedirect.value;
                                }, 2000);
                            }
                        } else {
                            console.error('Unexpected response status', response.status);
                            if (pending) pending.classList.add('hidden');
                            if (fail) fail.classList.remove('hidden');
                        }
                    })
                    .catch(error => {
                        console.error('Error submitting form:', error);
                        if (pending) pending.classList.add('hidden');
                        if (fail) fail.classList.remove('hidden');
                    });
            }
        };
    });
});
</script>
