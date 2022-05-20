<template>
    <section class="tw-grid tw-grid-cols-3 tw-gap-1 sm:tw-gap-4 tw-mb-6 md:tw-mb-8">
        <!-- Method -->
        <a :href="methodUrl" 
            class="tw-relative tw-h-14 sm:tw-h-32 tw-w-full tw-border-[0.5px] tw-border-[#A1A1A9] dark:tw-border-[#344858] tw-rounded-xl tw-overflow-hidden tw-group"
        >
            <div class="tw-absolute tw-w-full tw-h-full tw-inline-flex tw-flex-col tw-items-center tw-transition-all tw-justify-center focus:tw-bottom-1"
                 :class="`${brand}-card tw-text-${brand}`"
            >
                <!-- Icon -->
                <musora-icon icon-name="method" class="tw-w-4 tw-h-4 sm:tw-h-9 sm:tw-w-9 tw-mb-1 sm:tw-mb-2" />
                <!--Name SVG-->
                <svg width="124" height="26" viewBox="0 0 124 26" fill="none" xmlns="http://www.w3.org/2000/svg" class="tw-w-14 tw-h-3 sm:tw-h-auto sm:tw-w-auto">
                    <path d="M11.3988 11.6204L11.3996 11.6197L11.4061 11.6139L20.7525 1.32589H22.8954V25.0989H16.7633V14.5345H16.7623H16.7613H16.7609L11.7659 19.8162H11.0976L6.13485 14.5338L6.1341 14.5345L6.13335 14.5352L6.13307 14.5355V25.0989H0.00102956V1.32589H2.21238L11.398 11.6211L11.3988 11.6204ZM89.8799 0.987358C92.8885 0.987358 95.8969 2.01176 98.1533 4.06048C100.41 6.10919 101.914 9.18226 101.914 13.2798C101.914 17.3862 100.409 20.466 98.1529 22.5191C95.8963 24.5723 92.8875 25.5989 89.8786 25.5989C86.8698 25.5989 83.861 24.5723 81.6044 22.5191C79.3478 20.466 77.8434 17.3862 77.8434 13.2798C77.8434 9.18226 79.3477 6.10919 81.6043 4.06048C83.861 2.01176 86.8701 0.987358 89.8799 0.987358ZM29.8037 10.1634V10.1644H37.782V15.5475H29.8037V15.5486H29.8026V19.7148H29.8037V19.7158H38.7858V25.0989H23.8379V1.39375H38.4842V6.8104H29.8037V6.81143H29.8026V10.1634H29.8037ZM45.0588 6.81143H45.0578V6.8104H39.2923V1.39375H56.7217V6.8104H50.9917V6.81143H50.9906V25.0989H45.0588V6.81143ZM76.9719 1.39375V25.0989H70.8373V15.5844H70.8363V15.5834H63.5945V15.5844H63.5934V25.0989H57.4614V1.39375H63.5934V9.9949H63.5945V9.99593H70.8363V9.9949H70.8373V1.39375H76.9719ZM111.603 25.0989H102.752V1.39272L111.603 1.39375C115.424 1.41065 118.29 2.89652 120.201 5.11681C122.112 7.33712 123.067 10.2919 123.067 13.2467C123.067 16.2015 122.112 19.1563 120.201 21.3765C118.29 23.5966 115.424 25.0823 111.603 25.0989ZM89.8951 6.87825C88.4247 6.87825 86.9537 7.41173 85.8502 8.47869C84.7467 9.54566 84.0109 11.1461 84.0109 13.2798C84.0109 15.431 84.7464 17.0445 85.8497 18.1202C86.953 19.1959 88.4241 19.7338 89.8951 19.7338C91.3662 19.7338 92.8372 19.1959 93.9405 18.1202C95.0438 17.0445 95.7793 15.431 95.7793 13.2798C95.7793 11.1461 95.0442 9.54566 93.941 8.47869C92.8378 7.41173 91.3668 6.87825 89.8951 6.87825ZM111.603 6.91205H108.754V6.91308H108.753V19.5791H108.754V19.5801H111.603C113.472 19.5801 114.874 18.7883 115.808 17.6007C116.743 16.413 117.21 14.8295 117.21 13.2461C117.21 11.6626 116.743 10.0792 115.808 8.89151C114.874 7.70383 113.472 6.91205 111.603 6.91205Z" fill="currentColor" stroke="currentColor" stroke-width="0.00205912"/>
                </svg>
                <!-- Text Description -->
                <p class="tw-hidden lg:tw-block tw-uppercase tw-text-lg tw-font-bebas-neue tw-mt-2">
                    <template v-if="hasCompletedMethod">
                        <span class="tw-flex tw-items-center tw-text-[#22C55E]">
                            <svg width="15" height="15" viewBox="0 0 15 15" fill="none" xmlns="http://www.w3.org/2000/svg" class="tw-mr-2">
                                <path fill-rule="evenodd" clip-rule="evenodd" d="M7.5002 14.3002C11.2557 14.3002 14.3002 11.2557 14.3002 7.5002C14.3002 3.74466 11.2557 0.700195 7.5002 0.700195C3.74466 0.700195 0.700195 3.74466 0.700195 7.5002C0.700195 11.2557 3.74466 14.3002 7.5002 14.3002ZM10.6512 6.40124C10.9832 6.06929 10.9832 5.5311 10.6512 5.19915C10.3193 4.86721 9.7811 4.86721 9.44915 5.19915L6.6502 7.99811L5.55124 6.89915C5.21929 6.56721 4.6811 6.56721 4.34915 6.89915C4.01721 7.2311 4.01721 7.76929 4.34915 8.10124L6.04915 9.80124C6.3811 10.1332 6.91929 10.1332 7.25124 9.80124L10.6512 6.40124Z" fill="currentColor"/>
                            </svg>
                            Completed
                        </span>
                    </template>
                    <template v-else>
                        <span v-if="hasStartedMethod" :class="`tw-text-${brand}`">
                            Continue Level {{ nextLearningPathLevel }} - {{ nextLearningPathLessonTitle }}
                        </span>
                        <span v-else :class="`tw-text-${brand} dark:tw-text-white tw-flex tw-items-center`">
                            Start
                            <svg width="9" height="7" viewBox="0 0 9 7" fill="none" xmlns="http://www.w3.org/2000/svg" class="tw-ml-1">
                                <path d="M5.08333 0.5L8 3.5M8 3.5L5.08333 6.5M8 3.5L1 3.5" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                        </span>
                    </template>
                </p>
            </div>
        </a>

        <!-- Songs -->
        <a :href="`/${brand}/songs/`" 
            class="tw-relative tw-h-14 sm:tw-h-32 tw-w-full tw-border-[0.5px] tw-border-[#A1A1A9] dark:tw-border-[#344858] tw-rounded-xl tw-overflow-hidden tw-group"
        >
            <div class="tw-absolute tw-w-full tw-h-full tw-inline-flex tw-flex-col tw-transition-all tw-items-center tw-justify-center focus:tw-bottom-1"
                 :class="[ brand === 'pianote'? `songs-card-blue tw-text-[#5FCFF5]` : `songs-card-pink tw-text-[#DD4572]`]"
            >
                <!-- Icon -->
                <musora-icon icon-name="headphones" class="tw-w-4 tw-h-4 sm:tw-h-9 sm:tw-w-9 tw-mb-1 sm:tw-mb-2"/>
                <!--Name SVG-->
                <svg width="106" height="25" viewBox="0 0 106 25" fill="none" xmlns="http://www.w3.org/2000/svg" class="tw-w-14 tw-h-3 sm:tw-h-auto sm:tw-w-auto">
                    <path d="M5.69617 17.32H0.000692379C-0.13124 27.5441 18.6355 27.3779 18.6355 17.6187C18.6355 11.8097 14.1573 11.1127 9.58198 10.6148C7.5084 10.3824 5.79575 10.0172 5.92768 8.25805C6.12434 5.50277 12.3152 5.23723 12.3152 8.32431H17.9111C18.0431 -1.70043 0.132614 -1.70043 0.331757 8.32431C0.396479 13.3698 3.68981 15.0961 8.69328 15.4612C10.9984 15.594 12.9077 15.9592 12.9077 17.5856C12.9077 20.3075 5.69617 20.2743 5.69617 17.32ZM92.5476 17.32H86.8521C86.7202 27.5441 105.487 27.3779 105.487 17.6187C105.487 11.8097 101.009 11.1127 96.4334 10.6148C94.3598 10.3824 92.6472 10.0172 92.7791 8.25805C92.9758 5.50277 99.1667 5.23723 99.1667 8.32431H104.763C104.895 -1.70043 86.9841 -1.70043 87.1807 8.32431C87.2479 13.3698 90.5388 15.0961 95.5447 15.4612C97.8498 15.594 99.7591 15.9592 99.7591 17.5856C99.7591 20.3075 92.5476 20.2743 92.5476 17.32ZM42.5377 12.8387C42.5377 4.80579 36.6281 0.789062 30.7185 0.789062C24.809 0.789062 18.8994 4.80579 18.8994 12.8387C18.8994 28.9383 42.5377 28.9383 42.5377 12.8387ZM64.0029 12.8056C64.0378 20.7392 69.9623 24.6891 75.8221 24.6891C80.0713 24.6891 84.45 22.8304 86.0954 17.9839C86.8845 15.7268 86.8845 13.5026 86.755 11.179H75.8569V16.3241H80.7608C79.7078 18.5483 78.1944 19.179 75.8221 19.179C72.3321 19.179 70.0942 16.6562 70.0942 12.8056C70.0942 9.2537 72.1031 6.33277 75.8221 6.33277C78.162 6.33277 79.6755 7.12938 80.6289 9.12093H86.424C85.3063 3.34507 80.4646 0.921833 75.8221 0.888703C69.9623 0.888703 64.0378 4.87204 64.0029 12.8056ZM61.073 24.457H63.1814V1.18737H57.1549V12.5732L45.5025 1.08799H43.3617V24.4236H49.453V13.0049L61.073 24.457ZM24.9583 12.8387C24.9583 8.65636 27.8459 6.56492 30.736 6.56492C33.6236 6.56492 36.5136 8.65636 36.5136 12.8387C36.5136 21.2702 24.9583 21.2702 24.9583 12.8387Z" fill="currentColor"/>
                </svg>
                <!-- Text Description -->
                <p class="tw-hidden lg:tw-block tw-uppercase tw-text-current tw-text-lg tw-font-bebas-neue tw-mt-2">View All Songs</p>
            </div>
        </a>

        <!-- Coaches -->
        <a :href="`/${brand}/coaches/`" 
            class="tw-relative tw-h-14 sm:tw-h-32 tw-w-full tw-border-[0.5px] tw-border-[#A1A1A9] dark:tw-border-[#344858] tw-rounded-xl tw-overflow-hidden tw-group">
            <div class="tw-absolute tw-w-full tw-h-full tw-inline-flex tw-flex-col tw-items-center tw-transition-all tw-justify-center tw-text-[#FFA710] coaches-card focus:tw-bottom-1">
                <!-- Icon -->
                <musora-icon icon-name="whistle" class="tw-w-4 tw-h-4 sm:tw-h-9 sm:tw-w-9 tw-mb-1 sm:tw-mb-2"/>
                <!--Name SVG-->
                <svg width="121" height="22" viewBox="0 0 121 22" fill="none" xmlns="http://www.w3.org/2000/svg" class="tw-w-14 tw-h-3 sm:tw-h-auto sm:tw-w-auto">
                    <path d="M109.942 14.4344H105.132C105.021 23.2482 120.87 23.105 120.87 14.6919C120.87 9.68415 117.088 9.0833 113.224 8.65404C111.473 8.45368 110.027 8.13887 110.138 6.62216C110.304 4.24713 115.533 4.01822 115.533 6.6795H120.259C120.37 -1.96252 105.244 -1.96252 105.41 6.6795C105.467 11.0291 108.246 12.5172 112.474 12.832C114.42 12.9465 116.033 13.2611 116.033 14.6633C116.033 17.0098 109.942 16.9812 109.942 14.4344ZM39.5683 10.5712C39.5683 3.64629 34.5753 0.183594 29.5843 0.183594C24.5933 0.183594 19.6023 3.64629 19.6023 10.5712C19.6023 24.4501 39.5683 24.4501 39.5683 10.5712ZM0 10.5427C0.0273306 17.3532 5.03302 20.7871 9.98196 20.7585C14.1257 20.7585 18.4902 18.5265 19.2134 12.8606H14.3191C13.7914 15.0067 12.0948 16.0942 9.98196 16.0942C7.03446 16.0656 5.14445 13.4902 5.14445 10.5427C5.14445 7.22322 7.06179 4.96243 9.98196 4.96243C12.0675 4.96243 13.5412 5.87831 14.2371 7.90997H19.1314C18.3788 2.55885 14.0143 0.298049 9.98196 0.298049C5.03302 0.298049 0.0273306 3.73197 0 10.5427ZM55.0543 10.5427C55.0837 17.3532 60.0873 20.7871 65.0362 20.7585C69.18 20.7585 73.5444 18.5265 74.2676 12.8606H69.3755C68.8457 15.0067 67.1491 16.0942 65.0362 16.0942C62.0887 16.0656 60.1987 13.4902 60.1987 10.5427C60.1987 7.22322 62.1182 4.96243 65.0362 4.96243C67.1218 4.96243 68.5955 5.87831 69.2914 7.90997H74.1857C73.4351 2.55885 69.0685 0.298049 65.0362 0.298049C60.0873 0.298049 55.0837 3.73197 55.0543 10.5427ZM104.466 0.526958H92.3142V20.5582H104.716V16.0083H97.2632V12.4884H103.881V7.93852H97.2632V5.10567H104.466V0.526958ZM91.2294 0.526958H86.1417V7.7955H80.1353V0.526958H75.0476V20.5582H80.1353V12.5172H86.1417V20.5582H91.2294V0.526958ZM52.3023 20.5582H57.1671V19.8143L48.3814 0.269484H46.2412L37.4828 19.8143V20.5582H42.3476L43.4871 18.0401H51.1628L52.3023 20.5582ZM24.7194 10.5712C24.7194 6.96575 27.1582 5.16278 29.599 5.16278C32.0398 5.16278 34.4786 6.96575 34.4786 10.5712C34.4786 17.8398 24.7194 17.8398 24.7194 10.5712ZM49.5503 13.6618H45.0996L47.2966 8.39635L49.5503 13.6618Z" fill="currentColor"/>
                </svg>
                <!-- Text Description -->
                <p class="tw-hidden lg:tw-block tw-uppercase tw-text-[#FFA710] tw-text-lg tw-font-bebas-neue tw-mt-2">View All Coaches</p>
            </div>
        </a>
    </section>
