<script setup>
import { ref } from 'vue'
import ModalRenderer from '../Modal/ModalRenderer.vue'
import UserInfo from './steps/UserInfo.vue'
import InstrumentSelect from './steps/InstrumentSelect.vue'
const props = defineProps({
    brand: {
        type: String,
        default: 'drumeo'
    }
})
const initialSteps = [
    { label: 'ABOUT', checked: false },
    { label: 'INSTRUMENT', checked: false },
    { label: 'EXPERIENCE', checked: false },
    { label: 'GENRES', checked: false },
    { label: 'TOPICS', checked: false },
    { label: 'COACHES', checked: false }
]
const initialInfo = {
    user: {
        name: '',
        avatarUrl: ''
    },
    instrument: null
}
let currentStep = ref(0)
let info = ref(initialInfo)
let steps = ref(initialSteps)
function changeStep(step) {
    currentStep.value = step
}
function changeInfo(newInfo) {
    info.value = newInfo

    if (newInfo.user.name && newInfo.user.name.length > 0) {
        checkStepToggle(0, true)
    } else {
        checkStepToggle(0, false)
    }
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
            :brand="brand"
            v-if="currentStep === 0"
            @changeStep="changeStep"
            @changeInfo="changeInfo"
            @checkStep="checkStepToggle"
            :steps="steps"
            :info="info"
        />
        <InstrumentSelect
            :brand="brand"
            v-if="currentStep === 1"
            @changeStep="changeStep"
            @changeInfo="changeInfo"
            @checkStep="checkStepToggle"
            :steps="steps"
            :info="info"
        />
        <div v-if="currentStep === 2">STEP 3</div>
    </ModalRenderer>
</template>
