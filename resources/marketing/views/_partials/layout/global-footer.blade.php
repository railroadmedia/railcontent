<footer id="publicFooter" class="flex-none bg-black pt-10 pb-9 sales-footer">

    <!-- Footer Top -->
    @if( @isset($sections) )
        <div class="py-3 md:py-6 border-b border-zinc-700">
            <div class="container mx-auto px-4 flex justify-center flex-col md:flex-row">
                @foreach($sections as $section)
                    <div class="flex flex-col xs-12 text-gray-500 mb-6 md:mb-2 align-h-left px-7 text-center md:text-left">
                        <h5 class="text-gray-100 uppercase mb-2 text-lg font-bebas-neue">{{ $section['title'] }}</h5>
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

    <!-- Footer Bottom -->
    <div class="container mx-auto pt-7 px-4 flex flex-col items-center text-gray-500">
        <!-- Logo -->
        <img src="{{ $logo }}" class="w-36 mb-6 opacity-70" alt="Musora Logo">

        <p class="text-center">
            <a class="text-xs md:text-sm block leading-loose md:leading-normal" rel="noopener" href="https://goo.gl/maps/c4JxakSmnjB2" target="_blank">
                107-31265 Wheel Ave. Abbotsford,
                <span class="block md:inline leading-loose md:leading-normal">BC, V2T 6H2 Canada</span>
            </a>
            <a class="text-xs md:text-sm block md:inline leading-loose md:leading-normal" href="tel:+18004398921">Toll Free: 1-800-439-8921  / </a>
            <a class="text-xs md:text-sm block md:inline leading-loose md:leading-normal" href="tel:+16048557605">Direct: 1-604-855-7605 / </a>
            <a class="text-xs md:text-sm" href="{{ get_legacy_brand_base_url("musora") }}/contact">Contact Us</a>
        </p>
        {{-- <div class="flex items-center justify-center my-4">
            <a rel="noopener" href="https://www.youtube.com/user/guitarlessonscom" target="_blank" class="flex items-center justify-center mx-2 text-xl h-11 w-11 border-2 border-gray-500 rounded-full"><i class="fab fa-youtube" aria-hidden="true"></i></a>
            <a rel="noopener" href="https://www.facebook.com/guitareoofficial" target="_blank" class="flex items-center justify-center mx-2 text-xl h-11 w-11 border-2 border-gray-500 rounded-full"><i class="fab fa-facebook-f" aria-hidden="true"></i></a>
            <a rel="noopener" href="https://www.instagram.com/guitareoofficial/" target="_blank" class="flex items-center justify-center mx-2 text-xl h-11 w-11 border-2 border-gray-500 rounded-full"><i class="fab fa-instagram" aria-hidden="true"></i></a>
        </div> --}}
        <p class="text-xs md:text-sm">
            Musora Media, Inc. © 2022 - &nbsp;
            <a class="text-xs md:text-sm" href="/terms-of-service">Terms</a>&nbsp;&nbsp;/&nbsp;&nbsp;
            <a href="/privacy-policy" class="text-xs md:text-sm">Privacy</a>&nbsp;&nbsp;/&nbsp;&nbsp;
            <a rel="noopener" href="/careers" class="text-xs md:text-sm">Careers</a>&nbsp;&nbsp;/&nbsp;&nbsp;
            <a rel="noopener" href="https://www.musora.com/brand" class="text-xs md:text-sm">Brand Guide</a>
        </p>
    </div>

</footer>
