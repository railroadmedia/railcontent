<!-- Modal -->
<div
    x-show="{{ $name }}"
    style="display: none"
    x-on:keydown.escape.prevent.stop="{{ $name }} = false; "
    role="dialog"
    aria-modal="true"
    class="fixed inset-0 z-10 overflow-y-auto"
>
    <!-- Overlay -->
    <div x-show="{{ $name }}" x-transition.opacity class="fixed inset-0 bg-black bg-opacity-50"></div>

    <!-- Panel -->
    <div
        x-show="{{ $name }}" x-transition
        x-on:click="{{ $name }} = false;"
        class="relative flex min-h-screen items-center justify-center p-4"
    >
        <!-- Close button -->
        <i class="fal fa-times fa-2x fixed top-16 right-2 text-white cursor-pointer text-5xl"></i>
        <div
            x-on:click.stop
            x-trap.noscroll.inert="{{ $name }}"
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
