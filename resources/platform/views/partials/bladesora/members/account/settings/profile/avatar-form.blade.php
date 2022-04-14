@component('partials.bladesora.members.account.settings.edit-form')
    @slot('formTitle')
        Profile Picture
    @endslot

    @slot('modalId')
        avatarModal
    @endslot

    @slot('formData')
        <div class="tw-flex tw-flex-col">
            <div class="tw-flex tw-flex-row tw-flex-wrap align-center">
                <div class="tw-flex tw-flex-col image-col align-center tw-relative">
                    <img class="rounded"
                         src="{{ $profilePictureUrl }}"
                         data-avatar-update="true">

                    @if($canClearAvatar)
                        <span id="clearAvatar" class="tw-rounded clear-button">
                            <i class="fas fa-times"></i>
                        </span>
                    @endif
                </div>
                <div class="tw-flex tw-flex-col align-center pa">
                    <p class="tiny text-grey-3">For best results upload a square photo.</p>
                    <p class="tiny text-grey-3 tw-italic">Max file size: <strong>5MB</strong></p>
                </div>
            </div>
        </div>
    @endslot

    @slot('formModal')
        <div id="avatarModal" class="modal">
            <div class="tw-flex tw-flex-col tw-bg-white corners-10 tw-shadow">
                <div class="tw-flex tw-flex-row pa-3">
                    <h2 class="subheading">Edit: Profile Picture</h2>
                </div>

                <image-cropper
                    theme-color="{{ $brand }}"
                    brand="{{ $brand }}"
                    :aspect-ratio="1"
                    upload-endpoint="{{ $uploadRequestEndpoint }}"
                    save-endpoint="{{ $fieldSaveRequestEndpoint }}"
                    user-id="{{ $userId }}"
                    @image-uploaded="avatarUploaded"></image-cropper>
            </div>
        </div>
    @endslot
@endcomponent