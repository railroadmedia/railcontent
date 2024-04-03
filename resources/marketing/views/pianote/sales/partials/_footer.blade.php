@include('_partials.components.cookie-modal')
<footer id="footer" class="bottom-footer clearfix relative">
    @if(empty($minimal))
    <div class="container max-w-[75rem] mx-auto">
        <div class="footer-link-wrap footer-sign-up">
            <h1>Stay Connected</h1>
            <p class="show-for-desktop">Join over 400,000 piano players who get free lessons twice a week.</p>
            <p class="hide-for-desktop">Receive free weekly lessons.</p>
            <form id="PianoteEngagementTriggerWebsiteSignupWebForm" accept-charset="UTF-8" action="/customer-io/submit-email-form" method="POST"
                  class="ajax-form clearfix facebook-track-lead lg:flex" onsubmit="emailSignUpConversionTrackerForImpactProvider()">
                <input type="hidden" name="form_name" value="Blog Signup">

                <input type="hidden" name="leadtracker_form_name" value="Pianote General">
                <div class="col-xs-12 form-group text-center medium-text-left lg:w-7/12 lg:pr-1">
                    <input class="medium-body" id="sign-up-email" name="email" type="email" placeholder="Email Address..." required="">
                </div>
                <div class="col-xs-12 form-group lg:w-5/12">
                    <button class="submit button-red join-form-button border-pianote text-pianote hover:bg-pianote hover:text-black" type="submit">
                        <span class="pre-add"> Sign up <i class="fas fa-paper-plane"></i></span>
                        <span class="pending hide hidden">Sending <i class="fas fa-spinner-third fa-spin"></i></span>
                        <span class="success hide hidden">Sent <i class="fas fa-thumbs-up"></i></span>
                        <span class="fail hide hidden">Try Again <i class="fas fa-exclamation-triangle"></i></span>
                    </button>
                </div>
                <input name="inf_form_xid" type="hidden" value="PianoteEngagementTriggerWebsiteSignupWebForm">
                <input name="tag_names_to_add[]" type="hidden" value="Pianote - Engagement - Trigger - Website Signup - Web Form">
                <input name="list_ids_to_subscribe_to[]" type="hidden" value="33">
                <input name="success_redirect" type="hidden" value="/thank-you">
            </form>
            <div class="thank-you-box">
                <p><em>You should receive an email from team@pianote.com within 10 minutes.</em></p>
            </div>
            <a style="width: 48%;max-width:130px;
        display: inline-block;
        margin-right: 2%;
        margin-top: 10px;" href="https://apps.apple.com/us/app/musora/id1619053766?ppid=afddd5f6-fbc3-46c9-b6e4-6c9e6a6936af" target="_blank">
                <img src="https://d21q7xesnoiieh.cloudfront.net/fit-in/250x0/filters:quality(95)/marketing/drumeo/membership/homepage/2023/download-on-app-store-button.png" alt="app store icon"></a>
            <a style="width: 48%;max-width:130px;
        display: inline-block;
        margin-top: 10px;" href="https://play.google.com/store/apps/details?id=com.musoraapp&listing=pianote_previews" target="_blank">
                <img src="https://d21q7xesnoiieh.cloudfront.net/fit-in/250x0/filters:quality(95)/marketing/drumeo/membership/homepage/2023/google-play-button.png" alt="google play icon"></a>
        </div>
        <div class="footer-link-wrap">
            <h1>Resources</h1>
            <p><a href="{{ get_legacy_brand_base_url('pianote') }}/blog/">The Pianote Note</a><br>
                <a href="{{ get_legacy_brand_base_url('pianote') }}/chord-hacks">Chord Hacks</a><br>
                <a href="{{ get_legacy_brand_base_url('pianote') }}/getting-started">Getting Started On Piano</a><br>
                <a href="{{ get_legacy_brand_base_url('pianote') }}/piano-in-5-days">5 Days To Playing Piano</a><br>
                <a href="{{ get_legacy_brand_base_url('pianote') }}/learn-songs">Learn 3 Songs On Piano</a></p>
        </div>
        <div class="footer-link-wrap">
            <h1><a href="{{ get_legacy_brand_base_url('pianote') }}/shop/">PIANOTE SHOP</a></h1>
            <p><a href="{{ get_legacy_brand_base_url('pianote') }}/">Pianote Membership</a><br>
                <a href="{{ get_legacy_brand_base_url('pianote') }}/shop/500-songs">500 Songs In 5 Days</a><br>
                <a href="{{ get_legacy_brand_base_url('pianote') }}/shop/play-beautiful-piano">Playing Beautiful Piano</a><br>
                <a href="{{ get_legacy_brand_base_url('pianote') }}/shop/chords-scales-book">Chords & Scales Book</a><br>
                <a href="{{ get_legacy_brand_base_url('pianote') }}/shop/practice-planner">Practice Planner</a></p>
        </div>
        <div class="footer-link-wrap">
            <h1>Other Sites</h1>
            <p><a rel="noopener" href="{{ get_musora_brand_base_url() }}">Musora</a><br>
                <a rel="noopener" href="{{ get_legacy_brand_base_url("drumeo") }}">Drumeo</a><br>
                <a rel="noopener" href="{{ get_legacy_brand_base_url("guitareo") }}">Guitareo</a><br>
                <a rel="noopener" href="{{ get_legacy_brand_base_url("singeo") }}">Singeo</a><br>
        </div>
    </div>
    @endif
    <div class="footer-bottom" @if(!empty($minimal)) style="border-top: 0;padding-top: 0;" @endif>
        <div class="container mx-auto">
            <img class="logo" src="https://d21q7xesnoiieh.cloudfront.net/fit-in/250x0/filters:quality(95)/marketing/pianote/membership/homepage/2023/pianote-logo-white.png" alt="Pianote">
            @if(empty($minimal))
            <p><a rel="noopener" href="https://goo.gl/maps/c4JxakSmnjB2" target="_blank">107-31265 Wheel Ave. Abbotsford,<br class="mobile-only"> BC, V2T 6H2 Canada</a><br>
                <a href="tel:+18004398921">Toll Free: 1-800-439-8921</a> / <br class="mobile-only"><a href="tel:+16048557605">Direct: 1-604-855-7605</a> / <br class="mobile-only"><a href="{{ get_musora_brand_base_url() }}/contact">Contact Us</a></p>
            <a rel="noopener" href="https://youtube.com/user/pianolessonscom" target="_blank" class="social-media youtube" aria-label="youtube"><i class="fab fa-youtube"></i></a>
            <a rel="noopener" href="https://facebook.com/pianoteofficial" target="_blank" class="social-media facebook" aria-label="facebook"><i class="fab fa-facebook-f"></i></a>
            <a rel="noopener" href="https://instagram.com/pianoteofficial" target="_blank" class="social-media instagram" aria-label="instagram"><i class="fab fa-instagram"></i></a>
            <a rel="noopener" href="https://www.tiktok.com/@pianoteofficial" target="_blank" class="social-media tiktok" aria-label="tiktok"><i class="fab fa-tiktok"></i></a>
            <a rel="noopener" href="https://pod.link/1657251884" target="_blank" class="inline-flex items-center justify-center social-media podcast" aria-label="podcast"><i class="fas fa-podcast"></i></a>
            @endif
            <p class="tiny">Musora Media, Inc. &copy; {{ date('Y') }} - &nbsp; <a href="/terms">Terms</a>&nbsp;&nbsp;/&nbsp;&nbsp;<a href="/privacy">Privacy</a>&nbsp;&nbsp;/&nbsp;&nbsp;<a rel="noopener" href="https://www.musora.com/careers">Careers</a>&nbsp;&nbsp;/&nbsp;&nbsp;<a rel="noopener" href="https://www.musora.com/brand">Brand Guide</a></p>
        </div>
    </div>
</footer>
@include("pianote.lead-gen.impact-email-sign-up-tracker")
