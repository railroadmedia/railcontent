<script setup>
import { ref, inject, onMounted } from 'vue'
import ModalRenderer from '../Modal/ModalRenderer.vue'
import UserInfo from './steps/UserInfo.vue'
import InstrumentSelect from './steps/InstrumentSelect.vue'
import InstrumentType from './steps/InstrumentType.vue'
import Experience from './steps/Experience.vue'
import Genre from './steps/Genre.vue'
import Topics from './steps/Topics.vue'
import Coaches from './steps/Coaches.vue'

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
})

onMounted(() => {
    console.log(props.selectedGear)
})

const userId = inject('userId');
const userName = inject('userName');
const userAvatar = inject('userAvatar');

const initialSteps = [
    { label: 'ABOUT', checked: false },
    { label: 'INSTRUMENT', checked: false },
    { label: 'GEAR', checked: false },
    { label: 'EXPERIENCE', checked: false },
    { label: 'GENRES', checked: false },
    { label: 'TOPICS', checked: false },
    { label: 'COACHES', checked: false }
]

const instrumentBrand = {
    piano: 'pianote',
    drums: 'drumeo',
    guitar: 'guitareo',
    singing: 'singeo',
    default: 'drumeo'
}
const initialInfo = {
    user: {
        id: userId,
        name: userName || null,
        avatarUrl: userAvatar || null
    },
    instrument: 'default',
    instrumentTypes: {}
}

let currentStep = ref(0)
let info = ref(initialInfo)
let steps = ref(initialSteps)

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
