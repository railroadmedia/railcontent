<template>
    <!-- My Stats -->
    <section class="tw-flex tw-flex-row tw-mb-[30px] tw-animate-pulse">
        <div class="tw-flex tw-flex-col tw-w-full">
            <!-- title -->
            <div class="tw-flex tw-items-center tw-mb-4 tw-w-full tw-justify-between">
                <div class="tw-flex tw-items-center">
                    <div class="tw-w-[294px] tw-h-[24px] tw-rounded-full tw-bg-ui-skeleton"></div>
                </div>
                <div class="tw-flex tw-items-center">
                    <div class="tw-w-[44px] tw-h-[17px] tw-rounded-full tw-bg-ui-skeleton"></div>
                </div>
            </div>
            <!-- Stats -->
            <div class="tw-flex tw-flex-col lg:tw-flex-row tw-justify-center tw-items-center tw-mb-5 tw-w-full tw-rounded-full tw-min-h-[150px] lg:tw-pr-6 tw-bg-ui-skeleton"></div>
            <div class="tw-grid tw-grid-rows-2 xl:tw-grid-rows-1 tw-gap-3 tw-auto-cols-fr tw-grid-flow-col">
                <div v-for="n in 4" :key="n" class="tw-inline-flex tw-w-full tw-min-h-[150px] tw-flex-col tw-rounded-full tw-border-[3px] tw-border-ui-skeleton tw-justify-center tw-items-center tw-justify-items-stretch"></div>
            </div>
        </div>
    </section>
</template>
<script setup>
</script>