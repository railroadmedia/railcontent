<div class="product-wrap lg:tw-w-2/3 tw-px-3 md:tw-px-4">
    <div class="pack-details slider-wrap tw-w-full tw-pt-5 tw-mx-auto tw-mb-1 md:tw-pt-9 md:tw-mt-2 lg:tw-pt-11 lg:tw-mt-5">
        <div class="product-title tw-text-center tw-pb-5 sm:tw-pb-6 lg:tw-pb-7">
            <div class="clearfix tw-w-full">
                @if(!empty($headerText))
                    <div class="tw-text-xl md:tw-text-3xl lg:tw-text-4xl tw-leading-none">{!! $headerText !!}</div>
                @endif
                @if(!empty($specialText))
                    {!! $specialText !!}
                @endif
            </div>
        </div>
        <div class="slider-container tw-overflow-hidden tw-w-full tw-mb-5 md:tw-mb-7" style="font-size: 0;@if(!empty($interactiveBanner)) max-height:1500px @endif">
            <div class="slider-for tw-overflow-hidden @if(!empty($interactiveBanner) || !empty($packBanner)) tw-rounded-t @else tw-rounded @endif">
                @if (!empty($videoSrc))
                    <div class="tw-overflow-hidden tw-relative tw-w-full" style="padding-bottom: 56.25%;">
                        <iframe class="tw-absolute tw-w-full tw-h-full tw-inset-0" src="{{ $videoSrc }}" frameborder="0" allowfullscreen id="videoPlayer"></iframe>
                        <div class="tw-hidden" id="videoSrc">{{$videoSrc}}</div>
                    </div>
                @elseif(!empty($videoThumb))
                    <img src="https://cdn.musora.com/image/fetch/w_1000,q_auto:best/{{ $videoThumb }}" alt="thumbnail">    
                @endif
                @if (!empty($images))
                    @foreach ($images as $image)
                        <div style="display: none;">
                            <img class="tw-w-full" src="https://cdn.musora.com/image/fetch/w_1000,q_auto:best/{{ $image }}">
                        </div>
                    @endforeach
                @endif
            </div>
            <div class="slider-nav tw-mx-auto tw-w-full @if(!empty($noSlider)) tw-hidden @endif">
                @if(!empty($images))
                    @if(!empty($videoSrc))
                        <div style="display: none;"><img class="tw-w-full" src="https://cdn.musora.com/image/fetch/w_1000,q_auto:best/{{ $videoThumb  }}"></div>
                    @endif
                    @foreach ($images as $image)
                        <div style="display: none;"><img class="tw-w-full" src="https://cdn.musora.com/image/fetch/w_1000,q_auto:best/{{ $image }}"></div>
                    @endforeach
                @endif
            </div>
            @if(!empty($interactiveBanner))
                <div class="tw-rounded-b tw-p-4 tw-flex tw-justify-between tw-items-center bg-drumeo sm:tw-py-1 sm:tw-px-5">
                    <img class="tw-w-full sm:tw-w-2/3" src="https://s3.amazonaws.com/drumeo-packs/interactive-edition-logo-white.png">
                    <img class="tw-w-40 tw-hidden sm:tw-inline lg:tw-w-48" src="{{ $interactiveBanner }}">
                </div>
            @elseif(!empty($packBanner))
                <div class="tw-rounded-b tw-p-4 tw-w-full tw-flex tw-justify-between tw-items-center bg-drumeo sm:tw-py-1 sm:tw-px-5">
                    <img class="tw-w-full sm:tw-w-2/3" src="https://s3.amazonaws.com/drumeo-packs/drumeo-training-pack-white.png">
                    <img class="tw-w-40 tw-hidden sm:tw-inline lg:tw-w-48" src="{{ $packBanner }}">
                </div>
            @endif
            @if(!empty($packDetails))
                <div class="tw-w-full tw-mx-auto tw-mt-4"><p class="tw-uppercase tw-mx-auto tw-text-xs md:tw-text-sm">{!!  $packDetails  !!}</p></div>
            @endif
        </div>
    </div>
</div>