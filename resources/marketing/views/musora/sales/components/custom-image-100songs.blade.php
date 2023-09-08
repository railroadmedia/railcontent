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
            <div class="md:w-1/2 @if($textOnLeft) md:order-1 @endif text-center md:text-left p-6 lg:pl-2 align-center relative z-10 sm:m-8">
                <h5 class="text-sky-600 text-2xl font-normal uppercase leading-10 lg:py-4 sm:py-0 text-left">{{ $title }}</h5>
                <h3 class="text-white lg:text-5xl sm:text-2xl font-extrabold leading-[3rem] lg:text-left text-left lg:py-4">{{ $subtitle }}</h3>
                <p class="text-white lg:text-xl sm:text-lg font-normal lg:leading-loose text-left lg:py-4">{{ $description }}</p>
            </div>
        </div>



</div>
