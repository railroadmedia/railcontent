<div class="container max-w-7xl mx-auto flex flex-col md:flex-row items-center lg:min-h-850 lg:m-16 sm:p-9">
    <div class="lg:w-2/3  @if($textOnLeft) md:order-1 @endif text-center md:text-left lg:w-max mx-auto sm:p-9 p-3 align-center">
        <div class="container lg:w-1/2 lg:ml-10"> 
        <h5 class="text-sky-600 text-2xl font-normal uppercase leading-10 py-4">{{ $title }}</h5>
        <h3 class="text-black text-5xl sm: text-4xl font-extrabold leading-[3rem]s py-4">{{ $subtitle }}</h3>
        <p class="text-gray-950 text-xl sm:text-base  sm: leading-snug font-normal leading-loose py-4">{{ $description }}</p></div>
       
    </div>

    <div class="md:w-2/3 py-10 @unless($textOnLeft) md:order-1  @endif">
       <img
    class="w-full lg:w-640 lg:h-640 sm:w-350 sm:h-350 rounded-2xl transition-opacity"
    src="{{ $imageSrc }}"
    alt="{{ $altText }}"
    loading="lazy"
    onload="this.classList.remove('opacity-0')"
/>

    </div>
</div>