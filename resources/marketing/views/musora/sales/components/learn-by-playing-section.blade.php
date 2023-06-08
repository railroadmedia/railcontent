<section class="text-center px-5 sm:px-6 pt-10 sm:pt-14 lg:pt-20" style="background-color:#f4f8fb;">
    <div class="container max-w-5xl mx-auto">
        <h2><strong>{!! $header !!}</strong></h2>
        <p class="leading-tight mt-2 sm:mt-3 mb-8 sm:mb-10
        @if(!empty($variant)) max-w-lg text-left leading-normal @endif
        ">{!! $desc !!}</p>
        <div class="aspect-16:9 cursor-hover rounded-xl autoplay-video overflow-hidden w-full relative z-20 -mb-10" x-on:click="trailer = true;">
            <i class="absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 fas fa-play play-button z-10"></i>
            <video class="rounded-xl overflow-hidden object-cover w-full h-full absolute z-0 lazyload" data-src="{{ $vid }}" type="video/mp4" autoplay muted loop playsinline></video>
        </div>
    </div>
</section>
<div class="h-5 sm:h-10 relative z-10" style="background: linear-gradient(to bottom right, transparent calc(50% - 1px), transparent, #fff calc(50% + 1px));"></div>
