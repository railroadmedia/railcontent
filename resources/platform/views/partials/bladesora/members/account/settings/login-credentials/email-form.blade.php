@component('partials.bladesora.members.account.settings.edit-form')
    @slot('formTitle')
        Login Email
    @endslot

    @slot('modalId')
        loginEmailModal
    @endslot

    @slot('formData')
        <div class="tw-flex tw-flex-col">
            @include('partials.bladesora.members.account.partials._text-fields', [
                "fields" => [
                    "Login Email" => $emailInput['inputValue'],
                ],
                "showEmpty" => true
            ])

            @if(!empty($pending))
                <p class="tiny text-error tw-italic">
                    Email change pending confirmation
                </p>
            @endif
        </div>
    @endslot

    @slot('formModal')
        <div id="loginEmailModal" class="modal">
            <div class="tw-flex tw-flex-col tw-bg-white corners-10 tw-shadow">
                <div class="tw-flex tw-flex-row pa-3">
                    <h2 class="subheading">Edit: Login Email</h2>
                </div>

                <form method="POST" action="{{ $action }}">
                    {{ method_field($method) }}
                    {{ csrf_field() }}

                    @if($showLegacyUserNameMessage)
                        <div class="tw-flex tw-flex-row ph-3 tw-mb-2">
                            <p class="tiny text-grey-3">WARNING: It looks like you are still using the legacy username login. While you are still able to login with your user name right now, upon changing your email you will be required to log in using that email from now on.</p>
                        </div>
                    @endif

                    <div class="tw-flex tw-flex-row ph-3 tw-mb-2">
                        <p class="tiny text-grey-3">WARNING: Changing your email in {{ ucfirst($brand) }} will also change your email in {{ $otherBrands }}.</p>
                    </div>

                    <div class="tw-flex tw-flex-row ph-3 tw-mb-1">
                        <div class="tw-flex tw-flex-col">
                            @include('partials.bladesora.members.inputs.text-input', array_merge([
                                "brand" => $brand,
                                "inputId" => "loginEmail",
                                "inputName" => "login_email",
                                "inputLabel" => "Login Email",
                                "inputValue" => "",
                                "inputErrors" => [],
                                "type" => "email",
                            ], $emailInput ?? []))
                        </div>
                    </div>

                    <div class="tw-flex tw-flex-row ph-3 tw-mb-1">
                        <div class="tw-flex tw-flex-col">
                            @include('partials.bladesora.members.inputs.text-input', array_merge([
                                "brand" => $brand,
                                "inputId" => "emailPassword",
                                "inputName" => "password",
                                "inputLabel" => "Password",
                                "inputValue" => "",
                                "inputErrors" => [],
                                "type" => "password",
                            ], $emailPasswordInput ?? []))
                        </div>
                    </div>

                    <div class="tw-flex tw-flex-row ph-3 tw-pb-3">
                        <button class="btn collapse-150 tw-mr-1">
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