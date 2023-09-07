<div class="container max-w-7xl mx-auto relative flex lg:m-9">
    <img
        class="w-full md:w-1350 h-auto bg-slate-950 rounded-2xl transition-opacity opacity-0 block hidden md:block relative"
        src="{{ $desktopImageSrc }}"
        alt="{{ $altText }}"
        loading="lazy"
        onload="this.classList.remove('opacity-0')"
    />
   
    <!-- Full-width mobile image for smaller screens -->
    <img
        class="w-full h-645 bg-slate-950 rounded-2xl transition-opacity opacity-0 block md:hidden"
        src="{{ $mobileImageSrc }}"
        alt="{{ $altText }}"
        loading="lazy"
        onload="this.classList.remove('opacity-0')"
    />
    
<div class="absolute inset-0 flex flex-col sm:items-center lg:justify-center md:justify-center md:items-start lg:items-start lg:pl-20">
        <div class="md:w-1/2 @if($textOnLeft) md:order-1 @endif text-center md:text-left p-3 lg:pl-2 align-center relative z-10 sm:m-8">
            <h5 class="text-sky-600 text-2xl font-normal uppercase leading-10 py-4">{{ $title }}</h5>
            <h3 class="text-white text-5xl font-extrabold leading-[3rem] py-4">{{ $subtitle }}</h3>
            <p class="text-white text-xl font-normal leading-loose py-4">{{ $description }}</p>
        </div>
    </div>
</div>
