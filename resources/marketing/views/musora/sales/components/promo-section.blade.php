@if(!empty($countdown))
    <div class="block h-10 w-full"></div>
<a href="#customize-anchor" style="background: #000;"
    class="anchor-slide promo-banner block text-center w-full transition-opacity duration-300 overflow-hidden whitespace-nowrap bg-cover bg-center shadow-md py-1 mx-auto text-xs -mt-10">
    <div class="container mx-auto relative">
        <div class="inline-block align-middle text-center">
            <p class="inline-block align-middle mx-auto font-bebas text-white text-sm leading-none sm:text-lg sm:leading-none text-left uppercase mr-2">
                {!! $countdown !!}
            </p>

            <div class="tzcd-smaller text-white align-middle inline-block">
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
            </div>
        </div>
    </div>
</a>
    <div class="sticky-trigger block"></div>
@endif
<div style="background:linear-gradient(30deg, #0a3761, #0c1526);">
<section class="text-center text-white px-5 sm:px-6 py-10 sm:py-14 lg:py-20" style="background:url('https://d21q7xesnoiieh.cloudfront.net/fit-in/600x0/marketing/musora/membership/homepage/2023/order-bg-tile-2.png') center center/160px;">
    <div class="container max-w-6xl mx-auto">
        <img class="hidden sm:inline-block h-9 lg:h-11" alt="promo logo" src="{{ $promoLogo }}">
        <img class="inline-block sm:hidden h-14" alt="mobile promo logo" src="{{ $promoLogoM }}">
        <h5 class="mt-4 mb-5 sm:mb-10">{!! $desc !!}</h5>
        <div class="text-left flex flex-wrap sm:flex-nowrap justify-center mb-5 sm:mb-11">
            <img class="h-56 mb-5 inline sm:hidden transition-opacity opacity-0"
                loading="lazy"
                onload="this.classList.remove('opacity-0')"
                src="https://www.musora.com/musora-cdn/image/width=520,quality=95/{{ $img }}"
                alt="promo image"
            >
            <p class="leading-normal max-w-xl pr-7 mx-0">{!! $text !!}</p>
            <img class="h-72 lg:h-96 hidden sm:inline transition-opacity opacity-0"
                loading="lazy"
                onload="this.classList.remove('opacity-0')"
                src="https://www.musora.com/musora-cdn/image/width=690,quality=95/{{ $img }}"
                alt="promo image"
            >
        </div>

        <a href="#customize-anchor" class="w-full sm:w-64 join promo smaller w-full max-w-sm @if(!empty($promoVersion)) anchor-slide @endif">SEE YOUR DEAL &raquo;</a>
        <p class="text-promo mt-3 mb-24 sm:mb-44 lg:mb-72">{!! $belowButton !!}</p>
    </div>
</section>
</div>




