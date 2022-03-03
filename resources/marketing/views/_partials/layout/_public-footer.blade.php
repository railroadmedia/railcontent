<footer id="publicFooter" class="container fluid collapsed-h shadow">
    @if(empty($minimal))
        <div class="container fluid bg-grey-6 pv-3">
            <div class="container upper-footer">
                <div class="flex flex-row flex-wrap">
                    <div class="flex flex-column xs-12 sm-4 tiny text-dark mb-2">
                        <img class="dark-logo mb-1"
                             src="{{ cdn('logos/logo-dark.png') }}">

                        <p>107-31265 Wheel Ave</p>
                        <p>Abbotsford BC, V2T 6H2 Canada</p>
                        <p>Toll Free: 1-800-439-8921</p>
                        <p>Direct: 1-604-855-7605</p>
                        <p><a class="text-white" href="/support">contact us</a></p>
                    </div>
                    <div class="flex flex-column xs-12 sm-8">
                        <div class="flex flex-row flex-wrap">
                            <div class="flex flex-column xs-12 sm-4 tiny text-dark mb-2 align-h-left">
                                <h5 class="title dense uppercase mb-1">Resources</h5>

                                <a href="/beat/" class="no-decoration text-dark">Drumeo Beat</a>
                                <a href="/beat/podcasts/" class="no-decoration text-dark">Drumeo Podcast</a>
                                <a href="/beat/rudiments/" class="no-decoration text-dark">40 Drum Rudiments</a>
                                <a href="/beat/how-to-play-drums/" class="no-decoration text-dark">How To Play Drums</a>
                            </div>
                            <div class="flex flex-column xs-12 sm-4 tiny text-dark mb-2 align-h-left">
                                <h5 class="title dense uppercase mb-1">Drum Shop</h5>

                                <a href="/" class="no-decoration text-dark">Drumeo</a>
                                <a href="/drumshop/practice-pad-full/" class="no-decoration text-dark">P4 Practice Pad</a>
                                <a href="/drumshop/successful-drumming/" class="no-decoration text-dark">Successful Drumming</a>
                                <a href="/drumshop/drumming-system/" class="no-decoration text-dark">Drumming System</a>
                            </div>
                            <div class="flex flex-column xs-12 sm-4 tiny text-dark mb-2 align-h-left">
                                <h5 class="title dense uppercase mb-1">Other Sites</h5>

                                <a href="https://www.musora.com" class="no-decoration text-dark">Musora</a>
                                <a href="https://www.guitareo.com" class="no-decoration text-dark">Guitareo</a>
                                <a href="https://www.pianote.com" class="no-decoration text-dark">Pianote</a>
                                <a href="https://www.recordeo.com" class="no-decoration text-dark">Recordeo</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif
    <div class="container fluid bg-black pv-1">
        <div class="container">
            <div class="flex flex-row flex-wrap align-h-center">
                <section class="flex flex-column footer-col">
                    <div class="flex flex-row tiny align-center text-dark">
                        Musora Media Inc &copy; {{ date('Y') }} -
                        <a href="/terms/" target="_blank" class="text-dark">Terms</a> /
                        <a href="/privacy/" target="_blank" class="text-dark">Privacy</a>
                    </div>
                </section>

                <div class="flex flex-column spacer ph hide-xs-only"></div>

                <section class="flex flex-column footer-col">
                    <div class="flex flex-row tiny align-center">
                        <a href="https://www.youtube.com/freedrumlessons/" class="text-dark social-media-link no-decoration rounded bg-grey-6"><i class="fab fa-facebook-f"></i></a>
                        <a href="https://facebook.com/drumeo/" class="text-dark social-media-link no-decoration rounded bg-grey-6"><i class="fab fa-youtube"></i></a>
                        <a href="https://instagram.com/drumeoofficial/" class="text-dark social-media-link no-decoration rounded bg-grey-6"><i class="fab fa-instagram"></i></a>
                    </div>
                </section>
            </div>
        </div>
    </div>
</footer>