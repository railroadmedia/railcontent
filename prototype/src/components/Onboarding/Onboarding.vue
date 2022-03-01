<script setup>
import ModalRenderer from '../Modal/ModalRenderer.vue'
import UserInfo from './steps/UserInfo.vue'
import InstrumentSelect from './steps/InstrumentSelect.vue'
const props = defineProps({
    currentStep: {
        type: Number,
        default: 1
    },
    brand: {
        type: String,
        default: 'drumeo'
    }
})
</script>

<template>
    <ModalRenderer>
        <UserInfo :brand="brand" v-if="currentStep === 0" />
        <InstrumentSelect :brand="brand" v-if="currentStep === 1" />
    </ModalRenderer>
</template>
