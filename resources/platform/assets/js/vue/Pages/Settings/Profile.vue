<template>
    <div class="tw-w-full">
        <div class="tw-w-full tw-mx-auto 3xl:tw-max-w-screen-3xl 4xl:tw-max-w-screen-4xl tw-px-4 md:tw-px-8 tw-mb-[30px]">
            <!-- Header -->
            <Breadcrumb :breadcrumbs="[ { title: 'Settings' }, { title: 'Profile' } ]"/>
            <PageHeader 
                page-type="settings"
                :title="userDisplayName"
                :hero-img="userProfilePictureUrl"
                :info-data="[`Musora Member Since ${ userCreatedYear }`]"
                :ctas="[{
                    type: 'PageHeaderPrimaryCta',
                    props: {
                        text: `${userCompletedAccount ? 'Update Your Account' : 'Complete Your Account'}`,
                        url: `/onboarding?brand=${brand}`,
                        showAllAlways: true,
                    }
                }]"
            />
        </div>

        <!-- Page Pills -->
        <PillNav :pills="accountPages"/>

        <div class="tw-w-full tw-mx-auto 3xl:tw-max-w-screen-3xl 4xl:tw-max-w-screen-4xl tw-px-4 md:tw-px-8">
            <!-- Page Content -->
            <div class="tw-flex tw-flex-col tw-grow">
                <input id="userInfo" type="hidden" :data-user-id="userId">

                <!-- DISPLAY NAME -->
                <section class="tw-flex tw-flex-row tw-px-0 md:tw-px-6 tw-py-6 tw-border-b tw-border-gray-300 dark:tw-border-[#223F57]">
                    <div class="tw-flex tw-flex-col tw-grow">
                        <div class="tw-flex tw-flex-row tw-mb-4 tw-flex-grow-0 tw-items-center" >
                            <h2 class="tw-font-bold dark:tw-text-white tw-text-xl">Display Name</h2>
                            <button class="tw-ml-auto tw-btn-primary tw-btn-circle tw-bg-transparent dark:hover:tw-bg-[#102230] hover:tw-bg-[#F5F5F6] tw-text-[#00101D] dark:tw-text-[#9EC0DC] tw-px-0" 
                                @click="handleShowDisplayNameModal"
                            >
                                <musora-icon icon-name="pencil" class="tw-w-[21px]" />
                            </button>
                        </div>
                        <div class="tw-flex tw-flex-col">
                            <div class="tw-flex tw-flex-row tw-mb-2 tw-items-center tw-w-full tw-text-[#00101D] dark:tw-text-white">
                                <h6 class="tw-font-bold tw-w-[200px] tw-flex-shrink-0">Display Name</h6>
                                <p>{{ userDisplayName }}</p>    
                            </div>
                            <small class="tw-text-sm text-grey-3 tw-italic dark:tw-text-[#9EC0DC]">
                                This is the name other users will see on your profile, comments and forum posts.
                            </small>
                        </div>
                    </div>
                    <!-- Display Name Modal -->
                    <EditDisplayNameModal v-if="showDisplayNameModal" @onCloseDisplayNameModal="handleShowDisplayNameModal" />
                </section>

                <!-- PROFILE PICTURE -->
                <section class="tw-flex tw-flex-row tw-px-0 md:tw-px-6 tw-py-6 tw-border-b tw-border-gray-300 dark:tw-border-[#223F57]">
                    <div class="tw-flex tw-flex-col tw-grow">
                        <div class="tw-flex tw-flex-row tw-mb-4 tw-flex-grow-0 tw-items-center" >
                            <h2 class="tw-font-bold dark:tw-text-white tw-text-xl">Profile Picture</h2>
                            <button class="tw-ml-auto tw-btn-primary tw-btn-circle tw-bg-transparent dark:hover:tw-bg-[#102230] hover:tw-bg-[#F5F5F6] tw-text-[#00101D] dark:tw-text-[#9EC0DC] tw-px-0" 
                                    @click="handleProfilePictureModal"
                            >
                                <musora-icon icon-name="pencil" class="tw-w-[21px]" />
                            </button>
                        </div>
                        <div class="tw-flex tw-flex-col">
                            <div class="tw-flex tw-flex-row tw-w-full tw-items-center tw-justify-center tw-flex-wrap lg:tw-flex-nowrap">
                                <div class="tw-flex tw-flex-col tw-bg-top tw-bg-cover tw-flex-shrink-0 tw-h-52 tw-w-52 tw-items-center tw-relative tw-rounded-full tw-mb-4 lg:tw-mb-0">
                                    <!-- Profile Image -->
                                    <template  v-if="userProfilePictureUrl">
                                        <img    
                                            class="tw-rounded-full tw-w-full tw-h-full"
                                            :src="userProfilePictureUrl"
                                            data-avatar-update="true"
                                        >
                                        <span @click="handleClearAvatar" class="tw-rounded-full clear-button">
                                            <i class="fas fa-times"></i>
                                        </span>
                                    </template>
                                    <!-- Default Image -->
                                    <svg v-else width="223" height="224" class="dark:tw-text-[#445F74] tw-text-[#232e30]" viewBox="0 0 223 224" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd" clip-rule="evenodd" d="M223 111.748C223 173.328 173.08 223.248 111.5 223.248C49.9203 223.248 0 173.328 0 111.748C0 50.1683 49.9203 0.248047 111.5 0.248047C173.08 0.248047 223 50.1683 223 111.748ZM139.375 69.9355C139.375 85.3305 126.895 97.8105 111.5 97.8105C96.1051 97.8105 83.625 85.3305 83.625 69.9355C83.625 54.5406 96.1051 42.0605 111.5 42.0605C126.895 42.0605 139.375 54.5406 139.375 69.9355ZM111.499 125.686C83.3796 125.686 59.15 142.34 48.1364 166.323C63.4718 184.112 86.1707 195.373 111.5 195.373C136.828 195.373 159.527 184.112 174.862 166.324C163.849 142.341 139.619 125.686 111.499 125.686Z" fill="currentColor"/>
                                    </svg>
                                </div>
                                <div class="tw-flex tw-flex-col tw-w-full tw-items-center tw-text-[#8c9698] dark:tw-text-[#9EC0DC] lg:tw-pr-[100px]">
                                    <p class="tw-text-sm">For best results upload a square photo.</p>
                                    <p class="tw-text-sm tw-italic">Max file size: <strong>15MB</strong></p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Profile Picture Name Modal -->
                    <ImageUploader
                        v-if="showProfilePictureModal"
                        modal-title="Upload Profile Picture"
                        :selfContained="true"
                        uploadServiceRoute="/user-management-system/picture/upload-from-s3-front-end"
                        successMessage="Your profile image has successfully uploaded"
                        fieldKey="profile_picture_url"
                        cropType="circle"
                        @uploadSuccess="handleUploadDone"
                        @uploadError="handleImageUploadError"
                        @onUploaderClose="handleProfilePictureModal"
                    />
                </section>

                <!-- ABOUT YOU -->
                <section class="tw-flex tw-flex-row tw-px-0 md:tw-px-6 tw-py-6 tw-border-b tw-border-gray-300 dark:tw-border-[#223F57]">
                    <div class="tw-flex tw-flex-col tw-grow">
                        <div class="tw-flex tw-flex-row tw-mb-4 tw-flex-grow-0 tw-items-center" >
                            <h2 class="tw-font-bold dark:tw-text-white tw-text-xl">About You</h2>
                            <button class="tw-ml-auto tw-btn-primary tw-btn-circle tw-bg-transparent dark:hover:tw-bg-[#102230] hover:tw-bg-[#F5F5F6] tw-text-[#00101D] dark:tw-text-[#9EC0DC] tw-px-0" 
                                    @click="handleShowAboutYouModal"
                            >
                                <musora-icon icon-name="pencil" class="tw-w-[21px]" />
                            </button>
                        </div>
                        <div class="tw-flex tw-flex-col tw-text-[#00101D] dark:tw-text-white">
                            <!-- Full Name -->
                            <div class="tw-flex tw-flex-row tw-mb-2 tw-w-full tw-items-center">
                                <h6 class="tw-font-bold tw-w-[200px] tw-flex-shrink-0">Full Name</h6>
                                <p>{{ userFullName }}</p>    
                            </div>
                            <!-- Country -->
                            <div class="tw-flex tw-flex-row tw-mb-2 tw-w-full tw-items-center">
                                <h6 class="tw-font-bold tw-w-[200px] tw-flex-shrink-0">Country</h6>
                                <p>{{ userCountry }}</p>    
                            </div>
                            <!-- Birthday -->
                            <div class="tw-flex tw-flex-row tw-mb-2 tw-w-full tw-items-center">
                                <h6 class="tw-font-bold tw-w-[200px] tw-flex-shrink-0">Birthday</h6>
                                <p>{{ userBirthdayFormatted }}</p>    
                            </div>
                            <!-- Birthday -->
                            <div class="tw-flex tw-flex-col tw-mb-2 tw-w-full">
                                <h6 class="tw-font-bold tw-mb-2">Biography</h6>
                                <p class="tw-whitespace-pre-line" v-html="userBiography"></p>    
                            </div>
                        </div>
                    </div>
                    <!-- Profile Picture Name Modal -->
                    <EditAboutYouModal v-if="showAboutYouModal" :country-list="countryList" @onCloseAboutYouModal="handleShowAboutYouModal" />
                </section>

                <!-- GEAR INFO -->
                <section class="tw-flex tw-flex-row tw-px-0 md:tw-px-6 tw-py-6 tw-border-b tw-border-gray-300 dark:tw-border-[#223F57]">
                    <div class="tw-flex tw-flex-col tw-grow">
                        <div class="tw-flex tw-flex-row tw-mb-4 tw-flex-grow-0 tw-items-center" >
                            <h2 class="tw-font-bold tw-text-[#00101D] dark:tw-text-white tw-text-xl">Gear Info</h2>
                        </div>
                        <div class="tw-grid tw-grid-cols-1 tw-gap-6 md:tw-grid-cols-2 md:tw-gap-8">
                                
                            <!-- Drums -->
                            <div class="tw-flex tw-flex-col tw-mb-4 tw-flex-grow-0 tw-text-[#00101D] dark:tw-text-white" >
                                <div class="tw-flex tw-items-center tw-mb-2">
                                    <h5 class="tw-font-bold tw-text-lg">My Drum Gear</h5>
                                    <button class="tw-ml-auto sm:tw-ml-4 tw-btn-primary tw-btn-circle tw-bg-transparent dark:hover:tw-bg-[#102230] hover:tw-bg-[#F5F5F6] tw-text-[#00101D] dark:tw-text-[#9EC0DC] tw-px-0" @click="handleShowDrumGearModal">
                                        <musora-icon icon-name="pencil" class="tw-w-[21px]" />
                                    </button>
                                </div>
                                <div class="tw-flex tw-flex-row tw-mb-2 tw-w-full tw-items-center">
                                    <h6 class="tw-font-bold tw-w-[200px] tw-flex-shrink-0">Playing Drums Since</h6>
                                    <p>{{ userDrummingSince }}</p>    
                                </div>
                                <div class="tw-flex tw-flex-row tw-mb-2 tw-w-full tw-items-center">
                                    <h6 class="tw-font-bold tw-w-[200px] tw-flex-shrink-0">My Drums</h6>
                                    <p>{{ userDrumBrands }}</p>    
                                </div>
                                <div class="tw-flex tw-flex-row tw-mb-2 tw-w-full tw-items-center">
                                    <h6 class="tw-font-bold tw-w-[200px] tw-flex-shrink-0">My Cymbals</h6>
                                    <p>{{ userCymbalBrands }}</p>    
                                </div>
                                <div class="tw-flex tw-flex-row tw-mb-2 tw-w-full tw-items-center">
                                    <h6 class="tw-font-bold tw-w-[200px] tw-flex-shrink-0">My Hardware</h6>
                                    <p>{{ userHardwareBrands }}</p>    
                                </div>
                                <div class="tw-flex tw-flex-row tw-mb-2 tw-w-full tw-items-center">
                                    <h6 class="tw-font-bold tw-w-[200px] tw-flex-shrink-0">My Sticks</h6>
                                    <p>{{ userStickBrands }}</p>    
                                </div>
                            </div>
                            <!-- Edit Drum Gear -->
                            <EditDrumGearModal v-if="showDrumGearModal" :country-list="countryList" @onCloseDrumGearModal="handleShowDrumGearModal" />

                            <!-- Piano -->
                            <div class="tw-flex tw-flex-col tw-mb-4 tw-flex-grow-0 tw-text-[#00101D] dark:tw-text-white" >
                                <div class="tw-flex tw-items-center tw-mb-2">
                                    <h5 class="tw-font-bold tw-text-lg">My Piano Gear</h5>
                                    <button class="tw-ml-auto sm:tw-ml-4 tw-btn-primary tw-btn-circle tw-bg-transparent dark:hover:tw-bg-[#102230] hover:tw-bg-[#F5F5F6] tw-text-[#00101D] dark:tw-text-[#9EC0DC] tw-px-0" @click="handleShowPianoGearModal">
                                        <musora-icon icon-name="pencil" class="tw-w-[21px]" />
                                    </button>
                                </div>
                                <div class="tw-flex tw-flex-row tw-mb-2 tw-w-full tw-items-center">
                                    <h6 class="tw-font-bold tw-w-[200px] tw-flex-shrink-0">Playing Piano Since</h6>
                                    <p>{{ userPlayingPianoSince }}</p>    
                                </div>
                                <div class="tw-flex tw-flex-row tw-mb-2 tw-w-full tw-items-center">
                                    <h6 class="tw-font-bold tw-w-[200px] tw-flex-shrink-0">My Piano</h6>
                                    <p>{{ userPianoBrands }}</p>    
                                </div>
                                <div class="tw-flex tw-flex-row tw-mb-2 tw-w-full tw-items-center">
                                    <h6 class="tw-font-bold tw-w-[200px] tw-flex-shrink-0">My Keyboard</h6>
                                    <p>{{ userKeyboardBrands }}</p>    
                                </div>
                            </div>

                            <!-- Edit Piano Gear -->
                            <EditPianoGearModal v-if="showPianoGearModal" :country-list="countryList" @onClosePianoGearModal="handleShowPianoGearModal" />

                            <!-- Guitar -->
                            <div class="tw-flex tw-flex-col tw-mb-4 tw-flex-grow-0 tw-text-[#00101D] dark:tw-text-white" >
                                <div class="tw-flex tw-items-center tw-mb-2">
                                    <h5 class="tw-font-bold tw-text-lg">My Guitar Gear</h5>
                                    <button class="tw-ml-auto sm:tw-ml-4 tw-btn-primary tw-btn-circle tw-bg-transparent dark:hover:tw-bg-[#102230] hover:tw-bg-[#F5F5F6] tw-text-[#00101D] dark:tw-text-[#9EC0DC] tw-px-0" @click="handleShowGuitarGearModal">
                                        <musora-icon icon-name="pencil" class="tw-w-[21px]" />
                                    </button>
                                </div>
                                <div class="tw-flex tw-flex-row tw-mb-2 tw-w-full tw-items-center">
                                    <h6 class="tw-font-bold tw-w-[200px] tw-flex-shrink-0">Playing Guitar Since</h6>
                                    <p>{{ userPlayingGuitarSince }}</p>    
                                </div>
                                <div class="tw-flex tw-flex-row tw-mb-2 tw-w-full tw-items-center">
                                    <h6 class="tw-font-bold tw-w-[200px] tw-flex-shrink-0">My Guitars</h6>
                                    <p>{{ userGuitarBrands }}</p>    
                                </div>
                                <div class="tw-flex tw-flex-row tw-mb-2 tw-w-full tw-items-center">
                                    <h6 class="tw-font-bold tw-w-[200px] tw-flex-shrink-0">My Amps</h6>
                                    <p>{{ userAmpBrands }}</p>    
                                </div>
                                <div class="tw-flex tw-flex-row tw-mb-2 tw-w-full tw-items-center">
                                    <h6 class="tw-font-bold tw-w-[200px] tw-flex-shrink-0">My Pedals</h6>
                                    <p>{{ userPedalBrands }}</p>    
                                </div>
                                <div class="tw-flex tw-flex-row tw-mb-2 tw-w-full tw-items-center">
                                    <h6 class="tw-font-bold tw-w-[200px] tw-flex-shrink-0">My Strings</h6>
                                    <p>{{ userStringBrands }}</p>    
                                </div>
                            </div>

                            <!-- Edit Guitar Gear -->
                            <EditGuitarGearModal v-if="showGuitarGearModal" :country-list="countryList" @onCloseGuitarGearModal="handleShowGuitarGearModal" />

                            <!-- Singing -->
                            <div class="tw-flex tw-flex-col tw-mb-4 tw-flex-grow-0 tw-text-[#00101D] dark:tw-text-white" >
                                <div class="tw-flex tw-items-center tw-mb-2">
                                    <h5 class="tw-font-bold tw-text-lg">My Singing Gear</h5>
                                    <button class="tw-ml-auto sm:tw-ml-4 tw-btn-primary tw-btn-circle tw-bg-transparent dark:hover:tw-bg-[#102230] hover:tw-bg-[#F5F5F6] tw-text-[#00101D] dark:tw-text-[#9EC0DC] tw-px-0" @click="handleShowSingingGearModal">
                                        <musora-icon icon-name="pencil" class="tw-w-[21px]" />
                                    </button>
                                </div>
                                <div class="tw-flex tw-flex-row tw-mb-2 tw-w-full tw-items-center">
                                    <h6 class="tw-font-bold tw-w-[200px] tw-flex-shrink-0">Singing Since</h6>
                                    <p>{{ userSingingSince }}</p>    
                                </div>
                                <div class="tw-flex tw-flex-row tw-mb-2 tw-w-full tw-items-center">
                                    <h6 class="tw-font-bold tw-w-[200px] tw-flex-shrink-0">My Microphone</h6>
                                    <p>{{ userMicBrands }}</p>    
                                </div>
                            </div>

                            <!-- Edit Singing Gear -->
                            <EditSingingGearModal v-if="showSingingGearModal" :country-list="countryList" @onCloseSingingGearModal="handleShowSingingGearModal" />

                        </div>
                    </div>
                </section>

                <!-- GEAR PHOTOS -->
                <section class="tw-w-full tw-flex tw-flex-row tw-px-0 md:tw-px-6 tw-py-6 tw-border-b tw-border-gray-300 dark:tw-border-[#223F57]">
                    <div class="tw-w-full tw-flex tw-flex-col tw-grow">
                        <div class="tw-flex tw-flex-row tw-mb-4 tw-flex-grow-0 tw-items-center" >
                            <h2 class="tw-font-bold dark:tw-text-white tw-text-xl">Gear Photos</h2>
                        </div>
                        <div class="tw-w-[calc(100%+2rem)] md:tw-w-full tw-relative tw-flex tw-flex-nowrap tw-no-scrollbar tw-overflow-auto tw-px-4 tw--mx-4 md:tw-px-0 md:tw--mx-0 md:tw-grid md:tw-grid-cols-2 xl:tw-grid-cols-3 2xl:tw-grid-cols-4 tw-gap-3 md:tw-gap-4">
                            <!-- Drum Photos -->
                            <div class="tw-w-[253px] md:tw-w-full tw-flex-shrink-0 md:tw-flex-shrink tw-flex tw-items-center tw-justify-center tw-relative">
                                <button class="tw-flex tw-flex-col tw-items-center tw-w-full tw-justify-center tw-relative tw-aspect-[16/9] tw-bg-[#D4D4D8] tw-text-[#002039] dark:tw-bg-[#002039] dark:tw-text-[#80A0B9] tw-rounded-lg tw-border tw-border-transparent hover:tw-border-[#002039] dark:hover:tw-border-[#80A0B9] tw-transition tw-overflow-hidden"
                                    @click="handleDrumPictureModal"
                                >
                                    <div class="tw-flex tw-flex-col tw-justify-center tw-items-center">
                                        <musora-icon icon-name="drum-set" width="47" height="41" viewBox="0 0 47 41" />
                                        <p class="tw-text-sm tw-italic tw-mt-2 tw-text-center">Add a photo of your<br> drum gear</p>
                                    </div>
                                    <img v-if="userDrumPhoto" class="tw-w-full tw-absolute tw-top-0 tw-left-0 tw-object-center tw-object-cover "
                                        :src="userDrumPhoto"
                                        data-drumeo-gear-update="true"
                                    >
                                </button>
                                <span v-if="userDrumPhoto" class="rounded clear-button tw-top-1 tw-right-1" @click="handleClearGearPhoto('drums')">
                                    <i class="fas fa-times"></i>
                                </span>
                            </div>
                            <!-- Drum Picture Modal -->
                            <ImageUploader
                                v-if="showDrumPictureModal"
                                modal-title="Upload Drum Gear Photo"
                                :selfContained="true"
                                uploadServiceRoute="/user-management-system/picture/upload-from-s3-front-end"
                                successMessage="Your profile image has successfully uploaded"
                                fieldKey="drums_gear_photo"
                                cropType="rectangle"
                                @uploadSuccess="handleDrumsUploadDone"
                                @uploadError="handleImageUploadError"
                                @onUploaderClose="handleDrumPictureModal"
                            />
                            
                            <!-- Piano Photos -->
                            <div class="tw-w-[253px] md:tw-w-full tw-flex-shrink-0 md:tw-flex-shrink tw-flex tw-items-center tw-justify-center tw-relative">
                                <button class="tw-flex tw-flex-col tw-items-center tw-w-full tw-justify-center tw-relative tw-aspect-[16/9] tw-bg-[#D4D4D8] tw-text-[#002039] dark:tw-bg-[#002039] dark:tw-text-[#80A0B9] tw-rounded-lg tw-border tw-border-transparent hover:tw-border-[#002039] dark:hover:tw-border-[#80A0B9] tw-transition tw-overflow-hidden"
                                    @click="handlePianoPictureModal"
                                >
                                    <div class="tw-flex tw-flex-col tw-justify-center tw-items-center">
                                        <musora-icon icon-name="keyboard" width="40" height="32" viewBox="0 0 40 32" />
                                        <p class="tw-text-sm tw-italic tw-mt-2 tw-text-center">Add a photo of your<br> piano gear</p>
                                    </div>
                                    <img v-if="userPianoPhoto" class="tw-w-full tw-absolute tw-top-0 tw-left-0 tw-object-center tw-object-cover "
                                        :src="userPianoPhoto"
                                        data-drumeo-gear-update="true"
                                    >
                                </button>
                                <span v-if="userPianoPhoto" class="rounded clear-button tw-top-1 tw-right-1" @click="handleClearGearPhoto('piano')">
                                    <i class="fas fa-times"></i>
                                </span>
                            </div>
                            <!-- Piano Picture Modal -->
                            <ImageUploader
                                v-if="showPianoPictureModal"
                                modal-title="Upload Piano Gear Photo"
                                :selfContained="true"
                                uploadServiceRoute="/user-management-system/picture/upload-from-s3-front-end"
                                successMessage="Your profile image has successfully uploaded"
                                fieldKey="piano_gear_photo"
                                cropType="rectangle"
                                @uploadSuccess="handlePianoUploadDone"
                                @uploadError="handleImageUploadError"
                                @onUploaderClose="handlePianoPictureModal"
                            />
                            
                            <!-- Guitar Photos -->
                            <div class="tw-w-[253px] md:tw-w-full tw-flex-shrink-0 md:tw-flex-shrink tw-flex tw-items-center tw-justify-center tw-relative">
                                <button class="tw-flex tw-flex-col tw-items-center tw-w-full tw-justify-center tw-relative tw-aspect-[16/9] tw-bg-[#D4D4D8] tw-text-[#002039] dark:tw-bg-[#002039] dark:tw-text-[#80A0B9] tw-rounded-lg tw-border tw-border-transparent hover:tw-border-[#002039] dark:hover:tw-border-[#80A0B9] tw-transition tw-overflow-hidden"
                                    @click="handleGuitarPictureModal"
                                >
                                    <div class="tw-flex tw-flex-col tw-justify-center tw-items-center">
                                        <musora-icon icon-name="electric-guitar" width="50" height="50" />
                                        <p class="tw-text-sm tw-italic tw-mt-2 tw-text-center">Add a photo of your<br> guitar gear</p>
                                    </div>
                                    <img v-if="userGuitarPhoto" class="tw-w-full tw-absolute tw-top-0 tw-left-0 tw-object-center tw-object-cover "
                                        :src="userGuitarPhoto"
                                        data-drumeo-gear-update="true"
                                    >
                                </button>
                                <span v-if="userGuitarPhoto" class="rounded clear-button tw-top-1 tw-right-1" @click="handleClearGearPhoto('guitar')">
                                    <i class="fas fa-times"></i>
                                </span>
                            </div>
                            <!-- Guitar Picture Modal -->
                            <ImageUploader
                                v-if="showGuitarPictureModal"
                                modal-title="Upload Guitar Gear Photo"
                                :selfContained="true"
                                uploadServiceRoute="/user-management-system/picture/upload-from-s3-front-end"
                                successMessage="Your profile image has successfully uploaded"
                                fieldKey="guitar_gear_photo"
                                cropType="rectangle"
                                @uploadSuccess="handleGuitarUploadDone"
                                @uploadError="handleImageUploadError"
                                @onUploaderClose="handleGuitarPictureModal"
                            />

                            <!-- Singing Photos -->
                            <div class="tw-w-[253px] md:tw-w-full tw-flex-shrink-0 md:tw-flex-shrink tw-flex tw-items-center tw-justify-center tw-relative">
                                <button class="tw-flex tw-flex-col tw-items-center tw-w-full tw-justify-center tw-relative tw-aspect-[16/9] tw-bg-[#D4D4D8] tw-text-[#002039] dark:tw-bg-[#002039] dark:tw-text-[#80A0B9] tw-rounded-lg tw-border tw-border-transparent hover:tw-border-[#002039] dark:hover:tw-border-[#80A0B9] tw-transition tw-overflow-hidden"
                                    @click="handleSingingPictureModal"
                                >
                                    <div class="tw-flex tw-flex-col tw-justify-center tw-items-center">
                                        <musora-icon icon-name="mic" width="30" height="47" viewBox="0 0 30 47" />
                                        <p class="tw-text-sm tw-italic tw-mt-2 tw-text-center">Add a photo of your<br> singing gear</p>
                                    </div>
                                    <img v-if="userSingingPhoto" 
                                        class="tw-w-full tw-absolute tw-top-0 tw-left-0 tw-object-center tw-object-cover "
                                        :src="userSingingPhoto"
                                        ta-ddarumeo-gear-update="true"
                                    >
                                </button>
                                <span v-if="userSingingPhoto" class="rounded clear-button tw-top-1 tw-right-1" @click="handleClearGearPhoto('singing')">
                                    <i class="fas fa-times"></i>
                                </span>
                            </div>
                            <!-- Singing Picture Modal -->
                            <ImageUploader
                                v-if="showSingingPictureModal"
                                modal-title="Upload Singing Gear Photo"
                                :selfContained="true"
                                uploadServiceRoute="/user-management-system/picture/upload-from-s3-front-end"
                                successMessage="Your profile image has successfully uploaded"
                                fieldKey="singing_gear_photo"
                                cropType="rectangle"
                                @uploadSuccess="handleSingingUploadDone"
                                @uploadError="handleImageUploadError"
                                @onUploaderClose="handleSingingPictureModal"
                            />

                        </div>
                        <p class="tw-text-sm text-grey-3 tw-italic tw-mt-3 dark:tw-text-[#9EC0DC]">
                            For best results upload photo larger than 1280x720px
                            <br>Max file size: <span class="tw-font-bold">15MB</span>
                        </p>
                    </div>
                </section>

                <!-- FORUM SIGNATURE -->
                <section class="tw-flex tw-px-0 md:tw-px-6 tw-py-6 tw-mb-10">
                    <div class="tw-flex tw-flex-col tw-grow">
                        <div class="tw-flex tw-flex-row tw-mb-4 tw-flex-grow-0 tw-items-center" >
                            <h2 class="tw-capitalize tw-font-bold dark:tw-text-white tw-text-xl">{{ brand }} Forum Signature</h2>
                            <button class="tw-ml-auto tw-btn-primary tw-btn-circle tw-bg-transparent dark:hover:tw-bg-[#102230] hover:tw-bg-[#F5F5F6] tw-text-[#00101D] dark:tw-text-[#9EC0DC] tw-px-0" 
                                    @click="handleSignatureModal"
                            >
                                <musora-icon icon-name="pencil" class="tw-w-[21px]" />
                            </button>
                        </div>
                        <div class="tw-flex tw-flex-col tw-text-[#00101D] dark:tw-text-white tw-break-words">
                            <p v-if="userSignature" v-html="userSignature"></p>
                            <p class="tw-text-sm text-grey-3 tw-italic tw-mt-3 dark:tw-text-[#9EC0DC]">
                                This will appear below your posts on the forums page.
                            </p>
                        </div>
                    </div>
                </section>
                <!-- Display Name Modal -->
                <EditSignatureModal v-if="showSignatureModal" @onCloseSignatureModal="handleSignatureModal" />                

            </div>
        </div>
    </div>
