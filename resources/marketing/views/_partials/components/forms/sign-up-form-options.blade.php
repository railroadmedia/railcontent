<script src="https://www.google.com/recaptcha/api.js"></script>
<style> .grecaptcha-badge {display:none;right:0!important;} </style>
@php
    if (!empty($formId))
        $cleanFormId = str_replace('-', '', (str_replace(' ', '', $formId)));
    else
        $cleanFormId = "ajaxForm";

    $theme = $theme ?? $brand
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

<form id="{{$cleanFormId}}" accept-charset="UTF-8" method="POST"
    action="{{ url()->route('customer-io.submit-email-form-rc') }}"
    class="ajax-form clearfix facebook-track-lead mx-auto relative">
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

    @if(!empty($nameInput))
        <div class="w-full px-2 sm:px-3 float-left">
            <div class="mt-2">
                                {{-- Name input field --}}
                <input type="text" name="first_name" id="sign-up-name" class="block w-full rounded-full border-0 py-2 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-{{$theme}} sm:text-sm sm:leading-6" placeholder="Your Name" required @if(!empty($inputBorder)) style="border: {{$inputBorder}};" @endif>
            </div>
        </div>
    @endif

    <div class="w-full px-2 sm:px-3 float-left {{ (!empty($stacked) && $stacked) ? '' : 'sm:w-7/12 sm:text-left' }}">
                                {{-- Email input field --}}
        <div class="my-2 relative pb-3">
            <input type="email" name="email" id="sign-up-email" class="block w-full rounded-full border-0 py-2 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-{{$theme}} sm:text-sm sm:leading-6" 
                @if(!empty($inputText)) placeholder="{!!  $inputText  !!}" @else placeholder="Your Email" @endif required @if(!empty($inputBorder)) style="border: {{$inputBorder}};" @endif>
            <div class="validation-icon hidden pointer-events-none absolute bottom-6 right-0 pr-3">
                <i class="fa-solid fa-circle-exclamation text-red-600"></i>
            </div>
            <p class="mt-1 pl-4 text-xs text-red-600 hidden absolute" id="email-error">Not a valid email address.</p>
        </div>
    </div>
            {{--  checkboxItems = ['Label' => 'value'] --}}
    @if(!empty($checkboxItems))
        <div class="w-full px-2 sm:px-3 text-white mb-4">
            <span id="checkbox-tooltip" class="hidden text-red-600 absolute z-10 text-xs" style="top:-15px; left:20;">
                Please select at least one option.
            </span>
            <input name="preferred_instrument" id="preferred_instrument" type="hidden" required>
            <p class="m-3 text-center sm:text-left">Choose your preferred option:</p>
            <div class="gap-x-4 justify-center flex flex-wrap lg:space-x-5">
                @foreach ($checkboxItems as $label => $id)
                    <div class="relative flex items-start justify-center lg:items-center lg:justify-start lg:space-x-3 mb-2 lg:mb-0">
                        <div class="flex h-6 items-center">
                            <input id="{{ $id }}" aria-describedby="{{ $id }}-description" type="checkbox" class="instrument-checkbox cursor-pointer h-4 w-4 rounded border-gray-300 text-{{$theme}} focus:ring-{{$theme}} focus:ring-offset-0 focus:ring-2 focus:ring-opacity-0 bg-{{$theme}}-100 checked:bg-{{$theme}}-500 checked:border-{{$theme}}" value="{{ $label }}" />
                        </div>
                        <div class="ml-3 text-sm leading-6 lg:ml-0 text-center lg:text-left">
                            <label for="{{ $id }}" class="font-medium text-white">{{ $label }}</label>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    @endif

    <div class="w-full px-2 sm:px-3 float-left {{ (!empty($stacked) && $stacked) ? '' : 'sm:w-5/12' }}">
        <button class="submit g-recaptcha flex w-full justify-center rounded-full px-3 py-3 lg:py-2 text-base lg:text-xl uppercase font-bebas leading-none tw-tracking-tight shadow-sm hover:opacity-90 @if(!empty($buttonColor)) {{ $buttonColor }} @else bg-{{$theme}} @endif @if(!empty($outline)) outline @endif" type="submit"
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
</form>

