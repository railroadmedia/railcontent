{{-- todo - review & clean --}}
<div class="tw-w-full fluid collapsed-h tw-py-8 md:tw-py-11 relative tw-bg-black">
    {{-- Background Image --}}
    <div class="tw-bg-cover tw-absolute tw-w-full tw-h-full tw-top-0 tw-left-0 tw-bg-top">
        <img src="https://www.musora.com/musora-cdn/image/width=1000,quality=90/{{ $backgroundImage }}"
             class="tw-h-full tw-w-full tw-object-cover tw-object-top tw-transition-opacity tw-opacity-0"
             onload="this.classList.remove('tw-opacity-0')"
        >
    </div>
    {{-- Background Gradient --}}
    <div class="tw-bg-cover tw-absolute tw-w-full tw-h-full tw-top-0 tw-left-0 tw-bg-top hide-lg-down" style="background: linear-gradient(to left, #000 0%, transparent 10%, transparent 90%, #000 100%)"></div>
    <div class="header-gradient-overlay absolute-fill {{ $brand }}"></div>
    <div class="tw-container tw-mx-auto tw-px-4 md:tw-px-8 dark:tw-text-white tw-relative">
        <div class="tw-flex tw-flex-row">
            {{ $content }}
        </div>

        {{ $interactionSlot ?? '' }}
    </div>
</div>
