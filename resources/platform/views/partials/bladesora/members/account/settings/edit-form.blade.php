<div class="tw-flex tw-flex-col tw-grow">
    <div class="tw-flex tw-flex-row tw-flex-auto tw-mb-4 tw-flex-grow-0 {{ !empty($gearForm) && !$gearForm ? 'tw-items-center' : ''}}" >
        <div class="tw-flex tw-flex-col">
            <h2 class="tw-font-bold dark:tw-text-white {{ !empty($gearForm) && !$gearForm ? 'tw-text-2xl' : 'tw-text-xl'}}">
                {{ $formTitle }}
            </h2>
        </div>
        @if( !empty($gearForm) && $gearForm )
            <div class="tw-ml-4 edit-button">
                <button class="" data-open-modal="{{ $modalId }}" dusk="{{ $modalId }}">
                    <i class="tw-text-lg fas fa-edit tw-text-[#00101D] dark:tw-text-white" aria-hidden="true"></i>
                </button>
            </div>    
        @else
            <div class="tw-ml-auto tw-flex tw-flex-col edit-button">
                <button class="tw-btn-secondary tw-btn-small tw-mb-0 tw-text-[#00101D] dark:tw-text-[#9EC0DC] tw-text-lg tw-px-4" data-open-modal="{{ $modalId }}" dusk="{{ $modalId }}">Edit</button>
            </div>
        @endif
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