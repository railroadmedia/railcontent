<template>
    <InfoModal :selfContained="true" class-override="tw-max-w-[510px] tw-w-full">
        <div class="tw-flex tw-flex-col tw-justify-center -tw-mt-[50px] tw-text-white tw-text-center">
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
                <div class="tw-w-[280px] tw-mx-auto">
                    <Datepicker inline :enable-time-picker="false" :action-row="{ showCancel: false, showSelect: false, showPreview: false }" :model-value="selectedDate" @internal-model-change="handleDateChange" />
                </div>
                <div class="tw-flex tw-justify-end tw-mt-[30px]">
                    <MuButton :disabled="!selectedDate" @click="handleStartNow">Start Now</MuButton>
                </div>
            </template>

            <!-- Step 2 (Community) -->
            <template v-if="step === 2 && challengeType === 'community'">
                <h1 class="tw-mb-3 tw-text-2xl tw-font-bold">30-Day Drummer starts on August 20</h1>
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
import InfoModal from '@collections/Modal/InfoModal.vue';
import MuButton from '@units/Button/MuButton';
import Dropdown from '@collections/Dropdown/Dropdown.vue';
import Datepicker from '@vuepic/vue-datepicker';
import '@vuepic/vue-datepicker/dist/main.css';

const props = defineProps({
    challengeType: {
        type: String,
        default: 'community',
    }
});

const selectedFrequency = ref(null);
const step = ref(2);
const selectedDate = ref();

const handleFrequencyChange = (val) => {
    selectedFrequency.value = val;
};

const handleNext = () => {
    step.value = 2;
};

const handleDateChange = (val) => {

}

const handleStartNow = () => {

};

const frequencyOptions = [
    { value: 'Daily' },
    { value: 'Weekly' },
    { value: 'None' },
]
</script>
