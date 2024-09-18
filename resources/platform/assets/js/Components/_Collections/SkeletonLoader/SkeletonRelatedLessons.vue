<template>
    <div class="tw-flex tw-w-full tw-animate-pulse">
        <div class="tw-w-full tw-border dark:tw-border-[#002039] tw-border-[#e5e7ea] dark:tw-bg-[#000C17] tw-bg-[#F9F9F9] tw-overflow-hidden">
            <header class="tw-flex tw-w-full">
                <div class="tw-bg-white dark:tw-bg-[#081825] tw-pt-[24px] tw-pb-[16px] tw-flex tw-justify-between tw-px-[18px] tw-w-full">
                    <!-- Title -->
                    <div class="tw-bg-[#F2F2F2] dark:tw-bg-[#002039] tw-rounded-full tw-w-40 tw-h-[35px]"></div>
                    <div class="tw-bg-[#F2F2F2] dark:tw-bg-[#002039] tw-rounded-full tw-h-[35px] tw-w-[35px]"></div>
                </div>
            </header>
            <!-- Cards -->
            <section
                class="tw-w-full tw-flex tw-flex-col tw-max-h-[1000px] tw-relative tw-overflow-y-auto lg:tw-block"
            >
                <div v-for="i in 5" :key="i" class="tw-group tw-flex tw-w-full tw-items-center tw-transition-colors hover:tw-bg-[#E0E0E1] dark:hover:tw-bg-[#102230] even:tw-bg-white dark:even:tw-bg-[#081825] tw-px-2">
                    <SkeletonCatalogueListElement />
                </div>
            </section>
        </div>
    </div>
</template>

<script setup>
import SkeletonCatalogueListElement from '@collections/SkeletonLoader/SkeletonCatalogueListElement';
</script>
