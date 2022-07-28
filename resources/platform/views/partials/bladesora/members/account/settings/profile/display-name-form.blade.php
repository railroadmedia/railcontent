@component('partials.bladesora.members.account.settings.edit-form')
    @slot('formTitle')
        Display Name
    @endslot

    @slot('modalId')
        displayNameModal
    @endslot

    @slot('formData')
        <div class="tw-flex tw-flex-col">
            @include('partials.bladesora.members.account.partials._text-fields', [
                "fields" => [
                    "Display Name" => $displayName,
                ],
                "showEmpty" => true
            ])
            <p class="tw-text-sm text-grey-3 tw-italic dark:tw-text-[#9EC0DC]">
                This is the name other users will see on your profile, comments and forum posts.
            </p>
        </div>
    @endslot
    
    {{-- MODAL --}}
    @slot('formModal')
        <div id="displayNameModal" class="modal">
            <div class="tw-flex tw-flex-col tw-bg-white corners-10 tw-shadow">
                <div class="tw-flex tw-flex-row pa-3">
                    <h2 class="subheading">Edit: Display Name</h2>
                </div>

                <form method="POST" action="{{ $action }}">
                    {{ method_field($method) }}
                    {{ csrf_field() }}

                    <div class="tw-flex tw-flex-row ph-3 tw-mb-1">
                        <div class="tw-flex tw-flex-col tw-w-full">
                            @include('partials.bladesora.members.inputs.text-input', array_merge([
                                "brand" => $brand,
                                "type" => "text",
                                "inputId" => "displayName",
                                "inputName" => "display_name",
                                "inputLabel" => "Display Name",
                                "inputValue" => "",
                                "inputErrors" => [],
                            ], $displayNameInput ?? []))
                        </div>
                    </div>

                    <div class="tw-flex tw-flex-row ph-3 tw-pb-3">
                        <button class="btn collapse-150 tw-mr-1">
                            <span class="tw-bg-{{ $brand }} tw-text-white corners-10 short tw-font-bebas-neue">
                                Save
                            </span>
                        </button>

                        <a class="btn collapse-150 close-modal corners-10 flat tw-text-[#00101D] flat short">
                            Cancel
                        </a>
                    </div>
                </form>
            </div>
        </div>
    @endslot
@endcomponent