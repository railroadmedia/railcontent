<!-- Modal -->
<div
    x-show="{{ $name }}"
    style="display: none;z-index: 2147483002;"
    x-on:keydown.escape.prevent.stop="{{ $name }} = false; "
    role="dialog"
    aria-modal="true"
    class="tw-fixed tw-inset-0 tw-overflow-y-auto"
>
    <!-- Overlay -->
    <div x-show="{{ $name }}" x-transition.opacity class="tw-fixed tw-inset-0 tw-bg-black tw-bg-opacity-80" style="z-index: 1005;"></div>

    <!-- Panel -->
    <div
        x-show="{{ $name }}" x-transition
        x-on:click="{{ $name }} = false;"
        class="tw-relative tw-flex tw-min-h-screen tw-items-center tw-justify-center tw-p-4"
        style="z-index: 1006;"
    >
        <!-- Close button -->
        <i class="fal fa-times fa-2x tw-fixed tw-top-16 tw-right-2 tw-text-white tw-cursor-pointer tw-text-5xl"></i>
        <div
            x-on:click.stop
            class="tw-relative tw-w-full tw-overflow-y-visible tw-max-w-6xl"
        >
            <!-- Content -->
            <div
                class="@if(!empty($styles)) {{ $styles }} @endif tw-overflow-hidden tw-rounded-xl tw--full tw-relative"
                style="padding-bottom: 56.25%;"
            >
                <iframe class="tw-z-10 tw-absolute tw-w-full tw-h-full reset-on-close" x-bind:src="{{ $name }} && '{{ $video }}'" frameborder="0" allowfullscreen allow="autoplay" title="{{ $name }}"></iframe>
            </div>
        </div>
    </div>
</div>
