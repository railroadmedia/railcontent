<div class="w-full sm:w-8/12 md:w-full mx-auto">
    <div class="flex-1 relative overflow-hidden rounded-xl hover:group"
        x-data="{ flipped: false, showDetails: false }"
        x-on:click="
            flipped = !flipped;
            if(flipped){
                $refs.front.classList.add('rotate-y-180');
                $refs.back.classList.remove('-rotate-y-180');
                $refs.back.classList.add('rotate-y-0');
            }
            else {
                $refs.front.classList.remove('rotate-y-180');
                $refs.back.classList.add('-rotate-y-180');
                $refs.back.classList.remove('rotate-y-0');
            }
        "
        @mouseenter="showDetails = true"
        @mouseleave="showDetails = false"
    >
        @php
            $aspectRatio = ($imageCount == 2) ? 'aspect-[18/10]' : 'aspect-[4/3]';
        @endphp
        <div class="{{ $aspectRatio }} relative cursor-pointer" style="perspective: 1000px;">
            <div class="absolute inset-0" style="transform-style: preserve-3d;">
                <div x-ref="front"
                    class="absolute w-full h-full transition-transform duration-700"
                    style="backface-visibility: hidden;">
                    <div class="w-full h-full rounded-xl border-2 shadow-lg overflow-hidden {{ $borderColor }}">
                        <picture class="block w-full h-full"
                            :class="{'opacity-0': !lazyLoad, 'opacity-100': lazyLoad}"
                            x-intersect.once="lazyLoad = true">
                            <source srcset="https://d21q7xesnoiieh.cloudfront.net/fit-in/980x0/filters:quality(95)/{{ $image }}"
                                media="(min-width: 640px)">
                            <img src="https://d21q7xesnoiieh.cloudfront.net/fit-in/600x0/filters:quality(95)/{{ $image }}"
                                alt="{{ $alt }}"
                                class="w-full h-full object-cover transition-opacity duration-300"
                                :class="{'opacity-0': !lazyLoad, 'opacity-100': lazyLoad}"
                                loading="lazy">
                        </picture>
                    </div>
                    <div class="absolute z-40 text-center top-1/2 left-1/2 text-white transition-opacity duration-300 transform -translate-x-1/2 -translate-y-1/2"
                        :class="{ 'opacity-0': !showDetails, 'opacity-100': showDetails }"
                    >
                        <i class="fas fa-arrow-right text-4xl"></i><br>
                        <p class="text-sm"><strong>DETAILS</strong></p>
                    </div>
                </div>
                <div x-ref="back"
                    class="absolute w-full h-full transition-transform duration-700 -rotate-y-180 {{ $borderColor }}"
                    style="backface-visibility: hidden;">
                    <div class="w-full h-full mx-auto text-center text-white flex flex-wrap justify-center items-center content-center p-2 md:p-3 rounded-xl border-2"
                        style="background:linear-gradient(to bottom, #01050f, #021225);">
                        <p class="leading-normal mx-auto text-sm">
                            {!! $description !!}
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <p class="w-full leading-normal mt-2">
        <span style="display:inline-block;">
            <s class="opacity-60">{{ $price }}</s>
            <strong class="{{ $textColor }} ml-0.5">FREE</strong>
        </span>
    </p>
</div>