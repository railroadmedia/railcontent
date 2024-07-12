<script setup>
import { bgColor } from '../../Constants/brands'
const props = defineProps({
    label: {
        type: String,
        default: ''
    },
    id: {
        type: String,
        default: 'text-input'
    },
    classOverride: {
        type: String,
        default: ''
    },
    brand: {
        type: String,
        default: 'drumeo'
    },
    isDisabled: {
        type: Boolean,
        default: false
    }
})
const emit = defineEmits(['onButtonClick'])
</script>

<template>
    <button
        type="button"
        @click="!isDisabled && emit('onButtonClick')"
        :class="`MusoraButton tw-flex tw-items-center tw-justify-center tw-uppercase tw-font-bebas-neue tw-leading-[24px] tw-text-[20px] tw-rounded-[25px] tw-py-[13px] tw-px-[36px] tw-text-white ${
            bgColor[brand]
        } ${classOverride} ${isDisabled ? 'MusoraButton__disabled' : ''}`"
    >
        <slot>Submit</slot>
    </button>
</template>

<style scoped>
.MusoraButton {
    box-shadow: 0px 1px 2px rgba(0, 0, 0, 0.05);
}

.MusoraButton__disabled {
    background: rgba(68, 95, 116, 0.55) !important;
    color: #00101d !important;
    cursor: default !important;
}
</style>
../../Constants/brands