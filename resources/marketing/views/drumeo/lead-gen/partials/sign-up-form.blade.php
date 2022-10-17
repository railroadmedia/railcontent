<form id="@if(!empty($formId)) {{ str_replace('-', '', (str_replace(' ', '', $formId))) }} @else ajaxForm @endif" accept-charset="UTF-8" action="{{ url()->route('customer-io.submit-email-form') }}"
      class="ajax-form clearfix infusion-form facebook-track-lead mx-auto" method="POST" onsubmit="emailSignUpConversionTrackerForImpactProvider()">

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

    <div class="columns {{ (!empty($stacked) && $stacked) ? '' : 'medium-7' }}">
        <input id = "sign-up-email" class="infusion-field-input-container" name="email" type="email" placeholder="Email Address..." required/>
    </div>
    <div class="infusion-submit columns {{ (!empty($stacked) && $stacked) ? '' : 'medium-5' }}">
        @if(!empty($submitArrows))
            <img class="form-arrow arrow-left" src="https://dpwjbsxqtam5n.cloudfront.net/lead-gen/gsotd/arrow-right-white.png">
            <img class="form-arrow arrow-right" src="https://dpwjbsxqtam5n.cloudfront.net/lead-gen/gsotd/arrow-left-white.png">
        @endif
        <button class="submit infusion-recaptcha" type="submit">
            <span class="pre-add">@if(!empty($buttonText)) {!!  $buttonText  !!} @else Get Started @endif <i class="fad fa-paper-plane"></i></span>
            <span class="pending hide hidden">Sending <i class="fad fa-spinner-third fa-spin"></i></span>
            <span class="success hide hidden">Sent <i class="fad fa-thumbs-up"></i></span>
            <span class="fail hide hidden">Try Again <i class="fad fa-exclamation-triangle"></i></span>
        </button>
    </div>

    @if(!empty($formId))
        <input name="inf_form_xid" type="hidden" value="{{ str_replace('-', '', (str_replace(' ', '', $formId))) }}"/>
    @endif

    @if(!empty($redirectURL))
        <input name="success_redirect" type="hidden" value="{{ $redirectURL }}"/>
    @else
        <input name="success_redirect" type="hidden" value="/thankyou"/>
    @endif

    @if(!empty($formArrows))
        <img class="form-arrow arrow-left" src="https://dpwjbsxqtam5n.cloudfront.net/lead-gen/gsotd/arrow-right-white.png">
        <img class="form-arrow arrow-right" src="https://dpwjbsxqtam5n.cloudfront.net/lead-gen/gsotd/arrow-left-white.png">
    @endif
</form>
<div class="disclaimer">
    <i class="fal fa-info-circle"></i>
    <p>By signing up you’ll also receive our ongoing free lessons and special offers. Don’t worry, we value your privacy and you can unsubscribe at any time.</p>
</div>

@include('lead-gen.partials.thank-you-box')