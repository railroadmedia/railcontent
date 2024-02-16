<template>
    <div class="tw-animate-pulse tw-snap-center tw-flex tw-flex-col tw-group tw-shrink-0 sm:tw-pr-[12px]"
         :class="`sm:tw-w-1/4 lg:tw-w-1/5 xl:tw-w-1/7 tw-mb-4 lg:tw-mb-6 ${isGroupedView ? 'tw-w-[145px] sm:tw-w-[170px] tw-mr-[12px] lg:tw-mr-0' : 'tw-w-full'}`">
        <div class="tw-flex tw-items-center" :class="`${isGroupedView ? 'tw-flex-col' : 'tw-flex-row sm:tw-flex-col'}`">
            <!-- Thumbnail Section -->
            <div class="tw-no-underline tw-flex tw-flex-col tw-aspect-square tw-mr-[5px] sm:tw-mr-0" :class="[
                { 'tw-w-full': isGroupedView },
                { 'tw-w-[65px] sm:tw-w-full tw-flex-shrink-0': !isGroupedView },
            ]">
                <div :class="`tw-relative tw-overflow-hidden ${isGroupedView ? 'tw-rounded-[9px]' : 'tw-rounded-[5px] sm:tw-rounded-[9px]'} tw-bg-white dark:tw-bg-[#0E2031] tw-aspect-square`"></div>
            </div>
            <!-- Description Section -->
            <div class="tw-flex tw-w-full tw-justify-between">
                <div class="tw-w-full tw-flex tw-flex-wrap lg:tw-block">
                    <div class="card-info tw-flex-auto tw-flex-col tw-rounded-lg tw-pt-2" :class="isGroupedView ? 'tw-flex' : 'tw-hidden sm:tw-flex'">
                        <div class="tw-flex tw-flex-col">
                            <!-- Artist Name -->
                            <div class="tw-mb-1 tw-w-2/3 tw-h-[17px] tw-bg-[#F2F2F2] dark:tw-bg-[#002039] tw-rounded-full"></div>
                            <!-- Song Title -->
                            <div class="tw-bg-[#F2F2F2] dark:tw-bg-[#002039] tw-rounded-full tw-w-11/12 tw-h-[18px] tw-mb-1"></div>
                        </div>
                        <!-- Difficulty Label -->
                        <div class="tw-w-2/3 tw-h-[17px] tw-bg-[#F2F2F2] dark:tw-bg-[#002039] tw-rounded-full"></div>
                    </div>
                    <div
                       class="card-info tw-flex-auto tw-flex-col tw-rounded-lg tw-h-full tw-justify-center"
                       :class="isGroupedView ? 'tw-hidden' : 'tw-flex sm:tw-hidden'">
                        <div class="tw-flex tw-flex-col">
                            <!-- Song Title -->
                            <div class="tw-mb-1 tw-w-3/4 tw-h-[18px] tw-bg-[#F2F2F2] dark:tw-bg-[#002039] tw-rounded-full"></div>
                        </div>
                        <!-- Difficulty Label, Artist Name -->
                        <div class="tw-w-1/2 tw-h-[18px] tw-bg-[#F2F2F2] dark:tw-bg-[#002039] tw-rounded-full"></div>
                    </div>
                </div>
                <!-- Add to Playlist -->
                <div :class="`tw-bg-[#F2F2F2] dark:tw-bg-[#002039] tw-rounded-full sm:tw-mt-2 ${isGroupedView ? 'tw-h-[14px] tw-w-[14px] lg:tw-h-[32px] lg:tw-w-[32px]' : 'tw-h-[25px] tw-w-[30px]'}`"></div>
            </div>
        </div>
    </div>
</template>
<script setup>
const props = defineProps({
    isGroupedView: {
        type: Boolean,
        default: () => false,
    },
});
</script>
