<script setup>
import { ref, computed, onMounted } from 'vue'
import { storeToRefs } from 'pinia'
import ModalRenderer from '../Modal/ModalRenderer.vue'
import UserInfo from './steps/UserInfo.vue'
import InstrumentSelect from './steps/InstrumentSelect.vue'
import InstrumentType from './steps/InstrumentType.vue'
import Experience from './steps/Experience.vue'
import Genre from './steps/Genre.vue'
import Topics from './steps/Topics.vue'
import Goals from './steps/Goals.vue'
import { initialSteps, instrumentBrand, brandInstrument } from './constants';
import { getInitialInfo, getCheckedSteps } from './utils';
import { useUserStore } from '../../../stores/user';

const props = defineProps({
    startOnStep: {
        type: Number,
        default: null,
    },
    selectedBrand: {
        type: String,
        default: null,
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
    selectedGoals: {
        type: Object,
    },
});


const userStore = useUserStore();
const { userId, userDisplayName, userProfilePictureUrl } = storeToRefs(userStore)

const currentStep = ref(0)
const info = ref(getInitialInfo({
    userId: userId.value,
    userDisplayName: userDisplayName.value,
    userProfilePictureUrl: userProfilePictureUrl.value,
    ...props,
    instrument: brandInstrument[props.selectedBrand],
}))
const steps = ref(initialSteps);
const brand = computed(() => instrumentBrand[info.value.instrument]);

function changeStep (step) {
    if (step === 2) {
        const newSteps = getCheckedSteps({ ...props, steps: JSON.parse(JSON.stringify(steps.value)), brand: brand.value });
        steps.value = newSteps;
    }
    currentStep.value = step;
}

function changeInfo (newInfo) {
    info.value = newInfo;
}

function checkStepToggle (step, val) {
    const newSteps = steps.value
    newSteps[step].checked = val
    steps.value = newSteps;
}

onMounted(() => {
    if (props.selectedBrand) {
        if (props.startOnStep) {
            const newSteps = [...steps.value];
            newSteps.forEach(({ }, index) => {
                if (props.startOnStep >= index) {
                    newSteps[index].checked = true;
                }
            });
            currentStep.value = props.startOnStep;
        } else {
            const newSteps = getCheckedSteps({ ...props, steps: JSON.parse(JSON.stringify(steps.value)), brand: props.selectedBrand });
            steps.value = newSteps;
            const lastCheckedStep = newSteps.findLastIndex(idx => idx.checked);
            currentStep.value = lastCheckedStep > 0 ? lastCheckedStep : 0;
        }
    }
});
</script>

<template>
    <div class="tw-bg-[#000c17]">
        <UserInfo :brand="brand" v-if="currentStep === 0" @onChangeStep="changeStep" @onChangeInfo="changeInfo"
            @onCheckStep="checkStepToggle" :steps="steps" :info="info" :config-options="configOptions" />
        <InstrumentSelect :brand="brand" v-if="currentStep === 1" @onChangeStep="changeStep" @onChangeInfo="changeInfo"
            @onCheckStep="checkStepToggle" :steps="steps" :info="info" :config-options="configOptions" />
        <InstrumentType :brand="brand" v-if="currentStep === 2" @onChangeStep="changeStep" @onChangeInfo="changeInfo"
            @onCheckStep="checkStepToggle" :steps="steps" :info="info" :config-options="configOptions" />
        <Experience :brand="brand" v-if="currentStep === 3" @onChangeStep="changeStep" @onChangeInfo="changeInfo"
            @onCheckStep="checkStepToggle" :steps="steps" :info="info" :config-options="configOptions" />
        <Genre :brand="brand" v-if="currentStep === 4" @onChangeStep="changeStep" @onChangeInfo="changeInfo"
            @onCheckStep="checkStepToggle" :steps="steps" :info="info" :config-options="configOptions" />
        <Topics :brand="brand" v-if="currentStep === 5" @onChangeStep="changeStep" @onChangeInfo="changeInfo"
            @onCheckStep="checkStepToggle" :steps="steps" :info="info" :config-options="configOptions" />
        <Goals :brand="brand" v-if="currentStep === 6" @onChangeStep="changeStep" @onChangeInfo="changeInfo"
            @onCheckStep="checkStepToggle" :steps="steps" :info="info" :config-options="configOptions" />
    </div>
</template>
