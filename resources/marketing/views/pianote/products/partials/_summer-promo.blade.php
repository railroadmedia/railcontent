<section class="py-12 sm:py-20 text-center text-white px-4 md:px-0" style="background: url('{{ $backgroundImageUrl }}') no-repeat center center; background-size: cover;">
    <img class="h-6 sm:h-8 md:h-12 mb-3" src="{{ $logoUrl }}" alt="Promo Logo" fetchpriority="high" />
    <h2 class="leading-tight mb-7 sm:mb-10"><strong>{{ $offerTitle }}</strong></h2>
{{--    @if(!empty($spotsAvailable))--}}
{{--        <h4 class="text-promo mb-4 sm:mb-8"><strong>ONLY</strong> <s class="opacity-60">100</s> <strong>{{ $spotsAvailable }}</strong> SPOTS AVAILABLE</h4>--}}
{{--    @endif--}}
    <img class="h-36 sm:h-72 md:h-80 lg:h-96" src="{{ $headerImageUrl }}" alt="bundle image" fetchpriority="high" />
    <br>
    <h3 class="text-white"> <s class="opacity-60">${{ $originalPrice }}</s> <strong>${{ $discountedPrice }}</strong> (Save {{ $discountPercentage }}%)</h3>
    <br>
    <a class="join bg-[#24CE7C] smaller w-full max-w-sm md:w-96 mb-2" href="{{ $ctaLink }}">
       get started &raquo;
    </a>
   <!-- <a class="join sold-out smaller w-full max-w-sm md:w-96 mb-2">
            SOLD OUT
        </a> -->
    <br>
</section>
