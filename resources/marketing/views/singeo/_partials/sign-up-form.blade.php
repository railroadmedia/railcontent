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
    class="@if(empty($redirectURL)) ajax-form @endif clearfix infusion-form facebook-track-lead mx-auto"
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

    <div class="infusion-field w-full px-1 sm:px-2 float-left @if(!empty($oneLine)) sm:w-7/12 sm:text-left sm:pl-0 @endif @if(!empty($oneLineLg)) lg:w-7/12 lg:text-left lg:pl-0 @endif">
        <input id="sign-up-email" class="w-full" name="email" type="email" placeholder="Email Address..." required/>
    </div>
    <div class="infusion-submit w-full px-1 sm:px-2 float-left @if(!empty($oneLine)) sm:w-5/12 sm:pr-0 @endif @if(!empty($oneLineLg)) lg:w-5/12 lg:pr-0 @endif">
        <button class="submit g-recaptcha @if(!empty($outline)) outline @endif" type="submit"
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
        <input name="success_redirect" type="hidden" value="/thank-you"/>
    @endif
</form>
<div class="disclaimer opacity-70 mx-auto inline-block">
    <i class="fa-light fa-info-circle float-left leading-none"></i>
    <span class="mx-auto text-left float-left leading-tight">By signing up you’ll also receive our ongoing free lessons and special offers. Don’t worry, we value your privacy and you can unsubscribe at any time.</span>
</div>

@if(empty($noTy))
    <div class="thank-you-box w-full rounded-lg mx-auto bg-white text-center text-black max-w-2xl transition-all duration-700 block overflow-hidden invisible max-h-0 opacity-0">
        <h5 class="mx-auto"><strong><i class="fas fa-check"></i> Success!</strong></h5>
        <h2 class="leading-none text-singeo my-3 md:my-4 font-roboto"><strong>@if(!empty($headline)) {{ $headline }} @else CHECK YOUR EMAIL @endif</strong></h2>
        <p class="leading-normal mx-auto max-w-xl"><em>@if(!empty($body)) {{ $body }} @else You should receive an email from team@singeo.com within 10 minutes.
                If you don’t, then check your spam folder or re-enter your email address again. @endif
            </em>
        </p>
        @if(empty($noSocial))
        <div class="mt-5 lg:mt-6">
            <a href="https://www.youtube.com/c/singeoofficial" target="_blank" class="text-white transition-opacity duration-300 py-3 w-14 h-14 text-3xl leading-none rounded-full inline-block text-center m-3 hover:opacity-70 youtube" style="background: #cd201f;"><i class="fab fa-youtube"></i></a>
            <a href="https://www.facebook.com/singeoofficial/" target="_blank" class="text-white transition-opacity duration-300 py-3 w-14 h-14 text-3xl leading-none rounded-full inline-block text-center m-3 hover:opacity-70 facebook" style="background: #3b5998;"><i class="fab fa-facebook-f"></i></a>
            <a href="https://www.instagram.com/singeoofficial/" target="_blank" class="text-white transition-opacity duration-300 py-3 w-14 h-14 text-3xl leading-none rounded-full inline-block text-center m-3 hover:opacity-70 instagram" style="background: linear-gradient(30deg, #FFD521 17%, #F20008 50%, #B900B4 83%);"><i class="fab fa-instagram"></i></a>
        </div>
        @endif
    </div>
@endif
@include("singeo.lead-gen.partials.impact-email-sign-up-tracker")

<script>
    function recaptchaSubmit{{$cleanFormId}}(token) {
        document.getElementById("{{$cleanFormId}}").submit();
    }
</script>
