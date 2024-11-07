@include('_partials.components.cookie-modal')
<footer id="footer" class="bottom-footer clearfix relative bg-[#111729]">
    @if(empty($minimal))
    <div class="container mx-auto max-w-[75rem]">
        <div class="footer-link-wrap footer-sign-up">
            <h1>Stay Connected</h1>
            <p class="show-for-desktop">Join thousands of singers who get free weekly vocal lessons.</p>
            <p class="hide-for-desktop">Receive free weekly lessons.</p>
            <form id="SingeoEngagementTriggerWebsiteSignupWebForm" accept-charset="UTF-8" action="/customer-io/submit-email-form" method="POST"
                    class="ajax-form clearfix facebook-track-lead lg:flex" onsubmit="emailSignUpConversionTrackerForImpactProvider()">
                <input type="hidden" name="form_name" value="Blog Signup">

                <input type="hidden" name="leadtracker_form_name" value="Singeo General">
                <div class="col-xs-12 form-group text-center medium-text-left lg:w-7/12 lg:pr-1">
                    <input class="medium-body" id="sign-up-email" name="email" type="email" placeholder="Email Address..." required="">
                </div>
                <div class="col-xs-12 form-group lg:w-5/12">
                    <button class="submit button-red join-form-button border-singeo text-singeo hover:bg-singeo hover:text-black" type="submit">
                        <span class="pre-add text-base"> Sign up <i class="fas fa-paper-plane text-sm ml-1"></i></span>
                        <span class="pending hide hidden">Sending <i class="fas fa-spinner-third fa-spin"></i></span>
                        <span class="success hide hidden">Sent <i class="fas fa-thumbs-up"></i></span>
                        <span class="fail hide hidden">Try Again <i class="fas fa-exclamation-triangle"></i></span>
                    </button>
                </div>
                <input name="inf_form_xid" type="hidden" value="SingeoEngagementTriggerWebsiteSignupWebForm">
                <input name="tag_names_to_add[]" type="hidden" value="Singeo - Engagement - Trigger - Website Signup - Web Form">
                <input name="list_ids_to_subscribe_to[]" type="hidden" value="33">
                <input name="success_redirect" type="hidden" value="/thank-you">
            </form>
            <div class="thank-you-box">
                <p><em>You should receive an email from team@singeo.com within 10 minutes.</em></p>
            </div>
            <a style="width: 48%;max-width:130px;
        display: inline-block;
        margin-right: 2%;
        margin-top: 10px;" href="https://apps.apple.com/us/app/musora-the-music-lessons-app/id1460388277" target="_blank">
                <img src="https://d21q7xesnoiieh.cloudfront.net/fit-in/250x0/filters:quality(95)/marketing/drumeo/membership/homepage/2023/download-on-app-store-button.png" alt="app store icon"></a>
            <a style="width: 48%;max-width:130px;
        display: inline-block;
        margin-top: 10px;" href="https://play.google.com/store/apps/details?id=com.drumeo" target="_blank">
                <img src="https://d21q7xesnoiieh.cloudfront.net/fit-in/250x0/filters:quality(95)/marketing/drumeo/membership/homepage/2023/google-play-button.png" alt="google play icon"></a>
        </div>
        <div class="footer-link-wrap">
            <h1>Resources</h1>
            <p><a href="/chorus/">The Singeo Chorus</a><br>
                <a href="/improve-any-voice">4 Vocal Exercises</a><br>
                <a href="/chorus/how-to-sing/">Your First Vocal Lesson</a><br>
                <a href="/chorus/7-days-to-a-beautiful-voice/">7 Days To A Beautiful Voice</a><br>
                <a href="/chorus/vocal-exercises-for-a-healthy-voice/">Your Daily Routine</a></p>
        </div>
        <div class="footer-link-wrap">
            <h1><a href="/shop/">Singeo SHOP</a></h1>
            <p><a href="/">Singeo Membership</a><br>
                <a href="/shop/singing-starter-kit">Singing Starter Kit</a><br>
                <a href="/shop/poster-vowels">Vowel Practice Poster</a><br>
                <a href="/shop/shirt-retro">Singeo T-Shirt</a><br>
                <a href="/shop/tumbler-doremi">Do-Re-Mi Tumbler</a></p>
        </div>
        <div class="footer-link-wrap">
            <h1>Other Sites</h1>
            <p><a rel="noopener" href="{{ get_musora_brand_base_url() }}">Musora</a><br>
                <a rel="noopener" href="{{ get_legacy_brand_base_url("drumeo") }}">Drumeo</a><br>
                <a rel="noopener" href="{{ get_legacy_brand_base_url("pianote") }}">Pianote</a><br>
                <a rel="noopener" href="{{ get_legacy_brand_base_url("guitareo") }}">Guitareo</a><br>
        </div>
    </div>
    @endif
    <div class="footer-bottom" @if(!empty($minimal)) style="border-top: 0;padding-top: 0;" @endif>
        <div class="container mx-auto">
            <img class="logo" src="https://www.musora.com/musora-cdn/image/width=280,quality=95/https://dmmior4id2ysr.cloudfront.net/logos/singeo-logo-white.png" alt="Singeo">
            @if(empty($minimal))
                <p><a href="https://goo.gl/maps/c4JxakSmnjB2" target="_blank">107-31265 Wheel Ave. Abbotsford,<br class="mobile-only"> BC, V2T 6H2 Canada</a><br>
                    <a href="tel:+18004398921">Toll Free: 1-800-439-8921</a> / <br class="mobile-only"><a href="tel:+16048557605">Direct: 1-604-855-7605</a> / <br class="mobile-only"><a href="{{ get_musora_brand_base_url() }}/contact">Contact Us</a></p>
                <a aria-label="Youtube" href="https://www.youtube.com/c/singeoofficial" target="_blank" class="inline-flex items-center justify-center social-media youtube"><i class="fab fa-youtube"></i></a>
                <a aria-label="Facebook" href="https://www.facebook.com/singeoofficial/" target="_blank" class="inline-flex items-center justify-center social-media facebook"><i class="fab fa-facebook-f"></i></a>
                <a aria-label="Instagram" href="https://www.instagram.com/singeoofficial/" target="_blank" class="inline-flex items-center justify-center social-media instagram"><i class="fab fa-instagram"></i></a>
                <a rel="noopener" href="https://pod.link/1657251884" target="_blank" class="inline-flex items-center justify-center social-media podcast" aria-label="podcast"><i class="fas fa-podcast"></i></a>
            @endif

            <p class="tiny">Musora Media, Inc. © {{ date('Y') }} - &nbsp; <a href="/terms">Terms</a>&nbsp;&nbsp;/&nbsp;&nbsp;<a href="/privacy">Privacy</a>&nbsp;&nbsp;/&nbsp;&nbsp;<a href="https://www.musora.com/careers">Careers</a>&nbsp;&nbsp;/&nbsp;&nbsp;<a href="https://www.musora.com/brand">Brand Guide</a></p>
        </div>
    </div>
</footer>
@include("singeo.lead-gen.partials.impact-email-sign-up-tracker")
@if(empty($noEverflow))
    @include("_partials.layout.everflow-product-tracker", ['advertiserId' => config('railanalytics.singeo.production.providers.everflow.brand_id')])
@endif
