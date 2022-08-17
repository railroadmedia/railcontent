<!-- Modal -->
<div
    x-show="{{ $name }}"
    style="display: none"
    x-on:keydown.escape.prevent.stop="{{ $name }} = false"
    role="dialog"
    aria-modal="true"
    x-id="['modal-title']"
    :aria-labelledby="$id('modal-title')"
    class="fixed inset-0 z-10 overflow-y-auto"
    >
    <!-- Overlay -->
    <div x-show="{{ $name }}" x-transition.opacity class="fixed inset-0 bg-black bg-opacity-50"></div>

    <!-- Panel -->
    <div
        x-show="{{ $name }}" x-transition
        x-on:click="{{ $name }} = false; @if(!empty($additionalClose)) {{ $additionalClose }} @endif"
        class="relative flex min-h-screen items-center justify-center p-4"
    >
        <!-- Close button -->
        <i class="fal fa-times fa-2x fixed top-16 right-2 text-white cursor-pointer text-5xl"></i>
        <div
            x-on:click.stop
            x-trap.noscroll.inert="{{ $name }}"
            class="relative w-full max-w-4xl overflow-y-visible"
        >
            <!-- Content -->
            {!! $content !!}
        </div>
    </div>
</div>