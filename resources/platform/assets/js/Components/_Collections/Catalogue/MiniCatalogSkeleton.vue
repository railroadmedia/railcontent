<template>
    <!-- lesson mini catalogs -->
    <section class="tw-flex tw-flex-row tw-mb-[30px]">
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
            <!-- Cards -->
            <div class="tw-flex tw-flex-col tw-grow tw-justify-center">
                <div class="tw-block tw-no-scrollbar tw-overflow-x-clip tw-overflow-y-hidden">
                    <div class="tw-no-scrollbar tw-flex lg:tw-overflow-x-clip tw-flex-nowrap tw-overflow-x-scroll lg:tw-grid lg:tw-grid-cols-4 2xl:tw-grid-cols-5 lg:tw-gap-3 2xl:tw-gap-4">
                        <SkeletonLoader 
                            :count="5" 
                            type="card"
                            :is-single-row="true" 
                        />
                    </div>
                </div>
            </div>
        </div>
    </section>
</template>
<script setup>
    import SkeletonLoader from '@collections/SkeletonLoader/SkeletonLoader.vue';
    
</script>