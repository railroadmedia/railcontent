<section class="relative text-center py-7 md:py-12 px-4 md:px-0 overflow-hidden">
    <picture>
        <source media="(min-width: 640px)" srcset="https://www.musora.com/musora-cdn/image/width=2000,quality=85/{{ $bg }}">
        <img class="absolute w-full h-full left-0 top-0 object-cover object-center" src="https://www.musora.com/musora-cdn/image/width=500,quality=85/{{ $bg }}" alt="header background" fetchpriority="high">
    </picture>

    <div class="container mx-auto relative z-10">
        <div>
            <img class="sm:h-32 md:h-44 lg:h-48 -mt-10 sm:-mt-16 {{ $logoStyles }}" src="https://www.musora.com/musora-cdn/image/quality=100,width=250,metadata=none/{{ $logo }}" alt="drumeo summer sale logo" fetchpriority="high">
            <p class="uppercase text-white">GREAT DEALS ON LESSONS,<br class="sm:hidden"> ACCESSORIES AND MORE!</p>
            <p class="font-extrabold text-[#FFD600] mb-4 md:mb-6">{{ $promoText }}</p>
            <a href="{{ $theme === 'drumeo' ? '/drumshop' : '/shop' }}" class="join smaller text-black bg-[#FFD600] sm:max-w-xs sm:w-full">SHOP NOW <i class="fas fa-arrow-right" style="line-height: 0;" aria-hidden="true"></i></a>
        </div>
    </div>
</section>
