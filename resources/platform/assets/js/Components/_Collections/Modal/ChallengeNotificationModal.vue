<template>
    <InfoModal :selfContained="true" class-override="tw-max-w-[510px] tw-w-full" @onClose="emit('modalClose')">
        <div class="tw-flex tw-flex-col tw-justify-center -tw-mt-[50px] dark:tw-text-white tw-text-center">
            <!-- Dark mode Logo -->
            <img class="tw-h-20 tw-mb-5 tw-hidden dark:tw-block" :src="`https://www.musora.com/musora-cdn/image/width=300,quality=95/${challenge?.dark_mode_logo}`" alt="challenge dark mode logo" />
            <!-- Light mode Logo -->
            <img class="tw-h-20 tw-mb-5 dark:tw-hidden" :src="`https://www.musora.com/musora-cdn/image/width=300,quality=95/${challenge?.light_mode_logo}`" alt="challenge light mode logo" />

            <!-- Step 1 -->
            <template v-if="step === 1">
                <h1 class="tw-mb-3 tw-text-2xl tw-font-bold">You're enrolled in 30-Day Drummer!</h1>
                <p class="tw-mb-5 tw-text-left">Next, choose if you would like to receive practice reminders for this Challenge (make sure you download the app to get push notifications).</p>
                <ul class="tw-text-left">
                    <li class="tw-mb-5"><input class="tw-mr-[10px]" type="radio" value="true" v-model="selectedFrequency" /> <label>Yes, send me practice reminders!</label></li>
                    <li><input class="tw-mr-[10px]" type="radio" value="false" v-model="selectedFrequency" /> <label>No thanks, I’m all good!</label></li>
                </ul>
                <div class="tw-flex tw-justify-end tw-mt-[30px]">
                    <MuButton :disabled="!selectedFrequency" @click="handleNext">Next</MuButton>
                </div>
            </template>

            <!-- Step 2 (Solo) -->
            <template v-if="step === 2 && challengeType === 'solo'">
                <h1 class="tw-mb-3 tw-text-2xl tw-font-bold">Choose Your Start Date</h1>
                <div class="tw-mx-auto">
                    <Datepicker :start-date="selectedDate" inline :enable-time-picker="false" :action-row="{ showCancel: false, showSelect: false, showPreview: false }" position="center" :min-date="new Date()" @internal-model-change="handleDateChange" />
                </div>
                <div class="tw-flex tw-justify-end tw-mt-[30px]">
                    <MuButton :disabled="!selectedDate" @click="setStartDate">{{ setStartDateButtonText }}</MuButton>
                </div>
            </template>

            <!-- Step 2 (Community) -->
            <template v-if="step === 2 && challengeType === 'community'">
                <h1 class="tw-mb-3 tw-text-2xl tw-font-bold">30-Day Drummer starts on August 20</h1>
                <div class="tw-mb-[10px] tw-flex tw-justify-center">
                    <!-- Avatars -->
                    <div v-for="(avatar, index) in challengeData.entity" class="tw-w-10 tw-h-10 tw-border tw-border-white tw-rounded-full tw-overflow-hidden tw-bg-cover tw-bg-center" :class="index !== 0 ? '-tw-ml-3' : ''" :style="`background-image: url('${avatar.profile_picture_url}')`"></div>
                    <div class="tw-w-10 tw-h-10 tw-border tw-border-white tw-rounded-full tw-overflow-hidden tw-bg-cover tw-bg-center -tw-ml-3 tw-transition-all tw-duration-1000" :class="slideIn ? '' : 'tw-absolute tw-opacity-0 tw-translate-x-10'" :style="`background-image: url('${userProfilePictureUrl}')`"></div>
                </div>
                <p class="tw-text-left">You’ve joined <span class="tw-font-bold">{{ userNames }}</span> and <span class="tw-font-bold">{{ challengeData.total }}</span> other drummers who have already enrolled!</p>
                <div class="tw-flex tw-justify-end tw-mt-[30px]">
                    <MuButton variant="secondary" class="tw-mr-[9px]">View Challenge</MuButton>
                    <MuButton is-link :href="`/${brand}`" >Go Home</MuButton>
                </div>
            </template>
        </div>
    </InfoModal>
</template>
<script setup>
import { ref, computed } from 'vue';
import axios from 'axios';
import Datepicker from '@vuepic/vue-datepicker';
import '@vuepic/vue-datepicker/dist/main.css';
import { useUserStore } from "@stores/user";
import { storeToRefs } from "pinia/dist/pinia";
import { postChallengesSetStartDate } from 'musora-content-services';

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
});

const emit = defineEmits(['modalClose']);

const userStore = useUserStore();
const { userProfilePictureUrl, brand } = storeToRefs(userStore);

const selectedFrequency = ref(true);
const step = ref(props.defaultStep || props.challengeType === 'community' ? 1 : 2);
const selectedDate = ref(new Date(Date.now()));
const slideIn = ref(false);
const challengeData = ref({
    entity:[],
    total: 0,
});

const userNames = computed(() => {
    const names = [];
    challengeData.value.entity.forEach((user) => {
        names.push(user.display_name);
    });

    return names.join(', ');
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
                const setNotification = await postChallengesCommunityNotification(props.challenge.content_id);

                const data = await axios.get(`/challenges/${props.challenge.content_id}`);
                challengeData.value = data.data;
                step.value = 2;

                setTimeout(() => {
                    slideIn.value = true;
                },1500)
            }
        } else {
            step.value = 2;
        }
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
        const startDate = await postChallengesSetStartDate(props.challenge.content_id, selectedDate.value);
    }
    catch(e) {
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
