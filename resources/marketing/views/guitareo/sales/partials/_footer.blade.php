@include('_partials.components.cookie-modal')
<footer class="bottom-footer clearfix">
    @if(empty($minimal))
    <div class="container">
        <div class="footer-link-wrap footer-sign-up">
            <h1>Stay Connected</h1>
            <p class="show-for-desktop">Join thousands of guitarists who get free weekly guitar lessons.</p>
            <p class="hide-for-desktop">Receive free weekly lessons.</p>
            <form id="GuitareoEngagementTriggerWebsiteSignupWebForm" accept-charset="UTF-8" action="/customer-io/submit-email-form" method="POST"
                    class="ajax-form clearfix facebook-track-lead lg:flex" onsubmit="emailSignUpConversionTrackerForImpactProvider()">
                <input type="hidden" name="form_name" value="Blog Signup">

                <input type="hidden" name="leadtracker_form_name" value="Blog Signup">
                <div class="col-xs-12 form-group text-center medium-text-left lg:w-7/12 lg:pr-1">
                    <label for="sign-up-email" class="sr-only">Email Address</label>
                    <input class="medium-body" id="sign-up-email" name="email" type="email" placeholder="Email Address..." required="">
                </div>
                <div class="col-xs-12 form-group lg:w-5/12">
                    <button class="submit button-red join-form-button border-guitareo text-guitareo hover:bg-guitareo hover:text-black" type="submit">
                        <span class="pre-add"> Sign up <i class="fas fa-paper-plane"></i></span>
                        <span class="pending hide hidden">Sending <i class="fas fa-spinner-third fa-spin"></i></span>
                        <span class="success hide hidden">Sent <i class="fas fa-thumbs-up"></i></span>
                        <span class="fail hide hidden">Try Again <i class="fas fa-exclamation-triangle"></i></span>
                    </button>
                </div>
                <input name="inf_form_xid" type="hidden" value="GuitareoEngagementTriggerWebsiteSignupWebForm">
                <input name="tag_names_to_add[]" type="hidden" value="Guitareo - Engagement - Trigger - Website Signup - Web Form">
                <input name="list_ids_to_subscribe_to[]" type="hidden" value="32">
                <input name="success_redirect" type="hidden" value="/thank-you">
            </form>
            <div class="thank-you-box">
                <p><em>You should receive an email from team@guitareo.com within 10 minutes.</em></p>
            </div>
            <a style="width: 48%;max-width:130px;
        display: inline-block;
        margin-right: 2%;
        margin-top: 10px;" href="https://apps.apple.com/us/app/musora/id1619053766?ppid=e92a296a-7aeb-40ec-85eb-aaf891c3e6c1" target="_blank" aria-label="Download on App Store">
                <img src="https://d21q7xesnoiieh.cloudfront.net/fit-in/250x0/filters:quality(95)/marketing/drumeo/membership/homepage/2023/download-on-app-store-button.png" alt="app store icon"></a>
            <a style="width: 48%;max-width:130px;
        display: inline-block;
        margin-top: 10px;" href="https://play.google.com/store/apps/details?id=com.musoraapp&listing=guitareo_previews" target="_blank" aria-label="Download on Google Play">
                <img src="https://d21q7xesnoiieh.cloudfront.net/fit-in/250x0/filters:quality(95)/marketing/drumeo/membership/homepage/2023/google-play-button.png" alt="google play icon"></a>
        </div>
        <div class="footer-link-wrap">
            <h1>Resources</h1>
            <p>
                <a href="/riff/" aria-label="The Guitareo Riff">The Guitareo Riff</a><br>
                <a href="/free-acoustic-guitar-lessons" aria-label="Getting Started On Guitar">Getting Started On Guitar</a><br>
                <a href="/song-in-an-hour" aria-label="Song In An Hour Challenge">Song In An Hour Challenge</a><br>
                <a href="/riff/lessons" aria-label="Free Guitar Video Lessons">Free Guitar Video Lessons</a><br>
                <a href="/riff/articles/" aria-label="Free Guitar Articles">Free Guitar Articles</a>
            </p>
        </div>
        <div class="footer-link-wrap">
            <h1><a href="/shop/" aria-label="GUITAREO Shop">GUITAREO Shop</a></h1>
            <p>
                <a href="/" aria-label="Guitareo Membership">Guitareo Membership</a><br>
                <a href="/guitar-quest" aria-label="GuitarQuest">GuitarQuest</a><br>
                <a href="/shop/500-songs" aria-label="500 Songs In 5 Days">500 Songs In 5 Days</a><br>
                <a href="/shop/survival-guide" aria-label="Guitareo Survival Guide">Guitareo Survival Guide</a><br>
                <a href="/shop/acoustic-guitar-made-easy" aria-label="Acoustic Guitar Made Easy">Acoustic Guitar Made Easy</a>
            </p>
        </div>
        <div class="footer-link-wrap">
            <h1>Other Sites</h1>
            <p>
                <a rel="noopener" href="{{ get_musora_brand_base_url() }}" aria-label="Musora">Musora</a><br>
                <a rel="noopener" href="{{ get_legacy_brand_base_url("drumeo") }}" aria-label="Drumeo">Drumeo</a><br>
                <a rel="noopener" href="{{ get_legacy_brand_base_url("pianote") }}" aria-label="Pianote">Pianote</a><br>
                <a rel="noopener" href="{{ get_legacy_brand_base_url("singeo") }}" aria-label="Singeo">Singeo</a><br>
            </p>
        </div>
    </div>
    @endif
    <div class="footer-bottom" @if(!empty($minimal)) style="border-top: 0;padding-top: 0;" @endif>
        <div class="container mx-auto">
            <img class="logo" src="https://d122ay5chh2hr5.cloudfront.net/sales/guitareo-logo.png" alt="Guitareo">
            @if(empty($minimal))
            <p><a rel="noopener" href="https://goo.gl/maps/c4JxakSmnjB2" target="_blank">107-31265 Wheel Ave. Abbotsford,<br class="mobile-only"> BC, V2T 6H2 Canada</a><br>
                <a href="tel:+18004398921">Toll Free: 1-800-439-8921</a> / <br class="mobile-only"><a href="tel:+16048557605">Direct: 1-604-855-7605</a> / <br class="mobile-only"><a href="{{ get_musora_brand_base_url() }}/contact">Contact Us</a></p>
            <a aria-label="Youtube" rel="noopener" href="https://www.youtube.com/user/guitarlessonscom" target="_blank" class="inline-flex items-center justify-center social-media youtube"><i class="fab fa-youtube"></i></a>
            <a aria-label="Facebook" rel="noopener" href="https://www.facebook.com/guitareoofficial" target="_blank" class="inline-flex items-center justify-center social-media facebook"><i class="fab fa-facebook-f"></i></a>
            <a aria-label="Instagram" rel="noopener" href="https://www.instagram.com/guitareoofficial/" target="_blank" class="inline-flex items-center justify-center social-media instagram"><i class="fab fa-instagram"></i></a>
            <a rel="noopener" href="https://pod.link/1657251884" target="_blank" class="inline-flex items-center justify-center social-media podcast" aria-label="podcast"><i class="fas fa-podcast"></i></a>
            @endif
            <p class="tiny">Musora Media, Inc. &copy; {{ date('Y') }} - &nbsp; <a href="/terms/" aria-label="Terms of Service">Terms</a>&nbsp;&nbsp;/&nbsp;&nbsp;<a href="/privacy/" aria-label="Privacy Policy">Privacy</a>&nbsp;&nbsp;/&nbsp;&nbsp;<a rel="noopener" href="https://www.musora.com/careers" aria-label="Careers at Musora">Careers</a>&nbsp;&nbsp;/&nbsp;&nbsp;<a rel="noopener" href="https://www.musora.com/brand" aria-label="Musora Brand Guide">Brand Guide</a></p>
        </div>
    </div>
</footer>
