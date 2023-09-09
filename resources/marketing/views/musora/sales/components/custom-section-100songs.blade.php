
<div class="container max-w-7xl mx-auto pt-12">
    <div class="lg:flex md:flex lg:justify-between lg:px-16">
        <!-- Left Column -->
        <div class="md:flex md:justify-left md:items-center md:pl-4 lg:flex lg:justify-left lg:items-center lg:pl-4 @if($textOnLeft) md:order-1 @endif">
            <div class="lg:ml-10 md:ml-10 pr-5">
                <h5 class="text-sky-600 text-lg font-normal uppercase leading-10 m-0 lg:text-2xl">{{ $title }}</h5>
                <h3 class="text-black m-0 pb-4 text-4xl font-extrabold leading-10 font-extrabold md:text-4xl lg:text-5xl lg:py-5"> 
                    {{ $subtitle }}
                </h3>
                <p class="text-gray-950 text-base font-normal leading-snug lg:text-xl lg:leading-loose">{{ $description }}</p>
            </div>
        </div>

        <!-- Right Column -->
        <div class="pt-10 @unless($textOnLeft) md:order-1 @endif">
            <img
                class="h-auto max-w-full rounded-2xl transition-opacity"
                src="{{ $imageSrc }}"
                alt="{{ $altText }}"
                loading="lazy"
                onload="this.classList.remove('opacity-0')"
            />
        </div>
    </div>
</div>
