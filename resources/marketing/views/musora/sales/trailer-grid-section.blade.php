<div class="h-5 sm:h-10 -mt-5 sm:-mt-10" style="background: linear-gradient(to bottom right, transparent calc(50% - 1px), transparent, #f4f8fb calc(50% + 1px));"></div>
<section class="text-center px-5 sm:px-6 py-10 sm:py-14 lg:py-20" style="background-color:#f4f8fb;">
    <div class="container max-w-5xl mx-auto">
        <div class="aspect-16:9 cursor-hover rounded-xl autoplay-video overflow-hidden w-full relative -mt-36 sm:-mt-64 lg:-mt-96 mb-20" data-open="trailer">
            <i class="absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 fas fa-play play-button z-10"></i>
            <img class="rounded-xl overflow-hidden inset-0 absolute z-0 lazyload" data-src="{{ $vidThumb }}">
        </div>
        <h2><strong>{!! $header !!}</strong></h2>
        <p class="mt-2 mb-10">{!! $desc !!}</p>
        <div class="flex flex-wrap items-start justify-center text-left">

            @foreach ($gridItems as $gridItem)
                <div class="w-full sm:w-1/2 lg:w-1/3 px-2 sm:px-3 mb-8">
                    <img class="rounded-xl mb-4" src="{{ $gridItem['image'] }}">
                    <p class="leading-tight">
                        {{ $gridItem['desc'] }}
                    </p>
                </div>
            @endforeach
        </div>
        <a href="" class="mx-1 join outline method smaller">EXPLORE THE METHOD <i class="fas fa-info-circle"></i> </a>
        <a href="" class="mx-1 join blue smaller anchor-slide">START FOR FREE <i class="fas fa-arrow-right"></i> </a>
    </div>
</section>
