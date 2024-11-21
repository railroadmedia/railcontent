<template>
    <InfoModal
        :selfContained="true"
        class-override="tw-max-w-[980px] tw-w-full"
        @onClose="() => emit('closeModal')"
    >
        <div class="tw-opacity-0 tw-absolute">
            <!-- Certificate Content -->
            <div ref="certificateContent" class="tw-flex tw-justify-center tw-items-center" :class="addHeightToPdf ? 'tw-h-[800px]' : ''">
                <div class="tw-text-center tw-relative tw-px-32">
                    <!-- Borders -->
                    <!-- Top -->
                    <div class="tw-h-2 tw-w-full tw-absolute tw-top-0 tw-left-0 tw-z-10" :style="`background: ${borders?.top}`"></div>
                    <!-- Right -->
                    <div class="tw-h-full tw-w-2 tw-absolute tw-top-0 tw-right-0 tw-z-10" :style="`background: ${borders?.right}`"></div>
                    <!-- Bottom -->
                    <div class="tw-h-2 tw-w-full tw-absolute tw-bottom-0 tw-left-0 tw-z-10" :style="`background: ${borders?.bottom}`"></div>
                    <!-- Left -->
                    <div class="tw-h-full tw-w-2 tw-absolute tw-top-0 tw-left-0 tw-z-10" :style="`background: ${borders?.left}`"></div>
                    <div class="tw-relative">
                        <div class="tw-relative tw-z-20">
                            <h1 class="tw-text-[57px] tw-font-extrabold">CERTIFICATE</h1>
                            <h2 class="tw-text-[28px] tw-mb-[15px]">OF COMPLETION</h2>
                            <div class="tw-flex tw-justify-center">
                                <img  class="tw-h-6 tw-top-0 tw-left-0 tw-z-10 tw-mt-2 -tw-mb-2" :src="`data:image/png;base64,${ribbon}`" />
                            </div>
                            <div class="userName tw-border-b tw-border-black tw-px-[90px] tw-mb-[15px] tw-inline-block tw-pb-4 tw-text-[40px]">{{ userName }}</div>
                            <div class="tw-font-bold tw-mb-8"><i>Congratulations—you've earned a {{ capitalizeFirstLetter(tier) }} Certificate!</i></div>
                            <p class="tw-w-[740px] tw-text-center tw-mx-auto tw-mb-10">
                                You practiced for a total of <b>{{ minutesPracticed }} minutes</b> and achieved a <b>{{ streak }}-day streak</b> during {{ challengeTitle }}, which earned you a {{ tier }} certificate. {{ awardText }}
                            </p>
                            <div class="tw-flex tw-items-center tw-justify-center tw-mb-[30px]">
                                <div>
                                    <div class="tw-border-b tw-border-[#CBCBCD] tw-px-[30px] tw-pb-4 tw-mb-2 tw-italic tw-text-[13px]">{{ dateCompleted }}</div>
                                    <div class="tw-text-[10px] tw-font-bold">DATE</div>
                                </div>
                                <img class="tw-mx-6 tw-h-40" :src="`data:image/png;base64,${awardImage}`" />
                                <div>
                                    <div class="tw-border-b tw-border-[#CBCBCD] tw-px-[30px] tw-pb-3 tw-mb-2">
                                        <img class="tw-h-[15px]" :src="`data:image/svg+xml;base64,${instructorSignature}`" />
                                    </div>
                                    <div class="tw-text-[10px] tw-font-bold">INSTRUCTOR</div>
                                </div>
                            </div>
                        </div>
                        <!-- Musora Logo background -->
                        <img class="tw-absolute tw-top-10 tw-left-0 tw-right-0 tw-bottom-0 tw-z-0" src="data:image/png;base64,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" />
                    </div>
                    <img class="tw-h-5 tw-mx-auto" :src="`data:image/png;base64,${brandLogo}`" />
                    <img class="tw-h-2 tw-mx-auto tw-mb-10" src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAC0AAAAKCAMAAAAXbScmAAAAOVBMVEUAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAC8dlA9AAAAEnRSTlMAwODvYLCggM9wkECfIBCPUDBykvk6AAAApUlEQVQY06WOSY5DMQhEXYDHP+bd/7BtxUorUlZRigWDXgHpJ11sX9COVnGu9N98qtKNuTyz3Z7Dih7dZXG7id10LKyX7iMlw+UoQRRkHjnT5lTYYNTX2RJ195QaUGBbdAMr5CRm3Dl2WPSxnec2TYJw5E/6MBD7oi+UX/SyNAX0CpnLkEWg5ycDwTWwNzq8J7PjNFXa8F53tUfYdFW/K56p6Sv9AdBYB/GXZYzQAAAAAElFTkSuQmCC" />
                </div>
            </div>
        </div>
        <div class="tw-px-2 lg:tw-px-10">
            <img v-if="imageSrc" :src="imageSrc" class="tw-w-full tw-object-contain tw-mb-6" />
            <div class="tw-flex tw-justify-end">
                <MuButton @click="generatePdf">Download</MuButton>
            </div>
        </div>
    </InfoModal>
