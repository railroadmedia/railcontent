<template>
    <div class="tw-animate-pulse tw-shrink-0" :class="widthStyles">
        <!-- Image -->
        <div class="tw-rounded-lg tw-aspect-[2/3] tw-bg-[#F2F2F2] dark:tw-bg-[#002039]"></div>
        <!-- Name -->
        <div class="tw-my-[7px] tw-w-1/2 tw-h-1.5 tw-bg-[#F2F2F2] dark:tw-bg-[#002039] tw-rounded-full"></div>
        <!-- Difficulty -->
        <div class="tw-bg-[#F2F2F2] dark:tw-bg-[#002039] tw-rounded-full tw-h-1.5 tw-w-1/4"></div>
    </div>
</template>
<script setup>
import { computed } from "vue";

const props = defineProps({
    isGroupedView: {
        type: Boolean,
        default: () => false,
    },
});

const widthStyles = computed(() => {
    if(props.isGroupedView){
        return 'tw-w-[168px] sm:tw-w-[230px] lg:tw-w-auto'
    }
})
</script>
