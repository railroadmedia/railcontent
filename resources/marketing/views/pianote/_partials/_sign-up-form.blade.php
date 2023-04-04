<form id="@if(!empty($formId)) {{ str_replace('-', '', (str_replace(' ', '', $formId))) }} @else ajaxForm @endif"
        accept-charset="UTF-8" action="{{ url()->route('customer-io.submit-email-form') }}"
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

    <div class="infusion-field w-full px-2 sm:px-3 float-left {{ (!empty($stacked) && $stacked) ? '' : 'sm:w-7/12 sm:text-left' }}">
        <input class="w-full" id="inf_field_Email" name="email" type="email" placeholder="Email Address..." required/>
    </div>
    <div class="infusion-submit w-full px-2 sm:px-3 float-left {{ (!empty($stacked) && $stacked) ? '' : 'sm:w-5/12' }}">
        @if(!empty($submitArrows))
            <img class="form-arrow arrow-left" src="https://dpwjbsxqtam5n.cloudfront.net/lead-gen/gsotd/arrow-right-white.png">
            <img class="form-arrow arrow-right" src="https://dpwjbsxqtam5n.cloudfront.net/lead-gen/gsotd/arrow-left-white.png">
        @endif
        <button class="submit @if(!empty($outline)) outline @endif" type="submit" @if(!empty($buttonBorder)) style="border: 2px solid {{ $buttonBorder }};" @endif>
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

    @if(!empty($formArrows))
        <img class="form-arrow arrow-left" src="https://dpwjbsxqtam5n.cloudfront.net/lead-gen/gsotd/arrow-right-white.png">
        <img class="form-arrow arrow-right" src="https://dpwjbsxqtam5n.cloudfront.net/lead-gen/gsotd/arrow-left-white.png">
    @endif
</form>
@if(empty($minimalForm))
    <div class="disclaimer opacity-70 mx-auto flex items-center" style="max-width: 470px; @if(!empty($disclaimerColor)) color:{{ $disclaimerColor }}; @endif">
        <i class="fal fa-info-circle leading-none w-10 text-xl md:text-3xl"></i>
        <span class="mx-auto text-left leading-tight flex-1 text-xs"><em>By signing up you’ll also receive our ongoing free lessons and special offers. Don’t worry, we value your privacy and you can unsubscribe at any time.</em></span>
    </div>

    <div class="thank-you-box w-full rounded-lg mx-auto bg-white text-center text-black max-w-2xl">
        <p><strong><i class="fas fa-check"></i> Success!</strong></p>
        <h2 class="text-pianote my-4 sm:my-5 font-roboto"><strong>@if(!empty($headline)) {{ $headline }} @else CHECK YOUR EMAIL @endif</strong></h2>
        <p><em>@if(!empty($body)) {{ $body }} @else You should receive an email from team@pianote.com within 10 minutes.
                If you don’t, then check your spam folder or re-enter your email address again. @endif
            </em>
        </p>
        @if(empty($noSocial))
            <div class="social-media">
                <a href="https://youtube.com/user/pianolessonscom" target="_blank" class="youtube"><i class="fab fa-youtube"></i></a>
                <a href="https://facebook.com/pianoteofficial" target="_blank" class="facebook"><i class="fab fa-facebook-f"></i></a>
                <a href="https://instagram.com/pianoteofficial" target="_blank" class="instagram"><i class="fab fa-instagram"></i></a>
            </div>
        @endif
    </div>
@else
    <div class="thank-you-box bg-white rounded-full w-full mx-auto text-center text-green-300 max-w-2xl transition-all duration-700 block overflow-hidden invisible max-h-0 opacity-0">
        <h5 class="mx-auto text-xl font-bold"><strong><i class="fas fa-check"></i> Success, Check your email!</strong></h5>
    </div>
@endif