</template>
<script setup>
    import { watch, ref, onBeforeMount } from "vue";
    import MusoraIcon from '../../components/MusoraIcons/MusoraIcon.vue';
    import { storeToRefs } from "pinia/dist/pinia";
    import { useUserStore } from "../../../stores/user";
    import Breadcrumb from '../../components/Breadcrumb/Breadcrumb';
    import PageHeader from '../../components/PageHeader/PageHeader';
    import PillNav from "../../components/PillNav/PillNav.vue";
    import EditDisplayNameModal from "../../components/Modal/EditDisplayNameModal.vue";
    import EditSignatureModal from "../../components/Modal/EditSignatureModal.vue";
    import ImageUploader from "../../components/ImageUploader/ImageUploader.vue";
    import EditAboutYouModal from "../../components/Modal/EditAboutYouModal.vue";
    import EditDrumGearModal from "../../components/Modal/EditDrumGearModal.vue";
    import EditPianoGearModal from "../../components/Modal/EditPianoGearModal.vue";
    import EditGuitarGearModal from "../../components/Modal/EditGuitarGearModal.vue";
    import EditSingingGearModal from "../../components/Modal/EditSingingGearModal.vue";

    //Pinia
    const userStore = useUserStore();
    const { 
        brand, 
        userId, 
        userDisplayName, 
        userFullName,
        userCountry,
        userBirthdayFormatted,
        userBiography,
        userProfilePictureUrl, 
        userCreatedYear, 
        userCompletedAccount,
        userDrumPhoto,
        userDrummingSince,
        userDrumBrands,
        userCymbalBrands,
        userHardwareBrands,
        userStickBrands,
        userPlayingPianoSince,
        userPianoPhoto,
        userPianoBrands,
        userKeyboardBrands,
        userGuitarPhoto,
        userPlayingGuitarSince,
        userGuitarBrands,
        userAmpBrands,
        userPedalBrands,
        userStringBrands,
        userSingingPhoto,
        userSingingSince,
        userMicBrands,
        userSignature
    } = storeToRefs(userStore);   

    //Props
    const props = defineProps({
        userForumSignature: String,
        countryList: Array,
    })

    //Computed

    //Refs
    const accountPages = ref([
        {
            name: 'Profile',
            url: `/${brand.value}/profile/${userId.value}/settings/profile`,
            isActive: true,
        }, 
        {
            name: 'Login Credentials',
            url: `/${brand.value}/profile/${userId.value}/settings/login-credentials`,
        },
        {
            name: 'Payments',
            url: `/${brand.value}/profile/${userId.value}/settings/payments`,
        },
        {
            name: 'Notification Settings',
            url: `/${brand.value}/profile/${userId.value}/settings/notifications`,
        },
        {
            name: 'Account Details',
            url: `/${brand.value}/profile/settings/account`,
        }
    ]);

    const showDisplayNameModal = ref(false);
    const showProfilePictureModal = ref(false);
    const showAboutYouModal = ref(false);
    const showDrumGearModal = ref(false);
    const showPianoGearModal = ref(false);
    const showGuitarGearModal = ref(false);
    const showSingingGearModal = ref(false);
    const showDrumPictureModal = ref(false);
    const showPianoPictureModal = ref(false);
    const showGuitarPictureModal = ref(false);
    const showSingingPictureModal = ref(false);
    const showSignatureModal = ref(false);
    
    //Methods

    //Modals
    const handleShowDisplayNameModal = () => {
        showDisplayNameModal.value = !showDisplayNameModal.value;
    };
    const handleProfilePictureModal = () => {
        showProfilePictureModal.value = !showProfilePictureModal.value;
    }
    const handleShowAboutYouModal = () => {
        showAboutYouModal.value = !showAboutYouModal.value;
    }
    const handleShowDrumGearModal = () => {
        showDrumGearModal.value = !showDrumGearModal.value;
    }
    const handleDrumPictureModal = () => {
        showDrumPictureModal.value = !showDrumPictureModal.value;
    }
    const handleShowPianoGearModal = () => {
        showPianoGearModal.value = !showPianoGearModal.value;
    }
    const handlePianoPictureModal = () => {
        showPianoPictureModal.value = !showPianoPictureModal.value;
    }
    const handleShowGuitarGearModal = () => {
        showGuitarGearModal.value = !showGuitarGearModal.value;
    }
    const handleGuitarPictureModal = () => {
        showGuitarPictureModal.value = !showGuitarPictureModal.value;
    }
    const handleShowSingingGearModal = () => {
        showSingingGearModal.value = !showSingingGearModal.value;
    }
    const handleSingingPictureModal = () => {
        showSingingPictureModal.value = !showSingingPictureModal.value;
    }
    const handleSignatureModal = () => {
        showSignatureModal.value = !showSignatureModal.value;
    }

    //Image Upload logic should be moved Pinia in the future
    const handleUploadDone = ({ profile_picture_url }) => {
        userStore.setUserProfilePictureUrl(profile_picture_url) //Update Pinia
        showProfilePictureModal.value = false; //Close Modal
    }

    //Drums
    const handleDrumsUploadDone = ({ drums_gear_photo }) => {
        userStore.setDrumsPictureUrl(drums_gear_photo) //Update Pinia
        showDrumPictureModal.value = false; //Close Modal
    }
    //Piano
    const handlePianoUploadDone = ({piano_gear_photo}) => {
        userStore.setPianoPictureUrl(piano_gear_photo) //Update Pinia
        showPianoPictureModal.value = false; //Close Modal
    }
    //Guitars
    const handleGuitarUploadDone = ({guitar_gear_photo}) => {
        userStore.setGuitarPictureUrl(guitar_gear_photo) //Update Pinia
        showGuitarPictureModal.value = false; //Close Modal
    }
    //Singing
    const handleSingingUploadDone = ({singing_gear_photo}) => {
        userStore.setSingingPictureUrl(singing_gear_photo) //Update Pinia
        showSingingPictureModal.value = false; //Close Modal
    }
    
    //Clear Avatar!
    const handleClearAvatar = () => {
        userStore.clearUserProfilePictureUrl();
    }
    //Clear Gear Photos
    const handleClearGearPhoto = (instrument) => {
        userStore.clearGearPictureUrl(instrument)         
    };

    //Handle All Image Upload Errors
    const handleImageUploadError = () => {
        window.shownotification({
            icon: 'error',
            text: 'Hmm, something has gone wrong. Your image could not be uploaded.'
        });
        showProfilePictureModal.value = false;
        showDrumPictureModal.value = false;
        showPianoPictureModal.value = false;
        showGuitarPictureModal.value = false;
        showSingingPictureModal.value = false;
    }

    watch(
        () => props.userForumSignature,
        (userForumSignature) => {
            userStore.setUserSignature(userForumSignature)
        },
        { immediate: true }
    )

    //Lifecycle Hooks
    onBeforeMount( ()=> {
        //console.log('country list', props.countryList)
    })  
</script>