<template>
    <div class="tw-animate-pulse tw-snap-center tw-flex tw-flex-col tw-group" :class="[
        forceListView || breakToListView ? 'tw-py-3 tw-w-full' : 'tw-w-[267px] tw-mr-3 lg:tw-mr-0 lg:tw-w-auto tw-shrink-0',
    ]">
        <div class="tw-flex" :class="[
            forceListView || breakToListView ? 'tw-flex-row tw-items-center' : 'tw-flex-col',
            { 'lg:tw-flex-col': breakToListView }
        ]">
            <!-- Thumbnail Image -->
            <div class="tw-flex tw-flex-col tw-items-start tw-p-0 tw-isolate tw-h-[120px] tw-bg-[#F2F2F2] dark:tw-bg-[#002039] tw-rounded-[8px]"
                :class="[
                    forceListView || breakToListView ? 'tw-w-1/3 lg:tw-w-full' : 'tw-w-full']">
            </div>
            <!-- Text Section -->
            <div class="tw-flex tw-flex-col"
                :class="[
                    forceListView || breakToListView ? 'tw-w-2/3 tw-ml-2 lg:tw-w-full lg:tw-ml-0' : 'tw-w-full tw-ml-0']">
                <div class="tw-flex tw-items-start tw-p-0 tw-gap-[12px] tw-w-full tw-h-[16px] tw-my-1">
                    <div class="tw-w-9/10 tw-w-full tw-h-[16px] tw-bg-[#F2F2F2] dark:tw-bg-[#002039] tw-rounded-[40px]">
                    </div>
                    <div class="tw-w-1/10 tw-w-[16px] tw-h-[16px] tw-bg-[#F2F2F2] dark:tw-bg-[#002039] tw-rounded-[40px]">
                    </div>
                </div>
                <div class="tw-w-full tw-h-[16px] tw-bg-[#F2F2F2] dark:tw-bg-[#002039] tw-rounded-[40px]"></div>
            </div>
        </div>
    </div>
</template>
<script setup>
const props = defineProps({
    forceListView: {
        type: Boolean,
        default: false,
    },
    breakToListView: {
        type: Boolean,
        default: false,
    }
})
</script>
