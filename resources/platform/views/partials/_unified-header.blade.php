<div id="unified-header" class="lg:tw-container lg:tw-mx-auto tw-px-4 lg:tw-px-8 tw-flex tw-w-full tw-h-[100px] md:tw-h-[120px] lg:tw-h-[180px] tw-relative tw-z-0 tw-items-center tw-justify-center tw-bg-[#000C17]">
    <picture class="tw-absolute tw-w-full tw-h-full tw-left-0 tw-top-0 tw-hidden md:tw-block tw-z-0 tw-object-cover">
        <source srcset="https://www.musora.com/musora-cdn/image/width=2400,quality=95/{{ $backgroundImage }}" media="(min-width: 1024px)">
        <img src="https://www.musora.com/musora-cdn/image/width=1100,quality=95/{{ $backgroundImage }}" alt="background" class="tw-object-cover tw-w-full tw-h-full tw-absolute tw-left-0 tw-top-0 tw-z-0">
    </picture>
    <div class="tw-absolute tw-w-full tw-z-10 tw-h-full tw-bottom-0" style="background: linear-gradient(180deg, rgba(0, 16, 29, 0.00) 0%, #00101D 100%), linear-gradient(0deg, rgba(11, 118, 219, 0.10) 0%, rgba(11, 118, 219, 0.10) 100%)"></div>
    <div class="tw-z-20 tw-w-full tw-h-auto">
        <div class="tw-flex tw-flex-row tw-w-full">
            {{ $content }}
        </div>
    </div>
</div>
