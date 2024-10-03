<template>
    <InfoModal :selfContained="true" class-override="tw-max-w-[510px] tw-w-full">
        <div class="tw-flex tw-flex-col tw-justify-center -tw-mt-[50px] dark:tw-text-white tw-text-center">
            <img class="tw-h-20 tw-mb-5" src="https://www.musora.com/musora-cdn/image/width=300,quality=95/https://d1923uyy6spedc.cloudfront.net/30DayDrummer-Logos-07-1702425574.svg" />

            <!-- Step 1 -->
            <template v-if="step === 1">
                <h1 class="tw-mb-3 tw-text-2xl tw-font-bold">You're enrolled in 30-Day Drummer!</h1>
                <p class="tw-mb-5">Next, select your notification frequency for this Challenges.</p>
                <p class="tw-mb-[10px]">Notification Frequency</p>
                <Dropdown
                    :sorted-options="frequencyOptions"
                    :selected-value="selectedFrequency"
                    placeholderLabel="Frequency"
                    @onChange="handleFrequencyChange"
                />
                <div class="tw-flex tw-justify-end tw-mt-[30px]">
                    <MuButton :disabled="!selectedFrequency" @click="handleNext">Next</MuButton>
                </div>
            </template>

            <!-- Step 2 (Solo) -->
            <template v-if="step === 2 && challengeType === 'solo'">
                <h1 class="tw-mb-3 tw-text-2xl tw-font-bold">Choose Your Start Date</h1>
                <div class="tw-mx-auto">
                    <Datepicker v-model="selectedDate" :start-date="selectedDate" inline :enable-time-picker="false" :action-row="{ showCancel: false, showSelect: false, showPreview: false }" position="center" @internal-model-change="handleDateChange" />
                </div>
                <div class="tw-flex tw-justify-end tw-mt-[30px]">
                    <MuButton :disabled="!selectedDate" @click="handleStartNow">Start Now</MuButton>
                </div>
            </template>

            <!-- Step 2 (Community) -->
            <template v-if="step === 2 && challengeType === 'community'">
                <h1 class="tw-mb-3 tw-text-2xl tw-font-bold">30-Day Drummer starts on August 20</h1>
                <div class="tw-mb-[10px] tw-flex tw-justify-center">
                    <!-- Avatars -->
                    <div class="tw-w-10 tw-h-10 tw-border tw-border-white tw-rounded-full tw-relative tw-overflow-hidden"></div>
                    <div class="tw-w-10 tw-h-10 tw-border tw-border-white tw-rounded-full tw-relative tw-overflow-hidden -tw-ml-3"></div>
                    <div class="tw-w-10 tw-h-10 tw-border tw-border-white tw-rounded-full tw-relative tw-overflow-hidden -tw-ml-3"></div>
                </div>
                <p>You’ve joined <span class="tw-font-bold">Stidger, Poco Askew, Dr Mojo,</span> and <span class="tw-font-bold">683</span> other drummers who have already enrolled!</p>
                <div class="tw-flex tw-justify-end tw-mt-[30px]">
                    <MuButton variant="secondary" class="tw-mr-[9px]">View Challenge</MuButton>
                    <MuButton>Go Home</MuButton>
                </div>
            </template>
        </div>
    </InfoModal>
</template>
<script setup>
import { ref } from 'vue';
import InfoModal from '@collections/Modal/InfoModal';
import MuButton from '@units/Button/MuButton';
import Dropdown from '@collections/Dropdown/Dropdown';
import Datepicker from '@vuepic/vue-datepicker';
import '@vuepic/vue-datepicker/dist/main.css';

const props = defineProps({
    challengeType: {
        type: String,
        default: 'solo',
    }
});

const selectedFrequency = ref(null);
const step = ref(2);
const selectedDate = ref(new Date(Date.now()));

const handleFrequencyChange = (val) => {
    selectedFrequency.value = val;
};

const handleNext = () => {
    step.value = 2;
};

const handleDateChange = (date) => {
    if(date){
        const day = date.getDate();
        const month = date.getMonth();
        const year = date.getFullYear();

        console.log(year, month, day);
    }
}

const handleStartNow = () => {

};

const frequencyOptions = [
    { value: 'Daily' },
    { value: 'Weekly' },
    { value: 'None' },
]

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
