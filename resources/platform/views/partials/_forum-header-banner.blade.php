<!-- Forum Header Banner -->
<div class="tw-w-full fluid collapsed-h pv-5 tw-relative tw-bg-black">
    {{-- Background Image --}}
    <div class="tw-bg-cover tw-absolute tw-w-full tw-h-full tw-top-0 tw-left-0 tw-bg-top">
        <img src="https://www.musora.com/musora-cdn/image/width=1000,q_auto:best/{{$backgroundImage}}"
            class="tw-h-full tw-w-full tw-object-cover tw-object-top tw-transition-opacity tw-opacity-0"
            onload="this.classList.remove('tw-opacity-0')"
        >
    </div>
    {{-- Background Gradient --}}
    <div class="absolute-fill bg-top hide-lg-down tw-left-0 tw-w-full" style="background: linear-gradient(to left, #000 0%, transparent 10%, transparent 90%, #000 100%)"></div>
    <div class="header-gradient-overlay absolute-fill {{ $brand }}"></div>
    <div class="tw-w-full tw-mx-auto 3xl:tw-max-w-screen-3xl 4xl:tw-max-w-screen-4xl tw-px-4 md:tw-px-8 tw-relative">
        <div class="tw-flex tw-flex-row tw-items-center">
            {{ $content }}
        </div>
    </div>
</div>
