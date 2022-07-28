@component('partials.bladesora.members.account.settings.edit-form')
    @slot('formTitle')
        Forum Signature
    @endslot

    @slot('modalId')
        signatureModal
    @endslot

    @slot('formData')

        <div class="tw-flex tw-flex-col grow body tw-break-words">

            {!! html_entity_decode($signature) !!}

            <p class="tw-text-sm text-grey-3 tw-italic tw-mt-3 dark:tw-text-[#9EC0DC]">
                This will appear below your posts on the forums page.
            </p>
        </div>

    @endslot

    @slot('formModal')
        <div id="signatureModal" class="modal">
            <div class="tw-flex tw-flex-col tw-bg-white corners-10 tw-shadow">
                <div class="pa-3 tw-pb-3">
                    <h2 class="subheading">Edit: Signature</h2>
                    <p class="tw-mt-1 tw-italic tw-text-sm tw-text-gray-400">Limit of 200 characters</p>
                    <p id="signatureErrorMessage" class="tw-text-sm tw-text-red-500 tw-mt-2 tw-transition tw-opacity-0">You have entered more than 200 characters.</p>
                </div>
                <span>
                <form method="POST" action="{{ $action }}">
                    {{ method_field($method) }}
                    {{ csrf_field() }}

                    <div class="tw-flex tw-flex-row ph-3 tw-mb-1">
                        <div class="tw-flex tw-flex-col tw-w-full">
                            <div class="tw-flex tw-flex-row tw-mb-1 tw-w-full">
                                <div class="tw-flex tw-flex-col tw-w-full">
                                    @include('partials.bladesora.members.inputs.textarea-input', [
                                        "brand" => $brand,
                                        "inputId" => "signature",
                                        "inputName" => "signature",
                                        "inputLabel" => "Signature",
                                        "inputValue" => $signature,
                                        "inputErrors" => [],
                                    ])
                                    
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="tw-flex tw-flex-row ph-3 tw-pb-3">
                        <button id="signatureButton" class="btn collapse-150 tw-mr-1">
                            <span class="tw-bg-{{ $brand }} tw-text-white corners-10 short">
                                Save
                            </span>
                        </button>

                        <a class="btn collapse-150 close-modal corners-10 flat tw-text-black flat short">
                            Cancel
                        </a>
                    </div>
                </form>
            </div>
        </div>
    @endslot
@endcomponent
