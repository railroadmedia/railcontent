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
                        text: `${userCompletedAccount.value ? 'Update Your Account' : 'Complete Your Account'}`,
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

                <h1 class="tw-text-2xl tw-font-bold tw-text-[#00101D] dark:tw-text-white tw-mt-10 tw-mb-2">Profile Settings</h1>

                <!-- DISPLAY NAME -->
                <section class="tw-flex tw-flex-row tw-p-6 tw-border-b tw-border-gray-300 dark:tw-border-[#223F57]">
                    <div class="tw-flex tw-flex-col tw-grow">
                        <div class="tw-flex tw-flex-row tw-mb-4 tw-flex-grow-0" >
                            <h2 class="tw-font-bold dark:tw-text-white tw-text-xl">Display Name</h2>
                            <button class="tw-ml-auto tw-btn-secondary tw-btn-small tw-mb-0 tw-text-[#00101D] dark:tw-text-[#9EC0DC] tw-text-lg tw-px-4" 
                                    @click="handleShowDisplayNameModal"
                            >Edit</button>
                        </div>
                        <div class="tw-flex tw-flex-col">
                            <div class="tw-flex tw-flex-row tw-mb-2 tw-items-center tw-w-full tw-text-[#00101D] dark:tw-text-white">
                                <h6 class="tw-font-bold tw-w-[200px]">Display Name</h6>
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
                <section class="tw-flex tw-flex-row tw-p-6 tw-border-b tw-border-gray-300 dark:tw-border-[#223F57]">
                    <div class="tw-flex tw-flex-col tw-grow">
                        <div class="tw-flex tw-flex-row tw-mb-4 tw-flex-grow-0" >
                            <h2 class="tw-font-bold dark:tw-text-white tw-text-xl">Profile Picture</h2>
                            <button class="tw-ml-auto tw-btn-secondary tw-btn-small tw-mb-0 tw-text-[#00101D] dark:tw-text-[#9EC0DC] tw-text-lg tw-px-4" 
                                    @click="handleProfilePictureModal"
                            >Edit</button>
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
                                        <span id="clearAvatar" class="tw-rounded-full clear-button">
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
                <section class="tw-flex tw-flex-row tw-p-6 tw-border-b tw-border-gray-300 dark:tw-border-[#223F57]">
                    <div class="tw-flex tw-flex-col tw-grow">
                        <div class="tw-flex tw-flex-row tw-mb-4 tw-flex-grow-0" >
                            <h2 class="tw-font-bold dark:tw-text-white tw-text-xl">About You</h2>
                            <button class="tw-ml-auto tw-btn-secondary tw-btn-small tw-mb-0 tw-text-[#00101D] dark:tw-text-[#9EC0DC] tw-text-lg tw-px-4" 
                                    @click="handleShowAboutYouModal"
                            >Edit</button>
                        </div>
                        <div class="tw-flex tw-flex-col tw-text-[#00101D] dark:tw-text-white">
                            <!-- Full Name -->
                            <div class="tw-flex tw-flex-row tw-mb-2 tw-w-full tw-items-center">
                                <h6 class="tw-font-bold tw-w-[200px]">Full Name</h6>
                                <p>{{ userFullName }}</p>    
                            </div>
                            <!-- Country -->
                            <div class="tw-flex tw-flex-row tw-mb-2 tw-w-full tw-items-center">
                                <h6 class="tw-font-bold tw-w-[200px]">Country</h6>
                                <p>{{ userCountry }}</p>    
                            </div>
                            <!-- Birthday -->
                            <div class="tw-flex tw-flex-row tw-mb-2 tw-w-full tw-items-center">
                                <h6 class="tw-font-bold tw-w-[200px]">Birthday</h6>
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
                <section class="tw-flex tw-flex-row tw-p-6 tw-border-b tw-border-gray-300 dark:tw-border-[#223F57]">
                    <div class="tw-flex tw-flex-col tw-grow">
                        <div class="tw-flex tw-flex-row tw-mb-4 tw-flex-grow-0" >
                            <h2 class="tw-font-bold tw-text-[#00101D] dark:tw-text-white tw-text-xl">Gear Info</h2>
                        </div>
                        <div class="tw-grid tw-grid-cols-1 tw-gap-6 sm:tw-grid-cols-2 sm:tw-gap-8">
                                
                            <!-- Drums -->
                            <div class="tw-flex tw-flex-col tw-mb-4 tw-flex-grow-0 tw-text-[#00101D] dark:tw-text-white" >
                                <div class="tw-flex tw-items-center tw-mb-2">
                                    <h5 class="tw-font-bold tw-text-xl">My Drum Gear</h5>
                                    <button class="tw-ml-4" @click="handleShowDrumGearModal">
                                        <i class="tw-text-lg fas fa-edit" aria-hidden="true"></i>
                                    </button>
                                </div>
                                <div class="tw-flex tw-flex-row tw-mb-2 tw-w-full tw-items-center">
                                    <h6 class="tw-font-bold tw-w-[200px]">Playing Drums Since</h6>
                                    <p>{{ userDrummingSince }}</p>    
                                </div>
                                <div class="tw-flex tw-flex-row tw-mb-2 tw-w-full tw-items-center">
                                    <h6 class="tw-font-bold tw-w-[200px]">My Drums</h6>
                                    <p>{{ userDrumBrands }}</p>    
                                </div>
                                <div class="tw-flex tw-flex-row tw-mb-2 tw-w-full tw-items-center">
                                    <h6 class="tw-font-bold tw-w-[200px]">My Cymbals</h6>
                                    <p>{{ userCymbalBrands }}</p>    
                                </div>
                                <div class="tw-flex tw-flex-row tw-mb-2 tw-w-full tw-items-center">
                                    <h6 class="tw-font-bold tw-w-[200px]">My Hardware</h6>
                                    <p>{{ userHardwareBrands }}</p>    
                                </div>
                                <div class="tw-flex tw-flex-row tw-mb-2 tw-w-full tw-items-center">
                                    <h6 class="tw-font-bold tw-w-[200px]">My Sticks</h6>
                                    <p>{{ userStickBrands }}</p>    
                                </div>
                            </div>

                            <!-- Piano -->
                            <div class="tw-flex tw-flex-col tw-mb-4 tw-flex-grow-0 tw-text-[#00101D] dark:tw-text-white" >
                                <div class="tw-flex tw-items-center tw-mb-2">
                                    <h5 class="tw-font-bold tw-text-xl">My Piano Gear</h5>
                                    <button class="tw-ml-4" @click="handleShowPianoGearModal">
                                        <i class="tw-text-lg fas fa-edit" aria-hidden="true"></i>
                                    </button>
                                </div>
                                <div class="tw-flex tw-flex-row tw-mb-2 tw-w-full tw-items-center">
                                    <h6 class="tw-font-bold tw-w-[200px]">Playing Piano Since</h6>
                                    <p>{{ userPlayingPianoSince }}</p>    
                                </div>
                                <div class="tw-flex tw-flex-row tw-mb-2 tw-w-full tw-items-center">
                                    <h6 class="tw-font-bold tw-w-[200px]">My Piano</h6>
                                    <p>{{ userPianoBrands }}</p>    
                                </div>
                                <div class="tw-flex tw-flex-row tw-mb-2 tw-w-full tw-items-center">
                                    <h6 class="tw-font-bold tw-w-[200px]">My Keyboard</h6>
                                    <p>{{ userKeyboardBrands }}</p>    
                                </div>
                            </div>

                            <!-- Guitar -->
                            <div class="tw-flex tw-flex-col tw-mb-4 tw-flex-grow-0 tw-text-[#00101D] dark:tw-text-white" >
                                <div class="tw-flex tw-items-center tw-mb-2">
                                    <h5 class="tw-font-bold tw-text-xl">My Guitar Gear</h5>
                                    <button class="tw-ml-4" @click="handleShowGuitarGearModal">
                                        <i class="tw-text-lg fas fa-edit" aria-hidden="true"></i>
                                    </button>
                                </div>
                                <div class="tw-flex tw-flex-row tw-mb-2 tw-w-full tw-items-center">
                                    <h6 class="tw-font-bold tw-w-[200px]">Playing Guitar Since</h6>
                                    <p>{{ userPlayingGuitarSince }}</p>    
                                </div>
                                <div class="tw-flex tw-flex-row tw-mb-2 tw-w-full tw-items-center">
                                    <h6 class="tw-font-bold tw-w-[200px]">My Guitars</h6>
                                    <p>{{ userGuitarBrands }}</p>    
                                </div>
                                <div class="tw-flex tw-flex-row tw-mb-2 tw-w-full tw-items-center">
                                    <h6 class="tw-font-bold tw-w-[200px]">My Amps</h6>
                                    <p>{{ userAmpBrands }}</p>    
                                </div>
                                <div class="tw-flex tw-flex-row tw-mb-2 tw-w-full tw-items-center">
                                    <h6 class="tw-font-bold tw-w-[200px]">My Pedals</h6>
                                    <p>{{ userPedalBrands }}</p>    
                                </div>
                                <div class="tw-flex tw-flex-row tw-mb-2 tw-w-full tw-items-center">
                                    <h6 class="tw-font-bold tw-w-[200px]">My Strings</h6>
                                    <p>{{ userStringBrands }}</p>    
                                </div>
                            </div>

                            <!-- Singing -->
                            <div class="tw-flex tw-flex-col tw-mb-4 tw-flex-grow-0 tw-text-[#00101D] dark:tw-text-white" >
                                <div class="tw-flex tw-items-center tw-mb-2">
                                    <h5 class="tw-font-bold tw-text-xl">My Singing Gear</h5>
                                    <button class="tw-ml-4" @click="handleShowSingingGearModal">
                                        <i class="tw-text-lg fas fa-edit" aria-hidden="true"></i>
                                    </button>
                                </div>
                                <div class="tw-flex tw-flex-row tw-mb-2 tw-w-full tw-items-center">
                                    <h6 class="tw-font-bold tw-w-[200px]">Singing Since</h6>
                                    <p>{{ userSingingSince }}</p>    
                                </div>
                                <div class="tw-flex tw-flex-row tw-mb-2 tw-w-full tw-items-center">
                                    <h6 class="tw-font-bold tw-w-[200px]">My Microphone</h6>
                                    <p>{{ userMicBrands }}</p>    
                                </div>
                            </div>

                        </div>
                    </div>
                </section>

                <!-- GEAR PHOTOS -->
                <section class="tw-flex tw-flex-row tw-p-6 tw-border-b tw-border-gray-300 dark:tw-border-[#223F57]">
                    <div class="tw-flex tw-flex-col tw-grow">
                        <div class="tw-flex tw-flex-row tw-mb-4 tw-flex-grow-0" >
                            <h2 class="tw-font-bold dark:tw-text-white tw-text-xl">Gear Photos</h2>
                        </div>
                        <div class="tw-grid tw-grid-cols-1 sm:tw-grid-cols-2 lg:tw-grid-cols-3 2xl:tw-grid-cols-4 tw-gap-4">
                            
                            <!-- Drum Photos -->
                            <div class="flex flex-row flex-wrap align-center tw-relative">
                                <button class="flex flex-column align-center tw-relative tw-aspect-[16/9] tw-bg-[#D4D4D8] tw-text-[#002039] dark:tw-bg-[#002039] dark:tw-text-[#80A0B9] tw-rounded-lg tw-border tw-border-transparent hover:tw-border-[#002039] dark:hover:tw-border-[#80A0B9] tw-transition tw-overflow-hidden">
                                    <div class="tw-flex tw-flex-col tw-justify-center tw-items-center">
                                        <svg width="47" height="41" viewBox="0 0 47 41" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M37.1446 24.719C37.1481 22.4284 36.5527 20.1754 35.4154 18.1752C34.278 16.175 32.6367 14.4945 30.6485 13.2946C28.6603 12.0946 26.3916 11.4153 24.0594 11.3215C21.7272 11.2278 19.4095 11.7227 17.3279 12.759C15.2463 13.7953 13.4705 15.3383 12.1702 17.2405C10.8699 19.1427 10.0887 21.3404 9.90118 23.6235C9.71369 25.9066 10.1262 28.1988 11.0994 30.2807C12.0725 32.3627 13.5736 34.1649 15.4593 35.5149L12.3138 39.1158L13.4642 40.0832L16.7379 36.336C18.7945 37.4993 21.1266 38.1117 23.5004 38.1117C25.8742 38.1117 28.2063 37.4993 30.263 36.336L33.5366 40.0832L34.687 39.1158L31.5416 35.5149C33.2761 34.2757 34.6877 32.6519 35.6612 30.7758C36.6348 28.8997 37.1428 26.8243 37.1437 24.719H37.1446ZM11.3731 24.719C11.371 21.9623 12.3432 19.2902 14.124 17.1581C15.9047 15.0261 18.3838 13.566 21.1388 13.0267C23.8937 12.4874 26.7539 12.9023 29.2321 14.2007C31.7102 15.4991 33.6527 17.6006 34.7287 20.147C35.8047 22.6935 35.9476 25.5273 35.1328 28.1655C34.3181 30.8037 32.5963 33.083 30.2608 34.615C27.9253 36.1469 25.1208 36.8367 22.325 36.5668C19.5293 36.2969 16.9155 35.0839 14.9291 33.1347C13.8022 32.0298 12.9081 30.7179 12.2979 29.2739C11.6878 27.83 11.3735 26.2822 11.3731 24.719Z" fill="currentColor"/>
                                            <path d="M23.5009 14.3056C21.0424 14.3026 18.659 15.1365 16.7569 16.6649C14.8548 18.1934 13.5518 20.3219 13.07 22.6877C12.5882 25.0534 12.9574 27.5098 14.1146 29.6383C15.2719 31.7668 17.1456 33.4356 19.4164 34.3601C21.6871 35.2847 24.2144 35.4079 26.5673 34.7086C28.9202 34.0093 30.9532 32.531 32.3196 30.5254C33.6861 28.5199 34.3015 26.1114 34.0609 23.7105C33.8203 21.3096 32.7386 19.0649 31.0002 17.359C29.0114 15.4063 26.3142 14.3081 23.5009 14.3056ZM23.5009 33.6447C21.3938 33.6468 19.3513 32.9318 17.7214 31.6216C16.0914 30.3113 14.975 28.4869 14.5624 26.4593C14.1498 24.4318 14.4665 22.3265 15.4586 20.5024C16.4507 18.6784 18.0568 17.2484 20.003 16.4563C21.9493 15.6641 24.1152 15.5588 26.1317 16.1584C28.1482 16.7579 29.8904 18.0251 31.0613 19.7441C32.2323 21.463 32.7595 23.5272 32.5531 25.5849C32.3467 27.6426 31.4195 29.5663 29.9295 31.0282C28.2248 32.7022 25.9125 33.6433 23.5009 33.6447Z" fill="currentColor"/>
                                            <path d="M44.7245 23.3682V5.81757C44.7999 5.74362 44.8761 5.67646 44.9515 5.6042C46.3609 4.22113 47.6482 2.25661 46.6407 1.26883C45.6332 0.281041 43.6321 1.54255 42.2227 2.92732C40.8133 4.31209 39.5269 6.27491 40.5335 7.2627C40.6529 7.37877 40.7951 7.46981 40.9515 7.53031C41.1078 7.59081 41.2751 7.61949 41.4431 7.61463C42.0778 7.56506 42.6874 7.34961 43.2085 6.99067V23.2271H40.1766V14.7433C40.2519 14.6694 40.3282 14.6022 40.4035 14.53C41.813 13.1469 43.1002 11.1832 42.0928 10.1946C41.0853 9.20597 39.0833 10.4683 37.6748 11.8522C36.2662 13.2362 34.9781 15.199 35.9855 16.1876C36.1049 16.3038 36.2471 16.3949 36.4035 16.4556C36.5598 16.5162 36.7271 16.5451 36.8951 16.5404C37.5306 16.4912 38.141 16.276 38.6632 15.9173V23.3682C38.2212 23.5212 37.8382 23.8046 37.5667 24.1796C37.2953 24.5546 37.1488 25.0028 37.1472 25.4628V28.438C37.147 28.8701 37.2746 29.2929 37.5147 29.6551C37.7547 30.0173 38.0969 30.3033 38.4995 30.4782C38.0351 30.9269 37.6747 31.4686 37.443 32.0664C37.2113 32.6642 37.1137 33.3039 37.1569 33.9421C37.2001 34.5802 37.383 35.2018 37.6931 35.7642C38.0033 36.3267 38.4335 36.8169 38.9543 37.2014L37.3239 39.1192L38.4891 40.0713L40.3325 37.9019C41.2207 38.1756 42.1731 38.1756 43.0613 37.9019L44.9021 40.0713L46.0681 39.1192L44.4369 37.1972C44.9574 36.8125 45.3874 36.3222 45.6974 35.7598C46.0074 35.1973 46.1902 34.5758 46.2334 33.9378C46.2765 33.2997 46.179 32.66 45.9475 32.0623C45.716 31.4646 45.3559 30.9228 44.8917 30.474C45.2941 30.2987 45.6361 30.0127 45.8763 29.6506C46.1165 29.2885 46.2445 28.8658 46.2448 28.4338V25.4585C46.2427 24.9987 46.096 24.5507 45.8247 24.1758C45.5533 23.8009 45.1706 23.5173 44.7288 23.3639L44.7245 23.3682ZM43.2934 3.97546C43.8932 3.34811 44.6105 2.84013 45.4063 2.47933C45.0381 3.26036 44.5201 3.96456 43.8808 4.55351C43.2805 5.18022 42.5632 5.68811 41.7679 6.04964C42.1361 5.26862 42.654 4.56442 43.2934 3.97546ZM38.7455 12.9012C39.3452 12.2739 40.0626 11.7659 40.8583 11.4051C40.4901 12.1861 39.9722 12.8903 39.3328 13.4793C38.7325 14.106 38.0153 14.6139 37.22 14.9754C37.5882 14.1944 38.1061 13.4902 38.7455 12.9012ZM41.6908 36.6183C40.9894 36.6182 40.3096 36.3795 39.7674 35.9428C39.2252 35.5061 38.8541 34.8984 38.7173 34.2233C38.5805 33.5482 38.6865 32.8474 39.0172 32.2403C39.3479 31.6333 39.8829 31.1576 40.5309 30.8942C41.179 30.6308 41.9001 30.5961 42.5713 30.7959C43.2426 30.9958 43.8224 31.4179 44.2121 31.9902C44.6018 32.5626 44.7772 33.2498 44.7084 33.9348C44.6396 34.6198 44.3309 35.2603 43.8348 35.747C43.2669 36.3051 42.4963 36.6192 41.6926 36.62L41.6908 36.6183ZM39.4169 29.1802C39.2158 29.1802 39.023 29.1018 38.8809 28.9623C38.7387 28.8228 38.6589 28.6336 38.6589 28.4363V25.4611C38.6589 25.2638 38.7387 25.0746 38.8809 24.9351C39.023 24.7956 39.2158 24.7173 39.4169 24.7173H43.9648C44.1657 24.7175 44.3584 24.7959 44.5005 24.9354C44.6426 25.0748 44.7225 25.2639 44.7228 25.4611V28.4363C44.7225 28.6335 44.6426 28.8226 44.5005 28.962C44.3584 29.1015 44.1657 29.1799 43.9648 29.1802H39.4169Z" fill="currentColor"/>
                                            <path d="M30.0949 11.553C31.1561 12.5944 32.5482 13.5617 33.6024 13.5617C33.7705 13.5664 33.9377 13.5375 34.0941 13.4769C34.2504 13.4163 34.3926 13.3251 34.512 13.209C35.5195 12.2203 34.2322 10.2541 32.8237 8.87359C31.4151 7.49307 29.4123 6.22816 28.4057 7.21594C27.3991 8.20373 28.6872 10.1733 30.0984 11.5556L30.0949 11.553ZM31.7547 9.92428C32.3934 10.5138 32.9107 11.2182 33.2784 11.9993C32.4822 11.6382 31.7642 11.13 31.1639 10.5023C30.525 9.91361 30.0077 9.20969 29.6401 8.429C30.4356 8.79058 31.1529 9.29879 31.7529 9.92598L31.7547 9.92428Z" fill="currentColor"/>
                                            <path d="M13.4001 13.5617C14.4544 13.5617 15.8491 12.591 16.9077 11.5539C18.3171 10.1699 19.6044 8.20628 18.5969 7.21849C17.5894 6.23071 15.5875 7.49137 14.1789 8.87529C12.7703 10.2592 11.4822 12.2229 12.4897 13.2107C12.6095 13.3271 12.7523 13.4183 12.9093 13.4787C13.0663 13.5391 13.2342 13.5673 13.4027 13.5617H13.4001ZM15.2479 9.92343C15.8478 9.29696 16.5652 8.78985 17.3607 8.42985C16.9925 9.21087 16.4746 9.91507 15.8352 10.504C15.2351 11.1309 14.5178 11.6388 13.7224 12.0002C14.0906 11.2191 14.6085 10.5149 15.2479 9.92598V9.92343Z" fill="currentColor"/>
                                            <path d="M8.3411 23.3682V15.9173C8.86166 16.2749 9.47044 16.4889 10.104 16.537C10.2721 16.5421 10.4394 16.5134 10.5959 16.4527C10.7523 16.3921 10.8944 16.3007 11.0136 16.1842C12.021 15.1964 10.7337 13.2302 9.32432 11.8488C7.9149 10.4675 5.91554 9.20682 4.90634 10.1955C3.89713 11.1841 5.18615 13.1495 6.59644 14.5308C6.67267 14.6048 6.74803 14.6728 6.82427 14.7442V23.233H3.79231V6.99662C4.31286 7.35422 4.92164 7.56822 5.55517 7.61633C5.72328 7.62138 5.89066 7.5927 6.04706 7.53204C6.20347 7.47137 6.3456 7.38001 6.46476 7.26355C7.47483 6.27746 6.18842 4.31209 4.77726 2.92817C3.36611 1.54425 1.36675 0.28189 0.35928 1.26883C-0.648194 2.25576 0.639086 4.22368 2.04938 5.6042C2.12561 5.67816 2.20097 5.74617 2.2772 5.81757V23.3716C1.83564 23.5245 1.45301 23.8076 1.18165 24.1821C0.910293 24.5565 0.763456 25.0041 0.76123 25.4636V28.4389C0.760631 28.871 0.888158 29.294 1.12826 29.6562C1.36837 30.0185 1.71068 30.3044 2.11348 30.4791C1.64906 30.9278 1.28871 31.4695 1.05702 32.0672C0.825325 32.665 0.727735 33.3048 0.770903 33.9429C0.81407 34.5811 0.996981 35.2026 1.30716 35.7651C1.61734 36.3276 2.04749 36.8178 2.56827 37.2023L0.940549 39.1192L2.10568 40.0713L3.94911 37.9019C4.83731 38.1756 5.78966 38.1756 6.67787 37.9019L8.51869 40.0713L9.68469 39.1192L8.0535 37.1972C8.57404 36.8125 9.00396 36.3222 9.31397 35.7598C9.62398 35.1973 9.80679 34.5758 9.84995 33.9378C9.89312 33.2997 9.79561 32.66 9.56409 32.0623C9.33256 31.4645 8.97245 30.9228 8.50829 30.474C8.91072 30.2987 9.25273 30.0127 9.49289 29.6506C9.73305 29.2885 9.86106 28.8658 9.86141 28.4338V25.4585C9.85934 24.9987 9.71261 24.5507 9.44126 24.1758C9.16992 23.8009 8.7872 23.5173 8.34544 23.3639L8.3411 23.3682ZM6.14251 11.4051C6.93854 11.7662 7.65619 12.2745 8.25621 12.9021C8.89504 13.491 9.41263 14.1949 9.78085 14.9754C8.98482 14.6143 8.26717 14.106 7.66715 13.4784C7.02804 12.8898 6.51041 12.1858 6.14251 11.4051ZM1.59458 2.47933C2.39216 2.83997 3.11132 3.34826 3.71262 3.97631C4.35144 4.56523 4.86904 5.2691 5.23725 6.04964C4.44123 5.68853 3.72357 5.18027 3.12355 4.55266C2.48289 3.96436 1.96377 3.26041 1.59458 2.47933ZM5.30915 36.62C4.6077 36.6199 3.92796 36.3812 3.38576 35.9445C2.84356 35.5078 2.47244 34.9001 2.33564 34.225C2.19884 33.5499 2.30482 32.8491 2.63552 32.242C2.96623 31.635 3.50119 31.1593 4.14927 30.8959C4.79735 30.6325 5.51843 30.5978 6.18967 30.7976C6.86091 30.9975 7.44077 31.4196 7.83044 31.9919C8.22012 32.5643 8.3955 33.2515 8.32671 33.9365C8.25792 34.6215 7.9492 35.262 7.45318 35.7487C7.17161 36.0249 6.83735 36.2441 6.46948 36.3936C6.10161 36.5431 5.70733 36.62 5.30915 36.62ZM3.03519 29.1819C2.83416 29.1819 2.64136 29.1035 2.49921 28.964C2.35706 28.8245 2.2772 28.6353 2.2772 28.438V25.4628C2.2772 25.2655 2.35706 25.0763 2.49921 24.9368C2.64136 24.7973 2.83416 24.719 3.03519 24.719H7.58312C7.78408 24.7192 7.97674 24.7976 8.11884 24.9371C8.26094 25.0765 8.34088 25.2656 8.3411 25.4628V28.438C8.34088 28.6352 8.26094 28.8243 8.11884 28.9637C7.97674 29.1032 7.78408 29.1816 7.58312 29.1819H3.03519Z" fill="currentColor"/>
                                        </svg>
                                        <p class="tw-text-sm tw-italic tw-mt-2 tw-text-center">Add a photo of your<br> drum gear</p>
                                    </div>
                                    <img v-if="userDrumPhoto" class="tw-w-full tw-absolute tw-top-0 tw-left-0"
                                        :src="userDrumPhoto"
                                        data-drumeo-gear-update="true"
                                    >
                                </button>
                                <span v-if="userDrumPhoto" data-clear-gear-photo="drums" class="rounded clear-button tw-top-1 tw-right-1">
                                    <i class="fas fa-times"></i>
                                </span>
                            </div>
                            
                            <!-- Piano Photos -->
                            <div class="flex flex-row flex-wrap align-center tw-relative">
                                <button class="flex flex-column align-center tw-relative tw-aspect-[16/9] tw-bg-[#D4D4D8] tw-text-[#002039] dark:tw-bg-[#002039] dark:tw-text-[#80A0B9] tw-rounded-lg tw-border tw-border-transparent hover:tw-border-[#002039] dark:hover:tw-border-[#80A0B9] tw-transition tw-overflow-hidden"
                                >
                                    <div class="tw-flex tw-flex-col tw-justify-center tw-items-center">
                                        <svg width="40" height="32" viewBox="0 0 40 32" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path fill-rule="evenodd" clip-rule="evenodd" d="M2.58065 0.572266C1.15542 0.572266 0 1.72363 0 3.14369V28.858C0 30.278 1.15542 31.4294 2.58065 31.4294H37.4194C38.8446 31.4294 40 30.278 40 28.858V3.14369C40 1.72363 38.8446 0.572266 37.4194 0.572266H2.58065ZM3.87097 3.14369C3.15831 3.14369 2.58065 3.71938 2.58065 4.42941V13.4294H37.4194V4.42941C37.4194 3.71938 36.8417 3.14369 36.129 3.14369H3.87097ZM30.9677 16.0008V21.1437C30.9677 21.8537 31.5454 22.4294 32.2581 22.4294V28.858H28.3871V22.4294C29.0998 22.4294 29.6774 21.8537 29.6774 21.1437V16.0008H30.9677ZM33.5484 28.858H36.129C36.8417 28.858 37.4194 28.2823 37.4194 27.5723V16.0008H34.8387V21.1437C34.8387 21.8537 34.261 22.4294 33.5484 22.4294V28.858ZM23.2258 28.858H27.0968V22.4294C26.3841 22.4294 25.8064 21.8537 25.8064 21.1437V16.0008H24.5161V21.1437C24.5161 21.8537 23.9385 22.4294 23.2258 22.4294V28.858ZM21.9355 22.4294C21.2228 22.4294 20.6452 21.8537 20.6452 21.1437V16.0008H18.0645V28.858H21.9355V22.4294ZM12.9032 28.858H16.7742V16.0008H14.1935V21.1437C14.1935 21.8537 13.6159 22.4294 12.9032 22.4294V28.858ZM11.6129 22.4294C10.9002 22.4294 10.3226 21.8537 10.3226 21.1437V16.0008H9.03226V21.1437C9.03226 21.8537 8.45459 22.4294 7.74194 22.4294V28.858H11.6129V22.4294ZM3.87097 28.858H6.45161V22.4294C5.73896 22.4294 5.16129 21.8537 5.16129 21.1437V16.0008H2.58065V27.5723C2.58065 28.2823 3.15831 28.858 3.87097 28.858Z" fill="currentColor"/>
                                            <path fill-rule="evenodd" clip-rule="evenodd" d="M7.74194 5.71512C6.31671 5.71512 5.16129 6.86649 5.16129 8.28655C5.16129 9.70661 6.31671 10.858 7.74194 10.858C9.16716 10.858 10.3226 9.70661 10.3226 8.28655C10.3226 6.86649 9.16716 5.71512 7.74194 5.71512ZM7.74194 7.00084C7.02928 7.00084 6.45161 7.57652 6.45161 8.28655C6.45161 8.99658 7.02928 9.57227 7.74194 9.57227C8.45459 9.57227 9.03226 8.99658 9.03226 8.28655C9.03226 7.57652 8.45459 7.00084 7.74194 7.00084Z" fill="currentColor"/>
                                            <path d="M18.0645 8.28655C18.0645 7.57647 18.6422 7.00084 19.3548 7.00084H23.2258C23.9384 7.00084 24.5161 7.57647 24.5161 8.28655C24.5161 8.99663 23.9384 9.57227 23.2258 9.57227H19.3548C18.6422 9.57227 18.0645 8.99663 18.0645 8.28655Z" fill="currentColor"/>
                                            <path d="M25.8064 8.28655C25.8064 7.57647 26.3841 7.00084 27.0968 7.00084H29.6774C30.39 7.00084 30.9677 7.57647 30.9677 8.28655C30.9677 8.99663 30.39 9.57227 29.6774 9.57227H27.0968C26.3841 9.57227 25.8064 8.99663 25.8064 8.28655Z" fill="currentColor"/>
                                            <path d="M32.2581 8.28655C32.2581 7.57647 32.8358 7.00084 33.5484 7.00084C34.261 7.00084 34.8387 7.57647 34.8387 8.28655C34.8387 8.99663 34.261 9.57227 33.5484 9.57227C32.8358 9.57227 32.2581 8.99663 32.2581 8.28655Z" fill="currentColor"/>
                                        </svg>
                                        <p class="tw-text-sm tw-italic tw-mt-2 tw-text-center">Add a photo of your<br> piano gear</p>
                                    </div>
                                    <img v-if="userPianoPhoto" class="tw-w-full tw-absolute tw-top-0 tw-left-0"
                                        :src="userPianoPhoto"
                                        data-drumeo-gear-update="true"
                                    >
                                </button>
                                <span v-if="userPianoPhoto" data-clear-gear-photo="drums" class="rounded clear-button tw-top-1 tw-right-1">
                                    <i class="fas fa-times"></i>
                                </span>
                            </div>
                            
                            <!-- Guitar Photos -->
                            <div class="flex flex-row flex-wrap align-center tw-relative">
                                <button class="flex flex-column align-center tw-relative tw-aspect-[16/9] tw-bg-[#D4D4D8] tw-text-[#002039] dark:tw-bg-[#002039] dark:tw-text-[#80A0B9] tw-rounded-lg tw-border tw-border-transparent hover:tw-border-[#002039] dark:hover:tw-border-[#80A0B9] tw-transition tw-overflow-hidden"
                                >
                                    <div class="tw-flex tw-flex-col tw-justify-center tw-items-center">
                                        <svg width="27" height="50" viewBox="0 0 27 50" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M0.279364 42.8262C1.24193 47.5948 5.03621 49.9999 11.5534 49.9999C12.0918 49.9999 12.6468 49.9791 13.2266 49.9491C20.7721 50.3825 25.1241 47.9876 26.1744 42.8064C26.8307 39.2244 25.4638 36.8193 23.8891 34.4762C23.2114 33.4751 22.8937 32.3292 22.9923 31.256C23.0579 30.4937 23.2878 30.1101 23.6049 29.5938C24.1433 28.7167 24.8076 27.6221 24.7855 24.8044C24.7838 24.735 24.7764 24.6659 24.7634 24.5976C24.61 23.9167 24.2165 22.1208 22.2375 21.914C22.0907 21.8974 21.9419 21.9101 21.8007 21.9512C21.6594 21.9924 21.5289 22.0611 21.4176 22.1528C21.3045 22.2426 21.2115 22.3528 21.1439 22.4768C21.0764 22.6009 21.0356 22.7364 21.0241 22.8754C20.9476 23.9492 20.4443 24.7556 19.4381 25.4254C18.6726 25.9208 17.6664 26.2384 16.5402 26.3538H16.496V11.075L18.3662 8.22931C18.5034 8.00831 18.5465 7.7464 18.4868 7.49654L20.4222 7.03209C20.7038 6.96362 20.945 6.79239 21.0928 6.55605C21.2406 6.31971 21.2829 6.03763 21.2103 5.77186C21.1378 5.50608 20.9564 5.2784 20.706 5.13888C20.4556 4.99936 20.1568 4.95945 19.8752 5.02791L17.8634 5.51269L17.3385 3.92318L19.2518 3.45872C19.531 3.38842 19.7695 3.21684 19.9153 2.98135C20.0611 2.74586 20.1024 2.46553 20.0303 2.2014C19.9582 1.93728 19.7784 1.71076 19.5301 1.57116C19.2819 1.43156 18.9853 1.39019 18.7049 1.45607L16.6817 1.94136L16.4529 1.17912C16.4422 1.15829 16.4314 1.14813 16.4314 1.13796C16.4067 1.06765 16.3703 1.00145 16.3237 0.941814C16.2917 0.887874 16.2557 0.836088 16.2161 0.786826C16.167 0.740306 16.1128 0.69875 16.0546 0.662835C16.0007 0.619227 15.9421 0.581233 15.8796 0.549516C15.8217 0.521536 15.7587 0.504287 15.6939 0.4987C15.6199 0.473855 15.5424 0.459803 15.464 0.457031C15.4527 0.467194 15.4419 0.457031 15.4204 0.457031H11.0404C10.7507 0.457836 10.4731 0.566829 10.2682 0.760206C10.0633 0.953582 9.94787 1.21563 9.94702 1.4891V24.8659C9.14435 24.3237 8.48638 23.6127 8.02517 22.789C7.56396 21.9653 7.31217 21.0516 7.28973 20.1202L7.2359 17.9732C7.22984 17.7954 7.17659 17.6219 7.08103 17.4686C6.98546 17.3152 6.85064 17.187 6.68893 17.0956C6.52509 17.0094 6.34061 16.9641 6.15301 16.9641C5.96541 16.9641 5.78093 17.0094 5.61709 17.0956C5.39798 17.2095 3.7797 18.1902 3.61605 18.3035C1.35498 19.7386 0.46671 22.474 1.46265 24.9508C2.31593 27.0977 3.04863 29.016 3.40071 30.824C3.64135 32.0213 3.36733 33.2703 2.64702 34.3542C1.0169 36.7598 -0.382266 39.2061 0.284209 42.8288L0.279364 42.8262ZM12.1338 11.8083H14.3211V31.4196H12.1338V11.8083ZM14.6053 2.51812L16.2457 7.53466L14.8018 9.74362H12.1338V2.51812H14.6053ZM5.54225 30.4495C5.15949 28.4885 4.39396 26.4757 3.49653 24.2358C2.86236 22.6564 3.40932 20.9327 4.85263 20.014C4.88547 19.9932 4.97322 19.9418 5.09327 19.8692L5.10458 20.1893C5.13693 21.4501 5.48103 22.6864 6.10943 23.7994C6.73783 24.9124 7.63313 25.8713 8.72389 26.5997C9.11602 26.8548 9.52511 27.0858 9.94863 27.2913V32.4517C9.94906 32.7251 10.0641 32.9873 10.2687 33.1808C10.4733 33.3744 10.7507 33.4837 11.0404 33.4848H15.4139C15.7037 33.484 15.9813 33.375 16.1861 33.1816C16.391 32.9882 16.5065 32.7262 16.5073 32.4527V28.4159C16.5951 28.4057 16.6823 28.4159 16.7695 28.4057C18.2677 28.2609 19.6227 27.8173 20.7064 27.1155C21.549 26.5565 22.1934 25.8873 22.6203 25.1235C22.5982 27.1465 22.1718 27.8381 21.7234 28.5709C21.3519 29.1807 20.9255 29.8718 20.827 31.0995C20.6957 32.6067 21.1333 34.2068 22.0518 35.5901C23.7029 38.047 24.5013 39.8738 24.0313 42.4543C23.2108 46.5002 19.6895 48.2859 13.3036 47.9042H13.1615C6.74277 48.2859 3.24351 46.5007 2.43437 42.4746C1.95309 39.8423 2.75146 38.0572 4.48978 35.4864C5.50672 33.938 5.87872 32.1625 5.5401 30.4495H5.54225Z" fill="currentColor"/>
                                            <path d="M9.90287 39.6787H16.4632C16.7532 39.6787 17.0313 39.57 17.2363 39.3764C17.4414 39.1829 17.5566 38.9203 17.5566 38.6466C17.5566 38.3729 17.4414 38.1104 17.2363 37.9168C17.0313 37.7233 16.7532 37.6146 16.4632 37.6146H9.90287C9.61289 37.6146 9.33478 37.7233 9.12973 37.9168C8.92468 38.1104 8.80949 38.3729 8.80949 38.6466C8.80949 38.9203 8.92468 39.1829 9.12973 39.3764C9.33478 39.57 9.61289 39.6787 9.90287 39.6787Z" fill="currentColor"/>
                                            <path d="M9.90287 43.807H16.4632C16.7532 43.807 17.0313 43.6982 17.2363 43.5047C17.4414 43.3111 17.5566 43.0486 17.5566 42.7749C17.5566 42.5012 17.4414 42.2387 17.2363 42.0451C17.0313 41.8516 16.7532 41.7428 16.4632 41.7428H9.90287C9.61289 41.7428 9.33478 41.8516 9.12973 42.0451C8.92468 42.2387 8.80949 42.5012 8.80949 42.7749C8.80949 43.0486 8.92468 43.3111 9.12973 43.5047C9.33478 43.6982 9.61289 43.807 9.90287 43.807Z" fill="currentColor"/>
                                        </svg>
                                        <p class="tw-text-sm tw-italic tw-mt-2 tw-text-center">Add a photo of your<br> guitar gear</p>
                                    </div>
                                    <img v-if="userGuitarPhoto" class="tw-w-full tw-absolute tw-top-0 tw-left-0"
                                        :src="userGuitarPhoto"
                                        data-drumeo-gear-update="true"
                                    >
                                </button>
                                <span v-if="userGuitarPhoto" data-clear-gear-photo="drums" class="rounded clear-button tw-top-1 tw-right-1">
                                    <i class="fas fa-times"></i>
                                </span>
                            </div>

                            <!-- Singing Photos -->
                            <div class="flex flex-row flex-wrap align-center tw-relative">
                                <button class="flex flex-column align-center tw-relative tw-aspect-[16/9] tw-bg-[#D4D4D8] tw-text-[#002039] dark:tw-bg-[#002039] dark:tw-text-[#80A0B9] tw-rounded-lg tw-border tw-border-transparent hover:tw-border-[#002039] dark:hover:tw-border-[#80A0B9] tw-transition tw-overflow-hidden"
                                >
                                    <div class="tw-flex tw-flex-col tw-justify-center tw-items-center">
                                        <svg width="30" height="47" viewBox="0 0 30 47" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M11.0608 26.1112V24.2853C11.0608 24.0109 10.9456 23.7477 10.7406 23.5537C10.5356 23.3596 10.2576 23.2506 9.96773 23.2506C9.67784 23.2506 9.39982 23.3596 9.19484 23.5537C8.98985 23.7477 8.87469 24.0109 8.87469 24.2853V26.1112C8.87469 26.3856 8.98985 26.6488 9.19484 26.8429C9.39982 27.0369 9.67784 27.1459 9.96773 27.1459C10.2576 27.1459 10.5356 27.0369 10.7406 26.8429C10.9456 26.6488 11.0608 26.3856 11.0608 26.1112Z" fill="currentColor"/>
                                            <path d="M24.5624 22.077C23.123 22.0843 21.7448 22.6287 20.727 23.5922C19.7092 24.5556 19.134 25.8603 19.1264 27.2228V41.4461C19.119 42.2601 18.7742 43.0387 18.1662 43.6143C17.5582 44.19 16.7357 44.5165 15.8759 44.5235H14.3144C13.4544 44.5166 12.6318 44.1901 12.0237 43.6145C11.4156 43.0389 11.0707 42.2602 11.0634 41.4461V40.2927C12.1671 40.0657 13.1654 39.5111 13.913 38.7098C14.6607 37.9084 15.1186 36.902 15.22 35.8372L16.8591 17.0367C18.2828 15.7329 19.2627 14.0564 19.6732 12.222C20.0838 10.3876 19.9062 8.47893 19.1633 6.74068C18.4205 5.00243 17.1461 3.5138 15.5036 2.46561C13.8612 1.41741 11.9254 0.857422 9.94457 0.857422C7.9637 0.857422 6.02796 1.41741 4.38549 2.46561C2.74303 3.5138 1.46868 5.00243 0.725805 6.74068C-0.0170684 8.47893 -0.194615 10.3876 0.215924 12.222C0.626463 14.0564 1.60638 15.7329 3.03006 17.0367L4.6691 35.8372C4.77295 36.909 5.2379 37.9208 5.9954 38.7235C6.75289 39.5261 7.76283 40.0771 8.87626 40.2952V41.4284C8.8846 42.7908 9.46037 44.0951 10.4785 45.0581C11.4967 46.0211 12.8751 46.565 14.3144 46.5717H15.8821C17.3214 46.5643 18.6995 46.0198 19.7172 45.0564C20.7349 44.0929 21.31 42.7883 21.3176 41.4259V27.2184C21.2992 26.8037 21.3696 26.3898 21.5246 26.0016C21.6795 25.6134 21.9158 25.2589 22.2192 24.9593C22.5227 24.6598 22.887 24.4214 23.2902 24.2586C23.6935 24.0958 24.1274 24.0118 24.5658 24.0118C25.0042 24.0118 25.4381 24.0958 25.8413 24.2586C26.2446 24.4214 26.6089 24.6598 26.9123 24.9593C27.2158 25.2589 27.452 25.6134 27.607 26.0016C27.7619 26.3898 27.8323 26.8037 27.8139 27.2184V38.2243C27.8139 38.4988 27.9291 38.7619 28.1341 38.956C28.3391 39.15 28.6171 39.259 28.907 39.259C29.1969 39.259 29.4749 39.15 29.6799 38.956C29.8848 38.7619 30 38.4988 30 38.2243V27.2184C29.9911 25.8564 29.4152 24.5526 28.3972 23.5901C27.3792 22.6275 26.0012 22.0839 24.5624 22.077ZM9.96929 2.96607C11.8322 2.97388 13.63 3.61549 15.0346 4.77381C16.4392 5.93213 17.3571 7.52993 17.6206 9.27562H2.29825C2.56254 7.52683 3.48329 5.92663 4.89198 4.76787C6.30066 3.60912 8.10306 2.96932 9.96929 2.96558V2.96607ZM2.29773 11.3292H17.6403C17.3782 13.0785 16.4579 14.6794 15.0485 15.8376C13.6392 16.9959 11.8355 17.6336 9.96903 17.6336C8.10261 17.6336 6.29891 16.9959 4.88953 15.8376C3.48015 14.6794 2.55982 13.0785 2.29773 11.3292ZM6.89838 35.6687L5.38894 18.6527C6.80232 19.3532 8.37393 19.719 9.96929 19.719C11.5647 19.719 13.1363 19.3532 14.5496 18.6527L13.0397 35.68C12.9834 36.4152 12.6351 37.1029 12.065 37.6049C11.4949 38.1068 10.7451 38.3859 9.96643 38.3859C9.18779 38.3859 8.43801 38.1068 7.86786 37.6049C7.29772 37.1029 6.94948 36.4152 6.89317 35.68L6.89838 35.6687Z" fill="currentColor"/>
                                        </svg>
                                        <p class="tw-text-sm tw-italic tw-mt-2 tw-text-center">Add a photo of your<br> singing gear</p>
                                    </div>
                                    <img v-if="userSingingPhoto" 
                                        class="tw-w-full tw-absolute tw-top-0 tw-left-0"
                                        :src="userSingingPhoto"
                                        data-drumeo-gear-update="true"
                                    >
                                </button>
                                <span v-if="userSingingPhoto" data-clear-gear-photo="drums" class="rounded clear-button tw-top-1 tw-right-1">
                                    <i class="fas fa-times"></i>
                                </span>
                            </div>

                        </div>
                    </div>
                </section>

                <!-- FORUM SIGNATURE -->
                <section class="tw-flex tw-flex-row tw-p-6 tw-mb-10">
                    <div class="tw-flex tw-flex-col tw-grow">
                        <div class="tw-flex tw-flex-row tw-mb-4 tw-flex-grow-0" >
                            <h2 class="tw-font-bold dark:tw-text-white tw-text-xl">Forum Signature</h2>
                            <button class="tw-ml-auto tw-btn-secondary tw-btn-small tw-mb-0 tw-text-[#00101D] dark:tw-text-[#9EC0DC] tw-text-lg tw-px-4" 
                                    @click="handleEditSignatureModal"
                            >Edit</button>
                        </div>
                        <div class="tw-flex tw-flex-col tw-text-[#00101D] dark:tw-text-white tw-break-words">
                            <p v-if="userForumSignature" v-html="userForumSignature"></p>
                            <p class="tw-text-sm text-grey-3 tw-italic tw-mt-3 dark:tw-text-[#9EC0DC]">
                                This will appear below your posts on the forums page.
                            </p>
                        </div>
                    </div>
                </section>
            </div>
        </div>
    </div>