@if(empty($noTy) && empty($minimalForm))
    <div class="disclaimer opacity-70 mx-auto flex items-center justify-center" @if(!empty($disclaimerColor)) style="color: {{$disclaimerColor}};" @endif>
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
    <div class="thank-you-box rounded-full w-full mx-auto text-center text-{{$theme}} max-w-2xl transition-all duration-700 block overflow-hidden invisible max-h-0 opacity-0">
        <h5 class="mx-auto text-xl font-bold"><strong><i class="fas fa-check"></i> Success, Check your email!</strong></h5>
    </div>
@endif

<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
<script>
    function recaptchaSubmit{{$cleanFormId}}(token) {
        const emailFormat = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;
        const userEmail = document.getElementById('{{ $cleanFormId }}').querySelector('input[type=email]');
        const form = document.getElementById("{{$cleanFormId}}");
        const submitButton = form.querySelector('.submit');

        const checkboxes = document.querySelectorAll('.instrument-checkbox');
        const tooltip = document.getElementById('checkbox-tooltip');
        const disclaimer = document.querySelector('.disclaimer');

        if (checkboxes.length > 0) {
            const isCheckboxSelected = Array.from(checkboxes).some(checkbox => checkbox.checked);

            if (!isCheckboxSelected) {
                tooltip.classList.remove('hidden');
                setTimeout(() => {
                    tooltip.classList.add('hidden');
                }, 3000);
                return;
            }
        }

        if(userEmail.value.match(emailFormat)){

            const formData = new FormData(form);

           // for (let [key, value] of formData.entries()) {
           //     console.log(`${key}: ${value}`);
           // }

            submitButton.querySelector('.pre-add').classList.add('hidden');
            submitButton.querySelector('.pending').classList.remove('hidden');

            axios.post(form.action, formData)
                .then(response => {
                    if (response.status === 201) {
                        console.log('Form submitted', response);
                        form.reset();
                        submitButton.querySelector('.pending').classList.add('hidden');
                        submitButton.querySelector('.success').classList.remove('hidden');

                        form.classList.add('hidden');
                        const thankYouBox = document.querySelector('.thank-you-box');
                        thankYouBox.classList.remove('invisible', 'max-h-0', 'opacity-0', 'hidden');
                        thankYouBox.classList.add('active');
                        
                        if (disclaimer) {
                            disclaimer.classList.add('hidden');
                        }

                        const successRedirect = form.querySelector('input[name="success_redirect"]');
                        if (successRedirect && successRedirect.value) {
                            setTimeout(() => {
                                window.location.href = successRedirect.value;
                            }, 2000);
                        }
                    } else if (response.status === 422) {
                        console.error('Form validation failed', response.data);
                        submitButton.querySelector('.pending').classList.add('hidden');
                        submitButton.querySelector('.fail').classList.remove('hidden');
                    } else {
                        console.error('Unexpected response status', response.status);
                        submitButton.querySelector('.pending').classList.add('hidden');
                        submitButton.querySelector('.fail').classList.remove('hidden');
                    }
                })
                .catch(error => {
                    if (error.response) {
                        console.error('Server responded with an error', error.response.data);
                    } else if (error.request) {
                        console.error('No response received', error.request);
                    } else {
                        console.error('Error setting up request', error.message);
                    }
                    submitButton.querySelector('.pending').classList.add('hidden');
                    submitButton.querySelector('.fail').classList.remove('hidden');
                });
                emailSignUpConversionTrackerForImpactProvider();
        } else {
            userEmail.classList.add('bg-red-200', 'border-red-500');
            document.getElementById('email-error').classList.remove('hidden');
            document.querySelector('.validation-icon').classList.remove('hidden');
        }
    }

    document.querySelectorAll('.instrument-checkbox').forEach(checkbox => {
        checkbox.addEventListener('change', function() {
            const selectedInstrument = Array.from(document.querySelectorAll('.instrument-checkbox:checked'))
                .map(cb => cb.value)
                .join(', ');
            document.getElementById('preferred_instrument').value = selectedInstrument;
        });
    });

    document.getElementById('sign-up-email').addEventListener('input', function() {
        const emailFormat = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;
        const emailError = document.getElementById('email-error');
        const iconError = document.querySelector('.validation-icon');
        if (this.value.match(emailFormat)) {
            emailError.classList.add('hidden');
            this.classList.remove('bg-red-200', 'border-red');
            iconError.classList.add('hidden');
        } else {
            emailError.classList.remove('hidden');
            this.classList.add('bg-red-200', 'border-red');
            iconError.classList.remove('hidden');
        }
    });
</script>