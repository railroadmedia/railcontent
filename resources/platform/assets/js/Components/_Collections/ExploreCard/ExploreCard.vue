<template>
    <button :id="id" :data-testid="id" class="tw-text-[#000C17] dark:tw-text-white hover:tw-text-white tw-h-[80px] xl:tw-h-[110px] tw-flex tw-justify-between tw-items-center tw-flex-1 tw-bg-white dark:tw-bg-[#002039] hover:tw-bg-[#081825] tw-py-[20px] tw-px-[20px] tw-rounded-[10px] xl:tw-max-w-[50%]" @click="emit('onCardClick')">
        <div class="tw-flex tw-items-center">
            <slot></slot>
            <div class="tw-pl-[15px] xl:tw-pl-[30px] tw-flex tw-flex-col tw-justify-center">
                <h2 class="tw-text-left tw-uppercase tw-text-[24px] tw-leading-[24px] xl:tw-text-[35px] xl:tw-leading-[35px] tw-font-normal tw-font-bebas-neue tw-letter-spacing-[1px]">{{ title }}</h2>
                <p class="tw-text-[12px] tw-leading-[18px] xl:tw-text-[18px] xl:tw-leading-[27px] tw-font-normal">{{ description }}</p>
            </div>
        </div>
        <div class="tw-flex tw-flex-col tw-justify-center tw-items-center">
            <ChevronRightIcon class="tw-block tw-w-[32px] tw-h-[32px]]" />
        </div>
    </button>
</template>

<script setup>
import { ChevronRightIcon } from '@heroicons/vue/outline';

const emit = defineEmits(['onCardClick']);

const props = defineProps({
    title: {
        type: String,
        required: true
    },
    description: {
        type: String,
        required: true
    },
    id: {
        type: String,
        required: true
    }
});
</script>
