<!-- Modal -->
<div
    x-show="{{ $name }}"
    style="display: none;z-index: 2147483002;"
    x-on:keydown.escape.prevent.stop="{{ $name }} = false"
    role="dialog"
    aria-modal="true"
    :aria-labelledby="['modal-title']"
    class="fixed inset-0 overflow-y-auto"
>
    <!-- Overlay -->
    <div x-show="{{ $name }}" x-transition.opacity class="fixed inset-0 bg-black bg-opacity-80" style="z-index: 1005;"></div>

    <!-- Panel -->
    <div
        x-show="{{ $name }}" x-transition
        x-on:click="{{ $name }} = false; @if(!empty($additionalOnClose)) {{ $additionalOnClose }} @endif"
        class="relative flex min-h-screen items-center justify-center p-4"
        style="z-index: 1006;"
    >
        <!-- Close button -->
        <i class="fa-light fa-times fa-2x fixed top-16 right-2 text-white cursor-pointer text-5xl z-150"></i>
        <div
            x-on:click.stop
            class="relative overflow-y-visible"
        >
            <!-- Content -->
            {!! $content !!}
        </div>
    </div>
</div>
