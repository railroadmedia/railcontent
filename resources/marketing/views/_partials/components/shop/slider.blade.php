<div class="product-wrap lg:w-2/3 px-3 md:px-4">
    <div class="pack-details slider-wrap w-full pt-5 mx-auto mb-1 md:pt-9 md:mt-2 lg:pt-11 lg:mt-5">
        <div class="text-center pb-5 sm:pb-6 lg:pb-7">
            <div class="clearfix">
                <div class="w-full">
                    @if(!empty($headerText))
                        <div class="text-xl md:text-3xl lg:text-4xl leading-none font-bold">{!! $headerText !!}</div>
                    @endif
                    @if(!empty($specialText))
                        {!! $specialText !!}
                    @endif
                </div>
            </div>
        </div>
        <div class="slider-container overflow-hidden w-full mb-5 md:mb-7" style="font-size: 0;@if(!empty($interactiveBanner)) max-height:1500px @endif">
            <div class="slider-for overflow-hidden @if(!empty($interactiveBanner) || !empty($packBanner)) rounded-t @else rounded @endif">
                @if (!empty($videoSrc))
                    <div class="overflow-hidden relative w-full" style="padding-bottom: 56.25%;">
                        <iframe class="absolute w-full h-full inset-0" src="{{ $videoSrc }}" frameborder="0" allowfullscreen id="videoPlayer" title="Product video"></iframe>
                        <div class="hidden" id="videoSrc">{{$videoSrc}}</div>
                    </div>
                @endif
                @if (!empty($images))
                    @foreach ($images as $key => $image)
                        @if((!empty($videoSrc) && $key !== 0) || empty($videoSrc) )
                            <div style="display: none;">
                                <img class="w-full" src="https://www.musora.com/musora-cdn/image/width=1400,quality=95/{{$image->path}}" alt="slide image {{ $key+1 }}">
                            </div>
                        @endif
                    @endforeach
                @endif
            </div>
            <div class="slider-nav mx-auto w-full @if(!empty($images) && count($images) <= 1) hidden @endif">
                @if(!empty($images))
                    @foreach ($images as $image)
                        @if((!empty($videoSrc) && $key !== 0) || empty($videoSrc) )
                            <div @if(count($images) > 1)style="display: none;"@endif><img class="w-full rounded border-4 border-solid w-full" style="border-color: #FFF;" src="https://www.musora.com/musora-cdn/image/width=1400,quality=95/{{$image->path}}" alt="slide image {{ $key+1 }}"></div>
                        @endif
                    @endforeach
                @endif
            </div>
            @if(!empty($interactiveBanner))
                <div class="rounded-b p-4 flex justify-between items-center bg-drumeo sm:py-1 sm:px-5">
                    <img class="w-full sm:w-2/3" src="https://www.musora.com/musora-cdn/image/width=1400,quality=95/https://s3.amazonaws.com/drumeo-packs/interactive-edition-logo-white.png">
                    <img class="w-40 hidden sm:inline lg:w-48" src="https://www.musora.com/musora-cdn/image/width=1400,quality=95/{{ $interactiveBanner }}">
                </div>
            @elseif(!empty($packBanner))
                <div class="rounded-b p-4 w-full flex justify-between items-center bg-drumeo sm:py-1 sm:px-5">
                    <img class="w-full sm:w-2/3" src="https://www.musora.com/musora-cdn/image/width=1400,quality=95/https://s3.amazonaws.com/drumeo-packs/drumeo-training-pack-white.png">
                    <img class="w-40 hidden sm:inline lg:w-48" src="{{ $packBanner }}">
                </div>
            @endif
            @if(!empty($packDetails))
                <div class="w-full mx-auto mt-4"><p class="uppercase mx-auto text-xs md:text-sm">{!!  $packDetails  !!}</p></div>
            @endif
        </div>
    </div>
</div>
