@component('partials.bladesora.members.account.settings.edit-form')
    @slot('formTitle')
        Piano Gear Photo
    @endslot

    @slot('modalId')
        pianoGearPhotoModal
    @endslot

    @slot('formData')
        <div class="flex flex-column">
            <div class="flex flex-row flex-wrap align-center">
                <div class="flex flex-column align-center tw-relative tw-aspect-[16/9] tw-bg-[#D4D4D8] tw-text-[#002039] dark:tw-bg-[#002039] dark:tw-text-[#80A0B9] tw-rounded-lg tw-border tw-border-transparent hover:tw-border-[#002039] dark:hover:tw-border-[#80A0B9] tw-transition">
                    @if(empty($gearPhotoUrl))
                        <svg width="40" height="32" viewBox="0 0 40 32" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" clip-rule="evenodd" d="M2.58065 0.572266C1.15542 0.572266 0 1.72363 0 3.14369V28.858C0 30.278 1.15542 31.4294 2.58065 31.4294H37.4194C38.8446 31.4294 40 30.278 40 28.858V3.14369C40 1.72363 38.8446 0.572266 37.4194 0.572266H2.58065ZM3.87097 3.14369C3.15831 3.14369 2.58065 3.71938 2.58065 4.42941V13.4294H37.4194V4.42941C37.4194 3.71938 36.8417 3.14369 36.129 3.14369H3.87097ZM30.9677 16.0008V21.1437C30.9677 21.8537 31.5454 22.4294 32.2581 22.4294V28.858H28.3871V22.4294C29.0998 22.4294 29.6774 21.8537 29.6774 21.1437V16.0008H30.9677ZM33.5484 28.858H36.129C36.8417 28.858 37.4194 28.2823 37.4194 27.5723V16.0008H34.8387V21.1437C34.8387 21.8537 34.261 22.4294 33.5484 22.4294V28.858ZM23.2258 28.858H27.0968V22.4294C26.3841 22.4294 25.8064 21.8537 25.8064 21.1437V16.0008H24.5161V21.1437C24.5161 21.8537 23.9385 22.4294 23.2258 22.4294V28.858ZM21.9355 22.4294C21.2228 22.4294 20.6452 21.8537 20.6452 21.1437V16.0008H18.0645V28.858H21.9355V22.4294ZM12.9032 28.858H16.7742V16.0008H14.1935V21.1437C14.1935 21.8537 13.6159 22.4294 12.9032 22.4294V28.858ZM11.6129 22.4294C10.9002 22.4294 10.3226 21.8537 10.3226 21.1437V16.0008H9.03226V21.1437C9.03226 21.8537 8.45459 22.4294 7.74194 22.4294V28.858H11.6129V22.4294ZM3.87097 28.858H6.45161V22.4294C5.73896 22.4294 5.16129 21.8537 5.16129 21.1437V16.0008H2.58065V27.5723C2.58065 28.2823 3.15831 28.858 3.87097 28.858Z" fill="currentColor"/>
                            <path fill-rule="evenodd" clip-rule="evenodd" d="M7.74194 5.71512C6.31671 5.71512 5.16129 6.86649 5.16129 8.28655C5.16129 9.70661 6.31671 10.858 7.74194 10.858C9.16716 10.858 10.3226 9.70661 10.3226 8.28655C10.3226 6.86649 9.16716 5.71512 7.74194 5.71512ZM7.74194 7.00084C7.02928 7.00084 6.45161 7.57652 6.45161 8.28655C6.45161 8.99658 7.02928 9.57227 7.74194 9.57227C8.45459 9.57227 9.03226 8.99658 9.03226 8.28655C9.03226 7.57652 8.45459 7.00084 7.74194 7.00084Z" fill="currentColor"/>
                            <path d="M18.0645 8.28655C18.0645 7.57647 18.6422 7.00084 19.3548 7.00084H23.2258C23.9384 7.00084 24.5161 7.57647 24.5161 8.28655C24.5161 8.99663 23.9384 9.57227 23.2258 9.57227H19.3548C18.6422 9.57227 18.0645 8.99663 18.0645 8.28655Z" fill="currentColor"/>
                            <path d="M25.8064 8.28655C25.8064 7.57647 26.3841 7.00084 27.0968 7.00084H29.6774C30.39 7.00084 30.9677 7.57647 30.9677 8.28655C30.9677 8.99663 30.39 9.57227 29.6774 9.57227H27.0968C26.3841 9.57227 25.8064 8.99663 25.8064 8.28655Z" fill="currentColor"/>
                            <path d="M32.2581 8.28655C32.2581 7.57647 32.8358 7.00084 33.5484 7.00084C34.261 7.00084 34.8387 7.57647 34.8387 8.28655C34.8387 8.99663 34.261 9.57227 33.5484 9.57227C32.8358 9.57227 32.2581 8.99663 32.2581 8.28655Z" fill="currentColor"/>
                        </svg>
                        <p class="tw-text-sm tw-italic tw-mt-2 tw-text-center">Add a photo of your<br> piano gear</p>
                    @endif

                    @if(!empty($gearPhotoUrl))
                        <img src="{{ !empty($gearPhotoUrl) ? $gearPhotoUrl : 'https://dmmior4id2ysr.cloudfront.net/assets/images/default-gear-photo.jpg' }}"
                            data-gear-update="true"    
                        >
                    @endif

                    @if($canClear)
                        <span id="clearGearPhoto" class="rounded clear-button">
                            <i class="fas fa-times"></i>
                        </span>
                    @endif
                </div>
            </div>
        </div>
    @endslot

    @slot('formModal')
        <div id="pianoGearPhotoModal" class="modal">
            <div class="flex flex-column bg-white corners-10 shadow">
                <div class="flex flex-row pa-3">
                    <h2 class="subheading">Edit: Gear Photo</h2>
                </div>

                <image-cropper
                    theme-color="{{ $brand }}"
                    brand="{{ $brand }}"
                    :aspect-ratio="1.78"
                    upload-endpoint="{{ $uploadRequestEndpoint }}"
                    save-endpoint="{{ $fieldSaveRequestEndpoint }}"
                    user-id="{{ $userId }}"
                    @image-uploaded="gearPhotoUploaded"></image-cropper>
            </div>
        </div>
    @endslot
@endcomponent