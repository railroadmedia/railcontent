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
        class="relative flex min-h-screen items-center justify-center p-4"
        style="z-index: 1006;"
    >
        <!-- Close button -->
        <i class="fal fa-times fa-2x fixed top-16 right-2 text-white cursor-pointer text-5xl"></i>
        <div
            x-on:click.stop
            class="relative w-full overflow-y-visible max-w-6xl"
        >
            <!-- Content -->
            <div
                class="aspect-16:9 overflow-hidden rounded-xl w-full relative"
            >
                <iframe class="absolute w-full h-full reset-on-close" x-bind:src="{{ $name }} && '//player.vimeo.com/video/{{ $video }}?autoplay=1'" frameborder="0" allowfullscreen allow="autoplay" title="{{ $name }}"></iframe>
            </div>
        </div>
    </div>
</div>
