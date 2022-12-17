<div class="h-5 sm:h-10 -mt-5 sm:-mt-10" style="background: linear-gradient(to bottom right, transparent calc(50% - 1px), transparent, #0c1524 calc(50% + 1px));"></div>
<section class="text-center text-white px-5 sm:px-6 py-10 sm:py-14 lg:py-20" style="background-color:#0c1524;">
    <div class="container max-w-6xl mx-auto">
        <h2><strong>{!! $header !!}</strong></h2>
        <p class="leading-tight mt-3">{!! $desc !!}</p>

        <div class="flex flex-wrap sm:flex-nowrap items-center justify-center my-12">
            <div class="text-left pr-8">
                @foreach ($songItems as $songItem)
                    <div class="flex mb-4">
                        <div class="w-14 flex-grow-0"><img alt="point icon" src="{{ $songItem['icon'] }}" class="h-10"></div>
                        <div class="flex-grow pl-4">
                            <h5><strong>{!!$songItem['title']!!}</strong></h5>
                            <p class="mt-2 text-sm">{!! $songItem['desc'] !!}</p>
                        </div>
                    </div>
                @endforeach
            </div>
            <video class="h-64 lg:h-96 rounded-xl lazyload" data-src="{{ $video }}" type="video/mp4" autoplay="" loop="" playsinline="" muted></video>
        </div>
        <a href="/songs" class="mx-1 join outline method smaller">SEE SONGS LIST <i class="fas fa-list-music"></i> </a>
        <a href="/pricing" class="mx-1 join blue smaller">START FOR FREE <i class="fas fa-arrow-right"></i> </a>
        <p class="text-light-navy text-sm mt-5"><em>Songs included with {{ $brandName }}</em></p>
    </div>
</section>
