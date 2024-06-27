<section class="py-20 text-center text-white px-4 md:px-0" style="background: url('{{ $backgroundImageUrl }}') no-repeat center center; background-size: cover;">        
    <img class="h-6 sm:h-8 md:h-12 mb-3" src="{{ $logoUrl }}" alt="Promo Logo" fetchpriority="high" />
    <h2 class="leading-tight"><strong>{{ $offerTitle }}</strong></h2>        
    <h4 class="text-promo py-4 md:py-8"><strong>ONLY</strong> {{ $spotsAvailable }} SPOTS AVAILABLE</h4> 

    <img class="md:h-96" src="{{ $headerImageUrl }}" alt="bundle image" fetchpriority="high" />
    <br>
    <h4 class="text-white"><strong>ONLY</strong> <s class="opacity-60">${{ $originalPrice }}</s> <strong>${{ $discountedPrice }}</strong> (Save {{ $discountPercentage }}%)</h4>
    <br>
    <a class="join bg-[#24CE7C] smaller w-full max-w-sm md:w-96 mb-2" href="{{ $ctaLink }}">  
       get started &raquo;
    </a>
   <!-- <a class="join sold-out smaller w-full max-w-sm md:w-96 mb-2">
            SOLD OUT
        </a> -->
    <br>
</section>