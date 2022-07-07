<script setup>
import { ref, inject } from 'vue'
import ModalRenderer from '../Modal/ModalRenderer.vue'
import UserInfo from './steps/UserInfo.vue'
import InstrumentSelect from './steps/InstrumentSelect.vue'
import InstrumentType from './steps/InstrumentType.vue'
import Experience from './steps/Experience.vue'
import Genre from './steps/Genre.vue'
import Topics from './steps/Topics.vue'
import Coaches from './steps/Coaches.vue'
import { initialSteps, instrumentBrand } from './constants';
import { getInitialInfo } from './utils';

const props = defineProps({
    brand: {
        type: String,
    },
    configOptions: {
        type: Object,
    },
    selectedGear: {
        type: Object,
    },
    selectedTopics: {
        type: Object,
    },
    selectedGenres: {
        type: Object,
    },
    selectedExperience: {
        type: Object,
    },
});

const userId = inject('userId');
const userName = inject('userName');
const userAvatar = inject('userAvatar');

const currentStep = ref(0)
const info = ref(getInitialInfo({ userId, userName, userAvatar, ...props }))
const steps = ref(initialSteps)

function changeStep(step) {
    currentStep.value = step
}

function changeInfo(newInfo) {
    info.value = newInfo
}

function checkStepToggle(step, val) {
    const newSteps = steps.value
    newSteps[step].checked = val
    steps.value = newSteps
}
</script>

<template>
    <ModalRenderer>
        <UserInfo
            :brand="instrumentBrand[info.instrument]"
            v-if="currentStep === 0"
            @onChangeStep="changeStep"
            @onChangeInfo="changeInfo"
            @onCheckStep="checkStepToggle"
            :steps="steps"
            :info="info"
            :config-options="configOptions"
        />
        <InstrumentSelect
            :brand="instrumentBrand[info.instrument]"
            v-if="currentStep === 1"
            @onChangeStep="changeStep"
            @onChangeInfo="changeInfo"
            @onCheckStep="checkStepToggle"
            :steps="steps"
            :info="info"
            :config-options="configOptions"
        />
        <InstrumentType
            :brand="instrumentBrand[info.instrument]"
            v-if="currentStep === 2"
            @onChangeStep="changeStep"
            @onChangeInfo="changeInfo"
            @onCheckStep="checkStepToggle"
            :steps="steps"
            :info="info"
            :config-options="configOptions"
        />
        <Experience
            :brand="instrumentBrand[info.instrument]"
            v-if="currentStep === 3"
            @onChangeStep="changeStep"
            @onChangeInfo="changeInfo"
            @onCheckStep="checkStepToggle"
            :steps="steps"
            :info="info"
            :config-options="configOptions"
        />
        <Genre
            :brand="instrumentBrand[info.instrument]"
            v-if="currentStep === 4"
            @onChangeStep="changeStep"
            @onChangeInfo="changeInfo"
            @onCheckStep="checkStepToggle"
            :steps="steps"
            :info="info"
            :config-options="configOptions"
        />
        <Topics
            :brand="instrumentBrand[info.instrument]"
            v-if="currentStep === 5"
            @onChangeStep="changeStep"
            @onChangeInfo="changeInfo"
            @onCheckStep="checkStepToggle"
            :steps="steps"
            :info="info"
            :config-options="configOptions"
        />
        <Coaches
            :brand="instrumentBrand[info.instrument]"
            v-if="currentStep === 6"
            @onChangeStep="changeStep"
            @onChangeInfo="changeInfo"
            @onCheckStep="checkStepToggle"
            :steps="steps"
            :info="info"
            :config-options="configOptions"
        />
    </ModalRenderer>
</template>
