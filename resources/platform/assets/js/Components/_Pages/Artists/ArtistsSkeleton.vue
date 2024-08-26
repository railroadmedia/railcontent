<template>
    <div class="tw-w-full tw-max-w-[1703px] tw-mx-auto tw-px-4 md:tw-px-8">
        <!-- Breadcrumbs -->
        <Breadcrumb :is-loading="true"/>

        <header data-v-16164e31="" class="tw-py-5 md:tw-pt-[25px] tw-flex tw-flex-col tw-border-b tw-border-[#E4E4E7] dark:tw-border-[#223457]">
            <div class="tw-flex tw-items-center tw-flex-wrap tw-justify-center sm:tw-justify-end">
                <div class="tw-flex-grow tw-mr-auto">
                    <div class="tw-flex tw-items-center">
                        <div class="tw-flex tw-flex-col tw-self-stretch tw-mr-1 tw-w-full">
                            <div class="tw-h-full tw-flex tw-flex-col tw-items-start tw-justify-center">
                                <div class="tw-flex">
                                    <span class="tw-text-2xl sm:tw-text-[32px] sm:tw-leading-tight tw-font-bold dark:tw-text-white tw-line-clamp-3 tw-overflow-hidden tw-capitalize">Artists</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </header>

        <div class="tw-animate-pulse tw-mb-4">
            <!-- Header Skeleton -->
            <div class="tw-my-4 tw-w-[125px] tw-h-[32px] md:tw-my-8 tw-bg-ui-skeleton tw-rounded-full"></div>
            <div class="tw-columns-xs">
                <div class="tw-mb-2" v-for="n in 26" :key="n">
                    <h2 class="tw-h-[28px] tw-w-[28px] tw-bg-ui-skeleton tw-rounded-full"></h2>
                    <li v-for="i in 4" :key="i" class="marker:tw-text-ui-skeleton tw-h-[24px] tw-w-2/3 tw-m-2 tw-bg-ui-skeleton tw-rounded-full" ></li>
                </div>
            </div>
        </div>
    </div>
</template>
<script setup>
</script>