</template>
<script>
//Icons
import MusoraIcon from '../MusoraIcons/MusoraIcon.vue'

export default {
    components: { MusoraIcon },
    props: {
        brand: String,
        methodUrl: String,
        hasCompletedMethod: Boolean,
        hasStartedMethod: Boolean,
    },
}
</script>
<style scoped>
    /* created custom styles here because tailwind does not have a way of creating multiple gradients. */
    .pianote-card {
        background: linear-gradient(180deg, rgba(255, 255, 255, 0.488) 0%, rgba(246, 26, 48, 0.248) 100%), rgba(255, 255, 255, 0.6);
    }
    .tw-dark .pianote-card {
        background: linear-gradient(0deg, rgba(0, 12, 23, 0.8), rgba(0, 12, 23, 0.8)), linear-gradient(180deg, rgba(0, 16, 29, 0.8) 0%, rgba(246, 26, 48, 0.632) 100%);
    }
    .singeo-card {
        background: linear-gradient(180deg, rgba(255, 255, 255, 0.488) 0%, rgba(131, 0, 233, 0.152) 100%), rgba(255, 255, 255, 0.6);
    }
    .tw-dark .singeo-card {
        background: linear-gradient(0deg, rgba(0, 12, 23, 0.8), rgba(0, 12, 23, 0.8)), linear-gradient(180deg, rgba(0, 16, 29, 0.8) 0%, rgba(131, 0, 233, 0.152) 100%);
    }
    .guitareo-card {
        background: linear-gradient(180deg, rgba(255, 255, 255, 0.488) 0%, rgba(0, 201, 172, 0.296) 100%), rgba(255, 255, 255, 0.6);
    }
    .tw-dark .guitareo-card {
        background: linear-gradient(0deg, rgba(0, 12, 23, 0.8), rgba(0, 12, 23, 0.8)), linear-gradient(180deg, rgba(0, 16, 29, 0.8) 0%, rgba(0, 201, 172, 0.4) 100%);
    }
    .drumeo-card {
        background: linear-gradient(180deg, rgba(255, 255, 255, 0.488) 0%, rgba(45, 133, 204, 0.376) 100%), rgba(255, 255, 255, 0.6);                
    }
    .tw-dark .drumeo-card {
        background: linear-gradient(0deg, rgba(0, 12, 23, 0.8), rgba(0, 12, 23, 0.8)), linear-gradient(180deg, rgba(0, 16, 29, 0.8) 0%, rgba(45, 133, 204, 0.376) 100%);
    }
    .coaches-card {
        background: linear-gradient(0deg, rgba(255, 255, 255, 0.6), rgba(255, 255, 255, 0.6)), linear-gradient(180deg, #FFFFFF 5.65%, rgba(255, 168, 17, 0.71) 100%);
    }
    .tw-dark .coaches-card {
        background: linear-gradient(0deg, rgba(0, 12, 23, 0.8), rgba(0, 12, 23, 0.8)), linear-gradient(180deg, rgba(0, 16, 29, 0.8) 0%, rgba(255, 168, 17, 0.71) 100%);
    }
    .songs-card-blue {
        background: linear-gradient(0deg, rgba(255, 255, 255, 0.6), rgba(255, 255, 255, 0.6)), linear-gradient(180deg, #FFFFFF 12.1%, rgba(95, 207, 245, 0.59) 100%);
    }
    .tw-dark .songs-card-blue {
        background: linear-gradient(0deg, rgba(0, 12, 23, 0.8), rgba(0, 12, 23, 0.8)), linear-gradient(180deg, rgba(0, 16, 29, 0.8) 0%, rgba(95, 207, 245, 0.59) 100%);
    }
    .songs-card-pink {
        background: linear-gradient(0deg, rgba(255, 255, 255, 0.6), rgba(255, 255, 255, 0.6)), linear-gradient(180deg, #FFFFFF 12.1%, rgba(221, 69, 114, 0.59) 100%);
    }
    .tw-dark .songs-card-pink {
        background: linear-gradient(0deg, rgba(0, 12, 23, 0.8), rgba(0, 12, 23, 0.8)), linear-gradient(180deg, rgba(0, 16, 29, 0.8) 0%, rgba(221, 69, 114, 0.59) 100%);
    }
</style>