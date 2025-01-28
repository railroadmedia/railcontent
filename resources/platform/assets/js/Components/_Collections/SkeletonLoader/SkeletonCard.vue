<template>
    <div class="tw-animate-pulse tw-snap-center tw-flex tw-flex-col tw-group tw-w-[279px] lg:tw-w-1/4 2xl:tw-w-1/5 tw-pr-3 tw-shrink-0 tw-mr-3 lg:tw-mr-0">
        <div class="tw-flex tw-flex-col">
            <!-- Thumbnail Image -->
            <div class="tw-flex tw-flex-col tw-items-start tw-p-0 tw-isolate tw-aspect-video tw-bg-[#F2F2F2] dark:tw-bg-[#002039] tw-rounded-[8px] tw-w-full">
            </div>
            <!-- Text Section -->
            <div class="tw-flex tw-flex-col tw-w-full tw-ml-0">
                <div class="tw-flex tw-items-start tw-p-0 tw-gap-[12px] tw-w-full tw-h-[16px] tw-my-1">
                    <div class="tw-w-9/10 tw-w-full tw-h-[16px] tw-bg-[#F2F2F2] dark:tw-bg-[#002039] tw-rounded-[40px]">
                    </div>
                    <div class="tw-w-[16px] tw-h-[16px] tw-bg-[#F2F2F2] dark:tw-bg-[#002039] tw-rounded-[40px]">
                    </div>
                </div>
                <div class="tw-w-full tw-h-[16px] tw-bg-[#F2F2F2] dark:tw-bg-[#002039] tw-rounded-[40px]"></div>
            </div>
        </div>
    </div>
</template>
<script setup>
const props = defineProps({
    isSingleRow: {
        type: Boolean,
        default: () => false,
    },
})
</script>
