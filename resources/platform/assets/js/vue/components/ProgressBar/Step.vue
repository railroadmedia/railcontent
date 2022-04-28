<script setup>
import { CheckIcon } from '@heroicons/vue/solid'
import { bgColor } from '../../../constants/brands'
const props = defineProps({
    stepType: {
        type: String,
        default: 'unchecked' // unchecked, tick, number
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
                    class="tw-h-[9px] tw-w-[9px] md:tw-h-[32px] md:tw-w-[32px] tw-overflow-hidden tw-rounded-full tw-text-[8px] md:tw-text-[16px]"
                >
                    <div
                        v-if="stepType === 'unchecked'"
                        :class="`tw-h-full tw-w-full tw-bg-transparent tw-border-[1px] tw-border-[#445F74] md:tw-bg-white md:tw-border-none`"
                    ></div>
                    <div
                        v-if="stepType === 'tick'"
                        v-on:click="emit('navigateToStep')"
                        :class="`${bgColor[brand]} tw-flex tw-h-full tw-w-full tw-cursor-pointer tw-items-center tw-justify-center tw-text-white`"
                    >
                        <CheckIcon class="tw-m-0 tw-h-1 tw-w-1 md:tw-h-6 md:tw-w-6 tw-text-white tw-hidden md:tw-inline" />
                    </div>
                    <div
                        v-if="stepType === 'number'"
                        :class="`${brand ? bgColor[brand] : 'tw-bg-white'} tw-flex tw-h-full tw-w-full tw-items-center tw-justify-center tw-text-white tw-font-bold`"
                    >
                        <span class="tw-hidden md:tw-inline">{{ currentStep + 1 }}</span>
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
                    <span class="tw-hidden md:tw-inline">{{ label }}</span>
                </div>
            </div>
        </div>
        <div v-if="!isLast" class="tw-mt-[14px] tw-w-[20px] md:tw-w-[60px] lg:tw-w-[80px]">
            <div
                :class="`tw-h-0 md:tw-h-[2px] tw-w-full ${
                    isBarBranded ? bgColor[brand] : 'tw-bg-white'
                }`"
            ></div>
        </div>
    </div>
</template>
