<!-- Forum Header Banner -->
<div class="tw-w-full fluid collapsed-h pv-5 tw-relative tw-bg-black">
    {{-- Background Image --}}
    <div class="tw-bg-cover tw-absolute tw-w-full tw-h-full tw-top-0 tw-left-0 tw-bg-top">
        <img src="https://musora.com/cdn-cgi/image/width=640,quality=90/{{$backgroundImage}}" 
            class="tw-h-full tw-w-full tw-object-cover tw-object-top tw-transition-opacity tw-opacity-0"
            onload="this.classList.remove('tw-opacity-0')"
        >
    </div>
    {{-- Background Gradient --}}
    <div class="header-background-container absolute-fill bg-top hide-lg-down" style="background: linear-gradient(to left, #000 0%, transparent 10%, transparent 90%, #000 100%)"></div>
    <div class="header-gradient-overlay absolute-fill {{ $brand }}"></div>
    <div class="tw-container tw-mx-auto tw-px-4 md:tw-px-8 tw-relative">
        <div class="tw-flex tw-flex-row tw-items-center">
            {{ $content }}
        </div>
    </div>
</div>
