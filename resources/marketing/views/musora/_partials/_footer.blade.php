<div class="cookie-notice hide">
    <div class="text-wrap">
        <p>We use cookies for traffic data and advertising. <a href="/cookie">Cookie Policy &raquo;</a></p>
        <div class="text-center">
            <div id="accept-cookies">OKAY GOT IT</div>

        </div>
    </div>
</div>
<footer id="footer" class="bottom-footer clearfix relative sales-footer">
    <div class="footer-bottom" style="border-top: 0;padding-top: 0;">
        <div class="row">
            <img class="logo" src="https://www.musora.com/musora-cdn/image/quality=100,width=250,metadata=none/https://dmmior4id2ysr.cloudfront.net/homepage/2023/musora_logo.png" alt="Drumeo">
            @if(empty($minimal))
                <p><a href="https://goo.gl/maps/c4JxakSmnjB2" rel="noopener" target="_blank">107-31265 Wheel Ave. Abbotsford,<br class="mobile-only"> BC, V2T 6H2 Canada</a><br>
                    <a href="tel:+18004398921">Toll Free: 1-800-439-8921</a> / <br class="mobile-only"><a href="tel:+16048557605">Direct: 1-604-855-7605</a> / <br class="mobile-only"><a href="{{ get_musora_brand_base_url() }}/contact">Contact Us</a></p>

                <a rel="noopener" href="https://www.youtube.com/freedrumlessons/" target="_blank" class="inline-flex items-center justify-center social-media youtube" aria-label="youtube"><i class="fab fa-youtube"></i></a>
                <a rel="noopener" href="https://facebook.com/drumeo/" target="_blank" class="inline-flex items-center justify-center social-media facebook" aria-label="facebook"><i class="fab fa-facebook-f"></i></a>
                <a rel="noopener" href="https://instagram.com/drumeoofficial/" target="_blank" class="inline-flex items-center justify-center social-media instagram" aria-label="instagram"><i class="fab fa-instagram"></i></a>
                <a rel="noopener" href="https://www.tiktok.com/@drumeoofficial" target="_blank" class="inline-flex items-center justify-center social-media tiktok" aria-label="tiktok"><i class="fab fa-tiktok"></i></a>
                <a rel="noopener" href="https://pod.link/1657251884" target="_blank" class="inline-flex items-center justify-center social-media podcast" aria-label="podcast"><i class="fas fa-podcast"></i></a>
            @endif

            <p class="tiny">Musora Media, Inc. &copy; {{ date('Y') }} - &nbsp; <a href="/terms/">Terms</a>&nbsp;&nbsp;/&nbsp;&nbsp;<a href="/privacy/">Privacy</a>&nbsp;&nbsp;/&nbsp;&nbsp;<a rel="noopener" href="https://www.musora.com/careers">Careers</a>&nbsp;&nbsp;/&nbsp;&nbsp;<a rel="noopener" href="https://www.musora.com/brand">Brand Guide</a></p>
        </div>
    </div>
</footer>
@include("drumeo.lead-gen.partials.impact-email-sign-up-tracker")
