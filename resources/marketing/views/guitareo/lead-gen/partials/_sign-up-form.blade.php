<form id="@if(!empty($formId)) {{ str_replace('-', '', (str_replace(' ', '', $formId))) }} @else ajaxForm @endif" accept-charset="UTF-8"
    action="{{ url()->route('customer-io.submit-email-form') }}"
    class="@if(empty($redirectURL)) ajax-form @endif clearfix infusion-form facebook-track-lead mx-auto" method="POST"
    onsubmit="emailSignUpConversionTrackerForImpactProvider()">

    @if(!empty($formName))
        {!! \Railroad\LeadTracker\Services\LeadTrackerService::getRequestTrackingInputsHtmlFromRequest(
            $formName,
            route('customer-io.submit-email-form', [], false),
            'post',
            null,
            null,
            null
        ) !!}
    @endif

    <div class="infusion-field columns {{ (!empty($stacked) && $stacked) ? '' : 'medium-7 medium-text-left' }}">
        <input id="inf_form_xid" name="email" type="email" placeholder="Email Address..." required/>
    </div>
    <div class="infusion-submit columns {{ (!empty($stacked) && $stacked) ? '' : 'medium-5' }}">
        @if(!empty($submitArrows))
            <img class="form-arrow arrow-left" src="https://dpwjbsxqtam5n.cloudfront.net/lead-gen/gsotd/arrow-right-white.png">
            <img class="form-arrow arrow-right" src="https://dpwjbsxqtam5n.cloudfront.net/lead-gen/gsotd/arrow-left-white.png">
        @endif
        <button class="submit @if(!empty($outline)) outline @endif" type="submit">
            <span class="pre-add">@if(!empty($buttonText)) {!!  $buttonText  !!} @else Get Started @endif <i class="fad fa-paper-plane"></i></span>
            <span class="pending hide">Sending <i class="fad fa-spinner-third fa-spin"></i></span>
            <span class="success hide">Sent <i class="fad fa-thumbs-up"></i></span>
            <span class="fail hide">Try Again <i class="fad fa-exclamation-triangle"></i></span>
        </button>
    </div>

    @if(!empty($formId))
        <input name="inf_form_xid" type="hidden" value="{{ str_replace('-', '', (str_replace(' ', '', $formId))) }}"/>
    @endif

    @if(!empty($redirectURL))
        <input name="success_redirect" type="hidden" value="{{ $redirectURL }}"/>
    @else
        <input name="success_redirect" type="hidden" value="/thank-you-white"/>
    @endif

    @if(!empty($formArrows))
        <img class="form-arrow arrow-left" src="https://dpwjbsxqtam5n.cloudfront.net/lead-gen/gsotd/arrow-right-white.png">
        <img class="form-arrow arrow-right" src="https://dpwjbsxqtam5n.cloudfront.net/lead-gen/gsotd/arrow-left-white.png">
    @endif
</form>
<div class="disclaimer">
    <i class="fal fa-info-circle"></i>
    <span>By signing up you’ll also receive our ongoing free lessons and special offers. Don’t worry, we value your privacy and you can unsubscribe at any time.</span>
</div>

<div class="thank-you-box">
    <p><strong><i class="fas fa-check"></i> Success!</strong></p>
    <h2>@if(!empty($headline)) {{ $headline }} @else Check your email @endif</h2>
    <p><em>@if(!empty($body)) {{ $body }} @else You should receive an email from team@guitareo.com within 10 minutes.
            If you don’t, then check your spam folder or re-enter your email address again. @endif
        </em>
    </p>
    <div class="social-media">
        <a href="https://www.youtube.com/user/guitarlessonscom" target="_blank" class="youtube"><i class="fab fa-youtube"></i></a>
        <a href="https://www.facebook.com/guitareoofficial" target="_blank" class="facebook"><i class="fab fa-facebook-f"></i></a>
        <a href="https://www.instagram.com/guitareoofficial/" target="_blank" class="instagram"><i class="fab fa-instagram"></i></a>
    </div>
</div>

@include("guitareo.lead-gen.partials.impact-email-sign-up-tracker")
