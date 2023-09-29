<div class="flex flex-col sm:flex-row items-center mb-12 sm:mb-16 max-w-3xl mx-auto">
    <div class="sm:w-1/2 @if(empty($textRight)) sm:order-1 sm:pl-5 lg:pl-10 @else sm:pr-5 lg:pr-10 @endif text-left mx-auto align-center mb-5 sm:mb-0">
        <p class="text-drumeo uppercase leading-tight">{{ $title }}</p>
        <h2 class="text-black font-extrabold leading-tight my-2 sm:my-4">{{ $subtitle }}</h2>
        <p class="">{{ $description }}</p>
    </div>

    <div class="@if(!empty($textRight)) sm:order-1 @endif flex-shrink-0">
        <img
            class="h-80 lg:h-96 rounded-xl transition-opacity opacity-0"
            src="{{ $imageSrc }}"
            alt="{{ $altText }}"
            loading="lazy"
            onload="this.classList.remove('opacity-0')"
        />
    </div>
</div>