</template>
<script setup>
    import { computed, ref, onBeforeMount } from "vue";
    import { storeToRefs } from "pinia/dist/pinia";
    import { useUserStore } from "../../../stores/user";
    import Breadcrumb from '../../components/Breadcrumb/Breadcrumb';
    import PageHeader from '../../components/PageHeader/PageHeader';
    import PillNav from "../../components/PillNav/PillNav.vue";
    import EditDisplayNameModal from "../../components/Modal/EditDisplayNameModal.vue";
    import ImageUploader from "../../components/ImageUploader/ImageUploader.vue";
    import EditAboutYouModal from "../../components/Modal/EditAboutYouModal.vue";

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
    const handleShowPianoGearModal = () => {
        showPianoGearModal.value = !showPianoGearModal.value;
    }
    const handleShowGuitarGearModal = () => {
        showGuitarGearModal.value = !showGuitarGearModal.value;
    }
    const handleShowSingingGearModal = () => {
        showSingingGearModal.value = !showSingingGearModal.value;
    }

    //Image Upload logic should be moved Pinia in the future
    const handleUploadDone = ({ profile_picture_url }) => {
        userStore.setUserProfilePictureUrl(profile_picture_url)
        showProfilePictureModal.value = false;
        window.shownotification({
            icon: 'check',
            text: `AHH, MUCH BETTER! The new "you" is being refreshed...`
        })
    }
    const handleImageUploadError = () => {
        window.shownotification({
            icon: 'error',
            text: 'Hmm, something has gone wrong. Your image could not be uploaded.'
        });
        showProfilePictureModal.value = false;
    }

    //Lifecycle Hooks
    onBeforeMount( ()=> {
        //console.log('country list', props.countryList)
    })  
</script>