</template>
<script setup>
import { ref, onMounted, computed } from 'vue';
import html2pdf from 'html2pdf.js';
import html2canvas from 'html2canvas';
import { fetchUserAward } from 'musora-content-services';

import InfoModal from '@collections/Modal/InfoModal';
import MuButton from '@units/Button/MuButton';

const props = defineProps({
    certificateData: {
        type: Object,
        required: true,
    },
})

const emit = defineEmits(['closeModal']);

const addHeightToPdf = ref(false);
const pdfSrc = ref(null);
const certificateContent = ref(null);
const imageSrc = ref(null);

const ribbon = computed(() => {
    return props.certificateData?.ribbon_image_64;
})

const borders = computed(() => {
    if(props.certificateData?.tier) {
        return gradients[props.certificateData?.tier];
    }
})

const userName = computed(() => {
    return props.certificateData?.user_name;
})

const tier = computed(() => {
    return props.certificateData?.tier;
})

const minutesPracticed = computed(() => {
    return props.certificateData?.minutes_practiced;
})

const streak = computed(() => {
    return props.certificateData?.streak;
})

const awardText = computed(() => {
    return props.certificateData?.award_text;
})

const challengeTitle = computed(() => {
    return props.certificateData?.challenge_title;
})

const dateCompleted = computed(() => {
    return props.certificateData?.date_completed;
})

const awardImage = computed(() => {
    return props.certificateData?.award_64;
})

const instructorSignature = computed(() => {
    return props.certificateData?.instructor_signature_64;
})

const brandLogo = computed(() => {
    return props.certificateData?.brand_logo_64;
})

const capitalizeFirstLetter = (letter) => {
    return letter.charAt(0).toUpperCase() + letter.slice(1);
}

const generatePdf = () => {
    addHeightToPdf.value = true;
    const element = certificateContent.value;

    // Generate PDF using html2pdf.js
    html2pdf()
    .from(element)
    .set({
        margin: 1,
        html2canvas: { scale: 2 },
        jsPDF: {
            format: 'letter',
            orientation: 'landscape',
        }
    })
    .save('test.pdf')
}

const generatePng = () => {
    const element = certificateContent.value;

    html2canvas(element)
    .then((canvas) => {
        // Convert the canvas to a data URL in PNG format
        imageSrc.value = canvas.toDataURL('image/png');
    })
    .catch((error) => {
        console.error('Error capturing HTML to PNG:', error);
    });
}

const gradients = {
    bronze: {
        top: 'linear-gradient(90deg, #9E8976 0.23%, #7A5E50 19.83%, #F6D0AB 41.45%, #9D774E 61.56%, #C99B70 86.2%, #795F52 100.77%)',
        right: 'linear-gradient(180deg, #9E8976 0.23%, #7A5E50 19.83%, #F6D0AB 41.45%, #9D774E 61.56%, #C99B70 86.2%, #795F52 100.77%)',
        bottom: 'linear-gradient(90deg, #9E8976 0.23%, #7A5E50 19.83%, #F6D0AB 41.45%, #9D774E 61.56%, #C99B70 86.2%, #795F52 100.77%)',
        left: 'linear-gradient(180deg, #9E8976 0.23%, #7A5E50 19.83%, #F6D0AB 41.45%, #9D774E 61.56%, #C99B70 86.2%, #795F52 100.77%)',
    },
    silver: {
        top: 'linear-gradient(90deg, #A8A8A6 -14.68%, #9F9E9E 21.69%, #D4D4D4 47.47%, #A29F9F 99.35%)',
        right: 'linear-gradient(180deg, #A8A8A6 -14.68%, #9F9E9E 21.69%, #D4D4D4 47.47%, #A29F9F 99.35%)',
        bottom: 'linear-gradient(90deg, #A8A8A6 -14.68%, #9F9E9E 21.69%, #D4D4D4 47.47%, #A29F9F 99.35%)',
        left: 'linear-gradient(180deg, #A8A8A6 -14.68%, #9F9E9E 21.69%, #D4D4D4 47.47%, #A29F9F 99.35%)',
    },
    gold: {
        top: 'linear-gradient(90deg, #8C421D -14.68%, #FBE67B 21.69%, #F7D14E 47.47%, #D4A041 99.35%)',
        right: 'linear-gradient(360deg, #8C421D -14.68%, #FBE67B 21.69%, #F7D14E 47.47%, #D4A041 99.35%)',
        bottom: 'linear-gradient(270deg, #8C421D -14.68%, #FBE67B 21.69%, #F7D14E 47.47%, #D4A041 99.35%)',
        left: 'linear-gradient(180deg, #8C421D -14.68%, #FBE67B 21.69%, #F7D14E 47.47%, #D4A041 99.35%)',
    },
}

onMounted(() => {
    generatePng();
});
</script>
<style scoped>
    @font-face {
        font-family: 'myfont';
        src: url('https://musora-web-platform.s3.us-east-1.amazonaws.com/challenges/Meloday.ttf');
    }

    .userName {
        font-family: 'myfont';
    }
</style>
