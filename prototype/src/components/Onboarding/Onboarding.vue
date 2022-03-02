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
let currentStep = ref(0)
let steps = ref(initialSteps)
function changeStep(step) {
    currentStep.value = step
}
function checkStepToggle(step) {
    const newSteps = steps.value
    newSteps[step].checked = !newSteps[step].checked
    steps.value = newSteps
}
</script>

<template>
    <ModalRenderer>
        <UserInfo
            :brand="brand"
            v-if="currentStep === 0"
            @changeStep="changeStep"
            @checkStep="checkStepToggle"
            :steps="steps"
        />
        <InstrumentSelect
            :brand="brand"
            v-if="currentStep === 1"
            @changeStep="changeStep"
            :steps="steps"
        />
    </ModalRenderer>
</template>
