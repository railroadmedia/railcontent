<template>
    <div class="tw-my-[30px] tw-animate-pulse">
        <div class="tw-pb-1">
            <h2 class="tw-mb-3 tw-bg-[#F2F2F2] dark:tw-bg-[#002039] tw-rounded-full tw-w-32 tw-h-7 md:t-w-h-8"></h2>
        </div>

        <!-- Active Coaches -->
        <div class="tw-my-3">
            <div class="tw-grid tw-grid-cols-2 md:tw-grid-cols-3 xl:tw-grid-cols-4 2xl:tw-grid-cols-6 tw-gap-3">
                <div v-for="i in 6" class="tw-rounded-3xl tw-overflow-hidden tw-relative tw-flex tw-mb-3 tw-aspect-[3/5]" :key="`active-coach-card-${i}`">
                    <div class="tw-absolute tw-w-full tw-h-full tw-top-0 tw-left-0 tw-bg-[#F2F2F2] dark:tw-bg-[#002039]"></div>
                </div>
            </div>
        </div>
    </div>
</template>
