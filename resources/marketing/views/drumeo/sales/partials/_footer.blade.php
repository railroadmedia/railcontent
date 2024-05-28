@include('_partials.components.cookie-modal')
<footer id="footer" class="bottom-footer clearfix relative sales-footer">
    @if(empty($minimal))
        <div class="row">
            <div class="footer-link-wrap footer-sign-up">
                <h1>Stay Connected</h1>
                <p class="show-for-desktop">Join over 400,000 drummers who receive free weekly drum lessons.</p>
                <p class="hide-for-desktop">Receive free weekly lessons.</p>
                <form id="DrumeoEngagementTriggerBlogSignupWebForm" accept-charset="UTF-8" action="/customer-io/submit-email-form" method="POST"
                    class="ajax-form clearfix facebook-track-lead lg:flex" onsubmit="emailSignUpConversionTrackerForImpactProvider()">
                    <input type="hidden" name="form_name" value="Blog Signup">

                    <input type="hidden" name="leadtracker_form_name" value="Blog Signup">
                    <div class="col-xs-12 form-group text-center medium-text-left lg:w-7/12 lg:pr-1">
                        <input class="medium-body" id="sign-up-email" name="email" type="email" placeholder="Email Address..." required="">
                    </div>
                    <div class="col-xs-12 form-group lg:w-5/12">
                        <button class="submit join-form-button" type="submit">
                            <span class="pre-add"> Sign up <i class="fas fa-paper-plane"></i></span>
                            <span class="pending hide hidden">Sending <i class="fas fa-spinner-third fa-spin"></i></span>
                            <span class="success hide hidden">Sent <i class="fas fa-thumbs-up"></i></span>
                            <span class="fail hide hidden">Try Again <i class="fas fa-exclamation-triangle"></i></span>
                        </button>
                    </div>
                    <input name="inf_form_xid" type="hidden" value="DrumeoEngagementTriggerBlogSignupWebForm">
                    <input name="success_redirect" type="hidden" value="/thank-you">
                </form>
                <div class="thank-you-box">
                    <p><em>You should receive an email from team@drumeo.com within 10 minutes.</em></p>
                </div>

                <a style="width: 48%;max-width:130px;
                            display: inline-block;
                            margin-right: 2%;
                            margin-top: 10px;"
                            href="https://apps.apple.com/us/app/musora-the-music-lessons-app/id1460388277"
                            target="_blank"
                            aria-label="Download on App Store">
                    <img src="https://d21q7xesnoiieh.cloudfront.net/fit-in/250x0/filters:quality(95)/marketing/drumeo/membership/homepage/2023/download-on-app-store-button.png" alt="App Store Icon">
                </a>
                <a style="width: 48%;
                        max-width:130px;
                        display: inline-block;
                        margin-top: 10px;"
                        href="https://play.google.com/store/apps/details?id=com.drumeo"
                        target="_blank"
                        aria-label="Download on Google Play" >
                    <img src="https://d21q7xesnoiieh.cloudfront.net/fit-in/250x0/filters:quality(95)/marketing/drumeo/membership/homepage/2023/google-play-button.png" alt="Google Play Icon">
                </a>
            </div>
            <div class="footer-link-wrap">
                <h1>Resources</h1>
                <p>
                    <a href="{{ get_legacy_brand_base_url('drumeo') }}/beat/" aria-label="The Drumeo Beat">The Drumeo Beat</a><br>
                    <a href="{{ get_legacy_brand_base_url('drumeo') }}/beat/rudiments/" aria-label="40 Drum Rudiments">40 Drum Rudiments</a><br>
                    <a href="{{ get_legacy_brand_base_url('drumeo') }}/100-songs/" aria-label="100 Free Drum Songs">100 Free Drum Songs</a><br>
                    <a href="{{ get_legacy_brand_base_url('drumeo') }}/free-playalongs/" aria-label="9 Free Play-Alongs">9 Free Play-Alongs</a><br>
                    <a href="{{ get_legacy_brand_base_url('drumeo') }}/beat/videos/" aria-label="Video Drum Lessons">Video Drum Lessons</a>
                </p>
            </div>
            <div class="footer-link-wrap">
                <h1><a href="{{ get_legacy_brand_base_url('drumeo') }}/drumshop/" aria-label="Drum Shop">Drum Shop</a></h1>
                <p>
                    <a href="{{ get_legacy_brand_base_url('drumeo') }}/" aria-label="Drumeo Membership">Drumeo Membership</a><br>
                    <a href="{{ get_legacy_brand_base_url('drumeo') }}/drumshop/practice-pad-full/" aria-label="P4 Practice Pad">P4 Practice Pad</a><br>
                    <a href="{{ get_legacy_brand_base_url('drumeo') }}/drumshop/quietkick/" aria-label="Drumeo QuietKick">Drumeo QuietKick</a><br>
                    <a href="{{ get_legacy_brand_base_url('drumeo') }}/drumshop/beginner-book" aria-label="Beginner Drum Book">Beginner Drum Book</a><br>
                    <a href="{{ get_legacy_brand_base_url('drumeo') }}/clothing/" aria-label="Drumeo Merch">Drumeo Merch</a>
                </p>
            </div>
            <div class="footer-link-wrap">
                <h1>Other Sites</h1>
                <p>
                    <a rel="noopener" href="{{ get_musora_brand_base_url() }}" aria-label="Musora">Musora</a><br>
                    <a rel="noopener" href="{{ get_legacy_brand_base_url('pianote') }}" aria-label="Pianote">Pianote</a><br>
                    <a rel="noopener" href="{{ get_legacy_brand_base_url('guitareo') }}" aria-label="Guitareo">Guitareo</a><br>
                    <a rel="noopener" href="{{ get_legacy_brand_base_url('singeo') }}" aria-label="Singeo">Singeo</a><br>
                </p>
            </div>
        </div>
    @endif
    <div class="footer-bottom" @if(!empty($minimal)) style="border-top: 0;padding-top: 0;" @endif>
        <div class="row">
            <img class="logo" src="https://d21q7xesnoiieh.cloudfront.net/fit-in/250x0/filters:quality(95)/marketing/drumeo/membership/homepage/2023/logo-white.png" alt="Drumeo Logo">
            @if(empty($minimal))
                <p><a href="https://goo.gl/maps/c4JxakSmnjB2" rel="noopener" target="_blank">107-31265 Wheel Ave. Abbotsford,<br class="mobile-only"> BC, V2T 6H2 Canada</a><br>
                <a href="tel:+18004398921">Toll Free: 1-800-439-8921</a> / <br class="mobile-only"><a href="tel:+16048557605">Direct: 1-604-855-7605</a> / <br class="mobile-only"><a href="{{ get_musora_brand_base_url() }}/contact">Contact Us</a></p>

                <a rel="noopener" href="https://www.youtube.com/freedrumlessons/" target="_blank" class="inline-flex items-center justify-center social-media youtube" aria-label="youtube"><i class="fab fa-youtube"></i></a>
                <a rel="noopener" href="https://facebook.com/drumeo/" target="_blank" class="inline-flex items-center justify-center social-media facebook" aria-label="facebook"><i class="fab fa-facebook-f"></i></a>
                <a rel="noopener" href="https://instagram.com/drumeoofficial/" target="_blank" class="inline-flex items-center justify-center social-media instagram" aria-label="instagram"><i class="fab fa-instagram"></i></a>
                <a rel="noopener" href="https://www.tiktok.com/@drumeoofficial" target="_blank" class="inline-flex items-center justify-center social-media tiktok" aria-label="tiktok"><i class="fab fa-tiktok"></i></a>
                <a rel="noopener" href="https://pod.link/1657251884" target="_blank" class="inline-flex items-center justify-center social-media podcast" aria-label="podcast"><i class="fas fa-podcast"></i></a>
            @endif

            <p class="tiny">Musora Media, Inc. &copy; {{ date('Y') }} - &nbsp; <a href="/terms/" aria-label="Terms of Service">Terms</a>&nbsp;&nbsp;/&nbsp;&nbsp;<a href="/privacy/" aria-label="Privacy Policy">Privacy</a>&nbsp;&nbsp;/&nbsp;&nbsp;<a rel="noopener" href="https://www.musora.com/careers" aria-label="Careers at Musora">Careers</a>&nbsp;&nbsp;/&nbsp;&nbsp;<a rel="noopener" href="https://www.musora.com/brand" aria-label="Musora Brand Guide">Brand Guide</a></p>
        </div>
    </div>
</footer>
@include("drumeo.lead-gen.partials.impact-email-sign-up-tracker")
