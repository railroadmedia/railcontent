<script setup>
import { CheckIcon } from '@heroicons/vue/solid'
import { bgColor } from '../../../constants/brands'
const props = defineProps({
    stepType: {
        type: String,
        default: 'white' // white, tick, number
    },
    isLast: {
        type: Boolean,
        default: false
    },
    label: {
        type: String,
        default: ''
    },
    brand: {
        type: String
    },
    currentStep: {
        type: Number
    },
    isBarBranded: {
        type: Boolean
    }
})
const emit = defineEmits(['navigateToStep'])
</script>

<template>
    <div class="tw-flex">
        <div class="tw-flex tw-flex-col">
            <div class="tw-relative tw-flex tw-flex-col tw-items-center">
                <div
                    class="tw-h-[32px] tw-w-[32px] tw-overflow-hidden tw-rounded-full"
                >
                    <div
                        v-if="stepType === 'white'"
                        class="tw-h-full tw-w-full tw-bg-white"
                    ></div>
                    <div
                        v-if="stepType === 'tick'"
                        v-on:click="emit('navigateToStep')"
                        :class="`${bgColor[brand]} tw- tw-flex tw-h-full tw-w-full tw-cursor-pointer tw-items-center tw-justify-center tw-text-white`"
                    >
                        <CheckIcon class="tw-m-0 tw-h-6 tw-w-6 tw-text-white" />
                    </div>
                    <div
                        v-if="stepType === 'number'"
                        :class="`${bgColor[brand]} tw-flex tw-h-full tw-w-full tw-items-center tw-justify-center tw-text-white`"
                    >
                        {{ currentStep + 1 }}
                    </div>
                </div>
                <div
                    class="tw-absolute tw-mt-[36px] tw-text-center tw-text-[14px] tw-text-white"
                    :class="
                        stepType === 'number'
                            ? 'tw-font-bold'
                            : 'tw-font-normal'
                    "
                >
                    {{ label }}
                </div>
            </div>
        </div>
        <div v-if="!isLast" class="tw-mt-[14px] tw-w-[80px]">
            <div
                :class="`tw-h-[2px] tw-w-full ${
                    isBarBranded ? bgColor[brand] : 'tw-bg-white'
                }`"
            ></div>
        </div>
    </div>
</template>
