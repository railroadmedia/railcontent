<template>
    <div class="tw-animate-pulse tw-flex tw-items-start tw-justify-between tw-mb-4 tw-flex-wrap">
        <div class="lg:tw-flex-1">
            <!-- Title -->
            <div class="tw-mt-2 tw-bg-[#F2F2F2] dark:tw-bg-[#002039] tw-rounded-full tw-w-52 tw-h-9 md:tw-h-10"></div>
            <div class="tw-w-full tw-flex tw-pt-[5px] tw-pb-2 tw-items-center tw-text-[#F2F2F2] dark:tw-text-[#002039]">
                <!-- Artist -->
                <div class="tw-bg-[#F2F2F2] dark:tw-bg-[#002039] tw-rounded-full tw-w-20 tw-h-9"></div>
                <DotSeparator />
                <!-- Difficulty -->
                <div class="tw-bg-[#F2F2F2] dark:tw-bg-[#002039] tw-rounded-full tw-w-20 tw-h-9"></div>
                <DotSeparator />
                <!-- Content Type -->
                <div class="tw-bg-[#F2F2F2] dark:tw-bg-[#002039] tw-rounded-full tw-w-20 tw-h-9"></div>
            </div>
        </div>
        <!-- Video CTAs -->
        <div class="tw-flex tw-items-start tw-mt-2 tw-overflow-auto sm:tw-overflow-visible tw-no-scrollbar tw-pb-40 -tw-mb-36 lg:-tw-mb-40 tw-relative">
            <div class="tw-mr-2 tw-bg-[#F2F2F2] dark:tw-bg-[#002039] tw-rounded-full tw-w-20 tw-h-[34px]"></div>
            <div class="tw-mr-2 tw-bg-[#F2F2F2] dark:tw-bg-[#002039] tw-rounded-full tw-w-16 tw-h-[34px]"></div>
            <div class="tw-mr-2 tw-bg-[#F2F2F2] dark:tw-bg-[#002039] tw-rounded-full tw-w-16 tw-h-[34px]"></div>
            <div class="tw-mr-2 tw-bg-[#F2F2F2] dark:tw-bg-[#002039] tw-rounded-full tw-w-16 tw-h-[34px]"></div>
            <div class="tw-mr-2 tw-bg-[#F2F2F2] dark:tw-bg-[#002039] tw-rounded-full tw-w-20 tw-h-[34px]"></div>
            <div class="tw-bg-[#F2F2F2] dark:tw-bg-[#002039] tw-rounded-full tw-w-[34px] tw-h-[34px]"></div>
        </div>
    </div>

    <!-- Coach Profile -->
    <div class="tw-animate-pulse tw-flex tw-mb-6">
        <div class="tw-bg-[#F2F2F2] dark:tw-bg-[#002039] tw-rounded-full tw-w-14 tw-h-14 tw-mr-3"></div>
        <div>
            <div class="tw-bg-[#F2F2F2] dark:tw-bg-[#002039] tw-rounded-full tw-w-24 tw-h-6 tw-mb-1"></div>
            <div class="tw-bg-[#F2F2F2] dark:tw-bg-[#002039] tw-rounded-full tw-w-32 tw-h-6"></div>
        </div>
    </div>
</template>
<script setup>
import DotSeparator from '@vuesora/Components/VideoResources/DotSeparator';

defineOptions({
  inheritAttrs: false, // Prevent automatic attribute inheritance
});
</script>
