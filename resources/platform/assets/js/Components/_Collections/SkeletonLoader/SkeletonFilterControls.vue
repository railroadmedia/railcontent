<template>
    <div class="tw-animate-pulse tw-flex tw-flex-col lg:tw-flex-row tw-w-full lg:tw-justify-between">
        <!-- Tabs -->
        <div class="tw-flex tw-grow tw-flex-nowrap tw-gap-[7px] md:tw-gap-[10px] tw-mb-3 lg:tw-mb-0">
            <div v-for="i in 3" :key="i" class="tw-w-20 tw-h-[45px] tw-bg-[#F2F2F2] dark:tw-bg-[#002039] tw-rounded-full"></div>
        </div>
        <div class="tw-flex tw-grow tw-justify-end tw-items-center">
            <!-- Search Bar -->
            <div class="tw-w-full xl:tw-max-w-[500px] tw-h-[45px] tw-bg-[#F2F2F2] dark:tw-bg-[#002039] tw-rounded-full"></div>
            <!-- Buttons -->
            <div class="tw-flex tw-shrink-0 tw-w-[45px] tw-h-[45px] tw-bg-[#F2F2F2] dark:tw-bg-[#002039] tw-rounded-full tw-ml-3"></div>
            <div class="tw-flex tw-shrink-0 tw-w-[45px] tw-h-[45px] tw-bg-[#F2F2F2] dark:tw-bg-[#002039] tw-rounded-full tw-ml-3"></div>
        </div>
    </div>
</template>
<script setup>
</script>
