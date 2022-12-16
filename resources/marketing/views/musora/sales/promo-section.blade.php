<section class="text-center text-white px-5 sm:px-6 py-10 sm:py-14 lg:py-20" style="background: #07233e url({{ $bgImage }}) center center/cover;">
    <div class="container max-w-5xl mx-auto">
        <img class="h-56 inline sm:hidden transition-opacity opacity-0"
            loading="lazy"
            onload="this.classList.remove('opacity-0')"
            src="https://cdn.musora.com/image/fetch/w_520,q_auto:best/{{ $img }}">
        <img class="hidden sm:inline-block h-11" alt="promo logo" src="{{ $promoLogo }}">
        <img class="inline-block sm:hidden h-11" alt="mobile promo logo" src="{{ $promoLogoM }}">
        <h5 class="mt-4 mb-5 sm:mb-10">{!! $desc !!}</h5>
        <div class="text-left flex flex-wrap sm:flex-nowrap mb-11">
            <p class="leading-normal max-w-lg pr-7">{!! $text !!}</p>
            <img class="h-72 lg:h-96 hidden sm:inline transition-opacity opacity-0"
                loading="lazy"
                onload="this.classList.remove('opacity-0')"
                src="https://cdn.musora.com/image/fetch/w_690,q_auto:best/{{ $img }}">
        </div>

        <a href="/pricing" class="join promo smaller w-full max-w-sm">GET STARTED</a>
        <p class="text-promo mt-3 mb-32 sm:mb-44 lg:mb-72">{!! $belowButton !!}</p>
    </div>
</section>




