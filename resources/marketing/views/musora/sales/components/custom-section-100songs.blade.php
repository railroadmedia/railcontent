<div class="container max-w-5xl mx-auto flex flex-col md:flex-row items-center">
    <div class="md:w-1/2 @if($textOnLeft) md:order-1 @endif text-center md:text-left lg:w-max mx-auto p-3 align-center">
        <h5 class="text-sky-600 text-2xl font-normal uppercase leading-10 py-4">{{ $title }}</h5>
        <h3 class="text-black text-5xl font-extrabold leading-10 py-4">{{ $subtitle }}</h3>
        <p class="text-gray-950 text-xl font-normal leading-loose py-4">{{ $description }}</p>
    </div>

    <div class="md:w-1/2 @unless($textOnLeft) md:order-1 @endif py-20">
        <img
            class=" w-96 h-96 rounded-2xl transition-opacity opacity-0"
            src="{{ $imageSrc }}"
            alt="{{ $altText }}"
            loading="lazy"
            onload="this.classList.remove('opacity-0')"
        />
    </div>
</div>