<img class="h-28 sm:h-40 lg:h-52 block mx-auto -mt-24 sm:-mt-36 lg:-mt-48 transition-all opacity-0"
    src="{{$logo}}" alt="guarantee badge" loading="lazy" onload="this.classList.remove('opacity-0')">
@if(!empty($imageUrl))
    <div class="flex flex-col md:flex-row text-left">
        <div class="md:w-2/3 md:pr-4">
            <h3 class="my-4 sm:my-6 lg:my-8 text-center md:text-left">{!! $guaranteeHeader !!}</h3>
            <img class="block md:hidden h-64 mx-auto mb-4" src="{{ $imageUrl }}">
            <p class="leading-normal">{!! $guaranteeText !!}</p>
        </div>
        <div class="w-1/3 hidden md:flex justify-center items-center">
            <img
                src="{{$imageUrl}}"
                alt="The 90-Day Better Technique collage"
                loading="lazy"
                onload="this.classList.remove('opacity-0')">
        </div>
    </div>
@endif
