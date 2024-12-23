<template>
    <InfoModal :selfContained="true" class-override="tw-max-w-[510px] tw-w-full" :hide-x-icon="hideXIcon" :disable-overlay-click="hideXIcon" @onClose="emit('modalClose')">
        <div class="tw-flex tw-flex-col tw-justify-center dark:tw-text-white tw-text-center">
            <!-- Dark mode Logo -->
            <img class="tw-h-24 tw-object-contain tw-mb-5 tw-hidden dark:tw-block" :class="!hideXIcon ? '-tw-mt-[50px]' : ''" :src="`https://www.musora.com/cdn-cgi/image/width=300,quality=95/${challenge?.dark_mode_logo_url}`" alt="challenge dark mode logo" />
            <!-- Light mode Logo -->
            <img class="tw-h-24 tw-object-contain tw-mb-5 dark:tw-hidden" :class="!hideXIcon ? '-tw-mt-[50px]' : ''" :src="`https://www.musora.com/cdn-cgi/image/width=300,quality=95/${challenge?.light_mode_logo_url}`" alt="challenge light mode logo" />

            <!-- Step 1 -->
            <template v-if="step === 1">
                <h1 class="tw-mb-3 tw-text-2xl tw-font-bold">You're enrolled in {{ challengeTitle }}!</h1>
                <p class="tw-mb-5 tw-text-left">Next, choose if you would like to receive practice reminders for this Challenge (make sure you download the app to get push notifications).</p>
                <ul class="tw-text-left">
                    <li class="tw-mb-5" @click="handleFrequencyChange(true)"><input class="tw-mr-[10px]" type="radio" :value="true" v-model="selectedFrequency" /> <label>Yes, send me practice reminders!</label></li>
                    <li @click="handleFrequencyChange(false)"><input class="tw-mr-[10px]" type="radio" :value="false" v-model="selectedFrequency" /> <label>No thanks, I’m all good!</label></li>
                </ul>
                <div class="tw-flex tw-justify-end tw-mt-[30px]">
                    <MuButton @click="handleNext">Next</MuButton>
                </div>
            </template>

            <!-- Step 2 (Solo) -->
            <template v-if="step === 2 && challengeType === 'solo'">
                <h1 class="tw-mb-6 tw-text-2xl tw-font-bold">Choose Your Start Date</h1>
                <div class="tw-mx-auto">
                    <Datepicker :start-date="selectedDate" inline :enable-time-picker="false" :action-row="{ showCancel: false, showSelect: false, showPreview: false }" position="center" :min-date="new Date()" @internal-model-change="handleDateChange" />
                </div>
                <div class="tw-flex tw-justify-end tw-mt-[30px]">
                    <MuButton :disabled="!selectedDate" @click="setStartDate">{{ setStartDateButtonText }}</MuButton>
                </div>
            </template>

            <!-- Step 2 (Community) -->
            <template v-if="step === 2 && challengeType === 'community'">
                <h1 class="tw-mb-3 tw-text-2xl tw-font-bold">{{ challengeTitle }} starts on {{ startDate }}</h1>
                <div class="tw-mb-[10px] tw-flex tw-justify-center">
                    <!-- Avatars -->
                    <div v-for="(avatar, index) in challengeData.data" class="tw-w-10 tw-h-10 tw-border tw-border-white tw-rounded-full tw-overflow-hidden tw-bg-cover tw-bg-center" :class="index !== 0 ? '-tw-ml-3' : ''" :style="`background-image: url('https://www.musora.com/cdn-cgi/image/width=40,quality=95/${avatar.profile_picture_url}')`"></div>
                    <div class="tw-w-10 tw-h-10 tw-border tw-border-white tw-rounded-full tw-overflow-hidden tw-bg-cover tw-bg-center -tw-ml-3 tw-transition-all tw-duration-1000" :class="slideIn ? '' : 'tw-absolute tw-opacity-0 tw-translate-x-10'" :style="`background-image: url('${userProfilePictureUrl}')`"></div>
                </div>
                <p class="tw-text-left">You’ve joined <span class="tw-font-bold">{{ userNames }}</span> and <span class="tw-font-bold">{{ challengeData.total }}</span> other {{ otherText }} who have already enrolled! {{ challengeTitle }} runs from {{ durationText }}</p>
                <div class="tw-flex tw-justify-end tw-mt-[30px]">
                    <MuButton variant="secondary" is-link :href="`${challenge.course_url}`" class="tw-mr-[9px]">View Challenge</MuButton>
                    <MuButton is-link :href="`/${brand}`" >Go Home</MuButton>
                </div>
            </template>
        </div>
    </InfoModal>
</template>
<script setup>
import { ref, computed } from 'vue';
import Datepicker from '@vuepic/vue-datepicker';
import '@vuepic/vue-datepicker/dist/main.css';
import { useUserStore } from "@stores/user";
import { storeToRefs } from "pinia/dist/pinia";
import {
    postChallengesSetStartDate,
    fetchChallengeMetadata,
    postChallengesCommunityNotification
} from 'musora-content-services';

