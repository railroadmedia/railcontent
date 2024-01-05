<footer id="publicFooter" class="flex-none bg-[#111729] pt-10 pb-9 sales-footer bottom-footer z-40">

    {{-- Footer Top --}}
    @if( @isset($sections) )
        <div class="py-3 md:py-6 border-b border-zinc-700">
            <div class="container mx-auto px-4 flex justify-center flex-col md:flex-row">

                {{-- If Stay Conected Section --}}
                <div class="flex flex-col xs-12 text-gray-500 mb-6 md:mb-2 align-h-left px-7 text-center md:text-left">
                    <h5 class="text-gray-100 uppercase mb-2 text-lg font-bebas-neue mx-0">
                        Stay Connected
                    </h5>
                    <p class="show-for-desktop">Join over 200,000 drummers who receive free weekly drum lessons.</p>
                    <p class="hide-for-desktop">Receive free weekly lessons.</p>
                    <form id="DrumeoEngagementTriggerBlogSignupWebForm" accept-charset="UTF-8" action="/laravel/public/customer-io/submit-email-form" method="POST" class="ajax-form clearfix infusion-form facebook-track-lead" onsubmit="emailSignUpConversionTrackerForImpactProvider()">
                        <input type="hidden" name="form_name" value="Blog Signup">
                        <div class="columns medium-7">
                            <input id="sign-up-email" class="infusion-field-input-container" name="email" type="email" placeholder="Email Address..." required="">
                        </div>
                        <div class="infusion-submit columns medium-5">
                            <button class="submit infusion-recaptcha" type="submit">
                                <span class="pre-add"> Sign Up  <i class="fas fa-paper-plane" aria-hidden="true"></i></span>
                                <span class="pending hide hidden">Sending <i class="fas fa-spinner-third fa-spin" aria-hidden="true"></i></span>
                                <span class="success hide hidden">Sent <i class="fas fa-thumbs-up" aria-hidden="true"></i></span>
                                <span class="fail hide hidden">Try Again <i class="fas fa-exclamation-triangle" aria-hidden="true"></i></span>
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
                    <div class="flex">
                        {{-- App Store Link --}}
                        <a style="width: 48%;max-width:130px; display: inline-block; margin-right: 2%; margin-top: 10px;" href="https://itunes.apple.com/us/app/musora/id1619053766?ls=1" target="_blank">
                            <img src="https://d21q7xesnoiieh.cloudfront.net/fit-in/400x0/filters:quality(95)/marketing/drumeo/membership/homepage/2023/download-on-app-store-button.png">
                        </a>
                        {{-- Google Play Store Link--}}
                        <a style="width: 48%;max-width:130px; display: inline-block; margin-top: 10px;" href="https://play.google.com/store/apps/details?id=com.musoraapp" target="_blank">
                            <img src="https://d21q7xesnoiieh.cloudfront.net/fit-in/400x0/filters:quality(95)/marketing/drumeo/membership/homepage/2023/google-play-button.png">
                        </a>
                    </div>
                </div>
                {{-- endif --}}

                @foreach($sections as $section)
                    <div class="flex flex-col xs-12 text-gray-500 mb-6 md:mb-2 align-h-left px-7 text-center md:text-left">
                        <h5 class="text-gray-100 uppercase mb-2 text-lg font-bebas-neue mx-0">{{ $section['title'] }}</h5>
                        @if( @isset($section['links']) )
                            <ul class="text-sm">
                                @foreach($section['links'] as $link)
                                    <li class="mb-1">
                                        <a class="text-sm" href="{{ $link['url'] }}" class="no-decoration text-gray-500">
                                            {{ $link['name'] }}
                                        </a>
                                    </li>
                                @endforeach
                            </ul>
                        @endif
                    </div>
                @endforeach
            </div>
        </div>
    @endif

    {{-- Footer Bottom --}}
    <div class="container mx-auto pt-7 px-4 flex flex-col items-center text-gray-500">
        {{-- Logo --}}
        <img src="{{ $logo }}" class="w-36 mb-6 opacity-70" alt="Musora Logo">

        <p class="text-center">
            <a class="text-xs md:text-sm block leading-loose md:leading-normal" rel="noopener" href="https://goo.gl/maps/c4JxakSmnjB2" target="_blank">
                107-31265 Wheel Ave. Abbotsford,
                <span class="block md:inline leading-loose md:leading-normal">BC, V2T 6H2 Canada</span>
            </a>
            <a class="text-xs md:text-sm block md:inline leading-loose md:leading-normal" href="tel:+18004398921">Toll Free: 1-800-439-8921  / </a>
            <a class="text-xs md:text-sm block md:inline leading-loose md:leading-normal" href="tel:+16048557605">Direct: 1-604-855-7605 / </a>
            <a class="text-xs md:text-sm" href="{{ get_musora_brand_base_url() }}/contact">Contact Us</a>
        </p>
        {{-- <div class="flex items-center justify-center my-4">
            <a rel="noopener" href="https://www.youtube.com/user/guitarlessonscom" target="_blank" class="flex items-center justify-center mx-2 text-xl h-11 w-11 border-2 border-gray-500 rounded-full"><i class="fab fa-youtube" aria-hidden="true"></i></a>
            <a rel="noopener" href="https://www.facebook.com/guitareoofficial" target="_blank" class="flex items-center justify-center mx-2 text-xl h-11 w-11 border-2 border-gray-500 rounded-full"><i class="fab fa-facebook-f" aria-hidden="true"></i></a>
            <a rel="noopener" href="https://www.instagram.com/guitareoofficial/" target="_blank" class="flex items-center justify-center mx-2 text-xl h-11 w-11 border-2 border-gray-500 rounded-full"><i class="fab fa-instagram" aria-hidden="true"></i></a>
        </div> --}}
        <p class="text-xs md:text-sm">
            Musora Media, Inc. © {{ date('Y') }} - &nbsp;
            <a class="text-xs md:text-sm" href="/terms">Terms</a>&nbsp;&nbsp;/&nbsp;&nbsp;
            <a href="/privacy" class="text-xs md:text-sm">Privacy</a>&nbsp;&nbsp;/&nbsp;&nbsp;
            <a rel="noopener" href="/careers" class="text-xs md:text-sm">Careers</a>&nbsp;&nbsp;/&nbsp;&nbsp;
            <a rel="noopener" href="https://www.musora.com/brand" class="text-xs md:text-sm">Brand Guide</a>
        </p>
    </div>

</footer>
