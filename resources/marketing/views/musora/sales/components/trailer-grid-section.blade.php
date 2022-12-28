<div class="h-5 sm:h-10 -mt-5 sm:-mt-10" style="background: linear-gradient(to bottom right, transparent calc(50% - 1px), transparent, #f4f8fb calc(50% + 1px));"></div>
<section class="text-center px-5 sm:px-6 py-10 sm:py-14 lg:py-20" style="background-color:#f4f8fb;">
    <div class="container max-w-6xl mx-auto">
        <div class="aspect-16:9 cursor-hover rounded-xl autoplay-video overflow-hidden w-full relative -mt-36 sm:-mt-64 lg:-mt-96 mb-6 sm:mb-20" x-on:click="trailer = true;">
            <i class="absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 fas fa-play play-button z-10"></i>
            <video class="rounded-xl overflow-hidden object-cover w-full h-full absolute z-0" src="{{ $vid }}" type="video/mp4" autoplay="" loop="" playsinline="" muted></video>
        </div>
        <h2><strong>{!! $header !!}</strong></h2>
        <p class="mt-2 sm:mt-3 mb-8 sm:mb-10">{!! $desc !!}</p>
        <div class="flex flex-wrap items-start justify-center text-left mb-2 sm:mb-6">
            @foreach ($gridItems as $key => $gridItem)
                <div class="flex flex-wrap items-start w-full sm:w-1/2 lg:w-1/3 pb-4 sm:pb-0 sm:px-3 mb-4 sm:mb-8 border-b sm:border-b-0">
                    <img
                        class="w-1/3 sm:w-full rounded-xl mb-3 transition-opacity opacity-0"
                        src="https://cdn.musora.com/image/fetch/w_640,q_auto:best/{{ $gridItem['image'] }}"
                        alt="grid{{$key+1}}"
                        loading="lazy"
                        onload="this.classList.remove('opacity-0')"
                    >
                    <p class="w-2/3 sm:w-full pl-3 sm:pl-0 leading-normal">
                        <strong class="font-black inline-block mb-0.5">{{ $gridItem['title'] }}</strong><br> {{ $gridItem['desc'] }}
                    </p>
                </div>
            @endforeach
        </div>
        @if(empty($promoVersion))
            <a href="/method" class="sm:mx-1 mb-2 sm:mb-0 w-full sm:w-64 join outline {{ $theme }}-blue smaller">EXPLORE THE METHOD <i class="fas fa-info-circle"></i> </a>
        @endif
        <a class="sm:mx-1 w-full sm:w-64 join {{ $theme }}-blue smaller"
            @if(!empty($promoVersion))
                href="/choose-plan"
            @else
                href="/choose-your-trial"
            @endif
        >
            @if(!empty($promoVersion))
                Get Started &raquo;
            @else
                START FOR FREE <i class="fas fa-arrow-right"></i>
            @endif
        </a>
    </div>
</section>
