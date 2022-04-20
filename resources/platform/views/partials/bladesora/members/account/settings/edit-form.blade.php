<div class="tw-flex tw-flex-col tw-grow">
    <div class="tw-flex tw-flex-row tw-flex-auto tw-items-center tw-mb-2">
        <div class="tw-flex tw-flex-col">
            <h2 class="subheading">
                {{ $formTitle }}
            </h2>
        </div>
        <div class="tw-flex tw-flex-col edit-button">
            <button class="btn" data-open-modal="{{ $modalId }}" dusk="{{ $modalId }}">
                <span class="tw-text-black tw-bg-black inverted corners-10 short">
                    Edit
                </span>
            </button>
        </div>
    </div>
    <div class="tw-flex tw-flex-row">
        <div class="tw-flex tw-flex-col tw-grow">
            <div class="tw-flex tw-flex-row">
                {{ $formData }}
            </div>
        </div>
    </div>

    {{ $formModal }}
</div>