@php
    $packHeader = str_replace(' ', '%20', $pack->fetch('data.header_image_url'));
@endphp

@component('partials.bladesora.members.components.header-banner', [
    'hideUser' => true,
    'backgroundImage' => 'https://www.musora.com/musora-cdn/image/width=1200/'.$packHeader,
])
    @slot('content')
        <div class="tw-flex tw-flex-col tw-justify-end tw-w-full tw-h-full tw-items-center">

            {{-- Pack Logo --}}
            <img alt="{{ $pack->fetch('title') }} Logo"
                 class="tw-w-full tw-transition-opacity tw-max-w-[350px] tw-opacity-0 tw-mb-4"
                 src="{{ $pack->fetch('data.logo_image_url') }}"
                 onload="this.classList.remove('tw-opacity-0')"
            >

            {{-- @if($pack['slug'] !== 'learn-songs-faster')
                <h1 class="heading text-white mb-3">
                    {{ $parentContent->fetch('fields.title') }}
                </h1>
            @endif --}}

            @if($pack['slug'] === '30-day-drummer')
                <a href="/drumeo/forums/drumeo-coaches/16/30-day-drummer-qanda-thread-for-domino-santantonio/13552?sortby_val=-published_on" 
                    class="btn collapse-200 bg-white inverted short text-white mt-2">
                    Ask A Question
                </a>
            @endif
            @if($parentContent->fetch('type') === 'pack-bundle' && $pack->fetch('bundle_count') > 1)
                <a href="{{ url()->route('platform.packs') }}"
                   class="tw-btn-secondary tw-text-white hover:tw-btn-primary hover:tw-bg-white hover:tw-text-black">
                    Back to All Lessons
                </a>
            @endif

        </div>
    @endslot
@endcomponent
