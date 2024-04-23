@php
    if(!empty($vimeo)){
        $video = '//player.vimeo.com/video/'.$video.'?autoplay=1';
    }
    elseif(!empty($soundslice)){
        if(!empty($score)){
            $video = 'https://www.soundslice.com/scores/'.$video.'/embed/?api=1&scroll_type=2&branding=0&top_controls=1&show_chords=0&layout=3&recording_idx=1&enable_metronome=0';
        }
        else{
            $video = 'https://www.soundslice.com/slices/'.$video.'/embed/?api=1&scroll_type=2&branding=0&top_controls=1&show_chords=0&layout=3&recording_idx=1&enable_metronome=0';
        }
    }
    elseif(!empty($youtube)){
        $video = 'https://www.youtube.com/embed/'.$video.'?autoplay=1';
    }
@endphp
<!-- Modal -->
<div
    x-show="{{ $name }}"
    style="display: none;z-index: 2147483002;"
    x-on:keydown.escape.prevent.stop="{{ $name }} = false; "
    role="dialog"
    aria-modal="true"
    class="fixed inset-0 overflow-y-auto"
>
    <!-- Overlay -->
    <div x-show="{{ $name }}" x-transition.opacity class="fixed inset-0 bg-black bg-opacity-80" style="z-index: 1005;"></div>

    <!-- Panel -->
    <div
        x-show="{{ $name }}" x-transition
        x-on:click="{{ $name }} = false;"
        class="relative min-h-screen flex items-start justify-center px-4 pt-40 sm:pt-28 lg:pt-16"
        style="z-index: 1006;"
    >
        <!-- Close button -->
        <i class="fa-light fa-times fa-2x fixed top-1 right-1 text-white cursor-pointer text-5xl"></i>
        <div
            x-on:click.stop
            class="relative w-full overflow-y-visible max-w-6xl"
        >
            <!-- Content -->
            <div
                class="@if(!empty($styles)) {{ $styles }} @endif overflow-hidden rounded-xl w-full relative @if(!empty($vimeo) || !empty($youtube)) aspect-16:9 @elseif(!empty($soundslice)) pb-[66vh] bg-white @endif"
            >
                <iframe class="z-10 absolute w-full h-full reset-on-close" x-bind:src="{{ $name }} && '{{ $video }}'" frameborder="0" allowfullscreen allow="autoplay" title="{{ $name }}"></iframe>
            </div>
            @if(!empty($button))
                {!! $button !!}
            @endif
        </div>
    </div>
</div>
