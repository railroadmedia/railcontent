<script setup>
import { ref, inject, computed } from 'vue'
import ModalRenderer from '../Modal/ModalRenderer.vue'
import UserInfo from './steps/UserInfo.vue'
import InstrumentSelect from './steps/InstrumentSelect.vue'
import InstrumentType from './steps/InstrumentType.vue'
import Experience from './steps/Experience.vue'
import Genre from './steps/Genre.vue'
import Topics from './steps/Topics.vue'
import Coaches from './steps/Coaches.vue'
import { initialSteps, instrumentBrand } from './constants';
import { getInitialInfo, getCheckedSteps } from './utils';

const props = defineProps({
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
const steps = ref(initialSteps);
const brand = computed(() => instrumentBrand[info.value.instrument]);

function changeStep(step) {
    if (step === 2) {
        const newSteps = getCheckedSteps({ ...props, steps: JSON.parse(JSON.stringify(steps.value)), brand: brand.value });
        newSteps.forEach(step => console.log(JSON.stringify(step)));
        steps.value = newSteps;
    }
    currentStep.value = step;
}

function changeInfo(newInfo) {
    info.value = newInfo;
}

function checkStepToggle(step, val) {
    const newSteps = steps.value
    newSteps[step].checked = val
    steps.value = newSteps;
}
</script>

<template>
    <ModalRenderer>
        <UserInfo
            :brand="brand"
            v-if="currentStep === 0"
            @onChangeStep="changeStep"
            @onChangeInfo="changeInfo"
            @onCheckStep="checkStepToggle"
            :steps="steps"
            :info="info"
            :config-options="configOptions"
        />
        <InstrumentSelect
            :brand="brand"
            v-if="currentStep === 1"
            @onChangeStep="changeStep"
            @onChangeInfo="changeInfo"
            @onCheckStep="checkStepToggle"
            :steps="steps"
            :info="info"
            :config-options="configOptions"
        />
        <InstrumentType
            :brand="brand"
            v-if="currentStep === 2"
            @onChangeStep="changeStep"
            @onChangeInfo="changeInfo"
            @onCheckStep="checkStepToggle"
            :steps="steps"
            :info="info"
            :config-options="configOptions"
        />
        <Experience
            :brand="brand"
            v-if="currentStep === 3"
            @onChangeStep="changeStep"
            @onChangeInfo="changeInfo"
            @onCheckStep="checkStepToggle"
            :steps="steps"
            :info="info"
            :config-options="configOptions"
        />
        <Genre
            :brand="brand"
            v-if="currentStep === 4"
            @onChangeStep="changeStep"
            @onChangeInfo="changeInfo"
            @onCheckStep="checkStepToggle"
            :steps="steps"
            :info="info"
            :config-options="configOptions"
        />
        <Topics
            :brand="brand"
            v-if="currentStep === 5"
            @onChangeStep="changeStep"
            @onChangeInfo="changeInfo"
            @onCheckStep="checkStepToggle"
            :steps="steps"
            :info="info"
            :config-options="configOptions"
        />
        <Coaches
            :brand="brand"
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