import InfoModal from '@collections/Modal/InfoModal';
import MuButton from '@units/Button/MuButton';

const props = defineProps({
    challengeType: {
        type: String,
        default: 'solo',
    },
    challenge: {
      type: Object,
      default: () => {},
    },
    defaultStep: {
        type: Number,
        default: 0,
    },
    isFromCarousel: {
        type: Boolean,
        default: false,
    },
    hideXIcon: {
        type: Boolean,
        default: false,
    },
});

const emit = defineEmits(['modalClose', 'onReFetchData']);

const userStore = useUserStore();
const { userProfilePictureUrl, brand } = storeToRefs(userStore);

const selectedFrequency = ref(true);
const step = ref(props.defaultStep !== 0 ? props.defaultStep : props.challengeType === 'community' ? 1 : 2);
const selectedDate = ref(new Date(Date.now()));
const slideIn = ref(false);
const challengeData = ref({
    data:[],
    total: 0,
});

const otherText = computed(() => {
    if(brand.value === 'drumeo'){
        return 'drummers';
    } else if(brand.value === 'pianote'){
        return 'piano players';
    } else if(brand.value === 'guitareo'){
        return 'guitar players';
    } else if(brand.value === 'singeo'){
        return 'singers';
    }
})

const userNames = computed(() => {
    const names = [];

    challengeData.value.data.forEach((user) => {
        names.push(user.display_name);
    });

    return names.join(', ');
})

const challengeTitle = computed(() => {
    return props.challenge.title;
})

const startDate = computed(() => {
    const converted = new Date(props.challenge.cohort_start_date);
    return `${months[converted.getMonth()]} ${converted.getDate()}`;
})

const durationText = computed(() => {
    return props.challenge?.duration_text;
})

const setStartDateButtonText = computed(() => {
    const today = new Date(Date.now());
    if(today.getDate() === selectedDate.value.getDate() && today.getMonth() === selectedDate.value.getMonth() && today.getFullYear() === selectedDate.value.getFullYear()){
        return 'Start Now';
    } else {
        return `Start on ${months[selectedDate.value.getMonth()]} ${selectedDate.value.getDate()}`
    }
})

const handleFrequencyChange = (val) => {
    selectedFrequency.value = val;
};

const handleNext = async () => {
    try {
        if(props.challengeType === 'community'){
            if(selectedFrequency.value){
                const setNotification = await postChallengesCommunityNotification(props.challenge.id);
                const data = await fetchChallengeMetadata(props.challenge.id);
                challengeData.value = data;

                setTimeout(() => {
                    slideIn.value = true;
                },1500)
            }
        }

        step.value = 2;
    } catch (e) {
        window.shownotification({
            icon: 'error',
            text: 'Woops! Something wrong happened, please try again later.'
        })
    }

};

const handleDateChange = (date) => {
    if(date){
        selectedDate.value = date;
    }
}

const setStartDate = async () => {
    try {
         await postChallengesSetStartDate(props.challenge.id, `${selectedDate.value.getFullYear()}-${selectedDate.value.getMonth() + 1}-${selectedDate.value.getDate()}`);
         const date = new Date();
         if(setStartDateButtonText.value === 'Start Now'){
            window.location.href = props.challenge?.next_lesson?.web_url_path;
         }
        else{
            //When the modal is opened from challenge carousel
            if(props.isFromCarousel){
                emit('onReFetchData')
            } else {
                window.location.href = `/${props.challenge.brand}`;
            }
        }
    }
    catch(e) {
        console.log(e);
        window.shownotification({
            icon: 'error',
            text: 'Woops! Something wrong happened, please try again later.'
        })
    }
};

const months = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'];
</script>
<style>
    .dp__outer_menu_wrap {
        border-radius: 10px !important;
        overflow: hidden !important;
    }

    .dp__menu_inner {
        padding: 0 !important;
        font-family: "Open Sans" !important;
    }

    .dp--header-wrap {
        background-color: #002039 !important;
        color: white !important;
        padding: 4px 0 !important;
    }

    .dp__month_year_wrap {
        width: auto !important;
        justify-content: space-between !important;
        gap: 6px !important;
    }

    .dp__btn {
        color: white !important;
        font-size: 18px !important;
        font-weight: 700 !important;
    }

    .dp__btn:hover {
        background-color: transparent !important;
    }

    .dp__icon {
        color: white !important;
    }

    .dp__inner_nav:hover {
        background-color: transparent !important;
    }

    .dp__menu {
        border: none !important;
    }

    .tw-dark .dp__outer_menu_wrap {
        border: none !important;
    }

    .dp__outer_menu_wrap {
        border: 1px solid #CBCBCD !important;
    }

    .dp__calendar_header_item {
        color: #CBCBCD !important;
        font-size: 14px !important;
    }

    .dp__calendar_header_separator {
        display: none !important;
    }

    .dp__calendar_item {
        font-weight: 700 !important;
        font-size: 14px !important;
    }
</style>
