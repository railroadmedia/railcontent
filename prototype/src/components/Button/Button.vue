<script setup>
import { bgColor } from '../../constants/brands'
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
        @click="!isDisabled && emit('buttonClick')"
        :class="`MusoraButton tw-rounded-[25px] tw-py-[13px] tw-px-[36px] tw-text-white ${
            bgColor[brand]
        } ${classOverride} ${isDisabled ? 'MusoraButton__disabled' : ''}`"
    >
        <slot>Submit</slot>
    </button>
</template>

<style scoped>
.MusoraButton {
    font-family: Bebas Neue;
    font-style: normal;
    font-weight: bold;
    font-size: 20px;
    line-height: 24px;
    text-transform: uppercase;
    box-shadow: 0px 1px 2px rgba(0, 0, 0, 0.05);
}

.MusoraButton__disabled {
    background: rgba(68, 95, 116, 0.55) !important;
    color: #00101d !important;
}
</style>
