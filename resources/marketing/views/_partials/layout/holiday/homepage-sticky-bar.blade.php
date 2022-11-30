<a href="#customize-anchor" style="background: #000 url(https://drumeo-assets.s3.amazonaws.com/promos/christmas/snow-dark.gif) center center/250px;box-shadow: 0 0 10px inset #000;"
   class="anchor-slide promo-banner block text-center w-full transition-opacity duration-300 overflow-hidden whitespace-nowrap bg-cover bg-center shadow-md py-1 z-0 mx-auto -mt-10 text-xs">
    <div class="container mx-auto relative">
        <div class="inline-block align-middle text-center">
            @include($theme.'._partials.holiday-logo',[
                'styles' => 'inline-block align-middle mr-2 h-8'
            ])

            <p class="inline-block align-middle mx-auto font-bebas text-white text-sm leading-none sm:text-lg sm:leading-none text-left uppercase">
                {!! $text !!}
            </p>

            {{-- <div class="tzcd-smaller text-white align-middle inline-block">
                <div class="inline-block">
                    <h2 class="font-extrabold leading-none text-lg">00</h2>
                    <p class="leading-none uppercase font-extrabold text-xs text-promo">days</p>
                </div>
                <div class="inline-block mx-2">
                    <h2 class="font-extrabold leading-none text-lg">00</h2>
                    <p class="leading-none uppercase font-extrabold text-xs text-promo">hrs</p>
                </div>
                <div class="inline-block mr-2">
                    <h2 class="font-extrabold leading-none text-lg">00</h2>
                    <p class="leading-none uppercase font-extrabold text-xs text-promo">mins</p>
                </div>
                <div class="inline-block">
                    <h2 class="font-extrabold leading-none text-lg">00</h2>
                    <p class="leading-none uppercase font-extrabold text-xs text-promo">secs</p>
                </div>
            </div> --}}
        </div>
    </div>
</a>
