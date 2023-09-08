<div class="container max-w-7xl mx-auto flex flex-col md:flex-row lg:min-h-850 lg:m-16">
    <div class="lg:w-2/3 @if($textOnLeft) md:order-1 @endif md:text-left lg:w-max mx-auto sm:pt-9 lg:align-center">
        <div class="container lg:w-1/2 lg:ml-10 sm:flex-col sm:justify-start sm:items-start sm:inline-flex">
            <h5 class="text-sky-600 lg:text-2xl sm:text-lg font-normal uppercase leading-10 py-4 m-0">{{ $title }}</h5>
            <h3 class="text-black lg:text-5xl md:text-4xl sm:text-3xl font-extrabold leading-[3rem] sm:text-2xl md:text-4xl m-0 header-custom-section">
                {{ $subtitle }}
            </h3>
            <p class="text-gray-950 text-xl font-normal py-4">{{ $description }}</p>
        </div>
    </div>

    <div class="md:w-2/3 py-10 @unless($textOnLeft) md:order-1 @endif">
        <img
            class="w-full lg:w-640 lg:h-640 sm:w-350 sm:h-350 rounded-2xl transition-opacity"
            src="{{ $imageSrc }}"
            alt="{{ $altText }}"
            loading="lazy"
            onload="this.classList.remove('opacity-0')"
        />
    </div>
</div>
