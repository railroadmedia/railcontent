<template>
    <div class="tw-animate-pulse tw-snap-center tw-flex tw-flex-col tw-group" :class="[
        forceListView || breakToListView ? 'tw-py-3 tw-w-full' : `tw-w-[267px] lg:tw-w-1/4 2xl:tw-w-1/5 tw-mb-4 lg:tw-mb-6 tw-shrink-0 tw-pr-[8px] xl:tw-pr-[12px] 3xl:tw-pr-[18px]`,
        { 'tw-py-3 tw-w-full @3xl/breakToList:tw-py-0 @3xl/breakToList:tw-w-1/4 @3xl/breakToList:tw-mb-6 @3xl/breakToList:tw-pr-[8px] @4xl/breakToList:tw-pr-[12px] @5xl/breakToList:tw-w-1/5 @6xl/breakToList:tw-pr-[18px]': breakToListView }
    ]">
        <div class="tw-flex" :class="[
            forceListView || breakToListView ? 'tw-flex-row tw-items-center' : 'tw-flex-col',
            { '@3xl/breakToList:tw-flex-col': breakToListView }
        ]">
            <!-- Thumbnail Image -->
            <div class="tw-flex tw-flex-col tw-items-start tw-p-0 tw-isolate tw-h-[120px] tw-bg-[#F2F2F2] dark:tw-bg-[#002039] tw-rounded-[8px]"
                :class="[
                    forceListView || breakToListView ? 'tw-w-1/3 @3xl/breakToList:tw-w-full' : 'tw-w-full']">
            </div>
            <!-- Text Section -->
            <div class="tw-flex tw-flex-col"
                :class="[
                    forceListView || breakToListView ? 'tw-w-2/3 tw-ml-2 @3xl/breakToList:tw-w-full @3xl/breakToList:tw-ml-0' : 'tw-w-full tw-ml-0']">
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
