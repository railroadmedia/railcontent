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

let currentStep = ref(0)
function changeStep(step) {
    currentStep.value = step
}
</script>

<template>
    <ModalRenderer>
        <UserInfo
            :brand="brand"
            v-if="currentStep === 0"
            @changeStep="changeStep"
        />
        <InstrumentSelect
            :brand="brand"
            v-if="currentStep === 1"
            @changeStep="changeStep"
        />
    </ModalRenderer>
</template>
