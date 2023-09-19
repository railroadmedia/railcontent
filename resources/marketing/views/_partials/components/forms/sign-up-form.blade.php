<script src="https://www.google.com/recaptcha/api.js"></script>
<style> .grecaptcha-badge {display:none;right:0!important;} </style>
@php
    if (!empty($formId))
        $cleanFormId = str_replace('-', '', (str_replace(' ', '', $formId)));
    else
        $cleanFormId = "ajaxForm";
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
    class="ajax-form clearfix infusion-form facebook-track-lead mx-auto"
    onsubmit="emailSignUpConversionTrackerForImpactProvider()">

    @if(!empty($formName))
        {!! \Railroad\LeadTracker\Services\LeadTrackerService::getRequestTrackingInputsHtmlFromRequest(
            $formName,
            route('customer-io.submit-email-form-rc', [], false),
            'post',
            null,
            null,
            null
        ) !!}
    @endif

    <div class="infusion-field w-full px-2 sm:px-3 float-left {{ (!empty($stacked) && $stacked) ? '' : 'sm:w-7/12 sm:text-left' }}">
        <input id='sign-up-email' class="w-full" name="email" type="email" placeholder="Your Email" required @if(!empty($inputBorder)) style="border: {{$inputBorder}};" @endif />
    </div>
    <div class="infusion-submit w-full px-2 sm:px-3 float-left {{ (!empty($stacked) && $stacked) ? '' : 'sm:w-5/12' }}">
        <button class="submit g-recaptcha bg-{{$brand}} hover:opacity-80 @if(!empty($outline)) outline @endif" type="submit"
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
    @else
        <input name="success_redirect" type="hidden" value="{{ $success_redirect }}"/>
    @endif
</form>

@if(empty($noTy) && empty($minimalForm))
    <div class="disclaimer opacity-70 mx-auto flex items-center justify-center" @if(!empty($disclaimerColor)) style="color: {{$disclaimerColor}};" @endif>
        <i class="fa-light fa-info-circle leading-none mr-2"></i>
        <span class="text-left leading-tight text-xs max-w-lg">By signing up you’ll also receive our ongoing free lessons and special offers. Don’t worry, we value your privacy and you can unsubscribe at any time.</span>
    </div>
    <div class="thank-you-box w-full rounded-lg mx-auto bg-white text-center text-black max-w-2xl">
        <p><strong><i class="fas fa-check"></i> Success!</strong></p>
        <h2 class="text-{{ $brand }} my-4 sm:my-5 font-roboto"><strong>@if(!empty($headline)) {{ $headline }} @else CHECK YOUR EMAIL @endif</strong></h2>
        <p><em>@if(!empty($body)) {{ $body }} @else You should receive an email from {{ 'team@' . $brand . '.com' }} within 10 minutes.
                If you don’t, then check your spam folder or re-enter your email address again. @endif
            </em>
        </p>
        @if(empty($noSocial))
            <div class="social-media">
                <a href="https://www.youtube.com/{{ $yt }}/" target="_blank" class="youtube"><i class="fab fa-youtube"></i></a>
                <a href="https://facebook.com/{{ $fb }}/" target="_blank" class="facebook"><i class="fab fa-facebook-f"></i></a>
                <a href="https://instagram.com/{{ $ig }}/" target="_blank" class="instagram"><i class="fab fa-instagram"></i></a>
            </div>
        @endif
    </div>
@else
    <div class="thank-you-box bg-white rounded-full w-full mx-auto text-center text-green-300 max-w-2xl transition-all duration-700 block overflow-hidden invisible max-h-0 opacity-0">
        <h5 class="mx-auto text-xl font-bold"><strong><i class="fas fa-check"></i> Success, Check your email!</strong></h5>
    </div>
@endif

<script>
    function recaptchaSubmit{{$cleanFormId}}(token) {
        const emailFormat = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;
        const userEmail = document.getElementById('sign-up-email').value;

        if(userEmail.match(emailFormat)){
            document.getElementById("{{$cleanFormId}}").submit();
            dataLayer.push({
                "event": "gtm.formSubmit",
                "formId": "{{ $cleanFormId }}",
                "formSuccess": true
            });
            emailSignUpConversionTrackerForImpactProvider();
        }
    }
</script>

