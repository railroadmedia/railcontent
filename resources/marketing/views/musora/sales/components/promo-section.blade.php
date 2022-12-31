<div style="background:linear-gradient(30deg, #0a3761, #0c1526);">
<section class="text-center text-white px-5 sm:px-6 py-10 sm:py-14 lg:py-20" style="background:url(https://drumeo-assets.s3.amazonaws.com/sales/2023/order-bg-tile-2.png) center center/160px;">
    <div class="container max-w-6xl mx-auto">
        <img class="hidden sm:inline-block h-9 lg:h-11" alt="promo logo" src="{{ $promoLogo }}">
        <img class="inline-block sm:hidden h-14" alt="mobile promo logo" src="{{ $promoLogoM }}">
        <h5 class="mt-4 mb-5 sm:mb-10">{!! $desc !!}</h5>
        <div class="text-left flex flex-wrap sm:flex-nowrap justify-center mb-5 sm:mb-11">
            <img class="h-56 mb-5 inline sm:hidden transition-opacity opacity-0"
                loading="lazy"
                onload="this.classList.remove('opacity-0')"
                src="https://cdn.musora.com/image/fetch/w_520,q_auto:best/{{ $img }}"
                alt="promo image"
            >
            <p class="leading-normal max-w-xl pr-7 mx-0">{!! $text !!}</p>
            <img class="h-72 lg:h-96 hidden sm:inline transition-opacity opacity-0"
                loading="lazy"
                onload="this.classList.remove('opacity-0')"
                src="https://cdn.musora.com/image/fetch/w_690,q_auto:best/{{ $img }}"
                alt="promo image"
            >
        </div>

        <a href="#customize-anchor" class="w-full sm:w-64 join promo smaller w-full max-w-sm @if(!empty($promoVersion)) anchor-slide @endif">GET STARTED &raquo;</a>
        <p class="text-promo mt-3 mb-24 sm:mb-44 lg:mb-72">{!! $belowButton !!}</p>
    </div>
</section>
</div>




