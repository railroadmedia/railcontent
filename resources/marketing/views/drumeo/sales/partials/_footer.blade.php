<div class="cookie-notice hide">
    <div class="text-wrap">
        <p>We use cookies to store information on your computer. Some of these cookies are essential, while others are used to help our efforts in improving your experience while using the site. By clicking "Accept All Cookies" you agree to the storing of cookies on your device.</p>
        <div class="text-center">
            <div id="accept-cookies">ACCEPT ALL COOKIES</div>
            <a href="/cookie">Cookie Policy</a>
        </div>
    </div>
</div>
<footer class="sales-footer">
    <div class="row">
        <div class="footer-link-wrap footer-sign-up">
            <h1>Stay Connected</h1>
            <p class="show-for-desktop">Join over 200,000 drummers who receive free weekly drum lessons.</p>
            <p class="hide-for-desktop">Receive free weekly lessons.</p>
            <form id="DrumeoEngagementTriggerBlogSignupWebForm" accept-charset="UTF-8" action="/laravel/public/customer-io/submit-email-form"
                  method="POST" class="ajax-form clearfix infusion-form facebook-track-lead" onsubmit="emailSignUpConversionTrackerForImpactProvider()">
                <input type="hidden" name="form_name" value="Blog Signup">
                <div class="columns medium-7">
                    <input id="sign-up-email" class="infusion-field-input-container" name="email" type="email" placeholder="Email Address..." required="">
                </div>
                <div class="infusion-submit columns medium-5">
                    <button class="submit infusion-recaptcha" type="submit">
                        <span class="pre-add"> Sign Up  <i class="fas fa-paper-plane"></i></span>
                        <span class="pending hide hidden">Sending <i class="fas fa-spinner-third fa-spin"></i></span>
                        <span class="success hide hidden">Sent <i class="fas fa-thumbs-up"></i></span>
                        <span class="fail hide hidden">Try Again <i class="fas fa-exclamation-triangle"></i></span>
                    </button>
                </div>
                <input name="inf_form_xid" type="hidden" value="DrumeoEngagementTriggerBlogSignupWebForm">
                <input name="tag_names_to_add[]" type="hidden" value="Drumeo - Engagement - Trigger - Blog Signup - Web Form">
                <input name="list_ids_to_subscribe_to[]" type="hidden" value="31">
                <input name="success_redirect" type="hidden" value="/thankyou">
            </form>
            <div class="thank-you-box">
                <p><em>You should receive an email from team@drumeo.com within 10 minutes.</em></p>
            </div>
        </div>
        <div class="footer-link-wrap">
            <h1>Resources</h1>
            <p><a href="/beat/">The Drumeo Beat</a><br>
                <a href="/beat/rudiments/">40 Drum Rudiments</a><br>
                <a href="/100-songs/">100 Free Drum Songs</a><br>
                <a href="/free-playalongs/">9 Free Play-Alongs</a><br>
            <a href="/beat/videos/">Video Drum Lessons</a></p>
        </div>
        <div class="footer-link-wrap">
            <h1><a href="/drumshop/">Drum Shop</a></h1>
            <p><a href="/">Drumeo Membership</a><br>
                <a href="/drumshop/practice-pad-full/">P4 Practice Pad</a><br>
                <a href="/drumshop/quietkick/">Drumeo QuietKick</a><br>
                <a href="/drumshop/beginner-book">Beginner Drum Book</a><br>
                <a href="/clothing/">Drumeo Merch</a></p>
        </div>
        <div class="footer-link-wrap">
            <h1>Other Sites</h1>
            <p><a rel="noopener" href="{{ get_musora_brand_base_url() }}">Musora</a><br>
                <a rel="noopener" href="{{ get_legacy_brand_base_url("pianote") }}">Pianote</a><br>
                <a rel="noopener" href="{{ get_legacy_brand_base_url("guitareo") }}">Guitareo</a><br>
            <a rel="noopener" href="{{ get_legacy_brand_base_url("singeo") }}">Singeo</a><br>
            <a rel="noopener" href="{{ get_musora_brand_base_url() }}">Recordeo</a></p>
        </div>
    </div>
    <div class="footer-bottom">
        <div class="row">
            <img class="logo" src="https://dpwjbsxqtam5n.cloudfront.net/logos/logo-white.png" alt="Drumeo">
            <p><a href="https://goo.gl/maps/c4JxakSmnjB2" rel="noopener" target="_blank">107-31265 Wheel Ave. Abbotsford,<br class="mobile-only"> BC, V2T 6H2 Canada</a><br>
                <a href="tel:+18004398921">Toll Free: 1-800-439-8921</a> / <br class="mobile-only"><a href="tel:+16048557605">Direct: 1-604-855-7605</a> / <br class="mobile-only"><a class="text-white" href="{{ get_musora_brand_base_url() }}/contact">Contact Us</a></p>
            <a rel="noopener" href="https://www.youtube.com/freedrumlessons/" target="_blank" class="social-media youtube" aria-label="youtube"><i class="fab fa-youtube"></i></a>
            <a rel="noopener" href="https://facebook.com/drumeo/" target="_blank" class="social-media facebook" aria-label="facebook"><i class="fab fa-facebook-f"></i></a>
            <a rel="noopener" href="https://instagram.com/drumeoofficial/" target="_blank" class="social-media instagram" aria-label="instagram"><i class="fab fa-instagram"></i></a>
            <a rel="noopener" href="https://www.tiktok.com/@drumeoofficial" target="_blank" class="social-media tiktok" aria-label="tiktok"><i class="fab fa-tiktok"></i></a>
            <p class="tiny">Musora Media, Inc. &copy; {{ date('Y') }} - &nbsp; <a href="/terms/">Terms</a>&nbsp;&nbsp;/&nbsp;&nbsp;<a href="/privacy/">Privacy</a>&nbsp;&nbsp;/&nbsp;&nbsp;<a rel="noopener" href="https://www.musora.com/jobs">Careers</a>&nbsp;&nbsp;/&nbsp;&nbsp;<a rel="noopener" href="https://www.musora.com/brand">Brand Guide</a></p>
        </div>
    </div>
</footer>
@include("drumeo.lead-gen.partials.impact-email-sign-up-tracker")
