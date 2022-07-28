@component('partials.bladesora.members.account.settings.edit-form')
    @slot('formTitle')
        Login Password
    @endslot

    @slot('modalId')
        loginPasswordModal
    @endslot

    @slot('formData')
        <div class="tw-flex tw-flex-col tw-w-full">
            @include('partials.bladesora.members.account.partials._text-fields', [
                "fields" => [
                    "Current Password" => "********",
                ],
                "showEmpty" => true
            ])
        </div>
    @endslot

    @slot('formModal')
        <div id="loginPasswordModal" class="modal">
            <div class="tw-flex tw-flex-col tw-bg-white corners-10 tw-shadow">
                <div class="tw-flex tw-flex-row pa-3">
                    <h2 class="subheading">Edit: Login Password</h2>
                </div>

                <form method="POST" action="{{ $action }}">
                    {{ method_field($method) }}
                    {{ csrf_field() }}

                    <div class="tw-flex tw-flex-row ph-3 tw-mb-2">
                        <p class="tiny text-grey-3">WARNING: Changing your password in {{ ucfirst($brand) }} will also change your password in {{ $otherBrands }}.</p>
                    </div>

                    <div class="tw-flex tw-flex-row ph-3 tw-mb-3">
                        <div class="tw-flex tw-flex-col tw-w-full">
                            @include('partials.bladesora.members.inputs.text-input', array_merge([
                                "brand" => $brand,
                                "type" => "password",
                                "inputId" => "currentPassword",
                                "inputName" => "current_password",
                                "inputLabel" => "Current Password",
                                "inputValue" => "",
                                "inputErrors" => [],
                            ], $currentPasswordInput ?? []))
                        </div>
                    </div>

                    <div class="tw-flex tw-flex-row ph-3 tw-mb-2">
                        <div class="tw-flex tw-flex-col tw-w-full">
                            @include('partials.bladesora.members.inputs.text-input', array_merge([
                                "brand" => $brand,
                                "type" => "password",
                                "inputId" => "loginPassword",
                                "inputName" => "new_password",
                                "inputLabel" => "New Password",
                                "inputValue" => "",
                                "inputErrors" => [],
                            ], $newPasswordInput ?? []))
                        </div>
                    </div>

                    <div class="tw-flex tw-flex-row ph-3 tw-mb-2">
                        <div class="tw-flex tw-flex-col tw-w-full">
                            @include('partials.bladesora.members.inputs.text-input', array_merge([
                                "brand" => $brand,
                                "type" => "password",
                                "inputId" => "loginPasswordConfirm",
                                "inputName" => "new_password_confirmation",
                                "inputLabel" => "Confirm Password",
                                "inputValue" => "",
                                "inputErrors" => [],
                            ], $newPasswordConfirmationInput ?? []))
                        </div>
                    </div>

                    <div class="tw-flex tw-flex-row ph-3 tw-pb-3">
                        <button class="btn collapse-150 tw-mr-1">
                            <span class="tw-bg-{{ $brand }} tw-text-white corners-10 short">
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