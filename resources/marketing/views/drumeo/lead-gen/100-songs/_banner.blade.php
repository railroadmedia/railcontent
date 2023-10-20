<div class="w-full pt-10 pb-80 sm:py-24 lg:py-32 px-6 sm:px-16 mb-12 sm:mb-16 relative max-w-4xl mx-auto">
    <div class="hidden sm:inline-block absolute inset-0 z-0 bg-cover bg-top bg-no-repeat" style="background-image:url(https://cdn.musora.com/image/fetch/w_2000,q_auto:best/{{ $desktopImageSrc }});"></div>
    <div class="inline-block sm:hidden absolute inset-0 z-0 bg-cover bg-top bg-no-repeat" style="background-image:url(https://cdn.musora.com/image/fetch/w_800,q_auto:best/{{ $mobileImageSrc }});"></div>
    <div class="flex flex-col lg:justify-center md:justify-center md:items-start lg:items-start w-full sm:w-1/2 max-w-md relative">
        <div class="text-white text-left align-center">
            <p class="text-drumeo uppercase leading-tight">{{ $title }}</p>
            <h2 class="font-extrabold font-black leading-tight my-3 lg:my-4">{{ $subtitle }}</h2>
            <p class="">{{ $description }}</p>
        </div>
    </div>
</div>
