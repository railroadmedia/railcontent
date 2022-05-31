<div class="tw-flex tw-flex-col tw-grow">
    <div class="tw-flex tw-flex-row tw-flex-auto tw-items-center tw-mb-4">
        <div class="tw-flex tw-flex-col">
            <h2 class="tw-text-2xl tw-font-bold dark:tw-text-white">
                {{ $formTitle }}
            </h2>
        </div>
        <div class="tw-ml-auto tw-flex tw-flex-col edit-button">
            <button class="tw-btn-secondary tw-btn-small tw-mb-0 tw-text-black dark:tw-text-[#9EC0DC] tw-text-lg tw-px-4" data-open-modal="{{ $modalId }}" dusk="{{ $modalId }}">Edit</button>
        </div>
    </div>
    <div class="tw-flex tw-flex-row">
        <div class="tw-flex tw-flex-col tw-grow">
            <div class="tw-flex tw-flex-row dark:tw-text-white">
                {{ $formData }}
            </div>
        </div>
    </div>

    {{ $formModal }}
</div>