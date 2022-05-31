@component('partials.bladesora.members.account.settings.edit-form')
    @slot('formTitle')
        Profile Picture
    @endslot

    @slot('modalId')
        avatarModal
    @endslot

    @slot('formData')
        <div class="tw-flex tw-flex-col tw-w-full">
            <div class="tw-flex tw-flex-row tw-w-full tw-items-center tw-justify-center tw-flex-wrap lg:tw-flex-nowrap">
                <div class="tw-flex tw-flex-col tw-bg-top tw-bg-cover tw-flex-shrink-0 tw-h-52 tw-w-52 tw-items-center tw-relative tw-rounded-full tw-mb-4 lg:tw-mb-0">
                    @if($profilePictureUrl) 
                        <img class="rounded"
                             src="{{ $profilePictureUrl }}"
                             data-avatar-update="true"
                        >
                    @else   
                        <svg width="223" height="224" class="dark:tw-text-[#445F74] tw-text-[#232e30]" viewBox="0 0 223 224" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" clip-rule="evenodd" d="M223 111.748C223 173.328 173.08 223.248 111.5 223.248C49.9203 223.248 0 173.328 0 111.748C0 50.1683 49.9203 0.248047 111.5 0.248047C173.08 0.248047 223 50.1683 223 111.748ZM139.375 69.9355C139.375 85.3305 126.895 97.8105 111.5 97.8105C96.1051 97.8105 83.625 85.3305 83.625 69.9355C83.625 54.5406 96.1051 42.0605 111.5 42.0605C126.895 42.0605 139.375 54.5406 139.375 69.9355ZM111.499 125.686C83.3796 125.686 59.15 142.34 48.1364 166.323C63.4718 184.112 86.1707 195.373 111.5 195.373C136.828 195.373 159.527 184.112 174.862 166.324C163.849 142.341 139.619 125.686 111.499 125.686Z" fill="currentColor"/>
                        </svg>
                    @endif

                    @if($canClearAvatar)
                        <span id="clearAvatar" class="tw-rounded-full clear-button">
                            <i class="fas fa-times"></i>
                        </span>
                    @endif
                </div>
                <div class="tw-flex tw-flex-col tw-w-full tw-items-center text-grey-3 dark:tw-text-[#9EC0DC] lg:tw-pr-[100px]">
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