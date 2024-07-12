<template>
    <div class="tw-flex tw-items-center tw-mt-2">
        <div class="tw-flex-grow tw-bg-[#CBCBCD] tw-rounded-full tw-h-[10px] dark:tw-bg-[#445F74]">
            <div :class="`${brandBgColor} tw-h-[10px] tw-rounded-full`" :style="{ width: progressPercentage }"></div>
        </div>
        <div class="tw-flex tw-ml-3 tw-px-2 tw-py-0 tw-border tw-border-[#B2B2B5] tw-bg-[#F4F4F5] dark:tw-border-[#444447] dark:tw-bg-[#232327]">
            <div class="tw-flex-shrink-0 tw-text-[#00101D] dark:tw-text-white tw-text-xs tw-font-semibold tw-leading-6">
                <slot name="progress-text" />
                <span>{{ progressPercentage }}</span>
            </div>
        </div>
    </div>
</template>
  
<script setup>
import { computed } from 'vue';
import { bgColor } from '../../../Constants/brands.js';
import { storeToRefs } from 'pinia';
import { useUserStore } from '../../../Stores/user';

const userStore = useUserStore();
const { brand } = storeToRefs(userStore);

const props = defineProps({
    progress: [Number, String],
});

const progressPercentage = computed(() => {
    return props.progress + '%';
});

const brandBgColor = computed(() => {
    return bgColor[brand.value];
});

</script>../../../Constants/brands.js