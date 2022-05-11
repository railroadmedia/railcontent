@component('partials.bladesora.members.account.settings.edit-form')
    @slot('formTitle')
        Profile Picture
    @endslot

    @slot('modalId')
        avatarModal
    @endslot

    @slot('formData')
        <div class="tw-flex tw-flex-col tw-w-full">
            <div class="tw-flex tw-flex-row tw-w-full tw-items-center">
                <div class="tw-flex tw-flex-col tw-bg-top tw-bg-cover tw-flex-shrink-0 tw-h-52 tw-items-center tw-relative tw-w-52 tw-rounded-full"
                     style="background-image: url(https://musora.imgix.net/https%3A%2F%2Fs3.amazonaws.com%2Fpianote%2Fdefaults%2Favatar.png?ixlib=js-2.3.2&amp;fit=crop&amp;crop=faces%2Cedges&amp;auto=format&amp;w=171&amp;h=171&amp;dpr=1&amp;s=1bfa63f0a133082f4c2edb5f7f252f25)"
                >
                    <img class="rounded"
                         src="{{ $profilePictureUrl }}"
                         data-avatar-update="true">

                    @if($canClearAvatar)
                        <span id="clearAvatar" class="tw-rounded-full clear-button">
                            <i class="fas fa-times"></i>
                        </span>
                    @endif
                </div>
                <div class="tw-flex tw-flex-col tw-w-full tw-items-center text-grey-3 dark:tw-text-[#9EC0DC] tw-pr-[100px]">
                    <p class="tiny">For best results upload a square photo.</p>
                    <p class="tiny tw-italic">Max file size: <strong>5MB</strong></p>
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
                    {{-- @image-uploaded="avatarUploaded" --}}
                />
                
            </div>
        </div>
    @endslot
@endcomponent